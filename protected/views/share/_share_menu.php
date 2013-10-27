<ul class="cons-list-tit fl width60">
     
    <li class="first<?php if(!$_GET['type'] || $_GET['type']=='all') echo ' nav';?>">
		<a href="<?php echo $this->createUrl('share/index',array('type'=>'all'))?>">全部</a>
	</li> 
     
	<li class="<?php if($_GET['type']==Dynamic::PROPERTY) echo ' nav';?>">
		<a href="<?php echo $this->createUrl('share/property',array('type'=>Dynamic::PROPERTY))?>">住所</a>
	</li>
	<li <?php if($_GET['type']==Dynamic::PRODUCT) echo ' class="nav"';?> >
		<a href="<?php echo $this->createUrl('share/product',array('type'=>Dynamic::PRODUCT))?>">行程</a>
	</li>
	<li <?php if($_GET['type']==Dynamic::TRAVEL) echo ' class="nav"';?> >
		<a href="<?php echo $this->createUrl('share/travel',array('type'=>Dynamic::TRAVEL))?>">行程单</a>
	</li>
	<li <?php if($_GET['type']==Dynamic::ARTICLE) echo ' class="nav"';?> >
		<a href="<?php echo $this->createUrl('share/article',array('type'=>Dynamic::ARTICLE))?>">攻略</a>
	</li>
	<li <?php if($_GET['type']==Dynamic::DELICACY) echo ' class="nav"';?> >
		<a href="<?php echo $this->createUrl('share/delicacy',array('type'=>Dynamic::DELICACY))?>">美食</a>
	</li>
    	<li <?php if($_GET['type']==Dynamic::CITY) echo ' class="nav"';?> >
		<a href="<?php echo $this->createUrl('share/city',array('type'=>Dynamic::CITY))?>">城市</a>
	</li>
    </li>
    	<li <?php if($_GET['type']==Dynamic::RESTAURANT) echo ' class="nav"';?> >
		<a href="<?php echo $this->createUrl('share/restaurant',array('type'=>Dynamic::RESTAURANT))?>">餐厅</a>
	</li>
    
    </li>
    	<li <?php if($_GET['type']==Dynamic::ATTRACTION) echo ' class="nav"';?> >
		<a href="<?php echo $this->createUrl('share/attraction',array('type'=>Dynamic::ATTRACTION))?>">景点</a>
	</li>
    
    
	<li class="end<?php if($_GET['type']==Dynamic::ALBUMIMAGE) echo ' nav';?>">
		<a href="<?php echo $this->createUrl('share/album',array('type'=>Dynamic::ALBUMIMAGE))?>">图片</a>
	</li>
</ul>