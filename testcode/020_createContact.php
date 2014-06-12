<?php
//fill in the details of the contacts
$contactData  = array('lastname'=>'Valiant', 'assigned_user_id'=>$cbUserID,'homephone'=>'123456789');
//encode the object in JSON format to communicate with the server.
$objectJson = json_encode($contactData);
$dmsg.= debugmsg("Create Contact, sending in",$objectJson);

//name of the module for which the entry has to be created.
$moduleName = 'Contacts';

//sessionId is obtained from loginResult.
$params = array("sessionName"=>$cbSessionID, "operation"=>'create', 
    "element"=>$objectJson, "elementType"=>$moduleName);
//Create must be POST Request.
$response =$httpc->send_post_data($cbURL, $params, true);
$dmsg.= debugmsg("Raw response (json) Create",$response);

//decode the json encode response from the server.
$jsonResponse = json_decode($response,true);
$dmsg.= debugmsg("Webservice response Create",$jsonResponse);

if($jsonResponse['success']==false) {
	$dmsg.= debugmsg('create failed:'.$jsonResponse['error']['message']);
	echo "Create failed!";
} else {
	$savedObject = $jsonResponse['result'];
	$id = $savedObject['id'];
	var_dump($savedObject);
}
?>