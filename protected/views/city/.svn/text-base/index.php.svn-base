<?php
/* @var $this CityController */
/* @var $city CActiveDataProvider */
Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl.'/css/destination.css');
Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl.'/css/base.css');
$this->breadcrumbs = array($city['name']);
?>


    <div class="summary box">
      <div class="summary-wrap"> <img src="<?php echo '/thumb/250_180/'.$city['image']; ?>" alt="<?php echo $city['name']; ?>"  class="city-img"/>
        <div class="details">
          <div class="summary-title"><span><?php echo $city['name']; ?></span><a href="<?php echo $this->createUrl('city/view',array('cid'=>$city['city_id'])); ?>"><?php echo Yii::t('info', '更多详情'); ?>>></a></div>
          <p style="height: 180px;"><?php echo $city['description']?$city['description']:Yii::t('info', '暂时没有相关描述'); ?></p>
        </div>
      </div>
     
      <!--<div class="summary-attractions zyxbox">-->
      <?php
      if($city->attraction)
        {
          $i=1;
      ?>
      <div class="summary-attractions">
        <h2 class="summary-tit tit-color2"><?php echo Yii::t('info', '周边景点'); ?><a href="<?php echo Yii::app()->createUrl('attraction/list',array('cid'=>$city['city_id'])); ?>"><?php echo $city->attraction?Yii::t('info', '更多'):''; ?></a></h2>
        <ul class="summary-list attraction-list">
        <?php
          foreach($city->attraction as $item){
          if($i++>10)break;
        ?>
        <li>
			<a title="<?php echo $item['name']; ?>" href="<?php echo Yii::app()->createUrl('attraction/index',array('id'=>$item['attraction_id'], 'cid'=>$city['city_id'])); ?>">
				<img border="0" alt="<?php echo $item['name']; ?>" src="<?php echo '/thumb/100_70/'.$item['image']; ?>" style="width: 100px; height: 70px;" />
			</a>
			<p class="have-been-to">
				有(<?php echo $item->visitorCount?$item->visitorCount:0; ?>)人去过
			</p>
			<h3>
				<a title="<?php echo $item['name']; ?>" href="<?php echo Yii::app()->createUrl('attraction/index',array('id'=>$item['attraction_id'], 'cid'=>$city['city_id'])) ?>"><?php echo $item['name']; ?></a>
			</h3>
        </li>
        <?php } ?>
        </ul>
      </div>
      <?php } ?>
    </div>
    <?php if($propertys){ ?>
    <div class="zyxbox">
      <div class="zyxbox-tit1">
        <h3 class="tit-color1"><?php echo $city['name'].Yii::t('info', '度假公寓'); ?><a href="<?php echo Yii::app()->createUrl('propertyList/index',array('city'=>$city['city_id'])); ?>"><?php echo $propertys?Yii::t('info', '更多'):''; ?></a></h3>
        <p class="tit-line"></p>
      </div>
      <div class="zyxbox-content pad0">
        <ul class="flats-list">
        <?php foreach($propertys as $item){ ?>
          <li>
            <div class="flasts-wrap">
              <p class="flasts-tit"><a href="<?php echo Yii::app()->createUrl('goods/index', array('id'=>$item['goods_id'])); ?>"><?php echo $item->propertyAddendum['title']; ?></a></p>
              <?php echo $item->getValuation($item['property_id']); ?>
              <ul class="flats-img">
              <?php $i = 1;
                    foreach($item->propertyPictures as $picture){
                      if($i++>4)break;
                      if(!isset($a))
                      {
                        $a = true;
                        echo '<li class="flats-img-first"><a href="'.Yii::app()->createUrl('goods/index', array('id'=>$item['goods_id'])).'"><img src="/thumb/118_106/'.$picture['path'].'" alt="'.$item->propertyAddendum['title'].'" /></a></li>';
                      }else{
                          echo '<li><a href="'.Yii::app()->createUrl('goods/index', array('id'=>$item['goods_id'])).'"><img src="/thumb/75_50/'.$picture['path'].'" alt="'.$item->propertyAddendum['title'].'" /></a></li>';
                      }
                    }
                      unset($a);
             ?>
              <li class="flats-img-more"><a href="<?php echo Yii::app()->createUrl('goods/index', array('id'=>$item['goods_id'])); ?>">...</a></li>
              </ul>
            </div>
          </li>
        <?php } ?>
        </ul>
      </div>
    </div>
    <?php } ?>
    <?php if($products){ ?>
    <div class="zyxbox">
      <div class="zyxbox-tit1">
        <h3 class="tit-color1"><?php echo $city['name'].Yii::t('info', '短期行程'); ?><a href="<?php echo Yii::app()->createUrl('productList/index',array('city'=>$city['city_id'])); ?>"><?php echo $products?Yii::t('info', '更多'):''; ?></a></h3>
        <p class="tit-line"></p>
      </div>
      <div class="zyxbox-content">
        <ul class="stroke-list">
        <?php foreach($products as $item){ ?>
          <li><a class="stroke-pic" title="<?php echo $item->productAddendum->title; ?>" href="<?php echo Yii::app()->createUrl('goods/index', array('id'=>$item['goods_id'])); ?>"><img border="0" alt="<?php echo $item->productAddendum->title; ?>" src="<?php echo '/thumb/73_47/'.$item->productImages[0]->path; ?>" /></a>
            <p class="stroke-info"> <a title="<?php echo $item->productAddendum->title; ?>" href="<?php echo Yii::app()->createUrl('goods/index', array('id'=>$item['goods_id'])); ?>"><?php echo $item->productAddendum->title; ?></a><span>￥<?php echo $item->goods->price; ?></span></p>
          </li>
        <?php } ?>
        </ul>
      </div>
    </div>
    <?php } ?>
    <?php $this->Widget('application.widgets.ItineraryWidget',array('cid'=>$_GET['cid']))?>
    <?php if($city->article){
            $i = 0;
    ?>
    <div class="zyxbox">
      <div class="zyxbox-tit1">
        <h3 class="tit-color1"><?php echo $city['name'].Yii::t('info', '专家攻略'); ?><a href="<?php echo Yii::app()->createUrl('article/index', array('cid'=>$city['city_id'])); ?>"><?php echo $city->article?Yii::t('info', '更多'):''; ?></a></h3>
        <p class="tit-line"></p>
      </div>
      <div class="zyxbox-content">
        <ul class="raiders-list">
          <?php foreach($city->article as $item)
                  {
                    if(++$i > 2)break;
          ?>
          <li><img src="<?php echo '/thumb/180_130/'.$item->article['image']; ?>" alt="<?php echo $item->article['title']; ?>" class="raiders-img" />
            <div class="raiders-wrap">
              <h2><a href="<?php echo $this->createUrl('article/view',array('id'=>$item->article['article_id'])); ?>"><?php echo $item->article['title']; ?></a></h2>
              <?php
                $pattern="/<[img|IMG].*?src=[\'|\"](.*?(?:[\.gif|\.jpg|\.png]))[\'|\"].*?[\/]?>/";
                $str = strip_tags($item->article['content']);
                $content = preg_replace($pattern,' ',$str);
                ?>
              <p><?php echo mb_substr($content, 0, 100).'......'; ?></p>
              <div class="raiders-bottom"> <span class="raiders-name"><?php echo Yii::t('info', '专家') ?>：<a href="<?php echo Dynamic::goUrl($item->article['customer_id'],'center'); ?>"><?php echo $item->article->customer['nick_name']; ?></a></span> <span class="raiders-time"><?php echo Yii::t('info', '发布时间'); ?>：<em><?php echo date('Y-m-d', $item->article->created) ?></em></span> </div>
            </div>
          </li>
          <?php } ?>
        </ul>
      </div>
    </div>
    <?php } ?>
