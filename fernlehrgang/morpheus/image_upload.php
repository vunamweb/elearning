<?php
session_start();
# # # # # # # # # # # # # # # # # # # # # # # # # # # 
# www.pixel-dusche.de                               #
# bj&ouml;rn t. knetter                                  #
# start 12/2003                                     #
#                                                   #
# post@pixel-dusche.de                              #
# frankfurt am main, germany                        #
# # # # # # # # # # # # # # # # # # # # # # # # # # # 

include("cms_include.inc");


$gid 	 = $_REQUEST["gid"];

echo "<div id=content_big class=text>\n<p><b>Bild Upload</b></p>";
echo '<p>&nbsp;</p><p><a href="javascript:history.back();">' .backlink() .' zur&uuml;ck</a></p><p>&nbsp;</p>';
echo "<form action=\"image_insert.php?log=$log\" method=post enctype=\"multipart/form-data\">\n\n";
?>

<p><input name="image[]" type="file" style="width:500px"></p>
<p><input name="image[]" type="file" style="width:500px"></p>
<p><input name="image[]" type="file" style="width:500px"></p>
<p><input name="image[]" type="file" style="width:500px"></p>
<p><input name="image[]" type="file" style="width:500px"></p>
<p><input name="image[]" type="file" style="width:500px"></p>
<p><input name="image[]" type="file" style="width:500px"></p>
&nbsp;
<?
echo "<p><input name=gid type=hidden value=$gid></p>\n";
?>

<p><input type=submit style="background-color:#7B1B1B;color:#FFFFFF;font-weight:bold;width:100px;" value="upload starten" style="width:100px;background-color:#BBBBBB"></p>
</form>

<?
echo '<p>&nbsp;</p><p><a href="javascript:history.back();">' .backlink() .' zur&uuml;ck</a></p>';
?>

<?
include("footer.php");
?>
