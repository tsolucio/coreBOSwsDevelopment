<?php
// delete using library
// Obtained from contact creation example
$contactId='4x194';

$delete = $cbconn->doDelete($contactId);

//check for whether the requested operation was successful or not.
if($delete) {
	//operation was successful get the response.
	echo "Record Deleted";
	var_dump($delete);
} else {
	echo "Delete Failed<br>";
	$err = $cbconn->lastError();
	echo $err['code'].': '.$err['message'];
}

?>