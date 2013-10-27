<?php
Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/switchable.js');
Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/maxlength.js');
?>
<div>
<h3 class="h3-style YH under-line">我的相册 | 上传照片 | <a href="javascript:;" onclick="create_album()">创建相册</a></h3>
    <ul style="line-height: 40px;">
        <li id="place-guise">
            <table>
                <tr>
<?php foreach($albums as $i => $album){?>
                    <td><a href="<?php echo $this->createUrl('center/album',array('id'=> $album->album_group_id)) ?>">
						<div class="img-wrap">
							<img width="100" height="100" src="<?php echo $album->cover ?>" />
                            <span class="file-wrap"> <em><?php echo $album->title ?></em></span>
						</div>
					</a></td>
<?php
if(($i+1)%5==0) echo '</tr><tr>';
}
?>
                    <td>
						<div class="img-wrap" onclick="create_album()">
							<img width="100" height="100" src="/images/album/add_album_group.jpg" />
                            <span class="file-wrap"> <em>添加相册</em> </span>
						</div>
					</td>
                </tr>
            </table>
           </li>
	</ul>

</div>

<!--弹出层：创建相册-->
<div class="undis" id="album-box" style="width:600px;">
    <div class="popwin-inner">
        <h2 class="popwin-tit">创建相册</h2>
        <div class="apply-form">
            <p>
				<span class="label">相册名称：</span>
				<span class="con"><input type="text" class="zyx-ipt w200" id="album-title"/></span>
			</p>
            <p>
                <span class="label">相册描述：</span>
				<span class="con">
                    <textarea data-maxlength-tip="#reply-txt-num2" maxlength="200" id="replyto-con" rows="5" class="zyx-ipt reply-input limit-input"></textarea>
				</span>
            </p>
            <p>
                <span class="label">&nbsp;</span>
				<span class="con">
					<a id="replyto-submit" onclick="submit_created()" class="zyxbtn3" href="javascript:;">确定</a>
					<span id="replyto-tip" class="apply-tip"></span>
                    <span class="fr gray">您还可以输入<em class="charleft" id="reply-txt-num2"></em>字</span>
				</span>
            </p>
        </div>
    </div>
</div>
<!--弹出层：创建相册，结束-->
<script type="text/javascript">
function create_album(){
	$.popwin.show({
		content:'#album-box'
	});
}

function submit_created(){
    var t = $('#album-title').attr('value');
    var d = $('#replyto-con').val();
    $.post("<?php echo $this->createUrl('album/CreateAlbumGroup') ?>", { t: t, d: d },
	function (data, textStatus){
		if(data == 'ok'){
            window.location.reload();
		}else{
            $('#replyto-tip').html(data);
		}
	}, "json");
}
</script>