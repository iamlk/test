

<div id="residence"  class="detail-list">
    <div class="zyxbox-tit5">
        <h3 class="tit-color5"><?php echo Yii::t('property','住所介绍'); ?></h3>
        <p class="tit-line"></p>
    </div>
    <div class="zyxbox-content">
      
		<div class="description_details clearfix">
			<ul class="table-striped intro">
				<li><label><?php echo Yii::t('property','住所类型'); ?>:</label><?php echo CHtml::encode($property->propertyType->propertyTypeAddendumLocal->type); ?></li>
				<?php if($property->bed): ?><li><label><?php echo Yii::t('property','床位总数'); ?>:</label><?php echo CHtml::encode(Yii::t('property','{%u}个',array('{%u}'=>$property->bed))); ?></li><?php endif; ?>
				<li><label><?php echo Yii::t('property','最多入住'); ?>:</label><?php echo CHtml::encode(Yii::t('property','{%u}人',array('{%u}'=>$property->person))); ?></li>
				<li><label><?php echo Yii::t('property','国家'); ?>:</label><span class="blue"><?php echo CHtml::encode($property->country->countryAddendumLocal->name); ?></span></li>
				<li><label><?php echo Yii::t('property','街区'); ?>:</label><span class="blue"><?php echo CHtml::encode($property->propertyAddendum->address); ?></span></li>
			</ul>
			<ul class="table-striped intro">
				<li><label><?php echo Yii::t('property','房间总计'); ?>:</label><?php echo CHtml::encode(Yii::t('property','{%u}间',array('{%u}'=>$property->room))); ?></li>
				<li><label><?php echo Yii::t('property','浴室个数'); ?>:</label><?php echo CHtml::encode(Yii::t('property','{%u}间',array('{%u}'=>$property->bathroom))); ?></li>
			<?php if($property->area_sqm != 0.00 && $property->area_sqm != 0){ ?>	<li><label><?php echo Yii::t('property','住所面积'); ?>:</label><?php echo CHtml::encode(Yii::t('property','{%u}平方米',array('{%u}'=>$property->area_sqm))); ?></li><?php } ?>
				<li><label><?php echo Yii::t('property','城市'); ?>:</label><span class="blue"><?php echo CHtml::encode($property->state->stateAddendumLocal->name.','.$property->city->cityAddendumLocal->name); ?></span></li>
			</ul>
		</div>
		
		
        <div class="residence-box ">
            <div class="fl mt10">
                <table>
                    <tr>
                        <td>
                            <?php echo ($property->propertyAddendum->description); ?>
                        </td>
                    </tr>
                </table>
            </div>

            <?php $this->widget('application.widgets.CustomerCard' , array('customer_id'=>$property->goods->customer_id));?>

        </div>
    </div>
</div>

