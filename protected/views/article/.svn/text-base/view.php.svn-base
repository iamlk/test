<?php Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl.'/css/mycenter.css'); ?>
<?php Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl.'/css/page.css'); ?>
<script>
$(function(){
	$('#content-1').click(function(){
        var content = $('#comment-txt').val();
        var article_id = $(this).attr("article-id");
		addArticle(0, content, article_id);
		return false;
	});

	$('.send-comment-2').click(function(){
	    var parent_id = $(this).attr("data-id");
        var content = $('#comment-txt-2').val();
        var article_id = $(this).attr("article-id");
		addArticle(parent_id, content, article_id);
		return false;
	});

    $(".reply-comment").each(function(i){
        $(this).click(function(){
            var id = $(this).attr("id");
            var comment = $(".comment-form-wrap .send-comment-2");
            comment.attr("data-id",id);
            // alert(comment.attr("data-id"));
            $.popwin.show({content:'#comment-form-2'});
        })
    });

    $(".raiders-detail-time a.delete").bind("click",function(){
         var obj = $(this);
         if(confirm("确定要删除吗？")){
              var id = obj.data("id");
            	obj.ajaxBind({data:{id:id},url:"<?php echo Yii::app()->createUrl('article/delete'); ?>"},{
            	    type:"auto",
            		onSuccess:function(data,item){
       		          msgBoxShow(data.state,data.reason);
                      window.location.href = "<?php echo Yii::app()->createUrl('myArticle/index'); ?>";
            		},
            		successMsg:false,
                    loading:false
               });
         }else{
             return false;
         }
    });

	/* $('.fav').ajaxBind({},{该部分已经集成整站ajax   请查阅base.js   通用ajax请求分享删除、收藏
		onSuccess:function(data,item){
			if(data.state==1){
				$(".fav").find('em').text(parseInt($(".fav").find('em').text())+1);
			}
		},
		loading:false
	});
	$('.share').ajaxBind({},{
		onSuccess:function(data,item){
			if(data.state==1){
				$(".share").find('em').text(parseInt($(".share").find('em').text())+1);
			}
		},
		loading:false
	}); */

   //点击回复滚动到留言窗口并获取焦点
	$(".reply").bind("click",function(){
	    var top = $("#comment-txt").offset().top;
		$("html,body").stop(false,true).animate({scrollTop:top},400);
		$("#comment-txt").focus();
	});



});

	$('#content-1').click(function(){
        var content = $('#comment-txt').val();
        var article_id = $(this).attr("article-id");
		addArticle(0, content, article_id);
		return false;
	});

function addArticle(parent_id, content, article_id){
               var csrfToken = $('#csrfToken').val() ;
               $.ajax({
                'url':'<?php echo Yii::app()->createUrl('article/addArticle'); ?>',
                'type':'post',
                'dataType':'json',
                'data':'parent_id='+parent_id+'&content='+content+'&article_id='+article_id+'&YII_CSRF_TOKEN='+csrfToken,
                'success':function(json){
                    if(json.code == 1)
                    {
                        $("#comment-txt-2").val("");
                        $("#comment-txt").val("");
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
      <textarea id="comment-txt-2"></textarea>
      <a class="btn send-comment-2" href="javascript:void(0)" data-id="" article-id="<?php echo $article['article_id']; ?>">评论</a>
    </form>
  </div>
</div>

<div class="main-wrap clearfix pb10 pt55">
    <h3 class="cent-title raiders-title"><a href="<?php echo Yii::app()->createUrl('people/index', array('u_id'=>$article['customer_id'])); ?>"><?php echo $article->customer['nick_name']; ?>的个人中心</a><em>&gt;</em><a href="<?php echo Yii::app()->createUrl('people/article', array('u_id'=>$article['customer_id'])); ?>">他的攻略</a><em>&gt;</em><?php echo $article['title']; ?></h3>
        <?php $this->Widget('application.widgets.CustomerCard',array('customer_id'=>$article->customer['customer_id'],'name'=>'itinerary'))?>
        <div class="raiders-wrap-right">
            <div class="my-raiders-list">


                <div class="raiders-wrap">
                    <h2><?php echo $article['title']; ?></h2>
                    <div class="raiders-detail-time">
                        <em>发布时间：</em>
                        <em><?php echo date('Y-m-d H:i:s',$article['updated']); ?></em> <em class="indent10">阅读：</em>(<em><?php echo $article['visit']; ?></em>)
                        <p class="raiders-bot">
                            <a class="reply" href="javascript:;">回复</a>(<em><?php echo $article['reviewCount']; ?></em>)
                            <i>|</i>
                            <a href="<?php echo Yii::app()->createUrl('collect/it',array('type'=>Dynamic::ARTICLE,'id'=>$article['article_id'])) ?>" class="<?php U_ID?'ajax-item ':''; ?>comment fav<?php if($this->isGuest)echo' fast-login'?>">收藏(<em><?php echo $article['favoriteCount']; ?></em>)</a>
                            <i>|</i>
                            <a href="<?php echo Yii::app()->createUrl('share/it',array('type'=>Dynamic::ARTICLE,'id'=>$article['article_id'])) ?>" class="<?php U_ID?'ajax-item ':''; ?>share<?php if($this->isGuest)echo' fast-login'?>">分享(<em><?php echo $article['shareCount']; ?></em>)</a>
                            <?php if(Yii::app()->user->customer_id==$article['customer_id']){ ?>
                            <i>|</i>
                            <a href="<?php echo Yii::app()->createUrl('article/update', array('id'=>$article['article_id'])); ?>">编辑</a>
                            <i>|</i>
                            <a href="javascript:;" class="delete" data-id="<?php echo $article['article_id']; ?>">删除</a>
                            <?php } ?>
                        </p>
                    </div>
                <?php echo $article['content']; ?>
                </div>
                <div class="raiders-wrap bd0">
                    <div class="raiders-detail-time">
                        <p class="raiders-bot">
                            <a class="reply" href="javascript:;">回复</a>(<em><?php echo $article['reviewCount']; ?></em>)
                            <i>|</i>
                            <a href="<?php echo Yii::app()->createUrl('collect/it',array('type'=>Dynamic::ARTICLE,'id'=>$article['article_id'])) ?>" class="<?php U_ID?'ajax-item ':''; ?>comment fav<?php if($this->isGuest)echo' fast-login'?>">收藏(<em><?php echo $article['favoriteCount']; ?></em>)</a>
                            <i>|</i>
                            <a href="<?php echo Yii::app()->createUrl('share/it',array('type'=>Dynamic::ARTICLE,'id'=>$article['article_id'])) ?>" class="<?php U_ID?'ajax-item ':''; ?>share<?php if($this->isGuest)echo' fast-login'?>">分享(<em><?php echo $article['shareCount']; ?></em>)</a>
                            <?php if(Yii::app()->user->customer_id==$article['customer_id']){ ?>
                            <i>|</i>
                            <a href="<?php echo Yii::app()->createUrl('article/update', array('id'=>$article['article_id'])); ?>">编辑</a>
                            <i>|</i>
                            <a href="javascript:;" class="delete" data-id="<?php echo $article['article_id']; ?>">删除</a>
                            <?php } ?>
                        </p>
                    </div>
                </div>
                <div class="reply-box-show reply-box-new">
                    <div class="comment-form">
                        <textarea id="comment-txt"></textarea>
                        <a class="btn send-comment" id="content-1" href="javascript::void(0)" article-id="<?php echo $article['article_id']; ?>">留言</a>
                    </div>
                    <?php include('reviews.php'); ?>
                </div>
            </div>
        </div>
</div>