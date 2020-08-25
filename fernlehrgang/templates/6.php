<?php
/* pixel-dusche.de */
global $imgCt;

$ds = '';

for($i=0; $i<$imgCt; $i++) {
	$ds .= '                            <li data-target="#myCarousel" data-slide-to="'.$i.'"'.($i<1 ? ' class="active"' : '').'></li>
';
}

$template = '
    <section id="gal" class="dark_section padtb0">
		<div id="mycarousel" class="carousel slide" data-ride="carousel">
              <!-- Indicators -->
              <ol class="carousel-indicators">
'.$ds.'
              </ol>

	          <!-- Wrapper for slides -->
	          <div class="carousel-inner" role="listbox">
	#cont#

	          </div>

			  <!-- Controls -->
			  <a class="left carousel-control" href="#myCarousel2" role="button" data-slide="prev">
			    <span class="glyphicon glyphicon-chevron-left"></span>
			  </a>
			  <a class="right carousel-control" href="#myCarousel2" role="button" data-slide="next">
			    <span class="glyphicon glyphicon-chevron-right"></span>
			  </a>
        </div>
    </section>

';

$imgCt2 = '';

?>