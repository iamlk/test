	<div class="main-right">
        <ul class="authenticate-list">
            <li class="identity"><h3>身份认证</h3><p>未认证</p></li>
            <li class="landlord"><h3>房东认证</h3><p>未认证</p></li>
            <li class="business"><h3>商家认证</h3><p>未认证</p></li>
            <li class="tourist"><h3>导游认证</h3><p>未认证</p></li>
        </ul>
        <div class="collection-list-index-wrap">
            <div class="collection-list-index">
                <ul>
                    <li class="big-img">
                        <a href="<?php echo $this->createUrl('people/sellerhouse',array('u_id'=>$this->uid));?>"><img width="233" height="184" alt="" src="../images/common/collection_1.png"></a>
                    </li>
                </ul>
                <div class="clear"></div>
                <p class="operating collection-info">住所（<?php echo $housecount['count']?>） </p>
            </div>
            <div class="collection-list-index">
                <ul>
                    <li class="big-img">
                        <a href="<?php echo $this->createUrl('people/sellershortrun',array('u_id'=>$this->uid));?>"><img width="233" height="184" alt="" src="../images/common/collection_3.png"></a>
                    </li>
                </ul>
                <div class="clear"></div>
                <p class="operating collection-info"> 短期行程（<?php echo $shortcount['count']?>） </p>
            </div>
            <!--<div class="collection-list-index">
                <ul>
                    <li class="big-img">
                        <a href="#"><img width="233" height="184" alt="" src="../images/common/collection_4.png"></a>
                    </li>
                </ul>
                <div class="clear"></div>
                <p class="operating collection-info">评论（<?php echo $plcount['count']?>） </p>
            </div>-->
        </div>
     </div>