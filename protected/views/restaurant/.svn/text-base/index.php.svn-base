<?php
/* @var $this RestaurantController */
/* @var $provider CActiveDataProvider */
Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl.'/css/destination_list.css');
Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl.'/css/page.css');
Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl.'/css/base.css');
Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl.'/css/destination.css');

$this->breadcrumbs=array($food->city['name']=>array('city/index', 'cid'=>$food['city_id']),
                         $food['name']=>array('food/index', 'id'=>$food['food_id'],'cid'=>$food['city_id']),
                         '餐厅推荐');
?>
    <div class="zyxbox martop0">
      <div class="zyxbox-tit1">
        <h3 class="tit-color1">餐厅推荐</h3>
        <p class="tit-line"></p>
      </div>
      <div class="zyxbox-content">
      <ul class="raiders-list">
        <?php
        foreach($dataProvider->getData() as $restaurant){ ?>
        <li> <a href="<?php echo $this->createUrl('restaurant/View',array('id'=>$restaurant['restaurant_id'],'cid'=>$restaurant->food['city_id'])); ?>"><img src="<?php echo '/thumb/180_130/'.$restaurant['image']; ?>" alt="<?php echo $restaurant->addendum['title']; ?>" class="raiders-img" /></a>
          <div class="raiders-wrap">
            <h2><a href="<?php echo $this->createUrl('restaurant/View',array('id'=>$restaurant['restaurant_id'],'cid'=>$restaurant->food['city_id'])); ?>"><?php echo $restaurant->addendum['title']; ?></a></h2>
            <?php
            $pattern="/<[img|IMG].*?src=[\'|\"](.*?(?:[\.gif|\.jpg|\.png]))[\'|\"].*?[\/]?>/";
            $str = strip_tags($restaurant->addendum['content']);
            $content = preg_replace($pattern, '', $str);
            ?>
            <p><?php echo mb_substr($content, 0, 100).'......'; ?></p>
            <div class="raiders-bottom">
            <span class="raiders-name">专家：<a href="<?php echo Dynamic::goUrl($restaurant->customer['customer_id'],'center'); ?>"><?php echo $restaurant->customer['full_name']; ?></a></span>
            <span class="raiders-time">发布时间：<em><?php echo date('Y-m-d', $restaurant['created']); ?></em></span>
            </div>
          </div>
        </li>
        <?php } ?>
      </ul>
      <?php
      $this->widget('application.widgets.PageToolbar' , array('pagination'=>$dataProvider->pagination, 'ajaxContainerId'=>'results-list','useAjax'=>true, 'route'=>'article/index'));
      ?>
      </div>
    </div>