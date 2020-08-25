<?php
session_start();
# # # # # # # # # # # # # # # # # # # # # # # # # # #
# www.pixel-dusche.de                               #
# björn t. knetter                                  #
#                                                   #
# post@pixel-dusche.de                              #
# frankfurt am main, germany                        #
# # # # # # # # # # # # # # # # # # # # # # # # # # #
$iso = 1;
include("cms_include.inc");
include("stopwords_de.php");
include("stopwords_en.php");
ob_start();

// setlocale(LC_CTYPE, 'de_DE@euro', 'de_DE', 'de', 'ge');

/*
$sql = "REPAIR TABLE `content`, `k_desc`, `morp_suche_count`, `k_title`, `nav`, `news`, `pdf`, `pdf_group`, `product`, `productkat`";
$res = safe_query($sql);

$sql = "OPTIMIZE TABLE `content`, `k_desc`, `morp_suche_count`, `k_title`, `nav`, `news`, `pdf`, `pdf_group`, `product`, `productkat`";
$res = safe_query($sql);
*/

# # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # #
# # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # #
# # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # #
# # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # #
# # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # #
# # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # #
# jetzt geht es los!!!!!!!!!
# # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # #
# # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # #
# # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # #
# # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # #
# # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # #
# # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # #

# ersetzungstabelle f&uuml;r sonderzeichen etc
global $locSearch, $locReplace, $replace;

$locSearch[] = "=ó=";
$locSearch[] = "=ä=";
$locSearch[] = "=ö=";
$locSearch[] = "=ü=";
$locSearch[] = "=&uuml;=";
$locSearch[] = "=ß=";
$locSearch[] = "=([0-9/.,+-]*\s)=";
$locSearch[] = "=([^A-Za-z])=";
$locSearch[] = "= +=";
$locSearch[] = "=/.=";

$locReplace[] = "o";
$locReplace[] = "ae";
$locReplace[] = "oe";
$locReplace[] = "ue";
$locReplace[] = "ue";
$locReplace[] = "ss";
$locReplace[] = " ";
$locReplace[] = " ";
$locReplace[] = " ";
$locReplace[] = " ";

# stopwoerter in de und en
$search_de[] = "=(\s[A-Za-z]{1,2})\s=";
$search_de[] = "= " . implode(" | ", $stopwords["de"]) . " =i";
$search_de[] = "= +=";

$search_en[] = "=(\s[A-Za-z]{1,2})\s=";
$search_en[] = "= " . implode(" | ", $stopwords["en"]) . " =i";
$search_en[] = "= +=";

$replace[] = " ";
$replace[] = " ";
$replace[] = " ";


$que = "DELETE FROM `morp_suche_keyw` WHERE 1";
safe_query($que);
$que = "DELETE FROM `morp_suche_count` WHERE 1";
safe_query($que);

//$STARTZEIT = microtime_float();

echo '<div id="content_big">';
ob_end_flush();
echo "<p><b>starte auslesen der datenbank.....</b></p>";

flush();

function konvertiere ($text, $search) {
	global $locSearch, $locReplace, $replace;

	$string = trim(mb_strtolower(stripslashes(strip_tags($text))));
	$string = preg_replace($locSearch, $locReplace, $string);
	$string = " " . str_replace(" ", "  ", $string) . " ";
	$string = trim(preg_replace($search, $replace, $string));

	return $string;
}

function set_keyw ($string, $db, $primary, $lang, $art, $navid, $stid="") {
	# ist das keyword vorhanden?
	$string = trim($string);
	$sql	= "SELECT kid FROM `morp_suche_keyw` WHERE keyw = '$string'";
	$res	= safe_query($sql);
	$x		= mysqli_num_rows($res);

	if ($x > 0) {
		# wenn ja, sprache und art kennzeichnen
		$row = mysqli_fetch_object($res);
		$kid = $row->kid;
		$que = "update `morp_suche_keyw` set $lang=1 WHERE kid=$kid";
		safe_query($que);
	}
	else {
		# wenn nein, sprache und art kennzeichnen und keyword einsetzen
		$que = "insert `morp_suche_keyw` set `keyw`='$string', $lang='1'";
		safe_query($que);
		$kid = mysqli_insert_id($mylink);
	}

	# ist dieses keyword im zusammenhang mit der navID schon vorhanden? wenn ja, zaehler hochsetzen => erhoehung der gewichtung
	$anz	= "anz".$lang;
	$sql	= "SELECT ".$anz.", sid FROM `morp_suche_count` WHERE kid='$kid' AND navid='$navid' AND art=".$art."";
	$res	= safe_query($sql);
	$x		= mysqli_num_rows($res);

	if ($stid) $set = ", stid=".$stid;
	if ($x > 0) {
		# wenn ja, zaehler erhoehen
		$row = mysqli_fetch_object($res);
		$id  = $row->sid;
		$an  = $row->$anz;
		$an++;
		$que = "update `morp_suche_count` set ".$anz."=".$an.$set." WHERE sid=".$id;
		safe_query($que);
	}
	else	{
		$que = "insert `morp_suche_count` set ".$anz."=1, navid='$navid', kid='$kid', art=$art".$set;
		safe_query($que);
	}

}

////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////

// es geht los!


// art: 1 =content, 2 = produkt, 3 = stelle

////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////
// CONTENT

$query 	= "SELECT * FROM content c, nav n WHERE c.navid=n.navid AND n.sichtbar=1 ORDER BY c.navid";
#$query 	= "SELECT * FROM content c, nav n WHERE c.navid=n.navid AND n.sichtbar=1 ORDER BY c.navid LIMIT 0,2";

flush();
$result = safe_query($query);
$oldid = 0;

while ($row = mysqli_fetch_object($result)) {
	 $de 	= get_raw_text(utf8_decode($row->content));
	$n_de 	= utf8_decode($row->name);
#	$id 	= $row->cid;
echo	$id 	= $row->navid;

echo " -- ";
flush();

	$string = konvertiere ($de, $search_de);
	$arr 	= explode(" ", $string);
//	print_r($arr);

	# # # # # # # # # # # # KEYWORDS
	if ($arr) {
		foreach ($arr as $word) {
			if(trim($word)) set_keyw (trim($word), "", "", "de", 1, $id);
		}
	}

	if($id != $oldid) {
		$oldid = $id;
		# auswertung titel / artikel bezeichnung deutsch
		$string = konvertiere ($n_de, $search_de);
		$arr 	= explode(" ", $string);

		if ($arr) {
			foreach ($arr as $word) {
				if(trim($word)) set_keyw (trim($word), "", "", "de", 1, $id);
			}
		}
	}
}

////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////
// PRODUKTE
/*
	$query 	= "SELECT * FROM morp_produkt WHERE 1";

flush();
$result = safe_query($query);
$oldid = 0;

while ($row = mysqli_fetch_object($result)) {
	$de 	= utf8_decode($row->prod_name).' '.utf8_decode($row->prod_text);
	$n_de 	= ''; // utf8_decode($row->prod_text);
#	$id 	= $row->cid;
	echo	$id 	= $row->pid;

echo " - PRODUKTE - ";
flush();

	$string = konvertiere ($de, $search_de);
	$arr 	= explode(" ", $string);
//	print_r($arr);

	# # # # # # # # # # # # KEYWORDS
	if ($arr) {
		foreach ($arr as $word) {
			if(trim($word)) set_keyw (trim($word), "", "", "de", 2, $id);
		}
	}
}
*/
////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////
// Stimmen

$query 	= "SELECT * FROM morp_stimmen WHERE 1";

flush();
$result = safe_query($query);
$oldid = 0;

while ($row = mysqli_fetch_object($result)) {
	$de 	= utf8_decode($row->name).' '.utf8_decode($row->beruf).' '.utf8_decode($row->text);
	$n_de 	= ''; // utf8_decode($row->prod_text);
#	$id 	= $row->cid;
	echo	$id 	= $row->sid;

echo " - Stimmen - ";
flush();

	$string = konvertiere ($de, $search_de);
	$arr 	= explode(" ", $string);
//	print_r($arr);

	# # # # # # # # # # # # KEYWORDS
	if ($arr) {
		foreach ($arr as $word) {
			if(trim($word)) set_keyw (trim($word), "", "", "de", 3, $id);
		}
	}
}

////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////
// AKTUELLES


#@mail('post@pixel-dusche.de', 'KEYWORD CREATE ::: biodentis', date("d.m-Y H:i"));

#echo '<script type="text/javascript">document.location.href=\'?last='.$last.'\';</script>';
#echo "<p><a href=\"_keyw.php?next=1\">weiter</a></p>";
?>

<p><br><b>fertig!!!</b>

</body>
</html>
