    <script type="text/javascript" src="/js/jquery.ad-gallery.js"></script>
    <link rel="stylesheet" type="text/css" href="/css/jquery.ad-gallery.css"/>
<div style="overflow: hidden;width: 730px;margin: 0 auto;">
<p class="p" style="font-size: 30px;color: red;margin: 10px;position: fixed;right: 30px;top: 40px"></p>
<div  id="pro-detail" style="width:730px;">
    <div class="pro-detail-wrap">
        <div class="residence-detail-tit"><span><a href=""><?php echo $model->addendum->product_name; ?></a><br/><em><?php echo Yii::t('property','产品编号'); ?>:<?php echo $model->code; ?></em></span><a href="" class="zyxbtn1">放入行程单</a></div>
        <div class="pro-detail-content">
            <div class="pro-detail-list">
			    <div class="residence-show clearfix mt55">
				   <!--ad start-->
				   
					<div class="picShow show-photo">
						<div class="bigImg">
							<div class="imgWrap">
								<img class="showImg"  src="" alt=""/>
							</div>
							<div class="title"><p></p></div>
							<a href="javascript:;" class="prev">上一张</a>
							<a href="javascript:;" class="next">下一张</a>
						</div>
						<div class="listWrap">
							<a href="javascript:;" class="prev">上一张</a>
							<a href="javascript:;" class="next">下一张</a>
							<div class="imgListWrap">
								<?php   $images = $model->productImages; ?>
								<?php if($images):?>
									<?php   $this->renderPartial('_d_image_list',array('images'=>$images)); ?>
								<?php endif;?>
							</div>
						</div>
					</div>
                        <!--ad end-->
                </div>


			<!--请设置行程后放入行程单  start-->
			<?php   $this->renderPartial('_d_order_form',array('model'=>$model,'data'=>$data)); ?>

			<!--行程介绍  start-->
			<?php   $this->renderPartial('_d_base_desc',array('model'=>$model)); ?>

			<!--价格明细  start-->
			<?php   $this->renderPartial('_d_price_detail',array('model'=>$model)); ?>

			<!--出发时间/地点  start-->
			<?php   $this->renderPartial('_d_start_time_zone',array('model'=>$model)); ?>

			<!--注意事项  start-->
			<?php   $this->renderPartial('_d_attentions',array('model'=>$model)); ?>

			<!--游客评论  start  -->
			<?php //  $this->renderPartial('_d_comments'); ?>

			<!--问题咨询  start  -->
			<?php //   $this->renderPartial('_d_consulting'); ?>

			<!--照片分享  start  -->
			<?php //  $this->renderPartial('_d_photo_sharing'); ?>

			<!--查看地图  start  -->
			<?php   $this->renderPartial('_d_view_map'); ?>

            </div>
        </div>
        <div class="pro-detail-bot">
            <em>|</em><a href="javascript:;" class="detail-bot-list">行程介绍</a>
            <em>|</em><a href="javascript:;" class="detail-bot-list">价格明细</a>
            <em>|</em><a href="javascript:;" class="detail-bot-list">出发时间/地点</a>
            <em>|</em><a href="javascript:;" class="detail-bot-list">注意事项</a>
            <em>|</em><a href="javascript:;" class="detail-bot-list">游客评论</a>
            <em>|</em><a href="javascript:;" class="detail-bot-list">问题咨询</a>
            <em>|</em><a href="javascript:;" class="detail-bot-list">照片分享</a>
            <em>|</em><a href="javascript:;" class="detail-bot-list">查看地图</a>
            <em>|</em>
        </div>
    </div>
</div>
</div>