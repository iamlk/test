<!--script type="text/javascript" src="/js/lib.js"></script-->
<style type="text/css">
.price-amount-list .ui-widget-header{background:url("/images/product/price.png") repeat scroll 0 0 #55C2FB;}
.price-amount-list .ui-slider-horizontal .ui-slider-handle {background: none repeat scroll 0 0 #FFF;border: 1px solid #666666 !important;border-radius: 10px;box-shadow: 0 1px 0 #FFF inset, 0 6px 9px #6C97B8 inset, 0 1px 3px #AAA;cursor: pointer;height: 15px; margin-left: -0.6em;top: -0.4em;width: 15px;}
.price-amount-list .ui-slider-horizontal .ui-state-active, .ui-slider-horizontal .ui-state-hover {box-shadow: 0 1px 0 #FFF inset, 0 8px 8px #3A6A8E inset, 0 1px 3px #AAA;}
.price-amount-list .ui-slider-horizontal {height: 6px;}
.price-amount-list li{display: inline-block;zoom:1;*display: block;}
.price-amount-list li.li-first,.price-amount-list li.li-last{width: 27px;}
.price-amount-list .price-first, .price-amount-list .price-last { position: relative;top: -10px;display: block;width: 20px;}
.price-amount-list #slider-range {margin: 13px 0 10px 9px;width: 188px;border-radius:0;}
</style>
<ul class="price-amount-list" style="visibility: show;height: 80px;">
    <li class="li-first"><span class="price-first"></span></li>
    <li class="price-bar">
        <?php $this->widget('zii.widgets.jui.CJuiSlider', array(
            'id' => 'slider-range',
            'options' => array(
                'range' => true,
                'min' => 0,
                'max' => 5000,
                'values' => array((int)$_GET['price_min'],(isset($_GET['price_max'])?(int)$_GET['price_max']:999999999)),
                'slide' => 'js:function(e,u){priceChange(e,u);}',
                'stop' => 'js:function(e,u){priceStop(e,u);}',
            ),
        ));?>
    </li>
    <li class="li-last"><span class="price-last indent10"></span></li>
</ul>
<script type="text/javascript">
function priceChange(e,ui)
{
    $(".price-first").text("$" + ui.values[ 0 ]);
    $(".price-last").text("$" + (ui.values[ 1 ]=='5000'?'5000+':ui.values[1]));
}
function priceStop(e,ui){
    var min = $( "#slider-range" ).slider( "values", 0 );
    var max = $( "#slider-range" ).slider( "values", 1 );
    if (max==5000) max=999999;
    if (s = top.location.search)
    {
        if ((new RegExp(/price_min=\d*/)).test(s))
        {
            s = s.replace((new RegExp(/price_min=\d*/)),'price_min='+min);
        }
        else
        {
            s = s+'&price_min='+min;
        }
        if ((new RegExp(/price_max=\d*/)).test(s))
        {
            s = s.replace((new RegExp(/price_max=\d*/)),'price_max='+max);
        }
        else
        {
            s = s+'&price_max='+max;
        }
        //top.location = '<?php echo $_SERVER['PHP_SELF'];?>'+s;
        top.location = '<?php echo $this->createUrl('propertyList/index');?>'+s;
    }
    else
    {
        var str = 'price_min='+min+'&price_max='+max;
        //top.location = '<?php echo $_SERVER['PHP_SELF'];?>'+'?'+str;
         top.location = '<?php echo $this->createUrl('propertyList/index');?>'+'?'+str;
    }
}
$(function() {
    setTimeout(function(){
        $(".price-first").text("$" + $( "#slider-range" ).slider( "values", 0 ));
        $(".price-last").text("$" + ((t=$( "#slider-range" ).slider( "values", 1 ))=='5000'?'5000+':t));
   },100);
});
</script>
<div style="clear: both;"></div>
