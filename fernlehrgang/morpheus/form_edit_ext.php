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
$form = 1;

include("cms_include.inc");

$db 	= "form_field";
$getid 	= "fid";

# get requests
$del	= $_GET["del"];
$edit	= $_REQUEST["edit"];
$save	= $_REQUEST["save"];
$sort	= $_REQUEST["sort"];
$sortid	= $_REQUEST["sortid"];
$stelle = $_REQUEST["stelle"];
$brick  = $_REQUEST["brickname"];
$ffidsav= $_REQUEST["ffidsave"];

/*
# # # # # # # !!!!!!!!!!! name einsetzen
$query = "SELECT * FROM $db where fid='$edit' ORDER BY reihenfolge";
$result = safe_query($query);
$row = mysqli_fetch_object($result);
# $ort = $row->fname;
# # # # # # # !!!!!!!!!!! # # # # # # # !!!!!!!!!!!
*/
# # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # 

if ($save) {
	$brickname 	= $_POST["brickname"];
	$stelle 	= $_POST["stelle"];
	$set 		= " art='$brickname', reihenfolge=$stelle, fid=$edit";		
	$query 		= "insert $db set " .$set;
	$result = safe_query($query);
	$c = mysqli_insert_id($mylink);
	protokoll($uid, $db, $c, "neu");
}
elseif ($del) {
	$query 	= "DELETE FROM $db WHERE ffid=" .$del;
	$result = safe_query($query);
	protokoll($uid, $db, $edit, "delete");
}
elseif ($ffidsav) {
	$ffid 	= $_POST["ffid"];
	$stelle = $_POST["reihenfolge"];
	$feld 	= $_POST["feld"];
	$desc 	= $_POST["desc"];
	$size	= $_POST["size"];
	$size	= $_POST["size"];
	$parent = $_POST["parent"];
	$klasse	= $_POST["klasse"];
	$fehler = $_POST["fehler"];
	$email  = $_POST["email"];
	$cont 	= $_POST["cont"];
	$auswahl = trim($_POST["auswahl"]);
	$hilfe 	= trim($_POST["hilfe"]);
	$pflicht = $_POST["pflicht"];
	$spalte = $_POST["spalte"];
	
	$set 		= " reihenfolge='$stelle', fehler='$fehler', cont='$cont', feld='$feld', klasse='$klasse', size='$size', parent='$parent', auswahl='$auswahl', `desc`='$desc', hilfe='$hilfe', spalte='$spalte', pflicht='". ($pflicht ? 1 : 0) ."', email='". ($email ? 1 : 0) ."'";		
	$query 		= "UPDATE $db set " .$set . " WHERE ffid=$ffid";
	$result 	= safe_query($query);
	protokoll($uid, $db, $ffid, "edit");
}
elseif ($setdb = $_GET["setdb"]) {
	$query 	= "SELECT feld FROM $db WHERE fid=" .$edit;
	$res	= safe_query($query);
    $arr1	= array();
    $arr2	= array();
	while ($row = mysqli_fetch_object($res)) {
        if ($row->feld) $arr1[] = $row->feld;
    }

	$res 	= safe_query("SHOW COLUMNS FROM form_auswertung");
    while ($row = mysqli_fetch_object($res)) {
        $arr2[] = $row->Field;
    }

	$arr = array_diff($arr1, $arr2);
	
	foreach($arr as $val) {
		if ($val) {
			$sql = 'ALTER TABLE `form_auswertung` ADD `'.$val.'` VARCHAR( 255 ) NOT NULL ';
			safe_query($sql);
		}	
	}
	$warn = "<h2>DATENBANK gesetzt</h2>";
}
elseif ($_REQUEST["repair"]) {
	$arr 		= array();
	$xx 		= 0;
	$sql  		= "SELECT * FROM $db WHERE fid=$edit ORDER BY reihenfolge";
	$res 		= safe_query($sql);
	
	while ($rw = mysqli_fetch_object($res)) $arr[] = $rw->ffid;
	
	foreach ($arr as $val) {
		$xx++;
		$sql  = "update $db set reihenfolge=$xx where ffid=$val";
		$res = safe_query($sql);
	}
}

elseif ($sort) {
	if ($sort == "up") $s2 = $sortid - 1;
	else $s2 = $sortid + 1;
	
	$sort_    = array($sortid, $s2);
	$sort_new = array($s2, $sortid);
	$sort_arr = array();

	for($i=0; $i<=1; $i++) {
		$query  = "SELECT * FROM $db WHERE fid=$edit AND reihenfolge=$sort_[$i]";
		$result = safe_query($query);
		$row = mysqli_fetch_object($result);
		$sort_arr[] = $row->ffid;
	}

	for($i=0; $i<=1; $i++) {
		$query  = "update $db set reihenfolge=$sort_new[$i] WHERE ffid=$sort_arr[$i]";
		safe_query($query);
	}	
}

# # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # 
# # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # 

// eingabearten
$eingabe = array("Zeichen"=>"", "Zahlen"=>"number", "E-Mail"=>"email");

$sql	= "SELECT * FROM $db WHERE fid=$edit ORDER BY reihenfolge";
$res 	= safe_query($sql);
$y 		= mysqli_num_rows($res);	
$form  .= '<table width="100%">';

if (!$ffidsav) $thid = $_GET["ffid"];;

while ($row = mysqli_fetch_object($res)) {
	$opt = array("Dropdown", "Radiobutton");
	$counter++;
	
	if ($thid == $row->ffid || $c == $row->ffid) {
		$art = $row->art;
		if (isin("^Freitext", $art)) $form .= '
	<form method="post">
	<tr><input type=hidden name="edit" value='.$edit.'><input type=hidden name="ffid" value='.$row->ffid.'><input type=hidden name="stelle" value="'.$row->reihenfolge.'">
		<td colspan="2" valign="top"><em style="background:#e2e2e2; width:100px;display:block;padding-left:10px;">'.$row->art.'</em><br>Reihenfolge: <input type="Text" name="reihenfolge" value="'.$row->reihenfolge.'" style="width:20px;"></td>
		<td colspan="4">Freitext<br><textarea cols="" rows="4" name="hilfe" style="width:400px;">'.$row->hilfe.'</textarea></td>
		<td colspan="2" valign="top">&nbsp;<br><input type="submit" name="ffidsave" value="speichern"></td>
	</tr></form>	
	';
	
		elseif (isin("^Fieldset", $art)) $form .= '
	<form method="post">
	<tr><input type=hidden name="edit" value='.$edit.'><input type=hidden name="ffid" value='.$row->ffid.'><input type=hidden name="stelle" value="'.$row->reihenfolge.'">
		<td colspan="2" valign="top"><em style="background:#e2e2e2; width:100px;display:block;padding-left:10px;">'.$row->art.'</em><br>Reihenfolge: <input type="Text" name="reihenfolge" value="'.$row->reihenfolge.'" style="width:20px;"></td>
		<td colspan="4"><br>'. (isin("start", $art) ? 'Fieldset (kurz/eindeutig/kein Leerzeichen)<br>
			<input type="Text" name="feld" value="'.$row->feld.'" style="background:#e2e2e2;">' : '') .'</td>
		<td colspan="2" valign="top">&nbsp;<br><input type="submit" name="ffidsave" value="speichern"></td>
	</tr></form>	
	';
	
		elseif (isin("^Ende", $art)) $form .= '
	<form method="post">
	<tr><input type=hidden name="edit" value='.$edit.'><input type=hidden name="ffid" value='.$row->ffid.'><input type=hidden name="stelle" value="'.$row->reihenfolge.'">
		<td colspan="2" valign="top"><em style="background:#e2e2e2; width:100px;display:block;padding-left:10px;">'.$row->art.'</em><br>Reihenfolge: <input type="Text" name="reihenfolge" value="'.$row->reihenfolge.'" style="width:20px;"></td>
		<td colspan="4"><br>'. (isin("start", $art) ? 'Fieldset (kurz/eindeutig/kein Leerzeichen)<br>
			<input type="Text" name="feld" value="'.$row->feld.'" style="background:#e2e2e2;">' : '') .'</td>
		<td colspan="2" valign="top">&nbsp;<br><input type="submit" name="ffidsave" value="speichern"></td>
	</tr></form>	
	';
	
		else {
			$set = $row->cont;
			foreach($eingabe as $key=>$val) {
				$dd .= '<option value="'.$val.'"'. ($set == $val ? ' selected' : '') .'>'.$key.'</option>';
			}
			$dd = '<select name="cont" style="width:100px;">'.$dd.'</select>';

			$form .= $set.'
	<form method="post">
	<tr style="background:#e9e9e9;"><input type=hidden name="edit" value='.$edit.'><input type=hidden name="ffid" value='.$row->ffid.'>
		<td colspan="2">
			<em style="background:#e2e2e2; width:100px;display:block;padding-left:10px;">'.$row->art.'</em><br>
			Reihenfolge: <input type="Text" name="reihenfolge" value="'.$row->reihenfolge.'" style="width:20px;">
		</td>
		<td colspan="2"><br>Feldname (kurz/eindeutig/kein Leerzeichen)<br>
			<input type="Text" name="feld" value="'.$row->feld.'" style="background:#e2e2e2;"></td>
		<td colspan="3" valign="top"><br>Bezeichnung / Anzeige<br>
			<input type="Text" name="desc" value="'.htmlspecialchars($row->desc).'" style="width:360px;"></td>
	</tr>
	<tr style="background:#c5c5c5;">
		<td colspan="2" valign="top"><br>
			<input type="checkbox" name="pflicht" value="1" '. ($row->pflicht == 1 ? 'checked' : '') .'> &nbsp;&nbsp;Pflichtfeld <br>&nbsp;<br>
			'. ($art == "Eingabefeld" ? 'Eingabe<br>'. $dd : '') .'
			<!-- Datenbank Feld<br><input type="Text" name="spalte" value="'.$row->spalte.'"> -->&nbsp;<br>
			</td>
		<td colspan="2" valign="top">'. 
			(in_array($row->art, $opt) ? 'W&auml;hlbare Optionen<br><textarea cols="" rows="4" name="auswahl" style="width:200px;">'.$row->auswahl.'</textarea>' : '') 
			. ($art == "Eingabefeld" ? '<br>Breite des Eingabefeld (0 bei Standard)<br><input type="text" name="size" value="'. $row->size .'">' : '') 
			.'</td>
		<td colspan="2">Hilfetext<br><textarea cols="" rows="4" name="hilfe" style="width:200px;">'.htmlspecialchars($row->hilfe).'</textarea></td>
		<td colspan="1" valign="top">Schalte Fieldset frei<br><input type="text" name="parent" value="'. $row->parent .'">&nbsp;<br>&nbsp;<br>
			Class<br><input type="text" name="klasse" value="'. $row->klasse .'">&nbsp;<br></td>
	</tr>
	<tr style="background:#c5c5c5;">
		<td colspan="2"><input type="submit" name="ffidsave" value="speichern" style="background:#ff0000;color:#fff; width:100px;height:24px;font-weight:bold;"></td>
		<td colspan="2"></td>
		<td colspan="3" valign="top">Pflichtfeld-Fehlermeldung (leer = Standard)<br>
			<input type="Text" name="fehler" value="'.$row->fehler.'" style="width:360px;"></td>
	</tr>
	
	</form>';
		}
	}
	else {
		unset($sort);
		if ($counter > 1) $sort .= "&nbsp;&nbsp;<a href=\"?stelle=".$counter."&sort=up&sortid=".$row->reihenfolge."&edit=$edit\" title=\"eine Position nach oben\">" .up() ."</a>";
		if ($counter < $y) $sort .= "&nbsp;&nbsp;<a href=\"?stelle=".$counter."&sort=down&sortid=".$row->reihenfolge."&edit=$edit\" title=\"eine Position nach unten\">" .down() ."</a>\n";

		$text = $row->auswahl ? str_replace("\n", ' | ', $row->auswahl) : $row->hilfe;
		
		$form .= '
	<tr>		
		';
		
		if ($row->parent) $form .= '<td nowrap>&nbsp;</td><td style="font-weight:bold;">&plusmn;&plusmn; ';
		elseif ($row->art == "Fieldset Start") $form .= '<td nowrap>&nbsp;</td><td style="font-style:italic;border-top: solid 1px #999999;border-left: solid 1px #999999;"> ';
		elseif ($row->art == "Fieldset Ende") $form .= '<td nowrap>&nbsp;</td><td style="font-style:italic;border-left: solid 1px #999999;border-bottom: solid 1px #999999;"> ';
		else $form .= '<td nowrap>'.$row->reihenfolge.'<!--  | <strong style="color:#ff0000;">'.$row->ffid.'</strong> --></td><td>';

		$form .= '<a href="?stelle='.$counter.'&ffid='.$row->ffid.'&edit='.$edit.'">'.$row->art.'</a></td>
		<td><a href="?ffid='.$row->ffid.'&edit='.$edit.'" name="'.$counter.'">'.$row->feld.'</a></td>
		<td'. (isin("^ende", $row->art) ? ' style="background:#ff0000;"' : '') .'>'.substr(htmlspecialchars($row->desc),0,60).'</td>
		<!-- <td>'.substr($text,0,60).'</td> -->
		<!-- <td>'.$row->spalte.'</td> -->
		<td>'. ($row->pflicht ? 'Pflicht' : '') .'</td>
		<td nowrap>'.$sort.'</td>
		<td nowrap><a href="?stelle='.$counter.'&ffid='.$row->ffid.'&edit='.$edit.'"><img src="images/edit.gif" alt="" width="18" height="10" border="0"></a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a href="?stelle='.$counter.'&del='.$row->ffid.'&edit='.$edit.'"><img src="images/delete.gif" alt="" width="9" height="10" border="0"></a></td>
	</tr>';
	}
	
	$form .= '<tr><td colspan="9"><hr></td></tr>';
}

$form .= '</table>';

# # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # 
$counter++;
// _textboxen zusammenstellen

# # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # 
# # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # 
# # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # 
# # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # 
//
// stelle select mit bricks zusammen
$select_brick = "\n<select name=brickname style=\"width:200;\">\n<option value=''>Bitte Formularfeld w&auml;hlen</option>";
$dir_arr = array("Eingabefeld", "Mitteilungsfeld", "Dropdown", "Checkbox", "Radiobutton", "Freitext", "Freitext Fett", "Ende Checkbox", "Fieldset Start", "Fieldset Ende", "trennlinie");

foreach($dir_arr as $name) {
	$select_brick .= "<option value='$name'>$name</option>\n";
}
$select_brick .= "</select>\n";
// _select
//

//
// stelle select mit counter zusammen
if (!$counter) $counter = 1;
$select_stelle = "\n<select name=stelle style=\"width:50;\">\n<option value='$counter'>$counter</option>\n";

if ($counter > 1) {
	for ($i=1; $i < $counter; $i++) {
		$select_stelle .= "<option value='$i'>$i</option>\n";
	}
}
$select_stelle .= "</select>\n";
// _select
//
# # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # 
# # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # 
echo "\n\n<div id=vorschau>\n<p class=text><a href=\"formular.php\" title=\"zur&uuml;ck\">" .backlink() ." zur&uuml;ck</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href=\"?edit=$edit&repair=1\">&raquo; sortierung aktualisieren</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href=\"?edit=$edit&setdb=1\">&raquo; Datenbankeintr&auml;ge setzen</a></p>";
echo "\n\n<p class=text>$warn<b><font color=#cccccc></font>Formulare erstellen und editieren</b></p>";

#if (!$descr) $descr = "Pflichtfeld";

echo "\n\n<form method=post action=\"\" name=content_edit>
	<input type=hidden name=save value=1>
	<input type=hidden name=edit value=$edit>\n\n

	<!-- textboxes -->\n\n";
	
	echo $select_brick ." " .$select_stelle ."<input type=submit style=\"background-color:#cccccc;color:#FFFFFF;font-weight:bold;width:100px;\" name=erstellen value=einf&uuml;gen style=\"width:60;background-color:#BBBBBB;\"> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</form></div>

	<div id=content>\n\n";

	echo $form;
	
	#echo "<br>$show";

?>

</div>

<?
include("footer.php");
?>