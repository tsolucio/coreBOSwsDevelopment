<?php
$soId = '6x204';
$retrieve = $cbconn->doRetrieve($soId);

//check for whether the requested operation was successful or not.
if($retrieve) {
	//operation was successful get the response.
	var_dump($retrieve);
} else {
	echo "Retrieve failed<br>";
	$err = $cbconn->lastError();
	echo $err['code'].': '.$err['message'];
}
?>