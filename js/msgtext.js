$('textarea').click(function(e){
	$.post('index.php/Msgboard/getSession', function(data) {
		if (data==0) {
			alert("please login firstly");
		}
	});
});

$('input.msg_verify').click(function(e){
	$.ajax({
		url: 'index.php/Msgboard/getSession',
		type: 'POST',
		async:false
	})
	.done(function(data) {
		if(data==0)
		{
			e.preventDefault();
			alert("please login firstly");
			console.log("success");
		}
	})
	.fail(function() {
		console.log("error");
	})
	.always(function() {
		console.log("complete");
	});
});

$('#leave-msg').validate({
	rules:{
		msg_comment:{
			required:true
		}
	}
});

$('.make-comment').validate({
	rules:{
		msg_comment:{
			required:true
		}
	}
});