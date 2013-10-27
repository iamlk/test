<div id="article">
	<div class="main-right">
       <div class="friends-search-wrap clearfix">
            <ul class="cons-list-tit fl width60">
                <?php include('_share_menu.php');?>
            </ul>
            <!--<form action="<?php $this->createUrl('share/property');?>" name="">
                <input type="text" value="" data-default="请输入关键字，进一步搜索" class="zyx-ipt searchtxt">
                <a class="zyxbtn3" href="javascript:;">搜索</a>
            </form>-->
        </div>
        <div class="share-list-wrap">
            <ul class="share-listitem">
            <?php foreach($data->getData() as $item):?>
            <li>
            <?php include('_article.php');?> 
            </li>
            <?php endforeach;?>
            </ul>
        </div>
                                          <?php
$this->widget('application.widgets.PageToolbar' , array('pagination'=>$data->pagination, 'ajaxContainerId'=>'article','useAjax'=>true, 'route'=>'share/articlepage'));
?>
        <div class="clear"></div>
    </div>
    </div>