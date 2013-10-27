<?php
/* @var $this ConfigurationGroupController */
/* @var $data ConfigurationGroup */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('configuration_group_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->configuration_group_id), array('view', 'id'=>$data->configuration_group_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('title')); ?>:</b>
	<?php echo CHtml::encode($data->title); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('description')); ?>:</b>
	<?php echo CHtml::encode($data->description); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('configurations')); ?>:</b>
	<?php echo CHtml::link('Configurations List',$this->createUrl('configuration/index',array('configuration_group_id'=>$data->configuration_group_id))); ?>
	<br />


</div>