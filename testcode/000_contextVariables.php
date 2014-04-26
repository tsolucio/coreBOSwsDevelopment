<?php
// show the variables we can use in our test code
echo "URL of the site we logged in with: <b>".$cbURL."</b><br>";
echo "Username we logged in with: <b>".$cbUserName."</b><br>";
echo "UserID we logged in with: <b>".$cbUserID."</b><br>";
echo "Accesskey we logged in with: <b>".$cbAccessKey."</b><br>";
echo "SessionID we logged in with: <b>".$cbSessionID."</b><br>";
echo 'cbwsLibrary connection to coreBOS: <b>$cbconn</b><br>';
echo 'http_curl connection to coreBOS: <b>$httpc</b><br>';

// debug message
$dmsg = 'Any message we put into the <b>$dmsg</b> variable will be output to the Debug box';
$dmsg.= debugmsg(
	'we have a special function for debug messages which accepts complex variables',
	array('v1'=>'value 1','v2'=>'value2')
);
?>
