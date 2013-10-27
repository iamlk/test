

<?php $form=$this->beginWidget('CActiveForm', array(
'id'=>'product-set-jion-form',
'htmlOptions'=>array('class'=>'ajaxSubmit'),
	'enableAjaxValidation'=>false,
)); ?>

<ul class="info-list">
	<li>
		<label>每天接待人数上限</label>
		<?php echo $form->textField($model,'max_per_day_num_for_adults');  ?>
        <!--
	    <label>每天参团儿童上限</label>
		<?php //echo $form->textField($model,'max_per_day_num_for_kids');  ?>
        <label>最小儿童年龄</label>
		<?php //echo $form->textField($model,'min_age_for_kids');  ?>
        -->
	</li>
    <?php if(false): ?>
	<li>

        <label>酒店房间预订上限</label>
		<?php echo $form->textField($model,'max_hotle_booking');  ?>
	</li>

	<li>
        <label>每间入住人数上限</label>
		<?php echo $form->textField($model,'max_room_for_adults');  ?>
        <!--
        <label>每间入住儿童上限</label>
		<?php echo $form->textField($model,'max_room_for_kids');  ?>
        -->
	
	</li>
	<li>

        <label>每间房间床位数</label>
		<?php echo $form->textField($model,'max_room_bed');  ?>
	</li>
    <?php endif; ?>
    	<?php echo $form->hiddenField($model,'product_id',array('size'=>10,'maxlength'=>10)); ?>

	<li>
		<label></label>
		<span class="btn-line property-btn">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : '保存'); ?>
		</span>
	</li>
</ul>
<?php $this->endWidget(); ?>

<!-- form -->
