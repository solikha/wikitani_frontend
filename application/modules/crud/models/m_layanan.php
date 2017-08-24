<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class M_layanan extends MY_Model
{
    var $cmdOptions = '';
    var $kodelayanan = array(
        '1' => 'ganti_paspor',
        '2' => 'paspor_baru_anak',
        '4' => 'pulang_habis',
        '5' => 'pindah_wn',
        '6' => 'lapor_meninggal',
        '7' => 'lapor_diri',
        '8' => 'registrasi',
        '9' => 'splp',
        '3.10' => 'ganti_nikah',
        '3.11' => 'ganti_cerai',
        '3.12' => 'ganti_alamat',
        '3.13' => 'ganti_stkerja'
    );
    
    public function __construct()
    {
        parent::__construct();
    }
    
    public function get_kode_layanan($layanan, $sub=''){
        if (isset($this->kodelayanan[$layanan.'.'.$sub])){
            return $this->kodelayanan[$layanan.'.'.$sub];
        } else if (isset($this->kodelayanan[$layanan])) {
            return $this->kodelayanan[$layanan];
        } else {
            return '';
        }
    }
    
    public function update_sys_menu($kode){
        $sqlcheck = "select menuname from sys_menu where menuname = :menuname";
        $sqlupdate = "
            INSERT INTO sys_menu (viewindex, menuname, caption, description, parentid, 
            menulevel, frontbar, command, context, visible, iconname, menuoptions, ismenu) 
            VALUES (null, :menuname, :caption, :desc, 0, 1, 0, 'crud', :menuname, 1, NULL, NULL, 0);
        ";
        $updatelist = array(
            array(
                'menuname' => 'edit_layanan_'.$kode,
                'caption' => 'edit_layanan_'.$kode,
                'desc' => 'edit_layanan_'.$kode
            )
        );
        foreach($updatelist as $item){
            $result = $this->mdb->QueryData('application', $sqlcheck, $item, 'record');
            if (!isset($result[0])){
                $this->mdb->ExecSQL('application', $sqlupdate, $item);
            }
        }
    }
    
    public function test_redirect(){
        $redir = 'menu/home';
        $result = array("success"=>1);
        $result['islink'] = 1;
        $result['link'] = $redir;
        return $result;
    }
        
    public function datawni($params){
        $sql = "select id, hashid, data_wni from app_wni where hashid = :hashid";
        $qres = $this->mdb->QueryData('application', $sql, $params, 'record');
        $result = array();
        if (isset($qres[0])){
            $result = json_decode($qres[0]['data_wni'], true);            
        }
        if (isset($this->cmdOptions['fields'])){
            foreach ($this->cmdOptions['fields'] as $name => $field){
                if ($field['type']=='lookup') {
                    $fldvalue = getArrayDef($result, $name);
                    $vdLookup = $this->getDataLookup($fldvalue, $field['lookupname'], $result);
                    $vtName = getArrayDef($field, 'target', $name.'_display');
                    $result[$vtName] = $vdLookup;
                }
            }
        }
        
        //print_r($result); die;
        return $result;
        //$sql = "select"
    }
    
    public function savewni($params){
        // print_r($params); die;
        $striplist = array('hashid', 'lyn_id', 'crud_name', 'action_name', 'undefined', 'layananid', 'sublayananid');
        $dataparams = $this->stripParams($params, $striplist);
        $datawni = $this->datawni($params);
        $xdatawni = array_merge($datawni, $dataparams);
        $sdatawni = json_encode($xdatawni);
        $sql = "update app_wni set data_wni = :data_wni where hashid = :hashid";
        $this->mdb->ExecSQL('application', $sql, array('hashid'=>$params['hashid'], 'data_wni'=>$sdatawni));
        //print_r($xdatawni); die;
        return array('success'=>1);
    }
    
    public function savewni_attach($params){
        print_r($files); die;
    }
    
	  public function datalayanan($params){

        $sql = "select a.id, a.wniid, a.username, a.create_by, a.taskname, a.layananidhash, a.statusname, a.data_layanan,
            a.layananid, a.layananid, c.nama as nama_layanan, c.nama as desk_nama_layanan,
			a.catatan2, a.layananidstr,
            a.sublayananid, d.nama as nama_sublayanan, 
            case when coalesce(d.nama_layanan, '') <> '' then d.nama_layanan else c.nama_layanan end as attachment_category,         
            e.public_description as task_description,
            e.public_instruction as task_instruction,
            e.public_actionby as task_actionby,
            to_char(a.createtime, 'dd-mm-yyyy hh:mi') as create_time,
            cast(b.data_wni as json)->>'full_name' as pemohon, cast(b.data_wni as json)->>'full_name' as nama_lengkap,
            cast(b.data_wni as json)->>'birth_city' as tempat_lahir_pemohon,
            cast(b.data_wni as json)->>'birth_date' as tanggal_lahir_pemohon,
            f.nama as jenis_kelamin
          from wni_layanan a
            left join app_wni b on a.wniid = b.id
            left join layanan c on a.layananid = c.id
            left join layanan_sub d on a.sublayananid = d.id
            left join app_task e on a.taskname = e.taskname and a.layananid = e.layananid
            left join jenis_kelamin f 
			on 
			case 
				when 
					cast(cast(b.data_wni as json)->>'jenkelid' as character varying) <> '' 
				then
					cast(cast(b.data_wni as json)->>'jenkelid' as integer)
				else
				null
			end 
			= f.id
          where layananidhash = :lyn_id
        ";
        $xresult = $this->mdb->QueryData('application', $sql, $params, 'record');
        $result = array();
        if (isset($xresult[0])){
            $xdata = $xresult[0];
            $xjson = json_decode($xdata['data_layanan'], true);
            unset($xdata['data_layanan']);
            if($xjson){
                $result = array_merge($xjson, $xdata);
            } else {
                $result = $xdata;
            }
            if(!isset($result['pbaru_tpt_keluar'])){
                $datakbri = $this->ci->config->item('kbri');
                $result['pbaru_tpt_keluar'] = $datakbri['nama'];
            }
        } else {
            throw new Exception('Data tidak diketemukan.');
        }
        
        if (isset($this->cmdOptions['fields'])){
            foreach ($this->cmdOptions['fields'] as $name => $field){
                if ($field['type']=='lookup') {
                    $fldvalue = getArrayDef($result, $name);
                    $vdLookup = $this->getDataLookup($fldvalue, $field['lookupname'], $result);
                    $vtName = getArrayDef($field, 'target', $name.'_display');
                    $result[$vtName] = $vdLookup;
                }
            }
        }
       // print_r($this->cmdOptions);
		//echo "<pre>";
		//$check_json_exists=$this->datalayanan($params);
		//print_r($check_json_exists); die();
            //print_r($result);
		//echo "</pre>"; die();
        return $result;
    }
	
	
	
	public function getDataAnak($params){
	  $result = $this->datalayanananakbrowse($params);
      //print_r($result);	  
        return $result;
	}
	
	public function datalayanananak($params){
	  //print_r($params);
        $sql = "select a.id as wni_lyn_id, a.id, a.wniid, a.username, a.taskname, a.layananidhash, a.statusname, a.data_layanan,
            a.layananid, c.nama as nama_layanan,
            a.sublayananid, d.nama as nama_sublayanan, 
            d.attach_category as attachment_category,
            e.public_description as task_description,
            e.public_instruction as task_instruction,
            e.public_actionby as task_actionby,
            to_char(a.createtime, 'dd-mm-yyyy hh:mi') as create_time,
            b.nama_lengkap as pemohon, b.nama_lengkap, b.tempat_lahir, to_char(b.tanggal_lahir, 'dd-mm-yyyy') as tanggal_lahir,
            f.nama as jenis_kelamin,
			g.nama as nama_anak,
			g.tempat_lahir as tempat_lahir_anak,
			g.tanggal_lahir as tanggal_lahir_anak
          from wni_layanan a
            left join app_wni b on a.wniid = b.id
            left join layanan c on a.layananid = c.id
            left join layanan_sub d on a.sublayananid = d.id
            left join app_task e on a.taskname = e.taskname and a.layananid = e.layananid
            left join jenis_kelamin f on b.jenkelid = f.id
			left join app_registration_anak g on a.regid= g.id
          where a.id = :lyn_id
        ";
        $xresult = $this->mdb->QueryData('application', $sql, $params, 'record');
        $result = array();
        if (isset($xresult[0])){
            $xdata = $xresult[0];
            $xjson = json_decode($xdata['data_layanan'], true);
            unset($xdata['data_layanan']);
            if($xjson){
                $result = array_merge($xjson, $xdata);
            } else {
                $result = $xdata;
            }
            if(!isset($result['pbaru_tpt_keluar'])){
                $datakbri = $this->ci->config->item('kbri');
                $result['pbaru_tpt_keluar'] = $datakbri['nama'];
            }
        } else {
            throw new Exception('Data tidak diketemukan.');
        }
        
        if (isset($this->cmdOptions['fields'])){
            foreach ($this->cmdOptions['fields'] as $name => $field){
                if ($field['type']=='lookup') {
                    $fldvalue = getArrayDef($result, $name);
                    $vdLookup = $this->getDataLookup($fldvalue, $field['lookupname'], $result);
                    $vtName = getArrayDef($field, 'target', $name.'_display');
                    $result[$vtName] = $vdLookup;
                }
            }
        }
        return $result;
    }
	
	//menghindari error pada fungsi lain jika mengubah parameter query di datalayanananak
	public function datalayanananakbrowse($params){
	  //print_r($params);
        $sql = "select a.id as wni_lyn_id, a.id, a.wniid, a.username, a.taskname, a.layananidhash, a.statusname, a.data_layanan,
            a.layananid, c.nama as nama_layanan,
            a.sublayananid, d.nama as nama_sublayanan, 
            d.attach_category as attachment_category,
            e.public_description as task_description,
            e.public_instruction as task_instruction,
            e.public_actionby as task_actionby,
            to_char(a.createtime, 'dd-mm-yyyy hh:mi') as create_time,
            cast(b.data_wni as json)->>'full_name' as pemohon,
		    cast(b.data_wni as json)->>'birth_city' as tempat_lahir,
			cast(b.data_wni as json)->>'birth_date',
			cast(a.data_layanan as json)->>'anak_tanggal_lahir' as search_tgl_lahir,
            f.nama as jenis_kelamin,
			g.nama as nama_anak,
			g.tempat_lahir as tempat_lahir_anak,
			g.tanggal_lahir as tanggal_lahir_anak
          from wni_layanan a
            left join app_wni b on a.wniid = b.id  
            left join layanan c on a.layananid = c.id
            left join layanan_sub d on a.sublayananid = d.id
            left join app_task e on a.taskname = e.taskname and a.layananid = e.layananid
            left join jenis_kelamin f on 
			case 
			when 
				cast(cast(b.data_wni as json)->>'jenkelid' as character varying)  <> '' then
				cast(cast(b.data_wni as json)->>'jenkelid' as integer)
				else
			null
			end 
			= 
			f.id
			left join app_registration_anak g on a.regid= g.id
          where a.layananidhash = :lyn_id
        ";
        $xresult = $this->mdb->QueryData('application', $sql, $params, 'record');
        $result = array();
        if (isset($xresult[0])){
            $xdata = $xresult[0];
            $xjson = json_decode($xdata['data_layanan'], true);
            unset($xdata['data_layanan']);
            if($xjson){
                $result = array_merge($xjson, $xdata);
            } else {
                $result = $xdata;
            }
            if(!isset($result['pbaru_tpt_keluar'])){
                $datakbri = $this->ci->config->item('kbri');
                $result['pbaru_tpt_keluar'] = $datakbri['nama'];
            }
        } else {
            throw new Exception('Data tidak diketemukan.');
        }
        
        if (isset($this->cmdOptions['fields'])){
            foreach ($this->cmdOptions['fields'] as $name => $field){
                if ($field['type']=='lookup') {
                    $fldvalue = getArrayDef($result, $name);
                    $vdLookup = $this->getDataLookup($fldvalue, $field['lookupname'], $result);
                    $vtName = getArrayDef($field, 'target', $name.'_display');
                    $result[$vtName] = $vdLookup;
                }
            }
        }
		//echo "<pre>";
		  //print_r($result);
		//echo "</pre>";
        return $result;
		
    }
	
	
	public function getdatajsonanak($params){
		//print_r($params);
        $sql = "select a.data_layanan from wni_layanan a where a.id=:lyn_id";
        $xresult = $this->mdb->QueryData('application', $sql, $params, 'record');
        $result = array();
        if (isset($xresult[0])){
            $xdata = $xresult[0];
            $xjson = json_decode($xdata['data_layanan'], true);
            unset($xdata['data_layanan']);
            if($xjson){
                $result = array_merge($xjson, $xdata);
            } else {
                $result = $xdata;
            }
            if(!isset($result['pbaru_tpt_keluar'])){
                $datakbri = $this->ci->config->item('kbri');
                $result['pbaru_tpt_keluar'] = $datakbri['nama'];
            }
        } else {
            throw new Exception('Data tidak diketemukan.');
        }
        
        if (isset($this->cmdOptions['fields'])){
            foreach ($this->cmdOptions['fields'] as $name => $field){
                if ($field['type']=='lookup') {
                    $fldvalue = getArrayDef($result, $name);
                    $vdLookup = $this->getDataLookup($fldvalue, $field['lookupname'], $result);
                    $vtName = getArrayDef($field, 'target', $name.'_display');
                    $result[$vtName] = $vdLookup;
                }
            }
        }
        return $result;
    }
	
	public function getdatajsonanakbrowse($params){
		//print_r($params);
        $sql = "select a.data_layanan from wni_layanan a where a.layananidhash=:lyn_id";
        $xresult = $this->mdb->QueryData('application', $sql, $params, 'record');
        $result = array();
        if (isset($xresult[0])){
            $xdata = $xresult[0];
            $xjson = json_decode($xdata['data_layanan'], true);
            unset($xdata['data_layanan']);
            if($xjson){
                $result = array_merge($xjson, $xdata);
            } else {
                $result = $xdata;
            }
            if(!isset($result['pbaru_tpt_keluar'])){
                $datakbri = $this->ci->config->item('kbri');
                $result['pbaru_tpt_keluar'] = $datakbri['nama'];
            }
        } else {
            throw new Exception('Data tidak diketemukan.');
        }
        
        if (isset($this->cmdOptions['fields'])){
            foreach ($this->cmdOptions['fields'] as $name => $field){
                if ($field['type']=='lookup') {
                    $fldvalue = getArrayDef($result, $name);
                    $vdLookup = $this->getDataLookup($fldvalue, $field['lookupname'], $result);
                    $vtName = getArrayDef($field, 'target', $name.'_display');
                    $result[$vtName] = $vdLookup;
                }
            }
        }
        return $result;
    }
	
	public function UpdateCheckAnak1($params){
	//print_r($params);die();
		$arr1=$this->getdatajsonanakbrowse($params);
		$arr2=array('wnianak_id'=>$params['selected_id']);
		$con_array = array_merge ($arr1, $arr2);
		$data_checkupdate=array(
			'newdata_layanan'=>json_encode($con_array),
			'wni_lyn_id'=>$params['wni_lyn_id']
		);
		$sql="update wni_layanan set data_layanan=:newdata_layanan,taskname='siap-proses' where id=:wni_lyn_id";
		$this->mdb->ExecSQL('application', $sql, $data_checkupdate);
		return array(
		'success'=>1,
		'islink'=> true,
		'link'=>'menu/layanan'
		);
	}

	public function UpdateCheckAnak2($params){
	//print_r($params);die();
		$datalayanan=$this->getdatajsonanakbrowse($params);
		//print_r($datalayanan); die();
		unset($datalayanan['wnianak_id']); 
		$data_checkupdate=array(
			'newdata_layanan'=>json_encode($datalayanan),
			'wni_lyn_id'=>$params['wni_lyn_id']
		);
		$sql="update wni_layanan set data_layanan=:newdata_layanan,taskname='siap-proses' where id=:wni_lyn_id";
		$this->mdb->ExecSQL('application', $sql, $data_checkupdate);
		return array(
		'success'=>1,
		'islink'=> true,
		'link'=>'menu/layanan'
		);
	}
	
	
    function datalayanan_bayar($params){
        $result = $this->datalayanan($params);
        //print_r($result);
        if (!isset($result['biaya'])){
            $sql = "select * from layanan_sub where layananid = :layananid
                and id = :sublayananid ";
            $xresult = $this->mdb->QueryData('application', $sql, $result, 'record');
            //print_r($xresult);
            if (isset($xresult[0]['biaya'])){
                $result['biaya'] = $xresult[0]['biaya'];
            }
        }
        //print_r($result);
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
    
    function getDataLookup($fldvalue, $lookupname, $params){
        $restype='matrix';
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
            $xresult = $this->mdb->QueryData('application', $sql, $params, $restype);
            $result = $xresult['matrixdata'];
        } else {
            $result = array();
        }
        foreach($result as $item){
            if ($item[0]==$fldvalue){
                return $item[1];
            }
        }
        //$vsql = $config['sql'];
        //$qresult = $this->mdb->QueryData('application', $vsql, $params, 'record');
        return '';
        
    }
    
   public function edit_pengambilanx($lyn_id){
//       $a = array('xxx'=>100, 'bbb'=>2000, 'ccc'=>"testing");
//       echo "*******";
//       //print_r($a);
//       print_r($lyn_id);
//       echo "######"; 
//       die;
     $sql = "select data_layanan from wni_layanan where layananidhash = :lyn_id";
		$params = array('lyn_id'=>$lyn_id['lyn_id']);
		$result = $this->mdb->QueryData('application', $sql, $params, 'record');
		if (isset($result[0])){
			$lyndata = json_decode($result[0]['data_layanan'], true);
                        print_r($lyndata);
		} else {
			$lyndata = array();
		}
		return $lyndata;
    }
    
    
    public function edit_pengambilan($params){
        $result = $this->datalayanan($params);
        
        if (!isset($result['diserahkan_oleh'])){
            $sql = "select :sys_username as username";
            $xresult = $this->mdb->QueryData('application', $sql, array(), 'record');
            $result['diserahkan_oleh'] = $xresult[0]['username'];
        }
        
        return $result;
    }

    public function edit_dispatch($params){
        $vsql = "select a.taskname, a.layananid, a.sublayananid, 
            coalesce(c.nama_layanan, b.nama_layanan) as nama_layanan 
            from wni_layanan a
            left join layanan b on a.layananid = b.id
            left join layanan_sub c on a.layananid = c.layananid and a.sublayananid = c.id
            where layananidhash = :lyn_id 
            ";
        //$vparams = array('lyn_id' => $code);
        $cmd = '';
        $dres = $this->mdb->QueryData('system', $vsql, $params, 'record');
        if (isset($dres[0])){
            $this->load->model('m_workflow', 'mwflow');
            $xdata = $this->mwflow->loadConfigLayanan($dres[0]['nama_layanan']);
            if (isset($xdata['controls']['edit-user']['link'])){
                $cmd = $xdata['controls']['edit-user']['link'];
            }
        }
        
        if($cmd!==''){
            $get_param = 'lyn_id='.$params['lyn_id'];
            $redirect = $cmd.'?'.$get_param;
            $result = array('redirect'=>$redirect);
        } else {
            $result = array('message'=>'Data Layanan tidak diketemukan.');
        }
        return $result;
    }
    
    public function edit_dispatch_old($params){
        $vsql = "select taskname, layananid, sublayananid 
            from wni_layanan where layananidhash = :lyn_id ";
        $dres = $this->mdb->QueryData('application', $vsql, $params, 'record');
        if (isset($dres[0])){
            $layananid = $dres[0]['layananid'];
            $sublayananid = $dres[0]['sublayananid'];
            if ($layananid==1){
                $cmd = 'layanan_ganti_paspor';
            } else if ($layananid==2){
                $cmd = 'layanan_paspor_baru_anak';
            } else if ($layananid==3){
                $cmd = 'layanan_konversi_data';
                $sublayananid = $params['sublayananid'];
                $cmd = $this->getKonversiLink($sublayananid);
            } else if ($layananid==4){
                $cmd = 'layanan_pulang_habis';
            } else if ($layananid==5){
                $cmd = 'layanan_pindah_wn';
            } else if ($layananid==6){
                $cmd = 'layanan_lapor_meninggal';
            } else if ($layananid==7){
                $cmd = 'layanan_lapor_diri';
            } else if ($layananid==10 && $sublayananid==22){
                $cmd = 'layanan_lapor_menikah';
            } else if ($layananid==10){
                $cmd = 'layanan_konversi_ganti_nama';
            } else {
                $sublayananid = $params['sublayananid'];
                $kode = $this->get_kode_layanan($layananid, $sublayananid);
                $cmd = 'layanan_'.$kode;
            }
            if ($cmd!==''){
                $get_param = 'lyn_id='.$params['lyn_id'];
                $redirect = $cmd.'?'.$get_param;
                $result = array('redirect'=>$redirect);
            } else {
                $result = array('message'=>'Jenis Layanan tidak diketemukan.');
            }
        } else {
            $result = array('message'=>'Data Layanan tidak diketemukan.');
        }
        return $result;
        //return $params;
        
        //$url = $
        $result = array('redirect'=>'http://www.google.com');
        return $result;
        //return $params;
        //return array('testing'=>'1234xxx');
    }
    
    public function edit_dispatch_hash($code){
        $vsql = "select taskname, layananid, sublayananid 
            from wni_layanan where layananidhash = :lyn_id ";
        $vparams = array('lyn_id' => $code);
        $dres = $this->mdb->QueryData('system', $vsql, $vparams, 'record');
        if (isset($dres[0])){
            $layananid = $dres[0]['layananid'];
            $sublayananid = $dres[0]['sublayananid'];
            if ($layananid==1){
                $cmd = 'edit_layanan_ganti_paspor';
            } else if ($layananid==2){
                $cmd = 'edit_layanan_paspor_baru_anak';
            } else if ($layananid==3){
                $cmd = 'edit_layanan_konversi_data';
                $sublayananid = $dres[0]['sublayananid'];
                $cmd = $this->getKonversiLink($sublayananid);
            } else if ($layananid==4){
                $cmd = 'edit_layanan_pulang_habis';
            } else if ($layananid==5){
                $cmd = 'edit_layanan_pindah_wn';
            } else if ($layananid==6){
                $cmd = 'edit_layanan_lapor_meninggal';
            } else if ($layananid==7){
                $cmd = 'edit_layanan_lapor_diri';
            } else if ($layananid==8){
                $cmd = 'check_input_data';
            } else if ($layananid==10 && $sublayananid==22){
                $cmd = 'edit_layanan_lapor_menikah';
            } else if ($layananid==10){
                $cmd = 'edit_layanan_konversi_ganti_nama';
                //$sublayananid = $dres[0]['sublayananid'];
                //$cmd = $this->getKonversiLink($sublayananid);
            } else if ($layananid==11){
                $cmd = 'edit_layanan_kelahiran';
            } else if ($layananid==12){
                $cmd = 'edit_layanan_lapor_meninggal';
            } else if ($layananid==13){
                $cmd = 'edit_layanan_konversi_ganti_alamat';
            } else {
                $sublayananid = $dres[0]['sublayananid'];
                $kode = $this->get_kode_layanan($layananid, $sublayananid);
                $cmd = 'edit_layanan_'.$kode;
            }
            if ($cmd!==''){
                $get_param = 'lyn_id='.$code;
                $redirect = $cmd.'?'.$get_param;
                $result = array('redirect'=>$redirect);
            } else {
                $result = array('message'=>'Jenis Layanan tidak diketemukan.');
            }
        } else {
            $result = array('message'=>'Data Layanan tidak diketemukan.');
        }
        return $result;
        //return $params;
        
    }
    
    /*
[lyn_id] => 88a576c7fc3ed355d4226bbfe1dafab1
    [attachment_category] => ganti_paspor
    [undefined] => 
    [nama_layanan] => Penggantian Paspor
    [layananid] => 1
    [sublayananid] => 1
    [pemohon] => Fulan bin Fulanov
    [create_time] => 31-03-2016 09:03
    [paspor_nomor] => 12345
    [paspor_noreg] => 88990000
    [paspor_tpt_keluar] => 
    [paspor_tgl_keluar] => 
    [paspor_berlaku] => 
     * 
     *      
     */
    
    function stripParams($data, $list){
        foreach($list as $item){
            if (isset($data[$item])){
                unset($data[$item]);
            }
        }
        return $data;
    }
    
    function filterParams($data, $list){
        $result = array();
        foreach($list as $item){
            if (isset($data[$item])){
                $result[$item] = $data[$item];
            }
        }
        return $result;
    }
    
    function selectedMerge($data, $update, $list){
        foreach($list as $item){
            if (isset($update[$item])){
                $data[$item] = $update[$item];
            }
        }
        return $data;
    }
    function doSaveData($sysparams, $dataparams){
        $vsql = "select * from wni_layanan where layananidhash = :lyn_id";
        $vdata = $this->mdb->QueryData('application', $vsql, $sysparams, 'record');
        if (isset($vdata[0])){
            $xdata = json_decode($vdata[0]['data_layanan'], true);
			if (!$xdata){
				$xdata = array();
			}
            $xdataparams = array_merge($xdata, $dataparams);
            // yang di dalam dataparams kosong, di xdataparams dibuang
            foreach($dataparams as $xkey=>$xvalue){
                if($xvalue===''){
                    if (isset($xdataparams[$xkey])){
                        unset($xdataparams[$xkey]);
                    }
                }
            }
            $list = array('wniid', 'sublayananid', 'taskname', 'statusname', 
                'description', 'catatan', 'catatan_status', 'catatan2');
            $vxdata = $vdata[0];
            $vxdata = $this->selectedMerge($vxdata, $sysparams, $list);
            $vxdata['data_layanan'] = json_encode($xdataparams);
            $vxdata['lyn_id'] = $sysparams['lyn_id'];
			//echo "<pre>";
			//print_r($vxdata);
			//echo "</pre>";
			//die();
            $xsql = "update wni_layanan 
                set wniid = :wniid, 
                sublayananid = :sublayananid,
                taskname = :taskname, statusname = :statusname,
                last_username = :sys_username,
                last_update = now(),
                description = :description, catatan = :catatan, catatan2 = :catatan2,
                data_layanan = :data_layanan
                where layananidhash = :lyn_id;
            ";
            $this->mdb->ExecSQL('application', $xsql, $vxdata);
            
        }
    }

public function update_final($params){
  $sql="update wni_layanan set statusname = 'final', taskname='final' where layananidhash=:lyn_id";
  $this->mdb->ExecSQL('application', $sql, $params);

}	
 
 public function save_pengambilan($params){
 //print_r($params); die();
        $xlist = array('lyn_id', 'attachment_category', 
            'undefined', 'layananid', 'sublayananid');
        $dataparams = $this->stripParams($params, $xlist);
        $sysparams = $this->filterParams($params, $xlist);
		//
		$datalayanan=$this->datalayanan($params);
		//print_r($datalayanan);die();
		//cek layanan terpilih 1= penggantian paspor
		if($datalayanan['layananid']==1){
			$this->doSaveData($sysparams, $dataparams);
			$this->update_final($params);
			$this->saveDataToWNI($params);
			return array('success'=>1);
		//cek layanan terpilih 2= paspor baru anak	
		}else if($datalayanan['layananid']==2){
			//cek apakah di field json data layanan ada wni_anak_id
			if(empty( $datalayanan['wni_anak_id'])){
				$this->insertDataAnakToWNI($this->datalayanan($params));
				return array(
					'success'=>1,
					'islink'=> true,
					'link'=>'menu/layanan'
				    );
			}else{
				 $oldWniData=$this->getOldWniData($datalayanan);
				//print_r($oldWniData);
				$datahistory=array(
				'nama_pengambil'=>getArrayDef($datalayanan,'nama_pengambil'),
				'tanggal_ambil'=>getArrayDef($datalayanan,'tanggal_ambil'),
				'wniid'=>getArrayDef($datalayanan,'wniid'),
				'pbaru_nomor'=>getArrayDef($datalayanan,'pbaru_nomor'),
				'diserahkan_oleh'=>getArrayDef($datalayanan,'diserahkan_oleh')
	             );
				$this->saveDataHistory("ganti paspor",json_encode($oldWniData));
				
				$this->updateDataAnakToWNI($this->datalayanan($params));
				return array(
					'success'=>1,
					'islink'=> true,
					'link'=>'menu/layanan'
				    );
			}
			
		}
    }
	
	public function updateDataAnakToWNI($params){
		 $sql="update wni 
					set nama_lengkap=:anak_nama_lengkap,
					tempat_lahir=:anak_tempat_lahir,
					tanggal_lahir=:anak_tanggal_lahir,
					jenkelid=:anak_jenis_kelamin,
					statuskawinid=:status_sipil,
					nomor_paspor=:pbaru_nomor,
					tempat_pengeluaran=:pbaru_tpt_keluar,
					tanggal_pembuatan=:pbaru_tgl_keluar,
					tanggal_habis_berlaku=:pbaru_berlaku
					";
		 $this->mdb->ExecSQL('application', $sql, $params);
	}
	
	public function insertDataAnakToWNI($params){
		 $sql="insert into wni (
		                        nama_lengkap,tempat_lahir,
		                        tanggal_lahir,email,
								jenkelid,statuskawinid,
								nomor_paspor,tempat_pengeluaran,
								tanggal_pembuatan,tanggal_habis_berlaku
								) 
								values 
								(
								:anak_nama_lengkap,:anak_tempat_lahir,
								:anak_tanggal_lahir,:email,
								:anak_jenis_kelamin,:status_sipil,
								:pbaru_nomor,:pbaru_tpt_keluar,
								:pbaru_tgl_keluar,:pbaru_berlaku)";
		 $this->mdb->ExecSQL('application', $sql, $params);
		 	
	}
	public function getOldWniData($params){
		$sql="select :layananidhash as layananidhash,a.nomor_paspor,a.tempat_pengeluaran,to_char(a.tanggal_pembuatan,'dd-mm-yyyy')as tanggal_pembuatan,to_char(a.tanggal_habis_berlaku,'dd-mm-yyyy')as tanggal_habis_berlaku from wni a where a.id=:wniid";
		$result = $this->mdb->QueryData('application', $sql, $params, 'record');
		return $result[0];
	}
    function saveDataToWNI($params){
         // baca dari data layanan berdasarkan lyn_id
         // pilih data apa saja yang akan disimpan ke history dan disimpan ke data wni
         // simpan data ke history 
         // update data ke data WNI
     $datalayanan=$this->datalayanan($params);
	 $data=array('pbaru_nomor'=>getArrayDef($datalayanan,'pbaru_nomor'),
	             'pbaru_tpt_keluar'=>getArrayDef($datalayanan,'pbaru_tpt_keluar'),
			     'wniid'=>getArrayDef($datalayanan,'wniid'),
			     'pbaru_tgl_keluar'=>getArrayDef($datalayanan,'pbaru_tgl_keluar'),
				 'pbaru_berlaku'   =>getArrayDef($datalayanan,'pbaru_berlaku')
	             );
	//print_r($datalayanan);
	 $oldWniData=$this->getOldWniData($datalayanan);
	//print_r($oldWniData);
     $datahistory=array(
				'nama_pengambil'=>getArrayDef($datalayanan,'nama_pengambil'),
				'tanggal_ambil'=>getArrayDef($datalayanan,'tanggal_ambil'),
				'wniid'=>getArrayDef($datalayanan,'wniid'),
				'pbaru_nomor'=>getArrayDef($datalayanan,'pbaru_nomor'),
				'diserahkan_oleh'=>getArrayDef($datalayanan,'diserahkan_oleh')
	             );
		$this->saveDataHistory("ganti paspor",json_encode($oldWniData));
        //update data ke data WNI
		$this->updateDataWNI($data);
    }
    function saveDataHistory($kategori, $data){
        $datahistory=array("kategori"=>$kategori,
						   "json_history"=>$data
		                   );
		
        // kategori
        // history_time <-- diisi dengan now()
        // data_history <-- json
        // update_user
		 $sql="insert into app_history(category,history_time,data_history,update_user)values(:kategori,now(),:json_history,:sys_username);";
		 $this->mdb->ExecSQL('application', $sql,$datahistory);
		
    }
    
    function updateDataWNI($data){
	   //print_r($data);
       $sql="update wni 
	     set nomor_paspor=:pbaru_nomor,
	     tempat_pengeluaran=:pbaru_tpt_keluar,
	     tanggal_pembuatan = to_date(:pbaru_tgl_keluar, 'dd-mm-yyyy'),
		 tanggal_habis_berlaku = to_date(:pbaru_berlaku, 'dd-mm-yyyy')
	   where id= CAST (:wniid AS INTEGER)";
	   $this->mdb->ExecSQL('application', $sql,$data);
    }
	public function edit_closing($params){
		  $result = $this->datalayanan($params);
        
        if (!isset($result['diserahkan_oleh'])){
            $sql = "select :sys_username as username";
            $xresult = $this->mdb->QueryData('application', $sql, array(), 'record');
            $result['diserahkan_oleh'] = $xresult[0]['username'];
        }
        
        return $result;
	}
	
    public function close_layanan($params){
		$sql="update wni_layanan set statusname =
		(
		select 
		case 
		when taskname='final'
		then
		'final'
		when taskname <> 'final'
		then
		'close'
		end
		 )
		 where 
		layananidhash =:lyn_id
		";
		$this->mdb->ExecSQL('application', $sql,$params);
		return array('success'=>1);
	}
        
    public function save_data_wni($params){
        $value = json_encode($params);
        $sysparams = array('data_wni'=>$value);
        $vsql = "select 0;
                insert into app_wni (hashid, data_wni) values (md5('app_wni'||:sys_hashkey||cast(currval('app_wni_id_seq') as character varying)), :data_wni);
                select hashid from app_wni where id = currval('app_wni_id_seq');";
        $vdata = $this->mdb->QueryData('application', $vsql, $sysparams, 'record');
//        echo json_encode($vdata[0]['hashid']);die;
        return array('success'=>1,'islink'=>1,'link'=>'menu/wni_edit?hashid='.$vdata[0]['hashid']);
    }
	
    public function save_data($params){
        $xlist = array('lyn_id', 'attachment_category', 
            'taskname', 'layananid', 'sublayananid');
        $dataparams = $this->stripParams($params, $xlist);
        $sysparams = $this->filterParams($params, $xlist);
        $this->doSaveData($sysparams, $dataparams);
//        print_r($params);
//        print_r($dataparams);
//        print_r($sysparams);
        return array('success'=>1);
    }
	
    public function save_personal_meninggal($params){
        $xlist = array('lyn_id', 'attachment_category', 
            'undefined', 'layananid', 'sublayananid');
        $dataparams = $this->stripParams($params, $xlist);
        $sysparams = $this->filterParams($params, $xlist);
        $this->doSaveData($sysparams, $dataparams);
            $xsql = "update wni_layanan 
                set taskname = 'check-cekal'
                where layananidhash = :lyn_id;
            ";
            $this->mdb->ExecSQL('application', $xsql, $params);
        return array('success'=>1,'islink'=>1,'link'=>'menu/layanan');
    }

    function doSaveDataReg($sysparams, $dataparams, $datawni) {
        $vsql = "select * from wni_layanan where layananidhash = :lyn_id";
        $vdata = $this->mdb->QueryData('application', $vsql, $sysparams, 'record');
        if (isset($vdata[0])) {
            $xdata = json_decode($vdata[0]['data_layanan'], true);
            if (!$xdata) {
                $xdata = array();
            }
            $xdataparams = array_merge($xdata, $dataparams);
            $list = array('wniid', 'sublayananid', 'taskname', 'statusname',
                'description', 'catatan', 'catatan_status', 'catatan2');
            $vxdata = $vdata[0];
            $vxdata = $this->selectedMerge($vxdata, $sysparams, $list);
            $vxdata['data_layanan'] = json_encode($xdataparams);
            foreach ($datawni as $key => $value) {
                $vxdata[$key] = $value;
            }
            $vxdata['lyn_id'] = $sysparams['lyn_id'];
//            echo json_encode($vxdata);die;
            if ($sysparams['layananid'] == 8) {
                if ($vxdata['wniid']==NULL) {
                    $xsql = "
                            insert into wni (" . $this->arrayDataComafield($datawni) . ") values (" . $this->arrayDataComaVal($datawni) . ");
                            insert into wni_user_link (userid, wniid) values ((select userid from sys_users where username=:email),currval('wni_id_seq'));

                            update wni_layanan 
                            set wniid = currval('wni_id_seq'), 
                            taskname = ( select taskname from app_status_layanan
                            where updatename='lolos-cekal' and layananid =:layananid ), 
                            statusname = :statusname,
                            last_username = :sys_username,
                            last_update = now(),
                            description = :description, catatan = :catatan, catatan2 = :catatan2,
                            data_layanan = :data_layanan
                            where layananidhash = :lyn_id;

                            update sys_users set isverified=1 where username=:email;
                    ";
                    $this->mdb->ExecSQL('application', $xsql, $vxdata);
                }else{
                    $xsql = "
                            insert into wni_user_link (userid, wniid) values ((select userid from sys_users where username=:email),:wniid);

                            update wni_layanan 
                            set wniid = :wniid, 
                            taskname = ( select taskname from app_status_layanan
                            where updatename='lolos-cekal' and layananid =:layananid ), 
                            statusname = :statusname,
                            last_username = :sys_username,
                            last_update = now(),
                            description = :description, catatan = :catatan, catatan2 = :catatan2,
                            data_layanan = :data_layanan
                            where layananidhash = :lyn_id;

                            update sys_users set isverified=1 where username=:email;
                    ";
                    $this->mdb->ExecSQL('application', $xsql, $vxdata);
                }
            } else {
                $xsql = "
                update wni_layanan 
                set wniid = :wniid, 
                taskname = ( select taskname from app_status_layanan
                where updatename='lolos-cekal' and layananid =:layananid ), 
                statusname = :statusname,
                last_username = :sys_username,
                last_update = now(),
                description = :description, catatan = :catatan, catatan2 = :catatan2,
                data_layanan = :data_layanan
                where layananidhash = :lyn_id;
            ";
                $this->mdb->ExecSQL('application', $xsql, $vxdata);
            }
        }
    }

    function arrayDataComafield($param) {
        $keys = array_keys($param);
        $arraySize = count($param);
        $t = '';
        for ($i = 0; $i < $arraySize; $i++) {
            $t .= $keys[$i];
            if ($i < ($arraySize - 1)) {
                $t .= ', ';
            }
        }
        return $t;
    }

    function arrayDataComaVal($param) {
        $keys = array_keys($param);
        $arraySize = count($param);
        $t = '';
        for ($i = 0; $i < $arraySize; $i++) {
            $t .= "'".$param[$keys[$i]]."'";
            if ($i < ($arraySize - 1)) {
                $t .= ', ';
            }
        }
        return $t;
    }

    public function save_data_reg($params) {
        $xlist = array('lyn_id', 'attachment_category',
            'undefined', 'layananid', 'sublayananid');
        $list = array(
            'nama_lengkap', 'tempat_lahir', 'tanggal_lahir', 'agamaid', 'email', 'jenkelid', 'statuskawinid', 'jenispasporid', 'pekerjaan', 
            'pekerjaan_asli', 'telp_rumah', 'telp_hp', 'alamat', 'kodepos', 'provinsi', 'nomor_file', 'negara', 'keterangan', 'nomor_paspor', 
            'tempat_pengeluaran', 'tanggal_pembuatan', 'tanggal_habis_berlaku', 'nomor_id', 'tanggal_pembuatan_id', 'tanggal_habis_berlaku_id', 
            'dikeluarkan_oleh', 'nama_instansi', 'alamat_instansi', 'kota_instansi', 'kodepos_instansi', 'provinsi_instansi', 'negara_instansi', 
            'alamat_id', 'kota_kab_id', 'provinsi_id', 'kodepos_id', 'telp_id', 'jenis_cacat', 'punya_hak_pilih', 'tanggal_pulang', 'tanggal_tiba',
            'tanggal_lapor', 'dwi_warganegara', 'menjadi_wna', 'meninggalkan_belgia', 'jenis_instansi', 'attachment', 'kota', 'statusijintinggalid'
        );
        $sysparams = $this->filterParams($params, $xlist);
        $dataparams = $this->stripParams($params, $xlist);
        $sql = "select a.sublayananid, a.layananid, a.layananidhash as lyn_id, b.full_name as nama_lengkap, b.birth_city as tempat_lahir, 
                b.birth_date as tanggal_lahir, b.agamaid, b.email, b.jenkelid, b.statuskawinid, b.jenispasporid, b.pkjaan_nama as pekerjaan, 
                b.paspor_nomor, b.paspor_tpt_keluar as tempat_pengeluaran, b.paspor_tgl_keluar as tanggal_pembuatan, b.paspor_berlaku as tanggal_habis_berlaku, 
                b.pengenal_nomor as nomor_id, b.pengenal_berlaku as tanggal_habis_berlaku_id, b.aluar_alamat as alamat, b.aluar_kodepos as kodepos, 
                b.aluar_telepon as telp_rumah, b.aluar_hp as telp_hp, b.aindo_alamat as alamat_id, b.aindo_kota as aindo_kota, b.aindo_kodepos as kodepos_id, 
                b.aindo_telepon as telp_id, b.pasangan_nama as nama_pasangan, b.pasangan_wn as warganegara, b.aluar_provinsi as provinsi, 
                b.aluar_negara as negara, b.pengenal_tgl_keluar as tanggal_pembuatan_id, b.pengenal_tpt_keluar as dikeluarkan_oleh, b.aindo_provinsi as provinsi_id,
                b.ll_jenis_cacat as jenis_cacat, b.ll_hak_pilih as punya_hak_pilih, b.pkjaan_provinsi as provinsi_instansi, b.pkjaan_negara as negara_instansi,
                b.pkjaan_telepon as telp_kantor, b.pasangan_hubungan as hubungan, b.ll_dwi_wn as dwi_warganegara
                from wni_layanan a 
                left join app_registration b on b.id=a.regid 
                where a.layananidhash=:lyn_id;";
        $vdata = $this->mdb->QueryData('application', $sql, $sysparams, 'record');
        $datawni = $this->filterParams($vdata[0], $list);
        $this->doSaveDataReg($sysparams, $dataparams, $datawni);
        // $sql = "
        //     update wni_layanan set statusname = 'final'
        //     where layananidhash=:lyn_id and layananid = 8;
        // ";
        // $this->mdb->ExecSQL('application', $sql, $params);
        return array('success' => 1, 'islink'=>true, 'link'=>'menu/layanan');
    }

    public function gagal_cetak($params){
        $xlist = array('lyn_id', 'attachment_category', 
            'undefined', 'layananid', 'sublayananid');
        $dataparams = array('pbaru_nomor'=>'');
        $sysparams = $this->filterParams($params, $xlist);
        $this->doSaveData($sysparams, $dataparams);
        $sql = "update app_nomor_paspor
              set status = 2,
              wni_layanan_id = (select id from wni_layanan where layananidhash = :lyn_id)
            where no_paspor = :pbaru_nomor;
            ";
        $this->mdb->ExecSQL('application', $sql, $params);
//        print_r($params);
//        print_r($dataparams);
//        print_r($sysparams);
        return array('success'=>1);
    }

    public function gagal_cetak_splp($params){
        $xlist = array('lyn_id', 'attachment_category', 
            'undefined', 'layananid', 'sublayananid');
        $dataparams = array('splp_nomor'=>'');
        $sysparams = $this->filterParams($params, $xlist);
        $this->doSaveData($sysparams, $dataparams);
        $sql = "update app_nomor_splp
              set status = 2,
              wni_layanan_id = (select id from wni_layanan where layananidhash = :lyn_id)
            where no_splp = :splp_nomor;
            ";
        $this->mdb->ExecSQL('application', $sql, $params);
//        print_r($params);
//        print_r($dataparams);
//        print_r($sysparams);
        return array('success'=>1);
    }
    
    
    function getKonversiLink($sublayananid){
        if ($sublayananid==10){
            $link = 'edit_layanan_konversi_ganti_nama';
        } else if ($sublayananid==11){
            $link = 'edit_layanan_konversi_ganti_nama';
        } else if ($sublayananid==12){
            $link = 'edit_layanan_konversi_ganti_alamat';
        } else if ($sublayananid==13){
            $link = 'edit_layanan_konversi_ganti_stat_pekejaan';
        } else {
            $link = 'edit_layanan_konversi_gabung';
        }
        return $link;
    }
    public function new_konversi_data($params){
        $vsql = "select 0;
            insert into wni_layanan(layananid, sublayananid, username, taskname, statusname, wniid)
            values (:layananid, :sublayananid, :sys_username, 'permohonan', 'draft', 
              (select max(b.wniid) from sys_users a join wni_user_link b on a.userid = b.userid where a.username = :sys_username))
            ;
            update wni_layanan set layananidhash = md5(:sys_hashkey||cast(currval('wni_layanan_id_seq') as character varying))
            where id = currval('wni_layanan_id_seq')
            ;
            select layananidhash as lyn_id 
            from wni_layanan 
            where id = currval('wni_layanan_id_seq')
            ;
        ";
        $dbresult = $this->mdb->QueryData('application', $vsql, $params, 'record');
        if (isset($dbresult[0])){
            $xparam = 'lyn_id='.$dbresult[0]['lyn_id'];
            $result = array('success'=>1, 'paramdata'=>$dbresult[0]);
            $sublayananid = $params['sublayananid'];
            $link=$this->getKonversiLink($sublayananid);
            $result['islink'] = 1;
            $result['link'] = 'menu/'.$link;
            $result['params'] = $xparam;
        } else {
            $result = array('success'=>0, 'message'=>'Problem save data.');
        }
        return $result;
    }

    function jenis_layanan($id) {
        $param = array('id' => $id);
        $sql = "select updatename, taskname from app_status_layanan
            where layananid = :id and kode=1 
            ";
        $qresult = $this->mdb->QueryData('application', $sql, $param, 'record');
        return $qresult;
    }
    
    function getfoto($lyn_id){
		
		$datalayanan=$this->datalayanan(array("lyn_id"=>$lyn_id));
		//echo "<pre>";
		   //print_r($datalayanan);
		//echo "</pre>";
		//die();
        $basefolder = $this->ci->config->item('filefolder');
        $default_filename = $basefolder.'blank-photo.png';
		$type=0;
		if($datalayanan["layananid"]==2){
		$type=8;
		}else if($datalayanan["layananid"]==11){
		$type=8;
		}
		else if($datalayanan["layananid"]==1){
		$type=3;
		}
		else if($datalayanan["layananid"]==12){
		$type=9;
		}else{
		$type=3;
		}
	
		 $sql = "select a.id, a.layananidhash, b.fileid, c.*
            from wni_layanan a 
            join wni_layanan_attch b on a.id = b.wni_layanan_id
            left join sys_files c on b.fileid = c.id
            where a.layananidhash = :lyn_id
            and b.attch_type_id = :type
            order by b.id desc
        ";
		
		
        $params = array('lyn_id'=>$lyn_id, 'type'=>$type);
        $result = array();
        $qresult = $this->mdb->QueryData('application', $sql, $params, 'record');
	   
        if (isset($qresult[0])){
            $path = $qresult[0]['filepath'];
            $filename = $this->ci->config->item('filefolder').$path;
            $result['name'] = $qresult[0]['name'];
            $result['type'] = $qresult[0]['type'];
            if (file_exists($filename)){
                $result['filename'] = $filename;
            } else {
			
                if (file_exists($default_filename)){
				
                    $result['filename'] = $default_filename;
                } else {
                    $result['filename'] = '';
                }
            }
        } else {
            $result['type'] = 'image/png';
            $result['name'] = 'nofile.png';
            if (file_exists($default_filename)){
                $result['filename'] = $default_filename;
            } else {
                $result['filename'] = '';
            }
        }
		          // print_r($result); die();
        return $result;
		
    }
    
    function nameReverse($fullname){
        $xnamelist = explode(' ', $fullname);
        $namelist = array();
        foreach($xnamelist as $item){
            if(trim($item)!==''){
                array_push($namelist, trim($item));
            }
        }
        $vcount = count($namelist);
        if ($vcount>1){
            $result = $namelist[$vcount-1];
            $varr2 = array_slice($namelist, 0, $vcount-1, true);
            $result = $result.'<';
            foreach($varr2 as $item){
                $result = $result.'<'.$item;
            }
        } else if ($vcount==1){
            $result = $namelist[0];
        } else {
            $result = '';
        }
        return $result;
    }
    
    
    function checksum($data){
        
        $arrnum = array();
        for($i=0; $i<=9; $i++){
            $arrnum[chr(48+$i)] = $i;
        }
        for($i=0; $i<=25; $i++){
            $arrnum[chr(65+$i)] = $i+10;
        }
        $arrnum['<'] = 0;
        
        $arrdata = str_split($data);
        $result = 0;
        $mode = 1;
        
        foreach($arrdata as $item){
            if ($mode==1){
                $result = $result + 7*getArrayDef($arrnum, $item, 0);
            } else if ($mode==2) {
                $result = $result + 3*getArrayDef($arrnum, $item, 0);
            } else {
                $result = $result + getArrayDef($arrnum, $item, 0);
            }
            $mode = $mode+1;
            if ($mode>3) {
                $mode=1;
            }
        }
        $xresult = $result % 10;
        return $xresult;
    }

    function test_mrz(){
        //echo date('Y-M-d', strtotime('01-02-2013')); die;
        
        //$this->checksum('W323283<<');
        $fullname = 'HATAMI NUGRAHA';
        $nopaspor = 'W323283';
        $gender = 1;
        $vlahir = '16-03-1980';
        $vberlaku = '14-12-2015';
        $result = $this->calcmrzone($fullname, 'P', $nopaspor, 'IDN', $gender,
            $vlahir, $vberlaku);
        //echo $this->nameReverse($fullname);
    }
    
    
    
    function calcmrzone($fullname, $tipe, $nopaspor, $countryid, $gender, $vlahir, $vberlaku){
        if (($gender==1) or ($gender=='L') or ($gender=='M') or (strtolower($gender)=='laki-laki')){
            $xgender = 'M';
        } else {
            $xgender = 'F';
        }
        $fullname = strtoupper($fullname);
        $resname = $this->nameReverse($fullname);
        
        $len = 39-strlen($resname);
        if ($len<0){
            $len =0;
        }
        $res_line1 = $tipe.'<'.$countryid.$resname.str_repeat('<', $len);
        
        $nopaspor = strtoupper($nopaspor);
        if (strlen($nopaspor)>9){
            $res_line2 = $nopaspor;
        } else {
            $res_line2 = $nopaspor.str_repeat('<',9-strlen($nopaspor));
        }
        $res_line2 = $res_line2.$this->checksum($res_line2);
        $xline2 = $res_line2;
                
        $xlahir = date('ymd', strtotime($vlahir));
        $xberlaku = date('ymd', strtotime($vberlaku));
        $res_line2 = $res_line2.$countryid.$xlahir.$this->checksum($xlahir).
            $xgender.$xberlaku.$this->checksum($xberlaku).
            str_repeat('<', 14).$this->checksum(str_repeat('<', 14));
        $xline2 = $xline2.$xlahir.$this->checksum($xlahir).
            $xgender.$xberlaku.$this->checksum($xberlaku).
            str_repeat('<', 14).$this->checksum(str_repeat('<', 14));
        $res_line2 = $res_line2.$this->checksum($xline2);
        $result = array();
        $result[0] = $res_line1;
        $result[1] = $res_line2;
        //print_r($result);
        return $result;
    }
    
    function dispatch_cek_cekal($lyn_id, $isadmin){
        $sql = "select layananid, sublayananid from wni_layanan where layananidhash = :lyn_id";
        $qres = $this->mdb->QueryData('application', $sql, array('lyn_id'=>$lyn_id), 'record');
        if (!isset($qres[0]['layananid'])){
            if ($isadmin){
                return 'layanan'.'?lyn_id='.$lyn_id;
            } else {
                return 'layanan_wni'.'?lyn_id='.$lyn_id;
            }
        } else {
            if ($qres[0]['layananid']==8){
                return 'check_cekal_reg'.'?lyn_id='.$lyn_id;
            } else {
                return 'check_cekal'.'?lyn_id='.$lyn_id;
            }
        }
    }
        
    function getTableFields($tablename, $schemaname='public'){
        $sql = "
            SELECT column_name, data_type
            FROM information_schema.columns
            WHERE table_schema = :schemaname
            AND table_name = :tablename
       ";
       $params = array('schemaname'=>$schemaname, 'tablename'=>$tablename);
       $qres = $this->mdb->QueryData('application', $sql, $params, 'record');
       return $qres;
    }
    
    function getSqlFieldsByTable($tbname){
        $fdlist = $this->getTableFields($tbname);
        $result = '';
        $last = '';
        if (is_array($fdlist)){
            foreach($fdlist as $field){
                if($last!==''){
                    $last = $last.', '; 
                }
                if($field['data_type']=='date'){
                    $xfield = "to_char(".$field['column_name'].", 'DD-MM-YYYY') as ".$field['column_name'];
                } else {
                    $xfield = $field['column_name'];
                }
                if (strlen($last.$xfield)>80){
                    $result = $result."\r\n".$last;
                    $last = '';
                }
                $last = $last.$xfield;
            }
            if ($last!==''){
                $result = $result."\r\n".$last;
            }
        }
        return $result;
    }
    /*
	public function getDataRegistration($params){
		$sql = "select a.*,b.wniid from app_registration a left join wni_layanan b on a.id=b.regid where b.layananidhash=:lyn_id";
        $result = $this->mdb->QueryData('application', $sql, $params, 'record');
		//print_r($result[0]); die();
		return $result[0];
	}
	
	
	
    public function updateAlamatToAppWNI($params){
		$dataregistration=$this->getDataRegistration($params);
		print_r($dataregistration); die();
		//$data_app_wni= $this->get_data_app_wni($dataregistration['wniid']);
		//print_r();die();
		$xparams=array(
		  "wniid"=>$dataregistration['wniid'],
		  "data_wni"=>"",
		);
		$sql="update app_wni set data_wni=:data_wni";
		$this->mdb->ExecSQL('application', $sql, $xparams);
		//print_r($dataregistration); die();
	}   
   */	
	public function get_wni_layanan_attach($params){
		$sql = "select a.* from wni_layanan_attch a where a.wni_layanan_id=:wnilynid";
        $result = $this->mdb->QueryData('application', $sql, $params, 'record');
		
		return $result[0];
		
	}
    function updateLolosCekal($params){
	$datalayanan=$this->datalayanan($params);
	//mengambil data dari app_wni_layanan attach
	//$data_wni_layanan_attach=$this->get_wni_layanan_attach(array("wnilynid"=>$datalayanan['id']));
        $sql = "select wniid, regid, cekal_id from wni_layanan where layananidhash = :lyn_id";
        $qres = $this->mdb->QueryData('application', $sql, array('lyn_id'=>$params['lyn_id']), 'record');
        if (isset($qres[0]['regid'])){
            $wniid = $qres[0]['wniid'];
            $regfields = $this->getSqlFieldsByTable('app_registration');
            $sql = "select ".$regfields." from app_registration where id = :regid";
            $qres = $this->mdb->QueryData('application', $sql, array('regid'=>$qres[0]['regid']), 'record');
            if (isset($qres[0])){
                $username = $qres[0]['email'];
                $striplist = array('id', 'gender', 'password', 'pwd_key');
                $xdata = $this->stripParams($qres[0], $striplist);
                $xwnidata = array();
                foreach($xdata as $key=>$value){
                    if ($value){
                        $xwnidata[$key] = $value;
                    }
                }
                if($wniid){
                    // update
                    $sql = "select id, data_wni from app_wni where id = :wniid";
                    $qres = $this->mdb->QueryData('application', $sql, array('wniid'=>$wniid), 'record');
                    if (isset($qres[0])){
                        $xdata = json_decode($qres[0]['data_wni'], true);
                        if (!is_array($xdata)){
                            throw new Exception('Gagal mengupdate data WNI.');
                        }
                        $xdata_wni = array_merge($xdata, $xwnidata);
                        $data_wni = json_encode($xdata_wni);
                        $sql = "
                            update app_wni set data_wni = :data_wni
                            where id = :wniid;
                            delete from wni_user_link where userid = (select userid from sys_users where username=:username);
                            insert into wni_user_link (userid, wniid) values 
                            ((select userid from sys_users where username=:username),:wniid);
                            
                            update wni_layanan set taskname = 'verified-wni'
                            where layananidhash = :lyn_id;
                            update sys_users set isverified = 1 where username = :username;
                        ";
                        $params = array('data_wni'=>$data_wni, 'username'=>$username, 'lyn_id'=>$params['lyn_id'],
                            'wniid'=>$wniid);
                        $this->mdb->ExecSQL('application', $sql, $params);
                    } else {
                        throw new Exception('Data Wni tidak diketemukan.');
                    }
                    return array('success' => 1, 'islink'=>true, 'link'=>'menu/layanan');
                } else {
                    // insert
					//$xwnidata= array_merge($xwnidata,array("aluar_alamat"=>$qres[0]['aluar_alamat']));
                    $data_wni = json_encode($xwnidata);
                    $sql = "
                        insert into app_wni(data_wni) values(:data_wni);
                        delete from wni_user_link where userid = (select userid from sys_users where username=:username);
                        insert into wni_user_link (userid, wniid) values 
                        ((select userid from sys_users where username=:username),currval('app_wni_id_seq'));
                        
                        update app_wni set hashid = md5('app_wni'||:sys_hashkey||cast(currval('app_wni_id_seq') as character varying))
                        where id = currval('app_wni_id_seq');
                        
                        update wni_layanan set taskname = 'verified-wni'
                        where layananidhash = :lyn_id;
                        update sys_users set isverified = 1 where username = :username;
														
						insert into app_wni_attch 
						(
							attch_type_id,
							wni_layanan_id,
							fileid,
							hashid,
							last_update,
							wniid,
							nama_layanan
						)
							select 
							  attch_type_id,
							  wni_layanan_id,
							  fileid,
							  hashid,
							  last_update,
							  currval('app_wni_id_seq'),
							  :nama_layanan
							from wni_layanan_attch 
							where wni_layanan_id= :wnilynid;
						";
					//print_r($data_wni_layanan_attach); die();
                    $params = array('data_wni'      =>$data_wni, 
					                'username'      =>$username, 
									'lyn_id'        =>$params['lyn_id'],
									'nama_layanan'  =>$datalayanan['nama_layanan'],
									'wnilynid'      =>$datalayanan['id'], 
									);
                    $this->mdb->ExecSQL('application', $sql, $params);
                    return array('success' => 1, 'islink'=>true, 'link'=>'menu/layanan');
                } 
                
            }
        }
		
        return array('success'=>0, 'message'=>'Gagal mengupdate data Lolos Cekal.');  
    }
    
    public function do_registrasi_verified($params){
        $this->updateLolosCekal($params);

        //$params['data'] = 'Registrasi verified anda selesai.';
        //$params['subject'] = 'Data EKBRI WNI Verified';

        $xlayanan = $this->datalayanan($params);
        //print_r($xlayanan);
        $qresult = array_merge($xlayanan, $params);
        $params['data'] = $this->load->view('email/v_registrasi', array('data'=>$qresult), true);
        $params['subject'] = 'Registrasi EKBRI anda sudah disetujui.';

        $this->save_email($params);

        return array('success' => 1, 'islink'=>true,'link'=>'menu/layanan');
    }
    
    public function do_pengambilan($params){
        //$params['data'] = 'data anda sudah diambil, terimakasih.';
        //$params['subject'] = 'Data EKBRI pengambilan';

        $xlayanan = $this->datalayanan($params);
        //print_r($xlayanan);
        $qresult = array_merge($xlayanan, $params);
        $params['data'] = $this->load->view('email/v_pengambilan', array('data'=>$qresult), true);
        $params['subject'] = 'Hasil layanan '.getArrayDef($qresult, 'layananidstr').' sudah diambil.';

        $this->save_email($params);

        return array('success' => 1, 'islink'=>true,'link'=>'menu/layanan');
    }
    
    public function do_siap_ambil($params){
        $sql="update wni_layanan set taskname = 'siap-ambil', 
                catatan2 ='', 
                statusname='proses' 
                where layananidhash = :lyn_id;
                ";
        $this->mdb->ExecSQL('application', $sql, $params);
        
        
    //     $sqls = "select 
    //             b.nama as nama_layanan
    //           from wni_layanan a 
    //           left join layanan b on a.layananid = b.id
    //           where a.statusname in ('start', 'proses') and a.layananidhash = :lyn_id;
	// ";
    //     $qresult = $this->mdb->QueryData('application', $sqls, $params, 'record');
    //     $params['data'] = 'hasil pencetakan untuk '.$qresult[0]["nama_layanan"].' sudah siap diambil, silahkan datang ke KBRI untuk melakukan pengambilan.';
    //     $params['subject'] = 'Data EKBRI Siap Ambil';

        $xlayanan = $this->datalayanan($params);
        $qresult = array_merge($xlayanan, $params);
        $params['data'] = $this->load->view('email/v_siap_ambil', array('data'=>$qresult), true);
        $params['subject'] = 'Hasil layanan '.getArrayDef($qresult, 'layananidstr').' siap diambil';

        $this->save_email($params);

        return array('success' => 1, 'islink'=>true,'link'=>'menu/layanan');
    }
    
    function wrapEmail($data){
        $xdata = array('content'=>$data);
        $email = $this->load->view('email/vshell', $xdata, true);
        return $email; 
    }

    function save_email($params) {
       
        $sqle = "select cast(a.data_wni as json)->>'email' as email
                 from app_wni a left join wni_layanan b on b.wniid=a.id
              where b.layananidhash = :lyn_id;
	";
        $qresule = $this->mdb->QueryData('application', $sqle, $params, 'record');
        if(isset($params['data'])){
            $params['data'] = $this->wrapEmail($params['data']);
        }
        if ($this->getdata_td($params, 'email')!=NULL) {
            $sql="Insert into app_email(email, kategori, subkategori, sourceid, data, subject, status)
                    values(:email, 'layanan', :nama_layanan, :id, :data, :subject, 0);";
            $this->mdb->ExecSQL('application', $sql, $params);
        }  elseif ($qresule[0]['email']!=NULL) {
            $params['email'] = $qresule[0]['email'];
            $sql="Insert into app_email(email, kategori, subkategori, sourceid, data, subject, status)
                    values(:email, 'layanan', :nama_layanan, :id, :data, :subject, 0);";
            $this->mdb->ExecSQL('application', $sql, $params);
        }
        
        
    }

    function getdata_td($param, $array) {
        if (isset($param[$array])) {
            $val = $param[$array];
        } else {
            $val = '';
        }
        return $val;
    }
    
    public function do_finish_form($params){
        $sql="update wni_layanan set taskname = 'siap-proses', 
                catatan2 ='', 
                statusname='proses' 
                where layananidhash = :lyn_id;
                ";
        $this->mdb->ExecSQL('application', $sql, $params);
        
        $xlayanan = $this->datalayanan($params);
        $qresult = array_merge($xlayanan, $params);
        $params['data'] = $this->load->view('email/v_finish_form', array('data'=>$qresult), true);
        $params['subject'] = 'Layanan '.getArrayDef($qresult, 'layananidstr').' siap diproses';

        $this->save_email($params);

        return array('success' => 1, 'islink'=>true,'link'=>'menu/layanan');
    }
    
    public function do_back_form($params){
        $sql= "update wni_layanan 
            set taskname = case when layananid=8 then 'attachment' else 'permohonan' end, 
            catatan2 =:catatan2 where layananidhash = :lyn_id;";
        $this->mdb->ExecSQL('application', $sql, $params);
        
        $sqls = "select 
                b.nama as nama_layanan
              from wni_layanan a 
              left join layanan b on a.layananid = b.id
              where a.statusname in ('start', 'proses') and a.layananidhash = :lyn_id;
	";
        $qresult = $this->mdb->QueryData('application', $sqls, $params, 'record');
        //$params['data'] = 'Data anda belum lengkap untuk '.$qresult[0]["nama_layanan"].', harap segera dilengkapi.';
        //$params['subject'] = 'Data EKBRI Perlu Diperbaiki';

        $xlayanan = $this->datalayanan($params);
        $qresult = array_merge($xlayanan, $params);
        $params['data'] = $this->load->view('email/v_back_form', array('data'=>$qresult), true);
        $params['subject'] = 'Layanan '.getArrayDef($qresult, 'layananidstr').' perlu diperbaiki';


        $this->save_email($params);

        return array('success' => 1, 'islink'=>true,'link'=>'menu/layanan');
    }
        
    public function sendEmailSiapProses() {
        $code = $this->getNextControlId();
        $sqls = "update app_email set controlid=:controlid 
            where id in (select id from app_email where controlid is null and status = 0 order by id limit 2 )";
        $this->mdb->ExecSQL('application', $sqls, array('controlid'=>$code));
        
        $sql = "select * from app_email where controlid = :controlid";
        $qresr = $this->mdb->QueryData('application', $sql, array('controlid'=>$code), 'record');
        if ($qresr!=NULL) {
            $hasils = array();
            foreach ($qresr as $key => $val) {
                $hasils[$key] = $val['email'].'='.$this->doSendEmail($val);
            }
            $hasil = json_encode($hasils);
        }  else {
            $hasil = 'error null';
        }
         return array('status'=>$hasil);
    }
    
    function doSendEmail($data){
        $to = array($data['email']);
        $subject = $data['subject']; 
        $message = $this->getRegistrationEmail($data);
        $hasil = $this->sendEmail($to, $subject, $message, $data['id']);
        return $hasil;
    }
    
    function getRegistrationEmail($data){
        $url = $this->getMainUrl().'confirmation/';
        $data['conf_url'] = $url;
        return $data['data'];
    }
    
    function sendEmail($to, $subject, $message, $id){
        try {
            $this->load->library('email');
            $xconfig = $this->ci->config->item('email_config');
            $defconfig = array();
            $defconfig['protocol'] = "smtp";
            $defconfig['charset'] = "utf-8";
            $defconfig['mailtype'] = "html";
            $defconfig['newline'] = "\r\n";

            $defconfig = array_merge($defconfig, $xconfig);
            $config = $defconfig;
            //$config = array_merge($defconfig, $config);
            $this->email->initialize($config);
            $this->email->from($config['from_email'], $config['from_name']);
            $this->email->to($to);
            $this->email->reply_to($config['from_email'], $config['from_name']);
            $this->email->subject($subject);
            $this->email->message($message);
            $this->email->send();
            $this->updateAppEmail($id, 1);
            $hasil = 'success';
        } catch (Exception $exc) {
            $this->updateAppEmail($id, -1);
            $hasil = 'error';
        }
        return $hasil;
    }

    public function updateAppEmail($id, $status) {
        $params = array('status'=>$status, 'id'=>$id);
        $sql="update app_email set status = :status where id = :id;";
        $this->mdb->ExecSQL('application', $sql, $params);
    }

    public function getNextControlId() {
        $sql = "select nextval('email_controlid_seq') as sequence";
        $qres = $this->mdb->QueryData('application', $sql, array(), 'record')[0];
        return $qres['sequence'];
    }

}