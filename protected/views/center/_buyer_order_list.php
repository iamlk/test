    <div id="buyer_order">
		<div class="seller-order-list buyers-order-list">
            <table class="buyers-table">
                <tr>
                    <th class="bl1">商品名称</th>
                    <th>卖家</th>
                    <th>金额</th>
                    <th>交易状态</th>
                    <th>订单总额</th>
                    <th>操作</th>
                </tr>
                
          <?php foreach($data->getData() as $item ):?>
                
                <tr class="order_<?php echo $item->order_code;?>">
                    <td colspan="6" class="p0"><p class="item-title mt10 brb0">订单编号：<?php echo $item->order_code;?> <span class="indent20">下单时间：<?php echo date('Y-m-d H:i:s',$item->created);?></span></p></td>
                </tr>
                <?php $temp=0;?>
                <?php foreach($item->orderDetails as $val):?>
                <?php $count=count($item->orderDetails);$orderinfo=json_decode($val->json);?>
                 <?php $temp++;?>
                 <?php if($temp==1):?>
                
                <tr class="order_<?php echo $item->order_code;?>">
                    <td class="name txtl">
                        <img src="<?php echo '/thumb/70_45/'.$orderinfo->img;?>" width="70" height="45" />
                        <a href="<?php echo $this->createUrl('goods/index',array('id'=>$val->goods_id))?>" title="<?php echo $orderinfo->title;?>" target="_blank"><?php echo mb_substr($orderinfo->title,0,6);?></a>
                    </td>
                    <td class="seller">
                        <span><a href="<?php echo Dynamic::goUrl($item->customer_id,'center');?>" target="_blank"><?php echo Customer::model()->getUserNickName($item->customer_id);?></a></span>
                    </td>
                    <td  class="money">
                        <span> <?php echo !empty($val->price)?'￥'.$val->price:'';?></span>
                    </td>
                    <td class="status">
                    <?php  include('_order_status.php');?>
                    </td>
                    <td class="ordertotal" rowspan="<?php echo $count;?>">
                        <span><?php echo !empty($item->payment_total)?'￥'.$item->payment_total:'';?></span>
                    </td>
                    <td class="operate" rowspan="<?php echo $count;?>">
                        <?php if( $item->order_status < Order::EXPIRED_STATUS):?>
                        <a href="<?php echo $this->createUrl('/order/confirm',array('oid'=>$item->order_id))?>" target="_blank">订单详情</a>
                        <?php else:?>
                        <a href="<?php echo $this->createUrl('/order/buyerorderdetail',array('id'=>$item->order_id))?>" target="_blank">订单详情</a>
                        <?php endif;?>

                         <?php if( $item->order_status == Order::PAID_STATUS ):?>
                        
    <a  class="share ajax-share" href="<?php echo $this->createUrl('center/travelshare',array('id'=>$item->order_id));?>">分享</a>
  
                        <?php endif;?>
                        
                        <?php if( $item->order_status == Order::ITINERARY_STATUS ):?>
                        
    <a  class="share" href="javascript:void(0)">已分享</a>
  
                        <?php endif;?>

                        <a data-order="<?php echo $item->order_code;?>" href="<?php echo $this->createUrl('/order/BuyerDeleteOrder',array('id'=>$item->order_id))?>" class="order  delete ajax-item">删除</a>

                        
                    </td>
                </tr>
                <?php else:?>
                
                   <tr class="order_<?php echo $item->order_code;?>">
                    <td class="name txtl">
                        <img src="<?php echo '/thumb/70_45/'.$orderinfo->img;?>" width="70" height="45" />
                        <a href="<?php echo $this->createUrl('goods/index',array('id'=>$val->goods_id))?>" title="<?php echo $orderinfo->title;?>" target="_blank"><?php echo mb_substr($orderinfo->title,0,6);?></a>
                    </td>
                    <td class="seller">
                        <span><a target="_blank" href="<?php echo Dynamic::goUrl($item->customer_id,'center');?>"><?php echo Customer::model()->getUserNickName($item->customer_id);?></a></span>
                    </td>
                    <td  class="money">
                        <span><?php echo !empty($val->price)?'￥'.$val->price:'';?></span>
                    </td>
                    <td class="status" >
                        <?php  include('_order_status.php');?>
                    </td>
                </tr>
                
                <?php endif;?>
                <?php endforeach;?>
                
               
               <?php endforeach;?>
     
            </table>
                                               <?php
$this->widget('application.widgets.PageToolbar' , array('pagination'=>$data->pagination, 'ajaxContainerId'=>'buyer_order','useAjax'=>true, 'route'=>'center/buyerorderpage'));
?>
		</div>
        </div>