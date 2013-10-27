<?php
/* @var $this ConfigurationController */
/* @var $dataProvider CActiveDataProvider */

$this->menu=array(
	array('label'=>'Create Configuration', 'url'=>array('create')),
	array('label'=>'Manage Configuration', 'url'=>array('admin')),
);
?>

<div class="main-wrap clearfix pb10">

<?php if ($criteria=$dataProvider->criteria and $criteria->condition and $group=ConfigurationGroup::model()->find($criteria)) : ?>
<h1>View ConfigurationGroup #<?php echo $group->configuration_group_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$group,
	'attributes'=>array(
		'configuration_group_id',
		'title',
		'description',
	),
)); ?>
<br />
<?php endif; ?>

<h1>Configurations</h1>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'dataProvider'=>$dataProvider,
	//'itemView'=>'_view',
    'columns'=>array(
        'configuration_id:raw:ID',
        'configuration_group_id:raw:GID',
        'title',
        'description',
        'key',
        'value',
        'created',
        'updated',
		array(
			'class'=>'CButtonColumn',
            'header'=>CHtml::encode(Yii::t('manage','管理')),
		),
    ),
)); ?>

</div>
