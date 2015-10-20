<div class="col-md-12 col-xs-12 none_padding user_profile">
	<div class="col-md-3 col-sm-5 col-xs-12 user_profile_photo">
		<img src="<?=$user->photo_addr?>" class="img-rounded">
	</div>
	<div class="col-md-8 col-sm-7 col-xs-12 user_profile_info">
		<h1><?=$user->username?></h1>
		<hr>
		<h4><?=$user->email?></h4>
	</div>
	<div class="col-md-12 col-sm-12 col-xs-12 user_profile_introducing">
		<h3><span class="glyphicon glyphicon-paperclip" aria-hidden="true"></span>自我介紹</h3>
		<body>
			<?=$user->introducing?>
		</body>
	</div>
	<div class="col-md-12 col-sm-12 col-xs-12 user_profile_articles overflow-ellipsis">
		<h3><span class="glyphicon glyphicon-paperclip" aria-hidden="true"></span>近期發表文章</h3>
		<table class="table table-condensed">
			<tr>

				<?php foreach ($user->topics as $row): ?>
				<tr>
					<td class="col-md-9 col-xs-8"><a href="<?=base_url()?>Topic/<?=$row->aid?>"><?=$row->topicname?></a></td>
					<td class="col-md-3 col-xs-4"><span class="glyphicon glyphicon-time" aria-hidden="true"></span><?=$row->edit_time?></td>
				</tr>
				<?php endforeach;?>

			</tr>
		</table>
	</div>
	<div class="col-md-12 col-sm-12 col-xs-12 user_profile_status">
		<h3><span class="glyphicon glyphicon-paperclip" aria-hidden="true"></span>帳號狀態</h3>
		<table class="table table-condensed">
			<thead>
				<th>權限</th>
				<th>註冊來自</th>
			</thead>
			<tr>
				<?php
					$rid = $user->rid;
					$utid = $user->utid;
					$activate = $user->activate;
					
					if($rid==2&&$utid==1){
						echo '<td>一般會員</td><td>TC Incubator</td>';
					}
					else if($rid==2&&$utid==2){
						echo '<td>一般會員</td><td>Facebook</td>';
					}
					else if($rid==3&&$utid==1){
						echo '<td>VIP會員</td><td>TC Incubator</td>';
					}
					else if($rid==3&&$utid==2){
						echo '<td>VIP會員</td><td>Facebook</td>';
					}
					else if($rid==4&&$utid==1){
						echo '<td>管理員</td><td>TC Incubator</td>';
					}
					else if($rid==4&&$utid==2){
						echo '<td>管理員</td><td>Facebook</td>';
					}
				?>


				<!--<td><?=$user->rid?></td>
				<td><?=$user->utid?></td>
				<td><?=$user->activate?></td>-->
			</tr>
		</table>
	</div>
</div>