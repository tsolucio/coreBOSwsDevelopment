const byteLength = parseInt(signature.replace(/=/g, '').length * 0.75);

const fileParams = {
	name: 'signature.jpg',
	size: byteLength,
	type: 'image/jpeg',
	content: signature,
};
const contactData = {
	assigned_user_id: loginresponseJson.result.userId,
	notes_title: 'upload signature',
	filename: fileParams,  
	filetype: 'image/jpeg',
	filesize: byteLength,
	filelocationtype: 'I',
	filestatus: 1,
};
return await fetch(cbURL, {
	method: 'POST',
	headers: {
	Accept: 'application/json',
	'Content-Type': 'application/json',
	},
	body: JSON.stringify({
	operation: 'create',
	sessionName: loginresponseJson.result.sessionName,
	elementType: 'Documents',
	element: JSON.stringify(contactData),
	}),
});