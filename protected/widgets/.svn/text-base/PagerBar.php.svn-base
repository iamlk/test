<?php
//Powered by Fedora in 2013.7.5

class PagerBar extends CBasePager {
	/**
	 * @var ProductFinder
	 */
	public $finder = null;
	/**
	 * @var CPagination
	 */
	public $pagination = null;
	public $step = 3 ;
	public $linkSize = 10 ;
	public $showOrderOption = false ;
	public $route = 'question/index';
	public $routeParams = array();
	public $loadingImage = '/images/loading2.gif';

	public $ajaxContainerId = 'datalist';
	public $useAjax = false;

	public $linkParams = array();

	public $currentPage = 0 ;
	public $recordTotal = 0;
	public $pageSize = 20 ;
	public $pageAccesor = 'page';

	protected function setFinder(){
		if($this->finder !== null){
			$this->currentPage = $this->finder->page;
			$this->recordTotal = $this->finder->total;
			$this->pageSize = $this->finder->pageSize;
		}else if($this->pagination !== null){
			$this->currentPage = $this->pagination->currentPage +1;
			$this->recordTotal = $this->pagination->itemCount;
			$this->pageSize = $this->pagination->pageSize;
			$this->pageAccesor = $this->pagination->pageVar;
		}
	}


	public function run(){

		$this->setFinder();

		if($this->recordTotal == 0){
			return false;
		}

		$pageTotal = ceil($this->recordTotal / $this->pageSize);

		//if just 1 page and no orderOptions disp ,noting display
		/*if($this->showOrderOption == false && $pageTotal < 1){
			return  ;
		}*/


		$loadingid = uniqid("l");

		echo '<div class="pager results-pager">';

		$cparams = array_merge($_GET , $this->routeParams);
		unset($cparams['_']);

		if($this->currentPage > 1){
			$params = $cparams ;
			$params[$this->pageAccesor] = $this->currentPage - 1 ;
			$linkParams = $this->linkParams;
			$linkParams['class'] = isset($linkParams['class'])? $linkParams['class'].' go go-prev':'go go-prev';
			if($this->useAjax) $linkParams['onclick'] = 'return pagetoolbar_load(\''.$this->ajaxContainerId.'\',this,\''.$loadingid.'\')';
			echo CHtml::link('上一页',$this->controller->createUrl($this->route , $params) , $linkParams);
		}

		$start = $this->currentPage - $this->step ;
		if($start < 1 ) $start = 1 ;

		$stop =$start + 9;


		if($stop > $pageTotal){
			$stop = $pageTotal;
		}

		echo '<span class="pager-num '.($pageTotal < 2 ? 'undis':'').'">|';

		for(;$start <=$stop;$start++){
			$params = $cparams ;
			$params[$this->pageAccesor] = $start ;
			if($this->currentPage == $start){
				echo '<b>'.$start.'</b>';
			}else{
				$LinkParams = $this->linkParams;
				$linkParams['class'] = '';
				if($this->useAjax) $linkParams['onclick'] = 'return pagetoolbar_load(\''.$this->ajaxContainerId.'\',this,\''.$loadingid.'\')';
				echo CHtml::link($start ,$this->controller->createUrl($this->route , $params) , $linkParams).'|';
			}

		}
		echo '</span>';

		if($this->currentPage < $pageTotal){
			$params = $cparams ;
			$params[$this->pageAccesor] = $this->currentPage + 1 ;
			$linkParams = $this->linkParams;
			$linkParams['class'] = isset($linkParams['class'])? $linkParams['class'].' go go-next':'go go-next';
			if($this->useAjax) $linkParams['onclick'] = 'return pagetoolbar_load(\''.$this->ajaxContainerId.'\',this,\''.$loadingid.'\')';
			echo CHtml::link('下一页',$this->controller->createUrl($this->route , $params) ,$linkParams);
		}

		echo '<span id="'.$loadingid.'" class="undis"><img src="'.$this->loadingImage.'" border="0"/></span></div>';

		$js = 'function pagetoolbar_load(t,src,l){
					$("#"+l).show();
					$.get($(src).attr("href") ,function(c){
						$("#"+l).hide();
						$("#"+t).html(c);
					});
                    $("html,body").animate({scrollTop: $("#'.$this->ajaxContainerId.'").offset().top-80});
					return false;
				}';

		Yii::app()->clientScript->registerScript(get_class($this) , $js,CClientScript::POS_END);
	}
}