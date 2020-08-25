<?php
global $pdf;

$query  = "SELECT * FROM pdf where pid=$text";
$result = safe_query($query);
$row = mysqli_fetch_object($result);

$de = $row->pdesc;
$nm = $row->pname;
$si = $row->psize;
$da = $row->pdate;
$da = euro_dat($da);

$typ = explode(".", $nm);
$c	 = (count($typ)-1);
$img = $typ[$c]."_s.gif";

$link = "<a href=\"".$dir."pdf/$nm\" target=\"_blank\" title=\"$typ[1] $nm zum Download\" style=\"text-decoration:none;\">";

$output .= 'ilink'.$link.''.$row->pdesc .'</a>ilink';

?>