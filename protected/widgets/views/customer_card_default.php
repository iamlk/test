<div class="fr mt10">
    <div class="my-head-photo">
        <img alt="" src="/thumb/160_/<?php echo $model->avator;?>">
        <p><?php echo Customer::link($model->customer_id,array('target'=>'_blank','class'=>'more-info'));?></p>
        <p><?php echo CHtml::link('更多房东信息&gt;&gt;',Dynamic::goUrl($model->customer_id,'center'),array('class'=>'btn','target'=>'_blank'))?></p>
        
    </div>
    <ul>
        <li><label>回复率</label><strong>99%</strong></li>
        <li><label>回复及时性</label><strong>1天内</strong></li>
        <li><label>日历更新时间</label><strong>3天前</strong></li>
    </ul>
</div>