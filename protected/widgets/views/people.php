<!-- set widget-->
    <div class="my-center-wrap clearfix  mt20">

       <?php if( !empty($data->attributes['avator']) && file_exists('./assets/'.$data->attributes['avator']) ):?>
       
        <img src="/thumb/160_160/<?php echo $data->attributes['avator'];?>" alt="" width="160" height="160" class="my-center-photo"/>
       
       <?php else:?>
       
        <img src="/thumb/160_160/assets/userheader/default_header.png" alt="" width="160" height="160" class="my-center-photo"/>
        
       <?php endif;?>
       
        <div class="my-center-info">
            <p class="position"><strong><?php echo $data->attributes['nick_name'];?></strong><!--span class="green indent5">(在线)</span--><img src="/images/common/my_contacts.png" alt="" width="30" height="25" class="indent5"><em class="indent5">LV30</em></p>
            <p>1<?php echo Customer::getAddress($data->attributes['customer_id'])?></p>
           <!-- <p>当前积分: <b class="green">5000</b>分</p>
            <p class="edition">我要发布</p>--->
            <p class="mt20"><?php echo $data->attributes['introduction'];?></p>
        </div>
    </div>

<!-- set widget-->