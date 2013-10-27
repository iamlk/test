<?php
/* @var $this RestaurantController */
/* @var $dataProvider CActiveDataProvider */
Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl.'/css/destination.css');
Yii::app()->clientScript->registerScriptFile('/js/switchable.js');

$this->breadcrumbs=array($dataProvider->city['name']=>array('city/index', 'cid'=>$dataProvider['city_id']),
                         $dataProvider['name']);
?>

    <div class="summary box">
      <div class="summary-wrap"><img src="<?php echo '/thumb/250_180/'.$dataProvider['image']; ?>" alt="<?php echo $dataProvider['name']; ?>" class="city-img" />
        <div class="details">
          <div class="summary-title"><span class="yahei"><?php echo $dataProvider['name']; ?></span><a href="<?php echo Yii::app()->createUrl('food/view',array('id'=>$dataProvider['food_id'],'cid'=>$dataProvider['city_id'])); ?>">更多详情>></a></div>
          <p style="height: 180px;"><?php echo mb_substr($dataProvider['description'], 0, 250); ?>...</p>
        </div>
      </div>
      <div class="summary-attractions zyxbox mt0 bd0">
        <h2 class="summary-tit">TOP10</h2>
        <ul class="summary-list" id="roll">
        <?php foreach($roll_all as $item){
              $label = trim($item->tableSchema->rawName ,'`');
        ?>
          <li> <a title="<?php echo $item['title']; ?>" href="<?php echo Yii::app()->createUrl($label.'/view', array('id'=>$item[$label.'_id'],'cid'=>$item->food['city_id'])); ?>"><img border="0" alt="" src="<?php echo '/thumb/102_72/'.$item['image']; ?>" /></a>
            <h3><a title="<?php echo $item['title']; ?>" href=""><?php echo $item['title']; ?></a></h3>
          </li>
          <?php } ?>
        </ul>
      </div>
    </div>
    <?php if($restaurant){ ?>
    <div class="zyxbox">
      <div class="zyxbox-tit4">
        <h3 class="tit-color4 tit-color1">推荐餐厅<a href="<?php echo Yii::app()->createUrl('restaurant/index',array('id'=>$dataProvider['food_id'],'cid'=>$dataProvider['city_id'])); ?>">更多推荐</a></h3>
        <p class="tit-line"></p>
      </div>
      <div class="zyxbox-content pad0">
        <ul class="flats-list">
          <?php foreach($restaurant as $item){ ?>
          <li class="last">
            <div class="flasts-wrap">
              <p class="flasts-tit"><a href="<?php echo Yii::app()->createUrl('restaurant/view', array('id'=>$item['restaurant_id'],'cid'=>$item->food['city_id'])); ?>"><?php echo $item['title'] ?></a></p>
              <ul class="flats-img">
              <li class="flats-img-first"><a href="<?php echo Yii::app()->createUrl('restaurant/view', array('id'=>$item['restaurant_id'],'cid'=>$item->food['city_id'])); ?>"><img src="<?php echo '/thumb/120_108/'.$item['image']; ?>" alt="" /></a></li>
                <?php
                $matches = array();
                $pattern = "/<[img|IMG].*?src=[\'|\"](.*?(?:[\.gif|\.jpg|\.png]))[\'|\"].*?[\/]?>/";
                preg_match_all($pattern, $item['content'], $matches);
                for($i=0;$i<3;$i++){ ?>
                <li><a href="<?php echo Yii::app()->createUrl('restaurant/view', array('id'=>$item['restaurant_id'],'cid'=>$item->food['city_id'])) ?>"><img src="<?php echo '/thumb/75_50/'.str_replace('/assets/','',$matches[1][$i]); ?>" alt="" /></a></li>
                <?php } ?>
                <li class="flats-img-more"><a href="<?php echo Yii::app()->createUrl('restaurant/view', array('id'=>$item['restaurant_id'],'cid'=>$item->food['city_id'])); ?>">...</a></li>
              </ul>
            </div>
          </li>
          <?php } ?>
        </ul>
      </div>
    </div>
    <?php } ?>
    <?php if($delicacy){ ?>
    <div class="zyxbox">
      <div class="zyxbox-tit4">
        <h3 class="tit-color4 tit-color1">推荐美食<a href="<?php echo Yii::app()->createUrl('delicacy/index',array('id'=>$dataProvider['food_id'],'cid'=>$dataProvider['city_id'])); ?>">更多推荐</a></h3>
        <p class="tit-line"></p>
      </div>
      <div class="zyxbox-content pad0">
        <ul class="flats-list">
          <?php foreach($delicacy as $item){ ?>
          <li class="last">
            <div class="flasts-wrap">
              <p class="flasts-tit"><a href="<?php echo Yii::app()->createUrl('delicacy/view', array('id'=>$item['delicacy_id'],'cid'=>$item->food['city_id'])); ?>"><?php echo $item['title'] ?></a></p>
              <ul class="flats-img">
              <li class="flats-img-first"><a href="<?php echo Yii::app()->createUrl('delicacy/view', array('id'=>$item['delicacy_id'],'cid'=>$item->food['city_id'])); ?>"><img src="<?php echo '/thumb/120_108/'.$item['image']; ?>" alt="" /></a></li>
                <?php
                $matches = array();
                $pattern = "/<[img|IMG].*?src=[\'|\"](.*?(?:[\.gif|\.jpg|\.png]))[\'|\"].*?[\/]?>/";
                preg_match_all($pattern, $item['content'], $matches);
                for($i=0;$i<3;$i++){ ?>
                <li><a href="<?php echo Yii::app()->createUrl('delicacy/view', array('id'=>$item['delicacy_id'],'cid'=>$item->food['city_id'])); ?>"><img src="<?php echo '/thumb/75_50/'.str_replace('/assets/','',$matches[1][$i]); ?>" alt="" /></a></li>
                <?php } ?>
                <li class="flats-img-more"><a href="<?php echo Yii::app()->createUrl('delicacy/view', array('id'=>$item['delicacy_id'],'cid'=>$item->food['city_id'])); ?>">...</a></li>
              </ul>
            </div>
          </li>
          <?php } ?>
        </ul>
      </div>
    </div>
    <?php } ?>
	
	
	<script type="text/javascript">
//我的发布滚动图片
    $(function(){
        var rollsize = $("#roll li").size();
        if(rollsize>5){
            $('#roll').bxCarousel({
                display_num: 5,
                move: 2,
                auto: true,
                margin: 8,
                auto_hover: true
            });
        }
    });
</script>
