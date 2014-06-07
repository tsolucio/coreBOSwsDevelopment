<?php
//create using library
//name of the module for which the entry has to be created.
$moduleName = 'Contacts';
//fill in the details of the contacts.userId is obtained from loginResult.
$contactData  = array('lastname'=>'Valiant', 'assigned_user_id'=>$cbUserID,'homephone'=>'123456789');
$create = $cbconn->doCreate($moduleName, $contactData);

//check for whether the requested operation was successful or not.
if($create) {
	//operation was successful get the response.
	var_dump($create);
} else {
	echo "Create failed<br>";
	$err = $cbconn->lastError();
	echo $err['code'].': '.$err['message'];
}

?>