<?php
$accountId = '11x20';
$input_array =  array (
	'assigned_user_id' => $cbUserID,
	'subject' => 'REST salesOrderSubject',
	'bill_city' => 'Drachten',
	'bill_code' => '9205BB',
	'bill_country' => 'Netherlands',
	'bill_pobox' => '',
	'bill_state' => '',
	'bill_street' => 'schuur 86',
	'carrier' => NULL,
	'contact_id' => NULL,
	'conversion_rate' => '1.000',
	'currency_id' => '21x1',
	'customerno' => NULL,
	'description' => 'Producten in deze verkooporder: 2 X Heart of David - songbook 2',
	'duedate' => '2014-11-06',
	'enable_recurring' => '0',
	'end_period' => NULL,
	'exciseduty' => '0.000',
	'invoicestatus' => 'Approved',
	'payment_duration' => NULL,
	'pending' => NULL,
	'potential_id' => NULL,
	'vtiger_purchaseorder' => NULL,
	'quote_id' => NULL,
	'recurring_frequency' => NULL,
	'salescommission' => '0.000',
	'ship_city' => 'schuur 86',
	'ship_code' => '9205BB',
	'ship_country' => 'Netherlands',
	'ship_pobox' => NULL,
	'ship_state' => NULL,
	'ship_street' => 'Drachten',
	'account_id' => $accountId,
	'sostatus' => 'Approved',
	'start_period' => NULL,
	'salesorder_no' => NULL,
	'terms_conditions' => NULL,
	'discount_type_final' => 'percentage',  //  zero/amount/percentage
	'hdnDiscountAmount' => '20.000',  // only used if 'discount_type_final' == 'amount'
	'hdnDiscountPercent' => '10.000',  // only used if 'discount_type_final' == 'percentage'
	'shipping_handling_charge' => 15,
	'shtax1' => 0,   // apply this tax, MUST exist in the application with this internal taxname
	'shtax2' => 8,   // apply this tax, MUST exist in the application with this internal taxname
	'shtax3' => 0,   // apply this tax, MUST exist in the application with this internal taxname
	'adjustmentType' => 'add',  //  none/add/deduct
	'adjustment' => '40.000',
	'taxtype' => 'group',  // group or individual  taxes are obtained from the application
	'pdoInformation' => array(
	  array(
		"productid"=>60,
	    "comment"=>'cmt1',
		"qty"=>1,
		"listprice"=>10,
		'discount'=>0,  // 0 no discount, 1 discount
		"discount_type"=>0,  //  amount/percentage
		"discount_percentage"=>0,  // not needed nor used if type is amount
		"discount_amount"=>0,  // not needed nor used if type is percentage
	  ),
	  array(
		"productid"=>57,
		"qty"=>2,
	    "comment"=>'cmt2',
		"listprice"=>10,
		'discount'=>1,
		"discount_type"=>'percentage',  //  amount/percentage
		"discount_percentage"=>2,
		"discount_amount"=>0
	  ),
	),
);

//encode the object in JSON format to communicate with the server.
$objectJson = json_encode($input_array);
$dmsg.= debugmsg("Create, sending in",$objectJson);

//name of the module for which the entry has to be created.
$moduleName = 'SalesOrder';

//sessionId is obtained from loginResult.
$params = array("sessionName"=>$cbSessionID, "operation"=>'create', 
    "element"=>$objectJson, "elementType"=>$moduleName);
//Create must be POST Request.
$response = $httpc->send_post_data($cbURL, $params, true);
$dmsg.= debugmsg("Raw response (json) Create",$response);

//decode the json encode response from the server.
$jsonResponse = json_decode($response,true);
$dmsg.= debugmsg("Webservice response Create",$jsonResponse);

if($jsonResponse['success']==false) {
	$dmsg.= debugmsg('create failed:'.$jsonResponse['error']['message']);
	echo 'create failed!';
} else {
	$savedObject = $jsonResponse['result'];
	$id = $savedObject['id'];
	var_dump($savedObject);
}
?>