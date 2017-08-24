<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/* Manggu Framework
 * Simple PHP Application Development
 * Kusnassriyanto S. Bahri
 * kusnassriyanto@gmail.com
 * 
 */

class M_menu extends MY_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    
    // get tampilan main menu
    // result json:  view->html, js->inline javascript (kalo ada)
    //               data lainnya.
    function getViewMainMenu(){
        $menudata = $this->getDataMainMenu();
        $view = $this->formatViewMainMenu($menudata);
        $result = array('view'=>$view);
        return $result;
    }
    
    function getDataMainMenu(){
        $result = $this->loadRecursiveMenu(0);
        return $result;
    }
    
    function formatViewMainMenu($menudata){
        $menuList = $this->buildMenu($menudata, 0);
        $viewdata = array('mainmenu'=>$menuList);
        $result = $this->load->view('mainmenu', $viewdata, true);
        return $result;
    }
    
    function loadRecursiveMenu($parentid){
        $result = array();
        $sql = 'select a.menuid, a.menuname, a.caption, a.description, a.command, '.
            'a.context, a.iconname, a.menuoptions from sys_menu a '.
            ' join ( '.
            'select distinct e.permissionname '.
            'from sys_users a '.
            'join sys_userroles b on a.userid = b.userid '.
            'join sys_roles c on b.roleid = c.roleid '.
            'join sys_rolepermissions d on c.roleid = d.roleid '.
            'join sys_permissions e on e.permissionid = d.permissionid '.
            'where a.username = :sys_username '.
            "and e.category = 'menu' ) x on a.menuname = x.permissionname ".
            'where a.parentid = :parentid and visible = 1 and ismenu = 1'.
            'order by a.viewindex ';
        $params = array('parentid'=>$parentid);
        $qresult = $this->mdb->QueryData('application', $sql, $params, 'record');
        //print_r($parentid);
        $result = array();
        if (is_array($qresult)){
            foreach($qresult as $row){
                $item = $row;
                $items = $this->loadRecursiveMenu($item['menuid']);
                if (count($items)!==0){
                    $item['children'] = $items;
                }
                array_push($result, $item);
            }
        }
        return $result;
        
    }
    
    function updateMenuName($item){
        //$result = 'fa fa-'.$item['iconname'];
        $result = $item['iconname'];
        return $result;
    }
    
    function buildMenu($arrdata, $level){
        $result = array();
        if (is_array($arrdata)){
            array_push($result, array('tipe'=>'ul', 'level'=>$level));
            foreach($arrdata as $arritem){
                $resitem = $arritem;
                $resitem['iconname'] = $this->updateMenuName($resitem);
                $resitem['tipe'] = 'item';
                //echo "##";print_r($arritem);echo "$$$";
                if (!isset($arritem['command']) or ($arritem['command']==='')){
                    $resitem['link'] = '#';
                } else {
                    //$resitem['link'] = $this->getAppUrl().$arritem['command'].'/'.$arritem['context'];
                    $resitem['link'] = $this->getBaseUrl().'menu/'.$arritem['menuname'];
                }
                unset($resitem['children']);
                $reschildren = '';
                if(isset($arritem['children']) ){
                    $reschildren = $this->buildMenu($arritem['children'], $level+1);
                    //$this->inti->doLogData('menu', 'reschildren', $reschildren);
//                    throw new Exception('test');
                    array_push($result, array('tipe'=>'li'));
                    if ($level<=1){
                        $resitem['tipe'] = 'parent'.$level;
                    }else {
                        $resitem['tipe'] = 'parent';
                    }
                    array_push($result, $resitem);
                    if (is_array($reschildren)){
                        $result = array_merge($result, $reschildren);
                    }
                    array_push($result, array('tipe'=>'/li'));
                } else {
                    array_push($result, $resitem);
                }
            }
            array_push($result, array('tipe'=>'/ul'));
            
        }
        return $result;
    }
    
    public function getMenuInfo($menuname){
        $result = array();
        $sql = 'select a.menuid, a.menuname, a.caption, a.description, a.command, '.
            'a.context, a.iconname, a.menuoptions from sys_menu a '.
            'where a.menuname = :menuname and visible = 1';
        $params = array('menuname'=>$menuname);
        $qresult = $this->mdb->QueryData('application', $sql, $params, 'record');
        if (count($qresult)>0){
            return $qresult[0];
        } else {
            return false;
        }
        
    }
    
    
}



?>
