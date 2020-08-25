<?php
session_start();
# # # # # # # # # # # # # # # # # # # # # # # # # # #
# www.pixel-dusche.de                               #
# bjoern t. knetter                                  #
# start 12/2003                                     #
#                                                   #
# post@pixel-dusche.de                              #
# frankfurt am main, germany                        #
# # # # # # # # # # # # # # # # # # # # # # # # # # #

// print_r($_POST);

function reorganize($akt) {
	$query = "SELECT * FROM galerie_name where ggid=$akt order by sort, date, gnid";
	$result = safe_query($query);
	$sort_arr = array();

	while ($row = mysqli_fetch_object($result)) {
	 	$sort_arr[] = $row->gnid;
	}

	$x = 0;
	foreach ($sort_arr as $val) {
		dbconnect();
		$x++;
		$query = "update galerie_name set sort=$x where gnid=$val";
		$result = safe_query($query);
	}
}

function reorganize_galerie($akt) {
	$query = "SELECT * FROM galerie_name gn, galerie g WHERE g.gnid=gn.gnid AND g.gnid=$akt order by g.sort, gid";
	$result = safe_query($query);
	$sort_arr = array();

	while ($row = mysqli_fetch_object($result)) {
	 	$sort_arr[] = $row->gid;
	}

	$x = 0;
	foreach ($sort_arr as $val) {
		$x++;
		$query = "update galerie set sort=$x where gid=$val";
		$result = safe_query($query);
		$result = safe_query($query);
	}
}

function split_dir ($dir) {
	$dir = explode("/", $dir);
	$x = count($dir) - 2;
	for($i=0; $i<$x; $i++) {
		$nd .= $dir[$i] ."/";
	}
	return $nd;
}

include("cms_include.inc");
// include("editor.php");

# navigationspunkt l&ouml;schen????
$save 	 = $_REQUEST["speichern"];
$ednm 	 = $_REQUEST["ednm"];
$name 	 = $_REQUEST["name"];
$del 	 = $_REQUEST["del"];
$neu 	 = $_REQUEST["neu"];
$list 	 = $_REQUEST["list"];
$delete	 = $_REQUEST["delete"];
$olddir	 = $_REQUEST["olddir"];
$deldir	 = $_REQUEST["deldir"];
$deldirok = $_REQUEST["deldirok"];
$ggid	 = $_REQUEST["ggid"];
$gnid	 = $_REQUEST["gnid"];
$gid	 = $_REQUEST["gid"];
$edit 	 = $_REQUEST["edit"];
$si 	 = $_REQUEST["si"];
$db 	 = $_REQUEST["db"];

$imgdelete = $_POST["imgdelete"];
$newsort	= $_POST["newsort"];
# # # neu sortierung auch hier
$way	= $_REQUEST["way"];
$sid	= $_REQUEST["sortid"];
$reorg	= $_REQUEST["reorg"];
# # # # # # # # # # # # # # #
$wayrefresh = $_REQUEST["wayrefresh"];

$dir = '../Galerie';

if ($reorg) {
	reorganize($reorg);
	# dbconnect();
	$ggid = $reorg;
	$db = "galerie_name";
}

elseif ($si) {
	if ($si == 2) $si = 0;
	$query 	= "update galerie_name set sichtbar=$si where gnid=$gnid";
	$result = safe_query($query);
}

if ($ggid) {
	$query 	= "SELECT * FROM galerie_group where ggid=$ggid";
	$result = safe_query($query);
	$row 	= mysqli_fetch_object($result);
	$nmgg 	= $row->ggname;
	$dir  .= '/'.$nmgg ."/";
}
if ($gnid) {
	$query 	= "SELECT * FROM galerie_name where gnid=$gnid";
	$result = safe_query($query);
	$row 	= mysqli_fetch_object($result);
	$nmgn 	= $row->gnname;
	$dir .= $nmgn ."/";
}

# bild_galerie.php?ggid=1&name=schwimmen&db=galerie_name

if ($db == "galerie_name") {
	$dbid 	= "gnid";
	$dbnm 	= "gnname";
	$back = '<p><a href="bild_galerie.php?db=galerie_name&ggid=1&name=awiesa"><i class="fa fa-chevron-left small"></i> '.$MORPTEXT["GLOB-ZURUCK"].'</a></p>'; # nur fuer mike
	if($gnid) {}
	else $back = '';
	$gal	= "name";
	$id		= $ggid;
}
elseif ($db == "galerie" || $imgdelete) {
	$db 	= "galerie";
	$dbid 	= "gid";
	$dbnm 	= "gname";
	$id		= $gnid;
	$back = '<p><a href="bild_galerie.php?ggid='.$ggid.'&db=';
	if ($edit || $del) $back .= 'galerie&gnid='.$gnid;
	else $back .= 'galerie_name';
	$back .= '"><i class="fa fa-chevron-left small"></i> '.$MORPTEXT["GLOB-ZURUCK"].'</a></p>';
	$gal	= "foto";
}
else {
	$db		= "galerie_group";
	$dbid 	= "ggid";
	$dbnm 	= "ggname";
	$gal	= "group";
	$id		= $ggid;
//	$back = '<p><a href="bild_galerie.php?db='.$db'.">'.backlink().' zur&uuml;ck</a></p>';
}

$dirlist = repl("\.\./", "", $dir);
$dirlist = repl("/", " - ", $dirlist);

echo "<div id=content_big class=text>\n<p><b>".$MORPTEXT["IMG-HEADLINE"]."</b> &nbsp; <a> $dirlist</a></p>" .$back;
# echo $dir;
#
#

if ($imgdelete) {
	if ($_REQUEST["gid"]) {
		foreach ($_REQUEST["gid"] as $val) {
			$query = "SELECT * FROM galerie where gid=$val";
			$result = safe_query($query);
			$row = mysqli_fetch_object($result);
			$tn = $row->tn;
			$nm = $row->gname;

			$query = "delete FROM galerie where gid=$val";
			$result = safe_query($query);

			# protokoll($uid, "galerie", $delete, "del");

			@unlink($dir."hl_".$nm);
			@unlink($dir.$nm);
			@unlink($dir.$tn);
		}
	}
}


elseif ($newsort) {
	if ($_REQUEST["sid"]) {
		$arr = $_REQUEST["sid"];
		foreach ($arr as $key=>$val) {
			$query = "update galerie set sort=".$val." where gid=".$key;
			$result = safe_query($query);
		}
	}
}

elseif ($del) {
	$warnung = "<p>&nbsp;</p><p><font color=#ff0000><b>Wollen Sie ". ($del == "all" ? 'wirklich ALLE BILDER (!)' : 'das Bild wirklich') ." l&ouml;schen?</b></font></p>
<p><a href=\"bild_galerie.php?delete=$del&ggid=$ggid&gnid=$gnid&db=galerie\" title=\"Foto l&ouml;schen!\">" .ilink() ." endgueltig l&ouml;schen</a> &nbsp; &nbsp; &nbsp; <a href=\"bild_galerie.php?ggid=$ggid&gnid=$gnid&db=galerie\" title=\"Foto l&ouml;schen!\">" .ilink() ." nein</a></p>";
}

elseif ($deldir) {
	$warnung = "<p>&nbsp;</p><p><font color=#ff0000><b>Wollen Sie den Ordner wirklich l&ouml;schen?</b></font></p>
<p><a href=\"bild_galerie.php?deldirok=$deldir&ggid=$ggid&db=galerie_name\" title=\"Foto l&ouml;schen!\">" .ilink() ." endgueltig l&ouml;schen</a> &nbsp; &nbsp; &nbsp; <a href=\"bild_galerie.php?ggid=$ggid&db=galerie_name\" title=\"Foto l&ouml;schen!\">" .ilink() ." nein</a></p>";
}

elseif ($deldirok) {
	$query = "SELECT * FROM galerie where gnid=$deldirok";
	$result = safe_query($query);
	//echo mysqli_num_rows($result);

	while($row = mysqli_fetch_object($result)) {
		$tn = $row->tn;
		$nm = $row->gname;
		$delid = $row->gid;

		$sql = "delete FROM galerie where gid=$delid";
		$res = safe_query($sql);

		protokoll($uid, "galerie", $delid, "del");

		@unlink($dir."hl_".$nm);
		@unlink($dir.$nm);
		@unlink($dir.$tn);
	}
	$sql = "delete FROM galerie_name where gnid=$deldirok";
	$res = safe_query($sql);
	protokoll($uid, "galerie_name", $deldirok, "del");
}

elseif ($delete == "all") {
	$query = "SELECT * FROM galerie where gnid=$gnid";
	$result = safe_query($query);
	//echo mysqli_num_rows($result);

	while($row = mysqli_fetch_object($result)) {
		$tn = $row->tn;
		$nm = $row->gname;
		$delid = $row->gid;

		$sql = "delete FROM galerie where gid=$delid";
		$res = safe_query($sql);

		protokoll($uid, "galerie", $delid, "del");

		@unlink($dir."hl_".$nm);
		@unlink($dir.$nm);
		@unlink($dir.$tn);
	}
}

elseif ($delete) {
	$query = "SELECT * FROM galerie where gid=$delete";
	$result = safe_query($query);
	$row = mysqli_fetch_object($result);
	$tn = $row->tn;
	$nm = $row->gname;

	$query = "delete FROM galerie where gid=$delete";
	$result = safe_query($query);

	protokoll($uid, "galerie", $delete, "del");

	@unlink($dir."hl_".$nm);
	@unlink($dir.$nm);
	@unlink($dir.$tn);
}

elseif ($way) {
	if ($way == "up") $s2 = $sid - 1;
	else $s2 = $sid + 1;

	$sort_    = array($sid, $s2);
	$sort_new = array($s2, $sid);
	$sort_arr = array();

	if ($db == "galerie_name") {
		for($i=0; $i<=1; $i++) {
			$query  = "SELECT * FROM $db where ggid=$ggid and sort=$sort_[$i]";
			$result = safe_query($query);
			$row = mysqli_fetch_object($result);
			$sort_arr[] = $row->gnid;
		}
		for($i=0; $i<=1; $i++) {
			$query  = "update $db set sort=$sort_new[$i] where gnid=$sort_arr[$i]";
			safe_query($query);
		}
	}

	elseif ($db == "galerie_group")	{
		for($i=0; $i<=1; $i++) {
			$query  = "SELECT * FROM $db where sort=$sort_[$i]";
			$result = safe_query($query);
			$row = mysqli_fetch_object($result);
			$sort_arr[] = $row->ggid;
		}
	# print_r($sort_arr);
	#die();
		for($i=0; $i<=1; $i++) {
			$query  = "update $db set sort=$sort_new[$i] where ggid=$sort_arr[$i]";
			safe_query($query);
		}
	}

	else	{
		for($i=0; $i<=1; $i++) {
			$query  = "SELECT gid FROM galerie g, galerie_name gn where g.gnid=gn.gnid AND g.gnid=$gnid AND g.sort=$sort_[$i]";
			$result = safe_query($query);
			$row = mysqli_fetch_object($result);
			$sort_arr[] = $row->gid;
		}

		for($i=0; $i<=1; $i++) {
			$query  = "update $db set sort=$sort_new[$i] where gid=$sort_arr[$i]";
			safe_query($query);
		}
	}

	$edit = $liste;
	unset($liste);
	unset($tid);
}
elseif ($wayrefresh) {
	$arr = array();

	if ($db == "galerie_name") {
		$query  = "SELECT * FROM $db where ggid=$ggid order by sort";
		$result = safe_query($query);
		$ct		= mysqli_num_rows($result);
		if ($ct > 0) {
			while ($row = mysqli_fetch_object($result)) {
				$sort_arr[] = $row->gnid;
			}

			$x = 0;
			foreach($sort_arr as $id) {
				$x++;
				$query  = "update $db set sort=$x where gnid=$id";
				safe_query($query);
			}
		}
	}

	elseif ($db == "galerie") 	{
		$query  = "SELECT * FROM $db WHERE gnid=$gnid order by sort";
		$result = safe_query($query);
		while ($row = mysqli_fetch_object($result)) {
			$sort_arr[] = $row->gid;
		}

		$x = 0;
		foreach($sort_arr as $id) {
			$x++;
			$query  = "update $db set sort=$x where gid=$id";
			safe_query($query);
		}
	}

	else	{
		$query  = "SELECT * FROM $db order by sort";
		$result = safe_query($query);
		while ($row = mysqli_fetch_object($result)) {
			$sort_arr[] = $row->ggid;
		}

		$x = 0;
		foreach($sort_arr as $id) {
			$x++;
			$query  = "update $db set sort=$x where ggid=$id";
			safe_query($query);
		}
	}
}

elseif($save && $name) {
	if ($db == "galerie_name") {
		$set  = ", ggid=".$_REQUEST["ggid"];
		$set2 = ", date='".us_dat($_REQUEST["date"])."', textde='".$_REQUEST["textde"]."', texten='".$_REQUEST["texten"]."', gntextde='".$_REQUEST["gntextde"]."', gntexten='".$_REQUEST["gntexten"]."'";
		$id = $_REQUEST["gnid"];

		if ($_FILES) {
			$tmp  = $_FILES['image']['tmp_name'][0];
			$img  = strtolower($_FILES['image']['name'][0]);

			if ($img) {
				if (!move_uploaded_file($tmp, "../Galerie/".$img)) die("upload fehlgeschlagen!");

				chmod("../Galerie/".$img, 0777);
				$img_set = ", img='$img'";
			}
		}
	}

	if (!$neu) {
		$query = "update $db set $dbnm='$name' $img_set $set2 where $dbid=$id";
		$result = safe_query($query);
		protokoll($uid, $db, $id, "edit");
	}
	else {
		# echo $dir .$name;
		# die();
		mkdir($dir .$name, 0777);
		if(is_dir($dir.$name)) {
			$query = "insert $db set $dbnm='$name' $set $set2";
			$result = safe_query($query);
			$c = mysqli_insert_id($mylink);
			protokoll($uid, $db, $c, "neu");
		}
		else die ("<h2>Der Ordner konnte nicht erstellt werden!</h2>");
	}

	echo ' <script> document.location.href="bild_galerie.php?ggid='.$ggid.'&name='.$name.'&db='.$db.'";     </script>';

	die();

}

elseif($save && $edit) {
	$query = "update $db set gtextde='".$_POST["gtextde"]."', gtexten='".$_POST["gtexten"]."', gdatum='".($_POST["gdatum"])."' where gid=$edit";
	$result = safe_query($query);
}

elseif($edit) {
	$query = "SELECT * FROM $db where gid=$edit";
	$result = safe_query($query);
	$row = mysqli_fetch_object($result);
	$datum = $row->gdatum;
	if ($datum == "0000-00-00") $datum  = date("Y-m-d");

	$warnung = '<form method="post">
			<input type="Hidden" name="edit" value="'.$edit.'">
			<input type="Hidden" name="ggid" value="'.$ggid.'">
			<input type="Hidden" name="gnid" value="'.$gnid.'">
			<input type="Hidden" name="db" value="'.$db.'">
			<input type="Hidden" name="speichern" value="1">

<!--		<p>'.$MORPTEXT["BGAL-BTEXTE"].'</p>
		<p><textarea cols="" rows="3" name="gtexten" style="width:600px;">'.$row->gtexten.'</textarea></p>
-->
		<p>'.$MORPTEXT["BGAL-BTEXTD"].'</p>
		<p><textarea cols="" rows="3" name="gtextde" style="width:600px;">'.$row->gtextde.'</textarea></p>

		<p>'.$MORPTEXT["GLOB-DATUM"].'</p>
		<p><input type="text" name="gdatum" value="'.($datum).'" style="width:600px;"></p>

		<p style="margin: 20px 0px 20px 0px;"><input type="submit" class="button" name="speichern" value="'.$MORPTEXT["GLOB-SPEICHERN"].'"></p></form>
		<p><img src="../timthumb.php?w=800&amp;src='.substr($dir, 3,strlen($dir)).urlencode($row->gname).'"></p>';
}

# ordner galerie name verwalten
elseif($ednm) {
	$db	 	= $_REQUEST["db"];
	$dbnm	= $_REQUEST["dbnm"];
	$datum  = euro_dat($row->date);

	$warnung = '<form method=post enctype="multipart/form-data">
			<input type="Hidden" name="olddir" value="'.$dir.'">
			<input type="Hidden" name="ggid" value="'.$ggid.'">
			<input type="Hidden" name="gnid" value="'.$gnid.'">
			<input type="Hidden" name="db" value="'.$db.'">
			<input type="Hidden" name="speichern" value="1">
		<!-- <p>ordner - <strong>bitte keine leer- und sonderzeichen!</strong> - moeglichst nicht umbennen<br> -->
		<input type="hidden" name="name" value="'.$row->gnname.'" style="width:200px;"></p>

		<p>'.$MORPTEXT["FORMEXT-REIHENF"].'<br>
		<input type="text" name="sort" value="'.$row->sort.'" style="width:200px;"></p>

		<p>headline<br>
		<input type="text" name="gntextde" value="'.$row->gntextde.'" style="width:450px;"></p>

		<p>&nbsp;</p>

<!--		<p>HTML English<br>
		<textarea cols="130" rows="16" name="texten" style="widht:100%; height:180px;">'.$row->texten.'</textarea></p>
-->
<!--
		<p style="margin: 10px 0px 10px 0px;">Flie�text auf Hellgrau<br>
		<textarea cols="130" rows="6" name="textde">'.$row->textde.'</textarea></p>
-->

<!--  		<p style="margin: 10px 0px 10px 0px;">text English<br>
		<textarea cols="130" rows="6" name="texten">'.$row->texten.'</textarea></p>  -->

		<p>'.$MORPTEXT["GLOB-DATUM"].'<br>
		<input type="text" name="date" value="'.$datum.'" style="width:100px;"></p>

		<p><input type="submit" class="button" name="speichern" value="'.$MORPTEXT["GLOB-SPEICHERN"].'"></p>
		<p>&nbsp;</p>
		<p>IAMGE<br>
			<input name="image[]" type="file" style="width:500px">
		</form>
		<p><img src="../Galerie/'.$row->img.'"></p>
		';

}

elseif($_FILES) {

	$dir = str_replace('//', '/', $dir);

	for($i=0; $i<=20; $i++) {
		$tmp  = $_FILES['img']['tmp_name'][$i];
		$img  = strtolower(eliminiere($_FILES['img']['name'][$i]));

		if ($img) {
			$typ = explode(".", $img);
			$c	 = (count($typ)-1);
			$typ = strtolower($typ[$c]);

			$query = "SELECT `sort` AS last FROM galerie WHERE gnid='$gnid' ORDER BY `sort` DESC";
			$result = safe_query($query);
			$row = mysqli_fetch_object($result);
			$last = $row->last;

			unset($img_true);
			unset($zip_true);

			if ($typ == "jpg" || $typ == "png")		$img_true = 1;
			elseif ($typ == "zip")  $zip_true = 1;
			else 					die("<p>upload von unbekannten datenformat.</p><p>Bitte nur JPG und Zip Dateien hochladen.</p><p><strong>Keine GIF!</strong></p>");
			# _type

			if ($img_true) {
				$nm = $img;
				unset($mx);

				if (!copy($tmp, $dir.$img)) die("upload fehlgeschlagen!");
				chmod($dir.$img, 0777);

				$nm = "hl_".$img;
				$mx = $morpheus["img_size"];
				include ("img_tn_height.php");

				# if (!copy($tmp, $dir.$img)) die("upload fehlgeschlagen!");
				chmod($dir.$img, 0777);

				$nm = "tn_".$img;
				$mx = $morpheus[img_size_tn];	# thumbnail
				# 64 x 54
				//include ("img_tn_height.php");
				include ("img_tn_height.php");

#				$mx = $morpheus["img_size_tn"];	# thumbnail
#				include ("img_tn_height.php");
			 	// echo $dir.$nm;

				chmod($dir.$nm, 0777);

				$last++;

				if (!$neu) $query = "update galerie set gname='$img', tn='$nm', gpix='$gpix', gsize='$gsize' where gid='$gid'";
				else $query = "insert galerie set gname='$img', gnid=$id, tn='$nm', gpix='$gpix', gsize='$gsize', `sort`=$last";
				$result = safe_query($query);
			}

			# # # zip hochladen. entzippen. in db eintragen tn erstellen

			elseif ($zip_true)	{
				if (!copy($tmp, $dir.$img)) die("upload fehlgeschlagen!");
				include('pclzip.lib.php');
				$archive = new PclZip($dir.$img);
				$zip = new PclZip($dir.$img);

				//				$listing = $archive->listContent();

				// -----------------------------------------------------------------
				// -----------------------------------------------------------------


				if (($list = $zip->listContent()) == 0) {
					die("Error : ".$zip->errorInfo(true));
				}

				$sort_arr = array();
				foreach ($list as $arr) {
					$sort_arr[] = $arr["filename"];
				}
				sort($sort_arr);
				foreach ($sort_arr as $val) {
					$last++;
					$new_sort_arr[$last] = $val;
				}
				$new_sort_arr = array_flip($new_sort_arr);


				// -----------------------------------------------------------------
				// -----------------------------------------------------------------

				$archive = new PclZip($dir.$img);
				if ($archive->extract(PCLZIP_OPT_PATH, $dir, PCLZIP_OPT_REMOVE_PATH, 'install/release') == 0) {
					die("Error : ".$archive->errorInfo(true));
				}
				$listing = $archive->listContent();


				foreach ($listing as $val) {
					$img = $val['filename'];

					$nm = "hl_".$img;
					$mx = $morpheus["img_size"];	# thumbnail
					include ("img_tn.php");
					chmod($dir.$nm, 0777);

					$nm = "tn_".$img;
					$mx = 54;	# thumbnail
					$wi = 64;
					$he = 54;
					# 64 x 54
					//include ("img_tn_height.php");
					include ("img_tn3.php");

					chmod($dir.$nm, 0777);

					$last = $new_sort_arr[$img];
					$query = "insert galerie set gname='$img', gnid=$id, tn='$nm', gpix='$gpix', gsize='$gsize', `sort`=$last";
					$result = safe_query($query);
				}
				@unlink($dir.$img);
			}
		}
	}
	// reorganize($akt);
}

elseif($neu && $db == "galerie") {
	$warnung = '<p>&nbsp;</p>
	<p><!-- <strong>TIPP</strong>: Sie koennen mehrere Bilder zu einem ZIP zusammenfuegen und so alle Bilder mit einem Upload in die Galerie einfuegen!<br>
	<strong>ABER</strong>: Einzelne Bilder zum einem ZIP zusammenfuegen. <strong>Keinen Ordner zippen</strong>! --></p>
	<p>&nbsp;</p>
	<form method="post" action="bild_galerie.php" enctype="multipart/form-data">
		<input type="Hidden" name="neu" value="1">
		<input type="Hidden" name="gnid" value="'.$gnid.'">
		<input type="Hidden" name="ggid" value="'.$ggid.'">
		<input type="Hidden" name="db" value="'.$db.'"><p>';

	for($i=0; $i<=10; $i++) {
		$warnung .= '<input type="file" name="img[]" style="width:500px;"><br>';
	}

	$warnung .= '</p><p><input type="submit" class="button" name="speichern" value="speichern"></p></form>';
}

elseif($neu) {
	$warnung = '<form method="post">
		<input type="Hidden" name="chdir" value="'.$dir.'">
		<input type="Hidden" name="neu" value="1">
		<input type="Hidden" name="ggid" value="'.$ggid.'">
		<input type="Hidden" name="db" value="'.$db.'">
		<input type="Hidden" name="speichern" value="1">
		<p>ordner-name - <strong>bitte keine leer- und sonderzeichen!</strong></p>
		<p>Bsp.: <strong>B-Day-20-10-2006</strong><br>
		<p><input type="text" name="name" value=""></p>

		<p>headline Deutsch<br>
		<input type="text" name="gntextde" value="" style="width:250px;"></p>
		<!-- <p>headline English<br>
		<input type="text" name="gntexten" value="" style="width:250px;"></p>
 -->
		<p><input type="submit" class="button" name="speichern" value="speichern"></p></form>';
}
#
#
#

if ($warnung) die ($warnung ."\n</div></body></html>");

$col = array("#FFFFFF","#EFECEC");
$ct = 0;

if ($gal == "group") {								# alle galerien in der uebersicht
	$query = "SELECT * FROM $db order by date,sort";
	$result = safe_query($query);
	$count	= mysqli_num_rows($result);
	$x		= 0;

	echo "<table border=0 cellspacing=2 cellpadding=4 style=\"border-bottom: solid 1px #cccccc;\">";

	while ($row = mysqli_fetch_object($result)) {
		$ed = "<img src=\"images/edit.gif\" alt=edit vspace=4 hspace=10 border=0>";
		$lnk = "<a href=\"bild_galerie.php?ggid=".$row->ggid."&name=".$row->ggname."&db=galerie_name\" title=\"oeffne ".$row->ggname."\">";

		echo "<tr bgcolor=$col[$ct] height=20><td width=200px>&nbsp; $lnk".ilink()." ".$row->ggname."</a>";

		if ($x > 1) echo '<a href="bild_galerie.php?db='.$db.'&gnid='.$row->gnid.'&sortid='.$sid.'&way=up&ggid='.$ggid.'"><img src="images/up.gif" alt="eine position nach oben" width="9" height="9" hspace="2" border="0"></a>';
		else echo '<img src="images/leer.gif" alt="" width="9" height="9" hspace="2" border="0">';

		if ($x < $count) echo '<a href="bild_galerie.php?db='.$db.'&gnid='.$row->gnid.'&sortid='.$sid.'&way=down&ggid='.$ggid.'"><img src="images/down.gif" alt="eine position nach oben" border="0" hspace=2></a>';

		#if ($admin) echo "<a href=\"bild_galerie.php?ggid=" .$row->ggid ."&db=$db&dbnm=ggname&dbid=ggid&chdir=$dir&olddir=" .$row->ggname ."&ednm=" .$row->ggname ."\"><i class=\"fa fa-cogs\"></i></a>";

		echo "</td><td> $lnk $ed</a></td><td>";

		# sichtbarkeiten auslesen und anzeigen
		if ($si == 1) 	echo '<a href="?ggid='.$ggid.'&db='.$db.'&si=2"><img src="images/an.gif" width="12" height="12" alt="" border="0" hspace="10"></a>';
		else			echo '<a href="?ggid='.$ggid.'&db='.$db.'&si=1"><img src="images/off.gif" width="12" height="12" alt="" border="0" hspace="10"></a>';

		echo "</td></tr>\n";

		if ($ct == 0) $ct = 1;		//farbendefenition
		else $ct = 0;
	}

	echo "</table>";
}

elseif ($gal == "name") {
	$query 	= "SELECT * FROM $db where ggid=$ggid order by sort";
	$result = safe_query($query);
	$count	= mysqli_num_rows($result);
	$x		= 0;

	echo "<p style=\"clear:left; margin: 10px 0px 10px 0px;\"><a href=\"bild_galerie.php?neu=1&db=$db&ggid=$ggid&gnid=$gnid\">" .ilink() ." ".$MORPTEXT["BGAL-NEUEGAL"].$neu_com."</a></p>";

	echo '<p style="width: 720px; border-bottom: solid 2px #cccccc;"><a href="bild_galerie.php?reorg='.$ggid.'"><i class="fa fa-sort-alpha-asc"></i> '.$MORPTEXT["GLOB-SORT-AKT"].'</a></p>
	<p>&nbsp;</p>';

	echo '<table border="0" cellspacing="1" cellpadding="0" class="autocol p20">';

	while ($row = mysqli_fetch_object($result)) {
		$ed 	= '<i class="fa fa-pencil-square-o"></i>';
		$delete = '<i class="fa fa-trash-o"></i>';
		$lnk 	= "<a href=\"bild_galerie.php?gnid=".$row->gnid."&ggid=".$ggid."&db=galerie\" title=\"oeffne ".$row->gnname."\">";
		$sid    = $row->sort;
		$si 	= $row->sichtbar;
		$x++;

		$vorh = is_dir($dir.$row->gnname);

		echo "<tr><td width=540>".$sid."&nbsp; <a href=\"bild_galerie.php?gnid=".$row->gnid."&ggid=".$ggid."&db=$db&dbnm=$dbnm&dbid=$dbid&olddir=".$row->gnname."&ednm=".$row->gnname."\">". ($vorh ? '' : '<strong style="color:red;">Ordner fehlt</strong>&nbsp;&nbsp;') ."".$row->gnname." / ".$row->gntextde." <i class=\"fa fa-cogs\"></i></a></td><td> $lnk $ed</a> </td><td nowrap>";

		if ($x > 1) echo '<a href="bild_galerie.php?db='.$db.'&gnid='.$row->gnid.'&sortid='.$sid.'&way=up&ggid='.$ggid.'"><i class="fa fa-chevron-up small"></i></a>';
		else echo '<img src="images/leer.gif" alt="" width="9" height="9" hspace="2" border="0">';

		if ($x < $count) echo '<a href="bild_galerie.php?db='.$db.'&gnid='.$row->gnid.'&sortid='.$sid.'&way=down&ggid='.$ggid.'"><i class="fa fa-chevron-down small"></i></a>';

		echo "</td><td><a name=\"deldir\" href=\"bild_galerie.php?deldir=".$row->gnid."&ggid=".$ggid."&db=galerie\" title=\"deldir\">$delete</a></td><td width=\"50\">";

		# sichtbarkeiten auslesen und anzeigen
		if ($si == 1) 	echo '<a href="?ggid='.$ggid.'&db='.$db.'&si=2&gnid='.$row->gnid.'"><i class="fa fa-eye"></i></a>';
		else			echo '<a href="?ggid='.$ggid.'&db='.$db.'&si=1&gnid='.$row->gnid.'"><i class="fa fa-eye-slash gray"></i></a>';

		echo "</tr>\n";

		if ($ct == 0) $ct = 1;		//farbendefenition
		else $ct = 0;
	}

	echo "</table><p>&nbsp;</p>";
}

else {

	echo "<p style=\"clear:left; margin: 10px 0px 10px 0px;\"><a href=\"bild_galerie.php?neu=1&db=$db&ggid=$ggid&gnid=$gnid\"><i class=\"fa fa-plus\"></i> ".$MORPTEXT["IMGL-NEUEBILDER"].$neu_com."</a> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <a href=\"bild_galerie.php?wayrefresh=$gnid&gnid=$gnid&ggid=$ggid&db=galerie\"><i class=\"fa fa-chevron-right small\"></i> ".$MORPTEXT["GLOB-SORT-AKT"]."</a></p><form method=\"post\">";


	$query = "SELECT * FROM $db where gnid=$gnid order by sort, gid";
	$result = safe_query($query);
	$count	= mysqli_num_rows($result);
	$x		= 0;

	while ($row = mysqli_fetch_object($result)) {
		$txtde 	= $row->gtextde;
		$txten 	= $row->gtexten;
		$gid 	= $row->gid;
		$sid 	= $row->sort;
		$x++;

		echo "<div style=\"float:left; background-color:silver; height: 290px; text-align:center; text-valign:middle; border:solid 3px #FFFFFF;\"><p style=\"height:40;margin: 0 0 10 0; font-size:10px;\"><input type=\"Text\" name=\"sid[".$gid."]\" value=\"".$sid."\" style=\"width: 40px;\"> &nbsp; <a href=\"bild_galerie.php?del=$gid&db=$db&ggid=$ggid&gnid=$gnid\"><img src=\"images/delete_w.gif\" border=0 vspace=4></a>&nbsp; &nbsp; &nbsp; &nbsp; ";

		if ($x > 1) echo '<a href="bild_galerie.php?db='.$db.'&sortid='.$sid.'&way=up&ggid='.$ggid.'"><img src="images/up.gif" alt="eine position nach oben" width="9" height="9" hspace="2" border="0"></a>';
		else echo '<img src="images/leer.gif" alt="" width="9" height="9" hspace="2" border="0">';

		if ($x < $count) echo '<a href="bild_galerie.php?db='.$db.'&sortid='.$sid.'&way=down&ggid='.$ggid.'"><img src="images/down.gif" alt="eine position nach oben" border="0" hspace=2></a>';

		echo " &nbsp; <input type=\"checkbox\" name=\"gid[]\" value=\"$gid\"><br><a href=\"bild_galerie.php?edit=$gid&db=$db&ggid=$ggid&gnid=$gnid\"><img src=\"$dir".$row->tn."\" border=0></a><br>".substr($txtde, 0,16)."<br>".substr($row->gname, 0,50)."</p></div>\n";
	}

	echo '<p style="clear:both;">&nbsp;</p><p><input type="Hidden" name="ggid" value="'.$ggid.'"><input type="Hidden" name="gnid" value="'.$gnid.'"><input type="submit" class="button" name="newsort" value="'.$MORPTEXT["BGAL-SORTUBERN"].'"> &nbsp; &nbsp; &nbsp; &nbsp; <input type="submit" class="button" name="imgdelete" value="'.$MORPTEXT["BGAL-MARKLOSCHEN"].'"></p></form>';
}

$new = "<p style=\"clear:left;\"><a href=\"bild_galerie.php?neu=1&db=$db&ggid=$ggid&gnid=$gnid\" title=\"Neue Bildergalerie erstellen\"><i class=\"fa fa-plus\"></i> ".$MORPTEXT["GLOB-NEU"]."</a></p>".
($gnid ? "<p><a href=\"bild_galerie.php?del=all&db=$db&ggid=$ggid&gnid=$gnid\" title=\"Neue Bildergalerie erstellen\"><i class=\"fa fa-trash-o\"></i> " .' '.$MORPTEXT["BGAL-ALLEBLOSCHEN"].'</a></p>' : '');

echo $new;
?>

</div>

<?
include("footer.php");
?>