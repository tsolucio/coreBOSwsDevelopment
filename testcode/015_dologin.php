<?php
include 'testcode/010_getchallenge.php';

//create md5 string concatenating user accesskey from my preference page 
//and the challenge token obtained from get challenge result. 
$generatedKey = md5($challengeToken.$cbAccessKey);
//login request must be POST request.
$response = $httpc->send_post_data($cbURL, 
    array('operation'=>'login', 'username'=>$cbUserName, 
        'accessKey'=>$generatedKey), true);
$dmsg.= debugmsg("Raw response (json) doLogin",$response);

//decode the json encode response from the server.
$jsonResponse = json_decode($response,true);
$dmsg.= debugmsg("Webservice response doLogin",$jsonResponse);

//operation was successful get the token from the response.
if($jsonResponse['success']==false) {
	$dmsg.= debugmsg('login failed:'.$jsonResponse['error']['message']);
	echo "Error trying to log in!";
} else {
	//login successful extract sessionId and userId from LoginResult so it can used for further calls.
	$sessionId = $jsonResponse['result']['sessionName']; 
	$userId = $jsonResponse['result']['userId'];
	echo "doLogin sessionId: $sessionId<br>";
	echo "doLogin userId: $userId<br>";
}
?>