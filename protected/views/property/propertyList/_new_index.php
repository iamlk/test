<script type="text/javascript">
    $(function(){
        $.ajax({
            'url':'<?php echo Yii::app()->createUrl('site/popCity'); ?>',
            'type':'post',
            'dataType':'html',
            'data':'type=properties',
            'success':function(json){
              $('.home-city-wrap').html(json);
            },
            'error':function(){
              //alert('错误：提交失败!');
            }
        });
    });
</script>
<div class="home-city-wrap undis">
</div>
        <div class="pro-list">
            <div class="pro-scroll-wrap">
                <div class="pro-title">
                    <h1>
                        <span class="pro-city"><?php $_city = (int)Yii::app()->request->getParam('city'); $_city_obj = City::model()->findByPk($_city);  echo $_city_obj?$_city_obj->cityAddendumLocal->name:''; ?></span>
                        <a href="javascript:;" class="indent5 toggle"  id="0">切换</a>
                    </h1>
                     <?php /** 此功能被屏蔽  leo  */ ?>
                    <?php if(false): ?>
                    <div class="more-map-btn">
                        <ul>
                            <li>更多资讯</li>
                            <li>更多玩法</li>
                        </ul>
                        <span class="indent5">&gt;&gt;</span>
                    </div>
                    <?php endif; ?>
                </div>
                <div class="pro-map-nav">
                    <ul>
                        <li><a href="<?php echo $this->createUrl('productList/index',array('city'=>$_city));?>">我能做的</a><img src="/images/pro_nav_line.png" alt=""></li>
                        <li class="select"><a href="javascript:;">度假公寓</a><img src="/images/pro_nav_line.png" alt=""></li>
                    </ul>
                </div>

            </div>
            <div class="pro-list-scroll">
                <?php echo $this->renderPartial('_filter');?>
                <div class="filters-order" style="display: ;">
                     <?php if(false): /** 按推荐排列暂时取消*/  ?><label class="more-filters"><span>关闭更多过滤条件</span><em class="icon"></em></label>
                   <label class="order">按推荐排列<em class="icon"></em></label><?php endif; ?>
                </div>
                <div class="pro-list-wrap" id="pro-list-wrap">
                <?php echo $this->renderPartial('_list',array('dataProvider'=>$dataProvider)); ?>
                </div>

            </div>
        </div>
        <?php /** 此功能被屏蔽  leo  */ ?>
        <?php if(false): ?>
        <div class="pro-map">
            <div class="pro-map-tit">
                <img src="/images/pro-map-more.png" alt="">
                <span class="map-max indent10"></span><span class="map-min indent10"></span>
                <p class="map-mode">地 图 模 式</p>
                <div class="pro-map-wrap">
                    <iframe class="iframe"  width="500" height="400" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="http://maps.google.com/maps?f=q&source=s_q&geocode=&q=Comfort+Suite+Inn+Rosemead,+9488+Valley+Blvd,+Rosemead,+CA&aq=&sll=34.081028,-118.063008&sspn=0.016386,0.027595&vpsrc=0&ie=UTF8&hq=Comfort+Suite+Inn+Rosemead,+9488+Valley+Blvd,+Rosemead,+CA&hnear=&radius=15000&t=m&ll=34.081028,-118.063008&spn=0.128792,0.09099&output=embed"></iframe><br />
                        <small><a href="http://maps.google.com/maps?f=q&source=embed&geocode=&q=Comfort+Suite+Inn+Rosemead,+9488+Valley+Blvd,+Rosemead,+CA&aq=&sll=34.081028,-118.063008&sspn=0.016386,0.027595&vpsrc=0&ie=UTF8&hq=Comfort+Suite+Inn+Rosemead,+9488+Valley+Blvd,+Rosemead,+CA&hnear=&radius=15000&t=m&ll=34.081028,-118.063008&spn=0.128792,0.09099" style="color:#0000FF;text-align:left">View Larger Map</a></small>
                </div>


            </div>

        </div>
        <?php endif; ?>
