   <?php if(Yii::app()->user->hasFlash('oktips')):?>
   <div id="msg-box"><?php echo Yii::app()->user->getFlash('oktips'); ?> </div>
  <?php endif;?>
<div id="image_list">
<div class="main-right" >
	<h3 class="cent-title"><a href="<?php echo $this->createUrl('album/index');?>">我的相册</a> <em>&gt;</em><?php echo $albuminfo['a_name']?></h3>
	   <div class="photo_layout">
			<div class="photo_toolbar">
				<!--相册工具栏-->
				<ul class="photo_toolbar_wrap">
					<li><a id="toolbar_upload" href="<?php echo $this->createUrl('album/uploadentry',array('a_id'=>$albuminfo['album_id']));?>" class="profession-btn" title="上传照片"><i class="icon icon_upload"><i></i></i>上传照片</a></li>

					<li><a href="<?php echo $this->createUrl('album/lotmanage',array('a_id'=>$albuminfo['album_id']));?>" class="" title="批量管理">批量管理</a></li>
				</ul>
				<!--相册列表-->
				<div class="clear"></div>
				<div id="phone_list_div" class="my-photo-wrap">
					<ul id="phonto_list_container" class="clearfix my-photo-list">
					 
					 <?php foreach($data->getData() as $item):?>
						<li>
							<a href=" <?php echo $this->createUrl('album/delalbumimage',array('album_image_id'=>$item['album_image_id']));?>" class="delete ajax-item">删除照片</a>
							<a class="img-wrap" href="<?php echo $this->createUrl('album/seepic',array('a_img_id'=>$item['album_image_id']));?>"><img src=" <?php echo '/thumb/190_142/'.$item['img_path'];?>" width="190" height="142" /></a>
							<input class="photo-info" value="<?php echo $item['img_title'];?>" type="text" data-remote="<?php echo $this->createUrl('album/UpdateImageTitle',array('album_image_id'=>$item['album_image_id']));?>" />
						</li>
					 <?php endforeach;?>
					</ul>
				<!--	<p class="talk-info"><a href="javascript:;" class="fav">评论</a><span>|</span><a class="share ">分享(<em>0</em>)</a></p>
					<div class="reply-box" style="display: none;">
						<div class="comment-form">
						<form method="get" class="ajax-talk" action="http://www.sgc.zyx.com/news/reply.html?parent_review_id=54&amp;object_type=article&amp;object_id=1090">
							<textarea name="content" class="comment-txt"></textarea>
							<input type="submit" value="评论" class="btn send-comment">
							
						</form>
						</div>
						<ul class="comment-list">
							 
						</ul>
				</div>-->
					<div class="album-info list-alibum-info">
				   
						<div class="title">
							<a href="javascript:;">
                            
							<?php if(!empty($albuminfo['face'])):?>
							<img src="<?php echo '/thumb/70_70/'.Album::model()->getImageFace($albuminfo['face']);?>" width="70" height="70" />
							<?php else:?>
							<img src="../images/common/my_photo_1.png" width="70" height="70" />
							<?php endif;?>
							</a>
							<h3><?php echo $albuminfo['a_name'];?></h3>
							<p>创建：<?php echo date('Y-m-d',$albuminfo['created']);?></p>
							<p>更新：<?php echo date('Y-m-d',$albuminfo['updated']);?></p>
						</div>
						<p><?php echo $albuminfo['a_description'];?></p>
					
					</div>
				</div>
			</div>
	   </div>
	   <?php
$this->widget('application.widgets.PageToolbar' , array('pagination'=>$data->pagination, 'ajaxContainerId'=>'image_list','useAjax'=>true, 'route'=>'album/imagepage'));
?>
</div>
</div>
<script>
	$('.photo-info').change(function(){
		var val=$(this).val();
		var $_this=$(this);
		$_this.ajaxBind({
			data:{title:val}
		},{
			type:'auto'
		});
	})
</script>