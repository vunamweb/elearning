<?php
session_start();
# # # # # # # # # # # # # # # # # # # # # # # # # # # 
# www.pixel-dusche.de                               #
# björn t. knetter                                  #
# start 12/2003                                     #
#                                                   #
# post@pixel-dusche.de                              #
# frankfurt am main, germany                        #
# # # # # # # # # # # # # # # # # # # # # # # # # # # 
$box = 1;
include("cms_include.inc");

$edit	= $_REQUEST["edit"];
$show	= $_REQUEST["show"];
$save	= $_REQUEST["save"];
$imgid	= $_REQUEST["imgid"];

$db 	= "content";
$getid 	= "cid";


# wenn bild in content eingesetzt wird
$stelle = $_REQUEST["stelle"];
$imglnk = $_REQUEST["imglnk"];
$navid  = $_REQUEST["navid"];
$db		= $_REQUEST["db"];
$art	= $_REQUEST["art"];
if ($navid)  $incl_lnk = "content_edit.php?db=$db&stelle=$stelle&edit=$navid&art=$art";


$back = $_GET["back"];

# # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # 
# # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # 

# neu gewaehltes deko-bild wird in db geschrieben
if ($imgid) {
	$inr = 1;
	$query = "update content set img" .$inr ."=$imgid, edit=1 where cid=$edit";
	$result = safe_query($query);	

echo '
<script type="text/javascript">
<!-- 
		parent.parent.GB_hide();
 -->
</script>
';

}

// content_edit.php?db=content&stelle=4&edit=4&art=&imgid=21&back=ebene;:;1;;p_0;:;0;;n_0;:;Hauptnavigation&db=content&imglnk=1
// content_foto.php?edit=&db=content&back=ebene;:;1;;p_0;:;0;;n_0;:;Hauptnavigation

# # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # 
# # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # 
	$dir 	 = '../images/allgemein';
	echo "<p>Bitte auf das gew&uuml;nschte Bild klicken,  ".$incl_lnk."</p>
	
	<p><a href=\"".$incl_lnk."&back=".$back."\">&laquo; zur&uuml;ck</a></p>";
	
	$ord = opendir($dir);
	$arr = array();
	
	while ($name = readdir($ord)) {
		if ($name != "." && $name != ".." && !preg_match("/.db/", $name)) $arr[] = $name;
	}
	sort ($arr);
	
	foreach ($arr as $val) {
		$id = explode(".", $val);
		
		echo "<p><a href=\"".$incl_lnk."&back=".$back."&imgnm=".$val."\" title=\"$val\" style=\"margin: 0px 10px 0px 0px;float:left;\"><img src=\"$dir/$val\" vspace=10 border=0></a></p>";
	}
	

?>

</div>

<?
include("footer.php");
?>