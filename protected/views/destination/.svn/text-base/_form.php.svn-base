<?php
/* @var $this DestinationController */
/* @var $model Destination */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'destination-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'belong_to_type'); ?>
		<?php echo $form->textField($model,'belong_to_type'); ?>
		<?php echo $form->error($model,'belong_to_type'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'belong_to_id'); ?>
		<?php echo $form->textField($model,'belong_to_id',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'belong_to_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'created'); ?>
		<?php echo $form->textField($model,'created'); ?>
		<?php echo $form->error($model,'created'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->