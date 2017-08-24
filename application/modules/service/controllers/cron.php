<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/* Manggu Framework
 * Simple PHP Application Development
 * Kusnassriyanto S. Bahri
 * kusnassriyanto@gmail.com
 * 
 */
class Cron extends MY_Controller {

    function __construct() {
        parent::__construct();
    }
    
    public function cron($funct=false, $sleep=1000, $crontime=10000){
        if($funct!==false){
            ob_end_flush();
            usleep(100*1000);
            $count=(int)($crontime/$sleep);
            for ($i=0; $i<$count; $i++){
                $funct();
                flush();
                //echo $sleep;
                usleep($sleep*1000);
            }
        }
    }

    public function status($cronsleep=1000, $crontime=60000){
        try {
            $this->load->model('m_cronstatus', 'mcron');
            $this->cron(function(){
                $this->mcron->doProcess();
            }, $cronsleep, $crontime);
        } catch (Exception $e) {
            echo $e->getMessage() . "\r\n" . $e->getTraceAsString();
        }
    }
    
    public function ftp($cronsleep=1000, $crontime=60000){
        $ftpfolder = $this->ci->config->item('ftpfolder');
//        $dir = $ftpfolder;
//        $files1 = scandir($dir);
//        $files2 = scandir($dir, 1);
//
//        print_r($files1);
//        print_r($files2);
        
$it = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($ftpfolder));
foreach ($it as $file) echo $file."\n";

        return;
        try {
            $this->load->model('m_cronstatus', 'mcron');
            $this->cron(function(){
                $this->mcron->doProcess();
            }, $cronsleep, $crontime);
        } catch (Exception $e) {
            echo $e->getMessage() . "\r\n" . $e->getTraceAsString();
        }
    }
    
    public function xindex(){
        ob_end_flush();
        usleep(100*1000);
        $this->load->model('m_cronstatus', 'mcron');
        $crontime = 10000;
        $sleep = 1000;
        $count=(int)($crontime/$sleep);
//        echo $count;
//        die;
        for ($i=0; $i<$count; $i++){
            $this->mcron->doProcess();
            flush();
            //echo $sleep;
            usleep($sleep*1000);
        }
        
    }
}
?>
