<?php
 /** 房间.一个 */
 Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/lib.js');
?>

<div>
<?php $form=$this->beginWidget('CActiveForm', array('id'=>'property-room-form')); ?>

    <?php echo $form->errorSummary(array($property,$propertyAddendum),'','',array('class'=>'xundis')); ?>

        <?php echo $form->hiddenField($property,'property_id'); ?>
        <style>ul.room-info label {width:100px;}</style>

        <ul class="info-list">
            <li>
                <?php echo CHtml::label(Yii::t('property','房间名称').':',null); ?>
                <?php echo $form->textField($propertyAddendum,'title',array('size'=>40,'maxlength'=>40,'class'=>'zyx-ipt w100')); ?>
                <span><?php echo CHtml::encode(Yii::t('property','请为房间名一个简短名称，便于客人在预订时查看。如：主卧、朝南卧室等。')); ?></span>
                <?php echo $form->error($propertyAddendum,'title',array('class'=>'tip-holder')); ?>
            </li>
            <li>
                <?php echo CHtml::label(Yii::t('property','最多入住').':',null); ?>
                <?php
                //$htmlOptions = array('prompt'=>CHtml::encode(Yii::t('form','请选择...')),'class'=>'zyx-ipt');
                // TODO: if ($cid=(int)Yii::app()->request->getParam('currency_id')) $htmlOptions['options'] = array($cid=>array('selected'=>true));
                //echo $form->dropDownList($property,'person',Property::getPersons(),$htmlOptions);
                ?>
                <?php echo $form->textField($property,'person',array('size'=>4,'maxlength'=>4,'class'=>'zyx-ipt','value'=>($propertyAddendum->title?$property->person:''))); ?>
                <span>人</span>
                <?php echo $form->error($property,'person',array('class'=>'tip-holder')); ?>
            </li>
            <li>
                <?php echo CHtml::label(Yii::t('property','房间床位').':',null); ?>
                <?php
                $htmlOptions = array('prompt'=>CHtml::encode(Yii::t('form','请选择床位')),'class'=>'zyx-ipt');
                echo $form->dropDownList($property,'bed',Property::getBeds(),$htmlOptions);
                ?>
                <?php echo $form->error($property,'bed',array('class'=>'tip-holder')); ?>
            </li>
            <li>
                <?php echo CHtml::label(Yii::t('property','房间床型').':',null); ?>
                <?php
                $htmlOptions = array('prompt'=>CHtml::encode(Yii::t('form','请选择床型')),'class'=>'zyx-ipt');
                echo $form->dropDownList($property,'bed_type',Property::getBedType(),$htmlOptions);
                ?>
                <?php echo $form->error($property,'bed_type',array('class'=>'tip-holder')); ?>
            </li>
            <li class="has-washroom">
                <?php echo CHtml::label(Yii::t('property','具备浴室').':',null); ?>
                <?php echo $form->radioButtonList($property,'is_share_bathroom',array(0=>'独立浴室',1=>'公共浴室'),array('separator'=>'','uncheckValue'=>null)); ?>
            </li>
            <li>
                <?php echo CHtml::label(Yii::t('property','房间大小').':',null); ?>
                <?php echo $form->textField($property,'area_sqm',array('size'=>9,'maxlength'=>9,'class'=>'zyx-ipt w50','value'=>($propertyAddendum->title?$property->area_sqm:''))); ?>
                <?php echo $form->textField($property,'area_sqf',array('size'=>9,'maxlength'=>9,'class'=>'zyx-ipt w50','value'=>($propertyAddendum->title?$property->area_sqf:''),'style'=>'display:none;')); ?>
                <select id="select-area">
                    <option value="sqm"><?php echo CHtml::encode(Yii::t('property','平方米'));?></option>
                    <option value="sqf"><?php echo CHtml::encode(Yii::t('property','平方英尺'));?></option>
                </select>
                <?php echo $form->error($property,'area_sqm',array('class'=>'tip-holder')); ?>
            </li>
            <?php if ($house and $house->is_dispersive) : ?>
            <li>
                <?php echo CHtml::label(Yii::t('property','零租价格').':',null); ?>
                <span>$</span>
                <?php echo $form->textField($propertyPrice,'day_price',array('size'=>9,'maxlength'=>9,'class'=>'zyx-ipt w50')); ?>
                <span>/<?php echo CHtml::encode(Yii::t('property','晚')); ?></span>
                <?php echo $form->error($propertyPrice,'day_price',array('class'=>'tip-holder')); ?>
            </li>
            <?php endif; ?>
            <li  class="place-guise">
                <?php echo CHtml::label(Yii::t('property','房间图片').':',null); ?>
                <div class="upload-img-wrap">
                    <?php echo $this->renderPartial('_image', array('property'=>$property, 'propertyPictures'=>$propertyPictures)); ?>
                </div>
                <?php echo $form->error($property,'propertyPicture',array('class'=>'tip-holder')); ?>
            </li>
        </ul>
			<?php if ($house and $house->is_dispersive) : ?>
				<?php echo $this->renderPartial('_room_price', array('property'=>$property, 'propertyPrice' => $propertyPrice, 'propertyPriceOverrides' => $propertyPriceOverrides)); ?>
				
            <?php endif; ?>
			<p class="aln-center">
				<span class="btn-line property-btn">
					<?php echo CHtml::submitButton(CHtml::encode(Yii::t('form','保存'))); ?>
				</span>
			</p>

<?php $this->endWidget(); ?>

</div><!-- form -->
<script type="text" id="extend-img">
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
<script>
	$('#Property_area_sqm').change(function(){
		var val=$(this).val();
		$('#Property_area_sqm').val(Math.round(val*100)/100);
		$('#Property_area_sqf').val(Math.round(val*10.76391041671*100)/100);
	});
	$('#Property_area_sqf').change(function(){
		var val=$(this).val();
		$('#Property_area_sqf').val(Math.round(val*100)/100);
		$('#Property_area_sqm').val(Math.round(val*0.09290304*100)/100);
	})
	$('#select-area').change(function(){
		var val=$(this).val();
		if(val=='sqm'){
			$('#Property_area_sqf').hide();
			$('#Property_area_sqm').show();
		}else{
			$('#Property_area_sqf').show();
			$('#Property_area_sqm').hide();
		}
	})
</script>
