<?php /* @var $this Controller */ ?>
<?php /* 产品.列表 */ ?>
<?php $this->beginContent('//layouts/base.without.footer'); ?>
<?php

Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl.'/css/page.css');
Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl.'/css/order_base.css');

Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl.'/css/product_list.css');
//Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/product_list.js');
Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl.'/widget/popwin/popwin1.css');
Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/widget/popwin/popwin1.js');
Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl.'/widget/lightbox/lightbox.css');
Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/widget/lightbox/lightbox.js');
Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl.'/widget/zyxcalendar/zyxcalendar.css');
Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/widget/zyxcalendar/zyxcalendar.js');
Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl.'/widget/country_selector/country_selector.css');
Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/widget/country_selector/country_selector.js');

Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/jquety.scrollTo.js');
?>


<div class="main-wrap clearfix pb10 mt55">

    <?php $this->Widget('application.widgets.ItineraryPlan'); ?>

        <div class="product-wrap-right mt10">
        <?php echo $content;?>
        </div>

<div class="clear"><input type='hidden' class='city-hide'  value=''/></div>
<script type="text/javascript">
    $(function(){

        $("body").append('<div id="popwin1"><div id="popwin1-con-outter"></div></div><div id="popwin1-bg"></div>');
		$(".map-mode").css({height:$(".pro-list").height()-39});

		/*修改产品*/

		var up =  $(".itinerary-num1-indent .update");
		var right = $(".product-wrap-right");
		var close = $(".item-tit span.close");
		var content = right.html();
		up.live("click",function(){

			var pdes = $(".filters-list li p");
			var des =  $(".product-wrap p.product-des");
			var prolist =  $(".pro-list");
			var height = prolist.height();
			var mainwrap =  $(".main-wrap");
			var right = $(".product-wrap-right");
			var node = $(".map-mode");
			var map = $(".pro-map-wrap");
			var mapmax = $(".map-max");
			var promap = $(".pro-map");
			var settlement = $(".settlement");
			var mapmin = $(".map-min");
			if(mainwrap.width() !==1000){
				pdes.stop(false,true).css({width :"649px"});
				des.stop(false,true).animate({width :"400px"},0);
				prolist.stop(false,true).animate({width :"726px"},0);
				mainwrap.css({width :"1000px"});
				right.stop(false,true).animate({width:"762px"},0);
				$(".pro-scroll-wrap").stop(false,true).animate({width :"726px"},0);
				node.show();
				map.hide();
				mapmax.hide();
				mapmin.hide();
				promap.css({width:"28px"});
				settlement.stop(false,true).animate({left:"50%",marginLeft:"-500px"},0);
			}

			$.post("<?php echo $this->createUrl('basket/shoplistbyday');?>", { day_step: $(this).attr('step') },
				function(data){
					if(!data == '' || !data == null){
					right.html(data);
				}
			});
		});

		close.live("click",function(){
			right.prepend("<div style='margin: 20% auto;width: 762px;'><div id='loading1'></div></div>");
			$("#loading1").show("normal");
		    $.post(window.location.href,{name:"robyn"},
			function(data){
			$("#loading1").hide("normal",function(){
                if(data==0){
                    alert("噢，没有数据了！");
                    return false;
                }
                right.html(data);
				$(".pro-map-wrap,.map-max,.map-min").hide();
				var height = $(".pro-list").height();
				$(".map-mode").css({height:height-39});
            });
			});
		});
		
 $(window).bind('resize', function(){
           var home_city_wrap = $(".home-city-wrap");
           var y = $(window).height()/2-200;
           home_city_wrap.css({"top": y});
       });
  var y = $(window).height()/2-200;
        var home_city_wrap = $(".home-city-wrap");
        home_city_wrap.css({"top": y});

	/*关闭切换目的地弹出窗口*/
	var close = $(".home-tit > span.close");
	$(".home-city-wrap").hide();
		close.live("click",function(){
			$(this).closest(".home-city-wrap").hide();
		});

	/*点击弹出切换目的地*/
	var toggle = $(".product-wrap-left a.toggle, .product-wrap-right a.toggle");
	var id;
	var hid = $(".city-hide");
	toggle.live("click",function(){
		$(".home-city-wrap").show();
		id = $(this).attr("id");
		hid.val(id);
        
	});


	/*点击切换城市
	var city = $(".home-city-detail a");
	var num;
	city.live("click",function(){
		num = hid.attr("value");
		if($(".product-wrap-left a#"+num).parent().has("b"))
		{
			$(".product-wrap-left a#"+num).parent().find("b").text($(this).text());
		}
		else($(".product-wrap-right a#"+num).parent().has("span"))
		{
			$(".product-wrap-right a#"+num).parent().find("span").text($(this).text());
		}
        //$.post("/site/test",{id:num,cid:$(this).data("city")});
		$(".home-city-wrap").hide();

	});
    */


	/*删除当天行程单商品*/
$(".order-list p span.delete").live("click",function(){
    var obj = $(this);
    var pro_id = $(this).attr('proid');
    var pro_type = $(this).attr('prot');
    var pro_day = obj.data("day");
	$.post("<?php echo $this->createUrl('basket/deleteGoods'); ?>", { goods_id: pro_id, entity_type: pro_type, day_step:pro_day },
		function(data){
			if(data == "OK"){
					obj.closest("li").remove();
					var day = obj.attr("prot");
					var id =obj.attr("proid");
					var right = $(".product-wrap-right");
					//var step = obj.clostest(".product-content").find(".update").attr("step");
                    if($('.item-content').length){
                        $.post("<?php echo $this->createUrl('basket/shoplistbyday');?>", { day_step: pro_day },
        					function(data){
            					if(!data == '' || !data == null){
            					right.html(data);
        					}
                        });
                    }

            }else{
				alert("对不起，删除没有成功！");
			}
		})
	});



	/*创建新的行程单*/
$(".new-confirm").live("click",function(){
    if(CLIENTSTATUS.login == false) {return false;}
	$.post("<?php echo $this->createUrl('basket/saveCurrentBasket'); ?>", { name: "fedora" },
		function(data){
			if(data == "OK"){
					alert("创建新的行程单成功");
					window.location.reload();
				}
			else{
					alert("对不起，创建没有成功！");
				}
		}
		)
	});


	/*我的行程单点击选中并第几天赋值变量*/

	var pro_content= $(".product-content-scroll .product-content");
	var num_icon = $(".itinerary-icon");
	var hid_num = $("#pro-num");
	var day;
	pro_content.live("click",function(){
	    day = $(this).find(num_icon).text()-1;
        if(hid_num.val()!=day){
    		hid_num.attr("value",day);
            $.post("<?php echo $this->createUrl('basket/setCurrentDay'); ?>", { current_day_step: day });
    		$(this).addClass("select").siblings(".product-content").removeClass("select");
        }
	});


    })


/*商品清单*/
$(function(){
	var del = $(".product-funtion .delete");
	var clear = $(".product-funtion .clear");
	var pro_id,pro_day,obj,pro_type;

	//当天删除
	$(".product-funtion .delete").live("click",function(){
		obj = $(this);
		pro_id = obj.data("id");
        pro_type = $(this).attr('prot');
        pro_day = obj.data("day");
		$.post("<?php echo $this->createUrl('basket/deleteGoods'); ?>",{goods_id:pro_id,day_step:pro_day,entity_type:pro_type},
			function(data){
			    if(data == "OK"){
					$("#item_"+pro_day+"_"+pro_id).remove();
					$("#product_"+pro_day+"_"+pro_id).remove();
				}
			else{
					alert("对不起，从当天移除失败！");
				}
			}
		);

	});


	//行程单删除
	$(".product-funtion .clear").live("click",function(){
		obj = $(this);
		pro_id = obj.data("id");
        pro_type = $(this).attr('prot');
        pro_day = obj.data("day");
		$.post("<?php echo $this->createUrl('basket/deleteGoods'); ?>",{goods_id:pro_id,day_step:'200',entity_type:pro_type},
			function(data){
			    if(data == "OK"){
					$("#item_"+pro_day+"_"+pro_id).remove();
					$(".product_"+pro_id).remove();
				}
			else{
					alert("对不起，从行程单移除失败！");
				}
			}
		);

	});
	
	//hover显示修改与切换
	var box = $(".product-content-box");
	var updata = $(".product-wrap-left a.update");
	var toggle = $(".product-wrap-left a.toggle");
	var select = $(".product-content-box.select");
	
	
	if(box.hasClass("select")){
			select.find(updata).show();
			select.find(toggle).show();
		}
	else{
		select.find(updata).hide();
		select.find(toggle).hide();
	}
	
	box.live("click",function(){
		box.find(updata).hide();
		box.find(toggle).hide();
		box.eq($(this).index()-1).find(updata).show();
		box.eq($(this).index()-1).find(toggle).show();
	});
	
	box.hover(function(){
		$(this).find(updata).show();
		$(this).find(toggle).show();
	},function(){
		if($(this).hasClass("select")){
			$(this).find(updata).show();
			$(this).find(toggle).show();
		}else{
		$(this).find(updata).hide();
		$(this).find(toggle).hide();}
	});
	
})



</script>
    <!--.main-wrap end-->
</div>


<?php $this->endContent(); ?>