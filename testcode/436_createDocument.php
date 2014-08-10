<?php
//name of the module for which the entry has to be created.
$moduleName = 'Documents';

// get file and file information
// if you are using PHP 5.2 (!) you need to install finfo via PECL
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
$contactData  = array(
	//'assigned_user_id'=>$cbUserID,
	'notes_title' => 'REST Test create doc',
	'filename'=>$model_filename,
	'filetype'=>$model_filename['type'],
	'filesize'=>$model_filename['size'],
	'filelocationtype'=>'I',
	'filedownloadcount'=> 0,
	'filestatus'=>1,
	'folderid' => '22x1',
);

//encode the object in JSON format to communicate with the server.
$objectJson = json_encode($contactData);
$dmsg.= debugmsg("Create, sending in",$objectJson);
 
$response = $cbconn->doCreate($moduleName, $contactData);
$dmsg.= debugmsg("Raw response (json) Create",$response);

echo "Document created with id: ".$response['id'];
?>
