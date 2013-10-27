<?php

/**
 * This is the model class for table "question".
 *
 * The followings are the available columns in table 'question':
 * @property int(10) unsigned $question_id
 * @property text $question
 * @property varchar(45) $parent_type
 * @property int(10) unsigned $parent_id
 * @property timestamp $created
 * @property int(10) unsigned $customer_id
 *
 * The followings are the available model relations:
 * @property Customer $customer
 * @property QuestionAnswer[] $questionAnswers
 * @property mixed $questionAnswerCount
 */
class Question extends BaseActiveRecord
{


    public function getContent(){
        return preg_replace('/\[(\d{1,3})\]/','<img src="/js/kindeditor/plugins/emoticons/images/\\1.gif" alt="\\1"/>',$this->question);
    }

    public function getProvider($attributes=array(),$pageSize=10,$order='question_id DESC'){
        $condition = '';
        if($attributes){
            $condition = '1=1';
            foreach($attributes as $key=>$value){
                $condition .= ' AND `t`.`'.$key.'` ="'.$value.'"';
            }
        }
    	$dataProvider=new CActiveDataProvider('Question', array(
    			'criteria'=>array('condition'=>$condition,'order'=>$order),
                'pagination'=>array('pageSize'=>$pageSize,'pageVar'=>'qpage'),
    	));
    	return $dataProvider;
    }
	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('question, parent_type, parent_id, created, customer_id', 'required'),
			array('parent_type', 'length', 'max'=>45),
			array('parent_id, customer_id', 'length', 'max'=>10),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('question_id, question, parent_type, parent_id, created, customer_id', 'safe', 'on'=>'search'),
		);
	}

    /**
     * @return array the query criteria.
     */
    public function defaultScope()
    {
        return array('condition' => sprintf('%s.question_id>10', $this->getTableAlias(true, false)));
    }

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'customer' => array(self::BELONGS_TO, 'Customer', 'customer_id'),
			'questionAnswers' => array(self::HAS_MANY, 'QuestionAnswer', 'question_id'),
			'questionAnswerCount' => array(self::STAT, 'QuestionAnswer', 'question_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		$t = array(
			'question_id' => 'Question ID',
			'question' => 'Question',
			'parent_type' => 'Parent Type',
			'parent_id' => 'Parent ID',
			'created' => 'Created',
			'customer_id' => 'Customer ID',
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

		$criteria->compare('question_id',$this->question_id,true);
		$criteria->compare('question',$this->question,true);
		$criteria->compare('parent_type',$this->parent_type,true);
		$criteria->compare('parent_id',$this->parent_id,true);
		$criteria->compare('created',$this->created,true);
		$criteria->compare('customer_id',$this->customer_id,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}