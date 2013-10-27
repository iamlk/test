<?php

/**
 * This is the model class for table "product".
 *
 * The followings are the available columns in table 'product':
 * @property int(10) unsigned $sect
 * @property int(10) unsigned $product_id
 * @property varchar(64) $code
 * @property decimal(10,2) $price
 * @property int(11) $duration
 * @property enum('hours','days') $duration_type
 * @property tinyint(1) $entity_type
 * @property int(10) unsigned $business_id
 *
 * The followings are the available model relations:
 * @property Business $business
 * @property ProductAddendum[] $productAddendums
 * @property mixed $productAddendumCount
 * @property ProductAttraction[] $productAttractions
 * @property mixed $productAttractionCount
 * @property ProductAttribute[] $productAttributes
 * @property mixed $productAttributeCount
 * @property ProductDescription[] $productDescriptions
 * @property mixed $productDescriptionCount
 * @property productEndCity[] $productEndCities
 * @property mixed $productEndCityCount
 * @property ProductImage[] $productImages
 * @property mixed $productImageCount
 * @property ProductMultiDay[] $productMultiDays
 * @property mixed $productMultiDayCount
 * @property ProductMultiDayPriceOverride[] $productMultiDayPriceOverrides
 * @property mixed $productMultiDayPriceOverrideCount
 * @property productOneDay[] $productOneDays
 * @property mixed $productOneDayCount
 * @property ProductOneDayPriceOverride[] $productOneDayPriceOverrides
 * @property mixed $productOneDayPriceOverrideCount
 * @property ProductOperation[] $productOperations
 * @property mixed $productOperationCount
 * @property ProductStartCity[] $productStartCities
 * @property mixed $productStartCityCount
 * @property ProductVisitingCity[] $productVisitingCities
 * @property mixed $productVisitingCityCount
 * @property travelCompanion[] $travelCompanions
 * @property mixed $travelCompanionCount
 */
class Product extends BaseActiveRecord
{

    const TOUR_ONE_DAY = 1;
    const TOUR_MULTI_DAY = 2;
    const TOUR_HOURS = 3;
    /** 分别表示 1 基本信息发布ok   2基本信息完善（非必需） 3 行程完善（非必需） 4. 价格设置 5.接待人数设置（非必需） 6.注意事项（非必需）  */
    public static $_STEP = array(
        1 => 1,
        2 => 2,
        3 => 3,
        4 => 4,
        5 => 5,
        6 => 6);

    public static $RoomType = array('1'=>'单人间','2'=>'双人间','3'=>'三人间','4'=>'四人间');

    public static $DayOrDays = array(1=>'OneDays',2=>'MultiDays',3=>'OneDays');
    public static function getDuration($type = null)
    {
        $a = array("days" => "天", "hours" => "段");
        return $type ? $a[$type] : $a;
    }
    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('goods_id,duration,duration_type', 'required'),
            array(
                'goods_id',
                'exist',
                'className' => 'Goods'),
            array(
                'duration,entity_type',
                'numerical',
                'integerOnly' => true),
            array('step', 'safe'),

            array(
                'product_type_id',
                'length',
                'max' => 10),
            array(
                'duration_type',
                'length',
                'max' => 5),

            array(
                'entity_type',
                'default',
                'value' => 0),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array(
                'product_id, duration, duration_type, entity_type',
                'safe',
                'on' => 'search'),
            );
    }

    /**
     * @return array the query criteria.
     */
    public function defaultScope()
    {
        //return array('condition' => sprintf('%s.product_id>0', $this->getTableAlias(true, false)));
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(

            'goods' => array(
                self::BELONGS_TO,
                'Goods',
                'goods_id'),
            'productAddendums' => array(
                self::HAS_MANY,
                'ProductAddendum',
                'product_id'),
            'addendum' => array(
                self::HAS_ONE,
                'ProductAddendum',
                'product_id',
                'condition' => 'addendum.language=' . '"' . Yii::app()->language . '"'),
            'productAddendum' => array(
                self::HAS_ONE,
                'ProductAddendum',
                'product_id',
                'condition' => 'productAddendum.language=' . '"' . Yii::app()->language . '"'),
            'productAddendumCount' => array(
                self::STAT,
                'ProductAddendum',
                'product_id'),
            'productAttractions' => array(
                self::HAS_MANY,
                'ProductAttraction',
                'product_id'),
            'productAttractionCount' => array(
                self::STAT,
                'ProductAttraction',
                'product_id'),
            'productAttributes' => array(
                self::HAS_MANY,
                'ProductAttribute',
                'product_id'),
            'productAttributeCount' => array(
                self::STAT,
                'productAttribute',
                'product_id'),
            'productDescriptions' => array(
                self::HAS_MANY,
                'ProductDescription',
                'product_id'),
            'productDescriptionCount' => array(
                self::STAT,
                'ProductDescription',
                'product_id'),
            'productEndCity' => array(
                self::HAS_ONE,
                'ProductEndCity',
                'product_id'),
            'productEndCityCount' => array(
                self::STAT,
                'ProductEndCity',
                'product_id'),
            'productImages' => array(
                self::HAS_MANY,
                'ProductImage',
                'product_id'),
            'productImageCount' => array(
                self::STAT,
                'productImage',
                'product_id'),
            'goodsImages' => array(
                self::HAS_MANY,
                'ProductImage',
                'product_id'),
            'goodsImageCount' => array(
                self::STAT,
                'productImage',
                'product_id'),
            'productMultiDay' => array(
                self::HAS_ONE,
                'ProductMultiDayPrice',
                'product_id'),
            'productMultiDayCount' => array(
                self::STAT,
                'ProductMultiDayPrice',
                'product_id'),
            'productMultiDayPriceOverrides' => array(
                self::HAS_MANY,
                'ProductMultiDayPriceOverride',
                'product_id'),
            'productMultiDayPriceOverrideCount' => array(
                self::STAT,
                'productMultiDayPriceOverride',
                'product_id'),
            'productOneDay' => array(
                self::HAS_ONE,
                'ProductOneDayPrice',
                'product_id'),
            'productOneDayCount' => array(
                self::STAT,
                'ProductOneDayPrice',
                'product_id'),
            'productOneDayPriceOverrides' => array(
                self::HAS_MANY,
                'ProductOneDayPriceOverride',
                'product_id'),
            'productOneDayPriceOverrideCount' => array(
                self::STAT,
                'productOneDayPriceOverride',
                'product_id'),
            'productOperations' => array(
                self::HAS_MANY,
                'ProductOperation',
                'product_id'),
            'productOperationCount' => array(
                self::STAT,
                'productOperation',
                'product_id'),
            'productStartCity' => array(
                self::HAS_ONE,
                'ProductStartCity',
                'product_id'),
            'productStartCityCount' => array(
                self::STAT,
                'ProductStartCity',
                'product_id'),
            'productVisitingCities' => array(
                self::HAS_MANY,
                'ProductVisitingCity',
                'product_id'),
            'productVisitingCityCount' => array(
                self::STAT,
                'productVisitingCity',
                'product_id'),
            'travelCompanions' => array(
                self::HAS_MANY,
                'TravelCompanion',
                'product_id'),
            'travelCompanionCount' => array(
                self::STAT,
                'TravelCompanion',
                'product_id'),
            'productNote' => array(
                self::HAS_ONE,
                'ProductNote',
                'product_id'),
            'productDepartures' => array(
                self::HAS_MANY,
                'ProductDeparture',
                'product_id'),
            'productComments' => array(
                self::HAS_MANY,
                'ProductComment',
                'product_id'),

            'productType' => array(
                self::BELONGS_TO,
                'ProductType',
                'product_type_id'),
            'goodsImage' => array(
                /*rick add 2013/8/7*/
                self::HAS_ONE,
                'ProductImage',
                'product_id'),
            'addendumOne' => array(
                self::HAS_ONE,
                'ProductAddendum',
                'product_id',
                ),
            'productReviews' => array(
                /*rick add(评论关联) 2013/8/7*/
                self::HAS_MANY,
                'ProductReview',
                'product_id'),
            'productReviewOne' => array(
                /*rick add(评论关联) 2013/8/7*/
                self::HAS_ONE,
                'ProductReview',
                'product_id'),    
            'productReviewCount' => array(
                self::STAT,
                'ProductReview',
                'product_id'),

            );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        $a = array(
            'product_id' => '商品编号',
            'goods_id' => '商品编号',
            'duration' => '持续时间',
            'duration_type' => '持续时间类型',
            'entity_type' => '行程标识',
            'product_type_id' => '行程类型',


            );
        foreach ($a as $k => $v)
            $a[$k] = Yii::t($this->tableName(), $v);
        return $a;
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
        $criteria->compare('product_id', $this->product_id, true);
        $criteria->compare('duration', $this->duration);
        $criteria->compare('duration_type', $this->duration_type, true);
        $criteria->compare('entity_type', $this->entity_type, true);
        $criteria->compare('step', $this->step, true);


        return new CActiveDataProvider($this, array('criteria' => $criteria, ));
    }


    /**
     * 可选择的"出车时间"列表，
     */
    public static function getInTimes()
    {
        $arr = array();
        $arr['99:99'] = CHtml::encode(Yii::t('product', '请选择'));
        for ($i = 0; $i < 24; $i++)
            $t = sprintf('%02u:00', $i) and $arr[$t] = $t;

        return $arr;
    }

    /**
     * 可选择的区间段
     */
    public static function sectionList()
    {
        $arr = array();

        for ($i = 1; $i <= 7; $i++) {
            $arr[$i] = $i . '段';
        }

        return $arr;
    }


    /**
     *  统计行程的开始时间和自动结束时间并输出周天行程
     * return array()
     * min_begin
     * max_over
     * auto_over
     * spece
     * $tours_type = 1 2 3 day days hours
     *
     **/
    public function caclTime($tours_type, $product_id)
    {
        $data = $temp = array();
        /** 多日游  **/
        if ($tours_type == 2) {

            // 统一价格
            $mult = ProductMultiDayPrice::model()->find(array('condition' => "product_id=$product_id",
                    'order' => '_id desc'));
            $t_time = $min = $max = time();
            if ($mult == null)
                return array();
            $v = $mult;

            $start_time = $v->start_date;
            $end_time = $v->end_date;
            if($start_time<$t_time && $end_time<$t_time)
            {
                //$start_time = $end_time = $t_time-10000;
            }

            $price1 = $price = $v->price_single;
            $price2 = $v->price_double;
            $price3 = $v->price_triple;
            $price4 = $v->price_quad;
            $price_kid = $v->price_kids;
            $price_adult = $v->price_adult;
            $check[7] = $v->sunday;
            $check[1] = $v->monday;
            $check[2] = $v->tuesday;
            $check[3] = $v->wednesday;
            $check[4] = $v->thursday;
            $check[5] = $v->friday;
            $check[6] = $v->saturday;
            $diff_days = ($v->end_date - $v->start_date) / (3600 * 24);
            for ($i = 0; $i <= $diff_days; $i++) {
                $temp['list'][strtotime("+$i days", $start_time)]['day'] = date("Y-m-d",
                    strtotime("+$i days", $start_time));
                $t = $temp['list'][strtotime("+$i days", $start_time)]['week'] = date("N",
                    strtotime("+$i days", $start_time));
                $temp['list'][strtotime("+$i days", $start_time)]['sel'] = $check[$t];
                $temp['list'][strtotime("+$i days", $start_time)]['price'] = $price;
                $temp['list'][strtotime("+$i days", $start_time)]['prices'] = array(
                    'price1' => $price1,
                    'price2' => $price2,
                    'price3' => $price3,
                    'price4' => $price4,
                    'price_kid' => $price_kid,
                    'price_adult' => $price_adult);

                $temp['list'][strtotime("+$i days", $start_time)]['date'] = date("j", strtotime
                    ("+$i days", $start_time));

            }


            $temp['start'] = date('Y-m-d', $start_time);
            $temp['over'] = date('Y-m-d', $end_time);

            // 特殊价格
            $mult_over = ProductMultiDayPriceOverride::model()->find(array('condition' =>
                    "product_id=$product_id", 'order' => '_id desc'));


            $temp_over = array();

            if ($mult_over) {

                $start_time = $mult_over->start_date;
                $end_time = $mult_over->end_date;

                $price1 = $price = $mult_over->price_single;
                $price2 = $mult_over->price_double;
                $price3 = $mult_over->price_triple;
                $price4 = $mult_over->price_quad;
                $price_kid = $mult_over->price_kids;
                $price_adult = $mult_over->price_adult;
                $check[7] = $mult_over->sunday;
                $check[1] = $mult_over->monday;
                $check[2] = $mult_over->tuesday;
                $check[3] = $mult_over->wednesday;
                $check[4] = $mult_over->thursday;
                $check[5] = $mult_over->friday;
                $check[6] = $mult_over->saturday;
                $diff_days = ($mult_over->end_date - $mult_over->start_date) / (3600 * 24);
                for ($i = 0; $i <= $diff_days; $i++) {
                    $temp_over['list'][strtotime("+$i days", $start_time)]['day'] = date("Y-m-d",
                        strtotime("+$i days", $start_time));
                    $t = $temp_over['list'][strtotime("+$i days", $start_time)]['week'] = date("N",
                        strtotime("+$i days", $start_time));
                    $temp_over['list'][strtotime("+$i days", $start_time)]['sel'] = $check[$t];
                    $temp_over['list'][strtotime("+$i days", $start_time)]['price'] = $price;
                    $temp_over['list'][strtotime("+$i days", $start_time)]['prices'] = array(
                        'price1' => $price1,
                        'price2' => $price2,
                        'price3' => $price3,
                        'price4' => $price4,
                        'price_kid' => $price_kid,
                        'price_adult' => $price_adult);

                    $temp_over['list'][strtotime("+$i days", $start_time)]['date'] = date("j",
                        strtotime("+$i days", $start_time));
                }
            }
            $temp['spec'] = $temp_over;
            return $temp;

            // 二次处理数据
        } elseif ($tours_type == 1 || $tours_type == 3) {
            // 统一价格
            $oneday = ProductOneDayPrice::model()->find(array('condition' => "product_id=$product_id",
                    'order' => '_id desc'));

            if ($oneday == null)
                return array();
            $v = $oneday;
            $start_time = $v->start_date;
            $end_time = $v->end_date;
            $price = $v->price_adult;
            $price_kid = $v->price_kids;
            $check[7] = $v->sunday;
            $check[1] = $v->monday;
            $check[2] = $v->tuesday;
            $check[3] = $v->wednesday;
            $check[4] = $v->thursday;
            $check[5] = $v->friday;
            $check[6] = $v->saturday;
            $diff_days = ($v->end_date - $v->start_date) / (3600 * 24);
            for ($i = 0; $i <= $diff_days; $i++) {
                $temp['list'][strtotime("+$i days", $start_time)]['day'] = date("Y-m-d",
                    strtotime("+$i days", $start_time));
                $t = $temp['list'][strtotime("+$i days", $start_time)]['week'] = date("N",
                    strtotime("+$i days", $start_time));
                $temp['list'][strtotime("+$i days", $start_time)]['sel'] = $check[$t];
                $temp['list'][strtotime("+$i days", $start_time)]['price'] = $price;
                $temp['list'][strtotime("+$i days", $start_time)]['prices'] = array('adult' => $price,
                        'kid' => $price_kid);
                $temp['list'][strtotime("+$i days", $start_time)]['date'] = date("j", strtotime
                    ("+$i days", $start_time));
            }


            $temp['start'] = date('Y-m-d', $start_time);
            $temp['over'] = date('Y-m-d', $end_time);

            // 特殊价格
            $one_over = ProductOneDayPriceOverride::model()->find(array('condition' =>
                    "product_id=$product_id", 'order' => '_id desc'));
            $temp_over = array();

            if ($one_over) {
                $start_time = $one_over->start_date;
                $end_time = $one_over->end_date;
                $price = $one_over->price_adult;
                $price_kid = $one_over->price_kids;
                $check[7] = $one_over->sunday;
                $check[1] = $one_over->monday;
                $check[2] = $one_over->tuesday;
                $check[3] = $one_over->wednesday;
                $check[4] = $one_over->thursday;
                $check[5] = $one_over->friday;
                $check[6] = $one_over->saturday;
                $diff_days = ($one_over->end_date - $one_over->start_date) / (3600 * 24);
                for ($i = 0; $i <= $diff_days; $i++) {
                    $temp_over['list'][strtotime("+$i days", $start_time)]['day'] = date("Y-m-d",
                        strtotime("+$i days", $start_time));
                    $t = $temp_over['list'][strtotime("+$i days", $start_time)]['week'] = date("N",
                        strtotime("+$i days", $start_time));
                    $temp_over['list'][strtotime("+$i days", $start_time)]['sel'] = $check[$t];
                    $temp_over['list'][strtotime("+$i days", $start_time)]['price'] = $price;
                    $temp_over['list'][strtotime("+$i days", $start_time)]['prices'] = array('adult' =>
                            $price, 'kid' => $price_kid);
                    $temp_over['list'][strtotime("+$i days", $start_time)]['date'] = date("j",
                        strtotime("+$i days", $start_time));
                }

            }
            $temp['spec'] = $temp_over;
            return $temp;

        }
        return $data;

    }
    public function showClander($product_id, $year, $month)
    {

        $respon = array(
            'status' => 'no',
            'message' => '数据有误',
            'data' => array());

        $product = Product::model()->findByPk($product_id);
        if (is_null($product))
            return $respon;
        $data = $this->caclTime($product->entity_type, $product_id);

        if (!$data)
            return $respon;
        $return = array();
        $list = $data['list'];
        $spec = $data['spec'];
        
        //print_r($data);die;
        $real_list_month = $real_spec_month = array();

        if ($list) {
            foreach ($list as $key => $v) {
                if ($month == date("n", $key) && $year == date('Y', $key) && $v['sel'] == 1) {
                    $real_list_month[] = $v;
                }

            }
        }

        if ($spec && isset($spec['list'])) {

            foreach ($spec['list'] as $key => $v) {
                if ($month == date("n", $key) && $year == date('Y', $key) && $v['sel'] == 1) {
                    $v['is_spec'] = 1;
                    $real_spec_month[] = $v;
                }

            }
        }
        
        //print_r($real_spec_month);die;
        
        $_t_t = array();
        foreach($real_list_month as $v)
        {
            $_t_t[$v['day']] = $v;
        }
        
        $_t_t_s = array();
        foreach($real_spec_month as $v)
        {
            $_t_t_s[$v['day']] = $v;
        }
        
        $_temp_spec = array();
        $_data_temp = array_merge($_t_t,$_t_t_s);
        foreach($_data_temp as $v)
        {
            $_temp_spec[] = $v;
        }
        
        if (!$real_list_month) {
            return $respon;
        }

        // print_r($result);die;
        $respon['is_mult'] = $product->entity_type == 2 ? 'yes' : 'no';
        $respon['year'] = $year;
        $respon['month'] = $month;
        $respon['status'] = 'yes';
        $respon['message'] = 'yes';

         $_t_data = $_temp_spec;
         $_price_arr = array();
         foreach($_t_data as $key => &$value)
         {
            if(floatval($value['prices']['kid']) == '0.00')
            {
                $value['prices']['kid'] = '/';
            }
            
            if(strtotime($value['day'])<time())
            {
                unset($_t_data[$key]);
            }
            else
            {
                $_price_arr[] = $value;
            }
         }
         
         

           //$respon['data'] = $_t_data;
           $respon['data'] = $_price_arr;
          // print_r($_t_data);die;
        return $respon;

    }

    /////////////////////////////////////////////////////////////////////////////////////////////////////

    /**
     * @author darren
     */
    public function getValuation($product_id)
    {
        $product_id = intval($product_id);
        $valuation_info = array();
        $valuation_per_sql = "select AVG(rating_total) as rating_total from " .
            ProductReview::model()->tableName() .
            " where parent_review_id=0 AND product_id = '" . $product_id .
            "' AND is_active='1'";
        $valuation_info['satisfaction'] = round(Yii::app()->db->createCommand($valuation_per_sql)->
            queryScalar(), 0);

        $valuation_info['satisfaction_img'] = '';
        $img_arr = array_fill(0, 5, '<img src="/images/icon/icon_star_%u.gif" />');
        foreach ($img_arr as $k => $img) {
            $img_arr[$k] = sprintf($img, ($valuation_info['satisfaction'] > 20 * $k ? 1 : 2));
            $valuation_info['satisfaction_img'] = implode($img_arr);
        }
        return $valuation_info['satisfaction_img'];
    }

    /**
     * @author darren
     */
    public function getPercentage($product_id)
    {
        $product_id = intval($product_id);
        $valuation_info = array();
        $valuation_per_sql = "select AVG(rating_total) as rating_total from " .
            ProductReview::model()->tableName() .
            " where parent_review_id=0 AND product_id = '" . $product_id .
            "' AND is_active='1'";
        $valuation_info['satisfaction'] = round(Yii::app()->db->createCommand($valuation_per_sql)->
            queryScalar(), 0);

        return $valuation_info['satisfaction'];
    }

    /**
     * @author darren
     * @return return data about page of review
     */
    public function getReviewInfo()
    {
        $language = '很不满意/不满意/一般/比较满意/非常满意';
        $ratings = array(
            'rating_total',
            'rating_1',
            'rating_2',
            'rating_3',
            'rating_4');
        $reviews_info = array();
        // satisfaction ... IMG & MSG
        $all_avg = ProductReview::model()->getReviewsPer($this->product_id);
        foreach ($ratings as $key => $value) {
            $reviews_info['satisfaction_' . $key] = round($all_avg[$value], 0);
            $reviews_info['satisfaction_img_' . $key] = $reviews_info['satisfaction_msg_' .
                $key] = '';
            $img_arr = array_fill(0, 5, '<img src="/images/icon/icon_star_%u.gif" />');
            //$msg_arr = explode('/',Yii::t('product_info',TEXT_SATISFACTION_5_LEVEL_MSG));
            $msg_arr = explode('/', $language);
            foreach ($img_arr as $k => $img) {
                $img_arr[$k] = sprintf($img, ($reviews_info['satisfaction_' . $key] > 20 * $k ?
                    1 : 2));
                $reviews_info['satisfaction_' . $key] > 20 * $k and $reviews_info['satisfaction_msg_' .
                    $key] = $msg_arr[$k];
            }
            $reviews_info['satisfaction_img_' . $key] = implode($img_arr);
        }
        // pagination & reviews & _count
        $dataProvider = $this->getReviewsProvider();
        $reviews_info['pagination'] = $dataProvider->pagination;
        $reviews_info['reviews'] = array();
        $reviews_info['review_count'] = 0;
        foreach ($dataProvider->getData() as $row) {
            if (!in_array($row['customer_id'], $customers)) {
                $customers[] = $row['customer_id'];
                $reviews_info['review_count'] += 1;
            }
            $arr = array();
            $arr['product_review_id'] = $row['product_review_id'];
            $arr['customer_id'] = $row['customer_id'];
            $arr['customers_name'] = $row->customer['nick_name'];
            $arr['customers_avatar'] = $row->customer['avator'];
            $arr['created'] = date('Y-m-d', $row['created']);
            $arr['helpful_yes_counter'] = $row['helpful_yes_counter'];
            $arr['helpful_no_counter'] = $row['helpful_no_counter'];
            //$arr['avatar'] = Customer::model()->getProfilePic($row['customer_id']);
            $arr['title'] = $row['name'];
            $arr['description'] = $row['description'];
            // satisfaction ... FACE & IMG & MSG
            foreach ($ratings as $key => $value) {
                $arr['satisfaction_' . $key] = round($row[$value], 0);
                $arr['satisfaction_face_' . $key] = sprintf('<img src="/images/icon/face_%s.gif" />',
                    $arr['satisfaction_' . $key] < 30 ? 3 : ($arr['satisfaction_' . $key] < 80 ? 2 :
                    1));
                $arr['satisfaction_img_' . $key] = $arr['satisfaction_msg_' . $key] = '';
                $img_arr = array_fill(0, 5, '<img src="/images/icon/icon_star_%u.gif" />');
                //$msg_arr = explode('/',Yii::t('product_info',TEXT_SATISFACTION_5_LEVEL_MSG));
                $msg_arr = explode('/', $language);
                foreach ($img_arr as $k => $img) {
                    $img_arr[$k] = sprintf($img, ($arr['satisfaction_' . $key] > 20 * $k ? 1 : 2));
                    $arr['satisfaction_' . $key] > 20 * $k and $arr['satisfaction_msg_' . $key] = $msg_arr[$k];
                }
                $arr['satisfaction_img_' . $key] = implode($img_arr);
            }
            // replies
            $arr['replies'] = array();
            foreach ($row->replies as $rep) {
                if ($rep['is_active'] != 1)
                    continue;
                $arr['replies'][] = array(
                    'product_review_id' => $rep['product_review_id'],
                    'parent_review_id' => $rep['parent_review_id'],
                    'customer_id' => $rep['customer_id'],
                    'customers_name' => $rep->customer['nick_name'],
                    'created' => date('Y-m-d', $rep['created']),
                    'description' => $rep['description']);
            }
            $reviews_info['reviews'][] = $arr;
        }
        //
        return $reviews_info;
    }
    
    public static function getStatus($product_id)
    {
         $respon = array();
         $model = Product::model()->findByPk($product_id);
         $step_str = $model->step;
         $step_arr = array();
         if($step_str)
         {
           $step_arr = explode(",",$step_str);
         }
            
         if(in_array(Product::$_STEP[1],$step_arr) && in_array(Product::$_STEP[4],$step_arr) && in_array(Product::$_STEP[6],$step_arr))
         {
                $goods = Goods::model()->findByPk($model->goods_id);
                if($goods && $goods->is_active !=1)
                {
                    $goods->is_active = 1;//激活
                   if( $goods->save(false))
                   {
                      
                   }
                }
                // 去个人中心管理  去前端页面浏览
                $respon['center'] =  Yii::app()->createUrl('center/shortrun',array());
                $respon['goods'] = Yii::app()->createUrl("goods/index",array('id'=>$goods->goods_id));
           }
           return $respon;
    }

    /**
     * @author darren
     * @return get sum of all review
     */
    public function getReviewCount()
    {
        $dataProvider = $this->getReviewsProvider();
        return count($dataProvider->getData());
    }

    /**
     * @author darren
     * @return return all review
     */
    public function getReviewsProvider()
    {
        $product_id = $this->product_id;
        // c
        $criteria = new CDbCriteria();
        $criteria->order = 'product_review_id DESC ';
        $criteria->addCondition('parent_review_id=0');
        $criteria->addCondition('is_active=1');
        $criteria->addCondition('product_id=:product_id');
        $criteria->params = array(':product_id' => $product_id);
        // d
        $dataProvider = new CActiveDataProvider('ProductReview', array(
            'criteria' => $criteria,
            'pagination' => array('pageSize' => 15, 'pageVar' => 'npage'),
            ));
        return $dataProvider;
    }

    /**
     * @author rick
     * @return return all product_id(me)
     */
    public function getProductId($user_id)
    {


        $arr = Yii::app()->db->createCommand()->select('p.product_id')->from('goods g')->
            where('customer_id=:id', array(':id' => $user_id))->join('product p',
            'p.goods_id=g.goods_id')->order('product_id desc')->queryAll();

        return $arr;

    }

    /**
     * @author rick
     * @return return all product_review
     */

    public function getProductReview($user_id)
    {
        $data = array();
        $p_arr = $this->getProductId($user_id);

        for ($i = 0; $i < count($p_arr); $i++) {

            $arr = Yii::app()->db->createCommand()->select('*')->from('product_review')->
                where('product_id=:id and is_active=1 and parent_review_id=0', array(':id' => $p_arr[$i]['product_id']))->
                order('product_review_id desc')->queryAll();

            if (!empty($arr)) {

                $data = array_merge_recursive($data, $arr);
            }

        }

        return $data;
    }

    /**
     *  获取对应评论的回复
     */
    public function getProductReviewHF($user_id)
    {

        $data = array();

        $arr = $this->getProductReview($user_id);

        $count = count($arr);

        for ($i = 0; $i < $count; $i++) {

            $temparr = Yii::app()->db->createCommand()->select('*')->from('product_review')->
                where('parent_review_id = :pid and customer_id= :id', array(':pid' => $arr[$i]['product_review_id'],
                    ':id' => $user_id))->order('product_review_id desc')->queryAll();

            if (!empty($temparr)) {

                $data = array_merge_recursive($data, $temparr);

            }

        }

        return $data;

    }
    
    //Fedora
    public function getExplodePrice($date)
    {
        $model = $this->getSpecialExplodePrice($date);
        if($model) return $model;
        
        if($this->entity_type == 2)
        {
            {
                $time = strtotime($date);
                $weekday = strtolower(date('l', $time));
                $model = ProductMultiDayPrice::model()->find('`start_date`<=' . $time .
                        ' AND `end_date`>=' . $time . ' AND `product_id`=' . intval($this->product_id));
                if (!$model || !$model->{$weekday}) 
                    return false;
                else
                    return $model;
            }
        }
        else
        {
            $time = strtotime($date);
            $weekday = strtolower(date('l', $time));
            $model = ProductOneDayPrice::model()->find('`start_date`<=' . $time .
                ' AND `end_date`>=' . $time . ' AND product_id=' . intval($this->product_id));
            if (!$model || !$model->{$weekday}) 
                return false;
            else
                return $model;
        }
    }
    
    //Feodra
    public function getSpecialExplodePrice($date)
    {
        if($this->entity_type == 2)
        {
            $time = strtotime($date);
            $weekday = strtolower(date('l', $time));
            $model = ProductMultiDayPriceOverride::model()->find('`t`.`start_date`<=' . $time .
                ' AND `t`.`end_date`>=' . $time . ' AND product_id=' . intval($this->product_id));
            if (!$model || !$model->{$weekday})
                return false;
            else
                return $model;
        }
        else
        {  
            $time = strtotime($date);
            $weekday = strtolower(date('l', $time));
            $model = ProductOneDayPriceOverride::model()->find('`t`.`start_date`<=' . $time .
                ' AND `t`.`end_date`>=' . $time . ' AND product_id=' . intval($this->product_id));
            if (!$model || !$model->{$weekday}) 
                return false;
            else
                return $model;
        }
    }

    //Fedora
    public function countMultiDaysPrice($date, $adult, $child, $rooms, $product_id = 0)
    {
        if(!$adult && !$child || !$date) return 0;
        $adult = intval($adult);
        $child = intval($child);
        $product_id = intval($product_id);
        $product_id = $product_id ? $product_id : $this->product_id;
        $special = $this->countMultiDaysSpecialPrice($date, $adult, $child, $rooms, $product_id);
        if ($special)
            return $special;
        $time = strtotime($date);
        $weekday = strtolower(date('l', $time));
        $model = ProductMultiDayPrice::model()->find('`start_date`<=' . $time .
            ' AND `end_date`>=' . $time . ' AND `product_id`=' . intval($product_id));
        if (!$model || !$model->{$weekday})
            return 0;
        $price = array();
        $price[1] = $model->price_single;
        $price[2] = $model->price_double;
        $price[3] = $model->price_triple;
        $price[4] = $model->price_quad;
        $tour_price = $model->price_adult * $adult + $model->price_kids * $child;
        $room_price = 0;
        foreach($rooms as $i=>$room){
            $room_price += $price[$i]*$room;
        }
        return $tour_price+$room_price;
    }

    //Fedora
    public function countMultiDaysSpecialPrice($date, $adult, $child, $rooms, $product_id = 0)
    {
        $product_id = $product_id ? $product_id : $this->product_id;
        $time = strtotime($date);
        $weekday = strtolower(date('l', $time));
        $model = ProductMultiDayPriceOverride::model()->find('`t`.`start_date`<=' . $time .
            ' AND `t`.`end_date`>=' . $time . ' AND product_id=' . intval($product_id));
        if (!$model || !$model->{$weekday})
            return 0;
        $price = array();
        $price[1] = $model->price_single;
        $price[2] = $model->price_double;
        $price[3] = $model->price_triple;
        $price[4] = $model->price_quad;
        $tour_price = $model->price_adult * $adult + $model->price_kids * $child;
        $room_price = 0;
        foreach($rooms as $i=>$room){
            $room_price += $price[$i]*$room;
        }
        return $tour_price+$room_price;
    }

    //Fedora
    public function countOneDayPrice($date, $adult, $child, $product_id = 0)
    {
        if(!$adult && !$child || !$date) return 0;
        $adult = intval($adult);
        $child = intval($child);
        $product_id = intval($product_id);
        $product_id = $product_id ? $product_id : $this->product_id;
        $special = $this->countOneDaySpecialPrice($date, $adult, $child, $product_id);
        if ($special)
            return $special;
        $time = strtotime($date);
        $weekday = strtolower(date('l', $time));
        $model = ProductOneDayPrice::model()->find('`start_date`<=' . $time .
            ' AND `end_date`>=' . $time . ' AND product_id=' . $product_id);
        if (!$model || !$model->{$weekday})
            return 0;
        return $model->price_adult * $adult + $model->price_kids * $child;
    }

    //Fedora
    public function countOneDaySpecialPrice($date, $adult, $child, $product_id = 0)
    {
        $product_id = $product_id ? $product_id : $this->product_id;
        $time = strtotime($date);
        $weekday = strtolower(date('l', $time));
        $model = ProductOneDayPriceOverride::model()->find('`t`.`start_date`<=' . $time .
            ' AND `t`.`end_date`>=' . $time . ' AND product_id=' . $product_id);
        if (!$model || !$model->{$weekday})
            return 0;
        return $model->price_adult * $adult + $model->price_kids * $child;
    }

    /**
     * @author rick add 2013-8-19
     * @return return me send propertyreview
     */
    public function getSendProductComment($user_id)
    {


        $arr = Yii::app()->db->createCommand()->select('*')->from('product_review')->
            where('customer_id = :id', array(':id' => $user_id))->order('product_review_id desc')->
            queryAll();


        return $arr;


    }

    /**
     * @author rick add 2013-8-19
     * @return 返回卖家对买家的短期行程评论的回复
     */
    public function getReciveProductComment($user_id)
    {
        $data = array();

        $arr = Yii::app()->db->createCommand()->select('*')->from('product_review')->
            where('customer_id = :id and parent_review_id=:rid', array(':id' => $user_id,
                'rid' => 0))->order('product_review_id desc')->queryAll();

        $count = count($arr);

        for ($i = 0; $i < $count; $i++) {

            $id = $arr[$i]['product_review_id'];

            $temparr = Yii::app()->db->createCommand()->select('*')->from('product_review')->
                where('parent_review_id=:id', array(':id' => $id))->order('product_review_id desc')->
                queryAll();

            if (!empty($temparr)) {

                $data = array_merge_recursive($data, $temparr);

                unset($temparr);

            }
        }

        return $data;


    }
    /**
     * @author rick add 2013-8-19
     * @return 返回短期行程的PRICE 参数 product_id
     */
    public function getProductPrice($product_id)
    {

        $arr = Yii::app()->db->createCommand()->select('goods_id')->from('product')->
            where('product_id = :id', array(':id' => $product_id))->queryAll();

        $arr = Yii::app()->db->createCommand()->select('price')->from('goods')->where('goods_id = :id',
            array(':id' => $arr[0]['goods_id']))->queryAll();

        return $arr[0]['price'];

    }

     /**
     * @author rick add 2013-8-19
     * @return 返回短期行程的goods_id 参数 product_id
     */
    public function getProductGoods_id($product_id)
    {

        $arr = Yii::app()->db->createCommand()->select('goods_id')->from('product')->
            where('product_id = :id', array(':id' => $product_id))->queryAll();

        return $arr[0]['goods_id'];

    }
    
    
    //Fedora 返回被占用的人数
    public function getOccupied($goods_id,$date)
    {
        $condition = 't.goods_start_date = "'.$date.'" AND t.goods_id='.$goods_id.' AND t.order_id in (select order_id from `'.Order::model()->tableName().'` WHERE order_status<1 OR order_status>2)';
        $list = OrderDetail::model()->findAll(array('select'=>'total_people','condition'=>$condition));
        $count = 0;
        foreach($list as $detail){
            $count += $detail->total_people;
        }
        return $count;
    }

}
