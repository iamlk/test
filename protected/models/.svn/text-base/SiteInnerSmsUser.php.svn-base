<?php

/**
 * This is the model class for table "site_inner_sms_user".
 *
 * The followings are the available columns in table 'site_inner_sms_user':
 * @property int(10) unsigned $_id
 * @property varchar(1024) $log
 * @property int(10) unsigned $customer_id
 * @property tinyint(5) unsigned $sms
 *
 * The followings are the available model relations:
 * @property Customer $customer
 */
class SiteInnerSmsUser extends BaseActiveRecord
{
    static public $result = array('state' => null, 'reason' => null);

    private $json = array(array(), );
    private $news = null;

    const Y = 'Y'; //已读

    const N = 'N'; //未读

    const D = 'D'; //已删除

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('log, customer_id ,sms', 'required'),
            array(
                'sms',
                'numerical',
                'integerOnly' => true),
            array(
                'log',
                'length',
                'max' => 1024),
            array(
                'customer_id',
                'length',
                'max' => 10),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array(
                '_id, log, customer_id, sms',
                'safe',
                'on' => 'search'),
            );
    }

    /**
     * @return array the query criteria.
     * public function defaultScope()
     * {
     * return array('condition' => sprintf('%s._id>10', $this->getTableAlias(true, false)));
     * }
     */

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array('customer' => array(
                self::BELONGS_TO,
                'Customer',
                'customer_id'), );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        $t = array(
            '_id' => 'ID',
            'log' => 'Log',
            'customer_id' => 'Customer ID',
            'sms' => 'News',
            );
        foreach ($t as $k => $v)
            $t[$k] = Yii::t($this->tableName(), $v);
        return $t;
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search()
    {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('_id', $this->_id, true);
        $criteria->compare('log', $this->log, true);
        $criteria->compare('customer_id', $this->customer_id, true);
        $criteria->compare('sms', $this->news);

        return new CActiveDataProvider($this, array('criteria' => $criteria, ));
    }

    /**
     *  rick add 站内信自动分配
     */

    public function autoDistribution($uid)
    {

        if (empty($uid)) {

            SiteInnerSmsUser::$result['state'] = '0';

            SiteInnerSmsUser::$result['reason'] = '用户ID错误';

            exit(json_encode(SiteInnerSmsUser::$result));
        }

        //获取系统站内信
        $data = $this->selectSmsInfoData();

        if (empty($data)) {

            SiteInnerSmsUser::$result['state'] = '0';

            SiteInnerSmsUser::$result['reason'] = '站内信为空';

            exit(json_encode(SiteInnerSmsUser::$result));
        }

        $smsdata = $this->getSmsLogData($uid);

        $this->news = $smsdata['news'];

        $alllog = (array )json_decode($smsdata['log']);

        $logarr = $this->jsonDataToArray(json_decode($smsdata['log']));

        $diffarr = array_diff($data, $logarr);

        if (!empty($diffarr)) {

            foreach ($diffarr as $item) {

                $alllog[$item] = SiteInnerSmsUser::N;
            }

            $this->news += count($diffarr);

            $this->json = array_filter($alllog);
            if ($this->updateSmsNote($uid)) {

                SiteInnerSmsUser::$result['state'] = '1';

                SiteInnerSmsUser::$result['reason'] = '站内信分配成功';

                SiteInnerSmsUser::$result['count'] = $this->news;

                exit(json_encode(SiteInnerSmsUser::$result));

            } else {

                SiteInnerSmsUser::$result['state'] = '0';

                SiteInnerSmsUser::$result['reason'] = '站内信分配失败';

                exit(json_encode(SiteInnerSmsUser::$result));
            }


        } else {

            SiteInnerSmsUser::$result['state'] = '0';

            SiteInnerSmsUser::$result['reason'] = '没有新消息';

            exit(json_encode(SiteInnerSmsUser::$result));
        }

    }

    /**
     *  站内信操作(删除、已读)
     */
    public function smsOperate($smsid, $uid, $state = SiteInnerSmsUser::Y)
    {

        $data = $this->selectSmsUser($uid);
        $this->news = $data['sms'];
        $logarr = json_decode($data['log']);

        foreach ($logarr as $key => $item) {

            if ($smsid != $key) {

                $this->json[$key] = $item;

            } else {

                if ($item == SiteInnerSmsUser::N || $item == SiteInnerSmsUser::Y) {
                    if ($item == SiteInnerSmsUser::N) {

                        $this->news--;
                    }
                    $this->json[$key] = $state;

                } else {

                    $this->json[$key] = $item;
                }

            }
        }

        $this->json = array_filter($this->json);

        if ($this->updateSmsNote($uid)) {

            SiteInnerSmsUser::$result['state'] = '1';

            SiteInnerSmsUser::$result['reason'] = '站内信删除成功';

            SiteInnerSmsUser::$result['count'] = $this->news;

            exit(json_encode(SiteInnerSmsUser::$result));

        } else {

            SiteInnerSmsUser::$result['state'] = '0';

            SiteInnerSmsUser::$result['reason'] = '站内信删除失败';

            exit(json_encode(SiteInnerSmsUser::$result));
        }
    }


    //JSON数据处理
    private function jsonDataToArray($log)
    {
        $arr = array();
        foreach ($log as $key => $val) {

            $arr[] = $key;
        }
        return $arr;
    }
    //获取用户站内信关联日志信息
    public function getSmsLogData($uid)
    {
        $data = $this->selectSmsUser($uid);
        if (empty($data)) {

            if (!$this->addSmsLogNote($uid)) {

                SiteInnerSmsUser::$result['state'] = '0';

                SiteInnerSmsUser::$result['reason'] = '建立消息关联失败';

                exit(json_encode(SiteInnerSmsUser::$result));

            } else {

                return $this->selectSmsUser($uid);
            }

        } else {

            return $data;
        }

    }

    //创建站内信日志记录
    public function addSmsLogNote($uid)
    {

        $sms = new SiteInnerSmsUser;

        $sms->log = json_encode($this->json);

        $sms->customer_id = $uid;

        $sms->sms = 0;

        return $sms->save(false);


    }
    //修改消息LOG
    function updateSmsNote($uid)
    {

        $sms = SiteInnerSmsUser::model()->findByAttributes(array('customer_id' => $uid));
        $sms->log = json_encode($this->json);
        $sms->sms = $this->news;
        return $sms->save(false); // 将更改保存到数据库

    }


    //查询日志关联记录
    public function selectSmsUser($uid)
    {

        $data = Yii::app()->db->createCommand()->select('*')->from('site_inner_sms_user')->
            where('customer_id=:id', array(':id' => $uid))->queryRow();

        return $data;
    }

    //获取站内信所有记录
    public function selectSmsInfoData()
    {
        $arr = array();
        $data = Yii::app()->db->createCommand()->select('site_inner_sms_id')->from('site_inner_sms')->
            where('customer_id=:cid and to_customer_id =:tid', array(':cid' => 1, ':tid' =>
                1))->queryAll();


        foreach ($data as $item) {

            $arr[] = $item['site_inner_sms_id'];
        }

        return $arr;
    }

    //获取站内信单条记录
    public function selectSmsInfoDataOne($sid, $type)
    {

        $data = Yii::app()->db->createCommand()->select('*')->from('site_inner_sms')->
            where('customer_id=:cid and to_customer_id =:tid and site_inner_sms_id = :sid',
            array(
            ':cid' => 1,
            ':tid' => 1,
            ':sid' => $sid))->queryRow();
        $data['type'] = $type;
        return $data;
    }

    //获取用户的站内信（未读和已读）
    public function getUserAllSms($uid,$page)
    {

        $data = $this->selectSmsUser($uid);

        $logarr = json_decode($data['log']);

        $arr = array();
        foreach ($logarr as $key => $item) {

            if ($item == SiteInnerSmsUser::Y || $item == SiteInnerSmsUser::N) {

                $arr[] = $this->selectSmsInfoDataOne($key, $item);

            }
        }
        $arr = array_filter($arr);

        $pagedata = new CArrayDataProvider($arr, array(
            'sort' => array(

                'attributes' => array('created'),
                'defaultOrder' => array('created' => true),

                ),

            'pagination' => array('pageSize' => $page),
            ));

        return $pagedata;
    }

    //获取用户的站内信（未读）
    public function getUserNotReadySms($uid)
    {

      $data = Yii::app()->db->createCommand()->select('*')->from('site_inner_sms_user')->
            where('customer_id=:id', array(':id' => $uid))->queryRow();

        return $data['sms'];

    }
        //获取用户的站内信（未读）
    public function getUserNotReadSms($uid)
    {

        $data = $this->selectSmsUser($uid);

        $logarr = json_decode($data['log']);

        $arr = array();
        foreach ($logarr as $key => $item) {

            if ($item == SiteInnerSmsUser::N) {

                $arr[] = $this->selectSmsInfoDataOne($key, $item);

            }
        }
        $arr = array_filter($arr);
        return $arr;
    }
    
       /**
     *  站内信操作(已读)
     */
    public function smsOperateIsRead($smsid, $uid, $state = SiteInnerSmsUser::Y)
    {

        $data = $this->selectSmsUser($uid);
        $this->news = $data['sms'];
        $logarr = json_decode($data['log']);

        foreach ($logarr as $key => $item) {

            if ($smsid != $key) {

                $this->json[$key] = $item;

            } else {

                if ($item == SiteInnerSmsUser::N || $item == SiteInnerSmsUser::Y) {
                    if ($item == SiteInnerSmsUser::N) {

                        $this->news--;
                    }
                    $this->json[$key] = $state;

                } else {

                    $this->json[$key] = $item;
                }

            }
        }

        $this->json = array_filter($this->json);

       $this->updateSmsNote($uid);

      
    }



}
