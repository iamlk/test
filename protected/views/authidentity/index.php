	<div class="profession-right mt20">
        <div class="profession-info">
            <p>申请职业认证的用户通过审核后，</p>
            <p>个人信息处出现对应认证标示，代表四海若邻已验证了该用户的职业信息。</p>
            <p>认证后，您将赢得更多买家的信任，促成交易；同时确保四海若邻平台的安全可靠性。</p>
        </div>
        <ul class="authenticate-index-list">
            <li class="landlord">
                <i></i>
                <h3>房东认证</h3>
                <p>如果您有房源出租，请申请房东认证。</p>
                <p class="people">已有<?php  echo Authidentity::getAuthCount(Authidentity::LANDER);?>人进行了房东认证</p>
                <p class="mt20"><a href="<?php echo $this->createUrl('authidentity/landentry')?>" class="profession-btn">立即申请</a></p>
            </li>
            <li class="business">
                <i></i>
                <h3>商家认证</h3>
                <p>如果您有房源出租，请申请商家认证。</p>
                <p class="people">已有<?php  echo (Authidentity::getAuthCount(Authidentity::BPEOPLE)+Authidentity::getAuthCount(Authidentity::BCOMPANY));?>人进行了商家认证</p>
                <p class="mt20"><a href="<?php echo $this->createUrl('authidentity/PeopleBusinessEntry')?>" class="profession-btn">立即申请</a></p>
            </li>
            <li class="tourist">
                <i></i>
                <h3>导游认证</h3>
                <p>如果您有房源出租，请申请导游认证。</p>
                <p class="people">已有<?php  echo Authidentity::getAuthCount(Authidentity::GUIDE);?>人进行了导游认证</p>
                <p class="mt20"><a href="<?php echo $this->createUrl('authidentity/guideentry')?>" class="profession-btn">立即申请</a></p>
            </li>
        </ul>
     </div>