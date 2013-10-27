 <?php if(Yii::app()->user->hasFlash('errortips')):?>
   <div id="msg-box" class="error"><?php echo Yii::app()->user->getFlash('errortips'); ?> </div>
  <?php endif;?>
  
   <?php if(Yii::app()->user->hasFlash('oktips')):?>
   <div id="msg-box"><?php echo Yii::app()->user->getFlash('oktips'); ?> </div>
  <?php endif;?>
<div class="main-right">
        <h3 class="cent-title"><a href="<?php echo $this->createUrl('myArticle/index');?>">我的攻略</a><a href="<?php echo $this->createUrl('article/create')?>" class="release">发布攻略</a></h3>
          
           <ul class="my-raiders-list">
          <div class="zyxbox-content" id="results-list">
               
                <?php include "article_list.php";?>
              
          </div>
          </ul>
	</div>