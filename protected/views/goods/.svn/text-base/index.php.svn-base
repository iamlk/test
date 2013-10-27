<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/short_trip_detail.css" />
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/page.css" />
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/order_base.css" />
<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/review.css" type="text/css" rel="stylesheet">
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/product_order.js" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/widget/zyxcalendar/zyxcalendar.css" />
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/widget/zyxcalendar/zyxcalendar.js" charset="utf-8"></script>
<div class="path-links pt65">
   <?php echo $this->breadcrumbs->display(); ?>
</div>
<div class="main-wrap-short clearfix pb10">
	<div class="short-left"><?php  $this->renderPartial("_left",array('data'=>$data)); ?></div>
	<div class="short-right">
 
    <?php /** 推荐行程*/ ?>
    <?php 
        if($this->_goods->entity_type == 2 && $this->_property )
        {
            $this->widget('application.widgets.RecommendationProductWidget',array('city_id'=>$data['city_id']));
        }
     ?>

    
    <?php /** 推荐住房*/ ?>
    <?php 
        if($this->_goods->entity_type == 1 && $this->_product )
        { 
             $this->widget('application.widgets.RecommendationPropertyWidget',array('city_id'=>$data['city_id'])); 
        } 
     ?>
    
    <?php /** 下一站城市推荐*/ ?>
	<?php $this->widget('application.widgets.NextStationWidget');?>
    <?php /** 功率文章列表*/ ?>
	<?php $this->widget('application.widgets.ArticleListWidget',array('city_id'=>$data['city_id']));?>
    <?php /** 结伴同游贴*/ ?>
	<?php //$this->widget('application.widgets.TravelCompanionWidget',array('city_id'=>$data['city_id']));?>
    <?php /** 活跃用户*/ ?>
	<?php $this->widget('application.widgets.ActiveUserWidget');?>

	</div>


</div>
