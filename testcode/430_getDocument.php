<?php
//fill in the details of the document id
// select id from documents
// 7x138 is an existing document
$docId='7x138';
//sessionId is obtained from loginResult.
$params = array("sessionName"=>$cbSessionID, "operation"=>'retrievedocattachment', "id"=>$docId,'returnfile'=>false);
//Create must be POST Request.
$response = $httpc->send_post_data($cbURL, $params, true);
$dmsg.= debugmsg("Raw response (json) retrievedocattachment",$response);

//decode the json encode response from the server.
$jsonResponse = json_decode($response,true);
$dmsg.= debugmsg("Webservice response retrievedocattachment",$jsonResponse);

if($jsonResponse['success']==false) {
	$dmsg.= debugmsg('retrievedocattachment failed: '.$jsonResponse['error']['message']);
	echo 'retrievedocattachment failed!';
} else {
	echo "<script type='text/javascript'>
		function doDOCDownload() {
			io = document.createElement('iframe');
			io.src = 'index.php?action=execCodeDirect&script=430_getDocumentDirect.php&docId=".$docId."';
			io.style.display = 'block';
			io = $(io);
			$('body').append(io);
			setTimeout(function() {
				io.remove();
			}, 5000);
		}
		</script>";
	echo "<br><a href='javascript:doDOCDownload();' class='btn btn-primary btn-large'>Download Document</a>";
}
?>