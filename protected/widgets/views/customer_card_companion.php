<div class="zyxbox-content">
    <div class="my-info">
        <p class="avatar">
            <a href="#"><img src="images/common/avatar_default.gif" alt="" /></a>
        </p>
        <p><?php echo CHtml::link($model->full_name,$this->controller->createUrl('center/user',array('id'=>$model->customer_id)),array('target'=>'_blank','class'=>'more-info'));?></p>
        <p class="gray"><?php echo date('Y年m月d日',strtotime($model->created)) ?>注册</p>
        <p><a href="#">个人中心</a></p>
    </div>
</div>