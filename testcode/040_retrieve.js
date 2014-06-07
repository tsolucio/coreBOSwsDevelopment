//Retrieve request
var record = '12x144';
cbconn.doRetrieve(record, processModuleRecord);
// processModuleRecord gets a call once request is completed

function processModuleRecord(result, args) {
	if(result) {
		console.log(result);
		outputmsg('Record Id = ' + cbconn.getRecordId(result.id));
	} else {
		outputmsg('<p style="color:red">Retrieve failed</p>');
	}
}
