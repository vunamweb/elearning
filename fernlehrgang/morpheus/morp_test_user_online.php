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
$um_wen_gehts 	= "History Test online User";
$titel			= "History Test online User";
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

	'. (true ? '<p><a href="morp_test_online.php">&laquo; zur&uuml;ck</a></p>' : '').
    '<form action="" onsubmit="" name="verwaltung" method="post">'
     ;
if(isset($add))
 echo '<p style="color:green">Duplicat success</p>' ;
else if(isset($del))
 echo '<p style="color:green">Delete success</p>' ;

   //echo filter_language();
   echo liste();
   //echo '<p><a href="?neu=1&language='.$language.'">&raquo; NEU</a></p>';
   echo '<!-- Modal -->
                        <div id="myModal" class="modal fade" role="dialog">
                          <div class="modal-dialog">

                            <!-- Modal content-->
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title"></h4>
                              </div>
                              <div class="modal-body">

                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                              </div>
                            </div>

                          </div>
                        </div>';

echo '
</form>
';

function liste() {
	//// EDIT_SKRIPT
	$db = "user_test";
	$id = "id";

	$ord = "uname";
    $language=$_GET['language'];
    if($language=='')
      $language='germany';
    ////////////////////

	$echo .= '<p>&nbsp;</p><table width="100%" cellspacing="0" cellpadding="0" class="p20 autocol" >
               <tr>
                <td>Test</td>
                <td>Date</td>
                <td>Status</td>
               </tr>
             ';

	$old = '';

	//get list test success
  $sql="select * from user_test where id_user=".$_GET[id]." order by test";
  $res = safe_query($sql);
  $count_test = mysqli_num_rows($res);

	while ($row = mysqli_fetch_object($res)) {
		$status = ($row->status==1)?'Pass' : 'Not pass';

        $echo .= '<tr>
         <td><a data-target="#myModal" data-toggle="modal" href="#" id='.$row->id.' class="test_success_admin" date='.$row->date_test.'> '.$row->test.'</a></td>
         <td>'.$row->date_test.'</td>
         <td>'.$status.'</td>
        </tr>';
	}

	$echo .= '</table><p>&nbsp;</p>';

	return $echo;
}
include("footer.php");

?>
