<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
<meta charset="UTF-8">
<base href="<?php echo base_url(); ?>" />
<title>MayStudio - Index</title>
<?php  foreach ($css as $value) {  ?>
      <link rel="stylesheet" href="css/<?php echo $value ?>.css" />
<?php } ?>
<!-- <link rel="stylesheet" href="css/style.css" />
<link rel="stylesheet" href="css/index.css" /> -->
</head>
<body>
<div id="page">
  	<div class="header">
    		<div id="login-nav"><a href="javascript:void(0)" id="login">登录</a>／<a href="signup.html" >注册</a></div>
		<ul class="nav">
        			<li><a href="<?php echo base_url(); ?>index.php/maystudio/index" class="current"><img class="logo" src="images/logo.png" alt="MayStudio logo" height="47" width="230" />首页</a></li>
            			<li><a href="stories.html">故事</a></li>
            			<li><a href="msgboard.html">留言</a></li>
            			<li><a href="games.html">游戏</a></li>
           			<li><a href="shopping.html">代购</a></li>
         	</ul>   
         	<div id="login-window">
    		       <form method="post" action="">
        			<label for="username">用户：</label>
            			<input type="text" id="username" name="username" /><br />
            			<label for="password">密码：</label>
            			<input type="password" id="password" name="password" /><br />
            			<input type="submit" id="login-submit" name="login" /><br />
            			<a class="signup" href="signup.html">注册新用户</a>
        	       </form>
    	       </div>
    	</div>
