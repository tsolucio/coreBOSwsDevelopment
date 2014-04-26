<?php
// Obtained from contact creation example
$contactId='4x194';

//delete a record created in above examples, sessionId a obtain from the login result.
$params = array("sessionName"=>$cbSessionID, "operation"=>'delete', "id"=>$contactId);
//delete operation request must be POST request.
$response = $httpc->send_post_data($cbURL, $params, true);
$dmsg.= debugmsg("Raw response (json) Delete",$response);

//decode the json encode response from the server.
$jsonResponse = json_decode($response, true);
$dmsg.= debugmsg("Webservice response Delete",$jsonResponse);

if($jsonResponse['success']==false) {
	$dmsg.= debugmsg('delete failed: '.$jsonResponse['error']['message']);
	echo 'delete failed!';
} else {
	echo debugmsg("Record Deleted",$jsonResponse);
}
?>