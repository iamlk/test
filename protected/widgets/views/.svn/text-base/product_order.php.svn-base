<?php
$room_type = Product::$RoomType;
$price = $order->price?G4S::format($order->price):G4S::format($product->goods->price);
//$price_rmb = $order->price?G4S::format($order->price*SiteOption::getValueByKey('USD_TO_RMB',true)):G4S::format($price*SiteOption::getValueByKey('USD_TO_RMB',true));
$json = json_decode($order->json,true);
$max_num = $product->productNote->max_per_day_num_for_adults;
$min_num = $max_num>30?30:$max_num;
$min_num = $min_num == 0 ? 30 : $min_num;
$adult_num = $json['adult']?intval($json['adult']):1;
$child_num = intval($json['child']);
$time_only = array();
foreach($data['time'] as $v)
{
    $time_only[]= '\''.$v['day'].'\'';
}
$time_spec = array();
foreach($data['only'] as $v)
{
    $time_spec[] = '\''.$v['day'].'\'';
}
$all_arr = array_merge($time_only,$time_spec);
?>
<div class="book-wrap">
    <form name="book" method="post" id="product_form" action="<?php echo $this->controller->createUrl('basket/postShopGoods'); ?>">
    <div class="book">
        <div class="book-top"><span></span>请设置行程后放入行程单</div>
        <div class="book-con clearfix" id="book-con">
        <!--预订选项，开始-->
        <div class="book-option">
            <ul class="options">
            <!--第一项 start-->
                <li>
                    <div class="num num1"></div>
                    <div class="con">
                        <h3>去往游玩日期：<label>（根据您行程单上所选日期）</label></h3>
                        <p class="ptxt">
                            <input type="text" id="go-time" data-remote="<?php echo $this->controller->createUrl('goods/productPrice'); ?>" value="<?php echo $order->goods_start_date?date('Y年m月d日',strtotime($order->goods_start_date)):'';?>" class="zyx-ipt w128  calendar" />
                        </p>

                    </div>
                </li>
                <li class="choose-num">
                    <div class="num num2"></div>
                    <div class="con">
                        <h3>请选择人数：<label>（温馨提示,每天接待人数上限:<em id="people-len">0</em>）</label>
                            <!--<a class="pbtn" id="hotel-1-link" href="javascript:;">修改</a>-->
                        </h3>
                        <div id="hotel-1-show">
                            <p class="pview">
                                <label>成人:</label>
								<select name="adult" class="num-setup" data-price="" id="adult" disabled="disabled">
									<option value="0">0</option>
								</select>
                                <label>小孩:</label>
								<select name="child" class="num-setup" data-price="" id="child" disabled="disabled">
									<option value="0">0</option>
								</select> 
                            </p>
							<p class="tip-holder" style="display:none;">该天不接待小孩。</p>
                        </div>
						<!--<input type="hidden" id="hidadult" value="<?php echo $adult_num; ?>"/>		
						<input type="hidden" id="hidkid" value="<?php echo $child_num; ?>"/>	-->
                        <!--酒店房间编辑-->
                        <!--<div id="hotel-1-edit" edittype="3">
                            <div class="frmpop">
                                <div class="frmpop-con">
                                    <div class="frmpop-title  hotel-form" data-num="<?php echo $min_num; ?>">
                                        温馨提示,每天接待人数上限:<?php echo $max_num == 0 ? '无限制':$max_num; ?>
                                    </div>
                                    <div class="frmpop-table">
                                        <h4>
                                            <span class="radio">&nbsp;</span>
                                            <span class="adult">成人</span>
                                            <span class="kid">小孩</span>
                                        </h4>
                                        <div class="frmpop-rooms">
                                            <p class="flist">
												<span class="ftxt">
													<span class="radio">&nbsp;</span>
												  <?php if($min_num): ?>
                                                   <input type="hidden" value="<?php echo $min_num; ?>" />
													<span class="adult">
														<select name="" class="adultlist">
                                                        <?php for($i=0;$i<=$min_num;$i++):?>
                                                          <option value="<?php echo $i;if($adult_num==$i)echo '" selected="selected';?>"><?php echo $i; ?></option>
                                                          <?php endfor;?>
														  
                                                        </select>
													</span>
													<span class="kid">
														<select name="" class="kidlist">
                                                            <?php for($i=0;$i<=$min_num;$i++):?>
                                                          <option value="<?php echo $i;if($child_num==$i)echo '" selected="selected'; ?>"><?php echo $i; ?></option>
                                                          <?php endfor;?>
														 
                                                        </select>
													</span>
                                                    <?php endif;?>
												</span>
                                            </p>
                                        </div>
											
                                    </div>
                                    <p class="zyxbtn-wrap">
                                        <a class="zyxbtn3 ok" href="javascript:;">确定</a>
                                        <a class="zyxbtn3 cancel" href="javascript:;">取消</a>
                                    </p>
                                </div>
                            </div>
                        </div>-->
                        <!--酒店房间编辑，结束-->

                    </div>
                </li>
               <!-- <?php if($product->entity_type == Product::TOUR_MULTI_DAY): ?>
                 <li>
                    <div class="num num3"></div>
                    <div class="con">
                        <h3>请选择酒店预订：<a class="pbtn" id="hotel-2-link" href="javascript:;">修改</a></h3>
                        <div id="hotel-2-show">
                            <?php 
                            $housing_num = '';
                            $housing_type = '';
                            foreach($json['rooms'] as $rt => $rs):
                            if($rs==0) continue;
                            $housing_num .=$rs.',';
                            $housing_type .= $rt.',';
                            ?>
                            <p class="pview">
                            <label>房间类型:</label><?php echo $room_type[$rt]; ?>&nbsp;&nbsp;&nbsp;&nbsp;
                            <label>房间数:</label><?php echo intval($rs); ?>   
                            </p>
                            <?php endforeach?>
                        </div>
						<input type="hidden" value="<?php echo substr($housing_type,0,-1); ?>" id="room-type-hid" />
						<input type="hidden" value="<?php echo substr($housing_num,0,-1); ?>" id="housing-num" />
						<input type="hidden" value="" id="arraytype" />
						
                        
                        <div id="hotel-2-edit" class="undis" edittype="6">
                            <div class="frmpop">
                                <div class="frmpop-con">
                                    <div class="frmpop-title">
                                       温馨提示,酒店房间预订上限:<?php echo $product->productNote->max_hotle_booking; ?> 
                                       房间限住人数:<?php echo $product->productNote->max_room_for_adults; ?>
                                       房间床位数:<?php echo $product->productNote->max_room_bed; ?>  
                                    </div>

                                    <div class="frmpop-table">
                                        <h4>
                                            <span class="radio">&nbsp;</span>
                                            <span class="adult">房间类型</span>
                                            <span class="radio">&nbsp;</span>
                                            <span class="adult">房间数</span>
                                        </h4>
                                        <div class="frmpop-rooms">
                                        <?php
                                            $tmp = array();
                                            foreach($json['rooms'] as $rt => $rs):
                                            if($rs==0) continue;
                                        ?>
                                            <p class="flist">
                                                <span class="radio">&nbsp;</span>
												<span class="ftxt">
                                                    <span class="room-adult">
														<select name="" id="room-type">
															<?php if(!in_array(1,$tmp)):?><option value="1" <?php if($rt==1) echo 'selected="selected"';?> >单人间 </option><?php endif?>
															<?php if(!in_array(2,$tmp)):?><option value="2" <?php if($rt==2) echo 'selected="selected"';?> >双人间 </option><?php endif?>
															<?php if(!in_array(3,$tmp)):?><option value="3" <?php if($rt==3) echo 'selected="selected"';?> >三人间 </option><?php endif?>
															<?php if(!in_array(4,$tmp)):?><option value="4" <?php if($rt==4) echo 'selected="selected"';?> >四人间 </option><?php endif?>
														</select>
													</span>
												  <?php 
                                                  $ct = $product->productNote->max_hotle_booking;
                                                  $tmp[] = $rt;
                                                  if($ct): 
                                                  ?>
                                                   <input type="hidden" value="<?php echo $ct; ?>"  />
													<span class="room-adult">
														<select name="" id="adult-num">
                                                          <?php for($i=0;($i<=$ct && $i<=30);$i++):?>
                                                          <option value="<?php echo $i; ?>" <?php if($rs==$i) echo 'selected="selected"';?> ><?php echo $i; ?></option>
                                                          <?php endfor;?>
                                                        </select>
													</span>
                                                    <?php endif; ?>
												
												</span>
                                            </p>
                                        <?php endforeach?>
                                            <p class="flist">
                                                <span class="radio">&nbsp;</span>
												<span class="ftxt">
                                                    <span class="room-adult">
														<select name="" id="room-type">
															<?php if(!in_array(1,$tmp)):?><option value="1">单人间 </option><?php endif?>
															<?php if(!in_array(2,$tmp)):?><option value="2">双人间 </option><?php endif?>
															<?php if(!in_array(3,$tmp)):?><option value="3">三人间 </option><?php endif?>
															<?php if(!in_array(4,$tmp)):?><option value="4">四人间 </option><?php endif?>
														</select>
													</span>
												  <?php $ct = $product->productNote->max_hotle_booking;if($ct): ?>
                                                   <input type="hidden" value="<?php echo $ct; ?>"  />
													<span class="room-adult">
														<select name="" id="adult-num">
                                                          <?php for($i=0;($i<=$ct && $i<=30);$i++):?>
                                                          <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                                          <?php endfor;?>
                                                        </select>
													</span>
                                                    <?php endif; ?>
												
												</span>
                                            </p>
                                        </div>
										
                                    </div>
                                    <p class="zyxbtn-wrap">
                                        <a class="zyxbtn3 ok" href="javascript:;">确定</a>
                                        <a class="zyxbtn3 cancel" href="javascript:;">取消</a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
                <?php endif;?>
				-->
            </ul>
            <div class="clear"></div>
          
        </div>
        <!--预订选项，结束-->

        <!--右侧预订信息，开始-->
        <div style="position: absolute; bottom: 0px; right: 0px;" class="book-tool" id="book-tool">
            <div id="price" class="price">
                <p>
                    <span class="currecy-type">人民币：</span>
                    <span id="currecy_display_usd" class="us">￥<em><?php echo $price ?></em></span>
                </p>
                <!--p class="cn"><label>人民币：</label><span id="currecy_display_cny">￥<?php //echo $price_rmb ?></span></p-->
            </div>

            <div class="add">
                <input type="submit" value="放入行程单" class="zyxbtn1 tooltip <?php if(Yii::app()->user->isGuest)echo 'fast-login';?>" id="order-add-card" />
            </div>

            <ul class="other-option">
                <li class="post" style="display: none;">
                    <a class="find-companion" id="find-companion1" href="javascript:;">发布立即结伴贴</a>
                    <a class="companion-help" target="_blank" href="" title="如何发布结伴贴"></a>
                </li>
            </ul>
        </div>
        <!--右侧预订信息，结束-->
        </div>
        <div class="book-bottom"></div>
    </div>
	<input type="hidden" id="product_id" value="<?php echo intval($product->product_id);?>" />
	<input type="hidden" id="goods_id" value="<?php echo intval($product->goods_id);?>" />
	<input type="hidden" id="start_date" value= "<?php echo $order->goods_start_date;?>" />
    </form>
	
</div>
<script type="text/javascript">
	/* $(function(){
		var val_kid = 0;
		var val_adult =0;
		var selected = '';
		var num = $(".hotel-form").data("num");
		$("#order-modify-con .adultlist").live("change",function(){
			val_adult = $(this).val();
			var j = parseInt(num)-parseInt($(this).val());
			$(".kidlist").html("");
			for(var i=0;i<=j;i++){
				if(val_kid==i) selected = ' selected="selected"';
				else selected = '';
				$(".kidlist").append("<option value="+i+selected+">"+i+"</option>");
			}
		});
		
		$("#order-modify-con .kidlist").live("change",function(){
			val_kid = $(this).val();
			var j = parseInt(num)-parseInt($(this).val());
			$(".adultlist").html("");
			for(var i=0;i<=j;i++){
				if(val_adult==i) selected = ' selected="selected"';
				else selected = '';
				$(".adultlist").append("<option value="+i+selected+">"+i+"</option>");
			}
		})
		
	}) */
</script>
<script type="text/javascript">
	/* var om_txt = {
		'choose':'选择',
		'modify':'修改',
		'pleaseChoose':'请选择',
		'room':'房间',
		'adult':'成人',
		'kid':'小孩',
		'bed':'床型',
		'date':'日期',
		'time':'时间',
		'price':'价格',
		'cabin':'机舱',
		'deck':'甲板',
		'type':'类型',
		'jbpf':'分享室',
		'jjlxr':'紧急联系信息',
		'email_error':'请输入一个有效的电子邮件地址。<br/>例如fred@domain.com的。',
		'empty_tip':'请在此列表中选择一个项目。'
	}; */
	
	/* function addProduct(){
		<?php if($product->entity_type ==2):?>
		
		<?php endif?>
	
	
	  $.post(
			"<?php echo $this->controller->createUrl('basket/postShopGoods'); ?>",
			{   goods_id: $('#goods_id').val(),
				goods_start_date: start_date,
				day_step:parent.$("#pro-num").val(),
				<?php if($product->entity_type ==2):?>
				roomtype:$("#room-type-hid").val(),
				rooms:$("#housing-num").val(),	
				<?php endif?>
				adult:$("#adult").val(),
				child:$("#child").val()
				},function(data){
				if(data == "OK"){
					parent.location.reload();
				}else{
					  alert("异常错误~");
				}
			   }, "json");
	}                               */
	/* function getPriceByPost(){
		$.post(
				"<?php echo $this->controller->createUrl('goods/getPrice'); ?>",
				{   goods_id: 0,//$('#goods_id').val(),
					start_date: $('#start_date')val(),
					<?php if($product->entity_type ==2):?>
					roomtype:$("#room-type-hid").val(),
					rooms:$("#housing-num").val(),
					<?php endif?>
					adult:$("#hidadult").val(),
					child:$("#hidkid").val()
				},
				function(data){
					$("#currecy_display_usd").text(data.price);
					//$("#currecy_display_cny").text(data.price_rmb);
				},
				"json");
	} */

	$(function(){
	   //为设置游客数量绑定操作
		$('.num-setup').live('change',function(){
			var len=parseInt($('#people-len').text());
			var adlutNum=$('#adult').val();
			var adlutprice=$('#adult').data('price');
			var childNum=$('#child').val();
			var childprice=$('#child').data('price');
			var num=$(this).val();
			var price=$(this).data('price');
			var html='';
			
			if($(this).is('#adult')){
				for(var i=0;i<=len-num;i++){
					html+='<option value="'+i+'">'+i+'</option>';
				}
				$('#child').html(html);
				$('#child  option[value='+childNum+']').attr("selected", true);  
			}else{
				for(var i=1;i<=len-num;i++){
					html+='<option value="'+i+'">'+i+'</option>';
				}
				$('#adult').html(html);
				$('#adult  option[value='+adlutNum+']').attr("selected", true);
			}
			$('#currecy_display_usd em').text(parseInt(adlutNum*adlutprice+childNum*childprice).toFixed(2));
		})
		//放入行程单  日历选择回调
		$('#go-time').zyxCalendar({
			lang:'tw',
			output:'yyyy年mm月dd日 w',
			readout:true,
			range:'<?php echo ((strtotime($data['start'])<time())?date('Y-m-d'):$data['start']).":".$data['end']; ?>',
			only:[<?php if($all_arr) echo implode(',',$all_arr); ?>],
			specific:[<?php if($time_spec) echo implode(',',$time_spec); ?>],
			callback:function(v){
				$('#start_date').val(v.year+'-'+(v.month+1)+'-'+v.day);
				$('#go-time').ajaxBind({
					data:function(){
						return {start_date:v.year+'-'+(v.month+1)+'-'+v.day,product_id:$('#product_id').val()}
					},
					type:'POST'
				},{
					type:'auto',
					successMsg:false,
					onSuccess:function(data,item){
						if(data.state==1){
							$('#adult').attr('data-price',data.adult);
							$('#child').attr('data-price',data.child);
							var html="",html1="";
							var len=data.count>30?30:data.count;
							if(len!=0){
								$('#currecy_display_usd em').text(data.adult);
							}else{
								$('#currecy_display_usd em').text('0.00');
							}
							
							$('#people-len').text(len);
							for(var i=1;i<=len;i++){
								html+='<option value="'+i+'">'+i+'</option>';
								$('#adult').removeAttr('disabled').html(html);
							}
							if(data.child!='0.00'){
								$('#hotel-1-show .tip-holder').hide();
								for(var i=0;i<len;i++){
									html1+='<option value="'+i+'">'+i+'</option>';
									$('#child').removeAttr('disabled').html(html1);
								}
							}
							if(data.child=='0.00'){ //不接待小孩的情况
								$('#hotel-1-show .tip-holder').show();
								$('#child').attr('disabled',true);
							}
							
						}
					}
				})
				//getPriceByPost();
			}
		});
		//放入行程单				 
		$('#product_form').submit(function(){
			if(CLIENTSTATUS.login == true){
				$(this).ajaxBind({},{
					type:'auto',
					successMsg:false,
					onSuccess:function(data,item){
						if(data.state ==1 ){
							parent.location.href = data.url;
						}else{
							msgBoxShow(data.state,data.reason);
						}
					}
				})
			};
			return false;
		})
		/* click(function(){
			
			//else fastLogin();
		}); */
		<?php //if($product->entity_type ==2):?>
		/* var type = $("#room-type");
		var num = $("#adult-num");
		var clone;
		num.live("change",function(){
			var me = $(this);
			var i = $(this).closest(".flist").nextAll(".flist").size();
			var typeed = $(this).closest(".flist").find("#room-type  option:selected").text();
			$(this).closest(".flist").find("#room-type  option:selected").attr("selected",true);
			var j = $(this).closest(".flist").find("#room-type  option").size()-1;
			clone = $(this).closest(".flist").find("#room-type").clone().html();
			if(i<1){
				$(this).closest(".flist").find("#room-type  option:selected").remove();
				if(j>0){
					$(this).closest(".frmpop-rooms").append("<p class='flist'>"+$(this).closest(".flist").html()+"</p>");
				}
				$(this).closest(".flist").find("#room-type").html(clone);
			}
		}); */
		<?php //endif?>
	});
</script>