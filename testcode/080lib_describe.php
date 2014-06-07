<?php
//Describe request
$ctodetails = $cbconn->doDescribe('Contacts');
if ($ctodetails) {
	var_dump($ctodetails);
} else {
	echo "Describe failed<br>";
	$err = $cbconn->lastError();
	echo $err['code'].': '.$err['message'];
}
?>
