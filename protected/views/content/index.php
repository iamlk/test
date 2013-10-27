<?php
Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl.'/css/mycenter.css');
//Yii::app()->clientScript->registerScriptFile('/js/mycent.js');  // 被屏蔽  leo
?>
<div class="path-links mt65">
   <?php echo $this->breadcrumbs->display(); ?>
</div>
<div class="main-wrap  help-center clearfix pb10">
	<div class="main-left">
        <div class="fl-alpha">
            <ul class="help-center-nav">
                <?php foreach($other as $optionGroup){ ?>
                <li class="selected">
                    <a href="javascript:;" class="title"><?php echo $optionGroup['title']; ?></a>
                    <ul class="sub-nav">
                        <?php foreach($optionGroup->siteOptions as $option){ ?>
                        
                       
                        
                        
                         <?php if(intval($option['is_code']) === 1): ?>
                        
                           <?php if($option['site_option_id'] != 36): ?>
                               <li class="select">
                               <a <?php if($option['site_option_id']==$_GET['id']) echo 'class="cur"'; ?> href="<?php eval($option['php_code']); echo $tmp; ?>"><?php echo $option['title']; ?></a>
                               </li>
                           <?php endif; ?>    
                            
                         <?php else: ?>
        				    <li class="select">
                            <a <?php if($option['site_option_id']==$_GET['id']) echo 'class="cur"'; ?> href="<?php echo Yii::app()->createUrl('content/index',array('id'=>$option['site_option_id'])); ?>"><?php echo $option['title']; ?></a>
                            </li>
                         <?php endif; ?>
                            
                       
                        <?php } ?>
                    </ul>
                </li>
                <?php } ?>
            </ul>
        </div>

		</div>

	<div class="main-right">
       <?php if($model['title']):?>
       <h3 class="cent-title"><?php echo $model['title']; ?></h3>
		<div class="simple">
			<p><?php echo str_ireplace('strong','b',$model['option_value']); ?></p>
		</div>
        <?php else:?>
        <h3 class="cent-title">没有您想要的帮助,不要乱来哟</h3>
        <?php endif;?>
        
	</div>

</div><!--.main-wrap end-->