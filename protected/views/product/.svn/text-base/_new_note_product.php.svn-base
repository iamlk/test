<?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'product-note-form',
	'enableAjaxValidation'=>false,
)); ?>
<?php $this->widget('KindEditor',array('name'=>'ProductNote[remark]','value'=>$model->remark ,'width'=>'','config'=>array('items'=>"['source','preview', 'cut', 'copy', 'paste',
        'plainpaste', 'wordpaste','formatblock', 'fontname', 'fontsize',  'forecolor', 'hilitecolor', 'bold',
        'italic', 'underline', 'strikethrough', 'lineheight', 'removeformat','hr','link', 'unlink']")));
?>
<?php echo CHtml::submitButton('Save'); ?>
<?php $this->endWidget(); ?>