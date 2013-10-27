<div id="image_list">
<div class="main-right" >
	<h3 class="cent-title"><a href="<?php echo $this->createUrl('peoplealbum/index',array('u_id'=>$this->uid));?>">他的相册</a> <em>&gt;</em><?php echo $albuminfo['a_name']?></h3>
	   <div class="photo_layout">
			<div class="photo_toolbar">
				<!--相册工具栏-->
				<ul class="photo_toolbar_wrap">
				
				</ul>
				<!--相册列表-->
				<div class="clear"></div>
				<div id="phone_list_div" class="my-photo-wrap">
					<ul id="phonto_list_container" class="clearfix my-photo-list">
					 
					 <?php foreach($data->getData() as $item):?>
						<li>
							
							<a class="img-wrap" href="<?php echo $this->createUrl('peoplealbum/seepic',array('a_img_id'=>$item['album_image_id'],'u_id'=>$this->uid));?>"><img src=" <?php echo '/thumb/190_142/'.$item['img_path'];?>" width="190" height="142" /></a>
							<input disabled="true" class="photo-info" value="<?php echo $item['img_title'];?>" type="text" />
						</li>
					 <?php endforeach;?>
					</ul>
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
$this->widget('application.widgets.PageToolbar' , array('pagination'=>$data->pagination, 'ajaxContainerId'=>'image_list','useAjax'=>true, 'route'=>'peoplealbum/imagepage'));
?>
</div>
</div>
