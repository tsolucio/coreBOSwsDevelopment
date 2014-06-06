//query to select data from the server.
var query = "select * from Contacts;";
var results = cbconn.doQuery(query, postExecQuery);

function postExecQuery(result, args) {
	if(result) {
		var columns = cbconn.getResultColumns(result);
		var hdr = "<table class='table table-striped small table-condensed'><tr>";
		for (index = 0; index < columns.length; ++index) {
			hdr += '<th>'+columns[index]+'</th>';
		}
		hdr += "</tr>";
		for (row = 0; row < result.length; ++row) {
			hdr +=  "<tr>";
			for (col = 0; col < columns.length; ++col) {
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