<?php
/* Zeichenkette in Zahl umwandeln

$num = intval($string);           //in Ganzzahl umwandeln
$num = floatval($string);         //in Gleitkommazahl

	Zahl in Zeichenkette
$str = strval($zahl);

  	Prüfen, ob variable bereits verwendet wurde
if ( isset($variable) ) { ... }

  	Typprüfungen
   if ( is_numeric($variable) ) { ... }   //numerischer Typ
   if ( is_string($variable) ) { ... }    //Zeichenkette
*/
global $lan, $navID, $sear;

$sear = 1;
$suche = isset($_GET["suche"]) ? $_GET["suche"] : '';
// print_r($_GET);

$suche 	= trim(utf8_decode($suche));
// $suche 	= substr(trim(utf8_decode($suche)),0,30);


// TRACKING der Suchbegriffe //
$dat = date("Y-m-d H:m:s");
$sql = "INSERT morp_suche_track set suche='$suche', time='$dat'";
safe_query($sql);
// ===========================================================//

$ersetz	= array ("ä","ö","ü","Ä","Ö","Ü","ß");
$durch = array ("ae","oe","ue","Ae","Oe","Ue","ss");
$suche = str_replace($ersetz, $durch, $suche);


$ersetz	= array (" und ",  " and ",  " oder ",  " or ",  ' + ',  ' +',  '+ ',  '+');
$marker = str_replace($ersetz, array(" ", " ", " ", " ", " ", " ", " ", " "), $suche);
$sstr 	= explode(" ", $marker);
$sstr 	= array_unique($sstr);

// print_r($sstr);
$newarr = array();
foreach ($sstr as $search) {
	if($search) $newarr[] = $search;
}
$sstr = $newarr;

$db1 	= "morp_suche_count";
$db2 	= "morp_suche_keyw";
$anz 	= "anz".$lan;

$output = '';

$output .= '<h3 class="lila">'.implode(" UND ", $sstr).'</h3>
	<p>&nbsp;</p>
';

# $arr 	= array(1=>"Inhalt", 2=>"connect-uebersicht", 3=>"connect-detail", 4=>"Seminar");

$arr 	= array(1=>"Inhalt");

$sql 	= "SELECT mc1.navid, mc1.art FROM ";
$whe 	= " WHERE ";
$x	 	= 0;
$ersetz = array();
$ersetzP = array();


foreach ($sstr as $search) {
	if($search) {
		$x++;
		$ersetz[]  = '<span class="marker">'.strToUpper($search).'</span>';
		$ersetzP[] = '<strong>'.strToUpper($search).'</strong>';

		$sql .= ($x > 1 ? ", " : "") . "$db1 mc".$x.", $db2 mk".$x;

		$whe .= ($x > 1 ? " AND " : "") . "
			mc".$x.".kid=mk".$x.".kid AND
			mk".$x.".keyw LIKE '%".$search."%'";

		if ($x > 1) $whe .= " AND mc1.navid=mc".$x.".navid ";
	}
}

 $sql .= $whe ."
		ORDER BY mc1.$anz, mc1.art ASC
";


/*
	ack! query failed: <li>errorno = 1146<li>error = Table 'd01c0710.morp_suche_track' doesn't exist<li>query=INSERT morp_suche_track set suche='LaserCUSING', time='2015-05-19 12:05:00'


	SELECT mc1.navid, mc1.art FROM morp_suche_count mc1, morp_suche_keyw mk1 WHERE
			mc1.kid=mk1.kid AND
			mk1.keyw LIKE '%LaserCUSING%'
		ORDER BY mc1.anzde, mc1.art ASC
*/


// die();

$res = safe_query($sql);
$n 	 = mysqli_num_rows($res);


$arr1 = array();
$arr2 = array();
$arr3 = array();

while ($row = mysqli_fetch_object($res)) {
	#$id  = $row->kid;
	#$de  = $row->keyw;
	$ni  = $row->navid;
	$art = $row->art;
	#$stid = $row->stid;
	#$an  = $row->$anz;

	$tmp = "arr".$art;
	if ($art && $ni) {
		array_push($$tmp, $ni);
	}
}


# print_r($arr1);
# print_r($arr2);
# print_r($arr3);
# print_r($arr4);
# print_r($marker);
# print_r($ersetz);

if (count($arr1) > 0) {
	$such = implode($arr1, " OR n.navid=");

	$sql = "SELECT n.navid, name FROM nav n, content c
			WHERE
				n.navid=c.navid AND
				(
				n.navid=$such
				)
			GROUP BY n.navid
	";

	$res = safe_query($sql);
	$ct  = mysqli_num_rows($res);

	$output .= '<h4 class="lila nml">Treffer </h4>
';

	while ($row = mysqli_fetch_object($res)) {
		$id  = $row->navid;
		$de  = $row->name;
		# $co  = substr(get_raw_text($row->content), 0, 2000);
//		$co  = get_raw_text($row->content);
		# $co  = get_cms_text($row->content, $lan, $dir);

		$anzeige = 0;

		// if (strpos($co, "produktbox")) unset($anzeige);

/*
		if (($anzeige)) {
			// content holen und in einzelne saetze zerlegen
			$str 	 = str_replace(array("\r", "\n", "\t", "&nbsp;", "  "), " ", strip_tags($co));
			$str_arr = explode(".", $str);
			$ausg	 = "";

			foreach($str_arr as $satz) {
				unset($tmp);
				foreach ($sstr as $val) {
					if (stripos($satz, $val) > 0 && !$tmp) $tmp = $satz."... ";
				}
				if ($tmp) $ausg .= $tmp;
			}

			$ausg = str_ireplace($sstr, $ersetz, $ausg);
		}
		$output .= '<h2 class="serg">&raquo; <a href="'.$dir.$navID[$id].'">'.$de.'</a></h2>
					' .($ausg ? '<p>'.$ausg.'</p>' : '<p>'.substr($co, 0, 80).'...</p>') .'
';
*/
		$output .= '<p class="suche"><a href="'.$dir.$navID[$id].'"><i class="fa fa-chevron-right sml gelb"></i> '.$de.'</a></p>
';
	}
}

//////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////
if (count($arr2) > 0) {
// SAUER SPEZIAL
	$sql = "SELECT n.navid, name FROM nav n, content c
			WHERE
				n.navid=c.navid AND
				(
				n.navid=14
				)
			GROUP BY n.navid
	";

	$output .= ($output ? '<br/>' : '').'<h4 class="lila nml">Treffer Produkte</h4>
';

	$res = safe_query($sql);
	$ct  = mysqli_num_rows($res);

	while ($row = mysqli_fetch_object($res)) {
		$id  = $row->navid;
		$de  = $row->name;
		$output .= '<p class="suche"><a href="'.$dir.$navID[$id].'"><i class="fa fa-chevron-right sml gelb"></i> Produkte '.$de.'</a></p>
';
	}
}
//////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////
if (count($arr3) > 0) {
// SAUER SPEZIAL
	$sql = "SELECT n.navid, name FROM nav n, content c
			WHERE
				n.navid=c.navid AND
				(
				n.navid=13
				)
			GROUP BY n.navid
	";

	$output .= '<h4 class="lila nml">Treffer Stellenangebote</h4>
';

	$res = safe_query($sql);
	$ct  = mysqli_num_rows($res);
	$row = mysqli_fetch_object($res);
	$id  = $row->navid;
	$de  = $row->name;
	$link = $dir.$navID[$id];
	$link = substr($link, 0, (strlen($link)-1));

	foreach($arr3 as $val) {
		$sql = "SELECT st_name FROM morp_stellen WHERE sid=$val";
		$rs = safe_query($sql);
		$rw = mysqli_fetch_object($rs);
		if($rw->st_name) $output .= '<p class="suche"><a href="'.$link.'-'.$val.'/"><i class="fa fa-chevron-right sml gelb"></i> '.$rw->st_name.'</a></p>
';
	}
}


//////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////


$output .= '';

	if ($ct < 1 && $cct < 1) $output = '
	<h4 class="lila nml">Ihre Such-Anfrage "<i>'.$suche.'</i>" hat kein Ergebnis erzielt</h4>';

?>