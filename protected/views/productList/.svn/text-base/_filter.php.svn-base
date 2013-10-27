<ul class="filters-list">
                   <?php if($filterData[0]): ?>
                    <li>
                        <label>行程类型:</label>
                        <p class="filters-type">
                        <?php foreach($filterData[0] as $k=>$v):?>
                         <?php if (in_array($k,$this->queries['type'])) : ?>
                                    <a href="<?php echo $this->createUrl('productList/index',$this->shiftParams(array('type'=>$k))); ?>" class="select">
                                        <?php echo CHtml::encode($v);?><em class="delete">×</em>
                                    </a>
                             <?php else : ?>
                                    <a href="<?php echo $this->createUrl('productList/index',$this->mergeParams(array('type'=>$k))); ?>" class="">
                                        <?php echo CHtml::encode($v) ; ?>
                                    </a>

                            <?php endif;?>
                            <?php endforeach;?>
                        </p>
                    </li>
                    <?php endif;?>
                    <?php if($filterData[1]): ?>
                    <li>
                        <label>途径景点:</label>
                        <p>
                        <?php foreach($filterData[1] as $k=>$v):?>
                         <?php if (in_array($k,$this->queries['attraction'])) : ?>
                                    <a href="<?php echo $this->createUrl('productList/index',$this->shiftParams(array('attraction'=>$k))); ?>" class="select">
                                        <?php echo CHtml::encode($v);?><em class="delete">×</em>
                                    </a>
                             <?php else : ?>
                                    <a href="<?php echo $this->createUrl('productList/index',$this->mergeParams(array('attraction'=>$k))); ?>" class="">
                                        <?php echo CHtml::encode($v) ; ?>
                                    </a>

                            <?php endif;?>
                            <?php endforeach;?>
                        </p>
                    </li>
                    <?php endif;?>

                     <?php if($filterData[2]): ?>
                    <li>
                        <label>持续时间:</label>
                        <p>
                        <?php foreach($filterData[2] as $k=>$v):?>
                         <?php if (in_array($k,$this->queries['day'])) : ?>
                                    <a href="<?php echo $this->createUrl('productList/index',$this->shiftParams(array('day'=>$k))); ?>" class="select">
                                        <?php echo CHtml::encode($v);?><em class="delete">×</em>
                                    </a>
                             <?php else : ?>
                                    <a href="<?php echo $this->createUrl('productList/index',$this->mergeParams(array('day'=>$k))); ?>" class="">
                                        <?php echo CHtml::encode($v) ; ?>
                                    </a>

                            <?php endif;?>
                            <?php endforeach;?>
                        </p>
                    </li>
                    <?php endif;?>

</ul>