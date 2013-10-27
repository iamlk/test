<?php
class CommentController extends BaseController
{
    public $layout = '//layouts/center.mine';
    public $flag = array('selected' => null, 'select' => null);
    public $page = 9;
    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    //卖家收到的评论
    public function actionSellerComment()
    {
        if (empty(Yii::app()->user->customer_id)) {

            $this->redirect($this->createUrl('site/login'));
        }
        $this->flag['selected'] = 'seller';

        $this->flag['select'] = 'recivecomment';

        $this->params['title'] = '评论管理-我是卖家-个人中心';

        //获取住所的评论(买家评价我的商品)
        $arr_property = Property::model()->getPropertyReview(U_ID);
        //获取短期行程的评论(买家评价我的商品)
        $arr_product = Product::model()->getProductReview(U_ID);
        //合并住所评论和短期行程评论(买家评价我的商品)
        $RPL_arr = array_merge($arr_property, $arr_product);

        $dataProvider_r = new CArrayDataProvider($RPL_arr, array('pagination' => array('pageSize' =>
                    $this->page), ));

        //我对买家的评论的回复（Property）
        $propertyHF = Property::model()->getProperty_reviewHF(U_ID);


        //我对买家的评论的回复（Product）
        $productHF = Product::model()->getProductReviewHF(U_ID);

        $SPL_arr = array_merge($propertyHF, $productHF);

        $dataProvider_s = new CArrayDataProvider($SPL_arr, array('pagination' => array('pageSize' =>
                    $this->page), ));

        $this->render('seller_comment', array('comment' => $dataProvider_r, 'data' => $dataProvider_s));


    }


    //卖家接受到的评论分页
    public function actionSellerReciveCommentPage()
    {

        //获取住所的评论(买家评价我的商品)
        $arr_property = Property::model()->getPropertyReview(U_ID);
        //获取短期行程的评论(买家评价我的商品)
        $arr_product = Product::model()->getProductReview(U_ID);
        //合并住所评论和短期行程评论(买家评价我的商品)
        $RPL_arr = array_merge($arr_property, $arr_product);

        $dataProvider_r = new CArrayDataProvider($RPL_arr, array('pagination' => array('pageSize' =>
                    $this->page), ));

        $this->renderPartial('_seller_recive_comment', array('comment' => $dataProvider_r));
    }

    //卖家发送出的评论分页
    public function actionSellerSendCommentPage()
    {

        //我对买家的评论的回复（Property）
        $propertyHF = Property::model()->getProperty_reviewHF(U_ID);


        //我对买家的评论的回复（Product）
        $productHF = Product::model()->getProductReviewHF(U_ID);

        $SPL_arr = array_merge($propertyHF, $productHF);

        $dataProvider_s = new CArrayDataProvider($SPL_arr, array('pagination' => array('pageSize' =>
                    $this->page), ));

        $this->renderPartial('_seller_send_comment', array('data' => $dataProvider_s));
    }

    //区分评论
    public function actionGetReviewType($p)
    {

        if (!empty($p)) {

            $arr = explode('_', $p);

        }

        return $arr[0];

    }

    //买家评论管理
    public function actionBuyerComment()
    {

        if (empty(Yii::app()->user->customer_id)) {

            $this->redirect($this->createUrl('site/login'));
        }
        $this->flag['selected'] = 'buyer';

        $this->flag['select'] = 'sendcomment';
        $this->params['title'] = '评论管理-我是买家-个人中心';
        //获取住所的评论(自己给出的评论)
        $arr_property = Property::model()->getSendPropertyComment(U_ID);
        //获取短期行程的评论(自己给出的评论)
        $arr_product = Product::model()->getSendProductComment(U_ID);
        //合并住所评论和短期行程评论(自己给出的评论)
        $SPL_arr = array_merge($arr_property, $arr_product);
        $dataProvider_s = new CArrayDataProvider($SPL_arr, array('pagination' => array('pageSize' =>
                    $this->page, ), ));

        //买家收到的评论回复（住所）
        $buyerreciveproperty = Property::model()->getRecivePropertyComment(U_ID);
        //买家收到的评论回复（短期行程）
        $buyerreciveproduct = Product::model()->getReciveProductComment(U_ID);
        $RPL_arr = array_merge($buyerreciveproperty, $buyerreciveproduct);

        $dataProvider_r = new CArrayDataProvider($RPL_arr, array('pagination' => array('pageSize' =>
                    $this->page, ), ));

        $this->render('buyer_comment', array('comment' => $dataProvider_s, 'buyerrecive' =>
                $dataProvider_r));

    }
    //自己发出的评论分页
    public function actionBuyerGiveCommentPage()
    {

        //获取住所的评论(自己给出的评论)
        $arr_property = Property::model()->getSendPropertyComment(U_ID);
        //获取短期行程的评论(自己给出的评论)
        $arr_product = Product::model()->getSendProductComment(U_ID);
        //合并住所评论和短期行程评论(自己给出的评论)
        $PL_arr = array_merge($arr_property, $arr_product);

        //通过创建日期排序
        //  print_r($PL_arr);exit;

        $dataProvider_s = new CArrayDataProvider($PL_arr, array('pagination' => array('pageSize' =>
                    $this->page), ));

        $this->renderPartial('_buyer_send_comment', array('comment' => $dataProvider_s));
    }
    //自己接受到评论分页
    public function actionBuyerReciveCommentPage()
    {

        //买家收到的评论回复（住所）
        $buyerreciveproperty = Property::model()->getRecivePropertyComment(U_ID);
        //买家收到的评论回复（短期行程）
        $buyerreciveproduct = Product::model()->getReciveProductComment(U_ID);
        $RPL_arr = array_merge($buyerreciveproperty, $buyerreciveproduct);

        $dataProvider_r = new CArrayDataProvider($RPL_arr, array('pagination' => array('pageSize' =>
                    $this->page, ), ));
        $this->renderPartial('_buyer_recive_comment', array('buyerrecive' => $dataProvider_r));

    }


}
?>