<?php ?>

<h2><?php echo CHtml::encode(Yii::t('property','修改您的空间')); ?></h2>
<div class="info-wrap">
	<?php echo $this->renderPartial('_form', array('property'=>$property, 'propertyAddendum'=>$propertyAddendum, 'propertyPictures'=>$propertyPictures, 'propertyPrice'=>$propertyPrice )); ?>
</div>