<?php
class Breadcrumbs
{
    private $breadcrumbs = array();
    public $separator = ' &raquo; ';

    /**
     * reset breadcrumb
     *
     * @return
     */
    function reset()
    {
        $this->breadcrumbs = array();
    }

    /**
     * Add breadcrumb item.
     *
     * @param string $name
     * @param url    $url
     * @param int    $postion
     */
    function add($name, $url='', $postion = null)
    {
        if (is_array($url) && count($url) > 0) {
            $this->breadcrumbs[] =
                array($name, Yii::app()->urlManager->createUrl($url[0], $url[1]));
        } else {
            if ( $url != '') {
                $this->breadcrumbs[] = array($name, $url);
            } else {
                $this->breadcrumbs[] = array($name);
            }
        }
    }
	
	public function removeLast() {
		array_pop($this->breadcrumbs);
	}
    public function test(){return;}
    /**
     * Display breadcrumbs.
     *
     * @return
     */
    public function display()
    {
        $baseUrl = Yii::app()->baseUrl ;
        $htmlParts = array();
        foreach ($this->breadcrumbs as $item) {
            list($name ,$url) = $item;
            if (empty($url)) {
                $htmlParts[] = $name ;
            } else {
                $htmlParts[] = CHtml::link($name,$url);
            }
        }
        echo implode($this->separator, $htmlParts);
    }
}
?>
