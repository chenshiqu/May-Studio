// JavaScript Document
$(document).ready(function() {
    $('#all-cmt').click(function(e){
		var $this=$(this);
		var $comments=$("#comments");
		e.preventDefault();
		
		if($comments.attr("class")==="collapse"){
			$comments.removeClass("collapse");
			$comments.addClass("unfold");
			$(".recommendation").hide("fast");
			$this.html("［点击收起］");
		}else{
			$(".recommendation").show("fast");
			$comments.removeClass("unfold");
			$comments.addClass("collapse");
			$this.html("［点击展开］");
		}
	});
});