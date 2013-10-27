<?php

Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl .
    '/widget/zyxcalendar/zyxcalendar.css');
Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl .
    '/widget/zyxcalendar/zyxcalendar.js');
?>
  <?php if (Yii::app()->user->hasFlash('tips')): ?>
   <div id="msg-box"><?php echo Yii::app()->user->getFlash('tips'); ?> </div>
  <?php endif; ?>
	<div class="main-right">
        <h3 class="cent-title">基本信息<span><?php echo $model['created']; ?> 注册</span></h3>
            <!--form action="./basicinfo" id="info-form" method="post" class="submit-form"-->
            	<?php $htmlOptions=array('action'=>$this->createUrl('center/basicinfo'),'method'=>'POST');$form=$this->beginWidget('CActiveForm', array('id'=>'info-form','htmlOptions'=>$htmlOptions)); ?>
               
                <ul class="info-list">
                <input type="hidden" value="updateuserinfo" name="action"/>
                    <li>
                        <label>登录名:</label>
                        <input type="text"  name="" class="long" maxlength="40" size="40" value="<?php echo
$this->Datahiding($model['email'], 'email'); ?>" disabled="true"/>
                    </li>
                    <li>
                        <label>昵称:</label>
                        <input type="text"  name="nickname" class="long" maxlength="40" size="40" value="<?php echo
$model['nick_name']; ?>" required="true" data-messages="required:昵称不能为空"/>
                    </li>
                    <li>
                        <label>真实姓名:</label>
                        <?php if (!empty($model['real_name'])): ?>
                        <input type="text"  name="realname" class="long" maxlength="40" size="40" value="<?php echo
$model['real_name']; ?>"/>
                         <?php if ($model['display_realname'] == 1): ?>
                        <input class="checkbox" type="checkbox" name="display_realname" value="1" checked="true"/><span class="if-birth">勾选后不公开真实姓名</span>
                        <?php else: ?>
                       <input class="checkbox" type="checkbox" name="display_realname" value="1"/><span class="if-birth">勾选后不公开真实姓名</span>
                        <?php endif; ?>
                        <?php else: ?>
                        <input type="text"  name="realname" class="long" maxlength="40" size="40" value=""/>
                        <?php endif; ?>
                    </li>
                    <li>
                        <label class="mr5">性别:</label>
                        
                        <?php if ($model['sex'] == '男'): ?>
                        
                        <input class="boxradio" type="radio" name="sex" id="my-sex-man" checked="checked" value="男"/>
                        <label for="my-sex-man">男</label>
                        <input class="boxradio" type="radio" name="sex" id="my-sex-woman" value="女"/>
                        <label for="my-sex-woman">女</label>
                        
                        <?php else: ?>
                        
                        <input class="boxradio" type="radio" name="sex" id="my-sex-man" value="男"/>
                        <label for="my-sex-man">男</label>
                        <input class="boxradio" type="radio" name="sex" id="my-sex-woman" value="女" checked="checked" />
                        <label for="my-sex-woman">女</label>
                        
                        <?php endif; ?>
                       
                    </li>

                    <li>
                        <label>生日:</label>
                        
                        <?php if (!empty($model['born'])): ?>
                        
                        <input type="text" name="born" value="<?php echo $model['born']; ?>" class="zyx-ipt w128 calendar" id="born_date" />
                        <?php if ($model['display_born'] == 1): ?>
                        <input class="checkbox" type="checkbox" name="display_born" value="1" checked="true"/><span class="if-birth">勾选后不公开生日</span>
                        <?php else: ?>
                         <input class="checkbox" type="checkbox" name="display_born" value="1"/><span class="if-birth">勾选后不公开生日</span>
                        <?php endif; ?>
                        <?php else: ?>
                        <input type="text" name="born" value="" class="zyx-ipt w128 calendar" id="born_date" />
                        <?php endif; ?>
                        
                    </li>
                
                    <li>
                        <label>所在地:</label>
                         
               <?php
                        // 国家
                        $htmlOptions = array(
                            'prompt' => CHtml::encode(Yii::t('form', '请选择...')),
                            'class' => 'zyx-ipt',
                            'ajax' => array(
                            'type'=>'POST', //request type
                            'url'=>Yii::app()->createUrl('center/dynamiczone'),
                            'update'=>'#Customer_state_id,#Customer_city_id', //selector to update
                            'data'=>array('id'=>'js:this.value','act'=>'state'),
                             ),
                        
                             );
                        echo $form->dropDownList($customer, 'country_id', Property::getCountries(), $htmlOptions);
               ?>
                
               <?php
                        // 省 州
                        $htmlOptions = array(
                            'prompt' => CHtml::encode(Yii::t('form', '请选择...')),
                            'ajax' => array(
                            'type'=>'POST', //request type
                            'url'=>Yii::app()->createUrl('center/dynamiczone'),
                            'update'=>'#Customer_city_id', //selector to update
                            'data'=>array('id'=>'js:this.value','act'=>'city'),
                             ),
                            'class' => 'zyx-ipt');
                        echo $form->dropDownList($customer, 'state_id', Property::getStates($customer->country_id), $htmlOptions);
                ?>
                
                <?php
                    // 城市
                    $htmlOptions = array(
                        'prompt' => CHtml::encode(Yii::t('form', '请选择...')),
                        'class' => 'zyx-ipt');
                    echo $form->dropDownList($customer, 'city_id', Property::getCities($customer->state_id), $htmlOptions);
                ?> 
                    
                     
                        
                    </li>
                    
                    
                    <li>
                        <label>自我介绍:</label>
                        <?php if (empty($model['introduction'])) { ?>
                        <textarea name="introduction" id="introduction" class="ipt-tip" data-default="写点什么，让大家多多了解你吧~"></textarea>
                        <?php } else { ?>
                        
                         <textarea name="introduction" id="introduction" class="ipt-tip" data-default="<?php echo
$model['introduction']; ?>"></textarea>
                        
                        <?php } ?>
                    </li>
                    <li>
                        <label>&nbsp;</label>
                        <span class="btn-line mycent-btn"><input type="submit" value="保存" name="yt0"></span>
                    </li>
                </ul>
                <?php $this->endWidget(); ?>
	</div>
