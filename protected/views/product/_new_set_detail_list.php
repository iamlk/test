
<table class="service-table">
	<tr>
		<th class="time">出发时间</th>
		<th class="add">详情地址</th>
		<th class="operate">操作</th>
	</tr>
	<?php foreach($data as $v):?>
	<tr id="del_dep_<?php echo $v->_id; ?>" >
		<td class="time"><?php echo $v->time; ?></td>
		<td class="add"><?php echo $v->full_address;  ?></td>
		<td>
		<a href="javascript:void(0);" class="change-ser" data-id="<?php echo $v->_id;?>" >修改</a>
		<a href="javascript:void(0);" title="点击删除" onclick="del_dep(<?php echo $v->_id; ?>)" >删除</a>
		</td>
	</tr>
	
	<?php endforeach ?>
<tr>
	<td colspan="2">
	</td>
	<td>
	<a href="javascript:void(0);" class="add-new" title="新增一项" data-id="<?php echo $model->product_id; ?>" data-in="detail" >新增一项</a>
	</td>
</tr>
</table>
