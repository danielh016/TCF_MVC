<div class="col-md-12 col-xs-12 editor">
    <div class="col-md-12 col-xs-12">
        <?php
            if( $mode == 'add' )
                echo('<div class="col-md-12 col-xs-12"><p class="bg-warning" style="padding:10px">發表新的文章時請記得每一項都要輸入</p></div>');
            if( $mode == 'reply' )
                echo('<div class="col-md-12 col-xs-12"><p class="bg-warning" style="padding:10px;">發表回應時請記得輸入內容</p></div>');
            if( $mode == 'edit' )
                echo('<div class="col-md-12 col-xs-12"><p class="bg-warning" style="padding:10px;">編輯時請記得輸入內容</p></div>');
        ?>
        <div class="col-md-10 col-xs-10 info">
            <label for="article_topicname" class="col-sm-2 control-label">標題</label>
            <div class="col-sm-10">
                <input class="form-control" type="text" id="article_topicname" placeholder="標題" value="<?php if(isset($topicname)) echo $topicname; ?>">
            </div>

            <label for="article_tag" class="col-sm-2 control-label">分類</label>
            <div class="col-sm-10">
                <!--<input class="form-control" type="text" id="article_tag" placeholder="分類" value="<?php if(isset($tag)) echo $tag; ?>">-->
                <select id="article_tag">   <!--創業/學習/趨勢/策略/管理/資源/設計/教育/介紹/品牌/故事/Code/工程師/商業模式/創業家精神/行銷-->
                    <option value="創業">創業</option>
                    <option value="策略">策略</option>
                    <option value="設計">設計</option>
                    <option value="管理">管理</option>
                    <option value="學習">學習</option>
                    <option value="教育">教育</option>
                    <option value="趨勢">趨勢</option>
                    <option value="資源">資源</option>
                    <option value="介紹">介紹</option>
                    <option value="品牌">品牌</option>
                    <option value="故事">故事</option>
                    <option value="code">Code</option>
                    <option value="工程師">工程師</option>
                    <option value="商業模式">商業模式</option>
                    <option value="創業家精神">創業家精神</option>
                    <option value="行銷">行銷</option>
                    <option value="其他">其他</option>
                </select>
            </div>

            <label for="article_photo_addr" class="col-sm-2 control-label">封面圖片網址</label>
            <div class="col-sm-10">
                <input class="form-control input-sm" type="url" id="article_photo_addr" placeholder="封面圖片網址" value="<?php if(isset($photo_addr)) echo $photo_addr;?>">
            </div>
        </div>


        <div class="col-md-2 col-xs-2 pull-right">
            <button type="submit" class="btn btn-success" id="article_editor_button">送出</button>
        </div>
        <br>
        <div class="col-md-2 col-xs-2 pull-right">
            <p>匿名</p>
            <select id="article_ano">
                <option value="0">否</option>
                <option value="1">是</option>
            </select>
        </div>


        <div class="col-md-10 col-xs-10 admin_bar <?php if((int)$_SESSION['rid']!=4) echo('sr-only'); ?> ">
            <div class="col-md-12 col-xs-12"><p class="bg-warning" style="padding:10px;">格式為：YYYY-MM-DD HH:MM:SS  格式不能錯!!</p></div>
            <label for="article_datepicker" class="col-sm-2 control-label">編輯時間</label>
            <div class="col-sm-3">
                <input class="form-control input-sm" type="datetime" id="article_datepicker" placeholder="ex: 2015-10-19 12:47:41" value="<?php if(isset($edit_time)) echo $edit_time;?>">
            </div>

            <label for="article_views" class="col-sm-2 control-label">瀏覽次數</label>
            <div class="col-sm-3">
                <input class="form-control input-sm" type="number" min="0" id="article_views" placeholder="瀏覽次數" value="<?php if(isset($views)) echo $views;?>">
            </div>
        </div>


    </div>
    <br>
    <hr>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="summernote"><?php if(isset($content)) echo $content; ?></div>
</div>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/horsey/2.6.1/horsey.min.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/horsey/2.6.1/horsey.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.6.16/summernote.min.js"></script>
<script src="../../../lib/summernote-zh-TW.js"></script>
<script>


$(document).ready(function() {
    /*horsey(document.querySelector('#article_tag'), {
        suggestions: [<?=$tags?>]
    });*/
    
    $('#summernote').summernote({
        height: 300,                 // set editor height

        minHeight: 300,             // set minimum height of editor
        maxHeight: 400,             // set maximum height of editor

        focus: true,                 // set focus to editable area after initializing summernote
        lang: 'zh-TW'               // default: 'en-US'
    });

    $('#article_editor_button').click(function(){
        $.ajax({
            url: "<?=$url?>",
            type: "post",
            dataType: "json",
            data: {
                article_topicname: $('#article_topicname').val(),
                article_tag: $('#article_tag').val(),
                article_photo_addr: $('#article_photo_addr').val(),
                article_content: $('#summernote').code(),
                article_edit_time: $('#article_datepicker').val(),
                article_views: $('#article_views').val(),
                article_ano: $('#article_ano').val()
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
