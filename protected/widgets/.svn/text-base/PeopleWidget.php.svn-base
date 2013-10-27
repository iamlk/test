<?php
/**
 * @author rick
 * $this->Widget('application.widgets.UserInfo')
 */
class PeopleWidget extends CWidget
{


    
    private $data;

    public function init()
    {

        
       $this->data=Customer::model()->findByPk($_REQUEST['u_id']);//获取用户信息

    }
    public function run()
    {

        $this->render('user_info', array('data'=>$this->data));
    }
}
