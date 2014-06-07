//Describe request
var module = 'Contacts';
var callback = {
	'function' : processModuleDetails,
	'arguments': { 'moduleName' : module }
	};
cbconn.doDescribe(module, callback);

function processModuleDetails(result, args) {
	if(result) {
		var module = args.moduleName;
		outputmsg('Module = ' + module + ', Details = ' + JSON.stringify(result));
	} else {
		outputmsg('<p style="color:red">Describe failed</p>');
	}
}
