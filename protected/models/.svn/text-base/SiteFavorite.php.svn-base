<?php

/**
 * This is the model class for table "site_favorite".
 *
 * The followings are the available columns in table 'site_favorite':
 * @property int(10) unsigned $site_favorite_id
 * @property varchar(100) $source_url
 * @property varchar(200) $img_url
 * @property varchar(100) $title
 * @property varchar(45) $object_type
 * @property int(10) unsigned $object_id
 * @property int(10) unsigned $customer_id
 * @property int(10) unsigned $created
 *
 * The followings are the available model relations:
 * @property Customer $customer
 */
class SiteFavorite extends BaseActiveRecord
{

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('source_url, img_url, hash, title, object_type, object_id, customer_id, created', 'required'),
			array('source_url, title', 'length', 'max'=>100),
            array('hash', 'length', 'max'=>32),
			array('object_type', 'length', 'max'=>45),
			array('object_id, customer_id, created', 'length', 'max'=>10),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('site_favorite_id, source_url, img_url, title, hash, object_type, object_id, customer_id, created', 'safe', 'on'=>'search'),
		);
	}

    /**
     * @return array the query criteria.
    public function defaultScope()
    {
        return array('condition' => sprintf('%s.site_favorite_id>10', $this->getTableAlias(true, false)));
    }
     */

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'customer' => array(self::BELONGS_TO, 'Customer', 'customer_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		$t = array(
			'site_favorite_id' => 'Site Favorite ID',
			'source_url' => 'Source Url',
            'hash' => 'Hash',
			'img_url' => 'Img Url',
			'title' => 'Title',
			'object_type' => 'Object Type',
			'object_id' => 'Object ID',
			'customer_id' => 'Customer ID',
			'created' => 'Created',
		);
        foreach ($t as $k => $v) $t[$k] = Yii::t($this->tableName(), $v);
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

		$criteria=new CDbCriteria;

		$criteria->compare('site_favorite_id',$this->site_favorite_id,true);
		$criteria->compare('source_url',$this->source_url,true);
		$criteria->compare('img_url',$this->img_url,true);
        $criteria->compare('hash',$this->hash,true);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('object_type',$this->object_type,true);
		$criteria->compare('object_id',$this->object_id,true);
		$criteria->compare('customer_id',$this->customer_id,true);
		$criteria->compare('created',$this->created,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
    /**
     * 网站功能收藏接口
    */
    public function  addFavorite($data = array())
    {
        $data['customer_id'] = Yii::app()->user->customer_id;

        Switch($data['object_type'])
        {
            case          'Product':$model = Product::model()->findByPk($data['object_id']);
                                    $data['source_url'] = json_encode(array('base'=>'goods/index','param'=>array('id'=>$model['goods_id'])));
                                    $images = ProductImage::model()->findAll(array('condition'=>'product_id=:productId','params'=>array(':productId'=>$data['object_id']),'limit'=>4));
                                    foreach($images as $item)
                                    {
                                        $collection[] = $item['path'];
                                    }
                                    $data['img_url'] = json_encode(implode(',',$collection));
                                    $data['title'] = $model->productAddendum['title'];
                                    break;

            case    'ProductReview':$model = ProductReview::model()->findByPk($data['object_id']);
                                    $data['source_url'] = json_encode(array('base'=>'goods/index','param'=>array('id'=>$model->product['goods_id'])));
                                    $data['title'] = $model->product->productAddendum['title'];
                                    break;

            case         'Property':$model = Property::model()->findByPk($data['object_id']);
                                    $data['source_url'] = json_encode(array('base'=>'goods/index','param'=>array('id'=>$model['goods_id'])));
                                    $images = PropertyPicture::model()->findAll(array('condition'=>'property_id=:propertyId','params'=>array(':propertyId'=>$data['object_id']),'limit'=>4));
                                    foreach($images as $item)
                                    {
                                        $collection[] = $item['path'];
                                    }
                                    $data['img_url'] = json_encode(implode(',',$collection));
                                    $data['title'] = $model->propertyAddendum['title'];
                                    break;

            case   'PropertyReview':$model = PropertyReview::model()->findByPk($data['object_id']);
                                    $data['source_url'] = json_encode(array('base'=>'goods/index','param'=>array('id'=>$model->property['goods_id'])));
                                    $data['title'] = $model->property->propertyAddendum['title'];
                                    break;

            case          'Article':$model = Article::model()->findByPk($data['object_id']);
                                    $data['source_url'] = json_encode(array('base'=>'article/view','param'=>array('id'=>$data['object_id'])));
                                    preg_match_all("/<[img|IMG].*?src=[\'|\"](.*?(?:[\.gif|\.jpg|\.png]))[\'|\"].*?[\/]?>/",$model['content'],$collection);
                                    foreach($collection[1] as $item)
                                    {
                                        $images[] = trim($item,'/assets/');
                                    }
                                    $data['img_url'] = json_encode(implode(',',$images));
                                    $data['title'] = $model['title'];
                                    break;

            case    'ArticleReview':$model = ArticleReview::model()->findByPk($data['object_id']);
                                    $data['source_url'] = json_encode(array('base'=>'article/view','param'=>array('id'=>$model['article_id'])));
                                    $data['title'] = $model->article['title'];
                                    break;

            case         'Delicacy':$model = Delicacy::model()->findByPk($data['object_id']);
                                    $data['source_url'] = json_encode(array('base'=>'delicacy/view','param'=>array('id'=>$data['object_id'])));
                                    preg_match_all("/<[img|IMG].*?src=[\'|\"](.*?(?:[\.gif|\.jpg|\.png]))[\'|\"].*?[\/]?>/",$model['content'],$collection);
                                    foreach($collection[1] as $item)
                                    {
                                        $images[] = trim($item,'/assets/');
                                    }
                                    $data['img_url'] = json_encode(implode(',',$images));
                                    $data['title'] = $model['title'];
                                    break;

            case   'DelicacyReview':$model = DelicacyReview::model()->findByPk($data['object_id']);
                                    $data['source_url'] = json_encode(array('base'=>'delicacy/view','param'=>array('id'=>$model['delicacy_id'])));
                                    $data['title'] = $model->delicacy['title'];
                                    break;

            case       'Restaurant':$model = Restaurant::model()->findByPk($data['object_id']);
                                    $data['source_url'] = json_encode(array('base'=>'restaurant/view','param'=>array('id'=>$data['object_id'])));
                                    preg_match_all("/<[img|IMG].*?src=[\'|\"](.*?(?:[\.gif|\.jpg|\.png]))[\'|\"].*?[\/]?>/",$model['content'],$collection);
                                    foreach($collection[1] as $item)
                                    {
                                        $images[] = trim($item,'/assets/');
                                    }
                                    $data['img_url'] = json_encode(implode(',',$images));
                                    $data['title'] = $model['title'];
                                    break;

            case 'RestaurantReview':$model = RestaurantReview::model()->findByPk($data['object_id']);
                                    $data['source_url'] = join(array('base'=>'restaurant/view','param'=>array('id'=>$model['restaurant_id'])));
                                    $data['title'] = $model->restaurant['title'];
                                    break;


            case            'Album':$model = Album::model()->findByPk($data['object_id']);
                                    if($data['customer_id'] == $model['customer_id'])
                                    {
                                        $data['source_url'] = json_encode(array('base'=>'album/index','param'=>array('id'=>$data['object_id'])));
                                    }else{
                                        $data['source_url'] = json_encode(array('base'=>'people/index','param'=>array('id'=>$data['object_id'])));
                                    }
                                    $images = AlbumImage::model()->findAll(array('condition'=>'album_id=:albumId','params'=>array(':albumId'=>$data['object_id']),'limit'=>4));
                                    foreach($images as $item)
                                    {
                                        $collection[] = $item['img_path'];
                                    }
                                    $data['img_url'] = json_encode(implode(',',$collection));
                                    $data['title'] = $model['a_name'];
                                    break;

            case 'AttractionReview':$model = AttractionReview::model()->findByPk($data['object_id']);
                                    $data['source_url'] = json_encode(array('base'=>'attraction/index','param'=>array('id'=>$model['attraction_id'])));
                                    $data['title'] = $model->attraction['name'];
                                    break;

            case        'Travel':$model = Itinerary::model()->findByPk($data['object_id']);
                                    $data['source_url'] = json_encode(array('base'=>'itinerary/view','param'=>array('id'=>$data['object_id'],'cid'=>$model->itineraryDetails[0]['city_id'])));
                                    $i = 0;
                                    foreach($model->itineraryDetails as $item)
                                    {
                                        if(++$i==4)break;
                                        $_a = json_decode($item['json'],true);
                                        $collection[] = $_a['img'];
                                    }
                                        $data['img_url'] = json_encode(implode(',',$collection));
                                        $data['title'] = $model['title'];
                                    break;
        }
        if(isset($data['source_url']) && isset($data['title']) && isset($data['object_type']) &&  isset($data['object_id'])  &&  $data['customer_id'])
        {
            $data['hash'] = md5($data['object_type'].$data['object_id'].$data['customer_id']);
            if($this->count('hash="'.$data['hash'].'"')) return 1;

            $fav = new SiteFavorite;
            $fav->attributes = $data;
            $fav->created = time();
            if($fav->save()){
                Dynamic::model()->saveDynamicApi($data['object_id'], $data['object_type'], $data['customer_id'],3);
                SiteCoolCount::counter(md5($data['object_type'].$data['object_id']),SiteCoolCount::TYPE_FAVORITE);
                return 3;
            }else{
                return 0;
            }
        }else{
            return 2;
        }
    }

    public function myCount($type,$id)
    {
        return SiteFavorite::model()->countByAttributes(array('object_type'=>$type,'object_id'=>$id));
    }

}