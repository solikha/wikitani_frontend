<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/* Manggu Framework
 * Simple PHP Application Development
 * Kusnassriyanto S. Bahri
 * kusnassriyanto@gmail.com
 * 
 */


class M_flexcrud extends MY_Model
{
    var $crudData;
    var $actionTypes;
    var $actionName;
    var $crudName;
    public function __construct()
    {
        parent::__construct();
    }
    
    public function showCrud($crudname, $actionname){
        //echo "Testing";
        //return array();
        $this->loadCrudFile($crudname, $actionname);
        
        $dbdata = $this->getDBData();
        $resultview = array();
        //print_r($this->crudData['servermode']['display']);
        foreach($this->crudData['servermode']['display'] as $item){
            $dbitem = getArrayDef($dbdata, $item, array());
            $resultview[$item] = $this->formatData($item, $dbitem);
        }

        $viewdata = $this->getDefaultCrudData();
        $viewdata = array_merge($viewdata, $resultview);
        $baseview = getArrayDef($this->crudData, 'template', 'baseview');
        //print_r($viewdata);
        //echo $baseview;
        $result = $this->load->view('flexcrud/'.$baseview, $viewdata, true);
        echo $result;
        
        /*$data['crudtitle'] = $this->getCrudTitle();
        $ctparams = $this->getViewDataParams();
        $data['crudparams'] = $ctparams['view'];
        $params = $this->getDefaultParams();
        //print_r($params);
        $qdata = $this->getViewDataGrid($params);
        $data['crudgrid'] = $qdata['view'];
        $data['crudgridinfo'] = $qdata['gridinfo'];
        $data['crudpages'] = $qdata['pagination'];
        $data['crudcommands'] = $qdata['crudcommands'];
        $data['crudname'] = $crudname;
        $data['actionname'] = $actionname;
        //print_r($data['crudgrid']);
        $result = $this->load->view('crud/baseview', $data, true);
        echo $result;*/
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
        return $result;
    }
    
    function getDBData(){
        $result = array();
        return $result;
    }
    
    function loadCrudFile($crudname, $actionname){
        $this->crudName = $crudname;
        $this->actionName = $actionname;
        //$this->fieldTypes = $this->getJsonFile('fieldtypes', 'list');
        $this->actionTypes = $this->getJsonFile('actiontypes', 'list');
        $this->crudData = $this->getJsonFile($crudname.'/'.$actionname);
//        if (!isset($this->crudData['grouplist'])){
//            $this->crudData['grouplist'] = $this->getGroupDefault();
//        }
    }
    
        function getJsonFile($crudname, $type=''){
        if ($type==''){
            $type = 'flexcrud';
        }
        $basefolder = $this->ci->config->item('basefolder').'flexcrud/';
        $filename = $basefolder.$crudname.".".$type;
        $json_data = file_get_contents($filename);
        return json_decode($json_data, true);
    }
    

    function formatData($itemname, $data){
        $result = '';
        if (isset($this->crudData['format-items'][$itemname])){
            $formatdata = $this->crudData['format-items'][$itemname];
            if ($formatdata['xtype']=='fieldlist'){
                $result = $this->formatFieldList($data, $formatdata);
            } else if ($formatdata['xtype']=='string'){
                $result = getArrayDef($formatdata, 'value');
            }
        } else {
            $result = '';
        }
        return $result;
    }
    
    function formatFieldList($data, $formatdata){
        $formatitems = $formatdata['items'];
        foreach($formatitems as &$itemformatdata){
            $itemname = getArrayDef($itemformatdata, 'name', '');
            if ($itemname!==''){
                if (isset($data[$itemname])){
                    $itemformatdata['value'] = $data[$item];
                }
            }
        }
        //print_r($formatitems);
        $bygroup = $this->groupingFieldList($formatitems);
        $elmresult = array();
        //print_r($bygroup);
        foreach($bygroup as $groupname=>$groupitems){
            $viewdata = array('arrelements'=>$groupitems);
            $view = $this->load->view('flexcrud/formelements', $viewdata, true);
            $elmresult[$groupname] = $view;
        }
        
        //print_r($elmresult);
        $template = getArrayDef($formatdata, 'template', '');
        if ($template!==''){
            $result = $this->load->view('flexcrud/'.$template, $elmresult, true);
        } else {
            $result = '';
        }
        return $result;
    }
    
    function groupingFieldList($formatdata, $defaultgroupname = 'default'){
        $result = array();
        foreach($formatdata as $item){
            $groupname = getArrayDef($item, 'group', $defaultgroupname);
            if (!isset($result[$groupname])){
                $result[$groupname] = array();
            }
            array_push($result[$groupname], $item);
        }
        return $result;
    }
    
    
}

?>
