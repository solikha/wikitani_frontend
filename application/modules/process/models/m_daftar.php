<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/* Manggu Framework
 * Simple PHP Application Development
 * Kusnassriyanto S. Bahri
 * kusnassriyanto@gmail.com
 * 
 */

class M_daftar extends M_process
{
    var $processDefinition = array();
    public function __construct()
    {
        parent::__construct();
        // setting timezone.
        $this->viewFolder = 'process/daftar';
        $this->procDef = array('procname'=>'daftar', 
            'title'=>'Pendaftaran Pelanggan', 'subtitle'=>'-');
        $this->procFlow = $this->processFlow();
    }
    
    function processFlow(){
        $result = array(
            'taskdefs'=>array(
                'firstnode'=>'daftar',
                'nodes'=>array(
                    'daftar'=>array('status'=>'draft', 'caption'=>'Input Data Pelanggan', 'progress'=>'1 of 5'),
                    'survey'=>array('status'=>'process', 'caption'=>'Survei Pelanggan', 'progress'=>'2 of 5'),
                    'kontrak'=>array('status'=>'process', 'caption'=>'Pembuatan Kontrak', 'progress'=>'3 of 5'),
                    'workorder'=>array('status'=>'process', 'caption'=>'Pembuatan Workorder', 'progress'=>'4 of 5'),
                    'pemasangan'=>array('status'=>'process', 'caption'=>'Pemasangan', 'progress'=>'5 of 5'),
                    'addjobsite'=>array('status'=>'draft', 'caption'=>'Data Jobsite', 'progress'=>'1 of 5', 'Penambahan Jobsite'),
                    'payment'=>array('status'=>'process', 'caption'=>'Pembayaran', 'progress'=>'4 of 5'),
                    'print'=>array('status'=>'process', 'caption'=>'Printing', 'progress'=>'Process'),
                    'finish'=>array('status'=>'finish', 'caption'=>'Selesai', 'progress'=>'Finish')
                ),
                'flows'=>array(
                    array('start'=>'daftar', 'end'=>'survey', 'flow'=>'next'),
                    array('start'=>'survey', 'end'=>'kontrak', 'flow'=>'next'),
                    array('start'=>'survey', 'end'=>'daftar', 'flow'=>'back'),
                    array('start'=>'survey', 'end'=>'addjobsite', 'flow'=>'back', 'option'=>'jobsite'),
                    array('start'=>'kontrak', 'end'=>'survey', 'flow'=>'back'),
                    array('start'=>'kontrak', 'end'=>'payment', 'flow'=>'next'),
                    array('start'=>'payment', 'end'=>'kontrak', 'flow'=>'back'),
                    array('start'=>'payment', 'end'=>'pemasangan', 'flow'=>'next'),
                    array('start'=>'workorder', 'end'=>'pemasangan', 'flow'=>'next'),
                    array('start'=>'workorder', 'end'=>'kontrak', 'flow'=>'back'),
                    array('start'=>'pemasangan', 'end'=>'finish', 'flow'=>'next'),
                    array('start'=>'pemasangan', 'end'=>'payment', 'flow'=>'back'),
                    array('start'=>'addjobsite', 'end'=>'survey', 'flow'=>'next'),
                    array('start'=>'payment', 'end'=>'*', 'flow'=>'next')
                )
            ),
            'stepdefs' => array(
                'daftar' => array(
                    'firstnode'=>'pelanggan',
                    'nodes'=>array(
                        'pelanggan' =>array('viewname'=>'daftar_pelanggan', 'caption'=>'Input Data Pelanggan (Detail Pelanggan)'),
                        'pemasangan' =>array('viewname'=>'daftar_pemasangan', 'caption'=>'Input Data Pelanggan (Pemasangan)'),
                        'keluarga' =>array('viewname'=>'daftar_keluarga', 'caption'=>'Input Data Pelanggan (Keluarga)'),
                        'administrasi' =>array('viewname'=>'daftar_administrasi', 'caption'=>'Input Data Pelanggan (Administrasi)'),
                        'konfirmasi' =>array('viewname'=>'daftar_konfirmasi', 'caption'=>'Konfirmasi Data Pelanggan (Konfirmasi)')
                    ),
                    'flows' => array(
                       array('start'=>'pelanggan', 'end'=>'pemasangan', 'flow'=>'next'),
                       array('start'=>'pemasangan', 'end'=>'pelanggan', 'flow'=>'back'),
                       array('start'=>'pemasangan', 'end'=>'keluarga', 'flow'=>'next'),
                       array('start'=>'keluarga', 'end'=>'pemasangan', 'flow'=>'back'),
                       array('start'=>'keluarga', 'end'=>'administrasi', 'flow'=>'next'),
                       array('start'=>'administrasi', 'end'=>'keluarga', 'flow'=>'back'),
                       array('start'=>'administrasi', 'end'=>'konfirmasi', 'flow'=>'next'),
                       array('start'=>'konfirmasi', 'end'=>'administrasi', 'flow'=>'back'),
                       array('start'=>'konfirmasi', 'end'=>'*', 'flow'=>'next'),
					   
                    )
                ),
                'survey' => array(
                    'firstnode'=>'pelanggan',
                    'nodes'=>array(
                        'pelanggan' =>array('viewname'=>'survey_pelanggan', 'caption'=>'Survey Pelanggan'),
                        'hasil' =>array('viewname'=>'survey_hasil', 'caption'=>'Input Hasil Survey'),
                        'rekomendasi' =>array('viewname'=>'survey_rekomendasi', 'caption'=>'Input Rekomendasi Layanan'),
                        'konfirmasi' =>array('viewname'=>'survey_konfirmasi', 'caption'=>'Konfirmasi Data Survey')
                    ),
                    'flows' => array(
                       array('start'=>'pelanggan', 'end'=>'*', 'flow'=>'back'),
                       array('start'=>'pelanggan', 'end'=>'hasil', 'flow'=>'next'),
                       array('start'=>'hasil', 'end'=>'pelanggan', 'flow'=>'back'),
                       array('start'=>'hasil', 'end'=>'rekomendasi', 'flow'=>'next'),
                       array('start'=>'rekomendasi', 'end'=>'hasil', 'flow'=>'back'),
                       array('start'=>'rekomendasi', 'end'=>'konfirmasi', 'flow'=>'next'),
                       array('start'=>'konfirmasi', 'end'=>'rekomendasi', 'flow'=>'back'),
                       array('start'=>'konfirmasi', 'end'=>'*', 'flow'=>'next')
                    )
                ),
                'kontrak' => array(
                    'firstnode'=>'pelanggan',
                    'nodes'=>array(
                        'pelanggan' =>array('viewname'=>'kontrak_pelanggan', 'caption'=>'Input Nomor Kontrak'),
                        'download' =>array('viewname'=>'kontrak_download', 'caption'=>'Verifikasi Data Kontrak'),
                        'upload' =>array('viewname'=>'kontrak_upload', 'caption'=>'Upload Kontrak'),
                        'konfirmasi' =>array('viewname'=>'kontrak_konfirmasi', 'caption'=>'Konfirmasi Kontrak')
                    ),
                    'flows' => array(
                       array('start'=>'pelanggan', 'end'=>'*', 'flow'=>'back'),
                       array('start'=>'pelanggan', 'end'=>'konfirmasi', 'flow'=>'next'),
                       array('start'=>'konfirmasi', 'end'=>'pelanggan', 'flow'=>'back'),
                       array('start'=>'konfirmasi', 'end'=>'*', 'flow'=>'next')
                    )
                ),
                'payment' => array(
                    'firstnode'=>'payment',
                    'nodes'=>array(
                        'payment' =>array('viewname'=>'payment_payment', 'caption'=>'Konfirmasi Pembayaran'),
                        'konfirmasi' =>array('viewname'=>'payment_konfirmasi', 'caption'=>'Konfirmasi Pembayaran')
                    ),
                    'flows' => array(
                       array('start'=>'payment', 'end'=>'*', 'flow'=>'back'),
                       array('start'=>'payment', 'end'=>'konfirmasi', 'flow'=>'next'),
                       array('start'=>'konfirmasi', 'end'=>'payment', 'flow'=>'back'),
                       array('start'=>'konfirmasi', 'end'=>'*', 'flow'=>'next')
                    )
                ),
                'pemasangan' => array(
                    'firstnode'=>'pelanggan',
                    'nodes'=>array(
                        'pelanggan' =>array('viewname'=>'pemasangan_pelanggan', 'caption'=>'Pemasangan'),
                        'hasil' =>array('viewname'=>'pemasangan_hasil', 'caption'=>'Hasil Pemasangan'),
                        'konfirmasi' =>array('viewname'=>'pemasangan_konfirmasi', 'caption'=>'Konfirmasi Pemasangan')
                    ),
                    'flows' => array(
                       array('start'=>'pelanggan', 'end'=>'*', 'flow'=>'back'),
                       array('start'=>'pelanggan', 'end'=>'hasil', 'flow'=>'next'),
                       array('start'=>'hasil', 'end'=>'pelanggan', 'flow'=>'back'),
                       array('start'=>'hasil', 'end'=>'konfirmasi', 'flow'=>'next'),
                       array('start'=>'konfirmasi', 'end'=>'hasil', 'flow'=>'back'),
                       array('start'=>'konfirmasi', 'end'=>'*', 'flow'=>'next')
                    )
                ),
                'addjobsite' => array(
                    'firstnode'=>'addjobsite',
                    'nodes'=>array(
                        'addjobsite' =>array('viewname'=>'jobsite_pengisian', 'caption'=>'Input Pemasangan'),
                        'konfirmasi' =>array('viewname'=>'jobsite_konfirmasi', 'caption'=>'Konfirmasi Pemasangan')
                    ),
                    'flows' => array(
                       array('start'=>'addjobsite', 'end'=>'*', 'flow'=>'back'),
                       array('start'=>'addjobsite', 'end'=>'konfirmasi', 'flow'=>'next'),
                       array('start'=>'konfirmasi', 'end'=>'addjobsite', 'flow'=>'back'),
                       array('start'=>'konfirmasi', 'end'=>'*', 'flow'=>'next')
                    )
                ),
                'print' => array(
                    'firstnode'=>'pelanggan',
                    'nodes'=>array(
                        'print_survey' =>array('viewname'=>'survey_print', 'caption'=>'Survey Pelanggan'),
                        'pemasangan' =>array('viewname'=>'survey_hasil', 'caption'=>'Input Hasil Survey')
                    ),
                    'flows' => array(
                    )
                )
            )
        );
        return $result;
    }
    
    public function getFirstTask(){
        $fnode = $this->getFirstNode($this->procFlow['taskdefs']);
        $taskname = $fnode['firstnode'];
        $status = $fnode['status'];

        $fnode = $this->getFirstNode($this->procFlow['stepdefs'][$taskname]);
        $stepname = $fnode['firstnode'];
        
        $result = array();
        $result['taskname'] = $taskname;
        $result['status'] = $status;
        $result['stepname'] = $stepname;
        return $result;
        //return array('taskname'=>'daftar', 'stepname'=>'', 'status'=>'draft');
    }
    
    public function getViewName($taskname, $stepname){
        // get view name
        $viewname = '';
        if (isset($this->procFlow['stepdefs'][$taskname])){
            $steps = $this->procFlow['stepdefs'][$taskname];
            if($stepname===''){
                $step = $steps['firstnode'];
            } else {
                $step = $stepname;
            }
            if (isset($steps['nodes'][$step]['viewname'])){
                $viewname = $steps['nodes'][$step]['viewname'];
            }
        }
        if ($viewname===''){
            if(isset($this->procFlow['taskdefs']['nodes'][$taskname]['viewname'])){
                $viewname = $this->procFlow['taskdefs']['nodes'][$taskname]['viewname'];
            }
        }
		//print_r(array('taskname'=>$taskname,
		//  'stepname' =>$stepname,
		//  'viewname' =>$viewname
		//)); die;
        return $viewname;
        
//        if ($taskname=='daftar'){
//            return 'daftarplg';
//            return 'vdaftar_pelanggan';
//        } else if ($taskname=='add_jobsite'){
//            return 'vdaftar_jobsite';
//        } else {
//            return '';
//        }
    }
    
    function findByFlow($data, $node, $flow){
        $result = '';
        foreach ($data['flows'] as $item){
            if(($item['start']==$node) and ($item['flow']==$flow)){
                //echo "ketemu";
                $result = $item['end'];
                break;
            }
        }
//        var_dump($node);
//        var_dump($flow);
//        var_dump($result);
        return $result;
    }
    
    function getFirstNode(&$flowinfo){
        $firstnode = $flowinfo['firstnode'];
        if (isset($flowinfo['nodes'][$firstnode])){
            $result = $flowinfo['nodes'][$firstnode];
        } else {
            $result = array();
        }
        $result['firstnode'] = $firstnode;
        return $result;
    }
    
    // daftar -> survey -> kontrak -> workorder -> pemasangan -> finish
    public function getNextTask($taskname, $flowname){
	  //var_dump($taskname); var_dump($flowname); var_dump($this->procNewData['startname'] );
		if(($taskname == 'survey')
			and ($flowname == 'back')
			and ($this->procNewData['startname'] ==  'addjobsite')){
			//echo "xxx";
			$result = 'addjobsite';
		} else {
			$data = $this->procFlow['taskdefs'];
			$result = $this->findByFlow($data, $taskname, $flowname);
			//var_dump($result);
		}
        if ($result===''){
            throw new MgException('check task', 'Next Task tidak diketemukan');
        }
		//var_dump($result); die;
        return $result;
    }
    
    public function getNextStep($taskname, $stepname, $flowname){
        if (isset($this->procFlow['stepdefs'][$taskname])){
            $data = $this->procFlow['stepdefs'][$taskname];
            //print_r($data);
            if($stepname===''){
                $stepname=$data['firstnode'];
            }
            $result = $this->findByFlow($data, $stepname, $flowname);
            if ($result=='*'){
                $result = '';
            }
        } else {
            $result = '';
        }
        return $result;
    }
    
    public function loadView($taskname, $stepname, $data){
	
        $this->load->model('crud/m_crud', 'mcrud');
        $this->mcrud->ismodal = true;
		
        $viewname = $this->getViewName($taskname, $stepname);
        $crudname = 'proc_daftar';
        $actionname = $viewname;
        $this->mcrud->defaultParams = array_merge($this->procData, $data['info']);
        //var_dump($stepname); die;
        //print_r($this->mcrud->defaultParams); die;
        //$this->mcrud->defaultParams['taskname'] = 
        //array('taskname'=>$taskname, 'stepname'=>$stepname);
        $result = $this->mcrud->showCommand($crudname, $viewname, true);
        return $result;
        
//            $viewname = $this->getViewName($taskname, $stepname);
//            if($this->viewFolder!==''){
//                $viewname = $this->viewFolder.'/'.$viewname;
//            }
//            $this->load->view($viewname, $data);
//            $this->load->view('process/vscripts', $data);
    }
    
    public function getStatusDef($taskname){
        //var_dump($this->procFlow['taskdefs']['nodes'][$taskname]);
        if (isset($this->procFlow['taskdefs']['nodes'][$taskname]['status'])){
            $result = $this->procFlow['taskdefs']['nodes'][$taskname]['status'];
        } else {
            $result = '';
        }
        return $result;
    }
    
    public function getStepInfo($taskname, $stepname){
        $result = array();
        if (isset($this->procFlow['taskdefs']['nodes'][$taskname]['status'])){
            $status = $this->procFlow['taskdefs']['nodes'][$taskname]['status'];
        } else {
            $status = 'process';
        }
        if (isset($this->procFlow['taskdefs']['nodes'][$taskname]['rolename'])){
            $rolename = $this->procFlow['taskdefs']['nodes'][$taskname]['rolename'];
        } else {
            $rolename = 'admin';
        }
        if (isset($this->procFlow['stepdefs'][$taskname])){
            $steps = $this->procFlow['stepdefs'][$taskname];
            if($stepname===''){
                $step = $steps['firstnode'];
            } else {
                $step = $stepname;
            }
            if (isset($steps['nodes'][$step])){
                $result = $steps['nodes'][$step];
            }
        }
        if(!isset($result['status'])){
            $result['status'] = $status;
        }
        if(!isset($result['rolename'])){
            $result['rolename'] = $rolename;
        }
        return $result;
        
    }
    
    public function beforeSaveData(){
        // dipanggil sebelum data disimpan
//        if (isset($this->procNewData['jenis_daftar'])){
//            $judul = $this->procNewData['jenis_daftar'];
//        } else {
//            $judul = 'Pendaftaran : ';
//        }
//        $judul = $judul.$this->procNewData['nama'];
//        $this->procNewData['title'] = $judul;
        $this->procNewData['title'] = $this->getTitle($this->procNewData['next_taskname']);
        $this->procNewData['subtitle'] = $this->getCaption($this->procNewData['next_taskname'], 
            $this->procNewData['next_stepname']);
        $this->procNewData['progress'] = $this->getProgress($this->procNewData['next_taskname'], 
            $this->procNewData['next_stepname']);
		$this->savePelanggan();
		$this->savePemasangan();
    }
	
	public function savePelanggan(){
	
		if(!isset($this->procNewData['cust_id'])){
		//echo "INSERT PELANGGAN OK"; 
		
			$sql ="SELECT 0;
						INSERT INTO app_customer (jpelanggan_id, nama, jpengenal_id, nomor_pengenal, alamat, kode_pos, provinsi_id,
						kota_id, rt_rw, kelurahan, kecamatan, tempat_lahir, tanggal_lahir, telepon_rumah, telepon_kantor, telepon_hp, 
						tanggal_survey)
						VALUES (:jpelanggan_id, :nama, :jpengenal_id, :nomor_pengenal, :alamat, :kode_pos, :provinsi_id, :kota_id, :rt_rw, 
						:kelurahan, :kecamatan, :tempat_lahir, to_date(:tanggal_lahir, 'DD-MM-YYYY'), :telepon_rumah, :telepon_kantor, 
						:telepon_hp, to_date(:tanggal_survey, 'DD-MM-YYYY'));
						select currval('app_customer_id_seq') as cust_id;";
						
			$params = array("jpelanggan_id"=>"", "nama"=>"", "jpengenal_id"=>"", "nomor_pengenal"=>"", "alamat"=>"", "kode_pos"=>"", 
						"provinsi_id"=>"", "kota_id"=>"", "rt_rw"=>"", "kelurahan"=>"", "kecamatan"=>"", "tempat_lahir"=>"", 
						"tanggal_lahir"=>"", "telepon_rumah"=>"", "telepon_kantor"=>"", "telepon_hp"=>"", "tanggal_survey"=>"");
						
			$params = array_merge($params, $this->procNewData);
			//$params = $this->procNewData;
			$result = $this->mdb->QueryData('application', $sql, $params, 'record');
			//var_dump( $result[0]);
			$this->procNewData['cust_id'] = $result[0]['cust_id'];
		
		} else {
		//echo "UPDATE PELANGGAN OK"; 
			$sql = "UPDATE app_customer set jpelanggan_id=:jpelanggan_id, nama=:nama, jpengenal_id=:jpengenal_id,
						nomor_pengenal=:nomor_pengenal, alamat=:alamat, kode_pos=:kode_pos, provinsi_id=:provinsi_id, kota_id=:kota_id, 
						rt_rw=:rt_rw, kelurahan=:kelurahan, kecamatan=:kecamatan, tempat_lahir=:tempat_lahir,
						tanggal_lahir= to_date(:tanggal_lahir, 'DD-MM-YYYY'), 
						telepon_rumah=:telepon_rumah, telepon_kantor=:telepon_kantor, telepon_hp=:telepon_hp, 
						nama_perusahaan=:nama_perusahaan, tgh_alamat=:tgh_alamat, tgh_kode_pos=:tgh_kode_pos, 
						tgh_provinsi_id=:tgh_provinsi_id, tgh_kota_id=:tgh_kota_id, tgh_rt_rw=:tgh_rt_rw, tgh_kelurahan=:tgh_kelurahan, 
						tgh_kecamatan=:tgh_kecamatan, tgh_telepon_rumah=:tgh_telepon_rumah, klg_nama=:klg_nama, 
						klg_alamat=:klg_alamat, klg_kode_pos=:klg_kode_pos, klg_provinsi_id=:klg_provinsi_id, klg_kota_id=:klg_kota_id, 
						klg_rt_rw=:klg_rt_rw, klg_kelurahan=:klg_kelurahan, klg_kecamatan=:klg_kecamatan, 
						klg_telepon_rumah=:klg_telepon_rumah, klg_telepon_kantor=:klg_telepon_kantor, klg_telepon_hp=:klg_telepon_hp, 
						kode_pelanggan=:kode_pelanggan, nama_sales=:nama_sales, kode_penjualan=:kode_penjualan, 
						nama_petugas_survey=:nama_petugas_survey, tanggal_survey=to_date(:tanggal_survey, 'DD-MM-YYYY')
						where id=:cust_id";
						
			$params = array("jpelanggan_id"=>"", "nama"=>"", "jpengenal_id"=>"", "nomor_pengenal"=>"", "alamat"=>"", "kode_pos"=>"", 
						"provinsi_id"=>"", "kota_id"=>"", "rt_rw"=>"", "kelurahan"=>"", "kecamatan"=>"", "tempat_lahir"=>"", 
						"tanggal_lahir"=>"", "telepon_rumah"=>"", "telepon_kantor"=>"", "telepon_hp"=>"", "nama_perusahaan"=>"", 
						"tgh_alamat"=>"", "tgh_kode_pos"=>"", "tgh_provinsi_id"=>"", "tgh_kota_id"=>"", "tgh_rt_rw"=>"", "tgh_kelurahan"=>"", 
						"tgh_kecamatan"=>"", "tgh_telepon_rumah"=>"", "klg_nama"=>"", "klg_alamat"=>"", "klg_kode_pos"=>"", 
						"klg_provinsi_id"=>"", "klg_kota_id"=>"", "klg_rt_rw"=>"", "klg_kelurahan"=>"", "klg_kecamatan"=>"", 
						"klg_telepon_rumah"=>"", "klg_telepon_kantor"=>"", "klg_telepon_hp"=>"", "kode_pelanggan"=>"",
						"nama_sales"=>"", "kode_penjualan"=>"", "nama_petugas_survey"=>"", "tanggal_survey"=>"");
						
                        $xparams = $this->getDefaultPelanggan($this->procNewData['cust_id']);
                        $params = array_merge($params, $xparams);
                        //print_r($params);
			$params = array_merge($params, $this->procNewData);
			//print_r($params); die;
			$result = $this->mdb->ExecSQL('application', $sql, $params, 'record');
			//var_dump( $result[0]);
		}
                
                
	}

        function getDefaultPelanggan($custid){
            $sql = "
                  select jpelanggan_id, nama, jpengenal_id, nomor_pengenal, alamat, 
                    kode_pos, provinsi_id, kota_id, rt_rw, kelurahan, kecamatan, 
                    tempat_lahir, to_char(tanggal_lahir, 'DD-MM-YYYY') as tanggal_lahir, 
                    telepon_rumah, telepon_kantor, telepon_hp, 
                    nama_perusahaan, tgh_alamat, tgh_kode_pos, tgh_provinsi_id, tgh_kota_id, 
                    tgh_rt_rw, tgh_kelurahan, tgh_kecamatan, tgh_telepon_rumah, klg_nama, 
                    klg_alamat, klg_kode_pos, klg_provinsi_id, klg_kota_id, klg_rt_rw, 
                    klg_kelurahan, klg_kecamatan, klg_tempat_lahir, 
                    to_char(klg_tanggal_lahir, 'DD-MM-YYYY') as klg_tanggal_lahir, 
                    klg_telepon_rumah, klg_telepon_kantor, klg_telepon_hp, kode_pelanggan, 
                    nama_sales, kode_penjualan, nama_petugas_survey
                    from app_customer where id = :custid
                ";
            $params = array('custid'=>$custid);
            $qresult = $this->mdb->QueryData('application', $sql, $params, 'record');
            if (isset($qresult[0])){
                $result = $qresult[0];
            } else {
                $result = array();
            }
            return $result;
        }
        
        function getDefaultPemasangan($jobsiteid){
            $sql = "
                  select nama as nama_jobsite, alamat as psg_alamat, 
                    provinsi_id as psg_provinsi_id, kota_id as psg_kota_id, 
                    cust_id, longitude, latitude, 
                    paket_id, rt_rw as psg_rt_rw, kelurahan as psg_kelurahan, 
                    kecamatan as psg_kecamatan, kode_pos as psg_kode_pos, no_telepon as psg_telepon_rumah, 
                    nomor_kontrak as kontrak_nomor, tanggal_kontrak as kontrak_tanggal, 
                    status_zona, status_cctv, last_upd_zona
                    from app_jobsite where id = :jobsite_id
                ";
            $params = array('jobsite_id'=>$jobsiteid);
            $qresult = $this->mdb->QueryData('application', $sql, $params, 'record');
            if (isset($qresult[0])){
                $result = $qresult[0];
            } else {
                $result = array();
            }
            return $result;
        }
        
	public function savePemasangan(){
	
		if(!isset($this->procNewData['jobsite_id'])){
		
			$sql ="SELECT 0;
						INSERT INTO app_jobsite(cust_id) VALUES(:cust_id);
						--INSERT INTO app_jobsite (nama_jobsite, psg_alamat, psg_provinsi_id, psg_kota_id, psg_kecamatan, psg_kelurahan, 
						--psg_rt_rw, psg_kode_pos, psg_telepon_rumah)
						--VALUES (:nama_jobsite, :psg_alamat, :psg_provinsi_id, :psg_kota_id, :psg_kecamatan, :psg_kelurahan, :psg_rt_rw, 
						--:psg_kode_pos, :psg_telepon_rumah);
						select currval('app_jobsite_id_seq') as jobsite_id;
						";
					
			$params = array("nama_jobsite"=>"", "psg_alamat"=>"", "psg_provinsi_id"=>"", "psg_kota_id"=>"", "psg_kecamatan"=>"", 
						"longitude"=>"", "latitude"=>"","psg_kelurahan"=>"", "psg_rt_rw"=>"", "psg_kode_pos"=>"", "psg_telepon_rumah"=>"",
						"kontrak_nomor"=>"", "kontrak_tanggal"=>"");
			
			$params = array_merge($params, $this->procNewData);		
			//$params = $this->procNewData;
			$result = $this->mdb->QueryData('application', $sql, $params, 'record');
			//var_dump( $result[0]);
			$this->procNewData['jobsite_id'] = $result[0]['jobsite_id'];
			
		} else {
			
			$sql = "UPDATE app_jobsite set nama=:nama_jobsite, alamat=:psg_alamat, provinsi_id=:psg_provinsi_id, 
						kota_id=:psg_kota_id, kecamatan=:psg_kecamatan, kelurahan=:psg_kelurahan, 
						rt_rw=:psg_rt_rw, kode_pos=:psg_kode_pos, no_telepon=:psg_telepon_rumah, nomor_kontrak=:kontrak_nomor,
                                                latitude = :latitude, longitude = :longitude,
						tanggal_kontrak=to_date(:kontrak_tanggal, 'DD-MM-YYYY') where id=:jobsite_id";
			
			$params = array("nama_jobsite"=>"", "psg_alamat"=>"", "psg_provinsi_id"=>"", "psg_kota_id"=>"", "psg_kecamatan"=>"", 
						"longitude"=>"", "latitude"=>"","psg_kelurahan"=>"", "psg_rt_rw"=>"", "psg_kode_pos"=>"", "psg_telepon_rumah"=>"", 
						"kontrak_nomor"=>"", "kontrak_tanggal"=>"");
						
			$xparams = $this->getDefaultPemasangan($this->procNewData['jobsite_id']);
                        $params = array_merge($params, $xparams);
                        
			$params = array_merge($params, $this->procNewData);
			//print_r($params); die;
			$result = $this->mdb->ExecSQL('application', $sql, $params, 'record');
			//var_dump( $result[0]);
		}
	}
    
    public function getCaption($taskname, $stepname){
        $result = '';
        if (isset($this->procFlow['stepdefs'][$taskname]['nodes'][$stepname]['caption'])){
            $result = $this->procFlow['stepdefs'][$taskname]['nodes'][$stepname]['caption'];
        } else {
            if (isset($this->procFlow['taskdefs']['nodes'][$taskname]['caption'])){
                $result = $this->procFlow['taskdefs']['nodes'][$taskname]['caption'];
            } else {
                if($stepname!==''){
                    $result = '$'.$taskname.'.'.$stepname;
                } else {
                    $result = $taskname;
                }
            }
        }
        return $result;
    }
    
    public function getProgress($taskname, $stepname){
        $result = '';
        if (isset($this->procFlow['stepdefs'][$taskname]['nodes'][$stepname]['progress'])){
            $result = $this->procFlow['stepdefs'][$taskname]['nodes'][$stepname]['progress'];
        } else {
            if (isset($this->procFlow['taskdefs']['nodes'][$taskname]['progress'])){
                $result = $this->procFlow['taskdefs']['nodes'][$taskname]['progress'];
            } else {
                $result = 'Process';
            }
        }
        return $result;
    }
    
    public function getTitle($taskname){
        $result = '';
        if (isset($this->procFlow['taskdefs']['nodes'][$taskname]['title'])){
            $result = $this->procFlow['taskdefs']['nodes'][$taskname]['title'];
        } else {
            //$result = 'Pendaftaran';
            $result = $this->procDef['title'];
        }
        return $result;
    }
    
}


?>
