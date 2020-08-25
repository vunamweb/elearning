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

include("cms_include.inc");

echo '<div id=content_big class=text>

<font class=text><b>Kursbeschreibung bearbeiten</b><img src="images/leer.gif" width="76" height="1" alt="">
<a href="content_edit.php?db=ec_kurs_art&new=1">' .ilink() .' neuen Datensatz erstellen</a><p>

<table cellpadding=0 cellspacing=1 border=0 class=text>
	<tr bgcolor="#c8c8c8">
		<td style="color:#000;">ID</td>
		<td style="color:#000;">Schl&uuml;ssel</td>
		<td width="200" valign="top" style="color:#000;">Kursart</td>
		<td width="450" valign="top" style="color:#000;">Text</td>
	</tr>';
		
$col = array("#FFFFFF","#EFECEC");
$ct = 0;

$sql = "SELECT * FROM ec_kurs_art order by rWert";
$res = safe_query($sql);

while ($row = mysqli_fetch_array($res))	{	
	echo "<tr bgcolor=$col[$ct]>
			<td valign=top align=center>" .$row['id'] ."</td>
			<td valign=top align=center><a href=\"content_edit.php?edit=" .$row["id"] ."&db=ec_kurs_art\">" .$row['rWert'] ."</a></td>
			<td valign=top><a href=\"content_edit.php?edit=" .$row["id"] ."&db=ec_kurs_art\">" .$row['art'] ."</a></td>";
			
	$text = $row['text'];
	$text = repl("1_headline","",$text);
	$text = repl("2_subheadline","",$text);
	$text = repl("3_fliesstext","",$text);
	$text = repl("@@","<br>",$text);
	$text = repl("##","",$text);
	
	echo "\n\t<td valign=top>" .substr($text,4,100) ." ...</td>\n</tr>";

	if ($ct == 0) $ct = 1;		//farbendefenition
	else $ct = 0;
}

echo ' </table>&nbsp;<br>
<p><a href="content_edit.php?new=1&db=ec_kurs_art">' .ilink() .' neuen Datensatz erstellen</a></p><p>&nbsp;</p>';

?>
 
</font>
</div>
<?
include("footer.php");
?>