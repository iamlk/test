<?php
/* @var $this SystemTranslationController */
/* @var $dataProvider CActiveDataProvider */

$this->menu=array(
	array('label'=>'Create SystemTranslation', 'url'=>array('create')),
	array('label'=>'Manage SystemTranslation', 'url'=>array('admin')),
);
?>
<div class="main-wrap clearfix pb10">

<?php if ($criteria=$dataProvider->criteria and $criteria->condition and $source=SystemSource::model()->find($criteria)) : ?>
<h1>View SystemSource #<?php echo $source->system_source_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$source,
	'attributes'=>array(
		'system_source_id',
		'category',
		'message',
	),
)); ?>
<br />
<?php endif; ?>

<h1>System Translations</h1>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'dataProvider'=>$dataProvider,
	//'itemView'=>'_view',
    'columns'=>array(
        'system_translation_id:raw:ID',
        'system_source_id:raw:SID',
        'language',
		array(
			'class'=>'CDataColumn',
            'header'=>CHtml::encode(Yii::t('manage','译文')),
            'name'=>'message',
		),
		array(
			'class'=>'CButtonColumn',
            'header'=>CHtml::encode(Yii::t('manage','管理')),
		),
    ),
)); ?>

</div>
