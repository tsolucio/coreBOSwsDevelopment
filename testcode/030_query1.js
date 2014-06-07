//query to select data from the server.
var query = "select * from Contacts;";
//var query = "select * from Contacts where lastname='Brown';";
//var query = "select lastname,firstname,account_id,assigned_user_id from Contacts;";
var results = cbconn.doQuery(query, postExecQuery);

function postExecQuery(result, args) {
	if(result) {
		var columns = cbconn.getResultColumns(result);
		var hdr = "<table class='table table-striped small table-condensed'><tr>";
		for (var index = 0; index < columns.length; ++index) {
			hdr += '<th>'+columns[index]+'</th>';
		}
		hdr += "</tr>";
		for (var row = 0; row < result.length; ++row) {
			hdr +=  "<tr>";
			for (var col = 0; col < columns.length; ++col) {
				hdr +=  '<td>'+result[row][columns[col]]+'</td>';
			}
			hdr +=  "</tr>";
		}
		hdr += "</table>";
		outputmsg(hdr);
	} else {
		outputmsg('<p style="color:red">Query failed</p>');
	}
}