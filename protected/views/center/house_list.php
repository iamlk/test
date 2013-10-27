                  
                   <?php foreach($model->getData() as $item):?>
                   

                      
                   <p class="item-title mt10">住所编号：<?php echo  $item->goods->code ;?>       编辑时间：<?php echo  date('Y-m-d H:i:s',$item->goods->created );?></p>
                   <table class="mycent-table">
                       <tr>
                           <td>
                               <div class="name">
                          
                                 <img src="<?php echo '/thumb/108_72/'.$item->goodsImage->attributes['path'];?>" width="108" height="72" />
                                 
                          
                                  
                                   <div class="name-right">
                                       <a href="<?php //echo $this->createUrl('property/info',array('property_id'=>$item->property_id));?>" target="_blank"><?php echo $item->propertyAddendum->attributes['title'];?></a>
                                       <p>
                                       <a href="<?php echo $this->createUrl('property/info',array('property_id'=>$item->property_id));?>" target="_blank" class="zyxbtn3">管理产品</a>
                                       <?php if($item->goods->is_active == 1):?>
                                       <a href="<?php echo $this->createUrl('goods/index',array('id'=>$item->goods->goods_id));?>" target="_blank" class="zyxbtn3 indent10">预览</a>
                                       <?php endif;?>
                                       </p>
                                   </div>
                               </div>
                           </td>
                           <td>
                                <div class="status">

                                <?php if( $item->goods->is_active == 0):?>
                                <p class="status-wrap"><span class="gray">(已下架)</span><a href="<?php echo $this->createUrl('/center/goodsstate',array('g_id'=>$item->goods_id));?>" class="btn indent10 ajax-item on">恢复</a></p>
                                   <p class="gray">您的住所不会显示在搜索结果中。如果该住所已被预订，只对即将到来的房客可见。</p>
                          
                                    
                                <?php elseif( $item->goods->is_active == 1 ):?> 
                                          <p class="status-wrap"><span class="green">(显示中)</span><a href="<?php echo $this->createUrl('/center/goodsstate',array('g_id'=>$item->goods_id));?>" class="btn indent10  ajax-item down">下架</a></p>
                                    <p class="gray">您的住所已发布成功，并将显示在搜索结果中。</p>
                                <?php elseif( $item->goods->is_active == 2 ):?>  
                                <p class="status-wrap"><span class="red"></span><a href="http://<?php echo $_SERVER['SERVER_NAME'];?>/index.php?r=property/info&property_id=<?php echo $item->property_id; ?>" target="_blank" class="btn indent10">完善</a></p>
                                   <p class="gray">您的住所现在为待售状态，不会显示在搜索结果中，请完善信息正式出售。</p>
                                
                                <?php endif;?>  
                                    
                                </div>
                           </td>
                       </tr>
                   </table>
                        

                   
                   <?php endforeach;?>
               <?php
$this->widget('application.widgets.PageToolbar' , array('pagination'=>$model->pagination, 'ajaxContainerId'=>'results-list','useAjax'=>true, 'route'=>'center/companionhouse'));
?>