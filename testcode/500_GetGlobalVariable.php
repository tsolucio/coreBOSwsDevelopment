<?php
// get global variable value
$gvname = 'Application_ListView_PageSize';
$gvdefault = 20;
$gvmodule = 'Invoice';
$params = "sessionName=$cbSessionID&operation=SearchGlobalVar";
$params.= "&gvname=$gvname&defaultvalue=$gvdefault&gvmodule=$gvmodule";
//SearchGlobalVar must be GET Request.
$response = $httpc->fetch_url("$cbURL?$params");
$dmsg.= debugmsg("Raw response (json) SearchGlobalVar",$response);

//decode the json encode response from the server.
$jsonResponse = json_decode($response, true);
$dmsg.= debugmsg("Webservice response SearchGlobalVar",$jsonResponse);

if($jsonResponse['success']==false) {
	$dmsg.= debugmsg('SearchGlobalVar failed: '.$jsonResponse['message']);
	echo 'SearchGlobalVar failed!';
} else {
	echo "Value for $gvname: " . $jsonResponse['result'];
}
?>