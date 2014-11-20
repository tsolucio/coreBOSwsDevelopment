<?php
//sessionId is obtained from loginResult.
$grefParams = '&term='.urlencode('es').
	'&filter=contains'.  // 'eq', 'neq', 'startswith', 'endswith', 'contains'
	'&searchinmodules=Accounts,Contacts'.
	'&limit=10';
$params = "sessionName=$cbSessionID&operation=getReferenceAutocomplete$grefParams";
//Call must be GET Request.
$response = $httpc->fetch_url("$cbURL?$params");
$dmsg.= debugmsg("Raw response (json) getReferenceAutocomplete",$response);

//decode the json encode response from the server.
$jsonResponse = json_decode($response,true);
$dmsg.= debugmsg("Webservice response getReferenceAutocomplete",$jsonResponse);

if($jsonResponse['success']==false) {
	$dmsg.= debugmsg('getReferenceAutocomplete failed: '.$jsonResponse['error']['message']);
	echo 'getReferenceAutocomplete failed!';
} else {
	var_dump($jsonResponse['result']);
}
?>