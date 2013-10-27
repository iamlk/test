<?php
Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl.'/css/jquery.Jcrop.css');
Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/jquery.Jcrop.js');
?>
<form action="<?php echo $this->createUrl('authidentity/savelandinfo');?>" enctype="multipart/form-data" method="post" class="ajax-form-auth">
	<div class="profession-right mt20 pt0">
		<input type="hidden" value="<?php echo $this->auth;?>" name="auth"/>
		<input type="hidden" value="<?php echo $this->auth_type;?>" name="auth_type"/>
        <h3 class="cent-title">
			<a href="<?php echo $this->createUrl('authidentity/index')?>">职业认证</a><em>&gt;</em>
			商家认证<em>&gt;</em>
			企业商家认证<span class="constact"> <a href="javascript::void(0)" class="feedback">有问题？咨询四海网</a></span>
		</h3>
        <div class="profession-status">
            <p class="status1">1.阅读并同意商家协议内容</p>
            <p class="status2 nav">2.填写认证信息</p>
            <p class="status3">3.提交审核</p>
        </div>
        <div class="authenticate-wrap">
            <div class="safelist">
				<?php if(empty($userinfo['bind_phone'])):?>
				<p class="account"><label>绑定手机号码：</label><span>暂未绑定</span></p>
				<p class="safeinfo1">
					绑定手机以便接收四海网相关短信。
				</p>
				<div class="slidewrap">
					<p class="account">
						<label>新手机号码：</label>
						<input type="text" class="text" name="phonenum" id="phonenum"/>
						<a class="get-code" href="<?php echo $this->createUrl('authidentity/sendphonenums')?>">获取验证码</a>
					</p>
					<p class="account">
						<label>效验码：</label>
						<input type="text" class="text" name="phonenumyzm"/>
					</p>
				</div>
				<?php else:?>
					<p class="account"><label>绑定手机号码：</label><span><?php echo $userinfo['bind_phone'];?></span></p>
				<?php endif;?>
            </div>
            <div class="safelist">
                <div class="slidewrap">
                    <p class="account"><label>国家：</label><input type="text" class="text" name="country" value="<?php echo $auth['country']?>"/></p>
                    <p class="account"><label>证件类型：</label>
                    
                        <input class="boxradio" type="radio" name="passport" value="护照" id="passport" <?php if($auth['cert_type'] == '护照'):?>checked<?php endif;?>/>
                        <label for="passport">护照</label>
                 
                        <input class="boxradio" type="radio" name="passport" value="驾照" id="driver"  <?php if($auth['cert_type'] == '驾照'):?>checked<?php endif;?>/>
                        <label for="driver">驾照</label>
                        <input class="boxradio" type="radio" name="passport" value="身份证" id="id-cards" <?php if($auth['cert_type'] == '身份证'):?>checked<?php endif;?> />
                        <label for="id-cards">身份证</label>
                        <input class="boxradio" type="radio" name="passport" value="其他" id="other" <?php if($auth['cert_type'] == '其他'):?>checked<?php endif;?> />
                        <label for="other">其他</label>
                    </p>
                    <p class="account"><label>手持护照头部照：</label></p>
                    <div class="picture">
                        <div class="preview">
                            <?php if(!empty($auth['cert_image'])):?>
                            <img width="160" height="160" alt="" src="/thumb/108_72/<?php echo $auth['cert_image'];?>">
                           <?php else:?>
                            <img width="160" height="160" alt="" src="../images/common/de_picture.png">
                           <?php endif;?>
							<input type="hidden" class="realimage" name="pic" value="" />
                        </div>
                        <div class="example">
                            <img width="124" height="126" alt="" src="../images/common/head_portrait.png">
                            <p>示例</p>
                        </div>
                        <div class="upload_image mt30">
                            <a class="btn_addPic" href="javascript:;">
                                <span><em>+</em>添加图片</span>
                                <input type="file" class="filePrew fileAuth" name="pic" size="3" title="支持jpg、jpeg、gif、png格式，文件小于5M" data-remote="./savetempimage" tabindex="3">
                            </a>
                            <p>支持jpg, gif,png格式的图片，建议图片尺寸160*160，（小于5M） </p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="safelist">
                <div class="slidewrap">
                    <p class="account"><label class="pe-lab">企业营业执照副本复印件：</label></p>
                    <div class="picture">
                        <div class="preview">
                            <?php if(!empty($auth['company_listen_image'])):?>
                            <img width="160" height="160" alt="" src="/thumb/108_72/<?php echo $auth['company_listen_image'];?>">
                           <?php else:?>
                            <img width="160" height="160" alt="" src="../images/common/de_picture.png">
                           <?php endif;?>
							<input type="hidden" class="realimage" name="pic_listen" value="" />
                        </div>
                        <div class="example">
                            <img width="124" height="126" alt="" src="../images/common/head_enterprise.png">
                            <p>示例</p>
                        </div>
                        <div class="upload_image mt30">
                            <a class="btn_addPic" href="javascript:;">
                                <span><em>+</em>添加图片</span>
                                <input type="file" class="filePrew fileAuth" name="pic" size="3" title="支持jpg、jpeg、gif、png格式，文件小于5M" data-remote="./savetempimage" tabindex="3">
                            </a>
                            <p>支持jpg, gif,png格式的图片，建议图片尺寸160*160，（小于5M） </p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="safelist">
                <div class="slidewrap">
                    <p class="account"><label class="pe-lab">企业税务登记证复印件：</label></p>
                    <div class="picture">
                        <div class="preview">
                                <?php if(!empty($auth['company_tax_image'])):?>
                            <img width="160" height="160" alt="" src="/thumb/108_72/<?php echo $auth['company_tax_image'];?>">
                           <?php else:?>
                            <img width="160" height="160" alt="" src="../images/common/de_picture.png">
                           <?php endif;?>
							<input type="hidden" class="realimage" name="pic_tax" value="" />
                        </div>
                        <div class="example">
                            <img width="124" height="126" alt="" src="../images/common/head_enterprise1.png">
                            <p>示例</p>
                        </div>
                        <div class="upload_image mt30">
                            <a class="btn_addPic" href="javascript:;">
                                <span><em>+</em>添加图片</span>
                                <input type="file" class="filePrew fileAuth" name="pic" size="3" title="支持jpg、jpeg、gif、png格式，文件小于5M" data-remote="./savetempimage" tabindex="3">
                            </a>
                            <p>支持jpg, gif,png格式的图片，建议图片尺寸160*160，（小于5M） </p>
                        </div>
                    </div>
                </div>
            </div>
            <p class="mt20 submit"><input type="submit" class="profession-btn" value="提交认证" /></p>
        </div>
    </div>
    </form>