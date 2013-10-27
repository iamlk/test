<div class="left-box">
<?php //$this->widget('application.widgets.RecommendationItineraryWidget'); ?>
<?php $this->widget('application.widgets.RecommendationProductWidget',array('city_id'=>$_GET['cid'])); ?>
<?php $this->widget('application.widgets.RecommendationPropertyWidget',array('city_id'=>$_GET['cid'])); ?>
</div>
<div class="right-box">
    <div class="zyxbox martop0">
        <div class="zyxbox-tit3 bt0">
            <h3 class="tit-color3">热门行程单 </h3>
            <p class="tit-line"></p>
        </div>
        <div class="zyxbox-content">
            <ul class="share-list">
                <?php 
                foreach($list->getData() as $it):
                    $details = $it->itineraryDetails;
                    $share = SiteCoolCount::getShare(md5((Dynamic::TRAVEL).($it->itinerary_id)));
                    $fav = SiteCoolCount::getFavorite(md5((Dynamic::TRAVEL).($it->itinerary_id)));
                    $url = $this->createUrl('itinerary/view',array('cid'=>$_GET['cid'],'id'=>$it->itinerary_id));
                ?>
                <li>
                    <h4 class="share-tit"><a href="<?php echo $url; ?>"><?php echo $it->title;?></a>&nbsp;<span class="share-pay">人均消费：<em>￥<?php echo G4S::format($it->cpp);?></em></span></h4>
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
                        <em>阅读(<?php echo $it->view_count?>)</em><em> 回复(<?php echo $it->reviewCount;?>)</em><em>收藏(<?php echo $fav ?>) </em><em>分享(<?php echo $share ?>)</em>
                        <span class="sharer">分享者：<?php echo Customer::link($it->customer_id) ?></span>
                        <span class="sharing-time">分享时间：<em><?php echo date('Y年m月d日',$it->created);?></em></span>
                    </div>
                </li>
                <?php endforeach?>
            </ul>
            <div class="page-warp">
                <div class="pages">
                        <?php
                        $this->widget('application.widgets.PageToolbar' , 
                            array('pagination'=>$list->pagination, 
                            'ajaxContainerId'=>'results-list',
                            'useAjax'=>false, 
                            'route'=>'itinerary/index',
                            'routeParams'=>array('cid'=>$_GET['cid'])
                            )
                        );
                        ?>
                </div>
            </div>
        </div>
    </div>
</div>