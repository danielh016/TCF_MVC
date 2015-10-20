<div class="col-md-12 col-xs-12 article_bar">
    <div class="col-md-2 col-sm-3 col-xs-3 topics_icon">
        <h1 class="hidden-xs hidden-sm">HOT</h1>
        <h4 class="hidden-md hidden-lg">HOT</h4>
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
            </tbody>
        </table>
    </div>
</div>
<div class="col-md-12 col-xs-12 article_bar">
    <div class="col-md-2 col-sm-3 col-xs-3 topics_icon">
        <h1 class="hidden-xs hidden-sm">NEW</h1>
        <h4 class="hidden-md hidden-lg">NEW</h4>
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
            </tbody>
        </table>
    </div>
</div>