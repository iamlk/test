		<div class="zyxbox martop0">
			<div class="zyxbox-tit1">
				<h3 class="tit-color1"><?php echo $question->question;?></h3>
				<p class="tit-line"></p>
			</div>
			<div class="zyxbox-content pad0">
                <div class="send-box">
                <h4 class="share-tit"><?php echo $question->addition;?></h4>
				<div class="share-bottom-wrap">
                    <span id="add_addition"><a href="javascript:;">问题补充</a></span>&nbsp;&nbsp;
					<span>回答(<a href="#div-answers"><?php echo $question->questionAnswerCount ?>个</a>)</span>&nbsp;&nbsp;
                    <span>悬赏(<?php echo $question->reward ?>积分)</span>
					<span class="indent132">提问者：<a href=""><?php echo $question->customer_name ?></a></span>
					<span class="indent15">到期时间：<?php echo $question->timeout ?></span>
				</div>
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'question-asks-form',
	'enableAjaxValidation'=>false,
)); ?>
<div id="addtion" style="display: none;">
<?php $this->widget("application.extensions.kindeditor.KindEditor",array('name'=>'question[addition]',
        'config'=>array('afterChange'=>"function() { K('#word_count').html(this.count('text')); }"))); ?>
        			<div class="send-tool">
        				您当前输入了 <span id="word_count">0</span> 个文字。
                        <span id="wealth-bar"> <label>增加悬赏</label>
                        <select name="question[reward]">
                        <option value="0">0</option>
                        <option value="5">5</option>
                        <option value="10">10</option>
                        <option value="15">15</option>
                        <option value="20">20</option>
                        <option value="30">30</option>
                        <option value="50">50</option>
                        <option value="80">80</option>
                        <option value="100">100</option>
                        </select>
                        </span>
        				<input type="button" id="send-msg" value="提交" tabindex="2" class="btn btn-send-msg"/>
        				<span id="send-tip"></span>
                    </div>
</div>
<?php $this->endWidget(); ?>
                </div>
                <p class="tit-line"></p>
			</div>
		</div>

		<div id="div-answers" class="zyxbox">
<?php if($question->questionAnswers){?>
			<div class="zyxbox-tit1">
				<h3 class="tit-color1">网友回答</h3>
				<p class="tit-line"></p>
			</div>
<?php foreach($question->questionAnswers as $answer){ ?>
			<div class="zyxbox-content pad0">
                <div class="send-box">
                <h4 class="share-tit"><?php echo $answer->answer;?></h4>
				<div class="share-bottom-wrap">
					<span><a onclick="return confirm('确定采纳该回答？');" href="<?php echo $this->createUrl('question/deal',array('qid'=>$question->question_id,'aid'=>$answer->question_answer_id));?>">采纳为最佳答案</a></span>&nbsp;&nbsp;
					<span class="indent132">回复：<a href=""><?php echo $answer->customerName ?></a></span>
					<span class="indent15">到期时间：<?php echo $answer->updated ?></span>
				</div>
                </div>
                <p class="tit-line"></p>
			</div>
<?php }}else{?>
			<div class="zyxbox-tit1">
				<h3 class="tit-color1">暂时没有回答</h3>
				<p class="tit-line"></p>
			</div>
<?php }?>
		</div>
<script type="text/javascript">
	$(function(){
	var txt = $('#content');
	var tip = $('#send-tip');
	var tiping = false;
    var show=true;
    $('#add_addition').click(function(){
        if(show){
            $('#addtion').show(1000);
            show=false;
        }else{
            $('#addtion').hide(1000);
            show=true;
        }
    });
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
            $('#question-asks-form').submit();
		}
	});
	txt.focus(function(){
		tip.fadeOut();
		tiping = false;
	});
});
</script>