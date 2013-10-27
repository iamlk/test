<?php $article = Article::model()->findByPk($_GET['id']); ?>
<div id="results-list">
<ul id="comment-list-new">
<?php foreach($article->AllReview['reviews'] as $item){
        echo $item;
      }
?>
</ul>
<?php
$this->widget('application.widgets.PageToolbar' , array('pagination'=>$article->AllReview['pages'], 'ajaxContainerId'=>'results-list', 'useAjax'=>true, 'route'=>'article/reviews'));
?>
</div>