<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/jquery.mask.min.js');?>


<script type="text/javascript">
$(document).ready(function(){
    $('#Property_person, #Property_room,#Property_bed').mask('000');
    $('#Property_area_sqm, #Property_area_sqf').mask('000000.00');
    $('#PropertyPrice_day_price').mask('00000000.00');
});
</script>

	<h3>住所基本信息：</h3>
	<?php $form=$this->beginWidget('CActiveForm', array('id'=>'property-form', 'action'=>$this->createUrl('property/'.($this->action->id=='create'?'create':'update'),array('property_id'=>$property->property_id)))); ?>

 	<?php // echo $form->errorSummary(array($property,$propertyAddendum,$propertyPrice),'','',array('class'=>'xundis')); ?>
    <?php if ($this->action->id=='preview') : ?>
        <input type="hidden" name="returnUrl" value="<?php echo $this->createUrl('property/preview',array('property_id'=>$property->property_id)); ?>" />
    <?php endif; ?>
        <ul class="info-list">
            <li>
                <?php echo CHtml::label(Yii::t('property','住所类型').':',null); ?>
                <?php
                $htmlOptions = array('prompt'=>CHtml::encode(Yii::t('form','请选择...')));
                // TODO: if ($cid=(int)Yii::app()->request->getParam('currency_id')) $htmlOptions['options'] = array($cid=>array('selected'=>true));
                echo $form->dropDownList($property,'property_type_id',CHtml::listData(PropertyTypeAddendum::model()->local()->findAll(),'property_type_id','type'),$htmlOptions);
                ?>
                <?php echo $form->error($property,'property_type_id',array('class'=>'tip-holder')); ?>
            </li>
            <li>
                <?php echo CHtml::label(Yii::t('property','住所标题').':',null); ?>
                <?php echo $form->textField($propertyAddendum,'title',array('size'=>40,'maxlength'=>40,'class'=>'long')); ?>
				<?php echo $propertyAddendum->title; ?>
                <?php echo $form->error($propertyAddendum,'title',array('class'=>'tip-holder')); ?>
            </li>
            <li class="place-guise">
                <?php echo CHtml::label(Yii::t('property','住所外观').':',null); ?>
                <div class="upload-img-wrap">
                    <?php echo $this->renderPartial('_image', array('property'=>$property, 'propertyPictures'=>$propertyPictures)); ?>
                </div>
                <?php echo $form->error($property,'propertyPicture',array('class'=>'tip-holder')); ?>
            </li>
            <li>
                <?php echo CHtml::label(Yii::t('property','住所描述').':',null); ?>
                <?php echo $form->textArea($propertyAddendum, 'description'); ?>
				<?php echo $propertyAddendum->description; ?>
            </li>
            <li>
                <?php echo CHtml::label(Yii::t('property','卧室总计').':',null); ?>
                <?php echo $form->textField($property,'room',array('size'=>9,'maxlength'=>9,'class'=>'short')); ?>
                <span><?php echo CHtml::encode(Yii::t('property','间')); ?></span>
                <span class="warnning"><?php echo CHtml::encode(Yii::t('property','请输入能入住的卧室房间总数。')); ?></span>
                <?php echo $form->error($property,'room',array('class'=>'tip-holder')); ?>
            </li>
            <li>
                <?php echo CHtml::label(Yii::t('property','床位总计').':',null); ?>
                <?php echo $form->textField($property,'bed',array('size'=>9,'maxlength'=>9,'class'=>'short')); ?>
                <span><?php echo CHtml::encode(Yii::t('property','个')); ?></span>
                <span class="warnning"><?php echo CHtml::encode(Yii::t('property','请输入整个住所床位总数。')); ?></span>
                <?php echo $form->error($property,'bed',array('class'=>'tip-holder')); ?>
            </li>
            <li>
                <?php echo CHtml::label(Yii::t('property','最多入住').':',null); ?>
                <?php
                //$htmlOptions = array('prompt'=>CHtml::encode(Yii::t('form','请选择...')),'class'=>'zyx-ipt');
                // TODO: if ($cid=(int)Yii::app()->request->getParam('currency_id')) $htmlOptions['options'] = array($cid=>array('selected'=>true));
                //echo $form->dropDownList($property,'person',$property->getPersons(),$htmlOptions);
                ?>
                <?php echo $form->textField($property,'person',array('size'=>9,'maxlength'=>9,'class'=>'short')); ?>
                <span><?php echo CHtml::encode(Yii::t('property','人')); ?></span>
                <?php echo $form->error($property,'person',array('class'=>'tip-holder')); ?>
            </li>
            <li>
                <?php echo CHtml::label(Yii::t('property','具备浴室').':',null); ?>
                <?php
                $htmlOptions = array('prompt'=>CHtml::encode(Yii::t('form','请选择浴室')));
                // TODO: if ($cid=(int)Yii::app()->request->getParam('currency_id')) $htmlOptions['options'] = array($cid=>array('selected'=>true));
                echo $form->dropDownList($property,'bathroom',$property->getBathrooms(),$htmlOptions);
                ?>
                <?php echo $form->error($property,'bathroom',array('class'=>'tip-holder')); ?>
            </li>
            <li>
                <?php echo CHtml::label(Yii::t('property','住所面积').':',null); ?>
                <?php echo $form->textField($property,'area_sqm',array('size'=>9,'maxlength'=>9,'class'=>'zyx-ipt w50')); ?>
                <?php echo $form->textField($property,'area_sqf',array('size'=>9,'maxlength'=>9,'class'=>'zyx-ipt w50','style'=>'display:none;')); ?>
                <select id="select-area">
                    <option value="sqm"><?php echo CHtml::encode(Yii::t('property','平方米'));?></option>
                    <option value="sqf"><?php echo CHtml::encode(Yii::t('property','平方英尺'));?></option>
                </select>
				<span class="warnning">请输入住所的总面积</span>
                <?php echo $form->error($property,'area_sqm',array('class'=>'tip-holder')); ?>
            </li>
            <li>
                <?php echo CHtml::label(Yii::t('property','整租价格').':',null); ?>
                <span>$</span>
                <?php echo $form->textField($propertyPrice,'day_price',array('size'=>9,'maxlength'=>9,'class'=>'zyx-ipt w50')); ?>
                <span>/<?php echo CHtml::encode(Yii::t('property','晚')); ?></span>
                <?php echo $form->error($propertyPrice,'day_price',array('class'=>'tip-holder')); ?>
            </li>
        </ul>
        <h3>住所详细信息：<span>为保护您的隐私，客人正式预订后才能看到。</span></h3>
        <ul class="info-list">
            <li>
               <?php echo CHtml::label(Yii::t('property','所在地址').':',null); ?>
                <?php echo $form->hiddenField($property,'country_id',array('id'=>'country_id')); ?>
				<input type="text" data-remote="index.php?r=property/dynamicZone" id="country" class="country" autocomplete="off" value="<?php echo CHtml::encode($property->country->countryAddendumLocal->name); ?>" placeholder="请输入国家" />
                <?php echo $form->hiddenField($property,'state_id',array('id'=>'state_id')); ?>
				<input type="text"  data-remote="index.php?r=property/dynamicZone" id="state" class="state" autocomplete="off" value="<?php echo CHtml::encode($property->state->stateAddendumLocal->name); ?>" placeholder="请输入省" />
                <?php echo $form->hiddenField($property,'city_id',array('id'=>'city_id')); ?>
				<input type="text"  data-remote="index.php?r=property/dynamicZone" id="city" class="city" autocomplete="off" value="<?php echo CHtml::encode($property->city->cityAddendumLocal->name); ?>" placeholder="请输入城市" />
                <?php echo (($property->getErrors('country_id') or $property->getErrors('country_id') or $property->getErrors('country_id'))?CHtml::tag('div',array('class'=>'tip-holder'),Yii::t('property','国家/省/市 不可为空白.')):''); ?>
				<br />
				<label></label>
				<?php echo $form->textField($propertyAddendum,'address',array('size'=>69,'maxlength'=>69,'class'=>'address')); ?>
                <?php echo $form->error($propertyAddendum,'address',array('class'=>'tip-holder')); ?>
                <?php if ($propertyAddendum->address and $property->getErrors('longitude')) : ?>
                <?php echo CHtml::tag('div',array('class'=>'tip-holder'),Yii::t('property','注意：您输入的地址在google地图中没有找到，请重新输入地址。')); ?>
                <?php endif; ?>
            </li>
            <li>
                <?php echo CHtml::label(Yii::t('property','邮政编码').':',null); ?>
                <?php echo $form->textField($property,'zipcode',array('size'=>9,'maxlength'=>9,'class'=>'zyx-ipt w100')); ?>
                <?php echo $form->error($property,'zipcode',array('class'=>'tip-holder')); ?>
            </li>
            <li>
                <?php echo CHtml::label(Yii::t('property','房东手机').':',null); ?>
               <!-- <?php echo CHtml::textField('phone_zone',array('size'=>4)); ?>-->
                <?php echo $form->textField($property,'phone',array('size'=>29,'maxlength'=>29,'class'=>'zyx-ipt w150')); ?>
                <?php echo $form->error($property,'phone',array('class'=>'tip-holder')); ?>
            </li>
			<li>
				<?php // include('_map.php'); ?>
			</li>
            <li class="undis">
                <?php echo $form->labelEx($property,'longitude');  ?>
                <?php echo $form->textField($property,'longitude',array('size'=>9,'maxlength'=>9,'class'=>'zyx-ipt w100')); ?>
                <?php echo $form->error($property,'longitude',array('class'=>'tip-holder')); ?>
            </li>
            <li class="undis">
                <?php echo $form->labelEx($property,'latitude'); ?>
                <?php echo $form->textField($property,'latitude',array('size'=>9,'maxlength'=>9,'class'=>'zyx-ipt w100')); ?>
                <?php echo $form->error($property,'latitude',array('class'=>'tip-holder')); ?>
            </li>
			<li>
				<label>&nbsp;</label>
				<span class="btn-line property-btn"><?php echo CHtml::submitButton(CHtml::encode(Yii::t('form','发布')),array()); ?></span>
			</li>
        </ul>
        <div class="note">
            <p><span>温馨提示：</span><br />
            当您快速发布产品后，可以继续进行更详细的产品设置，包括添加更详细的介绍、不同的价格等。</p>
        </div>
	<?php $this->endWidget(); ?>
<!-- form -->
<div style="display:none">
	<div id="add-new-city">
		<h3>添加城市</h3>
		<ul>
			<li>
				<label>你将添加下列城市：</label>
				<input type="text" value="">
			</li>
			<li>
				<label></label>
				<a class="btn" href="javascript:;">确定</a>
			</li>
		</ul>
	</div>
</div>
<script type="text/html" id="extend-img">
<li>
	<div class="img-wrap">
		<img src="{src}" width="80" height="80" />
		<div class="operate">
			<a href="javascript:;" class="file-wrap">
				修改
				<input type="file" name="file" data-remote="index.php?r=imageHelper/upload" id="{random}" />
				<input type="hidden" value="{file}" name="PropertyPicture[path][]" id="PropertyPicture_path" />
			</a>
			<a href="javascript:;" class="remove">删除</a>
		</div>
	</div>
</li>

</script>
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
<script>
    $('#Property_area_sqm').change(function(){
        var val = $(this).val();
		if (val !== ''){
    		$('#Property_area_sqm').val(Math.round(val*100)/100);
    		$('#Property_area_sqf').val(Math.round(val*10.76391041671*100)/100);
        }
	});
	$('#Property_area_sqf').change(function(){
		var val=$(this).val();
        if (val !== ''){
            $('#Property_area_sqf').val(Math.round(val*100)/100);
            $('#Property_area_sqm').val(Math.round(val*0.09290304*100)/100);
        }
	});
	$("#PropertyAddendum_address").change(function(){
		var country = $("#country").val();
		var state = $("#state").val();
		var city = $("#city").val();
		var address = country + state + city + $(this).val();
		//alert(address);
		var lng = $("#Property_longitude");
		var lat = $("#Property_latitude");
		var	geocoder = new google.maps.Geocoder();
		if(geocoder){
			geocoder.geocode( { 'address': address }, function(results, status) {
				if (status == google.maps.GeocoderStatus.OK) {
				  var latLng=results[0].geometry.location;
				  lat.val(latLng.lat().toFixed(6));
				  lng.val(latLng.lng().toFixed(6));
				  //alert(latLng.lat());
				}else{
				  lat.val("");
				  lng.val("");
				}
			});
		}

	});
</script>



