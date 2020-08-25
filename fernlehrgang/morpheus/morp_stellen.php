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

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

function pulldown ($tp, $tab, $wname, $wid, $gruppe=0, $spalte=0) {
	if ($gruppe) 	$query = "SELECT * FROM $tab WHERE $spalte=$gruppe ORDER BY $wname";
	else 			$query = "SELECT * FROM $tab ORDER BY $wname";

	// echo $query;

	$result = safe_query($query);

	while ($row = mysqli_fetch_object($result)) {
		if ($row->$wid == $tp) $sel = "selected";
		else $sel = "";

		$nm = $row->$wname;
		$pd .= "<option value=\"" .$row->$wid ."\" $sel>$nm</option>\n";
	}
	return $pd;
}

// print_r($_REQUEST);

global $arr_form;

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
$um_wen_gehts 	= "Stellenangebot";
$titel			= "Stellenangebot";
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
//	array("st_aktiv", "sichtbar", '<input type="Text" value="#v#" name="#n#" style="#s#">', 'datum'),
	array("st_datum", "Datum // Reihenfolge", '<input type="Text" value="#v#" name="#n#" style="#s#">', 'datum'),
	array("st_art", "Art Stelle", 'selart'),
	array("st_name", "Name Stelle", '<input type="Text" value="#v#" name="#n#" style="#s#">'),
	array("st_hoch", "m/w", '<input type="Text" value="#v#" name="#n#" style="#s#">'),
	array("st_kurz", "Kleine Headline", '<input type="Text" value="#v#" name="#n#" style="#s#">'),
	array("st_aufgabe", "Aufgabe Liste", '<textarea cols="80" rows="15" name="#n#" style="height:200px;">#v#</textarea>'),
	array("st_profil", "Profil Liste", '<textarea cols="80" rows="15" name="#n#" style="height:200px;">#v#</textarea>'),

);
///////////////////////////////////////////////////////////////////////////////////////


#	array("mberechtigung", "Berechtigung (ID: 1 = Zugang)", '<input type="Text" value="#v#" name="#n#" style="#s#">'),
# 	array("ausbildungen", "<strong>Ausbildung EN</strong>", '<textarea cols="80" rows="5" name="#n#">#v#</textarea>'),
# 	array("imgid", "Berechtigung (ID: 1 = Zugang)", 'sel', 'image', 'imgname'),

/////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////

function liste() {
	//// EDIT_SKRIPT
	$db = "morp_stellen";
	$id = "sid";
	$ord = "st_datum, st_art";
	$anz = "st_name";
	$last = ''; 
	$art_array = array(1=>"Stelle", 2=>"Ausbildung");
	// $anz2 = "reihenfolge1";
	////////////////////

	$echo .= '<p>&nbsp;</p><table width="100%" cellspacing="0" cellpadding="0" class="autocol">';

	$sql = "SELECT * FROM $db WHERE 1 ORDER BY ".$ord."";
	$res = safe_query($sql);
	
	while ($row = mysqli_fetch_object($res)) {
		$edit = $row->$id;
		$art = $row->st_art;
		if($art != $last) {
			$echo .= '<tr>
			<td width="600"><p><strong>'.$art_array[$art].'</strong></p></td>
		</tr>';
			$art = $last;
		}
		$echo .= '<tr>
			<td width="600"><p><a href="?edit='.$edit.'">'.euro_dat($row->st_datum).' // '.$row->$anz.'</strong></a></p></td>
			<td valign="top"><a href="?v='.$edit.'&vi='.($row->st_aktiv ? 0 : 1).'"><i class="fa fa-'.($row->st_aktiv ? 'eye' : 'eye-slash').'"></i></a>
			<td valign="top"><a href="?edit='.$edit.'"><i class="fa fa-pencil-square-o"></a></td>
			<td valign="top"><a href="?del='.$edit.'"><i class="fa fa-trash-o"></a></td>
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
	$db = "morp_stellen";
	$id = "sid";
	/////////////////////

	$sql = "SELECT * FROM $db WHERE $id=".$edit."";
	$res = safe_query($sql);
	$row = mysqli_fetch_object($res);

	if ($row->st_aktiv == "1") $sichtbar = "checked";
	else unset($sichtbar);

	$echo .= '<input type="Hidden" name="neu" value="'.$neu.'">
		<input type="Hidden" name="edit" value="'.$edit.'">
		<input type="Hidden" name="save" value="1">
		sichtbar // aktiv: <input type="checkbox" name="sichtbar" value="1" '.$sichtbar.'>

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
		elseif ($arr[2] == "selart") {
			$echo .= '<tr><td>'.$arr[1].'</td><td><select name="st_art"><option>bitte wählen</option>';
			$echo .= '<option value="1" '. ($row->st_art == 1 ? ' selected' : '') .'>offene Stelle</option>';
			$echo .= '<option value="2" '. ($row->st_art == 2 ? ' selected' : '') .'>Ausbildung</option>';
			$echo .= '</select></td></tr>';
		}
		elseif ($arr[2] == "sel") {
			$echo .= '<tr><td>'.$arr[1].'</td><td><select name="'.$arr[0].'">'.pulldown ($row->$arr[0], $arr[3], $arr[4], $arr[0]).'</select></td></tr>';
		}
		elseif ($arr[2] == "text") {
			$echo .= '<tr><td>'.$arr[1].'</td><td>'.str_replace("#e#", $edit, $arr[3]).'</td></tr>';
		}
		else {
			if ($arr[3] == "datum") $val = euro_dat($row->$arr[0]);
			else $val = $row->$arr[0];

			$echo .= '<tr>
		<td>'.$arr[1].':</td>
		<td>'. str_replace(
					array("#v#", "#n#", "#s#", "#db#", '#e#', '#id#', '#s1#', '#s0#'),
					array($val, $arr[0], 'width:400px;', $db2, $edit, $id2, $sel1, $sel2),
			$arr[2]).'</td>
	</tr>';
		}
	}

	$echo .= '<tr><td><td><input type=hidden name="image" value="' .$image .'" style="width:500px"></td></tr>';

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
		if ($x <= 2) $echo .= '<tr>
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
	$db = "morp_stellen";
	$id = "sid";
	/////////////////////
	// print_r($_POST);

	$sichtbar	= $_POST["sichtbar"];
	if ($sichtbar) $sichtbar = 1;
	else $sichtbar = 0;

	foreach($arr_form as $arr) {
		$tmp1 = $arr[3];
		$tmp = $arr[0];
		$val = $_POST[$tmp];

		if ($tmp1 == "datum") $sql .= $tmp. "='" .us_dat($val). "', ";
		else $sql .= $tmp. "='" .$val. "', ";
	}

	$sql .= "st_aktiv='$sichtbar'";

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
	unset($edit);
}
elseif ($del) {
	die('<p>M&ouml;chten Sie den '.$um_wen_gehts.' wirklich l&ouml;schen?</p>
	<p><a href="?delete='.$del.'">Ja</a> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <a href="?">Nein</a></p>
	');
}
elseif ($delete) {
	$sql = "DELETE FROM morp_stellen WHERE sid=$delete";
	$res = safe_query($sql);
}

/////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////

$vi = $_GET["vi"];
$v = $_GET["v"];
if ($v) {
	$query 	 = "UPDATE morp_stellen SET st_aktiv=$vi WHERE sid='$v'";
	safe_query($query);
}


if ($neu) 		echo neu("neu");
elseif ($edit) 	echo edit($edit);
else			echo liste($id).$new;

echo '
</form>
';

include("footer.php");

?>
