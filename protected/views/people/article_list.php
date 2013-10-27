<div class="zyxbox-content" id="results-list">
<?php foreach($data->getData() as $item ):?>
   
   

            <li>
                <div class="raiders-wrap">
                    <h2><a href="<?php echo $this->createUrl('article/view',array('id'=>$item->article_id))?>"><?php echo $item->addendum->title;?></a></h2>
                    <p class="raiders-time">发布时间：<em><?php echo date('Y-m-d h:i:s',$item->created);?></em></p>
                    
                 <?php
                $pattern="/<[img|IMG].*?src=[\'|\"](.*?(?:[\.gif|\.jpg|\.png]))[\'|\"].*?[\/]?>/";
                $str = strip_tags($item->addendum->content);
                $content = preg_replace($pattern,' ',$str);
                ?>
                    
                    <p class="raiders-info"><?php echo mb_substr($content, 0, 100).'......'; ?></p>
                    <div class="raiders-bottom">
                        <!--<a href="###">回复</a><em>(<?php echo Dynamic::model()->getCommentCounts(Dynamic::ARTICLE,$item->article_id); ?>)</em><i>|</i>-->
                        <a href="<?php echo $this->createUrl('article/view',array('id'=>$item->article_id))?>">阅读</a><em>(<?php echo $item->visit;?>)</em><i>|</i>
                        <a class="share ajax-item" href="<?php echo $this->createUrl('share/it');?>?type=<?php echo Dynamic::ARTICLE;?>&id=<?php echo $item->article_id;?>">分享</a><em>(<?php  echo SiteShare::model()->myCount(Dynamic::ARTICLE,$item->article_id); ?>)</em><i></i>
                       
                        
                        <a href="<?php echo $this->createUrl('article/view',array('id'=>$item->article_id))?>" class="reveiw">阅读全文 >></a>
                    </div>
                </div>
            </li>
            
<?php endforeach;?>
<?php
$this->widget('application.widgets.PageToolbar' , array('pagination'=>$data->pagination, 'ajaxContainerId'=>'results-list','useAjax'=>true, 'route'=>'people/companion'));
?>
</div>