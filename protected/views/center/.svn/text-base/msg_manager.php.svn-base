	<div class="main-right">
        <h3 class="cent-title">消息管理</h3>
           <div class="consumption">
               <ul class="cons-tit">
                   <li <?php if($this->classly == 'HF'):?>class="nav" <?php endif;?> >回复</li>
                   <!--li>系统消息</li-->
                   <li <?php if($this->classly == 'SMS'):?>class="nav" <?php endif;?> >站内信</li>
                  <!-- <li>消息设置</li>-->
               </ul>
               <div class="cons-list" id="apply">
                   <ul class="cons-list-tit">
                       <li class="nav first">收到的消息</li>
                       <li class="end">发出的消息</li>
                   </ul>
                   <div class="content">
                   
                      <?php include "recive_reply.php";?>
                  
                   </div>
                   <div class="content">
                       <?php include "send_reply.php";?>
                   </div>

               </div>
       
               <!--div class="cons-list">
                 <?php // include "sys_msg.php";?>
               </div-->
               
                <div class="cons-list">
                 <?php include "station_msg.php";?>
               </div>

           </div>
	</div>
<script type="text/javascript">
 //tab切换
$(function(){
    var tit1 = $("#apply .cons-list-tit > li");
    var tit2 = $("#information .cons-list-tit > li");
    var con1 = $("#apply .content");
    var con2 = $("#information .content");
    $("#apply .content:gt(0)").hide();
    $("#information .content:gt(0)").hide();
    tit1.live("click",function(){
        $(this).addClass("nav").siblings("li").removeClass("nav");
        con1.eq($(this).index()).show().siblings(".content").hide();
    });
    tit2.live("click",function(){
        $(this).addClass("nav").siblings("li").removeClass("nav");
        con2.eq($(this).index()).show().siblings(".content").hide();
    });

});

//全选，全不选
   /*  $(function(){
        var all = $("#all");
        var check = $(".select-list li  input[type='checkbox']");
        all.click(function(){
            if($("#all").attr("checked")){
                check.attr("checked",true);
            }
            else{
                check.removeAttr("checked");
            }
        });
        check.live("click",function(){
            var size = $(".select-list li  input[type='checkbox']:checked").size();
            var size1 = $(".select-list li  input[type='checkbox']").size();
            //alert("选中的个数是："+size+"==========总数是："+size1);
            if(size==size1){
                all.attr("checked",true);
            }else{
                all.removeAttr("checked");
            }
        })
    }); */

</script>