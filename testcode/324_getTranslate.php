<?php
$translate = array(
		'Accounts'=>'Accounts',
		'LBL_LIST_ACCOUNT_NAME'=>'LBL_LIST_ACCOUNT_NAME',
		'Portal User'=>'Client Portal User',
		);
//sessionId is obtained from loginResult.
$params = array("sessionName"=>$cbSessionID, "operation"=>'gettranslation',
		 "totranslate"=> json_encode($translate),
		'language'=>'es_es',
		'module'=>'Contacts'
		);

//Call must be POST Request.
$response = $httpc->send_post_data($cbURL, $params, true);
$dmsg.= debugmsg("Raw response (json) GetTranslation",$response);

//decode the json encode response from the server.
$jsonResponse = json_decode($response,true);
$dmsg.= debugmsg("Webservice response GetTranslation",$jsonResponse);

if($jsonResponse['success']==false) {
	$dmsg.= debugmsg('GetTranslation failed: '.$jsonResponse['error']['message']);
	echo 'GetTranslation failed!';
} else {
	var_dump($jsonResponse['result']);
}
?>