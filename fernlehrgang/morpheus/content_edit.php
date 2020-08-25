<?php
# print_r($_SESSION);
# # # # # # # # # # # # # # # # # # # # # # # # # # #
# www.pixel-dusche.de                               #
# bj&ouml;rn t. knetter                                  #
# start 12/2003                                     #
# edit 27.11.2006                                   #
# post@pixel-dusche.de                              #
# frankfurt am main, germany                        #
# # # # # # # # # # # # # # # # # # # # # # # # # # #
session_start();

//error_reporting(E_ALL);
# # # # # # # # # # # # # # # # # # # # # # # # # # #
# # # sprache ermitteln
# # # # # # # # # # # # # # # # # # # # # # # # # # #
global $navarray, $sprache, $morpheus;
# print_r($_REQUEST);


if (!isset($_SESSION["sprache"])) $_SESSION["sprache"] = 1;
$sprache = $_SESSION["sprache"];

$img_pfad = "../images/userfiles/image/";

# # # # # # # # # # # # # # # # # # # # # # # # # # #
# # # _sprache
# # # # # # # # # # # # # # # # # # # # # # # # # # #

if ($_REQUEST["back"]) {
	$back = $_REQUEST["back"];
	$_SESSION["back"] = $back;
}
$back = $_SESSION["back"];
$templ = $_SESSION["templ"];

# # # # # # # # # # # # # # # # # # # # # # # # # # #
# # # _sprache
# # # # # # # # # # # # # # # # # # # # # # # # # # #

# # # # # # # # # # # # # # # # # # # # # # # # # # #
# formular pull down # # # # # # # # # # # # # # # # # # #
# # # # # # # # # # # # # # # # # # # # # # # # # # #
function pulldown ($tp, $db, $wname, $wid, $mf=0) {
	if ($db == "termin_liste")
		$query = "SELECT * FROM $db tl, termin_abt ta WHERE ta.taid=tl.taid ORDER BY ta.abt, $wname";
	elseif ($mf == 2)
		$query = "SELECT * FROM $db p, pdf_group g WHERE p.pgid=g.pgid AND p.pgid=$mf ORDER BY pname";
	elseif ($db == "pdf")
		$query = "SELECT * FROM $db p, pdf_group pg WHERE p.pgid=pg.pgid AND pgart=1 ORDER BY pg.pgname, $wname";
	elseif ($db == "product")
		$query = "SELECT * FROM $db p, productkat pk, productimg pi, productwg wg WHERE wg.prokid=pk.prokid AND p.proid=pi.proid AND p.proid=wg.proid GROUP by p.proid ORDER BY pk.prokbezde, $wname";
	elseif ($db == "produkt")
		$query = "SELECT * FROM $db p, morp_produkt_wg wg WHERE p.wid=wg.wid ";
	elseif ($mf)
		$query = "SELECT * FROM $db WHERE 1 ORDER BY ngid, nerstellt DESC, $wname";
	elseif ($db == "nav")
		$query = "SELECT * FROM $db WHERE 1 ORDER BY parent, $wname";
	else
		$query = "SELECT * FROM $db ORDER BY $wname";

	$result = safe_query($query);

	if ($db == "morp_shop_wg") $pd .= '<option value="0">alle</option>';

	while ($row = mysqli_fetch_object($result)) {
		if ($row->$wid == $tp) $sel = "selected";
		else $sel = "";

		$nm = $row->$wname;

		if ($db == "termin_liste") 	$nm = $row->abt ." - $nm";
		elseif ($db == "pdf") 		$nm = $row->pgname ." - $nm";
		elseif ($db == "product")	$nm = $row->prokbezde ." - $nm";
		elseif ($db == "produkt")	$nm = $row->wg_name ." - $nm";
		elseif ($db == "nav")	{
			$sql = "SELECT name FROM nav WHERE navid=".$row->parent;
			$res = safe_query($sql);
			$rw = mysqli_fetch_object($res);
			$nm = $rw->name ." - $nm";
		}

		$pd .= "<option value=\"" .$row->$wid ."\" $sel>$nm</option>\n";
	}
	return $pd;
}

function vorlage ($id) {
	$query = "SELECT vorl_name, cid FROM content WHERE vorlage=1 ORDER BY vorl_name";
	$result = safe_query($query);
	$pd = '<option value="0">bitte wählen</option>';

	while ($row = mysqli_fetch_object($result)) {
		if ($row->cid == $id) $sel = "selected";
		else $sel = "";

		$nm = $row->vorl_name;
		$pd .= "<option value=\"" .$row->cid ."\" $sel>$nm</option>\n";
	}
	return $pd;
}

function get_pdf($id) {
	// dbconnect_live();
	$query = "SELECT * FROM pdf WHERE pid=$id";
	$result = safe_query($query);
	$row = mysqli_fetch_object($result);
	return $row->pname;
	dbconnect();
}
# # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # #
# # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # #
$fckedit= $_REQUEST["fckedit"];
if ($fckedit) $box = 1;

include("cms_include.inc");
include("../nogo/navarray_".$morpheus["lan_arr"][$sprache].".php");

# # # # # # # # # # # # # # # # # # # # # # # # # # #
# # # # # # # # # # # # # # # # # # # # # # # # # # #

echo '<form name="check">
	<input type="hidden" name="check" value="">
</form>

<div id="vorschau" style="border-bottom:none;">
';

# print_r($_REQUEST);

$hoehe 		= $_SESSION["hoehe"];
if (!$hoehe) $hoehe = 4;

if ($_GET["navid"]) {
	$navid = $_GET["navid"];
	$_SESSION["navid"] = $navid;
}
else $navid = $_SESSION["navid"];


$cont 	= "content";
$db 	= $_REQUEST["db"];	# als $table definieren
$del	= $_GET["del"];
$edit	= $_REQUEST["edit"];
$change	= $_REQUEST["change"];
$split	= $_REQUEST["split"];
$save	= $_REQUEST["save"];
$sort	= $_REQUEST["sort"];
$stelle = $_REQUEST["stelle"];
$dupl	= $_REQUEST["duplizieren"];
$brick  = $_REQUEST["brickname"];
$vorlage= $_REQUEST["vorlage"];


if ($_POST["hoehe"]) {
	$hoehe 				= $_POST["hoehe"];
	$save				=1;
	$_SESSION["hoehe"] 	= $hoehe;
}


# # # # # # auswertung tabelle
$tab	= $_REQUEST["tab"];

# # # # # # linkwahl
$link	= $_REQUEST["link"];
$pos	= $_REQUEST["pos"];
$cid 	= $_REQUEST["cid"];
$p2 	= $_REQUEST["p2"];
$p3 	= $_REQUEST["p3"];
$p4 	= $_REQUEST["p4"];
$p5 	= $_REQUEST["p5"];
# # # # # # # # # # # # # # #

if ($db == "newsletter" || $_GET["target"] == "newsletter") {
	$getid 	 = "nlid";
	$link  	 = "newsletter.php";
	$cont 	 = "text";
	$db 	 = "newsletter";
}
elseif (!$db || $db == "content") {
	$db		 = "content";
	$getid 	 = "cid";
	if ($vorlage || $templ) 	$link = "template.php";
	else 			$link = "content.php?edit=$navid";
}
elseif ($db == "template") {
	$getid 	 = "tid";
	$link  	 = "template.php";
}
elseif ($db == "news") {
	$getid 	 = "nid";
	$link  	 = "news.php?edit=$edit&navid=$navid&ngid=".$_REQUEST["ngid"];
	$cont 	 = "ntext";
	$ngid	 = $_REQUEST["ngid"];
}
elseif ($db == "productkat") {
	$getid 	 = "prokid";
	$cont 	 = "c_". ($sprache == 1 ? "de" : "en");
	$link  	 = "shop_wg.php";
}

### diese variable ist gefuellt, wenn der link von image_list kommt, also ein image eingefuegt wird
$imgid 	= $_REQUEST["imgid"];
$imglnk = $_REQUEST["imglnk"];
$pid 	= $_REQUEST["pid"];
$art	= $_REQUEST["art"];

# # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # #
# # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # #
# # # # # # # !!!!!!!!!!! navigationsname einsetzen
if ($db == "content") {
	$query = "SELECT * FROM nav WHERE navid='$navid'";
	$result = safe_query($query);
	$row = mysqli_fetch_object($result);
	$ort = $row->name;
}
# # # # # # # !!!!!!!!!!! # # # # # # # !!!!!!!!!!!
# # # # # # # !!!!!!!!!!! immer ueberpruefen. kann von kunde zu kunde variieren
$query 	= "SELECT tid FROM content WHERE cid='$edit'";
$result = safe_query($query);
$row 	= mysqli_fetch_object($result);
$tid 	= $row->tid;
# # # # # # # !!!!!!!!!!! # # # # # # # !!!!!!!!!!! # # # # # # # !!!!!!!!!!!
# # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # #
# # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # #

if ($link) {
	if ($_GET["galery"]) $setlink = "galery=$cid";
	else {
		$setlink = "$cid";
/*
		$setlink = "cid=$cid&p2=$p2";
		if ($p3) $setlink .= "&p3=$p3";
		if ($p4) $setlink .= "&p4=$p4";
		if ($p5) $setlink .= "&p5=$p5";
		#$edit = $link;
*/
	}
}

if ($cid && ($pos == "all" || $pos == "de") && $db == "content") {
	# echo "import!!!! $cid $edit";
	$query 	= "SELECT * FROM $db WHERE $getid='$cid'";
	$result = safe_query($query);
	$row 	= mysqli_fetch_object($result);

	// if ($pos == "all") 	$lang_wahl = "c_".$lang;
	// else				$lang_wahl = "c_de";

	$lang_wahl = "content";

	$text 	= addslashes($row->$lang_wahl);
	if ($pos == "all") 	$query = "update $db set $lang_wahl='$text', edit=1 where $getid='$edit'";
	else				$query = "update $db set c_en='$text', edit=1 where $getid='$edit'";
	$result = safe_query($query);
}

elseif ($cid && $pos == "all" && $db == "newsletter") {
	# echo "import!!!! $cid $edit";
	$query 	= "SELECT * FROM content WHERE cid='$cid'";
	$result = safe_query($query);
	$row 	= mysqli_fetch_object($result);
	$text 	= addslashes($row->content);
	$query 	= "update newsletter set text='$text' WHERE $getid='$edit'";
	$result = safe_query($query);
}

if ($sort) {
	$query 	= "SELECT * FROM $db WHERE $getid='$edit'";
	$result = safe_query($query);
	$row 	= mysqli_fetch_object($result);
	$text 	= $row->$cont;
	$text 	= explode("##", $text);

	$bA = $text[($stelle-1)]; 	// brick A an position stelle-1 auslesen - weil array bei 0 beginnt
	$bB = $text[($sort-1)]; 	// brick B an position sort-1 auslesen
	$text[($stelle-1)] = $bB;	// brick B an neuer pos einsetzen
	$text[($sort-1)] = $bA;		// brick A an neuer pos einsetzen

	if ($val) $text = implode("##", $text);

	$set 	= "set $cont='".addslashes($text)."', edit=1 ";
	$query 	= "update $db " .$set ."where $getid=$edit";
	$result = safe_query($query);
}

elseif ($change) {
	$query 	= "SELECT * FROM $db WHERE $getid='$change'";
	$result = safe_query($query);
	$row 	= mysqli_fetch_object($result);
	$text 	= $row->$cont;
	$text 	= explode("##", $text);
	$br_  	= explode(".", $brick);

	$bA 	= $text[$stelle-1]; 		// brick stelle auslesen
	$bA 	= explode("@@", $bA);
	$bA[0] 	= $br_[0];
	$bA 	= implode("@@", $bA);

	$text[$stelle-1] = $bA;	// brick B an neuer pos einsetzen

	$text 	= implode("##", $text);

	$set 	= "set ".$cont."='".addslashes($text)."', edit=1 ";
	$query 	= "update $db " .$set ."where $getid=$change";
	$result = safe_query($query);
}

elseif ($save) {
	$x 		= 0;
	$brick_arr = array();


	foreach($_POST as $key=>$val) {
		$key = explode("#", $key);

		# if ($key[1]) $show .= "$key[0] - $key[1] - $key[2] - $val<br>";
		# if (isin("bild", $key[1])) $show .= "$key[0] - $key[1] - $key[2] - $val<br>";
		if ($key[0] == "brick") {
			if ((preg_match("/link_/", $key[1]) || preg_match("/image_popup/", $key[1]) || preg_match("/anker_link/", $key[1]) || preg_match("/gleicher/", $key[1])) && !preg_match("/linksbuendig/", $key[1]) && !preg_match("/download/", $key[1]) && !preg_match("/TOP/", $key[1]) && !$linktext)
				$linktext = $val ."|";

			else {
				if ($linktext) {
					$linktext .= $val;
					$tmp = explode("_", $key[2]);
					$key[2] = $tmp[0];
					$val = addslashes($linktext);
				}
				$x++;

				# $show .= "$brick -- $x - $stelle: $key[0] - $key[1] - $key[2] - $val ::: $dupl<br>";

				if ($dupl == $x)  {
					$tb = explode(".", $brick);
					$brick_arr[$key[2]] =  $key[1] ."@@" .addslashes($val) ."##". $key[1] ."@@" .addslashes($val) ."##";  // neuer datensatz wird eingefuegt
					// echo "<p>datensatz wird dupliziert</p>";
				}
				elseif ($brick && $stelle == $x)  {
					$tb = explode(".", $brick);
					$brick_arr[$key[2]] = $tb[0] ."@@" ."##" .$key[1] ."@@" .addslashes($val) ."##";  // neuer datensatz wird eingefuegt
					# echo "<p>neuer datensatz wird eingefuegt</p>";
				}
				else	{
					# $show .= "$key[0] - $key[1] - $key[2] - $val<br>";
					$brick_arr[$key[2]] = $key[1] ."@@" .addslashes($val) ."##";		  //
				}

				if ($linktext) unset($linktext);
			}
		}
	}
	// wenn ein brick hinten angefuegt wird
	# print_r($brick_arr);
	if ($brick && $stelle > $x) {
		$tb = explode(".", $brick);
		$brick_arr[] = $tb[0] ."@@";
	}

	if (count($brick_arr) < 1 && $brick) $brick_arr[] = $brick ."@@";

	foreach($brick_arr as $key=>$val) {
		if ($val) $text .= $val;
	}

	$text = $text;

	if (!$layout = $_POST["layout"]) $layout = 1;
	if ($db != "news" && $db != "productkat") 	$set = "set ".$cont."='$text', edit=1, layout='$layout' ";
	else										$set = "set ".$cont."='$text', edit=1 ";

	if ($edit) 	$query = "update $db " .$set ."where $getid=$edit";
	else 		$query = "insert $db " .$set;

	# echo "$query<br>";
	$result = safe_query($query);
	$c = mysqli_insert_id($mylink);

	if ($edit) 	protokoll($uid, $db, $edit, "edit");
	else 		protokoll($uid, $db, $c, "neu");

	if (!$edit) {
		echo "<p><strong>Check</strong> Zeile 213 in content_edit.php</p>";
		$query 	= "SELECT * FROM $db WHERE descr='$descr'";
		$result = safe_query($query);
		$row 	= mysqli_fetch_object($result);
		$edit 	= $row->edit;
	}
}
# # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # #
# # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # #

if ($split) {
	$query 		= "SELECT * FROM $db WHERE $getid='$edit'";
	$result 	= safe_query($query);
	$row 		= mysqli_fetch_object($result);
	$text 		= $row->$cont;
	$text_brick = "t".$tid."__fliesstext";

	if (preg_match("/<s>/", $text)) 	$text = explode("<s>", $text);
	else 								$text = explode("&lt;s&gt;", $text);

	$n			= count($text);
	$x			= 0;

	foreach ($text as $val) {
		$x++;
		$text_				.= addslashes($val);
		if ($x < $n) $text_ .= "##$text_brick@@";
	}

	$set 	= "set $cont='$text_', edit=1 ";
	$query 	= "update $db " .$set ."where $getid=$edit";
	$result = safe_query($query);
}

# # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # #
# # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # #
if ($edit || $del) {
	if ($db != "content") $query  = "SELECT * FROM $db WHERE $getid=$edit";
	else $query  = "SELECT * FROM content LEFT JOIN z_protokoll On content.cid=z_protokoll.id
					WHERE
						content.cid=$edit
					ORDER BY
						z_protokoll.prid DESC
						";

	# $query  = "SELECT * FROM $db WHERE $getid=$edit";
	$result = safe_query($query);
	$row 	= mysqli_fetch_object($result);
	$text 	= $row->$cont;
	$descr 	= $row->descr;
	$user	= $row->uid;
	$tid 	= $row->tid;
	if ($db == "template") $tid = "99";

# # ________________________________________________________________________________________________________________________________
# # diese komplexen abfragen muessen nochmal ueberdacht und ueberarbeitet werden - diese logiken sind sehr alt...
	# user auslesen
	if ($user) {
		$que  	= "SELECT * FROM user WHERE uid=$user";
		$res 	= safe_query($que);
		$reihe 	= mysqli_fetch_object($res);
		$unm	= $reihe->uname;
	}

	# # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # #
	# # es werden mehrere textlayouts unterstuetzt
/*	$layout = $row->layout;

	$layout_bez = $morpheus["layout"];

	foreach($layout_bez as $i=>$val) {
		$radio .= $val.' <input type="radio" name="layout" style="background-color:#dddddd;" border=0 value="'.$i.'"';
		if ($layout == $i) $radio .= ' checked';
		$radio .= '> &nbsp; &nbsp; &nbsp;';
	}
*/	# # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # #
	# # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # #

# # ________________________________________________________________________________________________________________________________
# # diese komplexen abfragen muessen nochmal ueberdacht und ueberarbeitet werden - diese logiken sind sehr alt...
	# # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # #
	# # textboxen zusammenstellen und anzahl feststellen
	$text_ 	 = explode("##", $text);
	$counter = 0;
	$arr_ct	 = (count($text_) -1);
	$zuruck  = "content_edit.php?edit=$edit&navid=$navid&db=$db&back=$back&sprache=$sprache";

	foreach ($text_ as $val) {
		if ($val) {
			$counter++;

			if ($counter) $textbox .= "<a name=".($counter)."></a>";

			if ($counter == $stelle && $del)
				$textbox .= "<p style=\"background-color:#ff0000; height: 30px; line-height: 30px; margin: 30px 0px 30px 0px;\"><font color=#ffffff size=-1 face=Tahoma> &nbsp; &nbsp; <a href=\"$zuruck\">< abbrechen</a>  &nbsp; ".$MORPTEXT["CONE-LOSCHEN"]."</font>&nbsp; &nbsp;
					<input type=\"hidden\" name=\"stelle\" value=\"$counter\"><input type=submit style=\"background-color:#CCCCCC; color:#000000; width:100px; border:solid 1px #7B1B1B; margin: 3px 0px 0px 0px;\" name=erstellen value=\"speichern $counter\"></p>";

			elseif (($counter == $stelle && $imgid) || ($counter == $stelle && $imglnk))    # nachdem ein bild ausgewaehlt wurde, dieses mit speichern best&auml;tigen
				{
					if (!$imglnk) $tmp = $art."#" .$counter ."\"";
					else {
						$val = explode("@@", $val);
						# print_r($val);
						$tmp = $val[0]."#" .$counter ."_a\"";;

						$txt   	= $val[1];
						$txt	= explode("|", $txt);
						if (!$pid) $txt	= $txt[1];
						else $imgid		= $txt[0];
					}

					$imgname = get_img($imgid);
					$textbox .= "\n\n<p><img src=\"".$img_pfad.$imgname."\" border=0>
						<input type=\"hidden\" name=\"brick#".$tmp;
					$textbox .= " value=\"$imgid\"><br>
						<p style=\"background-color:#ff0000; height: 30px; line-height: 30px; margin: 0px 0px 30px 0px; color: #ffffff;\"> &nbsp; ".$MORPTEXT["CONE-BILDUP"]."</font> &nbsp; &nbsp;
						<input type=\"hidden\" name=\"stelle\" value=\"$counter\"><input type=submit style=\"background-color:#CCCCCC; color:#000000; width:100px; border:solid 1px #7B1B1B;\" name=\"erstellen\" value=\"".$MORPTEXT["GLOB-SPEICHERN"]." $counter\"></p>";

					if ($imglnk) {
						if (!$pid) $txt = $txt;
						else $txt = $pid;
						$textbox .= "<input type=hidden name=\"brick#".$val[0]."#" .$counter ."_b\" value=\"$txt\">";
					}
				}

			elseif ($counter == $stelle && $pid)    {  # nachdem ein pdf ausgewaehlt wurde, dieses mit speichern best&auml;tigen
				$val = explode("@@", $val);
				$brick = $val[0];
				$brick = explode(".", $brick);
				$textbox .= "\n\n<p><input type=hidden name=\"brick#".$brick[0]."#" .$counter ."\" value=\"$pid\"><b>".get_pdf($pid)."</b> <font color=#ff0000 size=-1 face=Tahoma> &nbsp;".$MORPTEXT["CONE-DOWNLOAD"]."</font> &nbsp; &nbsp;
					<input type=submit style=\"background-color:#CCCCCC;color:#FFFFFF;font-weight:bold;width:100px; border:solid 1px #7B1B1B;\" name=erstellen value=speichern style=\"width:70;background-color:#BBBBBB;\"></p>";
			}
			else {
				$val 		= explode("@@", $val);
				$brickname 	= $val[0];
				$txt   		= $val[1];

				$brick 		= explode(".", $brickname);
				unset($image);

				$b_chk = explode("_", $brick[0]);
				unset($tmp);
				for($n=1; $n < count($b_chk); $n++) {
					$tmp .= $b_chk[$n]." ";
				}
				$b_chk = $tmp;
				trim($b_chk);
				###########################################################

# # ________________________________________________________________________________________________________________________________
# # per b_chk wird die art der textbox erkannt und zugewiesen
# # $b_chk enthaelt den namen des brick = name der php-vorlage aus dem ordner bricks

				$colour = "#fff";
				$bgcolor = "";

				if (preg_match("/galerie/", $b_chk)) 									$galerie = 1;
				elseif (preg_match("/texteditor/", $b_chk)) 							$fck = 1;
				elseif (preg_match("/formular/", $b_chk)) 								$insert_form = 1;
				elseif (preg_match("/bild ordner/", $b_chk)) 							$insert_img_folder = 1;
				elseif (preg_match("/bild/", $b_chk) || preg_match("/grafik/", $b_chk)) 		$image = 1;
				elseif (preg_match("/umbruch/", $b_chk) || preg_match("/sitemap/", $b_chk) ||
					preg_match("/^kunden/", $b_chk) || preg_match("/^spalte/", $b_chk) ||
					preg_match("/stellenangebote/", $b_chk) ||
					preg_match("/pfeil/", $b_chk) ||
					preg_match("/veranstaltungen/", $b_chk) ||
					preg_match("/^filialen/", $b_chk) ||
					preg_match("/textfluss/", $b_chk) ||
					preg_match("/linie/", $b_chk) ||
					preg_match("/ende/", $b_chk) ||
					preg_match("/end/", $b_chk) ||
					preg_match("/start/", $b_chk) ||
					preg_match("/trenner/", $b_chk)
				)		 							{ $umbruch = 1; $bgcolor = "#777777"; }

				elseif (preg_match("/menu/", $b_chk)) 									$insert_menu = 1;
				elseif (preg_match("/anwendung/", $b_chk)) 								$insert_anwendung = 1;
				elseif (preg_match("/^ icon/", $b_chk)) 								$insert_icon = 1;
				elseif (preg_match("/warengruppe/", $b_chk)) 							$insert_warengruppe = 1;
				elseif (preg_match("/produkt/", $b_chk)) 								$insert_prod = 1;
				elseif (preg_match("/image link/", $b_chk)) 							$insert_imagelink = 1;
				elseif (preg_match("/image popup/", $b_chk)) 							$insert_imagelink = 2;
#				elseif (preg_match("/presse/", $b_chk)) 								$insert_presse = 1;
				elseif (preg_match("/link/", $b_chk) || preg_match("/gleicher/", $b_chk)) 	$insert_link = 1;
				elseif (preg_match("/download/", $b_chk) || preg_match("/^uploaded/", $b_chk))	$insert_pdf = 1;
				elseif (preg_match("/kompetenz/", $b_chk)) 								$insert_loesung = 1;
				elseif (preg_match("/kunde/", $b_chk)) 									$insert_kunde = 1;
				elseif (preg_match("/farbe/", $b_chk)) 									$insert_farbe = 1;
				elseif (preg_match("/branche/", $b_chk)) 								$insert_branche = 1;
				elseif (preg_match("/mindflash/", $b_chk)) 								$insert_mindflash = 1;
				elseif (preg_match("/video/", $b_chk)) 									$insert_video = 1;
				elseif (isin("stimmen land", $b_chk)) 									$insert_land = 1;
				elseif (preg_match("/termin/", $b_chk)) 								$insert_termin = 1;
				elseif (preg_match("/objekt/", $b_chk)) 								$insert_objekt = 1;
				elseif (preg_match("/template/", $b_chk)) 								$insert_templ = 1;
				elseif (preg_match("/tabelle/", $b_chk)) 								$insert_tab = 1;
				elseif (preg_match("/news/", $b_chk) || preg_match("/faq/", $b_chk)) 	$insert_news = 1;

				elseif (preg_match("/vorlage/", $b_chk))								$insert_vorlage = 1;
				elseif (preg_match("/^vorlage/", $b_chk) || preg_match("/^headline/", $b_chk))$row = 2.5;
				elseif (preg_match("/^abstand/", $b_chk)) 								$insert_text = 1;
				elseif (preg_match("/html/", $b_chk)) 								$row = 10;
				elseif (preg_match("/text/", $b_chk) || preg_match("/aufzaehlung/", $b_chk)) 	$row = $hoehe;
				else $row = 1.5;

				# # headline und subheadline werden mit groesseren typo size dargestellt
				if (preg_match("/^headline/", $b_chk))			$colour = "#ffffff; font-size: 13px; font-weight: bold;";
				elseif (preg_match("/^sub/", $b_chk))			$colour = "#ffffff; font-size: 11px; font-weight: bold;";
				elseif (preg_match("/modul/", $b_chk))			$bgcolor = "#999999";

# # ________________________________________________________________________________________________________________________________
# # den abschluss jeder formatvorlage / brick definieren - loeschen, verschieben, etc.

				unset($textbox_abschluss);

				if ($counter > 1)
					$textbox_abschluss .= "<td valign=top  class=\"cl40\" align=center>&nbsp;<a href=\"javascript:check('content_edit.php?db=$db&edit=$edit&navid=$navid&sort=" .($counter-1) ."&stelle=$counter&back=$back');\" name=\"".$MORPTEXT["GLOB-POSO"]."\" title=\"".$MORPTEXT["GLOB-POSO"]."\"><i class=\"fa fa-sort-up\"></i></a> <a href=\"javascript:setdupl('".($counter)."');\"><i class=\"fa fa-plus-circle\"></i></a>";

				else
					$textbox_abschluss .= "<td valign=top width=40 align=center><a href=\"javascript:setdupl('".($counter)."');\"><i class=\"fa fa-plus-circle\"></i></a>&nbsp;";

				$textbox_abschluss .= "&nbsp;<a href=\"javascript:check('content_edit.php?db=$db&edit=$edit&navid=$navid&sort=" .($counter+1) ."&stelle=$counter&back=$back');\" name=\"".$MORPTEXT["GLOB-POSU"]."\" title=\"".$MORPTEXT["GLOB-POSU"]."\"><i class=\"fa fa-sort-desc\"></i></a>";

				if (!$sort && $counter == $stelle) 		$divend = 1;
				elseif ($sort && $counter == $sort) 	$divend = 1;
				else 									unset($divend);

				if ($divend) $textbox .= '
';
# # ________________________________________________________________________________________________________________________________

				if ($image) {
					if (!$txt) $txt = 1;
					$imgname = get_img($txt);
					$size 	 = getimagesize($img_pfad.($imgname));
					$w 		 = $size[0];

					if($w < 600) 	$blob 	 = "<img src=\"".$img_pfad.($imgname)."\" border=1>";
					else 			$blob 	 = "<img src=\"../timthumb.php?src=images/userfiles/image/".urlencode($imgname)."&w=600\" border=1>";

					# $hinweis = " image auswechseln - [".$b_chk ."]";
					$hinweis = $b_chk ;
					$chg_img = "<a href=\"javascript:check('image.php?gid=1&edit=$edit&navid=$navid&vorlage=$vorlage&stelle=$counter&back=$back&db=$db&art=".$brick[0]."');\">";

					$textbox .= "\n<table class=\"c700\">
						<tr>
							<td valign=top class=\"c150\"> &nbsp; " .$counter .".&nbsp; <input type=hidden name=\"brick#" .$brick[0] ."#" .$counter ."\" value=\"$txt\"> ".$hinweis." &nbsp; </td>
							<td align=left>$chg_img";

					$textbox .= $blob ."</a> $textbox_abschluss
					<p><a href=\"javascript:check('content_edit.php?edit=$edit&navid=$navid&del=1&stelle=$counter&back=$back&db=$db')\"><img src=\"images/delete_w.gif\" alt=\"\" border=\"0\"></a></p></td></tr></table>";
					unset($blob);
				}

				elseif ($fck) {
					$textbox .= "<p>

<table bgcolor=\"$bgcolor\">
	<tr>";
					$textbox .= "
		<td class=\"c150\" valign=top> &nbsp; $counter. " .str_replace("_", " ", $b_chk) ." &nbsp; <br>
			<br> &nbsp; <a href=\"content_fckedit.php?cid=$edit&navid=$navid&back=$back&stelle=$counter&db=$db\"><img src=\"images/edit.gif\" width=\"18\" height=\"10\" alt=\"\" border=0></a>
		</font> ";

					if ($fckedit && $counter == $stelle) $txt = ($_POST["FCKeditor1"]);

					$textbox .= "<td><textarea name=\"brick#" .$brick[0] ."#" .$counter ."\" readonly style=\"width:510px;height:1px; background-color:#f2f2f2; border: solid 4px $colour;\" onchange=\"setchange('1');\">". stripslashes($txt) ."</textarea>
					<div id=\"fck\">". $txt ."</div>
					<p style=\"clear:left;\"><a href=\"content_fckedit.php?cid=$edit&navid=$navid&back=$back&stelle=$counter&db=$db\"><img src=\"images/edit.gif\" width=\"18\" height=\"10\" alt=\"\" border=0></a></p>
				</td>

".$textbox_abschluss."
<p style=\"margin: 10px 0px 0px 0px;\"><a href=\"javascript:check('content_edit.php?db=$db&edit=$edit&navid=$navid&del=1&stelle=$counter&back=$back');\" class=del name=\"".$MORPTEXT["CONE-TEXTLOSCHEN"]."\" title=\"".$MORPTEXT["CONE-TEXTLOSCHEN"]."\"><i class=\"fa fa-trash-o\"></i></a></p></td>
</tr></table>
					";

					unset($fck);
				}

				elseif ($insert_vid) {
					if (!$txt) $txt = 0;

					if ($insert_pdf) $hinweis = " ".$MORPTEXT["CONE-DOCWAHL"];
					else $hinweis = " ".$MORPTEXT["CONE-VIDWAHL"];

					$textbox .= "<p>\n\n<table bgcolor=\"$bgcolor\">
						<tr>
							<td class=\"c520\" class='text_verw'> &nbsp; " .$counter .".&nbsp; <input type=hidden name=\"brick#" .$brick[0] ."#" .$counter ."\" value=\"$txt\"> <a href=\"javascript:check('pdf_select.php?cid=$edit&navid=$navid&stelle=$counter&back=$back');\">" .ilink() .$hinweis ."</a></font></td><td width=100><a href=\"javascript:check('content_edit.php?edit=$edit&navid=$navid&del=1&stelle=$counter&back=$back&db=$db');\" class=del><img src=\"images/delete_w.gif\" alt=\"\" border=\"0\"></a></td><td width=100>";

					$nm_pdf = get_pdf($txt);

					$textbox .= $textbox_abschluss;
					$textbox .= "<p style=\"border:solid 1;width:300px;margin:-0 0 0 0;color:gray;\"><b><a name=\"$nm_pdf\" href=\"../pdf/$nm_pdf\" target=\"_blank\" title=\"$nm_pdf\">".$nm_pdf."</a></b></p></td></tr></table>";
					unset($insert_pdf);
					unset($insert_video);
				}


				# # # # # # # # # # # links erstellen
				elseif ($umbruch) {
					unset($umbruch);
					$textbox .= "<p>\n\n<table bgcolor=\"$bgcolor\"><tr>";
					$textbox .= "<td class=\"c150\"> &nbsp; $counter. " .str_replace("_", " ", $b_chk) ."</td><td width=30><a href=\"javascript:check('content_edit.php?db=$db&edit=$edit&navid=$navid&del=1&stelle=$counter&back=$back');\" class=del name=\"".$MORPTEXT["CONE-UMBRUCHLOSCHEN"]."\" title=\"".$MORPTEXT["CONE-UMBRUCHLOSCHEN"]."\"><img src=\"images/delete_w.gif\" alt=\"\" border=\"0\"></a></td>";

					$textbox .= $textbox_abschluss;
					$textbox .= "<input type=Hidden name=\"brick#" .$brick[0] ."#" .$counter ."\" value=umbruch></td></tr></table>\n\n";
				}


				# # # # # # # # # # # links erstellen
				elseif ($insert_link) {
					unset($insert_link);
					$txt = explode("|", $txt);
					$href = $txt[0];
					$txt  = $txt[1];
					$hidden = "hidden";

					# echo $brick[0];

					if ($link && $counter==$pos) $href = $setlink;
					elseif(preg_match("/anker/", $brick[0]) || preg_match("/gleicher/", $brick[0])) $hidden = "text";
					elseif(preg_match("/extern/", $brick[0]) || preg_match("/mail/", $brick[0])) {}
					elseif(!$href) $href = $MORPTEXT["CONE-ZIELWAHL"];

					if(preg_match("/intern/", $brick[0]) || preg_match("/footer/", $brick[0]))
						$holelink = "<a href=\"javascript:check('link.php?edit=$edit&navid=$navid&back=$back&db=$db&pos=$counter');\" style=\"color:#ff0000;\">$href</a>";
					else unset($holelink);

					$textbox .= "<p>\n\n<table bgcolor=\"$bgcolor\"><tr>";
					$textbox .= "<td class=\"c160\"> &nbsp; $counter. " .str_replace("_", " ", $b_chk) ."</td>
						<td class=\"c460\">";

					if (preg_match("/TOP/", $brick[0])) $textbox .= "<input type=Hidden name=\"brick#" .$brick[0] ."#" .$counter ."\" value=anker><input type='text' name=\"brick#" .$brick[0] ."#" .$counter ."\" style=\"width:50px\" value=\"$href\">\n";
					else $textbox .= "<font class='text'> Link: $holelink <input type='$hidden' name=\"brick#" .$brick[0] ."#" .$counter ."_a\" style=\"width:200px\" value=\"$href\"><input type='text' name=\"brick#" .$brick[0] ."#" .$counter ."_a\" style=\"width:150px\" value=\"$href\"> &nbsp; Text: <input type='Text' name=\"brick#" .$brick[0] ."#" .$counter ."_b\" style=\"width:200px\" value=\"$txt\" onchange=\"setchange('1');\">
<td width=40><a href=\"javascript:check('content_edit.php?db=$db&edit=$edit&navid=$navid&del=1&stelle=$counter&back=$back');\" class=del name=\"".$MORPTEXT["CONE-LINKLOSCHEN"]."\" title=\"".$MORPTEXT["CONE-LINKLOSCHEN"]."\"><img src=\"images/delete_w.gif\" alt=\"".$MORPTEXT["CONE-LINKLOSCHEN"]."\" border=\"0\"></a></td>".$textbox_abschluss."</td></tr></table>";
				}



				# # # # # # # # # # # link zu einem Produkt im Shop erstellen # muss nochmal ueberdacht werden
				elseif ($insert_sho) {
					unset($insert_shop);

					$textbox .= "<p>\n\n<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" bgcolor=\"gray\"><tr>";
					$textbox .= "<td class=\"c150\" colspan=2> &nbsp; $counter. " .str_replace("_", " ", $b_chk) ." &nbsp; </td>
					<td width=190><a href=\"javascript:check('shop_produkt_auswahl.php?navid=$edit&navid=$navid&stelle=$counter&back=$back&db=$db&gb=1')\" rel=\"gb_page_center[640]\">".$MORPTEXT["CONE-ARTWAHL"]."</a></td>";
					$textbox .= "<td width=90><input type=\"Hidden\"name=\"brick#" .$brick[0] ."#" .$counter ."\" style=\"width:50px; border: solid 1px gray;\" onchange=\"setchange('1');\" value=\"$txt\"> &nbsp; &nbsp; &nbsp; <a href=\"javascript:check('content_edit.php?db=$db&edit=$edit&navid=$navid&del=1&stelle=$counter&back=$back');\" class=del name=\"".$MORPTEXT["CONE-TEXTLOSCHEN"]."\" title=\"".$MORPTEXT["CONE-TEXTLOSCHEN"]."\"><i class=\"fa fa-trash-o\"></i></a></td>";

					$textbox .= $textbox_abschluss;
					$textbox .= "
					</td></tr></table>";
				}


				# # # # # # # # # # # links erstellen
				elseif ($insert_imagelink) {
					$popup = $insert_imagelink;
					unset($insert_imagelink);
					$txt 	 = explode("|", $txt);
					$imageid = $txt[0];
					$href  	 = $txt[1];
					$hidden  = "hidden";

					if ($link && $counter==$pos) $href = $setlink;
					elseif(preg_match("/extern/", $brick[0])) $hidden = "text";
					elseif(!$href && !$popup) $href = $MORPTEXT["CONE-ZIELWAHL"];

					if(preg_match("/intern/", $brick[0])) $holelink = "<a href=\"javascript:check('link.php?edit=$edit&navid=$navid&back=$back&db=$db&pos=$counter');\">".$MORPTEXT["CONE-LINKSETZEN"]."</a>";
					elseif(preg_match("/pdf/", $brick[0])) {
						if (preg_match("/bitte/", $href)) $href = 1;
						$nm_pdf = get_pdf($href);
						$holelink = "<a href=\"javascript:check('pdf_select.php?cid=$edit&navid=$navid&stelle=$counter&back=$back&imglnk=1');\">" .ilink() ." PDF: " .$hinweis ." $nm_pdf</a>";
					}
					else unset($holelink);

					if($imageid) $imgname = get_img($imageid);

					$textbox .= "<p>\n\n<table class=\"c700\"><tr>";
					$textbox .= "<td class=\"c160\" valign=top> &nbsp; $counter. " .str_replace("_", " ", $b_chk) ."</td>
					<td valign=top><a href=\"javascript:check('image.php?gid=1&edit=$edit&navid=$navid&vorlage=$vorlage&stelle=$counter&back=$back&db=$db&imglnk=1');\"><img src=\"".$img_pfad.$imgname."\"></a><input type='hidden' name=\"brick#" .$brick[0] ."#" .$counter ."_a\" value=\"$imageid\"></td></tr><tr><td valign=top colspan=2>&nbsp; ". ($holelink  ? "Link: $holelink" : 'Text: ') ." <input type='text' name=\"brick#" .$brick[0] ."#" .$counter ."_b\" style=\"width:200px\" value=\"$href\"></td>";

					$textbox .= $textbox_abschluss;
					$textbox .= "<p><a href=\"javascript:check('content_edit.php?db=$db&edit=$edit&navid=$navid&del=1&stelle=$counter&back=$back');\" class=del name=\"".$MORPTEXT["CONE-LINKLOSCHEN"]."\" title=\"".$MORPTEXT["CONE-LINKLOSCHEN"]."\"><img src=\"images/delete_w.gif\" alt=\"".$MORPTEXT["CONE-LINKLOSCHEN"]."\" border=\"0\"></a></p>
					</td>\n</tr></table>\n";
					unset($imageid);
					unset($href);
					$popup = '';
				}


				# # # # # # # # # # # ohne image - nur text
				elseif ($insert_form || $insert_templ || $insert_termin || $insert_news || $insert_loesung || $galerie || $insert_branche || $insert_pdf || $insert_shop || $insert_anwendung || $insert_mindflash || $insert_kunde || $insert_objekt || $insert_presse || $insert_video || $insert_menu || $insert_vorlage || $insert_warengruppe || $insert_land || $insert_farbe || $insert_icon || $insert_prod || $insert_img_folder) {
					if ($insert_form) {
						unset($insert_form);
						$pdf_pd = pulldown ($txt, "form", "fname", "fid");
					}
					elseif ($insert_objekt) {
						unset($insert_objekt);
						$pdf_pd = pulldown ($txt, "morp_immo_objekt", "objekt", "oid");
					}
					elseif ($insert_prod) {
						unset($insert_objekt);
						$pdf_pd = pulldown ($txt, "morp_produkt_wg", "wg_name", "wid");
					}
					elseif ($insert_icon) {
						unset($insert_icon);
						$pdf_pd = pulldown ($txt, "morp_fa", "beschreibung", "faid");
					}
					elseif ($insert_land) {
						unset($insert_land);
						$pdf_pd = pulldown ($txt, "morp_stimmen_land", "land", "id");
					}
					elseif ($insert_farbe) {
						unset($insert_farbe);
						$pdf_pd = pulldown ($txt, "morp_color", "colname", "colid");
					}
					elseif ($insert_vorlage) {
						unset($insert_vorlage);
						$pdf_pd = vorlage($txt);
					}
					elseif ($insert_warengruppe) {
						unset($insert_warengruppe);
						$pdf_pd = pulldown ($txt, "morp_shop_wg", "gruppe", "wid");
					}
					elseif ($insert_menu) {
						unset($insert_menu);
						$pdf_pd = pulldown ($txt, "nav", "name", "navid");
					}
					elseif ($insert_shop) {
						unset($insert_shop);
						$pdf_pd = pulldown ($txt, "morp_shop_prod", "name", "pid");
					}
					elseif ($insert_presse) {
						unset($insert_presse);
						$pdf_pd = pulldown ($txt, "pdf_group", "pgname", "pgid");
					}
					elseif ($insert_img_folder) {
						unset($insert_img_folder);
						$pdf_pd = pulldown ($txt, "img_group", "name", "gid");
					}
					elseif ($insert_kunde) {
						unset($insert_kunde);
						$pdf_pd = pulldown ($txt, "morp_kunde", "beschr", "kid");
					}
					elseif ($insert_mindflash) {
						unset($insert_mindflash);
						$pdf_pd = pulldown ($txt, "news", "ntitle", "nid", 2);
					}
					elseif ($insert_video) {
						unset($insert_video);
						$pdf_pd = pulldown ($txt, "pdf", "pname", "pid", "2");
					}
					elseif ($insert_anwendung) {
						unset($insert_anwendung);
						$pdf_pd = pulldown ($txt, " product_eigenschaft", "pe_de", "peid");
					}
					elseif ($insert_news) {
						unset($insert_news);
						$pdf_pd = pulldown ($txt, "news_group", "ngname", "ngid");
					}
					elseif ($insert_pdf) {
						unset($insert_pdf);
						$pdf_pd = pulldown ($txt, "pdf", "pname", "pid");
					}
					elseif ($insert_branche) {
						unset($insert_branche);
						$pdf_pd = pulldown ($txt, "p_branche", "bname_de", "bid");
					}
					elseif ($insert_loesung) {
						unset($insert_loesung);
						$pdf_pd = pulldown ($txt, "p_loesung", "lname_de", "lid");
					}
					elseif ($insert_termin) {
						unset($insert_termin);
						echo $txt;
						$pdf_pd = pulldown ($txt, "termin_liste", "tname", "tlid");
					}
					elseif ($insert_templ) {
						unset($insert_templ);
						$pdf_pd = pulldown ($txt, "template", "tname", "tid");
					}
					elseif ($galerie) {
						unset($galerie);
						$pdf_pd = pulldown ($txt, "galerie_name", "gnname", "gnid");
					}
					$textbox .= "<p>\n\n<table border=\"0\" cellspacing=\"0\" cellpadding=\"4\" bgcolor=\"#B2B2B2\"><tr>";
					$textbox .= "<td width=200> &nbsp; $counter. " .str_replace("_", " ", $b_chk) ."</td>
					<td><select name=\"brick#" .$brick[0] ."#$counter\" style=\"width:300px;\">$pdf_pd</select> &nbsp; </td>";

					$textbox .= $textbox_abschluss;
					$textbox .= "<a href=\"javascript:check('content_edit.php?db=$db&edit=$edit&navid=$navid&del=1&stelle=$counter&back=$back');\"><img src=\"images/delete_w.gif\" alt=\"".$MORPTEXT["CONE-PDFLOSCHEN"]."\" border=\"0\"></a></p></td></tr></table>\n";
				}


				elseif ($insert_tab) {
					unset($insert_tab);
					if ($tab && $pos == $counter) {
						$lk = "edit=$tab";
						$txt = $tab;
					}
					elseif (!$txt) $lk = "neu=1";
					else $lk = "edit=$txt";

					$textbox .= "<p>\n\n<table border=\"0\" cellspacing=\"0\" cellpadding=\"4\" style=\"background-color:#a4c3e0;\"><tr>";
					$textbox .= "<td width=140> &nbsp; $counter. " .str_replace("_", " ", $b_chk) ."";
					$textbox .= "<p>&nbsp; <a href=\"javascript:check('tabelle.php?$lk&pos=$counter&cid=$edit&navid=$navid&db=$db&back=$back');\" class=nav>". ilink() ." ".$MORPTEXT["CONE-TABBEARBEIT"]."</a></p></td>";
					$textbox .= $textbox_abschluss;
					$textbox .= "<p><a href=\"javascript:check('content_edit.php?db=$db&edit=$edit&navid=$navid&del=1&stelle=$counter&back=$back');\" class=del name=\"".$MORPTEXT["CONE-TABLOSCHEN"]."\" title=\"".$MORPTEXT["CONE-TABLOSCHEN"]."\"><img src=\"images/delete_w.gif\" alt=\"".$MORPTEXT["CONE-TABLOSCHEN"]."\" border=\"0\"></a></p>
<input type=hidden name=\"brick#" .$brick[0] ."#$counter\" value=\"$txt\">";
					$textbox .= "</td></tr></table>";
				}


				elseif ($insert_text) {
					unset($insert_text);
					$textbox .= "<p>\n\n<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" bgcolor=\"gray\"><tr>";
					$textbox .= "<td class=\"c150\" colspan=2> &nbsp; $counter. " .str_replace("_", " ", $b_chk) ." &nbsp; <a href=\"javascript:check('brick_change.php?cid=$edit&navid=$navid&back=$back&pos=$counter&db=$db');\"><i class=\"fa fa-text-width\"></i></a></td>";
					$textbox .= " </td></tr><tr><td width=90><input type=\"Text\"name=\"brick#" .$brick[0] ."#" .$counter ."\" style=\"width:50px; border: solid 1px gray;\" onchange=\"setchange('1');\" value=\"".stripslashes($txt)."\"> &nbsp; &nbsp; &nbsp; <a href=\"javascript:check('content_edit.php?db=$db&edit=$edit&navid=$navid&del=1&stelle=$counter&back=$back');\" class=del name=\"".$MORPTEXT["CONE-TEXTLOSCHEN"]."\" title=\"".$MORPTEXT["CONE-TEXTLOSCHEN"]."\"><i class=\"fa fa-trash-o\"></i></a></td>";

# content_edit.php?db=$db&edit=$edit&stelle=$counter&split=$counter&save=1

					$textbox .= $textbox_abschluss;
					$textbox .= "
					</td></tr></table>";
				}


				else {
					$textbox .= "<p>

<table bgcolor=\"$bgcolor\">
	<tr>";
					$textbox .= "
		<td class=\"c150\" valign=top> &nbsp; $counter. " .str_replace("_", " ", $b_chk) ." &nbsp; <a href=\"javascript:check('brick_change.php?cid=$edit&navid=$navid&back=$back&pos=$counter&db=$db');\"><i class=\"fa fa-text-width\"></i></a></font> <p> &nbsp; <input type=image src=\"images/save.png\" name=\"erstellen\" class=\"erstellen\" value=\"".$MORPTEXT["GLOB-SPEICHERN"]." $counter\"></p>";

					if (preg_match("/text/", $brick[0])) $textbox .= "<p> &nbsp; <input type=\"submit\" name=\"split\" class=\"split\" value=\"text trennen <s> - $counter\" src=\"images/split.gif\" alt=\"".$MORPTEXT["CONE-TEXTSPLITTEN"]."\" border=0  style=\"border: solid 1px #000000; line-height:10px; width: 90px; height: 16px; margin: 6px 0px 0px 0px;\"></p></td>";

					$textbox .= "<td><textarea name=\"brick#" .$brick[0] ."#" .$counter ."\" style=\"height:" .($row*30) ."px;\" class=\"ta\" onchange=\"setchange('1');\">".stripslashes($txt)."</textarea></td>

".$textbox_abschluss."
<p style=\"margin: 10px 0px 0px 0px;\"><a href=\"javascript:check('content_edit.php?db=$db&edit=$edit&navid=$navid&del=1&stelle=$counter&back=$back');\" class=del name=\"".$MORPTEXT["CONE-TEXTLOSCHEN"]."\" title=\"".$MORPTEXT["CONE-TEXTLOSCHEN"]."\"><i class=\"fa fa-trash-o\"></i></a></p></td>
</tr></table>
					";
				}
			}
		}
		#if ($counter % 4 == 0) $textbox .="\n<!-- direct -->\n";

#		if ($divend) $textbox .= '</div>			';
	}
	# # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # #
	$counter++;

	// _textboxen zusammenstellen
}
# # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # #
# # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # #

# # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # #
# # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # #
//
// stelle select mit bricks zusammen
$dir = opendir("../bricks");
$select_brick = "\n<select name=brickname style=\"width:200;\">\n<option value=''>".$MORPTEXT["CONE-FORMATIERUNGWAHL"]."</option><option value=''>------------------------</option>\n";
$dir_arr = array();

//////////////////////////////////////////////////////////////////////
// NEU !!!!!!!!!!!!!!!!!!!!
// --- Template Art checken
# $link_arr = array(3, 4);
//////////////////////////////////////////////////////////////////////
if ($db == "news") $anz = "news_";
else $anz = "t".$tid."_";
while ($name = readdir($dir)) {
	if (!$link_aktiv) {
		if (!is_dir($name)) {
			# echo $name."<br>";
			if (preg_match("/^".$anz."/", $name)) $dir_arr[] = $name;
			elseif (preg_match("/^all/", $name)) $dir_arr[] = $name;
		}
		elseif (!preg_match("/Box/", $name)) $dir_arr[] = $name;
	}
}
sort ($dir_arr);

$eb1 = '';
$eb2 = '';
$eb3 = '';
$eb4 = '';
$eb5 = '';
$eb6 = '';

foreach($dir_arr as $name) {
	$name_ = explode(".", $name);
	$name_ = repl("_", " ", $name_[0]);
	$name_ = substr($name_,4);

	if ($counter > 1 && $name_ == "link") 	{}
	elseif ($name_[0] == "-") 				$select_brick .= "<option value=''>$name_</option>\n";
	elseif ($name_)							{
		$option = "<option value='$name'>$name_</option>\n";

		if(preg_match("/bild/", $name_)) 		$eb1 .= $option;
		elseif(preg_match("/link/", $name_)) 	$eb4 .= $option;
		elseif(preg_match("/headl/", $name_)) 	$eb2 .= $option;
		elseif(preg_match("/flies/", $name_)) 	$eb3 .= $option;
		elseif(preg_match("/umbru/", $name_)) 	$eb6 .= $option;
		else									$eb5 .= $option;

	}
}

$ebleer = "<option value=''>------------------</option>\n";
$select_brick .= $eb1 ? $eb1.$ebleer : '';
$select_brick .= $eb2 ? $eb2.$ebleer : '';
$select_brick .= $eb3 ? $eb3.$ebleer : '';
$select_brick .= $eb4 ? $eb4.$ebleer : '';
$select_brick .= $eb5 ? $eb5.$ebleer : '';
$select_brick .= $eb6 ? $eb6.$ebleer : '';
$select_brick .= "</select>\n";
// _select
//

//
// stelle select mit counter zusammen
if (!$counter) $counter = 1;
$select_stelle = "\n<select name=stelle style=\"width:50px;\">\n<option value='$counter'>$counter</option>\n";

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

$direct_link = '<div class="link_container"><span style="float:right; width: 40px;"><a href="#top">'.$MORPTEXT["CONE-TOP"].'</a>&nbsp; </span>';

for ($n=($counter-1); $n>1; $n--) {
	$direct_link .= '<span style="float:right; padding-right: 8px;"><a href="#'.$n.'">'.$n.'|</a></span>';
}

$direct_link .= '</div>
';

echo "\n\n<form method=post action=\"content_edit.php\" name=\"content_edit\" style=\"margin: 0px 0px 0px 0px;\">
	<input type=hidden name=save value=1>
	<input type=hidden name=db value=$db>
	<input type=hidden name=ngid value='$ngid'>
	<input type=hidden name=back value='$back'>
	<input type=hidden name=duplizieren value=\"\">
	<input type=hidden name=edit value=$edit>
	<input type=hidden name=navid value=$navid>
	<input type=hidden name=vorlage value='$vorlage'>

	<!-- textboxes -->\n\n";

echo "\n\n<table><tr><td valign=top><a href=\"$link\" class=\"zurueck\">" .'<i class="fa fa-chevron-left small"></i>'." ".$MORPTEXT["GLOB-ZURUCK"]."</a> &nbsp; &nbsp;  &nbsp; &nbsp;  &nbsp; &nbsp; ";

if ($db == "content") {
	echo "<a href=\"../index.php?vs=1&cid=$navid&navid=$navid&lan=$sprache\"";
	echo ' rel="gb_page_center[1240]" style="margin-left:300px;"';
	echo " target=\"_blank\">".$MORPTEXT["GLOB-VORSCHAU"]." " .ilink() ."</a>
	&nbsp; &nbsp; &nbsp;
		<b class=\"content_edit_titel\"><u>$ort</u></b>
	&nbsp; &nbsp; &nbsp;
		<img src=\"images/".$morpheus["lan_arr"][$sprache].".gif\">
	&nbsp; &nbsp; &nbsp; &nbsp;
		<span class=\"content_edit_letzte\">".$MORPTEXT["CONE-LETZTEBEAR"]." <strong>$unm</strong></span>";

#	if ($sprache > 1) echo "<a name=\"import\" href=\"content_edit.php?edit=$edit&cid=$edit&back=$back&db=content&pos=de&lang=$lang\" title=\"import\">" .ilink() ." de content importieren</a> &nbsp; &nbsp; ";

#	echo "<!-- [Daten werden in diese Seite kopiert. Originalseite bleibt bestehen, aber vorhandene Daten auf dieser Seite gehen verloren.] --></p>";
}

elseif ($db == "newsletter") {
	echo "<a href=\"newsletter/vorschau.php?edit=$edit&navid=$navid\" rel=\"gb_page_center[640]\" target=_blank> ".$MORPTEXT["GLOB-VORSCHAU"]." " .ilink() ."</a></p><div style=\"margin: -12px 0px 0px 310px; position: relative; height: 30px;\"><a name=\"import\" href=\"javascript:check('link.php?edit=$edit&navid=$navid&db=content&pos=all&lang=$lang&target=newsletter');\" title=\"import\">" .ilink() ." importieren</a> &nbsp;
[".$MORPTEXT["CONE-DATENSEITE"]."<img src=\"images/leer.gif\" width=\"74\" height=\"1\" alt=\"\">".$MORPTEXT["CONE-DATENSEITEVERLOREN"]."]</div>";
}

elseif ($db == "news") {
	# echo "<a href=\"../index.php?vs=1&cid=$edit&lang=$lang&nid=$edit\"  rel=\"gb_page_center[1024]\" target=\"_blank\">vorschau " .ilink() ."</a></p>";
}

echo "</td></tr></table>\n";

/*
if ($db != "news")	echo "\n\n <b><u>$ort</u></b> &nbsp; &nbsp; &nbsp; <img src=\"images/".$morpheus["lan_arr"][$sprache].".gif\">&nbsp; &nbsp; &nbsp; &nbsp; Letzte Bearbeitung durch: <strong>$unm</strong> &nbsp; &nbsp; &nbsp; &nbsp; <!-- <a href=\"cms_hilfe.php\" rel=\"gb_page_center[640]\" style=\"border: solid 1px #cccccc; padding: 2px; margin: 0px 0px 0px 150px;\">Hilfe</a> --></p>
";
*/

//if ($db == "content") echo '<p style="margin: 0px 0px 0px 0px; background-color:#dddddd;"> &nbsp; <strong>Layout</strong>: &nbsp; '.$radio."<br>&nbsp;</p>";

echo '
<div class="content_edit_top">
';

echo $select_brick ." " .$select_stelle ."<input type=submit style=\"background-color:#CCCCCC;color:#FFFFFF;font-weight:bold;width:100px;\" name=erstellen value=einf&uuml;gen style=\"width:60;background-color:#BBBBBB;\"> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;<input type=submit style=\"background-color:#CCCCCC;color:#FFFFFF;font-weight:bold;width:100px;\" name=erstellen value=".$MORPTEXT["GLOB-SPEICHERN"]." style=\"width:70;background-color:#BBBBBB;\">
 &nbsp; &nbsp; &nbsp; &nbsp; ".$MORPTEXT["CONE-HOHETEXT"]." ";

echo "<select name=\"hoehe\" style=\"width:50px !important;\" onchange=\"submit();\">\n";
for($x=1; $x<=20; $x++) {
	if ($x == $hoehe) $sel = "selected";
	else unset($sel);
	echo "<option value=\"$x\" $sel>$x</option>\n";
}
echo "</select>
".'
'."
</div>
</div>

	<div id=\"content\" class=\"content_edit\" style=\"margin-top:0 !important;\">\n<a name=1></a>\n";

	echo repl("<!-- direct -->", $direct_link, $textbox);

	echo "\n\n<!-- textboxes -->\n\n
	<p><input type=submit style=\"background-color:#CCCCCC;color:#FFFFFF;font-weight:bold;width:100px;\" name=erstellen value=".$MORPTEXT["GLOB-SPEICHERN"]." style=\"width:70;background-color:#BBBBBB;\"></p>
	</form>
		";
echo "<br>$show";

if ($tab) echo '<script language="JavaScript" type="text/javascript">
	document.content_edit.submit();
</script>
</div>
';

if ($fckedit) echo '
<script type="text/javascript">
<!--
	document.content_edit.submit();

	setInterval(function(){
		document.location.href="content_edit.php?db='.$db.'&edit='.$edit.'&navid='.$navid.'&back='.$back.'";
		parent.parent.GB_hide();
	},1000);
 -->
</script>
';


include("footer.php");
?>