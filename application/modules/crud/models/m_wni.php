<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class M_wni extends MY_Model
{
    var $cmdOptions = '';
    public function __construct()
    {
        parent::__construct();
    }
	public function save_to_app_wni($params){
	$data_wni=json_encode($params);
	$xparams=array("data_wni"=>$data_wni);
	$sql="
	select 0;
	insert into app_wni (data_wni)values(:data_wni);
	  update app_wni set hashid = md5('app_wni'||:sys_hashkey||cast(currval('app_wni_id_seq') as character varying))
      where id = currval('app_wni_id_seq');
	  select hashid,id from app_wni where id=currval('app_wni_id_seq');
	";
	$result =  $this->mdb->QueryData('application', $sql,$xparams,"record");
    return array('success' => 1, 'islink'=>true,'link'=>'menu/layanan_baru_edit_wni?wniid='.$result[0]['id']);
	}
	public function get_data_wni($params){
		$sql = "select a.*,a.id as selected_id,
		a.id as wniid,a.data_wni from app_wni a where a.id=:wniid";
        $xresult = $this->mdb->QueryData('application', $sql, $params, 'record');
		//echo "<pre>";print_r( $xresult);echo "</pre>"; die();
        $result = array();
        if (isset($xresult[0])){
            $xdata = $xresult[0];
			//echo "<pre>";print_r( $xdata);echo "</pre>"; die();
            $xjson = json_decode($xdata['data_wni'], true);
            unset($xdata['data_wni']);
            if($xjson){
			//echo "<pre>";print_r( $xjson);echo "</pre>"; die();
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
		//print_r ($result);
		return $result;
	}
	
	public function get_old_data_wni($params){
		 $sql = "select a.data_wni from app_wni a where a.id=:wniid";
        $xresult = $this->mdb->QueryData('application', $sql, $params, 'record');
        $result = array();
        if (isset($xresult[0])){
            $xdata = $xresult[0];
            $xjson = json_decode($xdata['data_wni'], true);
            unset($xdata['data_wni']);
            if($xjson){
                $result = array_merge($xjson, $xdata);
            } else {
                $result = $xdata;
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
		
		///unset($result[$params['']]);
        return $result;	
	}
	
	public function do_edit_data_wni($params){
		$sql="update app_wni set data_wni=:data_wni where id=:wniid";
		$this->mdb->ExecSQL('application', $sql, $params);
	}
	
	 public function edit_data_pemohon($params){
		//print_r($params); die();
		$oldWniData=$this->get_old_data_wni($params);
		//membuang index lama dan nilai lama untuk diupdate nilai baru
		unset($oldWniData["full_name"]);
		unset($oldWniData["jenkelid"]);
		unset($oldWniData["birth_city"]);
		unset($oldWniData["birth_date"]);
		unset($oldWniData["birth_email"]);
		unset($oldWniData["agamaid"]);
		unset($oldWniData["statuskawinid"]);
		//print_r($oldWniData);
		$new_data_pemohon=array_merge($oldWniData,$params);
		$xparams=array(
		"wniid"=>$params["wniid"],
		"data_wni"=>json_encode($new_data_pemohon)
		);
		$this->do_edit_data_wni($xparams);
		//print_r($new_data_pemohon);
        return array('success'=>1);
     }
	 
	 public function edit_data_perkerjaan($params){
		$oldWniData=$this->get_old_data_wni($params);
		//membuang nilai lama untuk diupdate nilai baru
		unset($oldWniData["pkjaan_nama"]);
		unset($oldWniData["pkjaan_namakantor"]);
		unset($oldWniData["pkjaan_telp"]);
		unset($oldWniData["pkjaan_alamat"]);
		unset($oldWniData["pkjaan_kota"]);
		unset($oldWniData["pkjaan_provinsi"]);
		unset($oldWniData["pkjaan_kodepos"]);
		unset($oldWniData["pkjaan_jenis"]);
		unset($oldWniData["pkjaan_negara"]);
		$new_data_pemohon=array_merge($oldWniData,$params);
		$xparams=array(
		"wniid"=>$params["wniid"],
		"data_wni"=>json_encode($new_data_pemohon)
		);
		$this->do_edit_data_wni($xparams);
        return array('success'=>1);
     }
	 
	  public function edit_data_paspor($params){
		$oldWniData=$this->get_old_data_wni($params);
		//membuang nilai lama untuk diupdate nilai baru
		unset($oldWniData["paspor_nomor"]);
		unset($oldWniData["paspor_tpt_keluar"]);
		unset($oldWniData["paspor_tgl_keluar"]);
		unset($oldWniData["paspor_berlaku"]);
		unset($oldWniData["status_ijin_tinggal"]);
		unset($oldWniData["pengenal_nomor"]);
		unset($oldWniData["pengenal_tgl_keluar"]);
		unset($oldWniData[" pengenal_tpt_keluar"]);
		unset($oldWniData["pengenal_berlaku"]);
		$new_data_pemohon=array_merge($oldWniData,$params);
		$xparams=array(
		"wniid"=>$params["wniid"],
		"data_wni"=>json_encode($new_data_pemohon)
		);
		$this->do_edit_data_wni($xparams);
        return array('success'=>1);
     }
	 public function edit_data_alamat_luar($params){
		$oldWniData=$this->get_old_data_wni($params);
		//membuang nilai lama untuk diupdate nilai baru
		unset($oldWniData["aluar_alamat"]);
		unset($oldWniData["aluar_kota"]);
		unset($oldWniData["aluar_kodepos"]);
		unset($oldWniData["aluar_telepon"]);
		unset($oldWniData["aluar_hp"]);
		unset($oldWniData["aluar_provinsi"]);
		unset($oldWniData["aluar_negara"]);
		$new_data_pemohon=array_merge($oldWniData,$params);
		$xparams=array(
		"wniid"=>$params["wniid"],
		"data_wni"=>json_encode($new_data_pemohon)
		);
		$this->do_edit_data_wni($xparams);
        return array('success'=>1);
	 
	 }
	 
	  public function edit_data_alamat_indo($params){
		$oldWniData=$this->get_old_data_wni($params);
		//membuang nilai lama untuk diupdate nilai baru
		unset($oldWniData["aindo_alamat"]);
		unset($oldWniData["aindo_kota"]);
		unset($oldWniData["aindo_kodepos"]);
		unset($oldWniData["aindo_telepon"]);
		unset($oldWniData["aindo_hp"]);
		unset($oldWniData["aindo_provinsi"]);
		unset($oldWniData["aindo_negara"]);
		$new_data_pemohon=array_merge($oldWniData,$params);
		$xparams=array(
		"wniid"=>$params["wniid"],
		"data_wni"=>json_encode($new_data_pemohon)
		);
		$this->do_edit_data_wni($xparams);
        return array('success'=>1);
	 }
	
	 public function edit_data_pasangan($params){
		$oldWniData=$this->get_old_data_wni($params);
		//membuang nilai lama untuk diupdate nilai baru
		unset($oldWniData["pasangan_nama"]);
		unset($oldWniData["hubungan"]);
		$new_data_pemohon=array_merge($oldWniData,$params);
		$xparams=array(
		"wniid"=>$params["wniid"],
		"data_wni"=>json_encode($new_data_pemohon)
		);
		$this->do_edit_data_wni($xparams);
        return array('success'=>1);
	 }
	
	public function edit_data_lain2x($params){
	//print_r($params); die();
		$oldWniData=$this->get_old_data_wni($params);
		//membuang nilai lama untuk diupdate nilai baru
		unset($oldWniData["ll_dwi_wn"]);
		unset($oldWniData["warganegara"]);
		unset($oldWniData["menjadi_wna"]);
		unset($oldWniData["meninggalkan_belgia"]);
		unset($oldWniData["ll_hak_pilih"]);
		unset($oldWniData["ll_jenis_cacat"]);
		unset($oldWniData["tanggal_tiba"]);
		unset($oldWniData["tanggal_lapor"]);
		unset($oldWniData["tanggal_pulang"]);
		$new_data_pemohon=array_merge($oldWniData,$params);
		$xparams=array(
		"wniid"=>$params["wniid"],
		"data_wni"=>json_encode($new_data_pemohon)
		);
		$this->do_edit_data_wni($xparams);
        return array('success'=>1);
	 }
	 
	 
	 public function pilih_data($params){
	// print_r($params); die();
		$sql = "select 
		case a.data_wni ::json->>'jenkelid' 
		when '1' then 'laki-laki' 
		when '2' then 'perempuan'
		end; as gendername, a.*, a.id as wniid,a.data_wni from app_wni a where a.id=:wniid";
        $xresult = $this->mdb->QueryData('application', $sql, $params, 'record');
        $result = array();
        if (isset($xresult[0])){
            $xdata = $xresult[0];
            $xjson = json_decode($xdata['data_wni'], true);
            unset($xdata['data_wni']);
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
		//print_r ($result);
		return $result;
	}
	
	 public function layanan_baru($params){
	 //echo "<pre>";
	   // print_r($params);
	 //echo "</pre>";
		//die();
		//print_r($xresult); die();
		$sql = "select a.*, case a.data_wni ::json->>'jenkelid' 
		when '1' then 'laki-laki' 
		when '2' then 'perempuan'
		end as gendername,
		a.data_wni ::json->>'birth_date' as birth_date,
		a.data_wni ::json->>'full_name' as full_name,
		a.id as wniid,
		a.data_wni 
		from app_wni a 
		where a.id=:wniid";
        $xresult = $this->mdb->QueryData('application', $sql, $params, 'record');
		//print_r($xresult); 
        $result = array();
        if (isset($xresult[0])){
            $xdata = $xresult[0];
            $xjson = json_decode($xdata['data_wni'], true);
            unset($xdata['data_wni']);
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
		//print_r ($result);
		return $result;
	}
	
}