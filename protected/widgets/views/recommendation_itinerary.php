<div class="zyxbox martop0">
    <div class="zyxbox-tit3">
        <h3 class="tit-color3">推荐短期行程</h3>
        <p class="tit-line"></p>
    </div>
    <div class="zyxbox-content">
        <ul class="next-city">
        <?php 
        foreach($model as $detail):
        $first = $detail->itineraryDetails[0];
        $json = json_decode($first->json,true);
        ?>
            <li>
                <a href="<?php ?>"><img alt="" src="/thumb/114_80/<?php echo $json['img'] ?>"/></a>
                <p class="next-city-name"><span><?php echo City::getCityName($first->city_id) ?></span></p>
                <p class="next-city-info">十日美东迈阿密,尼亚加拉瀑布半<span class="orange indent5">$<?php echo G4S::format($detail->cpp) ?></span></p>
            </li>
        <?php endforeach?>
        </ul>
    </div>
</div>