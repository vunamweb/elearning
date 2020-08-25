<?php
# # # # # # # # # # # # # # # # # # # # # # # # # # # 
# www.pixel-dusche.de                               #
# björn t. knetter                                  #
# start 12/2003                                     #
#                                                   #
# post@pixel-dusche.de                              #
# frankfurt am main, germany                        #
# # # # # # # # # # # # # # # # # # # # # # # # # # # 

function sprache($textid) {
	global $sprachen_arr;

	return $sprachen_arr[$textid];
} // get_text()
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

?>