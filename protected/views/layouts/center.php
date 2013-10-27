<?php
Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl.'/css/mycenter.css');
Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/mycent.js');
?>

<?php $this->beginContent('//layouts/base'); ?>

<!-- blue navigation-->
<!--回复后ajax组装数据 -->
<script  type="text/html" id="talk-reply">
	<li>
		<div class="comment-user-pic">
			<a href="{url}">
				<img alt="" src="{header}">
			</a>
		</div>
		<div class="comment-content">
			<a title="" target="_blank" href="{url}">{nickname}</a> 
			<span>{content}</span>
			<span class="verifing">您的评论正在审核中，别人暂时看不到您的评论。</span>
		</div>
	</li>
</script>
<script  type="text/html" id="talk-reply-comment">
	<li>
        <div class="comment-user-pic"><a href="{url}"><img src="{header}" alt="{nickname}"></a></div>
        <div class="comment-content">
        <a target="_blank" href="{url}">{nickname}</a>:{content}
        <p class="raiders-detail-time">09月09日 11:45</p>
        </div>
        <!--<a href="javascript:;" id="108" class="reply-comment">回复</a>-->
    </li>
</script>
<div class="main-nav-outter">
	<div class="main-nav">
		<ul class="main-nav-list">
			<li><a href="/">首页</a></li>
			<li class="current"><a href="<?php echo Dynamic::goUrl(U_ID,'center');?>">个人中心</a></li>
			<!--<li><a href="#">我的账户</a></li>-->
		</ul>
	</div>	
</div>
<!-- blue navigation-->
<div class="main-wrap clearfix pb10">

<?php echo $content;?>
</div>
<?php $this->endContent(); ?>
