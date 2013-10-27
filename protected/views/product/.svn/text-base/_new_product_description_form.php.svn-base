<?php
/* @var $this ProductDescriptionController */
/* @var $model ProductDescription */
/* @var $form CActiveForm */
?>

<?php $form=$this->beginWidget('CActiveForm', array(
    //'action'=>$this->createUrl("product/update",array("product_id"=>$product_id,'act'=>"desc")),
	'enableAjaxValidation'=>false,
    //'htmlOptions'=>array('enctype'=>'multipart/form-data','class'=>'ajaxSubmit'),
    'htmlOptions'=>array('class'=>'ajaxSubmit'),
    
)); ?>
<?php

            $data = array();
            
            foreach($model->productDescriptions as $v)
            {
                $data[$v->product_description_id]['day'] = $v->day;
                $data[$v->product_description_id]['name'] = $v->name;
                $data[$v->product_description_id]['description'] = $v->description;
                $data[$v->product_description_id]['url_path'] = $v->url_path;
                $data[$v->product_description_id]['product_id'] = $v->product_id;
            }
            
             $d_time = $model->entity_type == '3'?'段':'天';
             
  $ct_hotel = count($hoteArray);
  $ct = 0;

?>

<?php foreach($data as $k =>$v): ?>
<div class="product-description">
<?php if(count($data) != 1):?>
<h4><?php echo "第".$v['day'].$d_time."行程描述" ?>1</h4>
 <?php endif; ?>
	<ul class="info-list review-list">
		<li>
			<label>行程概述:</label>
			<input type="text" class="long" name="ProductDescription[<?php echo $k; ?>][name]" required="required" value="<?php echo $v['name'] ?>" />
		</li>
		<li class="place-guise">
			<label>行程图片</label>
			<div class="upload-img-wrap">
				<span class="file-wrap add-new-album">添加照片<input type="file" name="ProductDescription[<?php echo $k; ?>][url_path]" data-remote="<?php echo $this->createUrl('imageHelper/upload');?>">
                
                <input type="hidden" value="<?php echo $v['day']; ?>" name="ProductDescription[<?php echo $k; ?>][day]" />
                 <input type="hidden" value="<?php echo $k; ?>" name="ProductDescription[<?php echo $k; ?>][id]" />
                </span>
				<span class="warnning">请至少上传1张照片。</span>
				<ul class="upload-img-list clearfix">
                 <li>
                    <img width="120" height="120" alt="" src="<?php echo Yii::app()->assetManager->baseUrl.'/'.$v['url_path']; ?>" />
					<input type="hidden" value="<?php echo $v['url_path']; ?>" name="ProductDescription[<?php echo $k; ?>][url_path]" />
                 </li>
                    
                    	
				</ul>
			</div>
		</li>
		<li>
			<label>行程详情:</label>
             <?php $this->widget('KindEditor',array('name'=>'ProductDescription['.$k.'][description]','value'=> $v['description'],'width'=>'560px','config'=>array('items'=>"['source','preview', 'cut', 'copy', 'paste',
        'plainpaste', 'wordpaste','formatblock', 'fontname', 'fontsize',  'forecolor', 'hilitecolor', 'bold',
        'italic', 'underline', 'strikethrough', 'lineheight', 'removeformat','hr','link', 'unlink']"))); ?>
			
            
            
		</li>
         <?php if($hoteArray && $ct<$ct_hotel): ?>
		<li>
			<label>入住酒店:</label>
			<input type="text" class="long"  name="ProductHotel[<?php echo $hoteArray[$ct]['id'] ?>][name]" value="<?php echo $hoteArray[$ct]['name'] ?>" />
		</li>
		<li class="place-guise">
			<label>酒店图片:</label>
			<div class="upload-img-wrap">
				<a href="javascript:;" class="add-new-album add-hotel-img" data-for="review_result_photo_<?php echo $hoteArray[$ct]['id'] ?>" data-tempId="li-template"  name="HotelImages[<?php echo $hoteArray[$ct]['id'] ?>][path][]" >添加照片</a>
				<span class="warnning">请至少上传1张照片。</span>
				<ul class="upload-img-list clearfix" id="review_result_photo_<?php echo $hoteArray[$ct]['id'] ?>">
    			      <?php if($hoteArray[$ct]['path']):?>
                           <?php foreach($hoteArray[$ct]['path'] as $key_id=>$url): ?>
                         
                			<li>
                				<image src="<?php echo Yii::app()->assetManager->baseUrl.'/'.$url;?>" alt="<?php echo $hoteArray[$ct]['name'] ?>" width="155" height="110" />
                                <input type="hidden" name="HotelImageSet[<?php echo $hoteArray[$ct]['id'] ?>][<?php echo $key_id ?>]" value="<?php echo $url; ?>" />
                                <a href="javascript:;" class="remove-item">删除</a>
                			</li>
                            <?php endforeach;?>
                    <?php endif;?>
				</ul>
			</div>
		</li>
		<li>
			<label>酒店描述:</label>
            <?php $this->widget('KindEditor',array('name'=>'ProductHotel['.$hoteArray[$ct]['id'].'][desc]','value'=> $hoteArray[$ct]['desc'] ,'width'=>'560px','config'=>array('items'=>"['source','preview', 'cut', 'copy', 'paste',
        'plainpaste', 'wordpaste','formatblock', 'fontname', 'fontsize',  'forecolor', 'hilitecolor', 'bold',
        'italic', 'underline', 'strikethrough', 'lineheight', 'removeformat','hr','link', 'unlink']"))); ?>

            <input type="hidden" name="ProductHotel[<?php echo $hoteArray[$ct]['id'] ?>][hotel_id]" value="<?php echo $hoteArray[$ct]['id'] ?>" />
		</li>
        <?php $ct++; endif;?>
	</ul>
	</div>
    <?php endforeach; ?>
    <ul class="info-list">
    	<li>
			<label></label>
			<span class="btn-line property-btn">
				<?php echo CHtml::submitButton('确定'); ?>
			</span>	
	   </li>
    </ul>


<?php $this->endWidget(); ?>