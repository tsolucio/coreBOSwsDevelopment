<?php
//dologout using library
$logout = $cbconn->doLogout();

//check for whether the requested operation was successful or not.
if($logout) {
	//operation was successful get the response.
	echo "Logout successful";
} else {
	echo "Logout failed<br>";
	$err = $cbconn->lastError();
	echo $err['code'].': '.$err['message'];
}
?>
