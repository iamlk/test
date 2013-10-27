<script type="text/javascript">
    function post_start_end_date(s_date,e_date){
        $.post(
                "<?php echo $this->controller->createUrl('basket/postShopCart'); ?>",
                {start_date:s_date,end_date:e_date},
                function(data){
                    if(data=='1001')alert('日期设置错误！');
                },
                "json"
            );
    }
    function init_from_date(s_date,e_date){
        $('#go-time').zyxCalendar({
            lang:'tw',
            output:'yyyy年mm月dd日 w',
              range:s_date+':'+e_date,
            <?php if($dates){?>disabled:[<?php echo '"',implode('","',$dates),'"'; ?>],<?php }?>
            callback:function(v){
                start_date = v.year+'-'+(v.month+1)+'-'+v.day;
                init_end_date(start_date,e_date);
                //post_start_end_date(start_date,e_date);
            }
        });
    }
    function init_end_date(s_date,e_date){
        $('#leave-time').zyxCalendar({
            lang:'tw',
            output:'yyyy年mm月dd日 w',
            range:s_date+':'+e_date,
            <?php if($dates){?>disabled:[<?php echo '"',implode('","',$dates),'"'; ?>],<?php }?>
            callback:function(v){
                end_date = v.year+'-'+(v.month+1)+'-'+v.day;
                init_from_date(s_date,end_date);
                getPriceByPost();
                //post_start_end_date(s_date,end_date);
            }
        });
    }
    $(function(){
                                <?php 
                                        $start_d    = $property->propertyPrice->start_date;
                                        $end_d      = $property->propertyPrice->end_date;
                                        $_tmp = time();
                                        $start_d = strtotime($start_d)>=$_tmp ? $start_d : date("Y-m-d",$_tmp); 
                                        $end_d = strtotime($end_d)>$_tmp ? $end_d : date("Y-m-d",$_tmp);  ?>
        init_from_date('<?php echo $start_d ;?>','<?php echo $end_d ;?>');
        init_end_date('<?php echo $start_d ;?>','<?php echo $end_d ;?>');
    });
    
        var om_txt = {
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
        };
        var goods_id = '<?php echo intval($property->goods_id)?>';
        var start_date = '';
        var end_date = '';
        function addProduct(){
          $.post(
        		"<?php echo $this->controller->createUrl('basket/postShopGoods'); ?>",
        		{goods_id: goods_id,
        		goods_start_date: start_date,
        		goods_end_date:end_date,
        		day_step:parent.$("#pro-num").val()
        		},function(data){
        			if(data.state ==1 ){
        				parent.location.href = data.url;
        			}else{
        				msgBoxShow(data.state,data.reason);
        			}
        		   }, "json");
        }  
        
        function getPriceByPost(){
            $.post(
                    "<?php echo $this->controller->createUrl('goods/getPrice'); ?>",
                    {   goods_id: goods_id,
                        start_date: start_date,
                        end_date:end_date
                    },
                    function(data){
                        $("#currecy_display_usd").text(data.price);
                        //$("#currecy_display_cny").text(data.price_rmb);
                    },
                    "json"
            );
        }
</script>

<div class="book-wrap">
     <form action="" method="post" name="book">
     <div class="book" id="unique_book">
        <div class="book-top"><span></span>请选择入住时间后放入行程单</div>
        <div id="book-con" class="book-con clearfix">
            <!--预订选项，开始-->
            <div class="book-option">
                <ul class="options">
                
                <li>
                <div class="num num1"></div>
                <div class="con">
                    <h3>请选择入住时间：</h3>
                    <div class="pview1">
                        <input type="text" class="zyx-ipt w128  calendar" value="<?php echo $order->goods_start_date?date('Y年m月d日',strtotime($order->goods_start_date)):''; ?>" id="go-time"/>
                        <label class="indent15">退房时间:</label>
                        <input type="text" class="zyx-ipt w128  calendar indent5" value="<?php echo $order->goods_end_date?date('Y年m月d日',strtotime($order->goods_end_date)):''; ?>" id="leave-time"/>
                    </div>
                    <script type="text/javascript">
                        $(function(){
                            $('#order-add-card').click(function(){
								if(CLIENTSTATUS.login == true) addProduct();
                                //else fastLogin();
							});
                        });
                        
                    </script>
                </div>
                </li>
                
                </ul>
                <div class="clear"></div>
            </div>
            <!--预订选项，结束-->

            <!--右侧预订信息，开始-->
            <div class="book-tool property-tool" id="book-tool">
                <div id="price" class="price">
                    <p>
                        <span class="currecy-type">人民币：</span>
                        <span id="currecy_display_usd" class="us">￥<?php echo $property->goods->price?></span>
                    </p>
                    <!--p class="cn">
                        <label>人民币：</label>
                        <span id="currecy_display_cny">￥<?php //echo round($property->goods->price*SiteOption::getValueByKey('USD_TO_RMB',true),2);?></span>
                    </p-->
                </div>
    
                <div class="add property-add">
                      <a id="order-add-card" class="zyxbtn1 tooltip <?php if(Yii::app()->user->isGuest)echo 'fast-login';?>">放入行程单</a>
                </div>
    
            </div>
            <!--右侧预订信息，结束-->
        </div>
        <div class="book-bottom"></div>
    </div>
    </form>
</div>
