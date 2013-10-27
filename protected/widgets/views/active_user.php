<div class="zyxbox">
	<div class="zyxbox-tit3">
		<h3 class="tit-color3"><?php echo Yii::t('info', '最活跃的网友'); ?></h3>
		<p class="tit-line"></p>
	</div>
	<div class="zyxbox-content">
		<ul class="friend-list clearfix">
		<?php $i=0; ?>
		<?php foreach($model as $item){ ?>
		<?php if(++$i%3==0){
				echo '<li class="last">';
			  }else{
				echo '<li>';
			  } ?>
				<a href="<?php echo Dynamic::goUrl($item['customer_id'],'center'); ?>" title=""><img src="/thumb/60_60/<?php echo $item['avator']; ?>" /></a>
				<h3><a href="<?php echo Dynamic::goUrl($item['customer_id'],'center'); ?>"><?php echo $item['nick_name']; ?></a></h3>
			</li>
		<?php } ?>
		</ul>
	</div>
</div>