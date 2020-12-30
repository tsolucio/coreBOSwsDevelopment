<?php
require 'dologin.php';
 
//fill in the details of the document id. Can be obtained using vtwsbrowser
// select id from documents
$docId='7x134063';
//sessionId is obtained from loginResult.
$params = array("sessionName"=>$sessionId, "operation"=>'retrievedocattachment', "id"=>$docId,'returnfile'=>'1');
// must be POST Request.
$httpc->post("$endpointUrl", $params, true);
$response = $httpc->currentResponse();
if ($dcall==1) printvar("Raw response (json) RetrieveDocAttachment",$response);
 
//decode the json encode response from the server.
$jsonResponse = Zend_JSON::decode($response['body']);
if ($dcall==1) printvar("Webservice response RetrieveDocAttachment",$jsonResponse);
 
//operation was successful get the token from the reponse.
if($jsonResponse['success']==false)
    //handle the failure case.
    die('RetrieveDocAttachment failed: '.$jsonResponse['error']['message']);
 
// fix for IE catching or PHP bug issue
header("Pragma: public");
header("Expires: 0"); // set expiration time
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
// browser must download file from server instead of cache
 
// force download dialog
header("Content-Type: application/force-download");
//header('Content-Type: application/pdf');   FIXME
header("Content-Type: application/download");
 
// use the Content-Disposition header to supply a recommended filename and
// force the browser to display the save dialog.
header('Content-Disposition: attachment; filename="'.$jsonResponse['result']['0']['filename'].'"');
 
/*
The Content-transfer-encoding header should be binary, since the file will be read
directly from the disk and the raw bytes passed to the downloading computer.
The Content-length header is useful to set for downloads. The browser will be able to
show a progress meter as a file downloads. The content-lenght can be determined by
filesize function returns the size of a file.
*/
header("Content-Transfer-Encoding: binary");
 
echo base64_decode($jsonResponse['result']['0']['attachment']);
exit;
?>
