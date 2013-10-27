  
  <?php if(Yii::app()->user->hasFlash('errortips')):?>
   <div id="msg-box" class="error"><?php echo Yii::app()->user->getFlash('errortips'); ?> </div>
  <?php endif;?>
  
   <?php if(Yii::app()->user->hasFlash('oktips')):?>
   <div id="msg-box"><?php echo Yii::app()->user->getFlash('oktips'); ?> </div>
  <?php endif;?>
   

	<div class="main-right">
        <h3 class="cent-title">我是买家</h3>
        <p class="status-info">账户总支出：
        <?php if(Order::model()->AllPayMoney(U_ID)):?>
        <span>￥<?php echo Order::model()->AllPayMoney(U_ID);?></span>
        <?php else:?>
        <span>￥0.00</span>
        <?php endif;?>
        </p> 
		<div  class="filter">
     
			<label>排序： </label>
			<select class="filter-states" >
                <option name='all' <?php if($this->classly =='all'):?> selected="true" <?php endif;?>>全部订单</option>
			    <option name='3' <?php if($this->classly ==='3'):?> selected="true" <?php endif;?>>已付款订单</option>
				<option name='0' <?php if($this->classly ==='0'):?> selected="true" <?php endif;?>>未付款订单</option>
			 	<option name='2' <?php if($this->classly ==='2'):?> selected="true" <?php endif;?>>过期订单</option>
			</select>
          
		</div>
         
         
         
         <?php include('_buyer_order_list.php')?>
         
         
	</div>

<div id="share-form" class="undis">
	<form method="POST" action="">
		<input type="text" value="" name="title" placeholder="为您行程单输入标题，长度为30个字以内..." />
		<input type="submit" value="分享" />
		<a href="javascript:;" class="cancle">取消</a>
	</form>
</div>