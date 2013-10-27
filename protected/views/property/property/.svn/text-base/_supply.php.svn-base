<?php ?>


<?php $form=$this->beginWidget('CActiveForm', array('id'=>'property-supply', 'action'=>$this->createUrl('property/house',array('property_id'=>$property->property_id)))); ?>
	<h3>住所公共设施<span>您可以添加更多的公共设施。</span><a href="javascript:;" id="add-public-acc">新增公共设施</a></h3>
    <div id="public-acc" class="setup-column">
		<div style="display:none">
			<div id="new-public-acc">
				<ul class="info-list">
					<li>
						<label>公共设施名称：</label>
						<input type="text" value="" />
					</li>
					<li>
						<label></label>
						<span class="btn-line property-btn"><a href="javascript:;">确定</a></span>
					</li>
				</ul>
			</div>
		</div>
        <ul class="property-extension-amenity clearfix">
        <?php foreach (PropertyAmenity::getPropertyAmenities() as $row) : ?>
            <?php
            $_key = $row['property_amenity_id'];
            $_value = $row['name'];
            $_checked = !!array_filter($propertyExtensions, create_function('$a', 'return $a["type"]=="amenity" and $a["key"]=="'.$_key.'";'));
            ?>
            <li>
           		<?php echo CHtml::checkBox("PropertyExtensions[][amenity][$_key]", $_checked , array('value' => $_value)); ?>
        		<?php echo CHtml::label(CHtml::encode($_value), false); ?>
            </li>
        <?php endforeach; ?>
        </ul>
       <!-- <ul class="property-extension-custom clearfix" id="user-defined">
        <?php $_text = ''; ?>
        <?php foreach ($propertyExtensions as $row) : ?>
            <?php
            if ( $row->type == 'text' ) $_text = $row->value;
            if ( $row->type != 'custom' ) continue;
            $_key = $row->key?:1;
            $_value = $row->value;
            ?>
            <li>
           		<?php echo CHtml::checkBox("PropertyExtensions[][custom][$_key]", true , array('value' => $_value)); ?>
        		<?php echo CHtml::label(CHtml::encode($_value), false); ?>
            </li>
        <?php endforeach; ?>
        </ul>
		-->
        <?php echo CHtml::textArea('PropertyExtensions[][text][1]',$_text,array('placeholder'=>'您可以输入一些需要告诉客人的其它公共设施相关说明。')); ?>
    </div>
	<h3>注意事项</h3>
	<div class="setup-column">
		<ul class="info-list">
			<li>
				<?php echo CHtml::label(Yii::t('property','最少入住天数').':',null); ?>
				<?php echo $form->textField($property,'min_night',array('size'=>9,'maxlength'=>9,'class'=>'zyx-ipt  w100')); ?>
				<span>晚</span>
				<?php echo $form->error($property,'min_night',array('class'=>'tip-holder')); ?>
				<?php echo CHtml::label(Yii::t('property','最佳入住时间').':',null); ?>
				<?php
				$htmlOptions = array('prompt'=>CHtml::encode(Yii::t('form','请选择...')),'class'=>'zyx-ipt');
				// TODO: if ($cid=(int)Yii::app()->request->getParam('currency_id')) $htmlOptions['options'] = array($cid=>array('selected'=>true));
				echo $form->dropDownList($property,'in_time',$property->getInTimes(),$htmlOptions);
				?>
				<?php echo $form->error($property,'in_time',array('class'=>'tip-holder')); ?>
			</li>
			<li>
				<?php echo CHtml::label(Yii::t('property','最多入住天数').':',null); ?>
				<?php echo $form->textField($property,'max_night',array('size'=>9,'maxlength'=>9,'class'=>'zyx-ipt  w100')); ?>
				<span>晚</span>
				<?php echo $form->error($property,'max_night',array('class'=>'tip-holder')); ?>
				 <?php echo CHtml::label(Yii::t('property','最佳退房时间').':',null); ?>
				<?php
				$htmlOptions = array('prompt'=>CHtml::encode(Yii::t('form','请选择...')),'class'=>'zyx-ipt');
				// TODO: if ($cid=(int)Yii::app()->request->getParam('currency_id')) $htmlOptions['options'] = array($cid=>array('selected'=>true));
				echo $form->dropDownList($property,'out_time',$property->getOutTimes(),$htmlOptions);
				?>
				<?php echo $form->error($property,'out_time',array('class'=>'tip-holder')); ?>
			</li>
			<li class="has-pet">
				<?php echo CHtml::label(Yii::t('property','是否有宠物').':',null); ?>
				<?php echo $form->radioButtonList($property,'is_have_pet',array(1=>'有宠物或动物',0=>'没有宠物或动物'),array('separator'=>'')); ?>
			</li>
			<li>
				<?php echo CHtml::label(Yii::t('property_addendum','《房屋守则》').':',null); ?>
				<?php echo $form->textArea($propertyAddendum,'manual',array('style'=>'width:500px;height:120px;')); ?>
				<?php echo $form->error($propertyAddendum,'manual',array('class'=>'tip-holder')); ?>
			</li>
		</ul>
	</div>
	<h3>增值服务设置</h3>
	<div class="setup-column">
		<table id="service-table">
			<tr>
				<th><input type="checkbox" / ></th>
				<th>服务名称</th>
				<th>服务明细</th>
				<th>收费</th>
				<th>操作</th>
			</tr>
			<tr>
				<td>
					<input type="checkbox" / >
				</td>
				<td>接驳服务</td>
				<td class="service-wrap" colspan="2">
					<table>
						<tr><td>22：00前接机到酒店</td><td>+收 $50.00</td></tr>
						<tr><td>22：00前接机到酒店</td><td>+收 $50.00</td></tr>
					</table>
				</td>
				<td>
					<a href="#">编辑</a>
					<a href="#">添加明细</a>
					<a href="#">删除</a>
				</td>
			</tr>
			<tr>
				<td>
					<input type="checkbox" / >
				</td>
				<td>接驳服务</td>
				<td class="service-wrap" colspan="2">
					<table>
						<tr><td>22：00前接机到酒店</td><td>+收 $50.00</td></tr>
						<tr><td>22：00前接机到酒店</td><td>+收 $50.00</td></tr>
					</table>
				</td>
				<td>
					<a href="#">编辑</a>
					<a href="#">添加明细</a>
					<a href="#">删除</a>
				</td>
			</tr>
		</table>
		<p class="steup-line">
			<a href="javascript:;">+ 新增一项服务</a>&nbsp;&nbsp;
			<a href="javascript:;">+ 新增一项服务(复制其他产品的增值服务)</a>
			<span class="btn-line property-add-service">
				<a href="javacript:;">将选择的增值服务添加到其他行程</a>
			</span>
		</p>
	</div>
	<p class="aln-center">
		<span class="btn-line property-btn">
			<?php echo CHtml::submitButton(CHtml::encode(Yii::t('form','完成'))); ?>
		</span>
	</p>
<?php $this->endWidget(); ?>




</div>
