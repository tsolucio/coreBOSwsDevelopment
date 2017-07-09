<?php
$params = "sessionName=$cbSessionID&operation=getAssignedUserList&module=Accounts";
// must be GET Request.
$response = $httpc->fetch_url("$cbURL?$params");
$dmsg.= debugmsg("Raw response (json) getAssignedUserList",$response);

//decode the json encode response from the server.
$jsonResponse = json_decode($response, true);
$dmsg.= debugmsg("Webservice response getAssignedUserList",$jsonResponse);

if ($jsonResponse['success']==false) {
	$dmsg.= debugmsg('getAssignedUserList failed: '.$jsonResponse['message']);
	echo 'getAssignedUserList failed!';
} else {
	$userlist = json_decode($jsonResponse['result'], true);
	if (is_array($userlist)) {
		echo "<h4>User list</h4>";
		echo '<select name="assigned_user_id">';
		foreach ($userlist as $user) {
			echo '<option value="'.$user['userid'].'">'.$user['username'].'</option>';
		}
		echo '</select>';
	} else {
		echo "Error getting user list!";
	}
}
?>