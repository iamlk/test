<?php
/* @var $this ConfigurationGroupController */
/* @var $model ConfigurationGroup */

$this->breadcrumbs=array(
	'Configuration Groups'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List ConfigurationGroup', 'url'=>array('index')),
	array('label'=>'Create ConfigurationGroup', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#configuration-group-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<div class="main-wrap clearfix pb10">

<h1>Manage Configuration Groups</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'configuration-group-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'configuration_group_id',
		'title',
		'description',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>

</div>
