<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>MayStudio Administration</title>
<base href="<?php echo base_url(); ?>">
<link rel="stylesheet" href="css/admin.css">
</head>

<body>
	<div id="header">
    	<img src="images/logo.png" alt="logo">
        <h2>Administration</h2>
    </div>
	<div id="nav">
    	
    	<ul>
        	<li id="nav-users" class="active"><a href="#users">用户</a></li>
        	<li id="nav-index"><a href="#index">首页</a></li>
        	<li id="nav-stories"><a href="#stories">故事</a></li>
            <li id="nav-msgboard"><a href="#msgboard">留言</a></li>
            <li id="nav-game"><a href="#game">游戏</a></li>
            <li id="nav-shopping"><a href="#shopping">代购</a></li>
        </ul>
    </div>
    <div id="content">
    	
        <div id="users" class="admin-content">
        	<h3>用户管理</h3>
            <table>
            	<tr>
                	<th>ID</th>
                	<th>Username</th>
                	<th>Operation</th>
                </tr>
                <tr>
                	<td>00000</td>
                    <td>MMMayC</td>
                    <td><a href="">Delete</a> <a href="">Blacklist</a> <a href="">Elevation</a></td>
                </tr>
                <tr>
                	<td>00000</td>
                    <td>MMMayC</td>
                    <td><a href="">Delete</a> <a href="">Blacklist</a> <a href="">Elevation</a></td>
                </tr>
                <tr>
                	<td>00000</td>
                    <td>MMMayC</td>
                    <td><a href="">Delete</a> <a href="">Blacklist</a> <a href="">Elevation</a></td>
                </tr>
                <tr>
                	<td>00000</td>
                    <td>MMMayC</td>
                    <td><a href="">Delete</a> <a href="">Blacklist</a> <a href="">Elevation</a></td>
                </tr>
            </table>
        </div>
    	
        <div id="index" class="admin-content">
        	<h3>首页管理</h3>
            <form>
            	<label for="index-pic">更改首页图片</label>
                <input type="file" id="index-pic" name="index-pic"><br />
                <input type="submit" id="index-submit" name="index-submit" value="更改">
            </form>
        </div>
        
        <div id="stories" class="admin-content">
        	<h3>故事管理</h3>
            <p><strong>发布漫画</strong></p>
        	<?php echo form_open_multipart('admin/upload'); ?>
            <?php if (isset($error)): ?>
                        <p><?php echo $error ?></p>
            <?php endif ?>
            	<label for="sto-title">标题</label>
                <input type="text" id="sto-title" name="sto-title"><br />
                <label for="cartoon-pic">内容</label>
                <input type="file" id="cartoon-pic" name="cartoon_pic" ><br />
                <input type="submit" id="new-sto-submit" name="new-sto-submit" value="发布">
            </form>
            <p><strong>管理漫画<strong></p>
            <table>
            	<tr>
                	<th>Title</th>
                    <th>Publish Date</th>
                    <th>Operation</th>
                </tr>
                <tr>
                	<td>XXXXXXXXXX</td>
                    <td>13/03/2016</td>
                    <td><a href="">Delete</a> <a href="">Top</a></td>
                </tr>
                <tr>
                	<td>XXXXXXXXXX</td>
                    <td>13/03/2016</td>
                    <td><a href="">Delete</a> <a href="">Top</a></td>
                </tr>
                <tr>
                	<td>XXXXXXXXXX</td>
                    <td>13/03/2016</td>
                    <td><a href="">Delete</a> <a href="">Top</a></td>
                </tr>
                <tr>
                	<td>XXXXXXXXXX</td>
                    <td>13/03/2016</td>
                    <td><a href="">Delete</a> <a href="">Top</a></td>
                </tr>
            </table>
        </div>
        
        <div id="msgboard" class="admin-content">
        	<h3>留言管理</h3>
            <table>
            	<tr>
                	<th>User</th>
                    <th>Message</th>
                    <th>Operation</th>
                </tr>
                <tr>
                	<td>XXXXX</td>
                    <td>XXXXX</td>
                    <td><a href="">Delete</a> <a href="">Top</a></td>
                </tr>
                <tr>
                	<td>XXXXX</td>
                    <td>XXXXX</td>
                    <td><a href="">Delete</a> <a href="">Top</a></td>
                </tr>
                <tr>
                	<td>XXXXX</td>
                    <td>XXXXX</td>
                    <td><a href="">Delete</a> <a href="">Top</a></td>
                </tr>
                <tr>
                	<td>XXXXX</td>
                    <td>XXXXX</td>
                    <td><a href="">Delete</a> <a href="">Top</a></td>
                </tr>
            </table>
        </div>
        
        <div id="game" class="admin-content">
        	<h3>游戏管理</h3>
        </div>
        
        <div id="shopping" class="admin-content">
        	<h3>代购管理</h3>
        </div>
    </div>
    <script src="js/jquery-1.11.0.min.js"></script>
    <script src="js/admin.js"></script>
</body>
</html>
