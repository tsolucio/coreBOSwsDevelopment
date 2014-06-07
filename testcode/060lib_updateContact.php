<?php
//update using library
// Obtained from contact creation example
$contactId='12x143';
//name of the module for which the entry has to be updated.
$moduleName = 'Contacts';
//fill in the details of the contacts.userId is obtained from loginResult.
$contactData  = array('lastname'=>'Valiant Update', 'assigned_user_id'=>$cbUserID,'homephone'=>'987654321','id'=>$contactId);

$update = $cbconn->doUpdate($moduleName, $contactData);

//check for whether the requested operation was successful or not.
if($update) {
	//operation was successful get the response.
	var_dump($update);
} else {
	echo "Update failed<br>";
	$err = $cbconn->lastError();
	echo $err['code'].': '.$err['message'];
}
?>