<?php
//Product record to add the images to
$productID = '14x2616';

// get file and file information
$finfo = finfo_open(FILEINFO_MIME); // return mime type ala mimetype extension.
$filename = 'assets/go_top.png';
$mtype = finfo_file($finfo, $filename);
$files = array();
$files[] = array(
	'name'=>basename($filename),  // no slash nor paths in the name
	'size'=>filesize($filename),
	'type'=>$mtype,
	'content'=>base64_encode(file_get_contents($filename))
);
$filename = 'assets/app-logo.png';
$mtype = finfo_file($finfo, $filename);
$files[] = array(
	'name'=>basename($filename),  // no slash nor paths in the name
	'size'=>filesize($filename),
	'type'=>$mtype,
	'content'=>base64_encode(file_get_contents($filename))
);

$response = $cbconn->doInvoke('addProductImages',
	array('id'=>$productID,'files'=>json_encode($files)));
$dmsg = debugmsg("Raw response (json) add image ",$response);

if ($response['Error']=='0') {
	echo "Product updated with images<br>";
} else {
	echo "Error uploading Product images<br>";
}
var_dump($response);
?>
