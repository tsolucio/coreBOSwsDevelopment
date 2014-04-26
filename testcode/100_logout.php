<?php
//SessionId is the session which is to be terminated.
$params = "operation=logout&sessionName=$cbSessionID";

//logout must be GET Request.
$response = $httpc->fetch_url("$cbURL?$params");
$dmsg.= debugmsg("Raw response (json) Logout",$response);

//decode the json encode response from the server.
$jsonResponse = json_decode($response, true);
$dmsg.= debugmsg("Webservice response Logout",$jsonResponse);

if($jsonResponse['success']==false) {
	$dmsg.= debugmsg('logout failed: '.$jsonResponse['message']);
	echo 'logout failed!';
} else {
	echo debugmsg("Webservice Logout",$jsonResponse);
}
?>