<?php
// Login Contact
// Validates a contact access to the portal: the contact must have an active portal access with correct access dates
//    and give the correct email and password.
// This method returns a valid logged in session with the internal "portal" user

$email = 'julieta@yahoo.com';
$password = '5ub1ipv3';

//getchallenge
$response = $httpc->fetch_url("$cbURL?operation=getchallenge&username=$email");
$dmsg = debugmsg("Raw response (json) GetChallenge",$response);

//decode the json encode response from the server.
$jsonResponse = json_decode($response,true);
$generatedKey = $jsonResponse['result']['token'].$password;

$params = "operation=loginPortal&username=$email&password=$generatedKey";
$response = $httpc->fetch_url("$cbURL?$params");
$dmsg.= debugmsg("Raw response (json) Query",$response);

//decode the json encode response from the server.
$jsonResponse = json_decode($response, true);
$dmsg.= debugmsg("Webservice response loginPortal",$jsonResponse);

if($jsonResponse['success']==false) {
	$dmsg.= debugmsg('loginPortal failed: '.$jsonResponse['error']['message']);
	echo 'loginPortal failed!';
} else {
	if (!$jsonResponse['result']) {
		echo 'Contact with email '.$email.' could <b>NOT</b> be logged in correctly!';
	} else {
		echo 'Contact has been logged in correctly!';
		var_dump($jsonResponse['result']);
	}
}
?>
