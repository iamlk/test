     <ul class="talk-list">
     
     
       <?php foreach($comment as $m):?>
          
       <?php foreach($m->properties as $item):?>
       
        <?php foreach($item->propertyreview as $val):?>
        
        <?php

?>
    
        <li>
           <div class="talk-user-pic"><a href="#" target="_blank" ><img src="<?php echo Yii::app()->assetManager->baseUrl.'/'.$m->customer->avator;?>" alt=""></a></div>
           <div class="talk-content">
               <span class="talk-icon-arrow"></span>
               <p class="talk-user-info">
                   <a class="talk-user-name" href="#" target="_blank"><?php echo $m->customer->nick_name;?>：</a>  <?php 	echo $val->name;;?>
               </p>
               <div class="media-box">
                   <p>评论我的住所<a href="#">”<?php echo $item->propertyAddendum->title ;?>“</a></p>
               </div>
               <div class="msg-box">
               
               </div>
               <div class="talk-info">
                   <p class="talk-time"><?PHP echo $val->created;?></p>
                   <p class="talk-function">
                       <a href="" class="reply">删除</a><span>|</span><a href="#" class="fav">回复</a>
                   </p>
               </div>
               
             
               
               <?php //include "comment_answer.php";?>
               
               
           </div>
        </li>
        <?php endforeach;?>
        
       
       <?php endforeach;?>

       <?php endforeach;?>
       
       
       
       
       <?php foreach($comment as $m):?>
       
       <?php foreach($m->products as $item):?>
       
        <?php foreach($item->productreviews as $val):?>
         
         <?php if($val->parent_review_id==0):?>

        <li>
           <div class="talk-user-pic"><a href="#" target="_blank" ><img src="<?php echo Yii::app()->assetManager->baseUrl.'/'.$m->customer->avator;?>" alt=""></a></div>
           <div class="talk-content">
               <span class="talk-icon-arrow"></span>
               <p class="talk-user-info">
                   <a class="talk-user-name" href="#" target="_blank"><?php echo $m->customer->nick_name;?>：</a>  <?php 	echo $val->name;;?>
               </p>
               <div class="media-box">
                   <p>评论我的短期行程<a href="#">”<?php echo $item->productAddendum->title ;?>“</a></p>
               </div>
               <div class="msg-box">
               
               </div>
               <div class="talk-info">
                   <p class="talk-time"><?PHP echo $val->created;?></p>
                   <p class="talk-function">
                       <a href="#" class="reply">删除</a><span>|</span><a href="#" class="fav">回复</a>
                   </p>
               </div>
               
             
               
               <?php //include "comment_answer.php";?>
               
               
           </div>
        </li>
        
        <?php elseif($val->parent_review_id==$val->product_review_id):?>
        
        
                <li>
           <div class="talk-user-pic"><a href="#" target="_blank" ><img src="<?php echo Yii::app()->assetManager->baseUrl.'/'.$m->customer->avator;?>" alt=""></a></div>
           <div class="talk-content">
               <span class="talk-icon-arrow"></span>
               <p class="talk-user-info">
                   <a class="talk-user-name" href="#" target="_blank"><?php echo $m->customer->nick_name;?>：</a>  <?php 	echo $val->name;;?>
               </p>
               <div class="media-box">
                   <p>评论我的短期行程<a href="#">”<?php echo $item->productAddendum->title ;?>“</a></p>
               </div>
               <div class="msg-box">
               
               </div>
               <div class="talk-info">
                   <p class="talk-time"><?PHP echo $val->created;?></p>
                   <p class="talk-function">
                       <a href="#" class="reply">删除</a><span>|</span><a href="#" class="fav">回复</a>
                   </p>
               </div>
               
             
               
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

       <li>
           <div class="comment-user-pic"><a href="#"><img src="images/avatar2.jpg" alt=""></a></div>
           <div class="comment-content">
               <a href="#" target="_blank" title="王小小(@wangxiaoxiao)">王小小</a> 非常漂亮的云。
           </div>
           <a href="javascript:;" class="reply-comment">回复</a>
       </li>
 
   </ul>
</div>
               
               
           </div>
        </li>
        
        
        
          <?php endif;?>
        
        <?php endforeach;?>
        
       
       <?php endforeach;?>
           <?php endforeach;?>
     
                     


</ul>