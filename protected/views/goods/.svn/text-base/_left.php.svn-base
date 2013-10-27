<script>
    $(function(){
		<?php if(!$this->isGuest):?>
        $('#test-add').ajaxBind({},{loading:false});
		$('#test-share').ajaxBind({},{loading:false});
        <?php endif;?>
    })
</script>
<?php if($this->_goods->entity_type == 1 && $this->_product ):?>
<?php
/**
 * 短期行程处理
*/
$product = $this->_product;
?>
<div class="short-detail-tit">
    <span>
        <a href="javascript:void(0);"><?php echo $product->productStartCity->city->cityAddendum->name."&".$product->productAddendum->title; ?></a>
        <br/>
        <em>产品编号:<?php echo $this->_goods->code; ?></em>
    </span>

				<a href="<?php echo Yii::app()->createUrl('collect/it',array('type'=>Dynamic::PRODUCT,'id'=>$model->product_id)) ?>" id="test-add" class="zyxbtn1<?php if($this->isGuest)echo' fast-login'?>">收藏</a>
				<a href="<?php echo Yii::app()->createUrl('share/it',array('type'=>Dynamic::PRODUCT,'id'=>$model->product_id)) ?>" id="test-share" class="zyxbtn1<?php if($this->isGuest)echo' fast-login'?>">分享</a>
</div>
<div class="short-show clearfix">
<?php /** 图片外观显示 */ ?>
<?php $this->renderPartial('_product_gallery',array('product'=>$product)); ?>
</div>
<!--请设置行程后放入行程单  start-->
<?php
    
     $end_date = '';
     if($product->entity_type == 2)
     {
        // 多日
        $end_date = $product->productMultiDay->end_date;
     }
     else
     {
        $end_date = $product->productOneDay->end_date;
     }
      if($end_date>=time())
      {
        $this->Widget('application.widgets.ProductOrder',array('product_model'=>$product)); 
      }
      else
      {
         echo "<div>抱歉,此商品已过期</div>";
      }

       
?>
<?php  //$this->renderPartial('/product/_d_order_form',array('model'=>$product,'data'=>$data['data_time'])); ?>
<!--行程介绍  start-->
<?php   $this->renderPartial('/product/_d_base_desc',array('model'=>$product)); ?>
<!--价格明细  start-->
<?php   $this->renderPartial('/product/_d_price_detail',array('model'=>$product)); ?>
<!--出发时间/地点  start-->
<?php   //$this->renderPartial('/product/_d_start_time_zone',array('model'=>$product)); ?>
<!--注意事项  start-->
<?php   $this->renderPartial('/product/_d_attentions',array('model'=>$product)); ?>
<!--游客评论  start  -->
<?php   $this->renderPartial('/product/_d_comments',array('model'=>$product)); ?>
<!--问题咨询  start  -->
<?php   //$this->renderPartial('/product/_d_consulting'); ?>

<?php elseif($this->_goods->entity_type == 2 && $this->_property ):?>
<?php
/**
 * 住房处理
*/
$property = $this->_property;
?>
<div class="short-detail-tit">
    <span>
        <a href="javascript:void(0);"><?php echo $property->city->cityAddendum->name."&".$property->propertyAddendum->title; ?></a>
        <br/>
        <em>产品编号:<?php echo $this->_goods->code; ?></em>
    </span>

    <a href="<?php echo Yii::app()->createUrl('collect/it',array('type'=>Dynamic::PROPERTY,'id'=>$property->property_id)) ?>" id="test-add" class="zyxbtn1">收藏</a>
    <a href="<?php echo Yii::app()->createUrl('share/it',array('type'=>Dynamic::PROPERTY,'id'=>$property->property_id)) ?>" id="test-share" class="zyxbtn1">分享</a>
</div>
<div class="short-show clearfix">
<?php /** 图片外观显示 */ ?>
<?php $this->renderPartial('_property_gallery',array('property'=>$property)); ?>
</div>
<?php 
    $end_date = $property->propertyPrice->end_date;
    if(strtotime($end_date)>=time())
    {
        $this->Widget('application.widgets.PropertyOrder',array('property_model'=>$property)); 
    }
     else
    {
         echo "<div>抱歉,此商品已过期</div>";
    }
    
?>
<?php //echo $this->renderPartial('/property/property/_shopping', array('property'=>$property)); ?>
<?php echo $this->renderPartial('/property/property/_house', array('property'=>$property)); ?>
<?php echo $this->renderPartial('/property/property/_rooms', array('property'=>$property)); ?>
<?php echo $this->renderPartial('/property/property/_calendar', array('property'=>$property)); ?>
<?php echo $this->renderPartial('/property/property/_extensions', array('property'=>$property)); ?>
<?php echo $this->renderPartial('/property/property/_notice', array('property'=>$property)); ?>
<?php echo $this->renderPartial('/property/property/_reviews', array('property'=>$property)); ?>
<?php endif;?>