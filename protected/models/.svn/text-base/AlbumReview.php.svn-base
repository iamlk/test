<?php

/**
 * This is the model class for table "album_review".
 *
 * The followings are the available columns in table 'album_review':
 * @property int(10) $album_review_id
 * @property int(10) $parent_review_id
 * @property int(10) unsigned $album_image_id
 * @property int(10) unsigned $customer_id
 * @property int(10) $created
 * @property tinyint(2) $is_active
 * @property varchar(500) $content
 *
 * The followings are the available model relations:
 * @property Customer $customer
 * @property AlbumImage $albumImage
 */
class AlbumReview extends BaseActiveRecord
{

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('parent_review_id, album_image_id, customer_id, created, is_active, content',
                    'required'),
            array(
                'parent_review_id, created, is_active',
                'numerical',
                'integerOnly' => true),
            array(
                'album_image_id, customer_id',
                'length',
                'max' => 10),
            array(
                'content',
                'length',
                'max' => 500),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array(
                'album_review_id, parent_review_id, album_image_id, customer_id, created, is_active, content',
                'safe',
                'on' => 'search'),
            );
    }

    /**
     * @return array the query criteria.
     * public function defaultScope()
     * {
     * return array('condition' => sprintf('%s.album_review_id>10', $this->getTableAlias(true, false)));
     * }
     */

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'customer' => array(
                self::BELONGS_TO,
                'Customer',
                'customer_id'),
            'albumImage' => array(
                self::BELONGS_TO,
                'AlbumImage',
                'album_image_id'),
            );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        $t = array(
            'album_review_id' => 'Album Review ID',
            'parent_review_id' => 'Parent Review ID',
            'album_image_id' => 'Album Image ID',
            'customer_id' => 'Customer ID',
            'created' => 'Created',
            'is_active' => 'Is Active',
            'content' => 'Content',
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

        $criteria->compare('album_review_id', $this->album_review_id);
        $criteria->compare('parent_review_id', $this->parent_review_id);
        $criteria->compare('album_image_id', $this->album_image_id, true);
        $criteria->compare('customer_id', $this->customer_id, true);
        $criteria->compare('created', $this->created);
        $criteria->compare('is_active', $this->is_active);
        $criteria->compare('content', $this->content, true);

        return new CActiveDataProvider($this, array('criteria' => $criteria, ));
    }

    public function getAlbumImageReview($id)
    {
        $data = Yii::app()->db->createCommand()->select('a.*,r.*')->from('album_image a')->
            join('album_review r', 'a.album_image_id=r.album_image_id')->where('a.album_image_id=:id and r.parent_id=:pid',
            array(':id' => $id, ':pid' => 0))->order('album_review_id desc')->queryAll();

        return $data;
    }
    //获取所有相册图片的评论
    public function getAllAlbumImageReviewFormUser($id)
    {

        $album = Yii::app()->db->createCommand()->select('i.album_image_id as album_image_id')->
            from('album a')->join('album_image i', 'a.album_id=i.album_id')->where('a.customer_id=:id',
            array(':id' => $id))->queryAll();
        $array = array();
        foreach ($album as $item) {

            $data = Yii::app()->db->createCommand()->select('a.*,r.*')->from('album_image a')->
                join('album_review r', 'a.album_image_id=r.album_image_id')->where('a.album_image_id=:id and r.parent_id=:pid',
                array(':id' => $item['album_image_id'], ':pid' => 0))->order('album_review_id desc')->
                queryAll();

            if (!empty($data)) {

                $array = array_merge($array, $data);
            }

        }
        return $array;

    }
    //获取当前评论的所有回复
    public function getAlbumReviewHF($id)
    {

        $data = Yii::app()->db->createCommand()->select('*')->from('album_review')->
            where('parent_id=:id', array(':id' => $id))->order('created desc')->queryAll();
        return $data;
    }
    //获取用户发出的所有回复
    public function getAlbumImageReviewSend($uid)
    {

        $data = Yii::app()->db->createCommand()->select('*')->from('album_review')->
            where('customer_id=:id and  parent_id=0', array(':id' => $uid))->order('created desc')->
            queryAll();
        return $data;
    }


}
