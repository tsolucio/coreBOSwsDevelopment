<?php
//create using library
//name of the module for which the entry has to be created.
$moduleName = 'Contacts';
$pdoId='14x52';  // Product
$docId='15x159';  // Document
$srvId='26x151'; // Services

//fill in the details of the contacts.userId is obtained from loginResult.
$contactData  = array('lastname'=>'ValiantSR', 'assigned_user_id'=>$cbUserID,
		'homephone'=>'123456789','relations'=>array($pdoId,$docId,$srvId));
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