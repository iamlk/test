<div id="results-list">
<ul id="comment-list-new">
<?php 
foreach($reviews->getData() as $item):
    $customer = Customer::model()->findByPk($item->customer_id);
?>
    <li>
        <div class="comment-user-pic"><a href="<?php echo $this->createUrl('people/index',array('u_id'=>$item->customer_id)); ?>"><img src="<?php echo $customer->avator; ?>" alt="<?php echo $customer->nick_name; ?>"></a></div>
        <div class="comment-content">
        <?php 
            echo CHtml::link($customer->nick_name,$this->createUrl('people/index',array('u_id'=>$item->customer_id)),array('target'=>'_blank'));
            if($item->parent_id > 1){
                $toCustomer = $item->parent->customer;
                echo ' 回复 ',CHtml::link($toCustomer->nick_name,$this->createUrl('people/index',array('u_id'=>$toCustomer->customer_id)),array('target'=>'_blank'));
            }
            echo ':',$item->content;
        ?>
        <p class="raiders-detail-time"><?php echo date('m月d日 H:i',$item->created) ?></p>
        </div>
        <a href="javascript:;" id="<?php echo $item->itinerary_review_id?>" class="reply-comment">回复</a>
    </li>
<?php endforeach?>
</ul>
<?php
$this->widget('application.widgets.PageToolbar' , array('pagination'=>$reviews->pagination, 'ajaxContainerId'=>'results-list','useAjax'=>true, 'route'=>'itinerary/review'));
?>
</div>