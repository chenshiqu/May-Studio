$().ready(function(){
	$("#signup_form").validate({
		// debug: true;
		rules:{
			signup_username:{
				required:true,
				rangelength:[5,20]
			},
			signup_email:{
				required:true,
				email:true
			},
			signup_password:{
				required:true,
				minlength: 6
			},
			confirm_password:{
				required:true,
				equalTo:"#signup_password"
			}
		}
	});
})