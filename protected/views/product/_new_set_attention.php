<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'product-form-attention',
	'enableAjaxValidation'=>false,
    'htmlOptions'=>array('class'=>'ajaxSubmit'),//如果需要表单重置  添加'data-reset'=>'true'
)); ?>
    	<ul class="info-list">
		<li>
	    <?php $this->widget('KindEditor',array('name'=>'ProductNote[attention_rules]','value'=>$model->attention_rules,'width'=>'560px','config'=>array('items'=>"['source','preview', 'cut', 'copy', 'paste',
        'plainpaste', 'wordpaste','formatblock', 'fontname', 'fontsize',  'forecolor', 'hilitecolor', 'bold',
        'italic', 'underline', 'strikethrough', 'lineheight', 'removeformat','hr','link', 'unlink']"))); ?>
		</li>
		<li>
		<span class="btn-line property-btn">
			<?php echo CHtml::submitButton('保存'); ?>
		</span>
		</li>
<?php $this->endWidget(); ?>

</div><!-- form -->