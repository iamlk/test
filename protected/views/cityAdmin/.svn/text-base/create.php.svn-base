<?php
/* @var $this CityController */
/* @var $model City */

$this->breadcrumbs=array(
	'Cities'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List City', 'url'=>array('index')),
	array('label'=>'Manage City', 'url'=>array('admin')),
);
Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl.'/css/destination_list.css');
?>
<script type="text/javascript" src="/js/uploadify/jquery.uploadify.js"></script>
<?php echo $this->renderPartial('_form', array('model'=>$model,'type'=>'create')); ?>