
<?php if($this->actionGetReviewType($key[0])=='property'):?>

 <?php
	
   $hf=Property::model()->getProperty_reviewHF($value['property_review_id']);
    
?>
<div class="reply-box">
   <div class="comment-form">
       <form action="">
           <a href="#" class="icon-btn comment-face" title="插入表情"></a>
           <textarea class="comment-txt" name=""></textarea>
           <a href="#" class="btn send-comment">评论</a>
           <p class="comment-function">
               <label for="and-reply"><input type="checkbox" class="and-reply" name="">同时转发到我的微博</label>
               <span class="comment-tip">sdfsdf</span>
           </p>
       </form>
   </div>
   <ul class="comment-list">
       
       <?php if(!empty($hf)):?>
        
        <?php foreach($hf as $value):?>
        
       <li>
           <div class="comment-user-pic"><a href="#"><img src="<?php echo Yii::app()->assetManager->baseUrl.'/'.Customer::model()->getUserHeaderImage($value['customer_id']);?>" alt=""></a></div>
           <div class="comment-content">
               <a href="#" target="_blank" title=""><?php echo Customer::model()->getUserNickName($value['customer_id']);?></a><?php echo $value['description']?>
           </div>
           <a href="javascript:;" class="reply-comment">回复</a>
       </li>
       <?php endforeach;?>
       <?php endif;?>
 
   </ul>
</div>




  
<?php else:?>

 <?php
	
   $hf=Product::model()->getProductReviewHF($value['product_review_id']);
    
?>
<div class="reply-box">
   <div class="comment-form">
       <form action="">
           <a href="#" class="icon-btn comment-face" title="插入表情"></a>
           <textarea class="comment-txt" name=""></textarea>
           <a href="#" class="btn send-comment">评论</a>
           <p class="comment-function">
               <label for="and-reply"><input type="checkbox" class="and-reply" name="">同时转发到我的微博</label>
               <span class="comment-tip">sdfsdf</span>
           </p>
       </form>
   </div>
   <ul class="comment-list">
       
       <?php if(!empty($hf)):?>
        
        <?php foreach($hf as $value):?>
        
       <li>
           <div class="comment-user-pic"><a href="#"><img src="<?php echo Yii::app()->assetManager->baseUrl.'/'.Customer::model()->getUserHeaderImage($value['customer_id']);?>" alt=""></a></div>
           <div class="comment-content">
               <a href="#" target="_blank" title=""><?php echo Customer::model()->getUserNickName($value['customer_id']);?></a><?php echo $value['description']?>
           </div>
           <a href="javascript:;" class="reply-comment">回复</a>
       </li>
       <?php endforeach;?>
       <?php endif;?>
 
   </ul>
</div>

  
<?php endif;?>

