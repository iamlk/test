<div class="clear"></div>
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

<?php foreach($data as $model):?> 


        <?php /** 住房***/ ?>
        <?php if($model instanceof Property): ?>
        <?php $property = $model; ?>
		<ul class="search-list">
			<li>
			<h3>[住所]<a href="<?php echo $this->createUrl('goods/index',array('id'=>$property->goods_id)) ?>" target="_blank" > <?php echo $property->propertyAddendum->title.'('.$property->city->cityAddendum->name.')'; ?></a></h3>
			<div class="search-item">
				<a href="#" class="imgwrap"><img src="<?php echo Yii::app()->assetManager->baseUrl.'/'.$property->propertyPictures[0]->path; ?>" width="125" height="90" alt="<?php echo $property->propertyPictures->note; ?>" /></a>
				<p class="grade"><span style="width:72%">星级</span></p>
				<p class="des">			
                    <?php echo CHtml::encode(G4S::cut_string(strip_tags($property->propertyAddendum->description))); ?>
				</p>
				<p class="item-info"><?php echo $property->room; ?>个卧室&nbsp;|&nbsp;<?php $property->bathroom; ?>间浴室&nbsp;|&nbsp;入住<?php echo $property->person; ?>人&nbsp;|&nbsp;<?php echo $property->propertyType->propertyTypeAddendum->type; ?></p>
                <span color="orange" class="price"> ￥<?php echo $property->goods->price; ?></span>
			</div>
			</li>
		</ul>
        
       <?php /** 行程***/ ?> 
       <?php elseif($model instanceof Product): ?> 
       
       
      
        <?php $product = $model; ?>
		<ul class="search-list">
			<li>
			<h3>[行程]<a href="<?php echo $this->createUrl('goods/index',array('id'=>$product->goods_id)) ?>" target="_blank"> <?php echo $product->productAddendum->title.'('.$product->productStartCity->city->cityAddendum->name.')'; ?></a></h3>
			<div class="search-item">
				<a href="#" class="imgwrap"><img src="<?php echo Yii::app()->assetManager->baseUrl.'/'.$product->productImages[0]->path; ?>" width="125" height="90" alt="<?php echo $product->productImages[0]->note; ?>" /></a>
				<p class="grade"><span style="width:72%">星级</span></p>
				<p class="des">
                    <?php echo CHtml::encode(G4S::cut_string(strip_tags($product->productAddendum->description))); ?>
				</p>
				<p class="item-info">               <?php echo CHtml::encode(Yii::t('product','从{%u}出发',array('{%u}'=>$product->productStartCity->city->cityAddendum->name))).' | '; ?>

                    <?php echo CHtml::encode(Yii::t('product',"持续时间:{%u}",array('{%u}'=>$product->duration))); echo $product->entity_type== '3'?"时段":"天" ?></p>
                     <span color="orange" class="price"> ￥<?php echo $product->goods->price; ?></span>
			</div>
			</li>
		</ul>
        
       <?php /** 目的地***/ ?> 
       <?php elseif($model instanceof City): ?> 
       <?php $city = $model; ?>
		<div class="search-list view-list ">
			<h3>[目的地] <span class="key-word"></span></h3>
			<ul class="clearfix">
				<li>
					<a href="<?php echo  $this->createUrl('city/view',array('cid'=>$city->city_id)); ?>" target="_blank">
						<img src="<?php echo Yii::app()->assetManager->baseUrl.'/'.$city->image ?>" width="100" height="70" alt="" />
						<span><?php echo $city['name']; ?></span>
					</a>
				</li>
			</ul>
        </div>
        
        
        
       <?php /** 景点***/ ?> 
       <?php elseif($model instanceof Attraction): ?> 
       <?php $attracte = $model; ?>
		<div class="search-list view-list ">
			<h3>[景点] <span class="key-word"></span></h3>
			<ul class="clearfix">
				<li>
					<a href="<?php echo  $this->createUrl('attraction/index',array('id'=>$attracte->attraction_id,'cid'=>$attracte->parent_id)); ?>" target="_blank">
						<img src="<?php echo Yii::app()->assetManager->baseUrl.'/'.$attracte->image ?>" width="100" height="70" alt="" />
						<span><?php echo $attracte->addendum->name; ?></span>
					</a>
				</li>
			</ul>
        </div>
     
        <?php /** 分享行程单***/ ?> 
       <?php elseif($model instanceof Itinerary): ?> 
       <?php $itineray = $model; ?>
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
					<span> 分享(<?php echo $itineray->share_count; ?>)</span>
				</p>
				<p class="author">
					<span>分享者：</span><a href="<?php echo $this->createUrl("people/index",array("u_id"=>$itineray->customer_id));; ?>"><?php echo $itineray->customer->nick_name; ?></a>   
					<span>分享时间：</span> <?php echo date("Y-m-d",$itineray->created); ?>
				</p>
			</div>
		</div>
       <?php /** 攻略***/ ?> 
       <?php elseif($model instanceof Article): ?> 
       <?php $constract = $model; ?>
            <ul class="search-list">
			<li>
			<h3>[攻略]<a href="<?php echo $this->createUrl('article/view',array('id'=>$constract->article_id)); ?>" target="_blank"> <span class="key-word"></span><?php echo $constract->addendum->title; ?></a></h3>
			<div class="search-item">
				<a href="#" class="imgwrap"><img src="<?php echo Yii::app()->assetManager->baseUrl.'/'.$constract->image ?>" width="125" height="90" alt="" /></a>
				<p class="des">			
					<?php echo mb_substr(strip_tags($constract->addendum->content),0,50).'...';?>
				</p>
				<div class="caption">
					
					<p class="author"><span>作者：</span><a href="<?php echo $this->createUrl("people/index",array("u_id"=>$constract->customer_id)); ?>" ><?php echo $constract->customer->nick_name; ?></a>      <span>分享时间：</span> <?php echo date("Y-m-d H:i:s",$constract->created) ?></p>
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
      <?php elseif($model instanceof Food): ?> 
      <?php $food = $model; ?>
		<ul class="search-list">
			<li>
			<h3>[美食]<a href="<?php echo $this->createUrl('food/view',array('id'=>$food->food_id,'cid'=>$food->city_id)); ?>" target="_blank"> <?php echo $food->addendum->name; ?></a></h3>
			<div class="search-item">
				<a href="#" class="imgwrap"><img src="<?php echo Yii::app()->assetManager->baseUrl.'/'.$food->image ?>" width="125" height="90" alt="<?php echo $food->addendum->name; ?>" /></a>
				<p class="des">			
				<?php echo $food->addendum->description; ?>
				</p>
			</div>
			</li>
		</ul>
      <?php endif; ?>  
      <?php endforeach; ?>    
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
