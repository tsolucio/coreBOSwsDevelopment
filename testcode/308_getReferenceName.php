<?php
// list of IDS for which to retrieve the reference
$ids = array('12x22','12x23','10x32','10x33');
$pids = serialize($ids); // to convert into a flat object string

//sessionId is obtained from loginResult.
$params = array("sessionName"=>$cbSessionID, "operation"=>'getReferenceValue',
    "id"=>$pids);
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
	$refs = unserialize($jsonResponse['result']);
	var_dump($refs);
}
?>
