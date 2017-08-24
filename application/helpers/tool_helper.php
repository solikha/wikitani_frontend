<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/* Manggu Framework
 * Simple PHP Application Development
 * Kusnassriyanto S. Bahri
 * kusnassriyanto@gmail.com
 * 
 */

function getArrayDef($array, $index, $default=null){
    if (isset($array[$index])){
        return $array[$index];
    } else {
        return $default;
    }
}


function do_number_format($value, $decimal=2){
    $value = str_replace(',', '', $value);
    if (is_numeric($value)){
        return number_format($value, $decimal);
    } else {
        return '';
    }
}

   function limitString($string, $limit) {
    // Return early if the string is already shorter than the limit
    if(strlen($string) < $limit) {return $string;}

    $regex = "/(.{1,$limit})\b/";
    preg_match($regex, $string, $matches);
	//$length=strlen($matches[1]);
	//$start=0;
	//return substr($matches[1],1,$length)
	
    return $matches[1];
}

function truncate($text, $length) {
   $length = abs((int)$length);
   if(strlen($text) > $length) {
      $text = preg_replace("/^(.{1,$length})(\s.*|$)/s", '\\1', $text);
	 
   }
  //$text = str_replace('|',"\n",$text);
   return(strip_tags($text));
}


function getNumHash($x){
    $num = 879182731+$x;
    $xd = hash('crc32b', $num);
    $xd = base_convert($xd, 16, 36);
    $xd = strtoupper($xd);
    $xd = substr($xd.'EAS1A2', 0, 8);
    $xxd = $xd;
    $a = substr($xxd, 0, 4);
    $b = substr($xxd, 4, 4);
    $xd = $b.'-'.$a;
    return $xd;
}

function enc_rc4($key, $str) {
        $s = array();
        for ($i = 0; $i < 256; $i++) {
                $s[$i] = $i;
        }
        $j = 0;
        for ($i = 0; $i < 256; $i++) {
                $j = ($j + $s[$i] + ord($key[$i % strlen($key)])) % 256;
                $x = $s[$i];
                $s[$i] = $s[$j];
                $s[$j] = $x;
        }
        $i = 0;
        $j = 0;
        $res = '';
        for ($y = 0; $y < strlen($str); $y++) {
                $i = ($i + 1) % 256;
                $j = ($j + $s[$i]) % 256;
                $x = $s[$i];
                $s[$i] = $s[$j];
                $s[$j] = $x;
                $res .= $str[$y] ^ chr($s[($s[$i] + $s[$j]) % 256]);
        }
        return $res;
}    

function hexToStr($hex){
    $string='';
    for ($i=0; $i < strlen($hex)-1; $i+=2){
        $string .= chr(hexdec($hex[$i].$hex[$i+1]));
    }
    return $string;
}

function strToHex($string){
    $hex='';
    for ($i=0; $i < strlen($string); $i++){
        $hex .= str_pad(dechex(ord($string[$i])), 2, '0', STR_PAD_LEFT);
    }
    return $hex;
}    

//digunakan pada module search engine 
function getBeautyString($konten){
		$result=$konten;
        $prefix = "'";
		$result = preg_replace('/^' . preg_quote($prefix, '/') . '/', '', $result);	
       		
		$result = substr($result, 0, -1);		
	    return $result;
		
	}
function removeAllnewlineCharacters($string){
	$result = trim(preg_replace('/\s+/', ' ', $string));
	return $result;
}
function getNativeUrl(){
    if(isset($_SERVER['HTTPS'])){
        $protocol = ($_SERVER['HTTPS'] && $_SERVER['HTTPS'] != "off") ? "https" : "http";
    }
    else{
        $protocol = 'http';
    }
    return $protocol . "://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
}

function getHtdocs(){
    if(isset($_SERVER['HTTPS'])){
        $protocol = ($_SERVER['HTTPS'] && $_SERVER['HTTPS'] != "off") ? "https" : "http";
    }
    else{
        $protocol = 'http';
    }
    return $protocol . "://" . $_SERVER['HTTP_HOST'];
}
function getEmbedUrl($url){
   return	preg_replace("/\s*[a-zA-Z\/\/:\.]*youtube.com\/watch\?v=([a-zA-Z0-9\-_]+)([a-zA-Z0-9\/\*\-\_\?\&\;\%\=\.]*)/i","<iframe class='embed-responsive-item' style=\'width:auto; height:auto;'\ src=\"//www.youtube.com/embed/$1\" frameborder=\"0\" allowfullscreen></iframe>",$url);
}
// function limitString($in,$limit){
// $out = strlen($in) > $limit ? substr($in,0,$limit)."..." : $in;
// $result= $in;
// return $result;
// }

?>
