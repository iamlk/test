<div  id="send_reply">
<ul class="talk-list">
<?php foreach($send->getData() as $item):?>
 
  <?php  $key =array_keys($item); ?>
  
   <?php if($this->actionGetReviewType($key[0])=='article')://攻略的回复?>
 
   <?php include('_article_send_list.php');?>
   
   <?php endif;?>
   
   
   
   <?php if($this->actionGetReviewType($key[0])=='delicacy')://美食的回复?>
 
   <?php  include('_delicacy_send_list.php');?>
   
   <?php endif;?>
   
   
   <?php if($this->actionGetReviewType($key[0])=='restaurant')://餐厅的回复?>
 
   <?php include('_restaurant_send_list.php');?>
   
   <?php endif;?>
 
   
   <?php if($this->actionGetReviewType($key[0])=='attraction')://景点的回复?>
 
   <?php include('_attraction_send_list.php');?>
   
   <?php endif;?>
   
   <?php if($this->actionGetReviewType($key[0])=='album')://景点的回复?>
 
   <?php include('_albumimage_send_list.php');?>
   
   <?php endif;?>
   
   
<?php endforeach;?>
</ul>
<?php
$this->widget('application.widgets.PageToolbar' , array('pagination'=>$send->pagination, 'ajaxContainerId'=>'send_reply','useAjax'=>true, 'route'=>'center/sendreplypage'));
?>
</div>
