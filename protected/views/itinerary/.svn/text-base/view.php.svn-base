<?php Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl.'/css/mycenter.css'); ?>
<?php Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl.'/css/page.css'); ?>
<script>
var itinerary_id = '<?php echo $it->itinerary_id?>';
function addReview(parent_id, content){
    if(content.trim()=='') {alert('请填写内容!');return;}
       var csrfToken = $('#csrfToken').val() ;
       $.ajax({
            'url':'<?php echo Yii::app()->createUrl('itinerary/addReview'); ?>',
            'type':'post',
            'data':'parent_id='+parent_id+'&content='+content+'&itinerary_id='+itinerary_id,
            'success':function(json){
                if(json.code = 1)
                {
                    if($('#msg-box').length)
                    {
                        $('#msg-box').removeClass('error').show().html("谢谢，发表评论成功，将在审核后显示！");
                    }else{
                        $('body').append('<div id="msg-box">谢谢，发表评论成功，将在审核后显示！</div>');
                    }
                    var t=setTimeout(function(){$('#msg-box').fadeOut(1000)},2000);
                    $.popwin.close();
                    $("#comment-txt-2").val("");
                    $("#comment-txt").val("");
                }else{
                    if($('#msg-box').length){
                        $('#msg-box').addClass('error').show().html("发布失败，请不要为空");
                    }else{
                        $('body').append($('<div id="msg-box" class="error">发布失败，请不要为空</div>'))
                    }
                    var t=setTimeout(function(){$('#msg-box').fadeOut(1000)},2000);
                }
    
    
            },
            'error':function(){
                alert('error');
            }
        });
}
$(function(){
    $('.favorite').ajaxBind({},{
		onSuccess:function(data,item){
			if(data.state=='1'){
				$('.favorite').next('em').text(parseInt(item.next('em').text())+1);
			}
		},
		loading:false
	});
    $('.share').ajaxBind({},{
		onSuccess:function(data,item){
			if(data.state=='1'){
				$('.share').next('em').text(parseInt(item.next('em').text())+1);
			}
		},
		loading:false
	});
    
	$('#content-1').click(function(){
        var content = $('#comment-txt').val();
		addReview(0, content);
		return false;
	});

	$('.send-comment-2').click(function(){
	    var parent_id = $(this).attr("data-id");
        var content = $('#comment-txt-2').val();
		addReview(parent_id, content);
		return false;
	});

    $(".reply-comment").each(function(i){
        $(this).click(function(){
            var id = $(this).attr("id");
            var comment = $(".comment-form-wrap .send-comment-2");
            comment.attr("data-id",id);
            $.popwin.show({content:'#comment-form-2'});
        })
    });
});
</script>
<div class="undis" id="comment-form-2" style="width: 650px;height: 300px;">
  <div class="comment-form-wrap">
    <form>
      <textarea id="comment-txt-2"></textarea>
      <a class="btn send-comment-2" href="javascript:void(0);" data-id="" >评论</a>
    </form>
  </div>
</div>

<div class="main-wrap clearfix pb10 mt55">
    <h3 class="cent-title raiders-title">
    <?php $this->breadcrumbs->display();?>
    </h3>
    <?php $this->Widget('application.widgets.CustomerCard',array('customer_id'=>$it->customer_id,'name'=>'itinerary'))?>
        <div class="raiders-wrap-right">
            <div class="my-raiders-list">
                <div class="raiders-wrap">
                    <h2><a href="javascript:;"><?php echo $it->title?></a></h2>
                    <div class="raiders-detail-time">
                        <em>发布时间：</em>
                        <em><?php echo date('Y-m-d H:i',$it->created)?></em> <em class="indent10">阅读：</em><em>(<?php echo $it->view_count?>)</em>
                        <p class="raiders-bot">
							<a href="javascript:;">回复</a>
							(<em><?php echo $it->reviewCount?></em>)
							<i>|</i>
							<a class="favorite" href="<?php echo $this->createUrl('collect/it',array('type'=>Dynamic::TRAVEL,'id'=>$it->itinerary_id)) ?>">收藏</a>
							(<em><?php echo SiteCoolCount::getShare(md5((Dynamic::TRAVEL).($it->itinerary_id))); ?></em>)
							<i>|</i>
							<a class="share" href="<?php echo $this->createUrl('share/it',array('type'=>Dynamic::TRAVEL,'id'=>$it->itinerary_id)) ?>">分享</a>
							(<em><?php echo SiteCoolCount::getFavorite(md5((Dynamic::TRAVEL).($it->itinerary_id))); ?></em>)
                        </p>
                    </div>
                   <div class="order-content">
                   <?php 
                    foreach($list as $i => $p):
                        if(!$p[1]) continue;
                   ?>
                        <div class="itinerary left-line-blue">
                            <em class="itinerary-icon"><?php echo ($i+1)?></em>
                            <h3 class="itinerary-num">
                                <span class="itinerary-num-indent">第<?php echo G4S::num2char($i+1)?>天 <?php echo $p[0] ?> 去往 <?php echo City::getCityName($p[1])?></span>
                            </h3>
                        </div>
                        <div class="product-wrap left-line-blue">
                       <?php 
                       foreach($p as $j=>$d):
                           if($j<=1) continue;
                           $product = $d->goods->{Goods::$goods_type[$d->entity_type]};
                           $json = json_decode($d->json,true);
                       ?>
                           <div class="product mt0">
                               <div class="product-des">
                                   <div class="fl">
                                       <a href=""><img width="164" height="108" src="<?php echo '/thumb/170_114/'.$json['img'];?>" /></a>
                                   </div>
                                   <div class="product-option-wrap">
                                       <ul class="product-option">
                                           <li class="first">
                                               <a href="<?php echo $this->createUrl('goods/index',array('id'=>$d->goods_id));?>">
                                                <?php echo $json['title']?>
                                               </a>
                                           </li>
                                            <?php if($d->entity_type==Goods::ENTITY_PROPERTY):?>
                                               <li >
                                                   <label>住宿介绍：</label>
                                                   <p class="itinerary-info">
                                                       <?php echo $product->addendum->description?>
                                                   </p>
                                               </li>
                                                
                                            <?php else:?>
                                           <li>
                                               <span class="product-time"><label>出发城市：</label><em><?php echo City::getCityName($product->productStartCity->city_id);?></em></span>
                                           </li>
                                           <li >
                                               <label>行程简述：</label>
                                               <p class="itinerary-info">
                                                    <?php echo $prodcut->addendum->description?>
                                               </p>
                                           </li>
                                            <?php endif?>
                                      </ul>
                                   </div>
                               </div>
                           </div>
                       <?php endforeach?>
                       </div>
                       <?php endforeach?>
                   </div>
                </div>
                <div class="raiders-wrap bd0">
                    <div class="raiders-detail-time">
                        <p class="raiders-bot"> 
							<a href="javascript:;">回复</a>
							(<em><?php echo $it->reviewCount?></em>)
							<i>|</i>
							<a class="favorite" href="<?php echo $this->createUrl('collect/it',array('type'=>Dynamic::TRAVEL,'id'=>$it->itinerary_id)) ?>">收藏</a>
							(<em><?php echo SiteCoolCount::getShare(md5((Dynamic::TRAVEL).($it->itinerary_id))); ?></em>)
							<i>|</i>
							<a class="share" href="<?php echo $this->createUrl('share/it',array('type'=>Dynamic::TRAVEL,'id'=>$it->itinerary_id)) ?>">分享</a>
							(<em><?php echo SiteCoolCount::getFavorite(md5((Dynamic::TRAVEL).($it->itinerary_id))); ?></em>)
                        </p>
                    </div>
                </div>
                    
                <div class="reply-box-show reply-box-new">
                    <div class="comment-form">
                        <textarea id="comment-txt"></textarea>
                        <a class="btn send-comment" data-id="1" id="content-1" href="javascript::void(0)" article-id="<?php echo $it->itinerary_id; ?>">留言</a>
                    </div>
                    <?php include('_review.php'); ?>
                </div>
            </div>
        </div>
</div><!--.main-wrap end-->