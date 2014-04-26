<?php
// To obtain the identifier of the account you can use the Query operation
$accountId = '3x40';

//sessionId is obtained from loginResult.
$params = "sessionName=$cbSessionID&operation=retrieve&id=$accountId";
//Retrieve must be GET Request.
$response = $httpc->fetch_url("$cbURL?$params");
$dmsg.= debugmsg("Raw response (json) Retrieve",$response);

//decode the json encode response from the server.
$jsonResponse = json_decode($response, true);
$dmsg.= debugmsg("Webservice response Retrieve",$jsonResponse);

//operation was successful get the token from the response.
if($jsonResponse['success']==false) {
	$dmsg.= debugmsg('retrieve failed:'.$jsonResponse['error']['message']);
	echo 'retrieve failed!';
} else {
	$retrievedObject = $jsonResponse['result'];
	var_dump($retrievedObject);
}
?>