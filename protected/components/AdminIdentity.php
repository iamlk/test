<?php
/**
 * @desc 身份识别，识别"管理员"
 * @author zyme
 * @note 注意：id和name以数组array['admin']方式提供
 */
class AdminIdentity extends CUserIdentity
{

    private $_ids = array();
    private $_names = array();

    public function __construct($username, $password)
    {
        parent::__construct($username, $password);
    }

    public function authenticate()
    {
        $admin = Admin::model()->findByAttributes(array('username' => $this->username));
        if ($admin == null)
        {
            $this->errorCode = self::ERROR_USERNAME_INVALID;
        }
        elseif ($admin->password != $this->password)
        {
            $this->errorCode = self::ERROR_PASSWORD_INVALID;
        }
        else
        {
            $this->errorCode = self::ERROR_NONE;
            $this->_ids['admin'] = $x = $admin->admin_id;
            $this->_names['admin'] = $y = $admin->username;
            $this->setState('admin_id', $x);
            $this->setState('admin_name', $y);
        }
        return !$this->errorCode;
    }

    public function getId()
    {
        return $this->_ids?:null;
    }

    public function getName()
    {
        return $this->_names?:null;
    }

}
