<?php
/**
 * URL Map Config
 */
return array(
    '/'                             =>'site/index',
    //{目的地
    'city/<cid:\d+>'                =>'city/index',
    'city/detail/<cid:\d+>'         =>'city/view',
    
    'food/<cid:\d+>/<id:\d+>'       =>'food/index',
    'food/view/<cid:\d+>/<id:\d+>'  =>'food/view',
    
    'article/<id:\d+>'              =>'article/view',
    
    'attraction/<cid:\d+>/<id:\d+>' =>'attraction/index',
    'attraction_detail/<cid:\d+>/<id:\d+>' =>'attraction/view',
    'attractions/<cid:\d+>'         =>'attraction/list',
    
    'delicacy/<cid:\d+>/<id:\d+>'   =>'delicacy/view',
    'delicacies/<cid:\d+>/<id:\d+>' =>'delicacy/index',
    
    'restaurants/<cid:\d+>/<id:\d+>'=>'restaurant/index',
    
    // 帮助中心 leo
    'help/<id:\d+>'                 =>'content/index',
    'help/city'                     =>'content/item',
    'help/city/<id:\d+>'            =>'content/list',
    'help/attraction'               =>'content/attration',
    'help/attraction/<id:\d+>'      =>'content/aitem',
    
    
    //缩略图
    'thumb/auto/<wh>/<f:.+>'        =>'Tools/autoThumb',
    'thumb/<wh>/<f:.+>'             =>'Tools/thumb',
    
    //个人中心
    'home/<u_id:\d+>'               =>'people/index',
    'home'                          =>'center/index',
    
    //产品详情页
    'product/<id:\d+>'              =>'goods/index',
    
    //四大导航
    'tours/<city:\d+>'              =>'productList/index',
    'properties/<city:\d+>'         =>'propertyList/index',
    'itineraries/<cid:\d+>'         =>'itinerary/index',
    'articles/<cid:\d+>'            =>'article/index',

    //行程单
    'itinerary/<cid:\d+>/<id:\d+>'            =>'itinerary/view',
    

    //{AccountModule
    'password_forgotten.php'=>'account/forgottenPassword',
    //}
	// {article
	'default/cid-<cPath:\d+>' => 'article/seoNews',
	'default' => 'article/seoNews',
	//}
	// { service center
	'tour_question.php' => 'tourQuestion/post',
	'service_center_article.php' => 'serviceCenter/view',
	'service_center.php'=>'serviceCenter/index',
	// }
	'landingpage/<name:.*>/' => 'landingPage/index',
    '<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
    /**
	array(
				'class'=>'webeez.extensions.TffTravelCompanionUrlRule',
				'language_id'=>3
	),
	array(
				'class'=>'webeez.extensions.TffProductUrlRule',
				'connectionID'=>'db',
				'language_id'=>3
	),
    */
);
?>
