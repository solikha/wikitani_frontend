<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class M_pengambilan extends MY_Model
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
    
 
	  public function datalayanan($params){
	  //print_r($params);
        $sql = "select a.id,a.id as wni_layanan,a.wniid, a.username, a.taskname, a.layananidhash, a.statusname, a.data_layanan,
            a.layananid, c.nama as nama_layanan,
            a.sublayananid, d.nama as nama_sublayanan, 
            d.attach_category as attachment_category,
            e.public_description as task_description,
            e.public_instruction as task_instruction,
            e.public_actionby as task_actionby,
            to_char(a.createtime, 'dd-mm-yyyy hh:mm') as create_time,
            b.nama_lengkap as pemohon, b.nama_lengkap, b.tempat_lahir, to_char(b.tanggal_lahir, 'dd-mm-yyyy') as tanggal_lahir,
            f.nama as jenis_kelamin,
			g.nama as nama_anak,
			g.tempat_lahir as tempat_lahir_anak,
			g.tanggal_lahir as tanggal_lahir_anak
          from wni_layanan a
            left join wni b on a.wniid = b.id
            left join layanan c on a.layananid = c.id
            left join layanan_sub d on a.sublayananid = d.id
            left join app_task e on a.taskname = e.taskname and a.layananid = e.layananid
            left join jenis_kelamin f on b.jenkelid = f.id
			left join app_registration_anak g on a.regid= g.id
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
        //print_r($this->cmdOptions);
        //print_r($result);
        return $result;
    }
	
	
	public function getDataAnak($params){
	  $result = $this->datalayanananak($params);
      //print_r($result);	  
        return $result;
	}
	
	public function datalayanananak($params){
	    //print_r($params); die();
        $sql = "select a.id as wni_lyn_id, a.id, a.wniid, a.username, a.taskname, a.layananidhash, a.statusname, a.data_layanan,
            a.layananid, c.nama as nama_layanan,
            a.sublayananid, d.nama as nama_sublayanan, 
            d.attach_category as attachment_category,
            e.public_description as task_description,
            e.public_instruction as task_instruction,
            e.public_actionby as task_actionby,
            to_char(a.createtime, 'dd-mm-yyyy hh:mm') as create_time,
            b.nama_lengkap as pemohon, b.nama_lengkap, b.tempat_lahir, to_char(b.tanggal_lahir, 'dd-mm-yyyy') as tanggal_lahir,
            f.nama as jenis_kelamin,
			g.nama as nama_anak,
			g.tempat_lahir as tempat_lahir_anak,
			g.tanggal_lahir as tanggal_lahir_anak
          from wni_layanan a
            left join wni b on a.wniid = b.id
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
	public Function getLayananId($params){
		$sql="select a.id as wni_lyn_id,a.wniid from wni_layanan a where a.layananidhash=:lyn_id";
		$result= $this->mdb->QueryData('application', $sql, $params, 'record');
		return $result[0];
	}
	//$params diambil dari form modal pengambilan
	public function getdatajsonanak($params){
	//print_r($params); die();
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
	//perintah fungsi hampir sama dengan getdatajsonanak dan getdatajsonanak2
	//namun berbeda parameter yg digunakan 
	public function getaArrayLayanan($params){
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
	//$params tidak diambil dari form melainkan hasilquery pada method datalayanan
	public function getdatajsonanak2($params){
        $sql = "select a.data_layanan from wni_layanan a where a.id=:id";
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
		$arr1=$this->getdatajsonanak($params);
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
		$datalayanan=$this->getdatajsonanak($params);
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
	

 
  
    
    public function edit_pengambilan($params){
        $result = $this->datalayanan($params);
        
        if (!isset($result['diserahkan_oleh'])){
            $sql = "select :sys_username as username";
            $xresult = $this->mdb->QueryData('application', $sql, array(), 'record');
            $result['diserahkan_oleh'] = $xresult[0]['username'];
        }
        
        return $result;
    }   

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
            $list = array('wniid', 'sublayananid', 'taskname', 'statusname', 
                'description', 'catatan', 'catatan_status', 'catatan2');
            $vxdata = $vdata[0];
            $vxdata = $this->selectedMerge($vxdata, $sysparams, $list);
            $vxdata['data_layanan'] = json_encode($xdataparams);
            $vxdata['lyn_id'] = $sysparams['lyn_id'];
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
//hupdate final ini digunakan khusus untuk 
//pergantian paspor layanan id=1 diberi nama berbeda karena didalam params tidak ada 
//field lyn id
public function update_final($params){
//print_r($params); die();
  $sql="update wni_layanan set statusname = 'proses', taskname='complete' where layananidhash=:lyn_id";
  $this->mdb->ExecSQL('application', $sql, $params);

}	
//digunakan untuk selain layanan ganti paspor
public function update_final2($params){
  $sql="update wni_layanan set statusname = 'proses', taskname='complete' where id=:id";
  $this->mdb->ExecSQL('application', $sql, $params);

}
 
 public function save_pengambilan($params){
        $xlist = array('lyn_id', 'attachment_category', 
            'undefined', 'layananid', 'sublayananid');
        $dataparams = $this->stripParams($params, $xlist);
        $sysparams = $this->filterParams($params, $xlist);
		$datalayanan=$this->datalayanan($params);
		//method get old wni data sudah mengquery ke tabel wni	
		$oldWniData=$this->getOldWniData($datalayanan);
			if($datalayanan['layananid']==1){
				
				$arrWNI_LynId 		=$this->getLayananId($params);
						$wni_lyn_id			=$arrWNI_LynId['wni_lyn_id'];
						$wniid	   			=$arrWNI_LynId['wniid'];
						$oldWniDataPaspor=array(
							"nomor_paspor" 			=>$oldWniData['nomor_paspor'],
							"tempat_pengeluaran" 	=>$oldWniData['tempat_pengeluaran'],
							"tanggal_pembuatan" 	=>$oldWniData['tanggal_pembuatan'],
							"tanggal_habis_berlaku" =>$oldWniData['tanggal_habis_berlaku'],
						);
				$this->saveDataHistory("ganti_paspor",json_encode($oldWniDataPaspor),$wni_lyn_id,$wniid);
				$this->updateDataPengambilanToLayanan($params);
				//$this->doSaveData($sysparams, $dataparams);
				$this->updateDataPasporToWNI($this->datalayanan($params));
				$this->update_final($params);
				//$this->saveDataToWNI($params);
				
					return array(
						'success'=>1
				    );
		//cek layanan terpilih 2= paspor baru anak	
		}else if($datalayanan['layananid']==2){
			//child if untuk menentukan apakah di field json data layanan ada wni_anak_id
			if(empty( $datalayanan['wnianak_id'])){
				$this->updateDataPengambilanToLayanan($params);
				$this->insertDataAnakToWNI($this->datalayanan($params));
				$this->update_final2($this->datalayanan($params));
				$this->updateDataPengambilanToLayanan($params);
				return array(
					'success'=>1
				    );
			}else if(empty( $datalayanan['wnianak_id'])==false){
				$datahistory=array(
				'nama_pengambil'=>getArrayDef($datalayanan,'nama_pengambil'),
				'tanggal_ambil'=>getArrayDef($datalayanan,'tanggal_ambil'),
				'wniid'=>getArrayDef($datalayanan,'wniid'),
				'pbaru_nomor'=>getArrayDef($datalayanan,'pbaru_nomor'),
				'diserahkan_oleh'=>getArrayDef($datalayanan,'diserahkan_oleh')
	             );
				 //mengambil data lama wni  berdasarkan wnianak_id sebagai wniid
				// print_r($params); die();
				//print_r(array('wnianak_id'=>$datalayanan['wnianak_id'])); die();
				 $xparams=array("wniid"           =>$datalayanan['wnianak_id'],
				                "layananidhash"   =>$params['lyn_id']
				                );
				 $newOldWniData=$this->getOldWniData($xparams);
				// print_r( $newOldWniData);die();
				 //memilih data wni anak yang lama untuk dimasukan ke history 
				 $oldWniDataAnak=array(
					"wnianak_id"				=> $datalayanan['wnianak_id'],
					"nama_lengkap" 				=> $newOldWniData['nama_lengkap'],	
					"tempat_lahir" 				=> $newOldWniData['tempat_lahir'],
					"tanggal_lahir"				=> $newOldWniData['tanggal_lahir'],	
					"jenkelid"					=> $newOldWniData['jenkelid'],
					"statuskawinid"    	 		=> $newOldWniData['statuskawinid'],	
					"pekerjaan"      			=> $newOldWniData['pekerjaan'],
					"nama_instansi" 			=> $newOldWniData['nama_instansi'],	
					"alamat_instansi"   		=> $newOldWniData['alamat_instansi'],
					"telp_kantor"    			=> $newOldWniData['telp_kantor'],
					"kota_instansi"     		=> $newOldWniData['kota_instansi'],	
					"kodepos_instansi"  		=> $newOldWniData['kodepos_instansi'],	
					"telp_rumah"     			=> $newOldWniData['telp_rumah'],
					"telp_hp"          	 		=> $newOldWniData['telp_hp'],
					"alamat"      				=> $newOldWniData['alamat'],
					"kodepos"     				=> $newOldWniData['kodepos'],
					"nomor_paspor"      		=> $newOldWniData['nomor_paspor'],
					"tempat_pengeluaran" 		=> $newOldWniData['tempat_pengeluaran'],
					"tanggal_pembuatan" 		=> $newOldWniData['tanggal_pembuatan'],	
					"tanggal_habis_berlaku" 	=> $newOldWniData['tanggal_habis_berlaku'],
					"nomor_id"    				=> $newOldWniData['nomor_id'],
					"tanggal_habis_berlaku_id"  => $newOldWniData['tanggal_habis_berlaku_id'],
					"alamat_id"       			=> $newOldWniData['alamat_id'],	
					"kota_kab_id"       		=> $newOldWniData['kota_kab_id'],
					"kodepos_id"     			=> $newOldWniData['kodepos_id'],
					"telp_id"    				=> $newOldWniData['telp_id'],
				 );
				$xparams=array("wniid"  =>$datalayanan['wnianak_id']);
				$arrWNI_LynId=$this->getLayananId($params);
				$wni_lyn_id=$arrWNI_LynId['wni_lyn_id'];
				$wniid=$datalayanan['wnianak_id'];
				$this->saveDataHistory("ganti paspor anak",json_encode($oldWniDataAnak),$wni_lyn_id,$wniid);
				$this->updateDataAnakToWNI($this->datalayanan($params));
				$this->update_final2($this->datalayanan($params));
				$this->updateDataPengambilanToLayanan($params);
				return array(
					'success'=>1
				    );
			}
		}else if($datalayanan['layananid']==3){
			//"child if" untuk menyesuaikan fungsi yang dipanggil dengan sublayananidnya(sublayanan)
					if($datalayanan['sublayananid']==10){
						$arrWNI_LynId=$this->getLayananId($params);
						$wni_lyn_id=$arrWNI_LynId['wni_lyn_id'];
						$wniid=$arrWNI_LynId['wniid'];
						$oldWniDataNikah=array(
							"nama_pasangan"	=>$oldWniData['nama_pasangan'],
							"warganegara"	=>$oldWniData['warganegara'],
							"statuskawinid"	=>$oldWniData['statuskawinid']
						);
					$this->saveDataHistory("ganti karena menikah",json_encode($oldWniDataNikah),$wni_lyn_id,$wniid);
					$this->updateDataNikahToWNI($this->datalayanan($params));
					$this->update_final2($this->datalayanan($params));
					$this->updateDataPengambilanToLayanan($params);
			  }else if($datalayanan['sublayananid']==11){
						$arrWNI_LynId=$this->getLayananId($params);
						$wni_lyn_id=$arrWNI_LynId['wni_lyn_id'];
						$wniid=		$arrWNI_LynId['wniid'];
						$oldWniDataCerai=array(
							"nama_pasangan"	=>$oldWniData['nama_pasangan'],
							"warganegara"	=>$oldWniData['warganegara'],
							"statuskawinid"	=>$oldWniData['statuskawinid']
						);
					$this->saveDataHistory("ganti karena cerai",json_encode($oldWniDataCerai),$wni_lyn_id,$wniid);
					$this->updateDataCeraiToWNI($this->datalayanan($params));
					$this->update_final2($this->datalayanan($params));
					$this->updateDataPengambilanToLayanan($params);
			  }else if($datalayanan['sublayananid']==12){
					$arrWNI_LynId=$this->getLayananId($params);
						$wni_lyn_id=$arrWNI_LynId['wni_lyn_id'];
						$wniid	   =$arrWNI_LynId['wniid'];
						$oldWniDataAlamat=array(
							"alamat"	=>$oldWniData['alamat'],
							"kota"		=>$oldWniData['kota'],
							"kodepos"	=>$oldWniData['kodepos'],
							"telp_rumah"=>$oldWniData['telp_rumah'],
							"telp_hp"	=>$oldWniData['telp_hp']
						);
					//print_r($oldWniDataAlamat);die();	
					$this->saveDataHistory("ganti paspor ganti alamat",json_encode($oldWniDataAlamat),$wni_lyn_id,$wniid);
					$this->updateDataGantiAlamatToWNI($this->datalayanan($params));
					$this->update_final2($this->datalayanan($params));
					$this->updateDataPengambilanToLayanan($params);
			  }else if($datalayanan['sublayananid']==13){
						$arrWNI_LynId=$this->getLayananId($params);
						$wni_lyn_id=$arrWNI_LynId['wni_lyn_id'];
						$wniid	   =$arrWNI_LynId['wniid'];
						$oldWniDataPekerjaan=array(
							"pekerjaan"			=>$oldWniData['pekerjaan'],
							"nama_instansi"		=>$oldWniData['nama_instansi'],
							"alamat_instansi"	=>$oldWniData['alamat_instansi'],
							"telp_kantor"		=>$oldWniData['telp_kantor'],
							"kota_instansi"		=>$oldWniData['kota_instansi'],
							"kodepos_instansi"	=>$oldWniData['kodepos_instansi']
						);
						//print_r($params); die();
					$this->saveDataHistory("ganti status kerja",json_encode($oldWniDataPekerjaan),$wni_lyn_id,$wniid);
					$this->updateDataGantiStatusPekerjaanToWNI($this->datalayanan($params));
					$this->update_final2($this->datalayanan($params));
					$this->updateDataPengambilanToLayanan($params);
			  }
				return array(
					'success'=>1
				    );
			 }else if($datalayanan['layananid']==4){	
						$arrWNI_LynId=$this->getLayananId($params);
						$wni_lyn_id=$arrWNI_LynId['wni_lyn_id'];
						$wniid	   =$arrWNI_LynId['wniid'];
						$oldWniDataPulangHabis=array(
							"tanggal_pulang"			=>$oldWniData['tanggal_pulang'],
							"meninggalkan_belgia"		=>$oldWniData['meninggalkan_belgia']
						);
					$this->saveDataHistory("pulang habis",json_encode($oldWniDataPulangHabis),$wni_lyn_id,$wniid);
					$this->updateDataPulangHabisToWNI($this->datalayanan($params));
					$this->update_final2($this->datalayanan($params));
					$this->updateDataPengambilanToLayanan($params);
				return array(
					'success'=>1
				    );
			 }else if($datalayanan['layananid']==5){
						$arrWNI_LynId 		=$this->getLayananId($params);
						$wni_lyn_id			=$arrWNI_LynId['wni_lyn_id'];
						$wniid	   			=$arrWNI_LynId['wniid'];
						$oldWniDataPindahWN=array(
							"menjadi_wna" =>$oldWniData['menjadi_wna'],
						);
					$this->saveDataHistory("pindah WN",json_encode($oldWniDataPindahWN),$wni_lyn_id,$wniid);
					$this->updateDataPindahWnToWNI($this->datalayanan($params));
					$this->update_final2($this->datalayanan($params));
					$this->updateDataPengambilanToLayanan($params);
				return array(
					'success'=>1
				    );
		     }else if($datalayanan['layananid']==6){
					// tidak mengupdate apapun
					$this->update_final2($this->datalayanan($params));
					$this->updateDataPengambilanToLayanan($params);
				return array(
					'success'=>1
				    );
		     }else if($datalayanan['layananid']==7){
						$arrWNI_LynId 		=$this->getLayananId($params);
						$wni_lyn_id			=$arrWNI_LynId['wni_lyn_id'];
						$wniid	   			=$arrWNI_LynId['wniid'];
						$oldWniDataLaporDiri=array(
							"tanggal_tiba" 			=>$oldWniData['tanggal_tiba'],
							"tanggal_lapor" 		=>$oldWniData['tanggal_lapor'],
							"tanggal_pulang"		=>$oldWniData['tanggal_pulang'],
							"meninggalkan_belgia"	=>$oldWniData['meninggalkan_belgia']		
						);
					$this->saveDataHistory("lapor diri",json_encode($oldWniDataLaporDiri),$wni_lyn_id,$wniid);
					$this->updateDataLaporDiriToWNI($this->datalayanan($params));
					$this->update_final2($this->datalayanan($params));
					$this->updateDataPengambilanToLayanan($params);
				return array(
					'success'=>1
				    );
		    }else if($datalayanan['layananid']==8){
				$this->update_final2($this->datalayanan($params));
				return array(
					'success'=>1
				    );
		    }	
    }
	
	
	
	public function updateDataPengambilanToLayanan($params){
		//print_r($params); die();
		//data pengambilan yg lama
		$datalayanan=$this->getaArrayLayanan($params);
		unset($datalayanan['nama_pengambil']);
		unset($datalayanan['tanggal_ambil']);
		unset($datalayanan['diserahkan_oleh']);
		//data pengambilan yg baru
		$new_data_pengambilan=array(
			"nama_pengambil"	=>$params['nama_pengambil'],
			"tanggal_ambil"		=>$params['tanggal_ambil'],
			"diserahkan_oleh"	=>$params['diserahkan_oleh'],
		);
		$datalayanan=array_merge($new_data_pengambilan,$datalayanan);
		//print_r($datalayanan);die();
		//print_r($data_pengambilan); die();
		$new_datalayanan=array(
			"layananidhash"=>$params["lyn_id"],
			"json_data_layanan"=>json_encode($datalayanan)
		);
		//print_r($new_datalayanan);die();
		$sql="update wni_layanan set data_layanan=:json_data_layanan where layananidhash=:layananidhash";
		$this->mdb->ExecSQL('application', $sql, $new_datalayanan);
	}
	
	public function updateDataPasporToWNI($params){
		$data_json=$this->getdatajsonanak2($params);
		//print_r($data_json); die();
		$default=array(
			"paspor_nomor"				=>"",
			"paspor_tpt_keluar"			=>"",
			"paspor_tgl_keluar"			=>"",
			"paspor_berlaku"			=>""
			);
		$data_json=array_merge($default,$data_json);
		//print_r($data_json); die();
		$data_paspor=array(
			"wniid"			        =>$params['wniid'],
			"paspor_nomor"	        =>getArrayDef($data_json,'paspor_nomor'),
			"paspor_tpt_keluar"     =>getArrayDef($data_json,'paspor_tpt_keluar'),
			"paspor_tgl_keluar"	    =>getArrayDef($data_json,'paspor_tgl_keluar'),
			"paspor_berlaku"		=>getArrayDef($data_json,'paspor_berlaku')
			);
		//print_r($data_lapor_diri); die();	
		$data_paspor=array_merge($default,$data_paspor);
		
		//print_r($data_nikah); die();
		$sql="update wni set 
				nomor_paspor			=:paspor_nomor,
				tempat_pengeluaran	    =:paspor_tpt_keluar,
				tanggal_pembuatan		=to_date(:paspor_tgl_keluar,'dd-mm-yyyy'),
				tanggal_habis_berlaku	=to_date(:paspor_berlaku,'dd-mm-yyyy')
			  where 
			  id=:wniid
			 ";
		$this->mdb->ExecSQL('application', $sql, $data_paspor);
	}
	
	
	
	public function updateDataLaporDiriToWNI($params){
		$data_json=$this->getdatajsonanak2($params);
		//print_r($data_json); die();
		$default=array(
			"lapor_tanggal_pulang"	=>"",
			"tanggal_tiba"			=>"",
			"tanggal_lapor"			=>"",
			"tanggal_pulang"		=>"",
			"meninggalkan_belgia"	=>""
		);
		$data_json=array_merge($default,$data_json);
		//print_r($data_json); die();
		$data_lapor_diri=array(
			"wniid"					=>$params['wniid'],
			"lapor_tanggal_pulang"	=>getArrayDef($data_json,'lapor_tanggal_pulang'),
			"tanggal_tiba"			=>getArrayDef($data_json,'tanggal_tiba'),
			"tanggal_lapor"			=>getArrayDef($data_json,'tanggal_lapor'),
			"meninggalkan_belgia"	=>getArrayDef($data_json,'meninggalkan_belgia')
			);
		//print_r($data_lapor_diri); die();	
		$data_lapor_diri=array_merge($default,$data_lapor_diri);
		
		//print_r($data_nikah); die();
		$sql="update wni set 
				tanggal_tiba		=to_date(:tanggal_tiba,'dd-mm-yyyy'),
				tanggal_lapor	    =to_date(:tanggal_lapor,'dd-mm-yyyy'),
				tanggal_pulang		=to_date(:lapor_tanggal_pulang,'dd-mm-yyyy'),
				meninggalkan_belgia	= false
			  where 
			  id=:wniid
			 ";
		$this->mdb->ExecSQL('application', $sql, $data_lapor_diri);
	}
	
	public function updateDataPindahWnToWNI($params){
		$data_json=$this->getdatajsonanak2($params);
		//print_r($data_json); die();
		$default=array(
			"nomor_paspor"		=>"",
			"nomor_register"	=>"",
			"negara"			=>"",
			"tempat_keluar"		=>"",
			"tanggal_keluar"	=>"",
			"berlaku_sampai"	=>""	
		);
		$data_json=array_merge($default,$data_json);
		//print_r($data_json); die();
		$data_pindah_wn=array(
			"wniid"				=>$params['wniid'],
			"nomor_paspor"		=>$data_json['nomor_paspor'],
			"nomor_register"	=>$data_json['nomor_register'],
			"negara"			=>$data_json['negara'],
			"tempat_keluar"		=>$data_json['tempat_keluar'],
			"tanggal_keluar"	=>$data_json['tanggal_keluar'],
			"berlaku_sampai"	=>$data_json['berlaku_sampai']
		);
		$data_pindah_wn=array_merge($default,$data_pindah_wn);
		//print_r($data_nikah); die();
		$sql="update wni set 
				menjadi_wna	=true
			  where 
			  id=:wniid
			 ";
		$this->mdb->ExecSQL('application', $sql, $data_pindah_wn);
	}
	public function updateDataPulangHabisToWNI($params){
		$data_json=$this->getdatajsonanak2($params);
		//print_r($data_json); die();
		$default=array(
			"tanggal_kembali"	=>"",
			"alasan"			=>"",
			"alamat_id"			=>"",
			"kota_kab_id"		=>"",
			"kodepos_id"		=>""
		);
		$data_json=array_merge($default,$data_json);
		//print_r($data_json); die();
		$data_pulang_habis=array(
			"wniid"				=>$params['wniid'],
			"tanggal_kembali"	=>$data_json['tanggal_kembali'],
			"alasan"			=>$data_json['alasan'],
			"alamat_id"			=>$data_json['alamat_id'],
			"kota_kab_id"		=>$data_json['kota_kab_id'],
			"kodepos_id"		=>$data_json['kodepos_id']
		);
		$data_pulang_habis=array_merge($default,$data_pulang_habis);
		//print_r($data_nikah); die();
		$sql="update wni set 
				tanggal_pulang			=to_date(:tanggal_kembali,'dd-mm-yyyy'),
				meninggalkan_belgia		=true
			  where 
			  id=:wniid
			 ";
		$this->mdb->ExecSQL('application', $sql, $data_pulang_habis);
	}
	
	public function updateDataGantiStatusPekerjaanToWNI($params){
		$data_json=$this->getdatajsonanak2($params);
		//print_r($data_json); die();
		$default=array(
			"pkjaan_nama"				=>"",
			"pkjaan_namakantor"			=>"",
			"pkjaan_telepon"			=>"",
			"pkjaan_alamat"				=>"",
			"pkjaan_kota"				=>"",
			"pkjaan_kodepos"			=>""
		);
		$data_json=array_merge($default,$data_json);
		//print_r($data_json); die();
		$data_status_kerja=array(
			"wniid"						=>$params['wniid'],
			"pkjaan_nama"				=>$data_json['pkjaan_nama'],
			"pkjaan_namakantor"			=>$data_json['pkjaan_namakantor'],
			"pkjaan_telepon"			=>$data_json['pkjaan_telepon'],
			"pkjaan_alamat"				=>$data_json['pkjaan_alamat'],
			"pkjaan_kota"				=>$data_json['pkjaan_kota'],
			"pkjaan_kodepos"			=>$data_json['pkjaan_kodepos'],
		);
		$data_status_kerja=array_merge($default,$data_status_kerja);
		//print_r($data_nikah); die();
		$sql="update wni set 
		     pekerjaan			=:pkjaan_nama,
			 nama_instansi		=:pkjaan_namakantor,
			 alamat_instansi  	=:pkjaan_alamat,
			 kota_instansi		=:pkjaan_kota,
			 telp_kantor		=:pkjaan_telepon,
			 kodepos_instansi	=:pkjaan_kodepos
			 where 
			 id=:wniid
			 ";
		$this->mdb->ExecSQL('application', $sql, $data_status_kerja);
	}
	//function update untuk layananid = 3  sublayanan id 10
	public function updateDataNikahToWNI($params){
		$data_json=$this->getdatajsonanak2($params);
		//print_r($data_json); die();
		$default=array(
			"pasangan_nama"				=>"",
			"pasangan_wn"				=>"",
			"pasangan_tpt_lahir"		=>"",
			"pasangan_tgl_lahir"		=>"",
			"pasangan_alamat"			=>"",
			"pasangan_pasangan_kota"	=>"",
			"pasangan_kodepos"			=>"",
			"pasangan_telepon"			=>"",
			"pasangan_hp"				=>"",
			"pasangan_alamat_sama"		=>""
		);
		$data_json=array_merge($default,$data_json);
		//print_r($data_json); die();
		$data_nikah=array(
			"wniid"						=>$params['wniid'],
			"pasangan_nama"				=>$data_json['pasangan_nama'],
			"pasangan_wn"				=>$data_json['pasangan_wn'],
			"pasangan_tpt_lahir"		=>$data_json['pasangan_tpt_lahir'],
			"pasangan_tgl_lahir"		=>$data_json['pasangan_tgl_lahir'],
			"pasangan_alamat"			=>$data_json['pasangan_alamat'],
			"pasangan_pasangan_kota"	=>$data_json['pasangan_pasangan_kota'],
			"pasangan_kodepos"			=>$data_json['pasangan_kodepos'],
			"pasangan_telepon"			=>$data_json['pasangan_telepon'],
			"pasangan_hp"				=>$data_json['pasangan_hp'],
			"pasangan_alamat_sama"		=>$data_json['pasangan_alamat_sama']
		);
		$data_nikah=array_merge($default,$data_nikah);
		//print_r($data_nikah); die();
		$sql="update wni set 
		     nama_pasangan=:pasangan_nama,
			 statuskawinid='2',
			 warganegara  =:pasangan_wn
			 where 
			 id=:wniid
			 ";
		$this->mdb->ExecSQL('application', $sql, $data_nikah);
		
	}
	
	//function update untuk layananid = 3  sublayanan id 11
	public function updateDataCeraiToWNI($params){
		$data_json=$this->getdatajsonanak2($params);
		//print_r($data_json); die();
		$default=array(
			"pasangan_nama"				=>"",
			"pasangan_wn"				=>"",
			"pasangan_tpt_lahir"		=>"",
			"pasangan_tgl_lahir"		=>"",
			"pasangan_alamat"			=>"",
			"pasangan_pasangan_kota"	=>"",
			"pasangan_kodepos"			=>"",
			"pasangan_telepon"			=>"",
			"pasangan_hp"				=>"",
			"pasangan_alamat_sama"		=>""
		);
		$data_json=array_merge($default,$data_json);
		//print_r($data_json); die();
		$data_nikah=array(
			"wniid"						=>$params['wniid'],
			"pasangan_nama"				=>$data_json['pasangan_nama'],
			"pasangan_wn"				=>$data_json['pasangan_wn'],
			"pasangan_tpt_lahir"		=>$data_json['pasangan_tpt_lahir'],
			"pasangan_tgl_lahir"		=>$data_json['pasangan_tgl_lahir'],
			"pasangan_alamat"			=>$data_json['pasangan_alamat'],
			"pasangan_pasangan_kota"	=>$data_json['pasangan_pasangan_kota'],
			"pasangan_kodepos"			=>$data_json['pasangan_kodepos'],
			"pasangan_telepon"			=>$data_json['pasangan_telepon'],
			"pasangan_hp"				=>$data_json['pasangan_hp'],
			"pasangan_alamat_sama"		=>$data_json['pasangan_alamat_sama']
		);
		$data_nikah=array_merge($default,$data_nikah);
		//print_r($data_nikah); die();
		$sql="update wni set 
		     nama_pasangan=:pasangan_nama,
			 statuskawinid='5',
			 hubungan='',
			 warganegara  =:pasangan_wn
			 where 
			 id=:wniid
			 ";
		$this->mdb->ExecSQL('application', $sql, $data_nikah);
	}
	
	//function update untuk layananid = 3  sublayanan id 12
	public function updateDataGantiAlamatToWNI($params){
		$data_json=$this->getdatajsonanak2($params);
		//print_r($data_json); die();
		$default=array(
			"aluar_alamat"				=>"",
			"aluar_kota"				=>"",
			"aluar_kodepos"	            =>"",
			"aluar_telepon"				=>"",
			"aluar_hp"					=>""
		);
		$data_json=array_merge($default,$data_json);
		$data_alamat=array(
			"wniid"						=>	 $params['wniid'],
			"aluar_alamat"				=>	 $data_json['aluar_alamat'],
			"aluar_kota"				=> 	 $data_json['aluar_kota'],
			"aluar_kodepos"	            =>	 $data_json['aluar_kodepos'],
			"aluar_telepon"				=>	 $data_json['aluar_telepon'],
			"aluar_hp"					=>	 $data_json['aluar_hp']
		);
		$data_alamat=array_merge($default,$data_alamat);
		$sql="update wni set 
		     alamat 		= :aluar_alamat ,
			 kota   		= :aluar_kota   ,
			 kodepos		= :aluar_kodepos,
			 telp_rumah    	= :aluar_telepon,
			 telp_hp        = :aluar_hp
			 where 
			 id=:wniid
			 ";
		$this->mdb->ExecSQL('application', $sql, $data_alamat);
	}
	//function update untuk layananid = 3  sublayanan id 13
	public function updateDataGantiStatusKerjaToWNI($params){
	}		
	//function update untuk layananid = 3 (wnianak id exist)
	public function updateDataAnakToWNI($params){
	$default=array('anak_nama_lengkap'=>'', 'anak_tempat_lahir'=>'', 'anak_tanggal_lahir'=>'', 'anak_jenis_kelamin'=>'', 'status_sipil'=>'', 'pkjaan_nama'=>'', 'pkjaan_namakantor'=>'',
				   'pkjaan_alamat'=>'', 'pkjaan_telepon'=>'', 'pkjaan_kota'=>'',
				   'pkjaan_kodepos'=>'', 'aluar_telepon'=>'', 'aluar_hp'=>'', 
				   'aluar_alamat'=>'', 'aluar_kodepos'=>'', 'paspor_nomor'=>'', 
				   'paspor_tpt_keluar'=>'', 'paspor_tgl_keluar'=>'', 'paspor_berlaku'=>'', 
				   'pengenal_nomor'=>'', 'pengenal_berlaku'=>'', 'alamat_indo'=>'',
				   'aindo_kota'=>'', 'aindo_kodepos'=>'', 'aindo_telepon'=>'',
	               );
	$params=array_merge($default,$params);
	$sql="update wni 
	set 
	nama_lengkap=
	case when 
	:anak_nama_lengkap is not null
	then 
	:anak_nama_lengkap
	else
	nama_lengkap 
	end,
	tempat_lahir=
	case when 
	:anak_tempat_lahir is not null
	then 
	:anak_tempat_lahir
	else
	tempat_lahir
	end,
	tanggal_lahir=
	case when 
	:anak_tanggal_lahir is not null
	then      
	to_date(:anak_tanggal_lahir,'dd-mm-yyyy')
	else 
	tanggal_lahir
	end,
	jenkelid= 
	case when 
	:anak_jenis_kelamin is not null
	then
	:anak_jenis_kelamin
	else 
	jenkelid
	end,
	statuskawinid= 
	case when
	:status_sipil is not null
	then
	:status_sipil
	else 
	statuskawinid
	end,
    pekerjaan= 
	case when
	:pkjaan_nama is not null
	then
	:pkjaan_nama
	else 
	pekerjaan
	end,
	nama_instansi= 
	case when
	:pkjaan_namakantor is not null
	then
	:pkjaan_namakantor
	else 
	nama_instansi
	end,
	alamat_instansi= 
	case when
	:pkjaan_alamat is not null
	then
	:pkjaan_alamat
	else 
	alamat_instansi
	end,
	telp_kantor= 
	case when
	:pkjaan_telepon is not null
	then
	:pkjaan_telepon
	else 
	telp_kantor
	end,
    kota_instansi= 
	case when
	:pkjaan_kota is not null
	then
	:pkjaan_kota
	else 
	kota_instansi
	end,
	kodepos_instansi= 
	case when
	:pkjaan_kodepos is not null
	then
	:pkjaan_kodepos
	else 
	kodepos_instansi
	end,
	telp_rumah= 
	case when
	:aluar_telepon is not null
	then
	:aluar_telepon
	else 
	telp_rumah
	end,
	telp_hp= 
	case when
	:aluar_hp is not null
	then
	:aluar_hp
	else 
	telp_hp
	end,
	alamat= 
	case when
	:aluar_alamat is not null
	then
	:aluar_alamat
	else 
	alamat
	end,
	kodepos= 
	case when
	:aluar_kodepos is not null
	then
	:aluar_kodepos
	else 
	kodepos
	end,
	nomor_paspor= 
	case when
	:paspor_nomor is not null
	then
	:paspor_nomor
	else 
	nomor_paspor
	end,
	tempat_pengeluaran= 
	case when
	:paspor_tpt_keluar is not null
	then
	:paspor_tpt_keluar
	else 
	tempat_pengeluaran
	end,
	tanggal_pembuatan= 
	case when
	:paspor_tgl_keluar is not null
	then
	to_date(:paspor_tgl_keluar,'dd-mm-yyyy')
	else 
	tanggal_pembuatan
	end,
	tanggal_habis_berlaku= 
	case when
	:paspor_berlaku is not null
	then
	to_date(:paspor_berlaku,'dd-mm-yyyy')
	else 
	tanggal_habis_berlaku
	end,
	nomor_id= 
	case when
	:pengenal_nomor is not null
	then
	:pengenal_nomor
	else 
	nomor_id
	end,
	tanggal_habis_berlaku_id= 
	case when
	:pengenal_berlaku is not null
	then
	to_date(:pengenal_berlaku,'dd-mm-yyyy')
	else 
	tanggal_habis_berlaku_id
	end,
	alamat_id= 
	case when
	:alamat_indo is not null
	then
	:alamat_indo
	else 
	alamat_id
	end,
	kota_kab_id= 
	case when
	:aindo_kota is not null
	then
	:aindo_kota
	else 
	kota_kab_id
	end,
	kodepos_id= 
	case when
	:aindo_kodepos is not null
	then
	:aindo_kodepos
	else 
	kodepos_id
	end,
	telp_id= 
	case when
	:aindo_telepon is not null
	then
	:aindo_telepon
	else 
	telp_id
	end
	where 
	id=:wnianak_id
	";
	$this->mdb->ExecSQL('application', $sql, $params);
	}
	//function insert untuk layananid = 2 (wni anakid undefined index)
	public function insertDataAnakToWNI($params){
	$oldparams=$params;
	$default=array('anak_nama_lengkap'=>'', 'anak_tempat_lahir'=>'', 'anak_tanggal_lahir'=>'',
				   'anak_jenis_kelamin'=>'', 'status_sipil'=>'', 'pkjaan_nama'=>'',
 				   'pkjaan_namakantor'=>'',
				   'pkjaan_alamat'=>'', 'pkjaan_telepon'=>'', 'pkjaan_kota'=>'',
				   'pkjaan_kodepos'=>'', 'aluar_telepon'=>'', 'aluar_hp'=>'', 
				   'aluar_alamat'=>'', 'aluar_kodepos'=>'', 'paspor_nomor'=>'', 
				   'paspor_tpt_keluar'=>'', 'paspor_tgl_keluar'=>'', 'paspor_berlaku'=>'', 
				   'pengenal_nomor'=>'', 'pengenal_berlaku'=>'', 'alamat_indo'=>'',
				   'aindo_kota'=>'', 'aindo_kodepos'=>'', 'aindo_telepon'=>'',
	               );
	$params=array_merge($default,$params);
		$sql="insert into wni(
							  nama_lengkap
		                      ,
							  tempat_lahir
							  ,
							  tanggal_lahir
							  ,
							  jenkelid
							  ,
							  statuskawinid
							  ,
							  pekerjaan
							  ,
							  nama_instansi
							  ,
							  alamat_instansi
							  ,
							  telp_kantor
							  ,
							  kota_instansi
							  ,
							  kodepos_instansi
							  ,
							  telp_rumah
							  ,
							  telp_hp
							  ,
							  alamat
							  ,
							  kodepos
							  ,
							  nomor_paspor
							  ,
							  tempat_pengeluaran
							  ,
							  tanggal_pembuatan
							  ,
							  tanggal_habis_berlaku
							  ,
							  nomor_id
							  ,
							  tanggal_habis_berlaku_id
							  ,
							  alamat_id
							  ,
							  kota_kab_id
							  ,
							  kodepos_id
							  ,
							  telp_id
		                     )
							 values
							 (
							 :anak_nama_lengkap
							 ,
							 :anak_tempat_lahir
							 ,
							 to_date(:anak_tanggal_lahir,'dd-mm-yyyy')
							 ,
							 :anak_jenis_kelamin
							 ,
							 :status_sipil
							 ,
							 :pkjaan_nama
							 ,
							 :pkjaan_namakantor
							 ,
							 :pkjaan_alamat
							 ,
							 :pkjaan_telepon
							 ,
							 :pkjaan_kota 
							 ,
							 :pkjaan_kodepos
							 ,
							 :aluar_telepon
							 ,
							 :aluar_hp
							 ,
							 :aluar_alamat
							 ,
							 :aluar_kodepos
							 ,
							 :paspor_nomor
							 ,
							 :paspor_tpt_keluar
							 ,
							 to_date(:paspor_tgl_keluar,'dd-mm-yyyy')
							 ,
							 to_date(:paspor_berlaku,'dd-mm-yyyy')
							 ,
							 :pengenal_nomor
							 ,
							 to_date(:pengenal_berlaku,'dd-mm-yyyy')
							 ,
							 :alamat_indo
							 ,
							 :aindo_kota
							 ,
							 :aindo_kodepos
							 ,
							 :aindo_telepon 
							 )
		      ";
		 $this->mdb->ExecSQL('application', $sql, $params);
		 $this->update_wnianak_id_to_datalayanan($oldparams);	
	}
	public function getCurrvalWniId(){
	$params=array();
		$sql="select currval('wni_id_seq')as wnianak_id";
		$result = $this->mdb->QueryData('application', $sql,$params, 'record');
		return $result[0];
	}
	public function update_wnianak_id_to_datalayanan($params){
		//print_r($params); die();
		$datalayanan=$this->getdatajsonanak2($params);
		$wnianak_id = $this->getCurrvalWniId();
		//print_r($wnianak_id);die();
		$datalayanan=array_merge($datalayanan,$wnianak_id);
		$newparams=array(
		'data_layanan'=>json_encode($datalayanan),
		'layananidhash'=>$params['layananidhash']
		);
		//print_r($params);die();
		$sql="update wni_layanan set data_layanan=:data_layanan where layananidhash=:layananidhash";
		$this->mdb->ExecSQL('application', $sql,$newparams);
	}
	public function getOldWniData($params){
	//print_r($params);die();
		$sql="select a.*, :layananidhash as layananidhash,a.nomor_paspor,
		 a.tempat_pengeluaran,to_char(a.tanggal_pembuatan,'dd-mm-yyyy')as tanggal_pembuatan,
		 to_char(a.tanggal_habis_berlaku,'dd-mm-yyyy')as tanggal_habis_berlaku 
		 from wni a 
		 where a.id=:wniid";
		$result = $this->mdb->QueryData('application', $sql, $params, 'record');
		//print_r($result); die();
		return $result[0];
	}
    function saveDataToWNI($params){
         // baca dari data layanan berdasarkan lyn_id
         // pilih data apa saja yang akan disimpan ke history dan disimpan ke data wni
         // simpan data ke history 
         // update data ke data WNI
     $datalayanan=$this->datalayanan($params);
	 $data=array('pbaru_nomor'=>getArrayDef($datalayanan,'paspor_nomor'),
	             'pbaru_tpt_keluar'=>getArrayDef($datalayanan,'paspor_tpt_keluar'),
			     'wniid'=>getArrayDef($datalayanan,'wniid'),
			     'pbaru_tgl_keluar'=>getArrayDef($datalayanan,'paspor_tgl_keluar'),
				 'pbaru_berlaku'   =>getArrayDef($datalayanan,'paspor_berlaku')
	             );
	 $oldWniData=$this->getOldWniData($datalayanan);
	 //memilih data wni yg sesuai layanan ganti paspor
	 $oldWniDataGantiPaspor=array(
		"nomor_paspor"=>$oldWniData['nomor_paspor'],
		"tempat_pengeluaran"=>$oldWniData['tempat_pengeluaran'],
		"tanggal_pembuatan"=>$oldWniData['tanggal_pembuatan'],
		"tanggal_habis_berlaku"=>$oldWniData['tanggal_habis_berlaku']
	 );
     $datahistory=array(
				'nama_pengambil'=>getArrayDef($datalayanan,'nama_pengambil'),
				'tanggal_ambil'=>getArrayDef($datalayanan,'tanggal_ambil'),
				'wniid'=>getArrayDef($datalayanan,'wniid'),
				'pbaru_nomor'=>getArrayDef($datalayanan,'pbaru_nomor'),
				'diserahkan_oleh'=>getArrayDef($datalayanan,'diserahkan_oleh')
	             );
		$arrWNI_LynId=$this->getLayananId($params);
		$wni_lyn_id=$arrWNI_LynId['wni_lyn_id'];
		$wniid=$arrWNI_LynId['wniid'];
		$this->saveDataHistory("ganti paspor",json_encode($oldWniDataGantiPaspor),$wni_lyn_id,$wniid);
        //update data ke data WNI
		$this->updateDataWNI($data);
    }
    function saveDataHistory($kategori, $data,$wni_lyn_id,$wniid){
        $datahistory=array("kategori"=>$kategori,
						   "wni_lyn_id"=>$wni_lyn_id,
						   "wniid"=>$wniid,
						   "json_history"=>$data
		                   );
	    $arr_layanan=json_decode($data);
		
        // kategori
        // history_time <-- diisi dengan now()
        // data_history <-- json
        // update_user
		 $sql="insert into app_history
		 (category,history_time,data_history,update_user,wni_lyn_id,wniid)
		    values
	     (:kategori,now(),:json_history,:sys_username,:wni_lyn_id,:wniid);";
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
	
    public function save_data($params){
        $xlist = array('lyn_id', 'attachment_category', 
            'undefined', 'layananid', 'sublayananid');
        $dataparams = $this->stripParams($params, $xlist);
        $sysparams = $this->filterParams($params, $xlist);
        $this->doSaveData($sysparams, $dataparams);
//        print_r($params);
//        print_r($dataparams);
//        print_r($sysparams);
        return array('success'=>1);
    }


    
}