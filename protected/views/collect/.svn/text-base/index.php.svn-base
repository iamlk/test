<div id="index">
<div class="main-right clearfix">
	<div class="friends-search-wrap">
		<?php include('_collect_menu.php');?>
	</div>
	<ul class="photo_toolbar_wrap">
		<li>
			<input type="checkbox" name="all" id="all">本页全选
		</li>
		<li>
			<a href="javascript:void(0);" class="all" data-type="<?php echo Dynamic::PRODUCT ?>" title="批量删除">批量删除</a>
		</li>
	</ul>
	<div class="collection-list-wrap clearfix">
	<?php foreach($data->getData() as $item):?>
	    
        <?php if( $item->attributes['object_type'] == Dynamic::PRODUCT):?>
         
          <?php include('_product.php');?>
         
        <?php endif;?>
        
        <?php if( $item->attributes['object_type'] == Dynamic::PROPERTY):?>
         
          <?php include('_property.php');?>
         
        <?php endif;?>
 
        <?php if( $item->attributes['object_type'] == 'Travel'):?>
        
          <?php include('_travel.php');?>
         
        <?php endif;?>
        
         <?php if( $item->attributes['object_type'] == Dynamic::ARTICLE):?>
         
          <?php include('_article.php');?>
         
        <?php endif;?>
        
        
         <?php if( $item->attributes['object_type'] == Dynamic::DELICACY):?>
         
          <?php include('_delicacy.php');?>
         
        <?php endif;?>
        
         <?php if( $item->attributes['object_type'] == Dynamic::ALBUM):?>
         
          <?php include('_album.php');?>
         
        <?php endif;?>
        
         <?php if( $item->attributes['object_type'] == Dynamic::RESTAURANT):?>
         
          <?php include('_restaurant.php');?>
         
        <?php endif;?>
        
        
	 <?php endforeach;?>
	</div>
            <?php
$this->widget('application.widgets.PageToolbar' , array('pagination'=>$data->pagination, 'ajaxContainerId'=>'index','useAjax'=>true, 'route'=>'collect/indexpage'));
?>
</div>

</div>