<?php
# # # # # # # # # # # # # # # # # # # # # # # # # # #
# www.pixel-dusche.de                               #
# björn t. knetter                                  #
# start 12/2003                                     #
# edit 27.11.2006                                   #
# post@pixel-dusche.de                              #
# frankfurt am main, germany                        #
# # # # # # # # # # # # # # # # # # # # # # # # # # #

global $dir;

$db = "morp_stimmen";
$id = "stid";
$ord = "reihenfolge";

$sq = "SELECT * FROM $db WHERE 1 ORDER BY ".$ord."";
$rs = safe_query($sq);

$output .= '<section class="testimonials">
';
while ($rw = mysqli_fetch_object($rs)) {
	$output .= '
							<article class="testimonial type-testimonial status-publish hentry">
'.($rw->text ? '								<div class="tl-content_wrap">
									<div class="tl-content">
										<blockquote>
											'.nl2br($rw->text).'
										</blockquote>
									</div>
								</div>' : '').'
								<figure class="tl_author_img">
									<img width="150" height="150" src="'.$dir.'timthumb.php?w=150&amp;h=150&amp;zc=1&amp;src=images/userfiles/image/'.urlencode($rw->img1).'" class="attachment-thumbnail wp-post-image" alt="'.$rw->name.'" title="'.$rw->name.'" />
								</figure>
								<p class="tl_author">'.$rw->name.'</p>
								<p class="tl_company">'.$rw->beruf.'</p>
								<div class="cl"></div>
								<div class="divider"></div>

							</article>';
}

$output .= '</section>
';

?>