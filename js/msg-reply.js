// JavaScript Document
$(document).ready(function(e) {
	/*like*/
	$('#like').click(function(e){
		var $this=$(this);
		e.preventDefault();
		
		if($this.attr("class")==="like"){
			$this.removeClass('like');
			$this.addClass('liked');

			//update favour
			var url="index.php/msgboard/increase_favour";
			$.ajax({
				url: url,
				type: 'POST',
				data: {mood_id: $('.mood_id').attr('value')},
			})
			.done(function(data) {
				$('#favour_number').html(data);
				console.log(data);
			})
			.fail(function(data) {
				console.log(data);
			})
			.always(function() {
				console.log("complete");
			});
		}else{
			$this.removeClass('liked');
			$this.addClass('like');

			//update favour
			var url="index.php/msgboard/down_favour";
			$.ajax({
				url: url,
				type: 'POST',
				data: {mood_id: $('.mood_id').attr('value')},
			})
			.done(function(data) {
				$('#favour_number').html(data);
				console.log(data);
			})
			.fail(function(data) {
				console.log(data);
			})
			.always(function() {
				console.log("complete");
			});
		}
		
	});
	//});
	
	/*reply*/
    	$('.reply').click(function(e){
		e.preventDefault();
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
