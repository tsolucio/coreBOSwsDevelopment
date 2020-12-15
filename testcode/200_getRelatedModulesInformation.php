<?php
//name of the module
$moduleName = 'Contacts';

//sessionId is obtained from loginResult.
$params = array(
    "sessionName"=>$cbSessionID,
    "operation"=>'getRelatedModulesInfomation', 
    "module"=>$moduleName,
);
//must be POST Request.
$response = $httpc->send_post_data($cbURL, $params);
$dmsg.= debugmsg("Raw response (json) RelInfo",$response);

//decode the json encode response from the server.
$jsonResponse = json_decode($response, true);
$dmsg.= debugmsg("Webservice response RelInfo",$jsonResponse);

if($jsonResponse['success']==false) {
    $dmsg.= debugmsg('RelInfo failed:'.$jsonResponse['error']['message']);
    echo "RelInfo failed!";
} else {
    $savedObject = $jsonResponse['result'];
    $id = $savedObject['id'];
    var_dump($savedObject);
}
?>
