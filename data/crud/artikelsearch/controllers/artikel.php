<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class artikel extends MY_Controller {

    public function __construct() {
        parent::__construct();
        //  $this->load->model('m_workflow', 'wflow');
        // $this->load->library('mustache');
        $this->load->helper('url');
        $this->load->helper('tool_helper');
    }

    public function index() {
		$this->load->model('m_artikel','martikel');		       
		$datalookup=$this->martikel->loadDataLookupArtikel();
        $data["lookup_kategori"]=$datalookup;			
		$this->load->view("v_tambahkonten",$data);
    }
	
	public function showContentItemForm(){
		//echo $_GET["artikel_id"];
		
		$this->load->model('m_artikel','martikel');
		$artikel_id = $_GET["artikel_id"];		
		$datalookup_kategori=$this->martikel->loadDataKategoriByArtikelId($artikel_id);
		$datalookup_subkategori=$this->martikel->loadDataSubKategoriByArtikelId($artikel_id);
		$datalookup_subkategori=$this->martikel->loadDataSubKategoriByArtikelId($artikel_id);
		$datajudulartikel=$this->martikel->loadJudulArtikelByArtikelId($artikel_id);
		//loadJudulArtikelByArtikelId
		$data["lookup_kategori"]=$datalookup_kategori;
        $data["lookup_subkategori"]=$datalookup_subkategori;
		$data["judulartikel"]=$datajudulartikel["judul_artikel"];	
        $data["artikel_id"]	=$artikel_id;
		 //echo $datajudulartikel["judul_artikel"];
		$this->load->view("v_tambahkontenitem",$data);
	}
	
	function showEditContentItemForm(){
		$this->load->model('m_artikel','martikel');
		
		$artikel_konten_id=$_GET["artikel_konten_id"];
		$data_artikel_konten=$this->martikel->loadArtikelKontenByArtikelKontenId($artikel_konten_id);
		$artikel_id = $data_artikel_konten["artikel_id"];
		$judul_konten_artikel = $data_artikel_konten["judul_konten_artikel"];
		$konten = $data_artikel_konten["konten"];
		
		$datalookup_kategori=$this->martikel->loadDataKategoriByArtikelId($artikel_id);
		$datalookup_subkategori=$this->martikel->loadDataSubKategoriByArtikelId($artikel_id);
		$datalookup_subkategori=$this->martikel->loadDataSubKategoriByArtikelId($artikel_id);
		$datajudulartikel=$this->martikel->loadJudulArtikelByArtikelId($artikel_id);
		//loadJudulArtikelByArtikelId
		$data["lookup_kategori"]=$datalookup_kategori;
        $data["lookup_subkategori"]=$datalookup_subkategori;
		$data["judulartikel"]=$datajudulartikel["judul_artikel"];	
        $data["artikel_id"]	=$artikel_id;
		$data["judul_konten_artikel"]=$judul_konten_artikel;
		$data["konten"]	=$konten;
		//echo $konten; die();
		 //echo $datajudulartikel["judul_artikel"];
		$this->load->view("v_editkontenitem",$data);
	}
	public function saveartikel(){
		// echo "save ready";
		 
		$kategori_nama = $_POST["kategori_nama"]; 
		$subkategori_nama = $_POST["subkategori_nama"];
		$judul_artikel =$_POST["judul_artikel"];
		$judul_konten = $_POST["judul_konten"];
		$content = $_POST["content"];
		
		$this->load->model('m_artikel','martikel');		
		$this->martikel->saveartikel($kategori_nama,$subkategori_nama,$judul_artikel,$judul_konten,$content);
		header("Location:".base_url()."/index.php/menu/artikel");
    }
	
	public function saveArtikelContent(){
       // $content = htmlentities($_POST['editor1']);	
	   $content = "'".$_POST['editor1']."'";	
       // echo $content; die();		
		$kategori_nama = $_POST["kategori_nama"]; 
		$artikel_id = $_POST["artikel_id"];
		$subkategori_nama = $_POST["subkategori_nama"];
		$judul_artikel =$_POST["judul_artikel"];
		$judul_konten = $_POST["judul_konten"];
		$content = $content;
		
		$this->load->model('m_artikel','martikel');		
		$this->martikel->saveArtikelContent($artikel_id,$kategori_nama,$subkategori_nama,$judul_artikel,$judul_konten,$content);
		header("Location:".base_url()."/index.php/menu/artikel");
    }
	
	public function getLookupSubkategori(){
		$this->load->model('m_artikel','martikel');		
		$kategoriid=$_POST['kategori_nama'];
		//echo $kategoriid;
		$data_subkategori=$datalookup=$this->martikel->loadDataSubKategori($kategoriid);
		echo json_encode($data_subkategori);
		//echo $kategori_nama;
		//print_r($data_subkategori);
		//echo "data server ok";
	}

   

}

?>
