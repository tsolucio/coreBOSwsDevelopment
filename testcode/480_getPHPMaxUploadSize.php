<?php
$params = array(
	"sessionName"=>$cbSessionID,
	"operation"=>'getMaxLoadSize',
);
// this is a POST Request.
$response = $httpc->send_post_data($cbURL, $params, true);
$dmsg.= debugmsg("Raw response (json) getMaxUpload",$response);

//decode the json encode response from the server.
$jsonResponse = json_decode($response, true);
$dmsg.= debugmsg("Webservice response getMaxUpload",$jsonResponse);

if ($jsonResponse['success']==false) {
	$dmsg.= debugmsg('getMaxUpload failed: '.$jsonResponse['message']);
	echo 'getMaxUpload failed!';
} else {
	$uploadsize = $jsonResponse['result'];
	if ($uploadsize!==false) {
		echo "<H3>The maximum PHP upload size is:<br> $uploadsize bytes</H3>";
	} else {
		echo "Error getting upload max size!";
	}
}
?>