				<div class="col-md-12 col-sm-12 col-xs-12">
				    <div class="col-md-8 col-sm-8 col-xs-12">
					    <div class="fb-page" data-href="https://www.facebook.com/TCincubator.page" data-small-header="true" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="false" data-show-posts="false">
                            <div class="fb-xfbml-parse-ignore">
                                <blockquote cite="https://www.facebook.com/TCincubator.page">
                                    <a href="https://www.facebook.com/TCincubator.page">TC Incubator 提攜 孵化</a>
                                </blockquote>
                            </div>
                        </div>
				    </div>
				    <div class="col-md-4 col-sm-4 col-xs-12">
                        <p>Powered by &copy; Yves Liou & H.Y.Hu, 2015</p>
                        <!--
                        <p> Thanks <a href="http://www.toripantha.com/">Tori Pantha</a>.</p>
                        <p> Thanks <a href="http://stackoverflow.com/">StackOverflow</a>.</p>
                        -->
                    </div>
				</div>
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
                    <!-- TCKK -->
                    <ins class="adsbygoogle"
                         style="display:block"
                         data-ad-client="ca-pub-1566520964413832"
                         data-ad-slot="1437331304"
                         data-ad-format="auto"></ins>
                    <script>
                    (adsbygoogle = window.adsbygoogle || []).push({});
                    </script>
                </div>
			</div><!-- row -->
        </div><!-- col-xs-12 col-sm-10 col-md-8 col-lg-8 -->
        <div class="hidden-xs hidden-sm col-md-1 col-lg-2">
        </div>
    </div>

<div class="modal-dialog modal-xs" id="ask-to-login-dialog">
    <div id="myModal" class="modal modal-xs fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">現在就登入TC Incubator跟我們一起討論吧！</h4>
                </div>
                <div class="modal-body">
                    <?=$_SESSION['fb_login_button']?><br>
                    <h4>或者</h4>
                    <hr>
                    <form action="<?=base_url().'Auth/typical'?>" method="post" id="signin">
                        <div class="form-group">
                            <label for="signin_email">電子信箱</label>
                            <input id="signin_email" name="signin_email" type="email" class="form-control" placeholder="sample@gmail.com" required>
                        </div>
                        <div class="form-group">
                            <label for="signin_password">密碼</label>
                            <input id="signin_password" name="signin_password" type="password" class="form-control" placeholder="˙˙˙˙˙˙˙" required>
                        </div>
                        <input type="submit" class="btn btn-success btn-block" value="登入">
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>
</BODY>

</HTML>
