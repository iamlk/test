<?php $htmlOptions=array('class'=>'valid-form'); $form=$this->beginWidget('CActiveForm', array('htmlOptions'=>$htmlOptions,'id'=>'property-form', 'action'=>$this->createUrl('property/attention',array('property_id'=>$property->property_id)))); ?>
<?php if(Yii::app()->user->hasFlash('is_ok')):?>
       <?php if((strpos($property->step,'1') !== false) && (strpos($property->step,'2') !== false) && (strpos($property->step,'3') !== false) && (strpos($property->step,'4') !== false)): ?>
            <?php include '_msg.php'; ?>
        <?php else: ?>
            <div id="msg-box"><?php echo Yii::app()->user->getFlash('is_ok'); ?> </div>
        <?php endif; ?>
<?php endif;?>
<?php if(false && $property->getErrors()): ?>
 <div id="msg-box"><?php  echo $form->errorSummary(array($property,$propertyAddendum)); ?></div>
 <?php endif;?>
<ul class="info-list">
	<li>
		<label>最少入住天数：<span>*</span></label>
		<?php echo $form->textField($property,'min_night',array('maxlength'=>20,'required'=>true,'data-rules'=>'digits:true','data-messages'=>'required:<i></i>请填写最少入住天数,digits:<i></i>最少入住天数必须为整数')); ?>
        <?php echo $form->error($property,'min_night',array('class'=>'tip-holder')); ?>
	</li>
	<li>
		<label>最多入住天数：<span>*</span></label>
		<?php echo $form->textField($property,'max_night',array('maxlength'=>20,'required'=>true,'data-rules'=>'digits:true','data-messages'=>'required:<i></i>请填写最多入住天数,digits:<i></i>最多入住天数必须为整数')); ?>
		<span class="note-red">温馨提示：</span>0天表示没有限制
        <?php echo $form->error($property,'max_night',array('class'=>'tip-holder')); ?>
	</li>
	<li>
		<label>房屋守则：</label>
		<!--<textarea><?php echo $propertyAddendum->manual ?></textarea>-->
        <?php //echo $form->textArea($propertyAddendum,'manual',array()); ?>
        <?php $this->widget('KindEditor',array('name'=>'PropertyAddendum[manual]','value'=>$propertyAddendum->manual,'width'=>'560px','config'=>array('minWidth'=>500,'items'=>"['source','preview', 'cut', 'copy', 'paste',
        'plainpaste', 'wordpaste','formatblock', 'fontname', 'fontsize',  'forecolor', 'hilitecolor', 'bold',
        'italic', 'underline', 'strikethrough', 'lineheight', 'removeformat','hr','link', 'unlink']"))); ?>
         <?php echo $form->error($propertyAddendum,'manual',array('class'=>'tip-holder')); ?>
	</li>
	<li>
		<label></label>
		<span class="btn-line property-btn"><?php echo CHtml::submitButton(CHtml::encode(Yii::t('form','下一步')),array()); ?></span>
	</li>
</ul>
<?php $this->endWidget(); ?>