<?php
$rooms = $property->propertyRooms;
$_f = false;
 foreach($rooms as $v)
 {
    if($v->bed && $v->bedType)
    {
        $_f = true;
    }
 }

if ($_f) :
?>
                <div id="room" class="detail-list">
                    <div class="zyxbox-tit5">
                        <h3 class="tit-color5"><?php echo CHtml::encode(Yii::t('property','房间介绍')); ?></h3>
                        <p class="tit-line"></p>
                    </div>
                    <div class="zyxbox-content">
                    <?php $i=0; foreach ($rooms as $k=>$room) :  ?>
					    <?php if($i== 0){ ?>
                        <h4 class="room-tit"><span class="orange">房间<?php echo $k+1; ?></span><?php echo CHtml::encode($room->propertyAddendum->title); ?></h4>
						<?php }else{ ?>
						 <h4 class="room-tit mt20"><span class="orange">房间<?php echo $k+1; ?></span><?php echo CHtml::encode($room->propertyAddendum->title); ?></h4>
						<?php }; ?>
                       
						<div class="description_details clearfix">
							<ul class="table-striped intro">
								<?php if($room->person): ?><li><label><?php echo CHtml::encode(Yii::t('property','可以入住')); ?>:</label><?php echo CHtml::encode(Yii::t('property','{%u}人',array('{%u}'=>$room->person))); ?></li><?php endif; ?>
								<?php if($room->bed): ?><li><label><?php echo CHtml::encode(Yii::t('property','房间床位')); ?>:</label><?php echo CHtml::encode(Yii::t('property','{%u}个',array('{%u}'=>$room->bed))); ?></li><?php endif; ?>
								<li><label><?php echo CHtml::encode(Yii::t('property','房间床型')); ?>:</label><?php  echo CHtml::encode(Yii::t('property',Property::getBedType((int)$room->bed_type))); ?></li>
							</ul>
							<ul class="table-striped intro">
								<li><label><?php echo CHtml::encode(Yii::t('property','具备浴室')); ?>:</label><?php  echo  ($room->is_share_bathroom == 0)?'独立浴室':'公共浴室'; ?></li>
								<?php if($room->area_sqm!=0.00): ?><li><label><?php echo CHtml::encode(Yii::t('property','房间大小')); ?>:</label><?php echo CHtml::encode(Yii::t('property','{%u}平方米',array('{%u}'=>$room->area_sqm))); ?></li><?php endif; ?>
								<li><label><?php echo CHtml::encode(Yii::t('property','每日价格')); // TODO: ?>:</label>$<?php echo $property->propertyPrice->day_price; ?></li>
							</ul>
						</div>
						

                    <?php $i++; endforeach; ?>
                    </div>
                </div>

<?php endif; ?>