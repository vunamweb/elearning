<?php
session_start();
# # # # # # # # # # # # # # # # # # # # # # # # # # # 
# www.pixel-dusche.de                               #
# björn t. knetter                                  #
# start 12/2003                                     #
#                                                   #
# post@pixel-dusche.de                              #
# frankfurt am main, germany                        #
# # # # # # # # # # # # # # # # # # # # # # # # # # # 

include("cms_include.inc");

# # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # 
# # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # 

echo '<div id=content_big class=text>';

$del   = $_REQUEST["del"];
$delete = $_REQUEST["delete"];
$nname 	= $_REQUEST["nname"];
$vname 	= $_REQUEST["vname"];
$usr 	= $_REQUEST["usr"];
$usrid 	= $_REQUEST["usrid"];
$pw 	= $_REQUEST["pw"];
$id 	= $_REQUEST["id"];
$kurse 	= $_REQUEST["kurse"];

# print_r($_REQUEST);

if ($del) {
	echo "<p>Sind Sie sich sicher, dass Sie den Teilnehmer username: <b>$usr</b> id: <b>$del</b> l&ouml;schen m&ouml;chten?</p>
		<p>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <a href=\"teilnehmer_edit.php?delete=$del\">Ja</a>
		&nbsp; &nbsp; &nbsp; &nbsp; <a href=\"teilnehmer_edit.php\">Nein</a></p>";
	die("</body></html>");
}
elseif ($delete) {
	$query = "delete FROM teilnehmer WHERE id=$delete";
	safe_query($query);
	$query = "delete FROM projekt_user WHERE user=$delete";
	safe_query($query);

	$delete = 0;
	$id = 0;
}

if ($kurse) {
	foreach ($kurse as $val) {
		$query = "select * FROM projekt_user where user='$usrid' and projekt='$val'";
		$result = safe_query($query);
		if (mysqli_num_rows($result) < 1) {
			$query = "insert projekt_user set user='$usrid', projekt='$val'";
			$result = safe_query($query);
			echo '<p>user <b>'.$usrid.'</b> wurde projekt <b>'.$val.'</b> zugeordnet</p>
			';		
		}
		else echo '<p><em>user <b>'.$usrid.'</b> war dem projekt <b>'.$val.'</b> bereits zugeordnet</em></p>
			';
	}
	
	echo '<p>&nbsp;</p>
		<form action="../phpBB/pixel-profile.php" method="post" target="_blank">'."
			<input name=\"usr\" type=\"text\" value=\"$usr\">
			<input name=\"vname\" type=\"hidden\" value=\"$vname\">
			<input name=\"nname\" type=\"hidden\" value=\"$nname\">
			<input name=\"reg\" type=\"hidden\" value=\"pixel\">
			<input name=\"pw\" type=\"hidden\" value=\"$pw\">".'
			<p><input type="submit" name="phpBB" value="in phpBB eintragen" style="background-color:#ff0000; color:#ffffff; height:20px; width: 160px;"></p>
	';
	die ("</body></html>");
}
if (!$nname && !$vname) {
	echo '<p><b>Neuen Teilnehmer hinzuf&uuml;gen</b></p>
	<form action="teilnehmer_edit.php" name="neu" method="post">
	<table cellpadding="6" cellspacing="1">
		<tr>
			<td>Vorname</td>
			<td><input type="Text" name="vname" value="'.$_POST["vname"].'"></td>
			<td>Nachname</td>
			<td><input type="Text" name="nname" value="'.$_POST["nname"].'"></td>
			<td><input type="submit" name="einfuegen" value="einfügen"></td>
		</tr>
	</table>
		';
	
	echo "</form>
		<p><a href=\"index.php\">" .backlink() ." zur&uuml;ck</a></p>
		<p>&nbsp;</p>
		<table>";
	
	//
	// alphabetische Suche
	for ($i=65; $i<=90; $i++) {
		$ch = chr($i);
		echo '<a href="teilnehmer_edit.php?char='.$ch.'"><b>'.$ch.'</b></a> &nbsp; ';
	}
	//________________________________________
	
	// Wurde ein Buchstabe gewaehlt?
	if(!$th_char = $_GET["char"]) $th_char = "a";
	// if (!$th_char) $query = "SELECT * FROM teilnehmer order by nname";
	 $query = "SELECT * FROM teilnehmer where nname LIKE '$th_char%' order by nname";
	$result = safe_query($query);
	
	$col = array("#FFFFFF","#EFECEC");
	$ct  = 0;

	// Liste aller Teilnehmer
	while ($row = mysqli_fetch_object($result)) {
		$name 	= $row->nname;
		$vn		= $row->vname;
		$un		= $row->usr;
		$id		= $row->id;
		$pw		= $row->pwd;
		echo "<tr bgcolor=$col[$ct]><td width=100><a href=\"teilnehmer_proj.php?data=".$id."\">$name</a></td><td width=100>$vn</td><td width=100>$un</td><td width=100>$pw</td><td width=50>$id</td><td><a href=\"teilnehmer_edit.php?del=$id&usr=$un\"><img src=\"images/delete.gif\" alt=\"\" width=\"9\" height=\"10\" border=\"0\"></a></td></tr>\n";
		
		if ($ct == 0) $ct = 1;		//farbendefenition
		else $ct = 0;
	}
	echo "</table>";
	
}
elseif ($nname && $vname) {
	$username = substr(strtolower($vname), 0,1) .strtolower($nname);
	
	$query = "SELECT * FROM teilnehmer where usr='$username'";
	$result = safe_query($query);
	
	if (mysqli_num_rows($result) > 0) {
		$query = "SELECT * FROM teilnehmer where usr LIKE '".$username."%'";
		$result = safe_query($query);
		if ($a = mysqli_num_rows($result)) $a++;
		else $a=1;
		$username = substr(strtolower($vname), 0,1) .strtolower($nname).$a;
	}
	
		$query = "insert teilnehmer set usr='$username', nname='$nname', vname='$vname'";
		$result = safe_query($query);
		# id auslesen
		$thid = mysqli_insert_id($mylink);
		# passwort generieren
		$abc = array("q", "w", "e", "r", "t", "z", "u", "i", "p", "a", "s", "d", "f", "g", "h", "j", "k", "y", "x", "c", "v", "b", "n", "m");
		$rand = array_rand($abc, 2);
		$pw = $abc[$rand[0]] .$abc[$rand[1]] .$thid;
		$rand = array_rand($abc, 3);
		$pw .= $abc[$rand[0]] .$abc[$rand[1]] .$abc[$rand[2]];
		# datensatz aktualisieren
		$query = "update teilnehmer set pwd='$pw' where id=$thid";
		$result = safe_query($query);

		echo "<p>Neuer Teilnehmer: $vname $nname - id: $thid - passwort: $pw</p>
		<p><a href=\"mailto:x@x.de?subject=Ihre Zugangsdaten bei ECONECT&body=username: $username %0D%0Apasswort: $pw %0D%0A\">".ilink()." E-Mail an Teilnehmer</a></p>";

		$query 	= "SELECT * FROM projekt order by id";	
		$result = safe_query($query);
		$x 		= mysqli_num_rows($result);
		$x		= $x/2;
		$c		= 0;
		
		echo "&nbsp;<br>Dem Teilnehmer <b>$nname</b> Kurse zuweisen<p>
			<form method=post>
				<input name=\"usrid\" type=\"Hidden\" value=\"$thid\">
				<input name=\"usr\" type=\"Hidden\" value=\"$username\">
				<input name=\"vname\" type=\"Hidden\" value=\"$vname\">
				<input name=\"nname\" type=\"Hidden\" value=\"$nname\">
				<input name=\"pw\" type=\"Hidden\" value=\"$pw\">
			<div style=\"float: left; width: 250px;\">";
	
		while ($row = mysqli_fetch_array($result)) {
			$c++;
			$nm = $row["name"];
			$id = $row["id"];
			if ($c > $x) { echo "</div><div style=\"float: left; width: 250px;\">"; $c = 0; }
			echo '<p><input type="Checkbox" name="kurse[]" value='.$id.'> '.$nm.'</p>
			';
		}
		
		echo '</div>
			<p style="clear: left;">&nbsp;</p><p><input type=submit name="zuweisen" value="zuweisen"></p>
		</form>
		';

#	}
#	else { echo "<p>Der Teilnehmer k&ouml;nnte bereits angelegt sein.</p>
#		<p><a href=\"teilnehmer_edit.php\">" .backlink() ." zur&uuml;ck</a>"; }
}

?>

<?
include("footer.php");
?>