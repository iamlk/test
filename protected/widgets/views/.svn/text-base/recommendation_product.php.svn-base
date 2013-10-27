<div class="zyxbox martop0">
  <div class="zyxbox-tit3">
    <h3 class="tit-color3">推荐短期行程<a href="<?php echo Yii::app()->createUrl('productList/index',array('city'=>$this->city_id)); ?>">更多</a></h3>
    <p class="tit-line"></p>
  </div>
  <div class="zyxbox-content">
    <ul class="next-city">
    <?php foreach($model as $item){ ?>
      <li>
        <a href="<?php echo Yii::app()->createUrl('goods/index',array('id'=>$item->goods_id)); ?>">
			<img alt="" width="114" height="80" src="/thumb/114_80/<?php echo $item->product->productImages[0]['path']; ?>" />
            <span><?php echo $item->product->productStartCity->city['name']; ?></span>
		</a>
        <p>
			<a href="<?php echo Yii::app()->createUrl('goods/index',array('id'=>$item->goods_id)); ?>">
				<?php echo strlen($item->product->productAddendum['title'])>10?mb_substr($item->product->productAddendum['title'],0,8).'...':$item->product->productAddendum['title']; ?>
			</a>
            <br />
			<span class="orange indent5">￥<?php echo $item['price']; ?></span>
		</p>
      </li>
    <?php } ?>
    </ul>
  </div>
</div>