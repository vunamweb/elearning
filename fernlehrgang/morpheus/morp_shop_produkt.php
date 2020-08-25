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
	$pd = "<option value=\"1\"> </option>\n";

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
$um_wen_gehts 	= "Produkte";
$titel			= "Produkt Verwaltung";
///////////////////////////////////////////////////////////////////////////////////////


echo '<div id="vorschau">
	<h2>'.$titel.'</h2>

	'. ($edit || $neu ? '<p><a href="?pid='.$pid.'">&laquo; zur&uuml;ck</a></p>' : '') .'	
	<form action="" onsubmit="" name="verwaltung" method="post">
';


$new = '<p><a href="?neu=1">&raquo; NEU</a></p>';

//// EDIT_SKRIPT
// 0 => Feldbezeichnung, 1 => Bezeichnung f&uuml;r Kunden, 2 => Art des Formularfeldes
$arr_form = array(
	array("reihenfolge", "Reihenfolge", '<input type="Text" value="#v#" name="#n#" style="#s# ; width:50px;">'),
	array("wid", "Warengruppe", 'sel', 'morp_shop_wg', 'gruppe'),
#	array("msid", "Sprache", 'sel', 'morp_sprachen_kunde', 'sprache'),
	array("name", "Name", '<input type="Text" value="#v#" name="#n#" style="#s#">'),
#	array("subline", "Name lang", '<input type="Text" value="#v#" name="#n#" style="#s#">'),
#	array("abstract", "Unterzeile", '<input type="Text" value="#v#" name="#n#" style="#s#">'),

 	array("beschreibung", "Beschreibung", '<textarea cols="80" rows="8" name="#n#">#v#</textarea>'),
//	array("details", "Details", '<textarea cols="80" rows="8" name="#n#">#v#</textarea>'),

# 	array("laenge", "L&auml;nge in Minuten", '<input type="Text" value="#v#" name="#n#" style="#s#">'),
//	array("laenge", "L&auml;nge/Dauer Webinar", 'sel', 'morp_shop_wg_abt', 'bezeichnung'),
//	array("preis", "Preis", '<input type="Text" value="#v#" name="#n#" style="#s#">'),

#	array("pdf", "PDF", 'foto', 'image', 'imgname', 6, 'gid'),
#	array("teaser", "Teaser YouTube Code", '<input type="Text" value="#v#" name="#n#" style="#s#">'),

	array("img", "Produkt Foto 1", 'foto', 'image', 'imgname', 6, 'gid'),
	array("img1", "Produkt Foto", 'foto', 'image', 'imgname', 6, 'gid'),
	array("img2", "Produkt Foto", 'foto', 'image', 'imgname', 6, 'gid'),
	array("img3", "Produkt Foto", 'foto', 'image', 'imgname', 6, 'gid'),
	array("img4", "Produkt Foto", 'foto', 'image', 'imgname', 6, 'gid'),
	array("img5", "Produkt Foto", 'foto', 'image', 'imgname', 6, 'gid'),
	array("img6", "Produkt Foto", 'foto', 'image', 'imgname', 6, 'gid'),
	array("img7", "Produkt Foto", 'foto', 'image', 'imgname', 6, 'gid'),
	array("img8", "Produkt Foto", 'foto', 'image', 'imgname', 6, 'gid'),
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
	$db = "morp_shop_prod p";
	$db2 = "morp_shop_wg w";
	$id = "pid";
	
	$id1 = "p.wid";
	$id2 = "w.wid";
	
	$zusatz = " $id1=$id2 ";
	
	$ord = "gruppe, reihenfolge, name";
	$anz = "name";
	$anz2 = "gruppe";
	$anz3 = "reihenfolge";
	////////////////////
	
	$echo .= '<p>&nbsp;</p><table class="autocol">';

	$alt = '';
	
	$sql = "SELECT * FROM $db, $db2 WHERE $zusatz ORDER BY ".$ord."";
	$res = safe_query($sql); 
		
	while ($row = mysqli_fetch_object($res)) {	
		$edit = $row->$id;
		$gr = $row->gruppe;

		if($gr != $alt) {
			$echo .= '<tr>
			<td colspan="4"><strong>'.($alt ? '<br>' : '').$row->$anz2.'</strong></td>
		</tr>';
			$alt = $gr;			
		}
		$echo .= '<tr>
			<td width="400"><p><a href="?edit='.$edit.'">'.$row->$anz	.'</a></p></td>
			<td><p><a href="?edit='.$edit.'">'.$row->$anz2.'</a></p></td>
			<td><a href="?edit='.$edit.'"><img src="images/edit.gif" alt="" width="18" height="10" border="0"></a></td>
			<td><a href="?del='.$edit.'"><img src="images/delete.gif" alt="" width="9" height="10" border="0"></a></td>
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
	$db = "morp_shop_prod";
	$id = "pid";
	/////////////////////

	$sql = "SELECT * FROM $db WHERE $id=".$edit."";
	$res = safe_query($sql); 
	$row = mysqli_fetch_object($res);
	
	$echo .= '<input type="Hidden" name="neu" value="'.$neu.'">
		<input type="Hidden" name="edit" value="'.$edit.'">
		<input type="Hidden" name="save" value="1">
	
	<style>
		textarea { height:200px; }
	</style>
	
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
			$echo .= '<tr><td><p>'.$arr[1].'</p></td><td><select name="'.$arr[0].'">'.pulldown ($row->$arr[0], $arr[3], $arr[4], $arr[0], $arr[5], $arr[6]).'</select></td></tr>';
			if ($arr[0] == "imgid") $image = pfad ($arr[0], $arr[3], $arr[4], $row->$arr[0]);
		}
		elseif ($arr[2] == "foto") {
			// $echo .= '<tr><td>'.$arr[1].'</td><td><select name="'.$arr[0].'">'.pulldown ($row->$arr[0], $arr[3], $arr[4], $arr[0], $arr[5], $arr[6]).'</select></td></tr>';
			// if ($arr[0] == "imgid") $image = pfad ($arr[0], $arr[3], $arr[4], $row->$arr[0]);

			$echo .= '<tr>
				<td width="160"><p>'.$arr[1].'</p></td>
				<td><input type=hidden name='.$arr[0].' value="' .$row->$arr[0].'" style="width:500px"><a href="image_folder_upload.php?pid='.$edit.'&imgid='.$arr[0].'">';
	
			if ($row->$arr[0] && $arr[0] != "pdf") $echo .=  '<img src="../timthumb.php?zc2&w=200&src=images/artikel/'.urlencode($row->$arr[0]).'"></a> &nbsp; &nbsp; 
					<a href="?delimg='.$arr[0].'&edit='.$edit.'"><img src="images/delete.gif" width="9" height="10" alt="Bild löschen" border="0" hspace="6"></a>';
					
			elseif ($row->$arr[0]) $echo .=  '<a href="../pdf/seminare/'.$row->$arr[0].'" target="_blank">PDF</a> &nbsp; &nbsp; 
					<a href="?delimg='.$arr[0].'&edit='.$edit.'"><img src="images/delete.gif" width="9" height="10" alt="Bild löschen" border="0" hspace="6"></a>';

			else $echo .=  '<b>'.($arr[0]=="pdf" ? 'PDF' : 'Foto').'</b>: bitte w&auml;hlen</a>';
			
			$echo .= '</td></tr>';

		}
		elseif ($arr[2] == "text") {
			$echo .= '<tr><td><p>'.$arr[1].'</p></td><td>'.str_replace("#e#", $edit, $arr[3]).'</td></tr>';
		}
		else $echo .= '<tr>
		<td><p>'.$arr[1].':</p></td>
		<td><p>'. str_replace(
					array("#v#", "#n#", "#s#", "#db#", '#e#', '#id#', '#s1#', '#s0#'), 
					array($row->$arr[0], $arr[0], 'width:400px;', $db2, $edit, $id2, $sel1, $sel2), 
			$arr[2]).'</p></td>
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
	$db = "morp_shop_prod";
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
}
elseif ($del) {
	die('<p>M&ouml;chten Sie den '.$um_wen_gehts.' wirklich l&ouml;schen?</p>
	<p><a href="?delete='.$del.'">Ja</a> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <a href="?">Nein</a></p>
	');
}
elseif ($delete) {
	$sql = "DELETE FROM morp_shop_prod WHERE pid=$delete";
	$res = safe_query($sql);	
}
elseif ($delimg) {
	$sql = "UPDATE morp_shop_prod SET $delimg='' WHERE pid=$edit";
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
