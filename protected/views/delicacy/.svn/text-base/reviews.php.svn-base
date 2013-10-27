<?php $model = Delicacy::model()->findByPk($_GET['id']); ?>
<div id="results-list">
<ul id="comment-list-new">
<?php foreach($model->AllReview['reviews'] as $item){
        echo $item;
      }
?>
</ul>
<?php
$this->widget('application.widgets.PageToolbar' , array('pagination'=>$model->AllReview['pages'], 'ajaxContainerId'=>'results-list', 'useAjax'=>true, 'route'=>'article/reviews'));
?>
</div>