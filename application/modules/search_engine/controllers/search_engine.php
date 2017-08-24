<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/* Manggu Framework
 * Simple PHP Application Development
 * Kusnassriyanto S. Bahri
 * kusnassriyanto@gmail.com
 * 
 */

class search_engine extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
		$this->load->helper('url');
        $this->load->helper('tool_helper');
    }
    
   
    function index(){
		/* coddingan awal 
        $this->load->model('m_searchengine', 'msearchengine');
        $sessData = $this->mlogin->getSessionData();
        $this->msearchengine->openSearchEngineScreen();
       */
	     //echo "test"; die();
		$this->load->model('m_searchengine', 'msearchengine'); 
        $this->load->model('menu/m_menu','mmenu');		
        $data   = $this->mmenu->getDefaultData();
		 $data["page"]="Search Engine";	
		$html = $this->load->view("v_searchengine2",$data,TRUE);
		
		$data["pagecontent"]=$html;
       	
		$this->load->view('menu/baseview',$data); 	
    }
	
    public function doSearch(){
		$keyword=$_GET["textsearch"];
		$this->load->model('m_searchengine', 'msearchengine'); 
        $this->load->model('menu/m_menu','mmenu');		
        $data   = $this->mmenu->getDefaultData();
		$data_artikel= $this->msearchengine->getArticleInformation($keyword);
		$data["data_artikel"]=$data_artikel;
		$data["data_keyword"]=$keyword;
		if(empty($data_artikel)){    
		$html = $this->load->view("v_datanotfound",$data,TRUE);
		}else if($this->getCountArticleIdPerArticle($data_artikel)==1){
		$html = $this->load->view("v_resultsearch",$data,TRUE);	
		}else if($this->getCountArticleIdPerArticle($data_artikel) > 1 ){
		$html = $this->load->view("v_resultindex",$data,TRUE);	
		}



		$data["pagecontent"]=$html;
		$data["page"]="Result Search";		
		$this->load->view('menu/baseview',$data); 	
	}

	function getCountArticleIdPerArticle($arr){
		$dataArtikelId=array();
		$i=0;
		foreach ($arr as $key =>$value){
			$dataArtikelId[$i]=$value["artikel_id"];
			$i ++;
		}
		
		$data_unique= array_unique($dataArtikelId);
		return count($data_unique);
	}
	public function showArtikelByArtikelId(){
		$artikel_id=$_GET["artikel_id"];
		//echo $artikel_id; die();
		$this->load->model('m_searchengine', 'msearchengine'); 
        $this->load->model('menu/m_menu','mmenu');		
        $data   = $this->mmenu->getDefaultData();
		$data_artikel= $this->msearchengine->getArticleInformationByArtikelId($artikel_id);
		$data["data_artikel"]=$data_artikel;
		$html = $this->load->view("v_artikelbyartikelid",$data,TRUE);
		$data["pagecontent"]=$html;		
		$this->load->view('menu/baseview',$data); 	
		
	}
	public function showFormSunting(){
		$artikel_konten_id=$_POST["artikel_konten_id"];
		$this->load->model('m_searchengine', 'msearchengine'); 
        $this->load->model('menu/m_menu','mmenu');
        $this->load->model('artikel/m_artikel','martikel');	
        $data   = $this->mmenu->getDefaultData();
		$data_form_sunting= $this->martikel->loadArtikelKontenByArtikelKontenId($artikel_konten_id);	
		$data["data_form_sunting"]=$data_form_sunting;
		$html = $this->load->view("v_formsunting",$data,TRUE);
		$data["pagecontent"]=$html;		
		$this->load->view('menu/baseview',$data);  	
	}
	
	public function doSaveUpdatedArticleContent(){
		$this->load->model('m_searchengine', 'msearchengine'); 
		$artikel_konten_id=$_POST["artikel_konten_id"];
		$judul_artikel = $_POST["judul_artikel"];
		$userid = $_POST["userid"];
		$content = $_POST["editor1"];
		$content = removeAllnewlineCharacters($content);
		$content = "'".$content."'";	
		$this->msearchengine->doSaveUpdatedArticleContent($artikel_konten_id,$content,$userid);
		header("Location:".base_url()."/index.php/search_engine/doSearch?textsearch=".$judul_artikel);
	}
	public function doGiveRate(){
		$this->load->model('m_searchengine', 'msearchengine'); 		
		$artikel_id=$_GET["artikel_id"];
		$rate=$_GET["rate"];
		$userid=$_GET["userid"];
		if($this->checkIfUserRateExist($userid,$artikel_id)!=0){
			$this->msearchengine->doGiveRate($artikel_id,$rate,$userid);
			echo "Penilaian anda rating telah diperbaharui";
		}else{
			$this->msearchengine->doUpdateRate($artikel_id,$rate,$userid);
			echo "Terimakasih atas penilaian anda";
		}
	   
    }
	
	public function checkIfUserRateExist($userid,$artikel_id){ 
		$this->load->model('m_searchengine', 'msearchengine'); 				
	    return $this->msearchengine->checkIfUserRateExist($artikel_id,$userid);
	   
	}
	 public function doSearchArtikelFavorite(){
		//echo "artikel favorite";
		//$keyword=$_GET["textsearch"];
		$this->load->model('m_searchengine', 'msearchengine'); 
        $this->load->model('menu/m_menu','mmenu');		
        $data   = $this->mmenu->getDefaultData();
		$data_favorite= $this->msearchengine->getArticleFavorite();
		$data["data_favorite"]=$data_favorite;
		//echo "<pre>";
		//print_r($data_favorite);
		//echo "</pre>"; die();
		$html = $this->load->view("v_favoriteartikel",$data,TRUE);
		$data["pagecontent"]=$html;		
		$this->load->view('menu/baseview',$data); 	
	

	}
    
  
}



?>
