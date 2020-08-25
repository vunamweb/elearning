<?php

global $dir, $navID, $SID;

$dat = isset($_POST["gdat"]) ? $_POST["gdat"] : '';
$un = isset($_POST["unr"]) ? $_POST["unr"] : '';
$em = isset($_POST["mail"]) ? $_POST["mail"] : '';
$aktiv = isset($_GET["aktivierung"]) ? $_GET["aktivierung"] : '';
$reset = isset($_GET["reset"]) ? $_GET["reset"] : '';

$nolog = 1;
$warn = '';


// 75c!TB3

if($aktiv) {
	$sql = "SELECT * FROM morp_kunden WHERE secure='$aktiv' ";
	$res = safe_query($sql);
	$x = mysqli_num_rows($res);
	$nolog = 0;
	if($x > 0) {
		$row = mysqli_fetch_object($res);
		$pass = setpw();
		$sql = "UPDATE morp_kunden set kontrolle='1', pass='".md5($pass)."', newpass=1 WHERE secure='".$aktiv."'";
		$res = safe_query($sql);

			$footer = getVorlagenText(203, "de", $dir);
			$mailto = $row->email;
			$mailsubject = "Erfolgreiche Aktivierung LAK Hessen";
			$mailbody .= utf8_decode("Vielen Dank für Ihre Anmeldung für den geschützten Brereich der LAK Hessen.\n\nLogin: ").$row->kid."\nPasswort: ".$pass."\n\n\n".utf8_decode(strip_tags(trim($footer)));
			$mailheaders = "From: info@apothekerkammer.de";
			$mailheaders = 'From: LAK Hessen <info@apothekerkammer.de>';
			$checkmail = mail($mailto, $mailsubject, $mailbody, $mailheaders);

		if($reset) $output = '<h2>Sie haben Ihr Passwort erfolgreich zurück gesetzt.</h2><p>Sie erhalten jetzt eine E-Mail mit Ihrem vorläufigen Passwort.</p><p>&nbsp;</p><p><a href="'.$dir.$navID[105].'"><i class="fa fa-external-link-square"></i> Hier geht es zum Login</a></p>';
		else  $output = '<h2>Sie haben sich erfolgreich registriert</h2><p>Sie erhalten jetzt eine E-Mail mit Ihrem vorläufigen Passwort.</p><p>&nbsp;</p><p><a href="'.$dir.$navID[105].'"><i class="fa fa-external-link-square"></i> Hier geht es zum Login</a></p>';
	}
}
elseif($dat && $un && $em) {
	$pruefe = email_check($em);
	if($pruefe) {
		$sql = "SELECT * FROM morp_kunden WHERE gebdat='$dat' AND kid='$un'";
		$res = safe_query($sql);
		$x = mysqli_num_rows($res);

		if($x > 0) {
			$nolog = 0;
			$row = mysqli_fetch_object($res);
			// echo " YOU ARE IN !!!!";
			$pass = $row->kontrolle;
			if($pass) {
				$output = '<p>Sie sind bereits freigeschaltet.</p>
				<p>Haben Sie Ihr Passwort vergessen? Dann beantragen Sie das Zurücksetzen Ihres Passwort <a href="'.$dir.$navID[107].'"><i class="fa fa-external-link-square"></i> hier</a></p>';
			}
			else {
				$md5 = md5("LAK".$un."-hes");
				$sql = "UPDATE morp_kunden set SID='$SID', email='$em', secure='".$md5."' WHERE kid=".$row->kid;
				$res = safe_query($sql);
				if($res) {
					$output = '<h2>Sie erhalten jetzt eine E-Mail mit Aktivierungslink.</h2>
				<p>Vielen Dank f&uuml;r Ihre Anmeldung</p>';

					$footer = getVorlagenText(203, "de", $dir);
					$mailto = $em;
					$mailsubject = "Aktivierungslink LAK Hessen";
					$mailbody .= utf8_decode("Vielen Dank für Ihre Anmeldung für den geschützten Brereich der LAK Hessen.\n\nBitte klicken Sie auf den folgenden Link oder kopieren den kompletten Link in die Adresszeile Ihres Internetbrowser.\n").$dir."index.php?aktivierung=".$md5."\n\n".utf8_decode(strip_tags(trim($footer)));

					$mailheaders = 'From: LAK Hessen <info@apothekerkammer.de>';
					$checkmail = mail($mailto, $mailsubject, $mailbody, $mailheaders);
				}
			}
		}
		else $output = "<p>Ihre Mitgliedsinformationen sind uns nicht bekannt.</p><p>&nbsp;</p>";
	}
	else $warn = "<h2>Bitte geben Sie eine g&uuml;ltige E-Mail-Adresse an</h2><p>&nbsp;</p>";
}
elseif($dat || $un || $em) { $warn = "<h2>Bitte f&uuml;llen Sie alle Felder aus.</h2>"; }

if($nolog) {
	$output .= getform($dat, $un, $em);
}

$output = $warn.$output;

?>