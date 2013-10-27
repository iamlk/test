<?php
/* @var $this CityController */
/* @var $model City */
Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl.'/css/news_detail.css');

$this->breadcrumbs = array($model['name']=>array('city/index', 'cid'=>$model['city_id']),
                           Yii::t('info', '详细介绍'));
?>

<div class="main-wrap clearfix pb10">
	<div class="news-detail">
         <h2 class="news-tit"><?php echo $model['name']; ?></h2>
                    <div class="raiders-detail-time">
                        <p class="raiders-bot">
                          <a href="<?php echo Yii::app()->createUrl('share/it',array('type'=>Dynamic::CITY,'id'=>$model['city_id'])) ?>" class="<?php if(U_ID!=0)echo 'ajax-item '; ?>share<?php if($this->isGuest)echo' fast-login'?>">分享(<em><?php echo $model['shareCount']; ?></em>)</a>
                        </p>
                    </div>
        <br />
        <div class="news-content"><?php echo $model['content']; ?></div>
	</div>
</div>
