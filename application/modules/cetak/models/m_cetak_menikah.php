<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/* Manggu Framework
 * Simple PHP Application Development
 * Kusnassriyanto S. Bahri
 * kusnassriyanto@gmail.com
 * 
 */

class m_cetak_menikah extends MY_Model {

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

}

?>
