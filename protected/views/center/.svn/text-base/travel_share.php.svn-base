    <h3 class="h3-style YH">行程分享</h3>
                <div class="tab-nav">
                    <span class="select">热门</span><em>|</em><span>最新</span>
                </div>
                <div class="share-tab">
                    <ul class="share-list">
                       <?php foreach($hot as $item):?>
                    
                        <li>
                             <a target="_blank" href="<?php echo $this->createUrl('itinerary/view',array('id'=>$item['itinerary_id']))
?>"><?php echo $item['title']?></a>
                            <p> <?php echo date('Y-m-d H:i:s',$item['created']);?></p>
                        </li>
                        <?php endforeach;?>
                    </ul>
                </div>
                <div class="share-tab">
                    <ul class="share-list">
                        <?php foreach($new as $item):?>
                       
                        <li>
                            <a target="_blank" href="<?php echo $this->createUrl('itinerary/view',array('id'=>$item['itinerary_id']))
?>"><?php echo $item['title']?></a>
                            <p> <?php echo date('Y-m-d H:i:s',$item['created']);?></p>
                        </li>
                        <?php endforeach;?>
                    </ul>
                </div>