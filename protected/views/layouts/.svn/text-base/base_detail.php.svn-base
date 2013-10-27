<!DOCTYPE HTML>
<?php
/**
 * @note 此模板专用于 product property 详情页展示  Iframe 嵌套页面
 * @author leo
 *
*/
 ?>
<html lang="<?php echo str_replace('_','-',Yii::app()->language);?>">
    <head>
        <meta http-equiv="Content-Type" content="text/html;charset=utf-8" />
        <title><?php echo CHtml::encode($this->pageTitle); ?></title>
        <meta name="description" content="<?php // TODO: ?>" />
        <meta name="keywords" content="<?php // TODO: ?>" />
        <meta name="reply-to" content="<?php // TODO: ?>" />
        <meta name="robots" content="index,follow" />
        <link rel="shortcut icon" type="image/x-icon" href="/favicon.ico"  />
        <link rel="stylesheet" type="text/css" href="/css/base.css" />
        <link rel="stylesheet" type="text/css" href="/css/product_list.css" />
        <link rel="stylesheet" type="text/css" href="/css/page.css" />
        <script type="text/javascript" src="/js/jquery.js"></script>
        <script type="text/javascript" src="/js/base.js"></script>
        <script type="text/javascript" src="/js/lib.js"></script>
        <script type="text/javascript" src="/js/residence_detail.js"></script>
        <script type="text/javascript" src="/js/jquety.scrollTo.js"></script>
        <link rel="stylesheet" type="text/css" href="/widget/popwin/popwin.css" />
        <script type="text/javascript" src="/widget/popwin/popwin.js"></script>
        <link rel="stylesheet" type="text/css" href="/widget/country_selector/country_selector.css" />
        <script type="text/javascript" src="/widget/country_selector/country_selector.js" charset="utf-8"></script>
        <link rel="stylesheet" type="text/css" href="/widget/zyxcalendar/zyxcalendar.css" />
        <script type="text/javascript" src="/widget/zyxcalendar/zyxcalendar.js" charset="utf-8"></script>
        <link rel="stylesheet" type="text/css" href="/widget/lightbox/lightbox.css" />
        <script type="text/javascript" src="/widget/lightbox/lightbox.js" charset="utf-8"></script>
        <link rel="stylesheet" type="text/css" href="/css/order_base.css" />
        <script src="/js/product_order.js" type="text/javascript"></script>

        <link rel="stylesheet" type="text/css" href="/css/review.css" />
		<script type="text/javascript">
			var CLIENTSTATUS = {
				"login":<?php echo $this->isGuest?'false':'true'?>,
				"lang":"<?php echo Yii::app()->getLanguage()?>",
				"serverTime":"<?php echo time()?>",
				"uid":"<?php echo (int)Yii::app()->user->customer_id?>"
			};

		</script>
    </head>
    <body style="overflow: hidden;width: 730px;margin: 0 auto;">
        <?php echo $content; ?>
		<div>
			<?php if(Yii::app()->user->isGuest): ?>
			<form action="<?php echo $this->createUrl('/site/login') ?>" class="undis product-valid-form signup-box" id="poplogin" method="post">
				<ul>
					<li>
						<label for="LoginForm[username]">账户：</label>
						<input type="text" id="LoginForm[username]" name="LoginForm[username]"  value=""/>
					</li>
					<li>
						<label for="password">密码：</label>
						<input type="password"  id="password" name="LoginForm[password]" value=""/>
					</li>
					<li>
						<label></label>
						<input id="login" type="submit" value="登录" class="zyxbtn3" />
					</li>
					<li>
						<label></label>
						<a href="<?php echo $this->createUrl('findpwd/index') ?>" target="_blank">忘记密码？</a> |
						<a href="<?php echo $this->createUrl('site/signup') ?>" target="_blank">新用户注册</a>
					</li>
				</ul>
			</form>
			<?php endif; ?>	
		</div>
		<script type="text/javascript">		
			$(function(){
				/* if($('.show-photo').length){
					$('.show-photo').picShow();
				} */
				<?php if(!$this->isGuest):?>
                $('#test-add').ajaxBind({},{loading:false});
				$('#test-share').ajaxBind({},{loading:false});
                <?php endif;?>
			});
		</script>
    </body>
</html>


