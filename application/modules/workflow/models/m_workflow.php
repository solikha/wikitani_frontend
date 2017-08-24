<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/* Manggu Framework
 * Simple PHP Application Development
 * Kusnassriyanto S. Bahri
 * kusnassriyanto@gmail.com
 * 
 */

class M_workflow extends MY_Model {

    var $workflowdata;
    var $processname;
    var $processcategory;
    var $username = 'public';
    var $view_workflow;
    var $url_final_draft;
    var $url_final_verify;
    var $workflowid = '';
    var $wfdbdata;
    var $currenttask;

    public function __construct() {
        parent::__construct();
        $this->view_workflow = base_url() . index_page() . '/menu/editworkflow';
        $this->url_final_draft = base_url() . index_page() . '/menu/permohonan_perizinan';
        $this->url_final_verify = base_url() . index_page() . '/menu/persetujuan_perizinan';
    }

    function loadWorkflow($category, $wfname) {
        $this->processname = $wfname;
        $this->processcategory = $category;
        $filename = $this->ci->config->item('basefolder') . '/workflow/' . $category . "/" .
                $wfname . '.process';
        if (!file_exists($filename)) {
            throw new MgException('404', 'Workflow ' . $category . '/' . $wfname . ' tidak diketemukan.');
        }
        $json_file = file_get_contents($filename);
        $json_data = json_decode($json_file, true);

        $json_data['category'] = $category;
        $json_data['name'] = $wfname;

        if (!isset($json_data['tasks'])) {
            throw new MgException('500', 'Proses ' . $category . '/' . $wfname . ' error. Tasks tidak diketemukan.');
        }
        if (count($json_data['tasks']) <= 0) {
            throw new MgException('500', 'Proses ' . $category . '/' . $wfname . ' error. Task tidak diketemukan.');
        }
        $start_task_def = $json_data['tasks'][0];
        $json_data['start_task'] = $start_task_def;
        $this->workflowdata = $json_data;
    }

    function formatHidden($vdata) {
        $result = '';
        foreach ($vdata as $vname => $vvalue) {
            $vtext = '<input type="hidden" name="' . $vname . '" value="' . $vvalue . '">';
            $result = $result . $vtext;
            $result = $result . "\r\n";
        }
        return $result;
    }

    function showControlFields($mode) {
        $xtask = null;
        $nextroledesc = '';
        $nextrole = '';
        if (isset($this->currenttask['next_task']['taskname'])) {
            $next_task = $this->currenttask['next_task']['taskname'];
            $xtask = $this->findTask($next_task);
            if (isset($xtask['role_name'])) {
                $nextrole = $xtask['role_name'];
                $sql = "select coalesce(a.description, :rolename) as rolename
                    from sys_roles a where rolename = :rolename";
                $params = array('rolename' => $nextrole);
                $res = $this->mdb->QueryData('application', $sql, $params, 'record');
                if (isset($res[0]['rolename'])) {
                    $nextroledesc = $res[0]['rolename'];
                }
            }
        }
        $currentroledesc = '';
        $currentrole = '';
        if (isset($this->currenttask['next_task']['taskname'])) {
            $currentrole = $this->currenttask['role_name'];
            $sql = "select coalesce(a.description, :rolename) as rolename
                from sys_roles a where rolename = :rolename";
            $params = array('rolename' => $currentrole);
            $res = $this->mdb->QueryData('application', $sql, $params, 'record');
            if (isset($res[0]['rolename'])) {
                $currentroledesc = $res[0]['rolename'];
            }
        }
        $data = array();
        if ($mode == 'new') {
            $data['saving_mode'] = 'new_data';
            $data['processname'] = $this->processname;
            $data['processcategory'] = $this->processcategory;
            $data['next_rolename'] = $nextrole;
            $data['next_roledesc'] = $nextroledesc;
            $data['current_rolename'] = $currentrole;
            $data['current_roledesc'] = $currentroledesc;
            //$vtext = '<input type="hidden" name="saving_mode" value="new_data">';
            $result = $this->formatHidden($data);
            //echo $result;
        } else {
            $data['saving_mode'] = 'edit_data';
            $data['processname'] = $this->processname;
            $data['processcategory'] = $this->processcategory;
            $data['workflowid'] = $this->workflowid;
            $data['next_rolename'] = $nextrole;
            $data['next_roledesc'] = $nextroledesc;
            $data['current_rolename'] = $currentrole;
            $data['current_roledesc'] = $currentroledesc;
            //$vtext = '<input type="hidden" name="saving_mode" value="new_data">';
            $result = $this->formatHidden($data);
        }
        return $result;
    }

    function prepareParams($mode) {
        $result = array();
        $result['control_fields'] = $this->showControlFields($mode);
        $result['form_action'] = base_url() . index_page() . '/menu/save_workflow';
        return $result;
    }

    function getFirstView() {
        if (isset($this->workflowdata['tasks'][0])) {
            $vTask = $this->workflowdata['tasks'][0];
            if (isset($vTask['steps'][0]['view'])) {
                $vView = $vTask['steps'][0]['view'];
                return $vView;
            } else {
                throw new MgException('500', 'First step tidak ada atau tidak memiliki view.');
            }
        } else {
            throw new MgException('500', 'Task tidak diketemukan.');
        }
    }

    function startscreen($category, $wfname) {
        $this->loadWorkflow($category, $wfname);
        $vView = $this->getFirstView();
        $params = $this->prepareParams('new');
        if ($vView['type'] == 'ciview') {
            $vName = 'workflow/' . $category . '/' . $wfname . '/' . $vView['viewname'];
            $this->load->view($vName, $params);
        } else {
            throw new MgException('500', 'Tipe view dari step (' . $vView['type'] . ')tidak dikenal');
        }
//        print_r($this->workflowdata);
        //die;
//        $params = $this->prepareParams();
//        $view = $this->getView();
//        $this->load->view($view, $params);
    }

    function findFirstNextStep() {
        $result = array();
        $vtask = $this->workflowdata['tasks'][0];
        $vstep = $vtask['steps'][0];
        $result['last_status'] = getArrayDef($vtask, 'status_name', '');
        if (!isset($vstep['next_step']['stepname'])) {
            $vstep['next_step']['type'] = 'terminal';
        }

        if ($vstep['next_step']['type'] == 'terminal') {
            $nstask = $vtask['next_task'];
            if ($nstask['type'] == 'fieldvalue') {
                $valtask = getArrayDef($_POST, $nstask['fieldname'], '');
                $taskname = getArrayDef($nstask['valuelist'], $valtask, '---');
                if ($taskname == '---') {
                    $taskname = getArrayDef($nstask['valuelist'], 'other', '');
                }
            } else {
                $taskname = getArrayDef($nstask, 'taskname', '');
            }
            $xtask = $this->findTask($taskname);
            $xstep = $xtask['steps'][0];
            $result['same_task'] = 0;
        } else {
            $xtask = $vtask;
            $stepname = $vstep['next_step']['stepname'];
            $xstep = $this->findStep($xtask, $stepname);
            $result['same_task'] = 1;
        }
//        print_r($vtask);
//        echo "xtask";
//        print_r($xtask);
//        echo "---";
        $result['last_status'] = getArrayDef($vtask, 'status_name', '');
        $result['last_rolename'] = getArrayDef($vtask, 'role_name', '');
        $result['next_status'] = getArrayDef($xtask, 'status_name', '');
        $result['next_taskname'] = getArrayDef($xtask, 'name', '');
        $result['next_stepname'] = getArrayDef($xstep, 'name', '');
        $result['next_rolename'] = getArrayDef($xtask, 'role_name', '');
        return $result;
    }

    function findTask($taskname) {
        foreach ($this->workflowdata['tasks'] as $item) {
            if ($item['name'] == $taskname) {
                return $item;
            }
        }
        return null;
    }

    function findStep($vtask, $stepname) {
        foreach ($vtask['steps'] as $item) {
            if ($item['name'] == $stepname) {
                return $item;
            }
        }
        return null;
    }

    function findNextStep($wfid, $action) {
        $vdata = $this->wfdbdata;
        $vxdata = json_decode($vdata['workflowdata'], true);
        //print_r($vdata);
        //echo "<br>";
        $category = $vdata['processcategory'];
        $wfname = $vdata['processname'];
        $taskname = $vdata['next_taskname'];
        $stepname = $vdata['next_stepname'];
        $this->loadWorkflow($category, $wfname);
        $vtask = $this->findTask($taskname);
        $vstep = $this->findStep($vtask, $stepname);
        if (strtolower($action) == 'previous') {
            if (!isset($vstep['prev_step']['type'])) {
                $vstep['prev_step']['type'] = 'terminal';
            }
            if ($vstep['prev_step']['type'] == 'terminal') {
                $nstask = $vtask['prev_task'];
                if ($nstask['type'] == 'fieldvalue') {
                    $vxdata = array_merge($vxdata, $_POST);
                    $valtask = getArrayDef($vxdata, $nstask['fieldname'], '');
                    $taskname = getArrayDef($nstask['valuelist'], $valtask, '---');
                    if ($taskname == '---') {
                        $taskname = getArrayDef($nstask['valuelist'], 'other', '');
                    }
                    $xtask = $this->findTask($taskname);
                    $xstep = $xtask['steps'][0];
                } else {
                    $taskname = getArrayDef($nstask, 'taskname', '');
                    $xtask = $this->findTask($taskname);
                    $xstep = $xtask['steps'][0];
                }
                $result['same_task'] = 0;
                //echo "+++";
            } else {
                $xtask = $vtask;
                $stepname = $vstep['prev_step']['stepname'];
                $xstep = $this->findStep($xtask, $stepname);
                $result['same_task'] = 1;
                //echo "---";
            }
            //echo "xtask";
            //print_r($xtask);
        } else {
            if (!isset($vstep['next_step']['type'])) {
                $vstep['next_step']['type'] = 'terminal';
            }
            if ($vstep['next_step']['type'] == 'terminal') {
                $nstask = $vtask['next_task'];
                if ($nstask['type'] == 'fieldvalue') {
                    $vxdata = array_merge($vxdata, $_POST);
                    $valtask = getArrayDef($vxdata, $nstask['fieldname'], '');
                    $taskname = getArrayDef($nstask['valuelist'], $valtask, '---');
                    if ($taskname == '---') {
                        $taskname = getArrayDef($nstask['valuelist'], 'other', '');
                    }
                    //print_r($_POST);
                    $xtask = $this->findTask($taskname);
                    $xstep = $xtask['steps'][0];
                } else if ($nstask['type'] == 'final') {
                    $xtask = array();
                    $xtask['status_name'] = getArrayDef($nstask, 'final_status', 'disetujui');
                    $xtask['role_name'] = $vtask['role_name'];
                    $xstep = array();
                } else {
                    $taskname = getArrayDef($nstask, 'taskname', '');
                    $xtask = $this->findTask($taskname);
                    $xstep = $xtask['steps'][0];
                }
                $result['same_task'] = 0;
            } else {
                $xtask = $vtask;
                $stepname = $vstep['next_step']['stepname'];
                $xstep = $this->findStep($xtask, $stepname);
                $result['same_task'] = 1;
            }
        }
//        echo "vstep";
//        print_r($vstep);
//        die;
//        print_r($vtask);
//        print_r($xtask);
        $result['last_status'] = getArrayDef($vtask, 'status_name', '');
        $result['last_rolename'] = getArrayDef($vtask, 'role_name', '');
        $result['next_status'] = getArrayDef($xtask, 'status_name', '');
        $result['next_taskname'] = getArrayDef($xtask, 'name', '');
        $result['next_stepname'] = getArrayDef($xstep, 'name', '');
        $result['next_rolename'] = getArrayDef($xtask, 'role_name', '');
        return $result;
    }

    function savedata() {
        $category = $_POST['processcategory'];
        $wfname = $_POST['processname'];
        $savingmode = $_POST['saving_mode'];
        //echo $category.'/'.$wfname.'/'.$savingmode;
        //echo '<br>';
        $sessData = $this->mlogin->getSessionData();
        if ($sessData !== false) {
            $this->username = $sessData['username'];
        }
        $username = $this->username;
        //echo $username;

        $this->loadWorkflow($category, $wfname);

        $baseparams = array();
        $baseparams['processname'] = $wfname;
        $baseparams['processcategory'] = $category;
        $baseparams['last_username'] = $username;
        if (isset($_POST['action'])) {
            $action = $_POST['action'];
        } else {
            $action = 'next';
        }
        if ($savingmode == 'new_data') {
            //$task = getFirstTask;
            $next = $this->findFirstNextStep();
            $baseparams['createuser'] = $username;
            $baseparams['next_taskname'] = $next['next_taskname'];
            $baseparams['next_stepname'] = $next['next_stepname'];
            $baseparams['last_status'] = $next['last_status'];
            $baseparams['next_status'] = $next['next_status'];
            $baseparams['next_rolename'] = $next['next_rolename'];
            $baseparams['last_rolename'] = $next['last_rolename'];
            $dataparams = $_POST;
            unset($dataparams['action']);
            unset($dataparams['saving_mode']);
            $workflowid = $this->insertdata($baseparams, $dataparams);
        } else {
            $workflowid = $_POST['workflowid'];
            $baseparams['workflowid'] = $workflowid;
            $this->wfdbdata = $this->findWfData($workflowid);
            $next = $this->findNextStep($workflowid, $action);
            $baseparams['next_taskname'] = $next['next_taskname'];
            $baseparams['next_stepname'] = $next['next_stepname'];
            $baseparams['last_status'] = $next['last_status'];
            $baseparams['next_status'] = $next['next_status'];
            $baseparams['next_rolename'] = $next['next_rolename'];
            $baseparams['last_rolename'] = $next['last_rolename'];
            //$task = getFirstTask;
            $dataparams = $_POST;
            unset($dataparams['action']);
            unset($dataparams['saving_mode']);
//            print_r($baseparams);
//            die;
            $this->updatedata($baseparams, $dataparams);
        }
        //print_r($next);
        if ($next['same_task']) {
            echo "Save Data. Please Wait...";
            $redirect = $this->view_workflow . '/' . $workflowid;
        } else {
            echo "Save Data. Please Wait...";
            if (strtolower($baseparams['last_rolename']) == 'pemohon') {
                $redirect = $this->url_final_draft;
            } else {
                $redirect = $this->url_final_verify;
            }
        }
        redirect($redirect, 'refresh');
    }

    function updatedata($baseparams, $dataparams) {
        $vdata = $this->wfdbdata;
        $xdata = json_decode($vdata['workflowdata'], true);
        $xdata = array_merge($xdata, $dataparams);
        $vsdata = json_encode($xdata);
        $vsqlparams = $baseparams;
        $vsqlparams['workflowdata'] = $vsdata;
        //print_r($baseparams);
        //die;
        $vsql = 'update app_workflow
            set workflowdata=:workflowdata, next_taskname=:next_taskname, 
            next_stepname=:next_stepname, next_rolename=:next_rolename,
            next_status=:next_status, last_update=now(), last_username=:last_username, 
            last_status=:last_status
            where workflowid=:workflowid;';
        $this->mdb->ExecSQL('system', $vsql, $vsqlparams);
    }

    function insertdata($baseparams, $dataparams) {
        $vdata = json_encode($dataparams);
        $vsql = 'select 0; insert into app_workflow(
            processname, processcategory, createuser,  
            workflowdata, next_taskname, next_stepname, next_rolename, next_status, 
            last_username, last_status)
            values (:processname, :processcategory, :createuser, 
            :workflowdata, :next_taskname, :next_stepname, :next_rolename, :next_status, 
            :last_username, :last_status);' .
                "select currval('app_workflow_workflowid_seq') as workflowid";
        $vsqlparams = $baseparams;
        $vsqlparams['workflowdata'] = $vdata;
        //$this->mdb->ExecSQL('system', $vsql, $vsqlparams);
        $vdata = $this->mdb->QueryData('system', $vsql, $vsqlparams, 'record');
        if (isset($vdata[0]['workflowid'])) {
            return $vdata[0]['workflowid'];
        } else {
            return 0;
        }
        //print_r($vdata);
    }

    function findView($taskname, $stepname) {
        $task = $this->findTask($taskname);
        if ($task === null) {
            $result = array('type' => 'not-found');
        } else {
            $step = $this->findStep($task, $stepname);
            if ($step === null) {
                $result = array('type' => 'not-found');
            } else {
                if (isset($step['view'])) {
                    $result = $step['view'];
                } else {
                    $result = array('type' => 'not-found');
                }
            }
        }
        return $result;
    }

    function viewworkflow($wfid) {
        $this->workflowid = $wfid;
        $wfdata = $this->findWfData($wfid);
        $category = $wfdata['processcategory'];
        $wfname = $wfdata['processname'];
        $taskname = $wfdata['next_taskname'];
        $stepname = $wfdata['next_stepname'];
        $this->loadWorkflow($category, $wfname);
        //$vView = $this->findView($taskname, $stepname);
        $this->currenttask = $this->findTask($taskname);
        if (isset($this->workflowdata['view_process'])) {
            $vView = $this->workflowdata['view_process'];
        } else {
            $vView = array('type' => 'ciview', 'viewname' => 'v_view_workflow');
        }
        $params = $this->prepareParams('edit');
        if ($vView['type'] == 'ciview') {
            $vName = 'workflow/' . $category . '/' . $wfname . '/' . $vView['viewname'];
            $this->load->view($vName, $params);
        } else {
            throw new MgException('500', 'Tipe view dari step (' . $vView['type'] . ')tidak dikenal');
        }
        $vdata = json_decode($wfdata['workflowdata'], true);
        $this->JSLoadValue($vdata);
    }

    function editworkflow($wfid) {
        $this->workflowid = $wfid;
        $wfdata = $this->findWfData($wfid);
        $category = $wfdata['processcategory'];
        $wfname = $wfdata['processname'];
        $taskname = $wfdata['next_taskname'];
        $stepname = $wfdata['next_stepname'];
        $this->loadWorkflow($category, $wfname);
        $this->currenttask = $this->findTask($taskname);
        $vView = $this->findView($taskname, $stepname);
        $params = $this->prepareParams('edit');
        if ($vView['type'] == 'ciview') {
            $vName = 'workflow/' . $category . '/' . $wfname . '/' . $vView['viewname'];
            $this->load->view($vName, $params);
        } else {
            throw new MgException('500', 'Tipe view dari step (' . $vView['type'] . ')tidak dikenal');
        }
        $vdata = json_decode($wfdata['workflowdata'], true);
        //echo "&&&&&&&";
        $this->JSLoadValue($vdata);
    }

    function findWfData($wfid) {
        $vsql = 'select * from app_workflow where workflowid = :workflowid';
        $vparams = array('workflowid' => $wfid);
        $vdata = $this->mdb->QueryData('system', $vsql, $vparams, 'record');
        if (isset($vdata[0])) {
            return $vdata[0];
        } else {
            return false;
        }
    }

    function JSLoadValue($vdata) {
        $params = array('workflowdata' => $vdata);
        $this->load->view('workflow/jsloader', $params);
    }

    function data_no($code, $month, $year) {
        $vsql = 'select * from app_no_receipt where code = :code and month = :month and year = :year';
        $vparams = array('code' => $code, 'month' => $month, 'year' => $year);
        $vdata = $this->mdb->QueryData('system', $vsql, $vparams, 'record');
        if (isset($vdata[0])) {
            return $vdata[0];
        } else {
            return false;
        }
    }

    function data_no_max($code, $month, $year) {
        $vsql = 'select max(no) from app_no_receipt where code = :code and month = :month and year = :year';
        $vparams = array('code' => $code, 'month' => $month, 'year' => $year);
        $vdata = $this->mdb->QueryData('system', $vsql, $vparams, 'record');
        if (isset($vdata[0])) {
            return $vdata[0];
        } else {
            return false;
        }
    }

    function update_data_no_max($code, $month, $year, $no) {
        $param = array('code' => $code, 'month' => $month, 'year' => $year, 'no' => $no);
        $sql = "UPDATE app_no_receipt SET no=:no WHERE code=:code and month=:month and year=:year";
        $qresult = $this->mdb->ExecSQL('application', $sql, $param, 'record');
        return $qresult;
    }

    function insert_data_no_max($code, $month, $year, $no) {
        $param = array('code' => $code, 'month' => $month, 'year' => $year, 'no' => $no);
        $sql = "INSERT INTO app_no_receipt (code, month, year, no) VALUES (:code, :month, :year, :no)";
        $qresult = $this->mdb->ExecSQL('application', $sql, $param, 'record');
        return $qresult;
    }

}

?>
