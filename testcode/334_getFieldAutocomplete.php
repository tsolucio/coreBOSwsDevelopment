<?php
//sessionId is obtained from loginResult.
$grefParams = '&term='.urlencode('es').
	'&filter=contains'.  // 'eq', 'neq', 'startswith', 'endswith', 'contains'
	'&searchinmodule=Products'.
	'&fields=productname,vendor_part_no'.
	'&returnfields=productname,vendor_part_no'.
	'&limit=10';
$params = "sessionName=$cbSessionID&operation=getFieldAutocomplete$grefParams";
//Call must be GET Request.
$response = $httpc->fetch_url("$cbURL?$params");
$dmsg.= debugmsg("Raw response (json) getFieldAutocomplete",$response);

//decode the json encode response from the server.
$jsonResponse = json_decode($response,true);
$dmsg.= debugmsg("Webservice response getFieldAutocomplete",$jsonResponse);

if($jsonResponse['success']==false) {
	$dmsg.= debugmsg('getFieldAutocomplete failed: '.$jsonResponse['error']['message']);
	echo 'getFieldAutocomplete failed!';
} else {
	var_dump($jsonResponse['result']);
}
?>