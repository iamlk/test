<?php
/* @var $this SystemSourceController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'System Sources',
);

$this->menu=array(
	array('label'=>'Create SystemSource', 'url'=>array('create')),
	array('label'=>'Manage SystemSource', 'url'=>array('admin')),
);
?>
<div class="main-wrap clearfix pb10">

<h1>System Sources</h1>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'dataProvider'=>$dataProvider,
	//'itemView'=>'_view',
    'columns'=>array(
        'system_source_id:raw:ID',
        'category',
		array(
			'class'=>'CDataColumn',
            'header'=>CHtml::encode(Yii::t('manage','原文')),
            'name'=>'message',
		),
        array(
			'class'=>'CDataColumn',
            'header'=>CHtml::encode(Yii::t('manage','译文总数')),
            'value'=>'$data->systemTranslationCount',
		),
        array(
            'class'=>'CLinkColumn',
            'header'=>CHtml::encode(Yii::t('manage','查看译文')),
            'label'=>CHtml::encode(Yii::t('manage','查看译文')),
            'urlExpression'=>'Yii::app()->createUrl("systemTranslation/index",array("system_source_id"=>$data->system_source_id))',
        ),
		array(
			'class'=>'CButtonColumn',
            'header'=>CHtml::encode(Yii::t('manage','管理')),
		),
    ),
)); ?>

</div>
