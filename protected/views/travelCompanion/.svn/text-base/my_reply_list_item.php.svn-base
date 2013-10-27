<div class="mytours-reply-table">
    <div class="mytours-search-btn">
        <span>关键字</span>
        <input type="text" id="tc_keyword" class="zyx-ipt searchtxt ipt-tip" title="请输入关键字，进一步搜索" data-default="请输入关键字，进一步搜索" name="tc_keyword">
        <a onclick="search_reply()" href="javascript:;" class="zyxbtn3">搜索</a>

    </div>
    <form id="mytours-search-form" action="#" method="get">
        <table>
            <thead>
            <tr>
                <th>回帖内容</th>
                <th>&nbsp;</th>
                <th>原贴标题</th>
                <th>最后更新</th>
                <th>操作</th>
            </tr>
            </thead>
            <tbody id="myreplys">
<?php foreach($reply as $r){ ?>
            <tr user-data="<?php echo $r->travel_companion_reply_id ?>">
                <td>
                    <p class="old-reply-content"><?php echo $r->content ?></p>
                    <div class="new-reply-wrap undis">
                        <input type="text" class="new-reply-content msg-txt zyx-ipt" value="">
                        <ul class="new-reply-btn">
                            <li><a href="javascript:;" class="zyxbtn3 reply-submit">确定</a></li>
                            <li><a href="javascript:;" class="zyxbtn3 reply-reset">取消</a></li>
                        </ul>
                    </div>
                </td>
                <td>&nbsp;&nbsp;</td>
                <td><?php echo CHtml::link($r->travelCompanion->title,$this->createUrl('travelCompanion/view',array('id'=>$r->travelCompanion->travel_companion_id)))?></td>
                <td><?php echo $r->created?><br/><span class="gray">(<?php echo $r->updated ?> 更新)</span></td>
                <td><span class="reply-edit">编辑</span></td>
            </tr>
<?php }?>
            </tbody>
        </table>

    </form>
</div>