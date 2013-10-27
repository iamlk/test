<?php
Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl.'/css/order_confirm.css');

Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl.'/css/page.css');
Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl.'/widget/country_selector/country_selector.css');
Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/widget/country_selector/country_selector.js');
Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl.'/widget/zyxcalendar/zyxcalendar.css');
Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl.'/widget/zyxcalendar/zyxcalendar.js');

$this->beginContent('//layouts/base.without.footer'); ?>


<div class="main-wrap clearfix pb10 mt55">
    <div class="order-top">
        <div class="breadcrumbs">
            <?php $this->breadcrumbs->display();?>
        </div>
        <div class="order-number">
            <ul class="order-number-list">
                <li><strong>订单编号：<?php echo $order->order_code ?></strong></li>
                <li><strong>订单状态：<span class="orange">待支付</span></strong></li>
                <li>下单时间：<?php echo date('Y-m-d H:i:s',$order->created) ?></li>
            </ul>
            <p>请您在 <?php echo G4S::seconds2day($order->expired-time()); ?> 内完成本次交易的付款，否则订单将逾期自动取消。</p>
            <p><a  href="javascript:;" class="zyxbtn3">立即支付</a><a  href="javascript:;" class="zyxbtn3 returnedit">返回编辑</a></p>
        </div>
    </div>
	<div class="order-wrap">
         <h2 class="order-tit left-line-blue"><span class="confirm">确认行程单</span><span class="data">(<?php echo date('Y年-m月-d日---',strtotime($order->start_date)),date('Y年-m月-d日',strtotime($order->end_date)) ; ?>)</span>
             <span class="constact undis">有问题？ <a href="###">咨询四海网</a></span></h2>


        <div class="order-content">
        <div class="product-wrap left-line-blue">
            <div class="product mt0">
                <div class="product-tit">
                    <label>主联系人信息：</label>
                    <p><label>&nbsp;</label></p>
                </div>
               <div class="product-content">
                   <div class="product-des">
                       <ul class="customer-list fl">
                           <li>
                               <p><label>英文姓：</label><span class="en-fri-name"><?php echo $order->last_name ?></span></p>
                               <p><label>英文名：</label><span class="en-sec-name"><?php echo $order->first_name ?></span></p>
                           </li>
                           <li>
                               <p><label>国&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;家：</label><span class="city"><?php echo Country::getCountryName($order->country_id); ?></span></p>
                               <p><label>手 机 号：</label><span class="pho-num"><?php echo $order->cellphone ?></span></p>
                           </li>
                           <li>
                               <p><label>邮箱地址：</label><span class="email"><?php echo $order->email ?></span></p>
                           </li>
                       </ul>

                   </div>
                   <a href="javascript:;" class="human-updata">修改</a>
               </div>

                <div class="product-content-1 undis">
                    <div class="product-des">
                            <ul class="customer-list fl">
                                <li>
                                    <p><label>英文姓：</label><input type="text" value="<?php echo $order->last_name ?>" class="zyx-ipt w120  new-en-fri-name" name="last_name" required="false" data-messages="required:输入的英文姓不能为空"> </p>
                                    <p><label>英文名：</label><input type="text" value="<?php echo $order->first_name ?>"  class="zyx-ipt w120  new-en-sec-name" name="first_name" required="false" data-messages="required:输入的英文名不能为空"></p>
                                </li>
                                <li>
                                    <p><label>国&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;家：</label>
                                    <?php
                                         // 国家
                                            $htmlOptions = array('prompt'=>CHtml::encode(Yii::t('form','请选择...')),'class'=>'zyx-ipt w120  new-city','required'=>true,'data-messages'=>'required:<i></i>请选择国家');
                                            echo CHtml::dropDownList('country_id',intval($order->country_id),Property::getCountries(),$htmlOptions);
                                        ?>
                                    </p>
                                    <p><label>手 机 号：</label><input type="text" value="<?php echo $order->cellphone ?>"  class="zyx-ipt w120  new-pho-num" name="cellphone" data-rules="tell:true" data-messages="required:<i></i>手机号码不能为空,tell:<i></i>请输入正确的手机号码"></p>
                                </li>
                                <li>
                                    <p><label>邮箱地址：</label><input type="text" value="<?php echo $order->email ?>"  class="zyx-ipt w120  new-email" name="email" required="false"  data-rules="email:true" data-messages="required:<i></i>邮箱地址不能为空,email:<i></i>请输入正确的邮箱地址"></p>
                                </li>
                            </ul>

                    </div>
                    <p class="zyxbtn-wrap">
                        <a class="zyxbtn2" href="javascript:;" id="customer-ok">确定</a>
                    </p>
                </div>

            </div>
        </div>
<?php 
$g_array = array(); 
foreach($list as $i => $p){
    if(!$p[1]) continue;
?>
            <div class="itinerary left-line-blue">
                <em class="itinerary-icon"><?php echo ($i+1);?></em>
                <h3 class="itinerary-num">
                    <span class="itinerary-num-indent">第<?php echo G4S::num2char($i+1); ?>天 <?php echo $p[0] ?> 去往 <?php echo City::getCityName($p[1])?></span>
                </h3>
            </div>
            <div class="product-wrap left-line-blue">
<?php 
    foreach($p as $j =>$d){
        if($j<=1) continue;
        $src = '/thumb/46_46/'.$d->goods->{Goods::$goods_type[$d->entity_type]}->goodsImages[0]->path;
        $price = G4S::format($d->price);
        $json = json_decode($d->json,true);
?>
                <div class="product <?php if($j==0) echo 'mt0'?>">
                    <div class="product-tit">
                        <label>商品类型：
                        <?php 
                        if($d->entity_type==Goods::ENTITY_PROPERTY)
                            echo '入住度假公寓（ID:',$d->goods_id,'）';
                        else
                            echo '加入短期行程（ID:',$d->goods_id,'）';
                        ?>
                        </label>
                    </div>
                    <div class="product-des">
                        <div class="fl">
                            <a href="<?php echo $this->createUrl('goods/index',array('id'=>$d->goods_id));?>">
                            <img width="37" height="37" src="<?php echo $src?>"/>
                            </a>
                        </div>
                        <div class="product-option-wrap">
                            <ul class="product-option">
                                <li>
                                <?php echo CHtml::link($json['title'],$this->createUrl('goods/index',array('id'=>$d->goods_id)));?>
                                </li>
                                <li>
                                <?php if($d->entity_type==Goods::ENTITY_PROPERTY):?>
                                    <span class="product-time">
                                    <label>入住时间：</label>
                                    <em><?php echo date('Y年m月d日',strtotime($d->goods_start_date)),'&mdash;&mdash;',date('Y年m月d日',strtotime($d->goods_end_date));?></em>
                                    </span>
                                <?php else:?>
                                    <span class="product-time">
                                    <label>出发时间：</label>
                                    <em><?php echo date('Y年m月d日',strtotime($d->goods_start_date))?></em>
                                    </span>
                                    <dl class="pview">
                                        <dd class="adult"><label>成人：</label><?php echo intval($json['adult'])?>人</dd>
                                        <dd class="children"><label>儿童：</label><?php echo intval($json['child'])?>人</dd>
                                    </dl>
                                <?php endif?>
                                </li>
                                <?php 
                                    if(!in_array($d->goods_id,$g_array)){
                                        $g_array[]=$d->goods_id;
                                ?>
                                <li><label>商品价格：</label><strong class="orange">$<?php echo $price?></strong><label class="indent5">(人民币)</label></li>
                                <?php }?>
                            </ul>
                        </div>
                        <div class="fr">
                            <ul class="product-funtion mt">
                                <!--li><a href="javascript:;" class="updata" data-id="<?php echo $d->goods_id?>">修改</a></li>
                                <li><a href="javascript:;" class="delete" data-id="<?php echo $d->goods_id?>">从当天移除</a></li-->
                            </ul>
                        </div>
                    </div>
                </div>
    <?php }?>
            </div>
<?php } ?>
        </div>
         <div class="overview">
             <div class="fl">
                 <div class="order-msg">
                     <h5>预订留言：</h5>
                     <textarea class="zyx-ipt" id="msg-txt">我已经定了航班，请尽快确认我的订单，谢谢。</textarea>
                 </div>
             </div>
             <div class="fr">
                 <ul class="price-list">
                     <li><span>您共需支付：</span><strong id="final-price" class="final-price">￥<?php echo G4S::format($order->payment_total)?></strong></li>
                 </ul>
             </div>
         </div>
</div><!--.main-wrap end-->

 <div class="order-pay mt30">
     <div class="zyxbox mt0 bd0">
         <div class="pay-box">
         <div class="pay-con-box">
         <div class="payment-con" id="pay-card-box" style="display: block;">
             <form id="pay-card-form" method="post" action="##">
                 <h2>信用卡支付<span>信用卡支付币种为美元，请确保信用卡有足够的余额或足够的支付限额。</span></h2>
                 <h3>四海网获得美国Better Business Bureau（BBB）的A-优秀评级，将确保您所有支付操作的安全，请放心使用信用卡支付。</h3>

                 <div class="agreement">
                     <div class="agreement-con">
                         <h3>客户协议</h3>
                         <p>请在预订和购买四海网（go4seas.com）网站上的旅行团以及旅行团相关的产品前仔细阅读此顾客须知的各项条款，以便您能全面了解双方的权利和责任。作为四海网的顾客，您必须认同您所阅读的内容，理解并同意以下各项条款，并赞成其所有内容, 包括其它的一些更新， 四海网保持最终解释权。</p>


                         <h4>旅行权益</h4>
                         <p>导游在旅行途中会为客人推荐自费项目，客人自主决定是否参加。
                             行程中导游若有违反合同之处，旅客有权抵制。如有争议，请旅客和导游先行友好协商，并请及时联络我们反馈，我们将协调解决。为了有效的维护旅客的利益，请旅客在争端开始前联络我们调解。行程结束之后的投诉，如无证据证明，旅行社保留不予受理的权力。
                             线路产品组成要素，均为经过四海网严格考评甄选出的具备相关资质的地接社提供，四海网只对其硬件设施等标准的描述和承诺承担责任，不对其在您消费过程中可能涉及的人员软性服务或者不可抗力造成的不便承担责任。</p>


                         <h4>您的资格</h4>
                         <p>您必须是18岁或18岁以上的个体。 如果您未满18岁, 您可以在父母或法律监护人的带领下使用四海网。</p>

                         <h4>您的责任</h4>
                         <p>在您预订前, 您有责任阅读所有和您想要购买团的相关信息，包括∶价格与通知、路线介绍、 团费包含哪些，不包含哪些、取消和退款政策、各项条款，以及特别提示等。一旦您阅读并充分理解其所有内容后，在购买后就不得有任何异议。</p>

                         <h4>订票程序及电子版团票</h4>
                         <p>1.在您提交预订之后，您立马会通过E-Mail收到一个预订收据。<br>
                             2.在您提交预订的一两个工作日内，您会收到我们发给您的确认邮件。<br>
                             3.电子版团票会在您出发前的二至三天，或者更快的时间内，通过邮件发送给您，在电子版团票里我们会提供您出团的所有详细信息。为了您的方便与再次确认，当地旅行团供应商的信息我们将一并发送给您。<br>
                             4.您只需要打印出您的电子版团票，并在出团当天附上您带有照片的有效身份证，出示给导游便可以了。 请记住，电子版团票是您的购买凭证。<br>

                             您可以在出发前联系您的航班和当地旅行团供应商以再次确定您的抵达接机事宜。</p>

                         <h4>隐私及数据收集</h4>
                         <p>四海网 是网站收集信息的唯一所有者， 我们不会把信息出卖、分享或是租赁给任何团体。四海网 从不同的站点收集用户信息，用以处理订单和更好的用相关信息为您服务。信息包括姓名、运送地址、帐户地址、电话号码、电子邮件地址以及付款信息，比如信用卡。四海网 还需要您提交您的用户名及密码以便访问您的信息。您得保证您的用户名和密码是机密的并不能与其它任何人分享。<br>

                             四海网的信息安全使用将会在隐私和安全政策里详细介绍. 四海网的隐私和安全政策是此协议的一部分，并且您同意给予我们对其所提及数据的使用权，不视之为侵犯您的隐私和公众权利。</p>

                         <h4>注册及登录</h4>
                         <p>为了让您更方便及时地参与四海网推出的一些优惠活动，我们可能会设置：当您登录您在四海网注册会员使用的邮箱并点击四海网注册或者活动的邮件信息链接到达四海网时，四海网会默认您已经登录了四海网网站。四海网确保不会泄漏您的任何个人信息，但请务必确保您邮箱的安全。</p>


                         <h4>旅游保险</h4>
                         <p>四海网 强烈推荐您购买医疗、行程取消以及行李等保险项目。四海网 现暂不提供任何行程安排，网站上列出的旅游产品都是由独立的旅行团供应商来实施操作的。我们是旅行团供应商、运送、观光和旅馆住宿的代理商。四海网 不对意外事故承担任何责任，包括丢失损坏物品，救护伤员，途中死亡，以及一切的推迟、不规则操作。解决事宜会遵循航空公司、酒店和公共汽车公司等指定的规则。四海网不对任何由于您和旅行团供应商或第三方争论而引起的开销或损害负责，包括一切涉及到本网站或使用网站内信息的事宜，您不得发表任何针对四海网以及它的所有成员及附属机构的言论。</p>


                         <h4>订团修改和取消</h4>
                         <p>旅行团供应商会尽量保证行程安排和预计的保持一致。但为了保证行程顺利, 旅行团供货商保留对由于天气、交通、旅行游览车临时发生故障和其它一些无法控制的原因所导致对行程更改、推迟和取消的权利。<br>
                             旅行团供应商保留在出发前如果参团人数不足以成团的情况下取消行程的权利，四海网会提前通知。
                             <br>
                             旅行团供应商保留因为参团人数不足而调换游览车的权力。<br>
                             旅行团供应商所有临时采取的行为, 均会从整个团体利益出发而考虑。此行为与四海网完全无关，但是四海网会全力协助四海贵宾争取权宜。</p>

                         <h4>护照和签证</h4>
                         <p>您有责任携带一切旅游证件和/或进入和/或经由您选择路线中国家所必须的一切必备证件。不同国籍的人会有不同的入境法律。四海网 不会保留顾客的私人旅行证件或是承担通知每个国家现行所需证件的责任。您要承担由于缺少旅行证件而造成的推迟或行程更改的所有费用。<br>

                             您应当严格遵守法律以及游览国家政府所发布的法规，包括移民和海关法律条例等。四海网 不对您由于违背游览国家政府法规而产生的罚款负责。</p>

                         <h4>价格、取消以及退款政策</h4>
                         <p>所有的旅游产品价格都是以美元计算。 不同时期的价格会有所不同。 比如，价格在节假日会有所增长。 所有价格都需要加以确认。 具体细则我们会在取消和退款政策.四海网 的取消和退款政策是此协议的一部分，在您预订前您要确保已经阅读并同意其所有内容。</p>

                         <h4>关于买二送二和买二送一的团</h4>
                         <p>只在适用的条件下生效。如在行程确认后进行修改或取消，需要交纳一定的费用。提前于出团日7天及以上取消免费参团人行程，将额外收取$30.00的取消费用。提前于出团日7天以内取消免费参团人行程，将按取消和退款条例进行收费。如免费参团人于出团当天缺席，将根据每个团设定的标准对其收取一定数量的罚金（每人）。罚金将由导游以现金的方式强制性从其他参团人处收取。<br>
                             更多关于四海网取消和退款条例的信息请参考取消和退款条例。四海网客户协议、取消和退款条例均属于协议内容。同意协议表示您在预定前已经阅读并同意协议内容。</p>

                         <h4>自行退款</h4>
                         <p>您不得对四海网 使用Discover, MasterCard, VISA, American Express 或任何银行信用卡的电子记录退款而产生异议。同意四海网 通过电子邮件操作工作, 所以我们提供的服务是以邮件形式传送的。您不能要求团票亲自领取或是邮寄，接受电子邮件作为传送方式并通知Discover, MasterCard, VISA, American Express 和发行信用卡的银行我们会通过电子邮件传送来为您您预订服务。如果四海网 可以提供电子版团票已经通过电子邮件传送出去（提供电脑系统记录数据和时间证明）；或是通过传真（提供显示已传送到指定传真号码成功的复印件证明）；或是通过邮寄（提供特定某人已在美国邮政服务处已投递团票的签名陈述），您就不得对已获取基本服务而收费用进行争论。<br>
                             您不得不正当的对收费进行争论。例如在四海网不认同的情况下自行退款。 如果您不适当的自行退款(只要 四海网 判定)，您得退还所有费用。如果您不正当的自行退款，您必须提供一个手写给信用卡公司，确定费用是合理正当的声明，并传真一份此信件的复本到四海网，专用传真号 1-626-552-3723
                             对于从网站自行退款，四海网将采取法律行动将其取回，并收取自行退款费用。 如果四海网诉讼成功，您还将承担诉讼费用。</p>

                         <h4>责任划分</h4>
                         <p>四海网将尽力给顾客提供正确、完善和最新的信息，但也不排除会有一些技术和排版上的错误存在。顾客在使用前有义务进行核实。我们有权在不提前通知的情况下作任何修改和更新。顾客自行承担访问使用网站信息的所有风险。我们会提供一些其它网站的链接以方便您访问。这些网站与四海网无任何关系，我们不对其提供内容负责。您在选择时要提高警惕，以免在使用时感染病毒或对您造成任何损害。</p>

                         <h4>法律声明</h4>
                         <p>该协议遵循并依照美国加利福尼亚州法律之内容，不与其法律条款抵触。一旦顾客对四海网的进行使用并享用其提供之服务，即视为同意遵守洛杉矶和加利福尼亚法院所有的个人专属管辖权，并因此同意无条件遵守洛杉矶县内法院规定之所有法律条款。一旦该协议中的条款出现无效或非强制性的规定，该规定必须最大限度的得到强制执行。强制过程中包含的其他规定仍然发挥充分法律效力。四海网不支持或强制执行该协定的任何规定的行为不视为对任何权限和规定的弃权。该协定不能用作四海网与产品供应商或任何其他公司团体合作、任命、合资和代理等关系之凭证和依据。产品供应商和任何其他公司团体均无权以四海网的名义行使任何义务和职责。该协议是顾客和四海网间针对顾客对四海网的使用而制定的。</p>

                     </div>
                     <p>
                         我已经阅读四海网提供的<a target="_blank" href="#">客户协议</a>、<a target="_blank" href="#">取消和退款条例</a>、<a target="_blank" href="#">信用卡支付验证书</a>
                     </p>
                     <p class="agreement-choose">
                         <input type="radio" value="yes" checked="checked" name="agree" id="iagree">
                         <label class="current" for="iagree">我同意</label>

                         <input type="radio" value="no" name="agree" id="irefuse">
                         <label for="irefuse">我拒绝</label>
                     </p>
                     <p><span class="bold orange">温馨提示：</span>行程在出发前七日内（含七日）将无法取消和申请退款，请您谅解！</p>
                 </div>


                 <div class="pay-oper txtc">
                     <input type="submit" id="btn-pay-card" value="">
                 </div>
                 <div id="examp-box">
                     <div class="examp-con">
                         <img width="570" height="380" alt="" id="card-pic">
                     </div>
                     <div class="examp-bg"></div>
                     <span title="关闭" id="examp-close"></span>
                     <!--[if IE 6]>
                     <iframe style="width:650px;height:360px;left:10px;position:absolute;top:10px;z-index:-1;overflow:hidden;"></iframe>
                     <![endif]-->
                 </div>
             </form>
         </div><!-- #pay-card-box end -->
         <script type="text/javascript">

             /*同意协议*/
             $(function(){
                 var box = $('.agreement-choose');
                 var labels = box.find('label');
                 var r = box.find(':radio[name=agree]');
                 var setChecked = function(n){
                     labels.filter('.current').removeClass('current');
                     labels.eq(n).addClass('current');
                     if(r.eq(n).val() !=='yes'){
                         $('#btn-pay-card').addClass('disabled');
                     }else{
                         $('#btn-pay-card').removeClass('disabled');
                     }
                 };
                 r.each(function(i){
                     var me = $(this);
                     if(me.is(':checked')){
                         setChecked(i);
                     }
                     me.click(function(){
                         if(me.is(':checked')){
                             setChecked(i);
                         }
                     })
                 });
             });


         </script>

         <div class="payment-con" id="pay-paypal-box" style="display: none;">
             <h2>PayPal支付<span>中国内地客户暂不支持Paypal支付方式。</span></h2>
             <p class="paypal-logo"><img alt="" src="images/logo_paypal.jpg"></p>
             <p class="pay-oper">
                 <input type="submit" id="btn-pay-pal" value="">
             </p>
             <h4>Paypal支付注意事项：</h4>
             <p>1、四海网提供的paypal支付方式暂时只适用于除中国内地以外的客户。</p>
             <p>2、PayPal系统中的每个电子邮件地址都是唯一的，并表示一个唯一标识符(类似银行账号)。</p>
             <p>3、如果您的交易涉及币种兑换，将按PayPal从金融机构获得的汇率完成兑换，该汇率将依据市场情况进行定期调整。</p>

         </div><!-- #pay-paypal-box end -->

         <div class="payment-con" id="pay-cash-box" style="display: none;">
             <h2>现金存款(省2% , 美国)支付方式<span>通过银行转账支付的客户将获得订单金额2%的现金折扣优惠！</span></h2>
             <h3>（请在支付金额的时候在银行存款表格上注明您的订单号。）</h3>
             <ul class="cash">
                 <li><b>方式一：</b></li>
                 <li>
                     <label>银行名称：</label>
                     Bank of America</li>
                 <li>
                     <label>账户名：</label>
                     Go4Seas</li>
                 <li>
                     <label>账号：</label>
                     0944332670</li>
                 <li>
                     <label>ABA银行号码：</label>
                     026009593</li>
             </ul>

             <ul class="cash cash-long">
                 <li><b>方式二：</b></li>
                 <li>
                     <label>银行名称：</label>
                     Chase</li>
                 <li>
                     <label>账户名：</label>
                     Go4Seas</li>
                 <li>
                     <label>账号：</label>
                     825225188</li>
                 <li>
                     <label>公司地址：</label>
                     Go4Seas77 Las Tunas Dr., Suite 203Arcadia, CA 91007</li>
                 <li>
                     <label>电&#12288;话：</label>
                     1-866-638-6888</li>
                 <li>
                     <label>传&#12288;真：</label>
                     1-626-552-3723</li>
             </ul>

         </div><!-- #pay-cash-box end -->

         <div class="payment-con" id="pay-draft-box" style="display: none;">
             <h2>汇票/旅行支票(省2% , 美国)方式支付<span>通过汇票/旅行支票 支付的顾客将获得订单金额2%的现金折扣优惠！</span></h2>
             <h3>(采用汇票/旅游支票您将承担支付转账费用，四海网不接收个人支票，请在汇票/旅行支票上注明付款给四海网go4seas， 并注明您的订单编号。)</h3>
             <p>
                 <label>公司地址：</label>
                 美国总部<b>Go4Seas77 Las Tunas Dr., Suite 203,Arcadia, CA 91007 USA</b><br>
             </p>
         </div><!-- #pay-draft-box end -->

         <div class="payment-con" id="pay-tm-box" style="display: none;">
             <h2>银行电汇（美国）支付方式<span>通过银行转账支付的客户将获得订单金额2%的现金折扣优惠！</span></h2>
             <h3>（采用银行电汇您将承担支付转账费用，请在发送电汇的时候在银行表格上注明您的订单号。）</h3>
             <ul class="cash cash-long2">
                 <li>
                     <label>银行名称：</label>
                     Bank of America</li>
                 <li>
                     <label>账户名：</label>
                     Go4Seas</li>
                 <li>
                     <label>账号：</label>
                     0944332670</li>
                 <li>
                     <label>ABA银行号码：</label>
                     026009593</li>
                 <li>
                     <label>SWIFT 代码：</label>
                     BOFAUS3N <span>国际电汇时需要</span></li>
                 <li>
                     <label>公司地址：</label>
                     go4seas&#12288;77 Las Tunas Dr., Suite 203,Arcadia, CA 91007 USA </li>
             </ul>
         </div><!-- #pay-tm-box end -->

         <div class="payment-con" id="pay-bt-box" style="display: none;">
             <h2>银行转账(省2% , 中国)支付方式<span>通过银行转账支付的客户将获得订单金额2%的现金折扣优惠！</span></h2>
             <p>&nbsp;</p>
             <p>中国内地地区客户请将订单款汇到以下银行账户：<span>(请在进行转账汇款时注明您的订单号。)</span></p>
             <ul class="bank-transfer">
                 <li class="head">
                     <div class="bank">银行</div>
                     <div class="num">帐号</div>
                     <div class="user">户名</div>
                 </li>
                 <li>
                     <div class="bank">建设银行</div>
                     <div class="num">4340 6138 1027 2113</div>
                     <div class="user">陈锐</div>
                 </li>
                 <li>
                     <div class="bank">招商银行</div>
                     <div class="num">6225 8802 8602 8015</div>
                     <div class="user">陈锐</div>
                 </li>
                 <li>
                     <div class="bank">工商银行</div>
                     <div class="num">6222 0244 0200 3304 924</div>
                     <div class="user">陈锐</div>
                 </li>
                 <li>
                     <div class="bank">中国银行</div>
                     <div class="num">6013 8231 0005 8387 192</div>
                     <div class="user">陈锐</div>
                 </li>
             </ul>
         </div><!-- #pay-bt-box end -->


         <div class="payment-con" id="pay-yl-box" style="display: none;">
             <h2>银联支付<span>xxxxx</span></h2>
             银联支付
         </div><!-- #pay-yl-box end -->


         </div><!-- pay-con-box end -->
         </div>

     </div>
     </div>

</div>

<!--行程单修改弹出窗口-->
<div id='shade'></div>
<div class="book-wrap undis" id="book-wrap">
<form name="book" method="post" action="">
    <input type="hidden" class="city-hide" value="">
    <div class="book">
        <div class="book-top"><span></span>请设置行程后放入行程单</div>
        <div class="book-con clearfix" id="book-con">
            <!--预订选项，开始-->
            <div class="book-option">
                <ul class="options">

                    <!--第一项 start-->
                    <li>
                        <div class="num num1"></div>
                        <div class="con">
                            <h3>去往游玩日期：<label>（根据您行程单上所选日期）</label></h3>
                            <p class="ptxt">
                                <input type="text" id="go-time" value="" class="zyx-ipt w128  calendar" />
                            </p>
                            <script type="text/javascript">
                                function getPriceByPost(){
                                    $.post(
                                            "xxxxxxxxxx",
                                            {pro_id: pro_id,
                                                pro_type:pro_type,
                                                start_date: start_date,
                                                time_location_id:$("#id1").val(),
                                                start_time:$("#time1").val(),
                                                start_location:$("#place1").val(),
                                                adult:adult,
                                                child:child,
                                                option_id:chk_value,
                                                option_name:chk_name
                                            },
                                            function(data){
                                                $("#currecy_display_usd").text('xxxx');
                                                $("#currecy_display_cny").text('xxxx');
                                            },
                                            "json"
                                    );
                                }
                                $(function(){
                                    $('#go-time').zyxCalendar({
                                        output:'yyyy年mm月dd日 w',
                                        readout:true,
                                        range:'2013-07-26:2013-08-26',
                                        only:[],
                                        specific:[],
                                        callback:function(v){
                                            start_date = v.year+'-'+(v.month+1)+'-'+v.day;
                                            getPriceByPost();
                                        }
                                    });
                                });
                            </script>
                        </div>
                    </li>
                    <!--第二项 start-->
                    <li>
                        <div class="num num3"></div>
                        <div class="con">
                            <h3>请选择参团人数：<a class="pbtn" id="hotel-1-link" href="javascript:;">修改</a></h3>
                            <div id="hotel-1-show"><p class="pview"><label>成人:</label>3 &nbsp;&nbsp;&nbsp;&nbsp;<label>小孩:</label> 3 </p></div>
                            <!--酒店房间编辑-->
                            <div id="hotel-1-edit" class="undis" edittype="3">
                                <div class="frmpop">
                                    <div class="frmpop-con">
                                        <div class="frmpop-title">
                                            房间：
                                            <select name="numberOfRooms" roomtype="1" maxper="4" minper="1">
                                                <option value="1">1</option>
                                                <option value="2" selected="">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="5">5</option>
                                                <option value="6">6</option>
                                                <option value="7">7</option>
                                                <option value="8">8</option>
                                                <option value="9">9</option>
                                                <option value="10">10</option>
                                                <option value="11">11</option>
                                                <option value="12">12</option>
                                                <option value="13">13</option>
                                                <option value="14">14</option>
                                                <option value="15">15</option>
                                                <option value="16">结伴拼房</option>
                                            </select>
                                        </div>

                                        <div class="frmpop-table">
                                            <h4>
                                                <span class="radio">&nbsp;</span>
                                                <span class="room">&nbsp;</span>
                                                <span class="adult">成人</span>
                                                <span class="kid">小孩</span>
                                            </h4>
                                            <div class="frmpop-rooms">
                                                <p class="flist">
														<span class="ftxt">
															<span class="radio">&nbsp;</span>
															<span class="room">房间 1：</span>
															<span class="adult">
																<select name="">
                                                                    <option value="1" selected="">1</option>
                                                                    <option value="2">2</option>
                                                                    <option value="3">3</option>
                                                                    <option value="4">4</option>
                                                                </select>
															</span>
															<span class="kid">
																<select name="">
                                                                    <option value="0">0</option>
                                                                    <option value="1">1</option>
                                                                    <option value="2">2</option>
                                                                    <option value="3">3</option>
                                                                </select>
															</span>
														</span>
                                                </p>
                                            </div>

                                            <p class="peifang">
                                                <label><input type="checkbox" name="agree_single_occupancy_pair_up" id="agree_single_occupancy_pair_up" value="1">&nbsp;接受单人配房</label>
                                                <a href="javascript:;" class="peifang-tip">[?]<span class="peifang-tip-con"><b>单人部分拼房：</b>四海网帮助贵宾在行程中与其他同游贵宾或者领队在部分行程段落中拼房，以达到节约团费的目的。<br><b>西海岸：</b>对于代码为LA2-** 的行程，如果行程中涉及到在旧金山或拉斯维加斯两晚住宿，我们将安排与同性团友或者同性领队拼房，限男性，100%保证拼房成功。但是在洛杉矶住宿部分以单人形式安排。<br> 对于代码为LA5-**的行程，四海网无法100%确定能提供单人部分配房，我们会在贵宾预定行程后的24-48小时确定是否协助部分配房成功，如果没有协助部分配房成功，贵宾需要以全程单人一房的价格为标准，并补齐差价；或者四海网不收取任何费用，全额退款。<br><b>东海岸：</b>对于代码为NY5-**、NY35-**，及NY3-**的部分行程，无论男性、女性，全程与同性以双人一间的规格拼房，100%保证拼房成功，您需要承担的费用为双人一间单价及额外的一部分服务费；对于代码为NY23-**的行程，不保证拼房成功；对于其他编号的纽约套餐行程，我们提供部分拼房服务。在纽约居住的时间以单人单房形式。在纽约以外的其他城市安排与同性拼房，无论男性、女性，100%保证拼房成功。您需要承担在纽约单房的差价。</span></a>
                                            </p>
                                        </div>
                                        <p class="zyxbtn-wrap">
                                            <a class="zyxbtn3 ok" href="javascript:;">确定</a>
                                            <a class="zyxbtn3 cancel" href="javascript:;">取消</a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <!--酒店房间编辑，结束-->

                        </div>
                    </li>
                </ul>
                <div class="clear"></div>
                <!--增值服务start -->
            </div>
            <!--预订选项，结束-->

            <!--右侧预订信息，开始-->
            <div style="position: absolute; bottom: 0px; right: 0px;" class="book-tool" id="book-tool">
                <div id="price" class="price">
                    <p>
                        <span class="currecy-type">美&nbsp;&nbsp;&nbsp;元：</span>
                        <span id="currecy_display_usd" class="us">$390.00</span>
                    </p>
                    <p class="cn"><label>人民币：</label><span id="currecy_display_cny">￥2481</span></p>
                </div>

                <div class="add">
                    <a class="zyxbtn1 tooltip" id="order-updata">确认修改</a>
                </div>

                <ul class="other-option">
                    <li class="post">
                        <a class="find-companion" id="find-companion1" href="javascript:;">发布立即结伴贴</a>
                        <a class="companion-help" target="_blank" href="" title="如何发布结伴贴"></a>
                    </li>
                </ul>
            </div>
            <!--右侧预订信息，结束-->
        </div>
        <div class="book-bottom"></div>
    </div>
</form>
</div>

<script type="text/javascript">
	$(function(){

		$(".all-city-btn").hover(function(){
			$(".all-city-list").show();
		},function(){
			$(".all-city-list").hide();
		});
		$(".all-city-list").hover(function(){
			$(".all-city-list").show();
		},function(){
			$(".all-city-list").hide();
		});

        $("#customer-1-link").click(function(){
            $(".customer-1-content").toggle();
            $(".customer-list-box").toggle();
        });
        $("#customer-1-ok").click(function(){
            $(".customer-1-content").toggle();
            $(".customer-list-box").toggle();
        });
    });

    /*修改联系人信息*/
    $(function(){
        var updata = $(".human-updata");
        var content = $(".product-content");
        var content1 = $(".product-content-1");
        var ok = $("#customer-ok");
        updata.click(function(){
            content.hide();
            content1.show();
        });
        var form = $("#pro-form");
        form.ZYXValidate();
        ok.click(function(){
            var en_fri_name = $(".en-fri-name");
            var en_sec_name = $(".en-sec-name");
            var city = $(".city");
            var pho_num = $(".pho-num");
            var email = $(".email");
            var new_en_fri_name = $(".new-en-fri-name");
            var new_en_sec_name = $(".new-en-sec-name");
            var new_city = $(".new-city");
            var new_pho_num = $(".new-pho-num");
            var new_email = $(".new-email");
            var data = form.serializeArray();
            $.post('<?php echo $this->createUrl('order/createAddress') ?>',{
                last_name:new_en_fri_name.val(),
                first_name:new_en_sec_name.val(),
                country_id:new_city.val(),
                cellphone:new_pho_num.val(),
                email:new_email.val(),
                o_id:<?php echo intval($order->order_id);?>
            },function(data){
                if(data == "OK"){
                    en_fri_name.text(new_en_fri_name.attr("value"));
                    en_sec_name.text(new_en_sec_name.attr("value"));
                    city.text($(".new-city option:selected").text());
                    pho_num.text(new_pho_num.attr("value"));
                    email.text(new_email.attr("value"));
                    content1.hide();
                    content.show();
                }
                else{
                    alert("服务器异常，更新失败！");
                }
            });

        });
    })


/*点击修改弹出窗口*/
    $(function(){
        $(window).bind('resize', function(){
            var book_wrap = $("#book-wrap");
            var y = $(window).height()/2-200;
            var shade = $("#shade");
            shade.css({height:$(window).height()});
            book_wrap.css({"top": y});
        });
        var y = $(window).height()/2-200;
        var book_wrap = $("#book-wrap");
        book_wrap.css({"top": y});

        var updata= $(".product-funtion a.updata");
        var hid = $("#book-wrap .city-hide");
        var shade = $("#shade");
        shade.css({height:$(window).height()});
        var close = book_wrap.find(".close");
        updata.live("click",function(){
            shade.show();
            book_wrap.show();
            hid.val($(this).data("id"));
        });
        shade.live("click",function(){
            $(this).hide();
            book_wrap.hide();
        });
        $("#order-updata").live("click",function(){
            shade.hide();
            book_wrap.hide();
        });

    })


    /*从行程单移除*/
    $(function(){
        var de = $(".product-funtion a.delete");
        var i;
        de.live("click",function(){
            var i = $(this).data("id");
            $.post('/site/test',{
                name:"robyn"
            },function(data){
                if(data == "OK"){
                    $(".product-funtion a.delete[data-id="+i+"]").closest(".product").remove();
                    //window.location.reload();
                }
                else{
                    alert("服务器异常，删除失败！");
                }
            });
        })
    })
	
	//返回编辑
	$(function(){
		var edit = $(".returnedit");
		edit.one("click", function(){
			$(this).css({opacity:"0.5",cursor:"default"}).attr("readonly","true");
			$.post("<?php echo $this->createUrl('order/back4Edit')?>",{oid:"<?php echo $_GET['oid']?>"},function(cid){
				if(cid){
					location.href = "<?php echo $this->createUrl('productList/index')?>?city="+cid;
				}else{
				    alert('异常错误！');
				}
			});
		});
	
	})
	
	
	
	
	
	
	

</script>

<?php $this->endContent(); ?>