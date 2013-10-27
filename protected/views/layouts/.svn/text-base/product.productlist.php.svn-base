<?php /* @var $this Controller */ ?>
<?php /* 产品.列表.房子 */ ?>
<?php $this->beginContent('//layouts/product.list'); ?>
                <ul class="filters-list">
                    <li>
                        <label>行程类型:</label>
                        <p>
                           <?php $this->renderDynamic("typeList"); ?>
                        </p>
                    </li>
                    <li>
                        <label>途径景点:</label>
                        <p>
                            <?php $this->renderDynamic("getAttractionList"); ?>
                        </p>
                    </li>

                    <li>
                        <label>持续时间:</label>
                        <p>
                         <?php $this->renderDynamic("getDayList"); ?>
                        </p>
                    </li>
                </ul>
                <div class="filters-order">
                    <label class="more-filters">展开更多过滤条件<em class="icon"></em></label><label class="order">按推荐排列<em class="icon"></em></label>
                </div>
                <div class="pro-list-wrap">
                    <?php echo $content; ?>
                    <div id="loading"></div>
                    <div id="loading-pro">查看更多商品</div>
                </div>
<?php $this->endContent(); ?>
