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

echo '<div id=content class=text><p><b>Fachbereiche verwalten</b></p>';

$rWert 	= $_REQUEST["rWert"];
$fbid	= $_REQUEST["fbid"];
$edit	= $_REQUEST["edit"];
$del	= $_REQUEST["del"];
$save	= $_REQUEST["speichern"];
$upd	= $_REQUEST["update"];

if ($save && $rWert && $fbid) {
	$fb	= $_REQUEST["fb"];
	$sql = "set fb='$fb', rWert=$rWert";
	
	if ($fbid == "neu") $query = "insert ";
	else $query = "update ";
	
	$query .= "ec_fachbereiche " .$sql;
	if ($fbid != "neu") $query .= " where fbid=$fbid";
	
	safe_query($query);
#	dbconnect_live();
#	safe_query($query);
#	dbconnect();

	unset($fbid);
}

elseif ($del && $rWert && $fbid) {
	$query .= "DELETE from ec_fachbereiche WHERE fbid=$fbid AND rWert=$rWert";
	safe_query($query);
#	dbconnect_live();
#	safe_query($query);
#	dbconnect();

	unset($fbid);
}

elseif ($save && $edit) {
	$art	= $_REQUEST["art"];
	$sql = "set art='$art'";
	
	if ($edit == "neu") $query = "insert ";
	else $query = "update ";
	
	$query .= "rechnungnr " .$sql;
	if ($edit != "neu") $query .= " where rWert=$edit";
	
	safe_query($query);
#	dbconnect_live();
#	safe_query($query);
#	dbconnect();

	unset($edit);
}

if ($edit) {
	echo "<p>Fachbereich hinzufügen oder ändern</p>\n"; 

	if ($edit == "neu") $neu = 1;
	else				$update = 1;
	
	if ($update) {
		$query  = "SELECT * FROM ec_rechnungnr where rWert=$edit";
		$result = safe_query($query);
		$row 	= mysqli_fetch_object($result);
		$name 	= $row->art;
	}

	echo '<p>&nbsp;</p>
		<form action="dozenten-fb.php" method="post" name="fachbereich"><input type="text" name="neu" value="'.$neu.'">
		<p><input type="Text" name="edit" value="'.$edit.'" style="width:50px;"> &nbsp; Rechnungsnummer</p>
		<p><input type="Text" name="art" value="'.$name.'" style="width:150px;"> &nbsp; Name des Fachbereiches</p>
		<p>&nbsp;
		</p><p><input type="submit" name="speichern" value="speichern"></p></form>
	';

	echo "<p>&nbsp;</p><p><a href=\"dozenten-fb.php\">".backlink()." zurück</a></p>\n";
}

elseif (!$rWert) {
	$query  = "SELECT * FROM ec_rechnungnr";
	$result = safe_query($query);
	
	while ($row = mysqli_fetch_object($result)) {
		$name 	= $row->art;
		$rw		= $row->rWert;
		$id		= $row->id;
		echo "<p style=\"float:left; width: 100px; background-color:#EFECEC;\"> &nbsp; <a href=\"dozenten-fb.php?rWert=$rw\" title=\"Untergruppen des Fachbereiches editieren\">".'<img src="images/plus.gif" alt="" width="11" height="10" border="0" title="Untergruppen des Fachbereiches editieren">&nbsp;'." $name</a></p><p style=\"float:left; width: 100px; background-color:#EFECEC; height: 16px;\">Rechnungnr.: $rw</p><p style=\"float:left; width: 30px; background-color:#EFECEC; height: 16px;\">&nbsp;<a href=\"dozenten-fb.php?edit=$rw\"><img src=\"images/stift.gif\" width=\"9\" height=\"9\" alt=\"\" border=\"0\" title=\"Fachbereich editieren\"></a></p><p style=\"clear:left;\"></p>\n";
	}
	echo "<p style=\"clear:left;\">&nbsp;</p><p><a href=\"dozenten-fb.php?edit=neu\">".ilink()." NEU</a></p>\n";
}

elseif ($rWert && !$fbid) {
	$query  = "SELECT * FROM ec_rechnungnr where rWert=$rWert"; # nur, um den namen auszulesen.
	$result = safe_query($query);
	$row = mysqli_fetch_object($result);
	$art = $row->art;
	echo "<p>Fachbereich <b>".$art."</b></p>\n"; 

	$query  = "SELECT * FROM ec_rechnungnr r, ec_fachbereiche f WHERE f.rWert=$rWert and f.rWert=r.rWert";
	$result = safe_query($query);

	while ($row = mysqli_fetch_object($result)) {
		$name 	= $row->fb;
		$rw		= $row->rWert;
		$id		= $row->fbid;
		echo "<p style=\"float:left; width: 360px; height: 16px; background-color:#EFECEC;\">&nbsp; &nbsp;<a href=\"dozenten-fb.php?rWert=$rw&fbid=$id\"> <b>$name</b> &nbsp; &nbsp;<img src=\"images/stift.gif\" alt=\"editieren\" width=\"9\" height=\"9\" border=\"0\"></a></p><p style=\"float:left; width: 40px; height: 16px; background-color:#EFECEC;\">&nbsp; &nbsp;<a href=\"dozenten-fb.php?rWert=$rw&fbid=$id&del=1\"> &nbsp;<img src=\"images/delete.gif\" alt=\"editieren\" width=\"9\" height=\"10\" border=\"0\"></a></p><p style=\"float:left; width: 300px; height: 16px; background-color:#EFECEC;\">ID für $art-$name: <b>$id</b></p><p style=\"clear:left;\"></p>\n";
	}

	echo "<p>&nbsp;</p><p><a href=\"dozenten-fb.php?rWert=$rWert&fbid=neu\">".ilink()." NEU</a></p>
		<p><a href=\"dozenten-fb.php\">".backlink()." zurück</a></p>\n";
}

elseif ($rWert && $fbid) {
	$query  = "SELECT * FROM ec_rechnungnr WHERE rWert=$rWert"; # nur, um den namen auszulesen.
	$result = safe_query($query);
	$row = mysqli_fetch_object($result);
	echo "<p>Untergruppe zu Fachbereich <b>".$row->art."</b> hinzufügen oder ändern</p>\n"; 

	if ($fbid != "neu") $update = 1;
	
	if ($update) {
		$query  = "SELECT * FROM ec_fachbereiche where fbid=$fbid";
		$result = safe_query($query);
		$row 	= mysqli_fetch_object($result);
		$fb 	= $row->fb;
	}

	echo '<form action="dozenten-fb.php" method="post" name="fachbereich">
		<input type="hidden" name="rWert" value="'.$rWert.'">
		<input type="hidden" name="fbid" value="'.$fbid.'">
		<p><input type="Text" name="fb" value="'.$fb.'" style="width:300px;"></p>
		<p><input type="submit" name="speichern" value="speichern"></p></form>
	';

	echo "<p>&nbsp;</p><p><a href=\"dozenten-fb.php?rWert=$rWert\">".backlink()." zurück</a></p>\n";
}



	
?>

</div>
</font>
<?
include("footer.php");
?>