<div class="zyxbox martop0">
    <div class="zyxbox-tit3">
        <h3 class="tit-color3">我的结伴同游</h3>
        <p class="tit-line"></p>
    </div>
    <div class="zyxbox-content">
    <div id="my-comp" class="my-comp">
    <ul class="zyx-tab tab-style1 tab-style-comp">
        <li class="current"><a href="javascript:;"><span>我的信息</span></a></li>
        <li class=""><a href="#"><span>我发布的结伴帖</span></a></li>
        <li class=""><a href="javascript:;"><span>我申请的结伴帖</span></a></li>
        <li class=""><a href="javascript:;"><span>我回复的结伴帖</span></a></li>
    </ul>

    <!--我的信息-->
    <div data-hash="my-information" class="tabcon" style="display: none;">
        <!--没有信息时显示<p class="noinfo">暂无信息</p>-->
        <?php if($sms){ include ('/protected/views/center/sms_list_item.php'); }else echo '<p class="noinfo">暂无信息</p>';?>
    </div>
    <!--我的信息，结束-->

    <!--我发布的结伴帖-->
    <div data-hash="my-sent" class="tabcon" style="display: none;">
        <!--没有信息时显示<p class="noinfo">暂无信息</p>-->
        <?php if($companion){ include ('my_companion_list_item.php'); }else echo '<p class="noinfo">暂无信息</p>';?>
    </div>
    <!--我发布的结伴帖，结束-->


    <!--我申请的结伴帖-->
    <div data-hash="my-applied" class="tabcon" style="display: block;">
        <?php if($application){ include ('my_application_list_item.php'); }else echo '<p class="noinfo">暂无信息</p>';?>
    </div>
    <!--我申请的结伴帖，结束-->

    <!--我回复的结伴帖，开始-->
    <div data-hash="my-reply" class="tabcon">
        <?php if($reply){ include ('my_reply_list_item.php'); }else echo '<p class="noinfo">暂无信息</p>';?>
    </div>
    <!--我回复的结伴帖，结束-->
    </div>
    </div>
</div>


<!--弹出层：给他发消息-->
<div class="undis" id="msgto-box" style="width:600px;">
    <div class="popwin-inner">
        <h2 class="popwin-tit">给他发消息</h2>
        <div class="apply-form">
            <p>
                <span class="label">内容：</span>
				<span class="con">
					<textarea id="msgto-con" class="zyx-ipt" rows="5"></textarea>
					<input type="hidden" name="msg_uid" value="" id="msgto-user-id" />
				</span>
            </p>
            <p>
                <span class="label">&nbsp;</span>
				<span class="con">
					<a id="msgto-submit" class="zyxbtn3" href="javascript:;">确定</a>
					<span id="msgto-tip" class="tipholder"></span>
				</span>
            </p>
        </div>
    </div>
</div>
<!--弹出层：给他发消息，结束-->



<!--弹出层：同意结伴并留言-->
<div class="undis" id="agree-box" style="width:600px;">
    <div class="popwin-inner">
        <h2 class="popwin-tit">同意结伴并给他留言</h2>
        <div class="apply-form">
            <p>
                <span class="label">内容：</span>
				<span class="con">
					<textarea id="agree-con" class="zyx-ipt limit-input" maxlength="100" data-maxlength-tip="#refuse-msg-tip" rows="5"></textarea>
					<input type="hidden" name="agree_msg" id="agree-user-id" />
					<span class="block txtr gray">您还可以输入<em class="charleft" id="refuse-msg-tip"></em>字</span>
				</span>
            </p>
            <p>
                <span class="label">&nbsp;</span>
				<span class="con">
					<a id="agree-submit" class="zyxbtn3" href="javascript:;">确定</a>
					<span id="agree-tip" class="tipholder"></span>
				</span>
            </p>
        </div>
    </div>
</div>
<!--弹出层：同意结伴并留言，结束-->


<!--弹出层：拒绝申请-->
<div class="undis" id="refuse-box" style="width:600px;">
    <div class="popwin-inner">
        <h2 class="popwin-tit">拒绝申请</h2>
        <div class="apply-form">
            <p>
                <span class="label">拒绝理由：</span>
				<span class="con">
					<textarea id="refuse-con" class="zyx-ipt limit-input" maxlength="100" data-maxlength-tip="#agree-msg-tip" rows="5"></textarea>
					<input type="hidden" name="agree_msg" id="refuse-user-id" />
					<span class="block txtr gray">您还可以输入<em class="charleft" id="agree-msg-tip"></em>字</span>
				</span>
            </p>
            <p>
                <span class="label">&nbsp;</span>
				<span class="con">
					<a id="refuse-submit" class="zyxbtn3" href="javascript:;">确定</a>
					<span id="refuse-tip" class="tipholder"></span>
				</span>
            </p>
        </div>
    </div>
</div>
<!--弹出层：拒绝申请，结束-->
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
<script type="text/javascript">
    /*我的结伴同游tab*/
    $(function(){
        function tab_init(outer){
            var tabbox = $(outer);
            var tits = tabbox.find('.zyx-tab > li');
            var cons = tabbox.find('.tabcon');
            tits.each(function(i){
                var me = $(this);
                me.click(function(){
                    cons.hide();
                    cons.eq(i).show();
                    tits.filter('.current').removeClass('current');
                    me.addClass('current');
                    var loc_hash = location.hash;
                    if(loc_hash!=''){
                        /*不用location.hash，避免产生历史记录*/
                        location.replace( location.href.replace(loc_hash , '#'+cons.eq(i).attr('data-hash')) );
                    }else{
                        location.replace( location.href + '#'+cons.eq(i).attr('data-hash') );
                    }
                    return false;
                });
            });
            cons.hide();
            var ls = location.href;
            var def = 0;
            if(ls.indexOf('#')> -1){
                var hashstr = ls.split('#')[1];
                cons.each(function(){
                    var me = $(this);
                    if( hashstr.indexOf(me.attr('data-hash')) >-1){
                        def = cons.index(me);
                    }
                });
            }
            tits.eq(def).trigger('click');
        }
        tab_init('#my-comp');
    });
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

/*取消申请*/
function cancelApp(id){
	$.popwin.ask('确定要取消该申请吗？',function(){
		$.post('<?php echo $this->createUrl('TravelCompanionApplication/cancel') ?>',{id:id},function(data){
			if(data.status === 0) {
				$.popwin.success('已成功取消申请。');
				window.location.reload();
			}
		},'json');
	});
}
    /*信息处理*/
    $(function(){
        var msgs = $('#msg-list li');
        var receive = msgs.filter('.receive');
            var sent = msgs.filter('.sent');
        var all = $('#select-all-msg');
        var types = $('.my-msg-num a');

        var checkboxs = msgs.find('input[type=checkbox]');
        var checkCheckbox = function(){
            checkboxs.removeAttr('checked');
            all.removeAttr('checked');
        };
        $('#msg-type-receive').click(function(){
            sent.hide();
            receive.show();
            types.filter('.on').removeClass('on');
            $(this).addClass('on');
            checkCheckbox();
        });

        $('#msg-type-sent').click(function(){
            receive.hide();
            sent.show();
            types.filter('.on').removeClass('on');
            $(this).addClass('on');
            checkCheckbox();
        });

        $('#msg-type-all').click(function(){
            msgs.show();
            types.filter('.on').removeClass('on');
            $(this).addClass('on');
            checkCheckbox();
        });

        var check = function(){
            var chks = msgs.filter(':visible').find('input[type=checkbox]');
            var hidden_chks = msgs.filter(':hidden').find('input[type=checkbox]');
            hidden_chks.removeAttr('checked');
            if(all.is(':checked')){
                chks.attr('checked','checked');
            }else{
                chks.removeAttr('checked');
            }
        };

        all.change(check);
        check();

        /*点击信息，设置为已读*/
        msgs.each(function(){
            var me = $(this);
            var msg_txt = me.find('.msgtxt');
            msg_txt.click(function(){
                $.popwin.info(msg_txt.text());
                //ajax 标记已读取
            });
        });
    });



    /*同意结伴并留言*/
    function agreeComp(id){
        $.popwin.show({
            content:'#agree-box'
        });

    	var btn = $('#agree-submit');
    	btn.click(function(){
    		if(btn.hasClass('tffbtn-disabled')) return false;
    		$.ajax({
    			url : '<?php echo $this->createUrl('travelCompanion/agree') ?>',
    			type : 'post',
    			dataType : 'json',
    			data : {
    				content : $('#agree-con').val(),
    				id : id
    			},
    			beforeSend : function(){
    				btn.toggleClass('tffbtn-disabled');
    			},
    			success : function(data){
    				btn.toggleClass('tffbtn-disabled');
    				if(data.status === 0){
    					$("[data-apply-id="+id+"]").attr('data-status',data.verify);
    					$('#agree-con').val('');
    					updateSentlistBtn(id);
    					$.popwin.success('操作成功。', '确定');
    				} else {
    					$("#agree-tip").html(data.msg);
    				}
    			}
    		});
    	});
    }

function updateSentlistBtn(data_apply_id){
	var apply_box = $('.applicant[data-apply-id='+data_apply_id+']');
	var status = parseInt(apply_box.attr('data-status'));
	if(status===1) apply_box.find('.status').html('已同意');
	if(status===2) apply_box.find('.status').html('已拒绝');
	if(status === 0){/*未处理*/
		apply_box.find('.agree').show();
		apply_box.find('.refuse').show();
		apply_box.find('.status').hide();
		apply_box.find('.cancel').hide();
	}else{
		apply_box.find('.cancel').show();
		apply_box.find('.status').show();
		apply_box.find('.agree').hide();
		apply_box.find('.refuse').hide();
	}

}

    /*拒绝结伴*/
    function refuseComp(id){
        $.popwin.show({
            content:'#refuse-box'
        });
	var btn = $('#refuse-submit');
	btn.click(function(){
		if(btn.hasClass('tffbtn-disabled')) return false;
		$.ajax({
			url : '<?php echo $this->createUrl('travelCompanion/refuse') ?>',
			type : 'post',
			dataType : 'json',
			data : {
				content : $('#refuse-con').val(),
				id : id
			},
			beforeSend : function(){
				btn.toggleClass('tffbtn-disabled');
			},
			success : function(data){
				btn.toggleClass('tffbtn-disabled');
				if(data.status === 0){
					$("[data-apply-id="+id+"]").attr('data-status',data.verify);
					$('#refuse-con').val('');
					updateSentlistBtn(id);
					$.popwin.success('操作成功。', '确定');
				} else {
					$("#refuse-tip").html(data.msg);
				}
			}
		});
	});
    }

    /*发送短信*/
    function sendMessage(id,cid){
        //$('#refuse-user-id').val(id);
        $.popwin.show({
            content:'#msgto-box'
        });
    	var btn = $('#msgto-submit');
    	btn.click(function(){
    		if(btn.hasClass('tffbtn-disabled')) return false;
    		if(!$.trim($('#msgto-con').val())) {
    			errorAnimate($('#msgto-con'));
    			return false;
    		}
    		$.ajax({
    			url : '<?php echo $this->createUrl('site/sendInnerSms') ?>',
    			type : 'post',
    			dataType : 'json',
    			data : {
    				content : $('#msgto-con').val(),
    				uid : id,
    				key_type : '<?php echo SiteInnerSms::KEY_TYPE_TRAVEL_COMPANION ?>',
    				key_id : cid
    			},
    			beforeSend : function(){
    				btn.toggleClass('tffbtn-disabled');
    			},
    			success : function(data){
    				btn.toggleClass('tffbtn-disabled');
    				if(data.status === 0){
    					$('#msgto-con').val('');
    					$.popwin.success('信息发送成功。');
    				} else {
    					$("#msgto-tip").html(data.msg);
    				}
    			}
    		});
    	});
    }


    /*我发布的结伴帖*/
    $(function(){
        $('.sent-list>li').each(function(){
            var me = $(this);
            var item_id = me.attr('data-mypost-id');
            var view = me.find('.handle');
            var stale = me.find('.stale');
            var view_box = me.find('.applicant-box');

            view.click(function(){view_box.slideToggle(100)});
            stale.click(function(){
    			$.popwin.ask('确定将该帖'+stale.html()+'吗？【'+me.find('.sent-link').text()+'】',function(){
    				$.post('<?php echo $this->createUrl('travelCompanion/setExpired') ?>', {id:item_id}, function(data){
    					if(data=='ok') $.popwin.success('操作成功。','确定',function(){
    						window.location.reload();
    					});
    					else $.popwin.error('操作失败。');
    				},'text')
    			});
    			return false;
    		});

            view_box.find('.applicant').each(function(){
                var that = $(this);
                var uid = that.attr('data-user-id');
                var comid = that.attr('data-com-id');
                var appid = that.attr('data-apply-id');
                var agree = that.find('.agree');
                var refuse = that.find('.refuse');
                var sendmsg = that.find('.sendmsg');
                agree.click(function(){
                    agreeComp(appid);
                    return false;
                });
                refuse.click(function(){
                    refuseComp(appid);
                    return false;
                });
                sendmsg.click(function(){
                    sendMessage(uid,comid);
                    return false;
                });
            });
        });



    });


    /*我回复的结伴帖*/


    function search_reply() {
        if($('#tc_keyword').val() == $('#tc_keyword').attr('data-default') ) $('#tc_keyword').val('');
        $.post('searchReply.php',{keyword:$('#tc_keyword').val()},function(data){
            if(data.status===0) {
                $("#myreplys").find('td').not(':first').remove();
                if($.trim(data.html).length!=0){
                    $("#noreply").hide();
                    $("#myreplys").append(data.html);
                    listen();
                } else {
                    $("#noreply").show();
                }
            }
        },'json');

    }

    function listen(){
        var reply = null;
        var replycontent = null;
        var newreplycontent = null;
        // var oldreply = $(".old-reply-content");
        // var newreply = $(".new-reply-content");
        // var newreplywrap = $(".new-reply-wrap");
        $(".mytours-reply-table .reply-edit").each(function(i){
            $(".mytours-reply-table .reply-edit").eq(i).bind("click",function(){
                replycontent = $(".old-reply-content").eq(i).html();
                $(".old-reply-content").eq(i).toggle();
                $(".new-reply-wrap").eq(i).toggle();
                reply = replycontent;
                $(".new-reply-content").eq(i).attr("value",reply);
                //alert(reply);
            });

        });

        $(".mytours-reply-table .reply-submit").each(function(i){
            $(".mytours-reply-table .reply-submit").eq(i).bind("click",function(){
                newreplycontent = $(".new-reply-content").eq(i).attr("value");
                var id = $("#myreplys>tr[user-data]").eq(i).attr("user-data");
                $.post('<?php echo $this->createUrl('travelCompanion/modifyContent') ?>',{id:id,content:newreplycontent},function(data){
                    if(data.status===0) {
                        reply = newreplycontent;
                        $(".old-reply-content").eq(i).html(reply);
                        $(".old-reply-content").eq(i).toggle();
                        $(".new-reply-wrap").eq(i).toggle();
                    } else {
                        if(data.msg) $.popwin.error(data.msg);
                        else $.popwin.error('操作失败，请重试。');
                    }
                },'json');
            });

        });

        $(".mytours-reply-table .reply-reset").each(function(i){
            $(".mytours-reply-table .reply-reset").eq(i).bind("click",function(){
                $(".old-reply-content").eq(i).toggle();
                $(".new-reply-wrap").eq(i).toggle();
            });

        });

    }
    listen();
</script>