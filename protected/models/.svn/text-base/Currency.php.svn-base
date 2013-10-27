<?php
class Currency extends CActiveRecord
{
    const ORIENTATION_LEFT = 'left';
    const ORIENTATION_RIGHT = 'right';
    const THOUSAND_SEPERATOR = ',';
    const DECIMAL_POINT = '.';
    const DECIMAL_PLACES = 2;
    const DEFAULT_CURRENCY = 'USD';
	public static $cc = null;
	private static $_currencies = null;

    /**
         * Returns the static model of the specified AR class.
         * @return Currency the static model class
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
                return 'currency';
        }

        /**
         * @return array validation rules for model attributes.
         */
        public function rules()
        {
                // NOTE: you should only define rules for those attributes that
                // will receive user inputs.
                return array(
                        array('name, code, symbol, orientation, xchg_rate, last_updated', 'required'),
                        array('xchg_rate', 'numerical'),
                        array('name', 'length', 'max'=>32),
                        array('code', 'length', 'max'=>3),
                        array('symbol', 'length', 'max'=>16),
                        array('orientation', 'length', 'max'=>5),
                        // The following rule is used by search().
                        // Please remove those attributes that should not be searched.
                        array('currency_id, name, code, symbol, orientation, xchg_rate, last_updated', 'safe', 'on'=>'search'),
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
                        'locales' => array(self::HAS_MANY, 'Locale', 'currency_id'),
                        'providers' => array(self::HAS_MANY, 'Provider', 'currency_id'),
                );
        }

        /**
         * @return array customized attribute labels (name=>label)
         */
        public function attributeLabels()
        {
                return array(
                        'currency_id' => 'Currency',
                        'name' => 'Name',
                        'code' => 'Code',
                        'symbol' => 'Symbol',
                        'orientation' => 'Orientation',
                        'xchg_rate' => 'Xchg Rate',
                        'last_updated' => 'Last Updated',
                );
        }
        
        public function allCurrencies(){
        	if(self::$_currencies == null){
        		self::$_currencies = Currency::findAll();
        	}
        	return self::$_currencies;
        }

   		public function getCurrencyList() {
   			/*
           $currencies_array['USD'] ='US Dollar [USD]';
           $currency_query_raw = "select currency_id, name, code, symbol,orientation, last_updated, xchg_rate from currency where code !='USD' order by name";
           $currency_query =Yii::app()->db->createCommand($currency_query_raw)->queryAll();
             foreach($currency_query as $currency) {
                          $currencies_array[$currency['code']] = $currency['name'] .'['.$currency['code'].']';
                 }
           return $currencies_array;*/
   			//currencies_array['USD'] ='US Dollar [USD]';
   			$currencies_array = array();
   			foreach(Currency::model()->allCurrencies() as $currency){
   				$currencies_array[$currency['code']] = $currency['name'] .'['.$currency['code'].']';
   			}
   			return $currencies_array;   			
        }
        
        public function getCurrencyById($id){
        	$id = intval($id);
        	foreach(Currency::model()->allCurrencies() as $currency){
        		if($currency['currency_id'] == $id){
        			return $currency;
        		}
        	}
        	return null;
        }
        
        public function getCurrencyByCode($code){
        	$code = trim(strtolower($code));
        	foreach(Currency::model()->allCurrencies() as $currency){
        		if(strtolower(trim($currency['code'])) == $code){
        			return $currency;
        		}
        	}
        	return null;
        }
        
        public static function getCurrencyCode($currency_id) {
               /* $currency_query_raw = "select code from currency where currency_id = '".$currency_id."'";
            $currency_query = Yii::app()->db->createCommand($currency_query_raw)->queryAll();
                $currency_code = $currency_query[0]['code'];
                return $currency_code;*/
        	$currency = Currency::model()->getCurrencyById($currency_id);
        	if($currency == null)
        		return '';
        	else
        		return $currency->code ;
        	
        }
        
        public function getCurrencyIdByCode($code){
        	$currency = Currency::model()->getCurrencyByCode($code);
        	if($currency == null)
        		return false;
        	else
        		return $currency->currency_id;        	
        	//return $this->dbConnection->createCommand('select currency_id FROM currency WHERE code = :code')->queryScalar(array(':code'=>strtoupper(trim($code))));
        }
        
		// tuzki add "static" for this function 2013-3-12
        public static function getCurrencyValue($code) {
                $currency_sql = "select xchg_rate from currency where code = '".$code."'";
            $currency_result = Yii::app()->db->createCommand($currency_sql)->queryRow();
                $currency_value = $currency_result['xchg_rate'];
                return $currency_value;
        }
        
        
    /**
     * Convert and format currency 
     * 
     * @param double $number Curreny amount
     * @param boolen $calculate_currency_value Default true. Calculate the currency.
     * @param type $currency_type Currency type
     * @param type $currency_value
     * @return type
     * @throws CException 
     */
    public function format($number, $calculate_currency_value = true, $currency_type = null, $currency_value = '') {
        // if currency type is set to null set the default currency
        if($currency_type == null)
			$currency_type=self::DEFAULT_CURRENCY;
            //$currency_type = Yii::app()->params->defaultCurrency;
        
        // find currency from db
        $currency = Currency::model()->findByAttributes(array('code' => strtoupper($currency_type)));

        // if currency cannot find throw exception
        if(!$currency)
            throw new CException(Yii::t('currency', '{currency} cannot find from database', array('{currency}'=>$currency_type)));

        $rate = ($currency_value) ? $currency_value : $currency->xchg_rate;
        
        if ($calculate_currency_value) {
            
            $formatString = '';
            if($currency->orientation == self::ORIENTATION_LEFT)
                $formatString .= $currency->symbol;
            
            $formatString .= number_format($number * $rate, self::DECIMAL_PLACES, self::DECIMAL_POINT, self::THOUSAND_SEPERATOR);
            
            if($currency->orientation == self::ORIENTATION_RIGHT)
                $formatString .= $currency->symbol;
            
            // if the selected currency is in the european euro-conversion and the default currency is euro,
            // the currency will displayed in the national currency and euro currency
            if ((self::DEFAULT_CURRENCY == 'EUR') && ($currency_type == 'DEM' || $currency_type == 'BEF' || $currency_type == 'LUF' || $currency_type == 'ESP' || $currency_type == 'FRF' || $currency_type == 'IEP' || $currency_type == 'ITL' || $currency_type == 'NLG' || $currency_type == 'ATS' || $currency_type == 'PTE' || $currency_type == 'FIM' || $currency_type == 'GRD')) {
                $formatString .= ' <small>[' . $this->format($number, true, 'EUR') . ']</small>';
            }
        } else {
            
            $formatString = '';
            if($currency->orientation == self::ORIENTATION_LEFT)
                $formatString .= $currency->symbol;
            
            $formatString .= number_format($number * $rate, self::DECIMAL_PLACES, self::DECIMAL_POINT, self::THOUSAND_SEPERATOR);
            
            if($currency->orientation == self::ORIENTATION_RIGHT)
                $formatString .= $currency->symbol;
        }

        return $formatString;
    }
    /**
     * convert and convert a currency 
     * @param number $value
     * @param string $sourceCurrencyCode USD source currency code
     * @param string $targetCurrencyCode null will not perform a convert action
     * @return string
     * @autho vincent 
     */
    public function formatCurrency($value , $sourceCurrencyCode = 'USD' , $targetCurrencyCode = null){    	
    	$currency = Currency::model()->getCurrencyByCode($currencyCode);
    	if($targetCurrencyCode!== null){
    		$value = $this->convert($value, $sourceCurrencyCode , $targetCurrencyCode);
    	}
    	if($currency->orientation == 'right'){
    		return number_format($value,2).$currency->symbol;
    	}else{
    		return $currency->symbol.number_format($value,2);
    	}
    }
    /**
     * convert currency
     * @param number $currencyValue
     * @param string $sourceCurrencyCode source
     * @param string $targetCurrencyCode target
     * @return number
     */
    public function convert($currencyValue , $sourceCurrencyCode = 'USD',$targetCurrencyCode='USD' ){
    	$currencyValue = floatval($currencyValue);
    	$targetCurrencyCode = strtoupper($targetCurrencyCode);
    	$sourceCurrencyCode = strtoupper($sourceCurrencyCode);
    	
    	$t = $this->getCurrencyByCode($targetCurrencyCode);
    	$s = $this->getCurrencyByCode($sourceCurrencyCode);
    	if($t == null ){
    		throw new CException(sprintf('Unsupported currency type %s' , $targetCurrencyCode));
    	}
    	
    	if($s == null ){
    		throw new CException(sprintf('Unsupported currency type %s' , $sourceCurrencyCode));
    	}
    	
    	if($targetCurrencyCode == $sourceCurrencyCode){
    		return $currencyValue ;
    	}
    	if(self::$cc == null){
    		self::$cc = new ECurrencyHelper();
    	}
    	$currencyValue = self::$cc->convert($sourceCurrencyCode,$targetCurrencyCode,$currencyValue);    	
    	return floatval($currencyValue);
    }
    /**
     * convertCurrency to USD 
     * @param float $currencyValue currency value
     * @param string $currencyCode source currency code
     * @author vincent.mi@toursforfun.com
     */
    public function convertToUSD($currencyValue , $currencyCode = 'USD'){
		return $this->convert($currencyValue,$currencyCode,'USD');
    }
	/*
	* @author 
	* @param - return any data to usd 
	* @data
	* @todo this function name not recommend 
	* @deprecated
	*/
	function tep_get_tour_price_in_usd($price_value, $operate_currency_cod) {		
		return self::convertToUSD($price_value,$operate_currency_cod);
	} //End

    /**
     * get product current
     */
    public function getTourProviderCurrencyByProductID($product_id){
        $sql = "SELECT c.code FROM currency AS c, provider AS pr, product AS p WHERE p.`product_id` = '" . intval($product_id) ."'  AND p.`provider_id` = pr.`provider_id` AND pr.`currency_id` = c.`currency_id`" ;
        $currency_code = Yii::app()->db->createCommand($sql)->queryScalar();
        return $currency_code;
    }

}
