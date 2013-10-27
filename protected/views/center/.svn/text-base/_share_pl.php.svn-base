<p class="talk-time">
	<?php echo Dynamic::model()->doDynamicTime($item['created']);?>前 来自 
	<a target="_blank" href="/" class="talk-sender">自由行</a>
</p>
<p class="talk-function">
	<a  class="share ajax-item" href="<?php echo $this->createUrl('share/it');?>?type=<?php echo $type;?>&id=<?php echo $item['interfix_id'];?>">
		分享(<em><?php  echo SiteShare::model()->myCount($type,$item['interfix_id']); ?></em>)
	</a>

	<span>|</span>
	<a  class="comment fav" href="javascript:;">
		评论(<em><?php echo Dynamic::model()->getCommentCounts($type,$item['interfix_id']); ?></em>)
	</a>
</p>