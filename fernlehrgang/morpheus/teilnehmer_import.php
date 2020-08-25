<?php
session_start();
# # # # # # # # # # # # # # # # # # # # # # # # # # # 
# www.pixel-dusche.de                               #
# björn t. knetter                                  #
# start 12/2003                                     #
#                                                   #
# post@pixel-dusche.de                              #
# frankfurt am main, germany                        #
# # # # # # # # # # # # # # # # # # # # # # # # # # # 

include("cms_include.inc");

# # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # 
# # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # # 

echo '<div id=content_big class=text>';

$import	= $_POST["import"];

if ($import) {
	$arr = explode("\n", $import);
	
	foreach ($arr as $val) {
		if ($val) {
			$data = explode("\t", $val);
			
			$ct = 0;
			$proj_arr = array();
			
			foreach($data as $user) {
				if ($ct < 1) {
					$name = explode(",", $user); 
					$set = "nname='".trim($name[0])."', vname='".trim($name[1])."', ";
					$nname=trim($name[0]);
					$vname=trim($name[1]);
				}
				elseif ($ct == 1) { $set .= "usr='".trim($user)."', "; $usernm = trim($user); }
				elseif ($ct == 2) { 
					if ($user[8])	echo $userid = substr(trim($user), 2, 4); 
					else 	echo $userid = substr(trim($user), 2, 3); 
					$set .= "pwd='".trim($user)."', id=$userid";	
				}
				elseif ($ct == 3) {  }
				elseif ($ct > 3) $proj_arr[] = trim($user);
				$ct++;
			}

			# $query = "SELECT * FROM teilnehmer where vname='$vname' AND nname='$nname'";
			$query = "SELECT * FROM teilnehmer where usr='$usernm'";
			$result = safe_query($query);
			if (mysqli_num_rows($result) < 1) {
					$query = "insert teilnehmer set $set";
					$result = safe_query($query);
					echo "$vname $nname wurde importiert<br>";
			}
			else	echo "$vname $nname ist bereits <strong>vorhanden</strong><br>";
			

			foreach($proj_arr as $pid) {
				if ($pid > 0) {				
					$query = "SELECT * FROM projekt_user where user=$userid AND projekt=$pid";
					$result = safe_query($query);
					if (mysqli_num_rows($result) < 1) {
						$query = "insert projekt_user set user=$userid, projekt=$pid";
						$result = safe_query($query);
						echo "$userid wurde projekt $pid zugeordnet<br>";
					}
					else echo "<font color=#ff0000>$user wurde dem projekt $val bereits zugeordnet</font><br>";
				}
				
			}
				#print_r($proj_arr);
				#echo $val ."<br>";
		}
	}
	/*
			foreach ($kurse as $val) {
				$query = "SELECT * FROM projekt_user where user=$user and projekt=$val";
				$result = safe_query($query);
				if (mysqli_num_rows($result) < 1) {
#					$query = "insert projekt_user set user=$user, projekt=$val";
#					$result = safe_query($query);
					echo "$user wurde projekt $val zugeordnet<br>";
				}
				else echo "<font color=#ff0000>$user wurde dem projekt $val bereits zugeordnet</font><br>";
			}			
		}	
		echo "<p>&nbsp;</p>\n";
	}
	echo "<p><b>Zuordnung abgeschlossen</b></p>
		<p><a href=\"teilnehmer_proj.php\">" .ilink() ." weiter</a></p>";
	*/
}

else	{
	echo '<form action="" method="post"><textarea cols="80" rows="30" name="import"></textarea>
	<p><input type="submit" name="senden" value="senden"></p>';
}

?>

<?
include("footer.php");
?>