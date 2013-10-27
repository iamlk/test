<?php
/* @var $this SystemTranslationController */
/* @var $model SystemTranslation */

$this->breadcrumbs=array(
	'System Translations'=>array('index'),
	$model->system_translation_id=>array('view','id'=>$model->system_translation_id),
	'Update',
);

$this->menu=array(
	array('label'=>'List SystemTranslation', 'url'=>array('index')),
	array('label'=>'Create SystemTranslation', 'url'=>array('create')),
	array('label'=>'View SystemTranslation', 'url'=>array('view', 'id'=>$model->system_translation_id)),
	array('label'=>'Manage SystemTranslation', 'url'=>array('admin')),
);
?>
<div class="main-wrap clearfix pb10">

<h1>Update SystemTranslation <?php echo $model->system_translation_id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>

</div>
