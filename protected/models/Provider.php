<?php

/**
 * This is the model class for table "provider".
 *
 * The followings are the available columns in table 'provider':
 * @property int(10) unsigned $provider_id
 * @property tinyint(1) $display_status_hist
 * @property tinyint(1) $separate_tours_package
 * @property tinyint(1) $can_issue_eticket
 * @property text $eticket_comment
 * @property tinyint(1) $auto_charged
 * @property tinyint(1) $auto_charged_package
 * @property text $auto_charged_time
 * @property text $auto_charged_time_package
 * @property decimal(10,2) $auto_charged_amount
 * @property decimal(10,2) $auto_charged_amount_package
 * @property varchar(255) $name
 * @property varchar(255) $chinese_name
 * @property varchar(255) $code
 * @property varchar(255) $address_line_1
 * @property varchar(255) $address_line_2
 * @property varchar(128) $city
 * @property varchar(128) $region
 * @property varchar(128) $state
 * @property varchar(16) $zip
 * @property varchar(32) $country
 * @property varchar(64) $phone
 * @property varchar(210) $fax
 * @property varchar(255) $website
 * @property varchar(64) $timezone
 * @property text $other_language
 * @property varchar(16) $transaction_fee
 * @property text $provider_cxln_policy
 * @property text $store_cxln_policy
 * @property tinyint(4) $max_child_age
 * @property text $major_category
 * @property varchar(255) $email
 * @property varchar(128) $contact
 * @property tinyint(1) $gender_needed
 * @property tinyint(1) $hotel_pickup_needed
 * @property tinyint(1) $signature_required
 * @property tinyint(1) $pick_location
 * @property tinyint(1) $departure_time
 * @property varchar(30) $departure_time_format
 * @property varchar(128) $local_operator_phone
 * @property varchar(225) $emergency_contact
 * @property varchar(64) $emergency_phone
 * @property text $reservation_note
 * @property text $how_to_book
 * @property text $pick_up_info
 * @property tinyint(2) $book_limit_value
 * @property enum('hours','days') $book_limit_value_type
 * @property tinyint(2) $book_limit_value_air
 * @property enum('hours','days') $book_limit_value_type_air
 * @property tinyint(1) $need_birthday_info
 * @property varchar(128) $accounting_contact
 * @property tinyint(4) $accounting_payment_method
 * @property varchar(50) $accounting_payment_frequency
 * @property varchar(100) $accounting_phone
 * @property varchar(100) $accounting_fax
 * @property varchar(255) $accounting_email
 * @property text $accounting_address
 * @property text $accounting_note
 * @property text $meta_title
 * @property text $meta_keyword
 * @property text $meta_desc
 * @property text $url_name
 * @property date $start_date
 * @property timestamp $created
 * @property timestamp $joined
 * @property timestamp $last_updated
 * @property varchar(255) $last_update_by
 * @property varchar(255) $next_update_due_date
 * @property tinyint(1) $api_access
 * @property int(10) unsigned $provider_language_id
 * @property int(10) unsigned $currency_id
 * @property varchar(20) unsigned $language
 *
 * The followings are the available model relations:
 * @property ProductAttributeTourProvider[] $productAttributeTourProviders
 * @property mixed $ProductAttributeTourProviderCount
 * @property ProductAttributeValueTourProvider[] $productAttributeValueTourProviders
 * @property mixed $ProductAttributeValueTourProviderCount
 * @property Currency $currency
 * @property ProviderLanguage $providerLanguage
 */
class Provider extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Provider the static model class
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
		return 'provider';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('eticket_comment, auto_charged_time, auto_charged_time_package, auto_charged_amount, auto_charged_amount_package, code, address_line_1, city, state, zip, country, phone, website, timezone, other_language, transaction_fee, provider_cxln_policy, store_cxln_policy, major_category, email, contact, departure_time_format, local_operator_phone, emergency_contact, emergency_phone, reservation_note, how_to_book, pick_up_info, accounting_contact, accounting_payment_frequency, accounting_phone, accounting_fax, accounting_email, accounting_address, accounting_note, meta_title, meta_keyword, meta_desc, url_name, start_date, last_updated, last_update_by, next_update_due_date, provider_language_id, currency_id, language', 'required'),
			array('display_status_hist, separate_tours_package, can_issue_eticket, auto_charged, auto_charged_package, max_child_age, gender_needed, hotel_pickup_needed, signature_required, pick_location, departure_time, book_limit_value, book_limit_value_air, need_birthday_info, accounting_payment_method, api_access', 'numerical', 'integerOnly'=>true),
			array('auto_charged_amount, auto_charged_amount_package, provider_language_id, currency_id', 'length', 'max'=>10),
			array('name, chinese_name, code, address_line_1, address_line_2, website, email, accounting_email, last_update_by, next_update_due_date', 'length', 'max'=>255),
			array('city, region, state, contact, local_operator_phone, accounting_contact', 'length', 'max'=>128),
			array('zip, transaction_fee', 'length', 'max'=>16),
			array('country', 'length', 'max'=>32),
			array('phone, timezone, emergency_phone', 'length', 'max'=>64),
			array('fax', 'length', 'max'=>210),
			array('departure_time_format', 'length', 'max'=>30),
			array('emergency_contact', 'length', 'max'=>225),
			array('book_limit_value_type, book_limit_value_type_air', 'length', 'max'=>5),
			array('accounting_payment_frequency', 'length', 'max'=>50),
			array('accounting_phone, accounting_fax', 'length', 'max'=>100),
			array('created, joined', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('provider_id, display_status_hist, separate_tours_package, can_issue_eticket, eticket_comment, auto_charged, auto_charged_package, auto_charged_time, auto_charged_time_package, auto_charged_amount, auto_charged_amount_package, name, chinese_name, code, address_line_1, address_line_2, city, region, state, zip, country, phone, fax, website, timezone, other_language, transaction_fee, provider_cxln_policy, store_cxln_policy, max_child_age, major_category, email, contact, gender_needed, hotel_pickup_needed, signature_required, pick_location, departure_time, departure_time_format, local_operator_phone, emergency_contact, emergency_phone, reservation_note, how_to_book, pick_up_info, book_limit_value, book_limit_value_type, book_limit_value_air, book_limit_value_type_air, need_birthday_info, accounting_contact, accounting_payment_method, accounting_payment_frequency, accounting_phone, accounting_fax, accounting_email, accounting_address, accounting_note, meta_title, meta_keyword, meta_desc, url_name, start_date, created, joined, last_updated, last_update_by, next_update_due_date, api_access, provider_language_id, currency_id, language', 'safe', 'on'=>'search'),
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
			'productAttributeTourProviders' => array(self::HAS_MANY, 'ProductAttributeTourProvider', 'provider_id'),
			'ProductAttributeTourProviderCount' => array(self::STAT, 'ProductAttributeTourProvider', 'provider_id'),
			'productAttributeValueTourProviders' => array(self::HAS_MANY, 'ProductAttributeValueTourProvider', 'provider_id'),
			'ProductAttributeValueTourProviderCount' => array(self::STAT, 'ProductAttributeValueTourProvider', 'provider_id'),
			'currency' => array(self::BELONGS_TO, 'Currency', 'currency_id'),
			'providerLanguage' => array(self::BELONGS_TO, 'ProviderLanguage', 'provider_language_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'provider_id' => 'Provider ID',
			'display_status_hist' => 'Display Status Hist',
			'separate_tours_package' => 'Separate Tours Package',
			'can_issue_eticket' => 'Can Issue Eticket',
			'eticket_comment' => 'Eticket Comment',
			'auto_charged' => 'Auto Charged',
			'auto_charged_package' => 'Auto Charged Package',
			'auto_charged_time' => 'Auto Charged Time',
			'auto_charged_time_package' => 'Auto Charged Time Package',
			'auto_charged_amount' => 'Auto Charged Amount',
			'auto_charged_amount_package' => 'Auto Charged Amount Package',
			'name' => 'Name',
			'chinese_name' => 'Chinese Name',
			'code' => 'Code',
			'address_line_1' => 'Address Line 1',
			'address_line_2' => 'Address Line 2',
			'city' => 'City',
			'region' => 'Region',
			'state' => 'State',
			'zip' => 'Zip',
			'country' => 'Country',
			'phone' => 'Phone',
			'fax' => 'Fax',
			'website' => 'Website',
			'timezone' => 'Timezone',
			'other_language' => 'Other Language',
			'transaction_fee' => 'Transaction Fee',
			'provider_cxln_policy' => 'Provider Cxln Policy',
			'store_cxln_policy' => 'Store Cxln Policy',
			'max_child_age' => 'Max Child Age',
			'major_category' => 'Major Category',
			'email' => 'Email',
			'contact' => 'Contact',
			'gender_needed' => 'Gender Needed',
			'hotel_pickup_needed' => 'Hotel Pickup Needed',
			'signature_required' => 'Signature Required',
			'pick_location' => 'Pick Location',
			'departure_time' => 'Departure Time',
			'departure_time_format' => 'Departure Time Format',
			'local_operator_phone' => 'Local Operator Phone',
			'emergency_contact' => 'Emergency Contact',
			'emergency_phone' => 'Emergency Phone',
			'reservation_note' => 'Reservation Note',
			'how_to_book' => 'How To Book',
			'pick_up_info' => 'Pick Up Info',
			'book_limit_value' => 'Book Limit Value',
			'book_limit_value_type' => 'Book Limit Value Type',
			'book_limit_value_air' => 'Book Limit Value Air',
			'book_limit_value_type_air' => 'Book Limit Value Type Air',
			'need_birthday_info' => 'Need Birthday Info',
			'accounting_contact' => 'Accounting Contact',
			'accounting_payment_method' => 'Accounting Payment Method',
			'accounting_payment_frequency' => 'Accounting Payment Frequency',
			'accounting_phone' => 'Accounting Phone',
			'accounting_fax' => 'Accounting Fax',
			'accounting_email' => 'Accounting Email',
			'accounting_address' => 'Accounting Address',
			'accounting_note' => 'Accounting Note',
			'meta_title' => 'Meta Title',
			'meta_keyword' => 'Meta Keyword',
			'meta_desc' => 'Meta Desc',
			'url_name' => 'Url Name',
			'start_date' => 'Start Date',
			'created' => 'Created',
			'joined' => 'Joined',
			'last_updated' => 'Last Updated',
			'last_update_by' => 'Last Update By',
			'next_update_due_date' => 'Next Update Due Date',
			'api_access' => 'Api Access',
			'provider_language_id' => 'Provider Language ID',
			'currency_id' => 'Currency ID',
			'language' => 'Language',
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

		$criteria->compare('provider_id',$this->provider_id,true);
		$criteria->compare('display_status_hist',$this->display_status_hist);
		$criteria->compare('separate_tours_package',$this->separate_tours_package);
		$criteria->compare('can_issue_eticket',$this->can_issue_eticket);
		$criteria->compare('eticket_comment',$this->eticket_comment,true);
		$criteria->compare('auto_charged',$this->auto_charged);
		$criteria->compare('auto_charged_package',$this->auto_charged_package);
		$criteria->compare('auto_charged_time',$this->auto_charged_time,true);
		$criteria->compare('auto_charged_time_package',$this->auto_charged_time_package,true);
		$criteria->compare('auto_charged_amount',$this->auto_charged_amount,true);
		$criteria->compare('auto_charged_amount_package',$this->auto_charged_amount_package,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('chinese_name',$this->chinese_name,true);
		$criteria->compare('code',$this->code,true);
		$criteria->compare('address_line_1',$this->address_line_1,true);
		$criteria->compare('address_line_2',$this->address_line_2,true);
		$criteria->compare('city',$this->city,true);
		$criteria->compare('region',$this->region,true);
		$criteria->compare('state',$this->state,true);
		$criteria->compare('zip',$this->zip,true);
		$criteria->compare('country',$this->country,true);
		$criteria->compare('phone',$this->phone,true);
		$criteria->compare('fax',$this->fax,true);
		$criteria->compare('website',$this->website,true);
		$criteria->compare('timezone',$this->timezone,true);
		$criteria->compare('other_language',$this->other_language,true);
		$criteria->compare('transaction_fee',$this->transaction_fee,true);
		$criteria->compare('provider_cxln_policy',$this->provider_cxln_policy,true);
		$criteria->compare('store_cxln_policy',$this->store_cxln_policy,true);
		$criteria->compare('max_child_age',$this->max_child_age);
		$criteria->compare('major_category',$this->major_category,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('contact',$this->contact,true);
		$criteria->compare('gender_needed',$this->gender_needed);
		$criteria->compare('hotel_pickup_needed',$this->hotel_pickup_needed);
		$criteria->compare('signature_required',$this->signature_required);
		$criteria->compare('pick_location',$this->pick_location);
		$criteria->compare('departure_time',$this->departure_time);
		$criteria->compare('departure_time_format',$this->departure_time_format,true);
		$criteria->compare('local_operator_phone',$this->local_operator_phone,true);
		$criteria->compare('emergency_contact',$this->emergency_contact,true);
		$criteria->compare('emergency_phone',$this->emergency_phone,true);
		$criteria->compare('reservation_note',$this->reservation_note,true);
		$criteria->compare('how_to_book',$this->how_to_book,true);
		$criteria->compare('pick_up_info',$this->pick_up_info,true);
		$criteria->compare('book_limit_value',$this->book_limit_value);
		$criteria->compare('book_limit_value_type',$this->book_limit_value_type,true);
		$criteria->compare('book_limit_value_air',$this->book_limit_value_air);
		$criteria->compare('book_limit_value_type_air',$this->book_limit_value_type_air,true);
		$criteria->compare('need_birthday_info',$this->need_birthday_info);
		$criteria->compare('accounting_contact',$this->accounting_contact,true);
		$criteria->compare('accounting_payment_method',$this->accounting_payment_method);
		$criteria->compare('accounting_payment_frequency',$this->accounting_payment_frequency,true);
		$criteria->compare('accounting_phone',$this->accounting_phone,true);
		$criteria->compare('accounting_fax',$this->accounting_fax,true);
		$criteria->compare('accounting_email',$this->accounting_email,true);
		$criteria->compare('accounting_address',$this->accounting_address,true);
		$criteria->compare('accounting_note',$this->accounting_note,true);
		$criteria->compare('meta_title',$this->meta_title,true);
		$criteria->compare('meta_keyword',$this->meta_keyword,true);
		$criteria->compare('meta_desc',$this->meta_desc,true);
		$criteria->compare('url_name',$this->url_name,true);
		$criteria->compare('start_date',$this->start_date,true);
		$criteria->compare('created',$this->created,true);
		$criteria->compare('joined',$this->joined,true);
		$criteria->compare('last_updated',$this->last_updated,true);
		$criteria->compare('last_update_by',$this->last_update_by,true);
		$criteria->compare('next_update_due_date',$this->next_update_due_date,true);
		$criteria->compare('api_access',$this->api_access);
		$criteria->compare('provider_language_id',$this->provider_language_id,true);
		$criteria->compare('currency_id',$this->currency_id,true);
		$criteria->compare('language',$this->language,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

    public function getAccountingPaymentFrequency() {
        $ar_payment_frequency[''] = '---Select---';
        $ar_payment_frequency['Monthly'] = 'Monthly';
        $ar_payment_frequency['Semi-monthly'] = 'Semi-monthly';
        $qry_payment_frequency="SELECT DISTINCT(accounting_payment_frequency) FROM  provider WHERE accounting_payment_frequency NOT IN ('', 'Monthly', 'Semi-monthly') ORDER BY accounting_payment_frequency ASC";
        $res_agency_operate_lang_id = Yii::app()->db->createCommand($qry_payment_frequency)->queryAll();
        foreach($res_agency_operate_lang_id as $row_payment_frequency){
            $ar_payment_frequency[$row_payment_frequency['accounting_payment_frequency']] = $row_payment_frequency['accounting_payment_frequency'];
        }
        $ar_payment_frequency['1'] = 'Other';
        return $ar_payment_frequency;
    }

    /*
    *  Get Provider language name pass through provider id
    */
    public function getProviderLanguageName($provider_id) {
        $qry_get_provider_lang="SELECT pl.name FROM  ".ProviderLanguage::model()->tableName() ." pl, ".Provider::model()->tableName()." p WHERE p.provider_language_id = pl.provider_language_id AND p.provider_id='".$provider_id."'";
        $res_get_provider_lang=Yii::app()->db->createCommand($qry_get_provider_lang)->queryRow();
        return $res_get_provider_lang['name'];
    }
}