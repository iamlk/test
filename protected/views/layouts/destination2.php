<?php /* @var $this Controller */ ?>
<?php $this->beginContent('//layouts/base'); ?>
    <!--banner-->
    <?php require(dirname(__FILE__).DIRECTORY_SEPARATOR.'inc.dev.php');?>
    <?php require(dirname(__FILE__).DIRECTORY_SEPARATOR.'inc.destination_banner.php');?>

    <div class="path-links">
        <?php $this->widget('zii.widgets.CBreadcrumbs', array('links'=>$this->breadcrumbs)); ?>
    </div>

    <div class="main-wrap clearfix pb10">

    	<div class="city-left">

	       <?php echo $content; ?>

    	</div>

    	<div class="city-right">
<?php
$this->widget('application.widgets.NextStationWidget');
$this->widget('application.widgets.FoodRecommendationWidget');
//$this->widget('application.widgets.TravelCompanionWidget', array('city_id'=>Yii::app()->request->getParam('cid')));
$this->widget('application.widgets.ActiveUserWidget');
?>
    	</div>

    </div>

<script type="text/javascript">
	$(function(){
		$(".all-city-btn").hover(function(){
			$(".all-city-list").show();
		},function(){
			$(".all-city-list").hide();
		});
		$(".all-city-list").hover(function(){
			$(".all-city-list").show();
		},function(){
			$(".all-city-list").hide();
		});
	});
</script>
<?php $this->endContent(); ?>
