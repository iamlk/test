    <!--inc.html-->
<head>
<?php
Yii::app()->clientScript->registerCsFile('/css/base.css',0);
Yii::app()->clientScript->registerCsFile('/widget/popwin/popwin.css',1);
Yii::app()->clientScript->registerCoreScript('jquery');
Yii::app()->clientScript->registerJsFile('/js/base.js',0);
Yii::app()->clientScript->registerJsFile('/js/jquery.validate.min.js',1);
Yii::app()->clientScript->registerJsFile('/js/lib.js',2);
Yii::app()->clientScript->registerJsFile('/widget/popwin/popwin.js',3);
?>
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
    <title><?php echo CHtml::encode($this->params['title'].$this->pageTitle); ?></title>
    <meta name="description" content="<?php echo CHtml::encode(mb_substr($this->params['description'],0,200)) ?>" />
    <meta name="robots" content="index,follow" />
    <link rel="shortcut icon" type="image/x-icon" href="/favicon.ico"  />
<script type="text/javascript">
    var CLIENTSTATUS = {
        "login":<?php echo $this->isGuest?'false':'true'?>,
        "lang":"<?php echo Yii::app()->getLanguage()?>",
        "serverTime":"<?php echo time()?>",
        "uid":"<?php echo (int)Yii::app()->user->customer_id?>"
    };
</script>

<!-- add by leo.yan  google analytics -->
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-43969963-1', '61.147.124.20:80');
  ga('send', 'pageview');

</script>

</head>
    <!--inc.html-->