<?php
//setrelated request
$ctoId='12x22';  // Contacts
$pdoId='14x52';  // Product
$docId='15x159';  // Document
$srvId='26x151'; // Services

$params = array(
	"sessionName"=>$cbSessionID,
	"operation"=>'SetRelation',
	"relate_this_id"=>$ctoId,
	'with_this_ids'=>json_encode(array($pdoId,$docId,$srvId)),
);
$response = $httpc->send_post_data($cbURL, $params, true);
$dmsg.= debugmsg("Raw response (json) SetRelation",$response);

//decode the json encode response from the server.
$jsonResponse = json_decode($response,true);
$dmsg.= debugmsg("Webservice response SetRelation",$jsonResponse);

if($jsonResponse['success']==false) {
	$dmsg.= debugmsg('SetRelation failed:'.$jsonResponse['error']['message']);
	echo 'SetRelation failed!';
} else {
	// Show response
	var_dump($jsonResponse['result']);
}
?>
