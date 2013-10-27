<?php ?>

<h2><?php echo CHtml::encode(Yii::t('propertySupply','完善住所信息')); ?></h2>
<div class="has-temp has-sidebar">
<div id="pro-sidebar">
	<?php $this->renderPartial('_menu'); ?>
</div>
<div class="info-wrap">

<?php echo $this->renderPartial('_price', array('property' => $property, 'propertyPrice' => $propertyPrice, 'propertyPriceOverrides' => $propertyPriceOverrides)); ?>

<?php echo $this->renderPartial('_supply', array('property' => $property, 'propertyAddendum' => $propertyAddendum, 'propertyExtensions' => $propertyExtensions, 'propertyPrice' => $propertyPrice)); ?>

</div>
<div>