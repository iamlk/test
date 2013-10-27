
<h3 class="h3-style YH">发现友邻</h3>
                <ul class="friends-list">
          
                <?php foreach($provider as $item):?>
             
         
                <li>
                <a href="<?php echo Dynamic::goUrl($item['customer_id'],'center');?>"><img src="<?php echo  '/thumb/45_45/'.Customer::model()->getUserHeaderImage($item['customer_id']);?>" alt="" width="45" height="45"/></a>
                <p><a href="<?php echo Dynamic::goUrl($item['customer_id'],'center');?>"><?php echo Customer::model()->getUserNickName($item['customer_id']);?></a></p>
                <?php $info=json_decode($item['json']);?>
                <p>TA购买了<a href="<?php echo $this->createUrl('goods/index',array('id'=>$info->_id));?>">“<?php  echo $info->title;?>”</a>...</p>
                </li>
               
                 <?php endforeach;?>
                </ul>
