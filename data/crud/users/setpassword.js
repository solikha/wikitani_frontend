// testing
validationRules = {
	username: {
		minlength : 5
	},
	currentpassword : {
		required : true
	},
	newpassword : {
		required : true,
		minlength : 5
	},
	confirmpassword : {
		required : true,
		minlength : 5,
		equalTo : "#newpassword"
	}
}
