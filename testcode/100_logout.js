cbconn.doLogout(postLogout);
// postLogin function gets a call once request is completed
function postLogout(result, args) {
  if (result)
	outputmsg('<p style="color:green">Logout was successful</p>');
  else 
	outputmsg('<p style="color:red">Logout failed</p>');
}
