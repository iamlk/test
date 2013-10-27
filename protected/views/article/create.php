<?php
/* @var $this ArticleController */
/* @var $model Article */

//$this->breadcrumbs=array(
//	'Articles'=>array('index'),
//	'Create',
//);
//
//$this->menu=array(
//	array('label'=>'List Article', 'url'=>array('index')),
//	array('label'=>'Manage Article', 'url'=>array('admin')),
//);
Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl.'/css/raiders_release.css');
?>
<div class="main-wrap clearfix pb10">
<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
</div>