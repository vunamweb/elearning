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


	$onl = isset($_GET["onl"]) ? $_GET["onl"] : 0;
	$pas = isset($_GET["pas"]) ? $_GET["pas"] : 0;
	$km = isset($_GET["km"]) ? $_GET["km"] : '';
	$az = isset($_GET["az"]) ? $_GET["az"] : '';
	$sear = isset($_GET["sear"]) ? $_GET["sear"] : '';

// print_r($_POST);

//// EDIT_SKRIPT
$um_wen_gehts 	= "Mitglied";
$titel			= "Verwaltung";
///////////////////////////////////////////////////////////////////////////////////////

$alph = array("a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k", "l", "m", "n", "o", "p", "q", "r", "s", "t", "u", "v", "w", "x", "y", "z");
$abisz = '';
foreach($alph as $val) {
	$abisz .= '<a href="?az='.$val.'" style="'.($val == $az ? 'background:#ED1C24;color:#fff' : '').'" class="but">'.$val.'</a>';
}
echo '<div id=vorschau>
	<h2>'.$titel.'</h2>

	'. ($edit || $neu ? '<p><a href="?pid='.$pid.'&onl='.$onl.'&pas='.$pas.'&sear='.$sear.'&km='.$km.'&az='.$az.'"><i class="fa fa-chevron-left small"></i> zur&uuml;ck</a></p>' : '') .
	($edit ? '<form action="" onsubmit="" name="verwaltung" method="post">' : '

	<p><i class="fa fa-filter"></i> &nbsp; <a href="?onl=1"'.($onl ? 'style="background:#ED1C24;color:#fff"' : '').' class="but">Kein Online-Zugang</a>
	<a href="?pas=1"'.($pas ? 'style="background:#ED1C24;color:#fff"' : '').' class="but">freigeschaltet</a>
	<a href="?km=APO"'.($km == "APO" ? 'style="background:#ED1C24;color:#fff"' : '').' class="but">APO</a>
	<a href="?km=LEI"'.($km == "LEI" ? 'style="background:#ED1C24;color:#fff"' : '').' class="but">LEI</a>
	<a href="?km=PHP"'.($km == "PHP" ? 'style="background:#ED1C24;color:#fff"' : '').' class="but">PHP</a>
	<a href="?" class="but">alle</a></p>
	<p class="zeile"><i class="fa fa-filter"></i> &nbsp; '.$abisz.'</p>
	<form id="verwaltung" method="get"><p><i class="fa fa-search suche"></i> &nbsp; <input type="text" name="sear" value="'.$sear.'" /> <a class="suche but"><i class="fa fa-play"></i></a> &nbsp; <a>(kid/name/mail)</a> </p>
<script>
	$( ".suche" ).click(function() {
		$( "#verwaltung" ).submit();
  	});
</script>
');


$new = '<p><a href="?neu=1">&raquo; NEU</a></p>';

//// EDIT_SKRIPT
// 0 => Feldbezeichnung, 1 => Bezeichnung für Kunden, 2 => Art des Formularfeldes
$arr_form = array(
	array("kid", "Kundennummer", '<input type="Text" value="#v#" name="#n#" style="#s#">'),
	array("nachname", "Name", '<input type="Text" value="#v#" name="#n#" style="#s#">'),
	array("vorname", "Vorname", '<input type="Text" value="#v#" name="#n#" style="#s#">'),
	array("gebdat", "Geb Datum", '<input type="Text" value="#v#" name="#n#" style="#s#">'),
	array("email", "E-Mail", '<input type="Text" value="#v#" name="#n#" style="#s#">'),

	array("str", "Strasse", '<input type="Text" value="#v#" name="#n#" style="#s#">'),
	array("plz", "PLZ", '<input type="Text" value="#v#" name="#n#" style="#s#">'),
	array("ort", "Ort", '<input type="Text" value="#v#" name="#n#" style="#s#">'),
	array("km1", "KM1", '<input type="Text" value="#v#" name="#n#" style="#s#">'),

	array("inlist", "freigeschaltet (0/1)", '<input type="Text" value="#v#" name="#n#" style="#s#">'),
	array("pass", "Passwort verschlüsselt", '<input type="Text" value="#v#" name="#n#" style="#s#">', 1),  /* 1 => nicht speichern */
	array("newpass", "Kunde muss neues Passwort setzen", '<input type="Text" value="#v#" name="#n#" style="#s#">'),
	array("kundenedit", "Daten von Mitglied geändert", '<input type="Text" value="#v#" name="#n#" style="#s#">'),
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

/* mitglied delegierter vorstand // gremien */

function liste($onl, $pas, $sear, $km, $az) {
	//// EDIT_SKRIPT
	$db = "morp_kunden";
	$id = "kid";

	$ord = "nachname, kid";
	$anz = "nachname";
	$anz2 = "kid";
	$anz3 = "email";
	$anz4 = "pass";
	$anz5 = "inlist";
	$anz6 = "km1";
	$anz7 = "vorname";
	////////////////////


	$where = 1;
	if($onl) $where = " inlist<1 ";
	elseif($pas) $where = " pass<>'' ";
	elseif($km) $where = " km1='$km' ";
	elseif($az) $where = " nachname LIKE '".$az."%' ";
	elseif($sear) $where = " nachname LIKE '%".$sear."%' OR email LIKE '%".$sear."%'  OR kid LIKE '%".$sear."%' ";


	$sql = "SELECT * FROM $db WHERE $where ORDER BY ".$ord."";
	$res = safe_query($sql);
	$x = 0;
	$n = mysqli_num_rows($res);
	$echo .= '<p>&nbsp;</p><p>Anzahl: '.$n.'</p><p>&nbsp;</p><table width="100%" cellspacing="0" cellpadding="0" class="autocol">
	<tr>
			<td width="50"></td>
			<td width="200"><p>kid | KM1</a></p></td>
			<td><p>Name</a></p></td>
			<td><p>Mail</a></p></td>
			<td width="100"><p>pw</p></td>
			<td valign="top" width="50"></td>
			<td valign="top" width="50"></td>
		</tr>';


	while ($row = mysqli_fetch_object($res)) {
		$x++;
		$edit = $row->$id.'&onl='.$onl.'&pas='.$pas.'&sear='.$sear.'&km='.$km.'&az='.$az;
		$echo .= '<tr>
			<td '.($row->$anz5 ? '' : ' style="background:#666"').'><p>'.$x.'</p></td>
			<td '.($row->$anz4 ? ' style="background:#fdb8bc"' : '').'><p><a href="?edit='.$edit.'">'.$row->$anz2	.' | '.$row->$anz6	.'</a></p></td>
			<td '.($row->$anz4 ? ' style="background:#fdb8bc"' : '').'><p><a href="?edit='.$edit.'">'.$row->$anz	.', '.$row->$anz7	.'</a></p></td>
			<td '.($row->$anz4 ? ' style="background:#fdb8bc"' : '').'><p><a href="?edit='.$edit.'">'.$row->$anz3.'</a></p></td>
			<td><p><a href="?edit='.$edit.'">'.substr($row->$anz4,0,8)	.'</a></p></td>
			<td><p><a href="?edit='.$edit.'"><i class="fa fa-pencil-square-o"></i></a></p></td>
			<td><p><a href="?del='.$edit.'"><i class="fa fa-trash-o"></i></a></p></td>
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
	$db = "morp_kunden";
	$id = "kid";
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
		<td>&nbsp;</td>
		<td></td>
	</tr>
	<tr>
		<td>PASSWORT vergeben</td>
		<td><input type="text" name="manuell" value=""></td>
	</tr>
	<tr>
		<td></td>
		<td><input type="submit" name="speichern" value="speichern"></td>
	</tr>
	<tr>
		<td colspan="2"><h2>Gruppen / Gremien Zuweisung</h2></td>
	</tr>
';

	$sql = "SELECT * FROM morp_gremien WHERE gid <> 3";
	$res = safe_query($sql);
	while($row = mysqli_fetch_object($res)) {
		$sql = "SELECT * FROM morp_gremien_zuord WHERE gid=".$row->gid." AND kid=".$edit;
		$rs = safe_query($sql);
		$n = mysqli_num_rows($rs);

		$echo .= '<tr>
		<td></td>
		<td><input type="checkbox" name="gremium[]" value="'.$row->gid.'"'.($n > 0 ? ' checked' : '').'> &nbsp; '.$row->gremium.'</td>
	</tr>';
	}

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
	$db = "morp_kunden";
	$id = "kid";
	/////////////////////

	foreach($arr_form as $arr) {
		$tmp = $arr[0];
		$chk = $arr[3]; /* speichern??? ja/nein  1 => nicht speichern */
		$val = $_POST[$tmp];

		if ($chk) {}
		else $sql .= $tmp. "='" .$val. "', ";
	}

	/**************/
	/**************/
	$np = isset($_POST["manuell"]) && $_POST["manuell"] ? md5($_POST["manuell"]) : '';
	if($np) $sql .= " pass='$np', ";
	/**************/
	/**************/
	$sq = "DELETE FROM morp_gremien_zuord WHERE kid=$edit";
	safe_query($sq);
	$gremium = $_POST["gremium"];
	if($gremium) {
		foreach($gremium as $val) {
			$sq  = "INSERT morp_gremien_zuord set gid=$val , kid=$edit";
			safe_query($sq);
		}
	}
	/**************/
	/**************/

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
	// $edit = 0;
}
elseif ($del) {
	die('<p>M&ouml;chten Sie das '.$um_wen_gehts.' wirklich l&ouml;schen?</p>
	<p><a href="?delete='.$del.'">Ja</a> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <a href="?">Nein</a></p>
	');
}
elseif ($delete) {
	$sql = "DELETE FROM morp_kunden WHERE kid=$delete";
	$res = safe_query($sql);
}

/////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////

if ($neu) 		echo neu("neu");
elseif ($edit) 	echo edit($edit);
else			echo liste($onl, $pas, $sear, $km, $az).$new;

echo '
</form>
';

include("footer.php");

?>
