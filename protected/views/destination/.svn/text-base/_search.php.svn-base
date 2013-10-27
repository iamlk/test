<?php
/* @var $this DestinationController */
/* @var $model Destination */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'destination_id'); ?>
		<?php echo $form->textField($model,'destination_id',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'belong_to_type'); ?>
		<?php echo $form->textField($model,'belong_to_type'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'belong_to_id'); ?>
		<?php echo $form->textField($model,'belong_to_id',array('size'=>10,'maxlength'=>10)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'created'); ?>
		<?php echo $form->textField($model,'created'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->