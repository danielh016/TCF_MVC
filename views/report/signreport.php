<div class="col-md-12 col-xs-12">
    <form class="form-horizontal" action="<?=base_url().'Report/add/'.$aid?>" method="post">
        <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">文章編號</label>
            <div class="col-sm-10">
                <p class="form-control-static"><?=$aid?></p>
            </div>
        </div>
        <div class="form-group">
            <label for="report_reason" class="col-sm-2 control-label">檢舉原因</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="report_reason" id="report_reason" placeholder="...">
            </div>
        </div>
        <div class="form-group">
            <label for="report_content" class="col-sm-2 control-label">詳細描述</label>
            <div class="col-sm-10">
                <textarea class="form-control" rows="3" name="report_content" id="report_content"></textarea>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-danger">送出</button>
            </div>
        </div>
    </form>
</div>
