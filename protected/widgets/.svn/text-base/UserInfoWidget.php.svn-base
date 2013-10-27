<?php
/**
 * @author rick
 * $this->Widget('application.widgets.UserInfo')
 */
class UserInfoWidget extends CWidget
{


    
    private $data;

    public function init()
    {

        
       $this->data=Customer::model()->findByPk(Yii::app()->user->customer_id);//获取用户信息

    }
    public function run()
    {

        $this->render('user_info', array('data'=>$this->data));
    }
}
