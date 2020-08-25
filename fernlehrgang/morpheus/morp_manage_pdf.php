<?php
# # # # # # # # # # # # # # # # # # # # # # # # # # #
# www.pixel-dusche.de                               #
# björn t. knetter                                  #
# start 12/2003                                     #
# edit 27.11.2006                                   #
# post@pixel-dusche.de                              #
# frankfurt am main, germany                        #
# # # # # # # # # # # # # # # # # # # # # # # # # # #

session_start();
#$box = 1;
include("cms_include.inc");
// print_r($_REQUEST);

global $arr_form;

///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
// NICHT VERAENDERN ///////////////////////////////////////////////////////////////////
$save	= $_REQUEST["save"];
$edit	= $_REQUEST["edit"];
$update	= $_REQUEST["update"];
$del	= $_REQUEST["del"];
$id	= $_REQUEST["id"];
$color	= $_REQUEST["color"];
$neu	= $_REQUEST["neu"];
$edit	= $_REQUEST["edit"];
$title= $_REQUEST["title"];
$text= $_REQUEST["text"];
$type=$_REQUEST['type'];
$add=$_REQUEST['add'];
$page=$_REQUEST['page'];
$download=$_REQUEST['download'];
$view=$_REQUEST['view'];
$language=$_GET['language'];
if($language=='')
      $language='germany';
///////////////////////////////////////////////////////////////////////////////////////


//// EDIT_SKRIPT
$um_wen_gehts 	= "PDF";
$titel			= "PDF";
///////////////////////////////////////////////////////////////////////////////////////


//////   BJOERN EDIT //////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////
if($page) {
	$sql = "SELECT * FROM page1_text_top where id_pdf=".$page;
	$rs = safe_query($sql);
	$rw = mysqli_fetch_object($rs);
	$name_of_product = $rw->value;
}
else $name_of_product = '';
///////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////

echo '<div id=vorschau>
	'.($name_of_product ? $name_of_product.'<br><br>' : '<h2>'.$titel.'</h2>').'

	'. ($edit || $neu || $view ? '<p><a href="?pid='.$pid.'">&laquo; zur&uuml;ck</a></p>' : '').
    '<form action="" onsubmit="" name="verwaltung" method="post">'
     ;
if(isset($add))
 echo '<p style="color:green">Duplicat success</p>' ;
else if(isset($del))
 echo '<p style="color:green">Delete success</p>' ;

if($add)
{
      $db = "pdf_store";
      $id = "id";
      $sql = "SELECT * FROM $db WHERE $id=".$add."";
      $res = safe_query($sql);
      $row = mysqli_fetch_object($res);
      // title
      $title='copy of ' . $row->title;
      //date time
      $date_time=date('Y-m-d H:i:s');
      // insert pdf
      $db='pdf_store';
      $sql = "insert into $db(title,date_time)
      values('".$title."','".$date_time."')";
      $res = safe_query($sql);
      $id= mysqli_insert_id($mylink);
      //insert color
      $db = "6_color";
      $sql = "SELECT * FROM $db WHERE id_pdf=".$add."";
      $res = safe_query($sql);
      $row = mysqli_fetch_object($res);
      $value=$row->value;
      $sql = "insert into $db(id_pdf,value)
        values('".$id."','".$value."')";
      safe_query($sql);
      // insert pdf_page1_headline
      $db='page1_headline';
      $sql = "SELECT * FROM $db WHERE id_pdf=".$add."";
      $res = safe_query($sql);
      while ($row = mysqli_fetch_object($res)) {
          $title=$row->title;
          $text=$row->text;
          $sql="insert into page1_headline(id_pdf,title,text)values(".$id.",'".$title."','".$text."')";
          safe_query($sql);
      }
      // insert pdf_page1_logo
      $db='page1_logo';
      $sql = "SELECT * FROM $db WHERE id_pdf=".$add."";
      $res = safe_query($sql);
      while ($row = mysqli_fetch_object($res)) {
          $image=$row->image;
          $id_logo=$row->id_logo;
          $sql="insert into page1_logo(id_pdf,id_logo,image)values(".$id.",".$id_logo.",'".$image."')";
          safe_query($sql);
      }
      //insert page 1 text top
      $db = "page1_text_top";
      $sql = "SELECT * FROM $db WHERE id_pdf=".$add."";
      $res = safe_query($sql);
      $row = mysqli_fetch_object($res);
      $value=$row->value;
      $sql = "insert into $db(id_pdf,value)
        values('".$id."','".$value."')";
      safe_query($sql);
      //insert page 1 text bottom
      $db = "page1_text_bottom";
      $sql = "SELECT * FROM $db WHERE id_pdf=".$add."";
      $res = safe_query($sql);
      $row = mysqli_fetch_object($res);
      $value=$row->value;
      $sql = "insert into $db(id_pdf,value)
        values('".$id."','".$value."')";
      safe_query($sql);
      //insert page 2 text
      $db = "page2_text";
      $sql = "SELECT * FROM $db WHERE id_pdf=".$add."";
      $res = safe_query($sql);
      $row = mysqli_fetch_object($res);
      $value=$row->value;
      $sql = "insert into $db(id_pdf,value)
        values('".$id."','".$value."')";
      safe_query($sql);
      // insert pdf page2 header, item
      $db='page2_header';
      $sql = "SELECT * FROM $db WHERE id_pdf=".$add."";
      $res = safe_query($sql);
      while ($row = mysqli_fetch_object($res)) {
          $name=$row->name;
          $id_header_old=$row->id;
          $sql="insert into page2_header(id_pdf,name)values(".$id.",'".$name."')";
          safe_query($sql);
          $id_header_new= mysqli_insert_id($mylink);
          //insert item
          $sql = "SELECT * FROM page2_header_item where id_page2_header=".$id_header_old."";
          $res1 = safe_query($sql);
          while ($row1 = mysqli_fetch_object($res1)) {
             $name=$row1->name;
             $value=$row1->value;
             $sql="insert into page2_header_item(id_page2_header,name,value)values(".$id_header_new.",'".$name."','".$value."')";
             safe_query($sql);
          }
      }
      // insert pdf page2 footer, item
      $db='page2_footer';
      $sql = "SELECT * FROM $db WHERE id_pdf=".$add."";
      $res = safe_query($sql);
      while ($row = mysqli_fetch_object($res)) {
          $name=$row->name;
          $id_footer_old=$row->id;
          $sql="insert into page2_footer(id_pdf,name)values(".$id.",'".$name."')";
          safe_query($sql);
          $id_footer_new= mysqli_insert_id($mylink);
          //insert item
          $sql = "SELECT * FROM page2_footer_item where id_page2_footer=".$id_footer_old."";
          $res1 = safe_query($sql);
          while ($row1 = mysqli_fetch_object($res1)) {
             $name=$row1->name;
             $value=$row1->value;
             $sql="insert into page2_footer_item(id_page2_footer,name,value)values(".$id_footer_new.",'".$name."','".$value."')";
             safe_query($sql);
          }
      }
  echo liste();
}
else if($download)
{
    if($language=="germany")
      $file_download="morp_save_pdf.php";
    else
      $file_download="morp_save_pdf_english.php";
    echo liste();
    echo '<p><a href="?neu=1&language='.$language.'">&raquo; NEU</a></p>';
    ?>
      <script>
        //window.open('<?php echo $file_download ?>?id_pdf=<?php echo $download ?>');
        window.location.href='http://pixeldusche.com/morpheus/morpheus/' + '<?php echo $file_download ?>' + '?id_pdf=<?php echo $download ?>'; 
      </script>
    <?php
}
else if($view)
{
 $id_pdf=$_REQUEST['view'];
 //echo $id_pdf; die();
//get color
$db = "6_color";
$sql = "SELECT * FROM $db where id_pdf=".$id_pdf."";
$res = safe_query($sql);
$row = mysqli_fetch_object($res);
$color=$row->value;
$html = '<!DOCTYPE html>
<html lang="en">
<head>
  <style>
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
       color:#fff;width:150px;
       border-top-right-radius: 10px;
       border-bottom-left-radius: 1px;
       border:1px solid '.$color.';
       background:'.$color.';
       padding:5px;
    }
    .border-title-logo-page1-icon
    {
       color:#fff;width:150px;
       border-top-left-radius: 10px;
       border-bottom-left-radius: 1px;
       border:1px solid '.$color.';
       background:'.$color.';
       padding:5px;
    }
    .border-logo-page1
    {
       border-top-left-radius: 10px;
       border-bottom-left-radius: 1px;
       border:1px solid '.$color.';
       background:'.$color.';
    }
    img.border-logo-page1{height:50px;}
    .headline-page1
    {
       border:1px solid '.$color.';border-radius:0 0 20px 0;border-left:0px solid red;padding:20px;position:relative;
    }
    .headline-page1 p{margin:0}
    .headline-page1 span{margin:0}
    .page2{page-break-before:always}
    .page2 p{margin:0}
    .page3{page-break-before:always}
    .page3 p{margin:0}
    .page2{page-break-before:always}
    .page4{page-break-before:always}
    .page4 p{margin:0}
     table tr td{padding-left:5px}
    .page 2 .detail{margin-top:20px}
    .footer-top{padding:20px 0 30px 20px; border:1px solid '.$color.';border-radius:0 0 0 20px;height:350px}
  </style>
</head>
<body>
<!-- page1  !-->
<div style="float:left;width:70%;">
            <h4 style="font-size:28px;margin-top:0">DATA SPECIFICATIONS</h4>';
//$id_pdf=$_GET['id_pdf'];
//page 1 text top
$db = "page1_text_top";
$sql = "SELECT * FROM $db where id_pdf=".$id_pdf."";
$res = safe_query($sql);
$row = mysqli_fetch_object($res);
$page1_text_top=$row->value;
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

$html.= "<div style='color:".$color.";'>" .$page1_text_top."</div>";
$html.=  '<div class="headline-page1">';

//page 1 headline
$db = "page1_headline";
$sql = "SELECT * FROM $db where id_pdf=".$id_pdf."";
$res = safe_query($sql);
while ($row = mysqli_fetch_object($res)) {
  $html.='<div style="color:'.$color.';font-weight:600">
                   '.$row->title.'
                </div>
                <div style="padding-top:10px;padding-bottom:20px">
                  '.$row->text.'
                </div>';
}
//page 1 text bottom
$html.='</div>

       </div>';
$html.='<div style="float:left;position:relative;height:100%">
             <div class="bottom-page1">
                   <p><img src="upload_logo/bottom.png" width="129" height="67" alt="" /></p>
                   '.$page1_text_bottom.'
             </div>';
$html.='   <div class="logo-page1">
                <div class="border-title-logo-page1-icon">isolates</div>
                <p style="padding-left:30px;color:'.$color.';font-familyz:Univers-BlackExt">Soja Protein</p>
                <table style="padding-left:30px" cellspacing="3" cellpadding="8">';

$db = "page1_logo";
$sql = "SELECT * FROM $db where id_pdf=".$id_pdf."";
$res = safe_query($sql);
$k=0;
while ($row = mysqli_fetch_object($res)) {
 if($k%2==0)
   $html.='<tr><td><img width="39" src="../pdf/'.$row->image.'" class="border-logo-page1"/></td>';
  else
   $html.='<td><img width="39" src="../pdf/'.$row->image.'" class="border-logo-page1"/></td></tr>';
  $k++;
}
$html.='</table> ';
$html.=' </div>';
$html.='</div>';

// page2
 $html.=      '<div style="clear:both"></div>
       <div class="page2">
          <div style="float:left;font-familyz:Univers-BlackExt;width:300px">
              <div class="border-title-logo-page1">isolates</div>
              <p style="color:'.$color.'">Soja Protein</p>
          </div>
          <div style="float:left;"><p style="color:'.$color.';font-familyz:Univers-LightUltraCondensed"><span style="font-size:38px">ISP 920H</span> Emulsion Typ</p><strong>DATA SPECIFICATIONS</strong>
          </div>
          <div style="clear:both"></div>

          <!-- header  !-->';

//page 2 header
$db = "page2_header";
$sql = "SELECT * FROM $db where id_pdf=".$id_pdf."";
$res = safe_query($sql);
while ($row = mysqli_fetch_object($res)) {
  $html.='<div class="detail">
  <h4 style="font-weight:500">'.$row->name.'</h4>
  <table width="100%">
  <tr><td colspan="2" style="background:'.$color.';height:15px"></td></tr>';
  //item of page 2 header
  $db = "page2_header_item";
  $sql = "SELECT * FROM $db where id_page2_header=".$row->id."";
  $res1 = safe_query($sql);
  $k=0;
  while ($row1 = mysqli_fetch_object($res1)) {
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
while ($row = mysqli_fetch_object($res)) {
  $html.='<div class="detail">
  <h4 style="font-weight:500">'.$row->name.'</h4>
  <table width="50%" style="float:left">
  <tr><td colspan="2" style="background:'.$color.';height:15px"></td></tr>';
  //item of page 2 header
  $db = "page2_footer_item";
  $sql = "SELECT * FROM $db where id_page2_footer=".$row->id."";
  $res1 = safe_query($sql);
  $k=0;
  while ($row1 = mysqli_fetch_object($res1)) {
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
          <div style="float:left;font-familyz:Univers-BlackExt;width:200px">
              <div class="border-title-logo-page1">isolates</div>
              <p style="color:'.$color.'">Soja Protein</p>
          </div>
          <div style="float:left;margin-left:200px"><p style="color:'.$color.';font-familyz:Univers-LightUltraCondensed"><span style="font-size:38px">ISP 920H</span> Emulsion Typ</p><strong>DATA SPECIFICATIONS</strong></div>
          <div style="clear:both"></div>
          <div class="detail">
            <h4 style="font-weight:500">ALLERGENELISTE</h4>
            <table width="100%">
              <tr style="background:'.$color.';color:#fff">
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
          <div style="float:left;font-familyz:Univers-BlackExt;width:200px">
              <div class="border-title-logo-page1">isolates</div>
              <p style="color:'.$color.'">Soja Protein</p>
          </div>
          <div style="float:left;margin-left:200px"><p style="color:'.$color.';font-familyz:Univers-LightUltraCondensed"><span style="font-size:38px">ISP 920H</span> Emulsion Typ</p><strong>DATA SPECIFICATIONS</strong></div>
          <div style="clear:both"></div>
          <div class="detail">
            <h4 style="font-weight:500">ALLERGENELISTE</h4>
            <table width="100%">
              <tr style="background:'.$color.';color:#fff">
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
      <div style="clear:both"></div>
      <br><br><br><br><br><br>
<!-- footer top  !-->
<div class="footer-top">
  <div style="float:left;width:40%">
    <h4>Geeignet für</h4>
    <p>Inflammation<br>Vegan<br>Vegetarier</p>
    <h4>Rückverfolgbarkeit</h4>
    <p>Die Rückverfolgbarkeit des Produktes ist anhand
        des Kundenauftrages und der Chargennummer
        gewährleistet.</p>
  </div>
  <div style="float:left;padding-left:20px;width:40%">
    <h4>Lebensmittelrecht und Zertifikate</h4>
    <p>Das Produkt entspricht den Anforderungen des
    deutschen Lebensmittelrechts sowie anzuwendender
    EU Verordnungen.</p>
    <p>ISO 9001:2008; ISO 22000:2005; Halal; Koscher;
    NON GMO von SGS; IP Zertifikat; HACCP</p>
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
 echo $html;
}
else if($del)
{
    //delete pdf_store
    $sql="delete from pdf_store where id=".$del."";
    safe_query($sql);
    //delete color
    $sql="delete from 6_color where id_pdf=".$del."";
    safe_query($sql);
    //delete page1_headline
    $sql="delete from page1_headline where id_pdf=".$del."";
    safe_query($sql);
    //delete from page1_logo
    $sql="delete from page1_logo where id_pdf=".$del."";
    safe_query($sql);
    //delete from page1_text_top
    $sql="delete from  page1_text_top where id_pdf=".$del."";
    safe_query($sql);
    //delete from page1_text_bottom
    $sql="delete from  page1_text_bottom where id_pdf=".$del."";
    safe_query($sql);
    //delete from page_text
    $sql="delete from  page2_text where id_pdf=".$del."";
    safe_query($sql);
    //delete from page2_header , item
    $sql = "SELECT b.id FROM page2_header as a,page2_header_item as b  WHERE a.id_pdf=".$del."
    and a.id=b.id_page2_header";
    $res = safe_query($sql);
    while ($row = mysqli_fetch_object($res)) {
       $sql="delete from  page2_header_item where id=".$row->id."";
       safe_query($sql);
    }
    $sql="delete from page2_header where id_pdf=".$del."";
    safe_query($sql);
    //delete from page2 footer , item
    $sql = "SELECT b.id FROM page2_footer as a,page2_footer_item as b  WHERE a.id_pdf=".$del."
    and a.id=b.id_page2_footer";
    $res = safe_query($sql);
    while ($row = mysqli_fetch_object($res)) {
       $sql="delete from  page2_footer_item where id=".$row->id."";
       safe_query($sql);
    }
    $sql="delete from page2_footer where id_pdf=".$del."";
    safe_query($sql);
   echo liste();
}
else if($update)
{
    if($language=='')
      $language='germany';
      //set field title or title_english will be updated
    if($language=='germany')
     $title_colum='title';
    else
     $title_colum='title_english'; 
    //
    echo "<br><p style='color:green'>Upload success</p>";
    $db = "pdf_store";
    $sql="update $db set $title_colum='".$title."' where id=".$edit."";
    safe_query($sql);
    echo liste();

}
else if ($edit)
{
    if($language=='')
      $language='germany';
    $db = "pdf_store";
    $id = "id";
    $sql = "SELECT * FROM $db WHERE $id=".$edit."";
    $res = safe_query($sql);
    $row = mysqli_fetch_object($res);
    if($language=='germany')
     $title=$row->title;
    else
     $title=$row->title_english;
    echo "<lable>Title: </lable><input type='text' value='".$title."' name='title'/>
          <input type='hidden' name='update' value='update'/>
          <input type='submit' value='Update'/>
    ";
}
else if($page)
{
   page($page);
}
else if ($save) {
    if($language=='')
      $language='germany';
    //set field title or title_english will be inserted
    if($language=='germany')
     $title_colum='title';
    else
     $title_colum='title_english'; 
    //
    //date time
    $date_time=date('Y-m-d H:i:s');
    // insert pdf
    $db='pdf_store';
    $sql = "insert into $db($title_colum,date_time)
    values('".$title."','".$date_time."')";
    $res = safe_query($sql);
    echo liste();

}
else if($neu)
{
    echo "<lable>Title: </lable><input type='text' value='' name='title'/>
          <input type='hidden' name='save' value='save'/>
          <input type='submit' value='save'/>
    ";
}
else
 {
   //echo filter_language();
   echo liste();
   echo '<p><a href="?neu=1&language='.$language.'">&raquo; NEU</a></p>';
 }
echo '
</form>
';
function page($page)
{
   $language=$_GET['language'];
    if($language=='')
      $language='germany';
    if($language=='germany')
      $page_checkbox="morp_edit_checkbox.php";
    else
        $page_checkbox="morp_edit_checkbox_english.php";
   echo '
           <ul style="list-style:none">
			  <li> <a href="morp_page1-text-top.php?edit='.$page.'&language='.$language.'"> <i class="fa fa-recycle"></i> <b>Produktbezeichnung</b> </a></li>
              <li> <br/><a href="morp_color.php?edit='.$page.'&language='.$language.'"> <i class="fa fa-eyedropper"></i> Warengruppe </a></li>
			  <li> <a href="morp_icon.php?id_pdf='.$page.'&language='.$language.'"> <i class="fa fa-language"></i> Icons </a></li>
              <li><br/><a> <i class="fa fa-file-code-o"></i> Seite 1</a>
		<ul>
           <li> <a href="morp_page1-headline.php?id_pdf='.$page.'&language='.$language.'"> Text Box </a></li>
<!--            <li> <a href="#"> Text </a>
             <ul>
               <li> <a href="morp_page1-text-bottom.php?edit='.$page.'&language='.$language.'"> Bottom </a></li>
             </ul>
           </li>-->
        </ul>
      </li>
      <li><br><a href="#"> <i class="fa fa-database"></i> Tabellen</a>
         <ul>
           <li> <a href="morp_page2-header.php?id_pdf='.$page.'&language='.$language.'"> Tabellen anlegen: VOR zentrierten Text </a>
              <ul>
                <li> <a href="morp_page2-header-item.php?id_pdf='.$page.'&language='.$language.'"> Einträge Tabelle </a></li>
             </ul>
           </li>
           <li> <a href="morp_page2-text.php?edit='.$page.'&language='.$language.'"> zentrierter Text </a></li>
           <li> <a href="morp_page2-footer.php?id_pdf='.$page.'&language='.$language.'"> Tabellen anlegen: NACH zentrierten Text // 2 Spalten</a>
              <ul>
                <li> <a href="morp_page2-footer-item.php?id_pdf='.$page.'&language='.$language.'"> Einträge Tabelle </a></li>
             </ul>
           </li>
         </ul>
      </li><br><a href="'.$page_checkbox.'?id_pdf='.$page.'"> <i class="fa fa-check-square-o"></i> Allergienliste</a></li>
      <li></li>
    </ul>
    ';
}
function liste() {
	//// EDIT_SKRIPT
	$db = "pdf_store";
	$id = "id";

	$ord = "title";
    $language=$_GET['language'];
    if($language=='')
      $language='germany';
    ////////////////////

	$echo .= '<p>&nbsp;</p><table width="100%" cellspacing="0" cellpadding="0" class="p20 autocol" >';

	$old = '';

	$sql = "SELECT * FROM $db WHERE 1 ORDER BY ".$ord."";
	$res = safe_query($sql);

	while ($row = mysqli_fetch_object($res)) {
		$edit = $row->$id;
        /*get title */
        if($language=='germany')
        {
            if($row->title=='')
             $title=$row->title_english . '(Not tranlate to germany)';
            else
             $title=$row->title; 
        }
        else
        {
            if($row->title_english=='')
             $title=$row->title . '(Not tranlate to english)';
            else
             $title=$row->title_english;
        }
    /* end */  
        $echo .= '<tr>
            <td width="60"><p><a href="?page='.$edit.'&language='.$language.'"> <i class="fa fa-pencil-square-o"></i></a></p></td>
			<td width="450"><p><a href="?page='.$edit.'&language='.$language.'"> '.$title.' ('.$row->id.')</a></p></td>
            <td valign="top" width="50"><a href="?edit='.$edit.'&language='.$language.'"><i class="fa fa-cogs"></a></td>
            <td valign="top" width="50"><a href="?add='.$edit.'&language='.$language.'"><i class="fa fa-plus mrg30"></a></td>
            <td valign="top" width="50"><a href="?download='.$edit.'&language='.$language.'"><i class="fa fa-download mrg30"></a></td>
            <td valign="top" width="50"><a href="?del='.$edit.'"><i class="fa fa-trash-o"></a></td>
            <td></td>
		</tr>';
	}

	$echo .= '</table><p>&nbsp;</p>';

	return $echo;
}
include("footer.php");

?>
