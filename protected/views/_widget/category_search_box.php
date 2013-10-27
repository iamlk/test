<form id="categorySearchBox" action="<?php echo $this->getController()->createUrl('category/search')?>" method="get">
<p class="para">
	<span class="gray">Category:</span>
	<?php
		echo CHtml::dropDownList(
			'category_id',
			$_REQUEST['category_id'],
			Category::model()->getDropdownList(),
			array('encode'=>false ,'onChange'=>'jumpTo(\''.$this->getController()->createUrlWithForward('category/categoryList','category_id').'\',\'category_id=\'+$(this).val())','class'=>'itext')
		);
	?>
	<span class="gray indent10">Departure City:</span>
	<select name="departure_city" onChange="jumpTo('<?php echo $this->getController()->createUrlWithForward('category/categoryList','category_id')?>','category_id='+$(this).val())">
		<option value="0">--select--</option>
		<?php
			$departure_citys = Category::model()->with(array(
				'descriptions' => array('select'=>'name', 'condition'=>'language="en_us"', 'limit'=>1)
				))->findAllByAttributes(array('parent_category_id'=>0));
			foreach($departure_citys as $departure_city) {
			?>
				<option value="<?php echo $departure_city->category_id?>"<?php echo $_REQUEST['category_id'] == $departure_city->category_id ? ' selected="selected"':''?>><?php echo preg_replace('/Tours Departing From /i', '', $departure_city->descriptions[0]->name) ?></option>
			<?php
			}
		?>
	</select>
	<span class="gray indent10">Provider:</span>
	<?php 
		echo CHtml::dropDownList('provider_id', $_REQUEST['provider_id'],
		array(''=>'') + CHtml::listData(Provider::model()->findAll(array('order'=>'name ASC')), 'provider_id', 'name'),
		array('class'=>'itext w200','onchange'=>'submitCategorySearchBox()'));
	?>
</p>
<p class="para">
	<span class="gray">Duration:</span>
	<select name="duration">
		<option value="">--select--</option>
		<?php
			$duration_groups = Product::model()->durationGroups();
			foreach ($duration_groups as $key => $duration_group) {
				foreach ($duration_group as $duration) {
			?>
				<option class="duration_type duration_type_<?php echo $key?>" value="<?php echo $duration?>"<?php echo $_REQUEST['duration'] ==  $duration ? ' selected="selected"':''?>><?php echo $duration?></option>
			<?php
				}
			}
		?>
	</select>
	<select name="duration_type">
		<?php
			$duration_types = Product::model()->durationTypes;
			foreach($duration_types as $key => $duration_type) {
			?>
				<option value="<?php echo $key?>"<?php echo $_REQUEST['duration_type'] ==  $key ? ' selected="selected"':''?>><?php echo $duration_type?></option>
			<?php
			}
		?>
	</select>
	<span class="gray indent10">Keyword:</span>
	<?php
		echo CHtml::textField('keyword',$_REQUEST['keyword'],array('class'=>'itext','placeholder'=>'Product ID/Category ID/TourCode'));
	?>
</p>
<p class="para">
	<?php echo CHtml::button('Search',array('class'=>"btn",'onclick'=>'submitCategorySearchBox()'));?>
</p>
</form>
<script type="text/javascript">
function submitCategorySearchBox(){
	document.getElementById('categorySearchBox').submit();
}
function fliter_option(type) {
	var select = $('select[name="duration"]');
	select.find('.duration_type').hide();
	select.find('.duration_type_'+type).show();
}
$(function() {
	var duration_type = $('select[name="duration_type"]').val();
	fliter_option(duration_type);
	$('select[name="duration_type"]').change(function() {
		duration_type = $(this).val();
		fliter_option(duration_type);
	});
});
</script>