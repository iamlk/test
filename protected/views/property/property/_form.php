
	<h3><span class="title">住所基本信息：</span></h3>
	<?php  $htmlOptions=array('class'=>'valid-form');$form=$this->beginWidget('CActiveForm', array('id'=>'property-form','htmlOptions'=>$htmlOptions)); ?>
        <ul class="info-list first-step">
        	<?php  //echo $form->errorSummary(array($property)); ?>
            <li>
            <label>住所类型：<span>*</span></label>
               
                <span>
					<?php
						$htmlOptions = array('prompt'=>CHtml::encode(Yii::t('form','请选择...')),'required'=>true,'data-messages'=>'required:<i></i>请选择住所类型');
						echo $form->dropDownList($property,'property_type_id',Property::getTypeList(),$htmlOptions);
					?>
				</span>	
                <?php echo $form->error($property,'property_type_id',array('class'=>'tip-holder')); ?>
            </li>
			<?php if(false): ?>
            <?php /** leo add 暂时屏蔽 **/ ?>
            <li>
				<label>卧室总计：<span>*</span></label>
				<span>
					<?php
						$htmlOptions = array('prompt'=>CHtml::encode(Yii::t('form','请选择...')),'required'=>true,'data-messages'=>'required:<i></i>请选择卧室总计');
						echo $form->dropDownList($property,'room',Property::getBedroom(),$htmlOptions);
					?>
				</span>	
                <?php echo $form->error($property,'room',array('class'=>'tip-holder')); ?>
			</li>
			<li>
				<label>可住人数：<span>*</span></label>
				<span>
					<?php
						$htmlOptions = array('prompt'=>CHtml::encode(Yii::t('form','请选择...')),'required'=>true,'data-messages'=>'required:<i></i>请选择可住人数');
						echo $form->dropDownList($property,'person',Property::getGuestsIn(),$htmlOptions);
					?>
				</span>	
                <?php echo $form->error($property,'person',array('class'=>'tip-holder')); ?>
			</li>
            
            <?php endif; ?>
            
            
            <li>
				<label>房间数量：<span>*</span></label>
				<span>
					<?php
						//$htmlOptions = array('prompt'=>CHtml::encode(Yii::t('form','请选择...')),'required'=>true,'data-messages'=>'required:<i></i>请选择卧室总计');
						//echo $form->dropDownList($property,'room',Property::getBedroom(),$htmlOptions);
                        echo $form->textField($property,'room',array('required'=>true,'data-messages'=>'required:<i></i>请填写房间数量'));
					?>
				</span>	
                <?php echo $form->error($property,'room',array('class'=>'tip-holder')); ?>
			</li>
			<li>
				<label>可住人数：<span>*</span></label>
				<span>
					<?php
						//$htmlOptions = array('prompt'=>CHtml::encode(Yii::t('form','请选择...')),'required'=>true,'data-messages'=>'required:<i></i>请选择可住人数');
						//echo $form->dropDownList($property,'person',Property::getGuestsIn(),$htmlOptions);
                         echo $form->textField($property,'person',array('required'=>true,'data-messages'=>'required:<i></i>请填写可住人数'));
					?>
				</span>	
                <?php echo $form->error($property,'person',array('class'=>'tip-holder')); ?>
			</li>
            
            
			<li>
				<label>所在地址：<span>*</span></label>
                <span>
                 <?php
                 // 国家
                    $htmlOptions = array('prompt'=>CHtml::encode(Yii::t('form','请选择...')),'required'=>true,'data-messages'=>'required:<i></i>请选择国家');
                    echo $form->dropDownList($property,'country_id',Property::getCountries(),$htmlOptions);
                ?>
                <?php echo $form->error($property,'country_id',array('class'=>'tip-holder')); ?>
                </span>
                
                 <span>
                 <?php
                 // 省 州
                    $htmlOptions = array('prompt'=>CHtml::encode(Yii::t('form','请选择...')),'required'=>true,'data-messages'=>'required:<i></i>请选择省份');
                    echo $form->dropDownList($property,'state_id',Property::getStates($property->country_id),$htmlOptions);
                ?>
                <?php echo $form->error($property,'state_id',array('class'=>'tip-holder')); ?>
                </span>
                
                 <span>
                 <?php
                 // 城市
                    $htmlOptions = array('prompt'=>CHtml::encode(Yii::t('form','请选择...')),'required'=>true,'data-messages'=>'required:<i></i>请选择城市');
                    echo $form->dropDownList($property,'city_id',Property::getCities($property->state_id),$htmlOptions);
                ?>
                <?php echo $form->error($property,'city_id',array('class'=>'tip-holder')); ?>
                </span>
			
			</li>
          
            <li>
				<label>具备浴室：<span>*</span></label>
				<span>
					<?php
					$htmlOptions = array('prompt'=>CHtml::encode(Yii::t('form','请选择浴室')),'required'=>true,'data-messages'=>'required:<i></i>请选择浴室');
					echo $form->dropDownList($property,'bathroom',$property->getBathrooms(),$htmlOptions);
					?>
				</span>	
                <?php echo $form->error($property,'bathroom',array('class'=>'tip-holder')); ?>
            </li>
            <li>
                <?php echo CHtml::label(Yii::t('property','住所面积').'：',null); ?>
                <span>
					<?php echo $form->textField($property,'area_sqm',array('size'=>9,'maxlength'=>9,'class'=>'sqm','data-rules'=>'number:true','data-messages'=>'number:<i></i>住所面积必须为数字','placeholder'=>'请输入住所面积')); ?>
					<?php echo $form->textField($property,'area_sqf',array('size'=>9,'maxlength'=>9,'class'=>'sqf','style'=>'display:none;')); ?>
				</span>
                <select id="select-area">
                    <option value="sqm"><?php echo CHtml::encode(Yii::t('property','平方米'));?></option>
                    <option value="sqf"><?php echo CHtml::encode(Yii::t('property','平方英尺'));?></option>
                </select>
				<span class="warnning">请输入住所的总面积</span>
                <?php echo $form->error($property,'area_sqm',array('class'=>'tip-holder')); ?>
            </li>
			<li>
				<label>便利设施：</label>
			</li>
			<li>
				<ul class="clearfix" id="fac-list">
                    <?php $data_A = Property::getAmenity() ;?>
                    <?php if ($data_A):?>
                    <?php foreach($data_A as $key=>$v): ?>
					<li>
						<input type="checkbox" name="Property[amenity][]" value="<?php echo $key; ?>" /><?php echo $v; ?>
					</li>
                    <?php endforeach;?>
                    <?php endif;?>
                   
				
                </ul>
                 <?php echo $form->error($property,'amenity',array('class'=>'tip-holder')); ?>
			</li>
         
			<li class="btn-wrap">
				<span class="btn-line property-btn"><?php echo CHtml::submitButton(CHtml::encode(Yii::t('form','下一步')),array()); ?></span>
				<span class="note-red">温馨提示：</span>
				当您快速发布产品后，可以继续进行更详细的产品设置，包括添加更详细的介绍、不同的价格等。
			</li>
        </ul>
	<?php $this->endWidget(); ?>
<!-- form -->


<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
<script>
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



