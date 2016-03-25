// JavaScript Document
$(document).ready(function(e) {
	/*like*/
	$('#like').click(function(e){
		var $this=$(this);
		e.preventDefault();
		
		if($this.attr("class")==="like"){
			$this.removeClass('like');
			$this.addClass('liked');
		}else{
			$this.removeClass('liked');
			$this.addClass('like');
		}
	});
	
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
		$('#reply-input textarea').html("回复 "+subject+"：");
						
	});

});
