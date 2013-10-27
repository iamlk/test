    <div class="zyxbox">
      <div class="zyxbox-tit3">
        <h3 class="tit-color3"><?php echo Yii::t('info', '相关资讯'); ?><?php if($model){ ?><a href="<?php echo Yii::app()->createUrl('article/index', array('cid'=>$this->city_id)); ?>"><?php echo Yii::t('info', '更多'); ?></a><?php } ?></h3>
        <p class="tit-line"></p>
      </div>
      <div class="zyxbox-content">
        <ul class="que-list">
        <?php if(!$model){
                echo Yii::t('info', '暂时没有相关内容');
              }else{
                foreach($model as $item){ ?>
                  <li><a title="<?php echo $item->article['title']; ?>" href="<?php echo Yii::app()->createUrl('article/view', array('id'=>$item['article_id'])); ?>"><em class="icon"></em><?php echo $item->article['title']; ?></a></li>
        <?php }} ?>
        </ul>
      </div>
    </div>