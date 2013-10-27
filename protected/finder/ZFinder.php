<?php
/**
 * 搜索者应用组件的基类
 * @package 搜索者
 * @author zyme
 */
class ZFinder extends CComponent
{

    /** 分页 **/
    protected $_pager = array();

    /** 查询 **/
    protected $_from = array();
    protected $_where = array();
    protected $_groupby = array();
    protected $_having = array();
    protected $_select = array();
    protected $_distinct = true;
    protected $_orderby = array();
    protected $_limit = array();

    /** 返回 **/
    protected $_count = null;
    protected $_data = null;

    /** SQL **/
    private $_sql_count = null;
    private $_sql_data = null;

    /** __construct init **/
    public function __construct()
    {
        $this->init();
    }
    public function init()
    {

    }

    /** 分页：page=当前页码 size=每页最多条数 count=当前页条数 total=所有总条数 **/
    public function getPagerPage()
    {
        return $this->_pager->page;
    }
    public function setPagerPage($page)
    {
        $this->_pager->page = $page;
    }
    public function getPagerSize()
    {
        return $this->_pager->size;
    }
    public function setPagerSize($size)
    {
        $this->_pager->size = $size;
    }
    public function getPagerCount()
    {
        return $this->_pager->count;
    }
    public function setPagerCount($count)
    {
        $this->_pager->count = $count;
    }
    public function getPagerTotal()
    {
        return $this->_pager->total;
    }
    public function setPagerTotal($total)
    {
        $this->_pager->total = $total;
    }

    /** 分页：数组 **/
    public function getPager()
    {
        return $this->_pager;
    }
    public function setPager($pager)
    {
        $this->_pager = $pager;
    }

    /** 总数 和 数据 **/
    public function count()
    {
        if ($this->_count === null)
        {
            Yii::trace(get_class($this).'.count()', 'ZFinder');
            $this->_count = Yii::app()->db->createCommand($this->_sql_count())->queryScalar();
        }
        return $this->_count;
    }
    public function data()
    {
        if ($this->_data === null)
        {
            Yii::trace(get_class($this).'.data()', 'ZFinder');
            $this->_data = Yii::app()->db->createCommand($this->_sql_data())->queryAll();
        }
        return $this->_data;
    }

    /** _sql_count _sql_data **/
    private function _sql_count()
    {
        if ($this->_sql_count === null)
        {
            $this->_sql_count = sprintf(' SELECT COUNT(*) AS _count FROM %s ', $this->_from);
            if ($this->_where) $this->_sql_count .= sprintf(' WHERE %s ', $this->_where);
        }
        return $this->_sql_count;
    }
    private function _sql_data()
    {
        if ($this->_sql_data === null)
        {
            $this->_sql_data = sprintf(' SELECT %s FROM %s ', ($this->_select?:'*'), $this->_from);
            if ($this->_where) $this->_sql_data .= sprintf(' WHERE %s ', $this->_where);
            if ($this->_orderby) $this->_sql_data .= sprintf(' ORDER BY %s ', $this->_orderby);
            if ($this->_limit) $this->_sql_data .= sprintf(' LIMIT %s ', $this->_limit);
        }
        return $this->_sql_data;
    }

}
