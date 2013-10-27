<ul class="raiders-list">
<?php
foreach($provider->getData() as $question){
?>
	<li>
		<div>
			<h2><?php echo CHtml::link($question->question,$this->createUrl('question/view',array('id'=>$question->question_id))) ?></h2>
			<div class="raiders-bottom">
				回答<em>(<?php echo $question->questionAnswerCount?>)</em>
				<span class="raiders-name">提问：<a href=""><?php echo $question->customer_name ?></a></span>
				<span class="raiders-time">更新时间：<em><?php echo $question->updated?></em></span>
			</div>
		</div>
	</li>
<?php }?>
</ul>
<?php
$this->widget('application.widgets.PageToolbar' , array('pagination'=>$provider->pagination, 'ajaxContainerId'=>'results-list','useAjax'=>true, 'route'=>'question/question'));
?>