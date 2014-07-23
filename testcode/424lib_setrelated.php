<?php
//setrelated request
$ctoId='12x22';  // Contacts
$pdoId='14x52';  // Product
$docId='15x159';  // Document
$srvId='26x151'; // Services

$rdo = $cbconn->doSetRelated($ctoId, array($pdoId,$docId,$srvId));

//check for whether the requested operation was successful or not.
if($rdo) {
	//operation was successful get the response.
	var_dump($rdo);
} else {
	echo "SetRelated failed<br>";
	$err = $cbconn->lastError();
	echo $err['code'].': '.$err['message'];
}
?>