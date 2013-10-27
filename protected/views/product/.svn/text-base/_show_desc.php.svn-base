<?php 
  $data= $model->productDescriptions;
  if($data!=null):
  $d_time = $model->entity_type == '3'?'段':'天';
  $ct_hotel = count($hoteArray);
  $ct = 0;
 foreach($data as $v):
 ?>
 <div class="product-description">
 <h4>第<?php echo $v->day;?><?php echo $d_time; ?></h4>
 <ul class="info-list review-list">
	 <li>
		 <span class="label">行程概述：</span>
		 <span><?php echo $v->name; ?></span>
	 </li>
	<li>
	<span class="label">行程图片：</span>
	<div class="upload-img-wrap">
		<ul class="img-review clearfix">
			<li>
				<image src="<?php echo Yii::app()->assetManager->baseUrl.'/'.$v->url_path;?>" alt="" width="155" height="110" />
				<span></span>
			</li>
		
		</ul>	
	</div>
	</li>
	 <li>
	 <span class="label">行程详情：</span>
	 <span><?php echo $v->description ?></span>
	 </li>
     <?php if($hoteArray && $ct<$ct_hotel): ?>
     <li>
			<span class="label">入住酒店：</span>
			<span><?php echo $hoteArray[$ct]['name'] ?></span>
	</li>
	<li class="place-guise">
		<span class="label">酒店图片：</span>
		<div class="upload-img-wrap">
    		<ul class="img-review clearfix">
               <?php if($hoteArray[$ct]['path']):?>
               <?php foreach($hoteArray[$ct]['path'] as $url): ?>
    			<li>
    				<image src="<?php echo Yii::app()->assetManager->baseUrl.'/'.$url;?>" alt="<?php echo $hoteArray[$ct]['name'] ?>" width="155" height="110" />
    				<span></span>
    			</li>
                <?php endforeach;?>
                <?php endif;?>
    		</ul>	
		</div>
	</li>
	<li>
		<span class="label">酒店描述：</span>
		<span><?php echo $hoteArray[$ct]['desc']; ?></span>
	</li>
    <?php $ct++; endif; ?>
     
 </ul>
 </div>
 <?php  endforeach ?>
 <?php endif ?>