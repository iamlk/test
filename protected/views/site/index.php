<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>管理中心 - 新浪微博开放平台</title>
<link href="/static/css/pages/manage_center/manage_center_lumpsugar.css?version=1.1.2.326" rel="stylesheet" type="text/css"/>
<link href="/css/module/layer/layer_login.css?version=1.1.2.326" rel="stylesheet" type="text/css"/>

<script src="/static/js/jquery-1.7.1.min.js"></script>
<script>
$(function(){
    $(".login_link").click(function(){
        $(".WB_dialog").show();
    });
});
</script>
</head>
<body class="B_manage_center">
<div class="op_header">
    <div class="global_top_header">
    <div class="header_inner">
        <div class="header_wrapper">
            <div class="logo_container">
                <a class="logo_link" href="/" title="进入首页"><img class="logo_img" src="http://img.t.sinajs.cn/t4/appstyle/open/images/common/transparent.gif" alt="Weibo Platform Logo" /></a>
                <h1 class="hidden_title">新浪微博开放平台</h1>
            </div>
            <div class="nav_list_container">
                <ul class="nav_list">
                    <li class="nav_item nav_item_more nav_more_mouseover2   nav_length_3">
                        <a class="nav_link" action-type="selection_btn" action-data="index=1" href="/development" title="">微连接<i class="mark_more_arrow"></i></a>
                        <div class="nav_more_layer" action-type="selection_menu" action-data="index=1">
                            <div class="nav_more_link_container">
                                <div class="more_link_line"><a class="nav_more_link" href="/development/mobile" title="">移动应用</a></div>
                                <div class="more_link_line"><a class="nav_more_link" href="/connect" title="">网站接入</a></div>
                                <div class="more_link_line"><a class="nav_more_link" href="/development/canvas" title="">站内应用</a></div>
                                <!-- <div class="more_link_line"><a class="nav_more_link" href="/development/pro" title="">专业版应用</a></div> -->
                            </div>
                        </div>
                    </li>
                    <li class="nav_item nav_item_more nav_more_mouseover2   nav_length_3">
                        <a class="nav_link" action-type="selection_btn" action-data="index=2" title="">微服务<i class="mark_more_arrow"></i></a>
                        <div class="nav_more_layer" action-type="selection_menu" action-data="index=2">
                            <div class="nav_more_link_container">
                                <div class="more_link_line"><a class="nav_more_link" href="/development/pro" title="">Page应用</a></div>
                            </div>
                        </div>
                    </li>
                    <li class="nav_item ">
                        <a class="nav_link" href="/wiki/" title="">文档</a>
                    </li>
                    <li class="nav_item ">
                        <a class="nav_link" href="/support" title="">支持</a>
                    </li>
                    <li class="nav_item  nav_current">
                        <a class="nav_link" href="/apps" hidefocus="true" title="">管理中心</a>
                    </li>
                </ul>
            </div>
            <!--登录Start-->
            <div class="pull_right">
    	        <div class="log_info login">
    	           <div class="login_link_container"><a class="login_link" node-type="login_btn" href="javascript:;" title="">登录</a></div>
    	        </div>
	        </div>
            <!--登录End-->
        </div>
    </div>
</div>
</div>

<!--主内容开始-->
<div class="wrap">
    <div class="op_main">
        <div class="content_box">
        	<div class="header"> <a class="logo_link" title="管理中心" href="/apps">管理中心</a> </div>
            <div class="content_wrap">
                <div class="content">
                    <div class="op_main_inner clearfix">
                    <div class="op_main_l">
    <div class="user_info_display">
        <div class="user_info_container">
            <div class="user_avatar"> <a class="user_avatar_a" href="http://weibo.com/wap97lkcom" target="_blank"><img class="user_avatar_img" src="http://tp4.sinaimg.cn/1827328475/50/5641998291/1" alt="Shit-PHP"/></a> </div>
            <div class="user_info">
                <p class="user_name"><a class="user_name_a" href="http://weibo.com/wap97lkcom" target="_blank" title="Shit-PHP">Shit-PHP</a></p>
                <p class="user_from"><i class="user_icon icon_male"></i>海外</p>
            </div>
        </div>
        <p class="base_personal_info">
            基本信息：
                            <a class="info_status_link" href="/developers/basicinfo">已完善</a>
                    </p>
        <p class="identification">
            身份认证：
                            <a class="identification_status_link" href="/developers/identity">未认证</a>
                    </p>
    </div>
    <div class="main_nav">
        <ul class="nav_list">
            <li class="nav_item">
                <a class="nav_item_link link_app" href="/apps" title="">我的应用</a>
            </li>
            <li class="nav_item">
                <a class="nav_item_link link_website" href="/webmaster" title="">我的网站</a>
            </li>
            <li class="nav_item">
                <a class="nav_item_link link_pay" href="/paycenter" title="">支付中心</a>
            </li>
        </ul>
    </div>
</div>
                    <!--右侧开始-->
                    <div id="pl_app_myApplication" class="op_main_r">
                        <div class="page_title" id="pl_pay_search">
                            <form class="nav_search" action="/apps/search">
                                <span class="input_wrap">
                                    <input node-type="searchInput" type="text" class="ser_input input_note" name="kw"/>
                                </span>
                                <input type="submit" class="search_btn" node-type="serBtn">
                            </form>
                            <h2 class="manage_title title_app"></h2>
                            <div class="related_data">（
                                已创建<em class="data_num">0</em>个，还可创建<em class="data_num">10</em>个）
                            </div>
                        </div>
                        <div class="sort_tab_nav clearfix">
                            <ul class="nav_list">
                                <li class="nav_item nav_current"><a class="nav_item_a" href="?ol=0" title="">未上线应用(0)</a></li>
                                <li class="nav_item "><a class="nav_item_a" href="?ol=1" title="">已上线应用(0)</a></li>
                            </ul>
                            <div class="nav_plus">
                                                                <a class="W_btn_c" href="/development"><span>创建应用</span></a>
                                                            </div>
                        </div>
                                                <div class="blank_note_container">
                            <p class="blank_note">您目前还没有未上线应用</p>
                        </div>
                                            </div>
                    <!--/右侧结束-->
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<!--/主内容结束-->

<!--/Footer-->
<div class="op_footer">
<div class="inner">
    <p class="links">
		<a href="/wiki/index.php/关于开放平台">关于微博开放平台</a>
		<span class="W_vline">|</span>
		<a href="/wiki/index.php/联系我们">联系我们</a>
		<span class="W_vline">|</span>
		<a href="/wiki/index.php/应用开发者协议">服务条款</a>
		<span class="W_vline">|</span>
		<a href="http://weibo.com/weibovc">开发者基金</a>
		<span class="W_vline">|</span>
		<a href="/game">微游戏</a>
		<span class="W_vline">|</span>
		<a href="/blog/">平台博客</a>
	</p>
    <p class="copyright W_textb">
		<span>京网文 [2011] 0398-130号</span>
		<span>京ICP证100780号</span>
		<span>Copyright © 1996-2013 SINA</span></p>
</div>
</div>
<!--/Footer结束-->
<div node-type="outer" style="background-color: rgb(0, 0, 0); opacity: 0.3; position: fixed; top: 0px; left: 0px; z-index: 99999; width: 1841px; height: 712px;"></div>
<div class="WB_dialog" node-type="outer" style="z-index: 99999; top: 266.5px; left: 655.5px;" stk-mask-key="13828539103312">
<div class="WB_panel">
<a title="关闭" node-type="close" class="WB_dl_close" href="#" onclick="return false;">关闭</a>
<div class="WB_login" node-type="inner">
<div class="login_inner clearfix">
<div class="login_main">
<h3 class="login_tit">已有新浪博客、新浪邮箱帐号，可直接登录</h3>
<p class="login_input_id">
<input type="text" node-type="username" tabindex="1" style="color: rgb(153, 153, 153);" value="邮箱/会员帐号/手机账号" class="WB_iptxt W_input_default"></p>
<p class="login_input_pw">
<input node-type="passwordtext" tabindex="2" style="color:#ccc" value="请输入密码" class="WB_iptxt">
<input node-type="password" tabindex="3" type="password" style="color: rgb(204, 204, 204); display: none;" value="" class="WB_iptxt">
</p>
<p class="login_input_vc" node-type="yzmDiv" style="display: none;">
<input type="text" node-type="yzm" value="" class="WB_iptxt"><img src="about:blank" node-type="yzmUrl">
<a class="change_vc" node-type="changePin" href="###">换一换</a>
</p>
<p class="login_input_wd" node-type="vdDiv" style="display:none;">
<input type="text" class="WB_iptxt" node-type="vd" value="" maxlength="6" style="color:#ccc">
<a href="http://weibo.com/forgot/vdun" target="_blank" class="wd_note">微盾挂失</a>
</p>
<p class="login_btn clearfix">
<a class="WB_btnA" href="###" onclick="return false;" tabindex="5" node-type="submitBtn">
<span>登录</span>
</a>
<label class="rmb_log">
<input node-type="saveState" tabindex="4" type="checkbox" class="WB_checkbox">下次自动登录</label>
</p>
</div>
<div class="reg_weibo">
<h3 class="login_tit">还未开通？赶快免费注册一个吧</h3>
<p class="reg_wbid">
<a class="WB_reg_btn" href="http://weibo.com/signup/signup.php?c=&amp;type=&amp;inviteCode=&amp;code=&amp;spe=&amp;lang=zh" tabindex="6" node-type="registUrl" target="_blank">
<span>注册微博</span>
</a></p></div></div></div></div></div>
</body>
</html>