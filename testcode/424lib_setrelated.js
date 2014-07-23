//establish m:m relations between records
//setrelated request
var ctoId='12x22';  // Contacts
var pdoId='14x52';  // Product
var docId='15x159';  // Document
var srvId='26x151'; // Services
var with_this_ids = [pdoId,docId,srvId];

cbconn.doSetRelated(ctoId, with_this_ids, afterSetRelated);

function afterSetRelated(result, args) {
	if(result) {
		console.log(result);
		outputmsg(result);
	} else {
		outputmsg('<p style="color:red">Set Related failed</p>');
	}
}