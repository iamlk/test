<div  id="recive_reply">
<ul class="talk-list">
<?php foreach($recive->getData() as $item):?>

  <?php  $key =array_keys($item);?>
  
   <?php if($this->actionGetReviewType($key[0])=='article')://攻略的回复?>
   
   <?php include('_article_recive_list.php');?>
   
   <?php endif;?>
   
   
   <?php if($this->actionGetReviewType($key[0])=='album')://景点的回复?>
 
   <?php include('_albumimage_recive_list.php');?>
   
   <?php endif;?>
   
   
<?php endforeach;?>
</ul>
<?php
$this->widget('application.widgets.PageToolbar' , array('pagination'=>$recive->pagination, 'ajaxContainerId'=>'recive_reply','useAjax'=>true, 'route'=>'center/recivereplypage'));
?>
</div>
