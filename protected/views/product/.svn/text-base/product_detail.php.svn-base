<?php $this->beginContent('//layouts/base_detail'); ?>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/product_detail.js"></script>
	<div  id="pro-detail" style="width:730px;">
		<div class="pro-detail-wrap">
			<div class="residence-detail-tit">
				<span>
					<a href=""><?php echo $model->addendum->title; ?></a>
					<br/>
					<em><?php echo Yii::t('property','产品编号'); ?>:<?php echo $model->goods->code; ?></em>
				</span>
				<a href="<?php echo Yii::app()->createUrl('collect/it',array('type'=>Dynamic::PRODUCT,'id'=>$model->product_id)) ?>" id="test-add" class="zyxbtn1<?php if($this->isGuest)echo' fast-login'?>">收藏</a>
				<a href="<?php echo Yii::app()->createUrl('share/it',array('type'=>Dynamic::PRODUCT,'id'=>$model->product_id)) ?>" id="test-share" class="zyxbtn1<?php if($this->isGuest)echo' fast-login'?>">分享</a>
			</div>
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
									<?php  include('_d_image_list.php');// $this->renderPartial('_d_image_list',array('images'=>$images)); ?>
								<?php endif;?>
							</div>
						</div>
					</div>
					<!--ad end-->
					</div>
					<!--请设置行程后放入行程单  start-->
					<?php
						$_date = 0;
						if($model->entity_type == Product::TOUR_MULTI_DAY){
							$_date = $model->productMultiDay->end_date;
						}else{
							$_date = $model->productOneDay->end_date;
						}
						if($_date>=time()):
					?>
					<?php  $this->Widget('application.widgets.ProductOrder',array('product_model'=>$model)); ?>
					<?php else: ?>
					<div class="book-wrap" style="color: orange;">
						商品时间设置已经过期
					</div>
					 <?php endif;?>
					<!--行程介绍  start-->
					<?php  include('_d_base_desc.php');// $this->renderPartial('_d_base_desc',array('model'=>$model)); ?>

					<!--价格明细  start-->
					<?php  include('_d_price_detail.php');// $this->renderPartial('_d_price_detail',array('model'=>$model)); ?>

					<!--出发时间/地点  start-->
					<?php  // 此处已屏蔽
					 if(false){ $this->renderPartial('_d_start_time_zone',array('model'=>$model));} ?>

					<!--注意事项  start-->
					<?php  include('_d_attentions.php');// $this->renderPartial('_d_attentions',array('model'=>$model)); ?>

					<!--游客评论  start  -->
					<?php  include('_d_comments.php');// $this->renderPartial('_d_comments',array('model'=>$model)); ?>

					<!--问题咨询  start  -->
					<?php  //include('_d_consulting.php');// $this->renderPartial('_d_consulting'); ?>

					<!--照片分享  start  -->
					<?php //include('_d_photo_sharing.php');//  $this->renderPartial('_d_photo_sharing'); ?>

					<!--查看地图  start  -->
					<?php //include('_d_view_map.php');//  $this->renderPartial('_d_view_map'); ?>

				</div>
			</div>
			<div class="pro-detail-bot">
				<em>|</em><a href="javascript:;" class="detail-bot-list">行程介绍</a>
				<em>|</em><a href="javascript:;" class="detail-bot-list">价格明细</a>
				<em>|</em><a href="javascript:;" class="detail-bot-list">注意事项</a>
				<em>|</em><a href="javascript:;" class="detail-bot-list">购买者评论</a>
			</div>
		</div>
	</div>
<?php $this->endContent(); ?>

