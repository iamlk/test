<div id="sysmsg">
      <ul class="system-info-list">
      
          <?php foreach($sysmsg->getData() as $m):?>
			   <li>
				    <h3>系统通知<span><?php echo date('Y-m-d H:i:s',$m['created'])?></span>
						<a href="<?php echo $this->createUrl('center/deletemessage',array('id'=>$m['site_inner_sms_id'],'type'=>'sysmsg'));?>" class="ajax-item delete"></a>
				    </h3>
				    <p><?php echo $m['content']?></p>
			   </li>
            <?php endforeach;?>           
      </ul>
      <?php
$this->widget('application.widgets.PageToolbar' , array('pagination'=>$sysmsg->pagination, 'ajaxContainerId'=>'sysmsg','useAjax'=>true, 'route'=>'center/sysmsgpage'));
?>
</div>        