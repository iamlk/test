<?php
/**
 * 房子的照片
 */
class PropertyPicture extends BaseActiveRecord
{

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('property_id, path, note, is_face', 'required'),
            array(
                'property_id',
                'exist',
                'className' => 'Property'),
            array(
                'path, note',
                'length',
                'max' => 250),
            array(
                'is_face',
                'boolean',
                'allowEmpty' => false),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array(
                '_id, property_id, path, note, is_face',
                'safe',
                'on' => 'search'),
            );
    }

    /**
     * @return array the query criteria.
     */
    public function scopes()
    {
        return array(
            'faces' => array(
                'condition' => 'is_face=1',
                'limit' => 30,
                'order' => '_id ASC',
                ),
            'rooms' => array(
                'condition' => 'is_face=0',
                'limit' => 30,
                'order' => '_id ASC',
                ),
            );
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array('property' => array(
                self::BELONGS_TO,
                'Property',
                'property_id'), );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            '_id' => 'ID',
            'property_id' => 'Property ID',
            'path' => 'Path',
            'note' => 'Note',
            'is_face' => 'Is Face',
            );
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
        $criteria->compare('property_id', $this->property_id, true);
        $criteria->compare('path', $this->path, true);
        $criteria->compare('note', $this->note, true);
        $criteria->compare('is_face', $this->is_face, true);

        return new CActiveDataProvider($this, array('criteria' => $criteria, ));
    }

    /**
     * 保存房子照片，带验证，对旧照片也有相关处理，删除(慎用)多的照片
     */
    public function updatePictures($property_id, $propertyPictures, $is_face, $deleteFile = false)
    {
        // pictures
        if ($is_face) $pictures = $this->faces()->findAllByAttributes(array('property_id' => $property_id));
        else  $pictures = $this->rooms()->findAllByAttributes(array('property_id' => $property_id));
        // 互相过滤，收集需要删除的东东
        $del_ids = $del_imgs = array();
        foreach ($pictures as $row)
        {
            $key = false;
            foreach ($propertyPictures as $_k=>$r)
            {
                if ( $row->path == $r['path'])
                {
                    if ( $row->note != $r['note'])
                    {
                        $row->note = $r['note'];
                        $row->update(array('note'));
                    }
                    $key = $_k;
                    break;
                }
            }
            if ($key === false)
            {
                $del_ids[] = $row['_id'];
                $del_imgs[] = $row['path'];
            }
            else  unset($propertyPictures[$key]);
        }
        // 需要增加的照片
        foreach ($propertyPictures as $r)
        {
            // 验证
            if (ImageHelper::validate(Yii::app()->assetManager->basePath.'/'.$r['path']) === true)
            {
                $_p = new PropertyPicture;
                $_p->property_id = $property_id;
                $_p->is_face = $is_face?1:0;
                $_p->save(false);
                // 图片移动到此
                $_p->path = Yii::app()->assetManager->makeAssetFileUrl(Yii::app()->assetManager->basePath.'/'.$r['path'], $_p->_id, 'property_picture/path');
                $_p->note = $r['note'];
                $_p->update(array('path','note'));
            }
        }
        // 需要删除的记录
        if ($del_ids) $this->deleteAll(sprintf('_id IN(%s)', implode(',', $del_ids)));
        // 需要删除(慎用)的照片
        if ($deleteFile and $del_imgs)
        {
            //foreach ($del_imgs as $file) unlink(realpath(Yii::app()->assetManager->basePath.'/'.$file));
        }
    }

}
