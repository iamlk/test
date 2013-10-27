<?php /* 凡是顶部带目的地的页面通用 */ ?>
<?php 
$this->beginContent('//layouts/base'); 

Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl.'/css/companion.css');
Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl.'/css/page.css');
?>
<?php require(dirname(__FILE__).DIRECTORY_SEPARATOR.'inc.dev.php');?>
<?php require(dirname(__FILE__).DIRECTORY_SEPARATOR.'inc.destination_banner.php');?>

<div class="path-links">
    <?php $this->breadcrumbs->display(); ?>
</div>

<div class="main-wrap clearfix pb10">

   <?php echo $content; ?>

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
