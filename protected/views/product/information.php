<?php  Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl.'/widget/uploader/uploader.css'); ?>
<?php  Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/widget/uploader/swfobject.js'); ?>
<?php  Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/widget/uploader/uploader.js'); ?>
<?php   Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl.'/widget/zyxcalendar/zyxcalendar.css');
        Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/widget/zyxcalendar/zyxcalendar.js'); ?>
 
<input  type="hidden" value="<?php echo $model->product_id;?>" id="product_id_leo" /> 
<h2>完善信息</h2>
<div class="has-temp">
<div class="info-wrap">
	<h3><span class="title">行程基本信息</span><a href="javascript:void(0);" class="change-info" data-rel="base_update" >修改</a></h3>
	<div id="base_base">
        <?php /** 显示基本信息 **/  ?>
        <div id="base_show">
			<?php  $this->renderPartial('_show_base', array('data'=>$model)); ?>
        </div>
        <?php /** 修改基本信息 **/  ?>
        <div id="base_update" class="undis">
			<?php  $this->renderPartial('_update_base_form', array('model'=>$model,'productImages'=>$model->productImages)); ?>
        </div>
	</div>
	<h3>
		<span class="title">行程介绍</span><a href="javascript:void(0);" class="change-info" data-rel="desc_update">修改</a>
	</h3>
	<div id="base_desc" class="setup-column">
        <?php /** 显示行程介绍 **/  ?>
        <div id="desc_show">
			<?php $this->renderPartial('_show_desc', array('model'=>$model,'hoteArray'=>$hoteArray)); ?>
        </div>
        <?php /** 修改行程介绍**/  ?>
        <div id="desc_update" class="undis">
			<?php  $this->renderPartial('_new_product_description_form', array('model'=>$model,'product_id'=>$model->product_id,'hoteArray'=>$hoteArray)); ?>
        </div>
	</div>
	<h3>
		<span class="title">价格明细</span><a href="javascript:void(0);" class="change-info" data-rel="price-setup-wrap">修改</a>
	</h3>
	<div class="setup-column">
		<div id="price-setup-wrap" class="undis">
			<h4>
				<span>设置价格</span>
				您可以设置多种不同条件的价格，价格将以最近时间设置的金额为准。以下是设置的价格情况，
				<span class="warnning">如果不接待，请将价格设置为0，客人将不可选。</span>
			</h4>
			<div id="price-setup" class="price-setup product-price-setup">
				<?php if($model->entity_type == '1' || $model->entity_type == '3'): ?>
					<?php  $this->renderPartial('_one_day_set_extend', array('product'=>$model,'modelPrice'=>$modelPrice,'modelPriceOver'=>$modelPriceOver)); ?>
				<?php elseif($model->entity_type == '2'): ?>
					<?php  $this->renderPartial('_mult_day_set_extend', array('product'=>$model,'modelPrice'=>$modelPrice,'modelPriceOver'=>$modelPriceOver)); ?>
				<?php endif ?>
			</div>
		</div>
		<div id="price_table">
			<!--<h4><span>价格设置情况</span>如果不出租住所，请将价格设置为0，客人将不可选。<a id="dayprice-view" href="javascript:;">每天价格详情查看</a></h4>-->
			<div id="base_price_list">
				<?php  echo $priceList; ?>
  	        </div>
		</div>
	</div>
    <?php /** 此模块暂时被取消  start **/   ?>
    <?php if(false):?>
	<h3>出发时间和地点</h3>
	<div class="setup-column">
		<div id="base_detail" class="undis">
			<?php $this->renderPartial("_new_set_detail",array("model"=>$modelDetail)) ?>
		</div>
		<div id="base_detail_list">
			<?php $this->renderPartial("_new_set_detail_list",array('data'=>$productDepartureData)) ?>
		</div>
	</div>
    <?php endif;?>
     <?php /** 此模块暂时被取消  end **/   ?>
	<h3>
		<span class="title">接待人数设置</span>
		<span class="text">我们默认常规的人数上限，您可以根据自己的情况修改(<em class="orange"> 0 表示无限制</em>)。</span>
		<a href="javascript:void(0);" class="change-info" data-rel="join_update" >修改</a>
	</h3>
	<div class="setup-column">
		<div id="base_join">
            <div id="join_show">
				<?php $this->renderPartial("_new_set_jion",array('note'=>$modelNote)) ?>
			</div>
            <div id="join_update" class="undis">
				<?php $this->renderPartial('_new_set_jion_update',array('model'=>$modelNote)) ?>
			</div>
		</div>
	</div>
     <?php /** 此模块暂时被取消  start **/   ?>
      <?php if(false):?>
	<h3><span class="title">增值服务设置</span></h3>
	<div class="setup-column">
		<div id="base_option">
		</div>
		<div id="base_option_list">
			<?php $this->renderPartial("_set_option_list",array('newmodel_attr'=>$newmodel_attr,'modelDesc'=>$modelDesc)) ?>
		</div>
		
		<p class="steup-line">
			<a href="javascript:void(0);" onclick="add_option(<?php echo $model->product_id; ?>)" >新增增值服务</a>
			<a href="javascript:void(0);" onclick="add_option_detail(0,<?php echo $model->product_id; ?>)">新增一行</a>
			<?php  echo CHtml::link("新增一项服务（复制其它产品的增值服务）",Yii::app()->createUrl("productoption/add",array("product_id"=>$model->product_id))); ?>
			<span class="btn-line property-add-service"><a href="javascript:void(0);" onclick="ck_muti_detail('<?php  echo Yii::app()->createUrl("productoption/mutiadd",array("product_id"=>$model->product_id));?>')">将选择的增值服务添加到其他行程...</a></span>

		</p>

	</div>
    <?php endif;?>
     <?php /** 此模块暂时被取消  end **/   ?>
	<h3><span class="title">注意事项</span><a href="javascript:void(0);" class="change-info" data-rel="attention_show" >修改</a></h3>
	<div class="setup-column"> 
		<div id="attention_show">
			<?php  echo $modelNote->attention_rules ? $modelNote->attention_rules : "&nbsp;暂无 &nbsp;"; ?>
        </div>
        <div id="attention_update" class="undis">
        	<?php $this->renderPartial("_new_set_attention",array('model'=>$modelNote)) ?>
        </div>
       
	
	</div>
</div>
</div>	

    
        
    
  
    
  
    




