<?php
Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/switchable.js');
Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/maxlength.js');
?>
<div>
<h3 class="h3-style YH under-line">相册名字 | 上传照片 | <a href="javascript:;" onclick="create_album()">创建相册</a></h3>
    <ul style="line-height: 40px;">
        <li id="place-guise">
            <table>
                <tr>
<?php foreach($albums as $album){?>
                    <td><a href="<?php echo $this->createUrl('center/album',array('id'=> $album->album_group_id)) ?>">
						<div class="img-wrap">
							<img width="100" height="100" src="<?php echo $album->cover ?>" />
                            <span class="file-wrap"> <em><?php echo $album->title ?></em></span>
						</div>
					</a></td>
<?php }?>
                </tr>
            </table>
           </li>
	</ul>

</div>
<script type="text/javascript">

</script>