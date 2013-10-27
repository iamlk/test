    		<div class="zyxbox">
    			<div class="zyxbox-tit3">
    				<h3 class="tit-color3"><?php echo Yii::t('info', '结伴同游贴'); ?><?php if($model){ ?><a href="<?php echo Yii::app()->createUrl('travelcompanion/index'); ?>"><?php echo Yii::t('info', '更多'); ?></a><?php } ?></h3>
    				<p class="tit-line"></p>
    			</div>
    			<div class="zyxbox-content">
    				<ul class="comp-list">
                    <?php foreach($model as $item){ ?>
    					<li>
    						<a class="comp-tit" target="_blank" title="<?php echo $item['title']; ?>" href="<?php echo Yii::app()->createUrl('travelcompanion/view', array('id'=>$item['travel_companion_id'])); ?>"><?php echo $item['title']; ?></a>
    						<p class="comp-detail"><?php echo mb_substr($item['content'], 0, 20); ?>...</p>
    						<p class="comp-info">
    						<?php echo date('Y/m/d',time($item['updated'])); ?><a target="_blank" href=""><?php echo $item->customer['full_name']; ?></a>
                            <?php
                            Switch($item->customer['gender'])
                            {
                                case 0:echo '女士';break;
                                case 1:echo '先生';break;
                                case 2:break;
                            }
                            ?>发布
    						</p>
    					</li>
                    <?php } ?>
    				</ul>
    			</div>
    		</div>