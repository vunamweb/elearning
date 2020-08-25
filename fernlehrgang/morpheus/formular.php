<?php
session_start();
# # # # # # # # # # # # # # # # # # # # # # # # # # #
# www.pixel-dusche.de                               #
# bj&ouml;rn t. knetter                                  #
# start 12/2003                                     #
#                                                   #
# post@pixel-dusche.de                              #
# frankfurt am main, germany                        #
# # # # # # # # # # # # # # # # # # # # # # # # # # #

include("cms_include.inc");

$edit 	 	= $_REQUEST["edit"];
$save 	 	= $_REQUEST["save"];
$del 	 	= $_REQUEST["del"];
$delete	 	= $_REQUEST["delete"];
$neu		= $_REQUEST["neu"];
$dupl		= $_REQUEST["dupl"];

if ($del) {
	$warnung = "<p><font color=#ff0000><b>Wollen Sie das Formular wirklich l&ouml;schen?</b></font></p>
				<p><a href=\"formular.php?delete=$del\" title=\"Formular l&ouml;schen!\">" .ilink() ." endg&uuml;ltig l&ouml;schen</a></p>
				<p><a href=\"formular.php\" title=\"zur&uuml;ck\">" .backlink() ." zur&uuml;ck</a></p>";
}

elseif ($delete) {
	$query = "delete from form where fid=$delete";
	safe_query($query);
	protokoll($uid, "form", $delete, "del");
}

elseif ($save) {
	$set 	= "fname='".$_POST["fname"]."', post='".$_POST["post"]."', betreff='".$_POST["betreff"]."', antwort='".$_POST["antwort"]."', extended='". ($_POST["extended"] ? 1 : 0) ."'";

	if ($neu) 	$query = "insert form set $set, edit=1";
	else		$query = "update form set $set, edit=1 WHERE fid=$edit";

	$result = safe_query($query);
	if ($neu) {
		$edit = mysqli_insert_id($mylink);
		protokoll($uid, "form", $edit, "neu");
	}
	else protokoll($uid, "form", $edit, "edit");
}

elseif ($dupl) {
	$query  = "SELECT * FROM form WHERE fid=$dupl";
	$result = safe_query($query);
	$num 	= mysqli_num_fields($result);
	$row 	= mysqli_fetch_array($result);
    $sql 	= "INSERT INTO `form` VALUES('',";

    for ($i=2;$i<=$num;$i++) {
     	$sql .= "'".mysqli_real_escape_string(stripslashes($row[$i-1]))."', ";
    }
   	$sql = substr($sql, 0, -2);
	$res = safe_query($sql.')');

	$c = mysqli_insert_id($mylink);
	protokoll($uid, "form", $c, "neu");

	if ($_GET["ext"]) {
		$sql	= "SELECT * FROM form_field WHERE fid=$dupl";
		$res	= safe_query($sql);
		while ($row = mysqli_fetch_object($res)) {
			$set 		= " fid=$c, reihenfolge='".$row->reihenfolge."', art='".$row->art."', feld='".$row->feld."', auswahl='".$row->auswahl."', `desc`='".$row->desc."', hilfe='".$row->hilfe."', spalte='".$row->spalte."', pflicht='".$row->pflicht."', email='".$row->email."', klasse='".$row->klasse."'";
			$query 		= "INSERT form_field set " .$set;
			$result 	= safe_query($query);
			#echo "<br>";
		}
	}
}


if ($neu || $edit) {
	if ($edit) {
		$query  = "SELECT * FROM form WHERE fid=$edit";
		$result = safe_query($query);
		$row = mysqli_fetch_object($result);

		$fname 		= $row->fname;
		$post 		= $row->post;
		$betreff 	= $row->betreff;
		$antwort	= $row->antwort;
	}

	$warnung = '<p><a href="formular.php">&laquo; fertig</a></p>
	<p>&nbsp;</p>

	<form action="formular.php" method=post>
		<input type="hidden" name="neu" value="'.$neu.'"><input type="hidden" name="edit" value="'.$edit.'"><input type="hidden" name="save" value="1">
		<p>Name des neuen Formulares</p>
		<p><input type="text" name="fname" size="50" value="'.$fname.'"></p>

		<p><input type="checkbox" name="extended" value="1" '. ($row->extended ? 'checked' : '') .'> &nbsp;&nbsp; Erweitertes Formular - Einstellm&ouml;glichkeiten / Datenbankauswertung</p>

		<p>Empf&auml;nger E-Mail</p>
		<p><input type="text" name="post" size="50" value="'.$post.'"></p>
		<p>Betreff</p>
		<p><input type="text" name="betreff" size="50" value="'.$betreff.'"></p>
		<p>Antwort, nachdem das Formular abgesendet worden ist.</p>
		<p><textarea cols="80" rows="5" name="antwort">'.$antwort.'</textarea></p>
		<p>&nbsp;</p>
		<p><input type="submit" class="button" name="speichern" value="speichern"></p>';
}

echo "<div id=content_big class=text>\n<p><b>Formularverwaltung</b></p>";
if ($warnung) die ($warnung ."</div></body></html>");


echo "<table border=0 cellspacing=1 cellpadding=4>";

$query  = "SELECT * FROM form order by fname";
$result = safe_query($query);
$y 		= mysqli_num_rows($result);
$x 		= 0;

while ($row = mysqli_fetch_object($result)) {
	$id = $row->fid;
	$nm = $row->fname;
	$ex = $row->extended;

	if ($id) {
		$x++;
		echo "<tr style=\"height:26px;\">
			<td width=30 align=left valign=top>$x </td>
			<td width=250 valign=top><a href=\"formular.php?edit=$id\" title=\"Formular bearbeiten\">$nm &nbsp; <i class=\"fa fa-pencil-square-o\"></i></a></td>
			<td width=100 valign=top><a href=\"formular.php?dupl=$id&ext=$ex\" title=\"Formular duplizieren\">Formular duplizieren</a></td>\n";

		echo "<td width=160 valign=top align=right><a href=\"form_edit". ($ex ? '_ext' : '') .".php?edit=$id\" title=\"Formular bearbeiten\"><i class=\"fa fa-pencil-square-o\"></i></a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ";
		echo "<a href=\"formular.php?del=$id\" title=\"Formular l&ouml;schen\"><i class=\"fa fa-trash-o\"></i><</a></td>
</tr>\n";
	}
}
echo "</table>";
echo "<p>&nbsp;<br><a href=\"formular.php?neu=1\" title=\"Neues Formular erstellen\">" .ilink() ." NEU</a></p>";
?>

</div>

<?
include("footer.php");
?>