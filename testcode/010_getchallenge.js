cbconn.__doChallenge(cbUserName);
if(cbconn._servicetoken == false)
	outputmsg('<p style="color:red">Challenge failed</p>');
else 
	outputmsg('<p style="color:green">Challenge successful, token='+cbconn._servicetoken+'</p>');

