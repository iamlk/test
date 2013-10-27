<div id="house">

	<div class="main-right">
        <!--<div class="friends-search-wrap">
        
            <ul class="cons-list-tit fl width60">
                <li class="first nav">全部</li>
                <li>星级</li>
                <li>价格</li>
                <li>可住人数</li>
                <li class="end">住所面积</li>
            </ul>
            <form name="" action="###">
                <input type="text" class="zyx-ipt searchtxt" data-default="请输入关键字，进一步搜索" value="" />
                <a href="javascript:;" class="zyxbtn3">搜索</a>
            </form>
           
        </div> -->
        <div class="collection-list-wrap">
        
           <?php foreach($data->getData() as $item):?>
        
            <?php  $info=json_decode($item['json']);?>
            
            <div class="collection-list">
                <ul>
                    <li class="big-img">
                        <a href="<?php echo $this->createUrl('goods/index',array('id'=>$info->_id))?>"><img src="<?php echo '/thumb/233_184/'.$info->img;?>" alt="" width="233" height="184" ></a>
                     </li>
                </ul>
                <div class="clear"></div>
                <p class="operating"><img class="grade-img" alt="" src="../images/grade5.png"><strong class="orange">￥<?php echo $item['price'];?></strong></p>
                <p class="operating collection-info"><?php echo  $info->title?> </p>
                <?php foreach(Dynamic::model()->getGoodsDynamicInfo($info->_id,'Property') as $val):?>
                <p class="operating"><span class="green"><?php  echo $val->propertyType->propertyTypeAddendumLocal->type?> <em>|</em> <?php echo $val->room;?>间卧室 <em>|</em> 可住<?php echo $val->person;?>人 <em>|</em> <?php echo $val->area_sqm;?>平米</span></p>
                <?php endforeach;?>
            </div>
           
  
            <?php endforeach;?>
 
        </div>
        <div class="clear"></div>
        <?php
$this->widget('application.widgets.PageToolbar' , array('pagination'=>$data->pagination, 'ajaxContainerId'=>'house','useAjax'=>true, 'route'=>'people/buyerhousepage'));
?>
    </div>
    </div>