 <?php foreach(Dynamic::model()->getArticleReviewDynamicInfo($item['interfix_id']) as $value):?>
 
<li>
                <div class="talk-user-pic"><a href="<?php echo Dynamic::goUrl($item['customer_id'],'center');?>"><img alt="" src="<?php echo '/thumb/48_48/'.Customer::model()->getUserHeaderImage($item['customer_id']);?>"></a></div>
                <div class="talk-content">
                    <span class="talk-icon-arrow"></span>
                    <p class="talk-user-info">
                        <a rel="@keke" target="_blank" href="<?php echo Dynamic::goUrl($item['customer_id'],'center');?>" class="talk-user-name"><?php echo Customer::model()->getUserNickName($item['customer_id']);?></a> 在 <a target="_blank" class="talk-link" href="<?php echo  $this->createUrl('article/view',array('id'=>$item['interfix_id']));?>">“<?php echo  $value->addendum->title;?>”</a>进行了<?php echo Dynamic::model()->getDynamicAction($item['action']);?>。
                    </p>
                    <div class="msg-box">
                     <?php echo $value->reviewOne->content;?>
                    </div>
                    <div class="talk-info">
                       <?php $type=Dynamic::ARTICLE?>
                       <?php include('_share_collect_pl.php');?>
                    </div>
                </div>
            </li>
<?php  endforeach;?>            
