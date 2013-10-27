  <?php if(Yii::app()->user->hasFlash('errortips')):?>
   <div id="msg-box" class="error"><?php echo Yii::app()->user->getFlash('errortips'); ?> </div>
  <?php endif;?>
     <?php if(Yii::app()->user->hasFlash('oktips')):?>
   <div id="msg-box"><?php echo Yii::app()->user->getFlash('oktips'); ?> </div>
  <?php endif;?>
<?php /* @var $this Controller */ ?>
<?php /* 社区.基本 */ ?>
<?php Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl.'/css/login.css');?>
<?php $this->beginContent('//layouts/base.without.footer'); ?>

<div class="lay_wrap">
    <div style="z-index:69" class="lay_main clearfix">
        <div class="lay_inner">
            <div class="login_img">
                <h2> 一路由我 随心所欲</h2><br/>
                <h3>为您推荐的最佳旅游路线。</h3>
            </div>
            <div style="width: 583px; height: 316px; visibility: visible; top: 0px;" id="login_div" class="login_wrap">
                <div class="global_dialog_content">

					<div class="g_pop_reg">
					
						<form action="<?php echo $this->createUrl('findpwd/update',array('action'=>'update'))?>" method="POST" class="signup-box forget-pass">
							<h3>找回密码</h3>
							<ul class="info-list">
							  <li>
								<label>新密码：</label>
								<input type="password" name="password" value=""/>
							  </li>
                               <li>
								<label>确认新密码：</label>
								<input type="password" name="repassword" value=""/>
							  </li>
                              <li>
									<label>&nbsp;</label>
									<span  class="btn_green">
										<input type="submit" value="修改密码" />
									</span>
								</li>
							</ul>
						</form>
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