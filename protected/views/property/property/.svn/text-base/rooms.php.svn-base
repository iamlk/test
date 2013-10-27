<?php /** 房间集，同时显示其它间的链接 */ ?>

<h2><?php echo CHtml::encode(Yii::t('property','住所房间信息')); ?></h2>

<?php $house = $property->propertyHouse; // 房屋 ?>
<?php $rooms = $house->propertyRooms; // 房间集 ?>

<div id="property-top-bar">
    <?php echo CHtml::link('住所信息总览',array('property/preview','property_id'=>$house->property_id)); ?>
    <?php echo CHtml::link('住所房间信息',array('property/room','property_id'=>$property->property_id),array('class'=>'cur')); ?>
</div>
<div class="info-wrap">

<?php if (count($rooms)>1) : ?>
    <div>
    <?php $form=$this->beginWidget('CActiveForm', array('action'=>$this->createUrl('property/dispersive',array('property_id'=>$house->property_id)),'id'=>'property-dispersive-form')); ?>
        <div class="setup-column">
            <p>如果您决定同时可以零租住所的每个房间，请你设置每个房间的价格，如果没有设置价格将不能零租。</p>
                <?php echo $form->radioButtonList($house,'is_dispersive',array(1=>'我要零租',0=>'我不零租'),array('separator'=>'&nbsp;&nbsp;&nbsp;&nbsp;')); ?>
                <?php echo CHtml::hiddenField('returnUrl',Yii::app()->request->requestUri); ?>
        </div>
        <div class="row buttons undis">
            <?php echo CHtml::submitButton(CHtml::encode(Yii::t('form','确定')),array('class'=>'zyxbtn3')); ?>
        </div>
    <?php $this->endWidget(); ?>
	</div>
<?php endif; ?>

	<ul>
		<?php $all_isok = true; foreach ($rooms as $k=>$room) : $me_isok=$room->checkRoomActive(); $all_isok=$me_isok && $all_isok; ?>
		<li>
			<h3 <?php echo ($room->property_id==$property->property_id?'class="cur"':''); ?>>
			<?php echo CHtml::encode(Yii::t('property',(count($rooms)>1?'房间{%u}':'房间信息'),array('{%u}'=>$k+1))); ?>
			<?php echo ($room->property_id==$property->property_id?'':CHtml::link(Yii::t('property',(count($rooms)>1?'修改':'房间信息'),array('{%u}'=>$k+1)),array('property/room','property_id'=>$room->property_id))); ?>
			</h3>
			<?php if ($room->property_id==$property->property_id) : ?>
			<div>
				<?php echo $this->renderPartial('_room', array('property'=>$property, 'propertyAddendum' => $propertyAddendum, 'propertyPictures' => $propertyPictures, 'propertyPrice' => $propertyPrice, 'propertyPriceOverrides' => $propertyPriceOverrides, 'house' => $house)); ?>
			</div>
			<?php endif; ?>
		</li>
		<?php endforeach; ?>
        <?php if ($all_isok) : ?>
        <li>
            <?php $form=$this->beginWidget('CActiveForm', array('action'=>$this->createUrl('property/active',array('property_id'=>$house->property_id)),'id'=>'property-active-form')); ?>
            <div>
                <?php echo CHtml::submitButton(CHtml::encode(Yii::t('form','发布')),array('class'=>'btn')); ?>
            </div>
            <?php $this->endWidget(); ?>
        </li>
        <?php else : ?>
        <?php endif; ?>
	</ul>

</div>
<script>
	$('#Property_is_dispersive_0,#Property_is_dispersive_1').change(function(){
		$('#property-dispersive-form').submit();}
	);
</script>