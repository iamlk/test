<?php
Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl.'/css/jquery.Jcrop.css');
Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/jquery.Jcrop.js');
?>
<div class="main-right">
	<h3 class="cent-title">修改头像</h3>
	<form action="./SaveNewHeaderImage" method="post" class="ajax-form-auth">
	   <div class="picture">
			<div class="preview">
            <?php if(!empty($user['avator']) && file_exists('./assets/'.$user['avator'])):?>
             <img src=" <?php echo '/thumb/160_160/'.$user['avator'];?>" alt="" width="160" height="160">
			
            <?php else:?>
           	<img src="/assets/userheader/defalut_header.png" alt="" width="160" height="160"/>
            <?php endif;?>
				<input type="hidden" name="realheader" id="realheader" />
			</div>
		   <div class="upload_image">
			   <a href="javascript:;" class="btn_addPic">
				   <span><em>+</em>添加图片</span>
				   <input type="file" tabindex="3" data-remote="./savetempimage" title="支持jpg、jpeg、gif、png格式，文件小于5M" size="3" name="pic" class="filePrew" id="filePrew">
			   </a>
			   <p>支持jpg, gif,png格式的图片，建议图片尺寸160*160，（小于5M） </p>
			   <p class="upload_btn"><span class="btn-line mycent-btn"><input type="submit" value="上传" name="yt0"></span></p>

		   </div>


	   </div>
	</form>
	<div id="upload_main_con" class="undis">
		<div class="upload_list">
			<div class="rel mb20">
				<img id="img_preview" src="" width="" height="" />
				<span id="preview_box" class="crop_preview"><img id="crop_preview" src="" /></span>
			</div>
			<div class="clear"></div>
			<form action="./crop" method="get" id="crop_form">
				<input type="hidden" id="x" name="x" />
				<input type="hidden" id="y" name="y" />
				<input type="hidden" id="w" name="w" />
				<input type="hidden" id="h" name="h" />
				<input type="hidden" id="bl" name="bl" />
				<div class="upload-submit">
					<span class="btn-line mycent-btn"><input type="submit" name="yt0" value="确认剪裁"></span>
				</div>
			</form>
		</div>
		<div id="img-upload-btn" class="undis">上传图片</div>
	</div>
</div>