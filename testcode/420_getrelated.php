<?php

//getrelated request
$docId='4x22';
$basModule='Contacts';
$docId='9x114';
$basModule='HelpDesk';
$docId='10x170';
$basModule='Faq';
$relModule='ModComments';

$docId='4x22';
$basModule='Contacts';
$relModule='Products';
$relModule='Services';
$relModule='Emails';

$docId='6x58';
$basModule='Products';
$relModule='Invoice';
$productDiscriminator='ProductBundle'; // 'ProductLineSalesOrder'

$docId='4x22';
$basModule='Contacts';
$relModule='Products';
$productDiscriminator='ProductLineAll'; // 'ProductLineAll';
$docId='10x170';
$basModule='Faq';
$docId='9x114';
$basModule='HelpDesk';
$relModule='ModComments';

$docId='30x144';
$basModule='Project';
$relModule='HelpDesk';

$docId='6x58';
$basModule='Products';
$relModule='Invoice';
$productDiscriminator='ProductLineSalesOrder'; // 'ProductLineSalesOrder'  ProductBundle

$docId='13x6489';
$basModule='Quotes';
$relModule='Products';
$productDiscriminator='ProductLineSalesOrder'; // 'ProductLineSalesOrder'  ProductBundle

$docId='9x104127';
$basModule='HelpDesk';
$relModule='Documents';
$productDiscriminator='ProductLineSalesOrder'; // 'ProductLineSalesOrder'  ProductBundle

$params = array(
	"sessionName"=>$cbSessionID,
	"operation"=>'getRelatedRecords',
	"id"=>$docId,
	"module"=>$basModule,
	"relatedModule"=>$relModule,
	'queryParameters'=>json_encode(array(
		"productDiscriminator"=>$productDiscriminator,
		//'columns'=>'productname,product_no,id',
		'limit'=>'3',
		'offset'=>'0',
		'orderby'=>''
		)),
	);
$response = $httpc->send_post_data($cbURL, $params, true);
$dmsg.= debugmsg("Raw response (json) getrelated",$response);

//decode the json encode response from the server.
$jsonResponse = json_decode($response,true);
$dmsg.= debugmsg("Webservice response getrelated",$jsonResponse);

if($jsonResponse['success']==false) {
	$dmsg.= debugmsg('getrelated failed:'.$jsonResponse['error']['message']);
	echo 'getrelated failed!';
} else {
	//Get the List of related records.
	$records = $jsonResponse['result']['records'];
	echo "<b>Related Records</b><br>";
	foreach ($records as $record) {
		var_dump($record);
	}
}
?>
