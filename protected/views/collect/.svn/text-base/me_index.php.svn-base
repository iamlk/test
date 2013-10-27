	<div class="main-right">
        <div class="friends-search-wrap">
            <ul class="cons-list-tit fl width60">
                <li class="first nav">住所</li>
                <li>行程</li>
                <li>行程单</li>
                <li>攻略</li>
                <li>美食</li>
                <li class="end">相册</li>
            </ul>
            <form action="###" name="">
                <input type="text" value="" data-default="请输入关键字，进一步搜索" class="zyx-ipt searchtxt">
                <a class="zyxbtn3" href="javascript:;">搜索</a>
            </form>
        </div>
        <ul class="photo_toolbar_wrap">
            <li><input type="checkbox" name="all" id="all">本页全选</li>
            <li><a href="javascript:void(0);" class="all" title="批量删除">批量删除</a></li>
        </ul>
        <div class="collection-list-wrap">
         
         <?php foreach($data as $item):?>
         <?php $images=json_decode($item->img_url);?>
            <div class="collection-list">
                <p class="collection-tit"><?php echo $item->title;?></p>
                <ul>
                <?php $count=0 ?>
                 <?php foreach($images as $img):?>
                 <?php $count++;?>
                 <?php if($count == 1 && !empty($img)):?>
                  <li class="big-img"><a href="###"><img src="<?php echo '/thumb/233_184/'.$img;?>" alt="" width="233" height="184" ></a></li>
                 
                 <?php elseif($count <=4 && !empty($img)):?>
                 <li><a href="###"><img src="<?php echo '/thumb/74_74/'.$img;?>" alt="" width="74" height="74"></a></li>
                   
                 <?php endif;?>
                      
                 <?php endforeach;?>
          <?php for($i=0;$i<(4-$count);$i++):?>
               <li></li>
              <?php endfor;?>
                </ul>
                <div class="clear"></div>
                <p class="operating"><input type="checkbox" name="delete"><span class="data"><?php echo date('Y-m-d',$item->created) ;?></span><span class="share"><a href="<?php echo $this->createUrl('share/it');?>" data-sourceurl="<?php echo Product::model()->getProductGoods_id($item->object_id);?>" data-title="<?php echo  $item->title;?>" data-type="1" data-id="<?php echo $item->object_id;?>" 
       data-images="<?php  $images=json_decode($item->img_url); foreach($images as $img):?>
         <?php $image.=$img.'|';?>
       <?php endforeach;?>
       <?php echo $image;?>
       " class="partake">分享</a><em>|</em><a href="###" class="edit">编辑</a></span></p>
                <span class="close"></span>
            </div>
            
        <?php endforeach;?>
        
        </div>
        <div class="clear"></div>
        <p id="loading-talk">正在加载……</p>
    </div>
    <script type="text/javascript">
    /*全选，全不选*/
    $(function(){
        var all = $("#all");
        var check = $(".collection-list input[type='checkbox']");
        all.live("click",function(){
            if($("#all").attr("checked")){
                check.attr("checked",true);
            }
            else{
                check.removeAttr("checked");
            }
        });


        check.live("click",function(){
            var size = $(".collection-list  input[type='checkbox']:checked").size();
            var size1 = $(".collection-list  input[type='checkbox']").size();
            //alert("选中的个数是："+size+"==========总数是："+size1);
            if(size==size1){
                all.attr("checked",true);
            }else{
                all.removeAttr("checked");
            }
        });

        //批量删除
        var allde = $(".all");
        allde.live("click",function(){
            var checked = $(".collection-list  input[type='checkbox']:checked");
            var size = $(".collection-list  input[type='checkbox']:checked").size();
            $.post("/site/test",{name:"robyn",age:"13"},function(data){
                if(data == "36OK"){
                    if(size == "0" && size == "" ){
                        alert("亲，您还没有选择");
                    }else{
                        alert("删除成功");
                        checked.closest(".collection-list").remove();
                    }
                }
                else{
                    alert("删除失败");
                }
            });
        });

        //单选删除
        var close = $(".collection-list-wrap .close");
        close.live("click",function(){
            var me = $(this);
            $.post("/site/test",{name:"robyn",age:"13"},function(data){
                if(data == "36OK"){
                    alert("删除成功");
                    me.parents(".collection-list").remove();
                }
                else{
                    alert("删除失败");
                }
            });
        });
    });

</script>