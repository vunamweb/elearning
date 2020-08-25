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
	
$db   = "personal";
$edit = $_REQUEST["edit"];
$save = $_REQUEST["save"];
$neu  = $_REQUEST["neu"];
$del  = $_REQUEST["del"];
$del_ = $_REQUEST["del_"];

$inp_arr = array("pid", "anrede", "titel", "nname", "vname", "email", "tel", "fax", "sekretariat", "abteilung", "position");
$de_arr = array("ID", "Anrede", "Titel", "Nachname", "Vorname", "E-Mail", "Tel", "Fax", "Name Sekretariat", "Abteilung", "Position");

echo "<div id=content_big>";

if ($del) {
	$nm  = $_REQUEST["nm"];
	echo '<p>&nbsp;</p>
		<p>Sind Sie sich sicher, dass sie den Mitarbeiter <b>'.$nm.'</b> löschen wollen?</p>
		<p>&nbsp; &nbsp; &nbsp; &nbsp; <a href="personal.php?del_=' .$del .'">Ja</a> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <a href="personal.php">Nein</a></p></body></html>';
	die();
}
elseif ($del_) {
	$query = "delete from $db where pid=$del_";
	$result = safe_query($query);
	protokoll($uid, $db, $del_, "del");
}
elseif ($save) {
	$x = 0;
	$ct = count($inp_arr);
	foreach ($inp_arr as $val) {
		$tmp = $_POST[$val];
		$set .= $val ."='$tmp'";
		$x++;
		if ($x < $ct) $set .= ", ";
	}
	
	if ($neu) {
		$query = "insert $db set $set";
		unset($neu);
	}
	
	elseif ($edit) {
		$query = "update $db set $set where pid=$edit";
		unset($edit);
		#protokoll($uid, $db, $edit, "edit");
	}
	$result = safe_query($query);
}

if ($neu  || $edit) {
	echo "<a href='personal.php'>" .backlink() ." zurück</a><p>
		<p><b>Mitarbeiter anlegen/bearbeiten</b></p>";
	
	if (!$neu) {
		$query = "SELECT * FROM personal where pid=$edit";
		$result = safe_query($query);
		$row = mysqli_fetch_object($result);
	}
	
	echo '<form method="post"><input type="hidden" name=edit value=' .$edit .'>
		<input type="hidden" name=save value=1>
		<input type="hidden" name=neu value='.$neu.'>
		<input type="hidden" name=edit value='.$edit.'>
		<p>&nbsp;</p>
		';
		
	$x = 0;
	
	foreach ($inp_arr as $val) {
		$tmp = $row->$val;
		echo '<p style="float:left; width: 150px;">'.$de_arr[$x].'</p><p style="float:left; width: 350px;"><input type="text" name='.$val.' value="'.$tmp.'"></p>
		';
		$x++;
	}

	echo '<p style="clear:left;">&nbsp;</p><p><input type="submit" class="button" name="save" value="speichern"></p>';

}
else {
	$query 	= "SELECT * FROM $db order by nname";
	$result = safe_query($query);

	$bgcolor = "#EFECEC";  // tabellen-hintergrundfarbe soll wechseln. erster farbwert wird gesetzt

	echo "\n<p class=text><b>Mitarbeiter verwalten</b></p>
		<table border=0 cellspacing=2 cellpadding=4>
			<tr>
				<td width=50><p><b>ID</b></p></td>
				<td width=300><p><b>Name</b></p></td>
				<td></td>
			</tr>
	";
	
	###########################################################
	// formular wird jetzt zusammengestellt
	while ($row = mysqli_fetch_object($result))	{	
		echo "<tr bgcolor=$bgcolor height=18>
			<td width=50><b>" .$row->pid ."</b></td>
			<td>";
		
		echo "<a href='personal.php?edit=" .$row->pid ."&db=personal'>" .$row->titel ." " .$row->vname ." <b>" .$row->nname ."</b><img src=\"images/stift.gif\" border=0 hspace=8></a>";
		
		echo "<td width=40 align=center><a href='personal.php?del=" .$row->pid ."&nm=" .$row->nname ."'><img src=\"images/delete.gif\" alt=\"löschen\" border=0></a>";

		echo "</td>
		</tr>
		";
		
		if ($bgcolor == '#EFECEC') $bgcolor = "#FFFFFF";
		else $bgcolor = '#EFECEC';
	}
	// formular ist fertig
	###########################################################
	
	echo "</table><br>";
	
	echo "<a href='personal.php?neu=1'>" .ilink() ." neu</a>";
}
?>

</div>

<?
include("footer.php");
?>