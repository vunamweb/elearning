<?php
  //calculator test number
  $sql="select * from user_test_active where id_user=".$_SESSION[id_user]." ORDER BY test DESC";
  $res = safe_query($sql);
  $row = mysqli_fetch_object($res);
  //get list test success
  $sql="select * from user_test where id_user=".$_SESSION[id_user]." and status=1 order by test";
  $res = safe_query($sql);
  $count_test = mysqli_num_rows($res);

  //if is first time
  if($row->id=="")
  {
    $test=1;
    //check faild 3 times
    $sql="SELECT COUNT( id ) AS count FROM  user_test WHERE id_user =".$_SESSION[id_user]." AND test =".$test." AND STATUS =0";
    $res = safe_query($sql);
    $row = mysqli_fetch_object($res);
    if($row->count==3)
     $test='faild 3 times';
  }
  // if active next test
  else if($row->active==1)
  {
    $test=$row->test;
    //check faild 3 times
    $sql="SELECT COUNT( id ) AS count FROM  user_test WHERE id_user =".$_SESSION[id_user]." AND test =".$test." AND STATUS =0";
    $res1 = safe_query($sql);
    $row = mysqli_fetch_object($res1);
    if($row->count==3)
     $test='faild 3 times';
  }
  //if not active next test
  else if($row->active==0)
    $test='no active';

//END calculator test number
  if($test !='faild 3 times' && $test !='no active')
  {
      $folder = $_POST['data-folder'];
      $numberLesson = (int)$_POST['number-lesson'];
      
      $xml = array();
      $title = array();
      $name_file = array();
      $color = array();
      $point = array();
      $checkall = array();
      $questions = array();
      
      for($i=0; $i< $numberLesson; $i++ ) {
        $question = $i + 1;
        
        $xml[$i] = simplexml_load_file($folder . '/' . 'question'.$question.'.xml') or die("Error: Cannot create object");
      
      $title[$i] = $xml[$i]->title;
      $name_file[$i] = $xml[$i]->name;
      $color[$i] = $xml[$i]->color;
      $point[$i] = $xml[$i]->questions['point'];
      $checkall[$i] = $xml[$i]->questions['checkall'];
      $questions[$i] = $xml[$i]->questions->question;
      }
      
      $alpha=array('A','B','C','D','E','F');
  }
?>
<style>
input[type="checkbox"] {
    display:none;
}

input[type="checkbox"] + label {
    color:#000;
    margin-left: 10px;
}

input[type="checkbox"] + label span {
    display:inline-block;
    width:21px;
    height:21px;
    margin:-2px 19px 0px 8px;
    vertical-align:middle;
    border:2px solid #5F5D92;
    cursor:pointer;
}

input[type="checkbox"]:checked + label span {
    background:url('img/check_radio_sheet.png') -20px -1px no-repeat;
}
label { font-weight: 300; }

</style>
<section id="slide_tabs" class="dark_section bg_image">
        <div class="container">
            <div class="row">
                <div class="col-sm-8">
<?php for($i=1; $i<=$test; $i++) { if($i<6) { ?>
                       <div class="download_pdf"><a target="_blank" href="questions/cs_lehrgang_heft_<?php echo $i; ?>_screen_ES.pdf"><i class="fa fa-download"></i> &nbsp; PDF Download <?php echo $i==$test ? 'f&uuml;r diese Pr&uuml;fung' : ' Pr&uuml;fung '.$i; ?></a></div>
<?php } } ?>
                </div>
                <div class="col-sm-4">
                   <?php if($count_test<1) { ?>
                </div>
                <div class="col-md-12">
<?php } else { ?>
	                    <div class="pull-right">
                         <h4 style="color: #000;">Bereits bestandene Pr&uuml;fungen</h4>
                         <?php while ($row = mysqli_fetch_object($res)) { ?>
                           <a data-target="#myModal" data-toggle="modal" href="#" id="<?php echo $row->id ?>" class="test_success">Pr&uuml;fung <?php echo $row->test ?> &nbsp;&nbsp;&nbsp; am <?php echo euro_dat($row->date_test); ?></a>
                         <?php } ?>
                         <!-- Modal -->

                         <br/><br/><label><a href="?profile=<?php echo $_SESSION["id_user"] ?>"><i class="fa fa-user"></i> &nbsp; Ihr Profil</a> </label>
					</div>
				</div>
                <div class="col-sm-12">
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
                        </div>
                       </div>
                   <?php }?>
                   <div class="clearfix"></div>
                   <?php if($test==6){?>
                   Herzlichen Gl&uuml;ckwunsch. Sie haben den Fernlehrgang bestanden.<br><br>Sie erhalten von uns Ihr Zertifikat per E-Mail.
                   <?php } else if($test=='faild 3 times'){?>
                    <h4 style="color: red;">Sie haben die Pr&uuml;fung zum 3. Mal nicht bestanden.<br><br>Damit haben Sie den Fernlehrgang nicht bestanden.</h4>
                   <?php } else if($test=='no active') { ?>
                     <h4 style="color: red;">Die n&auml;chste Pr&uuml;fung muss freigeschaltet werden.<br/><br>Falls 2 Wochen seit der letzten Pr&uuml;fung verstrichen sind, kontaktieren Sie bitte den   <a href="mailto:post@pixel-dusche.de?subject=Bitte Pr&uuml;fung freischalten&body=Pr&uuml;fungs-Nr.: <?php echo $_SESSION[id_user]; ?>">Administrator</a></h4>
                   <?php } else{?>
                   <h4 class="message" style="color: red;"></h4>

                   <div class="col-md-2" style="float: left;">
                     <img src="<?php echo $_POST['left-img'] ?>" />
                   </div>
                   
                   <div class="col-md-8" style="float: left;">
                      <div id="demo" class="carousel slide" data-ride="carousel">
<!-- The slideshow -->
  <div class="carousel-inner">
    <?php for($count = 0; $count< count($xml);$count++) { ?>
      <div class="carousel-item <?php if($count == 0) echo 'active'  ?>">
      <div class="question">
                           <h4 style="color: <?php echo $color[$count] ?>;"><?php echo $title[$count] ?></h4>
                           <?php for($i=0;$i<count($questions[$count]);$i++){?>
                             <div class="content" numberchoose="<?php echo NumberChoose($i,$test) ?>">
                                 <p style="color: <?php echo $color[$count] ?>;"><?php echo $i+1; ?>.<span class="title"><?php echo $questions[$count][$i]->title ?></span>
                                 <br><span class="title2" style="color: #000;"><?php echo NumberChoose($i,$test) ?> richtige Antwort<?php echo NumberChoose($i,$test) > 1 ? 'en' : ''; ?></span></p>
                                 <?php for($j=0;$j<count($questions[$count][$i]->choose);$j++){
                                   if($questions[$count][$i]->choose[$j]['value']=='yes')
                                     $choose='fGtzbXhjuzt';
                                   else
                                     $choose='fGtzbxhjuzt';
                                 ?>
                                   <div class="text">
                                       <span><?php echo $alpha[$j] ?></span>
                                       <input type="checkbox" id="<?php echo $i+1; ?>_<?php echo $j+1; ?>" name="<?php echo $i+1; ?>_<?php echo $j+1; ?>" class="question <?php echo $i; ?>" choose="<?php echo $choose ?>" point="<?php echo $questions[$count][$i]['point'] ?>"/>
                                       <label for="<?php echo $i+1; ?>_<?php echo $j+1; ?>"><span></span><?php echo $questions[$count][$i]->choose[$j] ?></label>
                                   </div>
                                 <?php }?>
                             </div>
                             <input type="hidden" name="resultpoint" class="question <?php echo $i; ?> resultpoint" value="0" />
                           <?php }?>
                       <input type="hidden" name="realpoint" id="realpoint" value="<?php echo $point; ?>" />
                       <input type="hidden" name="number-question" id="number-question" value="<?php echo count($questions);  ?>" />
                       <input type="hidden" name="count" id="count"  value="" />
                       <input type="hidden" name="history" id="history" value="" />
                       <input type="hidden" name="id_user" id="id_user" value="<?php echo $_SESSION[id_user]?>" />
                       <input type="hidden" name="test" id="test" value="<?php echo $test?>" />
                       <input type="hidden" name="checkall" id="checkall" value="<?php echo $checkall?>" />
                       <button class="<?php if($count != count($xml) -1) echo 'hide' ?>" type="submit" style="background:<?php echo $color ?>;">Pr&uuml;fungsergebnis absenden</button>
                        <h4 class="message" style="color: red;"></h4>
                       </div>
    </div>
    <?php } ?>
  </div>
  <!-- Left and right controls -->
  <a class="carousel-control-prev" href="#demo" data-slide="prev">
    <span class="carousel-control-prev-icon"></span>
  </a>
  <a class="carousel-control-next" href="#demo" data-slide="next">
    <span class="carousel-control-next-icon"></span>
  </a>
</div>
                   </div>
                   <div class="col-md-2" style="float: left;">
                     <img src="<?php echo $_POST['right-img'] ?>" />
                   </div>
                   
                   <?php } ?>
               </div> <!-- .col-sm-12 -->
            </div> <!-- .row -->
        </div> <!-- .container -->
    </section><!-- #slide_tabs -->