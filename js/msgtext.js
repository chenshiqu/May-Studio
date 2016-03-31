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
	.done(function() {
		e.preventDefault();
		alert("please login firstly");
		console.log("success");
	})
	.fail(function() {
		console.log("error");
	})
	.always(function() {
		console.log("complete");
	});
});