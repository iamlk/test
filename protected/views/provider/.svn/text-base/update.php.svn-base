<?php
/* @var $this ProviderController */
/* @var $model Provider */

$this->breadcrumbs=array(
	'Providers'=>array('index'),
	$model->provider_id=>array('view','id'=>$model->provider_id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Provider', 'url'=>array('index')),
	array('label'=>'Create Provider', 'url'=>array('create')),
	array('label'=>'View Provider', 'url'=>array('view', 'id'=>$model->provider_id)),
	array('label'=>'Manage Provider', 'url'=>array('admin')),
);
?>

<h1>Update Provider <?php echo $model->provider_id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>