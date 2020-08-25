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
error_reporting(E_ALL);
// print_r($_REQUEST);

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
$edit 	= isset($_REQUEST["edit"]) ? $_REQUEST["edit"] : '';
$delimg = isset($_REQUEST["delimg"]) ? $_REQUEST["delimg"] : '';
$neu	= isset($_REQUEST["neu"]) ? $_REQUEST["neu"] : '';
$save	= isset($_REQUEST["save"]) ? $_REQUEST["save"] : '';
$del	= isset($_REQUEST["del"]) ? $_REQUEST["del"] : '';
$delete	= isset($_REQUEST["delete"]) ? $_REQUEST["delete"] : '';
$id		= isset($_REQUEST["id"]) ? $_REQUEST["id"] : '';
$repair	= isset($_REQUEST["repair"]) ? $_REQUEST["repair"] : '';
///////////////////////////////////////////////////////////////////////////////////////

global $imgfolder, $scriptname, $table;

//// EDIT_SKRIPT
$um_wen_gehts 	= "Stimmen";
$titel			= "Verwaltung";
$imgfolder		= "stimmen";
$scriptname 	= pathinfo(__FILE__);
$scriptname 	= $scriptname['filename'];
$table			= 'morp_stimmen';
$setid			= 'stid';
///////////////////////////////////////////////////////////////////////////////////////

if ($repair) {
	$arr 	= array();
	$query  = "SELECT * FROM $table ORDER BY reihenfolge";
	$result = safe_query($query);
	while ($row = mysqli_fetch_object($result)) {
		$arr[] = $row->$setid;
	}
	$xx = 0;
	foreach ($arr as $val) {
		$xx++;
		$query  = "UPDATE $table set reihenfolge=$xx WHERE $setid=$val";
		$result = safe_query($query);
	}
}
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////


echo '<div id=vorschau>
	<h2>'.$titel.'</h2>

	'. ($edit || $neu ? '<p><a href="?">&laquo; zur&uuml;ck</a></p>' : '	<p><a href="?repair=1">&raquo; sortierung reparieren</a></p>') .'

	<form action="" onsubmit="" name="verwaltung" method="post">
';


$new = '<p><a href="?neu=1">&raquo; NEU</a></p>';

//// EDIT_SKRIPT
// 0 => Feldbezeichnung, 1 => Bezeichnung für Kunden, 2 => Art des Formularfeldes
$arr_form = array(
	array("reihenfolge", "Reihenfolge",'<input type="Text" value="#v#" name="#n#" style="#s#; width:30px;">'),
	array("name", "Name",'<input type="Text" value="#v#" name="#n#" style="#s#">'),
	array("beruf", "Beruf",'<input type="Text" value="#v#" name="#n#" style="#s#">'),
	array("text", "Text",'<textarea cols="" rows="15" name="#n#" style="#s#; height:200px;">#v#</textarea>'),
	array("textkurz", "Text kurz",'<textarea cols="" rows="5" name="#n#" style="#s# ; height:200px;">#v#</textarea>'),

	array("img1", "Foto 1", 'foto', 'image', 'imgname', 6, 'gid'),
#	array("img2", "Foto 2", 'sel', 'image', 'imgname', 6, 'gid'),
#	array("img3", "Foto 3", 'sel', 'image', 'imgname', 6, 'gid'),
);
///////////////////////////////////////////////////////////////////////////////////////


#	array("mberechtigung", "Berechtigung (ID: 1 = Zugang)", '<input type="Text" value="#v#" name="#n#" style="#s#">'),
# 	array("ausbildungen", "<strong>Ausbildung EN</strong>", '<textarea cols="80" rows="5" name="#n#">#v#</textarea>'),
# 	array("imgid", "Berechtigung (ID: 1 = Zugang)", 'sel', 'image', 'imgname'),

/////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////

function liste($table, $setid) {
	//// EDIT_SKRIPT
	$ord = "reihenfolge, name";
	$anz = "name";
	$anz2 = "beruf";
#	$anz3 = "mail";
	$anz4 = "reihenfolge";
	////////////////////

	$echo = '<p>&nbsp;</p><table width="100%" cellspacing="0" cellpadding="0" >';

	$sql = "SELECT * FROM $table WHERE 1 ORDER BY ".$ord."";
	$res = safe_query($sql);

	while ($row = mysqli_fetch_object($res)) {
		$edit = $row->$setid;
		$echo .= '
		<tr>
			<td width="250"><p><a href="?edit='.$edit.'">'.$row->$anz4	.' | '.$row->$anz	.'</a></p></td>
			<td><p><a href="?edit='.$edit.'">'.$row->$anz2.'</a></p></td>
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

function edit($edit, $table, $setid) {
	global $arr_form;
	global $imgfolder, $scriptname;

	//// EDIT_SKRIPT
	$db = $table;
	$id = $setid;
	$db2 = '';
	$sel2 = '';
	$id2 = '';
	$sel1 = '';
	$image = '';
	/////////////////////

	$sql = "SELECT * FROM $db WHERE $id=".$edit."";
	$res = safe_query($sql);
	$row = mysqli_fetch_object($res);


	$echo = '
		<input type="Hidden" name="edit" value="'.$edit.'">
		<input type="Hidden" name="save" value="1">

	<table width="100%">';

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

			$echo .= '<tr><td width="160">'.$arr[1].'</td><td><input type=hidden name='.$arr[0].' value="' .$row->$arr[0].'" style="width:500px"><a href="image_folder_upload2.php?id='.$edit.'&feld='.$arr[0].'&folder='.$imgfolder.'&from='.$scriptname.'&setid='.$id.'&tbl='.$db.'">';

			if ($row->$arr[0]) $echo .=  '<img src="../images/'.$imgfolder.'/'.$row->$arr[0].'"></a> &nbsp; &nbsp; <a href="?delimg='.$arr[0].'&edit='.$edit.'"><i class="fa fa-trash-o"></i> </a>';
			else $echo .=  '<b>Foto</b>: bitte w&auml;hlen</a>';

			$echo .= '</td></tr>';

		}
		elseif ($arr[2] == "text") {
			$echo .= '<tr><td>'.$arr[1].'</td><td>'.str_replace("#e#", $edit, $arr[3]).'</td></tr>';
		}
		else $echo .= '<tr>
		<td>'.$arr[1].':</td>
		<td>'. str_replace(
					array("#v#", "#n#", "#s#", "#db#", '#e#', '#id#', '#s1#', '#s0#'),
					array($row->$arr[0], $arr[0], 'width:100%;', $db2, $edit, $id2, $sel1, $sel2),
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
	global $arr_form, $table, $setid;

	//// EDIT_SKRIPT
	/////////////////////
	$sql = '';

	foreach($arr_form as $arr) {
		$tmp = $arr[0];
		$val = $_POST[$tmp];

		if ($tmp != "region") $sql .= $tmp. "='" .$val. "', ";
	}

	$sql = substr($sql, 0, -2);

	if ($neu) {
		$sql  = "INSERT $table set $sql";
		$res  = safe_query($sql);
		$edit = mysqli_insert_id($mylink);
		unset($neu);
	}
	else {
		$sql = "update $table set $sql WHERE $setid=$edit";
		$res = safe_query($sql);
	}
	// echo $sql;
	// $edit = 0;
}
elseif ($del) {
	die('<p>M&ouml;chten Sie den '.$um_wen_gehts.' wirklich l&ouml;schen?</p>
	<p><a href="?delete='.$del.'">Ja</a> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <a href="?">Nein</a></p>
	');
}
elseif ($delete) {
	global $table, $setid;
	$sql = "DELETE FROM $table WHERE $setid=$delete";
	$res = safe_query($sql);
}
elseif ($delimg) {
	global $table, $setid;
	$sql = "UPDATE $table SET $delimg='' WHERE $setid=$edit";
	$res = safe_query($sql);
}
/////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////

if ($neu) 		echo neu("neu", $table, $setid);
elseif ($edit) 	echo edit($edit, $table, $setid);
else			echo liste($table, $setid).$new;

echo '
</form>
';

include("footer.php");

?>
