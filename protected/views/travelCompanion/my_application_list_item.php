<ul class="apply-list">
<?php foreach($application as $a){ ?>
    <li class="last">
        <div class="apply-wrap	">
            <p class="apply-link fl">
<?php echo CHtml::link($a->travelCompanion->title,$this->createUrl('travelCompaion/view',array('id'=>$a->travelCompanion->travel_companion_id),array('target'=>'_blank')))?>
            </p>
            <span class="fr gray">
 <?php echo CHtml::link($a->travelCompanion->customer->full_name,$this->createUrl('center/user',array('id'=>$a->travelCompanion->customer->customer_id),array('target'=>'_blank')))?>
             发布于<?php echo $a->travelCompanion->created ?>  回复(<?php echo $a->travelCompanion->travelCompanionReplyCount ?>) 查看(<?php echo $a->travelCompanion->click_num ?>)</span>
            <p class="apply-from">
                来源：<a href=""><?php echo $a->travelCompanion->content ?></a>

            </p>
            <span class="apply-info">期望伴友(<?php echo $a->travelCompanion->totall ?>) 已经加入(<?php echo $a->travelCompanion->hasTotall ?>)</span>
        </div>
        <div class="apply-statu">
            <ul class="apply-statuul">
                <li>
                    <img src="images/sq_1.gif" class="myjb-ck ">
                    <span class="step on">已经提交申请</span>
                    <span class="arrow"><img src="images/jiantou_2.gif" class="myjb-ck "></span>
                    <img src="images/sqing_2.gif" class="myjb-ck ">
                    <span class="step">对方同意结伴</span>
                    <span class="arrow"><img src="images/jiantou_2.gif" class="myjb-ck "></span>
                    <img src="images/sqing_3.gif" class="myjb-ck ">
                    <span class="step">已经下单</span>
                </li>
                <li>
                    <p class="right-notice">你提交的申请已经提交给了发布者，请等待对方处理，如果改变主意你现在可以取消。<a class="cancel zyxbtn3 rightbtn" onclick="cancelApp(<?php echo $a->travel_companion_application_id ?>)" href="javascript:;">取消</a></p>
                </li>
            </ul>

        </div>
    </li>
<?php }?>
</ul>