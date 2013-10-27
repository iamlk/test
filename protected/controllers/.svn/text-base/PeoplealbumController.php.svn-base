<?php
class PeoplealbumController extends BaseController
{
    public $layout = '//layouts/people';
    public $flag = array('selected' => null, 'select' => null);
    public $result = array('state' => null, 'reason' => null);
    private $path = './assets/';
    private $image_save_path = '/Album/user_';
    private $page = 9;
    public $aid = null;
    public $uid = null;
    public $default = array();
    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     * @auth rick
     */
    public function actionIndex()
    {
        $this->params['title'] = '他的相册-好友中心';
        $this->flag['selected'] = 'peoplealbum';
        $this->uid = $_REQUEST['u_id'];

        $data = Album::model()->getAlbumAllInfo(intval($this->uid));
        $this->render('index', array('data' => $data));
    }
    //查看相册内容
    public function actionAlbumsub()
    {
        $this->params['title'] = '他的相册-好友中心';
        $this->flag['selected'] = 'peoplealbum';
        $this->uid = $_REQUEST['u_id'];
        $data = Album::getAlbumImageFormAid(intval($_REQUEST['a_id']));

        $albuminfo = Album::model()->getAlbumInfoFormAid(intval($_REQUEST['a_id']));

        $dataProvider = new CArrayDataProvider($data, array('pagination' => array('pageSize' =>
                    $this->page), ));

        $this->render('albumsub', array('data' => $dataProvider, 'albuminfo' => $albuminfo[0]));

    }
    //相册图片分页
    public function actionImagePage()
    {
        $this->flag['selected'] = 'peoplealbum';
        $this->uid = $_REQUEST['u_id'];
        $data = Album::getAlbumImageFormAid(intval($_REQUEST['a_id']));
        $albuminfo = Album::model()->getAlbumInfoFormAid(intval($_REQUEST['a_id']));
        $dataProvider = new CArrayDataProvider($data, array('pagination' => array('pageSize' =>
                    $this->page), ));
        $this->renderPartial('albumsub', array('data' => $dataProvider, 'albuminfo' => $albuminfo[0]));
    }


    //图片查看
    public function actionSeePic()
    {
        /*
        $this->params['title'] = '他的相册-好友中心';
        $this->flag['selected'] = 'peoplealbum';
        $this->uid = $_REQUEST['u_id'];
        $data = Album::getAlbumImageFormAid(Album::model()->getAid(intval($_REQUEST['a_img_id'])));
        $albuminfo = Album::model()->getAlbumInfoFormAid(Album::model()->getAid(intval($_REQUEST['a_img_id'])));
        foreach ($data as $item) {

        if ($item['album_image_id'] == intval($_REQUEST['a_img_id'])) {

        $this->default = $item;
        }
        }
        //print_r($this->default);exit;
        $this->render('see_pic', array('data' => $data, 'albuminfo' => $albuminfo[0]));
        */

        $this->params['title'] = '他的相册-好友中心';
        $this->flag['selected'] = 'peoplealbum';
        $this->uid = $_REQUEST['u_id'];
        $data = Album::getAlbumImageFormAid(Album::model()->getAid(intval($_REQUEST['a_img_id'])));
        $albuminfo = Album::model()->getAlbumInfoFormAid(Album::model()->getAid(intval($_REQUEST['a_img_id'])));
        //获取图片评论
        $albumrewview = AlbumReview::model()->getAlbumImageReview(intval($_REQUEST['a_img_id']));
        $albumrewview = new CArrayDataProvider($albumrewview, array('pagination' =>
                array('pageSize' => 5), ));
        foreach ($data as $item) {

            if ($item['album_image_id'] == intval($_REQUEST['a_img_id'])) {

                $this->default = $item;
            }
        }
        
       // print_r($albumrewview);exit;
        
        $this->render('see_pic', array(
            'data' => $data,
            'albuminfo' => $albuminfo[0],
            'albumrewview' => $albumrewview));

    }

    //图片评论翻页
    public function actionImageReviewPage()
    {
        $this->uid = $_REQUEST['u_id'];
        //获取图片评论
        $albumrewview = AlbumReview::model()->getAlbumImageReview(intval($_REQUEST['a_img_id']));

        $albumrewview = new CArrayDataProvider($albumrewview, array('pagination' =>
                array('pageSize' => 5), ));

        $this->renderPartial('_image_review', array('albumrewview' => $albumrewview));
    }

    //ajax获取评论
    public function actionGetImageReview()
    {
        $this->uid = $_REQUEST['u_id'];
        $albumrewview = AlbumReview::model()->getAlbumImageReview(intval($_REQUEST['a_img_id']));

        $albumrewview = new CArrayDataProvider($albumrewview, array('pagination' =>
                array('pageSize' => 5), ));

        $this->renderPartial('_image_review', array('albumrewview' => $albumrewview));

    }


}
?>