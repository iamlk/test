<ul>
    <li>
        <a href="<?php echo $this->createUrl('property/info',array('property_id'=>Yii::app()->request->getParam('property_id'))); ?>" <?php if($act =='info'):?> class="cur" <?php endif;?> >详细信息<span></span></a>
    </li>
    
    <li>
   
    <a href="<?php echo $this->createUrl('property/price',array('property_id'=>Yii::app()->request->getParam('property_id'))); ?>" <?php if($act =='price'):?> class="cur" <?php endif;?> >价格设置<span></span></a>
 
    </li>
    
    <li>
   
    <a href="<?php echo $this->createUrl('property/attention',array('property_id'=>Yii::app()->request->getParam('property_id'))); ?>" <?php if($act =='attention'):?> class="cur" <?php endif;?> >注意事项<span></span></a>
  
        
    </li>
    
    <li>
    
    <a href="<?php echo $this->createUrl('property/other',array('property_id'=>Yii::app()->request->getParam('property_id'))); ?>" <?php if($act =='other'):?> class="cur" <?php endif;?> >其他信息<span></span></a>
   
        
    </li>
    <li>
    
    <a href="<?php echo $this->createUrl('property/contact',array('property_id'=>Yii::app()->request->getParam('property_id'))); ?>" <?php if($act =='contact'):?> class="cur" <?php endif;?> >您的联系方式<span></span></a>
   
        
    </li>
    
</ul>

<?php if(false): ?>

<ul>
    <li>
        <a href="<?php echo $this->createUrl('property/info',array('property_id'=>Yii::app()->request->getParam('property_id'))); ?>" <?php if($act =='info'):?> class="cur" <?php endif;?> >详细信息<span></span></a>
    </li>
    
    <li>
    <?php if(in_array(3,$step)): ?>
    <a href="<?php echo $this->createUrl('property/price',array('property_id'=>Yii::app()->request->getParam('property_id'))); ?>" <?php if($act =='price'):?> class="cur" <?php endif;?> >价格设置<span></span></a>
    <?php else: ?>
    <a href="javascript:void(0);" class="clicked" <?php if($act =='price'):?> class="cur" <?php endif;?> >价格设置<span></span></a> 
     <?php endif; ?>   
    </li>
    
    <li>
    <?php if(in_array(4,$step)): ?>
    <a href="<?php echo $this->createUrl('property/attention',array('property_id'=>Yii::app()->request->getParam('property_id'))); ?>" <?php if($act =='attention'):?> class="cur" <?php endif;?> >注意事项<span></span></a>
    <?php else: ?>
    <a href="javascript:void(0);"  class="clicked" <?php if($act =='attention'):?> class="cur" <?php endif;?> >注意事项<span></span></a>
    <?php endif; ?> 
        
    </li>
    
    <li>
     <?php if(in_array(5,$step)): ?>
    <a href="<?php echo $this->createUrl('property/other',array('property_id'=>Yii::app()->request->getParam('property_id'))); ?>" <?php if($act =='other'):?> class="cur" <?php endif;?> >其他信息<span></span></a>
    <?php else: ?>
    <a href="javascript:void(0);" class="clicked"  <?php if($act =='other'):?> class="cur" <?php endif;?> >其他信息<span></span></a>
    <?php endif; ?> 
        
    </li>
    <li>
     <?php if(in_array(5,$step)): ?>
    <a href="<?php echo $this->createUrl('property/contact',array('property_id'=>Yii::app()->request->getParam('property_id'))); ?>" <?php if($act =='contact'):?> class="cur" <?php endif;?> >您的联系方式<span></span></a>
    <?php else: ?>
    <a href="javascript:void(0);" class="clicked"  <?php if($act =='contact'):?> class="cur" <?php endif;?> >您的联系方式<span></span></a>
    <?php endif; ?> 
        
    </li>
    
</ul>

<?php endif; ?>