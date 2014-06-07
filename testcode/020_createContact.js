//Create request
var module = 'Contacts';
var valuesmap = {
'lastname' : 'JSTest', 'firstname':'jstest'
};
cbconn.doCreate(module, valuesmap, afterCreateRecord);
// afterCreateRecord gets a call once request is completed

function afterCreateRecord(result, args) {
	if(result) {
		console.log(result);
		outputmsg('Record Id = ' + cbconn.getRecordId(result.id));
	} else {
		outputmsg('<p style="color:red">Create failed</p>');
	}
}
