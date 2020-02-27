<?php
// delete using library
$params=array(
	'id' => '19x19',
	'newOwnerId' => '19x1',
);

$delete = $cbconn->doInvoke('deleteUser', $params, 'POST');

//check for whether the requested operation was successful or not.
if ($delete) {
	//operation was successful get the response.
	echo 'User Deleted';
	var_dump($delete);
} else {
	echo 'Delete Failed<br>';
	$err = $cbconn->lastError();
	echo $err['code'].': '.$err['message'];
}
?>