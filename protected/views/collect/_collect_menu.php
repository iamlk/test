<ul class="cons-list-tit fl width60">

   	<li class="first<?php if(!$_GET['type'] || $_GET['type']=='all') echo ' nav';?>">
		<a href="<?php echo $this->createUrl('collect/index',array('type'=>'all'))?>">全部</a>
	</li>
	<li class="<?php if($_GET['type']==Dynamic::PROPERTY) echo ' nav';?>">
		<a href="<?php echo $this->createUrl('collect/property',array('type'=>Dynamic::PROPERTY))?>">住所</a>
	</li>
	<li <?php if($_GET['type']==Dynamic::PRODUCT) echo ' class="nav"';?> >
		<a href="<?php echo $this->createUrl('collect/product',array('type'=>Dynamic::PRODUCT))?>">行程</a>
	</li>
	<li <?php if($_GET['type']==Dynamic::TRAVEL) echo ' class="nav"';?> >
		<a href="<?php echo $this->createUrl('collect/travel',array('type'=>Dynamic::TRAVEL))?>">行程单</a>
	</li>
	<li <?php if($_GET['type']==Dynamic::ARTICLE) echo ' class="nav"';?> >
		<a href="<?php echo $this->createUrl('collect/article',array('type'=>Dynamic::ARTICLE))?>">攻略</a>
	</li>
	<li <?php if($_GET['type']==Dynamic::DELICACY) echo ' class="nav"';?> >
		<a href="<?php echo $this->createUrl('collect/delicacy',array('type'=>Dynamic::DELICACY))?>">美食</a>
	</li>
    <li class=" <?php if($_GET['type']==Dynamic::RESTAURANT) echo 'nav';?>">
		<a href="<?php echo $this->createUrl('collect/restaurant',array('type'=>Dynamic::RESTAURANT))?>">餐厅</a>
	</li>
	<li class="end <?php if($_GET['type']==Dynamic::ALBUM) echo 'nav';?>">
		<a href="<?php echo $this->createUrl('collect/album',array('type'=>Dynamic::ALBUM))?>">相册</a>
	</li>
	
</ul>

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
        var ids = [];
        allde.live("click",function(){
            var checked = $(".collection-list  input[type='checkbox']:checked");
            var size = $(".collection-list  input[type='checkbox']:checked").size();
            for(var i=0;i<size;i++){
               ids.push($(".collection-list  input[type='checkbox']:checked").eq(i).val()); 
            }
            if(size=="0" || size == ""){
                alert("没有选中任何对象");
                return;
            }
            $.post("<?php echo $this->createUrl('collect/deleteAll'); ?>",{id:ids,type:allde.data('type')},function(data){
                if(data.state == "1"){
                    alert(data.reason);
                    checked.closest(".collection-list").remove();
                }
                else{
                    alert(data.reason);
                }
            },'json');
        });

        //单选删除
       /*  var close = $(".collection-list-wrap .close");
        close.live("click",function(){
            var div = $(this).parents(".collection-list");
            $.post("/site/test",{name:"robyn",age:"13"},function(data){
                if(data == "36OK"){
                    alert("删除成功");
                    div.remove();
                }
                else{
                    alert("删除失败");
                }
            });
        }); */
    });

</script>