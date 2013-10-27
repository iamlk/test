<!DOCTYPE HTML>
<html lang="zh-CN">
<head>
    <meta charset="utf-8" />
    <title>发布结伴帖 - 四海网</title>
    <meta name="robots" content="nofollow" />
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/base.css" />
    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.js"></script>
    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/base.js"></script>


    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/widget/zyxcalendar/zyxcalendar.js" charset="utf-8"></script>
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/widget/zyxcalendar/zyxcalendar.css" />

    <style type="text/css">
        body{background:#FFF;min-width:inherit;}
        .companion{padding:10px;}
        .companion h3{height:25px;line-height:25px;font-size:14px;border-bottom:1px dashed #DBDBDB;}
        .companion h3 span{font-size:12px;font-weight:normal;color:#777;margin-left:5px;}
        .companion table{width:500px;margin:10px 0 10px 10px;}
        .companion table td{padding:3px 0;}
        .companion table td .label{color:#777;}
        .companion table td label{margin-right:5px;}
        .companion table td input{vertical-align:middle;}
        .companion .long{width:420px;}
        .companion .mid{width:200px;}
        .companion-more-tip{display:inline-block;width:15px;height:14px;overflow:hidden;background:url(/images/icon/question.gif) no-repeat;}
        .companion-send{width:90px;}


    </style>
</head>

<body>

<div class="companion">
    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id'=>'frm-companion-create',
        'focus'=>array($travelCompanion, 'title'),
    ));
    ?>
    <h3>结伴同游信息<span>（以下信息必填）</span></h3>
    <input name="TravelCompanion[customer_age]" type="hidden" id="customer_age" value="0" />
    <table>
        <tr>
            <td width="60"><span class="label">标题：</span></td>
            <td>
                <?php echo $form->textField($travelCompanion, 'title', array('id' => "comapnion-title", 'class' => 'zyx-ipt long', 'data-default' => '请为活动输入标题。', 'data-required'=>'true', 'data-error'=>'请为活动输入标题。')); ?>
                <div class="tip-holder"><?php if($form->error($travelCompanion, 'title')) echo '<span class="tip-error">'.strip_tags($form->error($travelCompanion, 'title')).'</span>'; ?></div>
            </td>
        </tr>
        <tr><td valign="top"><span class="label">旅游线路：</span></td>
            <td>
			<?php if($productName): ?>
            <span class="static">
                <?php echo CHtml::encode($productName) ?>
            </span>
			<?php endif ?>
				<?php echo $form->textArea($travelCompanion, 'content', array(
					'data-default' => '请输入你希望去的景点或路线。',
					'rows' => 3, 'id' => 'companion-tour',
					'class' => ($productName) ? 'hide zyx-ipt long' : 'zyx-ipt long',
					'data-required'=> ($productName) ?  'false' : 'true',
					'data-error'=>'请输入你希望去的景点或路线。',
				)); ?>
                <div class="tip-holder"><?php if($form->error($travelCompanion, 'content')) echo '<span class="tip-error">'.strip_tags($form->error($travelCompanion, 'content')).'</span>'; ?></div>
            </td>
        </tr>
        <tr>
            <td><span class="label">出行时间：</span></td>
            <td id="tourdate">
<?php
$product = Product::model()->findByPk($travelCompanion->product_id);
?>
<?php if($product->product_id>1 && $product->product_entity_type !=3) {
	echo '<select name="departure_date" id="departure_date" data-required="true" data-error="请选择出发日期。"></select>
		<script>
		$(function(){
			$("#departure_date").html(parent.$("#p-start-time-select").html());
		});</script>';
} else { ?>
                <?php echo $form->textField($travelCompanion, 'departure_date', array('class' => 'zyx-ipt calendar', 'id' => 'hope-start-date', 'data-required'=>'true', 'data-error'=>'请为选择出发日期。')); ?> -
                <?php echo $form->textField($travelCompanion, 'departure_date_end', array('class' => 'zyx-ipt calendar', 'id' => 'hope-end-date', 'data-required'=>'true', 'data-error'=>'请为选择出发日期。')); ?>
<?php } ?>
                <div class="tip-holder"><?php if($form->error($travelCompanion, 'departure_date') || $form->error($travelCompanion, 'departure_date_end')) echo '<span class="tip-error">'.strip_tags($form->error($travelCompanion, 'departure_date')), strip_tags($form->error($travelCompanion, 'departure_date_end')).'</span>'; ?></div>
            </td>
        </tr>
        <tr><td><span class="label">现有人数：</span></td>
            <td>
                <label>男</label>
                <?php
                echo $form->radioButton($travelCompanion, 'now_people_man', array('value' => 1, 'class' => 'boxradio','uncheckValue'=> NULL, 'checked'=>true));
                echo $form->radioButton($travelCompanion, 'now_people_man', array('value' => 2, 'class' => 'boxradio','uncheckValue'=> NULL));
                echo $form->radioButton($travelCompanion, 'now_people_man', array('value' => 3, 'class' => 'boxradio','uncheckValue'=> NULL));
                ?>
                <label>女</label>
                <?php
                echo $form->radioButton($travelCompanion, 'now_people_woman', array('value' => 1, 'class' => 'boxradio','uncheckValue'=> NULL));
                echo $form->radioButton($travelCompanion, 'now_people_woman', array('value' => 2, 'class' => 'boxradio','uncheckValue'=> NULL));
                echo $form->radioButton($travelCompanion, 'now_people_woman', array('value' => 3, 'class' => 'boxradio','uncheckValue'=> NULL));
                ?>
                <label>小孩</label>
                <?php
                echo $form->radioButton($travelCompanion, 'now_people_child', array('value' => 1, 'class' => 'boxradio','uncheckValue'=> NULL));
                echo $form->radioButton($travelCompanion, 'now_people_child', array('value' => 2, 'class' => 'boxradio','uncheckValue'=> NULL));
                echo $form->radioButton($travelCompanion, 'now_people_child', array('value' => 3, 'class' => 'boxradio','uncheckValue'=> NULL));
                ?>
				<div class="tip-holder"><?php if($form->error($travelCompanion, 'now_people_total')) echo '<span class="tip-error">'.strip_tags($form->error($travelCompanion, 'now_people_total')).'</span>'; ?></div>
            </td>
        </tr>

        <tr>
            <td>
                <span class="label">期望伴友：</span></td>
            <td>
                <label>男</label>
                <?php
                echo $form->radioButton($travelCompanion, 'hope_people_man', array('value' => 1, 'class' => 'boxradio','uncheckValue'=> NULL));
                echo $form->radioButton($travelCompanion, 'hope_people_man', array('value' => 2, 'class' => 'boxradio','uncheckValue'=> NULL));
                echo $form->radioButton($travelCompanion, 'hope_people_man', array('value' => 3, 'class' => 'boxradio','uncheckValue'=> NULL));
                ?>
                <label>女</label>
                <?php
                echo $form->radioButton($travelCompanion, 'hope_people_woman', array('value' => 1, 'class' => 'boxradio','uncheckValue'=> NULL, 'checked'=>true));
                echo $form->radioButton($travelCompanion, 'hope_people_woman', array('value' => 2, 'class' => 'boxradio','uncheckValue'=> NULL));
                echo $form->radioButton($travelCompanion, 'hope_people_woman', array('value' => 3, 'class' => 'boxradio','uncheckValue'=> NULL));
                ?>
                <label>小孩</label>
                <?php
                echo $form->radioButton($travelCompanion, 'hope_people_child', array('value' => 1, 'class' => 'boxradio','uncheckValue'=> NULL));
                echo $form->radioButton($travelCompanion, 'hope_people_child', array('value' => 2, 'class' => 'boxradio','uncheckValue'=> NULL));
                echo $form->radioButton($travelCompanion, 'hope_people_child', array('value' => 3, 'class' => 'boxradio','uncheckValue'=> NULL));
                ?>
				<div class="tip-holder"><?php if($form->error($travelCompanion, 'hope_people_total')) echo '<span class="tip-error">'.strip_tags($form->error($travelCompanion, 'hope_people_total')).'</span>'; ?></div>
            </td>

        </tr>
        <tr>
            <td>&nbsp;</td>
            <td>
                <?php echo $form->checkBox($travelCompanion, 'open_ended', array('value' => 1, 'uncheckValue'=> NULL)); ?>
                <span class="label">欢迎更多人申请结伴</span>
                <a href="javascript:void(0)" class="tooltip companion-more-tip">
                    <span class="tooltip-con">勾选后，当申请人数超过期望人数，“申请结伴”不会失效，仍然可以申请。</span>
                </a>
            </td>
        </tr>

        <tr>
            <td>
                <span class="label">支付方式：</span>
            </td>
            <td>
					<?php echo $form->radioButton($travelCompanion, 'who_payment', array('value' => 0, 'class' => 'boxradio', 'data-label' => 'AA制', 'checked'=>true, 'uncheckValue'=> NULL));?>
					<?php echo $form->radioButton($travelCompanion, 'who_payment', array('value' => 1, 'class' => 'boxradio', 'data-label' => '我支付', 'uncheckValue'=> NULL));?>
            </td>
        </tr>
    </table>

    <h3>我的基本信息<span>（以下信息非必填）</span></h3>
    <table>
        <tr>
            <td>
                <span class="label">姓名：</span>
            </td>
            <td>
                <label>
                    <?php echo $form->textField($travelCompanion, 'customer_name', array('class' => 'zyx-ipt', 'data-default' => '请输入姓名。')); ?>
                </label>
            </td>
        </tr>

        <tr>
            <td>
                <span class="label">性别：</span>
            </td>
            <td>
                <label for="sex_man">
                    <?php echo $form->radioButton($travelCompanion, 'customer_gender', array('value' => Customer::GENDER_MALE, 'class' => 'boxradio', 'id'=>'sex_man','uncheckValue'=> NULL, 'checked'=>true)); ?> 男
                </label>
                <label for="sex_woman">
                    <?php echo $form->radioButton($travelCompanion, 'customer_gender', array('value' => Customer::GENDER_FEMALE, 'class' => 'boxradio', 'id'=>'sex_woman','uncheckValue'=> NULL)); ?> 女
                </label>
                <div class="tip-holder"><?php echo $form->error($travelCompanion, 'customer_gender'); ?></div>
            </td>
        </tr>

        <tr>
            <td>
                <span class="label">邮箱：</span>
            </td>
            <td align="left" valign="top">
                <?php echo $form->textField($travelCompanion, 'email', array('class' => 'zyx-ipt mid', 'data-default' => '请输入您的电子邮箱。', 'data-required'=>'true', 'data-error'=>'Required', 'data-rule'=>'email', 'data-format-error'=>'Not a vlid email')); ?>
                <?php echo $form->checkBox($travelCompanion, 'companion_email_display', array('value' => 1,'uncheckValue'=> NULL)); ?>
                <label>保密</label>
                <span class="label">勾选后不公开邮箱地址</span>
                <div class="tip-holder"><?php echo $form->error($travelCompanion, 'email'); ?></div>
            </td>
        </tr>

        <tr>
            <td>
                <span class="label">电话：</span>
            </td>
            <td>
                <?php echo $form->textField($travelCompanion, 'phone', array('class' => 'zyx-ipt mid', 'data-default' => '请输入您的电话号码。')); ?>
                <?php echo $form->checkBox($travelCompanion, 'companion_phone_display', array('value' => 1,'uncheckValue'=> NULL)); ?>
                <label>保密</label>
                <span class="label">勾选后不公开电话号码</span>
            </td>
        </tr>

        <tr>
            <td valign="top">
                <span class="label">个人介绍：</span>
            </td>
            <td>
                <?php echo $form->textArea($travelCompanion, 'personal_introduction', array('data-default' => '请输入你的兴趣爱好或对结伴同游者的期望。', 'class' => 'zyx-ipt long', 'id' => 'personal_introduction', 'rows' => 3)); ?>
            </td>
        </tr>

        <tr>
            <td colspan="2">
                <span>
                    <label>
                        <input id="set-top" type="checkbox" name="set_top_box" value="1" /> 设置结伴帖置顶显示
                    </label>
                </span>
                <span id="set-top-info" style="display:none;" class="label">
                    (将扣除50积分/天)
					<?php echo $form->radioButton($travelCompanion, 'stick_num_days', array('checked'=>true,'value' => 1, 'uncheckValue'=> NULL)); ?> 1天
                    &nbsp;&nbsp;
                    <?php echo $form->radioButton($travelCompanion, 'stick_num_days', array('value' => 2,'uncheckValue'=> NULL)); ?> 2天
                    &nbsp;&nbsp;
                    <?php echo $form->radioButton($travelCompanion, 'stick_num_days', array('value' => 3,'uncheckValue'=> NULL)); ?> 3天
                </span>
            </td>
        </tr>

        <tr>
            <td colspan="2" align="center">
                <?php echo CHtml::submitButton('发布', array('class' => 'zyxbtn3 companion-send')); ?>
            </td>
            <?php echo $travelCompanion->firstError;?>
        </tr>
    </table>
    <?php $this->endWidget(); ?>
</div>

<script type="text/javascript">

    $(function(){
        $('.boxradio').boxradio();//调用模拟radio插件
		$('#hope-start-date,#hope-end-date').zyxCalendar({
			start:'d+1'
		});//调用日历控件

        var cbx = $('#set-top');
        var info = $('#set-top-info');
        var chkInfo = function(){
            if(cbx.is(':checked')){
                info.show();
            }else{
                info.hide();
            }
        };
        cbx.change(chkInfo);
        chkInfo();

        var title = $('#companion-title');
        var tour = $('#companion-tour');
        var hope_man = $('input[name="TravelCompanion[hope_people_man]"]');
        var hope_woman = $('input[name="TravelCompanion[hope_people_woman]"]');
        var hope_kid = $('input[name="TravelCompanion[hope_people_child]"]');

        $('#frm-companion-create').simpleValidate('#frm-companion-create input[type=submit]', function(){
            $.ajax({
                url:$('#frm-companion-create').attr('action'),
                type:'post',
                data:$('#frm-companion-create').serialize(),
                success:function(res){
                    try{
                        data = $.parseJSON(res);
						if(data.status == 'success') parent.$.popwin.success(data.html,'确定');
                        else if(data.status == 'error') $('#frm-errors').html(formatErrors(data.errors));
                        else parent.$.popwin.error(data.message, '确定');
                    }catch(e){
                        parent.$.show(data);
                    }
                },
                error:function(){
                    parent.window.popwinError('发布失败，请重试。');
                }
            });

            return false;
        });
    });
</script>
</body>
</html>