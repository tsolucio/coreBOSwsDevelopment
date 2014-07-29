// authenticate Contact
// Validates a contact access to the portal: the contact must have an active portal access with correct access dates
//    and give the correct email and password.

var email = 'mary_smith@company.com';
var password = 'j531iuze';
var params = { 'email': email,'password': password };

cbconn.doInvoke(checkContactLogin, 'authenticateContact', params);

function checkContactLogin(result, args) {
	if(result) {
		console.log(result);
		outputmsg('Contact with ID ' + result + ' has been authenticated correctly!');
	} else {
		outputmsg('<p style="color:red">Contact with email ' + email + ' could <b>NOT</b> be authenticated correctly!</p>');
	}
}
