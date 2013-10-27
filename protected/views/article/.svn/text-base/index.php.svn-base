<link rel="shortcut icon" type="image/x-icon" href="/favicon.ico"  />

<?php Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl.'/css/companion.css'); ?>
<?php Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl.'/css/page.css'); ?>
<?php Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl.'/widget/zyxcalendar/zyxcalendar.css'); ?>
<?php Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl.'/widget/popwin/popwin.css'); ?>


<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/base.js"></script>
<script type="text/javascript" src="js/lib.js"></script>
<script type="text/javascript" src="widget/zyxcalendar/zyxcalendar.js"></script>


<script src="widget/popwin/popwin.js" type="text/javascript"></script>

<?php
$this->breadcrumbs=array($city['name']=>array('city/index', 'cid'=>$city['city_id']),
                         '热门攻略');
?>
    <div class="zyxbox martop0">
        <div class="zyxbox-tit3 bt0">
            <h3 class="tit-color3">热门攻略</h3>

            <p class="tit-line"></p>
        </div>
        <div class="zyxbox-content">
            <ul class="raiders-list">
            <?php foreach($provider->getData() as $article){ ?>
                <li>
                    <a href="<?php echo $this->createUrl('article/view',array('id'=>$article->article->article_id)); ?>">
                    <?php //if(empty($article->article['image']))
                          //{
                            $preg = "/src=\"(.+?)\".*?/";
                            preg_match($preg,$article->article['content'],$matches);
                            $article->article['image'] = ltrim($matches[1],'/assets/');
                          //}
                    ?>
                    <img class="raiders-img" alt="<?php echo $article->article['title']; ?>" src="/thumb/180_130/<?php echo $article->article['image']; ?>" />
                    </a>
                    <div class="raiders-wrap">
                        <h2><a href="<?php echo $this->createUrl('article/view',array('id'=>$article->article->article_id)); ?>"><?php echo $article->article['title']; ?></a></h2>
                        <?php
                        $str = strip_tags($article->article['content']);
                        ?>
                        <p><?php echo mb_substr($str, 0, 100).'...'; ?></p>
                        <div class="raiders-bottom">
                            <span class="raiders-writer">作家：<?php echo Customer::link($article->article['customer_id']) ?></span>
                            <span class="raiders-time">发布时间：<em><?php echo date('Y-m-d H:i:s',$article->article['updated']); ?></em></span>
                        </div>
                    </div>
                </li>
            <?php } ?>
            </ul>
        <?php
        $this->widget('application.widgets.PageToolbar' , array('pagination'=>$provider->pagination, 'ajaxContainerId'=>'results-list','useAjax'=>true, 'route'=>'article/index'));
        ?>
        </div>
    </div>