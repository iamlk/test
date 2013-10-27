<?php $form=$this->beginWidget('CActiveForm', array(
	'enableAjaxValidation'=>false,
    'id'=>'option_add_form',

)); ?>
	<div>
		<label>增值服务名称</label>
		<?php echo $form->textField($modelDesc,'name'); ?>
		<?php echo CHtml::submitButton('submit',array('value'=>"添加")); ?>
	</div>


<?php $this->endWidget(); ?>

<script type="text/javascript" >

$(function(){
   //$("#option_add_form").ajaxForm();
   $("#option_add_form").submit(function() {
        
         var options = {
                dataType:'json',
                success: function(e) {
                 alert(e.message+e.error);
                },
        };
         $("#option_add_form").ajaxSubmit(options);
         return false;
        
    });
    
    
});

</script>