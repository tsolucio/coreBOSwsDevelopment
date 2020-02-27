<?php
//create User using library
$moduleName = 'Users';
//fill in the details of the User. Creating userId is obtained from loginResult.
$userData  = array(
	'phone_work'=>'987654321',
	'email1' => 'norepclara@drwho.tld',
	// you should define almost all the fields
	'assigned_user_id'=>$cbUserID,
	'id' => '19x19',
);
$create = $cbconn->doUpdate($moduleName, $userData);

//check whether the requested operation was successful or not.
if ($create) {
	//operation was successful get the response.
	var_dump($create);
} else {
	echo "Update failed<br>";
	$err = $cbconn->lastError();
	echo $err['code'].': '.$err['message'];
}
?>