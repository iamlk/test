<script src="/js/product_list.js"></script>
<ul class="product-list">
    <?php $data = $dataProvider->getData(); if($data):  foreach ($data as $row) :  ?>
    <li>
        <h2><?php echo CHtml::link(CHtml::encode($row['title']),$this->createUrl('goods/index',array('id'=>$row['goods_id'])),array('target'=>'_blank')); ?></h2>
            <!--a href="javascript:;" onclick="showPropertyDetail(<?php echo $row['id']; ?>);" ><?php echo CHtml::encode($row['title']); ?></a></h2-->
         <img onclick="showPropertyDetail(<?php echo $row['id']; ?>);" class="product-img" alt="<?php echo $row['note'];?>" src="/thumb/132_107/<?php echo $row['path']; ?>" />
        <div class="product-wrap">
            <p class="product-des"><?php echo G4S::cut_string(strip_tags($row['description'])); ?></p>
            <div class="product-bottom">
                <span>
                    <?php echo $row['room'] ? CHtml::encode(Yii::t('property','{%u}个卧室',array('{%u}'=>$row['room']))).' | ':''; ?>
                    <?php echo $row['bathroom'] ? CHtml::encode(Yii::t('property','{%u}间浴室',array('{%u}'=>$row['bathroom']))).' | ':''; ?>
                    <?php echo $row['person'] ? CHtml::encode(Yii::t('property','入住{%u}人',array('{%u}'=>$row['person']))).' | ':''; ?>
                    <?php echo CHtml::encode($row['type']); ?>
                </span>
            </div>
          <p class="grade mt5"><span style="width:<?php echo $row['percentage'] ?>%">星级</span></p>
		  <p class="business-info">
			   <a href="<?php echo $this->createUrl("people/index",array('u_id'=>$row['userid'])) ?>"><img  alt="<?php echo $row['username']; ?>" title="<?php echo $row['username']; ?>" src="/thumb/20_20/<?php echo $row['face']; ?>" width="20" height="20" /></a>
			   <span class="name"><a href="<?php echo $this->createUrl("people/index",array('u_id'=>$row['userid'])) ?>"><?php echo $row['username']; ?></a></span>
		  </p>
		  <span color='orange' class="price"><?php echo "￥".$row['price']; ?></span>
            <a class="zyxbtn5" href="javascript:void(0)" onclick="showPropertyDetail(<?php echo $row['id']; ?>);">查看详情</a>
        </div>
    </li>
    <?php endforeach; ?>
    <?php else: ?>
     <li>

        <div class="product-wrap">
           O(∩_∩)O哈哈~  没有找到哦
        </div>
    </li>
    <?php endif;?>
</ul>
<div class="pager" style="float:right;" >

<?php
$this->widget('application.widgets.PageToolbar' , array('pagination'=>$dataProvider->pagination, 'route'=>'propertyList/index'));
?>
<?php
/** $this->widget('CLinkPager',array(
    'header'=>'',
    'firstPageLabel' => '首页',
    'lastPageLabel' => '末页',
    'prevPageLabel' => '上一页',
    'nextPageLabel' => '下一页',
    'pages' => $dataProvider->pagination,
    'maxButtonCount'=>13,
));
*/
?>
</div>

