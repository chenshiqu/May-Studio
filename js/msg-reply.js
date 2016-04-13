// JavaScript Document
$(document).ready(function(e) {
	/*like*/
	$('#like').click(function(e){
		var $this=$(this);
		e.preventDefault();

		$.ajax({
			url: 'index.php/Msgboard/getSession',
			type: 'POST',
			async:false
		})
		.done(function(data) {
			if(data==0)
			{
				alert("please login firstly");
				console.log("success");
			}
			else
			{
				if($this.attr("class")==="like"){
					$this.removeClass('like');
					$this.addClass('liked');

					//update favour
					if($this.attr('name')=="mood")
					{
						$.ajax({
							url: "index.php/msgboard/increase_favour",
							type: 'POST',
							data: {mood_id: $('.mood_id').attr('value')},
							async:false
						})
						.done(function(data) {
							$('#favour_number').html(data);
							console.log(data);
						})
						.fail(function(data) {
							console.log(data);
						})
						.always(function() {
							console.log($this.attr('name'));
						});
					}
					else
					{
						$.ajax({
							url: "index.php/episode/up_favour",
							type: 'POST',
							data: {comment_id: $('.comment_id').attr('value')},
							async:false
						})
						.done(function(data) {
							$('#favour_number').html(data);
							console.log(data);
						})
						.fail(function(data) {
							console.log(data);
						})
						.always(function() {
							console.log($this.attr('name'));
						});
					}
				}
				else{
					$this.removeClass('liked');
					$this.addClass('like');

					//update favour
					if($this.attr('name')=="mood")
					{
						$.ajax({
							url: "index.php/msgboard/down_favour",
							type: 'POST',
							data: {mood_id: $('.mood_id').attr('value')},
							async:false
						})
						.done(function(data) {
							$('#favour_number').html(data);
							console.log(data);
						})
						.fail(function(data) {
							console.log(data);
						})
						.always(function() {
							console.log($this.attr('name'));
						});
					}
					else
					{
						$.ajax({
							url: "index.php/episode/down_favour",
							type: 'POST',
							data: {comment_id: $('.comment_id').attr('value')},
							async:false
						})
						.done(function(data) {
							$('#favour_number').html(data);
							console.log(data);
						})
						.fail(function(data) {
							console.log(data);
						})
						.always(function() {
							console.log($this.attr('name'));
						});
					}
				}
			}
		})
		.fail(function() {
			console.log("error");
		})
		.always(function() {
			console.log($this.attr('name'));
		});
		

		
	});
	//});
	
	/*reply*/
    	$('.reply').click(function(e){
    		var $this=$(this)
		e.preventDefault();

		var replyId=$this.prev().val();
		$('#parent_id').val(replyId);

		$('#reply-input textarea').html("");
		$('#reply-input').toggle("fast");
		
	});
	
	$('.reply-reply').click(function(e){
		var $this=$(this);
		e.preventDefault();
		
		$('#reply-input').css({"display":"block"});
		var subject=$this.parent().find("strong").html();
		var replyId=$this.parent().find('input').val();
		$('#reply-input textarea').html("回复"+subject+":");
		$('#parent_id').val(replyId);
						
	});

});
