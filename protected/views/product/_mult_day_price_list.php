	<h4><span>价格设置情况</span>如果不当天接待，请将价格设置为0，客人将不可选。</h4>
	<div data-remote="/index.php?r=product/ShowCalendar&pid=<?php echo $product_id; ?>" id="price-view">
		<p class="price-view-btn"><a href="javascript:;" class="prev">上一月</a><span><em id="year"><?php echo date('Y'); ?></em>年<em id="month"><?php echo date('n'); ?></em>月</span><a href="javascript:;" class="next">下一月</a></p>
		<ul id="cal-date"></ul>
	</div>
    
<?php if(false): ?> 
<?php /** 此列表被取消 */   ?>   
<table>
	<tr >
		<th>有效时间段</th><th>定价</th><th>时间</th>
	</tr>
	<?php if($modelview) foreach($modelview as $v){?>
	<tr>
		<td><?php echo date('Y年m月d日',$v->start_date)  ?>--<?php echo date('Y年m月d日',$v->end_date)  ?>
		所有 <?php
		if($v->sunday) echo 'Sun &nbsp;&nbsp;';
if($v->monday) echo 'Mon &nbsp;&nbsp;';
if($v->tuesday) echo 'Tue &nbsp;&nbsp;';
if($v->wednesday) echo 'Wed &nbsp;&nbsp;';
if($v->thursday) echo 'Thu &nbsp;&nbsp;';
if($v->friday) echo 'Fri &nbsp;&nbsp;';
if($v->saturday) echo 'Sat &nbsp;&nbsp;';
		?>
		</td>
		<td>定价： $<?php echo "单人：".$v->price_single."--双人：".$v->price_double."--3人：".$v->price_triple."--4人：".$v->price_quad;  ?>   儿童<?php echo $v->price_kids; ?></td>
		<td>时间 <?php echo date('Y年m月d日 H:i:s a',$v->create_time)  ?></td>
	</tr>
	<?php }?>
	<?php if($modelview2) foreach($modelview2 as $v){?>
    	<tr>
		<td><?php echo date('Y年m月d日',$v->start_date)  ?>--<?php echo date('Y年m月d日',$v->end_date)  ?>
		所有 <?php
		if($v->sunday) echo 'Sun &nbsp;&nbsp;';
if($v->monday) echo 'Mon &nbsp;&nbsp;';
if($v->tuesday) echo 'Tue &nbsp;&nbsp;';
if($v->wednesday) echo 'Wed &nbsp;&nbsp;';
if($v->thursday) echo 'Thu &nbsp;&nbsp;';
if($v->friday) echo 'Fri &nbsp;&nbsp;';
if($v->saturday) echo 'Sat &nbsp;&nbsp;';
		?>
		</td>
		<td>定价： $<?php echo "单人：".$v->price_single."--双人：".$v->price_double."--3人：".$v->price_triple."--4人：".$v->price_quad;  ?>   儿童<?php echo $v->price_kids; ?></td>
		<td>时间 <?php echo date('Y年m月d日 H:i:s a',$v->create_time)  ?></td>
	</tr>
	
	<?php } ?>
</table>

<?php endif; ?>
<p class="note"><span>温馨提示：</span>价格将以最近时间设置的金额为准。</p>
