<?php
/* @var $this ConfigurationGroupController */
/* @var $model ConfigurationGroup */

$this->breadcrumbs=array(
	'Configuration Groups'=>array('index'),
	$model->title=>array('view','id'=>$model->configuration_group_id),
	'Update',
);

$this->menu=array(
	array('label'=>'List ConfigurationGroup', 'url'=>array('index')),
	array('label'=>'Create ConfigurationGroup', 'url'=>array('create')),
	array('label'=>'View ConfigurationGroup', 'url'=>array('view', 'id'=>$model->configuration_group_id)),
	array('label'=>'Manage ConfigurationGroup', 'url'=>array('admin')),
);
?>

<div class="main-wrap clearfix pb10">

<h1>Update ConfigurationGroup <?php echo $model->configuration_group_id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>

</div>
