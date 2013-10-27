<?php
/* @var $this DestinationController */
/* @var $data Destination */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('destination_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->destination_id), array('view', 'id'=>$data->destination_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('belong_to_type')); ?>:</b>
	<?php echo CHtml::encode($data->belong_to_type); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('belong_to_id')); ?>:</b>
	<?php echo CHtml::encode($data->belong_to_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('created')); ?>:</b>
	<?php echo CHtml::encode($data->created); ?>
	<br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('created')); ?>:</b>
    <?php echo CHtml::encode($data->city->cityAddendum['name']); ?>


</div>