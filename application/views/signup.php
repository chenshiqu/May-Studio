    <div id="content" class="content-signup">
    <div id="container">
    	<div class="content-left">
        	<img src="images/permit.png" alt="maystudio permit" width="300" />
        </div>
        <div class="content-right">
              <?php echo form_open('login/signup_check','id="signup_form"'); ?>
        	<!-- <form id="signup_form"> -->
            	<h1>注册</h1>
                <p>
            	   <label  id="label_username" for="signup_username">用户名</label>
                <input type="text" id="signup_username" name="signup_username" />
                </p>
                <div id="username-feedback"></div>
                <p>
                <label id="label_password" for="signup_password">密码</label>
                <input type="password" id="signup_password" name="signup_password" />
                </p>
                <p>
                <label id="label_confirm_password" for="confirm_password">确认密码</label>
                <input type="password" id="confirm_password" name="confirm_password" />
                </p>
                <p>
                <label  id="label_email" for="signup_email">e-mail</label>
                <input type="text" id="signup_email" name="signup_email" />
                </p>
                <input type="submit" id="signup_submit" name="signup_submit" />
            </form>
        </div><?php if (isset($error)) { ?>
                    <script> alert("<?php echo $error ?>")</script>
        <?php  } ?>
    </div>
        
    </div>
