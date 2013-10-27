
<?php if(Yii::app()->user->hasFlash('errortips')):?>
   <div id="msg-box" class="error"><?php echo Yii::app()->user->getFlash('errortips'); ?> </div>
  <?php endif;?>

	<div class="main-right">
        <h3 class="cent-title"><a href="mycent_seller_index.html">我是卖家</a><em>&gt;</em>添加银行卡</h3>
         <form action="<?php echo $this->createUrl('center/addsellercardnum',array('action'=>'addcard'))?>" id="info-form" method="post" >
            
            <ul class="info-list seller-info">
                <li>
                    <label></label>
                    <span class="add-green">* 无需开通网银，72小时内到账</span>
                </li>
                   <?php if(!empty($data['banknumber'])):?>
                   <li>
                    <label>当前银行卡号:</label>
                    <span class="add-green"><?php echo $this->Datahiding($data['banknumber'],'document')?></span>
                   </li>
                   <?php endif;?>
                <li>
                    <label>开户行:</label>
                    <select class="zyx-ipt bank ZYXselect" name="bank_name">
                      <?php include('_bank_name.php');?>
                    </select>
                </li>
                <li>
                    <label>开户行支行:</label>
        
                   <input type="text" value="<?php echo $data['bank_address']?>"  class="long" maxlength="40" size="40" name="bank_address"/> 
                </li>
                <li>
                    <label>开户行账号:</label>
                    <input type="text" value="<?php echo $data['banknumber']?>"  class="long" maxlength="40" size="40" name="banknumber"/>
                </li>
                <li>
                    <label>再次确认账号:</label>
                    <input type="text" value="<?php echo $data['rebanknumber']?>"  class="long" maxlength="40" size="40" name="rebanknumber"/>
                </li>
                <li>
                    <label>开户姓名:</label>
                    <input type="text" value="<?php echo $data['banker'];?>" class="long" maxlength="40" size="40" name="banker"/>
                </li>
                <li>
                    <label>&nbsp;</label>
                    <span class="btn-line mycent-btn"><input type="submit" value="保存" name="yt0"/></span>
                </li>
            </ul>
          
        </form>
	</div>