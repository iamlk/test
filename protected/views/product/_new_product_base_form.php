<?php
/* @var $this ProductController */
/* @var $model Product */
/* @var $form CActiveForm */
?>
<?php  Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/widget/uploader/swfobject.js'); ?>
<?php  Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/widget/uploader/uploader.js'); ?>
<?php  Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl.'/widget/uploader/uploader.css'); ?>


<h3><span class="title">行程基本信息</span></h3>
<?php  $htmlOptions=array('class'=>'ajax-submit ajax-valid-form','enctype'=>"multipart/form-data");$form=$this->beginWidget('CActiveForm', array('id'=>'product-form','enableAjaxValidation'=>false,'htmlOptions'=>$htmlOptions)); ?>
<ul class="info-list">
   
	<li>

		<label>行程类型：<span>*</span></label>
		<span><?php echo $form->dropDownList($model,"product_type_id",ProductType::getTypes(),array('required'=>true)); ?></span>
	</li>

	<li>
		<label>产品名字：<span>*</span></label>
		<?php echo $form->textField($mname,'title',array('class'=>'long','required'=>true,'data-messages'=>'required:<i></i>产品名字不能为空')); ?>
	</li>

	<li>
		<label>产品描述：<span>*</span></label>
		<?php echo $form->textArea($mname,'description',array('class'=>'long','required'=>true,'data-messages'=>'required:<i></i>产品描述不能为空')); ?>
	</li> 
	<li class="place-guise">
		<label>产品图片：<span>*</span></label>
		<div class="upload-img-wrap">
			<a href="javascript:;" id="add-new-album" class="add-new-album" data-for="review_result_photo" data-tempId="li-template">添加照片</a>
			<span class="warnning">请至少上传3张照片。</span>
			<ul class="upload-img-list clearfix" id="review_result_photo">
			</ul>
		</div>
	</li>
	<li>
		<label>起始城市：<span>*</span></label>
		<input type="hidden" name="start_id" value="" />
		<input id="ProductStartCity_city_id" type="text" class="startCity" data-remote="/index.php?r=product/ajaxget&act=city" autocomplete="off" />
	</li>
	<li>
		<label>结束城市：<span>*</span></label>
		<input type="hidden" name="end_id" value="" />
	    <input id="ProductEndCity_city_id" class="startCity" type="text" data-remote="/index.php?r=product/ajaxget&act=city"  autocomplete="off" />
	</li>
	<li>
		<label>途经城市：<span>*</span></label>
		<input type="text"  id="visitcity" data-remote="/index.php?r=product/ajaxget&act=city" autocomplete="off" />
		<input type="hidden" name="visitcityId" id="visitcityId" />
	</li>
	<li>
		<label>沿途景点：</label>
		<input type="text"  id="attractcity"  data-remote="/index.php?r=product/ajaxget&act=attraction" autocomplete="off" />
		<input type="hidden" name="attractcityId" id="attractcityId" />
	</li>
	<li>
		<label>行程区段：<span>*</span></label>
		<?php echo $form->textField($model,'duration',array('required'=>true,'data-rules'=>'number:true','data-messages'=>'required:<i></i>行程区段不能为空,number:<i></i>行程区段必须为数字')); ?>
		<span><?php echo $form->dropDownList($model,'duration_type',Product::getDuration());?></span>
	</li>
   
</ul>
<h3><span class="title">行程介绍</span></h3>
<div class="product-description-wrap" id="product-description-wrap">
	<div class="note-text">请设置行程时间</div>
</div>
<ul class="info-list">
	<li>
		<label></label>
		<span class="btn-line property-btn">
			<?php echo CHtml::submitButton('发布'); ?>
		</span>
		<span class="note-red">温馨提示：</span>
		当您快速发布产品后，可以继续进行更详细的产品设置，包括添加多个出发地点、多个出团时间、不同的价格等。
	</li>
</ul>
<?php $this->endWidget(); ?>
<!-- form -->


