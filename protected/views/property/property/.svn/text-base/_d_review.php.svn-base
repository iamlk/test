                <div class="review-content">
                    <ul class="talk-list">
                    <?php foreach ( $property->ReviewInfo['reviews'] as $row ) : ?>
                        <li>
                            <div class="talk-user-pic">
                                <a href="<?php echo $this->createUrl('',array('customer_id'=>$row['customer_id'])); ?>">
                                  <img width="48" height="48" src="<?php echo Yii::app()->assetManager->baseUrl.'/'.$row['customers_avatar']; ?>" /></a>
                                <p><a href="<?php echo $this->createUrl('',array('customer_id'=>$row['customer_id'])); ?>"><?php echo($row['customers_name']);?></a></p>
                            </div>
                            <div class="talk-content">
                                <p class="talk-user-info"><?php echo($row['title']);?>
                				  <span class="favorite-grade1"><?php echo($row['satisfaction_face_0']);?>
					                <label><?php echo($row['satisfaction_0']);?>%</label>
                                    <!--各个评论的浮出评分框-->
					                <span class="tooltip-con cmt-tooltip">
						              <strong>评分详情：</strong><br />
				                      <label>符合描述：</label><?php echo($row['satisfaction_img_1']);?>
					                  <span><?php echo($row['satisfaction_msg_1']);?></span><br />
		                              <label>交流沟通：</label><?php echo($row['satisfaction_img_2']);?>
						              <span><?php echo($row['satisfaction_msg_2']);?></span><br />
		                              <label>环境卫生：</label><?php echo($row['satisfaction_img_3']);?>
						              <span><?php echo($row['satisfaction_msg_3']);?></span><br />
		                              <label>配套设施: </label>：</label><?php echo($row['satisfaction_img_4']);?>
						              <span><?php echo($row['satisfaction_msg_4']);?></span><br />
		                              <label>地理位置: </label>：</label><?php echo($row['satisfaction_img_5']);?>
						              <span><?php echo($row['satisfaction_msg_5']);?></span><br />
		                              <label>性价比: </label>：</label><?php echo($row['satisfaction_img_6']);?>
						              <span><?php echo($row['satisfaction_msg_6']);?></span><br />
					                </span>
                                    <!--各个评论的浮出评分框结束-->
			            	      </span>
                                </p>
                                <div class="msg-box"><?php echo($row['description']);?></div>
                                <div class="talk-info">
                                    <p class="talk-time">评论时间：<?php echo($row['created']);?></p>
                                    <p class="talk-function" property_review_id="<?php echo $row['property_review_id']; ?>">
                                    <span class="tip" id="helpful_tip_<?php echo($row['property_review_id']);?>"><?php echo Yii::t('info', '此评论对我'); ?></span>
                                    <a href="javascript:;" class="helpful_yes_counter helpful_<?php echo($row['property_review_id']);?>" ><?php echo Yii::t('info', '有用'); ?>(<label id="helpful_yes_<?php echo($row['property_review_id']);?>"><?php echo($row['helpful_yes_counter']);?></label>)</a>
                                    <a href="javascript:;" class="helpful_no_counter helpful_<?php echo($row['property_review_id']);?>" ><?php echo Yii::t('info', '没用'); ?>(<label id="helpful_no_<?php echo($row['property_review_id']);?>"><?php echo($row['helpful_no_counter']);?></label>)</a>
                                    <a href="javascript:;" class="reply login-to-reply-form" ><?php echo Yii::t('info', '回复'); ?>(<?php echo(count($row['replies']));?>)</a>
                                    </p>
                                </div>
                                <div class="comment-form undis" id="comment_<?php echo($row['property_review_id']);?>">
                            <form>
                                <textarea name="" class="comment-txt"></textarea>
                                <a class="btn send-comment" data-id="<?php echo $row['property_review_id']; ?>" href="javascript:;" >评论</a>
                                <!--addReviewReply(<?php echo($row['property_review_id']); ?>)-->
                            </form>
                        </div>
    		<?php if ($row['replies']) : ?>
    		<!--回复列表-->
    		<ul class="reply-list">
    			<?php foreach ($row['replies'] as $k=>$rep) : ?>
    			<li class="<?php echo(($k+1==count($row['replies']))?'last':'');?>">
    				<span class="num">#<?php echo($k+1);?></span>
    				<span class="time"><?php echo($rep['created']);?></span>
    				<div class="reply-con">
    					<span class="name"><a href="<?php echo $this->createUrl('travelCompanion/individualSpace',array('customer_id'=>$rep['customer_id'])); ?>" target="_blank">
    						<?php echo($rep['customers_name']);?></a></span><?php echo Yii::t('info', '回复说'); ?>：
    					<p><?php echo($rep['description']);?></p>
    				</div>
    			</li>
    			<?php endforeach; ?>
    		</ul>
    		<!--回复列表，结束-->
    		<?php endif; ?>
                            </div>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                </div>

<div class="pager cmt-pager">
<?php
$this->widget('application.widgets.PageToolbar' , array('pagination'=>$model->ReviewInfo['pagination'], 'ajaxContainerId'=>'results-list', 'useAjax'=>true, 'route'=>'property/reviewPages'));
?>
</div>
