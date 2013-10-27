<div class="reply-box">
	<div class="comment-form">
	<form action="<?php echo  $this->createUrl('news/reply',array('parent_review_id'=>0,'object_type'=>$type,'object_id'=>$item['interfix_id']));?>" class="ajax-talk" method="get">
	<!-- <a href="#" class="icon-btn comment-face" title="插入表情"></a>-->
		<textarea class="comment-txt" name="content"></textarea>
		<input type="submit" class="btn send-comment" value="评论" />
		<!--<p class="comment-function">
		 <label for="and-reply"><input type="checkbox" class="and-reply" name="">同时转发到我的微博</label>
		<span class="comment-tip">sdfsdf</span>
		</p>-->
	</form>
	</div>
	<ul class="comment-list">
		<?php if(!empty($hf)):?>
			<?php foreach($hf as $f):?>
				<li>
					<div class="comment-user-pic"><a href="<?php echo Dynamic::goUrl($f['customer_id'],'center');?>">
						<img src="<?php echo '/thumb/48_48/'.Customer::model()->getUserHeaderImage($f['customer_id']);?>" alt=""></a>
					</div>
					<div class="comment-content">
						<a href="<?php echo Dynamic::goUrl($f['customer_id'],'center');?>" target="_blank" title="">
							<?php echo Customer::model()->getUserNickName($f['customer_id']);?>
						</a> 
						<span><?php echo $f['content']?></span>
					</div>
					<a href="javascript:;" class="reply-comment"></a>
				</li>
			<?php endforeach;?>
		<?php endif;?> 
	</ul>
</div>