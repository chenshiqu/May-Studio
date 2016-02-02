// JavaScript Document
(function(){
  var $content = $('#show-portfolio').detach();   // Remove modal from page

  $('#open-portfolio').on('click', function() {           // Click handler to open modal
    modal.open({content: $content, width:400, height:600});
	var request;     
	
	                   
var $current;                        
var cache = {};                     
var $frame=$('#show-post');
var $thumbs=$('.thumb');
            
function crossfade($img) {           
                                     
  if ($current) {                    
    $current.stop().fadeOut('slow'); 
  }

  $img.css({                         
    marginLeft: -$img.width() / 2,  
    marginTop: -$img.height() / 2    
  });

  $img.stop().fadeTo('slow', 1);     
  
  $current = $img;                   
}

$(document).on('click', '.thumb', function(e){ 
  var $img,                              
      src = this.href;                    
      request = src;                     
  
  e.preventDefault();                    
  
  $thumbs.removeClass('active');          
  $(this).addClass('active');            

  if (cache.hasOwnProperty(src)) {        
    if (cache[src].isLoading === false) { 
      crossfade(cache[src].$img);         
    }
  } else {                                
    $img = $('<img/>');                   
    cache[src] = {                       
      $img: $img,                         
      isLoading: true                     
    };


    $img.on('load', function(){           
      $img.hide();                        
      
      $frame.removeClass('is-loading').append($img);
      cache[src].isLoading = false;       
     
      if (request === src) {
        crossfade($img);                  
      }                                 
    });

    $frame.addClass('is-loading');       

    $img.attr({                          
      'src': src,                         
      'alt': this.title || ''             
    });

  }

});


$('.thumb').eq(0).click();          
  });
}());