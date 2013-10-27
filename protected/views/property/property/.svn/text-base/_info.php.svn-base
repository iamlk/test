<?php  Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/widget/uploader/swfobject.js'); ?>
<?php  Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/widget/uploader/uploader.js'); ?>
<?php  Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl.'/widget/uploader/uploader.css'); ?>
<?php $htmlOptions=array('class'=>'valid-form'); $form=$this->beginWidget('CActiveForm', array( 'htmlOptions'=>$htmlOptions,'id'=>'property-form', 'action'=>$this->createUrl('property/info',array('property_id'=>$property->property_id)))); ?>
<?php if(Yii::app()->user->hasFlash('is_ok')):?>
	
    <?php if((strpos($property->step,'1') !== false) && (strpos($property->step,'2') !== false) && (strpos($property->step,'3') !== false) && (strpos($property->step,'4') !== false)): ?>
        <?php include '_msg.php'; ?>
    <?php else :?>
        <div id="msg-box"><?php echo Yii::app()->user->getFlash('is_ok'); ?> </div>    
    <?php endif; ?>
    
    
<?php endif;?>



<?php if(false && $property->getErrors()): ?>
 <div id="msg-box"><?php  echo $form->errorSummary(array($property)); ?></div>
 <?php endif;?>
        <ul class="info-list">
            <li>
				
                <?php echo CHtml::label(Yii::t('property','住所类型').'：<span>*</span>',null); ?>
				<span>
                <?php $htmlOptions = array('prompt'=>CHtml::encode(Yii::t('form','请选择...')),'required'=>true,'data-messages'=>'required:<i></i>请选择住所类型');echo $form->dropDownList($property,'property_type_id',Property::getTypeList(),$htmlOptions);
                ?>
				</span>
                <?php echo $form->error($property,'property_type_id',array('class'=>'tip-holder')); ?>
            </li>
			
			
            <li>
                <?php echo CHtml::label(Yii::t('property','住所标题').'：<span>*</span>',null); ?>
                <?php echo $form->textField($propertyAddendum,'title',array('required'=>true,'data-messages'=>'required:<i></i>请填写住所标题','maxlength'=>40,'class'=>'long')); ?>
                <?php echo $form->error($propertyAddendum,'title',array('class'=>'tip-holder')); ?>
            </li>
           
            <li>
                <?php echo CHtml::label(Yii::t('property','住所描述').'：<span>*</span>',null); ?>
                <?php //echo $form->textArea($propertyAddendum, 'description',array('required'=>true,'data-messages'=>'required:<i></i>请填写住所描述')); ?>
                <?php $this->widget('KindEditor',array('name'=>'PropertyAddendum[description]','value'=>$propertyAddendum->description,'width'=>'560px','config'=>array('minWidth'=>500,'items'=>"['source','preview', 'cut', 'copy', 'paste',
        'plainpaste', 'wordpaste','formatblock', 'fontname', 'fontsize',  'forecolor', 'hilitecolor', 'bold',
        'italic', 'underline', 'strikethrough', 'lineheight', 'removeformat','hr','link', 'unlink']"))); ?>
				<?php echo $form->error($propertyAddendum,'description',array('class'=>'tip-holder')); ?>
            </li>
			 <li class="place-guise">
                <label>住所外观：<span>*</span></label>
				<div class="upload-img-wrap">
					<a href="javascript:;" id="add-new-album" class="add-new-album" data-for="review_result_photo" data-tempId="li-template">添加照片</a>
					<span class="warnning">请至少上传3张照片。</span>
					<ul class="upload-img-list clearfix" id="review_result_photo">
                    <?php if($propertyPictures): ?>
                            <?php $prex = Yii::app()->assetManager->baseUrl; foreach($propertyPictures as $v): ?>
                            <li>
                                <img width="155" height="105" src="<?php echo $prex.'/'.$v['path'] ?>">
                                <input type="hidden" name="ProductImages[path][]" value="<?php echo $v['path'] ?>" id="<?php echo $v['path'] ?>">
           		                <textarea name="ProductImages[title][]"><?php echo $v['note'] ?></textarea>	
							    <a class="remove-item" href="javascript:;">删除</a>
                            </li>
                            <?php endforeach;?>
                       
					<?php endif;?>
                    <?php if(Yii::app()->user->hasFlash('p_image_no')):?>
    	               <span class="tip-holder"><?php echo Yii::app()->user->getFlash('p_image_no'); ?></span> 
                    <?php endif;?>
					</ul>
				</div>
            </li>
            <?php if(false): ?>
            <?php /** leo 屏蔽 **/ ?>
			<li>
				<label>卧室总计：<span>*</span></label>
			    <span>
					<?php  $htmlOptions = array('prompt'=>CHtml::encode(Yii::t('form','请选择...')),'required'=>true,'data-messages'=>'required:<i></i>请选择卧室总计');
                    echo $form->dropDownList($property,'room',Property::getBedroom(),$htmlOptions); ?>
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
                <?php echo CHtml::label(Yii::t('property','具备浴室').'：<span>*</span>',null); ?>
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
					<?php echo $form->textField($property,'area_sqm',array('maxlength'=>9,'class'=>'sqm','data-rules'=>'number:true','data-messages'=>'number:<i></i>住所面积必须为数字','placeholder'=>'请输入住所面积')); ?>
					<?php echo $form->textField($property,'area_sqf',array('maxlength'=>9,'class'=>'sqf','style'=>'display:none;')); ?>
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
                        <?php $data_A = Property::getAmenity() ; $data_exist = json_decode($property->amenity,true); ?>
                        <?php if ($data_A):?>
                        <?php foreach($data_A as $key=>$v): ?>
    					<li>
    						<input type="checkbox" name="Property[amenity][]" value="<?php echo $key; ?>" 
                            <?php if(in_array($key,$data_exist)): ?>
                            checked="checked"
                            <?php endif;?>
                             /><?php echo $v; ?>
    					</li>
                        <?php endforeach;?>
                        <?php endif;?>
                       
    				
                    </ul>
                     <?php echo $form->error($property,'amenity',array('class'=>'tip-holder')); ?>
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
                    $htmlOptions['options'] = array($property->state_id=>array('selected'=>true));
                    $country_id = (int)$property->country_id;
                    echo $form->dropDownList($property,'state_id',Property::getStates($country_id),$htmlOptions);
                ?>
                <?php echo $form->error($property,'state_id',array('class'=>'tip-holder')); ?>
                </span>
                
                 <span>
                 <?php
                 // 城市
                    $htmlOptions = array('prompt'=>CHtml::encode(Yii::t('form','请选择...')),'required'=>true,'data-messages'=>'required:<i></i>请选择城市');
                     $state_id = (int)$property->state_id;
                    echo $form->dropDownList($property,'city_id',Property::getCities($state_id),$htmlOptions);
                ?>
                <?php echo $form->error($property,'city_id',array('class'=>'tip-holder')); ?>
                </span>
				<br />
				<label></label>
				<?php echo $form->textField($propertyAddendum,'address',array('maxlength'=>69,'class'=>'address','required'=>true,'data-messages'=>'required:<i></i>请填写具体地址信息')); ?>
                <?php echo $form->error($propertyAddendum,'address',array('class'=>'tip-holder')); ?>
               
            </li>
            <li>
                <?php echo CHtml::label(Yii::t('property','邮政编码').'：',null); ?>
                <?php echo $form->textField($property,'zipcode',array()); ?>
                <?php echo $form->error($property,'zipcode',array('class'=>'tip-holder')); ?>
            </li>
			<li>
                <label>路线说明：</label>
                <!--<textarea><?php echo $propertyAddendum->direction; ?></textarea>-->
                <?php echo $form->textArea($propertyAddendum, 'direction'); ?>
				 <?php echo $form->error($propertyAddendum,'direction',array('class'=>'tip-holder')); ?>
				
            </li>
         
			<li class="aln-center">
				<span class="btn-line property-btn"><?php echo CHtml::submitButton(CHtml::encode(Yii::t('form','下一步')),array()); ?></span>
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



