<div class="main-right">
        <h3 class="cent-title"><a href="javascript:;">我是卖家</a> <em>&gt;</em> <a href="javascript:void(0)">我的住所</a><em>&gt;</em>住所管理</h3>
           <div class="evaluate">
               <ul class="cons-tit">
                   <li <?php if($this->tab==='mygoods'):?>class="nav"<?php endif;?>>住所管理</li>
                   <li <?php if($this->tab==='myorder'):?>class="nav"<?php endif;?>>出租的住所</li>
               </ul>
               <div class="cons-list">
					<div class="status-info1">
                    <?php $goods = Property::model()->getPropertyId(U_ID); if(count($goods)):?>
						<p class="total"><b>友情提示：</b>房东认证可有效提高您产品的可信度和价值，促成交易。已有<?php  echo Authidentity::getAuthCount(Authidentity::LANDER);?>位房东进行了房东认证！ <a href="<?php echo $this->createUrl('authidentity/index');?>" target="_blank">了解更多 ></a><a href="javascript:;" id="close">*</a></p>
                    <?php endif;?>    
					</div>
                   <div  class="filter">
                       <label>筛选：</label>
                       <select class="filter-states">
                           <?php if($_SESSION['state']==='all'):?>
						   <option name="all">全部</option>
                           <option name="1">显示中</option>
                           <option name="2">编辑中</option>
                           <option name="0">已下架</option>
                        <?php endif;?>
                         <?php if(intval($_SESSION['state'])===1 && $_SESSION['state']!='all'):?>
						   <option name="1">显示中</option>
                           <option name="all">全部</option>
                           <option name="2">编辑中</option>
                           <option name="0">已下架</option>
                        <?php endif;?>
                        
                         <?php if(intval($_SESSION['state'])===2 && $_SESSION['state']!='all'):?>
						   <option name="2">编辑中</option>
                           <option name="all">全部</option>
                           <option name="1">显示中</option>
                           <option name="0">已下架</option>
                        <?php endif;?>
                        
                         <?php if(intval($_SESSION['state'])===0 && $_SESSION['state']!='all'):?>
						   <option name="0">已下架</option>
                           <option name="all">全部</option>
                           <option name="2">编辑中</option>
                           <option name="1">显示中</option>
                        <?php endif;?>
                       </select>
                   </div>
                   
                <div id="results-list">
                <?php include "house_list.php";?>
                </div>
          
               </div>
               <div class="cons-list">
                  
                 <?php include "house_order_list.php";?> 

              </div>

           </div>
   </div>
   
  