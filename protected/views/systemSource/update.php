<?php
/* @var $this SystemSourceController */
/* @var $model SystemSource */

$this->breadcrumbs=array(
	'System Sources'=>array('index'),
	$model->system_source_id=>array('view','id'=>$model->system_source_id),
	'Update',
);

$this->menu=array(
	array('label'=>'List SystemSource', 'url'=>array('index')),
	array('label'=>'Create SystemSource', 'url'=>array('create')),
	array('label'=>'View SystemSource', 'url'=>array('view', 'id'=>$model->system_source_id)),
	array('label'=>'Manage SystemSource', 'url'=>array('admin')),
);
?>
<div class="main-wrap clearfix pb10">

<h1>Update SystemSource <?php echo $model->system_source_id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>

</div>