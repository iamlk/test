<div class="main-right clearfix">
	<div class="friends-search-wrap">
		<?php include('_collect_menu.php');?>
	</div>
	<ul class="photo_toolbar_wrap">
		<li>
			<input type="checkbox" name="all" id="all">本页全选
		</li>
		<li>
			<a href="javascript:void(0);" class="all" data-type="<?php echo Dynamic::PRODUCT ?>" title="批量删除">批量删除</a>
		</li>
	</ul>
	<div class="collection-list-wrap clearfix">
	<?php foreach($data as $item):?>
	   
        <?php include('_product.php');?>
      
	 <?php endforeach;?>
	</div>
</div>