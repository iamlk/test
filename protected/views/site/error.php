<?php
/* @var $this SiteController */
/* @var $error array */

$this->pageTitle=Yii::app()->name . ' - Error';
$this->breadcrumbs=array(
	'Error',
);
?>

<!--<h2>Error <?php //echo $code; ?></h2>

<div class="error">
<?php //echo CHtml::encode($message); ?>
</div>-->

<div class="main-wrap clearfix pb10 mg">
    <div id="mainTemplateHolder">
        <style type="text/css">
            body {background-color: #D4D4D4;height: 600px;}
            #bottomSpacer { padding-top:30px; }
            div.error404_main {background: url(../../../images/error404_main.jpg) no-repeat;width: 950px;height: 550px;	margin: 48px 21px 0 21px;position: relative;	}
            span.main_txt {display: block;	width: 150px;height: 63px;	position: absolute;	top: 223px;	left: 745px;text-align: center;	color: #1d1d1d;	padding: 2px 0 0 0;	}
            span.main_txt span {display: block;margin: 0 0 2px 0;	}
            span.main_txt a {	color: #1d1d1d;	}
            .main-wrap.mg { margin: 100px auto 0;}
        </style>
        <div class="error404_main">
            <span class="main_txt">
                <span>对不起！</span>
                <span>你想要的页面不存在：</span>
                <span>（<em class="red minute">5</em>秒回到首页）</span>
            </span>
        </div>
        <div class="clear"></div>
        <div class="clear"></div>
    </div>
</div>

<script type="text/javascript">
	$(function(){
	    var txt=0;
		var t;
		function returnHome(){
		    var txt = $(".minute").text();
			txt = parseInt(txt) - 1;
			if(txt== "0"){
				window.location.href = "<?php echo $this->createUrl('index')?>";
			}
			$(".minute").text(txt);
		}
		t = setInterval(returnHome,1000);
	});
</script>