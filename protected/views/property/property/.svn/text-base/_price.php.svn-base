<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/widget/zyxcalendar/zyxcalendar.js');?>
<?php Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl.'/widget/zyxcalendar/zyxcalendar.css');?>
<?php if(Yii::app()->user->hasFlash('is_ok')):?>
        <?php if((strpos($property->step,'1') !== false) && (strpos($property->step,'2') !== false) && (strpos($property->step,'3') !== false) && (strpos($property->step,'4') !== false)): ?>
            <?php include '_msg.php'; ?>
        <?php else :?>
            <div id="msg-box"><?php echo Yii::app()->user->getFlash('is_ok'); ?> </div>    
        <?php endif; ?>
<?php endif;?>

<?php  $htmlOptions=array('class'=>'valid-form'); $form=$this->beginWidget('CActiveForm', array( 'htmlOptions'=>$htmlOptions,'id'=>'property-form', 'action'=>$this->createUrl('property/price',array('property_id'=>$property->property_id)))); ?>

<?php if(false && $property->getErrors()): ?>
 <div id="msg-box"><?php  echo $form->errorSummary(array($propertyPrice,$propertyPriceOverride)); ?></div>
 <?php endif;?>
	<ul class="info-list">
        <li>
			<label>有效日期：<span>*</span></label>
		    <?php if($propertyPrice->start_date =='0000-00-00'){$propertyPrice->start_date='';} echo $form->textField($propertyPrice,'start_date',array('class'=>'setup-calendar','id'=>"start_date")); ?>
             <?php echo $form->error($propertyPrice,'start_date',array('class'=>'tip-holder')); ?>
			<span>-</span>
            <?php if($propertyPrice->end_date =='0000-00-00'){$propertyPrice->end_date='';}  echo $form->textField($propertyPrice,'end_date',array('class'=>'setup-calendar','id'=>"end_date")); ?>
             <?php echo $form->error($propertyPrice,'end_date',array('class'=>'tip-holder')); ?>
		</li>
		<li>
			<label>单日价格：￥<span>*</span></label>
			 <?php echo $form->textField($propertyPrice,'day_price',array('required'=>true,'data-rules'=>'number:true','data-messages'=>'required:<i></i>请输入单日价格,number:<i></i>单日价格必须为数字')); ?>
             <?php echo $form->error($propertyPrice,'day_price',array('class'=>'tip-holder')); ?>
		</li>
		<li>
			<label>连续预定一周价格：</label>
			<?php
                $htmlOptions = array('prompt'=>CHtml::encode(Yii::t('form','请选择折扣')),'class'=>'price');
                echo $form->dropDownList($propertyPrice,'week_discount',Property::getDiscount(),$htmlOptions);
                ?>
                <?php echo $form->error($propertyPrice,'week_discount',array('class'=>'tip-holder')); ?>
			<span class="warnning">连续出租一周的折扣价格为：</span>
			<span class="price-item">￥<?php echo $propertyPrice->week_price; ?></span>
		</li>
		<li>
			<label>连续预定一月价格：</label>
			<?php
                $htmlOptions = array('prompt'=>CHtml::encode(Yii::t('form','请选择折扣')),'class'=>'price');
                echo $form->dropDownList($propertyPrice,'month_discount',Property::getDiscount(),$htmlOptions);
                ?>
                <?php echo $form->error($propertyPrice,'month_discount',array('class'=>'tip-holder')); ?>
			<span class="warnning">连续出租一月的折扣价格为：</span>
			<span class="price-item">￥<?php echo $propertyPrice->month_price; ?></span>
		</li>
		<li>
			<label>特殊时段价格：</label>
            <?php if($propertyPriceOverride->start_date =='0000-00-00'){$propertyPriceOverride->start_date='';} echo $form->textField($propertyPriceOverride,'start_date',array('class'=>'setup-calendar','id'=>"start_date")); ?>
             <?php echo $form->error($propertyPriceOverride,'start_date',array('class'=>'tip-holder')); ?>
			<span>-</span>
            <?php if($propertyPriceOverride->end_date =='0000-00-00'){$propertyPriceOverride->end_date='';}  echo $form->textField($propertyPriceOverride,'end_date',array('class'=>'setup-calendar','id'=>"end_date")); ?>
             <?php echo $form->error($propertyPriceOverride,'end_date',array('class'=>'tip-holder')); ?>
        </li>
		<li>
			<label></label>
			<?php
			/** 折扣、涨价选择 */
			$htmlOptions = array('prompt'=>CHtml::encode(Yii::t('form','请选择折扣/涨价')),'class'=>'price');
			echo $form->dropDownList($propertyPriceOverride,'is_rise',Property::getDRType(),$htmlOptions);
			?>
			
			<?php
			 /** 涨价选择 */
             if($propertyPriceOverride->is_rise ==1)
             {
                	$htmlOptions = array('prompt'=>CHtml::encode(Yii::t('form','请选择')),'class'=>'price sale up-price ');
             }
             else
             {
                	$htmlOptions = array('prompt'=>CHtml::encode(Yii::t('form','请选择')),'class'=>'price sale up-price undis');
             }
		
			echo $form->dropDownList($propertyPriceOverride,'rise_float',Property::getRisecount(),$htmlOptions);
			?>
			<?php echo $form->error($propertyPriceOverride,'rise_float',array('class'=>'tip-holder')); ?>
			
			<?php
			 /** 折扣选择 */
             if($propertyPriceOverride->is_rise ==0)
             {
            	$htmlOptions = array('prompt'=>CHtml::encode(Yii::t('form','请选择')),'class'=>'price sale');
             }
             else
             {
                $htmlOptions = array('prompt'=>CHtml::encode(Yii::t('form','请选择')),'class'=>'price sale undis');
             }
		
			echo $form->dropDownList($propertyPriceOverride,'day_discount',Property::getDiscount(),$htmlOptions);
			?>
			<?php echo $form->error($propertyPriceOverride,'day_discount',array('class'=>'tip-holder')); ?>
			<span class="warnning">特殊时段价格为：</span>
			<span class="price-item">￥<?php echo $propertyPriceOverride->day_price; ?></span>
		</li>
		<li class="aln-center">
			<label></label>
			<span class="btn-line price-btn btn-center">
                <?php echo $form->hiddenField($property,'property_id'); ?>
				<input type="submit" value="保存" name="yt0" />
			</span>
		</li>
	</ul>
 <?php $this->endWidget(); ?>

    <!--<div id="price_table">
        <h4><span>价格设置情况</span><a href="javascript:;" id="dayprice-view" data-remote="/property/showPrice?property_id=<?php echo $property->property_id; ?>">每天价格详情查看</a></h4>
        <table>
            <tr>
                <th>有效价格时间段</th>
                <th>价格设置记录</th>
                <th>定价时间</th>
            </tr>
            <tr class="day_price">
                <td>默认单日价格</td>
                <td>定价为：$<span class="price"><?php echo $propertyPrice->day_price; ?></span></td>
                <td class="datetime"><?php echo $propertyPrice->datetime; ?></td>
            </tr>
           
            <tr class="week_price">
                <td>连续预订一周</td>
                <td>定价为：$<span class="price"><?php echo $propertyPrice->week_price; ?></span></td>
                <td class="datetime"><?php echo $propertyPrice->datetime; ?></td>
            </tr>
            <tr class="month_price">
                <td>连续预订一月</td>
                <td>定价为：$<span class="price"><?php echo $propertyPrice->month_price; ?></span></td>
                <td class="datetime"><?php echo $propertyPrice->datetime; ?></td>
            </tr>
          
            <tr class="price_override">
             <td>特殊时段价格</td>
                <td>
                
                定价为：$<span class="price"><?php echo $propertyPriceOverride->day_price; ?></span>
                <span class="price-item">&nbsp;&nbsp;
                <?php echo Yii::t('propertyPriceOverride','{%s1}~{%s2}',array('{%s1}'=>$propertyPriceOverride->start_date,'{%s2}'=>$propertyPriceOverride->end_date)); ?>
                </span>
                </td>
                <td class="datetime"><?php echo $propertyPriceOverride->datetime; ?></td>
            </tr>
          
        </table>
        <p class="note"><span>温馨提示：</span>价格将以最近时间设置的金额为准。</p>
    </div>-->
	<div id="price-view"  data-remote="/property/showPrice?property_id=<?php echo $property->property_id; ?>">
		<h3>价格详情<span>以下是客人在网站看到的每人需支付的金额。</span></h3>
		<p class="price-view-btn"><a class="prev" href="javascript:;">上一月</a><span><em id="year"><?php echo date('Y') ?></em>年<em id="month"><?php echo date('n') ?></em>月</span><a class="next" href="javascript:;">下一月</a></p>
		<ul id="cal-date"></ul>
	</div>
<!-- form -->