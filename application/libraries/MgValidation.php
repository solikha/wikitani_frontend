<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class MgValidation{
    var $validation_msg=array();
    var $validations;
    var $lang;
    public function __construct($validations, $langobj){
        $this->validations = $validations;
        $this->lang = $langobj;
    }
    
    protected function updateValidation($dataname, $message){
        $this->validation_msg[$dataname] = $message;
    }
    
    public function validationEmail($data, $name) {
        if (!filter_var($data[$name], FILTER_VALIDATE_EMAIL)) {
            $message = $this->getLangMsg('email', $name);
            $this->updateValidation($name, $message);
            return false;
        } else {
            return true;
        }
    }

    protected function validationDate($data, $name) {
        return true;
        if (!preg_match('/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/', $data[$name])) {
            $message = $this->getLangMsg('invalid_date', $name);
            $this->updateValidation($name, $message);
            return false;
        } else {
            return true;
        }
    }

    
    public function validationCekPassword($pass1) {
        if ($pass1['k_password'] !== $pass1['password']) {
            $message = $this->getLangMsg('k_password', '');
            $this->updateValidation('k_password', $message);
            return false;
        } else {
            return true;
        }
    }

    protected function getLangMsg($lang_name, $fieldName=''){
        $vmsg = $this->lang->line($lang_name);
        if (($vmsg==='') or ($vmsg===false)){
            $result = $lang_name.' '.$fieldName;
        } else {
            $xfld = 'field_'.$fieldName;
            $fld = $this->lang->line($xfld);
            if (($fld==='') or ($fld===false)){
                $fld = $xfld;
            }
            $result = str_ireplace('%field%', $fld, $vmsg);
        }
        return $result;
    }
    
    protected function validationBlank($data, $dataname) {
        if(!isset($data[$dataname]) or ($data[$dataname]==='')){
            //echo $dataname." err-blank\r\n";
            //$this->validation[$dataname] = $this->lang->line('blank_line');
            $message = $this->getLangMsg('blank_field', $dataname);
            //echo $message."\r\n";
            $this->updateValidation($dataname, $message);
            return false;
        }
        return true;
    }

    public function checkValidationByList($data) {
        //print_r($this->validations);
        $result = true;
        foreach ($this->validations as $fieldName => $field) {
            foreach ($field['validations'] as $validationItem) {
                //print_r($validationItem);
                if (!$this->$validationItem($data, $fieldName)) {
                    //print_r($validationItem);
                    $result = false;
                    break;
                }
            }
        }
        
        return $result;
    }
    
    public function getValidationMsg(){
        //print_r($this->validation_msg);
        $result = '';
        foreach($this->validation_msg as $key=>$item){
            //echo "|".$item."|";
            if ($result!==''){
                $result = $result.''."\r";
            }
            $result = $result.$item;
        }
        return $result;
        //$vmsg = print_r($this->validation_msg, true);
        //return $vmsg;
    }
    


    
}
