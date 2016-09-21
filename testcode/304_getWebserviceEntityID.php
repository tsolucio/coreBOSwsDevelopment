<?php
//name of the module for which to retrieve the entity ID
$moduleName = 'Contacts';

//sessionId is obtained from loginResult.
$params = array("sessionName"=>$cbSessionID, "operation"=>'vtyiicpng_getWSEntityId',
    "entityName"=>$moduleName);
//Create must be POST Request.
$response = $httpc->send_post_data($cbURL, $params, true);
$dmsg.= debugmsg("Raw response (json) Update",$response);

//decode the json encode response from the server.
$jsonResponse = json_decode($response, true);
$dmsg.= debugmsg("Webservice response Update",$jsonResponse);

if($jsonResponse['success']==false) {
	$dmsg.= debugmsg('failed:'.$jsonResponse['error']['message']);
	echo 'failed!';
} else {
	$savedObject = $jsonResponse['result'];
	print_r($savedObject);
}
?>
