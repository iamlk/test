<?php /* @var $this Controller */ ?>
    <div class="deve" id="deve" style="display: none; position: fixed; top:55px; left:0px; background-color: #fff; z-index:999999; padding:10px; ">
  		<?php $this->widget('zii.widgets.CMenu',array(
			'items'=>array(
				array('label'=>'Home', 'url'=>array('/site/index')),
				array('label'=>'目的地', 'url'=>array('/Destination/AddDestination')),
				array('label'=>'Contact', 'url'=>array('/site/contact')),
                array('label'=>Yii::t('base','管理员'), 'url'=>array('/admin/index')),
                array('label'=>Yii::t('base','配置'), 'url'=>array('/configurationGroup/index')),
                array('label'=>Yii::t('base','翻译'), 'url'=>array('/systemSource/index')),
                array('label'=>Yii::t('base','度假公寓列表'), 'url'=>array('/propertyList/index')),
                array('label'=>Yii::t('base','短期行程列表'), 'url'=>array('/productList/index')),
                array('label'=>Yii::t('base','房子创建-基本资料'), 'url'=>array('/property/create')),
                array('label'=>Yii::t('base','GII'), 'url'=>array('/gii')),
                array('label'=>Yii::t('base','退房政策'), 'url'=>array('/propertyPolicy/index')),
                array('label'=>Yii::t('base','房子搜索-LIST'), 'url'=>array('/propertyList/index')),
                array('label'=>Yii::t('base','房子图片'), 'url'=>array('/propertyPicture/index')),
                array('label'=>Yii::t('base','房子的基本价格'), 'url'=>array('/propertyPrice/index')),
                array('label'=>Yii::t('base','房子的定制价格'), 'url'=>array('/propertyPriceOverride/create','property_id'=>11)),
                array('label'=>Yii::t('base','普通会员'), 'url'=>array('/customer/index')),
                array('label'=>Yii::t('base','商家会员'), 'url'=>array('/provider/index')),
                array('label'=>Yii::t('base','你问我答'), 'url'=>array('/question/index')),
                array('label'=>Yii::t('base','发布目的地'), 'url'=>array('/city/create')),
                array('label'=>Yii::t('base','zh_cn'), 'url'=>$this->createUrl($this->route,array_merge($this->actionParams,array('language'=>'zh_cn')))),
                array('label'=>Yii::t('base','zh_tw'), 'url'=>$this->createUrl($this->route,array_merge($this->actionParams,array('language'=>'zh_tw')))),
                array('label'=>Yii::t('base','en_us'), 'url'=>$this->createUrl($this->route,array_merge($this->actionParams,array('language'=>'en_us')))),
				array('label'=>'Login', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
				array('label'=>'Logout ('.(($id=Yii::app()->user->customer_id)?'[会员]':'').(($id=Yii::app()->user->isLandlord)?'[房东]':'').(($id=Yii::app()->user->isTourguide)?'[导游]':'').(($id=Yii::app()->user->isBusiness)?'[商家]':'').')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest)
			),
		)); ?>
    </div>

   <!-- <div class="sidebar undis" id="sidebar" style="position: fixed; top:55px; right:0px; background-color: #fff; z-index:999999; padding:10px; ">
    	<div>
    	<?php
    		$this->beginWidget('zii.widgets.CPortlet', array(
    			'title'=>'Operations',
    		));
    		$this->widget('zii.widgets.CMenu', array(
    			'items'=>$this->menu,
    			'htmlOptions'=>array('class'=>'operations'),
    		));
    		$this->endWidget();
    	?>
    	</div>
    </div>
-->