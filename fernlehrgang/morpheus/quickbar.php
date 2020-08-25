<?php
# # # # # # # # # # # # # # # # # # # # # # # # # # # 
# www.pixel-dusche.de                               #
# bj&ouml;rn t. knetter                                  #
# start 12/2003                                     #
#                                                   #
# post@pixel-dusche.de                              #
# frankfurt am main, germany                        #
# # # # # # # # # # # # # # # # # # # # # # # # # # # 

global $morpheus;

function saveData($datei,$data,$art)  {
	$write = fopen($datei,$art);	   		//oeffne datei zum schreiben der daten
	if ($write!=0) fwrite($write, $data);				   //write data
	fclose($write);
}

$url = $morpheus["url"];

echo '<div id=content_big class=text>';

$sitemap = '<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.google.com/schemas/sitemap/0.84"
xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
xsi:schemaLocation="http://www.google.com/schemas/sitemap/0.84 http://www.google.com/schemas/sitemap/0.84/sitemap.xsd">
<!-- Created by www.pixel-dusche.de - CMS morpheus -->
<!-- Last update of sitemap '.date("Y-m-d").' -->
';

$site_start = '<url>
<loc>';

$site_end = '</loc>
<lastmod>'.date("Y-m-d").'</lastmod>
<changefreq>weekly</changefreq>
<priority>0.5</priority>
</url>
';

foreach ($morpheus["lan_arr"] as $key=>$lang) {
	$home = $morpheus["home_ID"][$lang];
	include("../nogo/navarray_".$lang.".php");
	
	$arr 		= array();
	$arrSmap	= array();
	$navarr_ID	= array();
	$smap 		= $sitemap;
	
	$tld 		= "com";
	
	for ($i = 1; $i <= 5; $i++) {
		$sql  = "SELECT * FROM nav WHERE ebene=$i AND lang=$key";
		$res = safe_query($sql);
	
		while ($row = mysqli_fetch_object($res)) {
			$id 	= $row->navid;
			$nm 	= $row->name;
			$pa 	= $row->parent;
			$vi 	= $row->sichtbar;
			$nm 	= strtolower(eliminiere($nm));
			
			if ($pa) {
				$path 		= $arr[$pa].$nm."/";
				$arr[$id] 	= $path;
				if ($vi) $arrSmap[$id] = $path;
			}
			else {
#				if ($home != $id) {
					$arr[$id] 	= $nm."/";
					if ($vi) $arrSmap[$id] = $nm."/";
/*				}
				else {
					$arr[$id] 	= "";
					if ($vi) $arrSmap[$id] = "";
				}
*/			}
		}
	}
	
	foreach($arr as $id=>$path) {
		$navarr_ID[] = $id.'=>"'.$path.'"';
	}
	foreach($arrSmap as $id=>$path) {
		if ($home == $id && $lang == "de") $smap .= $site_start.$url.$path.$site_end;
		else $smap .= $site_start.$url.$path.$site_end;
	}
	
	#print_r($n_arr);
	# sort($arr);
	
// falls drop down menu gewuenscht
/*
	$sel = "<select name=\"search\" style=\"width:150px;\" class=\"qf\" onchange='qb(this.options[this.selectedIndex].value)'><option value='.'>Index</option>\n";
	foreach ($arr as $val) {
		$val = explode("|", $val);
		$nm  = repl('\+', " ", $val[0]);
		$na  = $val[1];
		
		$sel .= "<option value='$na'>$nm</option>\n";	
	}
	$sel .= "</select>";
*/	
	# saveData("../quickbar".$lang.".php",$sel,"w");
	
	if ($lang == "de") 	saveData("../sitemap.xml",$smap."</urlset>","w");
	else				saveData("../sitemap_".$lang.".xml",$smap."</urlset>","w");
#echo $smap;
	
	saveData("../nogo/navID_".$lang.".inc", '<?php $navID = array('.implode(", ", $navarr_ID).'); ?>', "w");
}
#die();
?>