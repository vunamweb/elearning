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


  //echo $test;
  //END calculator test number
  if($test !='faild 3 times' && $test !='no active')
  {
      $xml=simplexml_load_file("questions/question".$test.".xml") or die("Error: Cannot create object");
      $title=$xml->title;
      $color=$xml->color;
      $point=$xml->questions['point'];
      $questions=$xml->questions->question;
      $alpha=array('A','B','C','D','E','F');
  }
  //echo count($questions);
  //echo($xml->questions['point']);
  //print_r($questions[0]);
  //print_r($xml);

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
    margin:-2px 19px 0px 4px;
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
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                   <?php if($count_test>0) {?>
                      <div class="pull-right">
                         <h4 style="color: #000;">List test pass</h4>
                         <?php while ($row = mysqli_fetch_object($res)) { ?>
                           <a data-target="#myModal" data-toggle="modal" href="#" id="<?php echo $row->id ?>" class="test_success">Test<?php echo $row->test ?> &nbsp;&nbsp;&nbsp;<?php echo $row->date_test; ?></a>
                         <?php } ?>
                         <!-- Modal -->
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
                   <?php if($test=='faild 3 times'){?>
                    <h4 style="color: red;">You had faild 3 times for this test , You can not do this test anytime , Please try with another account</h4>
                   <?php } else if($test=='no active') { ?>
                     <h4 style="color: red;">You need to active this test , Please contact admin for more detail</h4>
                   <?php } else{?>
                   <h4 class="message" style="color: red;"></h4>

                   <form method="post" class="register-question">
                       <div class="download_pdf"><a href="index.php?download=<?php echo $test ?>"><i class="fa fa-download"></i> &nbsp; PDF Download für diesen Fernlehrgang</a></div>
                       <br /> <br />
                       <div class="question">
                           <h4 style="color: <?php echo $color ?>;"><?php echo $title ?></h4>
                           <?php for($i=0;$i<count($questions);$i++){?>
                             <div class="content" numberchoose="<?php echo NumberChoose($i,$test) ?>">
                                 <p style="color: <?php echo $color ?>;"><?php echo $i+1; ?>.<span class="title"><?php echo $questions[$i]->title ?> <span class="black" style="color: #000;">(<?php echo NumberChoose($i,$test) ?>)</span></span> </p>
                                 <?php for($j=0;$j<count($questions[$i]->choose);$j++){?>
                                   <div class="text">
                                       <span><?php echo $alpha[$j] ?></span>
                                       <input type="checkbox" id="<?php echo $i+1; ?>_<?php echo $j+1; ?>" name="<?php echo $i+1; ?>_<?php echo $j+1; ?>" class="question <?php echo $i; ?>" choose="<?php echo $questions[$i]->choose[$j]['value'] ?>" point="<?php echo $questions[$i]['point'] ?>"/>
                                       <label for="<?php echo $i+1; ?>_<?php echo $j+1; ?>"><span></span><?php echo $questions[$i]->choose[$j] ?></label>
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
                       <button type="submit">Testergebnis absenden</button>
                       </div>
                   </form>
                   <?php } ?>
               </div> <!-- .col-sm-12 -->
            </div> <!-- .row -->
        </div> <!-- .container -->
    </section><!-- #slide_tabs -->