<?php
/* @var $this ProductOneDayPriceController */
/* @var $model ProductOneDayPrice */
/* @var $form CActiveForm */
?>
<?php 
    $form=$this->beginWidget('CActiveForm', array(
	'id'=>'product-one-day-price-form',
	'enableAjaxValidation'=>false,
	'htmlOptions'=>array('class'=>'ajaxSubmit','data-reset'=>''),//如果需要表单重置  添加
    )); 
?>
<ul class="info-list time-slice">
	<li>
		一般时段产品价格：
	</li>
	<li>
		<label>将</label>
		<?php echo $form->textField($modelPrice,'start_date',array('class'=>"setup-calendar",'value'=>date("Y-m-d",$modelPrice->start_date))); ?>
		<?php echo $form->textField($modelPrice,'end_date',array('class'=>"setup-calendar",'value'=>date("Y-m-d",$modelPrice->end_date))); ?>
		<span>区间的所有</span>
        <label><?php echo CHtml::checkBox("ProductOneDayPrice[sunday]",$modelPrice->sunday?true:false); ?>SUN</label>
		<label><?php echo CHtml::checkBox("ProductOneDayPrice[monday]",$modelPrice->monday?true:false); ?>MON</label>
		<label><?php echo CHtml::checkBox("ProductOneDayPrice[tuesday]",$modelPrice->tuesday?true:false); ?>TUE</label>
		<label><?php echo CHtml::checkBox("ProductOneDayPrice[wednesday]",$modelPrice->wednesday?true:false); ?>WEN</label>
		<label><?php echo CHtml::checkBox("ProductOneDayPrice[thursday]",$modelPrice->thursday?true:false); ?>THU</label>
		<label><?php echo CHtml::checkBox("ProductOneDayPrice[friday]",$modelPrice->friday?true:false); ?>FRI</label>
		<label><?php echo CHtml::checkBox("ProductOneDayPrice[saturday]",$modelPrice->saturday?true:false); ?>SAT</label>
		<label>设置为一般接待时段</label>
	</li>
	<li>
		该时段行程价格设置为：
	</li>
    <li>	
		<label>成人价格￥</label>
		<?php echo $form->textField($modelPrice,'price_adult',array('size'=>10,'maxlength'=>10)); ?><span>/人</span>
		 <label>儿童价格￥</label>
		<?php echo $form->textField($modelPrice,'price_kids',array('size'=>10,'maxlength'=>10)); ?><span>/人</span>
	</li>
    <li>
		<span class="btn-line property-btn btn-center">
       	<?php echo $form->hiddenField($modelPrice,'product_id'); ?>
			<?php echo CHtml::submitButton('确定'); ?>
		</span>
	</li>
		
</ul>
<?php $this->endWidget(); ?>
<?php 
    $form=$this->beginWidget('CActiveForm', array(
	'id'=>'product-one-day-price-over-form',
	'enableAjaxValidation'=>false,
	'htmlOptions'=>array('class'=>'ajaxSubmit','data-reset'=>''),//如果需要表单重置  添加
    )); 
?>
<ul class="info-list time-slice">
        <li>
        特殊时段产品价格：
		</li>
        <li>
			<label>将</label>
			<?php echo $form->textField($modelPriceOver,'start_date',array('class'=>"setup-calendar",'value'=>date("Y-m-d",$modelPriceOver->start_date))); ?>
			<?php echo $form->textField($modelPriceOver,'end_date',array('class'=>"setup-calendar",'value'=>date("Y-m-d",$modelPriceOver->end_date))); ?>
			<span>区间的所有</span>
		<label><?php echo CHtml::checkBox("ProductOneDayPriceOverride[sunday]",$modelPriceOver->sunday?true:false); ?>SUN</label>
		<label><?php echo CHtml::checkBox("ProductOneDayPriceOverride[monday]",$modelPriceOver->monday?true:false); ?>MON</label>
		<label><?php echo CHtml::checkBox("ProductOneDayPriceOverride[tuesday]",$modelPriceOver->tuesday?true:false); ?>TUE</label>
		<label><?php echo CHtml::checkBox("ProductOneDayPriceOverride[wednesday]",$modelPriceOver->wednesday?true:false); ?>WEN</label>
		<label><?php echo CHtml::checkBox("ProductOneDayPriceOverride[thursday]",$modelPriceOver->thursday?true:false); ?>THU</label>
		<label><?php echo CHtml::checkBox("ProductOneDayPriceOverride[friday]",$modelPriceOver->friday?true:false); ?>FRI</label>
		<label><?php echo CHtml::checkBox("ProductOneDayPriceOverride[saturday]",$modelPriceOver->saturday?true:false); ?>SAT</label>设置为特殊接待时段
		</li>
		<li>该时段行程价格设置为：</li>
		<li>
			<label>成人价格</label>
			<span>￥</span>
			<?php echo $form->textField($modelPriceOver,'price_adult',array('size'=>10,'maxlength'=>10)); ?><span>/人</span>
			 <label>儿童价格</label>	<span>￥</span>
			<?php echo $form->textField($modelPriceOver,'price_kids',array('size'=>10,'maxlength'=>10)); ?><span>/人</span>
		</li>
		<li>
			<span class="btn-line property-btn btn-center">
			<?php echo $form->hiddenField($modelPriceOver,'product_id'); ?>
				<?php echo CHtml::submitButton('确定'); ?>
			</span>
		</li>
</ul>



<script type="text/javascript">

 $(function(){
                    $('#ProductOneDayPrice_start_date,#ProductOneDayPrice_end_date,#ProductOneDayPriceOverride_start_date,#ProductOneDayPriceOverride_end_date').zyxCalendar({
                        range:'<?php  echo date('Y-m-d') ?>:',
                        output:'yyyy-mm-dd'
                    });
	
	});
</script>
<?php $this->endWidget(); ?>
