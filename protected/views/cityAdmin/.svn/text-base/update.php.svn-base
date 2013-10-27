<?php
/* @var $this CityController */
/* @var $model City */

$this->breadcrumbs=array(
	'Cities'=>array('index'),
	$model->city_id=>array('view','id'=>$model->city_id),
	'Update',
);

$this->menu=array(
	array('label'=>'List City', 'url'=>array('index')),
	array('label'=>'Create City', 'url'=>array('create')),
	array('label'=>'View City', 'url'=>array('view', 'id'=>$model->city_id)),
	array('label'=>'Manage City', 'url'=>array('admin')),
);
Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl.'/css/destination_list.css');
?>

<?php echo $this->renderPartial('_form', array('model'=>$model,'type'=>'update')); ?>