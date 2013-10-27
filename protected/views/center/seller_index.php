<?php if(Yii::app()->user->hasFlash('oktips')):?>
   <div id="msg-box" ><?php echo Yii::app()->user->getFlash('oktips'); ?> </div>
  <?php endif;?>
	<div class="main-right">
        <h3 class="cent-title"><a href="<?php echo  $this->createUrl('center/sellerindex')?>">我是卖家</a></h3>
        <div class="status-info1">
        <?php if(!empty($bankinfo['banknumber'])):?>
            <p class="total">账户总支出：
            
            <?php if(Order::model()->AllPayMoney(U_ID)):?>
            <span>￥<?php echo Order::model()->AllPayMoney(U_ID);?></span>
            <?php else:?>
            <span>￥0.00</span>
            <?php endif;?>
            
            <a href="<?php echo  $this->createUrl('center/addsellercardnum')?>" id="add-card">+ 修改银行卡</a>
            
            </p>
            <p>我的银行卡：<?php echo $this->Datahiding($bankinfo['banknumber'],'document');?></p>
        <?php else:?>   
        
            <p class="total">账户总支出：
         
            <?php if(Order::model()->AllPayMoney(U_ID)):?>
            <span>￥<?php echo Order::model()->AllPayMoney(U_ID);?></span>
            <?php else:?>
            <span>￥0.00</span>
            <?php endif;?>
         
            <a href="<?php echo $this->createUrl('center/addsellercardnum')?>" id="add-card">+ 添加银行卡</a>
         </p>
         <p>我的银行卡：无</p> 
            
        <?php endif;?>
        </div>
        <h2 class="slogan">与买家建立信任度，可有效提高订单量哦~</h2>
        
        <?php if(!empty($data['document_num'])):?>
        
        <p class="status-authenticate line">身份认证：<a href=""><?php echo $this->Datahiding($data['document_num'],'document');?></a><span class="red"></span></p>
        <?php else:?>
        
        <p class="status-authenticate line">身份认证：<a href="<?php echo $this->createUrl('center/security')?>">马上设置&gt;&gt;</a><span class="red">(未绑定)</span></p>
        
        <?php endif;?>
        <p class="status-authenticate">职业认证：<a href="<?php echo $this->createUrl('authidentity/index')?>">了解更多&gt;&gt;</a></p>
       
        <ul class="authenticate-index-list">
            <li class="landlord">
                <i></i>
                <h3>房东认证</h3>
                <p>如果您有房源出租，请申请房东认证。</p>
                <p class="people">已有<?php  echo Authidentity::getAuthCount(Authidentity::LANDER);?>人进行了房东认证</p>
                <p class="mt20"><a class="profession-btn" href="<?php echo $this->createUrl('authidentity/landentry')?>">立即申请</a></p>
            </li>
            <li class="business">
                <i></i>
                <h3>商家认证</h3>
                <p>如果您有行程产品出售，请申请商家认证。</p>
                <p class="people">已有<?php  echo (Authidentity::getAuthCount(Authidentity::BPEOPLE)+Authidentity::getAuthCount(Authidentity::BCOMPANY));?>人进行了商家认证</p>
                <p class="mt20"><a class="profession-btn" href="<?php echo $this->createUrl('authidentity/PeopleBusinessEntry')?>">立即申请</a></p>
            </li>
            <li class="tourist">
                <i></i>
                <h3>导游认证</h3>
                <p>如果您可以提供导游服务，请申请导游认证。</p>
                <p class="people">已有<?php  echo Authidentity::getAuthCount(Authidentity::GUIDE);?>人进行了导游认证</p>
                <p class="mt20"><a class="profession-btn" href="<?php echo $this->createUrl('authidentity/guideentry')?>">立即申请</a></p>
            </li>
        </ul>
	</div>