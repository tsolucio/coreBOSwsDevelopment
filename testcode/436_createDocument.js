export const cbUploadSignatureImage = async (signature) => {
	let loginresponse;
	try {
		//console.log('try dologin');
		loginresponse = await doLogin();
	} catch (error) {
		throw error;
	}

	const loginresponseJson = await loginresponse.json();
	
	// filelocation can be Internal or External. Internal is uploaded and saved in the application External is a link to outside storage
	// filedownload is the number of times the file has been downloaded (this is incremented from inside the application)
	// filestatus is if it is downloadable or not

	if (loginresponseJson.success) {
		const byteLength = parseInt(signature.replace(/=/g, '').length * 0.75);

		const fileParams = {
		name: 'signature.jpg',
		size: byteLength,
		type: 'image/jpeg',
		content: signature,// signature is a base64 image
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
	} else {
		console.log('error login');
		throw { message: 'error login' };
	}
};