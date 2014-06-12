<?php
$contactData  = array('subject'=>'wstest', 'assigned_user_id'=>$cbUserID,
					'date_start'=>'2014-06-10','time_start'=>'10:10',
					'due_date'=>'2014-06-10','time_end'=>'10:20',
					'recurringtype'=>'--None--','duration_hours'=>1,
					'eventstatus'=>'Held','activitytype'=>'Call',
					'cf_605'=>'wstxt','cf_606'=>22.3,
					'contact_id'=>'12x22;12x23',
					);
//encode the object in JSON format to communicate with the server.
$objectJson = json_encode($contactData);
$dmsg.= debugmsg("Create Events, sending in",$objectJson);

//name of the module for which the entry has to be created.
$moduleName = 'Events';

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