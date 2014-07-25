//establish m:m relations between records
//setrelated request
var ctoId='12x22';  // Contacts
var srvId='26x151'; // Services

queryParameters = {
	'limit' : '3',
	'offset' : '0',
	'orderby' : ''
};

cbconn.doGetRelatedRecords(ctoId, 'Contacts', 'Services', queryParameters, afterGetRelated);

function afterGetRelated(result, args) {
	console.log(result);
	if(result) {
		outputmsg(result.records.length);
		var columns = cbconn.getResultColumns(result.records);
		var colnames =[];
		for (var c=0; c < columns.length; ++c) {
			// we eliminate numeric column names
			if (!jQuery.isNumeric(columns[c])) colnames.push(columns[c]);
		}
		columns = colnames;
		var hdr = "<table class='table table-striped small table-condensed'><tr>";
		for (var index = 0; index < columns.length; ++index) {
			hdr += '<th>'+columns[index]+'</th>';
		}
		hdr += "</tr>";
		for (var row = 0; row < result.records.length; ++row) {
			hdr +=  "<tr>";
			for (var col = 0; col < columns.length; ++col) {
				hdr +=  '<td>'+result.records[row][col]+'</td>';
			}
			hdr +=  "</tr>";
		}
		hdr += "</table>";
		outputmsg(hdr);
	} else {
		outputmsg('<p style="color:red">Get Related failed</p>');
	}
}