<div id="stationmsg">
	<ul class="system-info-list">
	  <?php foreach($sms->getData() as $item):?>
		   <li>
			   <h3>站内信
			   <span><?php echo date('Y-d-m H:i:s',$item['created'])?></span>
			   <a href="<?php echo $this->createUrl('center/deletemessage',array('id'=>$item['site_inner_sms_id'],'type'=>'station'));?>" class="delete ajax-item"></a>
			   </h3>
			   <p><?php echo $item['content']?></p>
		   </li>

		<?php endforeach;?>           
	</ul>
<?php
$this->widget('application.widgets.PageToolbar' , array('pagination'=>$sms->pagination, 'ajaxContainerId'=>'stationmsg','useAjax'=>true, 'route'=>'center/stationpage'));
?>
</div>