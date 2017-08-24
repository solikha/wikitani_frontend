<?php
if (!isset($content)){
    $content = '';
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Notification email template</title>
</head>

<body bgcolor="#8d8e90">
<table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#8d8e90">
  <tr>
    <td><table width="600" border="0" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF" align="center">
        <tr>
          <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="61"><img src="https://brussel.ekbri.id/assets/images/email/garuda.png" width="45" border="0" alt="" style="margin-left: 10px"/></td>
                <td width="130" >
					<span style="font-family: 'Open Sans'; font-size:12px; font-weight:900; letter-spacing: 0.8px">KEDUTAAN BESAR</span><br>
					<span style="font-family: 'Open Sans'; font-size:11px; font-weight:900">REPUBLIK INDONESIA</span><br>
					<span style="font-family: 'Open Sans'; font-size:11px; letter-spacing: 0.6px">DI BRUSSELS, BELGIA</span>
				</td>
				
                <td width="407"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
						<td height="46" align="right" valign="middle">
						</td>
                    </tr>
                    <tr>
                      <td height="30"><img src="https://brussel.ekbri.id/assets/images/email/line1.png" width="405" height="30" border="0" alt=""/></td>
                    </tr>
                  </table></td>
              </tr>
            </table></td>
        </tr>
        <tr>
          <td align="center">&nbsp;</td>
        </tr>
        <tr>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td>
          <table width="100%" border="0" cellspacing="0" cellpadding="0"
             style="font-family: 'Open Sans'">
              <tr>
                <td width="10%">&nbsp;</td>
                <td width="80%" align="left" valign="top">
				<?php echo $content; ?>
				</td>
                <td width="10%">&nbsp;</td>
              </tr>
              <tr>
                <td>&nbsp;</td>
              </tr>
            </table></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td><img style="margin-left: 3px" src="https://brussel.ekbri.id/assets/images/email/line2.png" width="594" height="10" style="display:block" border="0" alt=""/></td>
        </tr>
        <tr>
          <td align="center"><span style="margin-left: 10px; font-family:'Open Sans', Helvetica, Arial, sans-serif; color:#231f20; font-size:12px">
		  <strong>KEDUTAAN BESAR REPUBLIK INDONESIA di BRUSSELS, BELGIA</span></td>
        </tr>
        <tr>
          <td align="center"><span style="margin-left: 10px; font-family:'Open Sans', Helvetica, Arial, sans-serif; color:#231f20; font-size:8px">
		  <strong>
        Boulevard de la Woluwe 38, 1200 Brussels, Belgium | Telepon: (+32) 2775 0120, 2779 0915 |
		<a href="mailto:kbri.brussel@skynet.be" style="color:#010203; text-decoration:none">kbri.brussel@skynet.be</a>
		</strong</span></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td>&nbsp;</td>
        </tr>
      </table></td>
  </tr>
</table>
</body>
</html>
