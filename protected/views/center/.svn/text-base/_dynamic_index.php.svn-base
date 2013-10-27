<div id="dynamic">
<div class="talk-box1">
		<ul class="talk-type">
			<li>
				<a href="<?php echo Dynamic::goUrl($item['customer_id'], 'center'); ?>" class="current">最新动态</a>
			</li>
            
		</ul>
		<ul class="talk-list">
			<?php foreach ($dynamic->getData() as $item): ?>
            
				<?php if ($item['interfix_type'] == Dynamic::PRODUCT): //短期行程 ?>
                   
					<?php include ('_product_dynamic.php'); ?>
                    
				<?php endif; ?>
                
				<?php if ($item['interfix_type'] == Dynamic::PRODUCTREVIEW): //短期行程评论 ?>
                
					<?php include ('_productReview_dynamic.php'); ?>
                    
				<?php endif; ?>
                
				<?php if ($item['interfix_type'] == Dynamic::PROPERTY): //住所 ?>
                
				    <?php include ('_property_dynamic.php'); ?>
                    
				<?php endif; ?>
                
				<?php if ($item['interfix_type'] == Dynamic::PROPERTYREVIEW): //短期行程评论 ?>
                 
					<?php include ('_propertyReview_dynamic.php'); ?>
                    
				<?php endif; ?>
                
				<?php if ($item['interfix_type'] == Dynamic::ARTICLE): //攻略 ?>
                    
				    <?php include ('_article_dynamic.php'); ?>
                    
				<?php endif; ?>
                
				 <?php if ($item['interfix_type'] == Dynamic::ARTICLEREVIEW): //攻略评论 ?>
                 
					<?php include ('_articleReview_dynamic.php'); ?>
                    
				<?php endif; ?>
                
                
               	<?php if ($item['interfix_type'] == Dynamic::ATTRACTION): //景点 ?>
                    
				    <?php include ('_attraction_dynamic.php'); ?>
                    
				<?php endif; ?>
                
				 <?php if ($item['interfix_type'] == Dynamic::ATTRACTIONREVIEW): //景点评论 ?>
                 
					<?php include ('_attractionReview_dynamic.php'); ?>
                    
				<?php endif; ?>
                
                
                
				<?php if ($item['interfix_type'] == Dynamic::DELICACY): //美食 ?>
                
				    <?php include ('_delicacy_dynamic.php'); ?>
                    
				<?php endif; ?>
                
				<?php if ($item['interfix_type'] == Dynamic::DELICACYREVIEW): //美食评论 ?>
                
					<?php include ('_delicacyReview_dynamic.php'); ?>
                    
				<?php endif; ?>
                
				<?php if ($item['interfix_type'] == Dynamic::ALBUM): // 相册 ?>
                   
					<?php include ('_album_dynamic.php'); ?>
                    
				<?php endif; ?>
                
                
               	<?php if ($item['interfix_type'] == Dynamic::ALBUMIMAGE): // 相册图片 ?>
                   
					<?php include ('_albumimage_dynamic.php'); ?>
                    
				<?php endif; ?>
                
               	<?php if ($item['interfix_type'] == Dynamic::ALBUMREVIEW): // 相册评论 ?>
                    
   	               <?php include ('_albumImageReview_dynamic.php'); ?>
                    
				<?php endif; ?>
                
				<?php if ($item['interfix_type'] == Dynamic::RESTAURANT): //餐厅 ?>
                
					<?php include ('_restaurant_dynamic.php'); ?>
                    
				<?php endif; ?>
                
				<?php if ($item['interfix_type'] == Dynamic::RESTAURANTREVIEW): //餐厅评论 ?>
                
				   <?php include ('_restaurantReview_dynamic.php'); ?>
                    
				<?php endif; ?> 
                
                
               	<?php if ($item['interfix_type'] == Dynamic::CITY): //城市 ?>
                
				   <?php include ('_city_dynamic.php'); ?>
                    
				<?php endif; ?> 
                
                
                
                <?php if ($item['interfix_type'] == Dynamic::FOOD): //食物 ?>
                
				   <?php include ('_food_dynamic.php'); ?>
                    
				<?php endif; ?> 
                
                
                
                
			<?php endforeach; ?>
		</ul>
	  <!-- 	<p id="loading-talk">正在加载……</p>-->
              <?php
$this->widget('application.widgets.PageToolbar', array(
    'pagination' => $dynamic->pagination,
    'ajaxContainerId' => 'dynamic',
    'useAjax' => true,
    'route' => 'center/indexpage'));
?>
	</div>
    </div>	