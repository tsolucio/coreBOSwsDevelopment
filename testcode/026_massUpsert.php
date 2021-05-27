<?php
$elements = array (
	array (
		'elementType' => 'HelpDesk',
		'referenceId' => '',
		'element' => array (
			'ticket_title' => 'support ticket MassUpsert Test 1',
			'parent_id' => '@{refAccount1}',
			'assigned_user_id' => '19x5',
			'product_id' => '14x2617',
			'ticketpriorities' => 'Low',
			'ticketstatus' => 'Open',
			'ticketseverities' => 'Minor',
			'hours' => '1.1',
			'ticketcategories' => 'Small Problem',
			'days' => '1',
			'description' => 'ST mass upsert test 1',
			'solution' => '',
		),
	),
	array (
		'elementType' => 'HelpDesk',
		'referenceId' => '',
		'searchon' => 'ticket_title,product_id',
		'element' => array (
			'ticket_title' => 'support ticket MassUpsert Test 1',
			'parent_id' => '@{refAccount2}',
			'assigned_user_id' => '19x5',
			'product_id' => '14x2617',
			'ticketpriorities' => 'Normal',
			'ticketstatus' => 'Closed',
			'ticketseverities' => 'Major',
			'hours' => '2.2',
			'ticketcategories' => 'Big Problem',
			'days' => '2',
			'description' => 'ST mass upsert test 2',
			'solution' => '2',
		),
	),
	array (
		'elementType' => 'Accounts',
		'referenceId' => 'refAccount1',
		'element' => array (
			'accountname' => 'MassUpsert Test 1',
			'website' => 'https://corebos.org',
			'assigned_user_id' => '19x5',
			'description' => 'mass upsert test',
		),
	),
	array (
		'elementType' => 'Accounts',
		'referenceId' => 'refAccount2',
		'searchon' => 'accountname',
		'element' => array (
			'accountname' => 'Kvoo Radio',
			'cf_725' => 'https://corebos.org',
			'cf_718' => 'mass upsert test',
		),
	),
);
//encode the object in JSON format to communicate with the server.
$objectJson = json_encode($elements);
$dmsg.= debugmsg('Mass Upsert, sending in', $objectJson);

$params = array(
	'sessionName' => $cbSessionID, //sessionId is obtained from loginResult.
	'operation' => 'MassCreate', // Note, MassCreate, not MassUpsert !
	'elements' => $objectJson,
);
//Create must be POST Request.
$response = $httpc->doPost($params, false);
$dmsg.= debugmsg('Raw response (json) MassUpsert', $response);

//decode the json encode response from the server.
$jsonResponse = json_decode($response, true);
$dmsg.= debugmsg('Webservice response MassUpsert', $jsonResponse);

if ($jsonResponse['success']) {
	var_dump($jsonResponse['result']);
} else {
	$dmsg.= debugmsg('create failed:'.$jsonResponse['error']['message']);
	echo 'MassUpsert failed!';
}
?>
