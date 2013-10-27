<div id="residence"  class="detail-list">
	<div class="zyxbox-tit5">
		<h3 class="tit-color5">行程介绍</h3>
		<p class="tit-line"></p>
	</div>
	<div class="zyxbox-content">
		<table  class="table description_details table-striped">
			<tbody>
				<tr>
					<td></td>
					<td><label>出发地点：</label><?php echo $model->productStartCity->city->cityAddendumLocal->name; ?> </td>
					<td></td>
					<td><label>结束地点：</label><?php echo $model->productEndCity->city->cityAddendumLocal->name; ?></td>
					<td></td>
				</tr>
				<tr>
					<td></td>
					<td><label>出发时间：</label>  
					<?php if($model->entity_type =='1' || $model->entity_type =='3'){

							// 一日游 小时游
							$oneDayModel = $model->productOneDay;
							if($oneDayModel != null)
							{
								$start = date("Y年m月d日",$oneDayModel->start_date);
								$end =  date("Y年m月d日",$oneDayModel->end_date);
								echo $start.'--'.$end."&nbsp;:";
							}
					}else{
						$mutiDayModel = $model->productMultiDay;
							if($mutiDayModel != null)
							{
								$start = date("Y年m月d日",$mutiDayModel->start_date);
								$end =  date("Y年m月d日",$mutiDayModel->end_date);
								echo $start.'--'.$end."&nbsp;:";
							}
					}
				    ?>
					</td>
					<td></td>
					<td><!--<label>持续时间：</label> --><?php //echo $model->duration;echo $model->duration_type=="days"?"天":"区段" ?></td>
					<td></td>
				</tr>
				<tr>
					<td></td>
					<td colspan="4"><label>行程描述：</label><?php echo $model->productAddendum->description; ?></td>
				</tr>
			</tbody>
		</table>
		<div class="residence-box">
		<?php $data= $model->productDescriptions; if($data): ?>
			<ul class="route">
			   <?php foreach($data as $v):    ?>
				<li>
					<h2><?php if($model->entity_type != 3): ?> <strong>第<?php echo $v->day;?>天</strong><?php endif;?> <?php echo $v->name; ?></h2>
					<img alt="" class="route-img" src="<?php echo Yii::app()->assetManager->baseUrl.'/'.$v->url_path; ?>" />
					<div class="hotel"><?php echo $v->description ?></div>
				</li>
				<?php endforeach;?>
			</ul>
			<?php endif;?>

		</div>
	</div>
</div>