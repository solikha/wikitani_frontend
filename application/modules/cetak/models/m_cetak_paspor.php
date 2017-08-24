<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/* Manggu Framework
 * Simple PHP Application Development
 * Kusnassriyanto S. Bahri
 * kusnassriyanto@gmail.com
 * 
 */

class m_cetak_paspor extends MY_Model {

    function loadWniLayanan($lyn_id) {
        //$sql = "select data_layanan from wni_layanan where layananidhash = :lyn_id";
        $sql = "select a.id, a.wniid, a.username, a.taskname, a.layananidhash, a.statusname, a.data_layanan,
            a.layananid, c.nama as nama_layanan,b.tempat_lahir,b.tanggal_lahir,b.nama_lengkap,b.warganegara,a.data_layanan,
            a.sublayananid, d.nama as nama_sublayanan, 
            d.attach_category as attachment_category,
            e.public_description as task_description,
            e.public_instruction as task_instruction,
            e.public_actionby as task_actionby,
            to_char(a.createtime, 'dd-mm-yyyy hh:mm') as create_time,
            b.nama_lengkap as pemohon, b.nama_lengkap, b.tempat_lahir, to_char(b.tanggal_lahir, 'dd-mm-yyyy') as tanggal_lahir,
            CASE when(b.jenkelid=1)then
			'L/M'
			when(b.jenkelid=2)
			then
			'P/F'
			end 
			as jenis_kelamin
          from wni_layanan a
            left join wni b on a.wniid = b.id
            left join layanan c on a.layananid = c.id
            left join layanan_sub d on a.sublayananid = d.id
            left join app_task e on a.taskname = e.taskname and a.layananid = e.layananid
            left join jenis_kelamin f on b.jenkelid = f.id
          where layananidhash = :lyn_id
        ";

        $params = array('lyn_id' => $lyn_id);
        $result = $this->mdb->QueryData('application', $sql, $params, 'record');
        if (isset($result[0])) {
            $lyndata = json_decode($result[0]['data_layanan'], true);
            $datapaspor = $result[0];
            if ($result[0]['layananid'] == 2) {
                $datapaspor['nama_lengkap'] = getArrayDef($lyndata, 'anak_nama_lengkap');
                $datapaspor['tempat_lahir'] = getArrayDef($lyndata, 'anak_tempat_lahir');
                $datapaspor['tanggal_lahir'] = getArrayDef($lyndata, 'anak_tanggal_lahir');
                $datapaspor['jenis_kelamin'] = getArrayDef($lyndata, 'anak_jenis_kelamin');
                if ($datapaspor['jenis_kelamin'] == '1') {
                    $datapaspor['jenis_kelamin'] = 'L/M';
                } else if ($datapaspor['jenis_kelamin'] == '2') {
                    $datapaspor['jenis_kelamin'] = 'P/F';
                }
            }
            $sql2 = "select cast(data_wni as json)->>'full_name' as nama from app_wni where id=:wniid";
            $params = array('wniid' => $result[0]['wniid']);
            $result2 = $this->mdb->QueryData('application', $sql2, $params, 'record');
            $datapaspor['nama']=$result2[0]['nama'];
        } else {
            $lyndata = array();
            $datapaspor = array();
        }
        //return $lyndata;
        $data_paspor['data_layanan'] = $lyndata;
        $data_paspor['data_paspor'] = $datapaspor;
        return $data_paspor;
    }

}

?>
