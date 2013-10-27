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
            
                   </p>
               </div>
               
             
               
               <?php //include "comment_answer.php";?>
               
               
           </div>
        </li>
        

          <?php endif;?>
        
        <?php endforeach;?>
        
       
       <?php endforeach;?>
           <?php endforeach;?>
     
                     


</ul>