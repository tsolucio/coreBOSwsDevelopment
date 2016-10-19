<?php
$accountId = '11x123';
$soId = '6x10569';
$input_array =  array (
	'assigned_user_id' => $cbUserID,
	'id' => $soId,
	'subject' => 'Hector Ridondo REST delline',
	'bill_city' => 'Drachten',
	'bill_code' => '9205BB',
	'bill_country' => 'HomeSweetHome',
	'bill_pobox' => '',
	'bill_state' => '',
	'bill_street' => 'schuur 86',
	'carrier' => 'USPS',
	'contact_id' => '12x1810',
	'conversion_rate' => '1.000',
	'currency_id' => '21x1',
	'customerno' => '356042440-00004',
	'description' => 'Producten in deze verkooporder: 2 X Heart of David - songbook 2',
	'duedate' => '2015-03-11',
	'enable_recurring' => '0',
	'end_period' => NULL,
	'exciseduty' => '0.000',
	'invoicestatus' => 'Approved',
	'payment_duration' => NULL,
	'pending' => '',
	'potential_id' => '13x5545',
	'vtiger_purchaseorder' => '',
	'quote_id' => '4x12519',
	'recurring_frequency' => NULL,
	'salescommission' => '0.000',
	'ship_city' => 'schuur 86',
	'ship_code' => '9205BB',
	'ship_country' => 'Netherlands',
	'ship_pobox' => NULL,
	'ship_state' => NULL,
	'ship_street' => 'Drachten',
	'account_id' => $accountId,
	'sostatus' => 'Created',
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
	'adjustmentType' => 'none',  //  none/add/deduct
	'adjustment' => '0.000',
	'taxtype' => 'group',  // group or individual  taxes are obtained from the application
	'pdoInformation' => array(
	  array(
		"productid"=>9734,
		"comment"=>'cmt1',
		"qty"=>10,
		"listprice"=>7,
		'discount'=>0,  // 0 no discount, 1 discount
		"discount_type"=>0,  //  amount/percentage
		"discount_percentage"=>0,  // not needed nor used if type is amount
		"discount_amount"=>0,  // not needed nor used if type is percentage
	  ),
	  array(
		"productid"=>9748,
		"qty"=>20,
		"comment"=>'cmt2',
		"listprice"=>8,
		'discount'=>1,
		"discount_type"=>'percentage',  //  amount/percentage
		"discount_percentage"=>2,
		"discount_amount"=>0
	  ),
	  array(
		"productid"=>2634,
		"qty"=>30,
		"comment"=>'cmt3',
		"listprice"=>9,
		'discount'=>0,
		"discount_type"=>'percentage',  //  amount/percentage
		"discount_percentage"=>0,
		"discount_amount"=>0
	  ),
	  array(
		"productid"=>2618,
		"deleted"=>1,
		"qty"=>30,
		"comment"=>'cmt3',
		"listprice"=>9,
		'discount'=>0,
		"discount_type"=>'percentage',  //  amount/percentage
		"discount_percentage"=>0,
		"discount_amount"=>0
	  ),
	),
);

$dmsg.= debugmsg("Update, sending in",$input_array);

//name of the module for which the entry has to be created.
$moduleName = 'SalesOrder';

$update = $cbconn->doUpdate($moduleName, $input_array);

//check for whether the requested operation was successful or not.
if($update) {
	//operation was successful get the response.
	var_dump($update);
} else {
	echo "Create failed<br>";
	$err = $cbconn->lastError();
	echo $err['code'].': '.$err['message'];
}
?>