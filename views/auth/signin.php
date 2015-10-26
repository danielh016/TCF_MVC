<div class="col-md-12 col-xs-12 article_list">
    <div class="col-md-7">
        <div class="col-md-1">
        </div>
        <div class="col-md-8">
        	<h1>現在就登入</h1>
            <hr>
            <?=$_SESSION['fb_login_button']?><br>
            <h4>或者</h4>
        	<form action="<?=base_url().'Auth/typical'?>" method="post" id="signin">
            	<div class="form-group">
            	    <label for="signin_email">電子信箱</label>
            	    <input id="signin_email" name="signin_email" type="email" class="form-control" placeholder="sample@gmail.com" required>
            	</div>
            	<div class="form-group">
            	    <label for="signin_password">密碼</label>
            	    <input id="signin_password" name="signin_password" type="password" class="form-control" placeholder="˙˙˙˙˙˙˙" required>
            	</div>
				<input type="submit"  class="btn btn-success btn-block" value="登入">
        	</form>
            <hr>
        </div>
        <div class="col-md-3">
        </div>
    </div>
    <div class="col-md-5">
        <h1>或註冊新帳號</h1>
        <hr>
        <form class="form-horizontal" action="<?=base_url().'Auth/do/signup'?>" method="post" id="signup">
        	<div class="form-group">
                <label for="signup_username" class="col-sm-2 control-label">姓名</label>
                <div class="col-sm-10">
                	<input id="signup_username" name="signup_username" type="text" class="form-control" placeholder="TCer" required>
                </div>
            </div>
            <div class="form-group">
                <label for="signup_email" class="col-sm-2 control-label">電子信箱</label>
                <div class="col-sm-10">
                	<input id="signup_email" name="signup_email" type="email" class="form-control" placeholder="sample@gmail.com" required>
                </div>
            </div>
            <div class="form-group">
                <label for="signup_password" class="col-sm-2 control-label">密碼</label>
                <div class="col-sm-10">
                	<input id="signup_password" name="signup_password" type="password" class="form-control" placeholder="至少 8位的密碼" required>
                </div>
            </div>
			<hr>
			<div class="form-group">
                <label for="signup_photo_addr" class="col-sm-2 control-label">個人照片</label>
                <div class="col-sm-10">
                	<input id="signup_photo_addr" name="signup_photo_addr" type="url" class="form-control" placeholder="http://i.imgur.com/mX3OJ8j.jpg">
                </div>
            </div>
            <div class="form-group">
                <label for="signup_password" class="col-sm-2 control-label">自我介紹</label>
                <div class="col-sm-10">
                	<textarea id="signup_introducing" name="signup_introducing" class="form-control" rows="4" wrap="hard"></textarea>
                </div>
            </div>
            <div class="form-group">
				<div class="col-sm-offset-2 col-sm-10">
					<input type="submit" class="btn btn-danger btn-block" value="註冊">
				</div>
			</div>
        </form>
    </div>
</div>
