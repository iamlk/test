
<div class="main-right">
        <h3 class="cent-title"><a href="">我是卖家</a> <em>&gt;</em>我的订单</h3>
           <div class="evaluate">
           <?php foreach($data as $item):?>
               <ul class="status-info">
                   <li>订单编号：<?php echo $item->order->order_code;?></li>
                   <?php $order_status=$item->order->order_status?>
                   <li>订单状态：<?php include('_order_status.php');?></li>
                   <li class="last"><span class="fontw">下单时间：<?php echo date('Y-m-d H:i:s',$item->order->created);?></span></li>
               </ul>
               <div class="product-info-wrap">
               
                   <div class="product-tit">
                       <label><span class="order-info">预订人信息</span><span class="green">（默认为联系人）</span></label>
                   </div>
                   <div class="product-content">
                       <div class="product-des">
                           <ul class="customer-list">
                               <li>
                                   <p><label>姓名：</label><span class="name"><?php  echo $item->order->first_name.' '.$item->order->last_name; ?></span></p>
                               </li>
                               <li>
                                   <p><label>邮箱：</label><span class="email"><?php echo $item->order->email; ?></span></p>
                               </li>
                               <li>
                                   <p><label>国家：</label><span class="country"><?php echo Country::getCountryName($item->order->country_id); ?></span></p>
                               </li>
                           </ul>
                       </div>
                   </div>
                   <h2 class="product-info-tit">
                       <span class="product-info">订单详情</span>
                       <span class="constact">有问题？ <a href="javascript::void(0)" class="feedback">咨询四海网</a></span>
                   </h2>
                   
                   <?php $count=0;?>
                   <?php //foreach( $item->orderDetails as $value):?>
                   
                   <?php  //echo $value->price;
$room_type = Product::$RoomType;
$price = $item->price?G4S::format($item->price):G4S::format($item->price);
$price_rmb = $item->price?G4S::format($item->price*SiteOption::getValueByKey('USD_TO_RMB',true)):G4S::format($price*SiteOption::getValueByKey('USD_TO_RMB',true));
?>
                   
                   
                   
                    <?php $count++;?>
                    <div class="product-info-content">
                        <div class="product-tit">
                         <?php if( $item->entity_type == 1):?>
                            <label><span class="order-info">卖家信息</span></label>
                          <?php else:?>  
                            <label><span class="order-info">房东信息</span></label>
                          <?php endif;?>
                        </div>
                        <div class="product-content">
                            <div class="product-des">
                                <ul class="customer-list">
                                    <li>
                                        <p><label>姓名：</label><span class="name"><?php echo Customer::model()->getUserNickName($item->provider_id);?></span></p>
                                    </li>
                                    <li>
                                        <p><label>邮箱：</label><span class="email"><?php echo Customer::model()->getUserEmail($item->provider_id);?></span></p>
                                    </li>
                                    <li>
                                        <p><label>地址：</label><span class="country"><?php echo Customer::model()->getUserAddress($item->provider_id);?></span></p>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <?php $info=json_decode($item->json);//print_r($info);?>
                        <?php if( $item->entity_type == 1):?>
                        
                        <div class="product">
                            <div class="product-tit">
                                <label>商品(<?php echo $count;?>)：参加短期行程</label> </div>
                            <div class="product-des">
                                <div class="fl">
                                    <a href="<?php echo  $this->createUrl('goods/index',array('id'=>$item->goods_id));?>"><img width="37" height="37" src="<?php echo '/thumb/37_37/'.$info->img;?>" ></a>
                                </div>
                                <div class="product-option-wrapitem">
                                    <ul class="product-option">
                                        <li><a target="_blank" href="<?php echo  $this->createUrl('goods/index',array('id'=>$item->goods_id));?>"><?php echo $info->title?></a></li>
                                        <li>
                                            <span class="product-time"><label>出发地点：</label><em><?php echo  Order::model()->getGoodsGoAddress($info->_id,1); ?></em></span>
                                            <dl class="pview">
                                                <dd class="adult"><label>成人：</label><?php echo $info->adult;?>人</dd>
                                                <dd class="children"><label>儿童：</label><?php echo $info->child;?>人</dd>
                                            </dl>
                                        </li>
                                          <li>
                                            <span class="product-time"><label>出发时间：</label><em><?php echo $item->goods_start_date;?></em></span>
                                            <dl class="pview">
                                                <dd class="adult"><label>结束时间：</label><em><?php echo $item->goods_end_date;?></em></dd>
                                                <dd class="children"><label>持续时间：</label><em><?php echo $item->goods_dates;?></em></dd>
                                            </dl>
                                        </li>
                                        <li>
                                            <label>商品价格：</label>
                                            <strong class="orange">$<?php echo $price;?></strong>
                                            <label class="indent5">(美元)</label>
                                            <strong class="indent20">￥<?php echo $price_rmb;?></strong>
                                            <label class="indent5">(人民币)</label>
                                        </li>
                                        <?php foreach($info->rooms as $key=>$val):?>
                                          <li>
                                            <label>房间预订：</label>
                                           
                                            <strong class="indent20"> <?php echo $room_type[$key]?></strong>
                                            <label class="indent5"><?php echo $val?>间</label>
                                            <label class="indent5"><?php echo  date('Y-m-d H:i:s',$item->created)?></label>
                                        </li>
                                       <?php endforeach;?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        
                        <?php  else:?>
                            <div class="product">
                            <div class="product-tit">
                                <label>商品(<?php echo $count;?>)：入住度假公寓</label> </div>
                            <div class="product-des">
                                <div class="fl">
                                    <a target="_blank" href="<?php echo  $this->createUrl('goods/index',array('id'=>$item->goods_id));?>"><img width="37" height="37" src="<?php echo '/thumb/37_37/'.$info->img;?>" ></a>
                                </div>
                                <div class="product-option-wrapitem">
                                    <ul class="product-option">
                                        <li><a href="<?php echo  $this->createUrl('goods/index',array('id'=>$item->goods_id));?>"><?php echo $info->title?></a></li>
                                        <li>
                                            <span class="product-time"><label>入住时间：</label><em><?php echo $item->goods_start_date;?>&mdash;&mdash;<?php echo $item->goods_end_date;?></em></span>
                                            <dl class="pview">
                                                <dd class="adult"><label>成人：</label><?php echo $info->adult;?>人</dd>
                                                <dd class="children"><label>儿童：</label><?php echo $info->child;?>人</dd>
                                            </dl>
                                        </li>
                                        <li>
                                            <label>商品价格：</label>
                                            <strong class="orange">$<?php echo $price;?></strong>
                                            <label class="indent5">(美元)</label>
                                            <strong class="indent20">￥<?php echo $price_rmb;?></strong>
                                            <label class="indent5">(人民币)</label>
                                        </li>

                                    </ul>
                                </div>
                            </div>
                        </div>
                        
                        
                        
                        <?php endif;?>
                        
                        
                        
                    </div>
                   <?php //endforeach;?>
               </div>
                <?php endforeach;?>
           </div>
   </div>