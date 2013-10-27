<?php

/**
 * This is the model class for table "site_share".
 *
 * The followings are the available columns in table 'site_share':
 * @property string $site_share_id
 * @property string $source_url
 * @property string $hash
 * @property string $img_url
 * @property string $title
 * @property string $object_type
 * @property string $object_id
 * @property string $customer_id
 * @property string $created
 */
class SiteShare extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return SiteShare the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'site_share';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('source_url, hash, img_url, title, object_type, object_id, customer_id, created', 'required'),
			array('source_url, title', 'length', 'max'=>100),
			array('hash', 'length', 'max'=>32),
			array('object_type', 'length', 'max'=>45),
			array('object_id, customer_id, created', 'length', 'max'=>10),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('site_share_id, source_url, hash, img_url, title, object_type, object_id, customer_id, created', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'site_share_id' => 'Site Share',
			'source_url' => 'Source Url',
			'hash' => 'Hash',
			'img_url' => 'Img Url',
			'title' => 'Title',
			'object_type' => 'Object Type',
			'object_id' => 'Object',
			'customer_id' => 'Customer',
			'created' => 'Created',
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

		$criteria->compare('site_share_id',$this->site_share_id,true);
		$criteria->compare('source_url',$this->source_url,true);
		$criteria->compare('hash',$this->hash,true);
		$criteria->compare('img_url',$this->img_url,true);
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
     * 1=短期行程  2=住所  3=攻略  4=美食 5=相册 6=行程单 7=回复' 8=商品评价
    */
    public function  addFavorite($data = array())
    {
        $data['customer_id'] = Yii::app()->user->customer_id;

        Switch($data['object_type'])
        {
            case          'Product':$model = Product::model()->findByPk($data['object_id']);
                                    $data['source_url'] = json_encode(array('base'=>'goods/index','param'=>array('id'=>$model['goods_id'])));
                                    $images = ProductImage::model()->find(array('condition'=>'product_id=:productId','params'=>array(':productId'=>$data['object_id'])));
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
                                    $data['img_url'] = json_encode(implode(',',$collection[1]));
                                    $data['title'] = $model['title'];
                                    break;

            case   'DelicacyReview':$model = DelicacyReview::model()->findByPk($data['object_id']);
                                    $data['source_url'] = json_encode(array('base'=>'delicacy/view','param'=>array('id'=>$model['delicacy_id'])));
                                    $data['title'] = $model->delicacy['title'];
                                    break;

            case       'Restaurant':$model = Restaurant::model()->findByPk($data['object_id']);
                                    $data['source_url'] = json_encode(array('base'=>'restaurant/view','param'=>array('id'=>$data['object_id'])));
                                    preg_match_all("/<[img|IMG].*?src=[\'|\"](.*?(?:[\.gif|\.jpg|\.png]))[\'|\"].*?[\/]?>/",$model['content'],$collection);
                                    $data['img_url'] = json_encode(implode(',',$collection[1]));
                                    $data['title'] = $model['title'];
                                    break;

            case 'RestaurantReview':$model = RestaurantReview::model()->findByPk($data['object_id']);
                                    $data['source_url'] = json_encode(array('base'=>'restaurant/view','param'=>array('id'=>$model['restaurant_id'])));
                                    $data['title'] = $model->restaurant['title'];
                                    break;


            case       'AlbumImage':$model = AlbumImage::model()->findByPk($data['object_id']);
                                    $data['source_url'] = 'NULL';
                                    $data['img_url'] = json_encode(array($model['img_path']));
                                    $data['title'] = $model['img_title'];
                                    break;
            case       'Attraction':$model = Attraction::model()->findByPk($data['object_id']);
                                    $data['source_url'] = json_encode(array('base'=>'attraction/view','param'=>array('id'=>$model['attraction_id'])));
                                    $data['img_url'] = json_encode(array($model['image']));
                                    $data['title'] = $model['name'];
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
            case        'City':$model = City::model()->findByPk($data['object_id']);
                                    $data['source_url'] = json_encode(array('base'=>'city/view','param'=>array('cid'=>$model['city_id'])));
                                    $data['img_url'] = json_encode(array($model['image']));
                                    $data['title'] = $model['name'];
                                    break;
            case        'Food':$model = Food::model()->findByPk($data['object_id']);
                                    $data['source_url'] = json_encode(array('base'=>'food/view','param'=>array('cid'=>$model['food_id'])));
                                    $data['img_url'] = json_encode(array($model['image']));
                                    $data['title'] = $model['name'];
                                    break;
        }
        if(isset($data['source_url']) && isset($data['title']) && isset($data['object_type']) &&  isset($data['object_id'])  &&  $data['customer_id'])
        {
            $data['hash'] = md5($data['object_type'].$data['object_id'].$data['customer_id']);
            if($this->count('hash="'.$data['hash'].'"')) return 1;

            $share = new SiteShare;
            $share->attributes = $data;
            $share->created = time();
            if($share->save()){
                Dynamic::model()->saveDynamicApi($data['object_id'], $data['object_type'], $data['customer_id'],2);
                SiteCoolCount::counter(md5($data['object_type'].$data['object_id']),SiteCoolCount::TYPE_SHARE);
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
        return SiteShare::model()->countByAttributes(array('object_type'=>$type,'object_id'=>$id));
    }
    // rick  add  判断是否已经被分享
    public function checkIsShare($object_type,$object_id){

        $data=  Yii::app()->db->createCommand()
        ->select('*')
        ->from('site_share')
        ->where('object_id=:id and object_type=:type', array(':id'=>$object_id,':type'=>$object_type))
        ->queryAll();

        return count($data);
    }


}