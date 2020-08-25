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

include("../nogo/config.php");

include("cms_header.php");
include("../nogo/db.php");
dbconnect();
include("login.php");
include("function.php");
include("cms_navigation.php");
	
$db   = "mitarbeiter";
$edit = $_REQUEST["edit"];
$save = $_REQUEST["save"];
$neu  = $_REQUEST["neu"];
$del  = $_REQUEST["del"];
$del_ = $_REQUEST["del_"];

# positionsaenderung
$sortid  = $_REQUEST["sortid"];
$sort 	 = $_REQUEST["sort"];

$arr  = array("Titel"=>"titel", "Vorname"=>"vname", "Name"=>"name", "Bezeichnung"=>"bez", "Fon"=>"fon", "Fax"=>"fax", "Direkt"=>"direkt", "E-Mail"=>"email", "Foto"=>"foto");

echo "<div id=content_big>";

if ($_REQUEST["repair"]) {
	$arr 	= array();
	$query  = "SELECT * FROM mitarbeiter order by sort";
	$result = safe_query($query);
	while ($row = mysqli_fetch_object($result)) {
		$arr[] = $row->mid;
	}
	$xx = 0;
	foreach ($arr as $val) {
		$xx++;
		$query  = "update mitarbeiter set sort = $xx where mid=$val";
		$result = safe_query($query);
	}
}

# wenn sortierung geaendert wurde, jetzt in db schreiben
if ($sort) {
	if ($sort == "up") $s2 = $sortid - 1;
	else $s2 = $sortid + 1;
	
	$sort_    = array($sortid, $s2);
	$sort_new = array($s2, $sortid);
	$sort_arr = array();

	for($i=0; $i<=1; $i++) {
		$query  = "SELECT * FROM $db where sort=$sort_[$i]";
		$result = safe_query($query);
		$row = mysqli_fetch_object($result);
		$sort_arr[] = $row->mid;
	}

	for($i=0; $i<=1; $i++) {
		$query  = "update $db set sort=$sort_new[$i] where mid=$sort_arr[$i]";
		safe_query($query);
	}	
}

elseif ($_REQUEST["repair"]) {
	$arr 	= array();
	
	$query  = "SELECT * FROM $db order by sort";
	$result = safe_query($query);
	while ($row = mysqli_fetch_object($result)) {
		$arr[] = $row->mid;
	}
	$xx = 0;
	foreach ($arr as $val) {
		$xx++;
		$query  = "update $db set sort = $xx where mid=$val";
		$result = safe_query($query);
	}
}

elseif ($del && $admin) {
	$nm  = $_REQUEST["nm"];
	echo '<p>&nbsp;</p>
		<p>Sind Sie sich sicher, dass sie den Mitarbeiter <b>'.$nm.'</b> löschen wollen?</p>
		<p>&nbsp; &nbsp; &nbsp; &nbsp; <a href="?del_=' .$del .'">Ja</a> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <a href="?">Nein</a></p></body></html>';
	die();
}

elseif ($del_) {
	$query = "delete from $db where mid=$del_";
	$result = safe_query($query);
	protokoll($uid, $db, $del_, "del");
}

elseif ($save) {
	$x = count($arr);
	$c = 0;
	foreach ($arr as $key=>$val) {
		$c++;
		$set .= $val."='".$_POST[$val]."'";
		if ($c < $x) $set .= ', ';
	}

	if ($neu) {
		$query = "insert $db set $set";
		unset($neu);
	}
	elseif ($edit) {
		$query = "update $db set $set where mid=$edit";
		unset($edit);
		protokoll($uid, $db, $edit, "edit");
	}
	$result = safe_query($query);
	# echo $query;
}

if (($neu  || $edit) && $admin) {
	echo "<a href='?'>" .backlink() ." zurück</a><p><p><b>Mitarbeiter anlegen/bearbeiten</b></p>";
	
	if (!$neu) {
		$query = "SELECT * FROM $db where mid=$edit";
		$result = safe_query($query);
		$row = mysqli_fetch_object($result);
	}
	
	echo '<form method="post"><input type="hidden" name=edit value=' .$edit .'>
		<input type="hidden" name=save value=1>
		<input type="hidden" name=neu value='.$neu.'>
		<input type="hidden" name=edit value='.$edit.'>
		<p>&nbsp;</p>
	';

	foreach ($arr as $key=>$val) {
		echo '<p><span style="float:left; width: 100px; display: block;">'.$key.'</span><span><input type="text" name="'.$val.'" value="'.$row->$val.'" style="width: 300px;"></span></p>
		';
	}
	
	echo '<p><input type="submit" class="button" name="save" value="speichern"></p>
';
}

else {
	$query 	= "SELECT * FROM $db order by sort";
	$result = safe_query($query);

	$bgcolor = "#EFECEC";  // tabellen-hintergrundfarbe soll wechseln. erster farbwert wird gesetzt

	echo "\n<p class=text><b>Mitarbeiter verwalten</b></p>
	<p><a href=\"?repair=1\">&raquo; sortierung reparieren</a></p>
		<table border=0 cellspacing=2 cellpadding=4>
			<tr>
				<td width=200><p><b>Name</b></p></td>
				<td></td>
			</tr>
	";
	
	###########################################################
	// formular wird jetzt zusammengestellt

	$x = 0;
	$y = mysqli_num_rows($result);

	while ($row = mysqli_fetch_object($result))	{	
		$so = $row->sort;
		$x++;
		
		echo "<tr bgcolor=$bgcolor height=18>
			<td> $so &nbsp; <font color=#000000>";
		
		echo "<a href='?edit=" .$row->mid ."&db=$db'>" .$row->vname ." " .$row->name ."<img src=\"images/stift.gif\" border=0 hspace=8></a></td>";
		echo "<td>";
		
		if ($x > 1) echo "<td width=20>&nbsp; <a href=\"?sort=up&sortid=$so\" title=\"eine Position nach oben\">" .up() ."</a></td>\n";
		else echo "<td width=20></td>\n";
		
		if ($x < $y) echo "<td width=20><a href=\"?sort=down&sortid=$so\" title=\"eine Position nach unten\">" .down() ."</a></td>\n";
		else echo "<td width=20></td>\n";

		
		echo "<td width=\"100\"> &nbsp; &nbsp; </td>
	<td><a href='?del=" .$row->mid ."&nm=" .$row->name ."'><img src=\"images/delete.gif\" alt=\"löschen\" border=0></a></td>
</tr>
";
		
		if ($bgcolor == '#EFECEC') $bgcolor = "#FFFFFF";
		else $bgcolor = '#EFECEC';
	}
	// formular ist fertig
	###########################################################
	
	echo "</table><br>";
	
	echo "<a href='?neu=1'>" .ilink() ." neu</a>";
}
?>

</div>

</body>
</html>
