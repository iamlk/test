<?php
$_data = $_data?array($_data):$provider->getData();
foreach($_data as $data){
?>
<li>
	<div class="talk-user-pic"><a rel="@keke" target="_blank" href="#"><img alt="" src="/images/avatar1.jpg"/></a></div>
	<div class="talk-content">
		<span class="talk-icon-arrow"></span>
		<p class="talk-user-info">
			<a href="#" class="talk-user-name"><?php echo $data['customerName'];?></a>
             <?php echo $data['act'];
             if($data['action_type']>0){
                echo ' '.CHtml::link($data['action_title'],$data['actionUrl'],array('class'=>'talk-link','title'=>$data['action_title'])).' ';
             }
             echo $data['ext'];
             ?>
		</p>
		<div class="media-box" style="display: none;">
        <!--
			<a class="photo-share" href="#"><img alt="" src="images/share_pic.jpg"></a>
			<a class="photo-share" href="#"><img alt="" src="images/share_pic.jpg"></a>
			<a class="photo-share" href="#"><img alt="" src="images/share_pic.jpg"></a>
        --!>
		</div>
		<div class="msg-box">
			<?php echo $data['content'];?>
		</div>
		<div class="talk-info">
			<p class="talk-time"><?php echo $data['time'];?> 来自 <?php echo CHtml::link('自由行',$this->createUrl('/'));?></p>
			<p class="talk-function">
				<a hidefocus="true" class="reply" href="#">转发(<?php echo $data['republic'];?>)</a>
                <span>|</span>
                <a hidefocus="true" class="fav" href="#">收藏(<?php echo $data['favorite'];?>)</a>
                <span>|</span>
                <a hidefocus="true" class="comment" href="javascript:;">评论(0)</a>
			</p>
		</div>
		<div class="reply-box" style="display: none;">
			<div class="comment-form">
				<form action="">
					<a title="插入表情" class="icon-btn comment-face" href="#"></a>
					<textarea name="" id="comment-txt"></textarea>
					<a class="btn send-comment" href="#">评论</a>
					<p class="comment-function">
						<label for="and-reply"><input type="checkbox" name="" id="and-reply">同时转发到我的微博</label>
						<span id="comment-tip">sdfsdf</span>
					</p>
				</form>
			</div>
			<ul id="comment-list">
				<li>
					<div class="comment-user-pic"><a href="#"><img alt="" src="images/avatar2.jpg"></a></div>
					<div class="comment-content">
						<a title="王小小(@wangxiaoxiao)" target="_blank" href="#">王小小</a> 非常漂亮的云。
					</div>
					<a class="reply-comment" href="javascript:;">回复</a>
				</li>
				<li>
					<div class="comment-user-pic"><a href="#"><img alt="" src="images/avatar2.jpg"></a></div>
					<div class="comment-content">
						<a title="王小小(@wangxiaoxiao)" target="_blank" href="#">王小小</a> 非常漂亮的云。
						什么时候我一定要去看看…… 非常漂亮的云。
						什么时候我一定要去看看…… 非常漂亮的云。
						什么时候我一定要去看看…… 非常漂亮的云。
						什么时候我一定要去看看……
					</div>
					<a class="reply-comment" href="javascript:;">回复</a>
				</li>
				<li>
					<div class="comment-user-pic"><a href="#"><img alt="" src="images/avatar2.jpg"></a></div>
					<div class="comment-content">
						<a title="王小小(@wangxiaoxiao)" target="_blank" href="#">王小小</a> 非常漂亮的云。
					</div>
					<a class="reply-comment" href="javascript:;">回复</a>
				</li>
			</ul>
		</div>
	</div>
</li>
<?php }?>