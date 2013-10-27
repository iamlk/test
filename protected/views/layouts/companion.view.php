<?php
Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/widget/zyxcalendar/zyxcalendar.js');
Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/maxlength.js');
Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl.'/widget/zyxcalendar/zyxcalendar.css');
Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl.'/css/companion.css');

?>

<?php $this->beginContent('//layouts/base'); ?>
    <!--banner-->
    <?php require(dirname(__FILE__).DIRECTORY_SEPARATOR.'inc.destination_banner.php');?>

    <div class="path-links">
        <?php $this->widget('zii.widgets.CBreadcrumbs', array('links'=>$this->breadcrumbs)); ?>
    </div>

    <div class="main-wrap clearfix pb10">

    	<div class="left-box">

	       <?php require(dirname(__FILE__).DIRECTORY_SEPARATOR.'companion.view.left.php');?>

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
