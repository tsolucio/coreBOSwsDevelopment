<?php
//listtypes request must be GET request.
$response = $httpc->fetch_url("$cbURL?sessionName=$cbSessionID&operation=listtypes");
$dmsg.= debugmsg("Raw response (json) listtypes",$response);

//decode the json encode response from the server.
$jsonResponse = json_decode($response, true);
$dmsg.= debugmsg("Webservice response listtypes",$jsonResponse);

if($jsonResponse['success']==false) {
	$dmsg.= debugmsg('list types failed:'.$jsonResponse['error']['message']);
	echo 'list types failed!';
} else {
	//Get the List of all the modules accessible.
	$modules = $jsonResponse['result']['types'];
	echo "<b>Accesible Modules</b><br>";
	foreach ($modules as $modname) {
		echo "$modname<br>";
	}
}
?>
