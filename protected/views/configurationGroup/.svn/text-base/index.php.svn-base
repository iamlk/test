<?php
/* @var $this ConfigurationGroupController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Configuration Groups',
);

$this->menu=array(
	array('label'=>'Create ConfigurationGroup', 'url'=>array('create')),
	array('label'=>'Manage ConfigurationGroup', 'url'=>array('admin')),
);
?>

<div class="main-wrap clearfix pb10">

<h1>Configuration Groups</h1>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'dataProvider'=>$dataProvider,
	//'itemView'=>'_view',
    'columns'=>array(
		'configuration_group_id:raw:ID',
		'title',
		'description',
		array(
			'class'=>'CDataColumn',
            'header'=>CHtml::encode(Yii::t('manage','配置总数')),
            'value'=>'$data->configurationCount',
		),
        array(
            'class'=>'CLinkColumn',
            'header'=>CHtml::encode(Yii::t('manage','查看配置')),
            'label'=>CHtml::encode(Yii::t('manage','查看配置')),
            'urlExpression'=>'Yii::app()->createUrl("configuration/index",array("configuration_group_id"=>$data->configuration_group_id))',
        ),
		array(
			'class'=>'CButtonColumn',
            'header'=>CHtml::encode(Yii::t('manage','管理')),
		),
	),
)); ?>

</div>