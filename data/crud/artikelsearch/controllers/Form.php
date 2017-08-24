<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Form extends CI_Controller {
 
    public function __construct() {
        parent::__construct();
 
        $this->load->library(array('ckeditor')); //library ckfinder ditambahkan untuk diload
    }
 
    /**
     * halaman awal ketika controller form diakses
     */
    public function index()
    {
        $width = '100%';
        $height = '300px';
        $this->editor($width,$height);
 
        $this->load->view('formeditor');
    }
 
    function editor($width,$height) {
    //configure base path of ckeditor folder
    $this->ckeditor->basePath = base_url().'plugins/ckeditor/';
    $this->ckeditor-> config['toolbar'] = 'Full';
    $this->ckeditor->config['language'] = 'en';
    $this->ckeditor-> config['width'] = $width;
    $this->ckeditor-> config['height'] = $height;
 
    //configure ckfinder with ckeditor config
    $path = './plugins/ckfinder'; //path folder ckfinder
    $this->ckfinder->SetupCKEditor($this->ckeditor,$path);
  }          
}
