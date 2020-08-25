<?php

/// ------------------ start der regulaeren sitemap.create


if(file_exists("../lokal.dat")) $xmlpfad = $morpheus["local"];
else $xmlpfad = $morpheus["url"];

$lang_arr = array("1"=>"de", "2"=>"en");

foreach ($lang_arr as $lan_id=>$lan) {
	include("../nogo/navID_".$lan.".inc");

//	$que  	= "SELECT * FROM nav WHERE (sichtbar=1 AND `lock` < 1 AND lang=$lan_id AND bereich <> 2) ORDER BY navid DESC";
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
	for($c=3; $c>0; $c--) {								// komplette nav auslesen und navid in die richtige reihenfolgen bringen
//		$que  	= "SELECT * FROM nav where (ebene=$c AND sichtbar=1 AND `lock` < 1 AND lang=$lan_id AND bereich <> 2) ORDER BY parent, sort";
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
	# print_r($arr_H);

	// jetzt gehts los. jeden wert in en oder de auslesen und richtigen link erzeugen!

	$lnk_arr = array();
	$nm_arr  = array();

	$footer_set = '<?php  $nav = \'
';
	$sub_on	= 0;
	$subsub_on	= 0;
	$subsub_ende = 0;
	$sub_on1	= 0;
	$subsub_on1	= 0;
	$subsub_ende1 = 0;
	$ausnahme = array(999);		// das sind hauptnavigatiosIDs, die direkt ein zusätzliches modul bedienen
	$start = 1;

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
			$anker	= $rw->anker;
			// link id's einsetzen
			$lnk_arr[$ebene] = $nid;
			$linkX			 = "";

			// nav namen einsetzen
			$nm_arr[$ebene]  = $nm;
			$nnm			 = "";


/*
							<li class="dropdown menu-item menu-item-has-children">
								<a><span>Services</span></a>
								<ul class="sub-menu">
									<li class="menu-item"><a href="service_four.html"><span>Four Columns Services Page</span></a></li>
									<li class="menu-item"><a href="service_three.html"><span>Three Columns Services Page</span></a></li>
									<li class="menu-item"><a href="service_two.html"><span>Two Columns Services Page</span></a></li>
								</ul>
							</li>
*/
			if ($ebene < 2) {
				// wenn keine subnavigation gesetzt - platzhalter loeschen
				if (!$subsub_on) $footer_set = str_replace(array('xx'.$par.'xx', 'SPAN'), array('', ''), $footer_set);

				$togo = $ilnk ? $ilnk : $nid;
				$lnk = '<a href="'.$xmlpfad.$navID[$togo].'" class="n'.($togo).'dropdown-toggle" data-toggle="dropdown"><span>'.($nm).'</span></a>';
#				$lnk = '<a href="" class="n'.($togo).'">'.($nm).'</a>';

				$footer_set .= ($subsub_on1 ? '
				</ul>
				<div class="clearfix"></div>
 ' : '');
				// subnavigation abschliessen
				$footer_set .= $start ? '' : ($subsub_ende ? '</li>
				</ul>
				<div class="clearfix"></div>
' : '</li>');
				$start = 0;
				// hauptnav abschliessen
				$footer_set .= ($sub_on ? '			</li>
' : '') .'
			<li class="dropdown yy'.$nid.' xx'.$nid.'xx to">'.$lnk.'';

				// parameter, die z.T. ueberpruefen, ob eine subnavi aufgerufen wird
				$lasturl = $navID[$nid];
				$sub_on = 1;
				$subsub_on = 0;
				$subsub_ende = 0;
				$subsub_on1 = 0;
				$subsub_ende1 = 0;
				$lastname = $nm;
				$lastid = $nid;
			}

			elseif ($ebene == 2 && $par > 1) {
				// platzhalter aus hauptnav beim ersten durchlauf loeschen
				if (!$subsub_on) {
//					$footer_set = str_replace(array('xx'.$par.'xx', 'SPAN'), array('submenu', '<span class="caret"></span>'), $footer_set);
//					$footer_set = str_replace(array('SPAN', 'ref="'.($lastid).'"'), array('<!--<span class="caret"></span>-->', ' dropdown-toggle tog" data-toggle="dropdown"'), $footer_set);
					$footer_set = str_replace(array('yy'.$lastid, 'ref="'.($lastid).'"'), array(' ', ''), $footer_set);
				}
				$lasturl = 0;
				$footer_set .= ($subsub_on1 ? '
				</ul></li>
' : '
');

				$footer_set .= (!$subsub_on ? '
				<ul class="dropdown-menu">
' : '');

				// parameter werden gesetzt. subnav vorhanden !!!!
				$subsub_on = 1;
				$subsub_on1 = 0;
				$subsub_ende = 1;
				$footer_set .= '						<li class="s'.($nid).' versBold"><a href="'.$xmlpfad.$navID[$val].'" title="'.($nm).'">'.($nm).'</a>';
			}

			elseif ($ebene == 3 && $par > 1) {
				$footer_set .= (!$subsub_on1 ? '
				<ul>
' : '');

				// parameter werden gesetzt. subnav vorhanden !!!!
				$subsub_on1 = 1;
				$subsub_ende1 = 1;


				$footer_set .= '						<li class="ss'.($nid).'"><a href="'.$xmlpfad.$navID[$val].($anker ? '#'.$anker : '').'" title="'.($nm).'">'.($nm).'</a></li>
';
			echo $xmlpfad.$navID[$val].'<br>';

				//else $footer_set .= '						<li class="ss'.($nid).'">'.($nm).'</li>';
			}
		}
	}

	if ($lasturl) $footer_set = str_replace(array('SPAN', ''), '', $footer_set);

/*
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
*/

#	$xmlpfad = "/peakom/";
echo	$footer_set = $footer_set.'	'.$nav_meta.'	</li>
\';
?>
';

	save_data("../nogo/nav_".$lan.".inc", $footer_set, "w");
	unset($footer_set);
}
 // die();
?>