<div id="shortrun">
	<div class="main-right">
          <!--<div class="friends-search-wrap">
            <div class="fl short-trip-select">
          
                <select class="zyx-ipt  ZYXselect">
                    <option>全部</option>
                    <option>价格</option>
                </select>
                <select class="zyx-ipt  ZYXselect">
                    <option>行程类型</option>
                    <option>行程类型</option>
                </select>
                
            </div>
            <script type="text/javascript">
                $(function(){
                    $('.short-trip-select select').ZYXselect({});
                });
            </script>
            <form name="" action="###">
                <input type="text" class="zyx-ipt searchtxt" data-default="请输入关键字，进一步搜索" value="" />
                <a href="javascript:;" class="zyxbtn3">搜索</a>
            </form>
            
        </div>
        </div>-->
        <div class="collection-list-wrap">
        
         <?php foreach($data->getData() as $val ):?>

       
             <div class="collection-list">
                <ul>
                    <li class="big-img">
                        <a href="<?php echo $this->createUrl('goods/index',array('id'=>$val->goods->goods_id))?>"><img src="<?php echo Yii::app()->assetManager->baseUrl.'/'.$val->goodsImage->attributes['path'];?>" alt="" width="233" height="184" ></a>
                    </li>
                </ul>
                <div class="clear"></div>
                <p class="operating"><img class="grade-img" alt="" src="../images/grade5.png"><strong class="orange">￥<?php echo $val->goods->price?></strong></p>
                <p class="operating collection-info"><?php echo $val->addendum->title;?> </p>
                <!--<p class="operating"><span class="green">独立屋 <em>|</em> 4间卧室 <em>|</em> 可住6人 <em>|</em> 150平米</span></p>-->
            </div>
       
       
            <?php endforeach;?>
            
        </div>
        <div class="clear"></div>
                <?php
$this->widget('application.widgets.PageToolbar' , array('pagination'=>$data->pagination, 'ajaxContainerId'=>'shortrun','useAjax'=>true, 'route'=>'people/SellerShortRunpage'));
?>
    </div>
    </div>