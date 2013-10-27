<?php ?>

<h2><?php echo CHtml::encode(Yii::t('propertySupply','完善住所信息')); ?></h2>

<?php $roomIds = $property->getRoomIds(); // 房间id数组集 ?>


<div id="property-top-bar">
    <?php echo CHtml::link('住所信息总览',array('property/preview','property_id'=>$property->property_id),array('class'=>'cur')); ?>
    <?php echo CHtml::link('住所房间信息',array('property/room','property_id'=>$roomIds[0])); ?>
</div>
<div class="info-wrap">
    <?php echo $this->renderPartial('_form', array('property'=>$property, 'propertyAddendum'=>$propertyAddendum, 'propertyPictures'=>$propertyPictures, 'propertyPrice'=>$propertyPrice )); ?>
    <?php echo $this->renderPartial('_price', array('property' => $property, 'propertyPrice' => $propertyPrice, 'propertyPriceOverrides' => $propertyPriceOverrides)); ?>
    <?php echo $this->renderPartial('_supply', array('property' => $property, 'propertyAddendum' => $propertyAddendum, 'propertyExtensions' => $propertyExtensions, 'propertyPrice' => $propertyPrice)); ?>
</div>