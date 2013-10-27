<?php
/* @var $this SystemTranslationController */
/* @var $model SystemTranslation */

$this->breadcrumbs=array(
	'System Translations'=>array('index'),
	$model->system_translation_id,
);

$this->menu=array(
	array('label'=>'List SystemTranslation', 'url'=>array('index')),
	array('label'=>'Create SystemTranslation', 'url'=>array('create')),
	array('label'=>'Update SystemTranslation', 'url'=>array('update', 'id'=>$model->system_translation_id)),
	array('label'=>'Delete SystemTranslation', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->system_translation_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage SystemTranslation', 'url'=>array('admin')),
);
?>
<div class="main-wrap clearfix pb10">

<h1>View SystemTranslation #<?php echo $model->system_translation_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'system_translation_id',
		'system_source_id',
		'language',
		'message',
	),
)); ?>

</div>