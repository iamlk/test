                    <ul id="comment-list">
<?php foreach($provider->getData() as $question){ ?>
						<li>
							<div class="ask" id="<?php echo 'ask_'.$question->question_id ?>">
								<p><?php echo $question->content ?></p>
								<div class="signature"><a class="btn-reply blue" href="javascript:;" data-default="<?php echo $question->question_id ?>">回复</a>&nbsp;<span><?php echo $question->customer->full_name ?></span><?php echo $question->created ?></div>
							</div>
                        </li>
       <?php foreach($question->questionAnswers as $answer){ ?>
						<div class="answer">
							<div class="arrow"></div>
							<div class="head-title">尊敬的客户，您好！感谢您对我们的支持。</div>
							<p><?php echo $answer->answer ?></p>
							<div class="signature"> <?php echo $answer->created ?><span><?php echo  Yii::t('sns','我') ?></span></div>
						</div>
      <?php }?>
<?php }?>
                    </ul>
<?php
$this->widget('application.widgets.PageToolbar' , array('pagination'=>$provider->pagination, 'ajaxContainerId'=>'results-list','useAjax'=>true, 'route'=>'question/questionSelf','routeParams'=>array('id'=>$user_id)));
?>