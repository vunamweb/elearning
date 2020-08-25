<script>
       function videoEnd() {
         if($('#complete'+currentVideo+'').css('display') == 'none') {
            $('#complete'+currentVideo+'').css('display','block');
         $('#incomplete'+currentVideo+'').hide();
         
         countVideo++;
         
         if(parseInt($('#countVideo').val()) == countVideo)
           $('.button_next_step').show();
           $('.notification').addClass('continue');
           $('.notification').html('Click next button to continue');
         }
       }
</script>
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
      
      $level = $_POST['level'];
      
      $watchVideo = $_POST['watch-video'];
      
      $waitTime = $_POST['wait-time'];
      
      $folder = $_POST['data-folder'];
      
      $numberLesson = (int)$_POST['number-lesson'];
      
      $percentPass = (int) $_POST['pass-percent'];
      
      $videos = $_POST['data-video'];
      $videos = explode(',', $videos);
      
      $pdfs = $_POST['data-pdf'];
      $pdfs = explode(',', $pdfs);
      
      $xml = array();
      $title_ = array();
      $img = array();
      $name_file = array();
      $color = array();
      $point = array();
      $checkall = array();
      $questions = array();
      
      for($i=0; $i< $numberLesson; $i++ ) {
        $question = $i + 1;
        
        $xml[$i] = simplexml_load_file($folder . '/' . 'question'.$question.'.xml') or die("Error: Cannot create object");
      
      $title_[$i] = $xml[$i]->title;
      $img[$i] = $xml[$i]->img;
      $name_file[$i] = $xml[$i]->name;
      $color[$i] = $xml[$i]->color;
      $point[$i] = $xml[$i]->questions['point'];
      $checkall[$i] = $xml[$i]->questions['checkall'];
      $questions[$i] = $xml[$i]->questions->question;
      }
      
      //echo($title[1][0]);
      
      $alpha=array('A','B','C','D','E','F');
      
      if($waitTime != '') {
        $sql="SELECT date_time FROM   fernlehrgang_wait_lesson WHERE id_user =".$_SESSION[id_user]." AND level ='".$level."'";
        $res = safe_query($sql);
        $row = mysqli_fetch_object($res);
        
        if($row->date_time == '') {
            $time = date("h:i:s",$waitTime);
            $sql = 'insert into fernlehrgang_wait_lesson(id_user, level, date_time) 
            values('.$_SESSION[id_user].', "'.$level.'", "'.date("Y-m-d H:i:s").'")';
            safe_query($sql);
        } else {
            $currentTime = date("Y-m-d H:i:s");
            $currentTime = strtotime($currentTime);
            
            $saveTime = $row->date_time;
            $saveTime = strtotime($saveTime);
            
            $spent = $currentTime - $saveTime;
            
            $rest = (int) $waitTime - (int) $spent;
            
            $time = date("h:i:s",$rest);
        }
        
        if($rest > 0) {
          $button = '<button class="button_next_step hide" style="background: #a62116;">Next</button>';
          $title ='<div class="notification">You must wait for '.$time.' to continue</div>';  
        } else {
          $button = '<button class="button_next_step" style="background: #a62116;">Next</button>';
          $title ='<div class="notification"></div>';
        }
        
      } else if($watchVideo != '') {
        $button = '<button class="button_next_step hide" style="background: #a62116;">Next</button>';
        $title ='<div class="notification">You must watch video before answering question</div>';
      } else {
        $button = '<button class="button_next_step" style="background: #a62116;">Next</button>';
        $title ='<div class="notification continue">Click next button to continue</div>';
      }
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
                <div class="col-sm-8 first_step">
<?php for($i=0; $i<count($pdfs); $i++) { if($pdfs[$i] != '') { ?>
                       <div class="download_pdf"><a target="_blank" href="pdf/download/<?php echo $pdfs[$i] ?>"><i class="fa fa-download"></i> &nbsp; PDF Download <?php echo $i + 1 ?> </a></div>
<?php } } ?>

<?php echo $title ?>

<?php for($i=0; $i<count($videos); $i++) { if($videos[$i] != '') { ?>
<div id="status" class="video">
<video count="<?php echo $i + 1 ?>" id="video<?php echo $i + 1 ?>" width="320" height="240" controls>
  <source src="video/<?php echo $videos[$i] ?>" type="video/mp4">
  <source src="movie.ogg" type="video/ogg">
Your browser does not support the video tag.
</video>
<span id="complete<?php echo $i + 1 ?>" class="status complete">COMPLETE</span>
<span id="incomplete<?php echo $i + 1 ?>" class="status incomplete">INCOMPLETE</span>
</div>
<script>
 var video = document.getElementById("video<?php echo $i + 1 ?>");
 video.addEventListener("ended", videoEnd)
</script>
<?php } } ?>

<?php echo $button ?>
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
                   <div class="col-md-12 next_step" style="float: left;">
                      <form method="post" class="register-question">
                      <div id="demo" class="carousel slide" data-ride="carousel" data-interval="false">
<!-- The slideshow -->
  <div class="carousel-inner">
    <?php for($count = 0; $count < count($xml); $count++) { ?>
      <div class="carousel-item <?php if($count == 0) echo 'active'  ?>">
      <h4 class="message" style="color: red;"></h4>
      <div class="question">
                           <h4 style="color: <?php echo $color[$count] ?>;"><?php echo $title_[$count][0] ?></h4>
                           <?php if($img[$count] != '') { ?>
                             <img width="200" src="./img/<?php echo $img[$count]  ?>" />
                           <?php } ?>
                           <?php for($i = 0; $i < count($questions[$count]); $i++){?>
                             <div class="content<?php echo $count + 1 ?>">
                                 <p style="color: <?php echo $color[$count] ?>;"><span class="title"><?php echo $questions[$count][$i]->title ?></span>
                                 <br><span class="title2" style="color: #000;"><?php echo NumberChoose($level, $count + 1) ?> richtige Antwort<?php echo NumberChoose($level, $i + 1) > 1 ? 'en' : ''; ?></span></p>
                                 <?php for($j=0;$j<count($questions[$count][$i]->choose);$j++){?>
                                   <div class="text">
                                       <span><?php echo $alpha[$j] ?></span>
                                       <input type="checkbox" id="<?php echo $level . '_' . ($count+1); ?>_<?php echo $j+1; ?>" name="<?php echo $level . '_' . ($count+1); ?>_<?php echo $j+1; ?>" class="question"/>
                                       <label for="<?php echo $level . '_' . ($count+1); ?>_<?php echo $j+1; ?>"><span class="active <?php if($questions[$count][$i]->choose[$j]['value'] == 'yes') echo 'true' ?>"></span><?php echo $questions[$count][$i]->choose[$j] ?></label>
                                   </div>
                                 <?php }?>
                             </div>
                           <input type="hidden" id="question<?php echo $count + 1 ?>" value="<?php echo NumberChoose($level, $count + 1) ?>" />
                           <?php }?>
                       <button class="<?php if($count != count($xml) -1) echo 'hide' ?>" type="submit" style="background:<?php echo $color ?>;">Pr&uuml;fungsergebnis absenden</button>
                       <!-- Left and right controls -->
  <a class="carousel-control-prev carousel-control" question="<?php echo $count + 1 ?>">
    <span class="carousel-control-prev-icon"></span>
  </a>
  <a class="carousel-control-next carousel-control" question="<?php echo $count + 1 ?>">
    <span class="carousel-control-next-icon"></span>
  </a>
                       </div>
                       <h4 class="message" style="color: red;"></h4>
    </div>
    <?php } ?>
  </div>
  <!-- Left and right controls -->
  <a id="previous-page" class="carousel-control-prev hide" href="#demo" data-slide="prev">
    <span class="carousel-control-prev-icon"></span>
  </a>
  <a id="next-page" class="carousel-control-next hide" href="#demo" data-slide="next">
    <span class="carousel-control-next-icon"></span>
  </a>
</div>
<input type="hidden" id="countVideo" value="<?php echo count($videos) - 1 ?>" />
<input type="hidden" id="numberLesson" name="numberLesson" value="<?php echo $numberLesson ?>" />
<input type="hidden" id="level" name="level" value="<?php echo $level ?>" />
<input type="hidden" id="percentPass" name="percentPass" value="<?php echo $percentPass ?>" />
<input type="hidden" id="type" name="type" value="result" />
<input type="hidden" name="history" id="history" value="">
</form>
                   </div>
                   <?php } ?>
               </div> <!-- .col-sm-12 -->
            </div> <!-- .row -->
        </div> <!-- .container -->
    </section><!-- #slide_tabs -->
    