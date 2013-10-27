<?php if(Yii::app()->user->hasFlash('is_ok')):?>
       <?php if((strpos($property->step,'1') !== false) && (strpos($property->step,'2') !== false) && (strpos($property->step,'3') !== false) && (strpos($property->step,'4') !== false)): ?>
            <?php include '_msg.php'; ?>
        <?php else: ?>
            <div id="msg-box"><?php echo Yii::app()->user->getFlash('is_ok'); ?> </div>
        <?php endif; ?>
        
<?php endif;?>

<?php $htmlOptions=array('class'=>'valid-form'); $form=$this->beginWidget('CActiveForm', array('htmlOptions'=>$htmlOptions,'id'=>'property-form', 'action'=>$this->createUrl('property/contact',array('property_id'=>$property->property_id)))); ?>
<?php if(false && $property->getErrors()): ?>
 <div id="msg-box"><?php  echo $form->errorSummary(array($property)); ?></div>
 <?php endif;?>
<ul class="info-list">
	<li>
		<label>手机号码：</label>
		<?php echo $form->textField($property,'phone',array('size'=>29,'maxlength'=>20,'class'=>'zyx-ipt w150')); ?>
        <?php echo $form->error($property,'phone',array('class'=>'tip-holder')); ?>
	</li>
	<li>
		<label>坐机号码：</label>
        
        <?php $telephone = $property->telephone; $tel_arr=array(); if($telephone) $tel_arr = explode('[#]',$telephone);?>
        
		<input type="text" class="short" name="tel_bf" value="<?php echo $tel_arr[0]; ?>" />
		<span>-</span>
		<input type="text" name="tel_af" value="<?php echo $tel_arr[1]; ?>" />
        <?php echo $form->error($property,'telephone',array('class'=>'tip-holder')); ?>
        <?php if(Yii::app()->user->hasFlash('telephone')):?>
        <span class="tip-holder"><?php echo Yii::app()->user->getFlash('telephone'); ?> </span>
        <?php endif;?>
	</li>
	<li>
		<label></label>
		<span class="btn-line property-btn"><?php echo CHtml::submitButton(CHtml::encode(Yii::t('form','保存')),array()); ?></span>
	</li>
</ul>
<?php $this->endWidget(); ?>