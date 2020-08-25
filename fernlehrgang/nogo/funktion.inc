<?php
# # # # # # # # # # # # # # # # # # # # # # # # # # #
# www.pixel-dusche.de                               #
# björn t. knetter                                  #
# start 12/2003                                     #
#                                                   #
# post@pixel-dusche.de                              #
# frankfurt am main, germany                        #
# # # # # # # # # # # # # # # # # # # # # # # # # # #

function repl($raus, $rein, $val) {
	//$raus = "/".$raus."/";
	//$rein = $rein;
	//$tmp = preg_replace($raus, $rein, $val);
	$tmp = str_replace($raus, $rein, $val);
	return $tmp;
}
function isin($suche, $val) {
	$suche = "/".$suche."/";
	return preg_match($suche, $val);
}

function countFailed($idUser, $level) {
    $sql="SELECT COUNT( id ) AS count FROM  user_test WHERE id_user =".$idUser." AND level ='".$level."' AND STATUS =0";
    $res = safe_query($sql);
    $row = mysqli_fetch_object($res);
    
    return $row->count;
}

function checkLessonPass($levelLesson, $idUser) {
    $sql="SELECT COUNT( id ) AS count FROM  user_test WHERE id_user =".$idUser." AND level ='".$levelLesson."' AND STATUS =1";
    $res = safe_query($sql);
    $row = mysqli_fetch_object($res);
    
    return ($row->count > 0) ? true : false;
}

function insertTest($idUser, $level, $status, $data) {
     $date_test=date('Y-m-d');
     $number_lesson = $data['numberLesson'];
     $value = $data['history'];
     
     $sql="insert user_test(id_user,date_test,level,status,number_lesson,value)values(".$idUser.",'".$date_test."','".$level."',".$status.",".$number_lesson.",'".$value."')";
     
     //echo $sql; die();
     safe_query($sql);
}

function checkContinueLesson() {
    $numberFailed = 2;
    
    $numberLesson = (int) $_POST['numberLesson'];
    $numberLessonBefore = (int) $_POST['numberLessonBefore'];
    $numberCourse = (int) $_POST['numberCourse'];
    
    $level = $_POST['level'];
    
    if(countFailed($_SESSION[id_user], $level) == $numberFailed)
     echo 'Sie haben den Test zum '.$numberFailed.'. Mal nicht bestanden.<br>Damit haben Sie den Fernlehrgang nicht bestanden';
    else {
        $level = explode('_', $level);
        
        if((int)$level[0] !=1 && (int)$level[1] == 1) {
            $course = (int)$level[0] -1;
            $lesson = $numberLessonBefore -1;
        } else {
            $course = (int)$level[0];
            $lesson = (int)$level[1] - 1 ;
        }
        
        $BeforeLesson = $course . '_' . $lesson;
        
        if(checkLessonPass($BeforeLesson, $_SESSION[id_user]) || ((int)$level[0] == 1 && (int)$level[1] ==1))
          echo 'yes';
        else
          echo 'You need to pass previous lesson';  
    }
    
    die();
}

function checkResult($data) {
    $passPoint = 0;
    $totalPoint = 0;
    
    $numberFailed = 2;
    
    $numberLesson = (int) $_POST['numberLesson'];
    
    $percentPass = (int) $_POST['percentPass'];
    
    $level = $_POST['level'];
    $copyLevel = $level;
    
    if(countFailed($_SESSION[id_user], $level) == $numberFailed)
     echo 'Sie haben den Test zum '.$numberFailed.'. Mal nicht bestanden.<br>Damit haben Sie den Fernlehrgang nicht bestanden';
    else {
       $level = explode('_', $level);
    
       $course = (int) $level[0];
       $lesson = (int) $level[1];
       
       for($i = 1; $i <= $numberLesson; $i++) {
           $xml=simplexml_load_file("questions/course$course/lesson$lesson/question$i.xml") or die("Error: Cannot create object");
           
           $questions = $xml->questions->question;
           
           $totalPoint = $totalPoint + (int) $xml->questions['point'];
           
           $check = true;
           
           for($j = 1;$j <= count($questions->choose); $j++)
           {
             $namePost = $course . '_' . $lesson . '_' . $i . '_' . $j;
             
             if($questions->choose[$j-1]['value'] == 'yes' && $_POST[$namePost] != 'on')
              $check = false;
           }
           
           if($check){
            $passPoint = $passPoint + (int) $xml->questions['point'];
           }
      }
    
    if($totalPoint * $percentPass/100 <= $passPoint){
        insertTest($_SESSION[id_user], $copyLevel, 1, $data);
        echo 'success';
    } else {
        insertTest($_SESSION[id_user], $copyLevel, 0);
        echo 'failed'; 
    }
   } 
    die();
}

function check_question($id,$value)
{
    foreach($value as $item)
      if($item==$id)
        return true;
    return false;
}
function NumberChoose($level,$question)
{
      $level = explode('_', $level);
      $course = (int) $level[0];
      $lesson = (int) $level[1];
      
      $xml=simplexml_load_file("questions/course$course/lesson$lesson/question$question.xml") or die("Error: Cannot create object");
      $questions=$xml->questions->question;
      //print_r($questions);
      
      $count=0;
      
      for($j=0;$j<count($questions->choose);$j++)
      {
        if($questions->choose[$j]['value']=='yes')
          $count++;
      }
      
      return $count;
}
function GetCountry()
{
    echo "<select name='country' id='country' required><option value=''>Land</option>";
    $sql="select * from country order by name";
    $res = safe_query($sql);
    while ($row = mysqli_fetch_object($res)) {
       echo '<option value='.$row->country_id.'>'.$row->name.'</option>';
    }
    echo "</select>";
}
function GetCountry_profile($id)
{
    echo "<select name='country' id='country' required><option value=''>Land</option>";
    $sql="select * from country order by name";
    $res = safe_query($sql);
    while ($row = mysqli_fetch_object($res)) {
       if($row->country_id==$id)
         $select="selected";
       else
         $select="";
       echo '<option '.$select.' value='.$row->country_id.'>'.$row->name.'</option>';
    }
    echo "</select>";
}
function GetProfile($id)
{
    $sql="select * from user where uid=".$id." and active=1";
    //echo $sql;
    $res = safe_query($sql);
    $row = mysqli_fetch_object($res);
    return $row;
}
function Getcourse($id)
{
    $sql="select * from morp_courses where id=".$id."";
    //echo $sql;
    $res = safe_query($sql);
    $row = mysqli_fetch_object($res);
    return $row;
}
function crontab($day)
{
	$emailLogo = '<img src="http://www.chung-shi.com/images/logo.jpg" alt="">';
	$format = '<p style="font-family:arial;color:#666;">';

    //get all user <> admin
    $sql="select * from user where admin=0";
    $res = safe_query($sql);
    $total=0;
    $information="";
    while ($row = mysqli_fetch_object($res)) {
       $id=$row->uid;
       $email=$row->email;
       $name=$row->Vorname." " .$row->Name;
       //get last date pass of user
       $sql="select date_test from user_test where id_user=".$id." and status=1 order by date_test desc";
       $res1 = safe_query($sql);
       $row1 = mysqli_fetch_object($res1);
       $date_test=$row1->date_test;
       $current_date=date('y-m-d');
       //if over 2 weeks
       if((strtotime($current_date)-strtotime($date_test) )/(24*3600)>=$day)
       {
         $total++;
         //add information to show result
         $information.=$name .' ' . 'pass last on' .$date_test ."<br>";
         //active next test
         $sql="update user_test_active set active=1 where id_user=".$id." and active=0";
        // safe_query($sql);
         //send email to inform user
         $headers = "MIME-Version: 1.0" . "\r\n";
         $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
		 $headers .= 'From: chung shi Fernlehrgang <info@chung-shi.com>' . "\r\n";
         $message = $emailLogo.$format."<br><br>Ihr nächster Fernlehrang ist bereits aktiv, Sie können die Prüfung jetzt durchführen</p>";
        //echo $message;
         $subject="Der nächste chung shi Fernlehrgang ist aktiviert";
        // echo ("$email,$subject,$message,$headers");
        mail($email,$subject,$message,$headers);
       }

    }
  echo 'Total '.$total.' user active' .'<br>' .$information;
  exit();
}
function filter_language()
{
    $language=$_GET['language'];

    if($language=='germany' || $language=="")
        return '
           <label>Language:</label>
           <select class="filter">
             <option value="germany">Germany</option>
             <option value="english">English</option>
           </select>

        ';
    else
         return '
           <label>Language:</label>
           <select class="filter">
             <option value="germany">Germany</option>
             <option selected value="english">English</option>
           </select>

        ';


    ;
}
function setumbruch ($val) {
	return preg_replace(array("/\|/"), array("&shy;"), $val);
}

function getDownloadDirectoy ($pgid, $dots="../") {
	$sql  = "SELECT pgart FROM pdf_group where pgid=$pgid";
	$res  = safe_query($sql);
	$row  = mysqli_fetch_object($res);
 	$art  = $row->pgart;

	if ($art < 2) {
		$pfad 	= $dots."pdf/";
	} else {
		$pfad 	= $dots."secure/dfiles/vxcDfgH/";
	}
	// echo $pfad;
	return $pfad;
}

function wort_anz($inhalt, $max=150, $punkte=1) {
	$text = explode(" ", $inhalt);
	$sum = 0;
	$anz = count($text);
	$new = '';
	$ct  = 0;
	for($i=0; $i<= $anz; $i++) {
		$wort = $text[$i];
		$c = strlen($wort)+1;   // +1 wegen leerzeichen
		$sum += $c;
		if ($sum < $max) { $new .= $wort.' ';	 $ct++; }
	}
	if ($punkte) $new .= $ct < $anz ? '...' : '';

	return $new;
}

function getVorlagenText($id, $lang, $dir) {
	$sql  = "SELECT `content`, `tid` FROM `content` WHERE cid=$id";
	$res = safe_query($sql);
	$row = mysqli_fetch_object($res);
    $this_text  = $row->content;
	$templ_id = $row->tid;
	$alle_bricks_aus_einem_template = get_cms_text($this_text, $lang, $dir);
	include("templates/". ($templ_id ? $templ_id : 1) .".php");
	return str_replace(array("#cont#","#anker#"), array($alle_bricks_aus_einem_template,''), $template);
}

function links($text) {
  $p[] = '"(( |^)((ftp|http|https){1}://)[-a-zA-Z0-9@:%_+.~#?&//=]+)"i';
  $r[] = '<a href="1" target="_blank">\1</a>';
  $p[] = '"( |^)(www.[-a-zA-Z0-9@:%_+.~#?&//=]+)"i';
  $r[] = '\1<a href="http://\2" target="_blank">\\2</a>';
  $p[] = '"([_.0-9a-z-]+@([0-9a-z][0-9a-z-]+.)+[a-z]{2,3})"i';
  $r[] = '<a href="mailto:\1">\\1</a>';
  $text = preg_replace($p, $r, $text);
  return $text;
}
#$text = "www.php4u.net ist meine Lieblingsseite.<br/> ";
#$text.= "michi@php4u.net ist die Email des Authors.";
#echo links($text);

function redirect ($dir) {
	# echo $dir;
	Header( "HTTP/1.1 301 Moved Permanently" );
	Header( "Location: ".$dir);
	Header("Connection: close");
}

function email_style() {
	return '<style Type="text/css">
<!--
body { background-color: #ffffff; }
p, h1, h2, h3, td, a	{ font-family: 	Arial, Verdana; font-size:	13px; line-height: 	16px; color: #666666; margin: 0 0 1px 0; padding: 0; }
td { padding:0;	margin:0;}
h1, h2  { font-weight: 	bold; margin: 0 0 10px 0; }
h1  { font-size: 22px; font-weight: normal; line-height: 20px; margin: 0 0 12px 0; color: #bbe630; }
a:link, a:visited, a:hover	{ font-weight: normal; text-decoration: underline; }
a:hover	{ color: #bbe630; }
//-->
</style>';
}

function setpw () {
	$pool = "qwertz6789upasdfg2345hkyxcvbnm";
	$pool .= "23456789";
	$pool .= "WERTZU8954PLKJHGF234DSAYXCVBNM";
	$sonder = "!?#";

	srand ((double)microtime()*1000000);

	for($index = 0; $index < 7; $index++) {
		if($index==3) $pass .= substr($sonder,(rand()%(strlen ($sonder))), 1);
	    else $pass .= substr($pool,(rand()%(strlen ($pool))), 1);
	}
	return $pass;
}
# # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # #
# # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # #
function no_injection ($str, $artikel=0) {
	if ($str) {
		$str_new = rawurldecode ($str);
		$str_new = preg_replace("=<[^>]*>=siU","",$str_new);

		if ($str_new != $str) unset($str);

		$ersetz = array(
			"select"=>"",
			"insert"=>"",
			"update"=>"",
			"delete"=>"",
			"drop"=>"",
			"function"=>"",
			"script"=>"",
			"alert"=>"",
			"having"=>""
		);

		if ($artikel) {
			$tmp = explode("+", $str);
			foreach ($tmp as $wort) {
				if (in_array($wort, $ersetz)) $nogo = 1;
			}
			if ($nogo) unset($str);
		}

		else {
			# keine unterstuetzung von str_ireplace. daher vergleich der strings vorher und nachher
			$str_lower 	= strtolower($str);
			$str_new 	= str_replace(array_keys($ersetz), array_values($ersetz), $str_lower);

			if ($str_lower != $str_new) unset($str);
		}
		return $str;
	}
}

# # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # #
# # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # #

function menge($menge) {
	global $waehrung;

	if ($menge > 999) {
		$x = strlen($menge);

		if ($waehrung == "&pound;")	$menge = substr($menge, 0, ($x-3)).','.substr($menge, ($x-3), 3);
		else $menge = substr($menge, 0, ($x-3)).'.'.substr($menge, ($x-3), 3);
	}
	return $menge;
}

# # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # #
# # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # #

$ersetzung = array(
utf8_encode("Ò") => "o",
utf8_encode("Ó") => "o",
utf8_encode("ò") => "o",
utf8_encode("ó") => "o",
utf8_encode("Ô") => "o",
utf8_encode("ô") => "o",
utf8_encode("Ú") => "U",
utf8_encode("ú") => "u",
utf8_encode("Ù") => "U",
utf8_encode("ù") => "u",
utf8_encode("Û") => "U",
utf8_encode("û") => "u",
utf8_encode("Á") => "A",
utf8_encode("À") => "A",
utf8_encode("à") => "a",
utf8_encode("á") => "a",
utf8_encode("â") => "a",
utf8_encode("é") => "e",
utf8_encode("è") => "e",
utf8_encode("É") => "E",
utf8_encode("È") => "E",
utf8_encode("Ê") => "E",
utf8_encode("ê") => "e",
utf8_encode("ä") => "ae",
("ä") => "ae",
utf8_encode("ö") => "oe",
utf8_encode("ü") => "ue",
utf8_encode("Ä") => "Ae",
utf8_encode("Ö") => "Oe",
utf8_encode("Ü") => "Ue",
("ö") => "oe",
("ü") => "ue",
("Ä") => "Ae",
("Ö") => "Oe",
("Ü") => "Ue",
utf8_encode("ß") => "ss",
("ß") => "ss",
utf8_encode("&") => "-",
utf8_encode("Í") => "I",
utf8_encode("Ì") => "I",
utf8_encode("í") => "i",
utf8_encode("ì") => "i",
utf8_encode("î") => "i",
utf8_encode("Î") => "I",
utf8_encode(":") => "",
utf8_encode(",") => "",
utf8_encode("´") => "",
utf8_encode("`") => "",
utf8_encode("'") => "",
utf8_encode("“") => "",
utf8_encode("”") => "",
utf8_encode('"') => "",
utf8_encode("„") => "",
utf8_encode("\"") => "",
utf8_encode("?") => "",
utf8_encode("!") => "",
utf8_encode("$") => "",
utf8_encode("=") => "",
utf8_encode("*") => "",
("&copy;") => "",
("&reg;") => "",
utf8_encode("®") => "",
utf8_encode("@") => "",
utf8_encode("€") => "",
utf8_encode("©") => "",
utf8_encode("°") => "",
utf8_encode("%") => "",
utf8_encode("(") => "",
utf8_encode(")") => "",
utf8_encode("™") => "I",
utf8_encode("+") => "-",
utf8_encode("¾") => "",
utf8_encode("½") => "",
utf8_encode("¼") => "",
utf8_encode("²") => "",
utf8_encode("³") => "",
utf8_encode(" ") => "-",
utf8_encode("/") => "-",
utf8_encode("-") => "-",
utf8_encode("---") => "-",
utf8_encode("--") => "-",

);

# # # # # # #
# # # # # # #
function email_code ($string) {
	$safe_string = "";
	# $string = strtolower($string);
	$string_length = strlen($string);

	$safe_array = array("0"=>"&#48;", "1"=>"&#49;", "2"=>"&#50;", "3"=>"&#51;", "4"=>"&#52;", "5"=>"&#53;", "6"=>"&#54;", "7"=>"&#55;", "8"=>"&#56;", "9"=>"&#57;", "a"=>"&#97;", "b"=>"&#98;", "c"=>"&#99;", "d"=>"&#100;", "e"=>"&#101;", "f"=>"&#102;", "g"=>"&#103;", "h"=>"&#104;", "i"=>"&#105;", "j"=>"&#106;", "k"=>"&#107;", "l"=>"&#108;", "m"=>"&#109;", "n"=>"&#110;", "o"=>"&#111;", "p"=>"&#112;", "q"=>"&#113;", "r"=>"&#114;", "s"=>"&#115;", "t"=>"&#116;", "u"=>"&#117;", "v"=>"&#118;", "w"=>"&#119;", "x"=>"&#120;", "y"=>"&#121;", "z"=>"&#122;", "-"=>"&#45;", "."=>"&#46;", ":"=>"&#58;", "@"=>"&#64;", "_"=>"&#95;", "A"=>"&#65;", "B"=>"&#66;", "C"=>"&#67;", "D"=>"&#68;", "E"=>"&#69;", "F"=>"&#70;", "G"=>"&#71;", "H"=>"&#72;", "I"=>"&#73;", "J"=>"&#74;", "K"=>"&#75;", "L"=>"&#76;", "M"=>"&#77;", "N"=>"&#78;", "O"=>"&#79;", "P"=>"&#80;", "Q"=>"&#81;", "R"=>"&#82;", "S"=>"&#83;", "T"=>"&#84;", "U"=>"&#85;", "V"=>"&#86;", "W"=>"&#87;", "X"=>"&#88;", "Y"=>"&#89;", "Z"=>"&#90;", " "=>" ");

	for ($i = 0; $i < $string_length; $i++) {
	       $safe_string .= $safe_array[$string["$i"]];
	}

	return $safe_string;

}


function email_check($email) {
   	$p = '/^[a-z0-9!#$%&*+-=?^_`{|}~]+(\.[a-z0-9!#$%&*+-=?^_`{|}~]+)*';
   	$p.= '@([-a-z0-9]+\.)+([a-z]{2,3}';
   	$p.= '|info|arpa|aero|coop|name|museum)$/ix';
   	return preg_match($p, $email);
}

# # # # # # #
# # # # # # #

function show_galerie($res) {
	global $dir;

	while ($row = mysqli_fetch_object($res)) {
		$tit 	= $row->gtexten;
		$desc 	= $row->gtextde;
		$img 	= $row->gname;
		$tn 	= $row->tn;
		$ordner = $row->gnname;

		$output .= ' href="'.$dir.'Galerie/mm/'.$ordner.'/'.$img.'" title="'.$tit.'"><img src="'.$dir.'Galerie/mm/'.$ordner.'/'.$tn.'" border="0" alt="'.$tit.'"></a>';
	}

	return $output;
}

function galerie_liste ($res) {
	global $te, $hl, $de, $cid, $p2, $p3, $p4, $dir, $lightbox;

	$lightbox = 1;

	while ($row = mysqli_fetch_object($res)) {
		$gnm 	= $row->$hl;
		$te 	= nl2br($row->$te);
		$img 	= $row->img;
		$gnid 	= $row->gnid;

		$output .= "<img src=\"".$dir."Galerie/".$img."\" alt=\"Zur Bildergalerie\" border=\"0\" style=\"margin: 4px 20px 0px 4px; float: left;\">
<strong>$gnm</strong>
";

	}
	return $output;
}

# # # # # # #
# # # # # # #

function save_data($datei,$data,$art)  {
	$write = fopen($datei,$art);	   				//oeffne datei zum schreiben der daten
	if ($write!=0) fwrite($write, $data);			//write data
	fclose($write);
}

function read_data($name) {
	# echo $name;
	$data = fopen($name,"r");

	while (!feof($data)) {
		$val .= trim(fgets($data,4096)) ."\n";
	}

	fclose($data);

	return $val;
} // read_infobox

# # # # # # # # # # # # # # # # # #
# # # # # # # # # # # # # # # # # #

function wochentag($d, $m, $y) {
	$tage 		= array(1=>"Montag", 2=>"Dienstag", 3=>"Mittwoch", 4=>"Donnerstag", 5=>"Freitag", 6=>"Samstag", 7=>"Sonntag");
	$timestamp 	= mktime(0,0,0,$m,$d,$y);
	$w			= date("w",$timestamp);
	return $tage[$w];
}

function tag($d) {
	$tage 		= array(1=>"Montag", 2=>"Dienstag", 3=>"Mittwoch", 4=>"Donnerstag", 5=>"Freitag", 6=>"Samstag", 7=>"Sonntag");
	return $tage[$d];
}

function create_img_liste()	{
	$query 	= "SELECT itext, imgid, `longtext` FROM image";
	$result = safe_query($query);
	$x 		= mysqli_num_rows($result);
	$n		= 0;

	while ($row = mysqli_fetch_object($result)) {
		$n++;
		$itext 		= $row->itext;
		$imgid 		= $row->imgid;
		$longtext 	= $row->longtext;
		$arr1 .= $imgid.'=>"'.$itext.'"';
		$arr2 .= $imgid.'=>"'.$longtext.'"';
		if ($n < $x) {
			$arr1 .= ', ';
			$arr2 .= ', ';
		}
	}

	$out = '<?php
$img_arr_t = array('.$arr1.');

$img_arr_lt = array('.$arr2.');

?>
';
	save_data("../nogo/img.php",$out,"w");
}

function protokoll($uid, $db, $id, $art) {
	# echo "$uid, $db, $id, $art";

	$date = date(Y ."-" .m ."-" .d);

	if (!$uid) $uid = 1;
	if ($art != "neu") {
		$que = "select * from z_protokoll where uid=$uid and db='$db' and id=$id and datum='$date' and art='$art'";
		$res = safe_query($que);
		$x = mysqli_num_rows($res);
	}
	if ($art == "neu" || $x < 1) {
		$que = "insert z_protokoll set uid=$uid, db='$db', id=$id, datum='$date', art='$art'";
		safe_query($que);
	}
}

function getPdf ($pid) {
	if ($pid) {
		$query = "SELECT pname, pdesc FROM pdf where pid=$pid";
		$result = safe_query($query);
		$row = mysqli_fetch_object($result);
		return $row->pname ."##" .$row->pdesc;
	}
}

# # # # bricks einfuegen
# # # # auswertung text startet
function get_cms_text ($text, $lang="de", $dir, $video_page="") 	{
	global $navarray, $navarrayFULL, $hn;
	global $color, $h1_2, $h1_1, $rechts;

	# zuerst check, ob template im text
	if (preg_match("/template/", $text)) $tchk = 1;

	# # # # template auswertung, falls vorhanden
	if ($tchk) {		# falls template vorhanden, dieses durch template inhalt ersetzen
		$tx = explode("##", $text);

		for($i=0; $i <= count($tx); $i++) {
			$txt 	= $tx[$i];
			if (preg_match("/template/", $txt)) {
				$txt = explode("@@", $txt);
				$tid = $txt[1];
				$query 	= "SELECT * FROM template where tid=$tid";
				$result = safe_query($query);
				$row 	= mysqli_fetch_object($result);
				$tx[$i]	= stripslashes($row->content);
			}
		}
		$text = implode("##", $tx);
	}
	# # # # _template

	$tx = explode("##", $text);

	for($i=0; $i <= count($tx); $i++) {
		$txt 	= $tx[$i];
		$txt 	= explode("@@", $txt);
		$text 	= $txt[1];

		# echo "bricks/" .$txt[0] .".php";

		if ($txt[0] && !preg_match("/template/",$txt[0])) {
			if(file_exists("bricks/" .$txt[0] .".php")) include("bricks/" .$txt[0] .".php");
		}
		elseif ($txt[0] && preg_match("/template/",$txt[0])) {
			$output .= "<!-- templ" .$txt[1] ." -->";
			$templ_arr[] = $txt[1];
		}
	}
	# # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # #
	# # # # # # # # # # # # # # # # # # # # # # # # # # #
	# # jetzt werden textinterne links noch ausgebessert

#ohne inneres </p>
#ilink<a href="http://xxx" target="_blank">www</a>ilink<p>Harmonie gibt. Mittlerweile sind die östlichen Philosophie

	$raus  	= array("MuCell", "<shy>", "ilink\n<p><strong>", "</strong></p>ilink", "ilink<p><strong>", "</strong></p>\nilink", "ilink<p>", "</p>\nilink", "</p>ilink", "\nilink", "ilink");
	$rein  	= array("MuCell<sup>&reg;</sup>", "&shy;", "", "", "", "", "", "", "", "", "", "");
	$output	= str_replace($raus, $rein, stripslashes($output));

	return $output;
}
# # # # # # # # # # # # # # # # # # # # # # # # # # #
# # # # # # # # # # # # # # # # # # # # # # # # # # #

# # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # bricks einfuegen
# # # # auswertung text startet
function get_raw_text ($text, $lang="de") 	{
	global $no_str, $nw_str, $search_str, $startseite_l, $startseite_r;

	$tx = explode("##", strip_tags($text));

	for($i=0; $i <= count($tx); $i++) {
		$txt 	= $tx[$i];
		$txt 	= explode("@@", $txt);
		$chk 	= $txt[0];
#		if (eregi("fliesstext", $chk)) {
			$txt 	= $txt[1];
			$txt	= ereg_replace("\n", " ", $txt);
			$txt	= ereg_replace("\r", " ", $txt);
			$txt	= ereg_replace("  ", " ", $txt);
			$t		.= $txt." ";
#		}
	}

	return $t;
}
# # # # # # # # # # # # # # # # # # # # # # # # # # #
# # # # # # # # # # # # # # # # # # # # # # # # # # #
# # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # bricks einfuegen
# # # # auswertung text startet
function get_raw_text_morp ($text, $lang="de") 	{
	global $no_str, $nw_str, $search_str, $startseite_l, $startseite_r;

	$tx = explode("##", strip_tags($text));
	# print_r($tx);

	for($i=0; $i <= count($tx); $i++) {
		$txt 	= $tx[$i];
		$txt 	= explode("@@", $txt);
		$text 	= $txt[1];
		$brick 	= $txt[0];
		$brick  = explode("__", $brick);

		# echo "bricks/" .$txt[0] .".php";

		if(file_exists("../bricks/" .$txt[0] .".php") && !preg_match("/page/", $brick[1])) { include("../bricks/" .$txt[0] .".php"); }

		if ($brick[1]) $t .= '<u>'.$brick[1] . '</u>: ' .$morp.' &nbsp; ';
	}

	return $t;
}
# # # # # # # # # # # # # # # # # # # # # # # # # # #
# # # # # # # # # # # # # # # # # # # # # # # # # # #
# # # # # # # # # # # # # # # # # # # # # # # # # # #
# # # # # # # # # # # # # # # # # # # # # # # # # # #


function browser_detection($which_test)
{
	// initialize variables
	$browser_name = '';
	$browser_number = '';
	// get userAgent string
	$browser_user_agent = strtolower( $_SERVER['HTTP_USER_AGENT'] );
	//pack browser array
	// values [0]= user agent identifier, lowercase, [1] = dom browser, [2] = shorthand for browser,
	$a_browser_types[] = array('opera', true, 'op' );
	$a_browser_types[] = array('msie', true, 'ie' );
	$a_browser_types[] = array('konqueror', true, 'konq' );
	$a_browser_types[] = array('safari', true, 'saf' );
	$a_browser_types[] = array('gecko', true, 'moz' );
	$a_browser_types[] = array('mozilla/4', false, 'ns4' );

	for ($i = 0; $i < count($a_browser_types); $i++)
	{
		$s_browser = $a_browser_types[$i][0];
		$b_dom = $a_browser_types[$i][1];
		$browser_name = $a_browser_types[$i][2];
		// if the string identifier is found in the string
		if (stristr($browser_user_agent, $s_browser))
		{
			// we are in this case actually searching for the 'rv' string, not the gecko string
			// this test will fail on Galeon, since it has no rv number. You can change this to
			// searching for 'gecko' if you want, that will return the release date of the browser
			if ( $browser_name == 'moz' )
			{
				$s_browser = 'rv';
			}
			$browser_number = browser_version( $browser_user_agent, $s_browser );
			break;
		}
	}
	// which variable to return
	if ( $which_test == 'browser' )
	{
		return $browser_name;
	}
	elseif ( $which_test == 'number' )
	{
		return $browser_number;
	}

	/* this returns both values, then you only have to call the function once, and get
	 the information from the variable you have put it into when you called the function */
	elseif ( $which_test == 'full' )
	{
		$a_browser_info = array( $browser_name, $browser_number );
		return $a_browser_info;
	}
}

// function returns browser number or gecko rv number
// this function is called by above function, no need to mess with it unless you want to add more features
function browser_version( $browser_user_agent, $search_string )
{
	$string_length = 8;// this is the maximum  length to search for a version number
	//initialize browser number, will return '' if not found
	$browser_number = '';

	// which parameter is calling it determines what is returned
	$start_pos = strpos( $browser_user_agent, $search_string );

	// start the substring slice 1 space after the search string
	$start_pos += strlen( $search_string ) + 1;

	// slice out the largest piece that is numeric, going down to zero, if zero, function returns ''.
	for ( $i = $string_length; $i > 0 ; $i-- )
	{
		// is numeric makes sure that the whole substring is a number
		if ( is_numeric( substr( $browser_user_agent, $start_pos, $i ) ) )
		{
			$browser_number = substr( $browser_user_agent, $start_pos, $i );
			break;
		}
	}
	return $browser_number;
}

# # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # #
# # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # #

function eliminiere ($nm) {
	global $ersetzung;

	$nm = trim(strtolower($nm));
	if (preg_match("/\"/", $nm)) $nm = str_replace("\"", "", $nm);
	$nm = str_replace(array_keys($ersetzung), array_values($ersetzung), $nm);

	return $nm;
}

function eliminiereBack ($nm) {
	$back_str 		= array("/\+/", "/ae/", "/oe/", "/ue/", "/Ae/", "/Oe/", "/Ue/");
	$back_str_new 	= array(" ", "ä", "ö", "ü", "Ä", "Ö", "Ü");
	$search_str 	= ereg_replace("/", "", implode("|", $back_str));

	if (preg_match("/".$search_str."/", $nm)) 	$nm = preg_replace($back_str, $back_str_new, $nm);

	return $nm;
}

function setstrong ($nm) {
	global $sstr, $nstr, $strong_str;

	if (preg_match("/".$strong_str."/", $nm)) $nm = preg_replace($sstr, $nstr, $nm);

	return $nm;
}
# # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # #
# # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # #

function write_session($sid, $page, $ip)
{
	$date = date(Y ."-" .m ."-" .d);
	$time = date(H.":".i);

	dbconnect();
	$query = "select * from path where sid='$sid' and datum='$date'";
	$result = safe_query($query);
	$x = mysqli_num_rows($result);

	if ($x > 0) {
		$row   = mysqli_fetch_array($result);
		$path  = $row["path"];
		$id    = $row["id"];
		$path .= "|$page";
		$query = "update path set path='$path', ende='$time' where id=$id";
	}
	else $query = "insert path set ip='$ip', path='$page', sid='$sid', datum='$date', start='$time'";
	$result = safe_query($query);
}

# # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # #
# # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # #

function get_text($textid) {
	global $language;
	#return "[".$language[$textid]."]";
	return utf8_encode($language[$textid]);
} // get_text()

# # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # #
# # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # #

# images für up and down
function down() {
	return "<img src=\"images/down.gif\" width=9 height=9 alt=\"eine Position nach unten\" border=0>";
}

function up() {
	return "<img src=\"images/up.gif\" width=9 height=9 alt=\"eine Position nach oben\" border=0>";
}

function ilink($text='') {
	return "<img src=\"images/link.gif\" width=5 height=10 alt=\"$text\" border=0>";
}

function backlink($text='') {
	return "<img src=\"images/backlink.gif\" width=5 height=10 alt=\"$text\" border=0>";
}

function table($cp=0, $cs=0, $w='', $b=0) {
	return "<table width=$w border=$b cellspacing=$cs cellpadding=$cp>";
}

function select($name, $style) {
	return "\n\n<select name=$name style=\"$style\">\n";
}

function option($value, $text) {
	return "<option value=\"$value\">$text</option>\n";
}

// für darstellung europäische zahldarstellung mit komma
function ger_p($val)
{
	$val = strtr($val,".",",");
	return $val;
}

function ger_trenn($val)
{
	$val = strtr($val,".",",");
	return $val;
}

// für berechnung benötigt man amerikanische zahldarstellung mit punkt
function us_p($val)
{
	$val = strtr($val,",",".");
	return $val;
}

// damit die zahlen immer mit 2 nachkommastellen geschrieben werden
function check_nachkomma($val)
{
	$nk = sprintf ('%.2f', $val);
	return $nk;
}

function euro_dat($dat) {
	$dat = explode("-", $dat);
	$dat = $dat[2] ."." .$dat[1] ."." .$dat[0];
	return $dat;
}

function us_dat($dat) {
	if(preg_match('/,/', $dat)) $dat = explode(",", $dat);
	else $dat = explode(".", $dat);
	$d = $dat[0];
	$m = $dat[1];
	$y = $dat[2];

	if (strlen($d) < 2) $d = "0".$d;
	if (strlen($m) < 2) $m = "0".$m;
	if (strlen($y) < 3) $y = "20".$y;

	$dat = $y ."-" .$m ."-" .$d;
	return $dat;
}

# # # # # # # NEWSLETTER # # # # # # # # #
# # # # # # # NEWSLETTER # # # # # # # # #
# # # # # # # NEWSLETTER # # # # # # # # #


function create_html_dok($text, $dir="", $art="html") {
	global $newsletter_show, $nl_image, $morpheus, $nav_s;

	if (preg_match("/template/", $text)) $tchk = 1;

	# # # # template auswertung, falls vorhanden
	if ($tchk) {		# falls template vorhanden, dieses durch template inhalt ersetzen
		$tx = explode("##", $text);

		for($i=0; $i <= count($tx); $i++) {
			$txt 	= $tx[$i];
			if (preg_match("/template/", $txt)) {
				$txt = explode("@@", $txt);
				$tid = $txt[1];
				$query 	= "SELECT * FROM template where tid=$tid";
				$result = safe_query($query);
				$row 	= mysqli_fetch_object($result);
				$tx[$i]	= $row->c_de;
			}
		}
		$text = implode("##", $tx);
	}

	if (!$dir) 	include ("design.php");
	else 		include ("newsletter/design.php");

	$tx = explode("##", $text);
	$newsletter_show = 1;

	for($i=0; $i <= count($tx); $i++) {
		$txt 	= $tx[$i];
		$txt 	= explode("@@", $txt);
		$text 	= $txt[1];

		# # # # # # # # # # # # #
		# der NUR text-bereich
		if (preg_match("/umbruch/", $txt[0]) || preg_match("/^umbruch/", $txt[1])) {}
		elseif (!preg_match("/bild/", $txt[0]) && !preg_match("/news/", $txt[0]) && !preg_match("/link/", $txt[0]) && !preg_match("/headline/", $txt[0]))
				$raw   .= $text;
		elseif (preg_match("/headline/", $txt[0])) $raw .= "\n\r\n\r*".$text."*\n";
		elseif (preg_match("/news/", $txt[0])) {}
		elseif (preg_match("/link/", $txt[0]) && !preg_match("/image/", $txt[0]) && !preg_match("/bild/", $txt[0])) {
				$tmp	= explode("|", $txt[1]);
				$raw   .= ' <'.$tmp[0].'>
				';
		}
		# # # # # # # # # # # # # _text
		# # # # # # # # # # # # #

		# # # # # # # # # # # # #
		# der HTML Bereich
		if (!$dir) 	{
			if(file_exists("../../bricks/" .$txt[0] .".php")) include("../../bricks/" .$txt[0] .".php");
		}
		else {
			if(file_exists("../bricks/" .$txt[0] .".php")) include("../bricks/" .$txt[0] .".php");
		}
		# # # # # # # # # # # # #
		# # # # # # # # # # # # #

		if (preg_match("/news/", $txt[0]))	{
			$news = ereg_replace("<a href=\"", "", $news);
			$news = ereg_replace("\" class=\"intern\">Zum Artikel", "", $news);
			$raw   .= strip_tags($news);
		}
	}
	# # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # #
	# # # # # # # # # # # # # # # # # # # # # # # # # # #
	# # jetzt werden textinterne links noch ausgebessert

	# # jetzt werden textinterne links noch ausgebessert
	if ($art == "html") 	{
		$raus  = array("/\|shy\|/", "/<\/p>\n\nilink/", "/ilink<p style=\"margin: 16px 0px 0px 0px;\">/", "/ilink<p>/", "/ilink/", "/<a name=\"[0-9][0-9]\"><\/a>/", "/ \./");
		$rein  = array("&shy;", " ", " ", " ", "", "", ".");
		$suche = ereg_replace("/", "", implode("|", $raus));

		if (preg_match("/ilink/", $output)) $output = preg_replace($raus, $rein, $output);

		# $raw   = strip_tags($output);
		# # # # # # # # # # # # # # # # # # # # # # # # # # #

		$arr 	   = explode("<!-- inhalt -->", $html);

		$html_dok  = $arr[0];
		$html_dok .= $output;
		$html_dok .= $arr[1];
		// _gefuellt

		return $html_dok;
	}
	else	{
		$raw = ereg_replace("\n\n", "\n", $raw);
		return $raw;
	}
}

function konvert_image ($file, $name, $mx, $savedir) {
	// echo $name;
	$typ = explode(".", $name);
	$typ = $typ[(count($typ)-1)];

	if ($typ == "jpg") 		$type = 11;
	elseif ($typ == "png")  $type = 10;
	else die("upload von unbekannten datenformat");
	# _type

	$src 	= ImageCreateFromJPEG($file);
	$w 		= ImageSx($src);
	$h 		= ImageSy($src);

	// echo "<li>w: ".$w."<li>h: ".$h."<li>new: ".$mx."<li>pfad: ".$savedir."<li>";

	# das konvertierte image ist quadratisch qualitaet 80%
	if ($mx) {
		if ($w > $h) {
			if ($w > $mx) $wert = $mx/$w;
			else $wert = $w/$mx;
		}
		else {
			if ($h > $mx) $wert = $mx/$h;
			else $wert = 1;
		}

		if ($wert > 1) {
			$x = $w/$wert;
			$y = $h/$wert;
		}
		else {
			$x = $w*$wert;
			$y = $h*$wert;
		}

		$posx = ($mx - $x)/2;
		$posy = ($mx - $y)/2;

		$dst 	= ImageCreateTrueColor($mx,$mx);
		$white 	= ImageColorAllocate($dst, 255, 255, 255);
		imagefill($dst, 0, 0, $white);
		ImageCopyResampled($dst, $src, $posx, $posy, 0, 0, $x, $y, $w, $h);
		@imageJPEG($dst, $savedir.$name, 80);
	}
}

function konvert_img ($file, $name, $mx, $savedir) {
	// echo $name;
	$typ = explode(".", $name);
	$typ = $typ[(count($typ)-1)];

	if ($typ == "jpg") 		$type = 11;
	elseif ($typ == "png")  $type = 10;
	else die("upload von unbekannten datenformat");
	# _type

	$src 	= ImageCreateFromJPEG($file);
	$w 		= ImageSx($src);
	$h 		= ImageSy($src);

	if ($mx) {
		$wert = $mx/$h;

		$x = $w*$wert;
		$y = $h*$wert;

#		$posx = ($mx - $x)/2;
#		$posy = ($mx - $y)/2;

		$dst 	= ImageCreateTrueColor($x,$y);
		$white 	= ImageColorAllocate($dst, 255, 255, 255);
		imagefill($dst, 0, 0, $white);
		ImageCopyResampled($dst, $src, $posx, $posy, 0, 0, $x, $y, $w, $h);
		@imageJPEG($dst, $savedir.$name, 80);
	}
}


function set_link() {
	global $navarray;

	$cid = $_GET["cid"];
	$p2  = $_GET["p2"];
	$p3  = $_GET["p3"];
	$p4  = $_GET["p4"];

	$setlink  .= $cid;
	if ($p2) {
		$setlink  .= "-".$p2;
		echo $thnav	= $navarray[$p2];
	}
	if ($p3) {
		$setlink 	.= "-".$p3;
		$thnav  .= "/".$navarray[$p3];
	}
	if ($p4) {
		$setlink 	.= "-".$p4;
		$thnav  .= "/".$navarray[$p4];
	}

	return $nlink = $thnav."/".$setlink;
}


function pull_down ($id, $db, $sp_name, $sp_id) {
	$query 	= "SELECT * FROM $db ORDER BY $sp_name";
	$result = safe_query($query);
	$pd = "<option value=\"\">Bitte w&auml;hlen</option>\n";

	while ($row = mysqli_fetch_object($result)) {
		if ($row->$sp_id == $id) $sel = "selected";
		else $sel = "";

		$nm  = $row->$sp_name;
		$pd .= "<option value=\"" .$row->$sp_id ."\" $sel>$nm</option>\n";
	}
	return $pd;
}

function get_img($imgid) {
	$que  	= "SELECT itext, imgname FROM image WHERE imgid=$imgid";
	$res 	= safe_query($que);
	$rw     = mysqli_fetch_object($res);
	$inm 	= $rw->imgname;
	return $inm;
}

function mobile_device_detect($iphone=true,$android=true,$opera=true,$blackberry=true,$palm=true,$windows=true,$mobileredirect=false,$desktopredirect=false){
  $mobile_browser   = false; // set mobile browser as false till we can prove otherwise
  $user_agent       = $_SERVER['HTTP_USER_AGENT']; // get the user agent value - this should be cleaned to ensure no nefarious input gets executed
  $accept           = $_SERVER['HTTP_ACCEPT']; // get the content accept value - this should be cleaned to ensure no nefarious input gets executed

  switch(true){ // using a switch against the following statements which could return true is more efficient than the previous method of using if statements

    case (preg_match('ipod',$user_agent)||preg_match('iphone',$user_agent)); // we find the words iphone or ipod in the user agent
      $mobile_browser = $iphone; // mobile browser is either true or false depending on the setting of iphone when calling the function
      $status = 'Apple';
    break; // break out and skip the rest if we've had a match on the iphone or ipod

    case (preg_match('iPad',$user_agent)); // we find the words iphone or ipod in the user agent
      $mobile_browser = 3; // mobile browser is either true or false depending on the setting of iphone when calling the function
      $status = 'Apple';
    break; // break out and skip the rest if we've had a match on the iphone or ipod

//    case (preg_match('android',$user_agent) && preg_match('Mobile',$user_agent));  // we find android in the user agent
    case (preg_match('android',$user_agent) );  // we find android in the user agent
      $mobile_browser = $android; // mobile browser is either true or false depending on the setting of android when calling the function
      $status = 'Android';
    break; // break out and skip the rest if we've had a match on android

    case (preg_match('opera mini',$user_agent)); // we find opera mini in the user agent
      $mobile_browser = $opera; // mobile browser is either true or false depending on the setting of opera when calling the function
      $status = 'Opera';
    break; // break out and skip the rest if we've had a match on opera

    case (preg_match('blackberry',$user_agent)); // we find blackberry in the user agent
      $mobile_browser = $blackberry; // mobile browser is either true or false depending on the setting of blackberry when calling the function
      $status = 'Blackberry';
    break; // break out and skip the rest if we've had a match on blackberry

    case (preg_match('/(pre\/|palm os|palm|hiptop|avantgo|fennec|plucker|xiino|blazer|elaine)/i',$user_agent)); // we find palm os in the user agent - the i at the end makes it case insensitive
      $mobile_browser = $palm; // mobile browser is either true or false depending on the setting of palm when calling the function
      $status = 'Palm';
    break; // break out and skip the rest if we've had a match on palm os

    case (preg_match('/(iris|3g_t|windows ce|opera mobi|windows ce; smartphone;|windows ce; iemobile)/i',$user_agent)); // we find windows mobile in the user agent - the i at the end makes it case insensitive
      $mobile_browser = $windows; // mobile browser is either true or false depending on the setting of windows when calling the function
      $status = 'Windows Smartphone';
    break; // break out and skip the rest if we've had a match on windows

    default;
      $mobile_browser = false; // set mobile browser to false
      $status = 'Desktop / full capability browser';
    break; // break even though it's the last statement in the switch so there's nothing to break away from but it seems better to include it than exclude it

  } // ends the switch

  // tell adaptation services (transcoders and proxies) to not alter the content based on user agent as it's already being managed by this script
//  header('Cache-Control: no-transform'); // http://mobiforge.com/developing/story/setting-http-headers-advise-transcoding-proxies
//  header('Vary: User-Agent, Accept'); // http://mobiforge.com/developing/story/setting-http-headers-advise-transcoding-proxies

  // if redirect (either the value of the mobile or desktop redirect depending on the value of $mobile_browser) is true redirect else we return the status of $mobile_browser

    return $mobile_browser; // will return either true or false


} // ends function mobile_device_detect


function getform($dat, $un, $em) {
	return '
	<form name="getlog" method="post" class="form">
		<p>Ihre Mitgliedsnummer</p>
		<input type="text" name="unr" id="unr" value="'.$un.'" placeholder="Ihre Mitgliedsnummer" /><br/>
		<p>Ihre E-Mail Adresse</p>
		<input type="text" name="mail" id="mail" value="'.$em.'" placeholder="Ihre E-Mail Adresse" /><br/>
		<p>Ihr Geburtsdatum</p>
		<input type="text" name="gdat" id="gdat" value="'.$dat.'" placeholder="tt.mm.jjjj" /><br/>
		<input type="submit" value="absenden" />
	</form>
';
}



function newPW($min, $sec) {
	return '
			<h2>Bitte geben Sie ein neues Passwort ein.</h2>
			<p>Das Passwort sollte mind. eine Zahl enthalten und insgesamt aus mind. 6 Zeichen bestehen.</p>
				<form name="golog" method="post" class="form">
					<input type="password" name="pw1" id="pw1" value="" placeholder="Passwort" /><br/>
					<input type="password" name="pw2" id="pw2" value="" placeholder="Passwort wiederholen" /><br/>
					<input type="hidden" name="sec" id="sec" value="'.erstelleID($sec).'" />
					<input type="submit" value="Passwort setzen" />
				</form>

';
}

function holeID($key) {
	$key = substr($key,15);
	$len = strlen($key);
	$len = $len-10;
	return $key = substr($key,0,$len);
}

function erstelleID($id) {
	return substr(md5($row->mail),0,15).$id.substr(md5($row->mail),5,10);
}

?>