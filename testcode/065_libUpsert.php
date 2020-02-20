<?php
$element = '{"email":"contact@nodomain.tld","assistant":"Test A & C","firstname":"Stéphanie","lastname":"anonymous","mobile":"09988559","assigned_user_id":"19x5"}';
$params = array(
	'elementType' => 'Contacts',
	'element' => $element,
	'searchOn' => 'email',
	'updatedfields' => 'email,firstname,lastname,assistant',
);

$dmsg.= debugmsg('Upsert, sending in', $params);

$upsert = $cbconn->doInvoke('upsert', $params);

//check for whether the requested operation was successful or not.
if ($upsert) {
	//operation was successful get the response.
	var_dump($upsert);
} else {
	echo 'Upsert failed<br>';
	$err = $cbconn->lastError();
	echo $err['code'].': '.$err['message'];
}
?>