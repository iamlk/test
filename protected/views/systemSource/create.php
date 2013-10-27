<?php
/* @var $this SystemSourceController */
/* @var $model SystemSource */

$this->breadcrumbs=array(
	'System Sources'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List SystemSource', 'url'=>array('index')),
	array('label'=>'Manage SystemSource', 'url'=>array('admin')),
);
?>
<div class="main-wrap clearfix pb10">

<h1>Create SystemSource</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>

</div>
