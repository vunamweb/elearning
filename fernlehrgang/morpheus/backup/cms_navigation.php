<?php
error_reporting ('none');
//error_reporting(E_ALL & ~E_DEPRECATED);
# # # # # # # # # # # # # # # # # # # # # # # # # # #
# www.pixel-dusche.de                               #
# bj&ouml;rn t. knetter                             #
# start 12/2003                                     #
#                                                   #
# post@pixel-dusche.de                              #
# frankfurt am main, germany                        #
# # # # # # # # # # # # # # # # # # # # # # # # # # #

# navigation
echo '
<div id="leftdiv">
	<a href="logout.php" title="home" class="nobord">logout</a>
	<div class="phone">0176.668 552 08</div>
</div>
<div id="nav">


	<h3>PDF Tool</h3>

     <a href="morp_manage_pdf.php"> <i class="fa fa-users"></i> Dokumenten Verwaltung </a>
<!--      <li> <a href="morp_checkbox.php"> <i class="fa fa-users"></i> Check box</a> </li>-->

<!--
<p style="height:1px;">&nbsp;</p>

	<h3>Backup</h3>
	<p><a href="backup_morpheus.php" class="nav" title="backup morpheus"><i class="fa fa-cloud-download"></i> '.$MORPTEXT["BMORP-SQLHEADL"].'</a></p>
-->

</div>
';

?>