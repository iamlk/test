	<ul id="slideshow">
    <?php $a=true;
          foreach($model as $item){ ?>
    <?php if($a){
          $a=false;
    ?>
      <li style="background-image: url('assets/<?php echo $item['image']; ?>');display: block;">
    <?php }else{ ?>
      <li style="background-image: url('assets/<?php echo $item['image']; ?>');">
    <?php } ?>
     <!-- <img width="1300" height="500"  src="images/banner_1.jpg" alt="卡西塔斯Kinsol招待所">-->
            <a  href="<?php echo $item['jump_url']; ?>"  class="caption clearfix">
                <span class="banner-avatar"><img width="56" height="56" src="/thumb/56_56/<?php echo $item['avatar']; ?>" alt=""/></span>
                <span class="caption-info">
                    <strong><span><?php echo $item['name']; ?></span></strong><br/>
                    <span class="color-gray"><?php echo mb_substr($item['title'],0,15); ?></span>
                    <span  class="price"><?php echo CURRENCY.$item['price']; ?></span>
                    <?php echo $item['assess']; ?>
              </span>
            </a>
      </li>
      <?php } ?>
      </ul>