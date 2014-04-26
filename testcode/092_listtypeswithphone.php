<?php
/* Valid field types are:
 * empty string or no parameter sent will list all module types accesible by the user
 * phone
 * url
 * reference a field that is a capture or pointer to another module
 * email
 * picklist
 * currency
 * boolean
 * owner
 * text
 * file
*/
$fieldtype  = array('phone');
//encode the object in JSON format to communicate with the server.
$fieldtypeJson = json_encode($fieldtype);
//listtypes request must be GET request.
$response = $httpc->fetch_url("$cbURL?sessionName=$cbSessionID&operation=listtypes&fieldTypeList=".$fieldtypeJson);
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
