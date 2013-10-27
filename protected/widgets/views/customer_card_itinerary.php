<div class="raiders-wrap-left">
    <ul class="raiders-user">
        <li>
        <h3>
        <?php echo CHtml::link($model->nick_name,Yii::app()->createUrl('people/index',array('u_id'=>$model->customer_id)))?>
        </h3>
        <a href="<?php echo Yii::app()->createUrl('people/index',array('u_id'=>$model->customer_id))?>" target="_blank">
        <img src="/thumb/48_48/<?php echo $model->avator?>" alt="<?php echo $model->nick_name; ?>" />
        </a>
        </li>
        <li>
        <label>所在地：</label>
        <span class="space"><?php echo $model->address?$model->address:'未知'; ?></span>
        </li>
    </ul>
</div>