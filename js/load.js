// 点开导航项时只刷新内容部分
/*$('.nav a').click(function(e){
	e.preventDefault();
	var url=this.href;
	
	$('.nav a.current').removeClass('current');
	$(this).addClass('current');
	
	$('#container').remove();
	$('#content').load(url+' #content').hide().fadeIn('slow');
});*/