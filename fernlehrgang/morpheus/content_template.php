<?php
session_start();
# # # # # # # # # # # # # # # # # # # # # # # # # # #
# www.pixel-dusche.de                               #
# bj&ouml;rn t. knetter                             #
# start 12/2003                                     #
#                                                   #
# post@pixel-dusche.de                              #
# frankfurt am main, germany                        #
# # # # # # # # # # # # # # # # # # # # # # # # # # #
//$jq = 1;$box = "";
$js = '';
$multiupload = '';
$form = '';
$stelle = '';
$split = '';
$erstellen = '';

include("cms_include.inc");

$edit	= $_REQUEST["edit"];
$ilink	= $_REQUEST["ilink"];
$save	= $_REQUEST["speichern"];
$delimg = $_REQUEST["delimg"];
$imgsav = $_REQUEST["imgsav"];
$vorlage= $_REQUEST["vorlage"];

if ($_REQUEST["navid"]) {
	$navid = $_REQUEST["navid"];
	$_SESSION["navid"] = $navid;
}
$navid = $_SESSION["navid"];

// print_r($_POST);

///////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////

if ($save) {
	$arr = array("tlink", "tbackground", "tid", "timage", "theadl", "theight", "twidth", "tcolor", "tref");
	foreach ($arr as $val) {
		$set[] = $val."='".$_POST[$val]."'";
	}
	$set = implode(", ", $set);
	$sql = "UPDATE content set $set WHERE cid=$edit";
	$res = safe_query($sql);

	if ($save == "speichern und zurueck") {
		echo '<script language="JavaScript" type="text/javascript">
		document.location.href=\'';
		if ($vorlage) echo 'template.php';
		else echo 'content.php?edit='.$navid;
		echo '\';
	</script>
';
	}
}
elseif ($ilink) {
	$sql  = "UPDATE content set tlink='$ilink' WHERE cid=$edit";
	$res = safe_query($sql);
}
elseif ($imgsav) {
	$sql  = "UPDATE content set timage='$imgsav' WHERE cid=$edit";
	$res = safe_query($sql);
}
elseif ($delimg) {
	$sql  = "UPDATE content set timage='' WHERE cid=$edit";
	$res = safe_query($sql);
}
///////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////

$sql  	= "SELECT * FROM content WHERE cid=$edit";
$res	= safe_query($sql);
$row 	= mysqli_fetch_object($res);
$titel	= $row->name;

///////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////

echo '<div id=content class=no_preview>'.$out.'
		<p>Template</p>

		<p><a href="';

if ($vorlage) echo 'template.php';
else echo 'content.php?edit='.$navid;

echo '">&laquo; '.$MORPTEXT["GLOB-ZURUCK"].'/ '.$MORPTEXT["GLOB-FERTIG"].'</a></p>


';

echo '

';

$cid = $row->cid;
$lnk = $row->tlink;
$tid = $row->tid;
$bac = $row->tbackground;
$thead = $row->theadl;
$img = $row->timage;
$width = $row->twidth;
$height = $row->theight;
$tcolor = $row->tcolor;
$tref = $row->tref;

echo '<form method="post">
	<p>&nbsp;</p>

';

# # # # # # # # # # # # # # # # # # # # # # # # #
$templ 	= $morpheus["template"];
$i 		= 0;
if (!$tid) $tid = 1;

foreach($templ as $key=>$val) {
	$umbr = isin("<br>", $val) ? 1 : 0;

	if ($val) $template .= '<p><input type="radio" name="tid" value="'.$key.'"'. ($tid == $key ? ' checked' : '') .'> &nbsp; <!-- <a href="images/screen/'.$key.'.jpg" class="preview"> -->'. str_replace("<br>", "", $val) .' ('.$key.')<!-- </a> -->'. ($umbr ? '<br>&nbsp;<br>' : '') .'</p>';
}
# # # # # # # # # # # # # # # # # # # # # # # # #
# # # # # # # # # # # # # # # # # # # # # # # # #
# # # # # # # # # # # # # # # # # # # # # # # # #

echo '<input type="Hidden" name="edit" value="'.$cid.'">';

 echo '<p><br><input type="Text" name="tlink" id="tbackground" value="'.$lnk.'" style="width: 300px;"></p>
 <p>&nbsp;</p>';
#echo '<input type="Text" name="theadl" id="tbackground" value="'.$thead.'" style="width: 300px;"></p><p>Link auf Box setzen - nur bei "Box unten" m&ouml;glich</p><p><input type="Text" name="tlink" value="'.$lnk.'"> <a href="link.php?edit='.$edit.'&db=content_template&vorlage='.$vorlage.' "> &nbsp; Link | interner Link | mailto &raquo;</a></p> <p>';

# # # # # # # # # # # # # # # # # # # # # # # # #
# # # # # # # # # # # # # # # # # # # # # # # # #
# # # # # # # # # # # # # # # # # # # # # # # # #
# # # # # # # # # # # # # # # # # # # # # # # # #
# # KUNDEN REFERENZEN
/*
echo '<select name="tref"><option value="0">Referenzkunden Link w&auml;hlen</option>';

$sql  	= "SELECT kid, kname FROM p_kunde";
$rs		= safe_query($sql);
while ($rw = mysqli_fetch_object($rs)) {
	$ti	= $rw->kname;
	$ki	= $rw->kid;
	echo '<option value="'.$ki.'"'. ($ki == $tref ? ' selected' : '') .'>'.$ti.'</option>';
}

echo '</select>';
*/
# # # # # # # # # # # # # # # # # # # # # # # # #
# # # # # # # # # # # # # # # # # # # # # # # # #
# # # # # # # # # # # # # # # # # # # # # # # # #
# # # # # # # # # # # # # # # # # # # # # # # # #
/*

echo '</p><p>&nbsp;</p>
<p>Breite Template: <input type="Text" name="twidth" id="tbackground" value="'.$width.'"></p>
<p>H&ouml;he Template: <input type="Text" name="theight" id="tbackground" value="'.$height.'"></p>
<!-- <p>Typo Farbe: <input type="Text" name="tcolor" id="tbackground" value="'.$tcolor.'"></p> -->
<p>&nbsp;</p>
';
<p>emotionales Bild (links-, rechtsb&uuml;ndig oder zentriert)<br><!-- <input type="Text" name="tbackground" id="tbackground" value="'.$bac.'"> --></p>
<!-- <p>
<img src="farben/5e616d.jpg" alt="" width="20" height="20" border="0" onclick="change(\'#5e616d\')"> &nbsp;
<img src="farben/8ec95b.jpg" alt="" width="20" height="20" border="0" onclick="change(\'#8ec95b\')"> &nbsp;
<img src="farben/a7da8b.jpg" alt="" width="20" height="20" border="0" onclick="change(\'#a7da8b\')"> &nbsp;
<img src="farben/ff0000.jpg" alt="" width="20" height="20" border="0" onclick="change(\'#ff0000\')"> &nbsp;
<img src="farben/fffb00.jpg" alt="" width="20" height="20" border="0" onclick="change(\'#fffb00\')">
</p> -->

';

/////////////// BACKGR.-IMAGE
 echo '<input type=hidden name="timage" value="' .$img .'"><a href="image.php?cedit='.$edit.'&navid='.$navid.'&db=content&vorlage='.$vorlage.'">';

 if ($img) echo '<img src="../images/userfiles/image/'.$img.'"></a><br><a href="?delimg='.$i.'&edit='.$edit.'&navid='.$navid.'&vorlage='.$vorlage.'"><img src="images/delete.gif" width="9" height="10" alt="Bild l&ouml;schen" border="0" hspace="6"></a>';
 else echo '<b>Foto</b>: bitte w&auml;hlen</a>';
////////////////////////
*/

echo '
	<p>&nbsp;</p>
	<p><input type="submit" name="speichern" value="'.$MORPTEXT["GLOB-SPEICHERN"].'"></p>
	<p><input type="submit" name="speichern" value="speichern und zurueck"></p>
';



echo "<div style=\"position:absolute; border: solid 1px #cccccc; padding: 10px 4px 4px 10px; width: 400px; top: 50px; left: 450px; z-index:100;\">Template:<br>".$template."</div>\n";

?>

</form>
</div>

<?php
include("footer.php");
?>