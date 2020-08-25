<?php
# # # # # # # # # # # # # # # # # # # # # # # # # # #
# www.pixel-dusche.de                               #
# björn t. knetter                                  #
# start 11/2007                                     #
#                                                   #
# post@pixel-dusche.de                              #
# frankfurt am main, germany                        #
# # # # # # # # # # # # # # # # # # # # # # # # # # #

global $morpheus;

$morpheus["layout"]			= array("","Dreispaltig");

/* DESIGNS BENENNUNG */
$morpheus["design"]			= array(
									3=>"Standard",
									1=>"Startseite",
#									2=>"Team",
									2=>"Kursplan",
#									3=>"St&ouml;rer rechte Seite / ohne Tags",
#									3=>"Stimmen",
#									2=>"Referenzen Seite / Galerie + Karussel",
#									2=>"Startseite ",
#									4=>"Kalkulator",
									#3=>"design-3.inc | <strong>Text-Seiten</strong>",
#									5=>"Header Bild",
);

/* TEMPLATES BENENNUNG */
$morpheus["template"]		= array(
									1=>"Text",
									3=>"Headline oben",
#									7=>"Text/Bild 1/3 Breite",
#									2=>"Bild links / Text rechts",
									11=>"Boxen Kurse<br>",
									6=>"Slider<br>",
									5=>"Header Bild / Startseite<br>",
									8=>"Footer",
									10=>"Trainer/Team",
#									10=>"Adresse links",
#									12=>"TAGS",
#									13=>"rechte Seite St&ouml;rer gelb",

#									6=>"Header Bild<br>",
#									4=>"Content 2 Spalten Text // rechts schmal<br>",


#									4=>"Bild Slider Header<br>",



#									12=>"Content / Headline & Text 2 Spalten<br>",
#									13=>"Content / Headline & Text 1 Spalte<br>",
#									5=>"Slider Startseite",
#									10=>"Startseite Buttons<br>",
#									9=>"Stellenangebote",
#									20=>"map",
#									11=>"Produkt Liste<br>",
);

$morpheus["navpos"]			= array(
									1=>"Hauptnavigation",
									2=>"Meta-Navigation",
#									3=>"Footer-Navigation"
									);

#$morpheus["news_formate"]	= array(1=>"Abstrakt und Detail", 4=>"Presse", );

# einstellungen, welche elemente in der seitenverwaltung aktiv sein sollen
$morpheus["foto"]			= 0;
$morpheus["standard_tid"]	= array(1);
$morpheus["standard_des"]	= 1;
#$morpheus["news_formate"]	= array(1=>"News", 3=>"Interview", 4=>"Settings");
$morpheus["news_formate"]	= array(1=>"News");

?>