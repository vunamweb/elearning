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

// get page1-text-header
$db = "page1_text_top";
$sql = "SELECT * FROM $db";
$res = safe_query($sql);
$row = mysqli_fetch_object($res);
$page1_text_top=$row->value;
// get page1-text-footer
$db = "page1_text_bottom";
$sql = "SELECT * FROM $db";
$res = safe_query($sql);
$row = mysqli_fetch_object($res);
$page1_text_bottom=$row->value;
// get page2-text
$db = "page2_text";
$sql = "SELECT * FROM $db";
$res = safe_query($sql);
$row = mysqli_fetch_object($res);
$page2_text=$row->value;
// title
$title='pdf_'.date('Y-m-d H:i:s');
//date time
$date_time=date('Y-m-d H:i:s');
// insert pdf
$db='pdf_store';
$sql = "insert into $db(title,date_time,page1_text_header,page1_text_footer,page2_text)
values('".$title."','".$date_time."','".$page1_text_top."' ,'".$page1_text_bottom."','".$page2_text."')";
$res = safe_query($sql);
$id= mysqli_insert_id($mylink);
// insert pdf_page1_headline
$db='page1_headline';
$sql = "SELECT * FROM $db WHERE 1";
$res = safe_query($sql);
while ($row = mysqli_fetch_object($res)) {
  $title=$row->title;
  $value=$row->text;
  $sql="insert into pdf_page1_headline(id_pdf,title,value)values(".$id.",'".$title."','".$value."')";
  safe_query($sql);
}
// insert pdf_page1_logo
$db='page1_logo';
$sql = "SELECT * FROM $db WHERE status=1";
$res = safe_query($sql);
while ($row = mysqli_fetch_object($res)) {
  $image=$row->image;
  $sql="insert into pdf_page1_logo(id_pdf,image)values(".$id.",'".$image."')";
  safe_query($sql);
}
// insert pdf page2 header, item
$db='page2_header';
$sql = "SELECT * FROM $db";
$res = safe_query($sql);
while ($row = mysqli_fetch_object($res)) {
  $value=$row->name;
  $id_header=$row->id;
  $sql="insert into pdf_page2_header(id_pdf,id_header,value)values(".$id.",".$id_header.",'".$value."')";
  safe_query($sql);
  //insert item
  $sql = "SELECT * FROM page2_header_item where id_page2_header=".$id_header."";
  $res1 = safe_query($sql);
  while ($row1 = mysqli_fetch_object($res1)) {
     $title=$row1->name;
     $value=$row1->value;
     $sql="insert into pdf_page2_header_item(id_pdf,id_header,title,value)values(".$id.",".$id_header.",'".$title."','".$value."')";
     safe_query($sql);
  }
}
// insert pdf page2 footer, item
$db='page2_footer';
$sql = "SELECT * FROM $db";
$res = safe_query($sql);
while ($row = mysqli_fetch_object($res)) {
  $value=$row->name;
  $id_footer=$row->id;
  $sql="insert into pdf_page2_footer(id_pdf,id_footer,value)values(".$id.",".$id_footer.",'".$value."')";
  safe_query($sql);
  //insert item
  $sql = "SELECT * FROM page2_footer_item where id_page2_footer=".$id_footer."";
  $res1 = safe_query($sql);
  while ($row1 = mysqli_fetch_object($res1)) {
     $title=$row1->name;
     $value=$row1->value;
     $sql="insert into pdf_page2_footer_item(id_pdf,id_footer,title,value)values(".$id.",".$id_footer.",'".$title."','".$value."')";
     safe_query($sql);
  }
}
// insert pdf checkbox
$db='checkbox';
$sql = "SELECT * FROM $db";
$res = safe_query($sql);
while ($row = mysqli_fetch_object($res)) {
  $title=$row->title;
  $id_format=$row->format_page;
  $choose=$row->choose;
  $sql="insert into pdf_checkbox(id_pdf,id_format,title,choose)values(".$id.",".$id_format.",'".$title."','".$choose."')";
  safe_query($sql);
}


    






///////////////////////////////////////////////////////////////////////////////////////


//// EDIT_SKRIPT
$um_wen_gehts 	= "Coach / Trainer / Team";
$titel			= "Create pdf success , you can go to manage pdf to see the file";
///////////////////////////////////////////////////////////////////////////////////////
echo '<div id=vorschau>
	<h2>'.$titel.'</h2> ';
include("footer.php");

?>
