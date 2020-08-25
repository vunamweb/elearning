<?php
  //calculator test number
  $sql="select * from user_test_active where id_user=".$_SESSION[id_user]." ORDER BY test DESC";
  $res = safe_query($sql);
  $row = mysqli_fetch_object($res);
  //get list test success
  $sql="select * from user_test where id_user=".$_SESSION[id_user]." and status=1 order by date_test";
  $res = safe_query($sql);
  $count_test = mysqli_num_rows($res);

  //if is first time
  /*
  if($row->id=="")
  {
    $test=1;
    //check faild 3 times
    $sql="SELECT COUNT( id ) AS count FROM  user_test WHERE id_user =".$_SESSION[id_user]."";
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
    $test='no active';*/


  //echo $test;
  //END calculator test number
  if($test !='faild 3 times' && $test !='no active')
  {
      $xml=simplexml_load_file("questions/test.xml") or die("Error: Cannot create object");
      
      $courses=$xml->course;
      //$a = $courses[0]->lesson;
      //print_r ($a[1]); die();
      
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
    border:2px solid <?php echo $color ?>;
    cursor:pointer;
}

input[type="checkbox"]:checked + label span {
    background:url('img/check_radio_sheet.png') -20px -1px no-repeat;
}
label { font-weight: 300; }

</style>
<section id="slide_tabs" class="dark_section bg_image">
        <div id="myModal" class="modal fade" role="dialog">
                          <div class="modal-dialog">

                            <!-- Modal content-->
                            <div class="modal-content">
                              <div class="modal-header">
                                <h4 class="modal-title"></h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                              </div>
                              <div class="modal-body">

                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                              </div>
                            </div>

                          </div>
                        </div>
        <div class="container">
            <div class="row">
            <div class="col-md-8">
            <div class="course" id="accordion">
                           <h4 class="message"></h4>
                           <form id="form-course" action="" method="POST">
                               <?php for($i=0; $i<count($courses); $i++){?>
                                 <div class="content">
                                     <a class="btnOpen" data-toggle="collapse" href="#lesson<?php echo $i ?>"><i class="fal fa-angle-down fa-lg"></i></a>
                                     <a style="color: <?php echo $courses[$i]['color'] ?>;"><span class="title"><?php echo $courses[$i]['name'] ?></span></a>
                                     <div numberLessonBefore="<?php if($i != 0) echo count($courses[$i-1]->lesson) ?>" numberLesson="<?php echo count($courses[$i]->lesson) ?>" class="lesson collapse <?php if($i == 0) echo 'show' ?>" id="lesson<?php echo $i ?>" data-parent="#accordion">
                                       <?php for($j = 0; $j < count($courses[$i]->lesson); $j++) { ?>
                                       <?php $item = $courses[$i]->lesson[$j];  ?>
                                         <?php 
                                             $videos = $item->videos->video;
                                             $string_videos = '';
                                             foreach($videos as $video)
                                               $string_videos .= $video . ',';
                                               
                                             $pdfs = $item->pdfs->pdf;
                                             $string_pdfs = '';
                                             foreach($pdfs as $pdf)
                                               $string_pdfs .= $pdf . ',';
                                          ?>
                                          <a class="title-lesson" level="<?php echo $i + 1;  ?>_<?php echo $j + 1;  ?>" watch-video="<?php echo $item['watch-video'] ?>" wait-time="<?php echo $item['wait-time'] ?>" number-lesson="<?php echo $item['number-lesson'] ?>" data-folder="<?php echo $item['data-folder'] ?>" data-video="<?php echo $string_videos ?>" data-pdf="<?php echo $string_pdfs ?>" onepage="<?php echo $item['onepage'] ?>" pass-percent="<?php echo $item['pass-percent'] ?>"><span><?php echo $item['name'] ?></span></a>
                                       <?php } ?>
                                     </div>
                                 </div>
                               <?php }?>
                           <input type="hidden" name="numberCourse" id="numberCourse" value="<?php echo count($courses)  ?>" />
                           <input type="hidden" name="level" id="level" value="" />
                           <input type="hidden" name="watch-video" id="watch-video" value="" />
                           <input type="hidden" name="wait-time" id="wait-time" value="" />
                           <input type="hidden" name="number-lesson" id="number-lesson" value="" />
                           <input type="hidden" name="data-folder" id="data-folder" value="" />
                           <input type="hidden" name="data-video" id="data-video" value="" />
                           <input type="hidden" name="data-pdf" id="data-pdf" value="" />
                           <input type="hidden" name="onepage" id="onepage" value="" />
                           <input type="hidden" name="pass-percent" id="pass-percent" value="" />
                           </form>
                      </div>
            </div>
            <div class="col-md-4">
              <div class="pull-right">
                         <h4 style="color: #000;">Bereits bestandene Pr&uuml;fungen</h4>
                         <?php while ($row = mysqli_fetch_object($res)) { ?>
                           <a data-target="#myModal" data-toggle="modal" href="#" id="<?php echo $row->id ?>" class="test_success">Pr&uuml;fung <?php echo $row->level ?> &nbsp;&nbsp;&nbsp; am <?php echo euro_dat($row->date_test); ?></a>
                         <?php } ?>
               </div>
            </div>

               </div> <!-- .col-sm-12 -->
            </div> <!-- .row -->
        </div> <!-- .container -->
    </section><!-- #slide_tabs -->