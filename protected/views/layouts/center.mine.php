<?php $this->beginContent('//layouts/center'); ?>
<!-- set widget-->
<?php $this->Widget('application.widgets.UserInfoWidget'); ?>
<!-- set widget-->
<?php require('center.mine.left.php');?>
<?php echo $content;?>
<?php $this->endContent(); ?>
