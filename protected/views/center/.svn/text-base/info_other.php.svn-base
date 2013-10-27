<?php
Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl.'/js/kindeditor/themes/default/default.css');
Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/js/switchable.js');
$css = '
        .send-box {background-color: #EBF7FB;border: 1px solid #D6F2FB;padding: 15px 20px;}
        .send-box h3 { color: #000;font-family: "Microsoft YaHei","黑体",sans-serif;font-size: 18px;line-height: 18px;}
        #msg-txt {background-color: #FFF;border: 1px solid #E6E7E7;color: #666;cursor:text;font-family: Tohoma,Arial,sans-serif;font-size: 14px;height: 80px;line-height: 18px;margin-top: 10px;overflow-y: hidden;padding: 5px 1%;resize: none;transition: border 0.2s linear 0s, box-shadow 0.2s linear 0s;width: 97.9%;}
        .send-tool {height: 26px;padding: 8px 5px 0;position: relative;}
        .send-tool .icon-btn { margin-right: 5px;}
        .icon-btn {display: inline-block;zoom:1;*display:inline;height: 16px;line-height: 16px;padding-left: 17px;position: relative;}
        .icon-btn em {background: url("/images/icon_btn_bg.gif") no-repeat scroll 0 0 transparent;cursor: pointer;float: left;height: 16px;left: 0;position: absolute;top: -1px;width: 16px;}
        .ke-img{background-image: url("/js/kindeditor/plugins/emoticons/images/static.gif");}
        .ke-menu-default{position: absolute; z-index: 811213;}
        .ke-plugin-emoticons .ke-cell:hover{background-color: #FFF9EC;border: 1px solid #0095CD;}
        .ke-menu a.ke-selected{color: #111;}
        .ke-plugin-emoticons .ke-preview{width: 25px;height: 25px;}
        .ke-plugin-emoticons .ke-table.block{display: block;}
        .ke-plugin-emoticons .ke-table{display: none;}';
Yii::app()->clientScript->registerCss('editor',$css);
?>
<div class="mycent-main border-gray">
		<div class="main-content-wrap">
            <div class="main-head">
                <h2 class="mycent-tit">我的简介 <a href="javascript:;" id="edit-info">编辑</a></h2>
                <div class="my-head-photo">
                    <img src="images/avatar-big1.jpg" alt="">
                    <p>自由行聘请专家</p>
                </div>
                <ul class="mycent-info1">
                    <li><label class="">职&nbsp;&nbsp;&nbsp;&nbsp;位：</label><span>自由行聘请专家</span></li>
                    <li><label class="">姓&nbsp;&nbsp;&nbsp;&nbsp;名：</label><span><?php echo $info->full_name?></span></li>
                    <li><label class="">性&nbsp;&nbsp;&nbsp;&nbsp;别：</label><span>女</span></li>
                    <li><label>精通语言：</label><span><?php echo ($info->language)?></span></li>
                    <li><label>注册日期：</label><span>2013年04月24日</span></li>
                    <li><label>所在地点：</label><span>巴黎，法兰西岛大区</span></li>
                    <li><label>导游经验：</label><span>1年</span></li>
                    <li><label>交通方式：</label><span>徒步旅游，自行车或者开车</span></li>
                    <li><label>价格/小时：</label><span>$50.00</span></li>
                    <li><label>价格/每天：</label><span>$350.00</span></li>
                </ul>
                <ul class="mycent-praise">
                    <li class="landlord"><span>我是房东</span><p class="praise"><span title="20%">20%</span><em>310 好评</em></p></li>
                    <li class="tourist-guide"><span>我是导游</span><p class="praise"><span title="30%">30%</span><em>310 好评</em></p></li>
                    <li class="merchant"><span>我是商户</span><p class="praise"><span title="35%">35%</span><em>310 好评</em></p></li>
                </ul>
                <div id="my-info" style="width: 640px;" class="undis">
                    <div class="my-info-wrap">
                        <p class="myinfo-tit">
                            带<em class="red">*</em>号的内容需要审核后方可修改，我们将在三个工作日内给您审核结果！
                        </p>
                        <ul class="nav nav-tabs">
                            <li class="active"><a class="popwin-tit" href="javascript:;">编辑个人资料</a></li>
                            <li class=""><a class="popwin-tit" href="javascript:;">编辑房东资料</a></li>
                            <li class=""><a class="popwin-tit" href="javascript:;">编辑导游资料</a></li>
                            <li class=""><a class="popwin-tit" href="javascript:;">编辑商户资料</a></li>
                        </ul>
                        <div class="mycent-nav undis">
                            <ul class="mycent-info2">
                                <li><label class="">职&nbsp;&nbsp;&nbsp;&nbsp;位：</label><input type="text" value="自由行聘请专家" class="zyx-ipt w120"><em class="red indent10">*</em></li>
                                <li><label class="">姓&nbsp;&nbsp;&nbsp;&nbsp;名：</label><input type="text" value="Adeline Marchand" class="zyx-ipt w120"><em class="red indent10">*</em></li>
                                <li><label class="">性&nbsp;&nbsp;&nbsp;&nbsp;别：</label>
                                    <select name="user[sex]" id="user_sex" class="zyx-ipt w80">
                                        <option selected="selected" value="性别">性别</option>
                                        <option value="男">男性</option>
                                        <option value="女">女性</option>
                                        <option value="other">其他</option>
                                    </select>
                                    <span class="private">保密<span class="icon icon-lock"></span></span>
                                </li>
                                <li><label>精通语言：</label>
                                    <select name="user[lan]" id="user_languages" class="zyx-ipt w80">
                                        <option selected="selected" value="中文">中文</option>
                                        <option value="法语">法语</option>
                                        <option value="英语">英语</option>
                                        <option value="德语">德语</option>
                                        <option value="意大利语">意大利语</option>
                                        <option value="other">其他</option>
                                    </select>
                                </li>
                                <li><label>注册日期：</label><span>2013年04月24日</span><em class="red indent10">*</em></li>
                                <li><label>所在地点：</label><span>巴黎，法兰西岛大区</span> <span class="private">保密<span class="icon icon-lock"></span></span></li>
                                <li><label>导游经验：</label><span>1年</span><em class="red indent10">*</em></li>
                                <li><label>交通方式：</label><span>徒步旅游，自行车或者开车</span></li>
                                <li><label>价格/小时：</label><span>$50.00</span> <span class="private">保密<span class="icon icon-lock"></span></span></li>
                                <li><label>价格/每天：</label><span>$350.00</span> <span class="private">保密<span class="icon icon-lock"></span></span></li>
                            </ul>
                            <div class="my-head-photo1">
                                <img src="images/avatar-big1.jpg" alt="">
                                <p><a href="javascript:;">更改头像</a></p>
                            </div>
                        </div>
                        <div class="mycent-nav undis">
                            <ul class="mycent-info2">
                                <li><label class="">职&nbsp;&nbsp;&nbsp;&nbsp;位：</label><input type="text" value="自由行聘请专家" class="zyx-ipt w120"><em class="red indent10">*</em></li>
                                <li><label class="">姓&nbsp;&nbsp;&nbsp;&nbsp;名：</label><input type="text" value="Adeline Marchand" class="zyx-ipt w120">
                                    <span class="private">保密<span class="icon icon-lock"></span></span>
                                </li>
                            </ul>
                        </div>
                        <div class="mycent-nav undis">
                            <ul class="mycent-info2">
                                <li><label class="">职&nbsp;&nbsp;&nbsp;&nbsp;位：</label><input type="text" value="自由行聘请专家" class="zyx-ipt w120"><em class="red indent10">*</em></li>
                                <li><label class="">姓&nbsp;&nbsp;&nbsp;&nbsp;名：</label><input type="text" value="Adeline Marchand" class="zyx-ipt w120"><em class="red indent10">*</em></li>
                            </ul>
                        </div>
                        <div class="mycent-nav undis">
                            <ul class="mycent-info2">
                                <li><label class="">职&nbsp;&nbsp;&nbsp;&nbsp;位：</label><input type="text" value="自由行聘请专家" class="zyx-ipt w120"></li>
                                <li><label class="">姓&nbsp;&nbsp;&nbsp;&nbsp;名：</label><input type="text" value="Adeline Marchand" class="zyx-ipt w120"></li>
                            </ul>
                        </div>
                    </div>
                    <div class="zyxbtn-wrap">
                        <a href="javascript:;" class="btn">确定</a>
                    </div>
                </div>
            </div>
            <div class="main-content">
                <h3 class="mycent-tit1">自我介绍</h3>
                <p>As your guide to Paris, I will do my best to make your stay unforgettable and show you the most charming face of Paris!!
                    The idea is to keep our group small in order to blend in with Parisians and the city.
                    Thus, you won't be tourists anymore, but rather locals for a few days!!</p>
                <p>I am Adeline, a 26 year old Parisian who loves Paris!!</p>
                <p>Having grown up in the Upper Marais, a very creative, trendy and historic district of Paris,
                    I'd be pleased to help you discover the cultural heritage, lifestyle, sophistication and creativity of Paris. Over time,
                    I have aquired a deep understanding of parisian life that I wish to share with you during our off the beaten-track tours.
                    I am also informed of cultural events in Paris (exhibitions, places to go out ...). Among the endless choices of activities available in Paris,
                    I will select the best on offer for you and your interests.
                    <span id="short-intro-more"> ... <a class="icon-intro-more" href="javascript:;">查看</a></span></p>
                <p id="short-intro-more-con" class="undis">I received a master's degree in 18th century French history from the Sorbonne, focusing my studies on the Grand Tour,
                    an aristocratic rite of passage. Afterward, I deepened my knowledge through various experiences: with Monique Blanc,
                    a curator of the Louvre Museum; with Franco Rendano, President of a Cultural Center in Italy; with collectors at the International Contemporary Art Fair;
                    and at the Festival of Theater in Avignon, where I was assisiting the writer Olivier Cadiot and director Ludovic Lagarde
                    <a href="javascript:;" id="short-intro-less" class="icon-intro-less">隐藏</a>
				</p>
            </div>
            <div class="pic_show">
                <h3 class="mycent-tit1">我的发布</h3>
                <div class="bx_wrap">
                    <div class="bx_container">
                        <ul id="product">
                            <li><a href="#"><img src="images/product_1.png" width="100" height="75" alt=""/><em>长滩岛，性价比最高的地方，海、美食、游泳、潜水</em></a></li>
                            <li><a href="#"><img src="images/product_1.png" width="100" height="75" alt=""/><em>这个有着燃烧壁炉的魅力公寓距离环球影城只隔几条</em></a></li>
                            <li><a href="#"><img src="images/product_1.png" width="100" height="75" alt=""/><em>长滩岛，性价比最高的地方，海、美食、游泳、潜水</em></a></li>
                            <li><a href="#"><img src="images/product_1.png" width="100" height="75" alt=""/><em>这个有着燃烧壁炉的魅力公寓距离环球影城只隔几条</em></a></li>
                            <li><a href="#"><img src="images/product_1.png" width="100" height="75" alt=""/><em>长滩岛，性价比最高的地方，海、美食、游泳、潜水</em></a></li>
                            <li><a href="#"><img src="images/product_1.png" width="100" height="75" alt=""/><em>这个有着燃烧壁炉的魅力公寓距离环球影城只隔几条</em></a></li>
                            <li><a href="#"><img src="images/product_1.png" width="100" height="75" alt=""/><em>长滩岛，性价比最高的地方，海、美食、游泳、潜水</em></a></li>
                            <li><a href="#"><img src="images/product_1.png" width="100" height="75" alt=""/><em>这个有着燃烧壁炉的魅力公寓距离环球影城只隔几条</em></a></li>
                        </ul>
                    </div>
            </div>
            </div>
            <div class="reply-wrap">
                <h3 class="mycent-tit1">你问我答</h3>
                <div class="reply-box reply-wrap1" style="position: relative;">
                    <div class="comment-form">
                        <form action="">
                            <div class="send-tool"><a href="javascript:;" class="icon-btn txt-face"><em></em>表情</a></div>
                            <textarea id="comment-txt" name="question"></textarea>
                            <a href="javascript:;" onclick="submit_question()" id="submit" class="btn send-comment">留言</a>
                            <p class="comment-function">
                                <span id="comment-tips" style="color: red; font-size: large; margin-left: 50px;"></span>
                            </p>
                        </form>
                    </div>
                    <div id="results-list">
<?php include "ask_list_item_other.php";?>
                    </div>
                </div>
		</div>
	</div>
</div>



<script type="text/javascript">

    $(function(){
        var pimg = $(".ke-preview-img");
        var kimg = $(".ke-img");
        var tf = $(".txt-face").offset();
		console.log(tf);
        var de = $(".ke-menu-default");
        var po = $(".ke-preview");
        var tr = $(".ke-table tr");
        var te = $("#comment-txt");
        var w = 205;
        var ic = $(".icon-btn");
        var j = 0;
        var t = tf.top+15;
        var l = tf.left;
        de.css({"top":t,"left":l});
        tr.each(function(i){
            tr.eq(i).find("td.ke-cell").slice(0, 5).hover(function(){
                po.css({"right":"0","display":"block"});
            },function(){
                po.css({"right":w,"display":"none"});
            });

            tr.eq(i).find("td.ke-cell").slice(5, 9).hover(function(){
                po.css({"left":"0","display":"block"});
            },function(){
                po.css({"left":w,"display":"none"});
            });
        });

        kimg.each(function(i){
            var tel=[];
            kimg.eq(i).hover(function(){
                pimg.attr("src","js/kindeditor/plugins/emoticons/images/"+i+".gif");
            });

            kimg.eq(i).bind("click",function(){
                tel = "["+i+"]";
                te.die().insertContent(tel);
                de.toggle();
            });
        })

        var page = $(".ke-page");
        var table = $(".ke-table");

        page.find("a").each(function(i){
            page.find("a").eq(i).bind("click",function(){
                page.find("a").eq(i).addClass("ke-selected").siblings("a").removeClass("ke-selected");
                table.eq(i).addClass("block").siblings().removeClass("block");
            })
        })

        de.css({"display":"none"});
        ic.click(function(){
            de.toggle();
        });
		console.log($(".txt-face").offset());
    })


    //插入光标处的插件
    $.fn.extend({
        insertContent : function(myValue, t) {
            var $t = $(this)[0];
            if (document.selection) {
                this.focus();
                var sel = document.selection.createRange();
                sel.text = myValue;
                this.focus();
                sel.moveStart('character', -l);
                var wee = sel.text.length;
                if (arguments.length == 2) {
                    var l = $t.value.length;
                    sel.moveEnd("character", wee + t);
                    t <= 0 ? sel.moveStart("character", wee - 2 * t	- myValue.length) : sel.moveStart("character", wee - t - myValue.length);
                    sel.select();
                }
            } else if ($t.selectionStart || $t.selectionStart == '0') {
                var startPos = $t.selectionStart;
                var endPos = $t.selectionEnd;
                var scrollTop = $t.scrollTop;
                $t.value = $t.value.substring(0, startPos) + myValue + $t.value.substring(endPos,$t.value.length);
                this.focus();
                $t.selectionStart = startPos + myValue.length;
                $t.selectionEnd = startPos + myValue.length;
                $t.scrollTop = scrollTop;
                if (arguments.length == 2) {
                    $t.setSelectionRange(startPos - t,$t.selectionEnd + t);
                    this.focus();
                }
            } else {
                this.value += myValue;
                this.focus();
            }
        }
    })

</script>


<script type="text/javascript">

    function submit_question(){
        var q = $('#comment-txt').val();
        $.post("<?php echo $this->createUrl('question/PostCustomer') ?>", { customer_id: "<?php echo intval($_GET['id']) ?>", question: q },
		function (data, textStatus){
			if(data[0] == 'ok'){
                $('#comment-txt').val('');
                $('#comment-tips').html('提问成功');
                $('#comment-list').prepend(data[1]);
			}else{
                $('#comment-tips').html(data);
			}
		}, "json");
    }
    $(function(){
        $(".praise").each(function(i){
            var praise = $(".praise").eq(i).find("span");
            var text = praise.text();
            praise.animate({"width":text,"position":"relative"},2000);
        });

    })

//我的发布滚动图片
    $(function(){
        $('#product').bxCarousel({
            display_num: 7,
            move: 2,
            auto: true,
            margin: 30,
            auto_hover: true
        });
    });

    //自我简介隐藏，展开
    $(function(){
        var con = $('#short-intro-more-con');
        var more = $('#short-intro-more');
        var less = $('#short-intro-less');
        if(con.length > 0){
            more.click(function(){
                con.show();
                more.hide();
                less.show();
            });
            less.click(function(){
                con.hide();
                more.show();
                less.hide();
            });
        }
    });

    $(function(){
       $("#edit-info").click(function(){
           $.popwin.show({content:'#my-info'});
       });
    });



    $(function(){
        var nav = $(".nav-tabs li");
        var tab = $(".mycent-nav");
        $(".mycent-nav:first").removeClass("undis");
        nav.each(function(i){
           nav.eq(i).bind("click",function(){
               $(this).addClass("active").siblings().removeClass("active");
               tab.addClass("undis");
               tab.eq(i).removeClass("undis");
           });
        });

        $(".btn").mousedown(function(){
            $(".btn").css({"boxShadow":"0 5px 10px -3px rgba(0, 0, 0, 0.8) inset, 0 0 0 #000000"});
        });

        $(".btn").mouseup(function(){
            $(".btn").css({"boxShadow":"0 0 0"});
        });

    });

</script>