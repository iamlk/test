<?php

  Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl.'/widget/zyxcalendar/zyxcalendar.css');
  Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/widget/zyxcalendar/zyxcalendar.js');
?>
<div id="order-results-list">
<script>
$(function(){
    $('.filter-list input.calendar').zyxCalendar({
		  output:'yyyy-mm-dd'
		});
});
</script>
               <div class="seller-order-list  product-order-list">
               
                      <div  class="filter">
                      <form action="<?php echo $this->createUrl('center/shortrun');?>" method="get">
                      <input type='hidden' value="search" name="action"/>
                       <ul class="filter-list">
                           <li>
                               <ul>
                                   <li>
                                       <label>订单编号：</label>
                                       <input type="text" class="odder-num" value="<?php echo $data['search_order_code'];?>" name="search_order_code"/>
                                   </li>
                                   <li>
                                       <label>顾客姓名：</label>
                                       <input type="text" class="customer-name" value="<?php echo $data['search_order_name'];?>" name="search_order_name"/>
                                   </li>
                               </ul>
                           </li>
                           <li>
                               <ul>
                                   <li>
                                       <label>下单时间：</label>
                                       <input class="zyx-ipt w100 calendar" type="text" value="<?php echo $data['search_orderdown_time_start'];?>"  name="search_orderdown_time_start"/>
                                       <i>-</i>
                                       <input class="zyx-ipt w100 calendar" type="text" value="<?php echo $data['search_orderdown_time_end'];?>"  name="search_orderdown_time_end"/>
                                   </li>
                                   <li>
                                       <label>出发时间：  </label>
                           
                                       <input class="zyx-ipt w100 calendar" type="text" value="<?php echo $data['search_go_time_start'];?>" name="search_go_time_start"/>
                                       <i>-</i>
                         
                                       <input class="zyx-ipt w100 calendar" type="text" value="<?php echo $data['search_go_time_end'];?>" name="search_go_time_end"/>
                                   </li>
                               </ul>
                           </li>
                           <li>
                               <ul>
                                   <li>
                                       <label>国家： </label>
                                       <?php $country=CountryAddendum::model()->findAll();?>
                                       <select  class="filter-select" name="country">
                                          <option value="all">不限</option>
                                          <?php foreach($country as $item):?>
                                           
                                           <option value="<?php echo $item->country_id;?>" <?php if($data['country'] == $item->country_id):?> selected="true"<?php endif;?>><?php echo $item->name;?></option>
                                          
                                           <?php endforeach;?>
                                       </select>
                                   </li>
                                   <li>
                                       <label>排序：</label>
                                       <select class="filter-select" name="order">
                                           <option value="all" <?php if($data['order'] === 'all'):?> selected="true"<?php endif;?>>不限</option>
                                           <option value="3"  <?php if($data['order'] === '3'):?> selected="true"<?php endif;?>>已付款</option>
                                           <option value="0"  <?php if($data['order'] === '0'):?> selected="true"<?php endif;?>>未付款</option>
                                           <option value="2"  <?php if($data['order'] === '2'):?> selected="true"<?php endif;?>>过期未支付</option>
                                       </select>
                                   </li>
                               </ul>
                           </li>
                       </ul>
                       <p><input type="submit" class="zyxbtn2" value="筛选" /></p>
                       </form>
                   </div>
                        <table class="buyers-table">
                            <tbody>
                            <tr>
                                <th class="bl1">商品名称</th>
                                <th>买家</th>
                                <th>国家</th>
                                <th>订单总额</th>
                                <th>入住时间</th>
                                <th>交易状态</th>
                                <th>操作</th>
                            </tr>
							<?php  foreach( $h_order->getData() as $item):?>
							<tr  class="order_<?php echo $item->order_code;?>">
								<td colspan="7" class="p0">
									<p class="item-title mt10 brb0">订单编号：<?php echo $item->order_code;?><span class="indent20">下单时间：<?php echo date('Y-m-d H:i:s',$item->created);?></span></p>
								</td>
							</tr>
							<?php foreach( $item->orderDetails as $val):?>
							<?php $orderinfo=json_decode($val->json);?>
							<tr class="order_<?php echo $item->order_code;?>">
								<td class="name txtl">
									<img width="70" height="45" src=" <?php echo '/thumb/70_45/'.$orderinfo->img;?>">
								    <a href="<?php echo $this->createUrl('goods/index',array('id'=>$val->goods_id));?>" title="<?php echo $orderinfo->title?>" target="_blank">
										<?php echo mb_substr($orderinfo->title, 0, 6);?>
								    </a>
								</td>
								<td class="seller">
									<span>
										<a href="<?php echo Dynamic::goUrl($item->customer_id,'center');?>" target="_blank">
											<?php echo Customer::model()->getUserNickName($item->customer_id);?>
										</a>
									</span>
								</td>
								<td class="country">
									<span>
										<a href="#">中国</a>
									</span>
								</td>
								<td class="ordertotal">
									<span><?php echo !empty($val->price)?'￥'.$val->price:'';?></span>
								</td>
								<td class="data">
									<span><?php echo $val->goods_start_date;?></span>
								</td>
							   <td class="status">
									 <?php include('_order_status.php');?>
							   </td>
							   <td class="operate">
								   <a href="<?php echo $this->createUrl('order/sellerorderdetail',array('id'=>$val->order_detail_id))?>" target="_blank">查看详情</a>
								   <a data-order="<?php echo $item->order_code;?>" href="<?php echo $this->createUrl('order/sellerdeleteorder',array('id'=>$val->order_detail_id))?>"  class="order item delete ajax-item">删除</a>
							   </td>
							</tr>
							<?php  endforeach;?>
							<?php  endforeach;?>
						</tbody>
					</table>
<?php
$this->widget('application.widgets.PageToolbar' , array('pagination'=>$h_order->pagination, 'ajaxContainerId'=>'order-results-list','useAjax'=>true, 'route'=>'center/CompanionShortRunOrder'));
?>
               </div>
               </div>