<?php /* @var $this Controller */ ?>
<?php /* 社区.房子.基本 */ ?>
<?php Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl.'/css/creat_product.css');?>
<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/creat_product.js');?>
<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/kindeditor/kindeditor-min.js');?>
<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/kindeditor/lang/zh_CN.js');?>
<?php if(false){ ?>
<!--<textarea id='editor_id' name="ProductDescription[{0}][description]"></textarea>-->    
<?php } ?>
<?php $this->beginContent('//layouts/base.without.footer'); ?>
    <!--nav-->
    <?php //require('community.navigation.php');?>
    <div class="main-wrap">
        <div id="property" class="issue">
            <?php echo $content; ?>
        </div>
    </div>
<div class="property-shadow undis">	
	<div id="property-done">
		<a href="javascript:;" class="esc"></a>
		<h2>恭喜您，发布成功！</h2>
		<p><a href="" class="review">预览>></a></p>
		<p>
		<span class="btn-line property-btn">
			<a title="管理我的产品" href="" class="goods">管理我的产品</a>
		</span>	
		</p>
	</div>
</div>
<div style="display:none">
	<div id="price-view">
		<h3>价格详情<span>以下是客人在网站看到的每人需支付的金额。</span></h3>
		<p class="price-view-btn"><a href="javascript:;" class="prev">上一月</a><span><em id="year"><?php echo date('Y') ?></em>年<em id="month"><?php echo date('n') ?></em>月</span><a href="javascript:;" class="next">下一月</a></p>
		<ul id="cal-date"></ul>
	</div>
</div>
<div style="display:none;">
	<div id="mydialog">
		<div id="zyx-upload-wrap"><a class="add-new-album" href="javascript:;"><span id="photo-upload"></span></a></div>
		<div id="zyx-upload-to-edit">
			<p class="zyxbtn-wrap"><a class="zyxbtn3 indent20" style="display: none;" id="uploader-close" href="javascript:;" >现在就去编辑图片说明</a></p>
		</div>
		<div id="zyx-photo-upload">
			<div id="zyx-upload-head">
				<span class="name">照片名</span>
				<span class="status">状态</span>
				<span class="size">大小</span>
			</div>
		</div>
		<div id="zyx-upload-info">
			总计<span id="zyx-photo-count">0</span>
			张照片，共<span id="zyx-photo-sizes">0KB</span>
			<span id="zyx-upload-append"></span>
			<!--<a id="zyx-upload-again" href="javascript:;" class="blue">继续上传</a>-->
			<span id="zyx-upload-tip"></span>
			<a href="javascript:;" class="zyxbtn3 disabled" id="zyx-upload-start">
			上传</a>
		</div>
	</div>
</div>

<script type="text/html" id="product-description">
<div class="product-description">
	<h4>第{0}天</h4>
	<ul class="info-list">
		<li>
			<label>行程概述：<span>*</span></label>
    
			<input type="text" class="long" name="ProductDescription[{0}][name]" required="required" data-messages="required:行程概述不能为空" />
		</li>

        <li class="place-guise">
			<label>行程图片：<span>*</span></label>
			<div class="upload-img-wrap">
				<span class="file-wrap add-new-album">添加照片<input type="file" data-remote="/index.php?r=imageHelper/upload" name="ProductDescription[{0}][url_path]" / ></span>
				<span class="warnning">请至少上传1张照片。</span>
				<ul class="upload-img-list clearfix">

				</ul>
			</div>
		</li>
		<li>
			<label>行程详情：<span>*</span></label>
			<textarea name="ProductDescription[{0}][description]">请输入当天行程的详细介绍.</textarea>
            
		</li>
		<li>
			<label>入住酒店：<span>*</span></label>
			<input type="text" class="long" name="ProductHotel[{0}][name]" />
		</li>
		<li class="place-guise">
			<label>酒店图片：<span>*</span></label>
			<div class="upload-img-wrap">
				<a href="javascript:;" class="add-new-album add-hotel-img" data-for="review_result_photo_{0}" data-tempId="li-template"  name="HotelImages[{0}][path][]" >添加照片</a>
				<span class="warnning">请至少上传1张照片。</span>
				<ul class="upload-img-list clearfix" id="review_result_photo_{0}">

				</ul>
			</div>
		</li>
		<li>
			<label>酒店描述：<span>*</span></label>
			<textarea name="ProductHotel[{0}][desc]">请输入当天行程的详细介绍.</textarea>
		</li>
	</ul>
</div>
</script>

<script type="text/html" id="product-description2">
<div class="product-description">
	<h4>第{0}天</h4>
	<ul class="info-list">
		<li>
			<label>行程概述：<span>*</span></label>
			<input type="text"  class="long" name="ProductDescription[{0}][name]"  required="required" data-messages="required:行程概述不能为空"/>
		</li>

        <li class="place-guise">
			<label>行程图片：<span>*</span></label>
			<div class="upload-img-wrap">
				<span class="file-wrap add-new-album"><em>添加照片</em><input type="file" data-remote="/index.php?r=imageHelper/upload" name="ProductDescription[{0}][url_path]" / ></span>
				<span class="warnning">请至少上传1张照片。</span>
				<ul class="upload-img-list clearfix">

				</ul>
			</div>
		</li>
		<li>
			<label>行程详情：<span>*</span></label>
			<textarea name="ProductDescription[{0}][description]">请输入当天行程的详细介绍.</textarea>
		</li>
	</ul>
</div>
</script>
<script type="text/html" id="product-description1">
<div class="product-description">
	<h4>第{1}段</h4>
	<ul class="info-list">
		<li>
			<label>行程概述：<span>*</span></label>
			<input type="text" class="long" name="ProductDescription[{1}][{0}][name]" required="required" data-messages="required:行程概述不能为空" />
		</li>

        <li class="place-guise">
			<label>行程图片：<span>*</span></label>
			<div class="upload-img-wrap">
				<span class="file-wrap add-new-album">添加照片<input type="file" data-remote="/index.php?r=imageHelper/upload" name="ProductDescription[{1}][{0}][url_path]" / ></span>
				<span class="warnning">请至少上传1张照片。</span>
				<ul class="upload-img-list clearfix">

				</ul>
			</div>
		</li>
		<li>
			<label>行程详情：<span>*</span></label>
			<textarea name="ProductDescription[{1}][{0}][description]">请输入当天行程的详细介绍.</textarea>
		</li>
	</ul>
</div>
</script>
<script type="text/html" id="li-template">
	<li>
		<img src="<?php echo Yii::app()->request->baseUrl; ?>{web_file}" width="155" height="105" />
		<?php echo CHtml::hiddenField('ProductImages[path][]','{img_path}',array('id'=>'{img_path}','class'=>'include')); ?>
		<?php echo CHtml::textField('ProductImages[title][]','',array('id'=>null,'class'=>'include')); ?>
		<a href="javascript:;" class="remove-item">删除</a>
	</li>
</script>
<script type="text/html" id="li-template1">
	<li>
		<img src="<?php echo Yii::app()->request->baseUrl; ?>{web_file}" width="155" height="105" />
		<?php echo CHtml::hiddenField('{img_name}','{img_path}',array('id'=>'{img_path}','class'=>'include')); ?>
		<a href="javascript:;" class="remove-item">删除</a>
	</li>
</script>
<script type="text/html" id="extend-img">
		<li>
			<img src="{src}" width="155" height="105" alt="" />
			<input type="hidden" name="{img_path}" value="{file}"/ >
		</li>

</script>
<?php $this->endContent(); ?>
