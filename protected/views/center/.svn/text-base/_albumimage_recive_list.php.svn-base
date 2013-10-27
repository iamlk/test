<?php foreach(Dynamic::model()->getAlbumReviewDynamicInfo($item['album_image_id']) as $value):?>
    <li>
        <div class="talk-user-pic">
			<a href="<?php echo Dynamic::goUrl($item['customer_id'],'center');?>" target="_blank" >
				<img src="<?php echo '/thumb/48_48/'.Customer::model()->getUserHeaderImage($item['customer_id']);?>" alt="">
			</a>
	    </div>
        <div class="talk-content">
            <span class="talk-icon-arrow"></span>
            <p class="talk-user-info">
				<a class="talk-user-name" href="<?php echo Dynamic::goUrl($item['customer_id'],'center');?>" target="_blank">
					<?php echo Customer::model()->getUserNickName($item['customer_id']);?>：
				</a> 
				<?php echo $item['content']?>
			</p>
            <div class="media-box">
				<p>回复了我的相册图片<a href="<?php echo Dynamic::goUrl($item['album_image_id'],Dynamic::ALBUMIMAGE);?>">“<?php echo  $value['img_title'];?>”</a></p>
            </div>
          
            <div class="talk-info">
                <p class="talk-time"><?php echo date('Y-m-d H:i:s',$item['created'])?></p>
                <p class="talk-function">
                    <a href="./deletemessage?id=<?php echo $item['album_review_id'];?>&type=<?php echo Dynamic::ALBUMIMAGE;?>" class="delete ajax-item">删除</a>
					<span>|</span>
					<a href="javascript:;" class="fav">回复</a>
                </p>
            </div>
            <?php $hf= AlbumReview::model()->getAlbumReviewHF($item['album_review_id']);?>
            <?php $obj_id=$item['album_image_id'];?>
            <?php $filed='album_review_id'?>
            <?php $type=Dynamic::ALBUMIMAGE;?>
            <?php $review_id=$item['album_review_id'];?>
           
           <?php include('_reply_common.php');?>
           
        </div>
    </li>
<?php endforeach;?>  
