<?php
/* @var $this ProductController */
/* @var $data Product */
?>


<ul class="info-list review-list">

	<li>
		<span class="label">行程类型：</span>
		<span><?php echo $data->productType->productTypeAddendumLocal->type_name; ?></span>
	</li>

	<li>
		<span class="label">产品名字：</span>
		<span><?php echo $data->productAddendum->title;  ?></span>

	</li>
	<li>
		<span class="label">产品描述：</span>
		<span><?php echo $data->productAddendum->description; ?></span>

	</li>
	<li>
		<span class="label">行程图片：</span>
		<div class="upload-img-wrap">
        
			<ul class="img-review clearfix">
            <?php $prex = Yii::app()->assetManager->baseUrl; foreach($data->productImages as $v): ?>
				<li>
					<image src="<?php echo $prex.'/'.$v->path; ?>" alt="" width="155" height="110" />
					<span><?php echo $v->note; ?></span>
				</li>
                <?php endforeach; ?>
				
			</ul>
			
		</div>
		
	</li>
	<li>
		<span class="label">起始城市：</span>
		<span><?php echo CHtml::encode($data->productStartCity->city->cityAddendumLocal->name); ?></span>

	</li>
	<li>
		<span class="label">结束城市：</span>
		<span><?php echo CHtml::encode($data->productEndCity->city->cityAddendumLocal->name); ?></span>

	</li>
	<li>
		<span class="label">途径城市：</span>
		<span>
        <?php   
        $visitCitys = $data->productVisitingCities;   
         $arr = array(); 
         foreach($visitCitys as $cityId)
         {
            $arr[]=$cityId->city->cityAddendumLocal->name;
         }
        
         echo implode("&nbsp;/&nbsp;",$arr); 
         ?>
        </span>

	</li>
	<li>
		<span class="label">沿途景点：</span>
		<span>
        <?php   
        $attractions = $data->productAttractions;   
         $arr = array(); 
         foreach($attractions as $aId)
         {
            $arr[]=$aId->attraction->addendum->name;
         }
        
         echo implode("&nbsp;/&nbsp;",$arr); 
         ?>
        </span>

	</li>
	
	<li>
		<span class="label">行程区段：</span>
		<span><?php echo CHtml::encode($data->duration); ?>	<?php echo CHtml::encode($data->entity_type==3?"段":"天"); ?></span>

	</li>
	
</ul>
