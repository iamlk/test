		<div class="zyxbox">
			<div class="zyxbox-tit1">
				<h3 class="tit-color1">请将您的疑问告诉大家吧</h3>
				<p class="tit-line">
                </p>
			</div>
			<div class="zyxbox-content pad0">
                <div class="send-box">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'question-asks-form',
	'enableAjaxValidation'=>false,
    ));
?>
                <textarea tabindex="1" name="question[question]" id="msg-txt"></textarea>
                <div id="addtion" style="display: none; height:auto;">
<?php $this->widget("application.extensions.kindeditor.KindEditor",array('name'=>'question[addition]')); ?>
                </div>
        			<div class="send-tool">
        				<span id="add_addition"><a href="javascript:;">问题补充（选填）</a></span>
                        <span id="wealth-bar"> <label>积分悬赏</label>
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
        				<input type="button" id="send-msg" value="提问" tabindex="2" class="btn btn-send-msg"/>
        				<span id="send-tip"></span>
                    </div>
<?php $this->endWidget(); ?>
		          </div>
			</div>
		</div>
<script type="text/javascript">

	$(function(){
<?php if($error) echo 'alert("'.$error.'");'; ?>
	var txt = $('#msg-txt');
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