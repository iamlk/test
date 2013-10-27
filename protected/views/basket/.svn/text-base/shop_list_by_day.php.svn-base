<div class="item-tit">
            <p>您的商品清单</p>
            <span class="close"></span>
        </div>
        <div class="item-content">
        <?php foreach($detail as $i=>$d){
            $src = '/thumb/46_46/'.$d->goods->{Goods::$goods_type[$d->entity_type]}->goodsImage->path;
            $id = $d->goods->{Goods::$goods_type[$d->entity_type]}->{Goods::$goods_type[$d->entity_type].'_id'};
            $json = json_decode($d->json,true);
            if($d->entity_type==Goods::ENTITY_PRODUCT){
                $show= 'showProductDetail('.$id.')';
            }else{
                $show= 'showPropertyDetail('.$id.')';
            }
            if($d->is_deal){
        ?>
            <div id="item_<?php echo $step.'_'.$d->goods_id;?>" data-day="<?php echo $step ?>" data-id="<?php echo $d->goods_id;?>" class="product product_<?php echo $d->goods_id;?> mt0">
                <div class="product-title">
                    <label>商品类型：
                    <?php 
                    if($goods->entity_type==Goods::ENTITY_PROPERTY)
                        echo '入住度假公寓（ID:',$d->goods_id,'）';
                    else
                        echo '加入短期行程（ID:',$d->goods_id,'）';
                    ?>
                    </label>
                </div>
                <div class="product-des1">
                    <div class="fl">
                        <a href=""><img width="37" height="37" src="<?php echo $src;?>"/></a>
                    </div>
                    <div class="product-option-wrap">
                        <ul class="product-option">
                            <li><a href=""><?php echo $prduct?></a></li>
                            <li>
                                <span class="product-time">
                                <?php 
                                if($goods->entity_type==Goods::ENTITY_PROPERTY)
                                    echo '<label>入住时间：</label><em>',date('Y年m月d日',strtotime($d->goods_start_date)),'&mdash;&mdash;',date('Y年m月d日',strtotime($d->goods_end_date)),'</em>';
                                else
                                    echo '<label>出发时间：</label><em>',date('Y年m月d日',strtotime($d->goods_start_date)),'）';
                                ?>
                                </span>
                                <?php if($goods->entity_type==Goods::ENTITY_PRODUCT):?>
                                <dl class="pview2">
                                    <dd class="adult"><label>成人：</label><?php echo $json['adult'];?>人</dd>
                                    <dd class="children"><label>儿童：</label><?php echo $json['child'];?>人</dd>
                                </dl>
                                <?php endif?>
                            </li>
                            <li><label>商品价格：</label><div class="pro-price"><span class="orange">$205.00<em>(美元)</em></span> <span>11649.00<em>(人民币)</em></span></div></li>
                        </ul>
                    </div>
                    <div class="fr">
                        <ul class="product-funtion mt">
                            <li><a href="javascript:;" onclick="<?php echo $show?>;">修改</a></li>
                            <?php if($d->entity_type == Goods::ENTITY_PROPERTY) {?><li title="只从当天行程移除， 其他日期的行程内依然保留此商品"><a href="javascript:;" id="delete_<?php echo $step.'_'.$d->goods_id;?>" data-day="<?php echo $step?>" data-id="<?php echo $d->goods_id;?>" prot="<?php echo $d->entity_type; ?>" class="delete">从当天移除</a></li><?php }?>
                            <li title="您的商品将从全部行程单内删除"><a href="javascript:;" id="clear_<?php echo $step.'_'.$d->goods_id;?>" data-day="200" data-id="<?php echo $d->goods_id;?>" prot="<?php echo $d->entity_type; ?>" class="clear">从行程单移除</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        <?php }else{?>
            <div id="item_<?php echo $step.'_'.$d->goods_id;?>" data-day="<?php echo $step ?>" data-id="<?php echo $d->goods_id;?>" class="product product_<?php echo $d->goods_id;?> no-setting-wrap">
                <div class="product-title">
                    <label>商品类型：
                    <?php 
                    if($goods->entity_type==Goods::ENTITY_PROPERTY)
                        echo '入住度假公寓（ID:',$d->goods_id,'）';
                    else
                        echo '加入短期行程（ID:',$d->goods_id,'）';
                    ?>
                    </label>
                </div>
                <div class="product-des1">

                    <div class="fl">
                        <a href=""><img width="37" height="37" src="<?php echo $src;?>"/></a>
                    </div>
                    <div class="product-option-wrap">
                    <ul class="product-option">
                            <li><a href="">浪漫乡间别墅，带美丽泳池，华丽花园，靠近乌布。</a></li>
                    </ul>
                        <p class="no-setting">您还未设置此行程，请点击“修改”进行设置</p>
                    </div>
                    <div class="fr">
                        <ul class="product-funtion mt">
                            <li><a href="javascript:;" onclick="<?php echo $show?>;">修改</a></li>
                            <?php if($d->entity_type == Goods::ENTITY_PROPERTY) {?><li title="只从当天行程移除， 其他日期的行程内依然保留此商品"><a href="javascript:;" id="delete_<?php echo $step.'_'.$d->goods_id;?>" data-day="<?php echo $step?>" data-id="<?php echo $d->goods_id;?>" prot="<?php echo $d->entity_type; ?>" class="delete">从当天移除</a></li><?php }?>
                            <li title="您的商品将从全部行程单内删除"><a href="javascript:;" id="clear_<?php echo $step.'_'.$d->goods_id;?>" data-day="200" data-id="<?php echo $d->goods_id;?>" prot="<?php echo $d->entity_type; ?>" class="clear">从行程单移除</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        <?php
            }
        }
        ?>
        </div>

