
            <?php $image=json_decode($item['img_url']);?>
          
                    <div class="fl">
                        <a href="<?php echo Dynamic::goUrl($item['customer_id'],'center');?>"><img width="48" height="48" src="<?php echo '/thumb/48_48/'.Customer::model()->getUserHeaderImage($item['customer_id']);?>"></a>
                    </div>
                    <div class="fr">
                        <div class="product-tit">
                            <label><a href="<?php echo Dynamic::goUrl($item['customer_id'],'center');?>"><?php echo Customer::model()->getUserNickName($item['customer_id']);?>：</a>先MARK，再对比一下看看吧！</label>
                        </div>
                        <div class="product-des">
                            <div class="fl">
                                <a href="<?php echo $this->createUrl('article/view',array('id'=>$item['object_id']));?>"><img width="180" height="130" src="<?php echo '/thumb/180_130/'.$image[0];?>"></a>
                                <p class="share-time"><?php echo date('Y-m-d H:i:s',$item['created']);?></p>
                            </div>
                            <div class="product-option-wrap">
                                <ul class="product-option">
                                    <li class="first"><h3 class="share-tit"><a href="<?php echo $this->createUrl('article/view',array('id'=>$item['object_id']));?>"><?php echo $item['title']?></a></h3></li>
                                    
                                    <?php foreach(Dynamic::model()->getArticleDynamicInfo($item['object_id']) as $value):?>
                                    
                                    <li>发布者：<a href="<?php echo Dynamic::goUrl($value->customer_id,'center');?>"><?php echo Customer::model()->getUserNickName($value->customer_id)?></a> <span class="updata_time">更新时间：<?php echo date('Y-m-d H:i:s',$value->created)?></span></li>
                                    <li>       
                                    
                                    <?php
                                    $pattern="/<[img|IMG].*?src=[\'|\"](.*?(?:[\.gif|\.jpg|\.png]))[\'|\"].*?[\/]?>/";
                             
                                    $str = strip_tags($value->addendum->content);
                                  
                                    $content = preg_replace($pattern,' ',$str);
?>
                                                                 
                                        <p class="itinerary-info"><?php echo mb_substr($content, 0, 150).'......'; ?></p>
                                    </li>
                                    
                                    <?php endforeach;?>
                                </ul>
                            </div>
                        </div>
                        <a href="<?php echo $this->createUrl('share/delete',array('type'=>$item['object_type'],'id'=>$item['object_id']))?>" class="delete ajax-item">删除</a>
                    </div>
     
          