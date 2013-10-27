<?php
/**
 * @author darren
 * $this->Widget('application.widgets.FooterContentWidget')
 */
class FooterContentWidget extends CWidget{
    public $model;

    public function init()
    {
        $this->model = SiteOptionGroup::model()->findAll(array('condition'=>'t.parent_group_id=11 AND is_active=1'));
    }
    public function run(){
        $this->render('footer_content', array('model'=>$this->model));
    }
}