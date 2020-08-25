<?php

/// ------------------ start der regulaeren sitemap.create


if(file_exists("../lokal.dat")) $xmlpfad = $morpheus["local"];
else $xmlpfad = $morpheus["url"]; 

$lang_arr = array("1"=>"de", "2"=>"en");


foreach ($lang_arr as $lan_id=>$lan) {
	include("../nogo/navID_".$lan.".inc");
		
	//$que  	= "SELECT * FROM nav WHERE (sichtbar=1 AND `lock` < 1 AND lang=$lan_id AND bereich <> 2) ORDER BY navid DESC";
	$que  	= "SELECT * FROM nav WHERE (sichtbar=1 AND lang=$lan_id AND bereich <> 2) ORDER BY navid DESC";
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
		//$que  	= "SELECT * FROM nav where (ebene=$c AND sichtbar=1 AND `lock` < 1 AND lang=$lan_id AND bereich <> 2) ORDER BY parent, sort";
		$que  	= "SELECT * FROM nav where (ebene=$c AND sichtbar=1 AND lang=$lan_id AND bereich <> 2) ORDER BY parent, sort";
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
	 print_r($arr_H);
	
	// jetzt gehts los. jeden wert in en oder de auslesen und richtigen link erzeugen!
	
	$lnk_arr = array();
	$nm_arr  = array();
	
	$footer_set = '<?php  $footer = \'	
';
		
	$ausnahme = array(999);		// das sind hauptnavigatiosIDs, die direkt ein zusätzliches modul bedienen
	$n=0;
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
			$ilnk	= $rw->lnk;
			$lock	= $rw->lock;
		
			if($lock) $lock = '<span class="fa fa-lock"></span> &nbsp;';
			else $lock = '';
			
			// link id's einsetzen
			$lnk_arr[$ebene] = $nid;
			$linkX			 = "";
			
			// nav namen einsetzen
			$nm_arr[$ebene]  = $nm;
			$nnm			 = "";	

			if ($ebene < 2) { 
				$n++;
				$togo = $ilnk ? $ilnk : $val;
				$lnk = '<a href="'.$xmlpfad.$navID[$togo].'">'.($nm).'</a>';
				
				$cl = "parent";
				$footer_set .= ($sub_on2 ? '</ul>
		</li>	
' : '') .($sub_on ? '</ul>
		</li>	
' : '') .'		
		<li class="'.$cl.' n__'.$val.'">'.$lnk.'
		 	<ul class="sub-menu'.$n.'">';
				$sub_on = 1;
				$sub_on2 = 0;
				$sub_on3 = 0;
				$sub_on4 = 0;
				
			}
			
/*********************************************************************/
			
			elseif ($ebene == 2 && $par > 1) {
				if (!$sub_on) {
					$footer_set .= '	
';
					$sub_on = 1;
				}
				$footer_set .= ($sub_on2 ? endUL(1) : endUL(0)).($sub_on3 ? endUL(1) : endUL(0)).($sub_on4 ? endUL(1) : endUL(0)).'				<li><a href="'.$xmlpfad.$navID[$val].'" title="'.($nm).'">'.$lock.($nm).'</a>';
				$sub_on2 = 0;
				$sub_on3 = 0;
				$sub_on4 = 0;
			}
			
			
/*********************************************************************/

			
			elseif ($ebene == 3 && $par > 1) {
				if (!$sub_on2) {
					$footer_set .= '
				<ul>
';
					$sub_on2 = 1;
				}
				$footer_set .= ($sub_on3 ? endUL(1) : endUL(0)).($sub_on4 ? endUL(1) : endUL(0)).'						<li><a href="'.$xmlpfad.$navID[$val].'" title="'.($nm).'">'.$lock.($nm).'</a></li>
';
				$sub_on3 = 0;
				$sub_on4 = 0;
			}

/*********************************************************************/

			
			elseif ($ebene == 4 && $par > 1) {
				if (!$sub_on3) {
					$footer_set .= '
				<ul>
';
					$sub_on3 = 1;
				}
				$footer_set .= ($sub_on4 ? endUL(1) : endUL(0)).'						<li><a href="'.$xmlpfad.$navID[$val].'" title="'.($nm).'">'.$lock.($nm).'</a></li>
';
				$sub_on4 = 0;
			}

/*********************************************************************/

			
			elseif ($ebene == 5 && $par > 1) {
				if (!$sub_on4) {
					$footer_set .= '
				<ul>
';
					$sub_on4 = 1;
				}
				$footer_set .= '						<li><a href="'.$xmlpfad.$navID[$val].'" title="'.($nm).'">'.$lock.($nm).'</a></li>
';
			}
		}
	}

	
	$que  	= "SELECT * FROM nav WHERE ebene=1 AND sichtbar=1 AND lang=$lan_id AND bereich = 2 ORDER BY `sort`";
	$res 	= safe_query($que);
	$nav_meta = '';
	
	while ($rw = mysqli_fetch_object($res)) {
		$par	 = $rw->parent;
		$nid	 = $rw->navid;
		$nm	 	 = $rw->name;
		$name	 = eliminiere($nm);
		
		$nav_meta .= '		<li><a href="'.$xmlpfad.$lan.'/'.$navID[$nid].'" title="'.$name.'"><strong>'.$nm.'</strong></a></li>'."\n\t";		
	}

	
#	$xmlpfad = "/peakom/";
	$footer_set = ' 
'.$footer_set.'</ul>
\';
?>
';


	$footer_set = preg_replace('/<ul class="sub-menu"><\/ul>/', '', $footer_set);
	save_data("../page/footer_".$lan.".inc",$footer_set,"w");
	unset($footer_set);
}
echo "did";
// die();


function endUL($x) {
	return $x ? '
				</ul>
			</li>	
' : '</li>
';
}

?>