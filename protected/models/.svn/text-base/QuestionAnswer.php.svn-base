<?php

/**
 * This is the model class for table "question_answer".
 *
 * The followings are the available columns in table 'question_answer':
 * @property int(10) unsigned $question_answer_id
 * @property text $answer
 * @property timestamp $updated
 * @property timestamp $created
 * @property int(10) unsigned $question_id
 * @property int(10) unsigned $customer_id
 *
 * The followings are the available model relations:
 * @property Customer $customer
 * @property Question $question
 */
class QuestionAnswer extends BaseActiveRecord
{

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('answer, updated, question_id, customer_id', 'required'),
			array('question_id, customer_id', 'length', 'max'=>10),
			array('created', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('question_answer_id, answer, updated, created, question_id, customer_id', 'safe', 'on'=>'search'),
		);
	}

    /**
     * @return array the query criteria.
     */
    public function defaultScope()
    {
        return array('condition' => sprintf('%s.question_answer_id>10', $this->getTableAlias(true, false)));
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
			'question' => array(self::BELONGS_TO, 'Question', 'question_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'question_answer_id' => 'Question Answer ID',
			'answer' => 'Answer',
			'updated' => 'Updated',
			'created' => 'Created',
			'question_id' => 'Question ID',
			'customer_id' => 'Customer ID',
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

		$criteria->compare('question_answer_id',$this->question_answer_id,true);
		$criteria->compare('answer',$this->answer,true);
		$criteria->compare('updated',$this->updated,true);
		$criteria->compare('created',$this->created,true);
		$criteria->compare('question_id',$this->question_id,true);
		$criteria->compare('customer_id',$this->customer_id,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}