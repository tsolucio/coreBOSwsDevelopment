<?php
// Call new method Get User Info
// For security reasons normal (non-admin) users do not have access to any of the "user" module information
// In the application a non-admin user cannot see information of other users but he CAN see all of his own information
// This inconsistency between the application and REST is partially fixed with this new REST method which returns some user fields
// Only fields of the currently connected user are returned.

// sessionId is obtained from loginResult.
// no other parameters => return fields of the connected user
// test for getPortalUserDateFormat
//$params = array("sessionName"=>$cbSessionID, "operation"=>'getPortalUserDateFormat');
// test for getPortalUserInfo
$params = array("sessionName"=>$cbSessionID, "operation"=>'getPortalUserInfo');
$response = $httpc->send_post_data($cbURL,$params,true);
$dmsg.= debugmsg("Raw response (json) Query",$response);

//decode the json encode response from the server.
$jsonResponse = json_decode($response, true);
$dmsg.= debugmsg("Webservice response Query",$jsonResponse);

if($jsonResponse['success']==false) {
    $dmsg.= debugmsg('query failed: '.$jsonResponse['message']);
    echo 'query failed!';
} else {
	//Array of user fields
	$retrievedInfo = $jsonResponse['result'];
	if (is_array($retrievedInfo)) {
		echo "<table class='table table-striped small table-condensed'><tr>";
		foreach ($retrievedInfo as $key=>$value) {
			echo "<th>$key</th>";
		}
		echo "</tr><tr>";
		foreach ($retrievedInfo as $value) {
			echo "<td>&nbsp;$value</td>";
		}
		echo "</tr></table>";
	} else {
		echo $retrievedInfo;
	}
}
?>