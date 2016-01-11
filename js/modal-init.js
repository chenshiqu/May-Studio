//登录小窗口
(function(){
  var $content = $('#login-window').detach();   // Remove modal from page

  $('#login').on('click', function() {           // Click handler to open modal
    modal.open({content: $content, width:340, height:200});
  });
}());