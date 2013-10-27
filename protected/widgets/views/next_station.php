<div class="zyxbox">
  <div class="zyxbox-tit2">
    <h3 class="tit-color2"><?php echo Yii::t('info', '热门城市'); ?></h3>
    <p class="tit-line"></p>
  </div>
  <div class="zyxbox-content">
    <ul class="next-city">
      <?php $i = 0; foreach($model as $item){ if(++$i>4)break; ?>
      <li>
		<a href="<?php echo Yii::app()->createUrl('city/index', array('cid'=>$item['city_id'])) ?>">
			<img title="<?php echo $item['name']; ?>" src="<?php echo '/thumb/114_80/'.$item['image']; ?>" alt="<?php echo $item['name']; ?>" />
			<span><?php echo $item['name']; ?></span>
		</a>
      </li>
      <?php } ?>
    </ul>
  </div>
</div>
