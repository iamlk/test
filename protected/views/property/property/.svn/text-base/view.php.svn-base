<?php
/* @var $this PropertyController */
/* @var $model Property */

$this->breadcrumbs=array(
	'Propertys'=>array('index'),
	$model->property_id,
);

$this->menu=array(
	array('label'=>'List Property', 'url'=>array('index')),
	array('label'=>'Create Property', 'url'=>array('create')),
	array('label'=>'Update Property', 'url'=>array('update', 'id'=>$model->property_id)),
	array('label'=>'Delete Property', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->property_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Property', 'url'=>array('admin')),
);
?>
<div class="main-wrap clearfix pb10">

<h1>View Property #<?php echo $model->property_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'property_id',
		'landlord_id',
		'is_active',
		'property_type_id',
		'person',
		'room',
		'bed',
		'country_id',
		'state_id',
		'city_id',
		'phone',
		'zipcode',
		'longitude',
		'latitude',
		'min_night',
		'max_night',
		'in_time',
		'out_time',
		'property_policy_id',
	),
)); ?>

</div>
