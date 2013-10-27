<?php
/* @var $this DestinationController */
/* @var $model Destination */

$this->breadcrumbs=array(
	'Destinations'=>array('index'),
	$model->destination_id,
);

$this->menu=array(
	array('label'=>'List Destination', 'url'=>array('index')),
	array('label'=>'Create Destination', 'url'=>array('create')),
	array('label'=>'Update Destination', 'url'=>array('update', 'id'=>$model->destination_id)),
	array('label'=>'Delete Destination', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->destination_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Destination', 'url'=>array('admin')),
);
?>

<h1>View Destination #<?php echo $model->destination_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'destination_id',
		'belong_to_type',
		'belong_to_id',
		'created',
	),
)); ?>
