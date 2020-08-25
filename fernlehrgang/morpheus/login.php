<?php
# # # # # # # # # # # # # # # # # # # # # # # # # # #
# www.pixel-dusche.de                               #
# björn t. knetter                                  #
# start 12/2003                                     #
#                                                   #
# post@pixel-dusche.de                              #
# frankfurt am main, germany                        #
# # # # # # # # # # # # # # # # # # # # # # # # # # #

#$admin  = 1;
#$uid    = 1;
#$counter = $_SESSION['counter'];

# print_r($_SESSION);

$log = $_SESSION['log'];
$arr = array("admin", "uid");

function logform($warn='') {
		echo "<div id=logform class=text><p><b>$warn</b></p>
			<p>Sie betreten einen gesch&uuml;tzten Kundenaccount.<br>
			Bitte melden Sie sich an.</p>
			<form method=post name=logform>
			<p><input type=text name=un> benutzername</p>
			<p><input type=password name=pw> passwort</p>
			<p><input type=submit style=\"background-color:#7B1B1B;color:#FFFFFF;font-weight:bold;width:100px;\" name=anmelden value=anmelden style=\"width:70;background-color:#BBBBBB;\"></p></form></div>

<script>
<!--
	document.logform.un.focus();
-->
</script>
";
}

function endhtml() {
	echo "</body></html>";
}

if ($log == "pixel-dusche" && !$relog) {
	global $user_name;

	foreach($arr as $val) {
		global $$val;
		$$val = $_SESSION[$val];
	}

	#echo '<p style="color:#FFFFFF">log: ';
	#echo $admin .", " .$user_name = $_SESSION['user_name'];
	#echo '</p>';
}
elseif ($_POST["anmelden"] || $relog) {
	$un  = $_POST["un"];
	$pw  = $_POST["pw"];

	if ($un || $pw) {
		$pw = md5($pw);
		$query = "SELECT * FROM user WHERE uname='" .$un ."' AND admin=1";
		$result = safe_query($query);
		$row = mysqli_fetch_object($result);
		if ($row->pw == $pw && $row->uname == $un) {
			$_SESSION['user_name'] 	= $row->uname;
			$_SESSION['log'] 		= "pixel-dusche";
			$_SESSION['sun']  		= $un;
			$_SESSION['sid']  		= $row->uid;
			$_SESSION['spw']  		= $pw;
			$_SESSION['admin'] 		= $row->admin;
			#$uid    = 1;

			foreach($arr as $val) {
				$_SESSION[$val] = $row->$val;
				global $$val;
				$$val = $row->$val;
			}
		}
		else {
			logform("<p><font color=#ff0000>Ihre UserID und/oder Passwort waren falsch</font></p>");
			endhtml();
			die();
		}
	}
	else {
		logform();
		endhtml();
		die();
	}
}
else {
	logform();
	endhtml();
	die();
}

?>