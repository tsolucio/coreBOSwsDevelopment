<?php
//query to select data from the server.
$query = "select * from Contacts;";
//$query = "select * from Contacts where lastname='Brown';";
//$query = "select lastname,firstname,account_id,assigned_user_id from Contacts;";
$q = $cbconn->doQuery($query);
if ($q) {
	$columns = $cbconn->getResultColumns($q);
	$hdr = "<table class='table table-striped small table-condensed'><tr>";
	foreach ($columns as $colhdr) {
		$hdr .= '<th>'.$colhdr.'</th>';
	}
	$hdr .= "</tr>";
	foreach ($q as $row) {
		$hdr .=  "<tr>";
		foreach ($row as $col) {
			$hdr .=  '<td>'.$col.'</td>';
		}
		$hdr .=  "</tr>";
	}
	$hdr .= "</table>";
	echo $hdr;
} else {
	echo "Query failed<br>";
	$err = $cbconn->lastError();
	echo $err['code'].': '.$err['message'];
}
?>