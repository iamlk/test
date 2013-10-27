<ul class="info-list review-list">
	<li>
	   <span class="label">每天接待人数上限: </span>
	   <!--<span>成人<?php echo $note->max_per_day_num_for_adults; ?>儿童:<?php echo $note->max_per_day_num_for_kids; ?>儿童最小年龄: <?php echo $note->min_age_for_kids; ?> 岁</span>-->
    	<span><?php echo $note->max_per_day_num_for_adults == 0?"无限制":$note->max_per_day_num_for_adults; ?></span>
	</li>
    <?php if(false): ?>
	<li>
    	<span class="label">酒店房间预订上限: </span>
    	<span><?php echo $note->max_hotle_booking; ?> </span>
	</li>
	<li>
    	<span class="label">每间人数上限: </span>
    	<!--<span>成人<?php echo $note->max_room_for_adults; ?>儿童:<?php echo $note->max_room_for_kids; ?></span>-->
        <span><?php echo $note->max_room_for_adults; ?></span>
    </li>
	<li>
        <span class="label">每间床位数: </span>
    	<span><?php echo $note->max_room_bed; ?> </span>
	</li>
    <?php endif; ?>
</ul>