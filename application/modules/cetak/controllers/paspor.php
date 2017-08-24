<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/* Manggu Framework
 * Simple PHP Application Development
 * Kusnassriyanto S. Bahri
 * kusnassriyanto@gmail.com
 * 
 */

class paspor extends Print_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->helper('tool_helper');
    }

    public function index() {
        
    }

	public function getDataAnak($params){
	//echo "<pre>";
	//print_r($params); die();
	//echo "</pre>";
	return array(
	"full_name"=>getArrayDef($params['data_layanan'],'full_name'),
	"birth_place"=>getArrayDef($params['data_layanan'],'anak_tempat_lahir'),
	"birth_date"=>getArrayDef($params['data_layanan'],'anak_tanggal_lahir')
	);
	}
	
	public function getDataAyah($params){
	return array(
	"full_name"=>getArrayDef($params['data_layanan'],'full_name'),
	"birth_place"=>getArrayDef($params['data_layanan'],'birth_place'),
	"birth_date"=>getArrayDef($params['data_layanan'],'birth_date')
	);
	}

	
    public function cetak(){
		
        $this->load->model('m_cetak_paspor', 'mcetakpaspor');
        $this->load->model('crud/m_layanan', 'mlayanan');
		
		
		
        if (isset($_GET['lyn_id'])) {
		
		
            $lyn_id = $_GET['lyn_id'];
            $datakbri = $this->ci->config->item('kbri');
            $kotakbri = $datakbri['kota'];
            $datapaspor = $this->mcetakpaspor->loadWniLayanan($lyn_id);
			
			$dataanak=$this->getDataAnak($datapaspor);
			$datapemohon=$this->getDataAyah($datapaspor);
			
			
			/*
			if($datapaspor["data_layanan"]['layananid']==2){
			$dataanak=$this->getDataAnak($datapaspor);
			unset($datapaspor['data_paspor']['full_name']);
			unset($datapaspor['data_paspor']['birth_place']);
			unset($datapaspor['data_paspor']['birth_date']);
			$datapaspor["data_paspor"]=array_merge($dataanak,$datapaspor["data_paspor"]);
			}
			*/
			if(getArrayDef($datapaspor["data_layanan"],'layananid' == 2)){
			unset($datapaspor['data_paspor']['full_name']);
			unset($datapaspor['data_paspor']['birth_place']);
			unset($datapaspor['data_paspor']['birth_date']);
			$datapaspor["data_paspor"]=array_merge($dataanak,$datapaspor["data_paspor"]);	
			}else{
			unset($datapaspor['data_paspor']['full_name']);
			unset($datapaspor['data_paspor']['birth_place']);
			unset($datapaspor['data_paspor']['birth_date']);
			$datapaspor["data_paspor"]=array_merge($datapemohon,$datapaspor["data_paspor"]);
			}
			//die();
            $data['datalayanan'] = $datapaspor['data_layanan'];
            $data['datapaspor'] = $datapaspor['data_paspor'];
            $data['datapaspor']['full_name'] = getArrayDef($datapaspor['data_paspor'],'full_name');
			$data['datapaspor']['birth_date'] = getArrayDef($datapaspor['data_paspor'],'birth_date');	
		    $data['datapaspor']['birth_place'] = getArrayDef($datapaspor['data_paspor'],'birth_place');
			//echo "<pre>";
			//print_r($data["datalayanan"]);
			//echo "<pre>";
			//die();
			$data['datapaspor']['pbaru_nomor'] = getArrayDef($data['datalayanan'],'pbaru_nomor');
			$data['datapaspor']['pbaru_noreg'] = getArrayDef($data['datalayanan'],'pbaru_noreg');
			$data['datapaspor']['pbaru_nikm'] = getArrayDef($data['datalayanan'],'pbaru_nikm');
			$data['datapaspor']['pbaru_tgl_cetak'] = getArrayDef($data['datalayanan'],'pbaru_tgl_cetak');
			$data['datapaspor']['pbaru_tgl_keluar'] = getArrayDef($data['datalayanan'],'pbaru_tgl_keluar');
			$data['datapaspor']['pbaru_tpt_keluar'] = getArrayDef($data['datalayanan'],'pbaru_tpt_keluar');
			$data['datapaspor']['pbaru_berlaku'] = getArrayDef($data['datalayanan'],'pbaru_berlaku');
			$data['datapaspor']['jenis_kelamin'] = getArrayDef($data['datalayanan'],'jenis_kelamin');
			$data['datapaspor']['jenkelid'] = getArrayDef($data['datalayanan'],'jenkelid');
            $datafoto = $this->mlayanan->getfoto($lyn_id);
            $data['foto'] = $datafoto['filename'];
			//print_r($datafoto); die();
			
			/*
			menghindari error karena json ini
			{
			name: "",
			type: "",
			filename: "c:\xampp\htdocs\ekbri-brussel\files\documents\"
			}
			*/
			//$array_foto=json_decode($datafoto);
			//if(isset($array_foto['type'])){
			//}
			
            $data['kode_foto'] = $datakbri['kode_foto'];
            $data['data_pencetakan'] = array("kota" => $kotakbri, "tanggal_cetak" => "2005-05-05");
            $data['datamrz'] = $this->mlayanan->calcmrzone(getArrayDef($datapaspor['data_paspor'], 'full_name'), 
				'P', getArrayDef($datapaspor['data_layanan'], 'pbaru_nomor'), 'IDN', 
				getArrayDef($datapaspor['data_paspor'], 'jenkelid'), 
				getArrayDef($datapaspor['data_paspor'], 'birth_date'), 
				getArrayDef($datapaspor['data_layanan'], 'pbaru_berlaku'));
			$data['datapaspor']['warganegara'] = 'INDONESIA';
            $html = $this->load->view("v_cetak_paspor", $data, true);
			//echo $html;
			//die();
            $this->load->library('m_pdf');
            $pdf = $this->m_pdf->load();
            if (isset($datapaspor['data_paspor']['nama_lengkap'])) {
                $nama = $datapaspor['data_paspor']['nama_lengkap'];
            } else {
                $nama = '';
            }
            $pdfFilePath = 'paspor_' . $nama . '.pdf';
            $pdf->WriteHTML($html);
            $pdf->Output($pdfFilePath, "I");
			
        } else {
            echo "data tidak diketemukan.";
        }
    }

}

?>
