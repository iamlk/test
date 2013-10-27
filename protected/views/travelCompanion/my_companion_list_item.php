<ul class="sent-list">
<?php foreach($companion as $c){ ?>
    <li data-mypost-id="<?php echo $c->travel_companion_id ?>">
        <p class="sent-link fl"><?php echo CHtml::link($c->title,$this->createUrl('travelCompanion/view',array('id'=>$c->travel_companion_id)),array('target'=>'_blank')) ?></p>
        <span class="fr gray"><?php echo $c->created ?> 回复(<?php echo $c->travelCompanionReplyCount ?>) 查看(<?php echo $c->click_num ?>)</span>
        <p class="from clear"><a href="<?php echo $this->createUrl('travelCompanion/view',array('id'=>$c->travel_companion_id)) ?>"><?php echo $c->content ?></a></p>
        <p class="sent-info">
            <span class="fl">期望结伴人数<?php echo $c->totall ?>人，申请结伴人数<?php echo $c->travelCompanionApplicationCount ?>人，同意<?php echo $c->agree ?>人。<?php if($c->travelCompanionApplicationCount){?><span class="handle">查看</span><?php }?></span>
            <span class="fr"><a href="javascript:;" class="blue stale"><?php echo $c->has_expired == '1' ? '重新开启' : '设为过期贴'; ?></a></span>
        </p>
        <?php if($c->travelCompanionApplicationCount){?>
        <div class="applicant-box">
            <!--申请人-->
            <?php foreach($c->travelCompanionApplications as $app){?>
            <div data-user-id="<?php echo $app->customer_id ?>" data-apply-id="<?php echo $app->travel_companion_application_id ?>" data-com-id="<?php echo $c->travel_companion_id ?>" class="applicant">
                <img alt="" src="images/common/avatar_boy_s.gif" class="avatar">
                <ul class="info">
                    <li><span>姓名：</span><?php echo $app->name_cn ?></li>
                    <li><span>邮箱：</span><a href="mailto:<?php echo $app->email ?>"><?php echo $app->email ?></a></li>
                    <li><span>英文名：</span><?php echo $app->name_en ?></li>
                    <li><span>电话：</span><?php echo $app->phone ?></li>
                    <li><span>性别：</span><?php echo Customer::gender2Str($app->gender); ?></li>
                    <li><span>人数：</span><?php echo $app->people_num ?></li>
                    <li class="msg"><span>留言：</span><?php echo $app->content ?></li>
                </ul>
                <p class="oper">
                <?php if($app->verify_status==0){?>
                    <a id="agree_2" href="javascript:;" class="agree">同意</a>
                    <a id="refuse_2" href="javascript:;" class="blue refuse">拒绝</a>
                <?php }?>
                |
                    <a href="javascript:;" class="blue sendmsg">给他发消息</a>
                </p>
            </div>
            <?php }?>
            <!--申请人，结束-->
            <p class="go-order">
                <a class="zyxbtn3" href="#">已经找到伴友，现在就去订购</a>
            </p>
        </div>
        <?php }?>
    </li>
<?php }?>
    <li data-mypost-id="12">
        <p class="sent-link fl"><a target="_blank" href="#">洛杉矶3晚寻女伴2名。</a></p>
        <span class="fr gray">2012-01-12 回复(2) 查看(11)</span>
        <p class="sent-info">
            <span class="fl">期望结伴人数3人，申请结伴人数0人，同意0人。</span>
            <span class="fr"><a href="javascript:;" class="blue stale">设为过期贴</a></span>
        </p>
    </li>
    <li data-mypost-id="12" class="last">
        <p class="sent-link fl"><a target="_blank" href="#">洛杉矶3晚寻女伴2名。</a></p>
        <span class="fr gray">2012-01-12 回复(2) 查看(11)</span>
        <p class="sent-info">
            <span class="fl">期望结伴人数3人，申请结伴人数0人，同意0人。</span>
            <span class="fr"><a href="javascript:;" class="blue stale">设为过期贴</a></span>
        </p>
    </li>
</ul>