<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/* Manggu Framework
 * Simple PHP Application Development
 * Kusnassriyanto S. Bahri
 * kusnassriyanto@gmail.com
 * 
 */
require_once APPPATH.'third_party/Mustache/Autoloader.php';


class Mustache {
    var $renderer;
    
    public function __construct($config=array()) {
        Mustache_Autoloader::register();
        $this->renderer = new Mustache_Engine($config);
    }
    
    public function render($template, $data){
        return $this->renderer->render($template, $data);
    }
    
}

?>
