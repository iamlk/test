<?php
// 过滤条
?>

                <ul class="filters-list">
                    <li>
                        <label>类型:</label>
                        <p>
                    <?php foreach (PropertyTypeAddendum::model()->local()->findAll() as $row) : ?>
                        <?php if (in_array($row->property_type_id,$this->queries['type'])) : ?>
                        <a href="<?php echo $this->createUrl('propertyList/index',$this->shiftParams(array('type'=>$row->property_type_id))); ?>" class="select">
                            <?php echo CHtml::encode($row->type) ; ?>
                        </a>
                        <?php else : ?>
                        <a href="<?php echo $this->createUrl('propertyList/index',$this->mergeParams(array('type'=>$row->property_type_id))); ?>" class="">
                            <?php echo CHtml::encode($row->type) ; ?>
                        </a>
                        <?php endif; ?>
                    <?php endforeach; ?>
                        </p>
                    </li>
                    <li>
                        <label>房间数:</label>
                        <p>
                            <?php foreach(Property::getBedroom() as $key => $v):?>
                                 <?php if (in_array($key,$this->queries['room'])) : ?>
                                <a href="<?php echo $this->createUrl('propertyList/index',$this->shiftParams(array('room'=>$key))); ?>" class="select">
                                    <?php echo CHtml::encode($v) ; ?>
                                </a>
                                <?php else : ?>
                                <a href="<?php echo $this->createUrl('propertyList/index',$this->mergeParams(array('room'=>$key))); ?>" class="">
                                      <?php echo CHtml::encode($v) ; ?>
                                </a>
                                <?php endif; ?>

                            <?php endforeach;?>

                        </p>
                    </li>
                    <li>
                        <label>床位数:</label>
                        <p>

                             <?php foreach(Property::getBeds() as $key => $v):?>
                                 <?php if (in_array($key,$this->queries['bed'])) : ?>
                                <a href="<?php echo $this->createUrl('propertyList/index',$this->shiftParams(array('bed'=>$key))); ?>" class="select">
                                    <?php echo CHtml::encode($v) ; ?>
                                </a>
                                <?php else : ?>
                                <a href="<?php echo $this->createUrl('propertyList/index',$this->mergeParams(array('bed'=>$key))); ?>" class="">
                                      <?php echo CHtml::encode($v) ; ?>
                                </a>
                                <?php endif; ?>

                            <?php endforeach;?>

                        </p>
                    </li>
                    <li>
                        <label>浴室数:</label>
                        <p>

                             <?php foreach(Property::getBathrooms(0,true) as $key => $v):?>

                                  <?php if (in_array($key,$this->queries['bath'])) : ?>

                                      <a href="<?php echo $this->createUrl('propertyList/index',$this->shiftParams(array('bath'=>$key))); ?>" class="select">
                                        <?php echo CHtml::encode($v) ; ?>
                                      </a>

                                <?php else : ?>
                                    <a href="<?php echo $this->createUrl('propertyList/index',$this->mergeParams(array('bath'=>$key))); ?>" class="">
                                          <?php echo CHtml::encode($v) ; ?>
                                    </a>
                                <?php endif; ?>

                            <?php endforeach;?>

                        </p>
                    </li>

                    <li>
                        <label>价格:</label>
                        <?php echo $this->renderPartial('_price_range'); ?>
                    </li>
                    <li>
                        <label>配套:</label>
                        <p>
                        <?php if($this->amenitys): $amenity_str = implode(',',$this->amenitys); $amenity_str = trim($amenity_str,',');   foreach (PropertyAmenityAddendum::model()->local()->findAll("property_amenity_id in ($amenity_str)") as $row) : ?>
                        
                           
                             <?php if (in_array($row->property_amenity_id,$this->queries['amenity'])) : ?>

                                      <a href="<?php echo $this->createUrl('propertyList/index',$this->shiftParams(array('amenity'=>$row->property_amenity_id))); ?>" class="select">
                                        <?php echo CHtml::encode($row->name) ; ?>
                                      </a>

                            <?php else : ?>
                                    <a href="<?php echo $this->createUrl('propertyList/index',$this->mergeParams(array('amenity'=>$row->property_amenity_id))); ?>" class="">
                                          <?php echo CHtml::encode($row->name) ; ?>
                                    </a>
                            <?php endif; ?>
                            
                        <?php endforeach; endif; ?>
                        </p>
                    </li>
                </ul>
