//upsert using doInvoke
var params = {
	"elementType":"Contacts",
	"element":JSON.stringify({
		"email":"kozane@gmail.com",
		"firstname":"JSTest upsert firstname",
		"lastname":"JSTest upsert lastname",
		"mobile":"02220303030",
		"leadsource":"archireport"
	}),
	"searchOn":"email",
	"updatedfields":"email ,firstname, lastname, mobile, leadsource"
};


cbconn.doInvoke(afterUpsertRecord, 'upsert', params, 'POST');

function afterUpsertRecord(result, args) {
	if(result) {
		console.log(result);
		outputmsg('Record Id = ' + cbconn.getRecordId(result.id));
	} else {
		outputmsg('<p style="color:red">Upsert failed</p>');
	}
}

