<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/* Manggu Framework
 * Simple PHP Application Development
 * Kusnassriyanto S. Bahri
 * kusnassriyanto@gmail.com
 * 
 */
$config['max_size'] = '10000';
$config['sysconfig']['enccode'] = 'MANGGUKBRI2016'; // jangan diganti, kecuali tahu
                                                // persis apa yang diinginkan!!
$config['sysconfig']['umursession'] = 5184000; // umur session dalam detik 900 = 15 menit
$config['sysconfig']['namasession'] = 'emgkbri-ssims';

$config['basefolder']='c:\xampp\htdocs\wikitani\data'."\\";
$config['filefolder']='c:\xampp\htdocs\wikitani\files\documents'."\\";
//$config['trackuser']='teguh1';
//$config['trackpassword']='1234';

//$config['brandname'] = 'Manggu';
//$config['brandicon'] = 'logo100';

$config['deploystate'] = 'debug'; // debug atau product

$config['appconfig']['assetdir'] = base_url().'themes/aceadmin/';;
$config['appconfig']['app-title'] = 'Manggu Application';
$config['appconfig']['login-icon'] = $config['appconfig']['assetdir'].'images/logo100.png';
$config['appconfig']['login-title'] = 'Manggu App';
$config['appconfig']['login-subtitle'] = '&copy; CSN';
$config['appconfig']['login-background'] = '#05676E';

$config['appconfig']['main-icon'] = $config['appconfig']['assetdir'].'images/logo100.png';
$config['appconfig']['main-title'] = 'Manggu App';
$config['appconfig']['main-barcolor'] = '#242a30';

// $config['email_config']['smtp_host'] = "ssl://mail.poldajabar.org";
// $config['email_config']['smtp_port'] = "465";
// $config['email_config']['smtp_user'] = "info@poldajabar.org";
// $config['email_config']['smtp_pass'] = "karawitan03";
// $config['email_config']['from_email'] = "info@poldajabar.org";
// $config['email_config']['from_name'] = "Admin E-KBRI";

$config['email_config']['smtp_host'] = "ssl://smtp.googlemail.com";
$config['email_config']['smtp_port'] = "465";
$config['email_config']['smtp_user'] = "Alimin Dev -";
$config['email_config']['smtp_pass'] = "87654321alimin";
$config['email_config']['from_email'] = "alimindev762@gmail.com";
$config['email_config']['from_name'] = "Alimin";
?>
