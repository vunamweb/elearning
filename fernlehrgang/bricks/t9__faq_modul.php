<?php

global $hn, $nid, $ns, $dir, $lan, $navID, $cid;

$nid = $_GET["nid"];
$ns  = $_GET["ns"];
# print_r($_REQUEST);

# anzahl der NEWSSEITEN wird berechnet. SEITENNAVIGATION erstellt
$query 	= "SELECT * FROM news n, news_group ng WHERE n.ngid=ng.ngid AND n.ngid=2 ORDER BY nid";
$result = safe_query($query);
$row 	= mysqli_fetch_object($result);

$img_news_pfad = $dir.'images/aktuell/';

$x = 0;

$news .= '												<div class="accordion">
';

while ($row = mysqli_fetch_object($result))	{
	$link 	= $dir.$navID[$cid]."" .eliminiere($row->ntitle).'+'.$row->nid.'/';

	$x++;

	// $liste .= '<h2 style="margin-bottom: 16px;"><a href="#'.$x.'" name="'.$x.'t">'.nl2br($row->ntitle) .'</a></h2>';

	$news .= '
									<div class="acc">
										<a href="#" class="tog">
											<span class="cmsms_plus">
												<span class="vert_line"></span>
												<span class="horiz_line"></span>
											</span>
											'.nl2br($row->ntitle) .'
										</a>
										<div class="tab_content">
											<p>
												'.nl2br($row->ntext) .'
											</p>
										</div>
									</div>';
}

$output .= $news.'</div>
';

?>