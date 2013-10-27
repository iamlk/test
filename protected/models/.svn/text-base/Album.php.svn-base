<?php

/**
 * This is the model class for table "album".
 *
 * The followings are the available columns in table 'album':
 * @property int(10) unsigned $album_id
 * @property varchar(250) $a_name
 * @property varchar(300) $a_description
 * @property int(10) $created
 * @property int(10) unsigned $customer_id
 *
 * The followings are the available model relations:
 * @property Customer $customer
 * @property AlbumImage[] $albumImages
 * @property mixed $albumImageCount
 */
class Album extends BaseActiveRecord
{

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('a_name, a_description, created, customer_id', 'required'),
            array(
                'created',
                'numerical',
                'integerOnly' => true),
            array(
                'a_name',
                'length',
                'max' => 250),
            array(
                'a_description',
                'length',
                'max' => 300),
            array(
                'customer_id',
                'length',
                'max' => 10),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array(
                'album_id, a_name, a_description, created, customer_id',
                'safe',
                'on' => 'search'),
            );
    }

    /**
     * @return array the query criteria.
     * public function defaultScope()
     * {
     * return array('condition' => sprintf('%s.album_id>10', $this->getTableAlias(true, false)));
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
            'albumImages' => array(
                self::HAS_MANY,
                'AlbumImage',
                'album_id'),
            'albumImageCount' => array(
                self::STAT,
                'AlbumImage',
                'album_id'),
            );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        $t = array(
            'album_id' => 'Album ID',
            'a_name' => 'A Name',
            'a_description' => 'A Description',
            'created' => 'Created',
            'customer_id' => 'Customer ID',
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

        $criteria->compare('album_id', $this->album_id, true);
        $criteria->compare('a_name', $this->a_name, true);
        $criteria->compare('a_description', $this->a_description, true);
        $criteria->compare('created', $this->created);
        $criteria->compare('customer_id', $this->customer_id, true);

        return new CActiveDataProvider($this, array('criteria' => $criteria, ));
    }

    /**
     *  RICK ADD  2013-8-16  相册验证
     */
    public function checkAlbumName($uid, $a_name)
    {

        $data = Yii::app()->db->createCommand()->select('album_id')->from('album')
            // ->join('tbl_profile p', 'u.id=p.user_id')
            ->where('customer_id=:id and a_name=:name', array(':id' => $uid, ':name' => $a_name))->
            queryRow();

        return $data['album_id'];
    }
    /**
     *  RICK ADD  2013-8-16  获取用户的所有相册信息
     */
    public function getAlbumAllInfo($uid)
    {

        $criteria = new CDbCriteria;
        $criteria->alias = 'Album';
        $criteria->addCondition("customer_id = " . $uid);
        $data = Album::model()->findAll($criteria);
        return $data;
    }
   /**
     *  RICK ADD  2013-8-16  获取用户的相册内所有图片
     */
    public function getAlbumImages($a_id){
        
         $data = Yii::app()->db->createCommand()->select('count(*) as count')->from('album_image')->
            where('album_id=:id', array(':id' => $a_id))->order('created desc')->queryRow();
        
         return $data['count'];
        
    }
    
    /**
     *  RICK ADD  2013-8-16  获取用户相册里面的所有图片
     */
    public function getAlbumImageFormAid($a_id)
    {

        $data = Yii::app()->db->createCommand()->select('*')->from('album_image')->
            where('album_id=:id', array(':id' => $a_id))->order('created desc')->queryAll();
        return $data;
    }
    /**
     *  RICK ADD  2013-8-16  根据相册ID删除相册
     */

    public function DelAlbumFromAid($a_id)
    {

        $album = Album::model()->findByPk($a_id);


        return $album->delete();

    }
    /**
     *  RICK ADD  2013-8-16  根据图片ID删除图片
     */
    public function DelAlbumImage($imgaeid)
    {
        //首先删除图片的关联信息（评论信息）
        $data=Yii::app()->db->createCommand()
        ->select('*')
        ->from('album_review')
        ->where('album_image_id=:id', array(':id'=>$imgaeid))
        ->queryAll();
        //删除动态
       Dynamic::model()->deleteAll('interfix_id=:id',array(':id'=>$imgaeid)); 
        for($i=0;$i<count($data);$i++ ){
            //删除评论
            $temp=AlbumReview::model()->findByPk($data[$i]['album_review_id']);
            $temp->delete();
        
        }
        
        $album_image = AlbumImage::model()->findByPk($imgaeid);
        
        return $album_image->delete();
    }


    /**
     *  RICK ADD  2013-8-16  单个相册信息
     */
    public function getAlbumInfoFormAid($a_id)
    {

        $data = Yii::app()->db->createCommand()->select('*')->from('album')->where('album_id=:id',
            array(':id' => $a_id))->queryAll();
        return $data;
    }

    /**
     *  RICK ADD  2013-8-16  单个图片信息
     */
    public function getImageInfo($a_id)
    {

        $data = Yii::app()->db->createCommand()->select('*')->from('album_image')->
            where('album_image_id=:id', array(':id' => $a_id))->queryAll();
        return $data;

    }

    /**
     *  RICK ADD  2013-8-16  根据单个相片ID获取相册的ID
     */
    public function getAid($album_image_id)
    {

        $data = Yii::app()->db->createCommand()->select('album_id')->from('album_image')->
            where('album_image_id=:id', array(':id' => $album_image_id))->queryRow();
        return $data['album_id'];

    }

    /**
     *  RICK ADD  2013-8-16  设置封面
     */

    public function setFace($image_id)
    {
         
      //   echo $this->getAid($image_id);exit;
         
        $album = Album::model()->findByPk($this->getAid($image_id));
        
        $album->face = $image_id;
        
        return $album->save(false);

    }
    
      /**
     *  RICK ADD  2013-8-16  获取封面
     */
    public function getImageFace($a_id)
    {

        $data = Yii::app()->db->createCommand()->select('*')->from('album_image')->
            where('album_image_id=:id', array(':id' => $a_id))->queryRow();
        return $data['img_path'];

    }
}
