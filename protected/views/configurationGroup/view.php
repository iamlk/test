<?php
/* @var $this ConfigurationGroupController */
/* @var $model ConfigurationGroup */

$this->breadcrumbs=array(
	'Configuration Groups'=>array('index'),
	$model->title,
);

$this->menu=array(
	array('label'=>'List ConfigurationGroup', 'url'=>array('index')),
	array('label'=>'Create ConfigurationGroup', 'url'=>array('create')),
	array('label'=>'Update ConfigurationGroup', 'url'=>array('update', 'id'=>$model->configuration_group_id)),
	array('label'=>'Delete ConfigurationGroup', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->configuration_group_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage ConfigurationGroup', 'url'=>array('admin')),
);
?>

<div class="main-wrap clearfix pb10">

<h1>View ConfigurationGroup #<?php echo $model->configuration_group_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'configuration_group_id',
		'title',
		'description',
	),
)); ?>

</div>
