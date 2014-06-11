<?php
//getRelatedRecords using library
// To obtain the identifier you can use the Query operation
$record='4x75';
$basModule='Quotes';
$relModule='Products';
$productDiscriminator='ProductLineSalesOrder'; // 'ProductLineSalesOrder'  ProductBundle

$queryParameters = json_encode(array(
	"productDiscriminator"=>$productDiscriminator,
	//'columns'=>'productname,product_no,id',
	'limit'=>'3',
	'offset'=>'0',
	'orderby'=>''
	));

$retrieve = $cbconn->doGetRelatedRecords($record, $basModule, $relModule, $queryParameters);

//check for whether the requested operation was successful or not.
if($retrieve) {
	//operation was successful get the response.
	var_dump($retrieve);
} else {
	echo "Retrieve failed<br>";
	$err = $cbconn->lastError();
	echo $err['code'].': '.$err['message'];
}
?>