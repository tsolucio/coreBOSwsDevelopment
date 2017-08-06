<?php
//name of the module for which the entry has to be created.
$moduleName = 'Assets';

// NOTE: for this code to work I added a custom image field on the Assets module in the coreBOSTest database

// get file and file information
$finfo = finfo_open(FILEINFO_MIME); // return mime type ala mimetype extension.
$filename = 'assets/app-logo.png';
$mtype = finfo_file($finfo, $filename);
$model_filename=array(
	'name'=>basename($filename),  // no slash nor paths in the name
	'size'=>filesize($filename),
	'type'=>$mtype,
	'content'=>base64_encode(file_get_contents($filename))
);

//fill in the details of the contacts.userId is obtained from loginResult.
$assetData  = array(
	'attachments' => array(
		'cf_862' => $model_filename,
	),
	'assigned_user_id'=>$cbUserID,
	'assetstatus' => 'In Service',
	'dateinservice'=> date('Y-m-d'),
	'datesold'=> date('Y-m-d'),
	'serialnumber'=>'WS-1234',
	'assetname'=>'WS-1234',
	'account' => '11x142',
	'product' => '14x2622',
);

$response = $cbconn->doCreate($moduleName, $assetData);
$dmsg = debugmsg("Raw response (json) Create",$response);

echo $moduleName." created with id: ".$response['id'];
?>
