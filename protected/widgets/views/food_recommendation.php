<div class="zyxbox">
  <div class="zyxbox-tit3">
    <h3 class="tit-color3 tit-color1"><?php echo $this->city['name'].Yii::t('info', '美食'); ?><a href="<?php echo Yii::app()->createUrl('food/index', array('cid'=>$this->city['city_id'], 'id'=>$this->food['food_id'])); ?>"><?php echo Yii::t('info', '更多'); ?></a></h3>
    <p class="tit-line"></p>
  </div>
  <div class="zyxbox-content">
    <ul class="food-list">
    <?php if(!$model)
          {
            echo Yii::t('info', '暂时没有相关内容');
          }else{
            foreach($model as $item){
    ?>
            <li><a href="<?php echo Yii::app()->createUrl($item['type'].'/view', array('id'=>$item['type_id'],'cid'=>$item['city_id'])); ?>"><img title="<?php echo $item['title']; ?>" src="<?php echo '/thumb/80_60/'.$item['image']; ?>" alt="<?php echo $item['title']; ?>" /></a></li>
    <?php } } ?>
    </ul>
  </div>
</div>
