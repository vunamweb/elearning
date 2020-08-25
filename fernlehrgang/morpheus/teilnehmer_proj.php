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

$data   	= $_REQUEST["data"];
$kurse   	= $_POST["kurse"];
$teilnehmer	= $_POST["teilnehmer"];
$nname 		= $_POST["nname"];
$usr 		= $_POST["usr"];
$id 		= $_POST["id"];
$del		= $_POST["del"];
$delstart	= $_POST["delstart"];
$pro_id 	= $_POST["pro_id"];

$user 		= $_GET["user"];
$delete		= $_GET["delete"];
/*
if ($del) {
	$data = $teilnehmer;
	$pid  = $projekt;
	
	echo "Sind Sie sich sicher, dass Sie die Teilnehmer aus dem Projekt l&ouml;schen m&ouml;chten?<p>
		&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <a href=\"teilnehmer_proj.php?delete=$data&pid=$pid\">Ja</a>
		&nbsp; &nbsp; &nbsp; &nbsp; <a href=\"teilnehmer_proj.php\">Nein</a>";
}

elseif ($delete) {
	$pid  = $_GET["pid"];

	if ($data && $pid) {
		$query = "delete FROM projekt_user where projekt=$pid and user=$data";
		safe_query($query);
	}

	echo "<a href=\"teilnehmer_proj.php\">" .ilink() ." weiter</a><p>";
	
	$delete = 0;
	$id = 0;
}
*/
if ($kurse) {
	$user = $teilnehmer;
	
	if ($user) {
		$query = "DELETE FROM projekt_user WHERE user=$user";
		$result = safe_query($query);

		foreach ($kurse as $val) {
			$query = "INSERT projekt_user SET user=$user, projekt=$val";
			$result = safe_query($query);
		}			
	}	

	echo "<p><b>Zuordnung abgeschlossen</b></p>
		<p><a href=\"teilnehmer_edit.php\">" .ilink() ." weiter</a></p>";
}

elseif (!$data && !$del && !$projekt) {
	echo "Zuerst muss eine Auswahl von Teilnehmern vorgenommen werden,<br>
		dann werden Sie aufgefordert ein Projekt auszuw&auml;hlen.<p>";
	getTeilnehmer ($nname, $usr, $id, "Teilnehmer zuordnen", "projekt", $pro_id, 24);
}

elseif ($data)  {
	echo "W&auml;hlen Sie die Projekte f&uuml;r den Teilnehmer <b>$data</b>
	<p>&nbsp;</p>
		<form method=post>
		<input type=hidden name=\"teilnehmer\" value=\"$data\">
		<input type=hidden name=\"del\" value=\"$delstart\">\n";
	
	$vorhanden = array();
	$query 	= "SELECT * FROM projekt_user WHERE user=$data";	
	$result = safe_query($query);
	$x 		= mysqli_num_rows($result);
	if ($x) {
		while ($row = mysqli_fetch_array($result)) {
			$vorhanden[] = $row["projekt"];
		}
	}

	// print_r($vorhanden);

	$query 	= "SELECT * FROM projekt order by name";	
	$result = safe_query($query);
	$x 		= mysqli_num_rows($result);
	$x		= $x/2;
	$c		= 0;
	
	echo "<div style=\"float: left; width: 350px;\">";

	while ($row = mysqli_fetch_array($result)) {
		$c++;
		$nm = $row["name"];
		$id = $row["id"];
		if ($c > $x) { echo "</div><div style=\"float: left; width: 330px;\">"; $c = 0; }

		if (in_array($id, $vorhanden)) $sel=" checked";
		else $sel = '';
		
		echo '<p><input type="Checkbox" name="kurse[]" value="'.$id.'"'.$sel.'>&nbsp;&nbsp;'.$nm.'</p>
		';
	}
	
	echo '</div>
		<p style="clear: left;">&nbsp;</p><p><input type=submit name="zuweisen" value="zuweisen"></p>
	</form>
	';
}

echo "<p><a href=\"teilnehmer_edit.php\">" .ilink() ." abbrechen / ende</a>
<p>&nbsp;</p>";

?>

<?
include("footer.php");
?>