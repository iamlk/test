<?php
/* @var $this ConfigurationController */
/* @var $model Configuration */

$this->breadcrumbs=array(
	'Configurations'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Configuration', 'url'=>array('index')),
	array('label'=>'Manage Configuration', 'url'=>array('admin')),
);
?>

<div class="main-wrap clearfix pb10">



<h1>Create Configuration</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>

</div>