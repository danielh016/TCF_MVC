<div class="col-md-12 col-xs-12 editor">
    <div class="col-md-12 col-xs-12 info">
        <div class="col-md-12 col-xs-12">
            <p class="bg-warning" style="padding:10px;">請記得至少要輸入姓名</p>
        </div>
        <div class="col-md-10 col-xs-10">
            <input class="form-control" type="text" id="profile_username" placeholder="姓名" value="<?php if(isset($username)) echo $username; ?>">
        </div>
        <div class="col-md-2 col-xs-2">
            <button type="submit" class="btn btn-success" id="profile_button">送出</button>
        </div>
        <hr>
        <div class="col-md-10 col-xs-10">
            <input class="form-control input-sm" type="url" id="profile_photo_addr" placeholder="照片網址" value="<?php if(isset($photo_addr)) echo $photo_addr;?>">
        </div>
    </div>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 center-block" id="summernote">
        <?php if(isset($introducing)) echo $introducing; ?>
    </div>
</div>




<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.6.16/summernote.min.js"></script>
<script src="../../../lib/summernote-zh-TW.js"></script>
<script>

$(document).ready(function() {
    $('#summernote').summernote({
        height: 300,                 // set editor height

        minHeight: 300,             // set minimum height of editor
        maxHeight: 400,             // set maximum height of editor

        focus: true,                 // set focus to editable area after initializing summernote
        lang: 'zh-TW'               // default: 'en-US'
    });

    $('#profile_button').click(function(){
        var profile_username = $('#profile_username').val();
        //var profile_email = $('#profile_email').val();
        var profile_photo_addr = $('#profile_photo_addr').val();
        var profile_introducing = $('#summernote').code();

        $.ajax({
            url: "<?=$url?>",
            type: "post",
            dataType: "json",
            data: {
                profile_username: profile_username,
                profile_photo_addr: profile_photo_addr,
                profile_introducing: profile_introducing
            },
            success: function(response){
                if( response.redirect_url ){
                    window.location.href = response.redirect_url;
                }
                else{
                    $("body").replaceWith(response);
                }
            },
            timeout: function(){
                window.location.href = "<?=base_url().'error'?>";
            }
        });
    });
});
</script>
