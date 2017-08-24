<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class M_cetak extends MY_Model
{
    var $cmdOptions = '';
    public function __construct()
    {
        parent::__construct();
    }
    
    public function cetak_dispatch_hash($code){
        $vsql = "select taskname, layananid, sublayananid 
            from wni_layanan where layananidhash = :lyn_id ";
        $vparams = array('lyn_id' => $code);
        $dres = $this->mdb->QueryData('system', $vsql, $vparams, 'record');
        if (isset($dres[0])){
            $layananid = $dres[0]['layananid'];
            if ($layananid==1){
                $cmd = 'cetak_paspor';
            } else if ($layananid==2){
                $cmd = 'cetak_paspor_anak';
            } else if ($layananid==3){
                $sublayananid = $dres[0]['sublayananid'];
                $cmd = $this->getKonversiLink($sublayananid);
            } else if ($layananid==4){
                $cmd = 'print_pulang_habis';
            } else if ($layananid==5){
                //$cmd = 'edit_layanan_pindah_wn';
                $cmd = '';
            } else if ($layananid==6){
                //$cmd = 'edit_layanan_lapor_meninggal';
                $cmd = '';
            } else if ($layananid==7){
                //$cmd = 'edit_layanan_lapor_diri';
                $cmd = 'cetak_lapor_diri';
            } else if ($layananid==9){
                $cmd = 'cetak_splp';
            } else if ($layananid==10){
                $sublayananid = $dres[0]['sublayananid'];
                $cmd = $this->getKonversiLink($sublayananid);
            } else if ($layananid==11){
                $cmd = 'cetak_kelahiran';
            } else if ($layananid==13){
                $cmd = 'cetak_alamat';
            } else {
                $cmd = '';
            }
            if ($cmd!==''){
                $get_param = 'lyn_id='.$code;
                $redirect = $cmd.'?'.$get_param;
                $result = array('redirect'=>$redirect);
            } else {
                $result = array('message'=>'Jenis Layanan tidak diketemukan.');
            }
        } else {
            $result = array('message'=>'Data Layanan tidak diketemukan.');
        }
        return $result;
        //return $params;
        
    }
    
     function getKonversiLink($sublayananid){
        if ($sublayananid==10){
            $link = 'cetak_nikah';
        } else if ($sublayananid==11){
            $link = 'cetak_cerai';
        } else if ($sublayananid==12){
            $link = 'cetak_alamat';
        } else if ($sublayananid==13){
            $link = 'cetak_stkerja';
        } else if ($sublayananid==22){
            $link = 'cetak_nikah';
        } else if ($sublayananid==23){
            $link = 'cetak_cerai';
        } else {
            $link = '';
        }
        return $link;
    }
  
    
    
}