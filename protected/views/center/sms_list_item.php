<p class="my-msg-num">
    <a id="msg-type-receive" href="javascript:;" class="blue on">收到的消息(<em id="_re">0</em>)</a>
    <a id="msg-type-sent" href="javascript:;" class="blue">发出的消息(<em id="_se">0</em>)</a>
    <a id="msg-type-all" href="javascript:;" class="blue">全部消息(<em id="_all">0</em>)</a>
</p>
<ul id="msg-list" class="msg-list">
<?php
$send_count = 0;
foreach($sms as $s){
?>
    <li class="<?php if($s->to_customer_id == Yii::app()->user->customer_id) {echo 'receive '; $send_count++;} else echo 'sent ';   if($s->read) echo 'markread'; ?>" style="display:<?php if($s->to_customer_id == Yii::app()->user->customer_id) echo 'list-item'; else echo 'none'; ?>;">
        <input type="checkbox" value="<?php echo $s->site_inner_sms_id?>" name="SiteInnerSms[]" />
        <div class="msg-wrap">
            <p class="msg-txt" from-id="<?php echo $s->site_inner_sms_id ?>"><?php echo $s->content ?></p>
            <p class="msg-from">
                <span>信息来源：</span>
                <a href="">洛杉矶一日游，寻女伴两名。</a>
            </p>
        </div>
		<span class="msg-time">
			<?php echo CHtml::link($s->customer->full_name,array('center/user','id'=>$s->customer_id)).' '.$s->created; ?>
		</span>
    </li>
<?php } ?>
</ul>
<p class="msg-tool">
    <label class="vmid" for="select-all-msg"><input type="checkbox" value="" name="" id="select-all-msg"> 全选</label>
    <a id="remove-msg" href="javascript:;" class="blue">删除</a>
    <a id="markread-msg" href="javascript:;" class="blue">标记为已读</a>
</p>

<script type="text/javascript">
$(function(){
        var msgs = $('#msg-list li');
    $("#_re").html(<?php echo intval($send_count) ?>);
    $("#_se").html(<?php echo count($sms)-intval($send_count) ?>);
    $("#_all").html(<?php echo count($sms) ?>);
    $(".msg-txt").live('click',function(p){
        p = $(this);
        $.post('<?php echo $this->createUrl('site/readSms') ?>',{'SiteInnerSms[]':$(this).attr('from-id')},function(data){
					p.parent('div').parent('li').addClass('markread');
                    $.popwin.info(p.html());
				});
    });


        /*删除信息*/
        $('#remove-msg').click(function(){
            var chked = msgs.filter(':visible').find(':checked');
            if(chked.length == 0){
                $.popwin.info('请先选择要删除信息。');
            }else{
    			$.post(
    				'<?php echo $this->createUrl('site/deleteSms') ?>',$(":checkbox[name=SiteInnerSms[]]").serialize(),function(data) {
    					if(data.status === 0)
                        successTextTip('删除成功~');
    					else $.popwin.error('删除失败，请重试。','确定');
    				},'json');
            }
            return false;
        });

        /*标记为已读*/
        $('#markread-msg').click(function(){
            var chked = msgs.filter(':visible').find(':checked');
            if(chked.length == 0){
                $.popwin.info('请先选择要标记的信息。');
            }else{

			$.post('<?php echo $this->createUrl('site/readSms') ?>',$(":checkbox[name=SiteInnerSms[]]").serialize(), function(data) {
			        if(data.status == 0)
                        successTextTip('标记成功~');
                    else $.popwin.error('标记失败，请重试。','确定');
			},'json');
            }
            return false;
        });
});
</script>