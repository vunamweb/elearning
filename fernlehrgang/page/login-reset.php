<?php

global $dir, $navID, $SID;

$dat = isset($_POST["gdat"]) ? $_POST["gdat"] : '';
$un = isset($_POST["unr"]) ? $_POST["unr"] : '';
$em = isset($_POST["mail"]) ? $_POST["mail"] : '';

$nolog = 1;
$warn = '';

if($dat && $un && $em) {
	$pruefe = email_check($em);
	if($pruefe) {
		$sql = "SELECT * FROM morp_kunden WHERE gebdat='$dat' AND kid='$un'";
		$res = safe_query($sql);
		$x = mysqli_num_rows($res);

		if($x > 0) {
			$nolog = 0;
			$row = mysqli_fetch_object($res);
			// echo " YOU ARE IN !!!!";

			$md5 = md5("LAK".$un."-".date("Ymd"));
			$sql = "UPDATE morp_kunden set SID='$SID', email='$em', secure='".$md5."' WHERE kid=".$row->kid;
			$res = safe_query($sql);
			if($res) {
				$output = '<h2>Passwort geändert</h2>
			<p>Sie erhalten jetzt eine E-Mail mit Aktivierungslink.</p>';

				$footer = getVorlagenText(203, "de", $dir);
				$mailto = $em;
				$mailsubject = "Aktivierungslink LAK Hessen";
				$mailbody .= "Sie haben ein neues Passwort beantragt.\n\nBitte klicken Sie auf den folgenden Link oder kopieren den kompletten Link in die Adresszeile Ihres Internetbrowser.\n".$dir."index.php?aktivierung=".$md5."&reset=1\n\n".utf8_decode(strip_tags(trim($footer)));

				$mailheaders = 'From: LAK Hessen <info@apothekerkammer.de>';
				$checkmail = mail($mailto, $mailsubject, $mailbody, $mailheaders);
			}

		}
		else $output = "<p>Ihre Mitgliedsinformationen sind uns nicht bekannt.</p><p>&nbsp;</p>";
	}
	else $warn = "<h2>Bitte geben Sie eine gültige E-Mail-Adresse an</h2><p>&nbsp;</p>";
}
elseif($dat || $un || $em) { $warn = "<h2>Bitte füllen Sie alle Felder aus.</h2>"; }

if($nolog) {
	$output .= getform($dat, $un, $em);
}


$output = $warn.$output;

?>