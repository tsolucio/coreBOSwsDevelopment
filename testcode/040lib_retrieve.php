<?php
//retrieve using library
// To obtain the identifier of the account you can use the Query operation
$accountId = '3x40';
$retrieve = $cbconn->doRetrieve($accountId);

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