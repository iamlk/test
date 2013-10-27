 <?php foreach(Dynamic::model()->getAlbumReviewDynamicInfo($item['interfix_id'],$item['action']) as $value):?>
 
<li>
                <div class="talk-user-pic"><a href="<?php echo Dynamic::goUrl($item['customer_id'],'center');?>"><img alt="" src="<?php echo '/thumb/48_48/'.Customer::model()->getUserHeaderImage($item['customer_id']);?>"></a></div>
                <div class="talk-content">
                    <span class="talk-icon-arrow"></span>
                    <p class="talk-user-info">
                        <a rel="@keke" target="_blank" href="<?php echo Dynamic::goUrl($item['customer_id'],'center');?>" class="talk-user-name"><?php echo Customer::model()->getUserNickName($item['customer_id']);?></a> 对 <a target="_blank" class="talk-link" href="<?php echo Dynamic::goUrl($item['customer_id'],'album');?>">“<?php echo  $value['img_title'];?>”</a>进行了<?php echo Dynamic::model()->getDynamicAction($item['action']);?>。
                    </p>
                    
                    <div class="media-box">
                    
                   <a class="photo-share" href="<?php echo Dynamic::goUrl($item['customer_id'],'album');?>"><img alt="" src="<?php echo '/thumb/120_90/'.$value['img_path'];?>"></a>
                 
                    </div>
                    <div class="msg-box">
                    <?php echo $value['content'];?>
                    </div>
                    <div class="talk-info">
                        <?php include('_share_pl.php');?>
                    </div>
                     <?php include('_reply_common_2.php');?>
                </div>
            </li>
<?php  endforeach;?>            
