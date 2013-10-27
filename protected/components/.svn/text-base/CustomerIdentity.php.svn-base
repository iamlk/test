<?php
/**
 * @desc 身份识别，识别"普通会员"
 * @author zyme
 * @note 注意：id和name以数组array['customer']方式提供
 */
class CustomerIdentity extends CUserIdentity
{

    private $customer_id;
    private $customer_name;

    public function __construct($username, $password)
    {
        parent::__construct($username, $password);
    }

    public function authenticate()
    {
        $customer = Customer::model()->findByAttributes(array('email' => $this->username));
        if ($customer == null)
        {
            $this->errorCode    = self::ERROR_USERNAME_INVALID;
        }
        elseif ($customer->password != md5($this->password))
        {
            $this->errorCode    = self::ERROR_PASSWORD_INVALID;
        }
        else
        {
            $this->errorCode    = self::ERROR_NONE;
            $this->customer_id  = $customer->customer_id;
            $this->customer_name= $customer->nick_name;
        }
        return !$this->errorCode;
    }

    public function getId()
    {
        return $this->customer_id?:null;
    }

    public function getName()
    {
        return $this->customer_name?:null;
    }

}
