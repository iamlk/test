<div class="main-wrap help-city-list">
	<div class="path-links">
		 <?php echo $this->breadcrumbs->display(); ?>
	</div>
     <?php if(($data = $dataProvider->getData())): ?> 
    	<div class="column city-list">
    		<h2><?php echo $value['name']; ?></h2>
    		<ul class="clearfix">
             <?php foreach($data as $v): ?>
    			<li>
    				<a target="_blank" title="<?php echo $v['name']; ?>" href="<?php echo $this->createUrl('attraction/index',array('cid'=> $v['parent_id'],'id'=>$v['attraction_id'])); ?>">
    					<img alt="<?php echo $v['name']; ?>" width="200" height="140" src="<?php echo Yii::app()->assetManager->baseUrl.'/'.$v['image']; ?>" />
    					<span class="city-name" style="opacity: 1;"><?php echo $v['name']; ?></span>
    				</a>
    			</li>
                <?php endforeach; ?> 
    		</ul>

	</div>
    <div class="pager" style="float:right;" >
        <?php $this->widget('application.widgets.PageToolbar' , array('pagination'=>$dataProvider->pagination, 'route'=>'content/aitem'));?>
    </div>
    
    
    <?php endif; ?>

</div>


