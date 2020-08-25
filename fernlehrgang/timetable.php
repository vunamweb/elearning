<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">

        <title>Sports&amp;Life</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->

        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/animations.css">
        <link rel="stylesheet" href="css/main.css">
        <script src="js/vendor/modernizr-2.6.2.min.js"></script>
        <!--[if lt IE 9]>
            <script src="js/vendor/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>
        <!--[if lt IE 7]>
            <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->

        <header id="header">
            <div class="container"><div class="row">

                <a class="navbar-brand" href="./">Sports<span class="highlight">&amp;</span>Life</a>

                <div class="col-sm-12 mainmenu_wrap"><div class="main-menu-icon visible-xs"><span></span><span></span><span></span></div>
                <ul id="mainmenu" class="menu sf-menu responsive-menu superfish">
                    <li class="">
                        <a href="./">Home</a>
                    </li>
                    <li class="dropdown">
                        <a href="./classes.html">Classes</a>
                        <ul class="dropdown-menu">
                            <li class="">
                                <a href="./classes.html">Classes</a>
                            </li>
                            <li class="">
                                <a href="./class-single.html">Single Class</a>
                            </li>
                        </ul>
                    </li>
                    <li class="active">
                        <a href="./timetable.html">Timetable</a>
                    </li>
                    <li class="dropdown">
                        <a href="./trainers.html">Trainers</a>
                        <ul class="dropdown-menu">
                            <li class="">
                                <a href="./trainers.html">Trainers</a>
                            </li>
                            <li class="">
                                <a href="./trainer-single.html">Single Trainer</a>
                            </li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="./404.html">Pages</a>
                        <ul class="dropdown-menu">
                            <li class="">
                                <a href="./blog.html">Blog</a>
                            </li>
                            <li class="">
                                <a href="./blog-single.html">Blog Post</a>
                            </li>
                            <li class="">
                                <a href="./shortcodes.html">Shortcodes</a>
                            </li>
                            <li class="">
                                <a href="./404.html">404</a>
                            </li>
                            <li class="">
                                <a href="./icons.html">Icons</a>
                            </li>

                        </ul>
                    </li>
                    <li class="">
                        <a href="./contact.html">Contact</a>
                    </li>

                </ul>
            </div>

        </div></div>
    </header>

    <section id="abovecontent" class="dark_section bg_image">
        <div class="container"><div class="row">
            <div class="block col-sm-12">
                <ul class="breadcrumb">
                    <li><a href="./" class="pathway"><i class="rt-icon-home"></i></a></li>
                    <li><span>Kursplan</span></li>
                </ul>
            </div>
        </div></div>
    </section>

  <style>
.dispblock { display: block; }
.h15 { height: 20px;  }
.h30 { height: 40px;  }
.h45 { height: 60px;  }
.h60 { height: 80px;  }
.h75 { height: 100px;  }
.h90 { height: 120px;  }

.h11 { height: 80px;  }
th.kurs { padding: 0 !important; min-width: 150px; }
th span { line-height: 80px; font-weight: normal; }
.col0 { background: none !important; }
.col1 { background: #8e8a89 !important; }
.col2 { background: #a62116 !important; }
.col3 { background: blue !important; }
.col10 { background: #4a4645 !important; }
.col11 { background: #1d1d1b !important; }
.klein { font-size: 0.75em; }

.table-responsive .table a { margin: 0 0 0 0; }

ul.kursmobile { list-style: none; }
.kursmobile li { display: table; }
 span.ktag { display: block; float: left; width: 150px; }
 span.kzeit { display: block; float: left; width: 150px; }
 span.kname { display: block; float: left; width: 150px; }
#timetable td a { color: #fff; padding: 0; padding-top: 6px; }
#timetable td, #timetable th { border: #1d1d1b solid 2px; padding: 0; }
th.tag { line-height: 80px !important; }
  </style>


<?php

include("nogo/config.php");
include("nogo/funktion.inc");
include("nogo/db.php");
dbconnect();

$sql = "SELECT * FROM morp_kursplan p, morp_kurse k LEFT JOIN morp_color c ON c.colid=k.colid WHERE p.kid=k.kid ORDER BY tag,von";
$res = safe_query($sql);

$oldtag = 0;
$tbody = '
                            <tbody>
                                <tr>
                                    <th class="kurs">
	                                    <span class="h11 col10 dispblock">09:00 - 10:00</span>
	                                    <span class="h11 col11 dispblock">10:00 - 11:00</span>
	                                    <span class="h11 col10 dispblock">11:00 - 12:00</span>
	                                    <span class="h11 col11 dispblock">12:00 - 13:00</span>
	                                    <span class="h11 col10 dispblock">13:00 - 14:00</span>
	                                    <span class="h11 col11 dispblock">14:00 - 15:00</span>
	                                    <span class="h11 col10 dispblock">15:00 - 16:00</span>
	                                    <span class="h11 col11 dispblock">16:00 - 17:00</span>
	                                    <span class="h11 col10 dispblock">17:00 - 18:00</span>
	                                    <span class="h11 col11 dispblock">18:00 - 19:00</span>
	                                    <span class="h11 col10 dispblock">19:00 - 20:00</span>
	                                    <span class="h11 col11 dispblock">20:00 - 21:00</span>
	                                    <span class="h11 col10 dispblock">21:00 - 22:00</span>
	                                 </th>

';

$td = '';
$mobileTD = '<ul class="kursmobile">';
$kurs_arr = array();

while ($row = mysqli_fetch_object($res)) {
	$tag = $row->tag;

	if($tag != $oldtag) {
		$oldtag = $tag;
		if(!$td) $td .= '
                                    <td>
';
		else {
			$td .= '
                                    </td>
                                    <td>
';

			$mobileTD .= '<li>&nbsp;</li>';
		}
	}

	if($row->kid != 18) {
		$key = explode(" ", $row->name);
		$key = explode("-", $key[0]);
		$kurs_arr[$key[0]] = $row->name;
echo $row->anzeige1;
		$von = $row->anzeige1 ? $row->anzeige1 : $row->von;
		$bis = $row->anzeige2 ? $row->anzeige2 : $row->bis;

		$raum = $row->raum;

		$td .= '                                        <a href="#'.$row->name.'" class="'.($row->colid ? '' : 'col1 ').$key[0].' h'.$row->gesamt.'"'.($row->colid ? ' style="background:#'.$row->color.';"' : '').'><span class="klein'.($raum ? ' fett' : '').'">'.$von.' - '.$bis.'</span><br/>'.$row->name.($raum ? '<br/>('.$raum.')' : '').'</a>
';
		$mobileTD .= '<li><span class="ktag">'.tag($row->tag).'</span><span class="kzeit">'.$von.' - '.$bis.'</span><span class="kname">'.$row->name.($raum ? ' ('.$raum.')' : '').'</span></li>';
	}
	else $td .= '                                        <a href="#" class="col0 h'.$row->gesamt.'"></a>
';
}

$kurs_arr = array_unique($kurs_arr);
$filter = '';

foreach($kurs_arr as $key=>$val) {
	$filter .= '<li><a data-filter=".'.$key.'" href="#" class="">'.$val.'</a></li>';
}
?>

    <section id="middle" class="darkgrey_section last_content_section">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 text-center">
                    <h2 class="block-header"><strong>Classes</strong> Timetable</h2>
                </div>
            </div>
            <div class="row">
                <div class="text-center filters col-sm-12">
                    <ul id="timetable_filter">
                        <li><a class="selected" data-filter="all" href="#">All</a></li>
                        <?php echo $filter; ?>
                    </ul>
                    <div class="clearfix"></div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12">
                    <div class="table-responsive">

	                    <?php echo $mobileTD; ?></ul>

                        <table class="table table-striped table-bordered" id="timetable">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th class="tag">Montag</th>
                                    <th class="tag">Dienstag</th>
                                    <th class="tag">Mittwoch</th>
                                    <th class="tag">Donnerstag</th>
                                    <th class="tag">Freitag</th>
                                    <th class="tag">Samstag</th>
                                    <th class="tag">Sonntag</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
	                                <?php echo $tbody; ?>
	                                 <?php echo $td; ?>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>




    <section id="partners" class="dark_section">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="owl-carousel partners">

                        <div class="item">
                            <img alt="" src="example/partner1.png">
                        </div>
                        <div class="item">
                            <img alt="" src="example/partner2.png">
                        </div>
                        <div class="item">
                            <img alt="" src="example/partner3.png">
                        </div>

                        <div class="item">
                            <img alt="" src="example/partner4.png">
                        </div>

                        <div class="item">
                            <img alt="" src="example/partner5.png">
                        </div>

                        <div class="item">
                            <img alt="" src="example/partner6.png">
                        </div>

                        <div class="item">
                            <img alt="" src="example/partner1.png">
                        </div>

                        <div class="item">
                            <img alt="" src="example/partner2.png">
                        </div>

                        <div class="item">
                            <img alt="" src="example/partner3.png">
                        </div>

                        <div class="item">
                            <img alt="" src="example/partner4.png">
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>


    <footer id="footer" class="dark_section">
        <div class="container">
            <div class="row">
                <div class="block widget_schedule col-md-3 col-sm-4">
                    <h3>Opening Hours</h3>
                    <dl class="dl-horizontal">
                        <dt>Monday-Friday</dt>
                        <dd><strong>9:00 - 21:00</strong></dd>
                        <dt>Saturday</dt>
                        <dd><strong>9:00 - 20:00</strong></dd>
                        <dt>Sunday</dt>
                        <dd><strong>9:00 - 16:00</strong></dd>
                    </dl>
                </div>


                <div class="block widget_tweet col-md-3 col-sm-4">
                    <h3>Twitter Widget</h3>
                    <div class="twitter"></div>
                </div>

                <div class="block widget_text col-md-3 col-sm-4">
                    <h3>Contact Info</h3>
                    <p>65 Santa Monica Blvd, LA, CA 97845, US<br>
                        <span><strong>Phone:</strong> </span>+91 544 567 8943<br>
                        <span><strong>Email:</strong> </span>
                        <a href="mailto:info@company.com">info@company.com</a><br>
                    </p>
                    <p>
                        <a class="socialico-twitter" href="#" title="Twitter">#</a>
                        <a class="socialico-facebook" href="#" title="Facebook">#</a>
                        <a class="socialico-google" href="#" title="Google">#</a>
                        <a class="socialico-linkedin" href="#" title="Lindedin">#</a>
                    </p>
                </div>


                <div class="block subscribe col-md-3 col-sm-4">
                    <h3>Newsletter</h3>
                    <p>Please, subscribe to our latest news to be updated.</p>
                    <form id="signup" action="/" method="get" class="form-inline">
                        <div class="form-group">
                            <input name="email" id="mailchimp_email" type="email" class="form-control" placeholder="Email">
                        </div>
                        <button type="submit" class="theme_btn">GO!</button>
                        <div id="response"></div>
                    </form>
                </div>

            </div>
        </div>
    </footer>


    <section id="copyright" class="light_section">
        <div class="container">
            <div class="row">

                <div class="col-sm-12 text-center">
                    Copyright - Sports &amp; Life Template by <a href="http://modernwebtemplates.com">MW Templates</a>
                </div>
            </div>
        </div>
    </section>


        <script src="js/vendor/jquery-1.11.0.min.js"></script>
        <script src="js/vendor/jquery-migrate-1.2.1.min.js"></script>
        <script src="js/vendor/bootstrap.min.js"></script>
        <script src="js/vendor/placeholdem.min.js"></script>
        <script src="js/vendor/hoverIntent.js"></script>
        <script src="js/vendor/superfish.js"></script>
        <script src="js/vendor/jquery.actual.min.js"></script>
        <script src="js/vendor/jquerypp.custom.js"></script>
        <script src="js/vendor/jquery.elastislide.js"></script>
        <script src="js/vendor/jquery.flexslider-min.js"></script>
        <script src="js/vendor/jquery.prettyPhoto.js"></script>
        <script src="js/vendor/jquery.easing.1.3.js"></script>
        <script src="js/vendor/jquery.ui.totop.js"></script>
        <script src="js/vendor/jquery.isotope.min.js"></script>
        <script src="js/vendor/jquery.easypiechart.min.js"></script>
        <script src='js/vendor/jflickrfeed.min.js'></script>
        <script src="js/vendor/jquery.sticky.js"></script>
        <script src='js/vendor/owl.carousel.min.js'></script>
        <script src='js/vendor/jquery.nicescroll.min.js'></script>
        <script src='js/vendor/jquery.fractionslider.min.js'></script>
        <script src='js/vendor/jquery.scrollTo-min.js'></script>
        <script src='js/vendor/jquery.localscroll-min.js'></script>
        <script src='js/vendor/jquery.parallax-1.1.3.js'></script>
        <script src='js/vendor/jquery.bxslider.min.js'></script>
        <script src='js/vendor/jquery.funnyText.min.js'></script>
        <script src='twitter/jquery.tweet.min.js'></script>


        <script src="js/plugins.js"></script>
        <script src="js/main.js"></script>

    </body>
</html>
