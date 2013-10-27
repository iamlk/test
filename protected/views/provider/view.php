<?php
/* @var $this ProviderController */
/* @var $model Provider */

$this->breadcrumbs=array(
	'Providers'=>array('index'),
	$model->provider_id,
);

$this->menu=array(
	array('label'=>'List Provider', 'url'=>array('index')),
	array('label'=>'Create Provider', 'url'=>array('create')),
	array('label'=>'Update Provider', 'url'=>array('update', 'id'=>$model->provider_id)),
	array('label'=>'Delete Provider', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->provider_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Provider', 'url'=>array('admin')),
);
?>

<h1>View Provider #<?php echo $model->provider_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'provider_id',
		'first_name',
		'last_name',
		'email',
		'password',
		'created',
		'updated',
	),
)); ?>
