<?php
// get merged template
$params = "sessionName=$cbSessionID&operation=getmergedtemplate";
$params.= '&template=15x44118&crmids=["7x2924","7x2824"]&output_format=ODT';
//get merged template must be GET Request.
$response = $httpc->fetch_url("$cbURL?$params");
$dmsg.= debugmsg("Raw response (json) getmergedtemplate", $response);

//decode the json encode response from the server.
$jsonResponse = json_decode($response, true);
$dmsg.= debugmsg("Webservice response getmergedtemplate", $jsonResponse);

if ($jsonResponse['success']==false) {
	$dmsg.= debugmsg('getmergedtemplate failed: '.$jsonResponse['message']);
	echo 'getmergedtemplate failed!';
} else {
	echo "Merged templates in: " . $jsonResponse['result']['file'];
}
?>