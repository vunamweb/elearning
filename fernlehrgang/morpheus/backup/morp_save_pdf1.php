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
$row = mysql_fetch_object($res);
$color=$row->value;
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
        font-family: LinotypeUniversW01-Medium;
        src: url(../dompdf/Univers/Linotype-Univers-Medium.otf);
   }
   body,h1,h2,h3,h4,h5,div,table,tr,td,p{font-family: Univers-55}
    .logo-page1
    {
      width:150px
    }
    .bottom-page1
    {
       position:absolute;width:150px;bottom:0
    }
    .border-title-logo-page1
    {
       color:#fff;
       background-image:url("icon/tr_'.$color.'.png");
       background:no-repeat;
       background-size: cover;
       padding-left: 31px;
       padding-top: 2px;
       font-size:24px;
       background-position: 0px 0px;
       width:240px;
       height:47px;
       font-family:Univers BlackExt; 
       text-align:center;
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
    }
    .logo-page1
    {
      
    }
    img.border-logo-page1{height:50px;}
    .headline-page1
    {
       border:1px solid #'.$color.';border-radius:0 0 20px 0;border-left:0px solid red;padding:20px;position:relative;
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
    .page2 .detail{margin-top:20px;margin-left:50px;margin-right:30px}
    .page3 .detail{margin-top:20px;margin-left:50px;margin-right:30px}
    .page4 .detail{margin-top:20px;margin-left:50px;margin-right:30px}
    .footer-top{padding:20px 0 30px 20px; border:1px solid #'.$color.';border-radius:0 0 0 20px;height:330px}
  </style>
</head>
<body>
<div style="position:absolute;left:60%;">';
//page1 logo
$html.='<div class="logo-page1">
                <div class="border-title-logo-page1-icon">isolates</div>
                <p style="margin:3px 0 0 0;padding-left:30px;color:#'.$color.';font-family:Univers BlackExt;width:200px;font-size:21px">Soja Protein</p>
                <table style="padding-left:30px" cellspacing="3" cellpadding="8">';        

$db = "page1_logo";
$sql = "SELECT * FROM $db where id_pdf=".$id_pdf." order by image";
$res = safe_query($sql);
$k=0;
while ($row = mysql_fetch_object($res)) {
 $image=str_replace('.png','',$row->image);
 $image.='_'.$color .'.png';
 if($k%2==0)
   $html.='<tr><td><img height="100" src="icon/'.$image.'" /></td>';
  else
   $html.='<td><img height="100" src="icon/'.$image.'" /></td></tr>';
  $k++;  
}
$html.='</table> ';
$html.=' </div>';
$html.='</div>;
<!-- page1  !-->
<div style="float:left;width:60%;">
            <h4 style="font-size: 28px;
    margin-top: 0px;
    color: #706F6F;
    margin-bottom: 15px;margin-left:18px;font-family: LinotypeUniversW01-Medium">DATA SPECIFICATIONS</h4>';
//$id_pdf=$_GET['id_pdf'];
//page 1 text top            
$db = "page1_text_top";
$sql = "SELECT * FROM $db where id_pdf=".$id_pdf."";
$res = safe_query($sql);
$row = mysql_fetch_object($res);
$page1_text_top=$row->value;
//page 1 text bottom            
$db = "page1_text_bottom";
$sql = "SELECT * FROM $db where id_pdf=".$id_pdf."";
$res = safe_query($sql);
$row = mysql_fetch_object($res);
$page1_text_bottom=$row->value;
//page 2 text            
$db = "page2_text";
$sql = "SELECT * FROM $db where id_pdf=".$id_pdf."";
$res = safe_query($sql);
$row = mysql_fetch_object($res);
$page2_text=$row->value;

$html.= "<div style='color:#".$color.";line-height:85px;margin-left:18px'>
  <p style='font-family: Univers-LightUltraCondensed;font-size: 90px;margin-bottom:0;margin-top:15px'>ISP 920H</p>
  <p style='font-size: 30px;margin-top:0;margin-bottom:20px;line-height: 24px;'>
    Soja Protein Isolat<br>
    <span>Emulsion Typ</span>
  </p>
</div>";
$html.=  '<div class="headline-page1">';
                
//page 1 headline
$db = "page1_headline";
$sql = "SELECT * FROM $db where id_pdf=".$id_pdf."";
$res = safe_query($sql);
while ($row = mysql_fetch_object($res)) {
  $html.='<div style="color:#706F6F;font-weight:600;font-size:22px">
                   '.$row->title.'
                </div>
                <div style="padding-top:5px;padding-bottom:25px">
                  '.$row->text.'
                </div>';
}
//page 1 text bottom
$html.='</div>
           
       </div>';
$html.='<div style="float:left;position:relative;height:100%">
             <div class="bottom-page1">
                   <p><img src="upload_logo/bottom.png" width="250" alt="" /></p>
                   
             </div>';

$html.='</div>';       
       
// page2 
 $html.=      '
       <div class="page2">
          <div style="float:left;font-family:Univers BlackExt;width:300px">
              <div class="border-title-logo-page1">isolates</div>
              <p style="color:#'.$color.';font-family:Univers BlackExt;font-size:21px">Soja Protein</p>
          </div>
          <div style="float:left;margin-left: 20px;margin-top: -60px;line-height:1.5em">
            <p style="color:#'.$color.';font-family:Univers-LightUltraCondensed;font-size:25px"><span style="font-size:55px;padding-right:5px">ISP 920H</span> Emulsion Typ
            </p>
            <p style="font-size:33px;font-weight:bold;color:#706F6F">DATA SPECIFICATIONS</p>
          </div>
          <div style="clear:both"></div>
          
          <!-- header  !-->';
          
//page 2 header
$db = "page2_header";
$sql = "SELECT * FROM $db where id_pdf=".$id_pdf."";
$res = safe_query($sql);
while ($row = mysql_fetch_object($res)) {
  $html.='<div class="detail">
  <h4 style="font-size:18px;color:#706F6F;margin-bottom:0;margin-top:40px">'.$row->name.'</h4>
  <table width="100%">
  <tr><td colspan="2" style="background:#'.$color.';height:20px"></td></tr>';
  //item of page 2 header
  $db = "page2_header_item";
  $sql = "SELECT * FROM $db where id_page2_header=".$row->id."";
  $res1 = safe_query($sql);
  $k=0;
  while ($row1 = mysql_fetch_object($res1)) {
     if($k%2==1)
      $style='style="background:'.$color.'"';
     else
      $style=''; 
     $html.='<tr style="font-weight:bold">
                <td '.$style.' width="50%">'.$row1->name.'</td>
                <td '.$style.' width="50%">'.$row1->value.'</td>
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
while ($row = mysql_fetch_object($res)) {
  $html.='<div class="detail">
  <h4 style="font-weight:500">'.$row->name.'</h4>
  <table width="50%" style="float:left">
  <tr><td colspan="2" style="background:'.$color.';height:15px"></td></tr>';
  //item of page 2 header
  $db = "page2_footer_item";
  $sql = "SELECT * FROM $db where id_page2_footer=".$row->id."";
  $res1 = safe_query($sql);
  $k=0;
  while ($row1 = mysql_fetch_object($res1)) {
    if($row1->name!="")
    { 
         if($k>=9)
         {
            $html.='</table><table width="50%" style="float:left;padding-left:30px;">
            <tr><td colspan="2" style="background:'.$color.';height:15px"></td></tr>';
            $k=0;
         }
         if($k%2==1)
          $style='style="background:'.$color.'"';
         else
          $style=''; 
         $html.='<tr style="font-weight:bold">
                    <td '.$style.' width="50%">'.$row1->name.'</td>
                    <td '.$style.' width="50%">'.$row1->value.'</td>
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
              <div class="border-title-logo-page1">isolates</div>
              <p style="color:#'.$color.';font-family:Univers BlackExt;font-size:21px">Soja Protein</p>
          </div>
          <div style="float:left;margin-left: 20px;margin-top: -60px;line-height:1.5em">
            <p style="color:#'.$color.';font-family:Univers-LightUltraCondensed;font-size:25px"><span style="font-size:55px;padding-right:5px">ISP 920H</span> Emulsion Typ
            </p>
            <p style="font-size:33px;font-weight:bold;color:#706F6F">DATA SPECIFICATIONS</p>
          </div>
          <div style="clear:both"></div>
          <div class="detail">
            <h4 style="font-weight:500;margin-bottom:0;margin-top:40px;color:#706F6F">ALLERGENELISTE</h4>
            <table width="100%">
              <tr style="background:#'.$color.';color:#fff">
                <td width="50%">Allergen</td>
                <td width="25%">Rezept mit</td>
                <td width="25%">Rezept ohne</td>
              </tr>';
//page3
$db = "checkbox";
$sql = "SELECT * FROM $db where format_page=1";
$res = safe_query($sql);
$k=0;
while ($row = mysql_fetch_object($res)) { 
   $sql="select * from pdf_checkbox where id_pdf=".$id_pdf." and id_checkbox=".$row->id." ";
   $res1 = safe_query($sql);
   $row1 = mysql_fetch_object($res1);
   if($k%2==1)
      $style='style="background:#F9EECF;font-weight:bold"';
     else
      $style='style="font-weight:bold"';
   $html.='<tr '.$style.'><td width="50%">'.$row->title.'</td>';
   if($row1->id!="")
     $html.='<td width="25%"><input type="checkbox" checked/></td>
                <td width="25%"></td></tr>';
     else
      $html.='<td width="25%"></td>
                <td width="25%"><input type="checkbox" checked/></td></tr>';
    $k++;                       
}
$html.='</table></div></div>';
$html.='
<!-- page4  !-->    
       <div style="clear:both"></div>
       <div class="page4">
          <div style="float:left;font-family:Univers BlackExt;width:300px">
              <div class="border-title-logo-page1">isolates</div>
              <p style="color:#'.$color.';font-family:Univers BlackExt;font-size:21px">Soja Protein</p>
          </div>
          <div style="float:left;margin-left: 20px;margin-top: -60px;line-height:1.5em">
            <p style="color:#'.$color.';font-family:Univers-LightUltraCondensed;font-size:25px"><span style="font-size:55px;padding-right:5px">ISP 920H</span> Emulsion Typ
            </p>
            <p style="font-size:33px;font-weight:bold;color:#706F6F">DATA SPECIFICATIONS</p>
          </div>
          <div style="clear:both"></div>
          <div class="detail">
            <h4 style="font-weight:500;margin-bottom:0;margin-top:40px;color:#706F6F">ALLERGENELISTE</h4>
            <table width="100%">
              <tr style="background:#'.$color.';color:#fff">
                <td width="50%">Zusätzliche Allergen</td>
                <td width="25%">Rezept mit</td>
                <td width="25%">Rezept ohne</td>
              </tr>';
//page4
$db = "checkbox";
$sql = "SELECT * FROM $db where format_page=2";
$res = safe_query($sql);
$k=0;
while ($row = mysql_fetch_object($res)) { 
   $sql="select * from pdf_checkbox where id_pdf=".$id_pdf." and id_checkbox=".$row->id." ";
   $res1 = safe_query($sql);
   $row1 = mysql_fetch_object($res1);
   if($k%2==1)
      $style='style="background:#F9EECF;font-weight:bold"';
     else
      $style='style="font-weight:bold"';
   $html.='<tr '.$style.'><td width="50%">'.$row->title.'</td>';
   if($row1->id!="")
     $html.='<td width="25%"><input type="checkbox" checked/></td>
                <td width="25%"></td></tr>';
     else
      $html.='<td width="25%"></td>
                <td width="25%"><input type="checkbox" checked/></td></tr>';
    $k++;                       
}
$html.='</table></div>';
$html.='<!-- footer  !-->
      <br><br><br><br><br><br>
<!-- footer top  !-->
<div class="footer-top">
  <div style="float:left;width:40%">
    <div style="">
        <p style="color:#706F6F;font-size:20px;margin-bottom:8px">Geeignet für</p>
        <p style="line-height:1em">Inflammation<br>Vegan<br>Vegetarier</p>
    </div>    
    <div style="margin-top:25px">
        <p style="color:#706F6F;font-size:20px;margin-bottom:8px">Rückverfolgbarkeit</p>
        <p style="line-height:1em">Die Rückverfolgbarkeit des Produktes ist anhand
            des Kundenauftrages und der Chargennummer
            gewährleistet.
        </p>
    </div>    
  </div>
  <div style="float:left;padding-left:20px;width:50%">
    <div style="margin_bottom:20px">
          <p style="color:#706F6F;font-size:20px;margin-bottom:10px">Lebensmittelrecht und Zertifikate</p>
          <p style="line-height:1em;margin-bottom:10px">Das Produkt entspricht den Anforderungen des
          deutschen Lebensmittelrechts sowie anzuwendender
          EU Verordnungen.</p>
          <p style="line-height:1em;">ISO 9001:2008; ISO 22000:2005; Halal; Koscher;
          NON GMO von SGS; IP Zertifikat; HACCP</p>  
    </div>
    <strong>Diese Spezifikation hat Gültigkeit bis auf Widerruf
    und ersetzte alle bisherigen Ausgaben.</strong>
  </div>
</div>
<!-- footer bottom  !-->
<div style="clear:both"></div>
<br><br><br><br>
<div class="footer-bottom">
  <div style="float:left;width:30%"><img src="upload_logo/footer.png" alt="" /></div>
  <div style="float:left;width:30%;padding-left:20px">
    Efos Global Services GmbH <br>
    Elzmattenstraße 30 <br>
    79312 Emmendingen / Germany <br>
  </div>
  <div style="float:left;width:30%;padding-left:20px">
    Phone: +49 7641 95 93 701 <br>
    E-Mail: info@efos.de <br>
  </div>
  <div style="clear:both"></div>
  <br>
  <p>Alle Angaben auf Datenblättern oder Spezifikationen dienen in erster Linie der Information und sind in keiner
Weise rechtlich verbindlich. Der Anwender ist verantwortlich für die rechtliche Zulässigkeit im Verbraucherland.
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
$dompdf->stream('Univers');
exit();
?>
