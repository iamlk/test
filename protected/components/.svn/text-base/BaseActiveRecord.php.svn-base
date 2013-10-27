<?php
/**
 * BaseActiveRecord is the base class for classes representing relational data.
 */
class BaseActiveRecord extends CActiveRecord
{

    public function __construct($scenario = 'insert')
    {
        if (get_called_class() == __CLASS__) throw new CException('Error: Should extend '.__CLASS__);
        parent::__construct($scenario);
    }

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Admin the static model class
     */
    final public static function model($className = null)
    {
        if ($className == null) $className = get_called_class();
        return parent::model($className);
    }

    public function tableName($class='')
    {
        return strtolower(ltrim(preg_replace('/([A-Z])/', '_$1', $class?$class:get_class($this)), '_'));
    }

    //$this->validate()验证后返回第一个错误信息
    public function getFirstError(){
        if($this->errors){
            foreach($this->errors as $list){
                foreach($list as $error)
                    return $error;
            }
        }
        return '';
    }

}
