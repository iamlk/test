<?php
/* @var $this BusinessController */
/* @var $model Business */

$this->breadcrumbs=array(
	'Businesses'=>array('index'),
	$model->business_id,
);

$this->menu=array(
	array('label'=>'List Business', 'url'=>array('index')),
	array('label'=>'Create Business', 'url'=>array('create')),
	array('label'=>'Update Business', 'url'=>array('update', 'id'=>$model->business_id)),
	array('label'=>'Delete Business', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->business_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Business', 'url'=>array('admin')),
);
?>

<h1>View Business #<?php echo $model->business_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'business_id',
	),
)); ?>
