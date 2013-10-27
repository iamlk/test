<div id="recive_comment">
	<table class="mycent-table">
	    <tr>
			<th>商品</th>
		    <th>被评论人</th>
		    <th>评论</th>
		    <th>操作</th>
	    </tr>
		 <?php foreach($comment->getData() as $value):?>
		 <?php  $key =array_keys($value);?>
	    <tr>   
		<?php if($this->actionGetReviewType($key[0])=='property'):?>
			<td>
				<a href="<?php echo $this->createUrl('goods/index',array('id'=>Property::model()->getPropertyGoods_id($value['property_id'])));?>">
					<?php echo PropertyAddendum::model()->getPropertyTitle($value['property_id']) ;?>
				</a>
				<span class="orange block">￥  <?php echo Property::model()->getPropertyPrice($value['property_id'])?></span>
			</td>

		<?php else:?>
			<td>
				<a href="<?php echo $this->createUrl('goods/index',array('id'=>Product::model()->getProductGoods_id($value['product_id'])));?>">
					<?php echo ProductAddendum::model()->getProductTitle($value['product_id']) ;?>
				</a>
				<span class="orange block">￥  <?php echo Product::model()->getProductPrice($value['product_id'])?></span>
			</td>
		<?php endif;?>
		    <td>
				买家：
				<a href="<?php echo Dynamic::goUrl($value['customer_id'],'center');?>" target="_blank">
					<?php echo Customer::model()->getUserNickName($value['customer_id']);?>
				</a>
		    </td>
            
		    <td>
				<?php echo mb_substr($value['description'],0,40); ?>
   	           <?php if($this->actionGetReviewType($key[0])=='property'):?>
               <?php $propertyHF = Goods::model()->getSellerHF($value['property_review_id'],Dynamic::PROPERTY);?>
               <?php if(!empty($propertyHF)):?>
                <p class="center-reply">[回复]<?php echo $propertyHF;?></p>
                <?php endif;?>
                <?php else:?>
               <?php $productHF = Goods::model()->getSellerHF($value['product_review_id'],Dynamic::PRODUCT); print_r($productHF);?> 
                <?php if(!empty($productHF)):?>
                <p class="center-reply">[回复]<?php echo $productHF;?></p>
                <?php endif;?> 
                <?php endif;?> 
		    </td>
			<?php if($this->actionGetReviewType($key[0])=='property'):?>
		   
		    <td>
				<div class="opreatWrap">
					<a  class="share-item ajax-item" href="<?php echo $this->createUrl('share/it');?>?type=<?php echo Dynamic::PROPERTY;?>&id=<?php echo $value['property_id'];?>" >
						一键分享
					</a>
                    
                    <?php if(empty($propertyHF)):?>
					<span>|</span>
					<a href="javascript:;" class="reply-toggle">回复</a>
					<div class="reply-box">
						<span class="arrow"></span>
						<div class="comment-form">
						<form method="get" class="ajax-talk seeler" action="<?php echo $this->createUrl('news/reply',array('parent_review_id'=>$value['property_review_id'],'object_type'=>Dynamic::PROPERTY,'object_id'=>$value['property_id']));?>">
							<textarea name="content" class="comment-txt"></textarea>
							<input type="submit" value="评论" class="btn send-comment">
							
						</form>
						</div>
						<ul class="comment-list">
							 
						</ul>
					</div>
                    <?php endif;?> 
				</div>
			</td>
		    <?php else:?>
			<td>
				<div class="opreatWrap">
					<a class="share-item ajax-item" href="<?php echo $this->createUrl('share/it');?>?type=<?php echo Dynamic::PRODUCT;?>&id=<?php echo $value['product_id'];?>" >
						一键分享
					</a>
                      <?php if(empty($productHF)):?>
					<span>|</span>
					<a href="javascript:;" class="reply-toggle">回复</a>
					<div class="reply-box">
						<span class="arrow"></span>
						<div class="comment-form">
						<form method="get" class="ajax-talk" action="<?php echo $this->createUrl('news/reply',array('parent_review_id'=>$value['product_review_id'],'object_type'=>Dynamic::PRODUCT,'object_id'=>$value['product_id']));?>">
							<textarea name="content" class="comment-txt"></textarea>
							<input type="submit" value="评论" class="btn send-comment">
							
						</form>
						</div>
						<ul class="comment-list">
							 
						</ul>
					</div>
                    <?php endif;?> 
				</div>
			</td>
			  
		    <?php endif;?>
	    </tr>
		<?php endforeach;?>
	</table>
<?php
$this->widget('application.widgets.PageToolbar' , array('pagination'=>$comment->pagination, 'ajaxContainerId'=>'recive_comment','useAjax'=>true, 'route'=>'comment/sellerrecivecommentpage'));
?>

</div>