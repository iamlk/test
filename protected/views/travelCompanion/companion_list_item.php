<ul class="complist">
<?php
foreach($provider->getData() as $companion){
?>
    <li>
        <h4 class="tit"><span class="tops">[置顶]</span><?php echo CHtml::link($companion->title,$this->createUrl('travelCompanion/view',array('id'=>$companion->travel_companion_id)),array('target'=>'_blank')) ?></h4>
        <p class="intro"><?php echo $companion->content ?></p>
        <p class="info">
        <?php echo CHtml::link($companion->customer_name,$this->createUrl('center/user',array('id'=>$companion->customer_id)),array('target'=>'_blank')) ?>
        <?php if($companion->customer_gender==Customer::GENDER_MALE) echo '先生';elseif($companion->customer_gender==Customer::GENDER_FEMALE) echo '女士';?> 回复(<span><?php echo $companion->travelCompanionReplyCount ?></span>) 查看(<span><?php echo $companion->click_num ?></span>)</p>
        <p class="update">发布于 <?php echo date('Y-m-d',strtotime($companion->created))?> 最后更新 <?php echo date('m-d H:i:s',strtotime($companion->updated)) ?></p>
    </li>
<?php }?>
</ul>
<?php
$this->widget('application.widgets.PageToolbar' , array('pagination'=>$provider->pagination, 'ajaxContainerId'=>'results-list','useAjax'=>true, 'route'=>'travelCompanion/companion'));
?>