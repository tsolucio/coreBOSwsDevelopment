<?php
// authenticate Contact
// Validates a contact access to the portal: the contact must have an active portal access with correct access dates
//    and give the correct email and password.

$email = 'mary_smith@company.com';
$password = 'j531iuze';
$params = array("sessionName"=>$cbSessionID, "operation"=>'authenticateContact',
	'email'=>$email,'password'=>$password);
$response = $httpc->send_post_data($cbURL,$params,true);
$dmsg.= debugmsg("Raw response (json) Query",$response);

//decode the json encode response from the server.
$jsonResponse = json_decode($response, true);
$dmsg.= debugmsg("Webservice response authenticateContact",$jsonResponse);

if($jsonResponse['success']==false) {
	$dmsg.= debugmsg('authenticateContact failed: '.$jsonResponse['message']);
	echo 'authenticateContact failed!';
} else {
	if (!$jsonResponse['result']) {
		echo 'Contact with email '.$email.' could <b>NOT</b> be authenticated correctly!';
	} else {
		echo 'Contact with ID '.$jsonResponse['result'].' has been authenticated correctly!';
	}
}
?>