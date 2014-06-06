cbconn.doLogin('admin', 'pzkM2SZ2c5r5dij', postLogin);
// postLogin function gets a call once request is completed
function postLogin(result, args) {
  if (result)
	outputmsg('<p style="color:green">Login was successful</p>');
  else 
	outputmsg('<p style="color:red">Login failed</p>');
}