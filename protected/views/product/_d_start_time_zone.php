<?php $productDepartures = $model->productDepartures; if($productDepartures): ?>
<div id="room" class="detail-list">
    <div class="zyxbox-tit5">
        <h3 class="tit-color5">出发时间/地点</h3>
        <p class="tit-line"></p>
    </div>
    <div class="zyxbox-content">
        <table class="room-table">
            <tr>
                <th>时间</th>
                <th>地点</th>
            </tr>
            <?php foreach($productDepartures as $v):?>
            <tr>
                <td><?php echo $v->time; ?></td>
                <td><a href="javascript;"><?php echo $v->full_address; ?></a></td>
            </tr>
            <?php endforeach;?>
           
        </table>
    </div>
</div>
<?php endif;?>