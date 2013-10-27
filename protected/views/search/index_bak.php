<div class="main-wrap clearfix search">
<?php if(false): ?>
	<div class="main-left search-nav">
		<a href="javascript:;" class="cur">全部（<span><?php echo array_sum($count); ?></span>）</a>
		<a href="javascript:;">住所（<span><?php echo $count['tour']; ?></span>）</a>
		<a href="javascript:;">行程（<span><?php echo $count['property']; ?></span>）</a>
		<a href="javascript:;">景点（<span><?php echo $count['attract']; ?></span>）</a>
		<a href="javascript:;">行程单（<span><?php echo $count['share']; ?></span>）</a>
		<a href="javascript:;">攻略（<span><?php echo $count['constract']; ?></span>）</a>
		<a href="javascript:;">结伴帖（<span><?php echo $count['together']; ?></span>）</a>
		<a href="javascript:;">美食（<span><?php echo $count['food']; ?></span>）</a>		
	</div>
<?php endif; ?>
<?php $this->renderPartial('_menu',array('count'=>$count)); ?>    
	<div class="main-right search-wrap">
		<h2 class="title"> 所有“<span class="key-word"><?php echo urldecode($this->_key); ?></span>”内容</h2>
       

        
<?php if($data): ?>        
        <?php $property = $data['property']; ?>
		<ul class="search-list">
			<li>
			<h3>[住所]<a href="<?php echo $this->createUrl('goods/index',array('id'=>$property->goods_id)) ?>" target="_blank" > <?php echo $property->propertyAddendum->title.'('.$property->city->cityAddendum->name.')'; ?></a></h3>
			<div class="search-item">
				<a href="#" class="imgwrap"><img src="<?php echo Yii::app()->assetManager->baseUrl.'/'.$property->propertyPictures[0]->path; ?>" width="125" height="90" alt="<?php echo $property->propertyPictures->note; ?>" /></a>
				<p class="grade"><span style="width:72%">星级</span></p>
				<p class="des">			
					<?php echo $property->propertyAddendum->description; ?>
				</p>
				<p class="item-info"><?php echo $property->room; ?>个卧室&nbsp;|&nbsp;2个卫生间&nbsp;|&nbsp;入住<?php echo $property->person; ?>人&nbsp;|&nbsp;<?php echo $property->propertyType->propertyTypeAddendum->type; ?></p>
			</div>
			</li>
		</ul>
      
        <?php $product = $data['tour']; ?>
		<ul class="search-list">
			<li>
			<h3>[行程]<a href="<?php echo $this->createUrl('goods/index',array('id'=>$product->goods_id)) ?>" target="_blank"> <?php echo $product->productAddendum->title.'('.$product->productStartCity->city->cityAddendum->name.')'; ?></a></h3>
			<div class="search-item">
				<a href="#" class="imgwrap"><img src="<?php echo Yii::app()->assetManager->baseUrl.'/'.$product->productImages[0]->path; ?>" width="125" height="90" alt="<?php echo $product->productImages[0]->note; ?>" /></a>
				<p class="grade"><span style="width:72%">星级</span></p>
				<p class="des">			
					<?php echo $product->productAddendum->description; ?>
				</p>
				<p class="item-info">               <?php echo CHtml::encode(Yii::t('product','从{%u}出发',array('{%u}'=>$product->productStartCity->city->cityAddendum->name))).' | '; ?>

                    <?php echo CHtml::encode(Yii::t('product',"持续时间:{%u}",array('{%u}'=>$product->duration))); echo $product->entity_type== '3'?"小时":"天" ?></p>
			</div>
			</li>
		</ul>
       
     <?php $attractes = $data['attract']; ?>
		<div class="search-list view-list ">
			<h3>[景点] <span class="key-word"></span></h3>
			<ul class="clearfix">
            <?php foreach($attractes as $v): ?>
            <?php //print_r($v->attributes); ?>
         
				<li>
					<a href="<?php echo  $this->createUrl('attraction/index',array('id'=>$v->attraction_id,'cid'=>$v->parent_id)); ?>" target="_blank">
						<img src="<?php echo Yii::app()->assetManager->baseUrl.'/'.$v->image ?>" width="100" height="70" alt="" />
						<span><?php echo $v->addendum->name; ?></span>
					</a>
				</li>
             <?php endforeach; ?>   
			</ul>
		</div>
     
        <?php if(false):?>
		<div class="search-list itin-list">
			<h3>[行程单] 自己量身定做的<span class="key-word">马尔代夫</span>10日游自由行5人出行</h3>
			<ul class="clearfix">
				<li>
					<a href="#">
						<img src="/images/location_1.png" width="120" height="80" alt="" />
					</a>
				</li>
				<li>
					<a href="#">
						<img src="/images/location_1.png" width="90" height="80" alt="" />
					</a>
				</li>
				<li>
					<a href="#">
						<img src="/images/location_1.png" width="60" height="80" alt="" />
					</a>
				</li>
				<li>
					<a href="#">
						<img src="/images/location_1.png" width="60" height="80" alt="" />
					</a>
				</li>
				<li>
					<a href="#">
						<img src="/images/location_1.png" width="40" height="80" alt="" />
					</a>
				</li>
				<li>
					<a href="#">
						<img src="/images/location_1.png" width="90" height="80" alt="" />
					</a>
				</li>
			</ul>
			<div class="caption">
				<p>参考次数<span>(30)</span>   照片分享<span>(16)</span>   游客评论<span>(7)</span></p>
				<p class="author"><span>分享者：</span>天天      <span>分享时间：</span> 2013年04月01日</p>
			</div>
		</div>
        <?php endif; ?>
      
         <?php $constract = $data['constract']; ?>
            <ul class="search-list">
			<li>
			<h3>[攻略]<a href="<?php echo $this->createUrl('article/view',array('id'=>$constract->article_id)); ?>" target="_blank"> <span class="key-word"></span><?php echo $constract->addendum->title; ?></a></h3>
			<div class="search-item">
				<a href="#" class="imgwrap"><img src="<?php echo Yii::app()->assetManager->baseUrl.'/'.$constract->image ?>" width="125" height="90" alt="" /></a>
				<p class="des">			
					<?php echo mb_substr(strip_tags($constract->addendum->content),0,50).'...';?>
				</p>
				<div class="caption">
					<p class="grade"><span style="width:72%">星级</span></p>
					<p class="author"><span>作者：</span><?php echo $constract->customer->nick_name; ?>      <span>分享时间：</span> <?php echo date("Y-m-d H:i:s",$constract->created) ?></p>
				</div>
			</div>
			</li>
		</ul>
    
        
        <?php /** 备注 结伴贴模块屏蔽  add be leo ***/ ?>
	 <?php if( false && $data['together']):?>
         <?php $together = $data['together']; ?>
		<ul class="search-list">
			<li>
			<h3>[结伴贴]<a href="<?php $this->createUrl('travelCompanion/view',array('id'=>$together->travel_companion_id)); ?>" target="_blank"><?php echo $together->title; ?></a></h3>
			<div>
				<p class="des">			
					<?php echo $together->content; ?><br />
					出行时间： <?php echo $together->departure_date; ?><br />
					
				</p>
				<div class="caption">
				
					<p class="author"><span>作者：</span><?php echo $together->customer_name; ?><span>分享时间：</span> <?php echo $together->created; ?></p>
				</div>
			</div>
			</li>
		</ul>
        <?php endif;?>
      
         <?php $food = $data['food'];  ?>
		<ul class="search-list">
			<li>
			<h3>[美食]<a href="<?php echo $this->createUrl('food/view',array('id'=>$food->food_id)); ?>" target="_blank"> <?php echo $food->addendum->name; ?></a></h3>
			<div class="search-item">
				<a href="#" class="imgwrap"><img src="<?php echo Yii::app()->assetManager->baseUrl.'/'.$food->image ?>" width="125" height="90" alt="" /></a>
				<p class="des">			
				<?php echo $food->addendum->description; ?>
				</p>
			</div>
			</li>
		</ul>
        
		<div>
        <ul>
        <li style="border: 0px;">
                <div class="pager" style="float:right;" >
                <?php $this->widget('application.widgets.PageToolbar' , array('pagination'=>$pages, 'route'=>'search/index'));?>
                </div>
            </li>
        </ul>
      
        <?php  else: ?>
        	<ul class="search-list">
            <li>
                <div class="product-wrap">
                   O(∩_∩)O哈哈~  没有找到哦
                </div>
                <hr />
                <div class="product-wrap" style="color: orange;">
                <ul class="search-list">
                <?php for($i=9;$i<15;$i++): ?>
                <li>Yii实现分页的两种方法,一种是用DAO实现,另外一种是在widget实现.各有优点吧,第一种效率会高一点, 第二种可以使用自带的表格,方便一些.一. DAO实现分页....</li>
                <?php endfor; ?>
                </ul>
                
                </div>
                
            </li>
		</ul>
        <?php endif; ?>
        
        </div>
        
	</div>
    </div>
