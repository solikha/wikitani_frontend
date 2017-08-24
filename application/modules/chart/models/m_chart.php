<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/* Manggu Framework
 * Simple PHP Application Development
 * Kusnassriyanto S. Bahri
 * kusnassriyanto@gmail.com
 * 
 */

class m_chart extends MY_Model {

    public function __construct() {
        parent::__construct();
    }

    public function data_kategori_wni() {
        $sql = "select count(case when cast(cast(a.data_wni as json)->>'kategoriwni' as character varying) <> '' then cast(cast(a.data_wni as json)->>'kategoriwni' as integer)else null end) as nilai, j.nama
            from app_wni a
            left join app_kategori_wni j on j.id=case when cast(cast(a.data_wni as json)->>'kategoriwni' as character varying) <> '' then cast(cast(a.data_wni as json)->>'kategoriwni' as integer)else null end
            where case when cast(cast(a.data_wni as json)->>'kategoriwni' as character varying) <> '' then cast(cast(a.data_wni as json)->>'kategoriwni' as integer)else null end IS NOT NULL
            group by case when cast(cast(a.data_wni as json)->>'kategoriwni' as character varying) <> '' then cast(cast(a.data_wni as json)->>'kategoriwni' as integer)else null end, j.nama";
        $params = array();
        $result = $this->mdb->QueryData('application', $sql, $params, 'record');
        if (isset($result)) {
            return $result;
        } else {
            return array();
        }
    }

    public function data_status() {
        $sql = "select count(case when cast(cast(a.data_wni as json)->>'statuskawinid' as character varying) <> '' then cast(cast(a.data_wni as json)->>'statuskawinid' as integer)else null end) as nilai, j.nama
            from app_wni a
            left join status_kawin j on j.id=case when cast(cast(a.data_wni as json)->>'statuskawinid' as character varying) <> '' then cast(cast(a.data_wni as json)->>'statuskawinid' as integer)else null end
            where case when cast(cast(a.data_wni as json)->>'statuskawinid' as character varying) <> '' then cast(cast(a.data_wni as json)->>'statuskawinid' as integer)else null end IS NOT NULL
            group by case when cast(cast(a.data_wni as json)->>'statuskawinid' as character varying) <> '' then cast(cast(a.data_wni as json)->>'statuskawinid' as integer)else null end, j.nama";  
        $params = array();
        $result = $this->mdb->QueryData('application', $sql, $params, 'record');
        if (isset($result)) {
            return $result;
        } else {
            return array();
        }
    }

    public function data_kelamin() {
        $sql = "select count(case when cast(cast(a.data_wni as json)->>'jenkelid' as character varying) <> '' then cast(cast(a.data_wni as json)->>'jenkelid' as integer)else null end) as nilai, j.nama
            from app_wni a
            left join jenis_kelamin j on j.id=case when cast(cast(a.data_wni as json)->>'jenkelid' as character varying) <> '' then cast(cast(a.data_wni as json)->>'jenkelid' as integer)else null end
            where case when cast(cast(a.data_wni as json)->>'jenkelid' as character varying) <> '' then cast(cast(a.data_wni as json)->>'jenkelid' as integer)else null end IS NOT NULL
            group by case when cast(cast(a.data_wni as json)->>'jenkelid' as character varying) <> '' then cast(cast(a.data_wni as json)->>'jenkelid' as integer)else null end, j.nama";
        $params = array();
        $result = $this->mdb->QueryData('application', $sql, $params, 'record');
        if (isset($result)) {
            return $result;
        } else {
            return array();
        }
    }

    public function layanan_name() {
        $sql = "select id, nama from layanan";
        $params = array();
        $result = $this->mdb->QueryData('application', $sql, $params, 'record');
        if (isset($result)) {
            return $result;
        } else {
            return array();
        }
    }

    public function layanan_name_where($id) {
        $sql = "select id, nama from layanan where id = $id";
        $params = array();
        $result = $this->mdb->QueryData('application', $sql, $params, 'record');
        if (isset($result)) {
            return $result;
        } else {
            return array();
        }
    }

    public function layanan_all() {
        $sql = "select count(a.layananid) as nilai, j.nama
            from wni_layanan a
            left join layanan j on j.id=a.layananid
            where a.layananid IS NOT NULL
            group by a.layananid, j.nama";
        $params = array();
        $result = $this->mdb->QueryData('application', $sql, $params, 'record');
        if (isset($result)) {
            return $result;
        } else {
            return array();
        }
    }

    public function layanan_all_tahun($starttahun) {
        $sql = "select count(a.layananid) as nilai, j.nama
            from wni_layanan a
            left join layanan j on j.id=a.layananid
            where a.layananid IS NOT NULL and a.createtime>= to_date('1-1-'||'" . $starttahun . "', 'dd-mm-yyyy') and a.createtime<= to_date('1-13-'||'" . $starttahun . "', 'dd-mm-yyyy')
            group by a.layananid, j.nama";
        $params = array();
        $result = $this->mdb->QueryData('application', $sql, $params, 'record');
        if (isset($result)) {
            return $result;
        } else {
            return array();
        }
    }

    public function layanan_($layanan, $starttahun) {
        $sql = "select count(layananid) as nilai, cast(TO_CHAR(createtime, 'MM') as integer) as bulan  from wni_layanan 
            where layananid=" . $layanan . " and createtime>= to_date('1-1-'||'" . $starttahun . "', 'dd-mm-yyyy') and createtime<= to_date('1-13-'||'" . $starttahun . "', 'dd-mm-yyyy')         
            group by cast(TO_CHAR(createtime, 'MM') as integer) order by cast(TO_CHAR(createtime, 'MM') as integer) ASC";
        $params = array();
        $result = $this->mdb->QueryData('application', $sql, $params, 'record');
        if (isset($result)) {
            return $result;
        } else {
            return array();
        }
    }

}

?>
