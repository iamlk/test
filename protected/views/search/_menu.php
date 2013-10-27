<div class="main-left search-nav">
<?php if($this->_act == 'all'): ?>
    <a href="javascript:;" class="cur">全部（<span><?php echo array_sum($count); ?></span>）</a>
<?php else: ?>
    <a href="<?php echo $this->createUrl('search/index',array('key'=>$this->_key,'act'=>'all')); ?>" >全部（<span><?php echo array_sum($count); ?></span>）</a>
<?php endif; ?>




<?php if($count['city']): ?>
    <?php if($this->_act == 'city'): ?>
        <a href="javascript:;" class="cur" >目的地（<span><?php echo $count['city']; ?></span>）</a>
    <?php else: ?>
       <a href="<?php echo $this->createUrl('search/index',array('key'=>$this->_key,'act'=>'city')); ?>" >目的地（<span><?php echo $count['city']; ?></span>）</a>
    <?php endif; ?>
<?php endif; ?>

<?php if($count['attract']): ?>
    <?php if($this->_act == 'attract'): ?>
        <a href="javascript:;" class="cur" >景点（<span><?php echo $count['attract']; ?></span>）</a>
    <?php else: ?>
       <a href="<?php echo $this->createUrl('search/index',array('key'=>$this->_key,'act'=>'attract')); ?>" >景点（<span><?php echo $count['attract']; ?></span>）</a>
    <?php endif; ?>
<?php endif; ?>

<?php if($count['tour']): ?>

    <?php if($this->_act == 'tour'): ?>
        <a href="javascript:;" class="cur">行程（<span><?php echo $count['tour']; ?></span>）</a>
    <?php else: ?>
       <a href="<?php echo $this->createUrl('search/index',array('key'=>$this->_key,'act'=>'tour')); ?>" >行程（<span><?php echo $count['tour']; ?></span>）</a>
    <?php endif; ?>

<?php endif; ?>


<?php if($count['property']): ?>
    <?php if($this->_act == 'property'): ?>
         <a href="javascript:;" class="cur" >住所（<span><?php echo $count['property']; ?></span>）</a>
    <?php else: ?>
       <a href="<?php echo $this->createUrl('search/index',array('key'=>$this->_key,'act'=>'property')); ?>" >住所（<span><?php echo $count['property']; ?></span>）</a>
    <?php endif; ?>
<?php endif; ?>

<?php if($count['share']): ?>
    <?php if($this->_act == 'share'): ?>
        <a href="javascript:;" class="cur" >行程单（<span><?php echo $count['share']; ?></span>）</a>
    <?php else: ?>
       <a href="<?php echo $this->createUrl('search/index',array('key'=>$this->_key,'act'=>'share')); ?>" >行程单（<span><?php echo $count['share']; ?></span>）</a>
    <?php endif; ?>
<?php endif; ?>

<?php if($count['constract']): ?>
    <?php if($this->_act == 'constract'): ?>
       <a href="javascript:;" class="cur">攻略（<span><?php echo $count['constract']; ?></span>）</a>
    <?php else: ?>
       <a href="<?php echo $this->createUrl('search/index',array('key'=>$this->_key,'act'=>'constract')); ?>" >攻略（<span><?php echo $count['constract']; ?></span>）</a>
    <?php endif; ?>
<?php endif; ?>

<?php  /** 备注结伴贴已经暂时注销   add by leo **/ ?>
<?php  if(false): ?>
<?php if($this->_act == 'together'): ?>
    <a href="javascript:;" class="cur">结伴帖（<span><?php echo $count['together']; ?></span>）</a>
<?php else: ?>
   <a href="<?php echo $this->createUrl('search/index',array('key'=>$this->_key,'act'=>'together')); ?>" >结伴帖（<span><?php echo $count['together']; ?></span>）</a>
<?php endif; ?>

<?php endif;?>

<?php if($count['food']): ?>
    <?php if($this->_act == 'food'): ?>
        <a href="javascript:;" class="cur">美食（<span><?php echo $count['food']; ?></span>）</a>
    <?php else: ?>
       <a href="<?php echo $this->createUrl('search/index',array('key'=>$this->_key,'act'=>'food')); ?>" >美食（<span><?php echo $count['food']; ?></span>）</a>
    <?php endif; ?>
<?php endif; ?>
		
</div>