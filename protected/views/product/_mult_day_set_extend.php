<?php
/* @var $this ProductMultiDayPriceController */
/* @var $model ProductMultiDayPrice */
/* @var $form CActiveForm */
?>



<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'product-multi-day-price-form',
	'enableAjaxValidation'=>false,
    	'htmlOptions'=>array('class'=>'ajaxSubmit'),//如果需要表单重置  添加'data-reset'=>'true'
)); ?>
<ul class="info-list time-slice">
	<li>
		一般时段产品价格：
	</li>
	<li>
		将
       <?php echo $form->textField($modelPrice,'start_date',array('class'=>"setup-calendar",'value'=>date("Y-m-d",$modelPrice->start_date))); ?>
       <?php echo $form->textField($modelPrice,'end_date',array('class'=>"setup-calendar",'value'=>date("Y-m-d",$modelPrice->end_date))); ?>
		区间的所有
        <label><?php echo CHtml::checkBox("ProductMultiDayPrice[sunday]",$modelPrice->sunday?true:false); ?>SUN</label>
		<label><?php echo CHtml::checkBox("ProductMultiDayPrice[monday]",$modelPrice->monday?true:false); ?>MON</label>
		<label><?php echo CHtml::checkBox("ProductMultiDayPrice[tuesday]",$modelPrice->tuesday?true:false); ?>TUE</label>
		<label><?php echo CHtml::checkBox("ProductMultiDayPrice[wednesday]",$modelPrice->wednesday?true:false); ?>WEN</label>
		<label><?php echo CHtml::checkBox("ProductMultiDayPrice[thursday]",$modelPrice->thursday?true:false); ?>THU</label>
		<label><?php echo CHtml::checkBox("ProductMultiDayPrice[friday]",$modelPrice->friday?true:false); ?>FRI</label>
		<label><?php echo CHtml::checkBox("ProductMultiDayPrice[saturday]",$modelPrice->saturday?true:false); ?>SAT</label>
		<label>设置为一般接待时段</label>
	</li>
	<li>
		该时段行程价格设置为：
	</li>
    <li>
		<label>成人价格</label><span>￥</span>
		<?php echo $form->textField($modelPrice,'price_adult',array('size'=>10,'maxlength'=>10)); ?><span>/人</span>
		<label>儿童价格</label><span>￥</span>
		<?php echo $form->textField($modelPrice,'price_kids',array('size'=>10,'maxlength'=>10)); ?><span>/人</span>
			
    </li>
    <li>
		该时段酒店价格设置为：
	</li>
	<li>
    <label>单人一间￥</label>
	<?php echo $form->textField($modelPrice,'price_single',array('size'=>10,'maxlength'=>10,'class'=>'short')); ?><label>/晚</label>

	 <label>双人一间￥</label>
	<?php echo $form->textField($modelPrice,'price_double',array('size'=>10,'maxlength'=>10,'class'=>'short')); ?><label>/晚</label>

		 <label>三人一间￥</label>
	<?php echo $form->textField($modelPrice,'price_triple',array('size'=>10,'maxlength'=>10,'class'=>'short')); ?><label>/晚</label>

    <label>四人一间￥</label>
	<?php echo $form->textField($modelPrice,'price_quad',array('size'=>10,'maxlength'=>10,'class'=>'short')); ?><label>/晚</label>

	</li>
    <li>
		<span class="btn-line property-btn btn-center">
			<?php echo $form->hiddenField($modelPrice,'product_id'); ?>
			<?php echo CHtml::submitButton('确定'); ?>
		</span>
	</li>
</ul>

<?php $this->endWidget(); ?>


<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'product-multi-day-price-over-form',
	'enableAjaxValidation'=>false,
    	'htmlOptions'=>array('class'=>'ajaxSubmit'),//如果需要表单重置  添加'data-reset'=>'true'
)); ?>
<ul class="info-list time-slice">
	<li>
		特殊时段产品价格：
	</li>
	<li>
		将
       <?php echo $form->textField($modelPriceOver,'start_date',array('class'=>"setup-calendar",'value'=>date("Y-m-d",$modelPriceOver->start_date))); ?>
       <?php echo $form->textField($modelPriceOver,'end_date',array('class'=>"setup-calendar",'value'=>date("Y-m-d",$modelPriceOver->end_date))); ?>
		区间的所有
        <label><?php echo CHtml::checkBox("ProductMultiDayPriceOverride[sunday]",$modelPriceOver->sunday?true:false); ?>SUN</label>
		<label><?php echo CHtml::checkBox("ProductMultiDayPriceOverride[monday]",$modelPriceOver->monday?true:false); ?>MON</label>
		<label><?php echo CHtml::checkBox("ProductMultiDayPriceOverride[tuesday]",$modelPriceOver->tuesday?true:false); ?>TUE</label>
		<label><?php echo CHtml::checkBox("ProductMultiDayPriceOverride[wednesday]",$modelPriceOver->wednesday?true:false); ?>WEN</label>
		<label><?php echo CHtml::checkBox("ProductMultiDayPriceOverride[thursday]",$modelPriceOver->thursday?true:false); ?>THU</label>
		<label><?php echo CHtml::checkBox("ProductMultiDayPriceOverride[friday]",$modelPriceOver->friday?true:false); ?>FRI</label>
		<label><?php echo CHtml::checkBox("ProductMultiDayPriceOverride[saturday]",$modelPriceOver->saturday?true:false); ?>SAT</label>
		<label>设置为一般接待时段</label>
	</li>
	<li>
		该时段行程价格设置为：
	</li>
    <li>
		<label>成人价格</label>
		<span>￥</span>
		<?php echo $form->textField($modelPriceOver,'price_adult',array('size'=>10,'maxlength'=>10)); ?><span>/人</span>
		<label>儿童价格</label>	<span>￥</span>
		<?php echo $form->textField($modelPriceOver,'price_kids',array('size'=>10,'maxlength'=>10)); ?><span>/人</span>
    </li>
    <li>
		该时段酒店价格设置为：
	</li>
	<li>
    <label>单人一间￥</label>
	<?php echo $form->textField($modelPriceOver,'price_single',array('size'=>10,'maxlength'=>10,'class'=>'short')); ?><label>/晚</label>
	 <label>双人一间￥</label>
	<?php echo $form->textField($modelPriceOver,'price_double',array('size'=>10,'maxlength'=>10,'class'=>'short')); ?><label>/晚</label>
	<label>三人一间￥</label>
	<?php echo $form->textField($modelPriceOver,'price_triple',array('size'=>10,'maxlength'=>10,'class'=>'short')); ?><label>/晚</label>
    <label>四人一间￥</label>
	<?php echo $form->textField($modelPriceOver,'price_quad',array('size'=>10,'maxlength'=>10,'class'=>'short')); ?><label>/晚</label>
	</li>
    <li>
		<span class="btn-line property-btn btn-center">
            <?php echo $form->hiddenField($modelPriceOver,'product_id'); ?>
			<?php echo CHtml::submitButton('确定'); ?>
		</span>
	</li>
</ul>
<?php $this->endWidget(); ?>
<script type="text/javascript">
 $(function(){
	$('#ProductMultiDayPrice_start_date,#ProductMultiDayPrice_end_date,#ProductMultiDayPriceOverride_start_date,#ProductMultiDayPriceOverride_end_date').zyxCalendar({
		range:'<?php  echo date('Y-m-d') ?>:',
		output:'yyyy-mm-dd'
	});
	
});
</script>
			

<!-- form -->