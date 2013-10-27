<?php /* @var $this Controller */ ?>
<?php $this->beginContent('//layouts/base'); ?>
<?php echo CHtml::hiddenField('csrfToken', Yii::app()->request->csrfToken); ?>
<!--banner-->
<div class="banner">
<?php $this->widget('application.widgets.SlideShowWidget'); ?>
     <div class="banner-img-wrap"></div>
      <div class="search-area">
        <!--<div  id="blob-bg">
          <img width="600" height="180" src="images/banner-text-bg.png" alt="">
        </div>
        -->
    <div class="container">
      <h1>目的地</h1>
      <h2>涵盖全球多个地区和国家</h2>
		<div class="banner-search">
		<form action="/search/index" method="get">
			<input type="text" name="key" id="banner-search-input"  maxlength="50" placeholder="你想去哪里？" def="你想去哪里？" data-remote="/index.php?r=search/ajaxget" autocomplete="off" />
			<input type="submit" value="" id="banner-search-btn">
		</form>
		<span class="banner-search-bg"></span>
		
		<div class="recommend-city-list undis">
			<div class="city-all">
				<label>全部:</label>
				<p>
                
                 <?php foreach( $this->parent as $item):?>
                 
					<a href="<?php
                
                if(strstr($item['path'],'http')){
                    
                    echo $item['path'];
                    
                }else{
                    
                    echo $this->createUrl('city/index',array('cid'=>intval($item['path']))) ;   
                }
  
                 ?>"><?php echo $item['name']?></a>
                    
			     <?php endforeach;?>
			
				</p>
				<div class="more">
					<span class="toggle">展开更多</span><em class="icon"></em>
				</div>
			</div>
            <em class="bottom"></em>
			<ul class="city-all-wrap"> 
             <?php foreach( $this->parent as $item):?>
               
               <?php foreach($this->sub as $value):?>
               
                 <?php if($item['recommend_id'] ==$value['parent_id'] ):?>
				<li>
					<label><?php echo Recommend::model()->nameFilter($value['name']);?></label>               
					<p>
                       <?php foreach($this->sub as $val):?>
                          <?php if($value['recommend_id'] ==$val['parent_id'] ):?>
                         
						<a href="<?php
                
                if(strstr($val['path'],'http')){
                    
                    echo $val['path'];
                    
                }else{
                    
                    echo $this->createUrl('city/index',array('cid'=>intval($val['path']))) ;   
                }
  
                 ?>"><?php echo $val['name'];?></a>
                 
                        <?php endif;?>
                        <?php endforeach;?>
					</p>
				</li>
                  <?php endif;?>
                <?php endforeach;?>
                 
             <?php endforeach;?> 
			</ul>	
		</div>
	</div>
    </div>
  </div>

    <div class="preNext pre"></div>
    <div class="preNext next"></div>

</div>


    <div class="main-wrap clearfix pb10">

	   <?php echo $content; ?>

    </div>


<div class="home-city-wrap undis">
</div>


<script type="text/javascript">
	$(function(){
        $(".city-tiles > li").each(function(i){
            $(this).hover(function(){
                $(this).find(".city-name").css({opacity:"0"}).stop(false,true).animate({opacity:"1"},800);
            });
        });


        var y = $(window).height()/2-200;
        var home_city_wrap = $(".home-city-wrap");
        home_city_wrap.css({"top": y});
		
		if($(".city-all p a").size()>15){
			$(".city-all .more").show();
		}else{
			$(".city-all .more").hide();
		}
		
		$(".city-all p a:gt(15)").hide();
		$(".city-all .toggle").toggle(function(){
			$(this).next(".icon").css({backgroundPosition:"center -4px"});
			$(this).text("关闭更多");
			$(".city-all p a:gt(15)").show();
		},function(){
			$(this).next(".icon").css({backgroundPosition:"center 7px"});
			$(this).text("展开更多");
			$(".city-all p a:gt(15)").hide();
		})
		
	})


    //Banner Start
    var curIndex=0;
    var time=800;
    var slideTime='<?php echo $this->params['slide']; ?>';
    var caption=$(".banner>#slideshow>li>.caption");
    var int=setInterval("autoSlide()",slideTime);
	var insize = $("#slideshow li").size();
    var index = 0;

    function autoSlide(){
        curIndex+1>=$(".banner>#slideshow>li").size()?curIndex=-1:false;
        show(curIndex+1);
    }

    function show(index){
        $.easing.def="easeOutQuad";
        //$(".banner-img-wrap").fadeOut(0);
        $(".banner>#slideshow>li").eq(curIndex).stop(false,true).fadeOut(time);
        setTimeout(function(){
            $(".banner>#slideshow>li").eq(index).stop(false,true).fadeIn(time);
            caption.eq(index).css({bottom:"-60px",opacity:"0"}).stop(false,true).animate({bottom:"25px","*bottom":"35px",opacity:"1"},time);
           //$(".banner-img-wrap").fadeIn(2000);
        },200);
        curIndex=index;
    }


    $(".banner .preNext.pre").click(function(){
        index--;
        if (index < 0) index = insize-1;
        show(index);
        window.clearInterval(int);
        int=setInterval("autoSlide()",slideTime);
    });
    $(".banner .preNext.next").click(function(){
        index++;
        if (index > insize-1) index = 0;
        show(index);
        window.clearInterval(int);
        int=setInterval("autoSlide()",slideTime);
    });

    //Banner End

    //通用输入框提示交互
    $(function(){
        $(':text[def],textarea[def]').each(function(){
            var me = $(this);
            var def = me.attr('def');
            if(me.val() == '' || me.val() == def){
                me.val(def);
                me.addClass("ipt-tip");
            }
            me.focus(function(){
                if(this.value == def){
                    this.value = '';
                }
                me.removeClass("ipt-tip");
            });
            me.blur(function(){
                if(this.value == ''){
                    this.value = def;
                    me.addClass("ipt-tip");
                }else{
                    me.removeClass("ipt-tip");
                }

            });
        });
    });

   $(function(){
       $(window).bind('resize', function(){
           var home_city_wrap = $(".home-city-wrap");
           var y = $(window).height()/2-200;
           home_city_wrap.css({"top": y});
       });

	    //banner搜索hover
		$("#banner-search-btn").hover(function(){
			$(".banner-search-bg").addClass("banner-search-hover");
		},function(){
			$(".banner-search-bg").removeClass("banner-search-hover");
		});

   });



	$(function(){
		$(".all-city-btn").hover(function(){
			$(".all-city-list").show();
		},function(){
			$(".all-city-list").hide();
		});
		$(".all-city-list").hover(function(){
			$(".all-city-list").show();
		},function(){
			$(".all-city-list").hide();
		});
	});
	//点击更多弹出选择目的地
    $(function(){
         var hid = $(".home-city-wrap");
         var close = $(".home-tit > span.close");
         var btn = $(".home-more a");
         var info = $(".panel-subtle-dark h5 .info");
         var arr = [];
         info.each(function(){
            arr.push($(this).text());
         });
        btn.live("click",function(){
            var type = $(this).attr('type');
            var me = $(this);
            var id =parseInt(me.data("id"))-1;
            var csrf = $('#csrfToken').val();
            $(".home-tit .select").text(arr[id]);
            getList(type, csrf);
            hid.show();
        });
         close.live("click",function(){
            hid.hide();
         });
    });
    function getList(type, csrf)
    {
        $('.home-city-wrap').html('');

        $.ajax({
            'url':'<?php echo Yii::app()->createUrl('site/popCity'); ?>',
            'type':'post',
            'dataType':'html',
            'data':'type='+type+'&csrf='+csrf,
            'success':function(json){
              $('.home-city-wrap').html(json);
            },
            'error':function(){
              //alert('错误：提交失败!');
            }
        });
    }
</script>

<?php $this->endContent(); ?>
