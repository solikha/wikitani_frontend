<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/* Manggu Framework
 * Simple PHP Application Development
 * Kusnassriyanto S. Bahri
 * kusnassriyanto@gmail.com
 * 
 */

class m_pulang_habis extends MY_Model {

    function loadWniLayanan($lyn_id) {
        $sql = "select data_layanan from wni_layanan where layananidhash = :lyn_id";
        $params = array('lyn_id' => $lyn_id);
        $result = $this->mdb->QueryData('application', $sql, $params, 'record');
        if (isset($result[0])) {
            $lyndata = json_decode($result[0]['data_layanan'], true);
        } else {
            $lyndata = array();
        }
        return $lyndata;
    }
    
    function nama($lyn_id) {
        $sql = "select x.id, x.wni_lyn_id , x.lyn_id, x.nama_layanan as nama_layanan, x.nama_sublayanan,  x.status_description, x.task_description, x.task_instruction, x.create_time, x.catatan2, x.attachment_category, x.pemohon, x.alamat_id, x.kota_kodepos  from ( select a.id, a.id as wni_lyn_id, a.layananidhash as lyn_id, a.regid, a.layananid, a.sublayananid, a.statusname,    a.taskname, to_char(a.createtime, 'dd-mm-yyyy hh:mm') as create_time, a.catatan2, b.nama as nama_layanan,    c.nama as nama_sublayanan,   c.attach_category as attachment_category,   d.public_description as status_description,   e.public_description as task_description,   e.public_instruction as task_instruction,   e.public_actionby as task_actionby,   f.fullname as pemohonx,   g.nama_lengkap as pemohon,   g.alamat_id, g.kota_kab_id || ' - ' || g.kodepos_id as kota_kodepos from wni_layanan a left join layanan b on a.layananid = b.id left join layanan_sub c on a.sublayananid = c.id left join app_status d on a.statusname = d.statusname left join app_task e on a.taskname = e.taskname and a.layananid = e.layananid left join sys_users f on a.username = f.username left join wni g on a.wniid = g.id where a.layananidhash = :lyn_id ) x;";
        $params = array('lyn_id' => $lyn_id);
        $result = $this->mdb->QueryData('application', $sql, $params, 'record');
        if (isset($result[0])) {
            $lyndata = $result[0]['pemohon'];
        } else {
            $lyndata = array();
        }
        return $lyndata;
    }

}

?>
