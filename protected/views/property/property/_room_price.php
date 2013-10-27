<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/lib.js'); ?>



<div class="setup-column">
	<div>
		<input id="property_id" type="hidden" value="<?php echo (int)$property->property_id; ?>" />
		<div id="msg-box"><div class="msg-box"></div></div>
		<div id="price-setup">
		 <h4><span>设置价格</span>您可以设置多种不同条件的价格，价格将以最近时间设置的金额为准。</h4>
			<ul data-action="<?php echo $this->createUrl('property/updatePriceOverride');?>" class="ajax-form info-list time-slice">
				<li>
					<label>设置某段时间价格:</label>
					<p class="price-setup-item">
						<span>将</span>
						<input id="start_date" type="text" name="start_date"  class="setup-calendar" value="" />
						<span>-</span>
						<input id="end_date" type="text" name="end_date"  class="setup-calendar" value="" />
						<span for="day_price2" class="short">价格设置为:</span>
						$<input type="text" name="value" id="day_price2" class="short"/>
						<span>/晚</span>
						<span class="btn-line price-btn">
							<a href="javascript:;">确定</a>
						</span>
					</p>	
				</li>
			</ul>
			<div  data-action="<?php echo $this->createUrl('property/updatePrice');?>" class="ajax-form" >
				<ul class="info-list time-slice">
					<li class="undis">
						<label for="day_price">默认每晚价格:</label>
						<input type="text" name="day_price" id="day_price" value="<?php echo $propertyPrice->day_price; ?>" />
					</li>
					<li>
						<label for="weekend_price">设置周末的价格为:</label>
						<p class="price-setup-item">
							$<input type="text" name="weekend_price" id="weekend_price" value="<?php echo $propertyPrice->weekend_price; ?>" />
							<span>/晚</span>
						</p>
					</li>
					<li>
						<label>设置特殊预订价格:</label>
						<div class="price-setup-item">
							<p>
								<span>连续预订一周价格为</span>
								$<input type="text" name="week_price" id="week_price" value="<?php echo $propertyPrice->week_price; ?>" />
							</p>
							<p>
								<span >连续预订一月价格为</span>
								$<input type="text" name="month_price" id="month_price" value="<?php echo $propertyPrice->month_price; ?>" />
							</p>
						</div>
					</li>
					<li>
						<label>设置其它额外费用:</label>
						<div class="price-setup-item">
							<p>
								<span>入住押金</span>
								$<input type="text" name="deposit" id="deposit" value="<?php echo $propertyPrice->deposit; ?>" />
							</p>
							<p>
								<span >人员超出</span>
								$<input type="text" name="extra_guest_price" id="extra_guest_price" value="<?php echo $propertyPrice->extra_guest_price; ?>" />
								<span class="warnning">超出本房屋最多入住人数时每人加收费用。</span>
							</p>
							<p>
								<span >清洁费用</span>
								$<input type="text" name="clean_price" id="clean_price" value="<?php echo $propertyPrice->clean_price; ?>" />
							</p>
						</div>
					</li>
				</ul>
				<ul  class="info-list">
					<li>
						<p>价格相关的其它补充说明</p>
						<textarea name="des"></textarea>
					</li>
					<li class="aln-center">
						<span class="btn-line price-btn btn-center">
							<a href="javascript:;">确定</a>
						</span>
					</li>
				</ul>
			</div>
		</div>

		<div id="price_table">
			<div>
			<span>以下是设置的价格情况，如果不出租住所，请将价格设置为0，客人将不可选。</span>
			<span style="display: inline-block; float:right;">
				<?php // echo CHtml::link('查看每天的价格详情',array('property/calendar','property_id'=>$property->property_id)); ?>
			</span>
			</div>
			<br />
			<table border=1>
				<tr>
					<th>有效价格时间段</th>
					<th>价格设置记录</th>
					<th>定价时间</th>
				</tr>
				<tr class="day_price">
					<td>默认每晚价格</td>
					<td>定价为：<span class="price"><?php echo $propertyPrice->day_price; ?></span></td>
					<td class="datetime"><?php echo $propertyPrice->datetime; ?></td>
				</tr>
				<tr class="weekend_price">
					<td>周末每晚价格</td>
					<td>定价为：<span class="price"><?php echo $propertyPrice->weekend_price; ?></span></td>
					<td class="datetime"><?php echo $propertyPrice->datetime; ?></td>
				</tr>
				<tr class="week_price">
					<td>连续预订一周</td>
					<td>定价为：<span class="price"><?php echo $propertyPrice->week_price; ?></span></td>
					<td class="datetime"><?php echo $propertyPrice->datetime; ?></td>
				</tr>
				<tr class="month_price">
					<td>连续预订一月</td>
					<td>定价为：<span class="price"><?php echo $propertyPrice->month_price; ?></span></td>
					<td class="datetime"><?php echo $propertyPrice->datetime; ?></td>
				</tr>
				<tr class="deposit">
					<td>入住押金</td>
					<td>定价为：<span class="price"><?php echo $propertyPrice->deposit; ?></span></td>
					<td class="datetime"><?php echo $propertyPrice->datetime; ?></td>
				</tr>
				<tr class="extra_guest_price">
					<td>超出人员</td>
					<td>定价为：<span class="price"><?php echo $propertyPrice->extra_guest_price; ?></span></td>
					<td class="datetime"><?php echo $propertyPrice->datetime; ?></td>
				</tr>
				<tr class="clean_price">
					<td>清洁费用</td>
					<td>定价为：<span class="price"><?php echo $propertyPrice->clean_price; ?></span></td>
					<td class="datetime"><?php echo $propertyPrice->datetime; ?></td>
				</tr>
				<?php foreach ($propertyPriceOverrides as $row) : ?>
				<tr class="price_override">
					<td><?php echo Yii::t('propertyPriceOverride','{%s1}至{%s2}',array('{%s1}'=>$row->start_date,'{%s2}'=>$row->end_date)); ?></td>
					<td>定价为：<span class="price"><?php echo $row->day_price; ?></span></td>
					<td class="datetime"><?php echo $row->datetime; ?></td>
				</tr>
				<?php endforeach; ?>
			</table>
			<br />
			<div>温馨提示：价格将以最近时间设置的金额为准。</div>
		</div>
	</div>
</div><!-- form -->
