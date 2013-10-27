<?php
/**
 * 短租(房子).主表
 * @author zyme  leo
 *
 * @note 本表内只有"房屋house"和"房间room"两种，1个房屋有1-N个房间，也可以0房间(即自身)
 *
 * This is the model class for table "property".
 *
 * The followings are the available columns in table 'property':
 * @property int(10) unsigned $property_id
 * @property int(10) unsigned $parent_property_id // 房屋pid小于11/房间pid大于10 // 详见:{@link isHouse()} {@link isRoom()}
 * @property int(10) unsigned $landlord_id
 * @property tinyint(1) unsigned $is_active  // 开放有效1/关闭无效0
 * @property tinyint(1) unsigned $is_dispersive  // 零租房1/整租房0 // 房间的此值必等于房屋
 * @property smallint(4) unsigned $property_type_id // 房屋类型/房间类别
 * @property smallint(4) unsigned $person // 详见:{@link getPersons()}(暂时没用)
 * @property smallint(4) unsigned $room
 * @property smallint(4) unsigned $bed
 * @property tinyint(1) unsigned $bed_type // 床类型0没有床/1国王/2皇后/3双人/4单人/5儿童/6婴儿 // 详见:{@link getBedType()}
 * @property smallint(4) unsigned $bathroom // 详见:{@link getBathrooms()}
 * @property tinyint(1) unsigned $is_share_bathroom // 浴室共用1/独立0
 * @property decimal(8,2) unsigned $area_sqm // 面积平方米
 * @property decimal(8,2) unsigned $area_sqf // 面积平方英尺
 * @property int(10) unsigned $country_id
 * @property int(10) unsigned $state_id
 * @property int(10) unsigned $city_id
 * @property varchar(30) $phone
 * @property varchar(10) $zipcode
 * @property varchar(20) $longitude
 * @property varchar(20) $latitude
 * @property smallint(4) $min_night
 * @property smallint(4) $max_night
 * @property varchar(5) $in_time  // 详见:{@link getInTimes()}
 * @property varchar(5) $out_time  // 详见:{@link getOutTimes()}
 * @property tinyint(1) unsigned $is_have_pet // 宠物有1/无0
 * @property smallint(4) unsigned $property_policy_id
 *
 * The followings are the available model relations:
 * @property PropertyType $propertyType
 * @property PropertyPolicy $propertyPolicy
 * @property Landlord $landlord
 * @property Country $country
 * @property State $state
 * @property City $city
 * @property PropertyAddendum[] $propertyAddendums
 * @property PropertyExtension[] $propertyExtensions
 * @property PropertyPicture[] $propertyPictures
 *
 * 扩展属性
 * @property array $bedType 可选择的"床的类型"列表，详见:{@link getBedType()}
 * @property array $persons 可选择的"房子居住人数"列表，详见:{@link getPersons()}(暂时没用)
 * @property array $bathrooms 可选择的"房子浴室间数"列表，详见:{@link getBathrooms()}
 * @property array $inTimes 可选择的"房子入住时间"列表，详见:{@link getInTimes()}
 * @property array $outTimes 可选择的"房子退房时间"列表，详见:{@link getOutTimes()}
 * @property array $countries 可选择的"房子所属国家地区"列表，详见:{@link getCountries()}
 * @property array $states 可选择的"房子所属国家地区的省或洲"列表，详见:{@link getStates()}
 * @property array $cities 可选择的"房子所属国家地区的省或洲的城市"列表，详见:{@link getCities()}
 * @property array $roomIds 房屋(房间的所属)的房间id数组/无房间为null值，详见:{@link getRoomIds()}
 */
class Property extends BaseActiveRecord
{
    /** 最大卧室数量 */
    private static $maxBedRoomNum = 5;
    /** 最多入住人数 */
    private static $maxGuestsNum = 10;
    /** 最多浴室数量 */
    private static $maxBathNum = 3;
    /** 分别表示 1 基本信息发布ok   2完善信息 3价格设置 4注意事项 5其他信息(非必需)  6联系方式 7最终显示 */
    public static $_STEP = array(1 => 1,2 => 2,3 => 3,4 => 4,5 => 5,6 => 6,7 => 7);

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        return array(
            array('parent_property_id,goods_id, is_dispersive, property_type_id, person, room, bathroom',
                    'required'),
            array('country_id, state_id, city_id, longitude, latitude, min_night, max_night, in_time, out_time, is_have_pet, property_policy_id',
                    'required'),
            array(
                'amenity',
                'amenityStrength',
                ),
            array('step', 'safe'),
            array(
                'parent_property_id',
                'exist',
                'className' => 'Property'),
            array(
                'goods_id',
                'exist',
                'className' => 'Goods'),

            array(
                'is_dispersive',
                'boolean',
                'allowEmpty' => false),
            array(
                'property_type_id',
                'exist',
                'className' => 'PropertyType'),
            array(
                'person, room, bed',
                'match',
                'pattern' => '/^[1-9]\d{0,2}$/'),
            array(
                'bed_type',
                'in',
                'range' => array_keys($this->getBedType())),
            array(
                'bed',
                'in',
                'range' => array_keys($this->getBeds())),
            array(
                'bathroom',
                'in',
                'range' => array_keys($this->getBathrooms())),
            array(
                'is_share_bathroom',
                'default',
                'value' => 0),
            array(
                'area_sqm, area_sqf',
                'numerical',
                'min' => 0,
                'max' => 999999.99,
                'numberPattern' => '/^([1-9]\d{1,5}|\d)(\.\d{1,2})?$/'),
            array(
                'country_id',
                'exist',
                'className' => 'Country'),
            array(
                'state_id',
                'exist',
                'className' => 'State'),
            array(
                'city_id',
                'exist',
                'className' => 'City'),

            array(
                'phone',
                'match',
                'pattern' => '/^[1-9]\d{10}$/'),
            array(
                'telephone',
                'match',
                'pattern' => '/^\d*\[#\]\d*$/'),
            array(
                'zipcode',
                'length',
                'max' => 8),
            array(
                'zipcode',
                'match',
                'pattern' => '/^\d{4,8}$/'),
            array(
                'longitude',
                'numerical',
                'min' => -180,
                'max' => 180,
                'numberPattern' => '/^[\+\-]?\d{1,3}\.?\d{0,6}$/'),
            array(
                'latitude',
                'numerical',
                'min' => -90,
                'max' => 90,
                'numberPattern' => '/^[\+\-]?\d{1,2}\.?\d{0,6}$/'),
            array(
                'min_night, max_night',
                'in',
                'range' => range(0, 999),
                ),

            array(
                'in_time, out_time',
                'match',
                'pattern' => '/^\d\d:\d\d$/'),
            array(
                'is_have_pet',
                'boolean',
                'allowEmpty' => false),
            array(
                'property_policy_id',
                'exist',
                'className' => 'PropertyPolicy'),

            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array(
                'property_id, parent_property_id, is_dispersive, property_type_id, person, room, bed, bed_type, bathroom, is_share_bathroom, area_sqm, area_sqf',
                'safe',
                'on' => 'search'),
            array(
                'country_id, state_id, city_id, phone, zipcode, longitude, latitude, min_night, max_night, in_time, out_time, is_have_pet, property_policy_id',
                'safe',
                'on' => 'search'),
            );
    }


    /**
     * @return array the query criteria.
     */
    public function defaultScopesss()
    {
        return array('condition' => sprintf('%s.property_id>0', $this->getTableAlias(true, false)));
    }

    /**
     * @return array the query criteria.
     */
    public function scopes()
    {
        return array(
            'house' => array('condition' => sprintf('%s.parent_property_id<=10', $this->
                    getTableAlias(true))),
            'room' => array('condition' => sprintf('%s.parent_property_id>10', $this->
                    getTableAlias(true))),
            );
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        return array(
            'propertyType' => array(
                self::BELONGS_TO,
                'PropertyType',
                'property_type_id'),
            'goods' => array(
                self::BELONGS_TO,
                'Goods',
                'goods_id'),
            'propertyPolicy' => array(
                self::BELONGS_TO,
                'PropertyPolicy',
                'property_policy_id'),

            'propertyHouse' => array(
                self::BELONGS_TO,
                'Property',
                'parent_property_id'),
            'propertyRooms' => array(
                self::HAS_MANY,
                'Property',
                'parent_property_id'),
            'propertyRoomCount' => array(
                self::STAT,
                'Property',
                'parent_property_id'),
            'country' => array(
                self::BELONGS_TO,
                'Country',
                'country_id'),
            'state' => array(
                self::BELONGS_TO,
                'State',
                'state_id'),
            'city' => array(
                self::BELONGS_TO,
                'City',
                'city_id'),
            'addendum' => array(
                self::HAS_ONE,
                'PropertyAddendum',
                'property_id'),
            'propertyAddendum' => array(
                self::HAS_ONE,
                'PropertyAddendum',
                'property_id'),
            'propertyAddendums' => array(
                self::HAS_MANY,
                'PropertyAddendum',
                'property_id'),
            'propertyAddendumLocal' => array(
                self::HAS_ONE,
                'PropertyAddendum',
                'property_id',
                'scopes' => 'local'),
            'propertyAddendumCount' => array(
                self::STAT,
                'PropertyAddendum',
                'property_id'),
            'propertyExtensions' => array(
                self::HAS_MANY,
                'PropertyExtension',
                'property_id'),
            'propertyExtensionCount' => array(
                self::STAT,
                'PropertyExtension',
                'property_id'),
            'goodsImages' => array(
                self::HAS_MANY,
                'PropertyPicture',
                'property_id'),
            'goodsImagesCount' => array(
                self::STAT,
                'PropertyPicture',
                'property_id'),
            'propertyPictures' => array(
                self::HAS_MANY,
                'PropertyPicture',
                'property_id'),
            'propertyPictureFaces' => array(
                self::HAS_MANY,
                'PropertyPicture',
                'property_id',
                'scopes' => 'faces'),
            'propertyPictureRooms' => array(
                self::HAS_MANY,
                'PropertyPicture',
                'property_id',
                'scopes' => 'rooms'),
            'propertyPictureCount' => array(
                self::STAT,
                'PropertyPicture',
                'property_id'),
            'propertyPrice' => array(
                self::HAS_ONE,
                'PropertyPrice',
                'property_id',
                'scopes' => 'lastPrice'),
            'propertyPriceOverrides' => array(
                self::HAS_MANY,
                'PropertyPriceOverride',
                'property_id'),
            'propertyPriceOverride' => array(
                self::HAS_ONE,
                'PropertyPriceOverride',
                'property_id'),
            'goodsImage' => array(
                /*rick add(单张封面图片) 2013/8/7*/
                self::HAS_ONE,
                'PropertyPicture',
                'property_id'),
            'propertyRevies' => array( //rick add
                self::HAS_MANY,
                'PropertyReview',
                'property_id'),
            'propertyRevieOne' => array(//rick add
                self::HAS_ONE,
                'PropertyReview',
                'property_id'),

            );

    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        $a = array(
            'property_id' => 'ID',
            'parent_property_id' => '房屋',
            'goods_id' => 'goods_id',
            'is_dispersive' => '零租',
            'property_type_id' => '住所类型',
            'person' => '最多入住人数',
            'room' => '卧室总计',
            'bed' => '床位总计',
            'bed_type' => '床位类型',
            'bathroom' => '具备浴室',
            'is_share_bathroom' => '浴室情况',
            'area_sqm' => '住所面积(平方米)',
            'area_sqf' => '住所面积(平方英尺)',
            'country_id' => '国家',
            'state_id' => '省份',
            'city_id' => '城市',
            'phone' => '房东电话',
            'telephone' => '座机号码',
            'zipcode' => '邮政编码',
            'longitude' => '经度',
            'latitude' => '纬度',
            'min_night' => '最少入住天数',
            'max_night' => '最多入住天数',
            'in_time' => '入住时间',
            'out_time' => '退房时间',
            'is_have_pet' => '是否有宠物',
            'property_policy_id' => '政策',
            'amenity' => '公共设施',
            );
        foreach ($a as $k => $v)
            $a[$k] = Yii::t($this->tableName(), $v);
        return $a;
    }
    /**
     * 价格计算接口
     */
    public function priceCalculation($propery_id, $start_time, $end_time)
    {
        //判断有多少天
        $respon = array(
            'status' => 0,
            'message' => '',
            'data' => 0.00);
        $timespan = $end_time - $start_time;
        $now = time();
        if ($start_time < $now) {
            $respon['message'] = '开始日期已过期';
            return $respon;
        }
        if ($timespan <= 0) {
            $respon['message'] = '开始结束日期非法';
            return $respon;
        }
        $return_price = $this->getPrice($propery_id);
        $day = ceil($timespan / (60 * 60 * 24));

        // 计算特殊价格
        if ($return_price['specprice']['start'] && $return_price['specprice']['end'] &&
            $return_price['specprice']['price'] != 0.00) {
            //在区间内 [3,5]==>t[1,6] =>[3,5]
            if ($return_price['specprice']['start'] <= $start_time && $end_time <= $return_price['specprice']['end']) {
                $total_price = sprintf('%.2f', $day * $return_price['specprice']['price']);
                $respon['data'] = $total_price;
                $respon['status'] = 1;
                return $total_price;
            }
            // 右边在区间外 [3,8]=>t[4,9]=>[3,4]+[4,8]
            elseif ($return_price['specprice']['start'] >= $start_time && $end_time > $return_price['specprice']['end']) {

            }

            // 在区间外[3,8]=>t[4,6]=>[3,4]+[4,6]+[6,8]
            elseif ($return_price['specprice']['start'] >= $start_time && $end_time > $return_price['specprice']['end']) {

            }
            // 右边在区间内[3,8]=>t[2,6]=>[3,6]+[6,8]
            elseif ($return_price['specprice']['start'] >= $start_time && $end_time > $return_price['specprice']['end']) {

            }
        }
        // 月价格
        if ($return_price['monthprice'] && $return_price['monthprice'] != 0.00) {

        }
        // 周价格
        if ($return_price['weekprice'] && $return_price['weekprice'] != 0.00) {

        }
        // 日常价格
        if ($return_price['dayprice'] && $return_price['dayprice'] != 0.00) {

        }


        //计算日常价格 周价格 月价格 和特殊价格 如果有的话


        return 0.00;
    }
    /**
     * 特殊价格
     */
    private function caculSpecPrice($return_price, $start_time, $end_time)
    {
        //在区间内 [3,5]==>t[1,6] =>[3,5]
        $day = ceil($timespan / (60 * 60 * 24));
        if ($return_price['specprice']['start'] <= $start_time && $end_time <= $return_price['specprice']['end']) {
            $total_price = sprintf('%.2f', $day * $return_price['specprice']['price']);
            return $total_price;
        }
        // 右边在区间外 [3,8]=>t[4,9]=>[3,4]+[4,8]
        elseif ($return_price['specprice']['start'] > $start_time && $end_time <= $return_price['specprice']['end']) {

        }
        // 在区间外[3,8]=>t[4,6]=>[3,4]+[4,6]+[6,8]
        elseif ($return_price['specprice']['start'] > $start_time && $end_time > $return_price['specprice']['end']) {

        }
        // 右边在区间内[3,8]=>t[2,6]=>[3,6]+[6,8]
        elseif ($return_price['specprice']['start'] < $start_time && $end_time > $return_price['specprice']['end']) {

        }

    }

    /**
     * 月价格
     */
    private function caculMonthPrice($return_price)
    {
        if ($return_price['monthprice'] && $return_price['monthprice'] != 0.00) {

        }
    }
    /**
     * 周价格
     */
    private function caculWeekPrice($return_price)
    {
        if ($return_price['weekprice'] && $return_price['weekprice'] != 0.00) {

        }
    }
    /**
     * 日常价格
     */
    private function caculDayPrice($return_price)
    {
        if ($return_price['dayprice'] && $return_price['dayprice'] != 0.00) {

        }

    }

    /**
     * 价格计算 核心
     *
     */
    private function getPrice($property_id)
    {
        $respon = array(
            'dayprice' => 0.00,
            'weekprice' => 0.00,
            'monthprice' => 0.00,
            'specprice' => array(
                'start' => '',
                'end' => '',
                'price' => 0.00));
        $property = Property::model()->findByPk((int)$property_id);
        $propertyPrice = $property->propertyPrice;
        $propertyPriceOver = $property->propertyPriceOverride;
        if ($property && $propertyPrice) {
            $respon['dayprice'] = sprintf("%.2f", $propertyPrice->day_price);
            $respon['weekprice'] = sprintf("%.2f", $propertyPrice->week_price);
            $respon['weekprice'] = sprintf("%.2f", $propertyPrice->month_price);
            if ($propertyPriceOver) {
                $respon['specprice']['start'] = strtotime($propertyPriceOver->start_date);
                $respon['specprice']['end'] = strtotime($propertyPriceOver->end_date);
                $respon['specprice']['price'] = sprintf("%.2f", $propertyPrice->day_price);
            }
        }

        return $respon;
    }
    /**
     * 未经过处理的价格数据
     *
     */
    public function showPrice($property_id, $time)
    {
        $property = Property::model()->findByPk((int)$property_id);
        $data = array();
        if ($property == null) {
            return $data;
        }
        $propertyPrice = $property->propertyPrice;
        $propertyPriceOver = $property->propertyPriceOverride;
        if ($propertyPrice == null) {
            return $data;
        }

        $weekPrice  = $propertyPrice->week_price;
        $monthPrice = $propertyPrice->month_price;
        
        $legal_start_date = $propertyPrice->start_date;
        $legal_end_date   = $propertyPrice->end_date;


        //当前
        $year = date('Y', $time);
        $month = date("m", $time);
        $days = date('t', $time);
        $date = date('j', $time);
        $start = date("Y-m-d", $time);


        for ($i = 0; $i <= $days - $date; $i++) {
            $temp = array();
            $temp['day'] = date("Y-m-d", strtotime("+$i days", $time));
            $temp['date'] = date('j', strtotime("+$i days", $time));
            $temp['week'] = date('N', strtotime("+$i days", $time));
            $temp['price'] = $propertyPrice->day_price;
            $temp['prices'] = array();
            if ($weekPrice != '0.00' && $weekPrice != '0') {
                $temp['prices'] = array('weekPrice' => $weekPrice);
            }
            if ($monthPrice != '0.00' && $monthPrice != '0') {
                $temp['prices'] = array('monthPrice' => $monthPrice);
            }
            //$temp['monthPrice'] = $monthPrice;
            //$temp['weekPrice'] = $weekPrice;
            $temp['is_spec'] = 0;
            $data[$temp['day']] = $temp;
        }

        if ($propertyPriceOver) {

            $start_date = $propertyPriceOver->start_date;
            $end_date = $propertyPriceOver->end_date;


            $diff_days = (strtotime($end_date) - strtotime($start_date)) / (3600 * 24);
            //echo $diff_days;
            $start_time = strtotime($start_date);
            for ($i = 0; $i <=($diff_days); $i++) {
                $temp = array();
                $temp['day'] = date("Y-m-d", strtotime("+$i days", $start_time));
                $temp['date'] = date('j', strtotime("+$i days", $start_time));
                $temp['week'] = date('N', strtotime("+$i days", $start_time));
                $temp['price'] = $propertyPriceOver->day_price;
                $temp['prices'] = array();
                if ($weekPrice != '0.00' && $weekPrice != '0') {
                    $temp['prices'] = array('weekPrice' => $weekPrice);
                }
                if ($monthPrice != '0.00' && $monthPrice != '0') {
                    $temp['prices'] = array('monthPrice' => $monthPrice);
                }
                //$temp['monthPrice'] = $monthPrice;
                //$temp['weekPrice'] = $weekPrice;
                $temp['is_spec'] = 1;
                $data[$temp['day']] = $temp;

            }

        }
        
       
        // add by leo 09/12
        foreach($data as $key =>&$_v)
        {
            // 有效日期外
            if(strtotime($legal_start_date)<=strtotime($_v['day']) && strtotime($legal_end_date)>=strtotime($_v['day']))
            {
                
            }
            else
            {
                unset($data[$key]);
            }
        }
        return $data;
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

        $criteria->compare('property_id', $this->property_id, true);
        $criteria->compare('step', $this->step, true);
        $criteria->compare('parent_property_id', $this->parent_property_id, true);
        $criteria->compare('property_type_id', $this->property_type_id);
        $criteria->compare('person', $this->person);
        $criteria->compare('room', $this->room);
        $criteria->compare('bed', $this->bed);
        $criteria->compare('bathroom', $this->bathroom);
        $criteria->compare('is_share_bathroom', $this->is_share_bathroom);
        $criteria->compare('area_sqm', $this->area_sqm);
        $criteria->compare('area_sqf', $this->area_sqf);
        $criteria->compare('country_id', $this->country_id, true);
        $criteria->compare('state_id', $this->state_id, true);
        $criteria->compare('city_id', $this->city_id, true);
        $criteria->compare('phone', $this->phone, true);
        $criteria->compare('zipcode', $this->zipcode, true);
        $criteria->compare('longitude', $this->longitude, true);
        $criteria->compare('latitude', $this->latitude, true);
        $criteria->compare('min_night', $this->min_night);
        $criteria->compare('max_night', $this->max_night);
        $criteria->compare('in_time', $this->in_time, true);
        $criteria->compare('out_time', $this->out_time, true);
        $criteria->compare('is_have_pet', $this->is_have_pet, true);
        $criteria->compare('property_policy_id', $this->property_policy_id);
        $criteria->compare('amenity', $this->amenity);

        return new CActiveDataProvider($this, array('criteria' => $criteria, ));
    }

    /**   add by leo */

    public function amenityStrength($attribute)
    {

        //$this->addError($attribute,'请选择公共设施2222');
        $amenity_arr = $this->$attribute;

        if (empty($amenity_arr)) {
            $this->addError('amenity', '请选择便利设施');
        } elseif (count($amenity_arr) == 1 && $amenity_arr[0] == 0) {
            $this->addError('amenity', '请选择便利设施');
        } else {
            $amenity_str = implode(',', $amenity_arr);
            $amenity_str = trim($amenity_str, ',');
            $arr = Property::ckAmenityValide($amenity_str);
            if (empty($arr)) {
                $this->addError('amenity', '选择了无效的便利设施');
            } else {
                $this->$attribute = json_encode($arr);
            }

        }


    }

    /**
     * 可选择的"床位数量"列表，值为:{@link beds}
     */
    public static function getBeds()
    {
        $arr = array();
        $arr[1] = Yii::t('property', '1张床');
        $arr[2] = Yii::t('property', '2张床');
        $arr[3] = Yii::t('property', '3张床');
        return $arr;
    }

    /**
     * 可选择的"床的类型"列表，值为:{@link bedType}
     * @desc 床类型:0没有床/1国王/2皇后/3双人/4单人/5儿童/6婴儿 // TODO:
     */
    public static function getBedType($id = 0)
    {
        $arr = array(); // TODO:
        $arr[0] = Yii::t('property', '没有床');
        $arr[1] = Yii::t('property', '国王床');
        $arr[2] = Yii::t('property', '皇后床');
        $arr[3] = Yii::t('property', '双人床');
        $arr[4] = Yii::t('property', '单人床');
        $arr[5] = Yii::t('property', '儿童床');
        $arr[6] = Yii::t('property', '婴儿床');
        $arr = array();
        $arr[1] = Yii::t('property', '国王床(2mx2m)');
        $arr[2] = Yii::t('property', '皇后床(1.8mx2m)');
        $arr[3] = Yii::t('property', '双人床(1.5mx2m)');
        $arr[4] = Yii::t('property', '单人床(0.8mx2m)');
        return $id ? $arr[$id] : $arr;
    }

    /**
     *折扣打折信息
     */
    public static function getDiscount()
    {
        $arr = array();
        for ($i = 5; $i < 10; $i += 0.5) {
            $arr["$i"] = Yii::t('property', $i . '折');
        }
        $arr["10"] = Yii::t('property', '不打折');
        return $arr;
    }
    
     /**
     *涨价信息
     */
    public static function getRisecount()
    {
        $arr = array();
        for ($i = 5; $i <= 50; $i += 5) {
            $arr[$i] = Yii::t('property', $i . '%');
        }
        $arr[0] = Yii::t('property', '不涨价');
        return $arr;
    }
    
    public static function getDRType()
    {
        return array(1=>'我要涨价',0=>'我要打折');
    }

    /**
     * 可选择的"房子居住人数"列表，值为:{@link persons}
     * @desc 人数值为:1-20,999表示有超过20人.
     * // TODO: (暂时没用)
     */
    public static function ____getPersons()
    {
        $arr = array_combine(range(1, 20), range(1, 20));
        $arr[999] = CHtml::encode(Yii::t('property', '超过20人'));
        return $arr;
    }

    /**
     * 可选择的"房子浴室间数"列表，值为:{@link bathrooms}
     * @desc 数值为:0-20.
     */
    public static function getBathrooms($id = 0, $is_filter = false)
    {
        $arr = array();
        for ($i = 0; $i <= self::$maxBathNum; $i++) {
            if ($is_filter && $i === 0) {
                $arr[99] = Yii::t('property', $i . '间');
            } else {
                $arr[$i] = Yii::t('property', $i . '间');
            }

        }
        return $id ? $arr[$id] : $arr;
    }

    /**
     * 可选择的"房子入住时间"列表，值为:{@link persons}
     * @desc 时间值为:每个整点时刻如13:00,99:99表示任意时刻.
     */
    public static function getInTimes()
    {
        $arr = array();
        for ($i = 0; $i < 24; $i++)
            $t = sprintf('%02u:00', $i) and $arr[$t] = $t;
        $arr['99:99'] = CHtml::encode(Yii::t('property', '任意时刻'));
        return $arr;
    }

    /**
     * 可选择的"房子退房时间"列表，值为:{@link persons}
     * @desc 时间值为:每个整点时刻如13:00,99:99表示任意时刻.
     */
    public static function getOutTimes()
    {
        return self::getInTimes();
    }

    /**
     * 可选择的"房子所属国家地区"列表，值为:{@link countries}
     */
    public static function getIsHavePet($bool = null)
    {
        $a = array(1 => Yii::t('property', '有宠物或动物'), 0 => Yii::t('property', '没有宠物或动物'));
        return ($bool === null ? $a : $a[(int)((bool)$bool)]);
    }

    /**
     * 可选择的"房子所属国家地区"列表，值为:{@link countries}
     */
    public static function getCountries()
    {
        //return array(11 => '中国', 12 => '美国');
        $obj = CountryAddendum::model()->local()->findAll();
        $arr = array();
        foreach ($obj as $v) {
            $arr[$v->country_id] = $v->name;
        }
        return $arr;
    }

    /**
     * 可选择的"房子所属国家地区的省或洲"列表，值为:{@link states}
     */
    public static function getStates($country_id)
    {
        //$arr[11] = array(11 => '中国的A省', 12 => '中国的B省');
        //$arr[12] = array(13 => '美国de洲1', 14 => '美国de洲2');
        //return $arr[$country_id];
        $arr = array();
        $objects = State::model()->findAllByAttributes(array('country_id' => $country_id));
        foreach ($objects as $v) {
            $arr[$v->state_id] = $v->stateAddendumLocal->name;
        }
        return $arr;
    }

    /**
     * 可选择的"房子所属国家地区的省或洲的城市"列表，值为:{@link cities}
     */
    public static function getCities($state_id)
    {
        //$arr[11] = array(11 => '中国A省de的m县', 12 => '中国A省de的n县');
        //$arr[12] = array(13 => '中国B省de的m县', 14 => '中国B省de的n县');
        //$arr[13] = array(15 => '美国de洲1的m城', 16 => '美国de洲1的n城');
        //$arr[14] = array(17 => '美国de洲2的m城', 18 => '美国de洲2的n城');
        //return $arr[$state_id];
        $arr = array();
        $obj = City::model()->findAllByAttributes(array('state_id' => $state_id));
        foreach ($obj as $v) {
            $arr[$v->city_id] = $v->cityAddendum->name;
        }
        return $arr;
    }

    /**
     * 是"房屋house"还是"房间room"，即房屋是否为"父级"
     * @note 房屋pid小于11/房间pid大于10，只有"房屋house"和"房间room"两种，1个房屋有1-N个房间，也可以0房间(即自身)
     */
    public function isHouse()
    {
        return !$this->isRoom();
    }
    public function isRoom()
    {
        return $this->parent_property_id > 10;
    }

    /**
     * 当"房屋"的'房间数>0'时，需要有足够的"房间"数据信息，自动复制"房屋"为"房间"，多数信息与"房屋"信息相同，主表+副表
     */
    public function autoMakeRoom()
    {
        if ($this->isHouse() and $this->room > 0 and $this->room > $this->
            propertyRoomCount) {
            for ($i = $this->propertyRoomCount; $i < $this->room; $i++) {
                //// 主表
                $_p = new Property;
                // 复制

                $_p->property_type_id = $this->property_type_id;
                $_p->country_id = $this->country_id;
                $_p->state_id = $this->state_id;
                $_p->city_id = $this->city_id;
                $_p->phone = $this->phone;
                $_p->zipcode = $this->zipcode;
                $_p->longitude = $this->longitude;
                $_p->latitude = $this->latitude;
                $_p->property_policy_id = $this->property_policy_id;
                // 特殊
                $_p->parent_property_id = $this->property_id;

                // 保存
                $_p->save(false);

            }
        }
    }

    /**
     * "房屋"的"房间"ID集合等，如果自己是"房间"，则是所属房屋的房间ID集合，如果没有"房间"返回null值，值为:{@link $roomIds}
     * @return array array(id,id,id) / null
     */
    public function getRoomIds()
    {
        $property = $this;
        if ($this->isRoom())
            $property = $this->propertyHouse;
        $arr = array();
        foreach ($property->propertyRooms as $row)
            $arr[] = $row->property_id;
        return $arr ? : null;
    }


    /**
     * Leo add
     **/

    /** 浴室类型 */

    public static function getBathType()
    {
        return array(0 => Yii::t('property', '独立浴室'), 1 => Yii::t('property', '公共浴'));
    }


    /**
     * 获取住所类型
     *@param int type_id
     *@return array('id'=>'value'))
     *@return value
     */
    public static function getTypeList($type_id = 0)
    {
        $arr = array();
        $obj = PropertyTypeAddendum::model()->local()->findAll();
        foreach ($obj as $v) {
            $arr[$v->property_type_id] = $v->type;
        }
        //print_r($arr);
        return $type_id ? $arr[$type_id] : $arr;
    }
    /**
     * 获取卧室总计
     *@param int _id
     *@return array('_id'=>'value'))
     *@return value
     */
    public static function getBedroom($_id = 0)
    {
        $arr = array();

        for ($i = 1; $i <= self::$maxBedRoomNum; $i++) {
            $arr[$i] = Yii::t('property', $i . '间卧室');
        }
        return $_id ? $arr[$_id] : $arr;

    }
    /**
     * 获取入住人数
     *@param int _id
     *@return array('_id'=>'value'))
     *@return value
     */
    public static function getGuestsIn($_id = 0)
    {
        $arr = array();

        for ($i = 1; $i <= self::$maxGuestsNum; $i++) {
            $arr[$i] = Yii::t('property', $i . '人');
        }
        return $_id ? $arr[$_id] : $arr;

    }

    /** 设施列表**/
    public static function getAmenity()
    {
        $arr = array();
        $obj = PropertyAmenityAddendum::model()->local()->findAll();
        foreach ($obj as $v) {
            $arr[$v->property_amenity_id] = $v->name;
        }
        return $arr;
    }
    /**
     * 检查设施列表
     */
    public static function ckAmenityValide($str)
    {
        $arr = array();
        $obj = PropertyAmenityAddendum::model()->local()->findAll(array('condition' =>
                "property_amenity_id in ($str)"));
        foreach ($obj as $v) {
            $arr[] = $v->property_amenity_id;
        }
        return $arr;

    }

    /////////////////////////////////////////////////////////////////////////////////////////////////////

    /**
     * @author darren
     */
    public function getValuation($property_id)
    {
        $property_id = intval($property_id);
        $valuation_info = array();
        $valuation_per_sql = "select AVG(rating_total) as rating_total from " .
            PropertyReview::model()->tableName() .
            " where parent_review_id=0 AND property_id = '" . $property_id .
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
    public function getPercentage($property_id)
    {
        $property_id = intval($property_id);
        $valuation_info = array();
        $valuation_per_sql = "select AVG(rating_total) as rating_total from " .
            PropertyReview::model()->tableName() .
            " where parent_review_id=0 AND property_id = '" . $property_id .
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
            'rating_4',
            'rating_5',
            'rating_6');
        $reviews_info = array();
        // satisfaction ... IMG & MSG
        $all_avg = PropertyReview::model()->getReviewsPer($this->property_id);
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
            $arr['property_review_id'] = $row['property_review_id'];
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
                    'property_review_id' => $rep['property_review_id'],
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
        $property_id = $this->property_id;
        // c
        $criteria = new CDbCriteria();
        $criteria->order = 'property_review_id DESC ';
        $criteria->addCondition('parent_review_id=0');
        $criteria->addCondition('is_active=1');
        $criteria->addCondition('property_id=:property_id');
        $criteria->params = array(':property_id' => $property_id);
        // d
        $dataProvider = new CActiveDataProvider('PropertyReview', array(
            'criteria' => $criteria,
            'pagination' => array('pageSize' => 15, 'pageVar' => 'npage'),
            ));
        return $dataProvider;
    }

    /**
     * @author rick
     * @return return all property_id(me)
     */
    public function getPropertyId($user_id)
    {


        $arr = Yii::app()->db->createCommand()->select('p.property_id')->from('goods g')->
            where('customer_id=:id', array(':id' => $user_id))->join('property p',
            'p.goods_id=g.goods_id')->order('property_id desc')->queryAll();

        return $arr;

    }

    /**
     * @author rick
     * @return return all property_review
     */

    public function getPropertyReview($user_id)
    {
        $data = array();
        $p_arr = $this->getPropertyId($user_id);

        for ($i = 0; $i < count($p_arr); $i++) {

            $arr = Yii::app()->db->createCommand()->select('*')->from('property_review')->
                where('property_id=:id and is_active=1 and parent_review_id=0', array(':id' => $p_arr[$i]['property_id']))->
                order('property_review_id desc')->queryAll();


            if (!empty($arr)) {

                $data = array_merge_recursive($data, $arr);
            }

        }

        return $data;
    }
    /**
     *  获取住所对应评论的回复
     */
    public function getProperty_reviewHF($user_id)
    {
       $data=array();

       $arr=$this->getPropertyReview($user_id);

       $count=count($arr);

       for($i=0;$i<$count;$i++){

            $temparr = Yii::app()->db->createCommand()->select('*')->from('property_review')->
            where('parent_review_id = :pid and customer_id= :id', array(':pid' => $arr[$i]['property_review_id'] , ':id'=>$user_id))->
            order('property_review_id desc')->queryAll();

           if(!empty($temparr)){

            $data=array_merge_recursive($data,$temparr);

           }

       }

        return $data;

    }

    /**
     * FDL  add by Fedora
     */
    public function countTotalPrice($from, $to, $property_id = 0)
    {
        $property_id = $property_id ? $property_id : $this->property_id;
        $normal = PropertyPrice::model()->find('property_id=' . $property_id);
        $model = $this->findByPk($property_id);
        $goods_id = $model->goods_id;
        $dates403 = $this->getOccupied($goods_id);
        $special = $this->countSpecialPrice($from, $to, $property_id,$dates403);
        $total_days = G4S::countDays($from, $to)+1;
        if($dates403){
            $tmp = $total_days;
            for($i=0;$i<$tmp;$i++){
                if(in_array(date('Y-m-d',strtotime("+$i day",strtotime($from))),$dates403)) $total_days--;
            }
        }
        $left_days = $total_days - $special['days'];
        if ($left_days < 7)
            $price = $normal->day_price * $left_days;
        elseif ($left_days < 30)
            $price = $normal->week_price * $left_days;
        else
            $price = $normal->month_price * $left_days;
        $total_price = $special['price'] * $special['days'] + $price;
        return $total_price;
    }
    /**
     * FDL  add by Fedora
     */
    public function countSpecialPrice($from, $to, $property_id = 0,$dates = array())
    {
        $property_id = $property_id ? $property_id : $this->property_id;
        $over = PropertyPriceOverride::model()->find('property_id=' . $property_id);
        if ($from > $over->end_date || $to < $over->start_date)
            return array('price' => $over->day_price, 'days' => 0);
        if ($to < $over->end_date)
            $e = $to;
        else
            $e = $over->end_date;
        if ($from > $over->start_date)
            $s = $from;
        else
            $s = $over->start_date;
        $count_days = G4S::countDays($s, $e)+1;
        if($dates){
            $tmp = $count_days;
            for($i=0;$i<$tmp;$i++){
                if(in_array(date('Y-m-d',strtotime("+$i day",strtotime($s))),$dates)) $count_days--;
            }
        }
        return array('price' => $over->day_price, 'days' => $count_days);
    }

    /**
     * @author rick add 2013-8-14
     * @return 返回买家自己发出的针对住所所有评论包括评论的回复
     */
    public function getSendPropertyComment($user_id)
    {


        $arr = Yii::app()->db->createCommand()->select('*')->from('property_review')->
            where('customer_id = :id', array(':id' => $user_id))->order('property_review_id desc')->
            queryAll();


        return $arr;


    }

    /**
     * @author rick add 2013-8-14
     * @return 返回卖家对买家的住所评论的回复
     */
    public function getRecivePropertyComment($user_id)
    {
        $data=array();

        $arr = Yii::app()->db->createCommand()->select('*')->from('property_review')->
            where('customer_id = :id and parent_review_id=:rid', array(':id' => $user_id,
                'rid' => 0))->order('property_review_id desc')->queryAll();

        $count = count($arr);

        for ($i = 0; $i < $count; $i++) {

            $id=$arr[$i]['property_review_id'];

            $temparr = Yii::app()->db->createCommand()->select('*')->from('property_review')->
                where('parent_review_id=:id', array(':id' => $id))->order('property_review_id desc')->
                queryAll();

            if (!empty($temparr)) {

               $data= array_merge_recursive($data,$temparr);

               unset($temparr);

            }
        }

        return $data;


    }

       /**
     * @author rick add 2013-8-19
     * @return 返回住所的PRICE 参数 property_id
     */
    public function getPropertyPrice($property_id){

         $arr = Yii::app()->db->createCommand()->select('goods_id')->from('property')->
            where('property_id = :id', array(':id' => $property_id))->queryAll();

         $arr = Yii::app()->db->createCommand()->select('price')->from('goods')->
            where('goods_id = :id', array(':id' => $arr[0]['goods_id']))->queryAll();

            return $arr[0]['price'];

    }

       /**
     * @author rick add 2013-8-19
     * @return 返回住所的goods_id 参数 property_id
     */
    public function getPropertyGoods_id($property_id)
    {

        $arr = Yii::app()->db->createCommand()->select('goods_id')->from('property')->
            where('property_id = :id', array(':id' => $property_id))->queryAll();



        return $arr[0]['goods_id'];

    }
    
    //Fedora
    public function getOccupied($goods_id)
    {
        $condition = 't.goods_id='.$goods_id.' AND t.order_id in (select order_id from `'.Order::model()->tableName().'` WHERE order_status<1 OR order_status>2)';
        $list = OrderDetail::model()->findAll(array('select'=>'goods_dates','condition'=>$condition));
        $dates = array();
        foreach($list as $detail){
            $dates = array_merge($dates,json_decode($detail->goods_dates,true));
        }
        return $dates;
    }

}
