<?php
/* @var $this AttractionController */
/* @var $model Attraction */
Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl.'/css/news_detail.css');

$this->breadcrumbs = array($relations['name']=>array($relations->tableName().'/index', 'cid'=>$model['parent_id']),
                           $model['name']=>array('attraction/index', 'id'=>$model['attraction_id'], 'cid'=>$model['parent_id']),
                           Yii::t('info', '详细介绍'));
?>

<div class="main-wrap clearfix pb10">
	<div class="news-detail">
         <h2 class="news-tit"><?php echo $model['name']; ?></h2>
         <div class="raiders-detail-time">
           <p class="raiders-bot">
             <a href="<?php echo Yii::app()->createUrl('share/it',array('type'=>Dynamic::ATTRACTION,'id'=>$model['attraction_id'])) ?>" class="<?php if(U_ID!=0)echo 'ajax-item '; ?>share<?php if($this->isGuest)echo' fast-login'?>">分享(<em><?php echo $model['shareCount']; ?></em>)</a>
           </p>
         </div>
        <br />
        <div class="news-content"><?php echo $model['content']; ?></div>
	</div>
</div>