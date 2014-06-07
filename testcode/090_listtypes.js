//ListTypes request
cbconn.doListTypes(processListTypesDetails);

function processListTypesDetails(result, args) {
	if(result) {
		console.log(result);
		var keys = Object.keys(result);
		console.log(keys);
		for (index in keys) {
			outputmsg(result[keys[index]].name+"<br>");
		}
	} else {
		outputmsg('<p style="color:red">ListTypes failed</p>');
	}
}
