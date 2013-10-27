<div id="resuts-list-wrap">
	<div id="results-list" class="clearfix">
		<ul id="comment-list-new">	
			<?php foreach($albumrewview->getData() as $item):?>
				<li>
					<div class="comment-user-pic">
						<a href="<?php echo Dynamic::goUrl($item['customer_id'],'center');?>"><img src="/thumb/32_32/<?php echo Customer::model()->getUserHeaderImage($item['customer_id']);?>" alt="<?php echo Customer::model()->getUserNickName($item['customer_id']);?>"></a>
					</div>
					<div class="comment-content"><a target="_blank" href="<?php echo Dynamic::goUrl($item['customer_id'],'center');?>">
						<?php echo Customer::model()->getUserNickName($item['customer_id']);?></a>:<?php echo $item['content'];?><p class="raiders-detail-time"><?php echo date('m月d日 H:i',$item['created'])?></p>
					</div>
					<!--<a href="javascript:;" id="<?php echo $item['album_review_id'];?>" class="reply-comment">回复</a>-->
				</li>
			<?php endforeach;?>
		</ul>
		<?php
			$this->widget('application.widgets.PageToolbar' , array('pagination'=>$albumrewview->pagination, 'ajaxContainerId'=>'results-list','useAjax'=>true, 'route'=>'album/imagereviewpage'));
		?>			
	</div>
</div>