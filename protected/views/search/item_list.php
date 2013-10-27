<div class="main-wrap clearfix search">
<?php $this->renderPartial('_menu',array('count'=>$count)); ?>  


	<div class="main-right search-wrap">
		<h2 class="title"> 所有“<span class="key-word"><?php echo urldecode($this->_key); ?></span>”内容</h2>
        
        <?php if($act === 'property'): ?>
		<ul class="search-list">
        	<?php if($data):?>
            <?php foreach($data as $property): ?>
			<li>
			<h3><a href="<?php echo $this->createUrl('goods/index',array('id'=>$property->goods_id)) ?>" target="_blank" > <?php echo $property->propertyAddendum->title.'('.$property->city->cityAddendum->name.')'; ?></a></h3>
			<div class="search-item">
				<a href="#" class="imgwrap"><img src="<?php echo Yii::app()->assetManager->baseUrl.'/'.$property->propertyPictures[0]->path; ?>" width="125" height="90" alt="<?php echo $property->propertyPictures->note; ?>" /></a>
				<p class="grade"><span style="width:72%">星级</span></p>
				<p class="des">			
					<?php //echo $property->propertyAddendum->description; ?>
                     <?php echo CHtml::encode(G4S::cut_string(strip_tags($property->propertyAddendum->description))); ?>
				</p>
				<p class="item-info"><?php echo $property->room; ?>个卧室&nbsp;|&nbsp;<?php echo $property->bathroom; ?>间浴室&nbsp;|&nbsp;入住<?php echo $property->person; ?>人&nbsp;|&nbsp;<?php echo $property->propertyType->propertyTypeAddendum->type; ?></p>
                <span color="orange" class="price"> ￥<?php echo $property->goods->price; ?></span>
			</div>
			</li>
            <?php endforeach;?>
            <li style="border: 0px;">
                <div class="pager" style="float:right;" >
                <?php $this->widget('application.widgets.PageToolbar' , array('pagination'=>$pages, 'route'=>'search/index'));?>
                </div>
            </li>
            <?php endif;?>
		</ul>
        <?php endif; ?>
        
         <?php if($act === 'tour'): ?>
		<ul class="search-list">
		<?php if($data):?>
            <?php foreach($data as $product): ?>
            	<li>
    			<h3><a href="<?php echo $this->createUrl('goods/index',array('id'=>$product->goods_id)) ?>" target="_blank"> <?php echo $product->productAddendum->title.'('.$product->productStartCity->city->cityAddendum->name.')'; ?></a></h3>
    			<div class="search-item">
    				<a href="#" class="imgwrap"><img src="<?php echo Yii::app()->assetManager->baseUrl.'/'.$product->productImages[0]->path; ?>" width="125" height="90" alt="<?php echo $product->productImages[0]->note; ?>" /></a>
    				<p class="grade"><span style="width:72%">星级</span></p>
    				<p class="des">			
    					<?php //echo $product->productAddendum->description; ?>
                        <?php echo CHtml::encode(G4S::cut_string(strip_tags($product->productAddendum->description))); ?>
    				</p>
    				<p class="item-info">               <?php echo CHtml::encode(Yii::t('product','从{%u}出发',array('{%u}'=>$product->productStartCity->city->cityAddendum->name))).' | '; ?>
    
                        <?php echo CHtml::encode(Yii::t('product',"持续时间:{%u}",array('{%u}'=>$product->duration))); echo $product->entity_type== '3'?"时段":"天" ?></p>
                         <span color="orange" class="price"> ￥<?php echo $product->goods->price; ?></span>
    			</div>
    			</li>
                
            <?php endforeach;?>
            <li style="border: 0px;">
                <div class="pager" style="float:right;" >
                <?php $this->widget('application.widgets.PageToolbar' , array('pagination'=>$pages, 'route'=>'search/index'));?>
                </div>
            </li>
        <?php endif;?>
		</ul>
        <?php endif; ?>
       
        <?php if($act === 'city'): ?>
			<h3> <span class="key-word"></span></h3>
			<ul class="search-list">
            <?php if($data):?>
            <?php foreach($data as $v): ?>
				<li>
					<a href="<?php echo  $this->createUrl('city/view',array('cid'=>$v->city_id)); ?>" target="_blank">
						<img src="<?php echo Yii::app()->assetManager->baseUrl.'/'.$v->image ?>" width="100" height="70" alt="" />
						<span><?php echo $v->addendum->name; ?></span>
					</a>
				</li>
             <?php endforeach; ?>
             <li style="border: 0px;">
                <div class="pager" style="float:right;" >
                <?php $this->widget('application.widgets.PageToolbar' , array('pagination'=>$pages, 'route'=>'search/index'));?>
                </div>
            </li>
             <?php endif;?>   
			</ul>
	
        <?php endif;?> 
        
        
        
	 
       <?php if($act === 'attract'): ?>
			<h3> <span class="key-word"></span></h3>
			<ul class="search-list">
            <?php if($data):?>
            <?php foreach($data as $v): ?>
				<li>
					<a href="<?php echo  $this->createUrl('attraction/index',array('id'=>$v->attraction_id,'cid'=>$v->parent_id)); ?>" target="_blank">
						<img src="<?php echo Yii::app()->assetManager->baseUrl.'/'.$v->image ?>" width="100" height="70" alt="" />
						<span><?php echo $v->addendum->name; ?></span>
					</a>
				</li>
             <?php endforeach; ?>
             <li style="border: 0px;">
                <div class="pager" style="float:right;" >
                <?php $this->widget('application.widgets.PageToolbar' , array('pagination'=>$pages, 'route'=>'search/index'));?>
                </div>
            </li>
             <?php endif;?>   
			</ul>
	
        <?php endif;?>
        
        <?php if($act === 'share'): ?>
         <?php if($data):?>
          <?php foreach($data as $itineray): ?>
        <div class="search-list itin-list">
			<h3>[行程单] <a  href="<?php echo Yii::app()->createUrl('itinerary/view',array('id'=>$itineray->itinerary_id)); ?>" target="_blank" ><?php echo $itineray->title;  ?></a></h3>
            <?php $objs = $itineray->itineraryDetails;
            
               $images = array();
               foreach($objs as $v)
               {
                 $json = $v->json;
                 if($json)
                 {
                    $_t_arr = json_decode($json,true);
                    if($_t_arr)
                    {
                        $images[$_t_arr['_id']]['img'] = $_t_arr['img'];
                        $images[$_t_arr['_id']]['title'] = $_t_arr['title'];
                    }
                 }
               }
               
            
             ?>
			<ul class="clearfix">
            <?php if($images): ?>
             <?php $i=0; $prex = Yii::app()->assetManager->baseUrl;?>
              <?php foreach($images as $v): if($i<5): ?>
				<li>
					<a href="javascript:;">
						<img src="<?php echo $v['img']?$prex.'/'.$v['img']:''; ?>" width="120" height="80" alt="<?php echo $v['title'] ?>" title="<?php echo $v['title'] ?>" />
					</a>
				</li>
                  <?php endif; $i++;  endforeach;?>    
            <?php endif;?>    
			</ul>
			<div class="caption">
                <p>
					<span>阅读(<?php echo $itineray->view_count; ?>)</span>
					<span>回复(<?php echo $itineray->reviewCount; ?>)</span>
					<span>收藏(<?php  echo SiteCoolCount::getFavorite(md5((Dynamic::TRAVEL).($itineray->itinerary_id))) ?>)</span>
					<span>分享(<?php echo $itineray->share_count; ?>)</span>
				</p>
				<p class="author">
					<span>分享者：</span><a href="<?php echo $this->createUrl("people/index",array("u_id"=>$itineray->customer_id));; ?>"><?php echo $itineray->customer->nick_name; ?></a>    
					<span>分享时间：</span> 
					<?php echo date("Y-m-d",$itineray->created); ?>
				</p>
			</div>
		</div>
           <?php endforeach; ?>
        <div class="pager" style="float:right;" >
                <?php $this->widget('application.widgets.PageToolbar' , array('pagination'=>$pages, 'route'=>'search/index'));?>
        </div>
          <?php endif; ?>
     <?php endif; ?>
        
         <?php if($act === 'constract'): ?>
            <ul class="search-list">
            <?php if($data):?>
            <?php foreach($data as $constract):?>
			<li>
			<h3><a href="<?php echo $this->createUrl('article/view',array('id'=>$constract->article_id)); ?>" target="_blank"><span class="key-word"></span><?php echo $constract->addendum->title; ?></a></h3>
			<div class="search-item">
				<a href="#" class="imgwrap"><img src="<?php echo Yii::app()->assetManager->baseUrl.'/'.$constract->image ?>" width="125" height="90" alt="" /></a>
				<p class="des">			
					<?php echo mb_substr(strip_tags($constract->addendum->content),0,50).'...';?>
				</p>
				<div class="caption">
				
					<p class="author"><span>作者：</span><a href="<?php echo $this->createUrl("people/index",array("u_id"=>$constract->customer_id)); ?>"><?php echo $constract->customer->nick_name; ?> </a>     <span>分享时间：</span> <?php echo date("Y-m-d H:i:s",$constract->created) ?></p>
				</div>
			</div>
			</li>
            <?php endforeach; ?>
            <li style="border: 0px;">
                <div class="pager" style="float:right;" >
                <?php $this->widget('application.widgets.PageToolbar' , array('pagination'=>$pages, 'route'=>'search/index'));?>
                </div>
            </li>
            <?php endif; ?>
		</ul>
        <?php endif;?>
	 <?php if( false && $data['together']):?>
         <?php $together = $data['together']; ?>
		<ul class="search-list">
			<li>
			<h3><a href="<?php $this->createUrl('travelCompanion/view',array('id'=>$together->travel_companion_id)); ?>" target="_blank">[结伴贴] <?php echo $together->title; ?></a></h3>
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
      
         <?php if($act === 'food'): ?>
      
         <?php $food = $data['food'];  ?>
		<ul class="search-list">
           <?php if($data): ?>
           <?php foreach($data as $food):?>
			<li>
			<h3><a href="<?php echo $this->createUrl('food/view',array('id'=>$food->food_id,'cid'=>$food->city_id)); ?>" target="_blank"> <?php echo $food->addendum->name; ?></a></h3>
			<div class="search-item">
				<a href="#" class="imgwrap"><img src="<?php echo Yii::app()->assetManager->baseUrl.'/'.$food->image ?>" width="125" height="90" alt="" /></a>
				<p class="des">			
				<?php echo $food->addendum->description; ?>
				</p>
			</div>
			</li>
           <?php endforeach;?>
           <li style="border: 0px;">
                <div class="pager" style="float:right;" >
                <?php $this->widget('application.widgets.PageToolbar' , array('pagination'=>$pages, 'route'=>'search/index'));?>
                </div>
            </li> 
           <?php endif;?> 
		</ul>
         <?php endif;?>
         
          <?php if($act === 'no'): ?>

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
         <?php endif;?>
		<div></div>
	</div>
    </div>
