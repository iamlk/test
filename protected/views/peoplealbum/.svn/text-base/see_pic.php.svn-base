<script type="text/javascript" src="/js/jquery.ad-gallery.js"></script>
<link rel="stylesheet" type="text/css" href="/css/jquery.ad-gallery.css">
<div class="main-right my-album">
	<h3 class="cent-title"><a href="<?php echo $this->createUrl('peoplealbum/index',array('u_id'=>$this->uid));?>">他的相册</a> <em>&gt;</em><?php echo $albuminfo['a_name'];?></h3>
	   <div class="photo_layout">
			<div class="photo_toolbar">
				<!--相册列表-->
				<div class="my-photo-wrap" id="phone_list_div">
				
					<div class="picShow peoplecenter-photo">
						<div class="bigImg">
							<div class="imgWrap">
								<img  class="showImg"  src="" alt=""/>
							</div>
							<div class="title"><p><?php echo $this->default['img_title'];?></p></div>
							<a href="javascript:;" class="prev">上一张</a>
							<a href="javascript:;" class="next">下一张</a>
						</div>
						<div class="listWrap">
							<a href="javascript:;" class="prev">上一张</a>
							<a href="javascript:;" class="next">下一张</a>
							<div class="imgListWrap">
								<ul class="imgList clearfix">
									 <?php foreach($data as $item):?>
										<li  data-id="<?php echo $item['album_image_id'];?>" <?php if($this->default['album_image_id'] == $item['album_image_id']):?>class="cur"<?php endif;?>>
											<a href="<?php echo '/thumb/auto/640_385/'.$item['img_path'];?>" title="<?php echo $item['img_title'];?>" >
												<img src="<?php echo '/thumb/46_46/'.$item['img_path'];?>" alt="<?php echo $item['img_title'];?>">
											</a>
										</li>
										<?PHP $ID=$item['album_image_id']; ?>
									<?php endforeach;?>
								</ul>
							</div>
						</div>
					</div>
				
				
					
				
				
				</div>
			</div>
	    </div>
		<div id="results-list-wrap">
			<p class="talk-info"><a href="javascript:;" class="fav">评论</a><span>|</span><a  class="share ajax-item" data-url="<?php echo $this->createUrl('share/it');?>?type=<?php echo Dynamic::ALBUM;?>" href="<?php echo $this->createUrl('share/it');?>?type=<?php echo Dynamic::ALBUMIMAGE;?>&id=<?php echo $ID;?>">分享</a></p>
			<div class="reply-box">
				<div class="comment-form">
				<form method="get" class="ajax-talk  ajax-reply-comment" action="<?php echo $this->createUrl('news/reply',array('object_type'=>Dynamic::ALBUMREVIEW,'object_id'=>$ID))?>" data-url="<?php echo $this->createUrl('news/reply',array('parent_review_id'=>0,'object_type'=>Dynamic::ALBUMREVIEW));?>">
					<textarea name="content" class="comment-txt"></textarea>
					<input type="submit" value="评论" class="btn send-comment">
					
				</form>
				</div>
			</div>
			<?php include('_image_review.php');?>
		</div>
</div>