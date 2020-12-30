<?php
//fill in the details of the invoice id.
// select subject,id from invoice
// 16x90 is an existing invoice
$invoiceId='7x2816';
//sessionId is obtained from loginResult.
$params = array("sessionName"=>$cbSessionID, "operation"=>'getpdfdata', "id"=>$invoiceId);
//Create must be POST Request.
$response = $httpc->send_post_data($cbURL, $params);
$dmsg= debugmsg("Raw response (json) GetPDFData",$response);

//decode the json encode response from the server.
$jsonResponse = json_decode($response,true);
$dmsg.= debugmsg("Webservice response GetPDFData",$jsonResponse);

if($jsonResponse['success']==false) {
	$dmsg.= debugmsg('GetPDFData failed: '.$jsonResponse['error']['message']);
	echo 'GetPDFData failed!';
} else {
	// The next code does not work in the coreBOSwsDevelopment because we capture the header in the application
	// but it does work if sent directly to the browser...
	/*
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
		
		// The Content-transfer-encoding header should be binary, since the file will be read
		// directly from the disk and the raw bytes passed to the downloading computer.
		// The Content-length header is useful to set for downloads. The browser will be able to
		// show a progress meter as a file downloads. The content-lenght can be determines by
		// filesize function returns the size of a file.
		header("Content-Transfer-Encoding: binary");
		echo base64_decode($jsonResponse['result']['0']['pdf_data']);
	*/
	// so we setup a button to launch it directly
	// you can study the getpdfdirect script to see the similarities
	echo "<script type='text/javascript'>
		function doPDFDownload() {
			io = document.createElement('iframe');
			io.src = 'index.php?action=execCodeDirect&script=400_getpdfdirect.php&invoiceID=".$invoiceId."';
			io.style.display = 'block';
			io = $(io);
			$('body').append(io);
			setTimeout(function() {
				io.remove();
			}, 15000);
		}
		</script>";
	echo "<br><a href='javascript:doPDFDownload();' class='btn btn-primary btn-large'>Download PDF</a>";
}
?>
