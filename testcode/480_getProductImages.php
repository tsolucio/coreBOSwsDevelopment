<?php
$params = "sessionName=$cbSessionID&operation=getProductImages&id=14x2616";
// must be GET Request.
$response = $httpc->fetch_url("$cbURL?$params");
$dmsg.= debugmsg("Raw response (json) getPdo",$response);

//decode the json encode response from the server.
$jsonResponse = json_decode($response, true);
$dmsg.= debugmsg("Webservice response getPdo",$jsonResponse);

if ($jsonResponse['success']==false) {
	$dmsg.= debugmsg('getPdo failed: '.$jsonResponse['message']);
	echo 'getPdo failed!';
} else {
	$retrievedObjects = $jsonResponse['result']['results'];
	if ($retrievedObjects>0) {
		echo "<table class='table table-striped small table-condensed'>";
		echo "<th>Name</th><th>Path</th><th>Full Path</th><th>Type</th><th>ID</th>";
		foreach ($jsonResponse['result']['images'] as $key=>$value) {
			echo "<tr>";
			echo "<td>".$value['name']."</td>";
			echo "<td>".$value['path']."</td>";
			echo "<td><a href='".$value['fullpath']."'>Link</a></td>";
			echo "<td>".$value['type']."</td>";
			echo "<td>".$value['id']."</td>";
			echo "</tr>";
		}
		echo "</table>";
	} else {
		echo "No images found!";
	}
}
?>