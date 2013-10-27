<!--bShare-->
<style type="text/css">
    .bshare{ position:relative; height:22px; padding:5px 10px; background:#fbfbfb; border-top:1px dashed #DBDBDB; clear:both;}
    .bshare label{ float:left; width:55px; line-height:24px; color:#777;}
    .bshare-custom a{ float:left; width:16px; height:16px; margin:3px 2px 4px; padding:0;}
    .bshare-custom a.bshare-more{ width:auto; font-size:12px; line-height:16px;}
    .shareRenren{ display:none; position:absolute; left:87px; top:8px; width:16px; height:16px; background:url(http://static.bshare.cn/frame/images/logos/s3/renren.gif);}
    .shareRenrenTr{ left:167px;}
    .shareRenren:hover{ opacity:0.75;}
</style>
<div class="zyxbox martop0">
    <div class="zyxbox-tit3">
    </div>
    <div class="zyxbox-content">
    <div class="comp-info clearfix">
        <div class="left">
            <h3><?php echo $info->title?></h3>
            <ul class="info-list">
                <li>
                    <span class="label">旅游线路：</span>
                    <p class="con">
                        <a href="#"><?php echo $info->content?></a>
                    </p>
                </li>
                <li>
                    <span class="label">出行时间：</span>
                    <p class="con">
                        <?php echo $info->departure_date?> - <?php echo $info->departure_date_end?>
                    </p>
                </li>
                <li>
                    <span class="label">现有人数：</span>
                    <p class="con">
                        <?php
                            if($info->now_people_man) echo '男'.$info->now_people_man.'人 ';
                            if($info->now_people_woman) echo '女'.$info->now_people_woman.'人 ';
                            if($info->now_people_child) echo '小孩'.$info->now_people_child.'人 ';
                        ?>
                    </p>
                </li>
                <li>
                    <span class="label">期望伴友：</span>
                    <p class="con">
                        <?php
                            if($info->hope_people_man) echo '男'.$info->hope_people_man.'人 ';
                            if($info->hope_people_woman) echo '女'.$info->hope_people_woman.'人 ';
                            if($info->hope_people_child) echo '小孩'.$info->hope_people_child.'人 ';
                            if($info->open_ended) echo '<span class="surpport-more">欢迎更多人申请结伴</span>';
                        ?>
                    </p>
                </li>
                <li>
                    <span class="label">支付方式：</span>
                    <p class="con">
                        <?php if($info->who_payment) echo '我支付';else echo 'AA制';?>
                    </p>
                </li>
                <li>
                    <span class="label">姓名：</span>
                    <p class="con">
                        <?php echo $info->customer_name; if($info->customer_gender==Customer::GENDER_MALE) echo '先生';elseif($info->customer_gender==Customer::GENDER_FEMALE) echo '女士';?>
                    </p>
                </li>
                <?php if ($info->email && !$info->companion_email_display) { ?>
                <li>
                    <span class="label">Email：</span>
                    <p class="con">
                        <a href="mailto:<?php echo $info->email;?>"><?php echo $info->email;?></a>
                    </p>
                </li>
                <?php } ?>
                <?php if ($info->phone && !$info->companion_phone_display) { ?>
                    <li>
                        <span class="label">电话：</span>
                        <p class="con"><?php echo $info->phone; ?></p>
                    </li>
                <?php } ?>
                <li>
                    <span class="label">个人介绍：</span>
                    <p class="con">
                        <?php echo nl2br($info->personal_introduction);?>
                    </p>
                </li>
            </ul>
        </div>

        <div class="right">
            <p class="comp-btn">
                <?php
				$has_filled = (($info->hope_people_man + $info->hope_people_woman + $info->hope_people_child) <= $apply_num && $info->open_ended != '1') ? true : false;
                $check_travel_companion_app = (int) TravelCompanionApplication::model()->countByAttributes(array('customer_id'=>Yii::app()->user->customer_id,'travel_companion_id'=>$info->travel_companion_id));
                if (((!Yii::app()->user->isGuest && $info->customer_id == Yii::app()->user->customer_id)) || $has_filled == true || $check_travel_companion_app || $info->has_expired == "1") {
					$show_apply_btn = false;
                    $alert_str = '你是楼主，不用申请。';
                    if ($has_filled == true) {
                        $alert_str = '名额已满！不能申请了，看看别的吧。';
                    }
                    if ($check_travel_companion_app) {
                        $alert_str = '您已经申请该结伴，请勿重复申请！';
                    }
                    if ($info->has_expired == "1") {
                        $alert_str = '已过期！';
                    }

                } else $show_apply_btn = true;
                ?>
				<?php if($show_apply_btn): ?>
					<a id="comp-apply-btn" class="zyxbtn3" href="javascript:;">申请结伴</a>
				<?php else: ?>
					<a class="zyxbtn3 disabled tooltip" href="javascript:;">申请结伴<span class="tooltip-con"><?php echo $alert_str ?></span></a>
				<?php endif ?>
            </p>
            <p class="comp-apply-count">已有<span class="bold"><?php echo $info->travelCompanionApplicationCount ?></span>人申请结伴</p>
            <p class="comp-oper">
                <a class="blue" href="javascript:;" id="reply-to">回复</a>
                <a class="blue" href="javascript:;" id="msg-to">给他发消息</a>
            </p>
        </div>
        <div class="bshare">
           <script type="text/javascript" charset="utf-8" src="http://static.bshare.cn/b/buttonLite.js#style=-1&amp;uuid=&amp;pophcol=1&amp;lang=zh"></script><script type="text/javascript" charset="utf-8" src="http://static.bshare.cn/b/bshareC0.js"></script>
            <div class="bshare-custom"><div class="bsPromo bsPromo2"></div>
                <label>分享到：</label>
                <a title="分享到新浪微博" class="bshare-sinaminiblog" href="javascript:void(0);"></a>
                <a class="bshareNull" href="javascript:void(0);"></a>
                <a title="分享到开心网" class="bshare-kaixin001" href="javascript:void(0);"></a>
                <a title="分享到facebook" class="bshare-facebook" href="javascript:void(0);"></a>
                <a title="分享到twitter" class="bshare-twitter" href="javascript:void(0);"></a>
                <a title="分享到yahoo收藏" class="bshare-byahoo" href="javascript:void(0);"></a>
                <a title="分享到豆瓣" class="bshare-douban" href="javascript:void(0);"></a>
                <a title="分享到qq空间" class="bshare-qzone" href="javascript:void(0);"></a>
                <a title="更多平台" class="bshare-more" href="javascript:void(0);">更多&gt;&gt;</a>
            </div>


            <script type="text/javascript">
                jQuery(function(){
                    if(typeof(bShare)!='undefined'){
                        bShare.addEntry({
                            title: "我在@四海网，希望&amp;quot;2222&amp;quot;，出行时间2013-06-02，现有男1人 ，期望伴友男2人  ",
                            pic:"http://qa.toursforfun.com/image/jieban_share.jpg"
                        })
                    }
                });
            </script>

        </div>
        <!--bShare end-->
    </div><!--.compinfo end-->


    <div class="reply-list-wrap">
        <h3>网友回复<span>(<?php echo $info->travelCompanionReplyCount ?>条)</span></h3>
        <div id="results-list">
        <?php
        if(!$provider->getData())echo '<p class="noinfo">暂无网友回复</p>';
        else include "companion_reply_list_item.php";
        ?>
        </div>
    </div><!--.reply-list-wrap end-->

    <div class="reply-form">
        <h3>回复</h3>
        <p class="nologin" id="nologin">
            <span class="gray">登录后才能发表回复，</span>
            <a href="javascript:;" onclick="fastLogin();" class="blue">立即登录</a>
        </p>
        <form name="" action="" id="reply-form">
            <textarea class="zyx-ipt reply-input limit-input" rows="5" id="user-reply-input" maxlength="300" data-maxlength-tip="#reply-txt-num1"></textarea>
            <p class="tool clearfix">
                <label class="fl gray"><input name="" type="checkbox" value="" /> 只告诉楼主</label>
                <span class="fr gray">您还可以输入<em id="reply-txt-num1" class="charleft"></em>字</span>
            </p>
            <p class="btn-wrap">
                <a class="zyxbtn3" id="submit" href="javascript:;">回复</a>
            </p>
        </form>


    </div><!--.reply-form-wrap end-->

    </div>
</div>

<!--弹出层：申请人信息-->
<div class="undis" id="apply-comp" style="width:600px;">
	<div class="popwin-inner">
		<h2 class="popwin-tit">我的基本信息<span>以下信息除了电话，其他均为必填项。</span></h2>
		<div class="apply-form">
			<p>
				<span class="label">姓名：</span>
				<span class="con">
					<input id="apply-name" type="text" class="zyx-ipt" value="<?php echo Yii::app()->user->customer_name ?>" />
					<span class="tip">请采用真实姓名，将用于填写下单信息。</span>
				</span>
			</p>
			<p>
				<span class="label">英文名：</span>
				<span class="con">
					<input id="apply-ename" type="text" class="zyx-ipt" value="<?php echo Yii::app()->user->customer_name ?>" />
					<span class="tip">请采用与护照一致的姓名，将用于填写下单信息。</span>
				</span>
			</p>
			<p>
				<span class="label">性别：</span>
				<span class="con">
					<label for="sex-man"><input type="radio" id="sex-man" name="comp_sec" value="1" class="boxradio" />男</label>
					<label for="sex-woman"><input type="radio" id="sex-woman" name="comp_sec" value="2" class="boxradio" />女</label>
				</span>
			</p>
			<p>
				<span class="label">邮箱：</span>
				<span class="con">
					<input id="apply-email" type="text" class="zyx-ipt" value="<?php echo Yii::app()->user->customer_email ?>" />
				</span>
			</p>
			<p>
				<span class="label">电话：</span>
				<span class="con">
					<input id="apply-phone" type="text" class="zyx-ipt" value="" />
				</span>
			</p>
			<p>
				<span class="label">人数：</span>
				<span class="con">
					<input id="apply-num" type="text" class="zyx-ipt" value="1" />
					<span class="tip">请输入预计结伴人数。</span>
				</span>
			</p>
			<p>
				<span class="label">留言：</span>
				<span class="con">
					<textarea id="apply-msg" class="zyx-ipt" rows="3" data-default="请输入你的兴趣爱好或对结伴同游者的期望">1</textarea>
				</span>
			</p>
			<p>
				<span class="label">&nbsp;</span>
				<span class="con">
					<a id="apply-submit" class="zyxbtn3" href="javascript:;">申请</a>
					<span id="apply-tip" class="apply-tip"></span>
				</span>
			</p>
		</div>
	</div>
</div>
<!--申请人信息，结束-->



<!--弹出层：给他发消息-->
<div class="undis" id="msgto-box" style="width:600px;">
	<div class="popwin-inner">
		<h2 class="popwin-tit">给他发消息</h2>
		<div class="apply-form">
			<p>
                <input type="hidden" id="msgto-user-id" value="<?php echo $info->customer_id ?>" />
                <input type="hidden" value="<?php echo (int)$_GET['id'] ?>" id="msgto-user-tci" />
				<span class="label">内容：</span>
				<span class="con">
					<textarea  data-maxlength-tip="#reply-txt-num3" maxlength="300" id="msgto-con" class="zyx-ipt reply-input limit-input" rows="5"></textarea>
				</span>
			</p>
			<p>
				<span class="label">&nbsp;</span>
				<span class="con">
					<a id="msgto-submit" class="zyxbtn3" href="javascript:;">确定</a>
					<span id="msgto-tip" class="apply-tip"></span>
                     <span class="fr gray">您还可以输入<em class="charleft" id="reply-txt-num3"></em>字</span>
				</span>
			</p>
		</div>
	</div>
</div>
<!--申请人信息，结束-->
<!--弹出层：成功提示-->
<div class="undis" id="success-tip" style="width:400px;">
	<div class="popwin-inner">
		<div class="success-tip" id="success-tip-txt"></div>
		<p class="popwin-btns">
			<a class="zyxbtn3" href="javascript:;" onclick="AddtoFavorites();">收藏本页</a>
			<a class="zyxbtn3" href="javascript:;" onclick="$.popwin.close();">关闭</a>
		</p>
	</div>
</div>
<!--申请人信息，结束-->

<!--弹出层：给他回复-->
<div class="undis" id="replyto-box" style="width:600px;">
    <div class="popwin-inner">
        <h2 class="popwin-tit">回复</h2>
        <div class="apply-form">
            <p>
                <span class="label">内容：</span>
				<span class="con">
                    <textarea data-maxlength-tip="#reply-txt-num2" maxlength="300" id="replyto-con" rows="5" class="zyx-ipt reply-input limit-input"></textarea>
				</span>
            </p>
            <p>
                <span class="label">&nbsp;</span>
				<span class="con">
					<a id="replyto-submit" class="zyxbtn3" href="javascript:;">确定</a>
					<span id="replyto-tip" class="apply-tip"></span>
                    <span class="fr gray">您还可以输入<em class="charleft" id="reply-txt-num2"></em>字</span>
				</span>
            </p>
        </div>
    </div>
</div>
<!--给他回复，结束-->
<script type="text/javascript">
var from_id = 0;
/*如果已登录*/
$(function(){
	var nologin = $('#nologin');
	var replyform = $('#reply-form');
	if(CLIENTSTATUS.login){
		nologin.hide();
		replyform.show();
	}else{
	   nologin.show();
	   replyform.hide();
	}
});


/*申请结伴*/
function applyCompanion(){
	$.popwin.show({
		content:'#apply-comp'
	});
}

function companionMsgTo(){
	$.popwin.show({
		content:'#msgto-box'
	});
}

function companionReplyTo(de){
	$.popwin.show({
		content:'#replyto-box'
	});
    $("#replyto-con").val(de);
}

$(function(){
	/*申请结伴按钮*/
	$('#comp-apply-btn').click(function(){
		checkLoginToDo('applyCompanion');
		return false;
	});

	/*模拟radio*/
	$('.boxradio').boxradio();

	/*给他发消息*/
	$('#msg-to').click(function(){
		checkLoginToDo('companionMsgTo');
		return false;
	});


    /*回复信息*/
   $(".btn-reply").live("click",function(){
       var de = $(this).attr("data-default");
       from_id = $(this).attr("from-id");
       checkLoginToDo('companionReplyTo',de);
       return false;
   })
});

/*申请结伴表单验证*/
$(function(){
	var name = $('#apply-name');
	var ename = $('#apply-ename');
	var email = $('#apply-email');
	var num = $('#apply-num');
	var phone = $('#apply-phone');
	var msg = $('#apply-msg');
	var btn = $('#apply-submit');
	var tip = $('#apply-tip');
	var isEmpty = function(o){
		var v = o.val();
		var def = o.attr('data-default');
		if(v == '' || v == def){
			return true;
		}else{
			return false;
		}
	};
	btn.click(function(){
	    var gender = $('[name="comp_sec"]:checked').val();
		if(btn.hasClass('disabled')){return false;}
		if(isEmpty(name)){alert('请填写姓名');name.focus();return false;}
		if(isEmpty(ename)){alert('请填写英文名');ename.focus();return false;}
		if(isEmpty(email) || !/^\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/.test(email.val())){
			alert('请填写正确的邮箱地址');
			email.focus();
			return false;
		}
		if(isEmpty(num) || !/\d+/.test(num.val())){
			alert('请填写预计结伴的人数(数字)');
			num.focus();
			return false;
		}
		if(isEmpty(msg)){alert('请填写留言');msg.focus();return false;}
		btn.addClass('disabled');
		tip.html('<span style="color:#4A9B33;">正在申请……</span>');
		$.post('<?php echo $this->createUrl('travelCompanion/applicationCreate')?>',
			{travel_companion_id:'<?php echo $_GET['id'] ?>',name_cn:name.val(),name_en:ename.val(),email:email.val(),people_num:num.val(),content:msg.val(),phone:phone.val(),gender:gender},
			function(data){
				if(data && data.status === 0) {
					successTextTip('申请结伴成功。');
				} else {
				    alert(data.errors);
						btn.removeClass('disabled');
						tip.html('');
				}
			},
			'json'
		);
	});
});

/*给他发消息表单验证*/
$(function(){
	var btn = $('#msgto-submit');
	var con = $('#msgto-con');
	var tip = $('#msgto-tip');
	btn.click(function(){
		if(btn.hasClass('disabled')){return false;}
		if($.trim(con.val()) == ''){
			con.val('');
			con.focus();
			return false;
		}else{
			btn.addClass('disabled');
			tip.html('<span style="color:#4A9B33;">正在发送……</span>');
			$.ajax({
    			url : '<?php echo $this->createUrl('site/SendInnerSms') ?>',
    			type : 'post',
    			dataType : 'json',
    			data : {
    				content : $('#msgto-con').val(),
    				uid : $('#msgto-user-id').val(),
    				key_type : '<?php echo SiteInnerSms::KEY_TYPE_TRAVEL_COMPANION ?>',
    				key_id : $('#msgto-user-tci').val()
    			},
    			beforeSend : function(){
    				btn.toggleClass('zyxbtn-disabled');
    			},
    			success : function(data){
    				btn.toggleClass('zyxbtn-disabled');
    				if(data.status === 0){
    					content : $('#msgto-con').val(''),
    					$.popwin.success('信息发送成功。', '确定');
						btn.removeClass('disabled');
                        $('#reply-txt-num3').html($('#msgto-con').attr('maxlength'));
						tip.html('');
    				} else {
    					$("#msgto-tip").html(data.msg);
    				}
    			}
    		});
		}
	});
});


/*申请结伴成功提示，发送消息成功提示公用*/
function successTextTip(txt){
	$.popwin.show({
		content:'#success-tip',
		hideClose:'yes',
		showBefore:function(){
			$('#success-tip-txt').html(txt);
		},
        closeAfter:function(){window.location.reload();}
	});
}
//留言
function reply(c,p){
    if(c==undefined)c=$('#user-reply-input').val();
    if(p==undefined)p=1;
	$.ajax({
		url:'<?php echo $this->createUrl('travelCompanion/reply') ?>',
		type:'post',
		dataType:'json',
		data:{
			travel_companion_id: <?php echo $info->travel_companion_id ?>,
			parent_travel_companion_reply_id:p,
			content:c,
			onlytopsee:$('#onlytopsee:checked').length
		},
		success:function(res){
				if(res.status === 0){
				$('#user-reply-input').val('');
				$('#to_who').val('');
                successTextTip('回复成功。');
			}else if(res.status === 1){
				$.popwin.error(res.message);
			}
		},
			error:function(){
				//alert("未知错误");
				return false;
		}
	});
}


/*回复验证*/
$(function(){
    var msg = $("#replyto-con");
    var sub = $("#replyto-submit");
    sub.click(function(){
       var v = msg.val();
       if(v == ''){
           alert("请输入回复内容");
           msg.focus();
       }else{
           reply(v,from_id);
       }
    });
});

/*点击回复滚动回复框*/
$(function(){
	$('#submit').click(function(){
		checkLoginToDo('reply');
		return false;
	});
    $("#reply-to").click(function(){
        var input = $("#user-reply-input");
        var height = input.offset().top;
        $("body").animate({"scrollTop":height});
        input.focus();
    });
});


$(function(){

		$(".all-city-btn").hover(function(){
			$(".all-city-list").show();
		},function(){
			$(".all-city-list").hide();
		});
		$(".all-city-list").hover(function(){
			$(".all-city-list").show();
		},function(){
			$(".all-city-list").hide();
		});
	})


</script>