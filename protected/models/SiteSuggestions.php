<?php

/**
 * This is the model class for table "site_suggestions".
 *
 * The followings are the available columns in table 'site_suggestions':
 * @property int(10) unsigned $_id
 * @property text $content
 * @property char(16) $ip
 * @property char(20) $created
 * @author leo   add 09/3/16:05
 * @note 网站意见建议信 控制
 */
class SiteSuggestions extends BaseActiveRecord
{
    
    
    // 默认存入数据库   如果是false 则发送专门邮箱待开发
    const _SAVE_IN_DB = true;


	public function rules()
	{
		return array(
			array('content', 'required'),
			array('ip,created', 'safe'),
			array('_id, content, ip, created', 'safe', 'on'=>'search'),
		);
	}

	public function relations()
	{
		return array();
	}

	public function attributeLabels()
	{
		$t = array(
			'_id' => 'ID',
			'content' => 'Content',
			'ip' => 'Ip',
			'created' => 'Created',
		);
        foreach ($t as $k => $v) $t[$k] = Yii::t($this->tableName(), $v);
        return $t;
	}

	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('_id',$this->_id,true);
		$criteria->compare('content',$this->content,true);
		$criteria->compare('ip',$this->ip,true);
		$criteria->compare('created',$this->created,true);
        $criteria->order = '_id desc';

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
    /**
     * 网站建议意见接口
    */
    public static function add($content)
    {
        if(trim($content) == '')return false;
        $_obj = new SiteSuggestions;
        $_obj->content = $content;
        $_obj->ip = G4S::getIp();
        $_obj->created = date("Y-m-d H:i:s");
        return $_obj->save(false);
    }
}