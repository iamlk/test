<?php
/* @var $this CityController */
/* @var $model City */

$this->breadcrumbs=array(
	'Cities'=>array('index'),
	$model->city_id,
);

$this->menu=array(
	array('label'=>'List City', 'url'=>array('index')),
	array('label'=>'Create City', 'url'=>array('create')),
	array('label'=>'Update City', 'url'=>array('update', 'id'=>$model->city_id)),
	array('label'=>'Delete City', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->city_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage City', 'url'=>array('admin')),
);
Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl.'/css/base.css');
Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl.'/css/destination.css');
?>
<script>
    $(function(){
        $(".getPage").each(function(i){
            $(this).click(function(){
                var page = $(".model").eq(i).html();
                var current_page = i+1;
                location.href = "index.php?r=city/update&currentPage="+current_page+"&cityID="+<?php echo $model->city_id; ?>;
        });
    });
        $(".description").click(function(){
            location.href = "index.php?r=city/update&currentPage=nothing&cityID="+<?php echo $model->city_id; ?>;
        })
})

</script>
<div class="main-wrap clearfix pb10">
	<div class="city-left">
		<div class="summary box">
			<div class="summary-wrap">
				<img src="images/city_1.png" alt="洛杉矶"  class="city-img"/>
				<div class="details">
					<div class="summary-title"><span class="tit"><?php echo $model->name; ?></span></div>
					<p><?php echo $model->description; ?></p>
				</div>
			</div>
            <br />
			<!--<div class="summary-attractions zyxbox">-->
            <div class="summary-attractions">
               <div class="related-wrap" id="allPage">
                 <?php echo $model->content; ?></div>
                 </div>
			</div>
		</div>
</div>
