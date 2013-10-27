<?php /* @var $this Controller */ ?>
<?php $this->beginContent('//layouts/base'); ?>
<!--banner-->
<?php require(dirname(__FILE__).DIRECTORY_SEPARATOR.'inc.dev.php');?>
<?php require(dirname(__FILE__).DIRECTORY_SEPARATOR.'inc.destination_banner.php');?>
<div class="path-links">
  <?php $this->widget('zii.widgets.CBreadcrumbs', array('links'=>$this->breadcrumbs)); ?>
</div>
<div class="main-wrap clearfix pb10">
  <div class="left-box">
  <?php $city_id = intval($_REQUEST['cid']); ?>
  <?php $this->widget('application.widgets.RecommendationProductWidget',array('city_id'=>$city_id)); ?>
  <?php $this->widget('application.widgets.RecommendationPropertyWidget',array('city_id'=>$city_id)); ?>
  </div>

  <div class="right-box">
  <?php echo $content; ?>
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
