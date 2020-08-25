<?php

/// ------------------ start der regulaeren sitemap.create


if(file_exists("lokal.dat")) $xmlpfad = $morpheus["local"];
else $xmlpfad = $morpheus["url"]; 

$lang_arr = array("1"=>"de");

##$offset_arr = array(3=>30, 4=>20, 5=>20, 6=>20, 7=>20, 10=>220,43=>54, 44=>20, 45=>20, 46=>20, 47=>344);
$offset_arr = array(1000=>1000);

foreach ($lang_arr as $lan_id=>$lan) {
	include("../nogo/navID_".$lan.".inc");
		
#	$que  	= "SELECT * FROM nav WHERE sichtbar=1 AND `lock` < 1 AND lang=$lan_id AND bereich=1 ORDER BY navid DESC";
#	$que  	= "SELECT * FROM nav WHERE sichtbar=1 AND lang=$lan_id AND bereich=1 ORDER BY navid DESC";
	$que  	= "SELECT * FROM nav WHERE sichtbar=1 AND lang=$lan_id ORDER BY navid DESC";
	$res 	= safe_query($que);
	$menge	= mysqli_num_rows($res);
	$rw 	= mysqli_fetch_object($res);
	
	$arr_H = array();
	$arr_S = array();
	
	for ($c=0; $c <= 400; $c++) {	
		$arr = "arr_".$c;		
		unset ($$arr);
	}
	
	# echo "wwww".print_r($arr_15, 1)."xxx<br>";
	
	//
	for($c=5; $c>0; $c--) {								// komplette nav auslesen und navid in die richtige reihenfolgen bringen
	#	$que  	= "SELECT * FROM nav where ebene=$c AND sichtbar=1 AND `lock` < 1 AND lang=$lan_id AND bereich=1 ORDER BY parent, sort";
	#	$que  	= "SELECT * FROM nav where ebene=$c AND sichtbar=1 AND lang=$lan_id AND bereich=1 ORDER BY parent, sort";
		$que  	= "SELECT * FROM nav where ebene=$c AND sichtbar=1 AND lang=$lan_id ORDER BY parent, sort";
		$res 	= safe_query($que);
		$num	= mysqli_num_rows($res);
		
		while ($rw = mysqli_fetch_object($res)) {
			$par	 = $rw->parent;
			$nid	 = $rw->navid;
		
			$arr	 = "arr_".$par;						// fuer jedes parent eine eigene globale mit dem parentwert schreiben
			$$arr .= $nid.'<!-- split:'.$nid.' -->,';	// das split wird mit dem navid wert belegt
			if ($par > $x) $x = $par;
		}
	}
	
	unset($tmp);
	
	for ($c=0; $c <= $x; $c++) {						// gehe alle navid durch. suche fuer jeden wert, ob ein split vorhanden ist
		$val 	= "arr_".$c;							// falls vorhanden wird am split gesplittet und der globale wert mittendrin eingesetzt
		$spl 	= explode("<!-- split:$c -->", $tmp);	// nicht die eleganteste methode, aber effektiv ;-) und scheint zu funken :-))
		$tmp	= $spl[0].",".$$val."," .$spl[1];
	}
	
	# echo $tmp;
	$new = explode(",", $tmp);							// temporaeren datensatz in array wandeln
	# print_r($new);
	
	$arr_H = array();
	
	foreach ($new as $val) {							// alle leeren elemente loeschen und neues nav-array schreiben
		if ($val) $arr_H[] = "$val";
	}
	# print_r($arr_H);
	
	// jetzt gehts los. jeden wert in en oder de auslesen und richtigen link erzeugen!
	
	$lnk_arr = array();
	$nm_arr  = array();
	
	$output = '<?php  $output .= \'<ul class="">';
		
	foreach ($arr_H as $val) {
		$y++;
		if ($lastid != $val) {
			settype($val, "integer");	# warum auch immer der typ festgesetzt werden muss. bei einigen abfragen gab es fehler :-((
			$que  	= "SELECT * FROM nav where navid=$val";
			$res 	= safe_query($que);
			$rw 	= mysqli_fetch_object($res);
			
			$nm 	= $rw->name;
			$par	= $rw->parent;
			$ebene	= $rw->ebene;
			$nid	= $rw->navid;
			$lock	= $rw->lock;
		
			// link id's einsetzen
			$lnk_arr[$ebene] = $nid;
			$linkX			 = "";
			
			// nav namen einsetzen
			$nm_arr[$ebene]  = $nm;
			$nnm			 = "";
			$top			 = 0;
			$noNav			 = 0;
			
			if ($ebene < 2) {
				$nnm	= eliminiere($nm_arr[1])."/";
				if($nm) $hl_format 	= '<b><a href="'.$xmlpfad.$navID[$nid].'">'.($nm).'</a></b>';
				$einzug		= 2;
#				if ($val < 21) $top		= 10;
##				if ($val < 20) $noNav	= 1;
				$hn_nm		= "hn".$val; 
				$$hn_nm		= $navID[$val];
				// $output .= '</div><div style="width:200px;display:inline;float:left;border-left: solid 1px #e2e2e2;margin:0 30px 0 50px;min-height:150px;">';
				$output .= '</ul><ul class="stichwort1">';
				$i = 0;
			}
			else {
				$linkX = $lnk_arr[$ebene];
				for ($i=1; $i<=$ebene; $i++) {
					# echo $linkX .= "-".$navID[$lnk_arr[$i]];
					$nnm    = eliminiere($nm_arr[$i])."/";
					if($i>2) $einzug = (5 * $i);
				}
				$hl_format = "$nm";
				$back		= "";				
			}
							
			if ($noNav) $output .= '<li>'.$hl_format.'</li>
';
			else $output .= '<li class="stichwort'.$i.'"><a href="'.$xmlpfad.$navID[$nid].'"><i class="fa fa-caret-right"></i> &nbsp; '.$hl_format.'</a></li>
';

		}
	}

#	$xmlpfad = "/peakom/";

	$output .= '</ul>';
	$output .= '\'; ?>';
		
	save_data("../page/sitemap_".$lan.".inc",$output,"w");
	//die();
	save_data("../xml/menu_".$lan.".xml",$xml,"w");
	unset($output);
	unset($xml_set);
}
//die();
?>