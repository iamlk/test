<?php

/*
$this->widget('zii.widgets.grid.CGridView', array(
            'id'=>'effectivepolicy-grid',
            'dataProvider'=>$dataProvider,
            'emptyText'=>'没有找到数据.',
            'nullDisplay'=>'-',
            'columns'=>array(
               
                array(
                    'name'=>'用户名',
                    'value'=>'$data["username"]',
                    'htmlOptions'=>array('style'=>'width:55px;')
                ),
                                array(
                    'name'=>'密码',
                    'value'=>'$data["password"]',
                    'htmlOptions'=>array('style'=>'width:55px;')
                ),
            ),
        ));

*/

?>
<ul>
<li><b>用户名----------------------------密码</b></li>
<?php foreach($dataProvider->getData() as $v): ?>
<li><?php echo $v['username'].'====================='.$v['password']; ?></li>
<?php endforeach;?>
</ul>

<div class="pager">
<?php $this->widget('CLinkPager',array(
    'header'=>'',
    'firstPageLabel' => '首页',
    'lastPageLabel' => '末页',
    'prevPageLabel' => '上一页',
    'nextPageLabel' => '下一页',
    'pages' => $dataProvider->pagination,
    'maxButtonCount'=>13,
));?>
</div>