<link rel="stylesheet" type="text/css" href="css/raiders_release.css" />

<div class="main-wrap clearfix mt55">
    <div class="raiders_release">
        <div class="raiders_release_left">
             <h3 class="title"><em>1</em>添加攻略目的地</h3>
             <div class="content">
                 <input type="text" class="zyx-ipt ipt-tip" id="destination" maxlength="40" data-remote="/index.php?r=product/ajaxget&act=city" autocomplete="off"  />
                 <input type="hidden" name="destinationId" id="destinationId" />
                 <p class="error mt10 red">请至少为攻略关联一个目的地。</p>
                 <div class="scenic-des">
                     <ul class="scenicList">
                     <?php foreach($model->articleCity as $item){ ?>
                     <li><a href="javascript:;" data-id="<?php echo $item['city_id']; ?>" data-for="attractcityId"><?php echo $item->city['name']; ?><input type="hidden" name="acity[]" value="<?php echo $item['city_id']; ?>" /></a><em class="selecteItem"></em></li>
                     <?php } ?>
                     </ul>
                 </div>
                 <script type="text/javascript">
                     $(function(){
                         $('#destination').autoComplete({
                             parntsName:'destinationList',
                             width:183,
                             left:0,
                             top:31,
                             ajaxData:function(input){
                                 return {key:$(input).val()};
                             },
                             onInput:null,
                             onBegin:function($_this){
                                 var itemHtml=$_this.parent().siblings('.undis').html();
                                 if(itemHtml){
                                     $_this.before(itemHtml);
                                 }
                             },
                             'ajaxItem':true,
                             'onEmpty':function(input){
                                 $(input).parent().find('ul').show().html('<li class="empty">对不起,没有该目的地</li>');
                             },
                             onClick:function(input,li){
                                 $(".scenicList").val('').prepend('<li><a href="javascript:;" data-id='+$(li).data('id')+' data-for="attractcityId">'+$(li).text()+';<input type="hidden" name="acity[]" value="'+$(li).data('id')+'" /></a><em class="selecteItem"></em></li>');
                                 var valArr=$('#destinationId').val();
                                 valArr+=$(li).data('id')+",";
                                 $('#destinationId').val(valArr);
                             }
                         });
                         $('.destinationList').bind('click',function(){
                             $(this).children().focus();
                         });
                         $('.selecteItem').live('click',function(){
                             $(this).closest("li").remove();
                         });


                        var btn = $(".profession-btn");
                        btn.live("click",function(){
                            var attractcity = new Array();
                            $(".scenicList li").each(function(){
                                attractcity.push($(this).find("a").data("id"));
                            });
                            var raiderstit = $("#raiders-tit");
                            var value = raiderstit.val();
                            //var content = $(".ke-content").text();
                            var content = $('iframe.ke-edit-iframe').contents().find("body").html();
                            var valueup = "请输入攻略标题，长度为30个字以内...";
                            if(valueup == value){
                               value = "";
                            }
                            $.post("<?php echo Yii::app()->createUrl('article/'.$this->operation, array('id'=>$model['article_id'])); ?>",{cid:attractcity,title:value,content:content},
                            function(json){
                                if(json.code=='1')
                                {
                                    alert(json.msg);
                                    location.href = "<?php echo Yii::app()->createUrl('myArticle/index'); ?>";
                                }else{
                                    alert(json.msg);
                                }
                            },'json')
                        })

                        var draft = $(".draft");
                        draft.live("click",function(){
                            var attractcity = new Array();
                            $(".scenicList li").each(function(){
                                attractcity.push($(this).find("a").data("id"));
                            });
                            var raiderstit = $("#raiders-tit");
                            var value = raiderstit.val();
                            var content = $(".ke-content").text();
                            var content = $('iframe.ke-edit-iframe').contents().find("body").html();
                            var valueup = "请输入攻略标题，长度为30个字以内...";
                            if(valueup == value){
                               value = "";
                            }
                            $.post("<?php echo Yii::app()->createUrl('article/draft', array('id'=>$model['article_id'])); ?>",{cid:attractcity,title:value,content:content},
                            function(json){
                                if(json.code=='1')
                                {
                                    alert(json.msg);
                                    location.href = "<?php echo Yii::app()->createUrl('myArticle/index'); ?>";
                                }else{
                                    alert(json.msg);
                                }
                            },'json')
                        })


                     })
                 </script>
             </div>
        </div>
        <div class="raiders_release_right">
             <h3 class="title"><em>2</em>填写攻略内容</h3>
            <div class="content">
                <div class="release-content">
                    <input type="text" value="<?php echo $model['title']?$model['title']:'请输入攻略标题，长度为30个字以内...'; ?>" class="ipt-tip zyx-ipt" data-default="请输入攻略标题，长度为30个字以内..." name="tit" id="raiders-tit">
                    <div class="release-wrap">
                    <?php $this->widget('KindEditor',array('name'=>'content','value'=>$model['content'] ,'width'=>'720px','height'=>'480px','config'=>array('items'=>"['image']",'allowImageRemote'=>'false')));
                    ?>
                    </div>
                    <div class="zyxbtn-wrap">
                        <a class="profession-btn" href="javascript:;">发布</a><?php if($this->operation == 'create'){ ?><a class="draft" href="javascript::void(0);"><span class="gray indent10">保存为草稿</span></a><?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div><!--.main-wrap end-->