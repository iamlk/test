<?php /* @var $this Controller */ ?>
<?php
$current_city = City::model()->findByPk($_GET['cid']);
?>
    <div class="litter-banner">
    	<ul id="slideshow1">
          <li class="active" style="display: block;">
    			<img width="1300" height="310"  alt="<?php echo $current_city['name']; ?>" src="<?php echo Yii::app()->assetManager->baseUrl.'/'.$current_city['image_top']; ?>">
          </li>
    	</ul>
    	<div class="banner-img-wrap1"></div>
      <div class="city-area">
        <div class="cicy-nav">
          <div class="all-city">
    			<p class="all-city-btn">所有目的地</p>
    	  </div>
<?php $this->Widget('application.widgets.RecommendationDestinationWidget'); ?>
    	  <div class="city-nav-list">
    		  <p class="city-title-pre">目的地</p>
    		  	<h3  class="city-title"><?php echo $current_city['name']; ?></h3>
    			<ul class="city-nav-details">
    				<li><a href="<?php echo $this->createUrl('propertyList/index',array('city'=>(int)$_GET['cid'])) ?>">度假公寓</a></li>
    				<li<?php if($this->getId()=='itinerary')echo ' class="select"';?> ><a href="<?php echo $this->createUrl('itinerary/index',array('cid'=>(int)$_GET['cid'])) ?>">行程单分享</a></li>
    				<li class="bottom"><a href="<?php echo $this->createUrl('productList/index',array('city'=>(int)$_GET['cid'])) ?>">短期行程</a></li>
    				<li class="bottom<?php if($this->getId()=='article')echo ' select';?>"><a href="<?php echo $this->createUrl('article/index',array('cid'=>(int)$_GET['cid'])) ?>">自由行攻略</a></li>
    			</ul>
    	  </div>
        </div>
      </div>
    </div>
