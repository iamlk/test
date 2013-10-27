<ul class="replys">
<?php
foreach($provider->getData() as $i => $question){
?>
            <li class="reply">
                <span class="num">#<?php echo $i+1; ?></span>
                <div class="info">
                    <span class="orange">[楼主]</span><?php echo CHtml::link($question->customer->full_name,$this->createUrl('center/user',array('id'=>$question->customer_id)))?>
                    <span class="gray"><?php echo $question->created ?></span>
                    <a class="btn-reply blue" from-id="<?php echo $question->travel_companion_reply_id?>" href="javascript:;">回复</a>
                    <p class="reply-con"><?php echo CHtml::encode($question->content) ?>
                    </p>
    <?php if($question->travelCompanionReplies){?>
                    <ul class="rrlist">
        <?php if($question->travelCompanionReplies)foreach($question->travelCompanionReplies as $answer){ ?>
                        <li>
                            <span class="orange">[楼主]</span><?php echo CHtml::link($answer->customer->full_name,$this->createUrl('center/user',array('id'=>$answer->customer_id)))?>
                            <span class="gray"><?php echo $answer->created ?></span>说：
                            <p class="reply-con"><?php echo CHtml::encode($answer->content) ?></p>
                        </li>
        <?php }?>
                    </ul>
    <?php }?>
                </div>
                <a class="avatar">
                    <img width="50" height="50" src="images/common/avatar_default_s.gif" />
                </a>
            </li>
<?php }?>
</ul>
<?php
$this->widget('application.widgets.PageToolbar' , array('pagination'=>$provider->pagination, 'ajaxContainerId'=>'results-list','useAjax'=>true, 'route'=>'travelCompanion/reply_list'));
?>