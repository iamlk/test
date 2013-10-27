    <!--inc.header-->
    <div class="header clearfix">
	        <input type="hidden" id="get-msg" data-remote="<?php echo $this->createUrl('site/getmessage'); ?>"/>
			<div class="top-wrap">
				<a class="logo" href="javascript:;">logo</a>
				<div class="top-search <?php echo @$this->params['search_box']?>">
					<form action="/search/index">
						<input type="text" name="key" id="top-search-input" class="top-search-input" placeholder="寻找您想要的..." data-remote="/index.php?r=search/ajaxGet" autocomplete="off" />
						<input type="submit" value="" id="top-search-btn"/>
					</form>
				</div>
			</div>
			<div class="top-bar">
				<ul class="clearfix">
				<?php if($this->isGuest){?>
					<li><a href="<?php echo $this->createUrl("site/signup"); ?>"  class="register">注册</a> </li>
					<!--<li><a href="javascript:;" class="login fast-login">登录</a> </li>-->
					<li><a href="<?php echo $this->createUrl("site/login"); ?>" class="login">登录</a> </li>
					<!--<li><a href="<?php echo $this->createUrl('site/logout'); ?>" class="login-out">退出</a> </li>-->
				<?php }else{?>
				<li class="inf">
                <?php ;?>
					<a href="<?php echo $this->createUrl('center/index'); ?>" class="user-header">
                   <?php $user_image_icon_path = Customer::model()->getUserHeaderImage(U_ID); ?>
                   <?php if($user_image_icon_path): ?>
                   <!--/thumb/50_50/-->
                    <img src="/thumb/50_50/<?php echo $user_image_icon_path;?>" alt="" class="loginimg"/>
                    <?php else: ?>
                    <img src="/thumb/50_50/userheader/default_header.png" alt="" class="loginimg"/>
                   <?php endif;?>
                    
                    
                    </a>
					<p class="login-inf">
						<?php echo CHtml::link(Yii::app()->user->customer_name,$this->createUrl('center/index'),array('class'=>'my'))?>
					</p>
					<div class="my-info1">
                    <?php if(false): ?>
						<!--<ul>
							<li><a href="<?php echo $this->createUrl('center/buyerIndex'); ?>">我的订单</a><span class="orange">(1未支付)</span></li>
							<li><a href="<?php echo $this->createUrl('collect/property'); ?>">我的收藏夹</a><span class="orange">(1未支付)</span></li>
                            <li><a href="<?php echo $this->createUrl('center/msgmanager'); ?>">站内信</a><span class="orange">(1未支付)</span></li>
							<li><a href="<?php echo $this->createUrl('site/logout'); ?>">退出</a></li>
						</ul> -->
                    <?php endif; ?>   
                
   
                        <?php  $this->getOnwerCount(); ?>
                 
					</div>
				</li>
				<li class="news"><img src="/images/news.png" alt="" /><em>信息</em>
					<ul class="my-news">
						<li><a href="<?php echo $this->createUrl('site/SetMessageState'); ?>?type=HF" class="hf get-msg">回复<em class="orange">()</em></a><input type="hidden" class="hfhid"/></li>
						<li><a href="<?php echo $this->createUrl('site/SetMessageState'); ?>?type=SMS" class="sms get-msg">站内信<em class="orange">()</em></a><input type="hidden" class="smshid"/></li>
					</ul>
				</li>
				<?php }?>
				    
					<li class="help"><a href="<?php echo $this->createUrl("content/index",array('id'=>26)); ?>" class="top-help">帮助</a> </li>
					<?php if($this->isGuest): ?>
						<li>
							<a href="javascript:;" class="zyxbtn5 fast-login">我要发布</a>
						</li>
					<?php else:?>
						<li>
						 <a href="javascript:;" class="zyxbtn5" id="publish">我要发布</a>
						</li>
						<div id="new-publish" class="undis">
							<ul>
								<li class="edition1"><a href="<?php echo $this->createUrl('property/create'); ?>"><span>房屋</span></a></li>
								<li class="edition2"><a href="<?php echo $this->createUrl('product/create'); ?>"><span>行程</span></a></li>
								<li class="edition3"><a href="<?php echo $this->createUrl('article/create'); ?>"><span>攻略</span></a></li>
							</ul>
					   </div>
					<?php endif; ?>
				</ul>
			</div>
	</div>
    <!--inc.header-->
<?php if(Yii::app()->user->isGuest): ?>
<form action="<?php echo $this->createUrl('/site/login') ?>" class="undis ajax-valid-form signup-box" id="poplogin" method="post">
	<ul>
		<li>
			<label for="LoginForm[username]">账户：</label>
			<input type="text" id="LoginForm[username]" name="LoginForm[username]"  value=""/>
		</li>
		<li>
			<label for="password">密码：</label>
			<input type="password"  id="password" name="LoginForm[password]" value=""/>
		</li>
		<li>
			<label></label>
			<input id="login" type="submit" value="登录" class="zyxbtn3" />
		</li>
		<li>
			<label></label>
			<a href="<?php echo $this->createUrl('findpwd/index') ?>" target="_blank">忘记密码？</a> |
			<a href="<?php echo $this->createUrl('site/signup') ?>" target="_blank">新用户注册</a>
		</li>
	</ul>
</form>

<?php endif; ?>
