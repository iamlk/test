<div class="product-wrap-left mt10">
        <form action="" method="post" id="my-order-form">
            <div class="product-tit">
            <span class="my-confirm">设计我的行程单</span>
			<span  class="new-confirm <?php if(Yii::app()->user->isGuest)echo 'fast-login';?>" title="清空并重新创建行程单"></span>
			</div>
			
            <div class="product-content1 confirm-data-bg">
                <div class="confirm-data  left-line-blue">
                    <p class="indentl5">
                    <span><?php echo $basket->start_date?date('Y年m月d日',strtotime($basket->start_date)):date('Y年m月d日',strtotime('+1 day')); ?></span>-<span><?php echo $basket->end_date?date('Y年m月d日',strtotime($basket->end_date)):date('Y年m月d日',strtotime('+5 year')); ?></span>
                    </p>
                </div>
            </div>
            <script type="text/javascript">
                $(function(){
                    $('#btn-pay-account').click(function(){
                        $(this).css({"opacity":"0.6"}).attr("disabled","true");
            		    $.post("<?php echo $this->controller->createUrl('order/create');?>",{name:"zyx"},
            			function(data){
            			     if(data.status) window.location.href=data.url;
                             else alert(data.msg);
            			},'json');
                    });
                });
            </script>
            <div class="product-content-wrap">
               <div class="product-content-scroll">
					<input type="hidden" id="pro-num"  value="<?php echo intval($basket->current_day_step); ?>"/>
                    <?php if(!$basket){?>

                   <div class="product-content product-content-box select">
                       <div class="itinerary left-line-gray">
                           <em class="itinerary-icon icon-gray">1</em>
                           <h2 class="itinerary-num1">
                               <span class="itinerary-num1-indent">
                                   <label><?php echo date('n.j',strtotime($basket->start_date)); ?> 去往</label>
                                   <b class="indent5"><?php echo City::getCityName($_GET['city']) ?></b>
                                   <a class="indent5 toggle" href="javascript:;"  id="y">切换</a>
                               </span>
                           </h2>
                       </div>
                       <div class="order-wrap left-line-gray">
                           <ul class="order-list">
                               <li><label>住宿</label></li>
                               <li><label>游玩</label></li>
                               <li><label>餐饮</label></li>
                               <li><label>交通</label></li>
                           </ul>
                       </div>
                   </div>
                   <?php
                   }else{
                        foreach($plan as $i => $p){
                            if(!$p[1]) continue;
                            if(is_object($p[0])){
                                $basket->updatePlanDate();
                                $ext_date = date('n.j',strtotime('+'.$i.' day',strtotime($basket->start_date)));
                                array_unshift($p,$ext_date);
                            }
                            if(is_object($p[1]))$p[1]=intval($_GET['city']);
                            $city = City::getCityName($p[1]);
                            $city = $city?$city:City::getCityName($_GET['city']);
                   ?>
                   <div class="product-content product-content-box <?php if($basket->current_day_step == $i)echo 'select'; ?>">
                       <div class="itinerary left-line-blue">
                           <em class="itinerary-icon"><?php echo ($i+1); ?></em>
                           <h2 class="itinerary-num1">
                               <span class="itinerary-num1-indent">
                                   <label><?php echo $p[0] ?> 去往</label>
                                   <b class="indent5"><?php echo $city ?></b>
                                   <a href="javascript:;" step="<?php echo intval($i); ?>" class="update">修改</a>
                                   <!--a class="indent5 toggle" href="javascript:;" id="_<?php echo intval($i); ?>">切换</a-->
                               </span>
                           </h2>
                       </div>
                       <div class="order-wrap left-line-blue">
                           <ul class="order-list">
                           <?php
                           foreach($p as $j => $d){ if($j<=1) continue;
                                $src = '/thumb/46_46/'.$d->goods->{Goods::$goods_type[$d->entity_type]}->goodsImage->path;
                                $id = $d->goods->{Goods::$goods_type[$d->entity_type]}->{Goods::$goods_type[$d->entity_type].'_id'};
                                if($d->entity_type==Goods::ENTITY_PRODUCT){
                                    $show= 'showProductDetail('.$id.')';
                                }else{
                                    $show= 'showPropertyDetail('.$id.')';
                                }
                                $title = '';
                                if(!$d->is_deal){
                                    $title = '该项目还没有设置！';
                                }else{
                                    $json = json_decode($d->json,true);
                                    $title = $json['title'];
                                }
                           ?>
                               <li id="product_<?php echo $i.'_'.$d->goods_id; ?>" data-day="<?php echo $i ?>" data-id="<?php echo $d->goods_id?>"  class="product_<?php echo $d->goods_id; ?>">
                                   <a href="javascript:;" onclick="<?php echo $show; ?>;">
                                       <img width="37" height="37" src="<?php echo $src; ?>" title="<?php echo $title ?>" />
                                   </a>
                                   <p>
                                       <span class="update" onclick="<?php echo $show; ?>;" title="修改"></span>
                                       <span proid="<?php echo $d->goods_id; ?>" data-day="<?php echo $i ?>" prot="<?php echo $d->entity_type; ?>" class="delete" title="从当天移除"></span>
                                   </p>
                               </li>
                           <?php } ?>
                           <li><label>住宿</label></li>
                           <li><label>游玩</label></li>
                           </ul>
                           <p class="all-order"><a href="" class="all-product-order">全天商品清单</a></p>
                       </div>
                   </div>


                   <?php }?>
                   <div class="product-content product-content-box">
                       <div class="itinerary left-line-gray">
                           <em class="itinerary-icon icon-gray"><?php echo count($plan)+1;?></em>
                           <h2 class="itinerary-num1">
                               <span class="itinerary-num1-indent">
                                   <label>去往</label>
                                   <b class="indent5"><?php echo City::getCityName($_GET['city']) ?></b>
                                   <a class="indent5 toggle" href="javascript:;"  id="x">切换</a>
                               </span>
                           </h2>
                       </div>
                       <div class="order-wrap left-line-gray">
                           <ul class="order-list">
                               <li><label>住宿</label></li>
                               <li><label>游玩</label></li>
                           </ul>
                       </div>
                   </div>
                    <?php }?>
				   <div class="product-content2">
                       <div class="order-wrap left-line-gray"></div>
                   </div>
               </div>

                <div class="settlement bottom0">
                    <p><a href="javascript:;" id="btn-pay-account"></a></p> 
				</div>
            </div>
        </form>
    </div>