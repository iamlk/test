<?php 
$msg = array('destinations'=>array('title'=>'更多目的地咨询','route'=>'city/index','param'=>'cid'),
'products'=>array('title'=>'更多短期行程','route'=>'productList/index','param'=>'city'),
'properties'=>array('title'=>'更多度假公寓','route'=>'propertyList/index','param'=>'city'));
?>
<h3 class="home-tit"><?php echo $msg[$type]['title'] ?>
    <span class="indent15">请先选择您要去往的目的地</span>
    <span class="close"></span>
</h3>
<div class="home-city-list">
    <ul class="home-city-details">
    <?php foreach($data as $country):?>
        <li>
        <div class="home-city-head"><?php echo $country['name']?></div>
        <div class="home-city-detail">
        <?php 
        foreach($country['list'] as $cid => $city){
            echo CHtml::link($city,$this->createUrl($msg[$type]['route'],array($msg[$type]['param']=>$cid)),array('data-city'=>$cid));
        }
        ?>
        </div>
        </li>
    <?php endforeach?>
    </ul>
</div>