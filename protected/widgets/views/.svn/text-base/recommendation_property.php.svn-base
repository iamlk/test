<div class="zyxbox">
  <div class="zyxbox-tit3">
    <h3 class="tit-color3">推荐度假公寓<a href="<?php echo Yii::app()->createUrl('propertyList/index',array('city'=>$this->city_id)); ?>">更多</a></h3>
    <p class="tit-line"></p>
  </div>
  <div class="zyxbox-content">
    <ul class="next-city">
    <?php foreach($model as $item){ ?>
      <li>
        <a href="<?php echo Yii::app()->createUrl('goods/index',array('id'=>$item['goods_id'])); ?>">
			<img alt="" width="114" height="80" src="/thumb/114_80/<?php echo $item->property->propertyPictures[0]['path']; ?>" />
			<span><?php echo $item->property->city['name']; ?></span>
		</a>
        <p>
		<a href="<?php echo Yii::app()->createUrl('goods/index',array('id'=>$item['goods_id'])); ?>">
            <?php echo strlen($item->property->propertyAddendum['title'])>10?mb_substr($item->property->propertyAddendum['title'],0,8).'...':$item->property->propertyAddendum['title']; ?>
		</a>
        <br />
		<span class="orange indent5">￥<?php echo $item['price']; ?></span>
		</p>
      </li>
    <?php } ?>
    </ul>
  </div>
</div>