<?php
/**
 * This is the model class for table "article_review".
 *
 * The followings are the available columns in table 'article_review':
 * @property integer $article_review_id
 * @property integer $parent_id
 * @property integer $article_id
 * @property integer $customer_id
 * @property integer $created
 * @property string $content
 */
class ArticleReview extends CActiveRecord
{
    public $_flatTree = '';
    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return ArticleReview the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'article_review';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('parent_id, article_id, customer_id, created, is_active, content', 'required'),
            array(
                'parent_id, article_id, customer_id, created, is_active',
                'numerical',
                'integerOnly' => true),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array(
                'article_review_id, parent_id, article_id, customer_id, created, content, is_active',
                'safe',
                'on' => 'search'),
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
        'customer'=>array(self::BELONGS_TO, 'Customer', 'customer_id'),
        'article'=>array(self::BELONGS_TO, 'Article', 'article_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'article_review_id' => 'Article Review',
            'parent_id' => 'Parent',
            'article_id' => 'Article',
            'customer_id' => 'Customer',
            'created' => 'Created',
            'content' => 'Content',
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

        $criteria = new CDbCriteria;

        $criteria->compare('article_review_id', $this->article_review_id);
        $criteria->compare('parent_id', $this->parent_id);
        $criteria->compare('article_id', $this->article_id);
        $criteria->compare('customer_id', $this->customer_id);
        $criteria->compare('created', $this->created);
        $criteria->compare('content', $this->content, true);

        return new CActiveDataProvider($this, array('criteria' => $criteria, ));
    }


    public function getAllReview($id)
    {
        if ($this->_flatTree == null)
        {
            $criteria = new CDbCriteria();
            $criteria->addCondition('article_id=:articleId');
            $criteria->params = array(':articleId' => $id);
            //$data = $this->findAll('article_id=:articleID', array(':articleID'=>$id));
            $dataProvider = new CActiveDataProvider('ArticleReview', array(
            'criteria' => $criteria,
            'pagination' => array('pageSize' => 2, 'pageVar' => 'npage'),
            ));
            $this->_findChildren($flatTree, $dataProvider->getData(), '0', false, 0);
            $this->_flatTree = $flatTree;
        }
        return array('reviews'=>$this->_flatTree,'pages'=>$dataProvider->pagination);
    }

//    private function _findChildren(&$res, $data, $parent_id, $customer_name, $level=0)
//    {
//        reset($data);
//        while (list($key, $row) = each($data))
//        {
//            if (!$customer_name == false)
//            {
//                if ($row['parent_id'] == $parent_id)
//                {
//                    $res .= '<li class="comments_item bor3">';
//                    //$res .= '<div class="comments_item_bd" style="left:'. ($level-1)*40 .'px;">';
//                    $res .= '<div class="comments_item_bd">';
//                    $res .= '<div class="ui_avatar"><a target="_blank" href=""><img src="'.$row->customer['avator'].'" alt="'.$row->customer['nick_name'].'" class="q_namecard"></a></div>';
//                    $res .= '<div class="comments_content">';
//                    $res .= '<a target="_blank" class="q_namecard nickname c_tx" href="">'.$row->customer['nick_name'].'</a>回复<a target="_blank" class="q_namecard nickname c_tx" href="">'.$customer_name.'</a>: ';
//                    $res .= $row['content'];
//                    $res .= '<div class="comments_op">';
//                    $res .= '<a class="ui_mr10 c_tx" id="'.$row['article_review_id'].'">回复</a> ';
//                    $res .= '<span>'.date('Y-m-d H:i:s', $row['created']).'</span>';
//                    $res .= '</div></div></div></li>';
//                    unset($data[$key]);
//                    $this->_findChildren($res, $data, $row['article_review_id'], $row->customer['nick_name'], $level+1);
//
//                }
//            }
//            else
//            {
//                if ($row['parent_id'] == $parent_id)
//                {
//                    $res .= '<li>';
//                    $res .= '<div class="comments_item_bd">';
//                    $res .= '<div class="ui_avatar"><a target="_blank" href=""><img src="'.$row->customer['avator'].'" alt="'.$row->customer['nick_name'].'" class="q_namecard"/></a></div>';
//                    $res .= '<div class="comments_content">';
//                    $res .= '<a target="_blank"  class="q_namecard nickname c_tx" href="">'.$row->customer['nick_name'].'</a>: ';
//                    $res .= $row['content'];
//                    $res .= '<div class="comments_op">';
//                    $res .= '<a class="ui_mr10 c_tx" id="'.$row['article_review_id'].'">回复</a> ';
//                    $res .= '<span>'.date('Y-m-d H:i:s', $row['created']).'</span>';
//                    $res .= '</div></div><div class="comments_list mod_comments_sub"><ul>';
//                    unset($data[$key]);
//                    $this->_findChildren($res, $data, $row['article_review_id'], $row->customer['nick_name'], $level+1);
//                    $res .= '</ul></div></div></li>';
//                }
//
//            }
//        }
//    }

    /**
     * Get a path to top category
     */
    public function getPath($category_id = null)
    {
        $this->_getDropdownListData();
        $compareId = null;
        if ($category_id == null) $category_id = $this->getAttribute('information_category_id');
        $path = array();
        for ($i = count($this->_flatTree) - 1; $i > -1; $i--)
        {
            $row = $this->_flatTree[$i];
            if ($compareId == null)
            {
                if ($row['id'] == $category_id)
                {
                    array_splice($path, 0, 0, array($row));
                    $compareId = $row['pid'];
                }
            }
            else
                if ($row['id'] == $compareId)
                {
                    array_splice($path, 0, 0, array($row));
                    $compareId = $row['pid'];
                }
        }
        return $path;
    }

     /**
     *  RICK ADD  2013-8-16  获取当前用户攻略的评论（不包含回复）
     */
    public function getArticleReview($uid){

         $data = Yii::app()->db->createCommand()->select('*')->from('article_review')->where('customer_id=:id and  parent_id=0',array(':id' => $uid))->order('created desc')->queryAll();
          return $data;
    }

      /**
     *  RICK ADD  2013-8-16  获取当前用户攻略的评论的回复
     */
    public function getArticleReviewHF($id){

         $data = Yii::app()->db->createCommand()->select('*')->from('article_review')->where('parent_id=:id', array(':id' => $id))->order('created desc')->queryAll();
          return $data;
    }

      /**
     *  RICK ADD  获取用户接受到的攻略回复
     */
    public function getArticleReviewRecive($uid)
    {

        $data = Yii::app()->db->createCommand()
        ->select('r.*')
        ->from('article a')
        ->join('article_review r', 'a.article_id=r.article_id')
        ->where('a.customer_id=:id  and r.parent_id=0',array(':id' => $uid))
        ->order('r.created desc')
        ->queryAll();

        return $data;


    }

}
