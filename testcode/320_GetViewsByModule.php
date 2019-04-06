<?php
//getViewsByModule request must be GET request.
$module = 'Assets';
$response = $httpc->fetch_url("$cbURL?sessionName=$cbSessionID&operation=getViewsByModule&module=$module");
$dmsg.= debugmsg("Raw response (json) getViewsByModule",$response);

//decode the json encode response from the server.
$jsonResponse = json_decode($response, true);
$dmsg.= debugmsg("Webservice response getViewsByModule",$jsonResponse);

if($jsonResponse['success']==false) {
	$dmsg.= debugmsg('getViewsByModule failed:'.$jsonResponse['error']['message']);
	echo 'getViewsByModule failed!';
} else {
	//Get the List of all accessible views
	$views = $jsonResponse['result']['filters'];
	echo "<b>Accesible Views</b><br>";
	foreach ($views as $view) {
		var_dump($view);
	}
}
?>
