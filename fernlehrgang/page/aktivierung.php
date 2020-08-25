<html>
<head>
<title>LAK</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="STYLESHEET" type="text/css" href="css/lak.css">
<script language="JavaScript1.2" src="js/coolmenus4.js">
/*****************************************************************************
Copyright (c) 2001 Thomas Brattli (webmaster@dhtmlcentral.com)

DHTML coolMenus - Get it at coolmenus.dhtmlcentral.com
Version 4.0_beta
This script can be used freely as long as all copyright messages are
intact.
******************************************************************************/
</script>
<style>
	.verdana { font-Family:verdana !important; font-size: 12px; }
</style>
</head>

<body bgcolor="#FFFFFF" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<script language="JavaScript1.2" src="js/menu-main.js">
/*****************************************************************************
Menue Code
******************************************************************************/
</script>
<table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td height="39" valign="top"><img src="images/part5.gif" width="651" height="39"></td>
  </tr>
  <tr>
    <td height="28" valign="top" background="images/part3.gif"><table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="175"><img src="images/part4.gif" width="175" height="28"></td>
          <td><strong><font face="Verdana, Arial, Helvetica, sans-serif">Newsletter</font></strong></td>
        </tr>
      </table></td>
  </tr>
  <tr>
    <td height="18" valign="top"><img src="images/part6.jpg" width="150" height="18"><img src="images/part7.jpg" width="204" height="18"></td>
  </tr>
  <tr>
    <td valign="top">      
      <table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td width="150" valign="top" background="images/part1.gif"><img src="images/part2.jpg" width="150" height="92"></td>
          <td width="10" valign="top">&nbsp;</td>
          <td valign="top"><table width="95%" height="100%" border="0" cellpadding="0" cellspacing="0">
        
              <tr>
          
                <td width="18" valign="top" background="images/text-tile.gif"><img src="images/text-start.gif" width="18" height="31"></td>
                <td valign="top">                 <br>
                  <table width="100%" border="0" cellpadding="0" cellspacing="5" bgcolor="#DBE1E9">
                    <tr>
                      <td>			
<div class="verdana">
		<?php 
		
		$vid = isset($_GET["vid"]) ? $_GET["vid"] : '';
		
		if($vid) {
			include("nogo/config.php");
			include("nogo/funktion.inc");
			include("nogo/de.inc"); 
			include("nogo/db.php");
			dbconnect();
			
			$sql = "UPDATE morp_register set `checked`=1 WHERE vid=$vid";
			$res = safe_query($sql);			
			
			$txt = get_text(9);
/*
			$arr = array("anrede"=>"Anrede", "name"=>"Name", "vorname"=>"Vorname", "email"=>"E-Mail", );
			$sql = "SELECT * FROM morp_newsletter_vt WHERE vid=$vid";
			$res = safe_query($sql);			
			$row = mysqli_fetch_object($res);
			$mbody = '';
			
			foreach($arr as $key=>$val) {
				if($key == "nachricht") $mbody .= $val.': <br><b>'.nl2br($row->$key)."</b>\n<br>";
				else $mbody .= $val.': <b>'.$row->$key."</b>\n<br>";
			}

			//$Empfaenger = 'xacffm@gmx.de';
			$name 		= $morpheus["emailname"];
			$kundemail 	= $morpheus["email"];
			$Betreff 	= "Neue Newsletteranmeldung";

			include("page/mail.php");

		}
		else $txt = '<p style="color:#ff0000;font-weight:bold;">Es ist ein Fehler entstanden!!!!!</p>';
*/		
			echo $txt; 
		} 
		
		?>
</div>	

                      </td>
                    </tr>
                  </table></td>
              </tr>
		  </table></td>
        </tr>
      </table>
      <p>&nbsp;</p></td>
  </tr>
</table>
</body>
</html>