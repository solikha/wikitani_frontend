<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/* Manggu Framework
 * Simple PHP Application Development
 * Kusnassriyanto S. Bahri
 * kusnassriyanto@gmail.com
 * 
 */

class M_crud extends MY_Model
{
    var $fieldTypes;
    var $crudData;
    var $actionTypes;
    var $crudName;
    var $actionName;
    var $sessionData = array();
    var $userInfo = array();
    var $namespace = '';
    var $ismodal = true;
    var $defaultParams = array();
    var $mustache_loaded = false;
    public function __construct()
    {
        parent::__construct();
        $this->load->library('user_agent');
    }
    
    function loadCrudFile($crudname, $actionname){
        $this->crudName = $crudname;
        $this->actionName = $actionname;
        $this->fieldTypes = $this->getJsonFile('fieldtypes', 'list');
        $this->actionTypes = $this->getJsonFile('actiontypes', 'list');
        $this->crudData = $this->getJsonFile($crudname.'/'.$actionname);
        if (!isset($this->crudData['grouplist'])){
            $this->crudData['grouplist'] = $this->getGroupDefault();
        }
    }
    
	function isAdmin($username=''){
		$sql = "
			select * 
			from sys_users a
			left join sys_userroles b on a.userid = b.userid
			left join sys_roles c on b.roleid = c.roleid
			where a.username = :username
			and isadmin = 1
			--and rolename = 'admin'		
		";
		$qres = $this->mdb->QueryData('application', $sql, array('username'=>$username), 'record');
		if (isset($qres[0])){
			//print_r($qres); die;
			return true;
		}
		return false;
		
	}
	
    public function showCrud($crudname, $actionname){
        $this->loadCrudFile($crudname, $actionname);
        $data = $this->getDefaultCrudData();
        
        $data['namespace'] = $this->getNameSpace();
        $data['crudtitle'] = $this->getCrudTitle();
        $data['show_search_btn'] = $this->getShowSearchButton();
        
        if(isset($this->crudData['defaultparamtype'])){
            $defpartype = $this->crudData['defaultparamtype'];
        } else {
            $defpartype = 'none';
        }
        $params = $this->getDefaultParams($defpartype);
        $ctparams = $this->getViewDataParams($data['namespace'].'crud-param', $params);
        $data['referrer'] = $this->agent->referrer();
        $data['crudparams'] = $ctparams['view'];
        $qdata = $this->getViewDataGrid($params);
        $data['crudgrid'] = $qdata['view'];
        $data['crudgridinfo'] = $qdata['gridinfo'];
        $data['crudpages'] = $qdata['pagination'];
        $data['crudcommands'] = $qdata['crudcommands'];
        $data['breadcrumbs'] = $qdata['breadcrumbs'];
        $data['cmdscripts'] = $qdata['cmdscripts'];
        $data['crudname'] = $crudname;
        $data['actionname'] = $actionname;
        //print_r($data['crudgrid']);
        $data['namespace'] = $this->getNameSpace();
        
        if (isset($this->crudData['scriptfile'])){
            try {
                $text = $this->getTextFile($crudname.'/'.$this->crudData['scriptfile']);
                $text = $text."\r\n";
            } catch(Exception $e) {

                $text = '//'.$e->getMessage();
            }
            $data['scriptdata'] = $text;
        }
        if (isset($this->crudData['showgrid'])){
            $data['showgrid'] = $this->crudData['showgrid'];
        }
        $result = $this->load->view('crud/baseview', $data, true);
        echo $result;
    }
    
    public function showCommand($crudname, $actionname, $buffered=false){
        $this->loadCrudFile($crudname, $actionname);
        $data = $this->getDefaultCrudData();
        //print_r($_POST);
        //print_r($this->crudData);
        $cmdMode = getArrayDef($this->crudData, 'cmdmode');
        if ($cmdMode=='select'){
            $result = $this->selectCommandCrud($crudname, $actionname);
            if($result){
                $data = $result;
            }
        }

        $data['namespace'] = $this->getNameSpace();
        $data['crudtitle'] = $this->getCrudTitle();
        
        $data['crudmessage'] = getArrayDef($this->crudData, 'message', '');
        //$data['crudmessage'] = getArrayDef($this->crudData, 'message', '');
        
        if(isset($this->crudData['defaultparamtype'])){
            $defpartype = $this->crudData['defaultparamtype'];
        } else {
            $defpartype = 'none';
        }

        if(isset($this->crudData['submitactions']['list'])){        
            //echo "xxx"; die;
            $cmd = $this->getSubmitCommands();
            $view = $this->formatViewCommands($cmd);
            $data['submitactions'] = $view;
            //print_r($this->getSubmitCommands());
        } else {
            unset($data['submitactions']);
        }
        if(isset($this->crudData['submitactions']['submiturl'])){
            $data['execurl'] = $this->getMainUrl().$this->crudData['submitactions']['submiturl'];
        } else {
            unset($data['execurl']);
        }
        //echo $defpartype."/////";
        //print_r($this->defaultParams);
        $defparams = array_merge($this->getDefaultParams($defpartype), $this->defaultParams);
        //print_r($defparams); die;
        if (isset($this->crudData['viewtype']) and $this->crudData['viewtype']=='view'){
            $data['paramdata'] = $defparams;
            $result = $this->load->view($this->crudData['viewname'], $data);
        } else {
            $ctparams = $this->getViewDataParams('crud-edit', $defparams);
            $data['crudparams'] = $ctparams['view'];
            //$params = $this->getDefaultParams();
            //print_r($params);

            //$data['editcommands'] = $qdata['crudcommands'];
            $data['crudname'] = $crudname;
            $data['actionname'] = $actionname;
            if (isset($this->crudData['scriptfile'])){
                try {
                    $text = $this->getTextFile($crudname.'/'.$this->crudData['scriptfile']);
                    $text = $text."\r\n";
                } catch(Exception $e) {

                    $text = '//'.$e->getMessage();
                }
                $data['scriptdata'] = $text;
            }
            //print_r($data['crudgrid']);
            $data['ismodal'] = $this->ismodal;
            if ($this->checkRoles('readonly')){
                $data['readonly'] = 1;
            } else {
                $data['readonly'] = 0;
            }
            $result = $this->load->view('crud/editview', $data, true);
        }
        if ($buffered){
            return $result;
        } else {
            echo $result;
        }
    }
    
    function selectCommandCrud($crudname, $actionname){
        if(isset($this->crudData['defaultparamtype'])){
            $defpartype = $this->crudData['defaultparamtype'];
        } else {
            $defpartype = 'none';
        }

        $defparams = array_merge($this->getDefaultParams($defpartype), $this->defaultParams);
        
        $cmdname = '';
        if (isset($this->crudData['selection']['fieldname'])){
            $fieldname = $this->crudData['selection']['fieldname'];
            if (isset($defparams[$fieldname])){
                $xname = $defparams[$fieldname];
                if (isset($defparams['selection']['commands'][$xname])){
                    $cmdname = $defparams['selection']['commands'][$xname];
                } else {
                    $cmdname = $xname;
                }
            }
        }
        if($cmdname!==''){
            $crudcmd = $crudname.'/'.$cmdname;
            if ($this->checkFileExists($crudcmd)){
                $this->loadCrudFile($crudname, $cmdname);
                $result = $this->getDefaultCrudData();
                return $result;
                //$data = $this->getDefaultCrudData();
            }
        }
        return false;
    }
    
    public function callCommandMethod($crudname, $actionname, $buffered=false){
        $this->loadCrudFile($crudname, $actionname);
        $data = $this->getDefaultCrudData();
        //print_r($_POST);
        //print_r($this->crudData);

        $data['namespace'] = $this->getNameSpace();
        $data['crudtitle'] = $this->getCrudTitle();
        
        $data['crudmessage'] = getArrayDef($this->crudData, 'message', '');
        //$data['crudmessage'] = getArrayDef($this->crudData, 'message', '');
        
        if(isset($this->crudData['defaultparamtype'])){
            $defpartype = $this->crudData['defaultparamtype'];
        } else {
            $defpartype = 'none';
        }

        //echo $defpartype."/////";
        //print_r($this->defaultParams);
        $defparams = array_merge($this->getDefaultParams($defpartype), $this->defaultParams);
        if (isset($this->crudData['execmethod'])){
            $cmdInfo = $this->crudData['execmethod'];
            $objname = $cmdInfo['objectname'];
            $methodname = $cmdInfo['methodname'];
            $params = getArrayDef($cmdInfo, 'params', array());
            $this->load->model($objname, 'mobj');
            $params = array_merge($params, $defparams);
            $this->mobj->cmdOptions = $this->crudData['execmethod'];
            $result = call_user_func_array(array($this->mobj, $methodname),
                array($params));
        }
        //print_r($defparams); die;
        /*if (isset($this->crudData['viewtype']) and $this->crudData['viewtype']=='view'){
            $data['paramdata'] = $defparams;
            $result = $this->load->view($this->crudData['viewname'], $data);
        } else {
            $ctparams = $this->getViewDataParams('crud-edit', $defparams);
            $data['crudparams'] = $ctparams['view'];
            //$params = $this->getDefaultParams();
            //print_r($params);

            //$data['editcommands'] = $qdata['crudcommands'];
            $data['crudname'] = $crudname;
            $data['actionname'] = $actionname;
            if (isset($this->crudData['scriptfile'])){
                try {
                    $text = $this->getTextFile($crudname.'/'.$this->crudData['scriptfile']);
                    $text = $text."\r\n";
                } catch(Exception $e) {

                    $text = '//'.$e->getMessage();
                }
                $data['scriptdata'] = $text;
            }
            //print_r($data['crudgrid']);
            $data['ismodal'] = $this->ismodal;
            if ($this->checkRoles('readonly')){
                $data['readonly'] = 1;
            } else {
                $data['readonly'] = 0;
            }
            $result = $this->load->view('crud/editview', $data, true);
        }
         * 
         */
        
        if ($buffered){
            return $result;
        } else {
            echo $result;
        }
    }
    
    
    public function showRecord($crudname, $actionname){
        $this->loadCrudFile($crudname, $actionname);
        $data = $this->getDefaultRecviewData();
        //print_r($_POST);
        //print_r($this->crudData);

        $data['namespace'] = $this->getNameSpace();
        $data['rectitle'] = $this->getCrudTitle();
        
        $data['recmessage'] = getArrayDef($this->crudData, 'message', '');
        
        $data['options'] = getArrayDef($this->crudData, 'options', array());
        
        if(isset($this->crudData['editlist'])){
            $this->crudData['paramlist'] = $this->crudData['editlist'];
        }
        
        if(isset($this->crudData['defaultparamtype'])){
            $defpartype = $this->crudData['defaultparamtype'];
        } else {
            $defpartype = 'none';
        }
        //echo $defpartype."/////";
        $defparams = $this->getDefaultParams($defpartype);
        if (isset($defparams['crudname'])){
            $defparams['crudname'] = $crudname;
        }
        if (isset($defparams['actionname'])){
            $defparams['actionname'] = $actionname;
        }
        $ctparams = $this->getViewDataParams('crud-record', $defparams);
        $data['recmain'] = $ctparams['view'];
        //$params = $this->getDefaultParams();
        $commands = $this->getViewCommands($defparams);
        $data['reccommands'] = $commands['view'];
        //$data['editcommands'] = $qdata['crudcommands'];
        $data['crudname'] = $crudname;
        $data['actionname'] = $actionname;
        //print_r($data);
        //print_r($data['crudgrid']);
        $result = $this->load->view('crud/recordview', $data, true);
        echo $result;
    }
    
    function isUploadFile(){
        if (isset($this->crudData['paramlist'])) {
            $paramdata = $this->crudData['paramlist'];
        } else {
            $paramdata = array();
        }
        $result = 0;
        //var_dump($paramdata); die;
        foreach($paramdata as $item){
            if(isset($item['ptype'])){
                if ($item['ptype']=='file'){
                    $result = 1;
                    break;
                }
            }
            if (isset($item['xtype'])){
                if ($item['xtype']=='file'){
                    $result = 1;
                    break;
                }
            }
        }        
        return $result;
    }
    
    function getDefaultCrudData(){
        $result = array();
        $result['crudurl'] = $this->getMainUrl('crud');
        $result['mainurl'] = $this->getMainUrl();
        $result['crudtitle'] = '';
        $result['crudparams'] = '';
        $result['crudgrid'] = '<div >grid</div>';
        $result['crudgridinfo'] = '';
        $result['crudpages'] = '<div >pagination</div>';
        $result['crudcommands'] = '<div >commands</div>';
        $result['breadcrumbs'] = '<div >breadcrumbs</div>';
        $result['cmdscripts'] = '<div >cmdscripts</div>';
        return $result;
    }
    
    function getDefaultRecviewData(){
        $result = array();
        $result['crudurl'] = $this->getMainUrl('crud');
        $result['mainurl'] = $this->getMainUrl();
        $result['recmessage'] = '';
        $result['rectitle'] = '';
        $result['recmain'] = '';
        $result['reccommands'] = '';
        $result['recdetails'] = '';
        return $result;
    }
    
    function getCrudTitle(){
        if (isset($this->crudData['title'])){
            $result = $this->crudData['title'];
        } else {
            $result = '';
        }
        return $result;
    }
    
    function getShowSearchButton(){
        if (isset($this->crudData['show_search_btn'])){
            $result = $this->crudData['show_search_btn'];
        } else {
            $result = 1;
        }
        return $result;
    }
    
    function getDefaultParams($defpartype='none'){
        if (isset($this->crudData['paramlist'])){
            $result = array();
            foreach($this->crudData['paramlist'] as $item){
                if (isset($item['name'])){
                    $name = $item['name'];
                    if (isset($item['value'])){
                        $value = $item['value'];
                    } else {
                        $value = '';
                    }
                    $result[$name] = $value;
                }
            }
        } else {
            $result = array();
        }
//        echo $defpartype."---";
//        print_r($result);
//        die;
        if ($defpartype=='post'){
            $result = array_merge($result, $_POST);
        } else if ($defpartype=='get'){
            $result = array_merge($result, $_GET);
        } else if ($defpartype=='query-get'){
            $datasql = $this->getDefaultParamQuery($_GET);
            $result = array_merge($result, $datasql);
        } else if ($defpartype=='query-post'){
            $datasql = $this->getDefaultParamQuery($_POST);
            //print_r($datasql);
            $result = array_merge($result, $datasql);
            //print_r($result);
        } else if ($defpartype=='method-get'){
            $datamethod = $this->getDefaultMethodExec($_GET);
            $result = array_merge($result, $datamethod);
        } else if ($defpartype=='method-post'){
            $datamethod = $this->getDefaultMethodExec($_POST);
            $result = array_merge($result, $datamethod);
        }
        return $result;
    }
    
    function getDefaultParamQuery($params){
        $result = array();
        if (isset($this->crudData['sqldefparam'])){
            //echo "^^^".$this->crudData['sqldefparam'];
            $sql = $this->crudData['sqldefparam'];
            $datasql = $this->mdb->QueryData('application', $sql, $params, 'record');
            if(isset($datasql[0])){
                $result = $datasql[0];
            }
        }
        array_merge($params, $result);
        return $result;
    }
    
    
    function getDefaultMethodExec($xparams){
        $result = array();
        if (isset($this->crudData['methoddefparam'])){
            //echo "^^^".$this->crudData['sqldefparam'];
            $cmdInfo = $this->crudData['methoddefparam'];
            $objname = $cmdInfo['objectname'];
            $methodname = $cmdInfo['methodname'];
            $params = getArrayDef($cmdInfo, 'params', array());
            $this->load->model($objname, 'mobj');
            $params = array_merge($params, $xparams);
            $this->mobj->cmdOptions = $this->crudData['methoddefparam'];
            $result = call_user_func_array(array($this->mobj, $methodname),
                array($params));
        }
        $result = array_merge($xparams, $result);
        return $result;
    }
    
    
    function executeData($command, $params, $files=false){
        $result = array();
        if (isset($this->crudData[$command])){
            //echo "^^^".$this->crudData['sqldefparam'];
            $this->load->model('m_file', 'mfile');
            $sql = $this->crudData[$command];
            if(isset($params['file_id'])){
                foreach($files as &$item){
                    $item['file_id'] = $params['file_id'];
                }
                //$files['file_id'] = $params['file_id'];
            }
            if (isset($params['delete_file_id'])){
                $this->mfile->delete($params['delete_file_id']);
            }
            $fileparams = $this->mfile->saveFiles($files);
            if(isset($this->crudData['fileoptions'])){
                $fileparams = array_merge($fileparams, $this->crudData['fileoptions']);
            }
            $params = array_merge($params, $fileparams);
            //print_r($params); die;
            if (isset($this->crudData['redirect'])) {
                $this->mdb->execSQL('application', $sql, $params);
                $result['islink'] = 1;
                $result['link'] = $this->crudData['redirect']['link'];
            } else if (isset($this->crudData['result'])) {
                $xresult = $this->mdb->QueryData('application', $sql, $params, 'record');
                if (isset($xresult[0])){
                    $xresult = $xresult[0];
                } else {
                    $xresult = array();
                }
                $yresult = array();
                $sparams = '';
                if (isset($this->crudData['result']['linkparams'])){
                    foreach($this->crudData['result']['linkparams'] as $item){
                        if ($sparams!==''){
                            $sparams = $sparams.'&';
                        }
                        $sparams = $sparams.$item.'='.$xresult[$item];
                        $yresult[$item] = $xresult[$item];
                    }
                }
                $result['link'] = $this->crudData['result']['link'];
                if (isset($this->crudData['result']['links'])){
                    $result['links'] = $this->crudData['result']['links'];
                }
                $result['paramdata'] = $yresult;
                $result['params'] = $sparams;
                $result['islink'] = 1;
                //$result['data'] = $xresult;
            } else {
                $this->mdb->execSQL('application', $sql, $params);
            }
            
            if (isset($this->crudData['aftersave'])){
                $cmd = $this->crudData['aftersave'];
                $model = $cmd['model'];
                if (isset($cmd['alias'])){
                    $alias = $cmd['alias'];
                } else {
                    $alias = $model;
                }
                $this->load->model($model, $alias);
                $method = $cmd['method'];
                $this->$alias->$method($params);
            }            
            $result['success']=1;
        } else {
            $result = array('success'=>0, 'error'=>1, 'message'=>'command not found.');
        }
        return $result;
    }
    
    function getDataParams($elclass='', $defparams=array()){
        //$folder = $this->ci->config->item('basefolder').'crud';
        //$filename = $folder.'/'.$crudname;
        
        //$fieldtypes = $this->getJsonFile('fieldtypes', 'list');
        //$cruddata = $this->getJsonFile($crudname);
        if ($elclass===''){
            $ns = $this->getNameSpace();
            $elclass = $ns.'crud-param';
        }
        $fieldtypes = $this->fieldTypes;
        $cruddata = $this->crudData;
        if (isset($cruddata['paramlist'])) {
            $paramdata = $cruddata['paramlist'];
        } else {
            $paramdata = array();
        }
        $result = array();
        foreach($paramdata as $item){
            $xtype = array();
            if (isset($item['ptype'])){
                if (isset($fieldtypes[$item['ptype']])){
                    $xtype = $fieldtypes[$item['ptype']];
                }
            }
            $resitem = array_merge($xtype, $item);
            if (isset($defparams[$item['name']])){
                $resitem['value'] = $defparams[$item['name']];
            }
            if (!isset($resitem['xtype'])){
                $resitem['xtype'] = 'text';
            }
            if (($resitem['xtype']=='lookup') or ($resitem['xtype']=='lookup-disable') 
                or ($resitem['xtype']=='checklistbox')){
                if (isset($resitem['lookupname'])){
                    $lookupname = $resitem['lookupname'];
                    $paramlist = '';
                    if (isset($resitem['lookup-params'])){
                        $params = $resitem['lookup-params'];
                        foreach($params as $pname=>$pval){
                            if($paramlist!==''){
                                $paramlist = $paramlist.',';
                            }
                            $paramlist = $paramlist.$pname;
                            if(isset($defparams[$pname])){
                                $params[$pname] = $defparams[$pname];
                            }
                        }
                    } else {
                        $params = array();
                    }
                    if (isset($resitem['value'])){
                        $value = $resitem['value'];
                    } else {
                        $value = '';
                    }
                    if ($paramlist!==''){
                        $resitem['lookup-paramlist'] = $paramlist;
                    }
                    //$value = 
                    if (($resitem['xtype']=='lookup') or ($resitem['xtype']=='lookup-disable')){
                        $ludata = $this->getViewLookup($lookupname, $params, $value);
                    } else {
                        //print_r($params);
                        $ludata = $this->getViewCheckListBox($lookupname, $params);
                        //print_r($ludata);
                    }
                    $resitem['lookup-data'] = $ludata['view'];
                }
            } else if ($resitem['xtype']=='attachment'){
                $resitem['attachment-data'] = $this->getViewAttachment($resitem, $defparams);
            } else if ($resitem['xtype']=='template'){
                $resitem['template_result'] = $this->getViewTemplate($resitem, $defparams);
            } else if ($resitem['xtype']=='template-single'){
                $resitem['template_result'] = $this->getViewTemplate($resitem, $defparams);
            } else if ($resitem['xtype']=='free-template'){
                $resitem['template_result'] = $this->getViewTemplate($resitem, $defparams);
            }
            if (isset($resitem['class'])){
                $resitem['class'] = $resitem['class'].' '.$elclass;
            } else {
                $resitem['class'] = $elclass;
            }
            
            if(isset($resitem['lookup-refresh'])){
                $resitem['class'] = $resitem['class'].' lookup-refresh';
            }
            array_push($result, $resitem);
        }
        //echo "####";
        //print_r($result);
        return $result;
    }
    
    function getDefaultAtchTemplate(){
        $result = '<div style="margin:4px; padding:0px;">{{{tipe_attachment}}} &nbsp;<a class="btn btn-xs btn-danger" href="{{{base_atch_url}}}/{{{linkid}}}" target="_blank"><i class="fa fa-external-link"></i></a></div>';
        return $result;
    }
    
    function getViewAttachment($item, $defparams){
        $lookupname = $item['lookupname'];
        if (isset($item['lookup-params'])){
            $params = $item['lookup-params'];
            $paramlist = '';
            foreach($params as $pname=>$pval){
                if($paramlist!==''){
                    $paramlist = $paramlist.',';
                }
                $paramlist = $paramlist.$pname;
                if(isset($defparams[$pname])){
                    $params[$pname] = $defparams[$pname];
                }
            }
        } else {
            $params = array();
        }
        //$params = getArrayDef($item, 'lookup-param');
        $data = $this->getDataLookup($lookupname, $params, 'record');
        $urlField = getArrayDef($item, '', '');
        $tpl = $this->getDefaultAtchTemplate();
        $tpl = getArrayDef($item, 'template', $tpl);
        $file_url = 'crud/svfile';
        $file_url = getArrayDef($item, 'file_url', $file_url);
        $result = '';
        foreach($data as $row){
            $row['base_atch_url'] = base_url().index_page().'/'.$file_url;
            $result = $result.$this->mustache($tpl, $row);
            //print_r($tpl);
        }
        //$result = $this->formatAttachment
        //$result = print_r($item, true);
        //$result = print_r($data, true);
//        print_r($data);
//        print_r($result); die;
        return $result;
    }
    
    function formatViewParams($dataparams){
        //return $dataparams;
        $rowgroup = $this->rowGrouping($dataparams);
        $data = array();
        foreach($rowgroup as $itemgroup){
            $xdata = $this->groupingFieldList($itemgroup);
            $data = array_merge($data, $xdata);
        }
        $data = array('arrelements'=>$data);
        
//        $dataparams = $this->groupingFieldList($dataparams);
        //return $dataparams;
        //$data = array('arrelements'=>$dataparams);
        $data['namespace'] = $this->getNameSpace();
        $result = $this->load->view('crud/formelements', $data, true);
        return $result;
    }
    
    function getViewTemplate($item, $defparams){
        if (isset($item['template'])){
            $tpl = $item['template'];
        } else {
            if (isset($item['name'])){
                $tpl = '{{{'.$item['name'].'}}}';
            } else {
                $tpl = '';
            }
        }
        $html = $this->mustache($tpl, $defparams);
        return $html;
    }    
    function rowGrouping($fieldlist){
        $arrGroup = array();
        $arrGroupContent = array();
        foreach($fieldlist as $item){
            if (!isset($item['rowname'])){
                $groupName = 'default';
            } else {
                $groupName = $item['rowname'];
            }
            if (!in_array($groupName, $arrGroup)){
                array_push($arrGroup, $groupName);
                $arrGroupContent[$groupName] = array($item);
            } else {
                array_push($arrGroupContent[$groupName], $item);
            }
        }
        return($arrGroupContent);
    }
    function getGroupDefault(){
        $result = array(
            'group_a' => array('groupname'=>'group_a', 'xtype'=>'column', 'class'=>'col-xs-12 col-md-12 col-lg-12 datapanel'),
            'group_b1' => array('groupname'=>'group_b1', 'xtype'=>'column', 'class'=>'col-sm-6 col-md-6 col-lg-6 datapanel'),
            'group_b2' => array('groupname'=>'group_b2', 'xtype'=>'column', 'class'=>'col-sm-6 col-md-6 col-lg-6 datapanel'),
            'group_c1' => array('groupname'=>'group_c1', 'xtype'=>'column', 'class'=>'col-sm-6 col-md-4 col-lg-4 datapanel'),
            'group_c2' => array('groupname'=>'group_c2', 'xtype'=>'column', 'class'=>'col-sm-6 col-md-4 col-lg-4 datapanel'),
            'group_c3' => array('groupname'=>'group_c3', 'xtype'=>'column', 'class'=>'col-sm-6 col-md-4 col-lg-4 datapanel'),
            'group_d1' => array('groupname'=>'group_d1', 'xtype'=>'column', 'class'=>'col-sm-6 col-md-3 col-lg-3 datapanel'),
            'group_d2' => array('groupname'=>'group_d2', 'xtype'=>'column', 'class'=>'col-sm-6 col-md-3 col-lg-3 datapanel'),
            'group_d3' => array('groupname'=>'group_d3', 'xtype'=>'column', 'class'=>'col-sm-6 col-md-3 col-lg-3 datapanel'),
            'group_d4' => array('groupname'=>'group_d4', 'xtype'=>'column', 'class'=>'col-sm-6 col-md-3 col-lg-3 datapanel'),
            'group_x1_1' => array('groupname'=>'group_x1_1', 'xtype'=>'column', 'class'=>'col-sm-4 col-md-1 col-lg-1 datapanel'),
            'group_x1_2' => array('groupname'=>'group_x1_2', 'xtype'=>'column', 'class'=>'col-sm-4 col-md-1 col-lg-1 datapanel'),
            'group_x1_3' => array('groupname'=>'group_x1_3', 'xtype'=>'column', 'class'=>'col-sm-4 col-md-1 col-lg-1 datapanel'),
            'group_x1_4' => array('groupname'=>'group_x1_4', 'xtype'=>'column', 'class'=>'col-sm-4 col-md-1 col-lg-1 datapanel'),
            'group_x1_5' => array('groupname'=>'group_x1_5', 'xtype'=>'column', 'class'=>'col-sm-4 col-md-1 col-lg-1 datapanel'),
            'group_x1_6' => array('groupname'=>'group_x1_6', 'xtype'=>'column', 'class'=>'col-sm-4 col-md-1 col-lg-1 datapanel'),
            'group_x1_7' => array('groupname'=>'group_x1_7', 'xtype'=>'column', 'class'=>'col-sm-4 col-md-1 col-lg-1 datapanel'),
            'group_x1_8' => array('groupname'=>'group_x1_8', 'xtype'=>'column', 'class'=>'col-sm-4 col-md-1 col-lg-1 datapanel'),
            'group_x1_9' => array('groupname'=>'group_x1_9', 'xtype'=>'column', 'class'=>'col-sm-4 col-md-1 col-lg-1 datapanel'),
            'group_x1_10' => array('groupname'=>'group_x1_10', 'xtype'=>'column', 'class'=>'col-sm-4 col-md-1 col-lg-1 datapanel'),
            'group_x2_1' => array('groupname'=>'group_x2_1', 'xtype'=>'column', 'class'=>'col-sm-6 col-md-2 col-lg-2 datapanel'),
            'group_x2_2' => array('groupname'=>'group_x2_2', 'xtype'=>'column', 'class'=>'col-sm-6 col-md-2 col-lg-2 datapanel'),
            'group_x2_3' => array('groupname'=>'group_x2_3', 'xtype'=>'column', 'class'=>'col-sm-6 col-md-2 col-lg-2 datapanel'),
            'group_x2_4' => array('groupname'=>'group_x2_4', 'xtype'=>'column', 'class'=>'col-sm-6 col-md-2 col-lg-2 datapanel'),
            'group_x2_5' => array('groupname'=>'group_x2_5', 'xtype'=>'column', 'class'=>'col-sm-6 col-md-2 col-lg-2 datapanel'),
            'group_x2_6' => array('groupname'=>'group_x2_6', 'xtype'=>'column', 'class'=>'col-sm-6 col-md-2 col-lg-2 datapanel'),
            'group_x2_7' => array('groupname'=>'group_x2_7', 'xtype'=>'column', 'class'=>'col-sm-6 col-md-2 col-lg-2 datapanel'),
            'group_x2_8' => array('groupname'=>'group_x2_8', 'xtype'=>'column', 'class'=>'col-sm-6 col-md-2 col-lg-2 datapanel'),
            'group_x2_9' => array('groupname'=>'group_x2_9', 'xtype'=>'column', 'class'=>'col-sm-6 col-md-2 col-lg-2 datapanel'),
            'group_x2_10' => array('groupname'=>'group_x2_10', 'xtype'=>'column', 'class'=>'col-sm-6 col-md-2 col-lg-2 datapanel'),
            'group_x3_1' => array('groupname'=>'group_x3_1', 'xtype'=>'column', 'class'=>'col-sm-6 col-md-3 col-lg-3 datapanel'),
            'group_x3_2' => array('groupname'=>'group_x3_2', 'xtype'=>'column', 'class'=>'col-sm-6 col-md-3 col-lg-3 datapanel'),
            'group_x3_3' => array('groupname'=>'group_x3_3', 'xtype'=>'column', 'class'=>'col-sm-6 col-md-3 col-lg-3 datapanel'),
            'group_x3_4' => array('groupname'=>'group_x3_4', 'xtype'=>'column', 'class'=>'col-sm-6 col-md-3 col-lg-3 datapanel'),
            'group_x3_5' => array('groupname'=>'group_x3_5', 'xtype'=>'column', 'class'=>'col-sm-6 col-md-3 col-lg-3 datapanel'),
            'group_x3_6' => array('groupname'=>'group_x3_6', 'xtype'=>'column', 'class'=>'col-sm-6 col-md-3 col-lg-3 datapanel'),
            'group_x4_1' => array('groupname'=>'group_x4_1', 'xtype'=>'column', 'class'=>'col-sm-6 col-md-4 col-lg-4 datapanel'),
            'group_x4_2' => array('groupname'=>'group_x4_2', 'xtype'=>'column', 'class'=>'col-sm-6 col-md-4 col-lg-4 datapanel'),
            'group_x4_3' => array('groupname'=>'group_x4_3', 'xtype'=>'column', 'class'=>'col-sm-6 col-md-4 col-lg-4 datapanel'),
            'group_x4_4' => array('groupname'=>'group_x4_4', 'xtype'=>'column', 'class'=>'col-sm-6 col-md-4 col-lg-4 datapanel'),
            'group_x4_5' => array('groupname'=>'group_x4_5', 'xtype'=>'column', 'class'=>'col-sm-6 col-md-4 col-lg-4 datapanel'),
            'group_x4_6' => array('groupname'=>'group_x4_6', 'xtype'=>'column', 'class'=>'col-sm-6 col-md-4 col-lg-4 datapanel'),
            'group_x4_7' => array('groupname'=>'group_x4_7', 'xtype'=>'column', 'class'=>'col-sm-6 col-md-4 col-lg-4 datapanel'),
            'group_x4_8' => array('groupname'=>'group_x4_8', 'xtype'=>'column', 'class'=>'col-sm-6 col-md-4 col-lg-4 datapanel'),
            'group_x4_9' => array('groupname'=>'group_x4_9', 'xtype'=>'column', 'class'=>'col-sm-6 col-md-4 col-lg-4 datapanel'),
            'group_x5_1' => array('groupname'=>'group_x5_1', 'xtype'=>'column', 'class'=>'col-sm-6 col-md-5 col-lg-5 datapanel'),
            'group_x5_2' => array('groupname'=>'group_x5_2', 'xtype'=>'column', 'class'=>'col-sm-6 col-md-5 col-lg-5 datapanel'),
            'group_x5_3' => array('groupname'=>'group_x5_3', 'xtype'=>'column', 'class'=>'col-sm-6 col-md-5 col-lg-5 datapanel'),
            'group_x5_4' => array('groupname'=>'group_x5_4', 'xtype'=>'column', 'class'=>'col-sm-6 col-md-5 col-lg-5 datapanel'),
            'group_x5_5' => array('groupname'=>'group_x5_5', 'xtype'=>'column', 'class'=>'col-sm-6 col-md-5 col-lg-5 datapanel'),
            'group_x5_6' => array('groupname'=>'group_x5_6', 'xtype'=>'column', 'class'=>'col-sm-6 col-md-5 col-lg-5 datapanel'),
            'group_x6_1' => array('groupname'=>'group_x6_1', 'xtype'=>'column', 'class'=>'col-sm-12 col-md-6 col-lg-6 datapanel'),
            'group_x6_2' => array('groupname'=>'group_x6_2', 'xtype'=>'column', 'class'=>'col-sm-12 col-md-6 col-lg-6 datapanel'),
            'group_x6_3' => array('groupname'=>'group_x6_3', 'xtype'=>'column', 'class'=>'col-sm-12 col-md-6 col-lg-6 datapanel'),
            'group_x6_4' => array('groupname'=>'group_x6_4', 'xtype'=>'column', 'class'=>'col-sm-12 col-md-6 col-lg-6 datapanel'),
            'group_x7_1' => array('groupname'=>'group_x7_1', 'xtype'=>'column', 'class'=>'col-sm-12 col-md-7 col-lg-7 datapanel'),
            'group_x7_2' => array('groupname'=>'group_x7_2', 'xtype'=>'column', 'class'=>'col-sm-12 col-md-7 col-lg-7 datapanel'),
            'group_x7_3' => array('groupname'=>'group_x7_3', 'xtype'=>'column', 'class'=>'col-sm-12 col-md-7 col-lg-7 datapanel'),
            'group_x7_4' => array('groupname'=>'group_x7_4', 'xtype'=>'column', 'class'=>'col-sm-12 col-md-7 col-lg-7 datapanel'),
            'group_x8_1' => array('groupname'=>'group_x8_1', 'xtype'=>'column', 'class'=>'col-sm-12 col-md-8 col-lg-8 datapanel'),
            'group_x8_2' => array('groupname'=>'group_x8_2', 'xtype'=>'column', 'class'=>'col-sm-12 col-md-8 col-lg-8 datapanel'),
            'group_x8_3' => array('groupname'=>'group_x8_3', 'xtype'=>'column', 'class'=>'col-sm-12 col-md-8 col-lg-8 datapanel'),
            'group_x8_4' => array('groupname'=>'group_x8_4', 'xtype'=>'column', 'class'=>'col-sm-12 col-md-8 col-lg-8 datapanel'),
            'group_x9_1' => array('groupname'=>'group_x9_1', 'xtype'=>'column', 'class'=>'col-sm-12 col-md-9 col-lg-9 datapanel'),
            'group_x9_2' => array('groupname'=>'group_x9_2', 'xtype'=>'column', 'class'=>'col-sm-12 col-md-9 col-lg-9 datapanel'),
            'group_x9_3' => array('groupname'=>'group_x9_3', 'xtype'=>'column', 'class'=>'col-sm-12 col-md-9 col-lg-9 datapanel'),
            'group_x9_4' => array('groupname'=>'group_x9_4', 'xtype'=>'column', 'class'=>'col-sm-12 col-md-9 col-lg-9 datapanel'),
            'group_x10_1' => array('groupname'=>'group_x10_1', 'xtype'=>'column', 'class'=>'col-sm-12 col-md-10 col-lg-10 datapanel'),
            'group_x10_2' => array('groupname'=>'group_x10_2', 'xtype'=>'column', 'class'=>'col-sm-12 col-md-10 col-lg-10 datapanel'),
            'group_x10_3' => array('groupname'=>'group_x10_3', 'xtype'=>'column', 'class'=>'col-sm-12 col-md-10 col-lg-10 datapanel'),
            'group_x10_4' => array('groupname'=>'group_x10_4', 'xtype'=>'column', 'class'=>'col-sm-12 col-md-10 col-lg-10 datapanel'),
            'group_x11_1' => array('groupname'=>'group_x11_1', 'xtype'=>'column', 'class'=>'col-sm-12 col-md-11 col-lg-11 datapanel'),
            'group_x11_2' => array('groupname'=>'group_x11_2', 'xtype'=>'column', 'class'=>'col-sm-12 col-md-11 col-lg-11 datapanel'),
            'group_x11_3' => array('groupname'=>'group_x11_3', 'xtype'=>'column', 'class'=>'col-sm-12 col-md-11 col-lg-11 datapanel'),
            'group_x11_4' => array('groupname'=>'group_x11_4', 'xtype'=>'column', 'class'=>'col-sm-12 col-md-11 col-lg-11 datapanel'),
            'group_x12_1' => array('groupname'=>'group_x12_1', 'xtype'=>'column', 'class'=>'col-sm-12 col-md-12 col-lg-12 datapanel'),
            'group_x12_2' => array('groupname'=>'group_x12_2', 'xtype'=>'column', 'class'=>'col-sm-12 col-md-12 col-lg-12 datapanel'),
            'group_x12_3' => array('groupname'=>'group_x12_3', 'xtype'=>'column', 'class'=>'col-sm-12 col-md-12 col-lg-12 datapanel'),
            'group_x12_4' => array('groupname'=>'group_x12_4', 'xtype'=>'column', 'class'=>'col-sm-12 col-md-12 col-lg-12 datapanel'),
        );
        
        return $result;
    }
    
    function getGroupInfo($groupName){
        $groupDefault = array('groupname'=>$groupName, 'xtype'=>'column', 'class'=>'col-sm-6 col-md-4 col-lg-4');
        if (isset($this->crudData['grouplist'][$groupName])){
            $result = $this->crudData['grouplist'][$groupName];
        } else {
            $result = array();
        }
        $result = array_merge($groupDefault, $result);
        return $result;
    }
    
    function groupingFieldList($fieldlist){
        //print_r($fieldlist);

        $arrGroup = array();
        $arrGroupContent = array();
        $arrGroupInfo = array();
        foreach($fieldlist as $item){
            if (!isset($item['groupname'])){
                $groupName = 'default';
            } else {
                $groupName = $item['groupname'];
            }
            if (!in_array($groupName, $arrGroup)){
                array_push($arrGroup, $groupName);
                $arrGroupContent[$groupName] = array($item);
                $arrGroupInfo[$groupName] = $this->getGroupInfo($groupName);
            } else {
                array_push($arrGroupContent[$groupName], $item);
            }
        }
        
        $result = array();
        array_push($result, array('xtype'=>'row'));
        foreach($arrGroup as $item){
            $groupInfo = $arrGroupInfo[$item];
            $groupContent = $arrGroupContent[$item];
            array_push($result, $groupInfo);
            foreach($groupContent as $gitem){
                array_push($result, $gitem);
            }
            array_push($result, array('xtype'=>'/column'));
        }
        array_push($result, array('xtype'=>'/row'));
        //print_r($result);
        return $result;
    }
    
    function getViewDataParams($elparams='', $defparams=array()){
        $data = $this->getDataParams($elparams, $defparams);
        $view = $this->formatViewParams($data);
        $result = array('view'=>$view);
        return $result;
    }
    
    function getDataLookup($lookupname, $params, $restype='matrix'){
        $config = $this->getJsonFile('lookup/'.$lookupname, 'lookup');
        if (!isset($config['lookuptype'])){
            $lookuptype = 'database';
        } else {
            $lookuptype = $config['lookuptype'];
        }
        if ($lookuptype=='static'){
            $result = $config['lookupdata'];
        } else if ($lookuptype=='database'){
            $sql = $config['sql'];
            $result = $this->mdb->QueryData('application', $sql, $params, $restype);
            if ($restype=='matrix'){
                $result = $result['matrixdata'];
            } else {
                //$result = $result['data'];
            }
            //$result = array();
        } else {
            $result = array();
        }
        //$vsql = $config['sql'];
        //$qresult = $this->mdb->QueryData('application', $vsql, $params, 'record');
        return $result;
        
    }
    
    function formatViewLookup($datalookup, $defvalue=''){
        $result = '';
        foreach($datalookup as $item){
            $resitem = '';
            $kode = '';
            $value = '';
            if (isset($item[0])){
                $kode = $item[0];
            }
            if (isset($item[1])){
                $value = $item[1];
            }
            if ($item[0]==$defvalue){
                $selected = 'selected';
            } else {
                $selected = '';
            }
            $resitem = '<option value="'.$kode.'" '.$selected.' >'.$value.'</option>';
            $result = $result."/r/n".$resitem;
        }
        return $result;
    }
    
    function getViewLookup($lookupname, $params, $curvalue){
        $data = $this->getDataLookup($lookupname, $params);
        $view = $this->formatViewLookup($data, $curvalue);
        $result = array('view'=>$view);
        return $result;
    }
    
    function getDataGrid($params){
        $sql = $this->crudData['sql'];
        if (isset($params['pagerec'])){
            $pagerec = $params['pagerec']+0;
        } else {
            $pagerec = 0;
        }
        if (isset($params['pagenum'])){
            $pagenum = $params['pagenum']+0;
        } else {
            $pagenum = 0;
        }
        
        if (isset($this->crudData['sqlcount'])){
            $sqlcount = $this->crudData['sqlcount'];
        } else {
            $sqlcount = 'select count(*) from ( '.$sql.') x';
        }
        
        $datasql = $this->mdb->QueryData('application', $sql, $params, 'record');
        $datacount = $this->mdb->QueryData('application', $sqlcount, $params, 'matrix');
        //print_r($datacount);
        if(isset($datacount['matrixdata'][0][0])){
            $qcount = $datacount['matrixdata'][0][0];
        } else {
            $qcount = 0;
        }
        
        //print_r($this->crudData['fieldlist']);
        $actualcount = count($datasql);
        $datastart = ($pagenum-1)*$pagerec+1;
        $dataend = $datastart+$actualcount-1;
        $gridinfo = "Show $datastart to $dataend of $qcount records";
        //$pagination = $this->calcPagination($pagerec, $pagenum, $qcount);
        $result = array('data'=>$datasql, 'count'=>$qcount, 'pagerec'=>$pagerec, 'pagenum'=>$pagenum,
            'actualcount'=>$actualcount, 'gridinfo'=>$gridinfo);
        
        return $result;
    }
    
    function xformatViewGrid($datagrid){
        if (isset($this->crudData['rowactions'])){
            $rowactposition = getArrayDef($this->crudData['rowactions'], 'position', 'right');
            $tdoptions = getArrayDef($this->crudData['rowactions'], 'tdoptions', '');
        } else {
            $rowactposition = 'none';
        }
        $data = array('rowactposition'=>$rowactposition, 'tdoptions'=>$tdoptions, 
            'cruddata'=>$this->crudData,
            'datagrid'=>$datagrid);
        $data['namespace'] = $this->getNameSpace();
        $result = $this->load->view('gridview', $data, true);
    }
    
    function getConditionField($row, $field, $value){
        if (isset($field['valuelist'][$value])){
            $result = $field['valuelist'][$value];
        } else if (isset($field['valuelist']['other'])){
            $result = $field['valuelist']['other'];
        } else {
            $result = $value;
        }
        return $result;
    }
    
    public function mustache($template, $data){
        $cmds = array('human_time'=>function($value, Mustache_LambdaHelper $helper) {
            $thetime = ($helper->render($value));
            return $this->humanTime(trim($thetime));
        });
        
        $data['human_time'] = $cmds['human_time'];
        if ($this->mustache_loaded===false){
            $mconfig = array('escape'=>array('M_crud'=>'Process'));
            $this->load->library('mustache');
            $this->mustache_loaded = true;
        }
        $text = $this->mustache->render($template, $data);
        return $text;
    }
    

    function getTemplatedField($row, $field, $value){
        $data = $row;
        if (isset($field['template'])){
            $result = $this->mustache($field['template'], $row);
        } else {
            $result = $value;
        }
        return $result;
    }
    
    function humanTiming ($time)
    {

        $time = time() - $time; // to get the time since that moment

        $tokens = array (
            31536000 => 'year',
            2592000 => 'month',
            604800 => 'week',
            86400 => 'day',
            3600 => 'hour',
            60 => 'minute',
            1 => 'second'
        );

        foreach ($tokens as $unit => $text) {
            if ($time < $unit) continue;
            $numberOfUnits = floor($time / $unit);
            return $numberOfUnits.' '.$text.(($numberOfUnits>1)?'s':'');
        }

    }

    function humanTime($value){
        //$value = '2014-12-04 21:13:20';
        //print_r($value); die;
        //$time = time() - strtotime($value); // to get the time since that moment
        $time = time() - strtotime($value); // to get the time since that moment

        $tokens = array (
            31536000 => 'year',
            2592000 => 'month',
            604800 => 'week',
            86400 => 'day',
            3600 => 'hour',
            60 => 'minute',
            1 => 'second'
        );

        foreach ($tokens as $unit => $text) {
            if ($time < $unit) continue;
            if ($unit>=604800){
                if ($unit<31536000){
                    $result = date('j M', strtotime($value));
                } else {
                    $result = date('j M Y', strtotime($value));
                }
            } else {
                $numberOfUnits = floor($time / $unit);
                $result = $numberOfUnits.' '.$text.(($numberOfUnits>1)?'s':'');
            }
            return $result;
        }
    }
    
    function getHumanTime($row, $field, $value){
        return $this->humanTime($value);
    }
    
    function formatViewGrid($datagrid){
        if (isset($this->crudData['rowactions'])){
            $rowactposition = getArrayDef($this->crudData['rowactions'], 'position', 'right');
            $tdoptions = getArrayDef($this->crudData['rowactions'], 'tdoptions', '');
        } else {
            $rowactposition = 'none';
        }
        //print_r($rowactposition);
        //print_r($datagrid);
        $result = '';
        $namespace = $this->getNameSpace();
        $result = $result.'<script>'."\r\n";
        //$result = $result.'var gridData = '.json_encode($datagrid['data']).";\r\n";
        $result = $result.'var '.$namespace.'gridData = '.json_encode($datagrid['data']).";\r\n";
        $result = $result.'</script>'."\r\n";
        
        $result = $result.'<table id="sample-table-1" class="table table-striped table-bordered table-hover">';
        $result = $result."\r\n".'<thead>';
        $result = $result."\r\n".'<tr>';
        if ($rowactposition=='left'){
            $result = $result."\r\n".'<td>'.getArrayDef($this->crudData['rowactions'], 'caption', 'Actions').'</td>';
        }
        foreach($this->crudData['fieldlist'] as $field){
            //$value = $field['name'];
            $value = getArrayDef($field, 'caption', getArrayDef($field, 'name', ''));
            //echo $value.":";
            if (isset($field['width'])){
                $strwidth = 'width="'.$field['width'].'"';
            } else {
                $strwidth = '';
            }
            $result = $result."\r\n".'<td '.$strwidth.'>'.$value.'</td>';
        }
        if ($rowactposition=='right'){
            $result = $result."\r\n".'<td>'.getArrayDef($this->crudData['rowactions'], 'caption', 'Actions').'</td>';
        }
        $result = $result."\r\n".'</tr>';
        $result = $result."\r\n".'</thead>';
        $result = $result."\r\n".'<tbody>';
        //print_r($datagrid['data']);
        $idx = 0;
        foreach($datagrid['data'] as $row){
            //echo "******\r\n";
            //print_r($row);
            //echo "******\r\n";
            $result = $result."\r\n".'<tr'.' data-index="'.$idx.'"'.'>';
            if ($rowactposition=='left'){
                $rowaction = $this->getViewRowActions($row);
                $result = $result."\r\n".'<td '.$tdoptions.'>'.$rowaction.'</td>';
            }
            foreach($this->crudData['fieldlist'] as $field){
                //$value = $field['name'];
                $value = getArrayDef($row, $field['name'], '');
                //echo $value.":";
                //print_r(getArrayDef($field, 'btype', 'text'));
                if (getArrayDef($field, 'btype', 'text')=='color') {
                    $xvalue = '<span class="label label-sm" style="background: #'.$value.'!important">'.
                        '&nbsp;&nbsp;&nbsp;&nbsp;</span>';
                    $xvalue = $xvalue.'&nbsp;'.$value;
                    $result = $result."\r\n".'<td>'.$xvalue.'</td>';
                } else if (getArrayDef($field, 'btype', 'text')=='condition') {
                    $xvalue = $this->getConditionField($row, $field, $value);
                    $result = $result."\r\n".'<td>'.$xvalue.'</td>';
                } else if (getArrayDef($field, 'btype', 'text')=='template') {
                    $xvalue = $this->getTemplatedField($row, $field, $value);
                    $result = $result."\r\n".'<td>'.$xvalue.'</td>';
                } else if (getArrayDef($field, 'btype', 'text')=='humantime') {
                    $xvalue = $this->getHumanTime($row, $field, $value);
                    $result = $result."\r\n".'<td>'.$xvalue.'</td>';
                } else {
                    $result = $result."\r\n".'<td>'.$value.'</td>';
                }
            }
            if ($rowactposition=='right'){
                $rowaction = $this->getViewRowActions($row);
                $result = $result."\r\n".'<td '.$tdoptions.'>'.$rowaction.'</td>';
            }
            $result = $result."\r\n".'</tr>';
            $idx = $idx+1;
        }
        
        $result = $result."\r\n".'</tbody>';
        $result = $result."\r\n".'</table>';
        return $result;
        //$result = array();
        //$result['count'] = $datagrid['count'];
        //$result['view'] = json_encode($datagrid['data']);
        //return json_encode($datagrid);
    }
    
    function getViewRowActions($row){
        $data = $this->getRowActions($row);
        $result = $this->formatRowActions($data);
        return $result;
    }
    
    function getRowCondition($condition, $data){
        if (($condition['type']=='equal') or ($condition['type']=='notequal')){
            //print_r($data);
            $field = $condition['field'];
            if (isset($condition['fieldref'])){
                $xfield = $condition['fieldref'];
                $value = $data[$xfield];
            } else {
                $value = $condition['value'];
            }
            if ($condition['type']=='equal'){
                if ($data[$field]==$value){
                    return 1;
                }
            } else {
                if ($data[$field]!=$value){
                    return 1;
                }
            }
        } else {
            return 1;
        }
        return 0;
    }
    
    function getRowActions($row){
        //print_r($row);
        $result = array();
        if (isset($this->crudData['rowactions']['list'])) {
            foreach($this->crudData['rowactions']['list'] as $action){
                if (isset($action['params'])){
                    $vparam = '';
                    foreach($action['params'] as $pitem){
                        $vparam=$vparam.'/';
                        $vparam = $vparam.$row[$pitem];
                    }
                    $action['target'] = $action['target'].$vparam;
                }
                $type = $action['type'];
                if (isset($action['condition'])){
                    $action['visible'] = $this->getRowCondition($action['condition'], $row);
                }
                if (isset($this->actionTypes[$type])){
                    $xaction = array_merge($this->actionTypes[$type], $action);
                } else {
                    $xaction = $action;
                }
//                print_r($xaction);
                
                if (isset($xaction['items'])){
                    $xvisible = FALSE;
                    foreach($xaction['items'] as &$xitem){
                        if (isset($xitem['condition'])){
                            $vcond = $this->getRowCondition($xitem['condition'], $row);
                            if (!$vcond){
                                $xitem['xtype'] = 'disable';
                            } else {
                                $xvisible = TRUE;
                            }
                        } else {
                            $xvisible = TRUE;
                        }
                    }
                    if (!$xvisible){
                        //$xaction['visible'] = 0;
                        $xaction['class'] = $xaction['class'].' disabled';
                    }
                }
                array_push($result, $xaction);
            }
        }
//        die;
//        print_r($result); die;
        return $result;
    }
    
    function formatRowActions($rowactions){
        $data = array('rowactions'=>$rowactions);
        $data['mainurl'] = $this->getMainUrl();
        $data['namespace'] = $this->getNameSpace();
        $result = $this->load->view('crud/rowactions', $data, true);
        return $result;
    }
    
    function getViewDataGrid($params){
        if (!isset($this->crudData['sql'])){
            $result = array('count'=>'', 'view'=>'', 'gridinfo'=>'', 
                'pagination'=>'', 'crudcommands'=>'', 'breadcrumbs'=>'', 'cmdscripts'=>'');
        } else {
            $data = $this->getDataGrid($params);
            $view = $this->formatViewGrid($data);
            $count = $data['count'];
            $pagenum = $data['pagenum'];
            //$pagenum = 16;
            //$count = 2219;
            $pagelist = $this->calcPagination($data['pagerec'], $pagenum, $count);
            //print_r($pagelist);
            $pagination = $this->formatViewPagination($pagelist);
            $commands = $this->getViewCommands($params);
            $cmdscripts = $this->getViewCmdScripts();
            $result = array('count'=>$data['count'], 'view'=>$view, 'gridinfo'=>$data['gridinfo'], 
                'pagination'=>$pagination, 'crudcommands'=>$commands['view'], 'breadcrumbs'=>$commands['breadcrumb'], 'cmdscripts'=>$cmdscripts['view']);
        }
        return $result;
    }
    
    function calcPagination($pagerec, $pagenum, $count){
        //echo $count;
        $edgecount = 1;
        $centercount = 1;
        $total = $edgecount*2+$centercount*2+3;
        $half = round(($total+1)/2);
        if ($pagerec==0){
            $pnum=1;
        } else {
            $pnum = floor($count/$pagerec);
            $pmod = $count % $pagerec;
            if ($pmod>0){
                $pnum = $pnum+1;
            }
        }
        if (($pagenum == 1) or ($pnum==0)){
            $result = array(array('name'=>'prev', 'caption'=>'', 'type'=>'start', 
                'class'=>'disabled page-disabled', 'icon'=>'icon-double-angle-left', 'data-page'=>0));
        } else {
            $result = array(array('name'=>'prev', 'caption'=>'', 'type'=>'start', 'class'=>'pagebutton',
                'icon'=>'icon-double-angle-left', 'data-page'=>$pagenum-1));
        }
        //echo $pagenum;
        //echo $pnum;
        if ($pnum<=11){
            for ($i=1; $i<=$pnum; $i++){
                $resitem = array('name'=>'pg_'.$i, 'caption'=>$i.'', 'type'=>'number', 'data-page'=>$i);
                if ($i==$pagenum){
                    $resitem['class'] = 'pagebutton active';
                } else {
                    $resitem['class'] = 'pagebutton';
                }
                array_push($result, $resitem);
            }
        } else {
            if ($pagenum<=$half){
                for ($i=1; $i<=$half+2; $i++){
                    $resitem = array('name'=>'pg_'.$i, 'type'=>'number', 'caption'=>$i.'', 'data-page'=>$i);
                    if ($i==$pagenum){
                        $resitem['class'] = 'pagebutton active';
                    } else {
                        $resitem['class'] = 'pagebutton';
                    }
                    array_push($result, $resitem);
                }
                $resitem = array('name'=>'xx1', 'caption'=>'...', 'type'=>'dots', 'class'=>'disabled');
                array_push($result, $resitem);
                for ($i=$pnum-$edgecount+1; $i<=$pnum; $i++){
                    $resitem = array('name'=>'pg_'.$i, 'type'=>'number', 'caption'=>$i.'', 'data-page'=>$i, 'class'=>'pagebutton');
                    array_push($result, $resitem);
                }
            } else if ($pagenum>=($pnum-$half+1)){
                for ($i=1; $i<=$edgecount; $i++){
                    $resitem = array('name'=>'pg_'.$i, 'type'=>'number', 'caption'=>$i.'');
                    array_push($result, $resitem);
                }
                $resitem = array('name'=>'xx2', 'caption'=>'...', 'type'=>'dots', 'class'=>'disabled', );
                array_push($result, $resitem);
                for ($i=$pnum-$half-1; $i<=$pnum; $i++){
                    $resitem = array('name'=>'pg_'.$i, 'type'=>'number', 'caption'=>$i.'', 'data-page'=>$i, 'class'=>'pagebutton');
                    if ($i==$pagenum){
                        $resitem['class'] = 'active';
                    } else {
                        $resitem['class'] = 'pagebutton';
                    }
                    array_push($result, $resitem);
                }
            } else {
                for ($i=1; $i<=$edgecount; $i++){
                    $resitem = array('name'=>'pg_'.$i, 'type'=>'number', 'caption'=>$i.'', 'data-page'=>$i, 'class'=>'pagebutton');
                    array_push($result, $resitem);
                }
                $resitem = array('name'=>'xx2', 'caption'=>'...', 'type'=>'dots', 'class'=>'disabled');
                array_push($result, $resitem);
                for ($i=$pagenum-$centercount; $i<=$pagenum+$centercount; $i++){
                    $resitem = array('name'=>'pg_'.$i, 'type'=>'number', 'caption'=>$i.'', 'data-page'=>$i, 'class'=>'pagebutton');
                    if ($i==$pagenum){
                        $resitem['class'] = 'pagebutton active';
                    } else {
                        $resitem['class'] = 'pagebutton';
                    }
                    array_push($result, $resitem);
                }
                $resitem = array('name'=>'xx2', 'caption'=>'...', 'type'=>'dots', 'class'=>'disabled');
                array_push($result, $resitem);
                for ($i=$pnum-$edgecount+1; $i<=$pnum; $i++){
                    $resitem = array('name'=>'pg_'.$i, 'type'=>'number', 'caption'=>$i.'', 'data-page'=>$i, 'class'=>'pagebutton');
                    array_push($result, $resitem);
                }
            }
            
        }
        
        if (($pagenum == $pnum) or ($pnum==0)){
            array_push($result, array('name'=>'next', 'caption'=>'', 'type'=>'end', 
                'class'=>'disabled page-disabled', 'icon'=>'icon-double-angle-right', 'data-page'=>0));
        } else {
            array_push($result, array('name'=>'next', 'caption'=>'', 'type'=>'end', 'class'=>'pagebutton',
                'icon'=>'icon-double-angle-right', 'data-page'=>$pagenum+1));
        }
        
        return $result;
        /*
        if ($pnum<=10){
            for ($i=1; $i<=$pnum; $i++){
                array_push($result, $i);
            }
        } else {
            for ($i=1; $i<=7; $i++){
                array_push($result, $i);
            }
            array_push($result, '...');
            for ($i=$pnum-2; $i<=$pnum; $i++){
                array_push($result, $i);
            }
        }
         * 
         */
        //array_push($result, 'end');
        //return $result;
    }
    
    function formatViewPagination($pagelist){
        //print_r($pagelist);
        
        $data = array('pagebuttons'=>$pagelist);
        $data['crudurl'] = $this->getMainUrl('crud');
        $data['crudname'] = $this->crudName;
        $data['actionname'] = $this->actionName;
        $data['namespace'] = $this->getNameSpace();
        $result = $this->load->view('crud/pagination', $data, true);
        return $result;
        /*$result = '<ul class="pagination">';
        foreach($pagelist as $page){
            //echo "****"; print_r($page);
            //$class = $page['class'];
            //icon-double-angle-left
            $resitem = '<li '.(isset($page['class']) ? 'class="'.$page['class'].'"' : '').'>'.
                '<button class = "btn" href="#">'.
                ((isset($page['icon'])) ? '<i class="'.$page['icon'].'"></i>' : '').
                ((isset($page['caption'])) ? $page['caption'] : 'x').
                '</button>'.
                '</li>';
            $result = $result."\r\n".$resitem;
        }
        $result = $result."\r\n</ul>";
        return $result;
        */
    }
    
    function getViewPagination($crudname, $params){
        $data = $this->getDataPagination($crudname, $params);
        $view = $this->formatViewPagination($data);
        $result = array('view'=>$view);
        return $result;
    }
    
    function getDataBreadcrumbs(){
        $result = array();
        if (isset($this->crudData['breadcrumbs'])) {
            foreach($this->crudData['breadcrumbs'] as $action){
                //print_r($action);
                $type = $action['type'];
                
                if (isset($this->actionTypes[$type])){
                    $xaction = array_merge($this->actionTypes[$type], $action);
                } else {
                    $xaction = $action;
                }
                if (isset($xaction['target'])){
                    if ($xaction['target']=='#referrer'){
                        $xaction['target'] = $this->agent->referrer();
                    } else if ($xaction['target']=='#varpost'){
                        if (isset($_POST['linkback'])){
                            $xaction['target'] = $_POST['linkback'];
                        } else {
                            $xaction['target'] = '#';
                        }
                    } else if ($xaction['target']=='#varget'){
                        if (isset($_GET['linkback'])){
                            $xaction['target'] = $_GET['linkback'];
                        } else {
                            $xaction['target'] = '#';
                        }
                    }
                }
                array_push($result, $xaction);
            }
        }
        return $result;
    }
    
    function getDataCommands($params=array()){
        $result = array();
        if (isset($this->crudData['actions'])) {
            foreach($this->crudData['actions'] as $action){
                //print_r($action);
                $type = $action['type'];
                
                if (isset($this->actionTypes[$type])){
                    $xaction = array_merge($this->actionTypes[$type], $action);
                } else {
                    $xaction = $action;
                }
                if (isset($xaction['target'])){
                    if ($xaction['target']=='#referrer'){
                        $xaction['target'] = $this->agent->referrer();
                    } else if ($xaction['target']=='#varpost'){
                        if (isset($_POST['linkback'])){
                            $xaction['target'] = $_POST['linkback'];
                        } else {
                            $xaction['target'] = '#';
                        }
                    } else if ($xaction['target']=='#varget'){
                        if (isset($_GET['linkback'])){
                            $xaction['target'] = $_GET['linkback'];
                        } else {
                            $xaction['target'] = '#';
                        }
                    }
                }
                if (isset($action['condition'])){
                    $check = $this->getRowCondition($action['condition'], $params);
                    if(!$check){
                        $xaction['xtype'] = 'inactive';
                    }
                }
                array_push($result, $xaction);
            }
        }
        return $result;
    }
    
    function getSubmitCommands(){
        $result = array();
        if (isset($this->crudData['submitactions']['list'])) {
            foreach($this->crudData['submitactions']['list'] as $action){
                //print_r($action);
                $type = $action['type'];
                
                if (isset($this->actionTypes[$type])){
                    $xaction = array_merge($this->actionTypes[$type], $action);
                } else {
                    $xaction = $action;
                }
                if (isset($xaction['target'])){
                    if ($xaction['target']=='#referrer'){
                        $xaction['target'] = $this->agent->referrer();
                    } else if ($xaction['target']=='#varpost'){
                        if (isset($_POST['linkback'])){
                            $xaction['target'] = $_POST['linkback'];
                        } else {
                            $xaction['target'] = '#';
                        }
                    } else if ($xaction['target']=='#varget'){
                        if (isset($_GET['linkback'])){
                            $xaction['target'] = $_GET['linkback'];
                        } else {
                            $xaction['target'] = '#';
                        }
                    }
                }
                array_push($result, $xaction);
            }
        }
        return $result;
    }
    
    function formatViewCommands($actions){
        $data = array('actions'=>$actions);
        $data['crudurl'] = $this->getMainUrl('crud');
        $data['mainurl'] = $this->getMainUrl();
        $data['crudname'] = $this->crudName;
        $data['actionname'] = $this->actionName;
        $data['namespace'] = $this->getNameSpace();
        $result = $this->load->view('crud/actions', $data, true);
        return $result;
    }
    
    function formatViewCmdScripts($actions){
        $data = array('actions'=>$actions);
        $data['crudurl'] = $this->getMainUrl('crud');
        $data['mainurl'] = $this->getMainUrl();
        $data['crudname'] = $this->crudName;
        $data['actionname'] = $this->actionName;
        $data['namespace'] = $this->getNameSpace();
        $result = $this->load->view('crud/cmdscripts', $data, true);
        return $result;
    }
    
    function getViewCommands($params=array()){
        $data = $this->getDataCommands($params);
        $crumb = $this->getDataBreadcrumbs();
        $view = $this->formatViewCommands($data);
        $breadcrumb = $this->formatViewCommands($crumb);
        $result = array('view'=>$view,'breadcrumb'=>$breadcrumb);
        return $result;
    }
    
    function getViewCmdScripts(){
        $data = array();//$this->getDataCmdScripts();
        $view = $this->formatViewCmdScripts($data);
        $result = array('view'=>$view);
        return $result;
    }
    
    function getJsonFile($crudname, $type=''){
        if ($type==''){
            $type = 'query';
        }
        $basefolder = $this->ci->config->item('basefolder').'crud/';
        $filename = $basefolder.$crudname.".".$type;
        $json_data = file_get_contents($filename);
        return json_decode($json_data, true);
    }
    
    function checkFileExists($crudname, $type=''){
        if ($type==''){
            $type = 'query';
        }
        $basefolder = $this->ci->config->item('basefolder').'crud/';
        $filename = $basefolder.$crudname.".".$type;
        if (file_exists($filename)){
            return 1;
        }
        return 0;
    }
    
    function getTextFile($crudname, $type=''){
        if ($type==''){
            $type = 'js';
        }
        $basefolder = $this->ci->config->item('basefolder').'crud/';
        $filename = $basefolder.$crudname.".".$type;
        $text_data = file_get_contents($filename);
        return $text_data;
    }
    
    function getParamsFromSQL($vsql){
        $tokens = preg_split('/[^a-zA-Z0-9\':_"]+/', $vsql);
        $temporaryArray = array();
        foreach($tokens as $token){
            if (substr($token, 0, 1)==':'){
                $paramname = strtolower(substr($token, 1));
                if (!in_array($paramname, $temporaryArray)){
                    array_push($temporaryArray, $paramname);
                }
                //$temporarySQL = str_replace($token, "?", $temporarySQL);
            }
        }
        $result = array();
        foreach($temporaryArray as $aritem){
            $result[$aritem] = '';
        }
        return $result;
    }
    
    function getDefaultSQLParams(){
        //print_r($this->crudData);
        if (isset($this->crudData['sql'])){
            $sql = $this->crudData['sql'];
            $xparams = array();
            //$xparams = $this->getParamsFromSQL($sql);        
            if (isset($xparams['pagerec'])){
                $xparams['pagerec'] = 10;
            }
            if (isset($xparams['pagenum'])){
                $xparams['pagenum'] = 10;
            }

            return $xparams;
        } else {
            return array();
        }
    }
    
    function getViewCheckListBox($dataname, $dataparams){
        $datacbox = $this->getDataCheckListBox($dataname, $dataparams);
        if (isset($dataparams['colcount'])){
            $colcount = $dataparams['colcount'];
        } else {
            $colcount = 4;
        }
        if (isset($dataparams['fieldcount'])){
            $fieldcount = $dataparams['fieldcount'];
        } else {
            $fieldcount = 0;
        }
        $view = $this->formatCheckListBox($datacbox, $colcount, $fieldcount);
        $result = array('view'=>$view);
        return $result;
        
    }

    function getDataCheckListBox($lookupname, $params){
        $config = $this->getJsonFile('lookup/'.$lookupname, 'lookup');
        if (!isset($config['lookuptype'])){
            $lookuptype = 'database';
        } else {
            $lookuptype = $config['lookuptype'];
        }
        if ($lookuptype=='static'){
            $result = $config['lookupdata'];
        } else if ($lookuptype=='database'){
            $sql = $config['sql'];
            $result = $this->mdb->QueryData('application', $sql, $params, 'matrix');
            $result = $result['matrixdata'];
            //$result = array();
        } else {
            $result = array();
        }
        //$vsql = $config['sql'];
        //$qresult = $this->mdb->QueryData('application', $vsql, $params, 'record');
        return $result;
    }
    
    
    function rowToCheckbox($row){
        $result = array();
        if (is_array($row)){
            if (count($row)>=3){
                $result['id'] = $row[0];
                $result['value'] = $row[1];
                $result['checked'] = $row[2];
            } else if (count($row)>=2){
                $result['id'] = $row[0];
                $result['value'] = $row[1];
                $result['checked'] = 0;
            } else if (count($row)>=1){
                $result['id'] = $row[0];
                $result['value'] = $row[0];
                $result['checked'] = 0;
            } else {
                $result['id'] = '-';
                $result['value'] = '-';
                $result['checked'] = 0;
            }
        } else {
            $result['id'] = $row;
            $result['value'] = $row;
            $result['checked'] = 0;
        }
        return $result;
    }

    function distributeListColumn($items, $count){
        $xcount = ceil(count($items)/$count);
        $arrcount = array();
        $result = array();
        for($idx=0; $idx<$count; $idx++){
            array_push($arrcount, 0);
            array_push($result, array());
        }
        $rowidx = 0;
        $colidx = 0;
        $idx = 0;
        //print_r($xcount);
        foreach($items as $row){
            array_push($result[$colidx], $row);
            $idx = $idx+1;
            if ($idx==$xcount){
                $idx = 0;
                $colidx = $colidx+1;
            }
        }
        return $result;
        /*$result = array();
        $arrcount = array();
        for($idx=0; $idx<$count; $idx++){
            array_push($arrcount, 0);
        }

        $idx = 0;
        foreach($items as $row){
            $arrcount[$idx] = $arrcount[$idx]+1;
            //array_push($result[$idx], $row);
            $idx = $idx+1;
            if ($idx == $count){
                $idx = 0;
            }
        }
        $idx = 0;
        foreach($arrcount as $itemcount){
            
        }
        return $result;*/
    }

    function distributeListColumnx($items, $count){
        $result = array();
        for($idx=0; $idx<$count; $idx++){
            array_push($result, array());
        }

        $idx = 0;
        foreach($items as $row){
            array_push($result[$idx], $row);
            $idx = $idx+1;
            if ($idx == $count){
                $idx = 0;
            }
        }
        return $result;
    }

    function formatCheckListBox($data, $count, $fdcount=0){
        $vdata = array();
        //print_r($data);
        foreach($data as $row){
            $item = $this->rowToCheckbox($row);
            $cnt = 0;
            $field=array();
            foreach($row as $fld){
                if ($cnt>2){
                    array_push($field, $fld);
                }
                $cnt = $cnt+1;
            }
            $item['field'] = $field;
            array_push($vdata, $item);
        }
        //print_r($vdata); die;
        //$count = 4;
        if ($count==1){
            $classname = 'col-xs-12';
        } else if ($count==2){
            $classname = 'col-xs-6';
        } else if ($count==3){
            $classname = 'col-xs-4';
        } else if ($count==4){
            $classname = 'col-xs-3';
        } else {
            $classname = 'col-xs-2';
        }
        $vgroup = $this->distributeListColumn($vdata, $count);
        $elements = array();
        foreach($vgroup as $itemgroup){
            array_push($elements, array('xtype'=>'column', 'class'=>$classname));
            foreach($itemgroup as $item){
                $element = $item;
                $element['xtype'] = 'checkbox';
                array_push($elements, $element);
            }
            array_push($elements, array('xtype'=>'/column'));
        }
        
        
        $data = array('arrelements'=>$elements);
        $data['namespace'] = $this->getNameSpace();
        $data['fieldcount'] = $fdcount;
        $result = $this->load->view('crud/checkboxlist', $data, true);
        //return json_encode($data);
        return $result;
    }
    
    function executeMethod($command, $xparams){
//        print_r($command);
//        print_r($xparams);
        if (isset($this->crudData[$command])){
            $cmdInfo = $this->crudData[$command];
            $objname = $cmdInfo['objectname'];
            $methodname = $cmdInfo['methodname'];
            //$params = $cmdInfo['params'];
            $params = getArrayDef($cmdInfo, 'params', array());
            $this->load->model($objname, 'mobj');
            $params = array_merge($params, $xparams);
            $result = call_user_func_array(array($this->mobj, $methodname),
                array($params));
            return $result;
        } else {
            throw new Exception('command '.$command.' tidak diketemukan.');
        }
    }
    
    function getNameSpace(){
        if($this->namespace!==''){
            $result = $this->namespace.'_';
        } else {
            $result = '';            
        }
        return $result;
    }

    
    
}



?>
