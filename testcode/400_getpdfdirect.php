<?php
//fill in the details of the invoice id.
$invoiceId=$_REQUEST['invoiceID'];
//sessionId is obtained from loginResult.
$params = array("sessionName"=>$cbSessionID, "operation"=>'getpdfdata', "id"=>$invoiceId);
//Create must be POST Request.
$response = $httpc->send_post_data($cbURL, $params, true);
$dmsg= debugmsg("Raw response (json) GetPDFData",$response);

//decode the json encode response from the server.
$jsonResponse = json_decode($response,true);
$dmsg.= debugmsg("Webservice response GetPDFData",$jsonResponse);

if($jsonResponse['success']==false) {
	$dmsg.= debugmsg('GetPDFData failed: '.$jsonResponse['error']['message']);
	echo 'GetPDFData failed!';
} else {
	// fix for IE catching or PHP bug issue
	header("Pragma: public");
	header("Expires: 0"); // set expiration time
	header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
	// browser must download file from server instead of cache
	
	// force download dialog
	header("Content-Type: application/force-download");
	header('Content-Type: application/pdf');
	header("Content-Type: application/download");
	
	// use the Content-Disposition header to supply a recommended filename and
	// force the browser to display the save dialog.
	header('Content-Disposition: attachment; filename="invoice.pdf"');
	
	/*
	The Content-transfer-encoding header should be binary, since the file will be read
	directly from the disk and the raw bytes passed to the downloading computer.
	The Content-length header is useful to set for downloads. The browser will be able to
	show a progress meter as a file downloads. The content-lenght can be determines by
	filesize function returns the size of a file.
	*/
	header("Content-Transfer-Encoding: binary");
	
	echo base64_decode($jsonResponse['result']['0']['pdf_data']);
}
?>