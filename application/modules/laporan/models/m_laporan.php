<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/* Manggu Framework
 * Simple PHP Application Development
 * Kusnassriyanto S. Bahri
 * kusnassriyanto@gmail.com
 * 
 */

class m_laporan extends MY_Model {
    
    function layanan() {
        $sql = "select id, nama from layanan;";
        $params = array();
        $result = $this->mdb->QueryData('application', $sql, $params, 'record');
        if (isset($result[0])) {
            $lyndata = $result;
        } else {
            $lyndata = array();
        }
        return $lyndata;
    }

    function laporan_static_minggu($thn, $bulan, $id) {
        $sql = "select  minggu-minggu_param+1 as minggu, count(*),nama
            from 
            (
            select b.nama, a.createtime, extract(week from a.createtime) as minggu, extract(week from to_date('$thn' || '-' || '$bulan' || '-1', 'yyyy-mm-dd')) as minggu_param
            from wni_layanan a
            left join layanan b on b.id=a.layananid
            where a.createtime>=to_date('$thn' || '-' || '$bulan' || '-1', 'yyyy-mm-dd')
            and a.createtime<to_date('$thn' || '-' || '$bulan' || '-1', 'yyyy-mm-dd')+cast('1 month' as interval)
            and a.layananid=$id
            order by b.nama
            ) xx
            group by minggu-minggu_param+1, nama
            order by minggu-minggu_param+1, nama";
        $params = array();
        $result = $this->mdb->QueryData('application', $sql, $params, 'record');
        if (isset($result[0])) {
            $lyndata = $result;
        } else {
            $lyndata = array();
        }
        return $lyndata;
    }
    
    function laporan_transaksi_rekap($awal, $akhir, $id) {
        $sql = "select a.layananid, i.nama, count(case when cast(cast(a.data_layanan as json)->>'jenis_bayar' as character varying) <> '' then cast(cast(a.data_layanan as json)->>'jenis_bayar' as integer)else null end) as nilai, j.nama, j.id
            from wni_layanan a
            left join jenis_bayar j on j.id=case when cast(cast(a.data_layanan as json)->>'jenis_bayar' as character varying) <> '' then cast(cast(a.data_layanan as json)->>'jenis_bayar' as integer)else null end
            left join layanan i on i.id=a.layananid
            where case when cast(cast(a.data_layanan as json)->>'jenis_bayar' as character varying) <> '' then cast(cast(a.data_layanan as json)->>'jenis_bayar' as integer)else null end IS NOT NULL
            and createtime >= '$awal 00:00:00+07' AND createtime <= '$akhir 23:59:59.999999' and a.layananid=$id
            group by a.layananid, i.nama, case when cast(cast(a.data_layanan as json)->>'jenis_bayar' as character varying) <> '' then cast(cast(a.data_layanan as json)->>'jenis_bayar' as integer)else null end, j.nama, j.id;";
        $params = array();
        $result = $this->mdb->QueryData('application', $sql, $params, 'record');
        if (isset($result[0])) {
            $lyndata = $result;
        } else {
            $lyndata = array();
        }
        return $lyndata;
    }
    
    function harga_jenis_() {
        $sql = "select a.layananid, i.nama, case when cast(cast(a.data_layanan as json)->>'biaya' as character varying) <> '' then cast(cast(a.data_layanan as json)->>'biaya' as integer)else null end as nilai
            from wni_layanan a
            left join layanan i on i.id=a.layananid
            where case when cast(cast(a.data_layanan as json)->>'biaya' as character varying) <> '' then cast(cast(a.data_layanan as json)->>'biaya' as integer)else null end IS NOT NULL
            group by a.layananid, i.nama, case when cast(cast(a.data_layanan as json)->>'biaya' as character varying) <> '' then cast(cast(a.data_layanan as json)->>'biaya' as integer)else null end;";
        $params = array();
        $result = $this->mdb->QueryData('application', $sql, $params, 'record');
        if (isset($result[0])) {
            $lyndata = $result;
        } else {
            $lyndata = array();
        }
        return $lyndata;
    }
    
    function laporan_transaksi_detail($awal, $akhir, $id) {
        $sql = "select a.id, e.description as status, to_char(a.createtime, 'YYYY-MM-DD') as createtime, a.layananid, i.nama as layanan, j.nama as jenis_bayar, j.id as id_jenis_bayar,
            case when cast(cast(a.data_layanan as json)->>'full_name' as character varying) <> '' then cast(cast(a.data_layanan as json)->>'full_name' as character varying)else null end as full_name,
            case when cast(cast(a.data_layanan as json)->>'paspor_nomor' as character varying) <> '' then cast(cast(a.data_layanan as json)->>'paspor_nomor' as character varying)else null end as paspor_nomor,
            case when cast(cast(a.data_layanan as json)->>'paspor_no_register' as character varying) <> '' then cast(cast(a.data_layanan as json)->>'paspor_no_register' as character varying)else null end as paspor_no_register
            from wni_layanan a
            left join jenis_bayar j on j.id=case when cast(cast(a.data_layanan as json)->>'jenis_bayar' as character varying) <> '' then cast(cast(a.data_layanan as json)->>'jenis_bayar' as integer)else null end
            left join layanan i on i.id=a.layananid
	    left join app_task e on a.taskname = e.taskname and a.layananid = e.layananid 
            where a.createtime >= '$awal 00:00:00+07' AND a.createtime <= '$akhir 23:59:59.999999' and a.layananid=$id ORDER BY a.createtime ASC;";
        $params = array();
        $result = $this->mdb->QueryData('application', $sql, $params, 'record');
        if (isset($result[0])) {
            $lyndata = $result;
        } else {
            $lyndata = array();
        }
        return $lyndata;
    }
    
    function laporan_transaksi_detail_null($awal, $akhir) {
        $sql = "select a.id, e.description as status, to_char(a.createtime, 'YYYY-MM-DD') as createtime, a.layananid, i.nama as layanan, j.nama as jenis_bayar, j.id as id_jenis_bayar,
            case when cast(cast(a.data_layanan as json)->>'full_name' as character varying) <> '' then cast(cast(a.data_layanan as json)->>'full_name' as character varying)else null end as full_name,
            case when cast(cast(a.data_layanan as json)->>'paspor_nomor' as character varying) <> '' then cast(cast(a.data_layanan as json)->>'paspor_nomor' as character varying)else null end as paspor_nomor,
            case when cast(cast(a.data_layanan as json)->>'paspor_no_register' as character varying) <> '' then cast(cast(a.data_layanan as json)->>'paspor_no_register' as character varying)else null end as paspor_no_register
            from wni_layanan a
            left join jenis_bayar j on j.id=case when cast(cast(a.data_layanan as json)->>'jenis_bayar' as character varying) <> '' then cast(cast(a.data_layanan as json)->>'jenis_bayar' as integer)else null end
            left join layanan i on i.id=a.layananid
	    left join app_task e on a.taskname = e.taskname and a.layananid = e.layananid 
            where a.createtime >= '$awal 00:00:00+07' AND a.createtime <= '$akhir 23:59:59.999999' ORDER BY a.createtime ASC;";
        $params = array();
        $result = $this->mdb->QueryData('application', $sql, $params, 'record');
        if (isset($result[0])) {
            $lyndata = $result;
        } else {
            $lyndata = array();
        }
        return $lyndata;
    }
    
    function laporan_rekapitulasi($thn) {
        $sql = "select b.nama, extract(month from a.createtime) as bulan, count(*), b.id
            from wni_layanan a
            left join layanan b on b.id=a.layananid
            where a.createtime>=to_date('$thn' || '-' || '01' || '-1', 'yyyy-mm-dd')
            and a.createtime<to_date('$thn' || '-' || '01' || '-1', 'yyyy-mm-dd')+cast('1 year' as interval)
            group by b.nama, extract(month from a.createtime), b.id order by extract(month from a.createtime);";
        $params = array();
        $result = $this->mdb->QueryData('application', $sql, $params, 'record');
        if (isset($result[0])) {
            $lyndata = $result;
        } else {
            $lyndata = array();
        }
        return $lyndata;
    }

}

?>
