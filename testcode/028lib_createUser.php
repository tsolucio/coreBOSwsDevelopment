<?php
//create User using library
$moduleName = 'Users';
//fill in the details of the User. Creating userId is obtained from loginResult.
$userData  = array(
	'user_name'=>'drwho',
	'user_password'=>'drwho',
	'confirm_password'=>'drwho',
	'first_name'=>'Clara',
	'last_name'=>'Oswald',
	'phone_work'=>'123456789',
	'roleid'=>'H1',
	'email1' => 'norep@drwho.tld',
	// you should define almost all the fields
	'assigned_user_id'=>$cbUserID,
);
$create = $cbconn->doCreate($moduleName, $userData);

//check whether the requested operation was successful or not.
if($create) {
	//operation was successful get the response.
	var_dump($create);
} else {
	echo "Create failed<br>";
	$err = $cbconn->lastError();
	echo $err['code'].': '.$err['message'];
}

?>