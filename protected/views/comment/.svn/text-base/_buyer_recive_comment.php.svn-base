<div id="recive_comment">
	<table class="mycent-table">
		<tr>
			<th>商品</th>
			<th>评论人</th>
			<th>评论</th>
			<th>操作</th>
		</tr>
		<?php foreach($buyerrecive->getData() as $item):?>
		<?php  $key =array_keys($item);?>
		<tr>
			<?php if($this->actionGetReviewType($key[0])=='property'):?>
			<td>
				<a href="<?php echo $this->createUrl('goods/index',array('id'=>Property::model()->getPropertyGoods_id($item['property_id'])));?>">
					<?php echo PropertyAddendum::model()->getPropertyTitle($item['property_id']) ;?>
				</a>
				<span class="orange block">￥ <?php echo Property::model()->getPropertyPrice($item['property_id'])?></span>
			</td>

			<?php else:?>

			<td>
				<a href="<?php echo $this->createUrl('goods/index',array('id'=>Product::model()->getProductGoods_id($item['product_id'])));?>">
					<?php echo ProductAddendum::model()->getProductTitle($item['product_id']) ;?>
				</a>
				<span class="orange block">￥  <?php echo Product::model()->getProductPrice($item['product_id'])?></span>
			</td>

			<?php endif;?>   
			<td>
				卖家：
				<a href="<?php echo Dynamic::goUrl($item['customer_id'],'center');?>" >
					<?php echo Customer::model()->getUserNickName($item['customer_id']);?>
				</a>
			</td>
			<td>
				<?php  echo mb_substr($item['description'],0,40);?>
			</td>

			<?php if($this->actionGetReviewType($key[0])=='property'):?>

			<td>
				<div class="opreatWrap">
					<a  class="share-item ajax-item" href="<?php echo $this->createUrl('share/it');?>?type=<?php echo Dynamic::PROPERTY;?>&id=<?php echo $item['property_id'];?>" >
						一键分享
					</a>
					<span></span>
					 <!--<a href="javascript:;" class="reply-toggle">回复</a>
                   
					<div class="reply-box">
						<span class="arrow"></span>
						<div class="comment-form">
						<form method="get" class="ajax-talk" action="<?php echo $this->createUrl('news/reply',array('parent_review_id'=>$item['property_review_id'],'object_type'=>Dynamic::PRODUCT,'object_id'=>$item['property_id']));?>">
							<textarea name="content" class="comment-txt"></textarea>
							<input type="submit" value="评论" class="btn send-comment">
							
						</form>
						</div>
						<ul class="comment-list">
							 
						</ul>
					</div>-->
				</div>
			</td>

			<?php else:?>

			<td>
				<div class="opreatWrap">
					<a class="share-item ajax-item" href="<?php echo $this->createUrl('share/it');?>?type=<?php echo Dynamic::PRODUCT;?>&id=<?php echo $item['product_id'];?>" >
						一键分享
					</a>
					<span></span>
				<!--	<a  href="javascript:;" class="reply-toggle">回复</a>
					<div class="reply-box">
						<span class="arrow"></span>
						<div class="comment-form">
						<form method="get" class="ajax-talk" action="<?php echo $this->createUrl('news/reply',array('parent_review_id'=>$item['product_review_id'],'object_type'=>Dynamic::PRODUCT,'object_id'=>$item['product_id']));?>">
							<textarea name="content" class="comment-txt"></textarea>
							<input type="submit" value="评论" class="btn send-comment">
							
						</form>
						</div>
						<ul class="comment-list">
							 
						</ul>
					</div>-->
				</div>
			</td>

			<?php endif;?>
		</tr>
		<?php endforeach;?>

	</table>
	<?php
	$this->widget('application.widgets.PageToolbar' , array('pagination'=>$buyerrecive->pagination, 'ajaxContainerId'=>'recive_comment','useAjax'=>true, 'route'=>'comment/BuyerReciveCommentPage'));
	?>
</div>