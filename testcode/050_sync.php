<?php
//time after which all the changes on the server are needed.
$stime = time();
//Create some data now so it is captured by the sync api response.
//Create Account.
//fill in the details of the Accounts.userId is obtained from loginResult.
$accountData  = array('accountname'=>'coreBOSwsTest', 'assigned_user_id'=>$cbUserID);
//encode the object in JSON format to communicate with the server.
$objectJson = json_encode($accountData);
//name of the module for which the entry has to be created.
$moduleName = 'Accounts';

//sessionId is obtained from loginResult.
$params = array("sessionName"=>$cbSessionID, "operation"=>'create', 
    "element"=>$objectJson, "elementType"=>$moduleName);
//Create must be POST Request.
$response = $httpc->send_post_data($cbURL, $params, true);
//decode the json encode response from the server.
$jsonResponse = json_decode($response, true);

if($jsonResponse['success']==false) {
	$dmsg.= debugmsg('create failed: '.$jsonResponse['error']['message']);
	echo "test create record failed!";
} else {
	$createResult = $jsonResponse['result'];
	
	$params = "operation=sync&modifiedTime=$stime&sessionName=$cbSessionID";
	
	//sync must be GET Request.
	$response = $httpc->fetch_url("$cbURL?$params");
	$dmsg.= debugmsg("Raw response (json) Sync",$response);
	
	//decode the json encode response from the server.
	$jsonResponse = json_decode($response, true);
	$dmsg.= debugmsg("Webservice response Sync",$jsonResponse);
	
	if($jsonResponse['success']==false) {
		$dmsg.= debugmsg('query failed: '.$jsonResponse['message']);
		echo 'query failed!';
	} else {
		//Array of vtigerObjects
		$retrievedObjects = $jsonResponse['result'];
		echo debugmsg("Webservice Sync",$retrievedObjects);
	}
}
?>