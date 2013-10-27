
<link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/widget/uploader/uploader.css" />
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/widget/uploader/swfobject.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/widget/uploader/uploader.js"></script>
<div style="display:none;">
	<div id="mydialog">
		<div id="zyx-upload-wrap"><a class="add-new-album" href="javascript:;"><span id="test"></span></a></div>
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
			<a id="zyx-upload-again" href="javascript:;" class="blue">继续上传</a>
			<span id="zyx-upload-tip"></span>
			<a href="javascript:;" class="zyxbtn3 disabled" id="zyx-upload-start">
			上传</a>
		</div>
	</div>
</div>
<a href="javascript:;" id="add-new-album" class="add-new-album" data-for="review_result_photo">添加照片</a>
<span class="warnning">请至少上传1张照片。</span>
<ul class="upload-img-list" id="review_result_photo">
<?php foreach ($propertyPictures as $row) : ?>
	<li>
		<img src="<?php echo Yii::app()->assetManager->baseUrl.'/'.$row['path']; ?>" width="250" height="150" />
		<?php echo CHtml::hiddenField('PropertyPicture[path][]',$row['path'],array('id'=>null)); ?>
		<?php echo CHtml::textArea('PropertyPicture[note][]',$row['note'],array('id'=>null)); ?>
		<a href="javascript:;"  class="remove-item">删除</a>
	</li>
<?php endforeach; ?>
</ul>

<script type="text/html" id="li-template">
	<li>
		<img src="<?php echo Yii::app()->request->baseUrl; ?>{web_file}" width="250" height="150" />
		<?php echo CHtml::hiddenField('PropertyPicture[path][]','{img_path}',array('id'=>null)); ?>
		<?php echo CHtml::textArea('PropertyPicture[note][]','',array('id'=>null)); ?>
		<a href="javascript:;" class="remove-item">删除</a>
	</li>
</script>
