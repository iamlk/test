<?php if(Yii::app()->user->hasFlash('is_ok')):?>
       <?php if((strpos($property->step,'1') !== false) && (strpos($property->step,'2') !== false) && (strpos($property->step,'3') !== false) && (strpos($property->step,'4') !== false)): ?>
         <?php include '_msg.php'; ?>
        <?php else: ?>
            <div id="msg-box"><?php echo Yii::app()->user->getFlash('is_ok'); ?> </div>
        <?php endif; ?>
<?php endif;?>
<p class="setup-column">你可以更详细的填写每个卧室信息或添加其他与众不同的信息</p>
<ul id="room-list" class="tab">
<?php $i=1;  foreach($propertyRoom as $v):?>

	<li>
    <?php $htmlOptions=array('class'=>'valid-form'); $form=$this->beginWidget('CActiveForm', array('htmlOptions'=>$htmlOptions,'id'=>'property-room-form'.$i)); ?>
		<a href="javascript:;" <?php if($v->bed && $v->bed_type): ?> class="tab-btn" <?php else:?> class="tab-btn on" <?php static $_is_show = 1; endif;?>   rel='room_<?php echo $i; ?>'>卧室<?php echo $i; ?></a>
		<ul class="info-list" id="room_<?php echo $i; ?>" <?php if($v->bed && $v->bed_type): ?> <?php elseif($_is_show == 1):?> style="display:block;"  <?php endif;?>  >
			<li>
				<label>卧室面积：</label>
                 <?php echo $form->textField($v,'area_sqm',array('size'=>9,'maxlength'=>9,'class'=>'sqm')); ?>
                 <?php echo $form->textField($v,'area_sqf',array('size'=>9,'maxlength'=>9,'class'=>'sqf','style'=>'display:none;')); ?>
                <select id="select-area">
                    <option value="sqm"><?php echo CHtml::encode(Yii::t('property','平方米'));?></option>
                    <option value="sqf"><?php echo CHtml::encode(Yii::t('property','平方英尺'));?></option>
                </select>
				<span class="warnning">请输入住所的总面积</span>
                <?php echo $form->error($v,'area_sqm',array('class'=>'tip-holder')); ?>
                
			</li>
			<li>
				<label>床位数：</label>
				 <?php
                $htmlOptions = array('prompt'=>CHtml::encode(Yii::t('form','请选择床位')),'class'=>'zyx-ipt');
                echo $form->dropDownList($v,'bed',Property::getBeds(),$htmlOptions);
                ?>
                <?php echo $form->error($v,'bed',array('class'=>'tip-holder')); ?>
			</li>
			<li>
				<label>床型：</label>
				<?php
                $htmlOptions = array('prompt'=>CHtml::encode(Yii::t('form','请选择床型')),'class'=>'zyx-ipt');
                echo $form->dropDownList($v,'bed_type',Property::getBedType(),$htmlOptions);
                ?>
                <?php echo $form->error($v,'bed_type',array('class'=>'tip-holder')); ?>
			</li>
			<li>
				<label>独立浴室：</label>
				<?php  $htmlOptions = array('prompt'=>CHtml::encode(Yii::t('form','请选择浴室')),'class'=>'zyx-ipt');
                 echo $form->dropDownList($v,'is_share_bathroom',Property::getBathType(),$htmlOptions); ?>
                <?php echo $form->error($v,'is_share_bathroom',array('class'=>'tip-holder')); ?>
			</li>
            <li class="aln-center">
            <?php echo $form->hiddenField($v,'parent_property_id'); ?>
            <?php echo $form->hiddenField($v,'property_id'); ?>
		      <span class="btn-line property-btn"><input type="submit" value="保存" name="yt0"/></span>
	       </li>
		</ul>
          <?php $this->endWidget(); ?>
	</li>
    
<?php $i++;  endforeach; ?>

       

	<li>
        <?php $form=$this->beginWidget('CActiveForm', array('id'=>'property-room-form_other')); ?>
    		<a href="javascript:;" <?php if(isset($_is_show) === false): ?>class="tab-btn solid on" <?php else:?> class="tab-btn solid" <?php endif;?>  rel='room_other'>添加其他</a>
    		<ul class="info-list" id="room_other" <?php if(isset($_is_show) === false): ?> style="display: block;"  <?php endif; ?>>
    			<li>
    			
    				<?php echo $form->textArea($propertyAddendum,'other'); ?>
                    <?php echo $form->error($propertyAddendum,'other',array('class'=>'tip-holder')); ?>
    			</li>
                <li class="aln-center">
                 <?php echo $form->hiddenField($property,'property_id'); ?>
    		      <span class="btn-line property-btn"><input type="submit" value="保存" name="yt0"/></span>
    	       </li>	
    		</ul>
    	 <?php $this->endWidget(); ?> 
	</li>
 
</ul>
 