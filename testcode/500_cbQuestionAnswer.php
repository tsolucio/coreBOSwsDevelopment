<?php
//sessionId is obtained from login result.
$params = "sessionName=$cbSessionID&operation=cbQuestionAnswer&qid=48x43175";
//query must be GET Request.
$response = $httpc->fetch_url("$cbURL?$params");
$dmsg.= debugmsg("Raw response (json) Query",$response);

//decode the json encode response from the server.
$jsonResponse = json_decode($response, true);
$dmsg.= debugmsg("Webservice response Query",$jsonResponse);

if($jsonResponse['success']==false) {
    $dmsg.= debugmsg('query failed: '.$jsonResponse['message']);
	var_dump($jsonResponse['message']);
    echo 'query failed!';
} else {
    $dmsg.= debugmsg('query OK: '.$jsonResponse['result']);
	var_dump($jsonResponse['result']);
    echo 'query OK!';
}
?>
