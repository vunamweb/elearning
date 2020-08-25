<?php
/* pixel-dusche.de */

$heute = date("N");
$sql = "SELECT * FROM morp_kursplan p, morp_kurse k LEFT JOIN morp_color c ON c.colid=k.colid WHERE p.kid=k.kid AND tag=$heute AND p.kid<>18 ORDER BY von";
$res = safe_query($sql);
$tmp = '';

while ($row = mysqli_fetch_object($res)) {
		$von = $row->anzeige1 ? $row->anzeige1 : $row->von;
		$bis = $row->anzeige2 ? $row->anzeige2 : $row->bis;

		$raum = $row->raum;

		$tmp .= '
                        <div class="owl-carousel-item">
                            <h3>'.$row->name.($raum ? '<br/>('.$raum.')' : '').'</h3>
                            <div class="classes-description">
                                <p class="with-icon time">'.$von.' - '.$bis.'</p>
                            </div>
                        </div>
';
}


$template = '
    <section id="events" class="darkgrey_section">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 text-center">
                    <h2 class="block-header"><strong>Kurse heute</strong></h2>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">


                    <div class="owl-carousel owl-items-4 classes">

'.$tmp.'

                    </div> <!-- eof owl-carousel -->


                </div>
            </div>
        </div>
    </section>
';

?>