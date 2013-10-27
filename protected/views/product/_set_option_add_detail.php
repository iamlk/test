<?php $form=$this->beginWidget('CActiveForm', array(
'id'=>'option_add_form_detail',
	'enableAjaxValidation'=>false,
)); ?>
	<div class="row">
        <label>所属服务</label>
        <?php echo $form->dropDownList($modelAttr,'product_option_id',$dataArr); ?>
		<label>服务明细</label>
		<?php echo $form->textField($modelValue,'value'); ?>
	   <label>明细价格</label>
		<?php echo $form->textField($modelAttr,'value_price'); ?>
		<?php echo CHtml::submitButton('添加服务明细'); ?>
	</div>

<?php $this->endWidget(); ?>
<script type="text/javascript" >

$(function(){
        $("#option_add_form_detail").submit(function() {
        
         var options = {
                dataType:'json',
                success: function(e) {
                 //alert(e.message+e.error);
                 if(e.error == 'no')
                 {
                    $("#option_add_form_detail").resetForm();
                    $('#base_option_list').html(e.html).fadeIn(500);
                    $('#base_option').fadeOut(500);
                 }
                 else
                 {
                    alert(e.message);
                 }
                 
                },
        };
         $("#option_add_form_detail").ajaxSubmit(options);
         return false;
        
    });
    
    
});

</script>