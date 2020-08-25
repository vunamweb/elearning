<?php
include("page/einstellungen.inc");     //Einstellungen ein- und auslesen
include("page/inifile.inc");
$output .=  "<form action = 'http://www.apothekerkammer.de/index.php?aminodb=1&anz_id=aminosuche' method = 'post'>";
$output .=  "<h2>Stichwortsuche &uuml;ber alle AMINO-Datenbanken</h2>";

$output .=  "<table align='center' border='1'>";
$output .=  "<tr><td>";
$output .=  "Stichworte: <input name='suche1'>";
$output .=  " &nbsp;<select name='operator'>";
$output .=  "<option value='and' selected>und";
$output .=  "<option value='or'>oder";
$output .=  "<option value='and not'>nicht";
$output .=  "</select>&nbsp";
$output .=  "<input name='suche2'>";
$output .=  " &nbsp;<select name='operator2'>";
$output .=  "<option value='and' selected>und";
$output .=  "<option value='or'>oder";
$output .=  "<option value='and not'>nicht";
$output .=  "</select>&nbsp";
$output .=  "<input name='suche3'>";
$output .=  "</td></tr>";

$output .=  "<tr><td>Auswahl der Datenbanken:<br>";

$output .=  "<table border='0' width='100%'>";
$output .=  "<TR><TD valign='top'>";
if ($amino=='1')
	{
	$output .=  "<span><input type='checkbox' name='am' value='AMINO-DB' ";
	if($svgami=='1')
		$output .=  " checked";
	$output .=  "></span><span class=\"chkbox\">
	    		&nbsp;&nbsp;AMINO-DB
    		</span>";
	}
if ($rez=='1')
	{
	$output .=  "<span><input type='checkbox' name='rz' value='Rezeptur-DB' ";
	if ($svgrez=='1')
		$output .=  " checked";
	$output .=  "></span><span class=\"chkbox\">
	    		&nbsp;&nbsp;Rezeptur-DB
    		</span>";
	}
if ($link=='1')
	{
	$output .=  "<span><input type='checkbox' name='li' value='Linkliste' ";
	if ($svglin=='1')
	$output .=  " checked";
	$output .=  "></span><span class=\"chkbox\">
	    		&nbsp;&nbsp;Linkliste
    		</span>";
	}
if ($literatur>='1')
	{
	$output .=  "<input type='checkbox' name='lt' value='Literatur' ";
	if ($svglit=='1')
	$output .=  " checked";
	$output .=  ">Literatur-DB<br />";
	}
$output .=  "</TD></TR></TABLE>";
$output .=  "</td></tr>";

if ($amino =='1') $output .=  "<input type='hidden' name='uebersicht' value='ja'>";

$output .=  "<tr><td align='center'><input type='submit' value='Suchen'>&nbsp;";
$output .=  "<input type='reset' value='Eingaben l&ouml;schen'></td></tr>";

$output .=  "</table>";
$output .=  "</form>";
$output .=  "<font size='-2'>&copy DK 2014</font></body>";

?>