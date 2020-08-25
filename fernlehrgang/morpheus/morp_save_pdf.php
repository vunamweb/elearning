<?php
    error_reporting( E_ALL );
    ini_set('display_errors', 0);
?>
<?php
include("../dompdf/autoload.inc.php");
include("../nogo/config.php");
include("../nogo/db.php");
dbconnect();
use Dompdf\Dompdf;
$dompdf = new Dompdf();
$id_pdf=$_REQUEST['id_pdf'];
//get color
$db = "6_color";
$sql = "SELECT * FROM $db where id_pdf=".$id_pdf."";
$res = safe_query($sql);
$row = mysqli_fetch_object($res);
$color=$row->value;

if($color == "e0cf5d") {
	$color2 = "f9eec8";
	$title_name = "isolates";
}
elseif($color == "dca051") {
	$color2 = "fbdfc5";
	$title_name = "concentrates";
}
elseif($color == "4670ba") {
	$color2 = "b3d4ea";
	$title_name = "textures";
}
elseif($color == "8272b4") {
	$color2 = "d8d4e7";
	$title_name = "fibres";
}
elseif($color == "92b76d") {
	$color2 = "d6e7d0";
	$title_name = "lecithin";
}
elseif($color == "3d99a9") {
	$color2 = "b3dfe4";
	$title_name = "soya beans";
}

$html = '<!DOCTYPE html>
<html lang="en">
<head>
  <style>
    @font-face {
        font-family: Univers BlackExt;
        src: url(../dompdf/Univers/Univers-BlackExt.otf);
   }
   @font-face {
        font-family: Univers-55;
        src: url(../dompdf/Univers/Univers.otf);
   }
   @font-face {
        font-family: Univers-LightUltraCondensed;
        src: url(../dompdf/Univers/Univers-LightUltraCondensed.otf);
   }
   @font-face {
        font-family:Univers-57-Condensed ;
        src: url(../dompdf/Univers/Univers-Condensed.otf);
   }
   @font-face {
        font-family:Univers-55-Light ;
        src: url(../dompdf/Univers/Univers-Bold.otf);
   }
   body,h1,h2,h3,h4,h5,div,table,tr,td,p{font-family: Univers-55}
    .logo-page1
    {
      width:150px;
      margin-top:28px;
    }
    .bottom-page1
    {
       position:absolute;width:150px;top:850px;padding-left:30px
    }
    .border-title-logo-page1
    {
       color:#fff;
       background-image:url("icon/tr_'.$color.'.png");
       background:no-repeat;
       background-size: cover;
       padding-left: 51px;
       padding-top: 2px;
       font-size:24px;
       background-position: 0px 0px;
       width:230px;
       height:47px;
       font-family:Univers BlackExt;
       text-align:left;
      /* border-radius: 0 10px 0 0;*/
    }
    .border-title-logo-page1-icon
    {
       color:#fff;
       background-image:url("icon/tl_'.$color.'.png");
       background:no-repeat;
       padding-left: 31px;
       background-position: 0px 0px;
       width:240px;
       height:47px;
       font-family:Univers BlackExt;
       font-size:24px;
       padding-top: 2px;
       padding-bottom: 0px;
    }
    .logo-page1
    {

    }
    img.border-logo-page1{height:50px;}
    .headline-page1
    {
       border:1px solid #'.$color.';border-radius:0 0 60px 0;border-left:0px solid red;padding:15px 20px 10px;position:relative;margin-top:14px;
    }
    .headline-page1 p{margin:0}
    .headline-page1 span{margin:0}
    .page2{page-break-before:always;margin-top:30px}
    .page2 p{margin:0}
    .page3{page-break-before:always;margin-top:30px}
    .page3 p{margin:0}
    .page2{page-break-before:always}
    .page4{page-break-before:always;margin-top:30px}
    .page4 p{margin:0;}
     table tr td{padding-left:5px}
    .page2 .detail{margin-top:0px;margin-left:50px;margin-right:30px}
    .page3 .detail{margin-top:20px;margin-left:50px;margin-right:30px}
    .page4 .detail{margin-top:20px;margin-left:50px;margin-right:30px}
    .page2-text{margin-left:50px;margin-top:30px;margin-bottom:15px;line-height:1em}
    .page2-text p {font-size: 12px;line-height:1em}
    .page2-text h1 {font-size: 14px;color:#706F6F;font-family:Univers-57-Condensed;}
    .footer-bottom{font-size:12px}
    .footer-top{padding:20px 0 30px 20px; border:1px solid #'.$color.';border-radius:0 0 0 50px;height:230px;font-size:12px}
    input[type="checkbox"]:checked + label:before {background-color: blue;color:pink;Content:"✔";}
  </style>
</head>
<body>
<div style="position:absolute;left:70%;">';
//page1 logo
$html.='<div class="logo-page1">
                <div class="border-title-logo-page1-icon">'.$title_name.'</div>
                <p style="padding-top:0;margin-top:-10px;padding-left:30px;color:#'.$color.';font-family:Univers BlackExt;width:200px;font-size:21px"> &nbsp; </p>
                <table style="padding-left:30px;margin-top:-15px" cellspacing="3" cellpadding="8">';

$db = "page1_logo";
$sql = "SELECT * FROM $db where id_pdf=".$id_pdf." order by image";
$res = safe_query($sql);
$k=0;
while ($row = mysqli_fetch_object($res)) {
 $image=str_replace('.png','',$row->image);
 $image.='_'.$color .'.png';
 if($k%2==0)
   $html.='<tr><td style="padding-bottom:0;padding-top:0;" valign="top"><img height="90" src="icon/'.$image.'" /></td>';
  else
   $html.='<td style="padding-bottom:0;padding-top:0;" valign="top"><img height="90" src="icon/'.$image.'" /></td></tr>';
  $k++;
}
$html.='</table> ';
$html.=' </div>';
$html.='<div class="bottom-page1">
                   <p><img src="upload_logo/bottom.png" width="200" alt="" /></p>

             </div>';
$html.='</div>
<!-- page1  !-->
<div style="float:left;width:70%;margin-top:25px">
            <p style="font-size: 30px;margin-top: 11px;color: #706F6F;margin-bottom: 15px;margin-left:18px;font-family:Univers-57-Condensed">DATA SPECIFICATIONS</p>';
//$id_pdf=$_GET['id_pdf'];
//page 1 text top
$db = "page1_text_top";
$sql = "SELECT * FROM $db where id_pdf=".$id_pdf."";
$res = safe_query($sql);
$row = mysqli_fetch_object($res);
$page1_text_top=$row->value;
$page1_text_top = explode("\n", $page1_text_top);
//page 1 text bottom
$db = "page1_text_bottom";
$sql = "SELECT * FROM $db where id_pdf=".$id_pdf."";
$res = safe_query($sql);
$row = mysqli_fetch_object($res);
$page1_text_bottom=$row->value;
//page 2 text
$db = "page2_text";
$sql = "SELECT * FROM $db where id_pdf=".$id_pdf."";
$res = safe_query($sql);
$row = mysqli_fetch_object($res);
$page2_text=$row->value;

$html.= "<div style='color:#".$color.";line-height:85px;margin-left:18px'>
  <p style='font-family: Univers-LightUltraCondensed;font-size: 90px;margin-bottom:0;margin-top:25px'>".$page1_text_top[0]."</p>
  <p style='font-size: 30px;margin-top:0;margin-bottom:20px;line-height: 24px;font-family:Univers-57-Condensed'>
    ".$page1_text_top[1]."<br>
    <span>".$page1_text_top[2]."</span>
  </p>
</div>";
$html.=  '<div class="headline-page1">';

//page 1 headline
$db = "page1_headline";
$sql = "SELECT * FROM $db where id_pdf=".$id_pdf." order by ordering";
$res = safe_query($sql);
while ($row = mysqli_fetch_object($res)) {
  $html.='<div style="color:#706F6F;font-size:22px;font-family:Univers-57-Condensed">
                   '.$row->title.'
                </div>
                <div style="padding-top:5px;padding-bottom:25px;line-height:1em;font-size:14px">
                  '.$row->text.'
                </div>';
}
//page 1 text bottom
$html.='</div>

       </div>';
// page2
 $html.=      '
       <div class="page2">
          <div style="float:left;font-family:Univers BlackExt;width:300px;">
              <div class="border-title-logo-page1">'.$title_name.'</div>
              <p style="color:#'.$color.';font-family:Univers BlackExt;font-size:21px"><!--Soja Protein--></p>
          </div>
          <div style="float:left;margin-left: 20px;margin-top: -63px;line-height:1.5em">
            <p style="color:#'.$color.';font-family:Univers-57-Condensed;font-size:20px"><span style="font-size:50px;padding-right:5px;font-family:Univers-LightUltraCondensed">'.$page1_text_top[0].'</span> <!--'.$page1_text_top[1].'--></p>
            <p style="font-size:35px;color:#706F6F;font-family:Univers-57-Condensed">DATA SPECIFICATIONS</p>
          </div>
          <div style="clear:both"></div>

          <!-- header  !-->';

//page 2 header
$db = "page2_header";
$sql = "SELECT * FROM $db where id_pdf=".$id_pdf."";
$res = safe_query($sql);
while ($row = mysqli_fetch_object($res)) {
  $html.='<div class="detail">
  <p style="font-size:18px;color:#706F6F;margin-top:25px;margin-bottom:7px;font-family:Univers-57-Condensed">'.$row->name.'</p>
  <table width="100%" style="padding: 0;" cellspacing="0" cellpadding="0" >
  <tr><td colspan="2" style="background:#'.$color.';height:20px"></td></tr>';
  //item of page 2 header
  $db = "page2_header_item";
  $sql = "SELECT * FROM $db where id_page2_header=".$row->id."";
  $res1 = safe_query($sql);
  $k=0;
  while ($row1 = mysqli_fetch_object($res1)) {
     if($k%2==1)
      $style='style="background:#'.$color2.';height:45px;font-size:12px"';
     else
      $style='style="height:45px;font-size:12px"';
     $html.='<tr '.$style.'>
                <td style="font-weight:600;border-right:1.5px solid #fff" valign="top" width="50%">'.$row1->name.'</td>
                <td valign="top" width="50%">'.$row1->value.'</td>
              </tr>';
     $k++;
  }
  $html.='</table></div>';
}
//page2-text
$html.=
          '<div class="page2-text">
            '.$page2_text.'
          </div>
          <!-- footer  !-->';

//page 2 footer
$db = "page2_footer";
$sql = "SELECT * FROM $db where id_pdf=".$id_pdf."";
$res = safe_query($sql);
while ($row = mysqli_fetch_object($res)) {
  $html.='<div class="detail">
   <p style="font-size:18px;color:#706F6F;margin-bottom:7px;margin-top:25px;font-family:Univers-57-Condensed">'.$row->name.'</p>
   <table width="40%" style="float:left;padding:0" cellspacing="0" cellpadding="0">
  <tr><td colspan="2" style="background:#'.$color.';height:20px"></td></tr>';
  //item of page 2 header
  $db = "page2_footer_item";
  $sql = "SELECT * FROM $db where id_page2_footer=".$row->id."";
  $res1 = safe_query($sql);
  $k=0;
  while ($row1 = mysqli_fetch_object($res1)) {
    if($row1->name!="")
    {
         if($k>=10)
         {
            $html.='</table><table width="40%" style="position:absolute;left:55%" cellspacing="0" cellpadding="0">
            <tr><td colspan="2" style="background:#'.$color.';height:20px"></td></tr>';
            $k=0;
         }
         if($k%2==1)
            $style='style="background:#'.$color2.';height:45px;font-size:12px"';
         else
            $style='style="height:45px;font-size:12px"';
         $html.='<tr '.$style.' >
                    <td style="font-weight:600;border-right:1.5px solid #fff" width="30%">'.$row1->name.'</td>
                    <td  width="30%">'.$row1->value.'</td>
                  </tr>';
         $k++;
    }
  }
  $html.='</table></div><div style="clear:both"></div>';
}
$html.='</div>
<!-- page3  !-->
       <div style="clear:both"></div>
       <div class="page3">
          <div style="float:left;font-family:Univers BlackExt;width:300px">
              <div class="border-title-logo-page1">'.$title_name.'</div>
              <p style="color:#'.$color.';font-family:Univers BlackExt;font-size:21px"><!-- Soja Protein --></p>
          </div>
          <div style="float:left;margin-left: 20px;margin-top: -63px;line-height:1.5em">
            <p style="color:#'.$color.';font-family:Univers-57-Condensed;font-size:20px"><span style="font-size:50px;padding-right:5px;font-family:Univers-LightUltraCondensed">'.$page1_text_top[0].'</span> <!--'.$page1_text_top[1].'--></p>
            <p style="font-size:35px;color:#706F6F;font-family:Univers-57-Condensed">DATA SPECIFICATIONS</p>
          </div>
          <div style="clear:both"></div>
          <div class="detail">
             <p style="font-size:18px;color:#706F6F;margin-bottom:7px;margin-top:40px;font-family:Univers-57-Condensed">ALLERGIENELISTE</p>
             <table width="100%">
              <tr style="background:#'.$color.';color:#fff;font-size:14px;font-weight:700">
                <td width="50%">Allergen</td>
                <td width="25%">Rezept mit</td>
                <td width="25%">Rezept ohne</td>
              </tr>';
//page3
$db = "checkbox";
$sql = "SELECT * FROM $db where format_page=1";
$res = safe_query($sql);
$k=0;
while ($row = mysqli_fetch_object($res)) {
   $sql="select * from pdf_checkbox where id_pdf=".$id_pdf." and id_checkbox=".$row->id." ";
   $res1 = safe_query($sql);
   $row1 = mysqli_fetch_object($res1);
   if($k%2==1)
      $style='style="background:#'.$color2.';font-weight:bold;font-size:12px"';
     else
      $style='style="font-weight:bold;font-size:12px;"';
   $html.='<tr '.$style.'><td width="50%" style="line-height:10px;padding:3px 10px 6px;">'.$row->title.'</td>';
   if($row1->id!="")
     $html.='<td width="25%">x</td>
                <td width="25%"></td></tr>';
     else
      $html.='<td width="25%"></td>
                <td width="25%">x</td></tr>';
    $k++;
}
$html.='</table></div></div>';
$html.='
<!-- page4  !-->
       <div style="clear:both"></div>
       <div class="page4">
          <div style="float:left;font-family:Univers BlackExt;width:300px">
              <div class="border-title-logo-page1">'.$title_name.'</div>
              <p style="color:#'.$color.';font-family:Univers BlackExt;font-size:21px"><!-- Soja Protein --></p>
          </div>
          <div style="float:left;margin-left: 20px;margin-top: -63px;line-height:1.5em">
            <p style="color:#'.$color.';font-family:Univers-57-Condensed;font-size:20px"><span style="font-size:50px;padding-right:5px;font-family:Univers-LightUltraCondensed">'.$page1_text_top[0].'</span> <!--'.$page1_text_top[1].'--></p>
            <p style="font-size:35px;color:#706F6F;font-family:Univers-57-Condensed">DATA SPECIFICATIONS</p>
          </div>
          <div style="clear:both"></div>
          <div class="detail">
            <p style="font-size:18px;color:#706F6F;margin-bottom:7px;margin-top:40px;font-family:Univers-57-Condensed">ALLERGIENELISTE</p>

            <table width="100%">
              <tr style="background:#'.$color.';color:#fff;font-size:14px;">
                <td width="50%">Zusätzliche Allergen</td>
                <td width="25%">Rezept mit</td>
                <td width="25%">Rezept ohne</td>
              </tr>';
//page4
$db = "checkbox";
$sql = "SELECT * FROM $db where format_page=2";
$res = safe_query($sql);
$k=0;
while ($row = mysqli_fetch_object($res)) {
   $sql="select * from pdf_checkbox where id_pdf=".$id_pdf." and id_checkbox=".$row->id." ";
   $res1 = safe_query($sql);
   $row1 = mysqli_fetch_object($res1);
   if($k%2==1)
      $style='style="background:#'.$color2.';font-weight:bold;font-size:12px"';
     else
      $style='style="font-weight:bold;font-size:12px"';
   $html.='<tr '.$style.'><td width="50%" style="line-height:10px;padding:4px 10px 8px;">'.$row->title.'</td>';
   if($row1->id!="")
     $html.='<td width="25%">x</td>
                <td width="25%"></td></tr>';
     else
      $html.='<td width="25%"></td>
                <td width="25%">x</td></tr>';
    $k++;
}
$html.='</table></div>';
$html.='<!-- footer  !-->
      <br><br><br>
<!-- footer top  !-->
<div class="footer-top">
  <div style="float:left;width:40%">
    <div style="">
        <p style="color:#706F6F;font-size:22px;margin-bottom:8px;font-family:Univers-57-Condensed">Geeignet für</p>
        <p style="line-height:1em">Inflammation<br>Vegan<br>Vegetarier</p>
    </div>
    <div style="margin-top:25px">
        <p style="color:#706F6F;font-size:22px;margin-bottom:8px;font-family:Univers-57-Condensed">Rückverfolgbarkeit</p>
        <p style="line-height:1em">Die Rückverfolgbarkeit des Produktes ist anhand
            des Kundenauftrages und der Chargennummer
            gewährleistet.
        </p>
    </div>
  </div>
  <div style="float:left;padding-left:20px;width:50%">
    <div style="margin_bottom:20px">
          <p style="color:#706F6F;font-size:22px;margin-bottom:10px;font-family:Univers-57-Condensed">Lebensmittelrecht und Zertifikate</p>
          <p style="line-height:1em;margin-bottom:10px;fontweight:300">Das Produkt entspricht den Anforderungen des
          deutschen Lebensmittelrechts sowie anzuwendender
          EU Verordnungen.</p>
          <p style="line-height:1em;">ISO 9001:2008; ISO 22000:2005; Halal; Koscher;
          NON GMO von SGS; IP Zertifikat; HACCP</p>
    </div>
    <p style="line-height:1em;font-family:Univers-55-Light">Diese Spezifikation hat Gültigkeit bis auf Widerruf
    und ersetzte alle bisherigen Ausgaben.<p>
  </div>
</div>
<!-- footer bottom  !-->
<div style="clear:both"></div>
<br><br>
<div class="footer-bottom">
  <div style="float:left;width:25%"><img width="150" src="upload_logo/footer.png" alt="" /></div>
  <div style="float:left;width:30%;padding-left:20px;padding-top:40px;font-size:0.9em;line-height:1.1em;">
    Efos Global Services GmbH <br>
    Elzmattenstraße 30 <br>
    79312 Emmendingen / Germany <br>
  </div>
  <div style="float:left;width:30%;padding-left:20px;padding-top:40px;font-size:0.9em;line-height:1.1em;">
    Phone: +49 7641 95 93 701 <br>
    E-Mail: info@efos.de <br>
  </div>
  <div style="clear:both"></div>
  <br>
  <p style="padding-left:5px;font-size:0.9em;line-height:0.9em;">Alle Angaben auf Datenblättern oder Spezifikationen dienen in erster Linie der Information und sind in keiner<br>
Weise rechtlich verbindlich. Der Anwender ist verantwortlich für die rechtliche Zulässigkeit im Verbraucherland.<br>
© Copyright by efos GmbH | 11.01.2016</p>
</div>
      </div>
       </body>
       </html>
       ';
//$html.="<div style='page-break-before:always'>fdfdfdfd</div>";
//echo $html;die();
$dompdf->loadHtml($html);
//$dompdf->loadHtml('helooo');


// (Optional) Setup the paper size and orientation
$dompdf->setPaper('A4', 'Horizontal');
//$customPaper = array(0,0,520,1360);
//$dompdf->set_paper($customPaper);
// Render the HTML as PDF
$dompdf->render();

// Output the generated PDF to Browser
//header('Content-Type: application/octet-stream');
//header('Content-Disposition: attachment; filename="morpheus.pdf"');
$dompdf->stream('puresoy-'.$title_name.'-'.$page1_text_top[0]);
exit();
?>
