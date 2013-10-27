<div id="send_comment">
<div class="main-right">
        <h3 class="cent-title">评论管理</h3>
           <div class="evaluate">
               <ul class="cons-tit">
                   <li class="nav">我给出的评论</li>
               </ul>
               <div class="cons-list">
                   <table class="mycent-table">
                       <tr>
                           <th>商品</th>
                           <th>被评论人</th>
                           <th>评论</th>
                           <th>分享</th>
                       </tr>
                        
                      
                       <?php foreach($comment->getData() as $value):?>
        
                         <?php  $key =array_keys($value);?>
                       
                       <tr>
                       
                        <?php if($this->actionGetReviewType($key[0])=='property'):?>
       
                                  <td><a href="###"><?php echo PropertyAddendum::model()->getPropertyTitle($value['property_id']) ;?></a><span class="orange block">$ <?php echo PropertyPrice::model()->getPropertyPrice($value['property_id']);?></span></td>
       
                        <?php else:?>
                  
                                             <td><a href="###"><?php echo ProductAddendum::model()->getProductTitle($value['product_id']) ;?></a><span class="orange block">$ <?php echo ProductAttribute::model()->getProductPrice($value['product_id']);?></span></td>
                        <?php endif;?>

                           
                           
                           <td>卖家：<a href="/people/index?u_id=<?php echo $value['customer_id'];?>" target="_blank"><?php echo Customer::model()->getUserNickName($value['customer_id']);?></a></td>
                           <td><?php echo mb_substr($value['description'],0,40);?></td>
                           <td><a href="###" >一键分享</a></td>
                       </tr>
                        <?php endforeach;?>

                   </table>
               </div>
 

              </div>
<?php
$this->widget('application.widgets.PageToolbar' , array('pagination'=>$comment->pagination, 'ajaxContainerId'=>'send_comment','useAjax'=>true, 'route'=>'comment/buyergivecommentpage'));
?>
</div>
</div>
    