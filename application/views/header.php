<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
<meta charset="UTF-8">
<base href="<?php echo base_url(); ?>" />
<title>MayStudio - Index</title>
<link rel="stylesheet" href="css/style.css" />
</head>

<body>
<div id="page">
  	<div class="header">
        <ul class="nav">
        	<li><a href="<?php echo base_url(); ?>index.php/maystudio/index" <?php if($current=="index") echo 'class="current"' ?>><img class="logo" src="images/logo.png" alt="MayStudio logo" height="47" width="230" />首页</a></li>
            <li><a href="<?php echo base_url(); ?>index.php/maystudio/stories" <?php if($current=="stories") echo 'class="current"' ?>>故事</a></li>
            <li><a href="<?php echo base_url(); ?>index.php/msgboard/index" <?php if($current=="msgboard") echo 'class="current"' ?>>留言</a></li>
            <li><a href="<?php echo base_url(); ?>index.php/maystudio/game" <?php if($current=="game") echo 'class="current"' ?>>游戏</a></li>
            <li id="login-nav">
            <?php if($this->session->id)
                        {?>
                            <a >您好！<?php echo $this->session->username?></a>
                            /
                            <a href="<?php echo base_url(); ?>index.php/login/signout">退出</a>
            <?php } 
                         else
                        {  ?>
                            <a id="login">登录</a>
                            ／
                            <a href="<?php echo base_url(); ?>index.php/login/signup" >注册</a>
                        <?php } ?>
            	
                
            </li>
            </ul>   
         <div id="login-window">
    	<!-- <form method="post" action=""> -->
         <script>      //登入ajax验证
                    function showMessage(value)
                    {
                            var url=$('base').attr('href')+"index.php/login/check_username";
                            $.ajax({
                                url: url,
                                type: 'POST',
                                data: {username: value},
                            })
                            .done(function(return_data) {
                                if(return_data==0)
                                {
                                    $('#append').css({
                                        "padding": 0,
                                        "margin": 0,
                                        "color":"red",
                                        "font-size":10,
                                        "height":20
                                    });
                                    $('#append').html("用户名不存在");
                                }
                                else
                                {
                                    $('#append').html(' ');
                                }
                                console.log(return_data);
                            })
                            .fail(function() {
                                console.log("error");
                            })
                            .always(function() {
                                console.log("complete");
                            });
                    }

                    function check()
                    {
                        var url=$('base').attr('href')+"index.php/login/signin";
                        $.ajax({
                            url: url,
                            type: 'POST',
                            data: {username: $('#username').val(),
                                        password:$('#password').val()
                            }
                        })
                        .done(function(return_data) {
                            console.log(return_data);
                            console.log($('#username').val());
                            if(return_data==0)
                            {
                                alert("用户名不存在");
                            }
                            else if(return_data==1)
                            {
                                alert("密码错误");
                            }
                            else
                            {
                                window.location=$('base').attr('href')+"index.php/maystudio/index";
                            }
                            
                        })
                        .fail(function() {
                            console.log("error");
                        })
                        .always(function() {
                            console.log("complete");
                        });
                        
                    }
              </script>
              <?php echo form_open("login/signin",array('id'=>'signin_form')) ?>
        	   <label for="username">用户：</label>
            	   <input type="text" id="username" name="username" onkeyup="showMessage(this.value)" /><br />
                   <p id="append"></p>
            	   <label for="password">密码：</label>
            	   <input type="password" id="password" name="password" /><br />
            	   <input type="button" id="login_submit" name="login" onclick="check()" value="登录"/><br />
            	   <a class="signup" href="<?php echo base_url(); ?>index.php/login/signup">注册新用户</a>
        	</form>
        </div>
    </div>