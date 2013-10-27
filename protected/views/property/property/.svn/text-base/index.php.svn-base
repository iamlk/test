<?php ?>

<table border='1' width="80%">
    <tr>
        <td>ID</td>
        <td>PID</td>
        <td>标题</td>
        <td>操作</td>
    </tr>
    <?php foreach ($dataProvider->getData() as $property) : ?>
        <tr>
            <td><?php echo $property->property_id; ?></td>
            <td><?php echo $property->parent_property_id; ?></td>
            <td><?php echo $property->propertyAddendum->title; ?></td>
            <td>
                <?php echo CHtml::link('预览',array('property/detail', 'property_id'=>$property->property_id)); ?>
                <?php echo CHtml::link('修改',array('property/preview', 'property_id'=>$property->property_id)); ?>
                <?php if ($property->isHouse() and $property->is_active) : ?>
                <?php echo CHtml::link('下架',array('property/inactive', 'property_id'=>$property->property_id)); ?>
                <?php endif; ?>
            </td>
        </tr>
    <?php endforeach; ?>
</table>

<div class="pager">
<?php $this->widget('CLinkPager',array(
    'header'=>'',
    'firstPageLabel' => '首页',
    'lastPageLabel' => '末页',
    'prevPageLabel' => '上一页',
    'nextPageLabel' => '下一页',
    'pages' => $dataProvider->pagination,
    'maxButtonCount'=>15,
));?>
</div>