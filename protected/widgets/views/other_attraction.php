    <div class="zyxbox">
      <div class="zyxbox-tit3">
        <h3 class="tit-color3"><?php echo Yii::t('info', '浏览此景点的人还浏览了'); ?></h3>
        <p class="tit-line"></p>
      </div>
      <div class="zyxbox-content">
        <ul class="summary-list other-summaey">
        <?php if(!$model)
              {
                echo Yii::t('info', '暂时没有相关内容');
              }else{
                foreach($model as $item){
        ?>
                <li> <a href="<?php echo Yii::app()->createUrl('attraction/index', array('id'=>$item['attraction_id'], 'cid'=>$item['parent_id'])); ?>" title="<?php echo $item['name']; ?>"><img border="0" width="100px" height="70px" src="<?php echo '/thumb/102_72/'.$item['image']; ?>" alt="<?php echo $item['name']; ?>" /></a>
                <h3><a href="<?php echo Yii::app()->createUrl('attraction/index', array('id'=>$item['attraction_id'], 'cid'=>$item['parent_id'])); ?>" title="<?php echo $item['name']; ?>"><?php echo $item['name']; ?></a></h3>
                </li>
        <?php } } ?>
          </li>
        </ul>
      </div>
    </div>