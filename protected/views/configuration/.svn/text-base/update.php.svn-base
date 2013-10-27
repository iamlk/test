<?php
/* @var $this ConfigurationController */
/* @var $model Configuration */

$this->breadcrumbs=array(
	'Configurations'=>array('index'),
	$model->title=>array('view','id'=>$model->configuration_id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Configuration', 'url'=>array('index')),
	array('label'=>'Create Configuration', 'url'=>array('create')),
	array('label'=>'View Configuration', 'url'=>array('view', 'id'=>$model->configuration_id)),
	array('label'=>'Manage Configuration', 'url'=>array('admin')),
);
?>

<div class="main-wrap clearfix pb10">

<h1>Update Configuration <?php echo $model->configuration_id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>

</div>