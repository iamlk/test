<?php foreach($model as $optionGroup){ ?>
	<dl>
		<dt><?php echo $optionGroup['title']; ?></dt>
		<dd>
			<ul>
				<?php   foreach($optionGroup->siteOptions as $option){ ?>
                    
                    <?php /** diy add be leo **/ ?>
                        <?php if(intval($option['is_code']) === 1): ?>
                                <?php if($option['site_option_id'] ==36): ?>
                                <li>
            						<a class="feedback" href="<?php eval($option['php_code']); echo $tmp; ?>"><?php echo $option['title']; ?></a>
            					</li>
                                <?php else: ?>
            					<li>
            						<a href="<?php eval($option['php_code']); echo $tmp; ?>"><?php echo $option['title']; ?></a>
            					</li>
                                <?php endif; ?>
                         <?php else: ?>
        					<li>
        						<a href="<?php echo Yii::app()->createUrl('content/index',array('id'=>$option['site_option_id'])); ?>"><?php echo $option['title']; ?></a>
        					</li>
                         <?php endif; ?>   
				<?php   } ?>
			</ul>
		</dd>
	</dl>
<?php } ?>