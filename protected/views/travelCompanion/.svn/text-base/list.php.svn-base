<div class="zyxbox martop0">
        <div class="zyxbox-tit3">
            <h3 class="tit-color3">结伴同游 </h3>
            <div class="comp-top">
                <a class="comp-help" href="">帮助</a>
                <div class="comp-rule" id="comp-rule">
                    <h3>结伴同游帖版规</h3>
                    <div id="comp-rule-con" class="comp-rule-con">
                        <p class="comp-rule-tip">本版是四海网专门为旅游爱好者提供的平台，旨在邀约有相同志趣的朋友共同旅游和交流，让大家能结实更多的朋友，结伴同游，分摊旅费，分享快乐。</p>
                        <h4>发帖原则：</h4>
                        <ul>
                            <li>1.遵守国家相关法律法规。</li>
                            <li>2.严禁发布各种违法煽动性帖子。</li>
                            <li>3.严禁发布与结伴同游无关的各种帖子。</li>
                            <li>4.严禁发布各种商业性质的广告贴，以及无实质内容的帖子。</li>
                            <li>5.严禁虚假信息，请珍惜每一个愿意与您结伴同游，有机会成为朋友的旅游爱好者。</li>
                            <li>6.违反上述发帖规则的帖子将删除。</li>
                            <li>7.如需扩散，请 <a target="_blank" href="http://www.weibo.com/Go4Seas">@四海网</a> 新浪微博。</li>
                        </ul>
                        <p class="comp-rule-hl">四海网期待您旅行回来，与我们分享图片，分享游记。</p>
                        <a href="http://www.weibo.com/Go4Seas" target="_blank" class="follow-sina-btn">加关注</a>
                    </div>
                </div>
            </div>
            <p class="tit-line"></p>
        </div>
        <div class="zyxbox-content">
            <!--结伴同游筛选-->
            <ul class="filters">
                <li>
                    <b>出发地点：</b>
                    <div>
                        <a href="#">不限</a>
                        <a href="#" class="selected">洛杉矶</a>
                        <a href="#">拉斯维加斯</a>
                        <a href="#">旧金山</a>
                        <a href="#">拉斯维加斯</a>
                        <a href="#">洛杉矶</a>
                        <a href="#">拉斯维加斯</a>
                        <a href="#">洛杉矶</a>
                        <a href="#">拉斯维加斯</a>
                    </div>
                </li>
                <li>
                    <b>出发时间：</b>
                    <div>
                        <a href="#">不限</a>
                        <div  class="cald">
                            <input type="text" class="zyx-ipt calendar" value="" id="search-start" /> 至
                            <input type="text" class="zyx-ipt calendar" value="" id="search-end" />
                        </div>
                    </div>
                </li>
                <li>
                    <b>寻伴性别：</b>
                    <div>
                        <a href="#">不限</a>
                        <a href="#" class="selected">寻男伴同游帖</a>
                        <a href="#">寻女伴同游帖</a>
                    </div>
                </li>
                <li>
                    <b>寻伴人数：</b>
                    <div>
                        <a href="#">不限</a>
                        <a href="#" class="selected">1人</a>
                        <a href="#">2人~3人</a>
                        <a href="#">3人~5人</a>
                        <a href="#">5人以上</a>
                    </div>
                </li>
                <li>
                    <b>帖子排序：</b>
                    <div>
                        <a href="#">不限</a>
                        <a href="#" class="selected">按发布时间</a>
                        <a href="#">按出行时间</a>
                    </div>
                </li>
            </ul>
            <!--结伴同游筛选，结束-->

            <p class="comp-btn-wrap"><a class="btn tooltip" href="javascript:;" id="send-comp" tooltip="如果你确定了旅游线路、出行时间等具体信息，请到旅游线路详细页面发“立即结伴帖”，将更容易结伴同游。">发布期望结伴帖</a></p>

            <!--结伴列表-->
            <div class="complist-wrap">
                <div class="complist-top">
                    <span>共有134帖满足条件：</span>
                    <a title="删除此条件" href="#"><b>景点：旧金山</b><i class="icon-del"></i></a>
                    <a title="删除此条件" href="#"><b>出发地：洛杉矶</b><i class="icon-del"></i></a>
                </div>
                <div class="complist-search">
                    <div class="fl">
                        <a class="orderby by-new up-active" href="javascript:;">今日新帖</a>
                        <a class="orderby by-week up-normal" href="javascript:;">一周热门</a>
                        <a class="orderby by-stroke up-normal" href="javascript:;">已成行</a>
                    </div>
                    <div class="fr">
                        <form action="" name="">
                            <input type="text" class="zyx-ipt searchtxt" data-default="请输入关键字，进一步搜索" value="" />
                            <a href="javascript:;" class="zyxbtn3">搜索</a>
                        </form>
                    </div>
                </div>
                <div class="zyxbox-content" id="results-list">
                <?php include "companion_list_item.php";?>
                </div>
                <div class="complist-foot">
                    <a class="btn fr tooltip" href="javascript:;" id="send-comp-foot" tooltip="如果你确定了旅游线路、出行时间等具体信息，请到旅游线路详细页面发“立即结伴帖”，将更容易结伴同游。">发布期望结伴帖</a>
                </div>
            </div>
            <!--结伴列表，结束-->

        </div>
    </div>
<script type="text/javascript">
/*按景点查找，二级菜单*/
$(function(){
	var list = $('.place-list');
	list.each(function(){
		var me = $(this);
		var tit = me.find('.place-menu');
		tit.each(function(){
			var that = $(this);
			var titlink = that.find('>a');
			var sub = that.find('ul');
			that.hover(function(){
				titlink.addClass('hover');
				if(sub.length > 0){sub.show();}
			},function(){
				titlink.removeClass('hover');
				if(sub.length > 0){sub.hide();}
			});
		});



	});
});

/*结伴同游版规*/
$(function(){
	var rulebox = $('#comp-rule');
	var con = $('#comp-rule-con');
	rulebox.hover(function(){
		con.show();
	},function(){
		con.hide();
	});
});


/*需要登录后操作的*/
$(function(){
	$('#send-comp,#send-comp-foot').click(function(){
		checkLoginToDo('sendCompanion');
		return false;
	});
});

function sendCompanion(){
	$.popwin.show({
		width:550,
		height:620,
		url:'<?php echo $this->createUrl('travelCompanion/create'); ?>'
	});
}

	function createSuccess() {
		$.popwin.success('您已成功发布结伴同游帖！<br />您可以登录&quot;<a href="/my_travel_companion.php">我的结伴同游</a>&quot;查看结伴进度。',"确定",function(){location.href="/travel-companion"});
	}

/*日历控件*/
$(function(){
	$('#search-start,#search-end').zyxCalendar();
});
</script>