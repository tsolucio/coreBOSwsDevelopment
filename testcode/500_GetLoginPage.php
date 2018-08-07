<?php
$params = "sessionName=$cbSessionID";
$params.= "&operation=getLoginPage";
$params.= "&template=splitLeft";
$params.= "&language=en_us";
$params.= "&csrf=0";

//GET Request.
$response = $httpc->fetch_url("$cbURL?$params");
$dmsg.= debugmsg("Raw response (json) getLoginPage", $response);

//decode the json encode response from the server.
$jsonResponse = json_decode($response, true);
$dmsg.= debugmsg("Webservice response getLoginPage", $jsonResponse);

if ($jsonResponse['success']==false) {
	$dmsg.= debugmsg('getLoginPage failed: '.$jsonResponse['message']);
	echo 'getLoginPage failed!';
} else {
	echo $jsonResponse['result'];
}
?>