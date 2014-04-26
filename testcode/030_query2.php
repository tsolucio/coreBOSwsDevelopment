<?php
//query to select data from the server.
$query = "select * from Contacts where lastname='Valiant';";
//urlencode to as its sent over http.
$queryParam = urlencode($query);
//sessionId is obtained from login result.
$params = "sessionName=$cbSessionID&operation=query&query=$queryParam";
//query must be GET Request.
$response = $httpc->fetch_url("$cbURL?$params");
$dmsg.= debugmsg("Raw response (json) Query",$response);

//decode the json encode response from the server.
$jsonResponse = json_decode($response, true);
$dmsg.= debugmsg("Webservice response Query",$jsonResponse);

//operation was successful get the token from the response.
if($jsonResponse['success']==false) {
	$dmsg.= debugmsg('query failed: '.$jsonResponse['message']);
	echo 'query failed!';
} else {
	//Array of vtigerObjects
	$retrievedObjects = $jsonResponse['result'];
	if (count($retrievedObjects)>0) {
		echo "<table class='table table-striped small table-condensed'><tr>";
		foreach ($retrievedObjects[0] as $key=>$value) {
			echo "<th>$key</th>";
		}
		echo "</tr>";
		foreach ($retrievedObjects as $record) {
			echo "<tr>";
			foreach ($record as $value) {
				echo "<td>&nbsp;$value</td>";
			}
			echo "</tr>";
		}
		echo "</table>";
	} else {
		echo "No records found!";
	}
}
?>