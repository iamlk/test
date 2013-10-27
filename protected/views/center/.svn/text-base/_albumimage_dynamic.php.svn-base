<?php foreach(Dynamic::model()->getAlbumDynamicInfo($item['interfix_id'],$item['action']) as $value):?>

            <li>
                <div class="talk-user-pic"><a rel="@keke" target="_blank" href="<?php echo Dynamic::goUrl($item['customer_id'],'center');?>"><img alt="" src="<?php echo '/thumb/48_48/'.Customer::model()->getUserHeaderImage($item['customer_id']);?>"></a></div>
                <div class="talk-content">
                    <span class="talk-icon-arrow"></span>
                    <p class="talk-user-info">
                        <a rel="@keke" target="_blank" href="<?php echo Dynamic::goUrl($item['customer_id'],'center');?>" class="talk-user-name"><?php echo Customer::model()->getUserNickName($item['customer_id']);?></a> <?php echo Dynamic::model()->getDynamicAction($item['action']);?>了图片到 <a target="_blank" class="talk-link" href="<?php echo Dynamic::goUrl($item['customer_id'],'album');?>">“<?php echo  $value->a_name;?>”</a>
                    </p>
                    <div class="media-box">
                    
                    <?php if(!empty($value->face)):?>
                    <a class="photo-share" href="<?php echo Dynamic::goUrl($item['interfix_id'],Dynamic::ALBUMIMAGE);?>"><img alt="" src="<?php echo '/thumb/120_90/'.Album::model()->getImageFace($value->face);?>"></a>
                    <?php else:?>
                       <a class="photo-share" href="<?php echo Dynamic::goUrl($item['interfix_id'],Dynamic::ALBUMIMAGE);?>"><img alt="" src="<?php echo '/thumb/120_90/'.$value->albumImages[0]->img_path;?>"></a>                 
                    <?php endif;?>
                 
                    </div>
                      <?php $type=Dynamic::ALBUMIMAGE?>
                    <div class="talk-info">
                      <?php include('_share_pl.php');?>

                    </div>

                        <?php include('_reply_common_2.php');?>
                </div>
            </li>
<?php endforeach;?>