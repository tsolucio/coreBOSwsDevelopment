<?php
//getchallenge must be a GET request.
$response = $httpc->fetch_url("$cbURL?operation=getchallenge&username=$cbUserName");
$dmsg = debugmsg("Raw response (json) GetChallenge",$response);

//decode the json encode response from the server.
$jsonResponse = json_decode($response,true);
$dmsg.= debugmsg("Webservice response GetChallenge",$jsonResponse);

//check for whether the requested operation was successful or not.
if($jsonResponse['success']==false) {
	$dmsg.= debugmsg('getchallenge failed:'.$jsonResponse['error']['message']);
	echo "Challenge failed.";
} else {
	//operation was successful get the token from the response.
	$challengeToken = $jsonResponse['result']['token'];
	echo "Challenge token: $challengeToken<br>";
}
?>
