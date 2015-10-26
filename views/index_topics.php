<div class="col-md-12 col-xs-12 article_bar">
    <div class="col-md-2 col-sm-3 col-xs-3 topics_icon">
        <h1 class="hidden-xs hidden-sm">最熱</h1>
        <h4 class="hidden-md hidden-lg">最熱</h4>
    </div>
    <div class="col-md-10 col-sm-9 col-xs-9">
        <table class="table table-hover table-condensed">
            <tbody>
                <?php foreach ($hot as $row): ?>
                    <tr>
                        <td class="col-md-8 col-sm-6 col-xs-12"><a href="<?=base_url()?>Topic/<?=$row->aid?>"><?=$row->topicname?></a></td>
                        <td class="col-md-4 col-sm-6 hidden-xs"><i class="fa fa-fire"></i>
                            <?=$row->hotindex?>
                        </td>
                    </tr>
                    <?php endforeach;?>
                    <tr>
                        <td class="col-md-8 col-sm-6 col-xs-12"><a href="<?=(base_url().'Topics/hot')?>">......更多熱門文章</a></td>
                    </tr>
            </tbody>
        </table>
    </div>
</div>
<div class="col-md-12 col-xs-12 article_bar">
    <div class="col-md-2 col-sm-3 col-xs-3 topics_icon">
        <h1 class="hidden-xs hidden-sm">最新</h1>
        <h4 class="hidden-md hidden-lg">最新</h4>
    </div>
    <div class="col-md-10 col-sm-9 col-xs-9">
        <table class="table table-hover table-condensed">
            <tbody>
                <?php foreach ($latest as $row): ?>
                    <tr>
                        <td class="col-md-8 col-sm-6 col-xs-12"><a href="<?=base_url()?>Topic/<?=$row->aid?>"><?=$row->topicname?></a></td>
                        <td class="col-md-4 col-sm-6 hidden-xs"><i class="fa fa-calendar"></i>
                            <?=$row->edit_time?>
                        </td>
                    </tr>
                    <?php endforeach;?>
                    <tr>
                        <td class="col-md-8 col-sm-6 col-xs-12"><a href="<?=(base_url().'Topics/latest')?>">......更多最新文章</a></td>
                    </tr>
            </tbody>
        </table>
    </div>
</div>