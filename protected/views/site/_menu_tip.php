<ul>
    <li><a href="<?php echo $this->createUrl('center/buyerIndex',array('classly'=>'all')); ?>">我买到的</a><!--span class="orange"><?php //if($data['to_pay']){ echo '('.$data['to_pay'].'未支付)' ;}  ?></span--></li>
    
       <li><a href="<?php echo $this->createUrl('center/house',array('tab'=>'myorder')); ?>">我卖出的住所</a><!--span class="orange"><?php //if($data['to_pay']){ echo '('.$data['to_pay'].'未支付)' ;}  ?></span--></li>
       
       <li><a href="<?php echo $this->createUrl('center/shortrun',array('tab'=>'myorder')); ?>">我卖出的行程</a><!--span class="orange"><?php //if($data['to_pay']){ echo '('.$data['to_pay'].'未支付)' ;}  ?></span--></li>
       
    <li><a href="<?php echo $this->createUrl('collect/index'); ?>">我的收藏夹</a><span class="orange"><?php if($data['collect']){ echo '('.$data['collect'].')' ;}  ?></span></li>

    <li><a href="<?php echo $this->createUrl('site/logout'); ?>">退出</a></li>
</ul>