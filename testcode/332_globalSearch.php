<?php
//doglobalsearch request must be POST request.
$restrictionsID=json_encode(array(
			'userId'=>$cbUserID,
			'accountId'=>'11x4',
			'contactId'=>'12x30'
));
$query = 'mary';
$params = array("sessionName"=>$cbSessionID,
				"operation"=>'getSearchResults', "query"=>$query,
				"search_onlyin"=>'','restrictionids'=>$restrictionsID);
//Call must be POST Request.
$response = $httpc->send_post_data($cbURL, $params, true);
$dmsg.= debugmsg("Raw response (json) unifiedsearch",$response);

//decode the json encode response from the server.
$jsonResponse = json_decode($response,true);
$dmsg.= debugmsg("Webservice response unifiedsearch",$jsonResponse);

if($jsonResponse['success']==false) {
	$dmsg.= debugmsg('unifiedsearch failed:'.$jsonResponse['error']['message']);
	echo 'unifiedsearch failed!';
} else {
	//Show the results
	$rdos = unserialize($jsonResponse['result']);
	$nrdos = count($rdos);
	echo "<b>SEARCH_CRITERIA: $query</b><br>";
	echo "<b>Results: $nrdos</b><br>";
	if ($nrdos>0)
	  echo "<table class='table table-striped small table-condensed'>";
	  foreach ($rdos as $modrdo) {
		echo "<tr><td>";
		foreach($modrdo as $fld) {
			echo "$fld |";
		}
		echo "</td></tr>";
	  }
	  echo "</table>";
}
?>
