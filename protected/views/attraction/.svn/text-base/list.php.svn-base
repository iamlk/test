<?php
/* @var $this attractionController */
/* @var $dataProvider CActiveDataProvider */
Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl.'/css/page.css');
Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl.'/css/base.css');
Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl.'/css/destination.css');

$this->breadcrumbs = array(City::model()->getCityName($_GET['cid'])=>array('city/index', 'cid'=>$_GET['cid']),
                           Yii::t('info', '景点列表'));
?>
    <div class="zyxbox martop0">
      <div class="zyxbox-tit1">
        <h3 class="tit-color1">景点列表</h3>
        <p class="tit-line"></p>
      </div>
      <div class="zyxbox-content">
      <ul class="raiders-list">
        <?php
            foreach($dataProvider->getData() as $attraction){
                ?>
        <li> <a href="<?php echo $this->createUrl('attraction/index',array('cid'=>$attraction['parent_id'],'id'=>$attraction['attraction_id'])) ?>"><img src="<?php echo '/thumb/180_130/'.$attraction['image']; ?>" alt="<?php echo $attraction['name']; ?>" class="raiders-img" /></a>
          <div class="raiders-wrap">
            <h2><a href="<?php echo $this->createUrl('attraction/index',array('cid'=>$attraction['parent_id'],'id'=>$attraction['attraction_id'])); ?>"><?php echo $attraction['name']; ?></a></h2>
            <?php
            $pattern="/<[img|IMG].*?src=[\'|\"](.*?(?:[\.gif|\.jpg|\.png]))[\'|\"].*?[\/]?>/";
            $str = strip_tags($attraction['content']);
            $content = preg_replace($pattern,'', $str);
            ?>
            <p><?php echo mb_substr($content, 0, 100).'......'; ?></p>
            <div class="raiders-bottom">
            <span>发布时间：<em><?php echo date('Y-m-d', $attraction['created']); ?></em></span>
            </div>
          </div>
        </li>
        <?php }?>
      </ul>
      <?php
      $this->widget('application.widgets.PageToolbar' , array('pagination'=>$dataProvider->pagination, 'ajaxContainerId'=>'results-list','useAjax'=>true, 'route'=>'attraction/list'));
      ?>
      </div>
    </div>