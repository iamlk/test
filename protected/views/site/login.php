<?php /* @var $this Controller */ ?>
<?php /* 社区.基本 */ ?>
<?php Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl.'/css/login.css');?>
<?php $this->beginContent('//layouts/base.without.footer'); ?>

<div class="lay_wrap">
    <div style="z-index:69" class="lay_main clearfix">
        <div class="lay_inner">
            <div class="login_img">
                <h2> 一路由我 随心所欲</h2><br/>
                <h3>为您推荐最佳旅游路线。</h3>
            </div>
            <div style="width: 583px; height: 316px; visibility: visible; top: 0px;" id="login_div" class="login_wrap">
                <div class="global_dialog_content">

					<div class="g_pop_reg">
						<?php $form=$this->beginWidget('CActiveForm', array(
							'id'=>'login-form',
							'enableClientValidation'=>true,
							'clientOptions'=>array(
								'validateOnSubmit'=>true,
							),
							'htmlOptions'=>array('class'=>'ajax-valid-form signup-box')
						)); ?>
						<div id="loginForProxy" class="reginst_main">
							<ul>
								<li>
									<label for="LoginForm[username]">帐号：</label>
									<input type="text"  id="LoginForm[username]" name="LoginForm[username]"  value="" class="zyx-ipt" >
								</li>
								<li>
									<label for="LoginForm[password]">密码：</label>
									<input type="password"  id="LoginForm[password]" name="LoginForm[password]" value="" class="zyx-ipt">
								</li>
								<li>
									<label>&nbsp;</label>
									<span  class="btn_green">
										<input type="submit" value="登录" />
									</span>
									<a  target="_blank" href="<?php echo $this->createUrl('findpwd/index') ?>" class="forget">忘记密码?</a>
								</li>
								<li>
									<label>&nbsp;</label>
									<input type="checkbox" checked="checked" name="rememberMe" id="rememberMe">
									<label for="autoLogin">下次自动登录</label>
								</li>
							</ul>
						</div>
<?php $this->endWidget(); ?>
						<div class="quick_login">
							<h3  id="toggleReg">还没有帐号?<a href="<?php echo $this->createUrl('site/signup')?>" class="btn_reg" target="_self" href="<?php echo $this->createUrl("site/signup"); ?>">快速注册</a>
							</h3>
							<div class="login_other">
								<h6>或使用合作网站帐号登录</h6>
								<ul>
									<li style="cursor:pointer;">
										<span id="partnersLoginQQ">
											<em class="ico_qq"></em>
											<a href="<?php echo $this->createUrl('siteThirdLogin/qq');?>" target="_blank">用QQ帐号登录</a>
										</span>
									</li>
									<li style="cursor:pointer;">
										 <span id="partnersLoginSINA">
											 <em class="ico_sina"></em>
											 <a href="<?php echo $this->createUrl('siteThirdLogin/sina');?>" target="_blank">用新浪微博登录</a>
										 </span>
									</li>
								<!--	<li style="cursor:pointer;">
										<span id="partnersLoginRENREN">
											<em class="ico_renren"></em>
											<a href="javascript:;">用人人网帐号登录</a>
										</span>
									</li>-->
								</ul>
							</div>
						</div>
					</div>
				</div>
            </div>
        </div>
    </div>


    <?php $this->renderPartial('/layouts/inc.footer');?>


</div>

<div id="lay_bg" class="lay_background">
    <img alt="" id="lay_bg_img" class="lay_background_img lay_background_img_fade_out" src="/images/login_bg<?php echo rand(1,3)?>.jpg">
</div>


<script type="text/javascript">
	$(function(){
        var t = $("body").outerWidth();
        var w = $(document).height();
        var w1 = $(window).height();
        var y1 = $(window).width();
        $("#lay_bg").css({"width":t,"height":w});
        $("#lay_bg_img").css({"width":t,"height":w});
        $(".lay_wrap").css({"height":w});
        $(window).bind('resize', function(){
            var t = $("body").outerWidth();
            var w = $(document).height();
            var y1 = $(window).width();
            $("#lay_bg").css({"width":t,"height":w});
            $("#lay_bg_img").css({"width":t,"height":w});
            $(".lay_wrap").css({"height":w});
        });
    });
</script>


<?php $this->endContent(); ?>