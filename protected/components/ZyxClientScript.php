<?php
/**
 * @desc 继承CClientScript，让JS和CSS加载顺序得以控制
 * @author Fedora
 * @note 
 */
class ZyxClientScript extends CClientScript
{

	public function registerJsFile($url,$order)
	{
		$position=$this->defaultScriptFilePosition;
		$this->hasScripts=true;
        unset($this->scriptFiles[$position][$url]);
        $scripts = array();
        $i = 0;
        if(!empty($this->scriptFiles[$position]))
        foreach($this->scriptFiles[$position] as $key=>$val){
            if($order == $i){
                $scripts[$url] = $url;
            }
            $scripts[$key] = $val;
            $i++;
        }
        unset($this->scriptFiles[$position]);
        $this->scriptFiles[$position] = $scripts;
		$this->scriptFiles[$position][$url]=$url;
		$params=func_get_args();
		$this->recordCachingAction('clientScript','registerScriptFile',$params);
		return $this;
	}
    
	public function registerCsFile($url,$order,$media='')
	{
		$this->hasScripts=true;
        unset($this->cssFiles[$url]);
        $css = array();
        $i = 0;
        if(!empty($this->cssFiles))
        foreach($this->cssFiles as $key=>$val){
            if($order == $i){
                $css[$url] = $media;
            }
            $css[$key] = $val;
            $i++;
        }
        $this->cssFiles = $css;
		$this->cssFiles[$url]=$media;
		$params=func_get_args();
		$this->recordCachingAction('clientScript','registerCssFile',$params);
		return $this;
	}
    
}
