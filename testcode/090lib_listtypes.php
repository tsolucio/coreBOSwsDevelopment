<?php
//listtypes request
$modules = $cbconn->doListTypes();
//$modules = $cbconn->doListTypes(array('phone','email'));
if ($modules) {
	echo "<b>Accesible Modules</b><br>";
	foreach ($modules as $modname) {
		echo $modname['name']."<br>";
	}
} else {
	echo "ListTypes failed<br>";
	$err = $cbconn->lastError();
	echo $err['code'].': '.$err['message'];
}
?>
