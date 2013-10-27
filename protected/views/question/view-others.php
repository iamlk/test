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

		<div id="div-answers" class="zyxbox">
			<div class="zyxbox-tit1">
				<h3 class="tit-color1">网友回答</h3>
				<p class="tit-line"></p>
			</div>
<?php
$form=$this->beginWidget('CActiveForm', array(
	'id'=>'answer-asks-form',
	'enableAjaxValidation'=>false,
));
if(Yii::app()->session['question_id'] != $question->question_id && Yii::app()->user->getIsGuest() || !$answered && !Yii::app()->user->getIsGuest()):
?>
			<div class="zyxbox-content">
                <div class="send-box">
			<h3><label for="msg-txt">我来帮他解答</label></h3>
        <?php if(Yii::app()->user->hasFlash('error')): ?>
            <h2 style="color: red;">
                <?php echo Yii::app()->user->getFlash('error'); ?>
            </h2>
        <?php endif; ?>
            <br />
<?php
$this->widget("application.extensions.kindeditor.KindEditor",array('name'=>'answer[answer]',
        'config'=>array('afterChange'=>"function() { K('#word_count').html(this.count('text')); }"))); ?>
        			<div class="send-tool">
        				您当前输入了 <span id="word_count">0</span> 个文字。
        				<input type="button" id="send-msg" value="回答" tabindex="2" class="btn btn-send-msg"/>
        				<span id="send-tip"></span>
                    </div>
		          </div>
			</div>
<?php
endif;
?>
<?php if($question->questionAnswers)foreach($question->questionAnswers as $answer){ ?>
        <div class="zyxbox-content pad0">
                <div class="send-box">
                <?php if($answer->customer_id == Yii::app()->user->getCustomer_id()){?>
                <h4 id="text_answer" class="share-tit"><?php echo $answer->answer;?></h4>
                <div id="edit_answer" style="display: none;"><?php $this->widget("application.extensions.kindeditor.KindEditor",array('value'=>$answer->answer,'name'=>'answer[answer]','width'=>'100%','height'=>200,
                'config'=>array('uploadJson'=>"'".$this->createUrl('KindEditor/upload_json')."'",
        'fileManagerJson'=>"'".$this->createUrl('KindEditor/file_manager_json')."'",
        'allowFileManager'=>'true','themeType'=>'"simple"','items'=>"['emoticons', 'image']",
        'afterChange'=>"function() { K('#word_count').html(this.count('text')); }",
        'newlineTag'=>'"br"'))); ?>
        			<div class="send-tool">
        				您当前输入了 <span id="word_count">0</span> 个文字。
        				<input type="button" id="send-msg" value="回答" tabindex="2" class="btn btn-send-msg"/>
        				<span id="send-tip"></span>
                    </div></div>
				<div class="share-bottom-wrap">&nbsp;&nbsp;
					<span><a onclick="editAgain();" href="javascript:;">重新编辑</a></span>&nbsp;&nbsp;
                <?php }else{ ?>
                <h4 class="share-tit"><?php echo $answer->answer;?></h4>
				<div class="share-bottom-wrap">&nbsp;&nbsp;
                <?php }?>
					<span class="indent132">回复：<a href=""><?php echo $answer->customerName ?></a></span>
					<span class="indent15">最后更新：<?php echo $answer->updated ?></span>
				</div>
			</div>
                <p class="tit-line"></p>
		</div>
<?php
}
$this->endWidget();
?>
	   </div>
<script type="text/javascript">
var show_edit = false;
function editAgain(){
    if(show_edit==true){
        $('#edit_answer').hide(1000);
        $('#text_answer').show(1000);
        show_edit=false;
    }else{
        $('#text_answer').hide(1000);
        $('#edit_answer').show(1000);
        show_edit=true;
    }
}
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