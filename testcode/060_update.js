//update using library
// Obtained from contact creation example
contactId='12x144';
//name of the module for which the entry has to be updated.
moduleName = 'Contacts';
//fill in the details of the contacts.userId is obtained from loginResult.
var valuesmap = {
	'lastname' : 'JSTest Update', 'firstname':'jstest Update', 'id':contactId
};

cbconn.doUpdate(moduleName, valuesmap, afterUpdateRecord);

function afterUpdateRecord(result, args) {
	if(result) {
		console.log(result);
		outputmsg('Record Id = ' + cbconn.getRecordId(result.id));
	} else {
		outputmsg('<p style="color:red">Update failed</p>');
	}
}