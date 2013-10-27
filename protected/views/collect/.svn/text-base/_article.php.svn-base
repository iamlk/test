	<?php $image=explode(',',json_decode($item['img_url']));?>
		<div class="collection-list">
			<p class="collection-tit" title="<?php echo $item['title'];?>"><?php echo  mb_substr($item['title'], 0, 10);?></p>
			<?php if(!empty($image)):?>
			<ul class="clearfix">
			<?php $count=0;?>
			<?php foreach($image as $val):?>
			<?php $count++;?>
			<?php if( $count==1 ):?>
				<li class="big-img">
					<a href="<?php echo  $this->createUrl('article/view',array('id'=>$item['object_id']));?>">
						<img src="<?php echo '/thumb/233_184/'.str_ireplace('\/assets\/','\/',$val);?>" alt="" width="233" height="184" >
					</a>
				</li>
			<?php else:?> 
             <?php if($count<=4):?>
				<li>
					<a href="<?php echo  $this->createUrl('article/view',array('id'=>$item['object_id']));?>">
						<img src="<?php echo '/thumb/74_74/'.str_ireplace('\/assets\/','\/',$val);?>" alt="" width="74" height="74">
					</a>
				</li>
			  <?php endif;?>	
			<?php endif;?>
			<?php endforeach;?>
            
              <?php for($i=0;$i<(4-$count);$i++):?>
               <li></li>
              <?php endfor;?>
          
			</ul>
			<?php else:?>
			<div class="collection-text">
				<?php foreach(Dynamic::model()->getArticleDynamicInfo($item['object_id']) as $value):?>
				<?php
					$pattern="/<[img|IMG].*?src=[\'|\"](.*?(?:[\.gif|\.jpg|\.png]))[\'|\"].*?[\/]?>/";
					$str = strip_tags($value->addendum->content);
					$content = preg_replace($pattern,' ',$str);
				?>
				<p>
					<?php echo mb_substr($content, 0, 200).'......'; ?>
					<a  href="<?php $this->createUrl('article/view',array('id'=>$item['object_id']));?>" class="indent5">[详情]</a>
				</p>
				<?php endforeach;?>
			</div>
			

			<?php endif;?>
			<p class="operating">
				<input type="checkbox" name="delete">
				<span class="data"><?php echo date('Y-m-d H:i:s')?></span>
				<span class="share">
                <?php if(!SiteShare::checkIsShare($item['object_type'],$item['object_id'])):?>
					<a href="<?php echo $this->createUrl('share/it');?>?type=<?php echo $item['object_type'];?>&id=<?php echo $item['object_id'];?>" class="partake ajax-item">分享</a>
				<?php endif;?>	
				</span>
			</p>
			<a href="<?php echo $this->createUrl('collect/delete',array('type'=>$item['object_type'],'id'=>$item['object_id']))?>" class="close ajax-item delete"></a>
		</div>