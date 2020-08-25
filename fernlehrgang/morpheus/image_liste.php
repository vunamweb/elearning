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

$stelle = $_REQUEST["stelle"];

include("cms_include.inc");


function img_group ($imgid) {
	$query  = "SELECT * FROM img_group order by name";
	$result = safe_query($query);
	while ($row = mysqli_fetch_object($result)) {
	 	$id = $row->gid;
		$nm = $row->name;
		if ($imgid == $id) $sel = "selected";
		else unset ($sel);
		$tmp .= "<option value=\"$id\" $sel>$nm</option>\n";
	}
	return $tmp;
}

$del 	 = $_REQUEST["del"];
$delete	 = $_REQUEST["delete"];
$save	 = $_REQUEST["save"];
$gid	 = $_REQUEST["gid"];

# beschreibenden text verwalten
$txtedit = $_REQUEST["txt"];
$newtext = $_REQUEST["newtext"];
$ltext 	 = $_REQUEST["longtext"];

# wenn bild in content eingesetzt wird
$stelle = $_REQUEST["stelle"];
$imglnk = $_REQUEST["imglnk"];
$navid  = $_REQUEST["navid"];
$edit   = $_REQUEST["edit"];
$cedit  = $_REQUEST["cedit"];
$db		= $_REQUEST["db"];
$art	= $_REQUEST["art"];
$vorlage= $_REQUEST["vorlage"];

$newsletter = $_REQUEST["newsletter"];
if ($_GET["db"] == "ec_kurs_art") $kurs = 1;

if ($cedit)  		$temp_lnk = "content_template.php?navid=$navid&edit=$cedit&vorlage=$vorlage";
elseif ($navid || $kurs)  	$incl_lnk = "content_edit.php?db=$db&stelle=$stelle&navid=$navid&edit=$edit&art=$art&vorlage=$vorlage";

# wenn bild in news eingesetzt wird
$nid	= $_REQUEST["nid"];
$ngid	= $_REQUEST["ngid"];

# deko bilder bestimmen
$inr 	= $_REQUEST["inr"];
$cid	= $_REQUEST["cid"];
$back	= $_REQUEST["back"];

# print_r($_REQUEST);

if ($save) {
	foreach ($_POST as $key=>$val) {
 		if (preg_match("/^gid/", $key)) {
			$tmp = explode ("_", $key);
			if ($val != $gid) {
				$que = "update image set gid=$val where imgid=$tmp[1]";
				safe_query($que);
			}
		}
	}

	create_img_liste();
}
elseif ($del) {
	$warnung = "<p><font color=#ff0000><b>Wollen Sie das Bild wirklich l&ouml;schen?</b></font></p>
				<p>Sind Sie sicher, dass dieses Bild auf keiner Ihrer Seiten mehr verwendet wird?<br>&nbsp;</p>
				<a href=\"image_liste.php?delete=$del&gid=$gid\" title=\"Bild l&ouml;schen!\">" .ilink() ." Bild l&ouml;schen</a><p>
				<a href=\"image_liste.php?gid=$gid\" title=\"abbrechen\">" .backlink() ." abbrechen</a>";
}
# das bild wird endg&uuml;ltig gel&ouml;scht
elseif ($delete) {
	$query = "SELECT imgname FROM image WHERE imgid=$delete";
	$res = safe_query($query);
	$row = mysqli_fetch_object($res);
	$tmp = "../images/userfiles/image/".$row->imgname;
	@unlink($tmp);

	$query = "delete from image where imgid=$delete";
	safe_query($query);
	create_img_liste();
}
elseif($txtedit) {
	$query  = "SELECT * FROM image where imgid=$txtedit";
	$result = safe_query($query);
	$row = mysqli_fetch_object($result);
	$tx = $row->itext;
	$lt = $row->longtext;
	$inm 	= $row->imgname;

//	if (!$tx) $tx = "Bitte hier den beschreibenden Text einf&uuml;gen";
	$warnung = "<form action='image_liste.php' method=post>
		<input type=\"hidden\" value=\"$txtedit\" name=\"stelle\">
		<input type=\"hidden\" value=\"$txtedit\" name=\"inr\">
		<input type=\"text\" value=$gid name=\"gid\"><br>
		<b>Alt Text oder externer Link (inkl. http:// angeben!)</b><br>
		<input type=\"text\" name=\"newtext\" size=\"100\" maxlength=\"255\" value=\"$tx\"><p>
		<p>&nbsp;</p>
		<b>Langtext</b>. Wird unter dem Galerie-Bild angezeigt<br>
		<textarea cols=\"100\" rows=\"5\" name=\"longtext\" style=\"height:60px;\">$lt</textarea>
		<input type=\"submit\" name=\"speichern\" value=\"speichern\">
		<p>&nbsp;</p><p>Gruppen-Zugeh&ouml;rigkeit</p><p></p></form>

		<img src=\"../images/userfiles/image/".$inm."\" border=0 vspace=6>";
	#<select name=\"gid\">" .img_group($txtedit) ."</select>
}
elseif ($newtext || $ltext) {
	$query = "update image set itext='$newtext', `longtext`='$ltext' where imgid=$inr";
	safe_query($query);
	#$gid = $inr;
	create_img_liste();
}

echo "<div id=content_big class=text><table border=0><tr><td>
";
if (!$cid && !$nid) echo "<p><b>Bildarchiv</b></p>";
if ($warnung) die ($warnung ."</div></body></html>");
if ($navid || $nid || $kurs) echo "<p><a href='javascript:history.back();'>" .backlink() ." zur&uuml;ck</a></p>\n";
elseif ($cid) echo "<p><a href='content_foto.php?back=$back&edit=$cid'>" .backlink() ." zur&uuml;ck</a></p>\n";
elseif ($newsletter) echo "<p><a href='newsletter.php'>" .backlink() ." zur&uuml;ck</a></p>\n";

if (!$navid && !$cid && !$nid && !$kurs) echo "<p><p><a href=\"image.php\" title=\"zur&uuml;ck\">" .backlink() ." zur&uuml;ck</a></p></p><p><a href=\"img_upload.php?gid=$gid\" title=\"Neue Bilder hochladen\">" .ilink() ." Neue Bilder hochladen</a></p>";

#
# query
# query
// THUMB ? --------
$query  = "SELECT * FROM img_group WHERE gid=$gid";
$result = safe_query($query);
$row = mysqli_fetch_object($result);
$thumb = $row->art;


$query  = "SELECT * FROM image where gid=$gid ORDER BY imgid DESC";
$result = safe_query($query);

$t = 0;
$x = 0;

if (!$navid && !$nid && !$inr) echo '<form method=post><input type="submit" class="button" name="save" value="Bilder im neuen Ordner speichern" style="width:200px;"><br/>';

$imgdir = "../images/userfiles/image/";

while ($row = mysqli_fetch_object($result)) {
	$id = $row->imgid;
	$nm = $row->imgname;
	$ty = $row->type;
	$tx = nl2br($row->longtext);

	$hires = $thumb == 2 ? 1 : 0;

	if ($tx) $tx = "<p class=bild style=\"background-color: silver; padding: 5px;\">$tx</p>";

	if ($nm) {
		$t++;
		$x++;

		echo "<div style=\"float:left;margin: 12 8 0 0; border: solid 1px #7B1B1B; padding:5px; width:400px;\">";

#  create_image($id, $nm, $ty);
	   $th_img = "<img src=\"".($hires ? '../timthumb.php?src=images/userfiles/image/'.urlencode($nm).'&w=360' : $imgdir.$nm)."\" border=0 alt=\"$itext\" title=\"$itext\" style=\"margin: 10px; float:left;\">";


  		#$th_img = "<img src=\"blob.php?imgid=$id\" border=0 vspace=6><p>";

		if ($incl_lnk) 		echo "<a href=\"" .$incl_lnk ."&imgid=$id&back=$back&db=$db&imglnk=$imglnk\" name=\"$id\">$th_img";
		elseif ($temp_lnk) 	echo "<a href=\"" .$temp_lnk ."&imgsav=$nm\" name=\"$id\">$th_img";
		elseif ($back) 		echo "<a href=\"content_foto.php?edit=$cid&inr=$inr&back=$back&imgid=$id\" name=\"$id\">$th_img";
		elseif ($nid) 		echo "<a href=\"news.php?edit=$nid&ngid=$ngid&gid=$id\" title=\"image w&auml;hlen\" name=\"$id\">$th_img";
		elseif ($newsletter) 		echo "<a href=\"newsletter.php?&update=$newsletter&img=$nm\" title=\"image w&auml;hlen\" name=\"$id\">$th_img";
		elseif ($id >= 1) 	echo "$th_img<a href=\"image_liste.php?del=$id&gid=$gid\" title=\"image l&ouml;schen\" name=\"$id\"><img src=\"images/delete.gif\" width=\"9\" height=\"10\" alt=\"Bild l&ouml;schen\" border=0>";

		if (!$back && !$nid && !$navid && !$newsletter && !$kurs) echo "</a> &nbsp; <select name=\"gid_$id\">" .img_group($gid) ."</select></p>
			$tx\n<p><a href=\"image_liste.php?gid=$gid&txt=$id\"><img src=\"images/lupe_.gif\" width=\"12\" height=\"12\" alt=\"\" border=0> <img src=\"images/edit.gif\" alt=\"Beschreibenden Text zum Bild bearbeiten\" border=0> <b>$nm</b></a></p>";
		else echo "<br>\n<b>$nm</b></a>";

		echo "</div>";
		# # # # # # # # # # # # # # # # # # # # # # # # # # # # #
	}
}

if (!$navid && !$nid && !$inr && !$kurs) echo '</form>
<td></tr><table>
';

if (!$navid && !$nid && !$inr && !$back && !$kurs) echo "<div style=\"clear:left;\"><p>&nbsp;</p><p><a href=\"img_upload.php?gid=$gid\">" .ilink() ." Neue Bilder hochladen</a></p></div>";
?>
</div>

<?
include("footer.php");
?>