<?php
//$extensions = $property->propertyExtensions;
$extensions = $property->amenity;
$extensions = json_decode($extensions,true);

if (!$extensions) return;
?>
                <div id="public-facilities"  class="detail-list">
                    <div class="zyxbox-tit5">
                        <h3 class="tit-color5">公共设施</h3>
                        <p class="tit-line"></p>
                    </div>
                    <div class="zyxbox-content">
                        <div class="tab-pane details_content active" id="amenities-panel">
                            <ul class="unstyled">
                            <?php foreach (PropertyAmenity::getPropertyAmenities() as $row) : ?>
                                <?php
                                $_key = $row['property_amenity_id'];
                                $_value = $row['name'];
                                //$_checked = !!array_filter($extensions, create_function('$a', 'return $a["type"]=="amenity" and $a["key"]=="'.$_key.'";'));
                                $_checked = in_array($_key,$extensions);
                                ?>
                                <li>
                                <?php if ($_checked) : ?>
                                    <i rel="tooltip" class="icon icon-large icon-ok-sign green" title="提供/允许便利设施"></i>
                                <?php else : ?>
                                    <i rel="tooltip" class="icon icon-large icon-ban-circle red" title="不提供/不允许便利设施"></i>
                                <?php endif; ?>
                                <?php echo CHtml::encode($_value); ?>
                                </li>
                            <?php endforeach; ?>
                          
                            </ul>
                            <div class="clear"></div>
                        </div>
                    </div>
                </div>
