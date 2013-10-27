<?php
/**
 * 后台管理
 * @author zyme
 */
class ManageController extends ManageBaseController
{

    /**
     * @return array action filters
     */
    public function filters()
    {
        return array('accessControl', );
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules()
    {
        return array(
            array(
                'allow',
                'users' => array('admin'),
                ),
            array(
                'deny',
                'users' => array('*'),
                ),
            );
    }

    

}
