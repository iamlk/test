<?php
/* @var $this ProviderController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Providers',
);

$this->menu=array(
	array('label'=>'Create Provider', 'url'=>array('create')),
	array('label'=>'Manage Provider', 'url'=>array('admin')),
);
?>

<h1>Providers</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
