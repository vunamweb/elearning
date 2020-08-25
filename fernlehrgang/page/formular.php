<?php
global $morpheus, $projID, $pageText, $lan, $navID, $subDetail, $gmap, $dir;

$re = $_POST["reise"];
$st = $_POST["stimme"];
$nm = $_POST["name"];
$na = $_POST["nachricht"];
$em = trim($_POST["email"]);
$te = $_POST["tel"];

$buchen = isset($_GET["buchen"]) ? $_GET["buchen"] : '';
$stimme = isset($_GET["stimme"]) ? $_GET["stimme"] : '';

$pruefe = email_check($em);

if ($nm && $pruefe) {
	$mbody = '
<style Type="text/css">
<!-- 
p, h1 { 
font-family:Arial; 
font-size:11px; 
line-height:16px; 
}
//-->
</style>

<p><strong>Name</strong>: '.$nm.'</p>
<p><strong>Telefon:</strong>: '.$te.'</p>
<p><strong>E-Mail</strong>: '.$em.'</p>
<p><strong>Reise</strong>: '.$re.'</p>
<p><strong>Kundenmeinung</strong>: '.$st.'</p>
<p>----------------------------------------------------------------------------</p>
<p><strong>Nachricht</strong>:<br>
'.$na.'</p> 	
';
			
	// $Empfaenger = $morpheus["email"];
	$Empfaenger = array('mail@marokko-4you.com');
	//$Empfaenger = array('post@pixel-dusche.de');
	$bcc 		= 'post@pixel-dusche.de';
	$name 		= $morpheus["emailname"];
	$kundemail 	= $morpheus["email"];
	$Betreff 	= "Kontaktanfrage aus dem Internet";
	
		$today = date("Y-m-d H:i:s");
		$sql = "insert morp_email set betreff='$Betreff', mail='$em', datum='$today', text='$mbody', `to`='$Empfaenger'";
		safe_query($sql);
	
	include("mail.php");
	
	$output = '<h1>Vielen Dank für Ihre Nachricht. </h1>
	<p>Wir werden uns umgehend um Ihr Anliegen kümmern.<br />
	<br />
	
	<p>&nbsp;</p>
	<p>&nbsp;</p>
	<p>&nbsp;</p>
	';
			
}

else {
	if($buchen) {
		$sql = "SELECT reise FROM  `morp_reisen` WHERE oid=$buchen";
		$res = safe_query($sql);
		$row = mysqli_fetch_object($res);
		$buchen = $row->reise;
	}

	$output .= '
<script>
function checkValues () {
	var err=0;d=document.formular;
	if (d.name.value==\'\') {
		err=1;
		alert (\'Bitte füllen Sie das Feld: Name aus!\');
		d.name.focus();
		return;
	}
	if (d.email.value==\'\' || d.email.value==\'E-Mail*\') {
		err=1;
		alert (\'Bitte füllen Sie das Feld: E-Mail aus!\');
		d.email.focus();
		return;
	}

	if (err==0) {
		d.submit();
	}
}

</script>	

<link href="'.$dir.'css/formstyle.css" type="text/css" rel="stylesheet" />

	<form class="contact-frm" name="formular" id="kontakt_formular" action="" onsubmit="javascript:checkValues();" method="post">
		<fieldset>
			<label>Vorname, Name *</label>
			<input id="name" name="name" value="'.$nm.'" class="txt" />
			<label>Telefon</label>
			<input id="tel" name="tel" value="'.$te.'" class="txt" />
			<label>E-Mail *</label>
			<input id="email" name="email" value="'.$em.'" class="txt" />
			'.($stimme ? '<label>Reisenummer / Reise</label>
			<input id="stimme" name="reise" readonly value="'.$stimme.'" class="txt" />' : '').'
			'.($buchen ? '<label>Reisenummer / Reise</label>
			<input id="reise" name="reise" readonly value="'.$buchen.'" class="txt" />' : '').'
			<label>Nachricht</label>
			<textarea class="txa" id="nachricht" name="nachricht">'.$na.'</textarea>
			<input class="btn-send" type="image" src="'.$dir.'images/btn_send.jpg"/>
		</fieldset>
	</form>	

<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>

';
}
$pageText = '';

?>