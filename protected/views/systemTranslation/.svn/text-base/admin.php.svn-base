<?php
/* @var $this SystemTranslationController */
/* @var $model SystemTranslation */

$this->breadcrumbs=array(
	'System Translations'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List SystemTranslation', 'url'=>array('index')),
	array('label'=>'Create SystemTranslation', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#system-translation-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>
<div class="main-wrap clearfix pb10">

<h1>Manage System Translations</h1>

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
	'id'=>'system-translation-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'system_translation_id',
		'system_source_id',
		'language',
		'message',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>

</div>
