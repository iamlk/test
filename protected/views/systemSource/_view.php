<?php
/* @var $this SystemSourceController */
/* @var $data SystemSource */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('system_source_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->system_source_id), array('view', 'id'=>$data->system_source_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('category')); ?>:</b>
	<?php echo CHtml::encode($data->category); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('message')); ?>:</b>
	<?php echo CHtml::encode($data->message); ?>
	<br />


</div>