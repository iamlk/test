<?php
/* @var $this SystemSourceController */
/* @var $model SystemSource */

$this->breadcrumbs=array(
	'System Sources'=>array('index'),
	$model->system_source_id,
);

$this->menu=array(
	array('label'=>'List SystemSource', 'url'=>array('index')),
	array('label'=>'Create SystemSource', 'url'=>array('create')),
	array('label'=>'Update SystemSource', 'url'=>array('update', 'id'=>$model->system_source_id)),
	array('label'=>'Delete SystemSource', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->system_source_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage SystemSource', 'url'=>array('admin')),
);
?>
<div class="main-wrap clearfix pb10">

<h1>View SystemSource #<?php echo $model->system_source_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'system_source_id',
		'category',
		'message',
	),
)); ?>

</div>
