<?php
//fill in the details of the contacts.userId is obtained from loginResult.
$contactData  = array('comments'=>'Valiantwstut2', 'from_portal'=>0,'parent_id'=>'4x22');
//encode the object in JSON format to communicate with the server.
$objectJson = json_encode($contactData);
$dmsg.= debugmsg("Create, sending in",$objectJson);

//name of the module for which the entry has to be created.
$moduleName = 'ModComments';

//sessionId is obtained from loginResult.
$params = array("sessionName"=>$cbSessionID, "operation"=>'addTicketFaqComment', 
    "id"=>'10x64', "values"=>$objectJson);
//Create must be POST Request.
$response = $httpc->send_post_data($cbURL, $params, true);
$dmsg.= debugmsg("Raw response (json) Create",$response);

//decode the json encode response from the server.
$jsonResponse = json_decode($response,true);
$dmsg.= debugmsg("Webservice response Create",$jsonResponse);

if($jsonResponse['success']==false) {
	$dmsg.= debugmsg('create failed:'.$jsonResponse['error']['message']);
	echo 'create failed!';
} else {
	$savedObject = $jsonResponse['result'];
	$id = $savedObject['id'];
	var_dump($savedObject);
}
?>