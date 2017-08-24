<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/* Manggu Framework
 * Simple PHP Application Development
 * Kusnassriyanto S. Bahri
 * kusnassriyanto@gmail.com
 * 
 */


class m_searchengine extends MY_Model
{
    var $keys;
    var $SysConfig;
    var $validation_msg=array();
    public function __construct()
    {
        parent::__construct();
        $this->SysConfig = $this->ci->config->item('sysconfig');
        $this->load->helper('language');
        $this->lang->load('user_validation');
        
    }
    
    public function openSearchEngineScreen(){
         //$data=array();
		  $data = $this->getDefaultData();
        $this->load->view('search_engine/v_searchengine',$data);
        
    }
	
	function getArticleInformation($params){
		$sql = "select DISTINCT ON(a.artikel_konten_id) a.konten ,b.judul_artikel,a.judul_konten_artikel,d.filepath,a.artikel_id,
		        a.artikel_konten_id,e.link from app_artikelkonten a
		        left join app_artikel b on a.artikel_id=b.artikel_id
				left join app_artikel_attch c on b.artikel_id=c.artikel_id
				left join sys_files d on d.id = c.fileid
				left join app_link e on a.artikel_id = e.artikel_id
		        where 
				b.judul_artikel ilike '%' ||:keyword || '%'   
				or   
				a.konten  ilike '%' ||:keyword || '%' 
				group by a.artikel_konten_id,b.judul_artikel,d.filepath,e.link order by a.artikel_konten_id
				";
        $params = array("keyword"=>$params);
        $result = $this->mdb->QueryData('application', $sql, $params, 'record');
		$data_artikel_information=array(""=>"");
        if (isset($result)) {
           $data_artikel_information = $result;
        } else {
            $data_artikel_information = array("info"=>"no data");
			
		}
		return $result;
	}
	
	function getArticleInformationByArtikelId($params){
		$sql = "select DISTINCT ON(a.artikel_konten_id) a.konten ,b.judul_artikel,a.judul_konten_artikel,d.filepath,a.artikel_id,
		        a.artikel_konten_id,e.link from app_artikelkonten a
		        left join app_artikel b on a.artikel_id=b.artikel_id
				left join app_artikel_attch c on b.artikel_id=c.artikel_id
				left join sys_files d on d.id = c.fileid
				left join app_link e on a.artikel_id = e.artikel_id
		        where a.artikel_id=:artikel_id";
				
        $params = array("artikel_id"=>$params);
        $result = $this->mdb->QueryData('application', $sql, $params, 'record');
		$data_artikel_information=array(""=>"");
        if (isset($result)) {
           $data_artikel_information = $result;
        } else {
            $data_artikel_information = array("info"=>"no data");
			
		}
		return $result;
	}
	
	
	function doSaveUpdatedArticleContent($artikel_konten_id,$konten,$userid){
		$params=array("artikel_konten_id"=>$artikel_konten_id,
					  "konten"=>$konten,
					  "userid"=>$userid
		             );
	           $sql="insert into app_updateartikel_konten
					(user_id,artikel_konten_id,tanggal_sunting,konten,approvestatus_id)
						values
			        (:userid,:artikel_konten_id,now(),:konten,0);			
					";
		 $this->mdb->ExecSQL('application', $sql, $params);
		
	}
	
	function checkIfUserRateExist($artikel_id,$userid){
		$params=array("artikel_id"=>$artikel_id,
					  "userid"=>$userid
		             );
	     $sql="select count(*) from app_rate where userid=:userid and artikel_id =:artikel_id";
		 $result = $this->mdb->QueryData('application', $sql, $params, 'record');
		 return $result[0];
	}
	
	function doGiveRate($artikel_id,$rate,$userid){
		$params=array("artikel_id"=>$artikel_id,
					  "rate"=>$rate,
					  "userid"=>$userid
		             );
	           $sql="insert into app_rate
					(userid,artikel_id,rate)
						values
			        (:userid,:artikel_id,:rate);			
					";
		 $this->mdb->ExecSQL('application', $sql, $params);
		
	}
	function doUpdateRate($artikel_id,$rate,$userid){
		$params=array("artikel_id"=>$artikel_id,
					  "rate"=>$rate,
					  "userid"=>$userid
		             );
	           $sql="update app_rate 
			          set rate=:rate
					  where userid=:userid and artikel_id=:artikel_id";
		 $this->mdb->ExecSQL('application', $sql, $params);
		
	}
	
	
	
	function getArticleFavorite(){
		$sql = "select DISTINCT ON (a.artikel_konten_id)a.artikel_konten_id ,a.konten,f.rate,b.judul_artikel,a.judul_konten_artikel,d.filepath,f.rate,
		        a.artikel_konten_id,a.artikel_id,e.link from app_artikelkonten a
		        left join app_artikel b on a.artikel_id=b.artikel_id
				left join app_artikel_attch c on b.artikel_id=c.artikel_id
				left join sys_files d on d.id = c.fileid
				left join app_link e on a.artikel_id = e.artikel_id 
				left join app_rate f on a.artikel_id= f.artikel_id
				where f.rate is not null and f.rate =(select max(rate) from app_rate )				
				";
        $params = array();
        $result = $this->mdb->QueryData('application', $sql, $params, 'record');
		$data_artikel_information=array(""=>"");
        if (isset($result)) {
           $data_artikel_information = $result;
        } else {
            $data_artikel_information = array("info"=>"no data");
			
		}
		return $result;
	}
	
	
}