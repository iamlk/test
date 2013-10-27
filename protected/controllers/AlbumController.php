<?php
class AlbumController extends BaseController
{
    public $layout = '//layouts/center.mine';
    public $flag = array('selected' => null, 'select' => null);
    public $result = array('state' => null, 'reason' => null);
    private $path = './assets/';
    private $image_save_path = '/Album/user_';
    private $page = 9;
    public $aid = null;
    public $default= array();
    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     * @auth rick
     */
    public function actionIndex()
    {
        if (U_ID == '') {

            $this->redirect($this->createUrl('site/login'));
        }
        $this->params['title'] = '我的相册-个人中心';
        $data = Album::model()->getAlbumAllInfo(U_ID);
        $this->render('index', array('data' => $data));
    }
    //查看相册内容
    public function actionAlbumsub()
    {
        if (U_ID == '') {

            $this->redirect($this->createUrl('site/login'));
        }
        $this->params['title'] = '我的相册-个人中心';
        $data = Album::getAlbumImageFormAid(intval($_REQUEST['a_id']));

        $albuminfo = Album::model()->getAlbumInfoFormAid(intval($_REQUEST['a_id']));

        $dataProvider = new CArrayDataProvider($data, array('pagination' => array('pageSize' =>
                    $this->page), ));

        $this->render('albumsub', array('data' => $dataProvider, 'albuminfo' => $albuminfo[0]));

    }
    //相册图片分页
    public function actionImagePage()
    {
        $data = Album::getAlbumImageFormAid(intval($_REQUEST['a_id']));
        $albuminfo = Album::model()->getAlbumInfoFormAid(intval($_REQUEST['a_id']));
        $dataProvider = new CArrayDataProvider($data, array('pagination' => array('pageSize' =>
                    $this->page), ));
        $this->renderPartial('albumsub', array('data' => $dataProvider, 'albuminfo' => $albuminfo[0]));
    }

    //上传相片的地址
    public function actionUploadEntry()
    {
      
        $arr = array('aid' => $_REQUEST['a_id']);
        $this->params['title'] = '我的相册-个人中心';
        $data = Album::model()->getAlbumAllInfo(U_ID);
        
        if(empty($data)){
            
           Yii::app()->user->setFlash('errortips', '您还没有创建相册哦！');
                
            $this->redirect($this->createUrl('album/index'));    
        }
        
        $this->render('uploadentry', array('data' => $data, 'arr' => $arr));
    }
    //批量管理
    public function actionLotManage()
    {
        if (U_ID == '') {

            $this->redirect($this->createUrl('site/login'));
        }
        $this->params['title'] = '批量管理-个人中心';
        $data = Album::getAlbumImageFormAid(intval($_REQUEST['a_id']));
        $albuminfo = Album::model()->getAlbumInfoFormAid(intval($_REQUEST['a_id']));
        $dataProvider = new CArrayDataProvider($data, array('pagination' => array('pageSize' =>
                    $this->page), ));

        $this->render('lot_manage', array('data' => $dataProvider, 'albuminfo' => $albuminfo[0]));

    }
    //分页
    public function actionManageImagePage()
    {
        $data = Album::getAlbumImageFormAid(intval($_REQUEST['a_id']));
        $albuminfo = Album::model()->getAlbumInfoFormAid(intval($_REQUEST['a_id']));
        $dataProvider = new CArrayDataProvider($data, array('pagination' => array('pageSize' =>
                    $this->page), ));
        $this->renderPartial('lot_manage', array('data' => $dataProvider, 'albuminfo' =>
                $albuminfo[0]));
    }

    //图片查看
    public function actionSeePic()
    {
        if (U_ID == '') {

            $this->redirect($this->createUrl('site/login'));
        }
        $this->params['title'] = '图片查看-个人中心';
        $data = Album::getAlbumImageFormAid(Album::model()->getAid(intval($_REQUEST['a_img_id'])));
        $albuminfo = Album::model()->getAlbumInfoFormAid(Album::model()->getAid(intval($_REQUEST['a_img_id'])));
        //获取图片评论
        $albumrewview=AlbumReview::model()->getAlbumImageReview(intval($_REQUEST['a_img_id']));
        $albumrewview = new CArrayDataProvider($albumrewview, array('pagination' => array('pageSize' =>
                    5), ));
        foreach($data as $item){
            
            if($item['album_image_id'] == intval($_REQUEST['a_img_id'])){
                
                $this->default=$item;
            }
        }
        $this->render('see_pic', array('data' => $data, 'albuminfo' => $albuminfo[0],'albumrewview'=>$albumrewview));

    }
    //图片评论翻页
    public function actionImageReviewPage(){
        
       //获取图片评论
        $albumrewview=AlbumReview::model()->getAlbumImageReview(intval($_REQUEST['a_img_id'])); 
        
        $albumrewview = new CArrayDataProvider($albumrewview, array('pagination' => array('pageSize' =>
                    5), ));
        
        $this->renderPartial('_image_review',array('albumrewview'=>$albumrewview));
    }
    //ajax获取评论
    public function actionGetImageReview(){
        
         $albumrewview=AlbumReview::model()->getAlbumImageReview(intval($_REQUEST['a_img_id'])); 
        
        $albumrewview = new CArrayDataProvider($albumrewview, array('pagination' => array('pageSize' =>
                    5), ));
        
        $this->renderPartial('_image_review',array('albumrewview'=>$albumrewview));
        
    }

    //创建相册入口
    public function actionCreateAlbum()
    {
      

        if (!empty($_REQUEST['albumname'])) {


            if (Album::model()->checkAlbumName(U_ID, $_REQUEST['albumname'])) {

                //相册名称已经存在，不可以重复创建
                Yii::app()->user->setFlash('errortips', '相册名字已经存在');
                $this->redirect($this->createUrl('album/index'));


            } else {

                $album = new Album;
                $album->a_name = $_REQUEST['albumname'];
                $album->a_description = $_REQUEST['description'];
                $album->created = time();
                $album->updated = time();
                $album->customer_id = U_ID;
                if ($album->save(false)) {

                    Yii::app()->user->setFlash('oktips', '相册创建成功');
                    $this->redirect($this->createUrl('album/index'));

                } else {


                    Yii::app()->user->setFlash('errortips', '相册名保存失败');
                    $this->redirect($this->createUrl('album/index'));

                }

            }

        } else {


            Yii::app()->user->setFlash('errortips', '请求数据异常');
            $this->redirect($this->createUrl('album/index'));


        }
    }

    //修改相册
    public function actionUpdateAlbumInfo()
    {

        if (empty($_REQUEST['a_id'])) {

            Yii::app()->user->setFlash('errortips', '请求数据异常');
            exit(json_encode($this->result));
        }


        $album = Album::model()->findByPk(intval($_REQUEST['a_id']));
        $album->a_name = $_REQUEST['albumname'];
        $album->a_description = $_REQUEST['description'];
        $album->updated = time();
        if ($album->save(false)) {

            Yii::app()->user->setFlash('oktips', '相册修改成功');
            $this->redirect($this->createUrl('album/index'));

        } else {

            Yii::app()->user->setFlash('errortips', '相册修改失败');
            $this->redirect($this->createUrl('album/index'));
        }


    }

    //删除相册
    public function actionDelAlbum()
    {

        if (empty($_REQUEST['a_id'])) {

            $this->result['state'] = '0';
            $this->result['reason'] = '请求数据异常';

            exit(json_encode($this->result));
        }


        if (count(Album::getAlbumImageFormAid(intval($_REQUEST['a_id']))) <= 0) {


            if (Album::DelAlbumFromAid(intval($_REQUEST['a_id']))) {

                $this->result['state'] = '1';
                $this->result['reason'] = '相册删除成功';

                exit(json_encode($this->result));

            } else {

                $this->result['state'] = '0';
                $this->result['reason'] = '相册删除失败';

                exit(json_encode($this->result));
            }


        } else {


            $arr = Album::model()->getAlbumImageFormAid($_REQUEST['a_id']);

            foreach ($arr as $item) {

                $rs = Album::model()->DelAlbumImage($item['album_image_id']);
            }


            if (Album::DelAlbumFromAid($_REQUEST['a_id'])) {

                $this->result['state'] = '1';
                $this->result['reason'] = '相册删除成功';

                exit(json_encode($this->result));

            } else {

                $this->result['state'] = '0';
                $this->result['reason'] = '相册删除失败';

                exit(json_encode($this->result));
            }


        }

    }
    //保存临时图片
    public function actionSaveImages()
    {

        if (empty($_REQUEST['ProductImages']['path'])) {

            $data = Album::model()->getAlbumAllInfo(U_ID);
            $this->render('uploadentry', array('data' => $data));
        }

        $count = count($_REQUEST['ProductImages']['path']);
        $flag = 0;
        for ($i = 0; $i < $count; $i++) {

            //查看图片是否存在
            if (file_exists($this->path . $_REQUEST['ProductImages']['path'][$i])) {

                $tempurl = $this->moveImageToAlbum($_REQUEST['ProductImages']['path'][$i]);

                $rs = $this->saveImageToDB($tempurl, $_REQUEST['ProductImages']['title'][$i], $_REQUEST['album_id']);

                if ($rs) {

                    $this->Timeupdated($_REQUEST['album_id']);

                    $flag++;
                }


            } else {

                $this->result['state'] = '0';
                $this->result['reason'] = '图片不存在';

                exit(json_encode($this->result));
            }
        }

        if ($count == $flag) {
            
            //检查相册的封面是否存在
             $data=Album::model()->getAlbumInfoFormAid(intval($_REQUEST['album_id']));
             
             if(empty($data['face'])){
                
                $images=Album::getAlbumImageFormAid(intval($_REQUEST['album_id']));
                
                $count=count($images)-1;
                
                $album=Album::model()->findByAttributes(array('album_id'=>intval($_REQUEST['album_id'])));
                
                $album->face= $images[$count]['album_image_id'];
                
                $album->save();
             }
            
             Dynamic::saveDynamicApi(Yii::app()->db->getLastInsertID(), Dynamic::ALBUMIMAGE,U_ID, 6);

            Yii::app()->user->setFlash('oktips', '图片上传成功');

            $this->redirect($this->createUrl('album/albumsub', array('a_id' => $_REQUEST['album_id'])));

        }


    }
    //图片位置转移
    public function moveImageToAlbum($path)
    {

        $imageinfo = getimagesize($this->path . $path);

        $filetype = explode('/', $imageinfo['mime']);

        $imagepostfix = $filetype[1] == 'jpeg' ? 'jpg' : $filetype[1];

        $imageres = Yii::app()->assetManager->makeAssetFileUrl($this->path . $path, time
            (), $this->image_save_path . Yii::app()->user->customer_id, $imagepostfix);

        @unlink($this->path . $path);

        return $imageres;

    }
    //图片地址保存到数据库
    private function saveImageToDB($path, $title, $aid)
    {

        $albumimage = new AlbumImage;
        $albumimage->img_path = $path;
        $albumimage->img_title = $title;
        $albumimage->created = time();
        $albumimage->updated = time();
        $albumimage->staus = 0;
        $albumimage->album_id = $aid;
        $rs = $albumimage->save(false);
       
        return $rs;
    }
    //修改图片TITLE接口
    public function actionUpdateImageTitle()
    {

        if (empty($_REQUEST['title'])) {


            $this->result['state'] = '0';
            $this->result['reason'] = '标题不能为空';

            exit(json_encode($this->result));
        }

        if (empty($_REQUEST['album_image_id'])) {


            $this->result['state'] = '0';
            $this->result['reason'] = '请求数据异常';

            exit(json_encode($this->result));
        }

        $AlbumImage = AlbumImage::model()->findByPk($_REQUEST['album_image_id']);

        $AlbumImage->img_title = $_REQUEST['title'];

        if ($AlbumImage->save(false)) {

            $this->Timeupdated(Album::model()->getAid($_REQUEST['album_image_id']));
            $this->result['state'] = '1';
            $this->result['reason'] = '修改成功';

            exit(json_encode($this->result));

        } else {

            $this->result['state'] = '0';
            $this->result['reason'] = '修改失败';

            exit(json_encode($this->result));
        }

    }

    //相册更新时间
    private function Timeupdated($aid)
    {

        $Album = Album::model()->findByPk($aid);
        $Album->updated = time();
        $Album->save(false);
    }
    //删除相册图片
    public function actionDelAlbumImage()
    {

        if (empty($_REQUEST['album_image_id'])) {


            $this->result['state'] = '0';
            $this->result['reason'] = '请求数据异常';

            exit(json_encode($this->result));
        }
        $data = Album::model()->getImageInfo($_REQUEST['album_image_id']);

        $rs = Album::model()->DelAlbumImage($_REQUEST['album_image_id']);

        if ($rs) {

            @unlink($this->path . $data['img_path']);

            $this->result['state'] = '1';
            $this->result['reason'] = '图片删除成功';

            exit(json_encode($this->result));

        } else {

            $this->result['state'] = '0';
            $this->result['reason'] = '图片删除失败';

            exit(json_encode($this->result));
        }

    }
    //批量删除
    public function actionLotDelImage()
    {


        if (!empty($_REQUEST)) {

            foreach ($_REQUEST['ck'] as $val) {

                Album::model()->DelAlbumImage($val);

                $data = Album::model()->getImageInfo($_REQUEST['album_image_id']);

                @unlink($this->path . $data['img_path']);

            }
        }

        echo '<script>window.location.href="' . $this->createUrl('/album/lotmanage',
            array('a_id' => $_REQUEST['a_id'])) . '"</script>';
        exit;
    }

    //设置封面
    public function actionSetFace()
    {

        if (empty($_REQUEST['id'])) {

            $this->result['state'] = '0';
            $this->result['reason'] = '图片ID为空';

            exit(json_encode($this->result));

        }

        $flag = Album::model()->setFace($_REQUEST['id']);

        if ($flag) {

            $this->result['state'] = '1';
            $this->result['id'] = $_REQUEST['id'];
            $this->result['reason'] = '封面设置成功';

            exit(json_encode($this->result));

        } else {

            $this->result['state'] = '0';
            $this->result['reason'] = '封面设置失败';

            exit(json_encode($this->result));
        }

    }

}
?>