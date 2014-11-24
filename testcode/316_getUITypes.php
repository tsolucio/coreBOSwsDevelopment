<?php
//name of the module for which to retrieve the entity ID
$moduleName = 'Accounts';

//sessionId is obtained from loginResult.
$params = array("sessionName"=>$cbSessionID, "operation"=>'getUItypes',
    "module"=>$moduleName);
//Call must be POST Request.
$response = $httpc->send_post_data($cbURL, $params, true);
$dmsg.= debugmsg("Raw response (json) Update",$response);

//decode the json encode response from the server.
$jsonResponse = json_decode($response, true);
$dmsg.= debugmsg("Webservice response Update",$jsonResponse);

if($jsonResponse['success']==false) {
	$dmsg.= debugmsg('failed:'.$jsonResponse['error']['message']);
	echo 'failed!';
} else {
	$vals = unserialize($jsonResponse['result']);
	var_dump($vals);
}
?>
