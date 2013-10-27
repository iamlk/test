<div class="main-wrap help-city-list">
	<div class="path-links">
	  <?php echo $this->breadcrumbs->display(); ?>
	</div>
     <?php if($country_city): ?> 
     
	<div class="column">
    
		<h2>所有目的地</h2>
       <?php foreach($country_city as $value): ?>
		<div class="all-city-list">
			<h3><?php echo $value['name']; ?></h3>
            <?php if($value['list']): ?>
                <?php foreach($value['list'] as $k => $v): ?>
    			 <a href="#<?php echo $value['id'] ?>" class="cur_test"><?php echo $v; ?></a>
                 <?php endforeach; ?> 
            <?php endif; ?>
		</div>
       <?php endforeach; ?> 
	</div>
    
    <?php /** 上面国家 下面展示 **/?>
    
    
    	<div class="column city-list">
        <?php foreach($country_city as $value): ?>
        <?php $data = $value['data']; if($data): ?>
           
    		<h2 id="<?php echo $value['id']; ?>" ><?php echo $value['name']; ?><a href="<?php echo $this->createUrl('content/list',array('id'=> $value['id'])); ?>" class="more">更多 &gt;&gt;</a></h2>
    		<ul class="clearfix">
             <?php foreach($data as $v): ?>
    			<li>
    				<a  title="<?php echo $v['city_name']; ?>" href="<?php echo Yii::app()->createUrl('city/index',array('cid'=>$v['city_id'])); ?>">
    					<img alt="<?php echo $v['city_name']; ?>" width="200" height="140" src="/thumb/200_140/<?php echo $v['image']; ?>" />
    					<span class="city-name" style="opacity: 1;"><?php echo $v['city_name']; ?></span>
    				</a>
    			</li>
                <?php endforeach; ?> 
    		</ul>
            
        <?php endif; ?>
	    <?php endforeach; ?> 
	</div>
    <?php endif; ?>

</div>

<?php   include('_list_js.php');    ?>


