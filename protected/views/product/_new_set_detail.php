<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'product-form-detail',
	'enableAjaxValidation'=>false,
    	//'htmlOptions'=>array('class'=>'ajaxSubmit'),//如果需要表单重置  添加'data-reset'=>'true'
)); ?>
<p>
	<span class="time">
	<?php echo $form->dropDownList($model,'time',Product::model()->getInTimes()); ?>
	</span><span class="add">
	<?php echo $form->textField($model,'full_address',array("cols"=>20,'rows'=>10)); ?>
	<?php echo $form->hiddenField($model,'product_id',array('size'=>10,'maxlength'=>10)); ?>
	</span><span class="operate">
	<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</span>
</p>
<?php $this->endWidget(); ?>

