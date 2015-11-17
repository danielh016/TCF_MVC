<div class="col-md-12 col-xs-12 overflow-wrap article_title">
    <div class="article_photo blur col-md-12 col-xs-12" style="background-image: url('<?=$photo_addr?>');"></div>
    <h1><?=$topicname?></h1>
</div><!-- article_bar_title -->

<div class="col-md-12 col-xs-12 articles">

    <div class="col-md-12 col-xs-12 overflow-wrap article_bar">

        <div class="col-md-1 col-xs-1 pull-right article_scrollspy">
            <nav class="navbar" id="scrollspy">
                <ul class="nav navbar-nav">
                    <li><a href="javascript: void(window.open('http://www.facebook.com/share.php?u='.concat(encodeURIComponent(location.href)) ));"><i class="fa fa-facebook"></i><br>分享</a></li>
                    <li><a href="<?=base_url().'Article/reply/'.$articles[0]->aid?>"><span class="glyphicon glyphicon-comment" aria-hidden="true"></span><br>發表觀點</a></li>
                    <?php
                        for( $i=1; $i<=count($articles); $i++ ){
                            //echo('<li><a href="'.base_url().'Article/reply/'.$articles[0]->aid.'">'.'<span class="glyphicon glyphicon-comment" aria-hidden="true"></span>發表觀點'.'</a></li>');
                            //原本有"說話符號的"版本
                            echo('<li><a href="#'.$i.'">#'.$i.'</a></li>');
                        }
                    ?>
                    <li><a href="#FB_COMMENT">#FB</a></li>
                </ul>
            </nav>
        </div>


        <?php
            $i = 0;
        ?>

        <?php foreach ($articles as $row):  //大for迴圈開始?>
        
        <?php       //若不是匿名(條件開始)
            $ano = $row->ano;
            if($ano==0){
        ?>

        <div class="col-md-11 col-xs-11 article_bar_author" id="<?=++$i?>">
            <div class="col-md-1 col-xs-2">
                <?php
                    $check_photo = $row->user_photo_addr;
                    if($check_photo==NULL){
                ?>
                    <img src="../../user_image/TC_defaultuser.png" alt="" class="user-img img-rounded">
                <?php  }
                    else if($check_photo!=NULL){ 
                ?>
                    <img src="<?=$row->user_photo_addr?>" alt="" class="user-img img-rounded">
                <?php
                    }
                ?>
            </div>
            <div class="col-md-8 col-xs-6">
                <h3><?=$row->username?></h3>
                <h6></h6>
            </div>
            <div class="col-md-3 col-xs-4">
                <h6><?='文章總數 '.$row->num_topics?></h6>
                <h6><?='加入時間 '.$row->join_time?></h6>
            </div>
        </div><!-- article_bar_author -->
        <div class="col-md-11 col-xs-11 article_bar_info">
            <a href="<?=base_url().'Report/sign/'.$row->aid?>">
                <i class="fa fa-ban"></i>檢舉
            </a>
            <a href="<?=base_url().'Article/edit/'.$row->aid?>">
                <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>編輯文章
            </a>
            <div class="pull-right">
                <?=$row->edit_time?><span>　　</span>#<?=$i?>
            </div>
        </div><!-- article_bar_info -->

        <?php   } //若不是匿名(條件結束)
                else if ($ano==1){  //若為匿名(條件開始)
        ?>

            <div class="col-md-11 col-xs-11 article_bar_author" id="<?=++$i?>">
                <div class="col-md-1 col-xs-2">
                    <img src="../../user_image/TC_defaultuser.png" alt="" class="user-img img-rounded">
                </div>
                <div class="col-md-8 col-xs-6">
                    <h3>匿名</h3>
                    <h6></h6>
                </div>
                <div class="col-md-3 col-xs-4">
                    <h6>文章總數 N/A</h6>
                    <h6>加入時間 N/A</h6>
                </div>
            </div><!-- article_bar_author -->
            <div class="col-md-11 col-xs-11 article_bar_info">
                <a href="<?=base_url().'Report/sign/'.$row->aid?>">
                    <i class="fa fa-ban"></i>檢舉
                </a>
                <a href="<?=base_url().'Article/edit/'.$row->aid?>">
                    <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>編輯文章
                </a>
                <div class="pull-right">
                    <?=$row->edit_time?><span>　　</span>#<?=$i?>
                </div>
            </div><!-- article_bar_info -->
        <?php } //若為匿名(條件結束)?>
            <div class="col-md-11 col-xs-11 article_bar_content">
                <?=$row->content?><br>

                <br>
                <p style="color:gray ; font-size:10pt">TC Sharing部分文章由會員上刊，如有不適當或對於文章出處有疑慮，請以文章檢舉或Email告知我們，我們將在最短時間內進行撤除</p>
            </div><!-- article_bar_content -->

        <?php endforeach; //大for迴圈結束?>
    </div><!-- article_bar -->
</div>

<div class="col-md-12 col-xs-12" id="FB_COMMENT">
    <div class="fb-comments" data-href="<?=base_url().'Topic/'.$articles[0]->aid?>" data-numposts="5"></div>
</div>