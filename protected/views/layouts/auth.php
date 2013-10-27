<?php
Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl.'/css/mycenter.css');
Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/mycent.js');
?>

<?php $this->beginContent('//layouts/base'); ?>

<!-- blue navigation-->    
<div class="main-nav-outter">
	<div class="main-nav">
		<ul class="main-nav-list">
			<li><a href="/">首页</a></li>
			<li class="current"><a href="<?php echo Dynamic::goUrl(U_ID,'center');?>">个人中心</a></li>
			<!--<li><a href="#">我的账户</a></li>-->
		</ul>
	
	</div>	
</div>
<!-- blue navigation-->
<div class="main-wrap clearfix pb10">

<?php echo $content;?>
</div>
<?php $this->endContent(); ?>
