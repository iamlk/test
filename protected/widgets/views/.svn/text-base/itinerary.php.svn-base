<div class="zyxbox">
  <div class="zyxbox-tit1">
    <h3 class="tit-color1"><?php echo City::getCityName($this->cid),'行程单分享',CHtml::link('更多',$this->controller->createUrl('itinerary/index',array('cid'=> $this->cid))); ?></h3>
    <p class="tit-line"></p>
  </div>
  <div class="zyxbox-content pad0">
    <ul class="share-list">
                <?php 
                foreach($list->getData() as $it):
                    $details = $it->itineraryDetails;
                    $share = SiteCoolCount::getShare(md5((Dynamic::TRAVEL).($it->itinerary_id)));
                    $fav = SiteCoolCount::getFavorite(md5((Dynamic::TRAVEL).($it->itinerary_id)));
                    $url = $this->controller->createUrl('itinerary/view',array('cid'=>$_GET['cid'],'id'=>$it->itinerary_id));
                ?>
                <li>
                    <h4 class="share-tit"><?php echo $it->title;?>&nbsp;<span class="share-pay">人均消费：<em>￥<?php echo G4S::format($it->cpp);?></em></span></h4>
                    <ul class="share-img">
                    <?php 
                    foreach($details as $i=>$detail):
                    $json = json_decode($detail->json,true);
                    if($i==4) {echo '<li class="share-img-more"><a href="',$url,'">...</a></li>';break;}
                    ?>
                        <li class="<?php if($i==0) echo 'share-img-first';?>">
                            <a href="<?php echo $url?>">
                                <img alt="" src="<?php echo '/thumb/_80/'.$json['img'] ?>" />
                            </a>
                        </li>
                    <?php 
                    endforeach;
                    if($i<4) echo '<li class="share-img-more"><a href="',$url,'">...</a></li>';
                    ?>
                    </ul>
                    <div class="share-bottom-wrap">
                        <em>阅读(<?php echo $it->view_count?>)</em>
                        <em>回复(<?php echo $it->reviewCount;?>)</em>
                        <em>收藏(<?php echo $fav ?>) </em>
                        <em>分享(<?php echo $share ?>)</em>
                        <span class="sharer">分享者：<?php echo Customer::link($it->customer_id); ?></span>
                        <span class="sharing-time">分享时间：<em><?php echo date('Y年m月d日',$it->created);?></em></span>
                    </div>
                </li>
                <?php endforeach?>
    </ul>
  </div>
</div>