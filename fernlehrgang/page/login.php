<?php
# print_r($_SESSION);

global $dir, $navID;

$pw = isset($_POST["pwd"]) ? $_POST["pwd"] : '';
$un = isset($_POST["unr"]) ? $_POST["unr"] : '';

$pwA = isset($_POST["pw1"]) ? $_POST["pw1"] : '';
$pwB = isset($_POST["pw2"]) ? $_POST["pw2"] : '';
$sec = isset($_POST["sec"]) ? $_POST["sec"] : '';

$nolog = 1;
$warn = '';
$min = 6;
$youAreIn = 0;

$sessMNR = isset($_SESSION["custname"]) ? $_SESSION["custname"] : '';
$sessPASS = isset($_SESSION["pd"]) ? $_SESSION["pd"] : '';

if($sessMNR && $sessPASS) {
	$sql = "SELECT * FROM morp_kunden WHERE pass='".$sessPASS."' AND kid='".$sessMNR."' AND kontrolle=1 AND inlist=1";
	$res = safe_query($sql);
	$x = mysqli_num_rows($res);
	if($x < 1) {
		$sql = "SELECT * FROM user WHERE pw='".$sessPASS."' AND uname='".$sessMNR."'";
		$res = safe_query($sql);
		$x = mysqli_num_rows($res);
	}
	if($x > 0) $youAreIn = 1;
}

if($youAreIn) { $output .= '<h3>Sie sind eingeloggt</h3>'; }

else {
	if($pwA && $pwB) {
		$kid = holeID($sec);
		$nolog = 0;
		if($pwA != $pwB) $output .= '<h2>Die Passwörter stimmen nicht überein</h2><p>&nbsp;</p>'.newPW($min, $kid);
		elseif(strlen($pwA) < $min) $output .= '<h2>Das Passwort muss aus mind. '.$min.' Zeichen bestehen.</h2><p>&nbsp;</p>'.newPW($min, $kid);
		else {
			$zahl = 0;
			$zeichen = 0;
			if(preg_match("/\d/", $pwA)) $zahl = 1;
			if(preg_match("/[a-zA-Z]/", $pwA)) $zeichen = 1;
			if(!$zahl) $output .= '<h2>Das Passwort muss mind. eine Zahl enthalten.</h2><p>&nbsp;</p>'.newPW($min, $kid);
			elseif(!$zeichen) $output .= '<h2>Das Passwort muss mind. einen Buchstaben enthalten.</h2><p>&nbsp;</p>'.newPW($min, $kid);
			else {
				$sql = "UPDATE morp_kunden set kontrolle='1', pass='".md5($pwA)."', newpass=0 WHERE kid='".$kid."'";
				$res = safe_query($sql);
				#$sql = "SELECT mnr FROM morp_kunden WHERE kid=$kid";
				#$res = safe_query($sql);
				#$row = mysqli_fetch_object($res);
				$output .= '<h2>Das Passwort wurde erfolgreich geändert.</h2><p>&nbsp;</p>';
				$_SESSION["custname"] = $kid;
				$_SESSION["pd"] = md5($pwA);
			}
		}
	}
	elseif($pw && $un) {
		$sql = "SELECT * FROM morp_kunden WHERE pass='".md5($pw)."' AND kid='$un' AND kontrolle=1";
		$res = safe_query($sql);
		$x = mysqli_num_rows($res);
		$col = '#ff0000';

		if($x > 0) {
			$row = mysqli_fetch_object($res);
			// echo " YOU ARE IN !!!!";

			// PRUEFE OB MITGLIED AKTIV
			if($row->inlist < 1) {
				$warn = "<p>Ihr Login war <b>nicht</b> erfolgreich.</p><p>&nbsp;</p>".'
			<p>Ihre Mitgliedschaft könnte beendet sein. Wenn das nicht der Fall ist, kontaktieren Sie uns bitte. <a href="'.$dir.$navID[80].'"><i class="fa fa-external-link-square"></i></a></p><p>&nbsp;</p>';
			}
			elseif($row->newpass) {
				$nolog = 0;
				$output .= newPW($min, $row->kid);
			}
			else {
				$nolog = 0;
				$_SESSION["custname"] = $row->kid;
				$_SESSION["pd"] = $row->pass;
				$warn = "Ihr Login war erfolgreich.";
				$col = 'green';
			}
		}
		else {
			$sql = "SELECT * FROM user WHERE pw='".md5($pw)."' AND uname='".$un."'";
			$res = safe_query($sql);
			$x = mysqli_num_rows($res);

			if($x < 1)	$warn = "<p>Ihr Login war <b>nicht</b> erfolgreich.</p><p>&nbsp;</p>".'
			<p>Haben Sie Ihr Passwort vergessen? Dann beantragen Sie das Zurücksetzen Ihres Passwort <a href="'.$dir.$navID[107].'"><i class="fa fa-external-link-square"></i> hier</a></p><p>&nbsp;</p>';
			else {
				$row = mysqli_fetch_object($res);
				$nolog = 0;
				$_SESSION["custname"] = $row->uname;
				$_SESSION["pd"] = $row->pw;
				$warn = "Ihr Login war erfolgreich.";
				$col = 'green';
			}
		}
	}


	if($nolog) {
		$output .= '
		<form name="golog" method="post" class="form">
			<input type="text" name="unr" id="unr" value="" placeholder="Ihre Mitgliedsnummer" /><br/>
			<input type="password" name="pwd" id="pwd" value="" placeholder="Passwort" /><br/>
			<input type="submit" value="Login" />
		</form>
	';
	}


}

$output = $warn.$output;

?>