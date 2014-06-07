<?php
// Obtained from contact creation example
$contactId='3x40';

//fill in the details of the contacts.userId is obtained from loginResult.
$contactData  = array('lastname'=>'Valiant Update', 'assigned_user_id'=>$cbUserID,'homephone'=>'987654321','id'=>$contactId);
//encode the object in JSON format to communicate with the server.
$objectJson = json_encode($contactData);
$dmsg.= debugmsg("Update, sending in",$objectJson);

//name of the module for which the entry has to be updated.
$moduleName = 'Contacts';

//sessionId is obtained from loginResult.
$params = array("sessionName"=>$cbSessionID, "operation"=>'update', 
    "element"=>$objectJson, "elementType"=>$moduleName);
//Create must be POST Request.
$response = $httpc->send_post_data($cbURL, $params, true);
$dmsg.= debugmsg("Raw response (json) Update",$response);

//decode the json encode response from the server.
$jsonResponse = json_decode($response, true);
$dmsg.= debugmsg("Webservice response Update",$jsonResponse);

if($jsonResponse['success']==false) {
	$dmsg.= debugmsg('update failed:'.$jsonResponse['error']['message']);
	echo 'update failed!';
} else {
	$savedObject = $jsonResponse['result'];
	$id = $savedObject['id'];
	var_dump($savedObject);
}
?>