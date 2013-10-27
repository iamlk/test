<!DOCTYPE HTML>
<html lang="<?php echo str_replace('_','-',Yii::app()->language);?>">
<?php require(dirname(__FILE__).DIRECTORY_SEPARATOR.'inc.html.php');?>
<body class="<?php echo @$this->params['body'];?>">
    <?php //require(dirname(__FILE__).DIRECTORY_SEPARATOR.'inc.header.php');?>
    <?php $this->renderDynamic('getHeader'); ?>

    <?php require(dirname(__FILE__).DIRECTORY_SEPARATOR.'inc.dev.php');?>

    <?php echo $content; ?>

    <?php require(dirname(__FILE__).DIRECTORY_SEPARATOR.'inc.footer.php');?>

</body>
</html>