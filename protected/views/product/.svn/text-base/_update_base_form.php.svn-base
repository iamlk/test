<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'product-form',
	'htmlOptions'=>array('class'=>'ajaxSubmit ajax-valid-form'),//如果需要表单重置  添加'data-reset'=>'true'
	'enableAjaxValidation'=>false,
)); ?>
<ul class="info-list">
	
	<li>
		<label>行程类型：</label>
		<?php echo $form->dropDownList($model,"product_type_id",ProductType::getTypes()); ?>
	</li>
	<li>
		<label>产品名字：</label>
		<?php echo $form->textField($model->productAddendum,'title',array('class'=>'long')); ?>
	</li>
	<li>
		<label>产品描述：</label>
		<?php echo $form->textArea($model->productAddendum,'description',array('class'=>'long')); ?>
	</li> 
	<li class="place-guise">
	<label>产品图片：</label>
			<div class="upload-img-wrap">
				<a data-tempid="li-template" data-for="review_result_photo" class="add-new-album" id="add-new-album" href="javascript:;">添加照片</a>
				<span class="warnning">请至少上传3张照片。</span>
			     <ul class="upload-img-list clearfix" id="review_result_photo">
                 <?php $prex = Yii::app()->assetManager->baseUrl; foreach($productImages as $v): ?>
                 <li>
        				<img src="<?php echo $prex.'/'.$v->path; ?>"  alt="" width="155" height="105" />
						<input type="hidden" name="ProductImages_set[<?php echo $v->product_image_id; ?>][path]" value="<?php echo $v->path; ?>" />
                        <input type="hidden" name="ProductImages_set[<?php echo $v->product_image_id; ?>][id]" value="<?php echo $v->product_image_id; ?>" />
						<input type="text" name="ProductImages_set[<?php echo $v->product_image_id; ?>][title]" value="<?php echo $v->note;?>" />
        				<a class="remove-item" href="javascript:;" data-remote="/index.php?r=product/ajaxget&act=del_pic&id=<?php echo $v->product_image_id; ?>&pid=<?php echo $model->product_id ?>" >删除</a>
				</li> 		
                 <?php endforeach; ?>
				</ul>
			</div>
	</li>

	<li>
		<label>起始城市：</label>
		<input type="hidden" name="start_id" value="<?php echo $model->productStartCity->city_id; ?>" />
		<input id="ProductStartCity_city_id" type="text" value="<?php echo $model->productStartCity->city->cityAddendum->name; ?>" class="startCity" data-remote="/index.php?r=product/ajaxget&act=city" autocomplete="off"/>
		
	</li>

	<li>
		<label>结束城市：</label>
		<input type="hidden" name="end_id" value="<?php echo $model->productEndCity->city_id; ?>" />
	    <input id="ProductEndCity_city_id" class="startCity"  type="text" value="<?php echo $model->productEndCity->city->cityAddendum->name; ?>"  data-remote="/index.php?r=product/ajaxget&act=city" autocomplete="off" />
	
	</li>
   <li>
		<label>途经城市：</label>
		<input type="text"  id="visitcity" data-remote="/index.php?r=product/ajaxget&act=city" autocomplete="off" />
	
        <div class="undis">
         <?php   
        $visitCitys = $model->productVisitingCities;   
         $arr =$arr_id =  array(); 
         foreach($visitCitys as $cityId)
         {
            $arr[$cityId->city_id]=$cityId->city->cityAddendumLocal->name;
            $arr_id[]= $cityId->city_id;
         }
        
         //echo implode("&nbsp;/&nbsp;",$arr); 
         ?>
         <?php if($arr): foreach($arr as $key=>$value): ?>
        <a class="selecteItem" data-for="visitcityId" data-id="<?php echo $key; ?>" href="javascript:;">
			<?php echo $value; ?>;
			<input type="hidden" name="vcity[]" value="<?php echo $key; ?>" />
		</a>
        	
        <?php endforeach;endif;?>
       
        </div>
         <input type="hidden" name="visitcityId" id="visitcityId" value="{L}<?php echo implode('{L}',$arr_id);  ?>" />
        
	</li>
	<li>
		<label>沿途景点：</label>
		<input type="text"  id="attractcity"  data-remote="/index.php?r=product/ajaxget&act=attraction" autocomplete="off" />
		
        <div class="undis">
         <?php   
        $attractions = $model->productAttractions;   
         $arr = $arr_id =  array(); 
         foreach($attractions as $aId)
         {
            $arr[$aId->attraction_id]=$aId->attraction->addendum->name;
            $arr_id[]= $aId->attraction_id;
         }
        
         //echo implode("&nbsp;/&nbsp;",$arr); 
         ?>
           <?php if($arr): foreach($arr as $key=>$value): ?>
         <a class="selecteItem" data-for="attractcityId" data-id="<?php echo $key; ?>" href="javascript:;">
			<?php echo $value; ?>;
			<input type="hidden" name="acity[]" value="<?php echo $key; ?>" />
		 </a>
          <?php endforeach;endif;?>
          
          </div>
         
	</li>
	<li>
		<label>行程区段：</label>
        <input value="<?php echo CHtml::encode($model->duration); ?>" type="text"  disabled="true" />
		<input value="<?php echo CHtml::encode($model->entity_type==3?"段":"天"); ?>" type="text" class="ipt-sel" disabled="true" />
	</li>
	<li>
		
        <?php echo $form->hiddenField($model,'product_id') ?>
	</li>
	<li>
			<label></label>
			<span class="btn-line property-btn">
				<?php echo CHtml::submitButton($model->isNewRecord ? '发布' : '保存'); ?>
			</span>
	</li>
</ul>
<?php $this->endWidget(); ?>