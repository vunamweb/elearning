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

function pulldown ($tp, $db, $wname, $wid) {
	if ($db == "termin_liste")
		$query = "SELECT * FROM $db tl, termin_abt ta WHERE ta.taid=tl.taid ORDER BY ta.abt, $wname";
	elseif ($db == "pdf")
		$query = "SELECT * FROM $db p, pdf_group pg WHERE p.pgid=pg.pgid ORDER BY pg.pgname, $wname";
	elseif ($db == "product")
		$query = "SELECT * FROM $db p, productkat pk, productimg pi WHERE p.prokid=pk.prokid AND p.proid=pi.proid ORDER BY pk.prokbezde, $wname";
	elseif ($db == "morp_haendler")
		$query = "SELECT name1, name2, plz, ort, knr, kid FROM $db ORDER BY knr, $wname";
	else
		$query = "SELECT * FROM $db ORDER BY $wname";

	$result = safe_query($query);

	while ($row = mysqli_fetch_object($result)) {
		if ($row->$wid == $tp) $sel = "selected";
		else $sel = "";

		$nm = $row->$wname;

		if ($db == "termin_liste") 	$nm = $row->abt ." - $nm";
		elseif ($db == "pdf") 		$nm = $row->pgname ." - $nm";
		elseif ($db == "product")	$nm = $row->prokbezde ." - $nm";
		elseif ($db == "morp_haendler") $nm = $row->knr .", ". $row->name1 .", ". $row->plz." ". $row->ort;
		$pd .= "<option value=\"" .$row->$wid ."\" $sel>$nm</option>\n";
	}
	return $pd;
}

function pdfname($pid) {
	$que  = "SELECT * FROM pdf WHERE pid=$pid";
	$res = safe_query($que);
	$row = mysqli_fetch_object($res);
	return $row->pname;
}

global $navarray;

if (!$sprache = $_REQUEST["sprache"]) {
	if (!$sprache = $_SESSION["sprache"]) $sprache = "1";
}
$_SESSION["sprache"] = $sprache;

/*
if ($_REQUEST["sprache"]) {
	$sprache = $_REQUEST["sprache"];
	$_SESSION["sprache"] = $sprache;
}
*/
include("cms_include.inc");

$ngid = $_REQUEST["ngid"];
if (!$ngid) $db   = "news_group";
else 		$db   = "news";

$edit 	= $_REQUEST["edit"];
$save 	= $_REQUEST["save"];
$neu  	= $_REQUEST["neu"];
$del  	= $_REQUEST["del"];
$del_ 	= $_REQUEST["del_"];

$delpdf = $_REQUEST["delpdf"];
$delimg = $_REQUEST["delimg"];
$dellnk = $_REQUEST["dellnk"];
$vis	= $_REQUEST["vis"];
$thid  	= $_REQUEST["thid"];

echo "<div id=content_big>";

# print_r($_REQUEST);

if ($del) {
	echo '<p>&nbsp;</p><p><font color=#ff0000><b>Sind Sie sich sicher, dass sie den Datensatz l&ouml;schen wollen?</b></font></p>
		<p>&nbsp; &nbsp; &nbsp; <a href="news.php?del_=' .$del .'&ngid=' .$ngid .'">Ja</a> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <a href="news.php?ngid=' .$ngid .'">Nein</a></p></body></html>';
	die();
}

elseif ($thid) {
	$query 	 = "UPDATE news SET sichtbar=$vis WHERE nid='$thid'";
	safe_query($query);
}

elseif ($del_) {
	$query = "SELECT * FROM news WHERE nid=$del_";
	$result = safe_query($query);
	$row = mysqli_fetch_object($result);
 	$ti = $row->ntitle;

	$query = "delete from news WHERE nid=$del_";
	$result = safe_query($query);

	$query_ = "INSERT `delete` SET descr='News \"$ti\" l&ouml;schen <br>benutzer: $user_name', `query`='$query'";
	safe_query($query_);
}

elseif ($delimg) {
	$todel = "img".$delimg;
	$query = "UPDATE news SET $todel='', edit=1 WHERE nid=$edit";
	$result = safe_query($query);
}

elseif ($delpdf) {
	$query = "UPDATE news SET pid='', edit=1 WHERE nid=$delpdf";
	$result = safe_query($query);
}

elseif ($dellnk) {
	$query = "UPDATE news SET nlink='', edit=1 WHERE nid=$dellnk";
	$result = safe_query($query);
}

elseif ($save && $ngid) {
	$ntitle 	= $_POST["ntitle"];
	$nsubtitle 	= addslashes($_POST["nsubtitle"]);
	$nlink		= $_POST["nlink"];
	$pid		= $_POST["pid"];
	$ntext 		= addslashes($_POST["ntext"]);
	$format		= $_POST["format"];
	$naut 		= $_POST["nautor"];
	$nabstr		= addslashes($_POST["nabstr"]);
	if (!$style	= $_POST["style"]) $style = 1;
	$nerstellt 	= us_dat($_POST["nerstellt"]);
	$nvon 		= us_dat($_POST["nvon"]);
	$nbis 		= us_dat($_POST["nbis"]);
	$hid 		= $_POST["hid"];
	$sichtbar	= $_POST["sichtbar"];
	if ($sichtbar) $sichtbar = 1;
	else $sichtbar = 0;

	if ($nabstr == "") {
		$na = explode(" ", $ntext);
		for($i=0; $i<25;$i++) {
			$nabstr .= $na[$i]." ";
		}
	}

	$set = "ntitle='$ntitle', nvon='$nvon', nbis='$nbis', hid='$hid', nlink='$nlink', nsubtitle='$nsubtitle', nabstr='$nabstr', nerstellt='$nerstellt', sichtbar=$sichtbar, ngid=$ngid, pid='$pid', nautor='$naut', style='$style'";
	# $set = "ntitle='$ntitle', nlink='$nlink', nsubtitle='$nsubtitle', nabstr='$nabstr', nerstellt='$nerstellt', aktuell=$aktuell, ngid=$ngid, pid='$pid', nautor='$naut', style='$style'";
	if ($format <= 3) $set .= ", ntext='$ntext'";

	if (!$neu) 	$query = "UPDATE `news` SET $set, edit=1 WHERE `nid`=$edit";
	else  		$query = "INSERT news SET $set";

	$result = safe_query($query);

	if (!$neu) {
		protokoll($uid, "news", $edit, "edit");
//		unset($edit);
	}
	else {
		$c = mysqli_insert_id($mylink);
		protokoll($uid, "news", $c, "neu");
		$edit = $c;
		unset($neu);
	}
}

elseif ($save) {
	$ngname = $_POST["ngname"];
	$format	= $_POST["format"];
	$nlang	= $_POST["nlang"];

	$set 	= "ngname='$ngname', format='$format', nlang='$nlang'";

	if (!$neu) $query = "UPDATE `news_group` SET $set, edit=1 WHERE `ngid`=$edit";
	else {
		$query = "INSERT news_group SET $set";
		unset($neu);
	}
	$result = safe_query($query);
	unset($edit);

	#dbconnect_live();
	#$result = safe_query($query);
	#dbconnect();

	# $edit = 0; # loeschen, falls nach speichern das formular stehen bleiben soll
}

# # # News wird erstellt oder editiert, nachdem Gruppe ausgewaehlt wurde
# # # es werden unterschiedliche Zusammenstellungen unterstuetzt. Bsp.: Mit Image (bis zu 4), interne/externe Links, Abstract
# # # UND NEU mit Pflege ueber das Content_Edit Modul (z.Zt. Format = 3)
if (($edit || $neu) && $ngid) {
	echo "<a href='news.php?ngid=$ngid'><i class=\"fa small fa-chevron-left\"></i> zur&uuml;ck</a><p>";

	if (!$neu) {
		$query = "SELECT * FROM news n, news_group ng WHERE n.nid=$edit AND n.ngid=ng.ngid";
		$result = safe_query($query);
		$row = mysqli_fetch_object($result);
	}

	else {
		$query = "SELECT * FROM news_group WHERE ngid=$ngid";
		$result = safe_query($query);
		$row = mysqli_fetch_object($result);
	}

	echo '<form action="news.php?edit='.$edit.'&save=1" method="post">
			<input type="hidden" name=edit value=' .$edit .'>
			<input type="hidden" name=save value=1>';

	if ($neu) {
		echo '<input type="hidden" name=neu value=1>';
		$nerstellt = date(d ."." .m ."." .Y);
		$nbis = date(d ."." .m ."." .Y);
	}
	else {
		$nerstellt = euro_dat($row->nerstellt);
		$nbis = euro_dat($row->nbis);
	}

	if ($row->sichtbar == "1") $sichtbar = "checked";
	else unset($sichtbar);
	// echo $sichtbar;

	$img1 	= $row->img1;
	$img2 	= $row->img2;
	$img3 	= $row->img3;
	$img4 	= $row->img4;

	# Darstellungs Format
	$format	= $row->format;
	echo '<input type="hidden" name=format value="'.$format.'">';

	$style 		= $row->style;
	$checked 	= "style_".$style;
	$$checked 	= 'checked';

	$imgid 	= $row->imgid;
	$pid 	= $row->pid;
	$nlink 	= $row->nlink;

	if (!$nlink) $bittew = "internen link w&auml;hlen";
	else {
		$bittew = "&nbsp;&raquo; internen link &auml;ndern";
		$dellink = ' &nbsp; &nbsp; &nbsp; <a href="news.php?dellnk='.$edit.'&edit='.$edit.'&ngid='.$ngid.'"><i class="fa fa-trash-o"></i>  Link l&ouml;schen</a>';
	}

	if ($link = $_GET["ebene"]) {
		include("../nogo/navarray_".$morpheus["lan_arr"][$row->nlang].".php");
		$nlink = $_GET["cid"];
		$save_warn = 1;
	}
	elseif ($_GET["gid"]) {
		$imgid = $_GET["gid"];
		$save_warn = 1;
	}
	elseif ($_GET["pid"]) {
		$pid = $_GET["pid"];
		$save_warn = 1;
	}

	echo '<table class="table news-size">
		<tr>
			<td colspan="2"><font style="color: #cccccc;">News Format: <strong>'.$morpheus["news_formate"][$format].'</strong></font> &nbsp; &nbsp; <img src="images/'.$morpheus["lan_arr"][$sprache].'.gif" alt="" width="13" height="9" border="0"> &nbsp; &nbsp;
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; sichtbar:	<input type="checkbox" name="sichtbar" value="1" '.$sichtbar.'></td>';
	echo '
		</tr>
		<tr>
			<td width=150>Titel</td>
			<td width=350><input type=text name=ntitle value="' .$row->ntitle .'" style="width:500px; height:20px;"></td>
		</tr>
	';

#	if ($format <= 2 || $format == 6) 	{
	if ($format <= 3) 	{
		echo '<tr>
			<td>';

		if ($format == 3) echo 'Termin';
		elseif ($format == 6) echo 'Subheadline';
		else echo '2. &uuml;berschrift (kein Pfilchtfeld)';

		echo '</td>
			<td><input type=text name=nsubtitle value="' .$row->nsubtitle .'" style="width:500px; background-color:#cccccc; height:20px;"></td>
		</tr>
		';
	}

	if ($format == 1 || $format == 3) 	echo '<tr>
			<td valign=top>'. ($format == 3 ? 'Job Beschreibung' : 'Newstext') .'</td>
			<td><textarea rows=10 style="width:500px" name="ntext">' .$row->ntext .'</textarea></td>
		</tr>
		'. ($format == 3 ? '' : '<tr>
			<td valign=top></td>
			<td>&lt;b&gt;text&lt;/b&gt;  <strong>text</strong><br>
			&lt;i&gt;text&lt;/i&gt;  <em>text</em><br>
			&lt;u&gt;text&lt;/u&gt;  <u>text</u><br></td>
		</tr>
		');

	if ($format == 2 || $format == 11 || $format == 3) echo '	<tr>
			<td valign=top>'. ($format == 3 ? 'Kurztext Job' : 'Abstract/Kurzfassung<br>
			<font size="-2"> (wenn Sie dieses Feld freilassen,<br>wird das Abstract automatisch erstellt)') .'</td>
			<td><textarea rows=4 style="width:500px; background-color:silver;" name="nabstr">' .($row->nabstr) .'</textarea></td>
		</tr>
<!-- 		<tr>
			<td>'.$autor_bez.'</td>
			<td><input type=text name=nautor value="' .$row->nautor .'" style="width:500px;"></td>
		</tr> -->
		';

	if ($format == 5 || $format == 6)	echo '<tr>
			<td valign=top></td>
			<td><p style="margin: 20px 0px 20px 0px;"><a href="content_edit.php?db=news&ngid='.$ngid.'&edit='.$edit.'"><i class="fa small fa-plus"></i> editiere <strong>' .$row->ntitle .'</strong> Text</a></p></td>
		</tr>';

	if (!$neu && $format != 5 && $format != 3) echo '<tr>
			<td>Link</td>
			<td><input type=text name=nlink value="' .$nlink .'" style="width:250px"> &nbsp; <a href="link.php?nid='.$edit.'&ngid='.$ngid.'">'  .$bittew .'</a>'.$dellink .'
			<p>Internen Link w&auml;hlen oder externen Link einsetzen</p>
			</td>
		</tr>
		';

	# im moment sind diese features fast alle ausgeblendet. koennen jederzeit aktiviert werden.
	# z.b. von bis fuer zeitliche steuerung der news. oder button, zum aktivieren der news auf
	# speziellen seiten > z.b. hot-news (kombi aus versch. news-gruppen) etc.


	# if ($format <= 2 || $format == 5 || $format == 6) 	{
	if ($format) 	{
		echo '<tr>
			<td>Erstellt</td>
			<td><input type=text name=nerstellt value="' .$nerstellt .'"></td>
		</tr>
		<tr>
			<td valign="top"><p>NEWS GRUPPE &nbsp; (Vorsicht!<br>es <u>k&ouml;nnen</u> Daten verloren gehen)</p></td>
			<td valign="top">';

		$pdf_pd = pulldown ($ngid, "news_group", "ngname", "ngid");
		echo "<p><select name=\"ngid\" style=\"width:250px;\">$pdf_pd</select><br>&nbsp;</p>";
	}
	else echo "<input type=\"Hidden\" name=\"ngid\" value=\"$ngid\">";

	# # # fotos
	# # # image einfuegen. images werden in einem folder in original groesse eingebunden
	if ($save_warn) echo '<p style="color:#FF0000;"><b>Bitte Speichern, sonst gehen die &auml;nderungen verloren!</b></p>';

	echo '<input type=submit style="background-color:#7B1B1B;color:#FFFFFF;font-weight:bold;width:100px;" style="background-color:#7B1B1B;color:#FFFFFF;font-weight:bold;width:100px;" value="speichern" name="speichern"></td>
		</tr>
		<tr>
			<td colspan="2"><table>';

	# # # # # # # # # # # # # # # # # # # # # # fotos anzeigen und link zum uploaden - keine veraenderung des foto. foto muss dem endformat entsprechen
	if ($edit && $format != 1 && $format != 3 && $format != 8 && $format != 6) 	{
		if ($format == 4) $n = 1;
		else $n = 4;

		$arr = array("", "Foto 1", "Foto 2", "Foto 3", "Foto 4");
		for ($i=1; $i<=$n; $i++) {
			$thimage = "img".$i;
			echo '<tr><td width="160">'.$arr[$i].'</td><td><input type=hidden name=img'.$i.' value="' .$$thimage .'"><a href="image_folder_upload.php?nid='.$edit.'&ngid='.$ngid.'&imgid='.$thimage.'&news=1">';

			# foto aus db loeschen. es bleibt aber auf der platte.
			if ($$thimage) echo '<img src="../images/presse/'.$$thimage.'"></a> &nbsp; &nbsp; <a href="news.php?delimg='.$i.'&edit='.$edit.'&ngid='.$ngid.'&news=1"><i class="fa fa-trash-o"></i> </a>';
			else echo '<b>Foto</b>: bitte w&auml;hlen</a>';

			echo '</td></tr>';
		}
	}

	# # in dieser variante wird ein thumbnail und ein bild in einer vorgegebenen groesse erstellt.
	# # vielleicht sollte diese variante demnaechst ausschliesslich verwendet werden, damit kunden
	# # die bilder nciht vorbereiten muessen. die bild-groessen werden ueber die config.inc gesteuert
	# # $morpheus["img_size_news"]	;  $morpheus["img_size_news_tn"]
	elseif ($edit && ($format == 4 || $format == 1)) 	{
		$arr = array("", "Foto", "Foto 2", "Foto 3", "Foto 4");

		for ($i=1; $i<=1; $i++) {
			$thimage = "img".$i;

			echo '<tr><td width="160">'.$arr[$i].'</td><td><input type=hidden name=img'.$i.' value="' .$$thimage .'" style="width:500px"><a href="image_folder_upload.php?nid='.$edit.'&ngid='.$ngid.'&tn='.$morpheus["img_size_news_tn"].'&full='.$morpheus["img_size_news"].'&imgid='.$thimage.'&news=1">';

			# foto aus db loeschen. es bleibt aber auf der platte.
			if ($$thimage) echo '<img src="../images/presse/'.$$thimage.'"></a> &nbsp; &nbsp; <a href="news.php?delimg='.$i.'&edit='.$edit.'&ngid='.$ngid.'&news=1"><i class="fa fa-trash-o"></i> </a>';
			else echo '<b>Foto</b>: bitte w&auml;hlen</a>';

			echo '</td></tr>';
		}
	}

	# http://localhost/peakom/morpheus/image_folder_upload.php?nid=1&ngid=7&tn=120&full=450&imgid=img1&news=1

	elseif ($edit && ($format == 6)) 	{
		$arr = array("", "Foto klein Thumb - Startseite - nur Buch", "Foto gross Mindflash - nur Buch");

		for ($i=1; $i<=2; $i++) {
			$thimage = "img".$i;

			echo '<tr><td width="160">'.$arr[$i].'</td><td><input type=hidden name=img'.$i.' value="' .$$thimage .'" style="width:500px"><a href="image_folder_upload.php?nid='.$edit.'&ngid='.$ngid.'&tn='.$morpheus["img_size_news_tn"].'&full='.$morpheus["img_size_news"].'&imgid='.$thimage.'&news=1">';

			# foto aus db loeschen. es bleibt aber auf der platte.
			if ($$thimage) echo '<img src="../images/presse/'.$$thimage.'"></a> &nbsp; &nbsp; <a href="news.php?delimg='.$i.'&edit='.$edit.'&ngid='.$ngid.'&news=1"><i class="fa fa-trash-o"></i> </a>';
			else echo '<b>Foto</b>: bitte w&auml;hlen</a>';

			echo '<p>&nbsp;</p></td></tr>';
		}
	}

	 # # # # # # # # # # # # # # # # # # # # # # fotos
	 # # # # # # # # # # # # # # # # # # # # # # fotos
	echo '</table>';

	echo '<input type=submit style="background-color:#7B1B1B;color:#FFFFFF;font-weight:bold;width:100px;" style="background-color:#7B1B1B;color:#FFFFFF;font-weight:bold;width:100px;" value="speichern" name="speichern"></td>
		</tr>';
###########################################################

	# # # # pdf download einfuegen
	if (!$neu && $format != 6) echo '<tr bgcolor="#E2E2E2">
			<td>Download-Dok/PDF</td><td><input type=hidden name=pid value="' .$pid .'" style="width:500px"><a href="pdf_select.php?nid='.$edit.'&ngid='.$ngid.'" title=\"Neues Dokument einsetzen\">';

	if ($pid > 0 && !$neu && $format != 6) {
		$pnm = pdfname($pid);
		echo 'neues Dokument/PDF w&auml;hlen</a><p><a href="news.php?delpdf='.$edit.'&edit='.$edit.'&ngid='.$ngid.'"><i class="fa fa-trash-o"></i> <b>'.$pnm.'</b> l&ouml;schen</a></p>
		<p><a href="../pdf/'.$pnm.'" target="_blank"><img src="../images/pdf_.gif" alt="" border="0"> Dokument ansehen</a></p>';
	}
	elseif (!$neu && $format != 6) echo '<b>Download-Dok/PDF</b>: bitte w&auml;hlen</a>';


	echo '</td>
		</tr>
		</table></form>';
}

# # # # NEWS GRUPPE erstellen / editieren
elseif ($edit || $neu) {
	echo "<a href='news.php'><i class=\"fa small fa-chevron-left\"></i> zur&uuml;ck</a><p>";

	if (!$neu) {
		$query 	= "SELECT * FROM news_group WHERE ngid=$edit";
		$result = safe_query($query);
		$row 	= mysqli_fetch_object($result);
	}

	echo '<form method="post"><input type="hidden" name=edit value=' .$edit .'><input type="hidden" name=save value=1>';
	if ($neu) {
		echo '<input type="hidden" name=neu value=1>';
	}

	echo '<table class="autocol p20">
		<tr>
			<td>News-Gruppe Name</td>
			<td><input type=text name=ngname value="' .$row->ngname .'" style="width:500px"></td>
		</tr>
		<tr>
			<td>Text Format<p>&nbsp;</p></td>
			<td>';

	foreach ($morpheus["news_formate"] as $key=>$val) {
		if ($row->format == $key) $chk = " checked";
		else unset($chk);
		echo '<input type="radio" name="format" value="'.$key.'"'.$chk.'> &nbsp;'.$val.'&nbsp; &nbsp; &nbsp;';
	}

	echo '<p>&nbsp;</p></td>
		</tr>
		<tr>
			<td>Sprache</td>
			<td>';

	$lan 	= $row->nlang;
	foreach ($morpheus["lan_arr"] as $key=>$val) {
		if ($key == $lan) 	$chk = " checked";
		else				unset($chk);
		echo '<input type="radio" name="nlang" value="'.$key.'"'.$chk.'> '.$morpheus["lan_nm_arr"][$val].' &nbsp; &nbsp; ';
	}

	echo '</td>
		</tr>
		<tr>
			<td></td>
			<td><input type=submit style="background-color:#7B1B1B;color:#FFFFFF;font-weight:bold;width:100px;" value="speichern" name="speichern"></td>
		</tr>
		</table>';
}

# # # Liste der News nach Auswahl einer Gruppe
elseif ($ngid) {
	$query 	= "SELECT format FROM news_group WHERE ngid=$ngid";
	$result = safe_query($query);
	$row 	= mysqli_fetch_object($result);
	$format = $row->format;

	echo "\n<p class=text><b>News verwalten</b></p>
		<p><a href=\"news.php\"><i class=\"fa small fa-chevron-left\"></i> zur&uuml;ck</a>  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a href='news.php?neu=1&ngid=$ngid'><i class=\"fa small fa-plus\"></i> neue News erstellen</a>
		<table class=\"autocol p20\">
			<tr bgcolor=$bgcolor>
				<td width=200><b>Titel</b></td>
				<td width=280><b>Text</b></td>
				<td width=60><b>Erstellt</b></td>
				<!-- <td width=100><b>G&uuml;ltig</b></td> -->
				<td width=50></td>
			</tr>
	";

	$query 	= "SELECT * FROM news WHERE ngid=$ngid ORDER BY nerstellt desc, nid desc";
	$result = safe_query($query);

	$bgcolor = "#EFECEC";  // tabellen-hintergrundfarbe soll wechseln. erster farbwert wird gesetzt

	###########################################################
	// formular wird jetzt zusammengestellt
	while ($row = mysqli_fetch_object($result))	{
		echo "<tr bgcolor=$bgcolor>
			<td valign=top><p>" .$row->ntitle ."</p></td>
			<td valign=top><p>" .substr($row->ntext, 0, 80) ." ...</p></td>
			<td valign=top><p>" .euro_dat($row->nerstellt) ."</p></td>
			<td valign=top align=\"center\">" .($row->sichtbar ? '<a href="?vis=0&thid='.$row->nid.'&ngid='.$row->ngid.'"><i class="fa  fa-eye"></i></a>' : '<a href="?vis=1&thid='.$row->nid.'&ngid='.$row->ngid.'"><i class="gray fa  fa-eye-slash"></i></a>') ."</td>
			<!-- <td valign=top><p>von: " .euro_dat($row->nvon) ."</p><br>
			bis: " .euro_dat($row->nbis) ."</td> -->
			<td valign=top width=100 align=center><a href='news.php?edit=" .$row->nid ."&ngid=".$row->ngid."'><i class=\"fa fa-pencil-square-o\"></i></a> &nbsp; &nbsp; &nbsp; <a href='news.php?del=" .$row->nid ."&ngid=".$row->ngid."'><i class=\"fa  fa-trash-o\"></i></a></td>
		</tr>
		";

		if ($bgcolor == '#EFECEC') $bgcolor = "#FFFFFF";
		else $bgcolor = '#EFECEC';
	}
	// formular ist fertig
	###########################################################

	echo "</table><br>
		<a href='news.php?neu=1&ngid=$ngid'><i class=\"fa small fa-plus\"></i> neu</a>";
}

# # # NEWS Start - Liste der News Gruppen
else {
	$query 	= "SELECT * FROM $db order by ngname";
	$result = safe_query($query);
	$ct		= 1;

	echo "<p><b>News-Gruppen</b></p>
		<p>&nbsp;</p>
		<table class=\"autocol p20\">\n";

	while ($row = mysqli_fetch_object($result))	{
		$nm = $row->ngname;
		$id = $row->ngid;
		$nl = $row->nlang;

		echo '<tr bgcolor="'.$morpheus["col"][$ct].'">
		<td width="300"><p> &nbsp; '.$nm.'</p></td>
		<td width="100" align="center"><p><a href="news.php?edit='.$id.'"><i class="fa fa-cogs"></i> </a></p></td>
		<td width="100" align="center"><p><a href="news.php?ngid='.$id.'&sprache='.$nl.'"><i class="fa fa-pencil-square-o"></i> </a></p></td>
	</tr>';

		if ($ct == 0) $ct = 1;		//farbendefenition
		else $ct = 0;
	}

	echo "</table><p>&nbsp;</p><p><a href=\"news.php?neu=1\"><i class=\"fa small fa-plus\"></i> NEU</a></p>";
}

?>

</div>

<?
include("footer.php");
?>