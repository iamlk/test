 <?php foreach(Dynamic::model()->getRestaurantDynamicInfo($item['interfix_id']) as $value):?>
            <li>
                <div class="talk-user-pic"><a rel="@keke" target="_blank" href="<?php echo Dynamic::goUrl($item['customer_id'],'center');?>"><img alt="" src="<?php echo '/thumb/48_48/'.Customer::model()->getUserHeaderImage($item['customer_id']);?>"></a></div>
                <div class="talk-content">
                    <span class="talk-icon-arrow"></span>
                    <p class="talk-user-info">
                        <a rel="@keke" target="_blank" href="<?php echo Dynamic::goUrl($item['customer_id'],'center');?>" class="talk-user-name"><?php echo Customer::model()->getUserNickName($item['customer_id']);?></a> <?php echo Dynamic::model()->getDynamicAction($item['action']);?>了餐厅 <a target="_blank" class="talk-link" href="<?php echo  $this->createUrl('restaurant/view',array('id'=>Product::model()->getProductGoods_id($item['interfix_id'])));?>">“<?php echo  $value->addendum->title;?>”</a>
                    </p>
                    <div class="media-box">
                  
                    <a class="photo-share" href="<?php echo  $this->createUrl('restaurant/view',array('id'=>Product::model()->getProductGoods_id($item['interfix_id'])));?>"><img alt="" src="<?php echo '/thumb/120_90/'.$value->image;?>"></a>
               
                    </div>
                        <?php
                $pattern="/<[img|IMG].*?src=[\'|\"](.*?(?:[\.gif|\.jpg|\.png]))[\'|\"].*?[\/]?>/";
                $str = strip_tags($value->addendum->content);
                $content = preg_replace($pattern,' ',$str);
                ?>
                    <div class="msg-box">
                      
                       <?php echo mb_substr($content, 0, 100).'......<a target="_blank" href="'.$this->createUrl("restaurant/view",array("id"=>$item["interfix_id"])).'" class="indent5">[详情]</a>'; ?>
                      
                    </div>
                    <?php $type=Dynamic::RESTAURANT;?>
                    
                    <div class="talk-info">
                    
                     <?php include('_share_collect_pl.php');?>
         
                    </div>

                      <?php include('_reply_common_2.php');?>
                </div>
            </li>
 <?php endforeach;?>