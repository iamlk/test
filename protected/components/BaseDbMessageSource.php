<?php
/**
 * @desc 翻译信息的数据库来源
 * @author zyme
 * @note 注意：开发人员定义category名称时需要在配置里申明extends关系
 */
class BaseDbMessageSource extends CDbMessageSource
{

    public $extends = array();
    public $sourceMessageTable = 'system_source';
    public $translatedMessageTable = 'system_translation';
    private $_messages = array();

    /**
     * 取“原文”的“翻译”信息
     */
    protected function loadMessagesFromDb($category, $language)
    {
        $sql = sprintf(" SELECT A.message AS source, B.message AS translation
                FROM `%s` AS A INNER JOIN `%s` AS B ON A.system_source_id=B.system_source_id
                WHERE A.category=:category AND B.language=:language
                LIMIT 9999 ", $this->sourceMessageTable, $this->translatedMessageTable);
        $command = $this->getDbConnection()->createCommand($sql);
        $command->bindValue(':category', $category);
        $command->bindValue(':language', $language);
        $messages = array();
        foreach ($command->queryAll() as $row) $messages[$row['source']] = $row['translation'];
        return $messages;
    }

    /**
     * 翻译一条信息
     */
    protected function translateMessage($category, $message, $language)
    {
        $key = $language.'.'.$category;
        if (!isset($this->_messages[$key])) $this->_messages[$key] = $this->loadMessages($category, $language);
        if (isset($this->_messages[$key][$message]) && $this->_messages[$key][$message] !== '') return $this->_messages[$key][$message];
        elseif (($_pc = $this->getParentCategory($category)) != '' and $_pc != $category) return $this->translateMessage($_pc, $message, $language);
        elseif ($this->hasEventHandler('onMissingTranslation'))
        {
            $event = new CMissingTranslationEvent($this, $category, $message, $language);
            $this->onMissingTranslation($event);
            return $event->message;
        }
        else  return $message;
    }

    /**
     * 取得父级category类名
     */
    private function getParentCategory($category)
    {
        return $this->extends[$category];
    }
}
