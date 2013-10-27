<div id="index">
	<div class="main-right">
       <div class="friends-search-wrap clearfix">
            <ul class="cons-list-tit fl width60">
                <?php include('_share_menu.php');?>
            </ul>  
        </div>
        <div class="share-list-wrap">
            <ul class="share-listitem">
            <?php foreach($data->getData() as $item):?>
        
               <?php if($item['object_type'] == Dynamic::PRODUCT):?>
                  <li><?php include('_product.php');?></li>
               <?php endif;?>

               <?php if($item['object_type'] == Dynamic::PROPERTY):?>
                 <li><?php include('_property.php');?></li>

               <?php endif;?>

               <?php if($item['object_type'] == Dynamic::TRAVEL):?>
                 <li><?php include('_travel.php');?></li>
               <?php endif;?>

               <?php if($item['object_type'] == Dynamic::ARTICLE):?>
                 <li> <?php include('_article.php');?></li>
               <?php endif;?>

               <?php if($item['object_type'] == Dynamic::DELICACY):?>
                 <li> <?php include('_delicacy.php');?></li>

               <?php endif;?>
           
               <?php if($item['object_type'] == Dynamic::CITY):?>
                 <li><?php include('_city.php');?></li>
        
               <?php endif;?>
               
               <?php if($item['object_type'] == Dynamic::ALBUMIMAGE):?>
                <li><?php include('_album.php');?></li>
               <?php endif;?>
               
               <?php if($item['object_type'] == Dynamic::RESTAURANT):?>
                <li><?php include('_restaurant.php');?></li>
               <?php endif;?>

               <?php if($item['object_type'] == Dynamic::ATTRACTION):?>
                 <li>   <?php include('_attraction.php');?></li>

               <?php endif;?>
            <?php endforeach;?>
            
            </ul>
            
        </div>
<?php
$this->widget('application.widgets.PageToolbar' , array('pagination'=>$data->pagination, 'ajaxContainerId'=>'index','useAjax'=>true, 'route'=>'peopleshare/indexpage'));
?>
        <div class="clear"></div>
    </div>
    </div>