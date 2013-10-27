<div id="property" class="issue">
	<?php ?>
	<h2><?php echo CHtml::encode(Yii::t('propertySupply','完善住所信息')); ?></h2>
	<div class="has-temp has-sidebar">
		<div id="pro-sidebar">
			<?php //$this->renderPartial('_menu',array('act'=>$act)); ?>
			<?php echo $menu; ?>
		</div>
		<div class="info-wrap">
			<?php if($act == 'info'): ?>
			<?php  $this->renderPartial('_info', array('property' => $property,'propertyAddendum' => $propertyAddendum,'propertyPictures' => $propertyPictures)); ?>
			<?php elseif($act == 'price'):?>
			<?php echo $this->renderPartial('_price', array('property' => $property, 'propertyPrice' => $propertyPrice, 'propertyPriceOverride' => $propertyPriceOverride)); ?>
			<?php elseif($act == 'attention'):?>
			<?php  $this->renderPartial('_attention',array('property'=>$property,'propertyAddendum' => $propertyAddendum)); ?>
			<?php elseif($act == 'other'):?>
			<?php  $this->renderPartial('_other',array('property'=>$property,'propertyAddendum' => $propertyAddendum,'propertyRoom'=>$propertyRoom)); ?>
			<?php elseif($act == 'contact'):?>
			<?php  $this->renderPartial('_contact',array('property'=>$property)); ?>
			<?php endif;?>
		</div>
	</div>
</div>