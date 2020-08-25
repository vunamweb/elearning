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


#$sql = "ALTER TABLE  `pdf` ADD  `locked` INT( 1 ) NOT NULL";
#safe_query($sql);

/*
	$sql = "ALTER TABLE  `pdf` ADD  `locked` INT( 1 ) NOT NULL ,
ADD  `pend` VARCHAR( 10 ) NOT NULL, ADD  `locked` INT( 1 )";
safe_query($sql);
*/

function pdf ($pgid, $pgart) {
	$query  = "SELECT * FROM pdf_group WHERE pgart=$pgart ORDER BY pgname";
	$result = safe_query($query);
	while ($row = mysqli_fetch_object($result)) {
	 	$id = $row->pgid;
		$nm = $row->pgname;
		if ($pgid == $id) $sel = "selected";
		else unset ($sel);
		$tmp .= "<option value=\"$id\" $sel>$nm</option>\n";
	}
	return $tmp;
}


function filter ($kat="") {
	$sql = "SELECT * FROM morp_customer_kat WHERE 1";
	$res = safe_query($sql);

	$echo = '<form method="get" onsubmit="" name="katfilter"><select name="filter" onchange="document.pdf.submit();"><option value="">Alle</option>';

	while($row = mysqli_fetch_object($res)) {
		$echo .= '<option value="'.$row->kid.'"'. ($row->kid == $kat ? ' selected' : '') .'>'.$row->kategorie.'</option>';
	}

	$echo .= '</select>';

	return $echo;
}


$pgid 	 = $_REQUEST["pgid"];
if (!$pgid) $db = "pdf_group";
else $db = "pdf";

$save 	 = $_REQUEST["save"];
$neu 	 = $_REQUEST["neu"];
$del 	 = $_REQUEST["del"];
$delete	 = $_REQUEST["delete"];
$edit	 = $_REQUEST["edit"];
$pid	 = $_REQUEST["pid"];
$date	 = $_REQUEST["pdate"];
$pstart	 = $_REQUEST["pstart"];
$pend	 = $_REQUEST["pend"];
$pdesc	 = $_REQUEST["pdesc"];
$reload	 = $_REQUEST["reload"];
$pdf 	 = $_FILES['userfile']['name'];
$ptmp 	 = $_FILES['userfile']['tmp_name'];
$kat 	 = $_REQUEST["filter"];


echo "<div id=content_big cla&szlig;=text>\n<p><b>Verwaltung Download Dokumente</b></p>";

if ($del && $pgid) {
	echo '<p>&nbsp;</p><p><font color=#ff0000><b>Sind Sie sich sicher, da&szlig; sie den Download l&ouml;schen wollen?</b></font></p>
		<p>&nbsp; &nbsp; &nbsp; <a href="pdf.php?delete=' .$del .'&pgid=' .$pgid .'">Ja</a> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <a href="pdf.php?pgid='.$pgid.'">Nein</a></p></body></html>';
	die();
}
elseif ($delete && $pgid) {
	$query = "SELECT * FROM pdf where pid=$delete";
	$result = safe_query($query);
	$row = mysqli_fetch_object($result);
 	$de = $row->pname;

	$query = "delete from pdf where pid=$delete";
	$result = safe_query($query);

	unlink("../pdf/$de");
}
elseif ($save && $pgid) {
	$name = $_POST["pname"];
	$lock	 = $_REQUEST["locked"];
	$query = "update pdf set pdesc='$pdesc', pdate='" .us_dat($date) ."', pstart='" .us_dat($pstart) ."', pend='" .us_dat($pend) ."', pgid=$pgid , locked=".($lock ? "1" : "0"). " WHERE pid=$edit";
	safe_query($query);
	protokoll($uid, "pdf", $edit, "edit");

	unset($edit);
}
elseif ($save) {
	$pgname = $_POST["pgname"];
	$pgart = $_POST["pgart"];
	$lock	 = $_REQUEST["locked"];

	if ($neu) $query = "insert $db ";
	else $query = "update $db ";

	$query .= "set pgname='$pgname', pgart = $pgart , locked=".($lock ? "1" : "0");
	if (!$neu) $query .= " where pgid=$edit";
	# echo $query;
	$res = safe_query($query);

	if (!$neu) protokoll($uid, $db, $edit, "edit");
	else {
		$c = mysqli_insert_id($mylink);
		protokoll($uid, $db, $c, "neu");
	}

	unset($edit);
	unset($neu);
}

if ($edit && $pgid) {
		$query  = "SELECT * FROM $db where pid=$edit";
		$query  = "SELECT * FROM pdf p, pdf_group g WHERE p.pgid=g.pgid AND pid=$edit";
		$result = safe_query($query);
		$row = mysqli_fetch_object($result);
	 	$id = $row->pid;
	 	$pg = $row->pgid;
		$de = $row->pdesc;
		$nm = $row->pname;
		$si = $row->psize;
		$pstart = euro_dat($row->pstart);
		$pend = euro_dat($row->pend);
		$da = $row->pdate;
		$da = euro_dat($da);
		$lo = $row->locked;

		$pgart = $row->pgart;

// ($pgart >= 4 ? '' :"

	echo "<form method=post name=pdf>
		<input type=hidden name=save value=1>
		<input type=hidden name=edit value=$id>
		<input type=hidden name=pgid value=$pg>
		<input type=hidden name=neu value=$neu>
		<br/>
		<table class=\"table autocol\" width=\"100%\">
		"

		."<tr>
			<td width=\"140\"><p>Dateiname<!-- , der auf der Homepage stehen soll --></p></td>
			<td><p>Upload-Datum</p></td>
			<td><p>Start Datum</p></td>
			<td><p>End Datum</p></td>
		</tr>
		<tr>
			<td>$nm  &nbsp; <br><br><a href=\"pdf_upload.php?reload=$id&pgid=$pgid\">" .'<i class="fa small fa-upload"></i> '." neues dokument uploaden</a></td>
			<td><input type=text name=pdate value='$da'></td>
			<td><input type=text name=pstart value='$pstart'></td>
			<td><input type=text name=pend value='$pend'></td>
		</tr>
		<tr>
			<td valign=top colspan=4><p>&nbsp;</p><p>Dateibeschreibung (max. 256 Zeichen)</p>
			<p><input name=\"pdesc\" style=\"width:500;\" size=255 maxlength=255 value=\"$de\"><br/><br/></p>
			</td>
		</tr>
		<tr>
			<td valign=top><p>geschütztes Dokument</p> <input type=\"checkbox\" name=\"locked\" ".($lo ? " checked" : "")." style=\"width:25;\" value=\"1\"></td>
			<td valign=top colspan=3><p>Gruppen-Zugeh&ouml;rigkeit</p> <select name=\"pgid\">" .pdf($pgid, $pgart) ."</select></td>
		</tr>
		</table>
		<br><br>
		<input type=submit style=\"background-color:#7B1B1B;color:#FFFFFF;font-weight:bold;width:100px;\" name=erstellen value=speichern style=\"width:70;background-color:#BBBBBB;\">
		";

		///// 2015-02-17
		////  Mitglieder Zuordnung

		if ($pgart >= 2) {
			echo "<h2 style=\"border-bottom: solid 1px #000; width:700px;\">Gruppen / Gremien Zuweisung</h2><p>&nbsp;</p>";

			$col 	= array("FFFFFF","cccccc", "cde6fa");
			$sql  	= "SELECT * FROM morp_gremien ORDER BY gid";
			$res  	= safe_query($sql);
			$ct   	= 0;

			while($row = mysqli_fetch_object($res)) {
				$sq  	= "SELECT * FROM morp_gremien_datei WHERE gid=".$row->gid." AND pid=".$id;
				$rs 	= safe_query($sq);
				$c	 	= mysqli_num_rows($rs);
				echo '<p class="vers"><input type="checkbox" value="'. ($row->gid) .'" name="datei"'. ($c > 0 ? ' checked' : '') .' ref="'. ($row->gid) .'|'. ($id) .'" class="gremium"> &nbsp; '.$row->gremium.'</p>';
			}
		}

		echo '<script>
$(document).ready(function(){
	$(\'.vers input\').on(\'ifChecked\', function(event){
		var data = $(this).attr("ref");

		var dataString = "add=1&data="+data;
		$.ajax({
			type: "POST",
			url: "pdf_save.php",
			data: dataString,
			success: function(msg){
				// alert(msg);
			}
		});
	});
	$(\'.vers input\').on(\'ifUnchecked\', function(event){
		var data = $(this).attr("ref");
		var dataString = "del=1&data="+data;
		$.ajax({
			type: "POST",
			url: "pdf_save.php",
			data: dataString,
			success: function(msg){
				// alert(msg);
			}
		});
	});
});
</script>
';

		echo "
		<p>&nbsp;</p>
		<p>&nbsp;</p>
		</form>
		";

	echo "<p><a href=\"pdf.php?pgid=$pgid\" title=\"zur&uuml;ck\"><i class=\"fa small fa-chevron-left small\"></i> zur&uuml;ck</a></p>";
}
elseif (($neu || $reload) && $pgid) {
	echo "<form action=\"pdf.php\" method=post enctype=\"multipart/form-data\">\n\n
		<input type=\"File\" name=\"userfile\" cla&szlig;=text><p>
		<input name=pid type=hidden value=$reload>
		<input name=pgid type=hidden value=$pgid>
		<input type=submit style=\"background-color:#7B1B1B;color:#FFFFFF;font-weight:bold;width:100px;\" value=\"upload starten\" style=\"width:100px;background-color:#BBBBBB\">
		</form>";

	echo "<p><a href=\"pdf.php?pgid=$pgid\" title=\"zur&uuml;ck\"><i class=\"fa small fa-chevron-left small\"></i> zur&uuml;ck</a></p>";
}
elseif ($edit || $neu || $rn) {
	if (!$neu) {
		$query  = "SELECT * FROM $db where pgid=$edit";
		$result = safe_query($query);
		$row = mysqli_fetch_object($result);
		$nm  = $row->pgname;
		$art = $row->pgart;
	}

	$bereich_bez = array("","Standard Download","Infomaterial Download mit Formular");
	$bereich_anz = count($bereich_bez)-1;
	if (!$bereich) $bereich = 1;

	for($i=1; $i <= $bereich_anz; $i++) {
		$radio .= '<p><input type="radio" name="pgart" value="'.$i.'"';
		if ($art == $i) $radio .= ' checked';
		$radio .= '> &nbsp; '.$bereich_bez[$i].'</p>';
	}

	echo "<form method=post name=pdf>
		<input type=hidden name=save value=1>
		<input type=hidden name=edit value=$edit>
		<input type=hidden name=neu value=$neu>
		<p>Name der Download-Gruppe &nbsp; <input type=text name=pgname value='$nm'></p>
		<p>&nbsp;</p>
		<p>$radio</p>
		<p>&nbsp;</p>
		<p><input type=submit style=\"background-color:#7B1B1B;color:#FFFFFF;font-weight:bold;width:100px;\" name=erstellen value=speichern style=\"width:70;background-color:#BBBBBB;\"></p>
		</form>
		";

	echo "<p><a href=\"pdf.php\" title=\"zur&uuml;ck\"><i class=\"fa small fa-chevron-left small\"></i> zur&uuml;ck</a></p>";
}
elseif($pdf) {
	$pfad = getDownloadDirectoy($pgid);
	$newpdf = $pdf;

	if (!copy($ptmp, $pfad.$newpdf)) {
		echo ("<p>failed to copy $tmp...$val<br>\n");
		die();
	}
	else {
		$size  = filesize($ptmp);
		$size  = $size/1024;
		$date = date(Y ."-" .m ."-" .d);
		if ($pid) $sql = "update pdf set pname='$newpdf', pdate='$date', psize=$size, edit=1, pgid=$pgid where pid=$pid";
		else $sql = "insert pdf set pname='$newpdf', pdate='$date', psize=$size, pgid=$pgid";
		safe_query($sql);
		echo "<p>Upload erfolgreich abgeschlo&szlig;en</p>
			<p><a href='pdf.php?pgid=$pgid'><i class=\"fa small fa-chevron-left small\"></i> zur&uuml;ck</a></p>";
	}
}
elseif ($pgid)	{
	$pfad = getDownloadDirectoy($pgid);
	echo "<p><a href=\"pdf_group.php\" title=zur&uuml;ck><i class=\"fa small fa-chevron-left small\"></i> zur&uuml;ck</a></p>";

	echo "

		<table>
		<tr style=\"font-weight:bold;\" height=20>
			<td valign=top width=160><b>name</b></td>
			<td valign=top></td>
			<td valign=top><b>beschreibung</b></td>
			<td valign=top><b>gr&ouml;&szlig;e</b></td>
			<td valign=top><b>Upload</b></td>
			<td valign=top><b>Start</b></td>
			<td valign=top><b>Ende</b></td>
			<td valign=top></td>
		</tr>";

	$col = array("#FFFFFF","#EFECEC");
	$ct  = 0;

	$query  = "SELECT * FROM pdf where pgid=$pgid order by pname";
	$result = safe_query($query);
	while ($row = mysqli_fetch_object($result)) {
	 	$id = $row->pid;
		$de = $row->pdesc;
		$nm = $row->pname;
		$si = $row->psize;
		$da = $row->pdate;
	 	$da = euro_dat($da);
	 	$pstart = euro_dat($row->pstart);
	 	$pend = euro_dat($row->pend);

		$lo = $row->locked;

	 	if(file_exists($pfad.$nm.'.jpg')) $thumb = '<img src="timthumb.php?w=50&h=50&src='.$pfad.$nm.'.jpg" />';
	 	else $thumb = '';

		echo "<tr bgcolor=$col[$ct] height=24>
				<td valign=top width=100><p><font color=#000000><a name=\"Download anzeigen\" href=\"".$pfad.$nm."\" target=\"_blank\" title=\"Download anzeigen\">$nm</a></p></td>
				<td valign=top width=80><p>$thumb</p></td>
				<td valign=top><p>$de</p></td>
				<td valign=top width=80><p>$si kb</p></td>
				<td valign=top width=80><p>$da</p></td>
				<td valign=top width=80><p>$pstart</p></td>
				<td valign=top width=80><p>$pend</p></td>
				<td valign=top width=40><p><a href=\"pdf.php?edit=$id&pgid=$pgid\"><i class=\"fa small fa-pencil-square-o\"></i></a></p></td>
				<td valign=top width=40><p><a href=\"pdf.php?del=$id&pgid=$pgid\"><i class=\"fa small fa-trash-o\"></i></a></p></td>
				<td valign=top width=40><p>".($lo ? "<a href=\"#\"><i class=\"fa small fa-lock\"></i></a>" : "")."</p></td>
			</tr>
			";
		if ($ct == 0) $ct = 1;		//farbendefenition
		else $ct = 0;
	}
	echo "</table>
		<p>&nbsp;</p><p><a href=\"pdf_upload.php?neu=1&pgid=$pgid\"><i class=\"fa small fa-plus small\"></i> NEU</a></p>";
}
else {
	$col = array("#FFFFFF","#EFECEC");
	$ct  = 0;

	echo '<table cellspacing="1">';

	$query  = "SELECT * FROM $db order by pgname";
	$result = safe_query($query);
	while ($row = mysqli_fetch_object($result)) {
	 	$id = $row->pgid;
	 	$nm = $row->pgname;
		echo "<tr bgcolor=$col[$ct] height=20><td width=250>&nbsp; <a href=\"pdf.php?pgid=$id\"><i class=\"fa small fa-chevron-left\"></i> <b>$nm</b></a>";
		if ($admin) echo '&nbsp; &nbsp; <a href="pdf.php?edit='.$id.'&db='.$db.'"><img src="images/stift.gif" width="9" height="9" alt="editiere name" border="0"></a>';
		echo '</td><td width=50 align="center"><a href="pdf.php?pgid='.$id.'"><img src="images/edit.gif" alt="&ouml;ffne ordner" border="0"></a></td></tr>';

		if ($ct == 0) $ct = 1;		//farbendefenition
		else $ct = 0;
	}
	echo "</table>";
	if ($admin) echo "<p><a href=\"pdf.php?neu=1\"><i class=\"fa small fa-chevron-right\"></i> NEU</a></p>";
}
?>

</div>

<?
include("footer.php");
?>