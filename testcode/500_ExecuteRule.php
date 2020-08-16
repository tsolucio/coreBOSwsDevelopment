<?php
// To obtain the identifier of the account you can use the Query operation
$context = array(
	'guestcount' => '4',
	'season' => 'Winter',
);
$context = json_encode($context);
$mapid = 'SeasonDish twocolumns';

//sessionId is obtained from loginResult.
$params = "sessionName=$cbSessionID";
$params.= "&operation=cbRule";
$params.= "&conditionid=".urlencode($mapid);
$params.= "&context=".urlencode($context);

//Retrieve must be GET Request.
$response = $httpc->fetch_url("$cbURL?$params");
$dmsg.= debugmsg("Raw response (json)", $response);

//decode the json encode response from the server.
$jsonResponse = json_decode($response, true);
$dmsg.= debugmsg("Webservice response", $jsonResponse);

//operation was successful get the token from the response.
if ($jsonResponse['success']==false) {
	$dmsg.= debugmsg('failed:'.$jsonResponse['error']['message']);
	echo 'rule failed!';
} else {
	echo $jsonResponse['result'];
}
?>