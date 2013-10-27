
<?php  Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl.'/widget/uploader/uploader.css'); ?>
<?php  Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/widget/uploader/swfobject.js'); ?>
<?php  Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/widget/uploader/uploader.js'); ?>

<div class="main-right">
	<h3 class="cent-title"><a href="<?php echo $this->createUrl('album/index');?>">我的相册</a> <em>&gt;</em>图片上传</h3>
	<form action="<?php echo $this->createUrl('album/saveimages');?>" enctype="multipart/form-data">
	<div class="upload-photo-formwarp">
		<div class="upload-pic-form">
			<label>上传至</label>
			<select name="album_id">
            <?php foreach($data as $item):?>
            
             <?php if( $arr['aid'] == $item->album_id):?>
             
				<option value="<?php echo $item->album_id;?>"><?php echo $item->a_name;?></option>
              <?php endif;?>
              
              <?php if(empty($arr['aid'])):?>
             	<option value="<?php echo $item->album_id;?>"><?php echo $item->a_name;?></option>
              <?php endif;?>  
		    <?php endforeach;?>
			</select>
			<a  id="toolbar_add_album"  href="#">创建相册</a>
		</div>
		<!--相册列表-->
		<div class="my-photo-wrap">
			<ul id="upload-photo-list" class="clearfix my-photo-list">
				<li class="upload-btnli">
					<span class="choice-pic btn-line"><a href="javascript:;" class="add-new-photo" data-for="upload-photo-list">选择照片</a></span>
					<p>每次可上传50张照片哦~</p>
				</li>
			</ul>
		</div>
	</div>
	<p class="upload-more-photo"><span class="choice-pic btn-line"><input value="上传照片" type="submit" /></span><a href="javascript:;"  data-for="upload-photo-list" class="add-new-photo">继续添加</a></p>
	</form>
</div>
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
			<!--<a id="zyx-upload-again" href="javascript:;" class="blue">继续上传</a>-->
			<span id="zyx-upload-tip"></span>
			<a href="javascript:;" class="zyxbtn3 disabled" id="zyx-upload-start">
			上传</a>
		</div>
	</div>
</div>
<div id="create-album" style="display:none;">
	<form action="<?php echo $this->createUrl('album/createalbum');?>" method="POST">
		<ul>
			<li><label>相册名称：</label><input type="text" name="albumname"/></li>
			<li><label>相册描述：</label><textarea type="text" name="description"></textarea></li>
			<li><label></label><!--<a href="javascript:;" class="create">创建</a>--><input type="submit" value="创建"  class="create"/><a href="javascript:;" class="cancle">取消</a></li>
		</ul>
	</form>
</div>
<script>
	$(function(){
		$('#toolbar_add_album').ZYXlightbox({
			width:490,
			contentId:'create-album',
			contentType:'inline',
			title:'创建相册',
			onShow:function($stage, element, box){
				//priceCal(url);
				
				$stage.find('form').submit(function(){
				var url=$(this).attr('action');
					var data=creatData($('form'));
					$.ajax({
						url:url,
						data:data,
						dataType:'json',
						success:function(result){
							if(result.state=='success'){
								 location.href=location.href;
							}else{
								if($('#msg-box').length){
									$('#msg-box').addClass('error').show().html(result.reason);
								 }else{
									$('body').append($('<div id="msg-box" class="error">'+result.reason+'</div>'))
								 }
								 var t=setTimeout(function(){$('#msg-box').fadeOut(1000)},2000);
							}
						}
					});
					return false;
				});
				$stage.find('.cancle').click(function(){
					box.close();
				});
			}
		});
		$('.delete').live('click',function(){
			$(this).parent().remove();
			if($('#upload-photo-list li').length==1){
				$('.upload-more-photo').hide();
				$('.upload-btnli').show();
			};
		})
		$('select').ZYXselect();
		$('.add-new-photo').ZYXlightbox({//添加照片
		width:580,
		contentId:'mydialog',
		contentType:'inline',
		onShow:function($stage, element, box){
			$('#uploader-close').click(function(){
				box.close();
			});
			$('#test').uploader({
				serverUrl:'/up.php',
                //	serverUrl:'/album/savetempimages',
				//serverUrl:'http://www.sgc.zyx.com/up.php',
				myClickDown:function(data){
				    //console.log(data);
					if(!$('.upload-more-photo').is(':visible')){
						$('.upload-more-photo').show();
					$('#'+element.data('for')).find('.upload-btnli').hide();
					}
					$('#'+element.data('for')).prepend($.extendObj(data,$('#my-photo-temp').html()));
				}
			});
		},onClose:function(){
			infos=[];
		}
	});
	})
</script>
<script type="text/html" id="my-photo-temp">
	 <li>
		<a href="javascript:;" class="delete">删除照片</a>
		<img src="{web_file}" width="145" height="145" />
		<?php echo CHtml::hiddenField('ProductImages[path][]','{img_path}',array('id'=>'{img_path}')); ?>
		<?php echo CHtml::textField('ProductImages[title][]','未命名',array('id'=>null)); ?>
	</li>
</script>