<?php
/* @var $this SystemSourceController */
/* @var $model SystemSource */

$this->breadcrumbs=array(
	'System Sources'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List SystemSource', 'url'=>array('index')),
	array('label'=>'Create SystemSource', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#system-source-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>
<div class="main-wrap clearfix pb10">

<h1>Manage System Sources</h1>

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
	'id'=>'system-source-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'system_source_id',
		'category',
		'message',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>

</div>
