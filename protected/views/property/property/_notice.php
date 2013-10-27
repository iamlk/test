<div id="notes"  class="detail-list">
    <div class="zyxbox-tit5">
        <h3 class="tit-color5"><?php echo Yii::t('property','注意事项'); ?></h3>
        <p class="tit-line"></p>
    </div>
    <div class="zyxbox-content">
       
       
        <table>
        <?php $manual = $property->propertyAddendum->manual; if($manual):?>
                <tr>
                    <th>
                   <p><label><?php echo Yii::t('property','《房屋守则》'); ?></label></p>
                  </th>
                </tr>
        
                <tr>
                    <td>
                       <?php echo CHtml::decode($manual); ?>
                    </td>
                </tr>
        <?php endif;?>
        
         <?php $direction = $property->propertyAddendum->direction; if($direction):?>
                <tr>
                    <th>
                   <p><label><?php echo Yii::t('property','路线说明'); ?></label></p>
                  </th>
                </tr>
        
                <tr>
                    <td>
                        <?php echo $direction; ?>
                    </td>
                </tr>
        <?php endif;?>
        
         <?php $other = $property->propertyAddendum->other; if($other):?>
                <tr>
                    <th>
                   <p><label><?php echo Yii::t('property','其他信息'); ?></label></p>
                  </th>
                </tr>
        
                <tr>
                    <td>
                        <?php echo $other; ?>
                    </td>
                </tr>
        <?php endif;?>
        
        
        </table>
    </div>
</div>
