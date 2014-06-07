<?php
//dologin using library
$login = $cbconn->doLogin($cbUserName, $cbAccessKey);

//check for whether the requested operation was successful or not.
if($login) {
	//operation was successful get the response.
	echo "Login sessionId: <b>".$cbconn->_sessionid."</b><br>";
	echo "Login userId: <b>".$cbconn->_userid."</b><br>";
} else {
	echo "Login failed<br>";
	$err = $cbconn->lastError();
	echo $err['code'].': '.$err['message'];
}
?>