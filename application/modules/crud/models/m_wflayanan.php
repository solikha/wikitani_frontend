<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class M_wflayanan extends MY_Model
{
    public function __construct()
    {
        parent::__construct();
    }
 
    function loadJSON($relpath, $ext='.json'){
        $base = $this->ci->config->item('basefolder');
        $filename = $base.$relpath.$ext;
        $fidata = file_get_contents($filename);
        $result = json_decode($fidata, true);
        return $result;
    }
    
 
    function stripParams($data, $list){
        foreach($list as $item){
            unset($data[$item]);
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

    function stripList($data, $list){
        $result = array();
        foreach ($data as $item){
            if(in_array($item, $list)){
            } else {
                array_push($result, $item);
            }
        }
        return $result;
    }
    
    function filterList($data, $list){
        $result = array();
        foreach ($data as $item){
            if(in_array($item, $list)){
                array_push($result, $item);
            } else {
            }
        }
        return $result;
    }
    
    
    function saveCekDokumen($params){
        $sql = "select id from wni_layanan where layananidhash = :lyn_id";
        $qres = $this->mdb->QueryData('application', $sql, $params, 'record');
        if (isset($qres[0])){
            $params['id'] = $qres[0]['id'];
            $sql = "
                delete from wni_layanan_doc 
                    where wni_layanan_id = :id;
                    
                insert into wni_layanan_doc(wni_layanan_id, doc_id) 
                    select :id, cast(unnest(string_to_array(:dokumen, ',')) as integer);
            ";
            $this->mdb->ExecSQL('application', $sql, $params);
        }
    }
    
    function tidakLolosCekal($params){
        $sql = "
            update wni_layanan set cekal_id=:selected_id
            where layananidhash = :lyn_id
        ";
        $this->mdb->ExecSQL('application', $sql, $params);
    }    
    
    function lolosCekal($params){
        $sql = "
            update wni_layanan set cekal_id=null
            where layananidhash = :lyn_id
        ";
        $this->mdb->ExecSQL('application', $sql, $params);
    }    

    function updateNomorPaspor($params){
	//print_r($params); die();
      if (isset($params['pbaru_nomor'])){
        $sql = "
                update app_nomor_paspor
                set status = 1,
                wni_layanan_id = (select id from wni_layanan where layananidhash = :lyn_id)
                where no_paspor = :pbaru_nomor
                ;
            ";
            $this->mdb->ExecSQL('application', $sql, $params);
      }
    }    
    
    function getDataLayanan($hashid){
        $sql = "select a.*,b.nama as nama_layanan
		from wni_layanan a 
        left join layanan b on a.layananid=b.id
		where a.layananidhash = :hashid
		";
        $params = array('hashid'=>$hashid);
        $qresult = $this->mdb->QueryData('application', $sql, $params, 'record');
        if (isset($qresult[0])){
            $result = $qresult[0];
            unset($result['data_layanan']);
            $xresult = json_decode($qresult[0]['data_layanan'], true);
            $result = array_merge($xresult, $result);
            return $result;
        } 
        return false;
    }
    
    function getDataWni($wniid){
        $sql = "select * from app_wni where id = :wniid";
        $params = array('wniid'=>$wniid);
        $qresult = $this->mdb->QueryData('application', $sql, $params, 'record');
        if (isset($qresult[0])){
            $result = json_decode($qresult[0]['data_wni'], true);
            return $result;
        } 
        return false;
    }
    
    function doUpdateDataWni($wniid, $data,$layanan){
        $dataWni = $this->getDataWNI($wniid);
        $dataWni = array_merge($dataWni, $data);
		if($layanan['layananid']==10){
		//mengosongkan pasangan data jika layanan lapor cerai
			if($layanan['nama_sublayanan']=='Lapor Cerai'){
						unset($dataWni['pasangan_wn']);
						unset($dataWni['suami_nama']);
						unset($dataWni['pasangan_nama']);
						unset($dataWni['pasangan_tpt_lahir']);
						unset($dataWni['pasangan_tgl_lahir']);
						unset($dataWni['pasangan_alamat_sama']);
						unset($dataWni['pasangan_alamat']);
						unset($dataWni['pasangan_kota']);
						unset($dataWni['pasangan_kodepos']);
						unset($dataWni['pasangan_telepon']);
						unset($dataWni['pasangan_hp']);
						unset($dataWni['statuskawinid']);
			            $dataWni=array_merge(array("statuskawinid"=>5),$dataWni);
			}else if ($layanan['nama_sublayanan']=='Lapor Menikah'){
			//blok untuk menambah data pasangan lapor menikah jika diperlukan
			
			}
		}else if($layanan['layananid']==4){
		//print_r($dataWni); die();
			$data_pulang_habis=array(
			"tanggal_kembali"	=>getArrayDef($layanan,'tanggal_kembali'),
			"alasan"			=>getArrayDef($layanan,'alasan'),
			"ll_status_pulang"	=>1
			);
		/*khawatir $dataWni murni terkontaminasi dg $data yg tidak tahu sumbernya
		  terpaksa query ulang
		*/
			$dataWni=$this->getDataWni((float)$layanan['wniid']);
		    unset($dataWni['tanggal_kembali']);
			unset($dataWni['alasan']);
			unset($dataWni['ll_status_pulang']);
		//merge dg data baru dari pulang habis
			$dataWni=array_merge($data_pulang_habis,$dataWni);
		}else if($layanan['layananid']==13){
			$data_alamat=array("aluar_alamat"=>getArrayDef($layanan,'aluar_alamat'),
			"aluar_alamat"	=>getArrayDef($layanan, 'aluar_alamat'),
			"aluar_kota"	=>getArrayDef($layanan, 'aluar_kota'),
			"aluar_kodepos"	=>getArrayDef($layanan, 'aluar_kodepos'),
			"aluar_telepon"	=>getArrayDef($layanan, 'aluar_telepon'),
			"aluar_hp"		=>getArrayDef($layanan, 'aluar_hp')
			);
			unset($dataWni['aluar_alamat']);
			unset($dataWni['aluar_kota']);
			unset($dataWni['aluar_kodepos']);
			unset($dataWni['aluar_telepon']);
			unset($dataWni['aluar_hp']);
			//merge data wni dg alamat dari data layanan
			$dataWni=array_merge($data_alamat,$dataWni);
		}
		//print_r($dataWni); die();
        $strdata = json_encode($dataWni);
        $sql = "update app_wni set data_wni = :data_wni where id = :wniid";
        $params = array('wniid'=>$wniid, 'data_wni'=>$strdata);
        $this->mdb->ExecSQL('application', $sql, $params);
    }
    
    function saveHistory($category, $wni_lyn_id, $wniid, $data){
        if (!empty($data)) {
            $xdata = json_encode($data);
            $sql = "insert into app_history(category, update_user, wni_lyn_id, wniid, data_history)
                values(:category, :sys_username, :wni_lyn_id, :wniid, :data_history)
            ";
            $params = array('category'=>$category, 'wni_lyn_id'=>$wni_lyn_id, 'wniid'=>$wniid, 'data_history'=>$xdata);
            $this->mdb->ExecSQL('application', $sql, $params);
        }
    }
    
    function prosesDataPengambilan($params) {
        $this->load->model('m_layanan', 'mlayanan');
        $this->mlayanan->do_pengambilan($params);
        $this->updateDataWni($params);
    }
    
    function prosesDataPengambilanAnak($params) {
        $this->load->model('m_layanan', 'mlayanan');
        $this->mlayanan->do_pengambilan($params);
        $this->updateDataAnak($params);
    }
    
    function updateDataWni($params){
        $list = getArrayDef($params, 'mapping', array());
        if (count($list)>0){
            $layanan = $this->getDataLayanan($params['lyn_id']);
            $datawni = $this->getDataWni($layanan['wniid']);
            if($layanan){
			
                $result = array();
                $history = array();
                foreach($list as $key=>$item){
                    if (isset($layanan[$item])){
                        $result[$key] = $layanan[$item];
                    }
                    if (isset($datawni[$item])){
                        $history[$item] = $datawni[$item];
                    }
                }
				$category = $params['nama_layanan'];
				//print_r(array('layananid'=>$layanan['layananid'])); die();
                $this->saveHistory($category, $layanan['wniid'], $layanan['id'], $history);
                $this->doUpdateDataWni($layanan['wniid'],$result,$layanan);
                $this->doCopyAttachmentWni($layanan['id'], $layanan['wniid'], $params['nama_layanan']);
            }
        }
    }
    
    function updateDataWniMeninggal($params){
        $list = getArrayDef($params, 'mapping', array());
        if (count($list)>0){
            $layanan = $this->getDataLayanan($params['lyn_id']);
            $datawni = $this->getDataWni($layanan['wniid']);
            if($layanan){
                $result = array();
                $history = array();
                foreach($list as $key=>$item){
                    if (isset($layanan[$item])){
                        $result[$key] = $layanan[$item];
                    }
                    if (isset($datawni[$item])){
                        $history[$item] = $datawni[$item];
                    }
                }
				$category = $params['nama_layanan'];
                                $cek_wni_meninggal =$this->getdataNot($result,'wni_meninggal');
                if (isset($cek_wni_meninggal)) {
                    $this->doUpdateDataWni($layanan['wniid'],$result,$layanan);
                }
                $this->saveHistory($category, $layanan['wniid'], $layanan['id'], $history);
                $this->doCopyAttachmentWni($layanan['id'], $layanan['wniid'], $params['nama_layanan']);
            }
        }
    }

    function getdataNot($param, $array) {

        if (isset($param[$array])) {
            $val = $param[$array];
        } else {
            $val = '';
        }
        return $val;
    }
    
    function getFieldLayanan($formname){
        $result = array();
        $config = $this->loadJSON('crud/'.$formname.'/browse', '.query');
        if (isset($config['paramlist']) and is_array($config['paramlist'])){
            foreach($config['paramlist'] as $item){
                if (isset($item['name'])){
                    //echo strpos($item['name'], 'heading_'); 
                    if((strpos($item['name'], 'head_')!==0) and (strpos($item['name'], 'heading_')!==0)
                         and (strpos($item['name'], 'btn_')!==0) and (strpos($item['name'], 'button_')!==0)
                         ){
                        array_push($result, $item['name']);
                    }
                }
            }
        }
        return $result;
    }
    
    
    function getDefaultWNI($params){
        //params: $wniid, $fields
        $wniid = $params['selected_id'];
        if(isset($params['form'])){
            $formname = $params['form'];
            $fields = $this->getFieldLayanan($formname);
        } else {
            $fields = array();
        }
        $deletelist = array("wni_lyn_id", "lyn_id", "create_by", "attachment_category",
            "taskname", "heading_data_permohonan", "nama_layanan", "nama_sublayanan",
            "pemohon", "create_time", "pagerec", "pagenum");

        if (isset($params['delete_fields'])){
            $deletelist = array_merge($deletelist, $params['delete_fields']);
        }
        $fields = $this->stripList($fields, $deletelist);
        
        $sql = 'select id, hashid, data_wni from app_wni where id = :wniid';
        $params = array('wniid'=>$wniid);
        $qres = $this->mdb->QueryData('application', $sql, $params, 'record');
        if (isset($qres[0])){
            $qresult = json_decode($qres[0]['data_wni'], true);
            $result = array();
            foreach($fields as $field){
                if (isset($qresult[$field])){
                    $result[$field] = $qresult[$field];
                }
            }
        }
        return $result;
    }
    
    function getDefaultWNIAnak($params){
	/*print_r($params); die();*/
        //params: $wniid, $fields
        $wniid = $params['selected_id'];
        $maps = array(
            'email'=>'email',
            'aluar_alamat'=>'aluar_alamat',
            'aluar_kota'=>'aluar_kota',
            'aluar_kodepos'=>'aluar_kodepos',
            'aluar_provinsi'=>'aluar_provinsi',
            'aluar_negara'=>'aluar_negara',
            'aluar_telepon'=>'aluar_telepon',
            'aluar_hp'=>'aluar_hp',
            'alamat_indo'=>'alamat_indo',
            'aindo_kota'=>'aindo_kota',
            'aindo_kodepos'=>'aindo_kodepos',
            'aindo_provinsi'=>'aindo_provinsi',
            'aindo_telepon'=>'aindo_telepon',
            'aindo_hp'=>'aindo_hp',
            'kindo_nama'=>'kindo_nama',
            'kindo_alamat'=>'kindo_alamat',
            'kindo_kota'=>'kindo_kota',
            'kindo_kodepos'=>'kindo_kodepos',
            'kindo_telepon'=>'kindo_telepon',
            'kindo_hp'=>'kindo_hp',
            'kluar_nama'=>'full_name',
            'kluar_alamat'=>'aluar_alamat',
            'kluar_kota'=>'aluar_kota',
            'kluar_kodepos'=>'aluar_kodepos',
            'kluar_telepon'=>'aluar_telepon',
            'kluar_hp'=>'aluar_hp'
        );
        
        $ayah_maps = array(
            'ayah_ada'=>'ortu_ada',
            'ayah_nama'=>'full_name',
            'kewarganegaraan_ayah'=>'ortu_wn',
            'ayah_tpt_lahir'=>'birth_city',
            'ayah_tgl_lahir'=>'birth_date',
            'ayah_alamat'=>'aluar_alamat',
            'ayah_kota'=>'aluar_kota',
            'ayah_kode_pos'=>'aluar_kodepos',
            'ayah_no_telepon'=>'aluar_telepon',
            'ayah_hp'=>'aluar_hp'
        );
        
        $ibu_maps = array(
            'ibu_ada'=>'ortu_ada',
            'ibu_nama'=>'full_name',
            'kewarganegaraan_ibu'=>'ortu_wn',
            'ibu_tpt_lahir'=>'birth_city',
            'ibu_tgl_lahir'=>'birth_date',
            'ibu_alamat'=>'aluar_alamat',
            'ibu_kota'=>'aluar_kota',
            'ibu_kode_pos'=>'aluar_kodepos',
            'ibu_no_telepon'=>'aluar_telepon',
            'ibu_hp'=>'aluar_hp'
        );
      
        $sql = 'select id, hashid, data_wni from app_wni where id = :wniid';
        $params = array('wniid'=>$wniid);
        $qres = $this->mdb->QueryData('application', $sql, $params, 'record');
        if (isset($qres[0])){
            $qresult = json_decode($qres[0]['data_wni'], true);
            $qresult['ortu_ada'] = "1";
            $qresult['ortu_wn'] = "ID";
			if(isset($qresult['jenkelid'])==true){
            if($qresult['jenkelid']==1){
                $maps = array_merge($maps, $ayah_maps);
            } else {
                $maps = array_merge($maps, $ibu_maps);
            }
			}else{
				//print_r(array("message"=>"jenkelid kosong")); die();
				$maps = array_merge($maps, $ayah_maps);
				$maps = array_merge($maps, $ibu_maps);
			}
            $result = array();
            foreach($maps as $target=>$source){
                if (isset($qresult[$source])){
                    $result[$target] = $qresult[$source];
                }
            }
        }
        return $result;
    }
    
    function getDefaultGantiNama($params){
        //params: $wniid, $fields
        $wniid = $params['selected_id'];
        $maps = array(
            'email'=>'email',
            'pasangan_nama'=>'pasangan_nama',
            'pasangan_wn'=>'pasangan_wn',
            'pasangan_tpt_lahir'=>'pasangan_tpt_lahir',
            'pasangan_tgl_lahir'=>'pasangan_tgl_lahir',
            'pasangan_alamat'=>'pasangan_alamat',
            'pasangan_kota'=>'pasangan_kota',
            'pasangan_kodepos'=>'pasangan_kodepos',
            'pasangan_telepon'=>'pasangan_telepon',
            'pasangan_hp'=>'pasangan_hp',
        );
        
        $sql = 'select id, hashid, data_wni from app_wni where id = :wniid';
        $params = array('wniid'=>$wniid);
        $qres = $this->mdb->QueryData('application', $sql, $params, 'record');
        if (isset($qres[0])){
            $qresult = json_decode($qres[0]['data_wni'], true);
            $qresult['ortu_ada'] = "1";
            $qresult['ortu_wn'] = "ID";
            $result = array();
            foreach($maps as $target=>$source){
                if (isset($qresult[$source])){
                    $result[$target] = $qresult[$source];
                }
            }
        }
        return $result;
    }
    
    function getDefaultMenikah($params){
        //params: $wniid, $fields
        $wniid = $params['selected_id'];
        $maps = array(
            'email'=>'email',
            'jenkelid'=>'jenkelid',
            'pasangan_nama'=>'pasangan_nama',
            'pasangan_wn'=>'pasangan_wn',
            'pasangan_tpt_lahir'=>'pasangan_tpt_lahir',
            'pasangan_tgl_lahir'=>'pasangan_tgl_lahir',
            'pasangan_alamat'=>'pasangan_alamat',
            'pasangan_kota'=>'pasangan_kota',
            'pasangan_kodepos'=>'pasangan_kodepos',
            'pasangan_telepon'=>'pasangan_telepon',
            'pasangan_hp'=>'pasangan_hp',
            'pkjaan_nama'=>'pkjaan_nama',
            'paspor_nomor'=>'paspor_nomor',
            'paspor_tpt_keluar'=>'paspor_tpt_keluar',
            'paspor_berlaku'=>'paspor_berlaku',
            'aluar_alamat'=>'aluar_alamat',
            'aluar_kota'=>'aluar_kota',
            'aluar_kodepos'=>'aluar_kodepos',
            'aindo_alamat'=>'aindo_alamat',
            'aindo_kota'=>'aindo_kota',
            'aindo_kodepos'=>'aindo_kodepos'
        );
        
        $sql = 'select id, hashid, data_wni from app_wni where id = :wniid';
        $params = array('wniid'=>$wniid);
        $qres = $this->mdb->QueryData('application', $sql, $params, 'record');
        if (isset($qres[0])){
            $qresult = json_decode($qres[0]['data_wni'], true);
            $qresult['ortu_ada'] = "1";
            $qresult['ortu_wn'] = "ID";
            $result = array();
            foreach($maps as $target=>$source){
                if (isset($qresult[$source])){
                    $result[$target] = $qresult[$source];
                }
            }
        }
        return $result;
    }
    
    function getDefaultKematian($params){
        //params: $wniid, $fields
        $wniid = $params['selected_id'];
        $maps = array(
            'email'=>'email',
            'kematian_nomor_surat'=>'kematian_nomor_surat',
            'kematian_sebab'=>'kematian_sebab',
//            'pelapor_nama'=>'pelapor_nama',
//            'pelapor_alamat'=>'pelapor_alamat',
//            'pelapor_telepon'=>'pelapor_telepon',
//            'pelapor_hubungan'=>'pelapor_hubungan',
            'full_name'=>'full_name',
            'pemohon'=>'full_name',
            'birth_city'=>'birth_city',
            'birth_country'=>'birth_country',
            'birth_date'=>'birth_date',
            'jenkelid'=>'jenkelid',
//            'pkjaan_alamat'=>'pkjaan_alamat',
//            'pkjaan_id'=>'pkjaan_id',
//            'pkjaan_kodepos'=>'pkjaan_kodepos',
//            'pkjaan_kota'=>'pkjaan_kota',
//            'pkjaan_nama'=>'pkjaan_nama',
//            'pkjaan_namakantor'=>'pkjaan_namakantor',
//            'pkjaan_negara'=>'pkjaan_negara',
//            'pkjaan_provinsi'=>'pkjaan_provinsi',
//            'pkjaan_telepon'=>'pkjaan_telepon',
//            'pkjaan_nama'=>'pkjaan_nama',
//            "paspor_nomor"=>"paspor_nomor",
//            "paspor_no_register"=>"paspor_no_register",
//            "paspor_tpt_keluar"=>"paspor_tpt_keluar",
//            "paspor_tgl_keluar"=>"paspor_tgl_keluar",
//            "paspor_berlaku"=>"paspor_berlaku",
            'aluar_alamat'=>'aluar_alamat',
            'aluar_kota'=>'aluar_kota',
            'aluar_kodepos'=>'aluar_kodepos',
            'aluar_hp'=>'aluar_hp',
            'aluar_telepon'=>'aluar_telepon',
            'aindo_alamat'=>'aindo_alamat',
            'aindo_kota'=>'aindo_kota',
            'aindo_kodepos'=>'aindo_kodepos',
            'aindo_hp'=>'aindo_hp',
            'aindo_telepon'=>'aindo_telepon'
        );
        
        $sql = 'select id, hashid, data_wni from app_wni where id = :wniid';
        $params = array('wniid'=>$wniid);
        $qres = $this->mdb->QueryData('application', $sql, $params, 'record');
        if (isset($qres[0])){
            $qresult = json_decode($qres[0]['data_wni'], true);
            $qresult['ortu_ada'] = "1";
            $qresult['ortu_wn'] = "ID";
            $result = array();
            foreach($maps as $target=>$source){
                if (isset($qresult[$source])){
                    $result[$target] = $qresult[$source];
                }
            }
        }
        return $result;
    }
    
    function getAttachType($nm_layanan){
        $result = array();
        $sql = "select *  from app_layanan_attype where nama_layanan = :nm_layanan ";
        $params = array('nm_layanan'=>$nm_layanan);
        $qres = $this->mdb->QueryData('application', $sql, $params, 'record');
        if (isset($qres[0])){
            foreach($qres as $row){
                array_push($result, $row['attch_type']);
            }
        }
        return $result;
    }
    
    function getLastLynId($wniid, $attch_type){
        $result = false;
        $sql = "select * from app_wni_attch 
            where wniid = :wniid and attch_type_id = :attch_type 
            order by last_update desc";
        $params = array('wniid'=>$wniid, 'attch_type'=>$attch_type);
        $qres = $this->mdb->QueryData('application', $sql, $params, 'record');
        if (isset($qres[0])){
            $result = $qres[0]['wni_layanan_id'];
        }
        return $result;
    }
    
    function copyAttachmemnt($wniid, $attch_type, $lyn_id, $to_lyn_id){
        $sql = "
            insert into wni_layanan_attch (attch_type_id, wni_layanan_id, fileid, hashid)
            select attch_type_id, :to_layanan_id, fileid, hashid 
              from app_wni_attch
              where wniid = :wniid and wni_layanan_id = :wni_layanan_id and attch_type_id = :attch_type
        ";
        $params = array('to_layanan_id'=>$to_lyn_id, 'wniid'=>$wniid, 
            'wni_layanan_id'=>$lyn_id, 'attch_type'=>$attch_type
        );
        //$result = $this->mdb->QueryData('application', $sql, $params, 'record');
        $this->mdb->ExecSQL('application', $sql, $params);
    } 
    
    function addDefaultAttachment($params){
    //function addDefaultAttachment($nm_layanan, $wniid, $wni_layanan_id){
        $nm_layanan = $params['nama_layanan'];
        $wniid = $params['selected_id'];
        $wni_layanan_id = $params['new_id'];
        
        $type_list = $this->getAttachType($nm_layanan);
        foreach($type_list as $item){
            $last_lyn_id = $this->getLastLynId($wniid, $item);
            if ($last_lyn_id!==false){
                $this->copyAttachmemnt($wniid, $item, $last_lyn_id, $wni_layanan_id);
            }
        }
    }
    
    function doSaveUpdateAnak($params,$datawni){
	$olddatawni=$this->getDataWni((float)$datawni['wnianak_id']);
	$datalayanan=$this->getDataLayanan($params['lyn_id']);
	$newdatawni=array();
	//array untuk filter field
	$field_wni=array(
	"full_name"=>"",
	"alias_name"=>"",
	"email"=>"",
	"jenkelid"=>"",
	"statuskawinid"=>"",
	"birth_date"=>"",
	"birth_place"=>"",
	"pkjaan_nama"=>"",
	"pkjaan_namakantor"=>"",
	"pkjaan_telepon"=>"",
	"pkjaan_alamat"=>"",
	"pkjaan_kota"=>"",
	"pkjaan_kodepos"=>"",
	"aluar_alamat"=>"",
	"aluar_kota"=>"",
	"aluar_kodepos"=>"",
	"aluar_telepon"=>"",
	"aluar_hp"=>"",
	"aindo_alamat"=>"",
	"alamat_indo"=>"",
	"aindo_kota"=>"",
	"aindo_kodepos"=>"",
	"aindo_telepon"=>"",
	"aindo_hp"=>"",
	"kluar_nama"=>"",
	"kluar_alamat_sama"=>"",
	"kluar_alamat"=>"",
	"kluar_kota"=>"",
	"kluar_kodepos"=>"",
	"kluar_telepon"=>"",
	"kluar_hp"=>"",
	"kindo_nama"=>"",
	"kindo_alamat_sama"=>"",
	"kindo_alamat"=>"",
	"kindo_kota"=>"",
	"kindo_kodepos"=>"",
	"kindo_telepon"=>"",
	"kindo_hp"=>"",
	"ayah_ada"=>"",
	"ayah_nama"=>"",
	"kewarganegaraan_ayah"=>"",
	"ayah_tpt_lahir"=>"",
	"ayah_tgl_lahir"=>"",
	"ayah_tgl_lahir"=>"",
	"ayah_alamat"=>"",
	"ayah_kota"=>"",
	"ayah_kode_pos"=>"",
	"ayah_telepon"=>"",
	"ayah_hp"=>"",
	"ibu_ada"=>"",
	"ibu_nama"=>"",
	"kewarganegaraan_ibu"=>"",
	"ibu_tpt_lahir"=>"",
	"ibu_tgl_lahir"=>"",
	"ibu_alamat"=>"",
	"ibu_kota"=>"",
	"ibu_kodepos"=>"",
	"ibu_telepon"=>"",
	"ibu_hp"=>""
	); 
	
	foreach($datalayanan as $key=>$value){
		foreach($field_wni as $key2=>$value2){
			if($key==$key2){
			//mendapatkan data layanan yg sesuai wni
				$newlayanan[$key2]=$datalayanan[$key];
				//print_r(array("q"=>$datalayanan[$key])); die();
			}
		}
	
	}
	
	$newdatawni=array();
	foreach($olddatawni as $field_wni_lama=>$value_wni){
		foreach($newlayanan as $field_layanan=>$value_layanan){
			if($field_layanan==$field_wni_lama){
				unset($olddatawni[$field_wni_lama]);
			}
		}
	}
	$newdatawni=$olddatawni;
	$newdatawni=array_merge($newlayanan,$newdatawni);
	
	$xparams=array(
	"wnianak_id"=>(float)$datalayanan['wnianak_id'],
	"data_wni"=>json_encode($newdatawni),
	);
	$sql="update app_wni set data_wni=:data_wni 
	      where 
		  id=:wnianak_id;
	";
	 $this->mdb->ExecSQL('application', $sql, $xparams);
    }
    
    function updateDataLayananById($lyn_id, $dataparams){
        $vsql = "select * from wni_layanan where layananidhash = :lyn_id";
        $vdata = $this->mdb->QueryData('application', $vsql, array('lyn_id'=>$lyn_id), 'record');
        if (isset($vdata[0])){
            
			if (!$vdata[0]['data_layanan']){
				$xdata = array();
			} else {
                $xdata = json_decode($vdata[0]['data_layanan'], true);
                if (!$xdata){
                    throw new Exception('Ada masalah dengan data layanan. Data tidak bisa disimpan.');
                }
            }
            $xdataparams = array_merge($xdata, $dataparams);
            $data_layanan = json_encode($xdataparams);
            $xparams = array('lyn_id'=>$lyn_id, 'data_layanan'=>$data_layanan);
            $xsql = "update wni_layanan 
                set data_layanan = :data_layanan
                where layananidhash = :lyn_id;
            ";
            $this->mdb->ExecSQL('application', $xsql, $xparams);
            
        }
    }   
    function doSaveInsertAnak($datawni, $wni_lyn_id, $nama_layanan){
		if(empty($datawni['jenkel_id'])==true){
			 unset($datawni['jenkel_id']);
		}
		
		if(empty($datawni['jenkelid'])==true){
			 unset($datawni['jenkelid']);
		}
		if(empty($datawni['statuskawinid'])==true){
			 unset($datawni['statuskawinid']);
		}
		
        $sql = "select 0;
            insert into app_wni(data_wni) values(:data_wni);
            update app_wni set hashid = md5('app_wni'||:sys_hashkey||cast(currval('app_wni_id_seq') as character varying))
            where id = currval('app_wni_id_seq');
            
            select currval('app_wni_id_seq') as wnianak_id;
        ";
        $params = array('data_wni'=>json_encode($datawni));
        $qres = $this->mdb->QueryData('application', $sql, $params, 'record');
        $wnianak_id = $qres[0]['wnianak_id'];
        $data = array('wnianak_id'=>$wnianak_id);
        $this->updateDataLayananById($wni_lyn_id, $data);
        $this->doCopyAttachmentWni($wni_lyn_id, $wnianak_id, $nama_layanan);
        
    }
    
    function doCopyAttachmentWni($wni_layanan_id, $wniid, $nama_layanan){
        $sql = "insert into app_wni_attch(attch_type_id, wniid, nama_layanan, wni_layanan_id, fileid, hashid)
            select attch_type_id, :wniid, :nama_layanan, wni_layanan_id, fileid, hashid
            from wni_layanan_attch where wni_layanan_id = :wni_layanan_id
        ";
        $params = array('wniid'=>$wniid, 'nama_layanan'=>$nama_layanan, 'wni_layanan_id'=>$wni_layanan_id);
        $this->mdb->ExecSQL('application', $sql, $params);
    }
    
	public function getNamaLayanan($params){
	//$sql="select nama from "
	}
	
    function updateDataAnak($params){
        $data = $this->getDataLayanan($params['lyn_id']);
        
        $wni_lyn_id = $data['id'];
        $striplist = array('command', 'crudname', 'actionname', 'undefined', 'nama_layanan', 'description',
            'catatan', 'catatan_status', 'catatan2', 'statusname', 'createtime', 'last_update', 'last_username',
            'regid', 'username', 'id', 'wniid', 'layananidhash');
        //mapping source=>target
        $params['constant_1'] = 1;
        $params['constant_0'] = 0;
        $xmaps = array(
            'anak_nama_lengkap'=>'full_name',
            'anak_jenis_kelamin'=>'jenkelid',
            'anak_tempat_lahir'=>'birth_city',
            'anak_tanggal_lahir'=>'birth_date',
            'pbaru_nomor'=>'paspor_nomor',
            'constant_1'=>'paspor_status',
            'pbaru_noreg'=>'paspor_no_register',
            'pbaru_tpt_keluar'=>'paspor_tpt_keluar',
            'pbaru_tgl_keluar'=>'paspor_tgl_keluar',
            'pbaru_berlaku'=>'paspor_berlaku'
        );
        $datawni = array();
        foreach($data as $source=>$value){
            if (isset($xmaps[$source])){
                $target = $xmaps[$source];
            } else {
                $target = $source;
            }
            $datawni[$target] = $value;
        }
		//echo "<pre>";
		//print_r($data);
		//echo "<pre>";
		//die();
		
		
        if (isset($datawni['wnianak_id']) and ($datawni['wnianak_id'])){
			$category=$datawni['nama_layanan'];
			$history=$this->getDataWni((int)$datawni['wnianak_id']); 
			$this->saveHistory($category, $datawni['wnianak_id'], $datawni['id'], $history);
			//die(); cek data di app_history apakah sudah masuk
            $this->doSaveUpdateAnak($params, $datawni);
			
        } else {
            $this->doSaveInsertAnak($datawni, $wni_lyn_id, $params['nama_layanan']);
        }
    }   
     
public function updateToSiapAmbil($params){
	print_r($params); die();
}	 
}