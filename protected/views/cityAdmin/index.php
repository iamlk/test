<?php
/* @var $this CityController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Cities',
);

$this->menu=array(
	array('label'=>'Create City', 'url'=>array('create')),
	array('label'=>'Manage City', 'url'=>array('admin')),
);

Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl.'/css/destination_index.css');
Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl.'/css/admin_base.css');
?>
	<div class="sub-content">
		<table class="table1 zebra row-hl" border="0" cellpadding="0" cellspacing="0">
			<thead>
				<tr>
					<th>ID</th>
					<th>City Name</th>
					<th>Time</th>
					<th>User</th>
					<th>Operate</th>
					<th>Set active</th>
				</tr>
			</thead>
			<tbody>
            <?php foreach($model as $item){ ?>
				<tr>
					<td><?php echo $item->city_addendum_temporary_id; ?></td></td>
					<td><?php echo $item->name; ?></td>
					<td><?php echo date('Y-m-d H:i:s', $item->created); ?></td>
					<td><?php echo '此处调用用户表数据' ?></td>
					<td><a href="<?php echo Yii::app()->createUrl('cityAdmin/view', array('id'=>$item->city_addendum_temporary_id)); ?>" class="show-more">Detail</a></td>
					<td><a class="state-default" href="javascript:;"></a></td>
				</tr>
            <?php } ?>
			</tbody>
		</table>
	</div>
    <script>
        $(function(){
            $(".state-default").toggle(
              var i;
              function(){
                $(this).css({"backgroundPosition":"3px -21px"});
                i=0;

              },function(){
                $(this).css({"backgroundPosition":"3px 3px"});
                i=1;
              }
            );
        });
    </script>
