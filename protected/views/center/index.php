
<div class="main-right">
	
    <?php include('_dynamic_index.php');?>
    

	<div class="right-wrap">
      
      <?php if(!empty($provider)):?>
		<div class="my-friends">
		   <?php include('find_friends.php');?>
		</div>
        <?php endif;?>
	<!--
	<div class="my-tour">
	   <?php // include('traveling_him.php');?> 
	</div>
	<div class="my-like">
	  <?php// include('guess_you_like.php');?> 
	</div>
	-->

		<div class="my-share">
			<?php include('travel_share.php');?> 
		</div>

        
	</div>


</div>


