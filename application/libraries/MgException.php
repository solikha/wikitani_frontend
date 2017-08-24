<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/* Manggu Framework
 * Simple PHP Application Development
 * Kusnassriyanto S. Bahri
 * kusnassriyanto@gmail.com
 * 
 */

class MgException extends Exception
{
    var $err_type = '';
    var $err_message = '';
    public function __construct ($err_type='', $err_message=''){
        parent::__construct($err_message);
        $this->err_message = $err_message;
        $this->err_type = $err_type;
    }
}

?>
