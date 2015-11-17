<!DOCTYPE html>
<HTML lang="en">

<HEAD>
    <TITLE><?php if(isset($topicname)) echo($topicname.' - ');?>TC Sharing 提攜分享</TITLE>
    <link href="http://tcincubator.com/lib/index.ico" rel="SHORTCUT ICON">

    <link rel="stylesheet" src="//normalize-css.googlecode.com/svn/trunk/normalize.css" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-social/4.10.1/bootstrap-social.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.6.16/summernote.min.css" />

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <!--<meta name="viewport" content="width=device-width, initial-scale=1">-->
    <meta name="viewport"content="width=600"/> 
    <meta name="description" content="提攜分享，正在分享你的新觀點">
    <meta property="og:title" content="<?php if(isset($topicname)) echo($topicname);?>" />
    <meta property="og:site_name" content="TC Sharing 提攜分享"/>
    <meta property="og:url" content="<?='http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']?>" />
    <meta property="fb:app_id" content="1659205097631179" />
    <meta property="og:type" content="article" />
    <meta property="og:locale" content="zh_TW" />
    <meta property="og:image" content="<?php if(isset($photo_metadata)) echo($photo_metadata);?>"/>

    <script>
        window.fbAsyncInit = function() {
            FB.init({
                appId      : '1659205097631179',
                xfbml      : true,
                version    : 'v2.4'
            });
        };

        (function(d, s, id){
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) {return;}
            js = d.createElement(s); js.id = id;
            js.src = "//connect.facebook.net/zh_TW/sdk.js#xfbml=1&version=v2.5&appId=1659205097631179";
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));
    </script>

    <script>
    $(document).ready(function() {
        $('body').scrollspy({ target: '#scrollspy' });


        $(".category_switch").click(function() {
            if(  $('.category_bar').css('display') == 'block' )
                $('.category_bar').css('display', 'none');
            else
                $('.category_bar').css('display', 'block');
        });

        function open_login_dialog(){
            $('#myModal').modal('show');
        }
        <?php if( $_SESSION['authstat'] == FALSE ){
                //沒有登入，則輸出這段程式碼，藉以啟用open_login_dialog()，在三分鐘後打開登入對話框。
                echo('setTimeout(function(){ open_login_dialog(); },90000);');
            }
        ?>
    });
    </script>
    <style>
    /*
    
        OVERRIDE

     */
    .row>* {
        border-bottom: 1px gray solid;
        padding-bottom: 10px;
        padding-top: 10px;
    }
    .form-control {
        border-radius: none;
        border-color: gray;
    }
    form *{
        font-family: "Times New Roman";
    }
    
    .btn-default {
        background-image: none;
        border-color: gray;
    }
    ul.navbar-nav {
        text-align: center;
        width: 100%;
    }
    .navbar {
        border-radius: 0px !important;
    }
    ul.navbar-nav>li>a {
        color: gray;
        height: 65px;
        display: inline-block;
        vertical-align: middle;
    }


    .carousel-control.right, .carousel-control.left {
        background-image: none;
    }
    .carousel-inner .item{
        height: 300px;
        width: 100%;
    }
    .carousel-caption p{
        color: white;
        font-size: 32px;
        font-weight: bold;
        text-shadow: 2px 2px black;
    }
    .carousel-caption a{
        color: white;
    }


    /*
    
        SELF

     */
    * {

        font-family: "Microsoft JhengHei","Times New Roman", "Georgia", "Serif";
    }
    /*global*/
    .blur {
        position: absolute;
        background-size: cover;
        background-repeat:no-repeat;
        background-position: 50% 50%; 
        height: 100%;
        z-index: -1;
    }
    /*global*/
    .spread{
        position: absolute;
        background-size: initial;
        background-repeat: repeat;
        background-position: 50% 50%;
        height: 100%;
        z-index: -1;
    }
    /*global*/
    .none_padding{
        padding-left: 0;
        padding-right: 0;
    }
    /*global*/
    .overflow-wrap{
        word-wrap: break-word;
    }
    /*global*/
    .overflow-ellipsis {
        overflow : hidden;
        text-overflow : ellipsis;
        white-space : nowrap;
    }
    /*global*/
    .flip {
        position:absolute;
        backface-visibility: hidden;
        transition: transform .5s linear .1s;
    }
    .logo a{
        padding: 0px !important;
    }
    .logo h1{
        display: inline-block;
        margin: 0px !important;
    }
    .logo h1:nth-of-type(1){
        background-color: rgb(43, 147, 209) !important;
        border: 1px gray solid;
        border-radius: 3px;
        color: white;
        padding: 3px;
        width: 60px;
    }
    .logo h1:nth-of-type(2){
        color: rgb(43, 147, 209);
    }
    img.user-img{
        position: relative;
        max-width: 28px;
        max-height: 28px;
    }
    img.logo-img{
        position: relative;
        max-height: 40px;
    }
    div.category_bar{
        display: none;
    }
    .category_bar .search_bar{
        margin-right: 10px;
    }
    .category_tag{
        background-color: #CCC;
        line-height: 200%;
        padding: 2px 10px;
    }
    div.topics_icon{
        position: relative;
        border: 2px gray solid;
        border-radius: 5px;
        color: gray;
        display: table;
    }
    .topics_icon h1,
    .topics_icon h2,
    .topics_icon h3,
    .topics_icon h4,
    .topics_icon h5,
    .topics_icon h6 {
        display: table-cell;
        vertical-align: middle;
        text-align: center;
        padding-top: 50%;
        padding-bottom: 50%;
    }
    div.topics_item {
        border-left: 1px gray solid;
        border-right: 1px gray solid;
        border-radius: 5px;
        color: gray;
        margin-bottom: 20px;
        min-height: 36px;
        overflow: hidden;
    }
    .topics_item h1,
    .topics_item h2,
    .topics_item h3,
    .topics_item h4,
    .topics_item h5,
    .topics_item h6{
        margin-top: 0;
        margin-bottom: 0;
    }
    .topics_item:hover img{
        transform: perspective( 600px ) rotateY( -180deg );
    }
    .topics_item:hover .topics_photo_back{
        transform: perspective( 600px ) rotateY( 0deg );
    }
    .topics_photo>*{
        min-height: 18px;
        max-height: 36px;
        min-width: 32px;
        max-width: 64px;
    }
    .topics_photo>img{
        transform: perspective( 600px ) rotateY( 0deg );
    }
    .topics_photo_back{
        border: 1px gray dotted;
        transform: perspective( 600px ) rotateY( 180deg );
    }
    .topics_photo_back>img{
        transform: perspective( 600px ) rotateY( 180deg );
    }
    .search-nav {
        padding: 5px;
        border: 1px rgb(43, 147, 209) solid;
        border-radius: 10px;
        color: rgb(43, 147, 209);
    }
    div.articles * {
        position: relative;
    }
    .article_bar h1,
    .article_bar h2,
    .article_bar h3,
    .article_bar h4,
    .article_bar h5,
    .article_bar h6{
        margin-top: 0;
        margin-bottom: 0;
    }
    .article_title {
        min-height: 50px;
        margin-bottom: 15px;
    }
    .article_photo {
        position: relative;
        background-size: 100% auto;
        height: 200px;
    }
    .article_photo+h1 {
        position: absolute;
        background-color: rgba(20,20,20,0.5);
        border-top-right-radius: 5px;
        border-bottom-right-radius: 5px;
        color: white;
        filter: blur(0px) !important;
        padding: 3px;
        top: 5%;
    }
    div.article_scrollspy {
        position: -webkit-sticky;
        position: -moz-sticky;
        position: -ms-sticky;
        position: -o-sticky;
        position: sticky;
        border-bottom: none;
        top: 0px;
    }
    .article_scrollspy li {
        border-right: 2px rgb(43, 147, 209) dashed;
        height: 55px;
        width: 80px;
    }
    .article_scrollspy li.active {
        border-right-style: solid;
    }
    .article_scrollspy li a{
        color: rgb(43, 147, 209);
        padding: 10px;
    }
    .article_bar_author {
        position: -webkit-sticky;
        position: -moz-sticky;
        position: -ms-sticky;
        position: -o-sticky;
        position: sticky;
        border: 1px rgb(43, 147, 209) solid;
        border-radius: 5px;
        color: rgb(43, 147, 209);
        padding: 5px;
    }
    .article_bar_author img{
        max-height: 100%;
        max-width: 100%;
    }
    .article_bar_info{
        border-bottom: 1px gray dotted;
        color: gray;
    }
    .article_bar_content {
        font-size: 20px;
        line-height: 250%;
        padding-top: 15px;
        padding-bottom: 15px;
    }
    .article_bar_content * {
        max-width: 100%
    }
    div.user_profile>* {
        border-radius: 10px;
        border: 1px gray solid;
        margin: 5px;
    }
    .user_profile_photo img{
        width: 100%;
    }
    .user_profile_photo, .user_profile_info {
        max-height: 250px;
        padding: 5px;
    }
    .user_profile_articles {
        overflow : hidden;
        text-overflow : ellipsis;
        white-space : nowrap;
    }
    .editor{
        border: 1px solid #CCC;
        box-shadow: 0 0 10px #CCC;
        padding: 10px;
    }
    .editor .form-control{
        border: 1px solid #CCC;
    }
    .editor textarea, .editor iframe{
        border: 1px solid gray;
        border-radius: 3px;
        min-height: 400px;
        width: 100%;
    }
    .info>*{
        margin-bottom: 5px;
    }
    </style>
</HEAD>

<BODY data-spy="scroll"  data-target="#scrollspy" data-offset="100">
<script>
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
    (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
    m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
    
    ga('create', 'UA-70018615-1', 'auto');
    ga('send', 'pageview');

</script>
<div class="container-fluid">
    <div class="hidden-xs hidden-sm col-md-1 col-lg-2">
    </div>
    <div class="col-xs-12 col-sm-11 col-md-10 col-lg-8">
        <div class="row">
            <nav class="navbar" role="navigation">
                <div class="container-fluid">
                    <div>
                        <ul class="nav navbar-nav">
                            <!--<li class="pull-left hidden-xs logo">-->
                            <li class="pull-left img">
                                <a href="<?php echo base_url();?>">
                                    <!--
                                    <h1>TC</h1>
                                    <h1>Incubator</h1>
                                    -->
                                    <img src="<?='http://'.$_SERVER['HTTP_HOST']?>/user_image/TC_slogo.png" alt="" class="logo-img">
                                </a>
                            </li>
                            
                            <li class="pull-left">
                                <a href="#" class="category_switch"><h5><span class="glyphicon glyphicon-tag" aria-hidden="true"></span> 分類討論<span class="caret"></span></h5></a>
                            </li>
                            <li class="pull-left">
                                <?php echo ('<a href="'.base_url().'Topics"><h5>#所有文章</h5></a>');?>
                            </li>
                            <li class="pull-left hidden-xs">
                                <?php if( $_SESSION['authstat'] == TRUE ){
                                        echo('<a href="'.base_url().'Topics/tag/?q=newhand'.'" class=""><h5>#新手報到</h5></a>');
                                    }
                                ?>
                            </li>
                            <li class="pull-left hidden-xs">
                                <?php if( $_SESSION['authstat'] == TRUE ){
                                        echo('<a href="'.base_url().'Topics/tag/?q=bugreport'.'" class=""><h5>#Bug回報</h5></a>');
                                    }
                                ?>
                            </li>
                            <li class="pull-right">
                                <?php if( $_SESSION['authstat'] == FALSE ){
                                        echo('<a href="'.base_url().'Auth/Signin'.'" class=""><h5><span class="glyphicon glyphicon-log-in" aria-hidden="true"></span> 登入/註冊</h5></a>');
                                    }
                                ?>
                            </li>
                            <li class="pull-right dropdown">
                                <?php if( $_SESSION['authstat'] == TRUE ){
                                    echo('<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">');

                                    if( $_SESSION['photo_addr'] == TRUE ){
                                        //有照片
                                        echo('<img class="user-img img-rounded" src="'.$_SESSION['photo_addr'].'"></img>'.$_SESSION['username']);
                                        echo('<span class="caret"></span>');
                                    }
                                    else{
                                        //沒照片
                                        echo('<h5><span class="glyphicon glyphicon-user" aria-hidden="true"></span>'.$_SESSION['username'].'</h5>');
                                        echo('<span class="caret"></span>');
                                    }
                                    echo('</a>');
                                    }
                                ?>
                                <ul class="dropdown-menu overflow-wrap">
                                    <!-- 下拉式選單裡的內容 -->
                                    <?php if( $_SESSION['authstat'] ){
                                        echo('<li><a href="'.base_url().'User/'.$_SESSION['uid'].'"><span class="glyphicon glyphicon-user" aria-hidden="true"></span>個人頁面</a></li>');
                                        echo('<li><a href="'.base_url().'User/edit/'.$_SESSION['uid'].'"><span class="glyphicon glyphicon-wrench" aria-hidden="true"></span>編輯個人資料</a></li>');
                                        echo('<li role="separator" class="divider"></li>');
                                        echo('<li><a href="'.base_url().'Signout"><span class="glyphicon glyphicon-log-out" aria-hidden="true"></span> 登出</a></li>');
                                    }
                                    ?>
                                </ul>
                            </li>
                            <li class="pull-right">
                                <?php if( $_SESSION['authstat'] == TRUE ){
                                        echo('<a href="'.base_url().'Article/add'.'" class=""><h6><span class="glyphicon glyphicon-plus" aria-hidden="true"></span>發表</h6></a>');
                                    }
                                ?>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
            <div class="col-md-12 col-xs-12 category_bar">
                <div class="col-md-12 col-xs-12 none_padding category_tag_bar overflow-wrap">
                    <div class="col-md-3 col-xs-12 none_padding pull-left search_bar input-group input-group-sm">
                        <form id="search-form">
                            <input type="text" name="q" class="form-control search_input" placeholder="搜尋文章...">
                        </form>
                        <div class="btn-group btn-group-sm" role="group" aria-label="...">
                            <button type="submit" form="search-form" formaction="<?=base_url().'Topics/topicname/'?>" formmethod="post" class="btn btn-default search_button">自標題</button>
                            <button type="submit" form="search-form" formaction="<?=base_url().'Topics/tag/'?>" formmethod="post" class="btn btn-default search_button">自分類</button>
                            <button type="submit" form="search-form" formaction="<?=base_url().'Topics/username/'?>" formmethod="post" class="btn btn-default search_button">自原PO</button>
                        </div>
                    </div>
                    <span class="category_tag category_hot overflow-wrap"><a href="<?=(base_url().'Topics/hot')?>"><i class="fa fa-fire"></i>熱門文章</a></span>
                    <span class="category_tag category_latest overflow-wrap"><a href="<?=(base_url().'Topics/latest')?>"><i class="fa fa-clock-o"></i>最新文章</a></span>
                    <?php foreach($tags as $row): ?>
                        <span class="category_tag overflow-wrap"><a href="<?=(base_url().'Topics/tag/0/10?encoding=b64&q='.base64_encode(str_replace(' ', '-', $row->tag)))?>"><?=$row->tag?></a></span>
                    <?php endforeach;?>
                </div>
            </div>