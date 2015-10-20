<div class="col-md-12 col-xs-12 article_list">

	<?php if(count($topics)==0) echo('<h1>:(</h1><br><h4>找不到符合條件的文章</h4>'); ?>
	<?php if(count($topics)) foreach ($topics as $row): ?>


	<div class="col-md-12 col-xs-12 none_padding topics_item">
		<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
			<div class="topics_photo">
				<img class="img-rounded flip" src="<?=$row->topic_photo_addr?>">
				<div class="topics_photo_back flip"><h1 class="center-block"><?=$row->aid?></h1></div>
			</div>
		</div>
		<div class="col-lg-7 col-md-7 col-sm-6 col-xs-6">
			<h2 class="hidden-xs hidden-sm"><a href="<?=base_url().'Topic/'.$row->aid?>"><?=$row->topicname?></a></h2>
			<h4 class="hidden-md hidden-lg"><a href="<?=base_url().'Topic/'.$row->aid?>"><?=$row->topicname?></a></h4>
		</div>
		<div class="col-lg-3 col-md-3 col-sm-4 col-xs-4 pull-right">
			<div><span class="glyphicon glyphicon-time" aria-hidden="true"></span><?=$row->edit_time?></div>
			<div><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span><?=$row->views?></div>
		</div>
	</div><!-- topics_item -->

	<?php endforeach;?>

</div>
