<?php foreach(Dynamic::model()->getRestaurantReviewDynamicInfo($item['restaurant_review_id']) as $value):?>
	<li>
	    <div class="talk-user-pic">
			<a href="<?php echo Dynamic::goUrl($item['customer_id'],'center');?>" target="_blank" ><img src="<?php echo '/thumb/48_48/'.Customer::model()->getUserHeaderImage($item['customer_id']);?>" alt=""></a>
		</div>
	    <div class="talk-content">
		    <span class="talk-icon-arrow"></span>
		    <p class="talk-user-info">
				<a class="talk-user-name" href="<?php echo Dynamic::goUrl($item['customer_id'],'center');?>" target="_blank"><?php echo Customer::model()->getUserNickName($item['customer_id']);?>：</a> <?php echo $item['content']?>
			</p>
		    <div class="media-box">
				<p>我回复了餐厅<a href="#">“<?php  echo  $value->addendum->title;?>”</a></p>
		    </div>
		 
		    <div class="talk-info">
				<p class="talk-time"><?php echo date('Y-m-d H:i:s',$item['created'])?></p>
				<p class="talk-function">
					<a href="<?php echo $this->createUrl('center/deletemessage',array('id'=>$item['restaurant_review_id'],'type'=>Dynamic::RESTAURANT));?>" class="delete ajax-item">删除</a><span>|</span><a href="javascript:;" class="fav">回复</a>
				</p>
		    </div>
			<?php $hf= RestaurantReview::model()->getRestaurantReviewHF($item['restaurant_review_id']);?>
             <?php $obj_id=$item['restaurant_id'];?>
              <?php $type=Dynamic::RESTAURANT;?>
            <?php $review_id=$item['restaurant_review_id'];?>
		   <?php include('_reply_common.php');?>
	    </div>
	</li>

<?php endforeach;?>  