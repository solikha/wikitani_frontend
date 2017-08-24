<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/* Manggu Framework
 * Simple PHP Application Development
 * Kusnassriyanto S. Bahri
 * kusnassriyanto@gmail.com
 * 
 */

class M_cprocess extends MY_Model {

    public function __construct() {
        parent::__construct();
		 $this->load->library('user_agent');
    }

    public function getLandmark($catid) {
        $sql = "select id, nama, category_id, longitude, latitude, alamat, deskripsi, no_telepon from app_landmark
            where category_id = :catid";
        $params = array('catid' => $catid);
        $result = $this->mdb->QueryData('application', $sql, $params, 'record');
        return $result;
    }

    public function processJobsite($zona_info) {
        $items = explode(", ", $zona_info);
        $result = '';
        foreach ($items as &$item) {
            $xitem = explode(":", $item);
            $yitem = array();
            if (isset($xitem[0])) {
                if (isset($xitem[1])) {
                    $yitem['zona'] = $xitem[0];
                    $yitem['status'] = $xitem[1];
                } else {
                    $yitem['zona'] = $xitem[0];
                    $yitem['status'] = 'normal';
                }
                if ($yitem['status'] == 'normal') {
                    $display = $yitem['zona'] . ": " . $yitem['status'];
                } else {
                    $display = $yitem['zona'] . ': <span class="badge badge-danger">' . $yitem['status'] . '</span>';
                }
                $yitem['display'] = $display;
                $item = $yitem;
            } else {
                $item = null;
            }
            if ($result !== '') {
                $result = $result . ', ';
            }
            //$result = $result.$yitem;
        }
        return $items;
    }

    public function getJobsite() {
        $sql = "select a.id, a.nama, a.alamat, a.longitude, a.latitude, b.nama as nama_kota,
            c.nama as nama_customer, d.zona_status, 
            case when status_count>1 then 'multi' when status_name='' then 'normal' else status_name end as nama_status,
            coalesce(d.updateid, 0) as updateid
            from app_jobsite a
            left join app_kota b on a.kota_id = b.id
            left join app_customer c on a.cust_id = c.id
            left join (
              select jobsite_id, max(coalesce(updateid, 0)) as updateid,
              string_agg(coalesce(nama, '')||':'||coalesce(status, 'normal'), ', ') as zona_status,
              string_agg(coalesce(case when status='normal' then '' else status end, ''), '') as status_name,
              sum(case when status = 'normal' or status is null or status='' then 0 else 1 end) as status_count
              from (select * from app_jobsite_zona order by nama) x
              group by jobsite_id
            ) d on a.id = d.jobsite_id
            ";
        $params = array();
        $result = $this->mdb->QueryData('application', $sql, $params, 'record');
        foreach ($result as &$item) {
            $item['zona_info'] = $this->processJobsite($item['zona_status']);
        }
        return $result;
    }

    public function showMapTracking() {
        $data = $this->getDefaultData();
        $data['dataPosJaga'] = $this->getLandmark('1');
        $data['dataHospital'] = $this->getLandmark('2');
        $data['dataJobsite'] = $this->getJobsite();
        $this->load->view('ccenter/vccenter', $data);
    }

	
	
	
	 function load_jobsite($id) {
        $param = array('jobsite_id' => $id);
        $sql = "select a.* ,b.nama as kota, c.nama as provinsi from app_jobsite a 
		left join app_kota b on a.kota_id=b.id
		left join app_provinsi c on a.provinsi_id=c.id
		where a.id = :jobsite_id";
        $qresult = $this->mdb->QueryData('application', $sql, $param, 'record')[0];
        return $qresult;
    }
	
	//function experimen
	 public function getsurveyexp($procid) {
		 $sql = "select 
		a.id as procid,b.nama as nama_kota,c.nama as nama_provinsi,
		CAST (procdata as json)->>'nama' AS nama_pelanggan,
		CAST (procdata as json)->>'nama_jobsite' AS nama_jobsite,
		CAST (procdata as json)->>'alamat' AS alamat,
		CAST (procdata as json)->>'psg_alamat' AS psg_alamat,
		CAST (procdata as json)->>'psg_kecamatan' AS psg_kecamatan,
		CAST (procdata as json)->>'psg_rt_rw' AS psg_rt_rw,
		CAST (procdata as json)->>'psg_kode_pos' AS psg_kode_pos,
		CAST (procdata as json)->>'psg_telepon_rumah' AS psg_telepon_rumah,
		CAST (procdata as json)->>'psg_kode_pos' AS psg_kode_pos,
		CAST (procdata as json)->>'psg_telepon_rumah' AS psg_telepon_rumah,
		CAST (procdata as json)->>'psg_kelurahan' AS psg_kelurahan,
		CAST (procdata as json)->>'longitude' AS longitude,
		CAST (procdata as json)->>'lattitude' AS lattitude,
		CAST (procdata as json)->>'tanggal_survey' AS tanggal_survey,
		CAST (procdata as json)->>'survey_depan' AS survey_depan,
		CAST (procdata as json)->>'survey_kiri' AS survey_kiri,
		CAST (procdata as json)->>'survey_kanan' AS survey_kanan,
		CAST (procdata as json)->>'survey_belakang' AS survey_belakang,
		CAST (procdata as json)->>'survey_catatan' AS survey_catatan,
		CAST (procdata as json)->>'survey_rkmd_paket' AS survey_rkmd_paket,
		CAST (procdata as json)->>'survey_rkmd_security' AS survey_rkmd_security,
		--CAST (procdata as json)->>'psg_provinsi_id' AS psg_provinsi_id,
		CAST (procdata as json)->>'psg_kota_id'  as json_kota_id,
		b.id as kota_id,
		CAST (procdata as json)->>'psg_kota_id' AS psg_kota_id,
		CAST (procdata as json)->>'survey_rkmd_peralatan' AS survey_rkmd_peralatan
		from app_process a
		left join app_kota b 
		on CAST (procdata as json)->>'psg_kota_id' = cast(b.id as character varying)
		left join app_provinsi c 
		on CAST (procdata as json)->>'psg_provinsi_id'	=cast(c.id as character varying)
		where a.id = :procid
            ";
      $params = array('procid' => $procid);
       $qresult = $this->mdb->QueryData('application', $sql, $params, 'record')[0];
        return $qresult;
	  
    }
	
	
	 public function getsurvey($procid) {
	  
	    $sql = "select 
		a.id as procid,b.nama as nama_kota,c.nama as nama_provinsi,
		CAST (procdata as json)->>'nama' AS nama_pelanggan,
		CAST (procdata as json)->>'nama_jobsite' AS nama_jobsite,
		CAST (procdata as json)->>'alamat' AS alamat,
		CAST (procdata as json)->>'psg_alamat' AS psg_alamat,
		CAST (procdata as json)->>'psg_kecamatan' AS psg_kecamatan,
		CAST (procdata as json)->>'psg_rt_rw' AS psg_rt_rw,
		CAST (procdata as json)->>'psg_kode_pos' AS psg_kode_pos,
		CAST (procdata as json)->>'psg_telepon_rumah' AS psg_telepon_rumah,
		CAST (procdata as json)->>'psg_kode_pos' AS psg_kode_pos,
		CAST (procdata as json)->>'psg_telepon_rumah' AS psg_telepon_rumah,
		CAST (procdata as json)->>'psg_kelurahan' AS psg_kelurahan,
		CAST (procdata as json)->>'longitude' AS longitude,
		CAST (procdata as json)->>'lattitude' AS lattitude,
		CAST (procdata as json)->>'tanggal_survey' AS tanggal_survey,
		CAST (procdata as json)->>'survey_depan' AS survey_depan,
		CAST (procdata as json)->>'survey_kiri' AS survey_kiri,
		CAST (procdata as json)->>'survey_kanan' AS survey_kanan,
		CAST (procdata as json)->>'survey_belakang' AS survey_belakang,
		CAST (procdata as json)->>'survey_catatan' AS survey_catatan,
		CAST (procdata as json)->>'survey_rkmd_paket' AS survey_rkmd_paket,
		CAST (procdata as json)->>'survey_rkmd_security' AS survey_rkmd_security,
		--CAST (procdata as json)->>'psg_provinsi_id' AS psg_provinsi_id,
		CAST (procdata as json)->>'psg_kota_id'  as json_kota_id,
		b.id as kota_id,
		CAST (procdata as json)->>'psg_kota_id' AS psg_kota_id,
		CAST (procdata as json)->>'survey_rkmd_peralatan' AS survey_rkmd_peralatan
		from app_process a
		left join app_kota b 
		on CAST (procdata as json)->>'psg_kota_id' = cast(b.id as character varying)
		left join app_provinsi c 
		on CAST (procdata as json)->>'psg_provinsi_id'	=cast(c.id as character varying)
		where a.id = :procid
            ";
      $params = array('procid' => $procid);
       $qresult = $this->mdb->QueryData('application', $sql, $params, 'record');
        return $qresult[0];
	  
    }
	
	public function getnamaprovinsi() {
	    $sql = "select nama as nama_provinsi2,id as provinsi_id from app_provinsi";
       $params = array();
       $result = $this->mdb->QueryData('application', $sql, $params, 'record')[0];
       return $result;  
    }
	
	public function getnamakota() {
	    $sql = "select nama from app_kota";
       $params = array();
       $result = $this->mdb->QueryData('application', $sql, $params, 'record');
       return $result;  
    }
	
	
    public function getJobsiteCCTV($jobsiteid) {
        $sql = "select a.id, a.nama as nama_jobsite, a.alamat, b.nama as nama_pelanggan 
            from app_jobsite a
            left join app_customer b on a.cust_id = b.id
            where a.id = :jobsiteid
            ";
        $params = array('jobsiteid' => $jobsiteid);
        $qresult = $this->mdb->QueryData('application', $sql, $params, 'record');
        if (isset($qresult[0])) {
            $result = $qresult[0];
            $sql = "select a.id as id_cctv, a.nama as nama_cctv, a.terminal_id, a.hardware_id,
                a.terminal_id || '/' || a.hardware_id as foto,
                a.nama as caption
                from app_jobsite_cctv a
                where a.jobsite_id = :jobsiteid
                  and a.terminal_id is not null
                  and a.hardware_id is not null
                ";
            $qresult = $this->mdb->QueryData('application', $sql, $params, 'record');
            if (isset($qresult[0])) {
                $result['images'] = $qresult;
            } else {
                $result['images'] = array();
            }
        } else {
            $result = array('id' => '', 'nama_jobsite' => '', 'alamat' => '', 'nama_pelanggan' => '',
                'images' => array());
        }
        return $result;
    }

    public function getJobsiteLookup() {
        $sql = "select a.id, a.nama as nama_jobsite, a.alamat, b.nama as nama_pelanggan 
            from app_jobsite a
            left join app_customer b on a.cust_id = b.id
            ";
        $params = array();
        $qresult = $this->mdb->QueryData('application', $sql, $params, 'record');
        $result = '';
        foreach ($qresult as $row) {
            if ($result !== '') {
                $result = $result . "\r\n";
            }
            $result = $result . '<option value="' . $row['id'] . '">' . $row['nama_jobsite'] . '(' . $row['nama_pelanggan'] . ')</option>';
        }
        return $result;
    }

    public function showCCTVMonitoring($jobsiteid = 0, $display = '', $random = 0) {
        $data = $this->getDefaultData();
        $cctvfolder = $this->ci->config->item('cctvfolder');
        //$data['image'] = array(array('foto' => 'images_001.jpg', 'caption' => 'gerbang'), array('foto' => 'images_002.jpg', 'caption' => 'pintu'), array('foto' => 'images_003.jpg', 'caption' => 'jendela'), array('foto' => 'images_004.jpg', 'caption' => 'atap'), array('foto' => 'images_005.jpg', 'caption' => 'halaman 1'), array('foto' => 'images_006.jpg', 'caption' => 'halaman 2'), array('foto' => 'images_007.jpg', 'caption' => 'kolam'));
        $data['cctv_non'] = $data['basedir'] . 'cctv/';
        $data['cctvdir'] = base_url() . 'index.php/ccenter/load_cctv/';
        $data['layoutid'] = $display;
        $data['jobsiteid'] = $jobsiteid;
        $data['jobsitelookup'] = $this->getJobsiteLookup();
        $data['cctvdata'] = $this->getJobsiteCCTV($jobsiteid);
        //print_r($data['cctvdata']);
        $data['cctv_url'] = $data['mainurl'] . 'menu/cctv_monitoring/';
        $data['image'] = $data['cctvdata']['images'];
        $this->load->view('ccenter/vcctv', $data);
    }

}

?>
