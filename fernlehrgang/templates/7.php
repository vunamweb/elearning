<?php
/* pixel-dusche.de */
global $tct;

if(!$tct) $tct = 1;
else $tct++;

if($tct>2) $tct=1;

$template = '
                   <div class="col-md-5 col-sm-5'.($tct == 2 ? ' padl40' : '').'">
#cont#
                   </div>
';

$hl = '';

?>