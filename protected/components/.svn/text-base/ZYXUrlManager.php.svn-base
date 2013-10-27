<?php
/**
 * This component is used for front-end
 * we can use createUrl to generate a full url
 * @author Fedora.Liu@go4seas.com
 */
class ZYXUrlManager extends CUrlManager{
	public $secureHost = '';
	public $commonHost = '';
	/**
	 * override CController::createUrl
	 * @see {CController::createUrl}
	 * @param string $route
	 * @param array $params
	 * @param booean|string $useSSL
	 * @author Fedora.Liu@go4seas.com
	 */
	public function createUrl($route,$params=array(),$useSSL=false)
	{
		if(!is_bool($useSSL)){
			$useSSL = trim(strtolower($useSSL));
			if($useSSL == 'ssl' || $useSSL == 'true' || $useSSL == '1' || $useSSL == 'https'){
				$useSSL = true ;
			}else
				$useSSL = false;
		}
		if($useSSL == true){
			$host = ($this->secureHost == '')? Yii::app()->request->getHostInfo('https'):$this->secureHost;
		}else{
			$host = ($this->commonHost == '')? Yii::app()->request->getHostInfo('http'):$this->commonHost;
		}
        $this->urlFormat = 'path';
		return $host.parent::createUrl($route , (array)$params , '&' ) ;
	}


}
