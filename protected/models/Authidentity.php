<?php

/**
 * This is the model class for table "authidentity".
 *
 * The followings are the available columns in table 'authidentity':
 * @property int(10) unsigned $authidentity_id
 * @property varchar(50) $country
 * @property varchar(50) $cert_type
 * @property varchar(200) $cert_image
 * @property varchar(200) $guide_image
 * @property varchar(200) $company_listen_image
 * @property varchar(200) $company_tax_image
 * @property smallint(5) unsigned $auth_type
 * @property int(10) unsigned $customer_id
 * @property smallint(5) $auth_state
 * @property varchar(200) $auth_notes
 *
 * The followings are the available model relations:
 * @property Customer $customer
 */
class Authidentity extends BaseActiveRecord
{
    const LANDER = 1; //房东
    const GUIDE = 2; //导游
    const BPEOPLE = 3; //个人商家
    const BCOMPANY = 4; //企业商家
    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('auth_type, customer_id', 'required'),
            array(
                'auth_type, auth_state',
                'numerical',
                'integerOnly' => true),
            array(
                'country, cert_type',
                'length',
                'max' => 50),
            array(
                'cert_image, guide_image, company_listen_image, company_tax_image, auth_notes',
                'length',
                'max' => 200),
            array(
                'customer_id',
                'length',
                'max' => 10),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array(
                'authidentity_id, country, cert_type, cert_image, guide_image, company_listen_image, company_tax_image, auth_type, customer_id, auth_state, auth_notes',
                'safe',
                'on' => 'search'),
            );
    }

    /**
     * @return array the query criteria.
     * public function defaultScope()
     * {
     * return array('condition' => sprintf('%s.authidentity_id>10', $this->getTableAlias(true, false)));
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
            'authidentity_id' => 'Authidentity ID',
            'country' => 'Country',
            'cert_type' => 'Cert Type',
            'cert_image' => 'Cert Image',
            'guide_image' => 'Guide Image',
            'company_listen_image' => 'Company Listen Image',
            'company_tax_image' => 'Company Tax Image',
            'auth_type' => 'Auth Type',
            'customer_id' => 'Customer ID',
            'auth_state' => 'Auth State',
            'auth_notes' => 'Auth Notes',
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

        $criteria->compare('authidentity_id', $this->authidentity_id, true);
        $criteria->compare('country', $this->country, true);
        $criteria->compare('cert_type', $this->cert_type, true);
        $criteria->compare('cert_image', $this->cert_image, true);
        $criteria->compare('guide_image', $this->guide_image, true);
        $criteria->compare('company_listen_image', $this->company_listen_image, true);
        $criteria->compare('company_tax_image', $this->company_tax_image, true);
        $criteria->compare('auth_type', $this->auth_type);
        $criteria->compare('customer_id', $this->customer_id, true);
        $criteria->compare('auth_state', $this->auth_state);
        $criteria->compare('auth_notes', $this->auth_notes, true);

        return new CActiveDataProvider($this, array('criteria' => $criteria, ));
    }
    //获取不同身份认证的数量
    public function getAuthCount($type)
    {

        switch ($type) {

            case Authidentity::LANDER:
                $user = Yii::app()->db->createCommand()->select('*')->from('authidentity')->
                    where('auth_type=:type and auth_state=:auth_state', array(':type' => $type,
                        ':auth_state' => 0))->queryAll();

                return count($user);
                break;


            case Authidentity::GUIDE:
                $user = Yii::app()->db->createCommand()->select('*')->from('authidentity')->
                    where('auth_type=:type and auth_state=:auth_state', array(':type' => $type,
                        ':auth_state' => 0))->queryAll();

                return count($user);
                break;

            case Authidentity::BPEOPLE:
                $user = Yii::app()->db->createCommand()->select('*')->from('authidentity')->
                    where('auth_type=:type and auth_state=:auth_state', array(':type' => $type,
                        ':auth_state' => 0))->queryAll();

                return count($user);
                break;
                $user = Yii::app()->db->createCommand()->select('*')->from('authidentity')->
                    where('auth_type=:type and auth_state=:auth_state', array(':type' => $type,
                        ':auth_state' => 0))->queryAll();

                return count($user);
                break;

            case Authidentity::BCOMPANY:

        }

    }


}
