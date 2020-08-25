<?php
# # # # # # # # # # # # # # # # # # # # # # # # # # #
# www.pixel-dusche.de                               #
# björn t. knetter                                  #
# start 12/2003                                     #
# edit 27.11.2006                                   #
# post@pixel-dusche.de                              #
# frankfurt am main, germany                        #
# # # # # # # # # # # # # # # # # # # # # # # # # # #

session_start();
#$box = 1;
include("cms_include.inc");

// print_r($_REQUEST);

/*
for($i=1;$i<=7;$i++) {
	for($n=9;$n<=22;$n++) {
		$start = $n < 10 ? '0'.$n.':00' : $n.':00';
		$end = ($n+1).':00';

		$sql = "INSERT morp_kursplan set kid='18', tag='$i', von='$start', bis='$end', gesamt='60'";
		safe_query($sql);
	}
}
*/


global $arr_form;

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

function pulldown ($tp, $tab, $wname, $wid, $gruppe=0, $spalte=0) {
	if ($gruppe) 	$query = "SELECT * FROM $tab WHERE $spalte=$gruppe ORDER BY $wname";
	else 			$query = "SELECT * FROM $tab ORDER BY $wname";

	//echo $query;

	$result = safe_query($query);
	$pd = "<option value=\"0\"> </option>\n";

	while ($row = mysqli_fetch_object($result)) {
		if ($row->$wid == $tp) $sel = "selected";
		else $sel = "";

		$nm = $row->$wname;
		$pd .= "<option value=\"" .$row->$wid ."\" $sel>$nm</option>\n";
	}
	return $pd;
}

function pfad ($feld, $tab, $wname, $id) {
	$sql = "SELECT * FROM $tab WHERE $feld=$id";
	$res = safe_query($sql);
	$row = mysqli_fetch_object($res);
	$nm  = $row->$wname;

	return $nm;
}

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

// NICHT VERAENDERN ///////////////////////////////////////////////////////////////////
$edit 	= $_REQUEST["edit"];
$delimg = $_REQUEST["delimg"];
$neu	= $_REQUEST["neu"];
$save	= $_REQUEST["save"];
$del	= $_REQUEST["del"];
$delete	= $_REQUEST["delete"];
$id		= $_REQUEST["id"];
///////////////////////////////////////////////////////////////////////////////////////


//// EDIT_SKRIPT
$um_wen_gehts 	= "Mitarbeiter / Team";
$titel			= "Verwaltung";
///////////////////////////////////////////////////////////////////////////////////////


echo '<div id=vorschau>
	<h2>'.$titel.'</h2>

	'. ($edit || $neu ? '<p><a href="?pid='.$pid.'">&laquo; zur&uuml;ck</a></p>' : '') .'
	<form action="" onsubmit="" name="verwaltung" method="post">
';


$new = '<p><a href="?neu=1">&raquo; NEU</a></p>';

//// EDIT_SKRIPT
// 0 => Feldbezeichnung, 1 => Bezeichnung für Kunden, 2 => Art des Formularfeldes
$arr_form = array(
	array("kid", "Kurs", 'sel', 'morp_kurse', 'name'),
	array("tag", "Tag", '<input type="Text" value="#v#" name="#n#" style="#s#">'),
	array("von", "Von", '<input type="Text" value="#v#" name="#n#" style="#s#">'),
	array("bis", "Bis", '<input type="Text" value="#v#" name="#n#" style="#s#">'),
	array("gesamt", "Minuten", '<input type="Text" value="#v#" name="#n#" style="#s#">'),

	array("raum", "Raum falls nicht I", '<input type="Text" value="#v#" name="#n#" style="#s#">'),
	array("anzeige1", "Abweichend Von", '<input type="Text" value="#v#" name="#n#" style="#s#">'),
	array("anzeige2", "Abweichen Bis", '<input type="Text" value="#v#" name="#n#" style="#s#">'),

#	array("aid", "Abteilung", 'sel', 'morp_kursplan_abt', 'bezeichnung'),
#	array("reihenfolge", "Reihenfolge", '<input type="Text" value="#v#" name="#n#" style="#s#">'),
#	array("img1", "Foto 1", 'foto', 'image', 'imgname', 6, 'gid'),
#	array("img2", "Foto 2", 'sel', 'image', 'imgname', 6, 'gid'),
#	array("img3", "Foto 3", 'sel', 'image', 'imgname', 6, 'gid'),
);
///////////////////////////////////////////////////////////////////////////////////////


#	array("mberechtigung", "Berechtigung (ID: 1 = Zugang)", '<input type="Text" value="#v#" name="#n#" style="#s#">'),
# 	array("ausbildungen", "<strong>Ausbildung EN</strong>", '<textarea cols="80" rows="5" name="#n#">#v#</textarea>'),
# 	array("imgid", "Berechtigung (ID: 1 = Zugang)", 'sel', 'image', 'imgname'),

/////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////

function liste() {
	//// EDIT_SKRIPT
	$db = "morp_kursplan m";
	$id = "pid";
	$ord = "tag, von";
	$anz = "tag";
	$anz2 = "kurs";
	$anz6 = "name";
	$anz3 = "von";
	$anz4 = "bis";
	$anz5 = "gesamt";

	////////////////////

	$echo .= '<p>&nbsp;</p><table width="100%" cellspacing="0" cellpadding="0" >';

	$old = '';

	$sql = "SELECT * FROM $db LEFT JOIN morp_kurse k ON m.kid=k.kid WHERE 1 ORDER BY ".$ord."";
	$res = safe_query($sql);

	while ($row = mysqli_fetch_object($res)) {
		$edit = $row->$id;
		$echo .= '<tr>
			<td width="450"><p><a href="?edit='.$edit.'">'.tag($row->$anz).' // '.$row->$anz3	.' - '.$row->$anz4	.' // '.$row->$anz6	.'</a></p></td>
			<td valign="top" width="50"><a href="?edit='.$edit.'"><i class="fa fa-pencil-square-o"></a></td>
			<td valign="top" width="50"><a href="?del='.$edit.'"><i class="fa fa-trash-o"></a></td>
			<td></td>
		</tr>';
	}

	$echo .= '</table><p>&nbsp;</p>';

	return $echo;
}

/////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////

function edit($edit) {
	global $arr_form;

	//// EDIT_SKRIPT
	$db = "morp_kursplan";
	$id = "pid";
	/////////////////////

	$sql = "SELECT * FROM $db WHERE $id=".$edit."";
	$res = safe_query($sql);
	$row = mysqli_fetch_object($res);

	$echo .= '<input type="Hidden" name="neu" value="'.$neu.'">
		<input type="Hidden" name="edit" value="'.$edit.'">
		<input type="Hidden" name="save" value="1">

	<table cellspacing="6">';

	$echo .= '<tr>
		<td></td>
	</tr>
';

	foreach($arr_form as $arr) {
		if ($arr[2] == "sellan") {
			$echo .= '<tr><td>'.$arr[1].'</td><td><select name="lan">';
			$echo .= '<option value="1" '. ($row->lan == 1 ? ' selected' : '') .'>Deutsch</option>';
			$echo .= '<option value="2" '. ($row->lan == 2 ? ' selected' : '') .'>English</option>';
			$echo .= '<option value="3" '. ($row->lan == 3 ? ' selected' : '') .'>Francais</option>';
			$echo .= '</select></td></tr>';
		}
		elseif ($arr[2] == "sel") {
			$echo .= '<tr><td>'.$arr[1].'</td><td><select name="'.$arr[0].'">'.pulldown ($row->$arr[0], $arr[3], $arr[4], $arr[0], $arr[5], $arr[6]).'</select></td></tr>';
			if ($arr[0] == "imgid") $image = pfad ($arr[0], $arr[3], $arr[4], $row->$arr[0]);
		}
		elseif ($arr[2] == "foto") {
			// $echo .= '<tr><td>'.$arr[1].'</td><td><select name="'.$arr[0].'">'.pulldown ($row->$arr[0], $arr[3], $arr[4], $arr[0], $arr[5], $arr[6]).'</select></td></tr>';
			// if ($arr[0] == "imgid") $image = pfad ($arr[0], $arr[3], $arr[4], $row->$arr[0]);

			$echo .= '<tr><td width="160">'.$arr[1].'</td><td><input type=hidden name='.$arr[0].' value="' .$row->$arr[0].'" style="width:500px"><a href="image_folder_upload.php?mid='.$edit.'&tn='.$morpheus["img_size_news_tn"].'&imgid='.$arr[0].'&team=1">';

			if ($row->$arr[0]) $echo .=  '<img src="../images/team/'.$row->$arr[0].'"></a> &nbsp; &nbsp; <a href="?delimg='.$arr[0].'&edit='.$edit.'"><img src="images/delete.gif" width="9" height="10" alt="Bild löschen" border="0" hspace="6"></a>';
			else $echo .=  '<b>Foto</b>: bitte wählen</a>';

			$echo .= '</td></tr>';

		}
		elseif ($arr[2] == "text") {
			$echo .= '<tr><td>'.$arr[1].'</td><td>'.str_replace("#e#", $edit, $arr[3]).'</td></tr>';
		}
		else $echo .= '<tr>
		<td>'.$arr[1].':</td>
		<td>'. str_replace(
					array("#v#", "#n#", "#s#", "#db#", '#e#', '#id#', '#s1#', '#s0#'),
					array($row->$arr[0], $arr[0], 'width:400px;', $db2, $edit, $id2, $sel1, $sel2),
			$arr[2]).'</td>
	</tr>';
	}

	if ($image) $echo .= '<tr><td></td><td><img src="../images/userfiles/image/' .$image .'" /></td></tr>';

	$echo .= '
	<tr>
		<td></td>
		<td><input type="submit" name="speichern" value="speichern"></td>
	</tr>
</table>';

	return $echo;
}

/////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////

function neu() {
	global $arr_form;

	$x = 0;

	$echo .= '<input type="Hidden" name="neu" value="1"><input type="Hidden" name="save" value="1">

	<table cellspacing="6">';

	foreach($arr_form as $arr) {
		if ($x <= 5) $echo .= '<tr>
			<td>'.$arr[1].':</td>
			<td>'. str_replace(array("#v#", "#n#", "#s#"), array($row->$arr[0], $arr[0], 'width:400px;'), $arr[2]).'</td>
		</tr>';
		$x++;
	}

	$echo .= '<tr>
		<td></td>
		<td><input type="submit" name="speichern" value="speichern"></td>
	</tr>
</table>';

	return $echo;
}

/////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////

if ($save) {
	global $arr_form;

	//// EDIT_SKRIPT
	$db = "morp_kursplan";
	$id = "pid";
	/////////////////////

	foreach($arr_form as $arr) {
		$tmp = $arr[0];
		$val = $_POST[$tmp];

		if ($tmp != "region") $sql .= $tmp. "='" .$val. "', ";
	}

	$sql = substr($sql, 0, -2);

	if ($neu) {
		$sql  = "INSERT $db set $sql";
		$res  = safe_query($sql);
		$edit = mysqli_insert_id($mylink);
		unset($neu);
	}
	else {
		$sql = "update $db set $sql WHERE $id=$edit";
		$res = safe_query($sql);
	}
	// echo $sql;
	 $edit = 0;
}
elseif ($del) {
	die('<p>M&ouml;chten Sie den '.$um_wen_gehts.' wirklich l&ouml;schen?</p>
	<p><a href="?delete='.$del.'">Ja</a> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <a href="?">Nein</a></p>
	');
}
elseif ($delete) {
	$sql = "DELETE FROM morp_kursplan WHERE pid=$delete";
	$res = safe_query($sql);
}

/////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////

if ($neu) 		echo neu("neu");
elseif ($edit) 	echo edit($edit);
else			echo liste($id).$new;

echo '
</form>
';

include("footer.php");

?>
