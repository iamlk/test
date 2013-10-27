<div id="image_list">
<div class="main-right">
<form action="<?php echo $this->createUrl('album/LotDelImage');?>">
	<h3 class="cent-title"><a href="<?php echo $this->createUrl('album/index');?>">我的相册</a> <em>&gt;</em><?php echo $albuminfo['a_name'];?></h3>
    <input type="hidden" value="<?php echo $albuminfo['album_id'];?>" name="a_id"/>
	   <div class="photo_layout">
			<div class="photo_toolbar">
				<!--相册工具栏-->
				<ul class="photo_toolbar_wrap">
					<li><input type="checkbox" class="check-all" >本页全选 已选 <span class="check-num">0</span> 张</li>

					<li><input value="批量删除" type="submit"/></li>
				</ul>
				<!--相册列表-->
				<div class="clear"></div>
				<div class="my-photo-wrap">
					<ul class="clearfix lotmanage my-photo-list" id="phonto_list_container">
					  <?php foreach($data->getData() as $item):?>
					 	<li>
						<a href="#"><img src=" <?php echo '/thumb/190_142/'.$item['img_path'];?>" width="190" height="142" /></a>
							<p>"<?php echo $item['img_title'];?>"<input type="checkbox" class="check" name="ck[]" value="<?php echo $item['album_image_id'];?>"/></p>
							
						</li>
				     <?php endforeach;?>
					 </ul>
					
				</div>
			</div>
	   </div>
	   <div class="pager results-pager"><span class="pager-num undis">|<b>1</b></span><span class="undis" id="l5211893c47320"><img border="0" src="/images/loading2.gif"></span></div>
              	   <?php
$this->widget('application.widgets.PageToolbar' , array('pagination'=>$data->pagination, 'ajaxContainerId'=>'image_list','useAjax'=>true, 'route'=>'album/ManageImagePage'));
?>
       </div>
</form>

</div>
<script>
	$('.lotmanage').find('input[type="checkbox"]').change(function(){
		var num=0;
		for(i=0;i<$('.lotmanage').find('input[type="checkbox"]').length;i++){
			if($('.lotmanage').find('input[type="checkbox"]').eq(i).attr('checked')=='checked')
			num++;
		}
		$('.check-num').text(num);
	});
	$('.check-all').change(function(){
		if($(this).attr('checked')=='checked'){
			$('.lotmanage').find('input[type="checkbox"]').attr('checked',true);
			$('.check-num').text($('.lotmanage').find('input[type="checkbox"]').length);
		}else{
			$('.lotmanage').find('input[type="checkbox"]').attr('checked',false);
			$('.check-num').text(0);
		}
	})
</script>