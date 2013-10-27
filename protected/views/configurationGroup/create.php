<?php
/* @var $this ConfigurationGroupController */
/* @var $model ConfigurationGroup */

$this->breadcrumbs=array(
	'Configuration Groups'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List ConfigurationGroup', 'url'=>array('index')),
	array('label'=>'Manage ConfigurationGroup', 'url'=>array('admin')),
);
?>

<div class="main-wrap clearfix pb10">

<h1>Create ConfigurationGroup</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>

</div>
