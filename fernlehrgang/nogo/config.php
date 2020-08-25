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
$morpheus = array();
$morpheus["dbname"] 		= "puresoy";
$morpheus["dfile"]			= "morpheus_db.sql";
$morpheus["user"]			= "root";
$morpheus["password"]		= "";
$morpheus["server"]			= "localhost";

$morpheus["email"]			= "info@Screening Mainz.de";
$morpheus["emailname"]		= "Screening Mainz";
$morpheus["multilang"]		= 0;
$morpheus["home_ID"]		= array("de"=>"1");
$morpheus["lan_arr"]		= array(1=>"de");
$morpheus["lan_nm_arr"]		= array("de"=>"Deutsch", "en"=>"English");
$morpheus["layout"]			= array("","Einspaltig");
$morpheus["druck_header"]	= 1;
$morpheus["druck_title"]	= "";
$morpheus["client"]			= "Screening Mainz";
$morpheus["client_adress"]	= "";
$morpheus["galeriepath"]	= "screening";
$morpheus["img_size_news"]		= 450;
$morpheus["img_size_news_tn"]	= 120;
$morpheus["img_size_tn"]	= 200;
$morpheus["img_size_full"]	= 1000;
$morpheus["img_size"]		= 1000;
$morpheus["col"] 			= array("#e2e2e2","","#cdc9c9","#e1e1e1");
//$morpheus["local"]			= "http://flhg.chung-shi.com/";
#$morpheus["local"]			= "http://flhg.chung-shi.com/";
$morpheus["url"]			= "http://bjoern-knetter.com/fernlehrgang/";
# meta tag einstellungen
$morpheus["author"]			= "pixel-dusche.de - CMS Morpheus";
$morpheus["page-topic"]		= "Ladenbau";
$morpheus["publisher"]		= "";
# einstellungen, welche elemente in der seitenverwaltung aktiv sein sollen
$morpheus["foto"]			= 0;
$morpheus["ebene"]			= 3;
?>