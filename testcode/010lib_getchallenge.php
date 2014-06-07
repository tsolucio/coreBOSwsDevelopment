<?php
//getchallenge using library
$chlg = $cbconn->__doChallenge($cbUserName);

//check for whether the requested operation was successful or not.
if($chlg) {
	//operation was successful get the token from the response.
	echo "Challenge successful.<br>";
	echo "Challenge token: <b>".$cbconn->_servicetoken."</b><br>";
} else {
	echo "Challenge failed<br>";
	$err = $cbconn->lastError();
	echo $err['code'].': '.$err['message'];
}
?>
