
<link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/base.css" />
<link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/widget/uploader/uploader.css" />
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/widget/uploader/swfobject.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/widget/uploader/uploader.js"></script>

<style type="text/css">
body{padding:10px;background:#FFF;}
.btn-center {clear: both;height: 25px;text-align: center;padding:10px 0;}
.photo-upload {margin-bottom: 10px;overflow: hidden;width: 743px;}
.photo-upload li {float: left;overflow: hidden;padding: 20px 0;width: 370px;}
.photo-upload li .pic {background: none repeat scroll 0 0 #FCFCFC;border: 1px solid #F0F0F0;height: 188px; margin: 0 auto;width: 250px;}
.photo-upload li .pic a {display: table-cell;height: 188px;text-align: center;vertical-align: middle;width: 250px;}
.photo-upload li .pic img {max-height: 188px; max-width: 250px;vertical-align: middle;}
.photo-upload li p { line-height: 22px;padding: 8px 0 0 23px;}
.photo-upload li label {color: #777;float: left;width: 36px;}
</style>


<?php
$this->beginWidget('zii.widgets.jui.CJuiDialog', array(
    'id'=>'mydialog',
    // additional javascript options for the dialog plugin
    'options'=>array(
        'title'=>'照片上传',
        'autoOpen'=>false,
        'draggable'=>false,
        'resizable'=>false,
        'modal'=>true,
		'width'=>'560'
    ),
));
?>
<div id="mydialog">
	<div id="zyx-upload-wrap"><a class="zyxbtn3" href="javascript:;"><span id="test"></span></a></div>
    <div id="zyx-upload-to-edit">
        <!--<p class="zyxbtn-wrap"><a class="zyxbtn3 indent20 ui-dialog-titlebar-close " href="javascript:;">关闭</a></p>-->
    </div>
</div>
<?php $this->endWidget('zii.widgets.jui.CJuiDialog'); ?>

<a href="javascript:;" onclick="$('#mydialog').dialog('open');" class="zyxbtn3" id="add-new-album">添加照片</a>

<form id="form_photo">
    <ul class="photo-upload" id="review_result_photo">
        <li>
            <div class="pic">
                <a target="_blank" href="<?php echo Yii::app()->request->baseUrl; ?>/images/product/20130609035113_218343_51511_detail_800_800.jpg">
                    <img width="250" height="188" src="<?php echo Yii::app()->request->baseUrl; ?>/images/product/20130609035113_218343_51511_detail_800_800.jpg" title="点击查看大图" />
                </a>
            </div>
            <p>
                <label>
                    <input type="hidden" class="zyx-ipt w150" value="20130609035113_218343_51511_detail_800_800.jpg"  name="image_name[]" />
                    标题：
                </label>
                <input type="text" value="" class="zyx-ipt w150" name="image_title[]" />
            </p>
        </li>
    </ul>
</form>



<script type="text/javascript">
$(function(){
	$('#test').uploader({
		serverUrl:'<?php echo Yii::app()->request->baseUrl; ?>/up.php',
		myclickDown:function(e){
			console.log(e);
		}
	});
    /*关闭*/
    $(".close").click(function(){
       // $(".ui-dialog,.ui-widget-overlay").hide();
    });
});

/*弹出层*/
$(function(){
    $('.add-new-album').click(function(){
        var photo_upload = $("#zyx-photo-upload");
        $.popwin.show({
            closeAfter:function(){
    			$('#test').uploader({

    			});
            },
            content:'#zyx-upload-wrap-pop'
        });
    });
});
</script>



</body>
</html>
