<?php
function tagLI($vli) {
	echo "<li>$vli</li>";
}
echo '<ul>';
// show the variables we can use in our test code
tagLI("URL of the site we logged in with: <b>".$cbURL."</b>");
tagLI("Username we logged in with: <b>".$cbUserName."</b>");
tagLI("UserID we logged in with: <b>".$cbUserID."</b>");
tagLI("Accesskey we logged in with: <b>".$cbAccessKey."</b>");
tagLI("SessionID we logged in with: <b>".$cbSessionID."</b>");
tagLI('cbwsLibrary connection to coreBOS: <b>$cbconn</b>');
tagLI('http_curl connection to coreBOS: <b>$httpc</b>');
echo '</ul>';

// debug message
$dmsg = 'Any message we put into the <b>$dmsg</b> variable will be output to the Debug box';
$dmsg.= debugmsg(
	'Result of the REST call',
	array('status'=>'success','result'=>'hello world')
);
echo "<br>You can find some more information on our wiki: <a href='http://corebos.org/documentation/doku.php?id=en:devel:corebosws:coreBOSwsDevelopment'>coreBOSwsDevelopment</a>";
?>
