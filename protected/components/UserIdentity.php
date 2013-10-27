<?php
/**
 * @desc 身份识别，组合识别"普通会员+房东会员+导游会员+商家会员+管理员"
 * @author zyme
 * @note 注意：id和name以数组array['customer/landlord/tourguide/business/admin']方式提供
 */
class UserIdentity extends CUserIdentity
{
    private $_id;
    private $_name;
    const ERROR_UNCERTIFIED = 11;//没有通过验证
    const ERROR_UNACTIVED   = 12;//无效用户

    public function __construct($username, $password)
    {
        parent::__construct($username, $password);
    }

    public function authenticate()
    {
        // customer
        $this->_auth_customer();
        $this->errorCode = self::ERROR_UNKNOWN_IDENTITY;
        if ($this->_id and $this->_name) 
        {
            // landlord
            $this->_auth_landlord();
            // tourguide
            $this->_auth_tourguide();
            // business
            $this->_auth_business();
            // error code
            $this->errorCode = self::ERROR_NONE;
        }
        return !$this->errorCode;
    }

    /**
     * @desc 识别"普通会员"
     */
    private function _auth_customer()
    {
        $identity = new CustomerIdentity($this->username, $this->password);
        $identity->authenticate();
        if ($identity->errorCode === CustomerIdentity::ERROR_NONE)
        {
            $identity->getId()      and $this->_id      = $identity->getId();
            $identity->getName()    and $this->_name    = $identity->getName();
            $this->setState('customer_id',  $this->_id);
            $this->setState('customer_name',$this->_name);
        }
        return $identity->errorCode;
    }

    /**
     * @desc 识别"房东会员"
     */
    private function _auth_landlord()
    {
        $identity = new LandlordIdentity($this->_id);
        $identity->authenticate();
        if ($identity->errorCode === LandlordIdentity::ERROR_NONE)
        {
            $this->setState('is_landlord', 1);
        }
    }

    /**
     * @desc 识别"导游会员"
     */
    private function _auth_tourguide()
    {
        $identity = new TourguideIdentity($this->_id);
        $identity->authenticate();
        if ($identity->errorCode === TourguideIdentity::ERROR_NONE)
        {
            $this->setState('is_tourguide', 1);
        }
    }

    /**
     * @desc 识别"商家会员"
     */
    private function _auth_business()
    {
        $identity = new BusinessIdentity($this->_id);
        $identity->authenticate();
        if ($identity->errorCode === BusinessIdentity::ERROR_NONE)
        {
            $this->setState('is_business', 1);
        }
    }

    public function getId()
    {
        return $this->_id?:null;
    }

    public function getName()
    {
        return $this->_name?:null;
    }

}
