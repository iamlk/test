<?php
/* @var $this ProductTypeController */
/* @var $model ProductType */
/* @var $form CActiveForm */
?>

<div class="form">
	<h3>行程类型添加</h3>
	<?php
	$form = $this->beginWidget('CActiveForm', array(
		'id' => 'product-type-form',
		'enableAjaxValidation' => false,
		));
	?>

		<?php
	echo $form->errorSummary($model);
	?>
	<ul class="setup-form">
		<li>
			 <?php echo $form->labelEx($model, 'language');?>
			 <?php echo $form->dropDownList($model, 'language', array_combine(Yii::app()->params['languages'],Yii::app()->params['languages']));?>
			 <?php echo $form->error($model, 'language', array('class' => 'tip-holder'));?>
		</li>
		<li>
			<?php echo $form->labelEx($model, 'type_name');?>
			<?php echo $form->textField($model, 'type_name', array("maxlength" => "20")); ?>
			<?php echo $form->error($model, 'type_name');?>
		</li>
		<li>
			<label></label>
			<?php echo CHtml::submitButton($model->isNewRecord?'添加':'Save');?>
		</li>
	</ul>
	<?php
	$this->endWidget();
	?>
	<span id="product-type-form_resp" style="height: 100px; color:red;"></span>

</div><!-- form -->

