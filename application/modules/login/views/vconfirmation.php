<?php 
if(!isset($email)){
    $email='-';
}
if(!isset($full_name)){
    $full_name='-';
}
?>
WNI yang terhormat,<br><br>

Email anda <?php echo $email; ?> didaftarkan dalam sistem eKBRI atas nama <?php echo $full_name; ?>. <br><br>  
Bila anda pemilik email tersebut, untuk melanjutkan proses registrasi ini 
silahkan melakukan konfirmasi dengan mengikuti link berikut ini  
<?php echo $conf_url; ?><br><br>
Bila anda bukan pemilik email ini, anda tidak perlu melakukan apa-apa. <br><br>
Terima kasih.<br><br>
Hormat kami,<br>
KBRI Brussels
