// JavaScript Document
$('.nav').each(function() {
    var $this=$(this);
	var $nav=$this.find('li.active');
	var $link=$nav.find('a');
	var $content=$($link.attr('href'));
	
	$this.on('click','.control',function(e){
		e.preventDefault();
		var $link=$(this),
			id=this.hash;
		if(id&&!$link.is('.active')){
			$content.removeClass('active');
			$nav.removeClass('active');
			
			$content=$(id).addClass('active');
			$nav=$link.parent().addClass('active');
		}
	});
});