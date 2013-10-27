<?php

/**
 * This is the model class for table "product_image".
 *
 * The followings are the available columns in table 'product_image':
 * @property int(10) unsigned $product_image_id
 * @property varchar(128) $image_path
 * @property int(10) unsigned $product_id
 *
 * The followings are the available model relations:
 * @property Product $product
 */
class ProductImage extends BaseActiveRecord
{

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'product_image';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('path, product_id', 'required'),
			array('path', 'length', 'max'=>128),
			array('product_id', 'length', 'max'=>10),
            array("note",'safe'),
			array('product_image_id, path, product_id', 'safe', 'on'=>'search'),
		);
	}

    /**
     * @return array the query criteria.
     */
    public function defaultScope()
    {
        return array('condition' => sprintf('%s.product_image_id>0', $this->getTableAlias(true, false)));
    }

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'product' => array(self::BELONGS_TO, 'Product', 'product_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'product_image_id' => 'Product Image ID',
			'path' => 'Path',
			'product_id' => 'Product ID',
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

		$criteria=new CDbCriteria;

		$criteria->compare('product_image_id',$this->product_image_id,true);
		$criteria->compare('path',$this->path,true);
		$criteria->compare('product_id',$this->product_id,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
    
    public function getImages($product_id)
    {
        
        $productImage = ProductImage::model()->findAllByAttributes(array("product_id"=>$id));
        if($productImage == null)
        return false;
        else
        $arr = array();
        $i=0;
        foreach($productImage as $v)
        {
            $arr[$i]['path'] = $v->path;
            $arr[$i]['note'] = $v->note;
        }
        return $arr;
        
    }
    
    /**
     * 保存行程照片，带验证，对旧照片也有相关处理，删除(慎用)多的照片
     */
    public function updatePictures($product_id, $productPictures,$deleteFile = false)
    {
        
        $pictures = ProductImage::model()->findAllByAttributes(array('product_id' => $product_id));
        // 互相过滤，收集需要删除的东东
        $del_ids = $del_imgs = array();
        foreach ($pictures as $row)
        {
            $key = false;
            foreach ($productPictures as $_k=>$r)
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
                $del_ids[] = $row['product_image_id'];
                $del_imgs[] = $row['path'];
            }
            else  unset($productPictures[$key]);
        }
        // 需要增加的照片
        foreach ($productPictures as $r)
        {
            // 验证
            if (ImageHelper::validate(Yii::app()->assetManager->basePath.'/'.$r['path']) === true)
            {
                $_p = new ProductImage;
                $_p->product_id = $product_id;
                // 图片移动到此
                $_p->path = $r['path'];
                $_p->note = $r['note'];
                $_p->save(false);
            }
        }
        // 需要删除的记录
        if ($del_ids) 
        {
            $del_ids = trim(implode(',',$del_ids),',');
            ProductImage::model()->deleteAll("product_image_id in($del_ids)");
        }
        // 需要删除(慎用)的照片
        if ($deleteFile and $del_imgs)
        {
            foreach ($del_imgs as $file) unlink(realpath(Yii::app()->assetManager->basePath.'/'.$file));
        }
    }
    
    
    
}