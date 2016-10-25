const response = {};

response.success = (data) => {
	console.log(JSON.stringify({data: data, success: true}));
	phantom.exit();
}

response.error = (errorCode, errorMessage) => {
	console.log(JSON.stringify({
		errorCode: errorCode, 
		errorMessage: errorMessage, 
		success: false
	}));
	phantom.exit();
}

module.exports = response;