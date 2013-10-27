<?php
	print_r($this->Datahiding());
?>
	<div class="main-right">
        <h3 class="cent-title">安全中心</h3>
        <div class="safe">
            <div class="safelist">
                <p class="name">Hi，<?php echo $userinfo['nick_name'];?> </p>
                <p class="time">上次登录：<?php echo $userinfo['last_login'];?></p>
                <?php if($userinfo['account_power']<5):?>
					<p class="account">
						<label>账号安全状态：</label>
						<em class="lt">弱</em>
						<em class="gt">中</em>
						<em class="gt">强</em>
						<span class="safeinfo">账号安全很低哦~</span>
					</p>
                <?php elseif($userinfo['account_power']>=5 && $userinfo['account_power']<8):?>
					<p class="account">
						<label>账号安全状态：</label>
						<em class="lt">弱</em>
						<em class="lt">中</em>
						<em class="gt">强</em>
						<span class="safeinfo">账号安全很一般哦~</span>
					</p>
                <?php elseif($userinfo['account_power']>=8):?>
                    <p class="account">
						<label>账号安全状态：</label>
						<em class="lt">弱</em>
						<em class="lt">中</em>
						<em class="lt">强</em>
						<span class="safeinfo">账号很安全哦~</span>
					</p>
                <?php endif;?>
            </div>
            <div class="safelist">
                <div class="img">
					<img src="../images/common/already.png" alt="" class="" width="27" height="20">
				</div>
                <p class="account">
					<label>密码安全系数：</label>
					<em class="lt">弱</em>
					<em class="eq">中</em>
					<em class="gt">强</em>
					<span class="slideup">修改</span>
				</p>
                <p class="safeinfo1">
                    建议密码由8位数以上数字、大小写字母组成。
                </p>
                <div class="slidewrap">
					<form action="<?php echo $this->createUrl('center/setpwd')?>" method="POST" id="pass-form" class="valid-form">
						<p class="account">
							<label>当前密码：</label>
							<input class="password" type="password" id="old_pwd" name="old_pwd" required="required" data-rules="minlength:6,maxlength:16" data-messages="required:密码不能为空,minlength:密码长度不正确，应为6～16个字符,maxlength:密码长度不正确，应为6～16个字符" >
						</p>
						<p class="account">
							<label>新密码：</label>
							<input class="password" type="password" id="newp" name="newp" required="required" data-rules="minlength:6,maxlength:16" data-messages="required:新密码不能为空,minlength:密码长度不正确，应为6～16个字符,maxlength:密码长度不正确，应为6～16个字符"/>
						</p>
						<p class="account">
							<label>确认密码：</label>
							<input class="password new_pwd_repeat" type="password" id="new_pwd_repeat" name="new_pwd_repeat" required="required" data-rules="equalTo:#newp,minlength:6,maxlength:16" data-messages="required:请再次填写新密码,equalTo:两次输入的密码不一致，请重新输入,minlength:密码长度不正确，应为6～16个字符,maxlength:密码长度不正确，应为6～16个字符"/>
						</p>
						<p class="account">
							<label></label>
							<span class="btn-line mycent-btn">
							<input type="submit" value="保存" id="pass-btn" />
							</span>
						</p>
					</form>
                </div>
            </div>
            
            <?php if(!empty($userinfo['bind_email'])):?>
            
            <div class="safelist">
				<div class="img">
					<img src="../images/common/already.png" alt="" class="" width="27" height="20">
				</div>
				<form  action="<?php echo $this->createUrl('center/bindemail');?>" method="POST" class="valid-form truss-item">
					<p class="account">
						<label>绑定电子邮件：</label>
						<span class="email"><?php echo $this->Datahiding($userinfo['bind_email'],'email');?></span>
                        <?php if($userinfo['display_bind_email']):?>
						<input type="checkbox" class="checkbox" name="display_bind_email" checked="true" value="1"/>
                        <?php else:?>
                       	<input type="checkbox" class="checkbox" name="display_bind_email" checked="" value="1"/>
                        <?php endif;?>
					<span class="if-email">勾选后不公开邮箱地址</span>
						<span class="slideup">修改</span>
					</p>
					<p class="safeinfo1">
						接收四海网相关信息。
					</p>
				  <div class="slidewrap">
						<p class="account">
							<label>绑定邮箱地址：</label>
							<input class="text" type="text" name="email" required="required" data-messages="required:请输入邮箱地址" id="email" reautocomplete="off" />
							<a href="<?php echo $this->createUrl('center/sendemailyzm_2');?>" class="sent-email get-code">获取验证码</a><em class="couterDown"></em>
						</p>
						<p class="account">
							<label>验证码：</label>
							<input id="emailyzm" type="text" required="required" data-messages="required:请输入验证码" name="emailyzm"/>
						</p>
						<p class="account">
							<label></label>
							<span class="btn-line mycent-btn">
								<input type="submit" value="保存" />
							</span>
						</p>     
					</div>
				</form>
				<div class="slidewrap">
					<form  action="<?php echo $this->createUrl('center/checkemailyzm');?>" method="POST" class="valid-form old-item">
						<p class="tip-holder">修改绑定邮箱地址，请您填写以下信息验证身份。</p>
						<p class="account">
							<label>当前邮箱地址：</label>
							<span class="email"><?php echo $this->Datahiding($userinfo['bind_email'],'email');?></span>
							<a href="<?php echo $this->createUrl('center/sendemailyzm_1');?>" class="sent-email get-code old-item">获取验证码</a><em class="couterDown"></em>
						</p>
						<p class="account">
							<label>验证码：</label>
							<input id="emailyzm" type="text" required="required" data-messages="required:请输入验证码" name="emailyzm"/>
						</p>
						<p class="account">
							<label></label>
							<span class="btn-line mycent-btn">
								<input type="submit" value="下一步"/>
							</span>
						</p>
					</form>	
				</div>
            </div>
           <?php else:?>
           <div class="safelist">
				<div class="img">
					<img src="../images/common/unmodified.png" alt="" class="" width="27" height="27">
				</div>
				<form  action="<?php echo $this->createUrl('center/bindemail')?>" method="POST" class="valid-form">
					<p class="account">
						<label>绑定电子邮件：</label>
						<span>未绑定</span>
			          
                      <!-- 	<input type="checkbox" class="checkbox" name="display_bind_email"  value="1"/>
                        
						<span class="if-email">勾选后不公开邮箱地址</span>-->
						<span class="slideup">绑定</span>
					</p>
					<p class="safeinfo1">
						接收四海网相关信息。
					</p>
					<div class="slidewrap">
						<p class="account">
							<label>绑定邮箱地址：</label>
							<input class="text" type="text" name="email"  required="required" data-messages="required:请输入邮箱地址" id="email" autocomplete="off" />
							<a href="<?php echo $this->createUrl('center/sendemailyzm_2')?>" class="sent-email get-code">获取验证码</a><em class="couterDown"></em>
						</p>
						<p class="account">
							<label>验证码：</label>
							<input id="emailyzm" type="text"  required="required" data-messages="required:请输入验证码" name="emailyzm"/>
						</p>
						<p class="account">
							<label></label>
							<span class="btn-line mycent-btn">
								<input type="submit" value="保存" id="email-btn" />
							</span>
						</p>    
					</div>
				</form>
            </div> 
        <?php endif;?> 
        <?php if(!empty($userinfo['bind_phone'])):?>
        <div class="safelist">
			<div class="img">
				<img src="../images/common/already.png" alt="" class="" width="27" height="27">
			</div>
			<form  action="<?php echo $this->createUrl('center/bindphone')?>" method="POST" class="valid-form">
				<p class="account">
					<label>绑定手机号码：</label>
					<span><?php echo $this->Datahiding($userinfo['bind_phone'],'phone');?></span>
                    <?php if($userinfo['display_bind_phone']):?>
					<input type="checkbox" class="checkbox" name="display_bind_phone" value="1" checked="true"/>
                    <?php else:?>
                    <input type="checkbox" class="checkbox" name="display_bind_phone" value="1"/>
                    <?php endif;?>
				<span class="if-tell">勾选后不公开手机号码</span>
					<span class="slideup">修改</span>
				</p>
				<p class="safeinfo1">
					接收四海网相关短信。
				</p>
				<div class="slidewrap">
					<p class="account">
						<label>新手机号码：</label>
						<input class="text" type="text" name="phonenum" id="phonenum"  required="required" data-rules="phonenum:true" data-messages="required:请输入手机号码,phonenum:请输入正确的手机号" />
						<a href="<?php echo $this->createUrl('center/sendphonenums_2')?>" class="get-code">获取验证码</a><em class="couterDown"></em>
					</p>
					<p class="account">
						<label>验证码：</label>
						<input class="text" type="text" name="phoneyzm" id="cellcode" required="required" data-messages="required:请输入验证码" />
					</p>
					<p class="account">
						<label></label>
						<span class="btn-line mycent-btn">
							<input type="submit" value="保存" id="cell-btn" />
						</span>
					</p>
				</div>
			</form>
            	<div class="slidewrap">
					<form  action="<?php echo $this->createUrl('center/checkphoneyzm');?>" method="POST" class="valid-form old-item">
						<p class="tip-holder">修改绑定手机号码，请您填写以下信息验证身份。</p>
						<p class="account">
							<label>当前手机号码：</label>
							<span class="email"><?php echo $this->Datahiding($userinfo['bind_phone'],'phone');?></span>
							<a href="<?php echo $this->createUrl('center/sendphonenums_1');?>" class="sent-email get-code old-item">获取验证码</a><em class="couterDown"></em>
						</p>
						<p class="account">
							<label>验证码：</label>
							<input id="phoneyzm" type="text" required="required" data-messages="required:请输入验证码" name="phoneyzm"/>
						</p>
						<p class="account">
							<label></label>
							<span class="btn-line mycent-btn">
								<input type="submit" value="下一步"/>
							</span>
						</p>
					</form>	
				</div>
        </div>
         <?php else:?>   
            <div class="safelist">
				<div class="img">
					<img src="../images/common/unmodified.png" alt="" class="" width="27" height="27">
				</div>
				<form  action="<?php echo $this->createUrl('center/bindphone')?>" method="POST" class="valid-form">
					<p class="account">
						<label>绑定手机号码：</label>
						<span>未绑定</span>
			
                   <!-- <input type="checkbox" class="checkbox" name="display_bind_phone" value="1"/>
                    
					<span class="if-tell">勾选后不公开手机号码</span>-->
						<span class="slideup">绑定</span>
					</p>
					<p class="safeinfo1">
						接收四海网相关短信。
					</p>
					<div class="slidewrap">
						<p class="account">
							<label>新手机号码：</label>
							<input class="text" type="text" name="phonenum" id="phonenum"  required="required" data-rules="phonenum:true" data-messages="required:请输入手机号码,phonenum:请输入正确的手机号" />
							<a href="<?php echo $this->createUrl('center/sendphonenums_2')?>" class="get-code">获取验证码</a><em class="couterDown"></em>
						</p>
						<p class="account">
							<label>验证码：</label>
							<input class="text" type="text" name="phoneyzm" id="cellcode" required="required" data-messages="required:请输入验证码" />
						</p>
						<p class="account">
							<label></label>
							<span class="btn-line mycent-btn">
							<input type="submit" value="保存" />
							</span>
						</p>
					</div>
				</form>
            </div>

         <?php endif;?>   
         <?php if(!empty($userinfo['document_num'])):?>
         
            
            <div class="safelist">
				<div class="img">
					<img src="../images/common/already.png" alt="" class="" width="27" height="27">
				</div>
				<form  action="<?php echo $this->createUrl('center/setidentitycard')?>" method="POST" class="valid-form">
					<p class="account">
						<label>身份认证：</label>
						<span><?php echo $this->Datahiding($userinfo['document_num'],'document');?></span>
						<span class="slideup">修改</span>
					</p>
					<p class="safeinfo1">
						您的身份认证信息不会泄露，为了您的账号安全，请设置认证信息。
					</p>
					<div class="slidewrap">
						<p class="account">
							<label>真实姓名：</label>
							<input class="text" type="text" name="realname" value="<?php echo $userinfo['real_name'];?>" id="realname"/>
							<label for="realname" class="error"></label>
						</p>
						
						<p class="account">
							<label>证件类型：</label>
							<select class="zyx-ipt  ZYXselect seid" name="cardtype" id="cardtype">
                            	<option value="身份证">身份证</option>
							
							</select>
							<label for="cardtype" class="error"></label>
						</p>
						<p class="account">
							<label>证件号码：</label>
							<input class="text" type="text" name="cardnums" value="" required="required" data-messages="required:请输入证件号" id="cardnums"/>
						</p>
                        <!--
						<p class="account">
							<label>网站登陆密码：</label>
							<input class="text" type="password" name="webpwd" value="<?php //echo $userinfo['weblogin_pwd'];?>" id="webpwd"/>
						</p>-->
						<p class="account">
							<label></label>
							<span class="btn-line mycent-btn">
								<input type="submit" value="保存" id="card-btn"/>
							</span>
						</p>
					</div>
                </form>
            </div>
         <?php else:?>   
         <div class="safelist">
			<div class="img">
				<img src="../images/common/unmodified.png" alt="" class="" width="27" height="27">
			</div>
			<form  action="<?php echo $this->createUrl('center/setidentitycard')?>" method="POST" class="valid-form">
                <p class="account">
					<label>身份认证：</label>
					<span>尚未设置身份认证</span>
					<span class="slideup">设置</span>
				</p>
                <p class="safeinfo1">
                    您的身份认证信息不会泄露，为了您的账号安全，请设置认证信息。
                </p>
                <div class="slidewrap">
                    <p class="account">
						<label>真实姓名：</label>
						<input class="text" type="text" name="realname" id="realname"/>
					</p>
                    <p class="account">
					<label>证件类型：</label>
                        <select class="zyx-ipt  ZYXselect seid" name="cardtype" id="cardtype">
                            <option value="身份证">身份证</option>
                           
                        </select>
                    </p>
                    <p class="account">
						<label>证件号码：</label>
						<input class="text" type="text" required="required" data-messages="required:请输入证件号" name="cardnums" id="cardnums"/>
					</p>
                  
                    <p class="account">
						<label></label>
						<span class="btn-line mycent-btn">
						<input type="submit" value="保存" id="card-btn"/>
						</span>
					</p>
                </div>
			</form>	
        </div>
         <?php endif;?>   
        </div>
	</div>