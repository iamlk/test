		<div class="zyxbox martop0">
			<div class="zyxbox-tit1">
				<h3 class="tit-color1"><?php echo $question->question;?></h3>
				<p class="tit-line"></p>
			</div>
			<div class="zyxbox-content pad0">
                <div class="send-box">
                <h4 class="share-tit"><?php echo $question->addition;?></h4>
				<div class="share-bottom-wrap">&nbsp;&nbsp;
					<span>回答(<a href="#div-answers"><?php echo $question->questionAnswerCount ?>个</a>)</span>&nbsp;&nbsp;
                    <span>悬赏(<?php echo $question->reward ?>积分)</span>
					<span class="indent132">提问者：<a href=""><?php echo $question->customer_name ?></a></span>
					<span class="indent15">最后更新：<?php echo $question->updated ?></span>
				</div>
                </div>
                <p class="tit-line"></p>
			</div>
		</div>
<?php if($question->status==1){?>
        <div id="div-answers" class="zyxbox">
			<div class="zyxbox-tit1">
				<h3 class="tit-color1">问题已关闭</h3>
				<p class="tit-line"></p>
			</div>
		</div>
<?php }elseif($best_answer->answer){?>
		<div id="div-answers" class="zyxbox">
			<div class="zyxbox-tit1">
				<h3 class="tit-color1">最佳答案</h3>
				<p class="tit-line"></p>
			</div>
			<div class="zyxbox-content pad0">
                <div class="send-box">
                <h4 class="share-tit"><?php echo $best_answer->answer;?></h4>
				<div class="share-bottom-wrap">&nbsp;&nbsp;
					<span class="indent132">回复：<a href=""><?php echo $best_answer->customerName ?></a></span>
					<span class="indent15">最后更新：<?php echo $best_answer->updated ?></span>
				</div>
                </div>
                <p class="tit-line"></p>
			</div>
		</div>
<?php } if($question->questionAnswerCount){?>
		<div id="div-answers" class="zyxbox">
			<div class="zyxbox-tit1">
				<h3 class="tit-color1">其他答案</h3>
				<p class="tit-line"></p>
			</div>
<?php if($question->questionAnswers)foreach($question->questionAnswers as $answer){
if($answer->question_answer_id == $question->best_answer_id) continue;
?>
			<div class="zyxbox-content pad0">
                <div class="send-box">
                <h4 class="share-tit"><?php echo $answer->answer;?></h4>
				<div class="share-bottom-wrap">&nbsp;&nbsp;
					<span class="indent132">回复：<a href=""><?php echo $answer->customer_name ?></a></span>
					<span class="indent15">最后更新：<?php echo $answer->updated ?></span>
				</div>
                </div>
			</div>
<?php }?>
		</div>
<?php }?>
<script type="text/javascript">
	$(function(){
	var txt = $('#content');
	var tip = $('#send-tip');
	var tiping = false;
	$('#send-msg').click(function(){
		if(txt.val()==''){
			if(!tiping){
				tiping = true;
				tip.html('您一个字都没有写哦。');
				tip.fadeIn();
				setTimeout(function(){
					tip.fadeOut();
					tiping = false;
				},5000);
			}
            return false;
		}else{
            $('#answer-asks-form').submit();
		}
	});
	txt.focus(function(){
		tip.fadeOut();
		tiping = false;
	});
});
</script>