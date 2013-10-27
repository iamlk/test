	<div class="main-right">
        <h3 class="cent-title"><a href="<?php echo $this->createUrl('peoplealbum/index',array('u_id'=>$this->uid));?>">他的相册</a></h3>
           <div class="photo_layout">
				<div id="create-album" style="display:none;">
                    <form action="./createalbum" method="POST">
						<ul>
							<li><label>相册名称：</label><input type="text" name="albumname"/></li>
							<li><label>相册描述：</label><textarea type="text" name="description"></textarea></li>
							<li><label></label><!--<a href="javascript:;" class="create">创建</a>--><input type="submit" value="创建"  class="create"/><a href="javascript:;" class="cancle">取消</a></li>
						</ul>
					</form>
				</div>
                <div class="photo_toolbar">
                    <!--相册工具栏-->
                    <ul class="photo_toolbar_wrap">
   
                    </ul>
                    <!--相册列表-->
                    <div class="clear"></div>
                    <div id="album_list_div">
                        <ul id="album_list_container">
                        
                        <?php foreach($data as $item):?>
                        
                            <li>
                                <div class="photo_albumlist_wrap">
                                     <a href=" <?php echo $this->createUrl('peoplealbum/albumsub',array('a_id'=>$item->album_id,'u_id'=>$this->uid));?>">
                                     <?php if(!empty($item->face)):?>
                                     <img src="<?php echo '/thumb/146_142/'.Album::model()->getImageFace($item->face);?>" width="146" height="142" />
                                     <?php else:?>
                                     <img src="../images/common/my_photo_1.png" width="146" height="142" />
                                     <?php endif;?>
                                     </a>
                                </div>
                                <p class="photo-info"><?php echo $item->a_name;?></p>
                                    <p class="photo-hover"><a  class="comment ajax-item" href="<?php echo $this->createUrl('collect/it');?>?type=<?php echo Dynamic::ALBUM;?>&id=<?php echo $item->album_id;?>">
		收藏
	</a></p>
  
                            </li>
                        <?php endforeach;?>
                        </ul>
                    </div>
                </div>
           </div>
   </div>

   <script type="text/javascript">
    $(function(){
        //相册hover显示删除与编辑
        var list = $("#album_list_container >li");
        list.hover(function(){
            $(this).find(".photo-hover").show();
        },function(){
            $(this).find(".photo-hover").hide();
        });
    });
</script>
   <script type="text/javascript">
	$(function(){
		$('.delete').click(function(){
			var $_this=$(this);
			$.ajax({
				url:$_this.attr('href'),
				dataType:'json',
				success:function(result){
					if(result.state=='success'){
						 $_this.parents('li').fadeOut(function(){
							$(this).remove();
						 })
					}else{
						if($('#msg-box').length){
							$('#msg-box').addClass('error').show().html(result.reason);
						 }else{
							$('body').append($('<div id="msg-box" class="error">'+result.reason+'</div>'))
						 }
						 var t=setTimeout(function(){$('#msg-box').fadeOut(1000)},2000);
					}
				}
			});
			return false;
		})
		$('#toolbar_add_album').ZYXlightbox({
			width:490,
			contentId:'create-album',
			contentType:'inline',
			title:'创建相册',
			onShow:function($stage, element, box){
				//priceCal(url);
				
				$stage.find('form').submit(function(){
				var url=$(this).attr('action');
					var data=creatData($('form'));
					$.ajax({
						url:url,
						data:data,
						dataType:'json',
						success:function(result){
							if(result.state=='success'){
								 location.href=location.href;
							}else{
								if($('#msg-box').length){
									$('#msg-box').addClass('error').show().html(result.reason);
								 }else{
									$('body').append($('<div id="msg-box" class="error">'+result.reason+'</div>'))
								 }
								 var t=setTimeout(function(){$('#msg-box').fadeOut(1000)},2000);
							}
						}
					});
					return false;
				});
				$stage.find('.cancle').click(function(){
					box.close();
				});
			}
		});
		$('.album-edite').ZYXlightbox({
			width:490,
			contentId:'create-album',
			contentType:'inline',
			title:'编辑相册',
			onShow:function($stage, element, box){
				//priceCal(url);
				var url=$(element).data('action');
				$stage.find('form').attr('action',url);
				$stage.find('input[name="albumname"]').val($(element).data('title'));
				$stage.find('input:submit').val('确定');
				$stage.find('textarea').text($(element).data('des'));
				$stage.find('.cancle').click(function(){
					box.close();
				});
				$stage.find('form').submit(function(){
				var url=$(this).attr('action');
					var data=creatData($('form'));
					$.ajax({
						url:url,
						data:data,
						dataType:'json',
						success:function(result){
							if(result.state=='success'){
								 location.href=location.href;
							}else{
								if($('#msg-box').length){
									$('#msg-box').addClass('error').show().html(result.reason);
								 }else{
									$('body').append($('<div id="msg-box" class="error">'+result.reason+'</div>'))
								 }
								 var t=setTimeout(function(){$('#msg-box').fadeOut(1000)},2000);
							}
						}
					});
					return false;
				});
			}
		});
	})
</script>