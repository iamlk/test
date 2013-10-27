<?php
/**
 * @desc 会话处理，附加登录后的会话信息
 * @author created zyme updated By Fedora
 * @note 注意：id和name以数组array['customer/business/admin']方式提供
 */
class BaseWebUser extends CWebUser
{
    public $allowAutoLogin=true;

    public function getCustomer_id()
    {
        return $this->getState('customer_id');
    }

    public function getCustomer_name()
    {
        return $this->getState('customer_name');
    }
    
    public function setCustomer_name($nick_name)
    {
        return $this->setState('customer_name',$nick_name);
    }
    
    public function getIsLandlord()
    {
        return $this->getState('is_landlord');
    }
    
    public function getIsBusiness()
    {
        return $this->getState('is_business');
    }
    
    public function getIsTourguide()
    {
        return $this->getState('is_tourguide');
    }
    /** add by leo */ 
    public function afterLogout()
    {
        $url = $_SERVER['HTTP_REFERER'];
        $url = $url?$url:'/';
        header('Location:'.$url);
    }

}
