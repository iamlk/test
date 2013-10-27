<?php
/**
 * @desc 身份识别，识别"商家会员"
 * @author Fedora
 * @note 注意：不清楚问Fedora
 */
class BusinessIdentity extends CUserIdentity
{
    private $_id;

    public function __construct($customer_id)
    {
        $this->_id = $customer_id;
    }

    public function authenticate()
    {
        $customer = Customer::model()->findByPk($this->_id);
        $model = $customer->business;
        // 验证
        if ($model == null)
        {
            $this->errorCode = self::ERROR_USERNAME_INVALID;
        }
        elseif (!$model->is_certified)
        {
            $this->errorCode = UserIdentity::ERROR_UNCERTIFIED;
        }
        elseif (!$model->is_active)
        {
            $this->errorCode = UserIdentity::ERROR_UNACTIVED;
        }
        else
        {
            $this->errorCode = self::ERROR_NONE;
        }
        return !$this->errorCode;
    }

    public function getId()
    {
        return $this->_id?:null;
    }

    public function getName()
    {
        return null;
    }

}
