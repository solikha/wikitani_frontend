<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/* Manggu Framework
 * Simple PHP Application Development
 * Kusnassriyanto S. Bahri
 * kusnassriyanto@gmail.com
 * 
 */

class m_artikel extends MY_Model {

    function showDataTest() {
       
        return "data ini dari model";
    }
	
	function loadDataLookupArtikel() {
        $sql = "select a.*, a.nama_kategori from app_kategori a";
        $params = array(""=>"");
        $result = $this->mdb->QueryData('application', $sql, $params, 'record');
		$lookupkategori=array(""=>"");
        if (isset($result)) {
           $lookupkategori = $result;
        } else {
            $lookupkategori = array("info"=>"no data");
        }
        return $lookupkategori;
		
    }
	function loadDataKategoriByArtikelId($params){
		 $sql = "select b.nama_kategori,b.kategori_id from app_artikel a 
				left join app_kategori b on a.kategori_id = b.kategori_id 
				where a.artikel_id=:artikel_id
				UNION ALL select c.nama_kategori,c.kategori_id  from app_kategori c";
        $params = array("artikel_id"=>$params);
        $result = $this->mdb->QueryData('application', $sql, $params, 'record');
		$lookupkategori=array(""=>"");
        if (isset($result)) {
           $lookupkategori = $result;
        } else {
            $lookupkategori = array("info"=>"no data");
        }
        return $lookupkategori;	
	}
	
	function loadArtikelKontenByArtikelKontenId($artikel_konten_id){
		$sql = "select b.nama_kategori,c.subkategori_nama,d.judul_artikel,d.artikel_id,a.judul_konten_artikel,a.konten 
		from app_artikelkonten a 
		left join app_artikel d on a.artikel_id = d.artikel_id 
		left join app_kategori b on d.kategori_id = b.kategori_id
		left join app_subkategori c on d.subkategori_id= c.subkategori_id
		where a.artikel_konten_id=:artikel_konten_id		
		";
        $params = array("artikel_konten_id"=>$artikel_konten_id);
        $result = $this->mdb->QueryData('application', $sql, $params, 'record');
		$data_artikel_konten=array(""=>"");
        if (isset($result)) {
           $data_artikel_konten = $result[0];
        } else {
            $data_artikel_konten = array("info"=>"no data");
        }
        return $data_artikel_konten;	
	}
	
	function loadDataSubKategoriByArtikelId($params){
		 $sql = "select 
					b.subkategori_nama,a.subkategori_id
				from 
					app_artikel a 
				left join app_subkategori b on a.subkategori_id = b.subkategori_id 
				where a.artikel_id=:artikel_id
				UNION ALL select 
				c.subkategori_nama,c.subkategori_id
				from app_subkategori c";
        $params = array("artikel_id"=>$params);
        $result = $this->mdb->QueryData('application', $sql, $params, 'record');
		$lookupkategori=array(""=>"");
        if (isset($result)) {
           $lookupkategori = $result;
        } else {
            $lookupkategori = array("info"=>"no data");
        }
        return $lookupkategori;	
	}
	
	
	function loadJudulArtikelByArtikelId($params){
		 $sql = "select a.judul_artikel from app_artikel a where artikel_id=:artikel_id";
        $params = array("artikel_id"=>$params);
        $result = $this->mdb->QueryData('application', $sql, $params, 'record');
		
        return $result[0];	
	}
	
	
	
	function saveartikel($kategori_nama,$subkategori_nama,$judul_artikel,$judul_konten,$content){
		//echo $kategori_nama.$subkategori_nama.$judul_artikel.$judul_konten.$content;
		$params=array("kategori_nama"=>$kategori_nama,
		              "subkategori_nama"=>$subkategori_nama,
		              "judul_artikel"=>$judul_artikel,
					  "judul_konten"=>$judul_konten,
					  "content"=>$content
		             );
	  $sql="insert into app_artikel 
					(kategori_id,subkategori_id,judul_artikel)
						values
			        (:kategori_nama, :subkategori_nama, :judul_artikel);

			insert into app_artikelkonten
					(user_id,artikel_id,judul_konten_artikel,tanggal_created,konten)
						values
			        (1,currval('app_artikel_artikel_id_seq'),:judul_konten,now(),:content);			
					";
		 $this->mdb->ExecSQL('application', $sql, $params);
	 
	}
	
	function saveArtikelContent($artikel_id,$kategori_nama,$subkategori_nama,$judul_artikel,$judul_konten,$content){
		//echo $kategori_nama.$subkategori_nama.$judul_artikel.$judul_konten.$content;
		$params=array(
		              "artikel_id"      =>$artikel_id,
		              "kategori_nama"   =>$kategori_nama,
		              "subkategori_nama"=>$subkategori_nama,
		              "judul_artikel"   =>$judul_artikel,
					  "judul_konten"    =>$judul_konten,
					  "content"         =>$content
		             );
					 
					 //print_r($params); die();
	          $sql="insert into app_artikelkonten
					(user_id,artikel_id,judul_konten_artikel,tanggal_created,konten)
						values
			        (1,:artikel_id,:judul_konten,now(),:content);			
					";
					echo $sql; die();
		 $this->mdb->ExecSQL('application', $sql, $params);
	 
	}
	
	function loadDataSubKategori($kategoriid){
        $sql = "select a.* from app_subkategori a where kategori_id=:kategoriid";
        $params = array("kategoriid"=>$kategoriid);
        $result = $this->mdb->QueryData('application', $sql, $params, 'record');
		$lookupsubkategori=array(""=>"");
        if (isset($result)) {
           $lookupsubkategori = $result;
        } else {
            $lookupsubkategori = array("info"=>"no data");
        }
        return $lookupsubkategori;
		
    }
	
	

}

?>
