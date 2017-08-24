<?php $siteurl = site_url('menu/layanan_wni'); ?>
WNI yang terhormat,<br><br>
Permohonan anda untuk layanan <strong><?php echo getArrayDef($data, 'desk_nama_layanan'); ?></strong> 
dengan kode layanan <strong><?php echo getArrayDef($data, 'layananidstr'); ?></strong> atas nama <strong><?php echo getArrayDef($data, 'full_name'); ?></strong> 
perlu diperbaiki.<br><br>
Harap masuk ke <a href="<?php echo $siteurl;?>">situs eKBRI</a> untuk melakukan perbaikan yang diminta.<br><br>
Terima kasih.<br><br>
Hormat kami,<br>
KBRI Brussels
