<?php foreach(Dynamic::model()->getFoodDynamicInfo($item['interfix_id'],$item['interfix_type']) as $value):?>

<?php $city_id = Food::model()->getFoodCityId($item['interfix_id']);?>
            <li>
                <div class="talk-user-pic"><a rel="@keke" target="_blank" href="<?php echo Dynamic::goUrl($item['customer_id'],'center');?>"><img alt="" src="<?php echo '/thumb/48_48/'.Customer::model()->getUserHeaderImage($item['customer_id']);?>"></a></div>
                <div class="talk-content">
                    <span class="talk-icon-arrow"></span>
                    <p class="talk-user-info">
                        <a rel="@keke" target="_blank" href="<?php echo Dynamic::goUrl($item['customer_id'],'center');?>" class="talk-user-name"><?php echo Customer::model()->getUserNickName($item['customer_id']);?></a> <?php echo Dynamic::model()->getDynamicAction($item['action']);?>了城市 <a target="_blank" class="talk-link" href="<?php echo  $this->createUrl('food/view',array('cid'=>$city_id ,'id'=>$item['interfix_id']));?>">“<?php echo  $value['title'];?>”</a>
                    </p>
                    <div class="media-box">
                  <?php   $image=json_decode($value['img_url']);
                    //echo $image[0]
                     //print_r($image);
                  ?>
                    <a class="photo-share" href="<?php echo  $this->createUrl('food/view',array('cid'=>$city_id ,'id'=>$item['interfix_id']));?>"><img alt="" src="/thumb/120_90/<?php echo $image[0]?>"></a>
               
                    </div>
                    <div class="msg-box">
                    </div>
                    <div class="talk-info">
                    <?php $type=Dynamic::FOOD?>
                      <?php include('_share.php');?>

                    </div>
                     <?php //include('_reply_common_2.php');?>
                </div>
            </li>
<?php endforeach;?>