
<!-- menu of my center-->
<div class="main-left">


<div class="fl-alpha">
    <ul class="my-left-list">
        <li <?php if($this->flag['selected']=='zhgl'):?>class="selected"<?php endif;?>>
            <p class="nav1"><a href="javascript:;">帐号管理</a><i></i></p>
            <ul class="next-nav-list" <?php if($this->flag['selected']=='zhgl'):?>style="display:block"<?php endif;?>>
                <li <?php if($this->flag['select']=='BasicInfo'):?>class="select"<?php endif;?>><a href="<?php echo $this->createUrl('/center/basicinfo')?>">基本信息</a></li>
                <li  <?php if($this->flag['select']=='UpdateHeader'):?>class="select"<?php endif;?>><a href="<?php echo $this->createUrl('/center/updateheader')?>">修改头像</a></li>
                <li  <?php if($this->flag['select']=='Security'):?>class="select"<?php endif;?>><a href="<?php echo $this->createUrl('/center/security')?>">安全中心</a></li>
   
                <li  <?php if($this->flag['select']=='MsgManager'):?>class="select"<?php endif;?>><a href="<?php echo $this->createUrl('/center/msgmanager')?>">消息管理</a></li>
            </ul>
        </li>
        <li  <?php if($this->flag['selected']=='buyer'):?>class=selected<?php endif;?>>
        <p class="nav2"><a href="javascript:;">我是买家</a><i></i></p>
            <ul class="next-nav-list" <?php if($this->flag['selected']=='buyer'):?>style="display:block"<?php endif;?>>
                <li <?php if($this->flag['select']=='order'):?>class="select"<?php endif;?>><a href="<?php echo $this->createUrl('/center/buyerindex')?>">我的订单</a></li>
                <li <?php if($this->flag['select']=='sendcomment'):?>class="select"<?php endif;?>><a href="<?php echo $this->createUrl('/comment/buyercomment')?>">评论管理</a></li> 
            </ul>
        </li>
        <li <?php if($this->flag['selected']=='seller'):?>class="selected"<?php endif;?>><p class="nav3"><a href="<?php echo $this->createUrl('/center/sellerindex')?>">我是卖家</a><i></i></p>
            <ul class="next-nav-list" <?php if($this->flag['selected']=='seller'):?>style="display:block"<?php endif;?>>
                <li <?php if($this->flag['select']=='sellerhouse'):?>class="select"<?php endif;?>><a href="<?php echo $this->createUrl('/center/house')?>">我的住所</a></li>
                <li <?php if($this->flag['select']=='sellershortrun'):?>class="select"<?php endif;?>><a href="<?php echo $this->createUrl('/center/shortrun')?>">我的短期行程</a></li>
                <li <?php if($this->flag['select']=='recivecomment'):?>class="select"<?php endif;?>><a href="<?php echo $this->createUrl('/comment/sellercomment')?>">评论管理</a></li>
        
            </ul>
        </li>
        <li  <?php if($this->flag['selected']=='album'):?>class="selected"<?php endif;?>><p class="nav4"><a href="<?php echo $this->createUrl('/album/index')?>">我的相册</a><i></i></p></li>
        <li <?php if($this->flag['selected']=='myarticle'):?>class="selected"<?php endif;?>><p class="nav9"><a href="<?php echo $this->createUrl('/myArticle/index')?>">我的攻略</a><i></i></p></li>
        <li <?php if($this->flag['selected']=='collection'):?>class="selected"<?php endif;?>><p class="nav12"><a href="<?php echo $this->createUrl('/collect/index')?>">我的收藏</a><i></i></p></li>
        <li <?php if($this->flag['selected']=='share'):?>class="selected"<?php endif;?>><p class="nav11"><a href="<?php echo $this->createUrl('share/index')?>">我的分享</a><i></i></p></li>
    </ul>
</div>

</div>
<!-- menu of my center-->