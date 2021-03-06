<?php
session_start();
error_reporting(0);
include("dompdf/autoload.inc.php");
use Dompdf\Dompdf;
$dompdf = new Dompdf();
# session_destroy();

# # # # # # # # # # # # # # # # # # # # # # # # # # # # # # #
global $dir, $navarray, $nav_h, $nav_s, $navarrayFULL, $SID, $lightbox, $lang, $lan, $hn, $nid, $ns, $waehrung, $thwg, $product_show, $wg_txt, $navID, $img_pfad, $uri, $print;
global $news_headl, $news_back, $tcolor, $mindflashID, $kompetenz, $komp_col, $lokal_pfad, $sub1_id, $qSET, $IAMIN, $lockicon;
# # # # # # # # # # # # # # # # # # # # # # # # # # # # # # #

// .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .
// .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .
// .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .
//     1   GRUNDEINSTELLUNGEN
// .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .
// .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .
// .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .

include("nogo/config.php");
include("nogo/funktion.inc");

# # # pfad ermitteln
# $out = print_r($_REQUEST, 1);
# print_r($_REQUEST);
# print_r($_POST);
# print_r($_SESSION);
$url  	 = $_SERVER["HTTP_HOST"];
$lasturl = $_SESSION["tld"];
$ref_chk = $_SERVER["HTTP_REFERER"];
$uri	 = $_SERVER["REQUEST_URI"];
$SID	 = session_id();
$mobile = mobile_device_detect();

if($mobile) $qSET = '&amp;q=30';
else $qSET = '&amp;q=90';

$logout = isset($_GET["logout"]) ? 1 : 0;

if($logout) {
	$_SESSION["custname"] = '';
	$_SESSION["pd"] = '';
}

 $cn = isset($_SESSION["custname"]) ? $_SESSION["custname"] : '';
 $pd = isset($_SESSION["pd"]) ? $_SESSION["pd"] : '';
$IAMIN = $cn && $pd ? 1 : 0;

$lockicon = '<i class="fa fa-lock"></i> ';

// $IAMIN = 1;

//$suche = isset($_POST["suche"]) ? $_POST("suche") : '';

//////////////////////////////////////////////////////////////////////////////////
$browser = browser_detection("browser");

if ($browser == "ie") {
	$msie = 1;
	$browser = substr(browser_detection("number"), 0, 1);
	if ($browser < 6) $browser = "MSIE5";
	elseif ($browser < 7) $browser = "MSIE6";
}
/////////////////////////////////////////////////////////////////////////////////

if(file_exists("lokal.dat")) $dir = $morpheus["local"];
else $dir = $morpheus["url"];

$img_pfad = $dir."images/userfiles/image/";

$lokal_pfad = '';
$count_tiefe = explode('/', $uri);
$count_tiefe = count($count_tiefe)-$morpheus["ebene"];  // -2 weil anfang und endslash im array sind
if($count_tiefe) {
	for ($i=1; $i<=$count_tiefe; $i++) {
		$lokal_pfad .= "../";
	}
}
$lokal_pfad = $dir;

// spracheinstellungen // sprachauswertung
if ($_GET["lang"]) 		$lan = $_GET["lang"];
elseif ($_GET["lan"]) 	$lan = $morpheus["lan_arr"][$_GET["lan"]];
else 					$lan = "de";

if($_GET["alt"]) {
	if($_GET["s1"]) {
		include("nogo/navID_de.inc");
		$id_arr = array_flip($navID);
		$new = strtolower($_GET["s1"])."/";

		if($_GET["s2"]) {
			$new .= strtolower($_GET["s2"])."/";
		}
		else $new .= "allgemeines/";

		if ($id_arr[$new]) $go = $dir.$new;
		else $go = $dir;

		// print_r($_REQUEST);
	}
	else $go = $dir;

	$nosend = 1;
	redirect ($go);
}
else if ($lan != "de" && $lan != "en") {
	$nosend = 1;
	redirect ($dir);
}

$lan_ID_arr = array_flip($morpheus["lan_arr"]);
$lang 		= $lan_ID_arr[$lan];
include("nogo/".$lan.".inc");
// ____ sprache


// navigation ID's laden
include("nogo/navarray_".$lan.".php");
include("nogo/navID_".$lan.".inc");


# $ausnahme = array("lang", "hn", "sn2", "sn3", "sn4", "cont");
$ausnahme = array("x","y");

if (($_GET || $_POST)) {
	foreach ($_POST as $key=>$val) {
		if ($val) {
			$check 	= $val;
			$chk 	= no_injection($val);
			// echo "($check != $chk)<br>";
			if ($check != $chk) {
				$nosend = 1;
				redirect ($dir);
			}
		}
	}
	foreach ($_GET as $key=>$val) {
		if ($val && !in_array($key, $ausnahme)) {
			if ($key == "pnm") 	$val = eliminiere($val);
			$check 	= $val;
			if ($key == "pnm") 	$chk = no_injection($val, 1);
			else 				$chk = no_injection($val);
			if ($check != $chk) {
				$nosend = 1;
				redirect ($dir);
			}
		}
	}
}
# # # # # # # # # # # # # # # # # # # # # # # # # # # # # # #

include("nogo/db.php");
dbconnect();

/////////////////////////////////////////////////////////////////////////////////////////
// aus welchen land kommt der kunde?
/*
$country = $_SESSION["country"];
if(file_exists("lokal.dat")) {}
elseif (!$country) {
	session_register('country');
	$ip_number = sprintf("%u", ip2long($_SERVER["REMOTE_ADDR"]));
	$sq 		= "SELECT country_code2 FROM iptoc WHERE IP_FROM <=$ip_number AND IP_TO >=$ip_number";
	$rs 		= safe_query($sq);
	$rw 		= mysqli_fetch_object($rs);
	$country 	= $rw->country_code2;
	$_SESSION["country"] = $country;
	if(file_exists("lokal.dat")) {
		$country = "EN";
		$_SESSION["country"] = "EN";
	}
	if ($country == "CH" || $country == "DE" || $country == "AT") 	{}
	elseif ($uri == '/') {
				$nosend = 1;
				redirect ($dir.'en/');
			}
}
*/
////////////////// TRACKING  // TRACKING  // TRACKING  // TRACKING

$uid = isset($_GET["uid"]) ? $_GET["uid"] : '';
$vid = isset($_GET["vid"]) ? $_GET["vid"] : '';
$vidmail = isset($_GET["m"]) ? $_GET["m"] : '';

if ($uid) {
	$sql = "SELECT * FROM morp_newsletter_track WHERE vid='$uid' AND site='".$_GET["newsname"]."'";
	$res = safe_query($sql);
	if (mysqli_num_rows($res) < 1) {
		$sql = "INSERT morp_newsletter_track set vid='$uid', site='".$_GET["newsname"]."'";
		$res = safe_query($sql);
	}
}
elseif($vid && $vidmail) {
	$sql = "SELECT vid FROM morp_register WHERE vid=$vid AND email='$vidmail'";
	$res = safe_query($sql);
	if(mysqli_num_rows($res)>0) {
		$sql = "UPDATE morp_register set `checked`=1 WHERE vid=$vid";
		safe_query($sql);
	}
	else $vid = '';
}

//////////////////////////////////////////////////

# # # # # # # # # # # # # # # # # # # # # # # # # # # # # # #
// standard seite festlegen

$hn 		= isset($_REQUEST["hn"]) ? $_REQUEST["hn"] : '';
$cont 		= isset($_REQUEST["sn2"]) ? $_REQUEST["sn2"] : '';
$cont3 		= isset($_REQUEST["sn3"]) ? $_REQUEST["sn3"] : '';
$cont4 		= isset($_REQUEST["sn4"]) ? $_REQUEST["sn4"] : '';
$cont5 		= isset($_REQUEST["sn5"]) ? $_REQUEST["sn5"] : '';
$print 		= isset($_REQUEST["print"]) ? $_REQUEST["print"] : '';
$nid 		= isset($_REQUEST["nid"]) ? $_REQUEST["nid"] : '';
//$id_arr 	= array_flip($navarray);
$id_arr 	= array_flip($navID);

if ($hn) 	$set_uri = eliminiere($hn)."/";
if ($cont) 	$set_uri .= eliminiere($cont)."/";
if ($cont3) $set_uri .= eliminiere($cont3)."/";
if ($cont4) $set_uri .= eliminiere($cont4)."/";
if ($cont5) $set_uri .= eliminiere($cont5)."/";
# echo $set_uri."\n\n";#
# print_r ($id_arr);
$cid 		= $id_arr[$set_uri];


// hauptnaviagtion ID auswerten
$hn_id 	= $id_arr[eliminiere($hn)."/"];

if ($cont) $sub1_id = $id_arr[eliminiere($hn)."/".eliminiere($cont)."/"];
else $sub1_id = "";

if(isset($_GET["suche"])) {
	$cid=26;
	$hn_id=26;
}
elseif ((!$hn_id || !$cid) && $hn)	{
	$find = substr($uri, 1, strlen($uri));
	$sql  	= "SELECT navid FROM nav WHERE oldlnk LIKE '%$find%'";
	$res 	= safe_query($sql);

	if(mysqli_num_rows($res) > 0) {
		$row 	= mysqli_fetch_object($res);
		$go = $navID[$row->navid];
		redirect ($dir.$go);
		exit();
	}
	else {
		redirect ($dir);
		exit();
	}
}
elseif (!$hn_id || !$cid)	{
	$hn_id 	= $morpheus["home_ID"][$lan];
	$cid 	= $morpheus["home_ID"][$lan];
}


#echo $cid;
#echo "<br>".$hn_id;

# vorschau aus CMS MORPHEUS
if ($_GET["vs"] == 1 && $_GET["cid"]) {
	$vorschau = 1;
	$cid 	= $_GET["navid"];
	$sn2	= $cid;
	$sql  	= "SELECT ebene, navid, parent FROM nav WHERE navid=$cid";
	$res 	= safe_query($sql);
	$row 	= mysqli_fetch_object($res);

	if ($row->ebene > 2) 	{
		$sn3	= $cid;
		$sn2	= $row->parent;
		$sql  	= "SELECT ebene, navid, parent FROM nav WHERE navid=".$row->parent."";
		$res 	= safe_query($sql);
		$row 	= mysqli_fetch_object($res);
		$hn_id 	= $row->parent;
	}
	elseif ($row->ebene == 1) 	$hn_id = $cid;
	else						$hn_id = $row->parent;

}


// .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .
// .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .
// .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .
// .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .
//     2   HAUPTNAVIGATION
// .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .
// .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .
// .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .
// .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .



# # # # # # # # # # # # # # # # # # # # # # # # # # # # # # #
// hauptnavigation
$sql  	= "SELECT name, n.navid, bereich, button, imgname, lnk, design, sichtbar, emotional FROM nav n LEFT JOIN image i ON i.imgid=n.emotional WHERE n.ebene=1 AND lang=$lang ORDER BY `sort` ASC";
$res 	= safe_query($sql);
$anz	= mysqli_num_rows($res);
$class	= "";
$nav_arr= array("leer");	# wert 0 ist null. wert 1 muss der aktive hauptnavigationsname sein
$n 		= 0;
$m 		= 0;
$nav_footer = '';
$nav_h = '';
$nav_meta = '';

while ($row = mysqli_fetch_object($res)) {
	$n_nm		= "name";
	$name		= $row->$n_nm;
	if ($name) {
		$id			= $row->navid;
		$bereich	= $row->bereich;
		$des		= $row->design;
		$nnm 		= eliminiere($name);
		$lnk		= $row->lnk;
		$extern 	= 0;
		$li_class	= "";
		$class		= "";
		$split 		= "";
		$button 	= $row->button;
		$sichtbar	= $row->sichtbar;


		if ($id == $morpheus["home_ID"][$lan] && $lang == 1)  $index = "";
#		elseif ($id == $morpheus["home_ID"][$lan])  $index = "en/";
		elseif ($lnk && preg_match("/^http/", $lnk))	{ 	$index = $lnk; $extern = 1; 	}
		elseif ($lnk) 										$index = $navID[$lnk];
		else												$index = strtolower($nnm)."/";

		if ($hn_id == $id) {
			if ($id >= 1) $class = ' active';
			if ($id >= 1) $li_class= ' class="active"';

			$split 			= "<!-- split".$id." -->";
			$design			= $des;

			$nav_arr[]		= strtolower($nnm);
			$breadcrumb 	= '<li><a href="'.$dir.$index.'" class="breadcrumb">'.utf8_encode($name).'</a></li>';
			$hn_name		= strtolower($nnm);
			if ($row->button) 	$but = $row->button;
			if ($row->imgname) 	$background = $img_pfad.$row->imgname;
			$flash_hn 		= $n;
		}

		if ($sichtbar) {
			if ($bereich == 1) 	{
				$m++;
				$nav_h .= '						<li'.$li_class.'><a href="'. ($extern ? $index : $dir.$index) .'" title="'.$name.'"'. ($extern ? ' target="_blank"' : '') .'>'.$name.'</a>'.$split.'</li>
';
			}

			elseif ($bereich == 2) 	{
				$n++;
//				if($button) $nav_meta .= '<li'.$li_class.'><a href="#" id="'.$button.'">'.$name.'</a></li>';
//				else $nav_meta .= '<li'.$li_class.'><a href="'. ($extern ? $index : $dir.$index) ."\" ".$class.' title="'.$name.'"'. ($extern ? ' target="_blank"' : '') .'>'.$name.'</a></li>';
				$nav_meta .= '						<li class="menu-item"><a href="'. ($extern ? $index : $dir.$index) .'" title="'.$name.'"'. ($extern ? ' target="_blank"' : '') .'>'.$name.'</a>'.$split.'</li>
';
			}
			elseif ($bereich == 3) 	{
				$nav_footer .= '		<li'.$li_class.'><a href="'.$dir.$index.'" '.$class.' title="'.$name.'">'.$name.'</a></h6>
';
			}


#			elseif ($bereich == 2) 	{
#				$m++;
#				$nav_meta .= '		<li><a href="'.$dir.$index.'" '.$class.' title="'.$name.'">'.$name.'</a></li>'. ($m<3 ? '<li class="trennerM"></li>' : '') .''."\n\t";
#			}
			elseif ($bereich == 3) 	$nav_log .= '		<li><div id="button" class="meta"><a href="'.$dir.$index.'" '.$class.' title="'.$name.'">'.$name.'</a></div></li>'."\n\t";
		}
	}
}

// _____ hauptnavi

unset($output);

# # # # # # # # # # # # # # # # # # # # # # # # # # # # # # #
// subnavigation
# es werden alle ebenen der subnav ausgelesen

$parent_arr = array(1=>$hn_id);
$set_lnk 	= eliminiere($hn)."/";

foreach ($_GET as $key=>$val) {
	if (preg_match("/^sn/", $key)) {
		$set_lnk .= eliminiere($val)."/";
		$parent_arr[substr($key,2)] = $id_arr[$set_lnk];
		$$key = $id_arr[$set_lnk];
	}
}

if ($vorschau && $cid != $hn_id) {
	$parent_arr[] = $sn2;
	$parent_arr[] = $sn3;
	$parent_arr[] = $sn4;
	$parent_arr[] = $sn5;
}

# print_r($parent_arr);
# $out .= print_r($parent_arr, 1);

$split_arr = array();
$ct = 0;
$sub_arr = array();

if ($intern && $logged != "brand-pixel") { 	# wenn zugangsgeschuetzte seiten im system sind

}

else	{
	$pid = '';
	foreach ($parent_arr as $key=>$val) {		# alle subnavigationsebenen werden durchlaufen, sofern diese geklickt wurden
		if ($val) {
			$ebene 		= ($key + 1);
			$sn_aktiv 	= "sn".$ebene;			# die aktive/geklickte subnavigations ID wird global als sn plus ebene definert


			$sql = "SELECT * FROM nav
				WHERE
					ebene=".$ebene." AND
					parent=".$val." AND
					sichtbar = 1
				ORDER BY `sort`";

			$res = safe_query($sql);

			unset($set_link);						# hier wird der pfad fuer die subnavigation zusammen gestellt
			for($n = 1; $n < $ebene; $n++) $set_link .= $nav_arr[$n].'/';

			while ($row = mysqli_fetch_object($res)) {
				$id		= $row->navid;
				$name	= $row->name;
				$des	= $row->design;
				$visib	= $row->sichtbar;
				$lnk	= $row->lnk;
				$lock	= $row->lock;

				//echo $val;
				//if($lock && !$IAMIN) {}
				if ($name) {
					$nnm 	= strtolower(eliminiere($name));	# sonderzeichen, leerzeichen, u.v.w. werden entfernt

					$sub	= "sub".$ebene;

					// manuell gesetzte links
					$extern 	= 0;
					$index		= "";
					$liclass 	= '';

					if ($lnk && preg_match("/^http/", $lnk))	{ $index = $lnk; $extern = 1; }
					elseif ($lnk) 								$index = $navID[$lnk];
					// _manuell

					if ($$sn_aktiv == $id) 	{
						$class 			= ' class="active"';			# aktive navigationselemente werden gekennzeichnet
						$liclass 			= ' active';			# aktive navigationselemente werden gekennzeichnet
						$split 			= '<!-- '.($id).' -->';
						$design			= $des;
						$split_arr[] 	= $ebene;
						$nav_arr[]		= $nnm;
						# $cid			= $id;
						$breadcrumb 	.= '<li><a href="'.$dir.$navID[$id].'" class="breadcrumb">'.$name.'</a></li>';
						if($ebene == 3) $pid = $row->parent;
					}
					elseif($ebene > 2)	{
						$class = '';
						$split 			= '<!-- '.($id).' -->';
					}
					else	{
						$class = '';
						$split = '';
					}

					$il = $lock ? $lockicon : '> ';

					// if ($visib) $nav_s	.= "<li><a href=\"".$dir.$lan.'/'.$set_link.'/'.$nnm."/\"".$class.">$name</a></li>"."\n";
					if ($visib && $index) 				$$sub	.= "<li><a href=\"". ($extern ? $index : $dir.$index) ."\"". ($extern ? ' target="_blank"' : '') ."".$class.">".$name."</a>".$split."</li>\n";
					elseif ($visib && $ebene == 3) 		{ $$sub	.= "<li class=\"hover".$liclass."\"><a href=\"".$dir.$set_link.$nnm."/\" class=\"hove\">".$il.$name."</a>".$split."</li>\n"; $sub_arr[]=$id; }
					elseif ($visib) 					$$sub	.= "<li><a href=\"".$dir.$set_link.$nnm."/\"".$class.">".$name."</a>".$split."</li>\n";
					// if ($visib) $nav_s	.= "<li><a href=\"index.php?sn=$nnm&".$set_link."\" ".$class.">$name</a>".$split."<span class=\"trenner\"></span></li>";
				}
			}
		}
	}


	if ($ebene > 1) {
		for ($i=2; $i <= $ebene; $i++) {
			$tmp = "sub".$i;
			$dat = $$tmp;

			if ($i == 2) $nav_s = $dat;
			elseif ($dat) {
				$nav_s = str_replace('<!-- '.($i).' -->', '<ul>'.$dat."</ul>", $nav_s);
			}
		}
	}
	if ($ebene > 2) {
		for ($i=3; $i <= $ebene; $i++) {
			$tmp = "sub".$i;
			$dat = $$tmp;

			if ($i == 3) $nav_s2 = $dat;
			elseif ($dat) $nav_s2 = str_replace("<!-- ".$i." -->", "<ul>".$dat."</ul>", $nav_s);
		}
	}

}
$nav_sUL = '<ul  class="dropdown-menu" role="menu">'.$nav_s.'</ul>';
if ($nav_s) $nav_s = '<ul class="subnav">'.$nav_s.'</ul>';
$nav_h = str_replace("<!-- split".$hn_id." -->", $nav_sUL, $nav_h);


// print_r($sub_arr);


/* *************************** NEW *****************************/
/* *************************** NEW *****************************/
/* *************************** NEW *****************************/
$dropDownMenu = '';

if(count($sub_arr)>0) {
	foreach($sub_arr as $getid) {
		$dropDownMenu = get_nav($getid, $parent_arr[4], '', 0, $parent_arr, 4);
		if($dropDownMenu) $sub3 = preg_replace('/<!-- '.($getid).' -->/', "\n".'		<ul class="hovermenu">'."\n".$dropDownMenu.'		</ul>', $sub3);
	}
}

// echo $sub3;

function get_nav($getid, $aktiv, $giveClass, $ul, $parent_arr, $getebene) {
	global $dir, $navID, $lockicon;
	// print_r($navID);

	if($ul) $ret = '
			<ul'.$giveClass.'>
';
	else $ret = '';


	$sql = "SELECT * FROM nav
		WHERE
			parent=".$getid." AND
			sichtbar=1
		ORDER BY `sort`";
	$res = safe_query($sql);

	if(mysqli_num_rows($res) > 0) {
		while ($row = mysqli_fetch_object($res)) {

			$id = $row->navid;
			$il = isLock($id) ? $lockicon : '';

			if ($aktiv == $id) 	$class = ' class="active"';
			else $class = '';

			$lnk	= $row->lnk;
			$extern = '';
			if ($lnk && preg_match("/^http/", $lnk))	{ $index = $lnk; $extern = 1; }
			elseif ($lnk) 								$index = $dir.$navID[$lnk];
			else 										$index = $dir.$navID[$id];

			$split = get_nav($id, $parent_arr[$getebene++], '', 1, $parent_arr);

			$ret .= '				<li'.$class.'><a href="'.$index.'"'.($extern ? ' target="_blank"' : '').'>'.$il.$row->name.'</a>'.$split.'</li>
';
		}

		if ($ul) $ret .= '			</ul>
';
	}
	else $ret = '';

	return $ret;
}

/* *************************** NEW ENDE *****************************/
/* *************************** NEW ENDE *****************************/
/* *************************** NEW ENDE *****************************/

// echo $sub2;
//////////////////////////////////////////////////////////////////////////////////////////////
// NAVIGATION __ FERTIG ___  ___  ___  ___  ___  ___  ___  ___  ___  ___  ___  ___  ___  ___
//////////////////////////////////////////////////////////////////////////////////////////////




// .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .
// .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .
// .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .
//     3   CONTENT / TEXT / INHALT
// .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .
// .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .
// .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .


//$meta_arr 	= array("title", "desc", "keyw", "footer");
$meta_arr 	= array("title", "desc", "keyw");
$img_arr 	= array();
$n_nm		= "content";
$detail 	= $_GET["detail"];
$leftimage	= '';

unset($output);
$rb_headl = '';

$logWarn = 0;
$startcol = "light";

global $google;
$google = '';

if ($cid) {
	$sql = "SELECT `lock` FROM nav WHERE navid=$cid";
	$res = safe_query($sql);
	$row = mysqli_fetch_object($res);
	$islock = $row->lock;

	if($islock && !$IAMIN) $output = ('Bitte loggen Sie sich ein: &nbsp; <a href="'.$dir.'mitglieder/login/"><i class="fa fa-external-link-square"></i> zum Login</a>!<br><br><br><a href="'.$dir.'"><i class="fa fa-external-link-square"></i> Zur Startseite</a>');
	else {
#	elseif($islock) echo('SP√É∆í√¢‚Ç¨≈æTER NUR F√É∆í√&ouml;‚&auml;úR BERECHTIGTE !!!!!!!!');
#	elseif($islock) echo('SP√É∆í√¢‚Ç¨≈æTER NUR F√É∆í√&ouml;‚&auml;úR BERECHTIGTE !!!!!!!!');

	unset($sql);
	$meta_fertig = '';

	$query = "SELECT * FROM content c LEFT JOIN image i ON i.imgid=c.img1, nav n WHERE c.navid=".$cid." AND n.navid=c.navid AND ton=1 ".$sql." ORDER BY tpos";

	// $query 	= "SELECT * FROM content c, nav n LEFT JOIN image i ON i.imgid=n.emotional WHERE c.navid=$cid AND n.navid=c.navid AND ton=1 ORDER BY tpos";
	// $query 	= "SELECT * FROM content c, nav n WHERE c.navid=$cid AND n.navid=c.navid AND ton=1 ORDER BY tpos";
	$result 	= safe_query($query);

	while ($row = mysqli_fetch_object($result)) {
		if ($row->emotional && !$leftimage) {
			$sql = "SELECT * FROM `image` WHERE imgid=".$row->emotional;
			$res = safe_query($sql);
			$rw  = mysqli_fetch_object($res);
			$leftimage = $rw->imgname;
		}

		$vid		= $row->vid;
		if ($vid) {
			$sql = "SELECT * FROM content c LEFT JOIN image i ON i.imgid=c.img1 WHERE cid=$vid";
			$res = safe_query($sql);
			$rw = mysqli_fetch_object($res);
			$throw = $rw;
		}
		else $throw = $row;

		$text		= $throw->$n_nm;
		$templ_id 	= $throw->tid;
		$templ_headl= $throw->theadl;
		$templ_lnk 	= $throw->tlink;
		$twidth		= $throw->twidth;
		$theight	= $throw->theight;
		$templ_bgr 	= $throw->tbackground;
		$tfoto 		= $throw->timage;
		$tcolor		= $throw->tcolor;
		$tref		= $throw->tref;
		$style 		= '';

		//if($templ_lnk) $templ_lnk = '<a name="'.$templ_lnk.'" id="'.$templ_lnk.'"></a>';
		if($templ_lnk) $templ_lnk = '<div class="zeigedich '.$templ_lnk.'" id="'.$templ_lnk.'"></div>';

		// $foto 		= $row->imgname;

		$templ_lnk_anz = '';
		$templ_lnk_box = '';
		$foto_lnk = '';
		$foto_url = '';

/*
		if($templ_lnk)  {
			if ($templ_lnk == $morpheus["home_ID"][$lan]) $togo = '';
			elseif ($templ_lnk == $morpheus["home_ID"][$lan] && $lan = "en") $togo = $lan.'/';
			else $togo = $lan.'/'.$navID[$templ_lnk];

			$templ_lnk_anz 	= ' <ul><li><a href="'.$dir.$togo.'" alt="'.$templ_headl.'">&nbsp;</a></li></ul>';
			# $templ_lnk_anz = ' <div><a href="'.$dir.$lan.'/'.$navID[$templ_lnk].'"><img src="'.$dir.'images/pfeil-grau.png" alt="" width="10" height="12" border="0" style="margin-left:10px;"></a></div>';
			$templ_lnk_box 	= ' style="cursor:pointer;" onclick="javascript:document.location.href=\''.$dir.$togo.'\'"';
			$foto_lnk		= '<a href="'.$dir.$togo.'" alt="'.$templ_headl.'">';
		}
*/

	  	# # # # auswertung text startet
		# # # # auswertung text startet

		// if ($text) {
			#echo $text;
			$get = (get_cms_text($text, $lang, $dir));
//			$get = utf8_decode($get);

			include("templates/". ($templ_id ? $templ_id : 1) .".php");

			if ($templ_id == 20)			$content = "boxen";
			elseif ($templ_id == 13)		$content = "rechts";
			elseif ($templ_id == 9)			$content = "slider";
			elseif ($templ_id == 5)			$content = "slider";
#			elseif ($templ_id == 200)		$content = "anhang";

			else							$content = "output";


			// echo $content;

			$$content .= str_replace(array("#cont#", "#col#", "#headl#", "#foto#", "#style#", "#anker#", "#link_anz#", "#link_box#", "#link_pur#", "xxxxxx"), array($get, $templ_bgr, $templ_headl, $foto_url, $style, $templ_lnk, $templ_lnk_anz, $templ_lnk_box, $foto_lnk, $startcol), $template);

			$startcol = $startcol == 'weiss' ? 'light' : 'weiss';

		# # # # # # # # # # # # # # # # # # # # # # # # # # #

			if (!$meta_fertig) {
				foreach ($meta_arr as $meta) {
					$meta_		= $meta;
					$$meta = $throw->$meta_;
				}

				# META Infos zusammenstellen
				if ($ebene > 2) $zusatz = $morpheus["title"].' - '. $_GET["sn".($ebene-1)];
				else			$zusatz = $morpheus["title"].' - '.$_GET["hn"];

				if (!$title)	$title = $zusatz;
				if (!$desc)		$desc = substr(get_raw_text ($text, $lan), 0, 250);
				if (!$keyw)		$keyw = $zusatz;

				$meta_fertig = 1;
			}
		}
	}
}

if(!$leftimage) $leftimage = 'left.jpg';


// .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .
// .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .
// .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .
//     4   AUSGABE
// .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .
// .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .
// .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .   .


# $output = utf8_decode($output);
// echo 'xxxxxx'.$design;

/*
1) http://flhg.chung-shi.com?active=alluser (active all user)
2) http://flhg.chung-shi.com ?active=id_user(only active for 1 user)
*/

/* vu nam */
  //crontab
  if(isset($_POST['type'])) {
    switch($_POST['type']) {
        case 'result':
          checkResult($_POST);
    }
  }
  
  if(isset($_POST['numberLessonBefore']))
   checkContinueLesson();
  
  if(isset($_GET['crontab']))
  {
   crontab(14);
  }
  // Ajax for register
  if(isset($_POST['register']))
 {
    $name=$_POST['username'];
    $password=md5($_POST['password']);
    $email=$_POST['email'];
    $token=md5(uniqid(rand(30,100), true));
    $anrede=$_POST['title'];
    $Vorname=$_POST['Vorname'];
    $name1=$_POST['name'];
    $Strasse=$_POST['Strasse'];
    $Hausnummer=$_POST['Hausnummer'];
    $Plz=$_POST['Plz'];
    $ort=$_POST['ort'];
    $country=$_POST['country'];
    $Geburtsdatum=$_POST['Geburtsdatum'];
    $Schuhgrosse=$_POST['Schuhgrosse'];
    $email_gesch=$_POST['email_gesch'];
    $Telefonnummer_privat=$_POST['Telefonnummer_privat'];
    $Telefonnummer_geschaft=$_POST['Telefonnummer_geschaft'];
    $Beschaftigt_bei=$_POST['Beschaftigt_bei'];
    $beschaftigt_als=$_POST['beschaftigt_als'];
    $beschaftigt_seit=$_POST['beschaftigt_seit'];
    /*
    //check exist user
    $sql="select uid from user where uname='".$name."'";
    $res = safe_query($sql);
    $row = mysqli_fetch_object($res);
    if($row->uid!="")
    {
       echo "<p class='error'>Benutzername existiert - bitte registrieren Sie sich mit einem anderen Benutzernamen.</p>";
       $class='error';
    }*/

	$emailLogo = '<img src="http://www.chung-shi.com/images/logo.jpg" alt="">';
	$format = '<p style="font-family:arial;color:#666;">';

    //check exist email
    $sql="select uid from user where email='".$email."'";
    $res = safe_query($sql);
    $row = mysqli_fetch_object($res);
    if($row->uid!="")
    {
       echo  "<p class='error'>Private E-Mail Adresse existiert - bitte registrieren Sie sich mit einer anderen E-Mail Adresse.</p>";
       $class='error';
    }
    if($class=="")
    {
        //print_r($_POST);
        //insert table user
        $sql="insert into user(uname,pw,email,active,token,Anrede,Vorname,name,Strasse,Hausnummer,Plz,ort,land,Geburtsdatum,Schuhgrosse,
        email_gesch,telefonnummer_privat,Telefonnummer_geschaft,Beschaftigt_bei,beschaftigt_als,beschaftigt_seit) values('".$name."','".$password."','".$email."',0,'".$token."'
        ,'".$anrede."','".$Vorname."','".$name1."','".$Strasse."','".$Hausnummer."','".$Plz."','".$ort."',".$country.",'".$Geburtsdatum."',
        '".$Schuhgrosse."','".$email_gesch."','".$Telefonnummer_privat."','".$Telefonnummer_geschaft."','".$Beschaftigt_bei."','".$beschaftigt_als."',
        '".$beschaftigt_seit."')";
        //echo $sql;
        safe_query($sql);
        //send email to active
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
		$headers .= 'From: chung shi Fernlehrgang <fernlehrgang@chung-shi.com>' . "\r\n";
        $message=$emailLogo.'<br><br>'.$format.'Bitte klicken Sie auf den nachfolgenden Link um Ihren Account freizuschalten.<br><br>';
        $message.="<a href='".$morpheus["local"]."?token=".$token."'>".$morpheus["local"]."/?token=".$token."</a></p>";
        //echo $message;
        $subject="Aktivieren Sie Ihren Account";
        mail($email,$subject,$message,$headers);
        echo $emailLogo.'<br><br>'.$format.'Vielen Dank f&auml;r Ihre Registrierung. Sie erhalten eine E-Mail zur Aktivierung Ihres Account</p>';
    }

    return;
 }
 //END AJax register
 //Logout
 if(isset($_POST['logout']))
 {
    $_SESSION["username"]="";
 }
 //End logout
 //Check login
 if(isset($_POST['login']))
 {
    $email=$_POST['email'];
    $password=md5($_POST['password']);
    $sql="select * from user where email='".$email."' and pw='".$password."' and active=1";
    //echo $sql;
    $res = safe_query($sql);
    $row = mysqli_fetch_object($res);
    //print_r($row);
    if($row->uid!="")
    {
        $design=2;
        $_SESSION["username"]=$row->Vorname.' '.$row->Name;
        $_SESSION["id_user"]=$row->uid;
        $_SESSION['email']=$row->email;
    }

    else
    {
       $message="<p class='error'>Falsche E-Mail oder Passwort</p>";
    }
 }
 //END check login
 //Check session login
 if($_SESSION["username"]!="")
  $design=2;
 if(isset($_GET['profile']))
  $design=3;
 //End check session login
 // Ajax for check test online
 if(isset($_POST['test']))
 {

     //print_r($_POST); die();
     $date_test=date('Y-m-d');
     $id_user=$_POST['id_user'];
     $test=$_POST['test'];
     $value=$_POST['value'];

     // if test not pass
     if($_POST['status']==0)
     {
        //echo "1";
        // check enought 3 times
        $sql="SELECT COUNT( id ) AS count FROM  user_test WHERE id_user =".$id_user." AND test =".$test." AND STATUS =0";
        $res = safe_query($sql);
        $row = mysqli_fetch_object($res);
        //if enought 3 times
        if($row->count==3)
            echo 'Sie haben den Test zum 3. Mal nicht bestanden.<br>Damit haben Sie den Fernlehrgang nicht bestanden.';
        // if not enought 3 times
        else
        {
            $count=$row->count+1;
            $rest_test=3-$count;
            // if faild 2 times
            if($row->count==2)
              echo 'Sie haben den Test zum 3. Mal nicht bestanden.<br>Damit haben Sie den Fernlehrgang nicht bestanden.';
            //if faild <2 times
            else
              echo 'Sie haben die Fernlehrgang-Pr&uuml;fung zum '.$count.'. Mal nicht bestanden.<br><br>Sie k&ouml;nnen die Fernlehrgang-Pr&uuml;fung noch '.$rest_test.' Mal durchf&uuml;hren.';
            // insert database to save this test
            $sql="insert user_test(id_user,date_test,test,status,value)values(".$id_user.",'".$date_test."',".$test.",0,'".$value."')";
            safe_query($sql);
        }
     }
     // if test pass
     else
     {
        //echo "2";
        // insert database to save this test
            $sql="insert user_test(id_user,date_test,test,status,value)values(".$id_user.",'".$date_test."',".$test.",1,'".$value."')";
            safe_query($sql);
        // update next test
        $test+=1;
        if($test<6)
        {
          $sql="insert into user_test_active(id_user,test,active)values(".$id_user.",".$test.",0)";
          safe_query($sql);
          echo 'Herzlichen Gl&uuml;ckwunsch. Sie haben diese Fernlehrgangs-Pr&uuml;fung bestanden.<br><br>In 2 Wochen erhalten Sie die Freigabe f&uuml;r die n&auml;chste Pr&uuml;fung.';
        }

        elseif($test == 6)
        {
          $sql="insert into user_test_active(id_user,test,active)values(".$id_user.",".$test.",1)";
          safe_query($sql);
          echo 'Herzlichen Gl&uuml;ckwunsch. Sie haben den Fernlehrgang bestanden.<br><br>Sie erhalten von uns Ihr Zertifikat per E-Mail.';
		  echo "<br>";
          // create pdf
          // PDF ready
          //get vorname, adress, gerbu
          $sql="SELECT * FROM  user WHERE uid =".$_SESSION[id_user]."";
		  #echo "<br>";
          $res = safe_query($sql);
          $row = mysqli_fetch_object($res);
          $Vorname=$row->Vorname.' '.$row->Name;
		  #echo "<br>";
          $address=$row->Strasse.' '.$row->Hausnummer.', '.$row->Plz.' '.$row->ort.' ';
		  #echo "<br>";
          $gerbu=($row->Geburtsdatum);

/*
          $html = '<!DOCTYPE html>
<html lang="en">
<head>
  <style>
    .footer{background:url("icon/img1.gif") no-repeat;padding-top:200px;padding-left:20px;font-weight:bold;}
    .footer p{margin:0;font-size:38px;padding-top:20px;padding-bottom:20px;text-align:center;line-height:25px}
    .header{padding-top:10px;padding-bottom:10px;border-top:2px solid #000;border-bottom:2px solid #000;margin-top:20px;font-size:40px;text-align:center;font-weight:bold}
    .body{margin-top:100px}
    .border-top-1{margin-left:5px;border-top:1px solid #ccc}
    .text{padding-bottom:45px;font-size:14px;color:#A7A9AC}
    .text-detail{font-weight:bold;color:#000;position:absolute;top:160px}
    .pdf{width:90%;margin:0 auto}
  </style>
</head>
<body>
<div>';
$html.='
       <div class="pdf">
           <div class="header">
             ZERTIFIKAT
           </div>
           <div class="body">
             <div class="border-top-1"></div>
             <div class="text">'.$Vorname.'</div>
             <div class="border-top-1"></div>
             <div class="text">'.$address.'</div>
             <div class="border-top-1"></div>
             <div class="text">'.$gerbu.'</div>
             <div class="text-detail">
                Hat durch seine erfolgre telimehme Hat durch seine erfolgre telimehme  Hat durch seine erfolgre telimehme Hat durch seine erfolgre telimehme
                Hat durch seine erfolgre telimehme Hat durch seine erfolgre telimehme
             </div>
           </div>
           <div class="footer">
                Er/Sie erhalt die zusatzqalifikation
                <p>

                  Medizinischer Fachberater/in
                  fur chung-shi produkte.

                </p>
                Mit Gultigkeit bis zum
                <div style="height:20px"></div>
                <div style="border-top:1px solid #ccc">
                 DATUM
                  <div style="padding-top:20px;text-align:center">
                    <img src="icon/img3.png">
                     <img src="icon/img2.gif">
                  </div>
                </div>

           </div>
      </div>
       ';
*/

$html = '<!DOCTYPE html>
<html lang="en">
<head>
  <style>

   @font-face {
        font-family: Univers-55;
        src: url(../dompdf/Univers/Univers.otf);
   }

  html { margin: 0px 30px;  font-family:Univers-55; }
  body {  font-family:Univers-55; }
 .body{margin-top:105px; font-family:arial; }

 .text{padding-bottom:28px; font-size:18px; color:#000; margin-left: 70px; font-family:Univers-55; }
 .text-detail{font-weight:bold;color:#000;position:absolute;top:160px}

 .pdf{width:100%;margin:0 auto; position:absolute; top:-1000px; }
 .datum { margin-left: 70px; margin-top:412px; font-family:Univers-55; font-size:18px; }
  </style>
</head>
<body>
		<img src="images/zertifikat.png" style="width:100%; margin-top:50px;" />
<div>';
$html.='
       <div class="pdf">

           <div class="body">
             <div class="text" style="padding-bottom:31px;">'.$Vorname.'</div>
             <div class="text">'.$address.'</div>
             <div class="text">'.$gerbu.'</div>


             <div class="datum">10.02.2023</div>
		  </div>
      </div>
       ';


          //echo $html ;die();
          $dompdf->loadHtml($html);
          // (Optional) Setup the paper size and orientation
          $dompdf->setPaper('A4', 'Horizontal');
          // Render the HTML as PDF
          $dompdf->render();
          $pdf = $dompdf->output();
          $file_location = "pdf/congratulation.pdf";
          file_put_contents($file_location,$pdf);
          //send email with attach pdf
            $files = "pdf/congratulation.pdf";
            $filename= "congratulation.pdf";
            $fp = fopen($files,"rb");
            $data = fread($fp,filesize($files));
            fclose($fp);
            $data = chunk_split(base64_encode($data));
            //end
            //header
            $email_body="Herzlichen Glückwunsch ".$_SESSION[username].".\n\nSie haben den chung shi Fernlehrgang bestanden.";
            $mime_boundary = "==Multipart_Boundary_x{$semi_rand}x";
            $headers = "From: $to";
            $headers .= "\nMIME-Version: 1.0\n" . "Content-Type: multipart/mixed;\n" . " boundary=\"{$mime_boundary}\"";
            //message
            $message = "This is a multi-part message in MIME format.\n\n" . "--{$mime_boundary}\n" . "Content-Type: text/plain; charset=\"utf-8\"\n" . "Content-Transfer-Encoding: 7bit\n\n" . $email_body . "\n\n";
            $message .= "--{$mime_boundary}\n";
            $message1 = "Content-Type: application/octet-stream; name=\"".basename($filename)."\"\n" .
                        "Content-Description: ".basename($filename)."\n" .
                        "Content-Disposition: attachment;\n" . " filename=\"".basename($filename)."\"; size=".filesize($files).";\n" .
                        "Content-Transfer-Encoding: base64\n\n" . $data . "\n\n";
            $message.=$message1;
            /* end */

            // $emailLogo

            //$headers = "From: $to\n";
        	//$headers .= "Reply-To: $email_address";
        	//mail($to,$email_subject,$email_body,$headers);
            mail($_SESSION['email'],"Herzlichen Glückwunsch zum bestandenen Fernlehrgang",$message,$headers);
        }
     }
 return;
 }
 //End Ajax for check test online
 //Ajax for get token when forget pw
 if($_POST['email_forgot_pw'])
 {
    //if get tolen
    if($_POST['token']=='')
    {
        $sql="select * from user where email='".$_POST[email_forgot_pw]."' and active=1";
        // echo $sql;
        $res = safe_query($sql);
        $row = mysqli_fetch_object($res);
        //if not exist email
        if($row->uid=='')
         echo 'Diese E-Mail Adresse ist bei uns nicht registriert.';
        //if exist email
        else
        {
            $token=md5(uniqid(rand(30,100), true));
            //update token for this email
            $sql="update user set token='".$token."' where email='".$_POST[email_forgot_pw]."' and active=1";
            safe_query($sql);
            //send email to this user
            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
            $message=	$emailLogo."$format<br><br>Anbei erhalten Sie einen Link, mit dem Sie Ihr Passwort zurücksetzen können:<br><br>";
            $message.=$token."</p>";
            //echo $message;
            $subject="Token für ein vergessenes Passwort";
            mail($_POST['email_forgot_pw'],$subject,$message,$headers);
            echo 'Wir haben Ihnen eine E-Mail mit einem Link gesendet, damit Sie Ihrem Account ein neues Passwort zuweisen können.';
        }
    }
    //else update password
    else
    {
       //check token
       $sql="select * from user where token='".$_POST[token]."' and email='".$_POST[email_forgot_pw]."'";
       $res = safe_query($sql);
       $row = mysqli_fetch_object($res);
       //if not exist token
       if($row->uid=='')
         echo 'Dieser Token wurde nicht vergeben. Bitte fordern Sie einen neuen Code an.';
       //else update password
       else
       {
          $sql="update user set pw='".md5($_POST['password'])."' where email='".$_POST[email_forgot_pw]."'";
          safe_query($sql);
          echo 'Sie haben Ihr Passwort erfolgreich ge&auml;ndert.';

       }
    }
   return;
 }
 //END
 //Ajax for show test pass
  if(isset($_POST['id_user_test']))
  {
     $id=$_POST['id_user_test'];
     
     $sql="select * from user_test where id=".$id."";
     $res = safe_query($sql);
     $row = mysqli_fetch_object($res);
     
     $value=explode(',',$row->value);
     $course_lesson =$row->level;
     $course_lesson = explode('_', $course_lesson);
     $number_lesson = $row->number_lesson;
     
     //echo $number_lesson; return;
     
     for($k = 1; $k <= $number_lesson; $k++) {
         $folder = 'questions/course'.$course_lesson[0].'/lesson'.$course_lesson[1].'/question'.$k.'.xml';
         
         $xml=simplexml_load_file($folder) or die("Error: Ein XML Fehler ist vorhanden. Bitte informieren Sie den <a href='mailto:post@pixel-dusche.de?subject=Fehler in der XML&body=Bitte XML $test pruefen.'>Admin</a>.");
         $title=$xml->title;
         $color=$xml->color;
         $questions=$xml->questions->question;
         //echo check_question('1_4',$value);return;
         ?>
         <h4 style="color: <?php echo $color ?>;"><?php echo $title ?></h4>
                               <?php for($i=0;$i<count($questions);$i++){?>
                                 <div class="content">
                                     <p style="color: <?php echo $color ?>;"><span class="title"><?php echo $questions[$i]->title ?></span> </p>
                                     <?php for($j=0;$j<count($questions[$i]->choose);$j++){
                                       $id= $course_lesson[0] . '_' . $course_lesson[1] . '_' .  ($i+1) . '_' . ($j+1);
                                     ?>
                                       <div class="text">
                                           <span><?php echo $alpha[$j] ?></span>
                                           <input <?php if(check_question($id,$value)) echo "checked" ?> type="checkbox" id="<?php echo $i+1; ?>_<?php echo $j+1; ?>"/>
                                           <label for="<?php echo $i+1; ?>_<?php echo $j+1; ?>"><span></span><?php echo $questions[$i]->choose[$j] ?></label>
                                       </div>
                                     <?php }?>
                                 </div>
    
                               <?php }?>
         <?php
         //return; 
     }
    return;
  }
 //END Ajax for show test pass
 //Download pdf
 if(isset($_GET['download']))
  {
     $test=$_GET['download'];
     $xml=simplexml_load_file("questions/question".$test.".xml") or die("Error: Cannot create object");
     $title=$xml->title;
     $color=$xml->color;
     $questions=$xml->questions->question;
     $alpha=array('A','B','C','D','E','F');
     $html='<h4 style="color:'.$color.'">'.$title.'</h4>';
     for($i=0;$i<count($questions);$i++)
     {
        $html.='<div class="content" style="margin-top: 30px;">';
        $html.='<p style="color:'.$color.'">'.($i+1).'.<span style="padding-left:10px">'.$questions[$i]->title.'('.$questions[$i][NumberChoose].')</span> </p>';
        for($j=0;$j<count($questions[$i]->choose);$j++)
        {
           $html.='<div class="text">';
           $html.='<span style="padding-right:10px">'.$alpha[$j].'.</span>';
           $html.='<span>'.$questions[$i]->choose[$j].'</span>';
           $html.='</div>';
        }
        $html.='</div>';
     }
     $dompdf->loadHtml($html);
    //$dompdf->loadHtml('helooo');


    // (Optional) Setup the paper size and orientation
    $dompdf->setPaper('A4', 'Horizontal');
    //$customPaper = array(0,0,520,1360);
    //$dompdf->set_paper($customPaper);
    // Render the HTML as PDF
    $dompdf->render();
    //$pdf = $dompdf->output();
    //$file_location = "pdf/test.pdf";
    //echo $file_location;
    //file_put_contents($file_location,$pdf);
    // Output the generated PDF to Browser
    //header('Content-Type: application/octet-stream');
    //header('Content-Disposition: attachment; filename="morpheus.pdf"');
    $dompdf->stream('test'.$_GET['download'].'online');
    return;
  }
  if(isset($_POST['data-folder'])) {
    if($_POST['onepage'] == 'true') {
        if($_POST['left-img'] != '' && $_POST['right-img'] != '')
          $design = 4;
        else if($_POST['left-img'] != '')
          $design = '4-1';
        else if($_POST['right-img'] != '')
          $design = '4-2';
        else
          $design = '4-3';     
    } else {
        if($_POST['left-img'] != '' && $_POST['right-img'] != '')
          $design = 5;
        else if($_POST['left-img'] != '')
          $design = '5-1';
        else if($_POST['right-img'] != '')
          $design = '5-2';
        else
          $design = '5-3';
    }
    //echo $design; die();
 }
 //End Download pdf
/* END */
include("design/header_inc.php");
include("design/top.php");
#include("design/sidebar-left.php");
//echo $design;
if ($design) 	include("design/design-".$design.".php");
else 			include("design/design-1.php");

include("design/footer_inc.php");

#echo $nav_ss. $nav_meta .$breadcrumb;
# include("nogo/nav_".$lan.".inc");
#echo $design;
?>