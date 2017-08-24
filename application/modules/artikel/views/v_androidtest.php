<?php
ob_start();
if (!defined('BASEPATH'))
    exit('No direct script access allowed'); 
?>
<html>
<head></head>
<body>

</body>

<script>
var person='<?php echo $data_person; ?>';
 //person=JSON.parse('<?php echo $data_person; ?>');
document.write(person);
//document.write(person.name);
//document.write(typeof(person));

</script>

</html>