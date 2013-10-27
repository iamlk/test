<?php
/* @var $this ConfigurationController */
/* @var $model Configuration */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'configuration-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'configuration_group'); ?>
		<?php
        $htmlOptions = array('prompt'=>CHtml::encode(Yii::t('form','请选择...')));
        if ($gid=(int)Yii::app()->request->getParam('configuration_group_id')) $htmlOptions['options'] = array($gid=>array('selected'=>true));
        echo $form->dropDownList($model,'configuration_group_id',CHtml::listData(ConfigurationGroup::model()->findAll(),'configuration_group_id','title'),$htmlOptions);
        ?>
		<?php echo $form->error($model,'configuration_group_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'title'); ?>
		<?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>120)); ?>
		<?php echo $form->error($model,'title'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'description'); ?>
		<?php echo $form->textField($model,'description',array('size'=>60,'maxlength'=>250)); ?>
		<?php echo $form->error($model,'description'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'key'); ?>
		<?php echo $form->textField($model,'key',array('size'=>60,'maxlength'=>120)); ?>
		<?php echo $form->error($model,'key'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'value'); ?>
		<?php echo $form->textArea($model,'value',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'value'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'created'); ?>
		<?php //echo $form->textField($model,'created'); ?>
        <?php
        $this->widget('CJuiDateTimePicker', array(
            'model'=>$model,
            'attribute'=>'created',
            'mode'=>'datetime',
            // additional javascript options for the date picker plugin
            'options'=>array(
                'dateFormat'=>'yy-mm-dd',
                'timeFormat'=>'hh:mm:ss',
                'showSecond'=>true,
                //'showAnim'=>'fold',
            ),
            'htmlOptions'=>array(
                //'style'=>'height:20px;'
            ),
            'language'=>'',
        ));
        ?>
		<?php echo $form->error($model,'created'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'updated'); ?>
		<?php //echo $form->textField($model,'updated'); ?>
        <?php
        $this->widget('CJuiDateTimePicker', array(
            'model'=>$model,
            'attribute'=>'updated',
            'mode'=>'datetime',
            // additional javascript options for the date picker plugin
            'options'=>array(
                'dateFormat'=>'yy-mm-dd',
                'timeFormat'=>'hh:mm:ss',
                'showSecond'=>true,
                //'showAnim'=>'fold',
            ),
            'htmlOptions'=>array(
                //'style'=>'height:20px;'
            ),
            'language'=>'',
        ));
        ?>
		<?php echo $form->error($model,'updated'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->