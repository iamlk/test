<?php
/**
 * @author darren
 * $this->Widget('application.widgets.ArticleListWidget')
 */
class ArticleListWidget extends CWidget{
    public $city_id;
    public $model;

    public function init(){
        $this->model = ArticleCity::model()->with('article')->findAll(array('condition'=>'t.city_id=:cityID AND article.is_active=1 AND article.draft=0 AND article.is_delete=0', 'order'=>'article.article_id DESC', 'limit'=>15, 'params'=>array(':cityID'=>$this->city_id)));
    }
    public function run(){
        $this->render('article_list', array('model'=>$this->model));
    }
}