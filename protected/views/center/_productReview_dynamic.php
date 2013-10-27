<?php foreach(Dynamic::model()->getProductReviewDynamicInfo($item['interfix_id']) as $value):?>
	<li>
		<div class="talk-user-pic">
			<a href="<?php echo Dynamic::goUrl($item['customer_id'],'center');?>">
				<img alt="" src="<?php echo '/thumb/48_48/'.Customer::model()->getUserHeaderImage($item['customer_id']);?>">
			</a>
		</div>
		<div class="talk-content">
			<span class="talk-icon-arrow"></span>
			<p class="talk-user-info">
				<a rel="@keke" target="_blank" href="<?php echo Dynamic::goUrl($item['customer_id'],'center');?>" class="talk-user-name">
					<?php echo Customer::model()->getUserNickName($item['customer_id']);?>
				</a>
				在 
				<a target="_blank" class="talk-link" href="<?php echo  $this->createUrl('goods/index',array('id'=>Product::model()->getProductGoods_id($item['interfix_id'])));?>">
					“<?php echo  $value->productAddendum->title;?>”
				</a>
				进行了<?php echo Dynamic::model()->getDynamicAction($item['action']);?>。
			</p>
            
            <div class="media-box">
                    <?php $imgcount=0?>
                    <?php foreach($value->productImages as $img):?>
                    <?php $imgcount++ ?>
                    <?php if($imgcount<=3):?>
                        <a class="photo-share" href="<?php echo  $this->createUrl('goods/index',array('id'=>Product::model()->getProductGoods_id($item['interfix_id'])));?>"><img alt="" src="<?php echo '/thumb/120_90/'.$img->path;?>"></a>
                    <?php endif;?>
                    <?php endforeach;?>
                    <?php $imgcount=null?>
               </div>
			<div class="msg-box">
            <?php foreach($value->productReviews as $val):?>
             <?php  echo mb_substr( $val->description, 0, 100).'......'?>
             <?php endforeach;?>
			</div>
			<div class="talk-info">
			   <?php include('_share_collect.php');?>
			</div>
		</div>
	</li>
	<?php  endforeach;?>            
