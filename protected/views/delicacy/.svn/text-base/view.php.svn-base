<?php
/* @var $this DelicacyController */
/* @var $model Delicacy */
Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl.'/css/mycenter.css');
Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl.'/css/page.css');
Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl.'/css/news_detail.css');

$this->breadcrumbs=array($model->food->city['name']=>array('city/index', 'cid'=>$model->food['city_id']),
                         $model->food['name']=>array('food/index', 'id'=>$model['food_id'],'cid'=>$model['city_id']),
                         '美食推荐'=>array('delicacy/index', 'id'=>$model['food_id'],'cid'=>$model['city_id']),
                         $model['title']);
?>
<script>
$(function(){
	$('#content-1').click(function(){
        var content = $('#comment-txt-3').val();
        var delicacy_id = $(this).attr("delicacy-id");
		addDelicacy(0, content, delicacy_id);
		return false;
	});

	$('.send-comment-4').click(function(){
	    var parent_id = $(this).attr("data-id");
        var content = $('#comment-txt-4').val();
        var delicacy_id = $(this).attr("delicacy-id");
		addDelicacy(parent_id, content, delicacy_id);
		return false;
	});

    $(".reply-comment").each(function(i){
        $(this).click(function(){
            var id = $(this).attr("id");
            var comment = $(".comment-form-wrap .send-comment-4");
            comment.attr("data-id",id);
            // alert(comment.attr("data-id"));
            $.popwin.show({content:'#comment-form-2'});
        })
    });

//	$('.fav').ajaxBind({},{
//		onSuccess:function(data,item){
//			if(data.state==1){
//				$(".fav").find('em').text(parseInt($(".fav").find('em').text())+1);
//			}
//		},
//		loading:false
//	});
//	$('.share').ajaxBind({},{
//		onSuccess:function(data,item){
//			if(data.state==1){
//				$(".share").find('em').text(parseInt($(".share").find('em').text())+1);
//			}
//		},
//		loading:false
//	});

   //点击回复滚动到留言窗口并获取焦点
	$(".reply").bind("click",function(){
	    var top = $("#comment-txt-3").offset().top;
		$("html,body").stop(false,true).animate({scrollTop:top},400);
		$("#comment-txt-3").focus();
	});

});
function addDelicacy(parent_id, content, delicacy_id){
               var csrfToken = $('#csrfToken').val() ;
               $.ajax({
                'url':'<?php echo Yii::app()->createUrl('delicacy/addDelicacy'); ?>',
                'type':'post',
                'dataType':'json',
                'data':'parent_id='+parent_id+'&content='+content+'&delicacy_id='+delicacy_id+'&YII_CSRF_TOKEN='+csrfToken,
                'success':function(json){
                    if(json.code == 1)
                    {
                        $("#comment-txt-3").val("");
                        $("#comment-txt-4").val("");
                        msgBoxShow(1, json.msg);
                        window.location.reload();
                    }else{
					    msgBoxShow(0, json.msg);
                    }
                },
                'error':function(){
                    alert('error');
                }
            });
}
</script>

<div class="undis" id="comment-form-2" style="width: 650px;height: 300px;">
  <div class="comment-form-wrap">
    <form>
      <textarea id="comment-txt-4"></textarea>
      <a class="btn send-comment-4" href="javascript:void(0)" data-id="" delicacy-id="<?php echo $model['delicacy_id']; ?>">评论</a>
    </form>
  </div>
</div>

<div class="main-wrap clearfix pb10">
	<div class="news-detail">
         <h2 class="news-tit"><?php echo $model->addendum['title']; ?></h2>
         <div class="raiders-detail-time">
            <p class="raiders-bot">
            <a class="reply" href="javascript:;">回复(<em><?php echo $model['reviewCount']; ?></em>)</a>
            <i>|</i>
            <a href="<?php echo Yii::app()->createUrl('collect/it',array('type'=>Dynamic::DELICACY,'id'=>$model['delicacy_id'])) ?>" class="<?php if(U_ID!=0)echo 'ajax-item '; ?>comment fav<?php if($this->isGuest)echo' fast-login'?>">收藏(<em><?php echo $model['favoriteCount']; ?></em>)</a>
            <i>|</i>
            <a href="<?php echo Yii::app()->createUrl('share/it',array('type'=>Dynamic::DELICACY,'id'=>$model['delicacy_id'])) ?>" class="<?php if(U_ID!=0)echo 'ajax-item '; ?>share<?php if($this->isGuest)echo' fast-login'?>">分享(<em><?php echo $model['shareCount']; ?></em>)</a>
            </p>
        </div>
        <br />
        <div class="news-content"><?php echo $model->addendum['content']; ?></div>
        <div class="news-page">
        <?php IF(!empty($up_delicacy)){ ?>
            <p class="page-left"><span>上一篇：</span>
            <a href="<?php echo $this->createUrl('delicacy/view',array('id'=>$up_delicacy->addendum['delicacy_id'],'cid'=>$up_delicacy->food['city_id'])); ?>"><?php echo $up_delicacy->addendum['title']; ?></a></p>
        <?php } ?>
        <?php IF(!empty($down_delicacy)){ ?>
            <p class="page-right"><span>下一篇：</span>
            <a href="<?php echo $this->createUrl('delicacy/view',array('id'=>$down_delicacy->addendum['delicacy_id'],'cid'=>$down_delicacy->food['city_id'])); ?>"><?php echo $down_delicacy->addendum['title']; ?></a></p>
        <?php } ?>
        </div>
	</div>
    <div class="relatedt-news-wrap mt10">
        <h3 class="relatedt-news-tit">相关餐厅推荐</h3>
        <ul class="relatedt-news-info">
        <?php
        $i = 0;
        $point = ceil(count($other_delicacy)/2);
        foreach($other_delicacy as $item)
        {
            if($i++ == $point)
            {
                echo '</ul><ul class="relatedt-news-info last">';
            }
            echo '<li><span><a href="'.$this->createUrl('delicacy/view',array('id'=>$item->addendum['delicacy_id'],'cid'=>$item->food['city_id'])).'">'.$item->addendum['title'].'</a></span><label>浏览('.$item['visit'].')</label></li>';
        }
        ?>
        </ul>
    </div>
    <div class="raiders-detail-time">
      <p class="raiders-bot">
        <a class="reply" href="javascript:;">回复(<em><?php echo $model['reviewCount']; ?></em>)</a>
            <i>|</i>
            <a href="<?php echo Yii::app()->createUrl('collect/it',array('type'=>Dynamic::DELICACY,'id'=>$model['delicacy_id'])) ?>" class="<?php if(U_ID!=0)echo 'ajax-item '; ?>comment fav<?php if($this->isGuest)echo' fast-login'?>">收藏(<em><?php echo $model['favoriteCount']; ?></em>)</a>
            <i>|</i>
            <a href="<?php echo Yii::app()->createUrl('share/it',array('type'=>Dynamic::DELICACY,'id'=>$model['delicacy_id'])) ?>" class="<?php if(U_ID!=0)echo 'ajax-item '; ?>share<?php if($this->isGuest)echo' fast-login'?>">分享(<em><?php echo $model['shareCount']; ?></em>)</a>
      </p>
    </div>
    <div class="reply-box-show reply-box-new mt10">
      <div class="comment-form">
        <textarea id="comment-txt-3"></textarea>
        <a class="btn send-comment" id="content-1" href="javascript::void(0)" delicacy-id="<?php echo $model['delicacy_id']; ?>">留言</a>
      </div>
        <?php include('reviews.php'); ?>
    </div>
 </div>