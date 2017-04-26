<?php
//vtiger Object name which need be described or whose information is requested.
// Can be passed in with modulename parameter
$moduleName = 'Contacts';

//use sessionId created at the time of login.
$params = "sessionName=$cbSessionID&operation=describe&elementType=$moduleName";
//describe request must be GET request.
$response = $httpc->fetch_url("$cbURL?$params");
$dmsg.= debugmsg("Raw response (json) describe",$response);
//decode the json encode response from the server.
$jsonResponse = json_decode($response, true);
$dmsg.= debugmsg("Webservice response describe",$jsonResponse);

if($jsonResponse['success']==false) {
	$dmsg.= debugmsg('describe object failed:'.$jsonResponse['error']['message']);
	echo 'describe object failed!';
} else {
	//get describe result object.
	$description = $jsonResponse['result'];
	
	echo "<b>Module Name and Id:</b> ".$moduleName.' ('.$description['idPrefix'].')</br>';
	echo "<b>User can create records:</b> ".($description['createable']==1 ? 'Yes' : 'No').'</br>';
	echo "<b>User can update records:</b> ".($description['updateable']==1 ? 'Yes' : 'No').'</br>';
	echo "<b>User can delete records:</b> ".($description['deleteable']==1 ? 'Yes' : 'No').'</br>';
	echo "<b>User can retrieve records:</b> ".($description['retrieveable']==1 ? 'Yes' : 'No').'</br>';
	echo "<b>Fields (hover over name for full details):</b> </br>";
	$i=0;
	foreach ($description['fields'] as $field){
	$ttname="tt$i";  $i++;
	$fieldname=$field['label'];
	$fielddesc="$fieldname\nField: ".$field['name']."\nMandatory: ";
	$fielddesc.=($field['name'] ? 'yes' : 'no')."\nNull: ".($field['nullable'] ? 'yes' : 'no');
	$fielddesc.="\nEditable: ".($field['editable'] ? 'yes' : 'no')."\nDefault: ".$field['default'];
	$fielddesc.="\nType: ".$field['type']['name']."\nFormat: ".$field['type']['name'];
	$addinfo='';
	if (isset($field['type']['refersTo'])) {
		$addinfo="\nRefers To: ";
		foreach($field['type']['refersTo'] as $capts) $addinfo.="$capts, ";
	}
	if (isset($field['type']['picklistValues'])) {
		$addinfo="\nPicklist values: ";
		foreach($field['type']['picklistValues'] as $plvs=>$plvn) $addinfo.=$plvn['value'].", ";
		$addinfo.="\nDefault: ".$field['default'];
	}
	$fielddesc.=$addinfo;
	echo "<div data-toggle='tooltip' data-placement='right' title='$fielddesc'>$fieldname,</div>";
	}
}
?>