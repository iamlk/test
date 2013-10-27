<?php $this->beginContent('//layouts/base_detail'); ?>
<p class="p" style="font-size: 30px;color: red;margin: 10px;position: fixed;right: 30px;top: 40px"></p>
<div id="pro-detail" style="width:730px;">
    <div class="pro-detail-wrap">
        <div class="residence-detail-tit">
            <span>
                <a href="javascript:;"><?php echo $property->propertyAddendumLocal->title; ?></a>
                <br/>
                <em><?php echo Yii::t('property','产品编号'); ?>:<?php echo $property->property_id; ?></em>
            </span>

            <a href="<?php echo Yii::app()->createUrl('collect/it',array('type'=>Dynamic::PROPERTY,'id'=>$property->property_id)) ?>" id="test-add" class="zyxbtn1<?php if($this->isGuest)echo' fast-login'?>"><?php echo Yii::t('property','收藏'); ?></a>
            <a href="<?php echo Yii::app()->createUrl('share/it',array('type'=>Dynamic::PROPERTY,'id'=>$property->property_id)) ?>" id="test-share" class="zyxbtn1<?php if($this->isGuest)echo' fast-login'?>"><?php echo Yii::t('property','分享'); ?></a>
        </div>
        <div class="pro-detail-content">
                    <div class="pro-detail-list">
                        <?php  $propertyPictures = $property->propertyPictures;
                         //foreach ($property->propertyRooms as $r)
                          //$propertyPictures = array_merge($propertyPictures,$r->propertyPictures); ?>
                        <div class="residence-show clearfix mt55">
                            <?php echo $this->renderPartial('_gallery', array('propertyPictures'=>$propertyPictures)); ?>
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
                        
                        <?php include('_house.php'); ?>
                        <?php include('_rooms.php'); ?>
                        <?php include('_calendar.php'); ?>
                        <?php include('_extensions.php'); ?>
                        <?php include('_notice.php'); ?>
                        <?php include('_reviews.php'); ?>
                        <?php /**
                         echo $this->renderPartial('_house', array('property'=>$property)); ?>
                        <?php echo $this->renderPartial('_rooms', array('property'=>$property)); ?>
                        <?php echo $this->renderPartial('_calendar', array('property'=>$property)); ?>
                        <?php echo $this->renderPartial('_extensions', array('property'=>$property)); ?>
                        <?php echo $this->renderPartial('_notice', array('property'=>$property)); ?>
                        <?php echo $this->renderPartial('_reviews', array('property'=>$property)); */?>

                    </div>
        </div>
        <div class="pro-detail-bot">
            <em>|</em><a href="javascript:;" class="detail-bot-list">住所介绍</a>
            <em>|</em><a href="javascript:;" class="detail-bot-list">房间介绍</a>
            <em>|</em><a href="javascript:;" class="detail-bot-list">价格明细</a>
            <em>|</em><a href="javascript:;" class="detail-bot-list">公共设施</a>
            <em>|</em><a href="javascript:;" class="detail-bot-list">注意事项</a>
            <em>|</em><a href="javascript:;" class="detail-bot-list">购买者评论</a>

            <em>|</em>
        </div>
    </div>
</div>
<?php $this->endContent(); ?>