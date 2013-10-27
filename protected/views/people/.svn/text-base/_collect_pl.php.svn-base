<p class="talk-time">
	<?php echo Dynamic::model()->doDynamicTime($item['created']);?>前 来自 
	<a target="_blank" href="/" class="talk-sender">自由行</a>
</p>
<p class="talk-function">

	<a  class="comment ajax-item" href="<?php echo $this->createUrl('collect/it');?>?type=<?php echo $item['interfix_type'];?>&id=<?php echo $item['interfix_id'];?>">
		收藏(<em><?php  echo SiteFavorite::model()->myCount($item['interfix_type'],$item['interfix_id']); ?></em>)
	</a>

   <!--
	<span>|</span>
	<a  class="comment fav" href="javascript:;s">
		评论(<em><?php echo Dynamic::model()->getCommentCounts($item['interfix_type'],$item['interfix_id']); ?></em>)
	</a>-->
    
</p>