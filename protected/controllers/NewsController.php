<?php
class NewsController extends BaseController
{
    public $result = array('state' => null, 'reason' => null);

    public function actionReply()
    {
         if (empty(Yii::app()->user->customer_id)) {

             $this->result['state'] = '0';
            $this->result['reason'] = '未登录不能发表评论';

            exit(json_encode($this->result));
        }

        if (empty($_REQUEST['object_type'])) {

            $this->result['state'] = '0';
            $this->result['reason'] = '消息类型不对哦';

            exit(json_encode($this->result));
        }

        if (empty($_REQUEST['object_id'])) {

            $this->result['state'] = '0';
            $this->result['reason'] = '异常错误';

            exit(json_encode($this->result));
        }

        if (empty($_REQUEST['content'])) {

            $this->result['state'] = '0';
            $this->result['reason'] = '消息内容不能为空哦';

            exit(json_encode($this->result));
        }

        if (G4S::hasBanwords($_REQUEST['content'])) {

            $this->result['state'] = '0';
            $this->result['reason'] = '消息内容含有非法内容';

            exit(json_encode($this->result));

        }
        
        


        switch ($_REQUEST['object_type']) {


            case Dynamic::ARTICLE:
                $this->articleReply($_REQUEST);
                break;

            case Dynamic::DELICACY:
                $this->delicacyReply($_REQUEST);
                break;

            case Dynamic::RESTAURANT:
                $this->restaurantReply($_REQUEST);
                break;

            case Dynamic::ATTRACTION:
                $this->AttractionReply($_REQUEST);
                break;

            case Dynamic::ALBUMIMAGE:

                $this->albumReply($_REQUEST);
                break;
            case Dynamic::ALBUMREVIEW:

                $this->albumreviewReply($_REQUEST);
                break;

            case Dynamic::PRODUCT:

                $this->productReply($_REQUEST);
                break;

            case Dynamic::PROPERTY:

                $this->propertyReply($_REQUEST);
                break;

            default:
                $this->result['state'] = '0';
                $this->result['reason'] = '这个不能评论了';

                exit(json_encode($this->result));
                break;
        }


    }

    //攻略评论回复
    private function articleReply($arr)
    {

        $article = new ArticleReview;

        $article->parent_id = intval($arr['parent_review_id']);

        $article->article_id = $arr['object_id'];

        $article->customer_id = U_ID;

        $article->created = time();

        $article->is_active = 0;

        $article->content = G4S::convert_tags($arr['content']);

        if ($article->save(false)) {

            $this->result['state'] = '1';
            $this->result['reason'] = '回复成功';
            $this->result['content'] = $arr['content'];
            $this->result['nickname'] = Customer::model()->getUserNickName(U_ID);
            $this->result['header'] = '/thumb/32_32/' . Customer::model()->
                getUserHeaderImage(U_ID);
            $this->result['url'] = Dynamic::goUrl(U_ID, 'center');
            Dynamic::saveDynamicApi($arr['object_id'], Dynamic::ARTICLEREVIEW,
                U_ID, 4);
            exit(json_encode($this->result));


        } else {

            $this->result['state'] = '0';
            $this->result['reason'] = '回复失败';

            exit(json_encode($this->result));


        }

    }
    private function delicacyReply($arr)
    {
        $delicacy = new DelicacyReview;

        $delicacy->parent_id = $arr['parent_review_id'];

        $delicacy->delicacy_id = $arr['object_id'];

        $delicacy->customer_id = U_ID;

        $delicacy->created = time();

        $delicacy->is_active = 0;

        $delicacy->content = $arr['content'];

        if ($delicacy->save(false)) {

            $this->result['state'] = '1';
            $this->result['reason'] = '回复成功';
            $this->result['content'] = $arr['content'];
            $this->result['nickname'] = Customer::model()->getUserNickName(U_ID);
            $this->result['header'] = '/thumb/32_32/' . Customer::model()->
                getUserHeaderImage(U_ID);
            $this->result['url'] = Dynamic::goUrl(U_ID, 'center');
            Dynamic::saveDynamicApi($arr['object_id'], Dynamic::DELICACYREVIEW,
                U_ID, 4);
            exit(json_encode($this->result));


        } else {

            $this->result['state'] = '0';
            $this->result['reason'] = '回复失败';

            exit(json_encode($this->result));


        }


    }

    private function restaurantReply($arr)
    {
        $restaurant = new RestaurantReview;

        $restaurant->parent_id = $arr['parent_review_id'];

        $restaurant->restaurant_id = $arr['object_id'];

        $restaurant->customer_id = U_ID;

        $restaurant->created = time();

        $restaurant->is_active = 0;

        $restaurant->content = $arr['content'];

        if ($restaurant->save(false)) {

            $this->result['state'] = '1';
            $this->result['reason'] = '回复成功';
            $this->result['content'] = $arr['content'];
            $this->result['nickname'] = Customer::model()->getUserNickName(U_ID);
            $this->result['header'] = '/thumb/32_32/' .Customer::model()->getUserHeaderImage(U_ID);
            $this->result['url'] = Dynamic::goUrl(U_ID, 'center');
            Dynamic::saveDynamicApi($arr['object_id'], Dynamic::
                RESTAURANTREVIEW, U_ID, 4);
            exit(json_encode($this->result));


        } else {

            $this->result['state'] = '0';
            $this->result['reason'] = '回复失败';

            exit(json_encode($this->result));


        }


    }


    private function attractionReply($arr)
    {
        $attractionReview = new AttractionReview;

        $attractionReview->parent_id = $arr['parent_review_id'];

        $attractionReview->attraction_id = $arr['object_id'];

        $attractionReview->customer_id = U_ID;

        $attractionReview->created = time();

        $attractionReview->is_active = 0;

        $attractionReview->content = $arr['content'];

        if ($attractionReview->save(false)) {

            $this->result['state'] = '1';
            $this->result['reason'] = '回复成功';
            $this->result['content'] = $arr['content'];
            $this->result['nickname'] = Customer::model()->getUserNickName(U_ID);
            $this->result['header'] = '/thumb/32_32/' .Customer::model()->getUserHeaderImage(U_ID);
            $this->result['url'] = Dynamic::goUrl(U_ID, 'center');
            Dynamic::saveDynamicApi($arr['object_id'], Dynamic::
                ATTRACTIONREVIEW, U_ID, 4);
            exit(json_encode($this->result));


        } else {

            $this->result['state'] = '0';
            $this->result['reason'] = '回复失败';

            exit(json_encode($this->result));


        }


    }


    private function albumReply($arr)
    {
        $albumReview = new AlbumReview;

        $albumReview->parent_id = $arr['parent_review_id'];

        $albumReview->album_image_id = $arr['object_id'];

        $albumReview->customer_id = U_ID;

        $albumReview->created = time();

        $albumReview->is_active = 0;

        $albumReview->content = $arr['content'];

        if ($albumReview->save(false)) {

            $this->result['state'] = '1';
            $this->result['reason'] = '回复成功';
            $this->result['content'] = $arr['content'];
            $this->result['nickname'] = Customer::model()->getUserNickName(U_ID);
            $this->result['header'] = '/thumb/32_32/' .Customer::model()->getUserHeaderImage(U_ID);
            $this->result['url'] = Dynamic::goUrl(U_ID, 'center');
            Dynamic::saveDynamicApi($arr['object_id'], Dynamic::ALBUMREVIEW,
                U_ID, 4);
            exit(json_encode($this->result));


        } else {

            $this->result['state'] = '0';
            $this->result['reason'] = '回复失败';

            exit(json_encode($this->result));


        }


    }

    private function productReply($arr)
    {

        $ProductReview = new ProductReview;

        $ProductReview->parent_review_id = $arr['parent_review_id'];

        $ProductReview->product_id = $arr['object_id'];

        $ProductReview->customer_id = U_ID;

        $ProductReview->created = time();

        $ProductReview->is_active = 0;

        $ProductReview->description = $arr['content'];

        $ProductReview->name = '';

        if ($ProductReview->save(false)) {

            $this->result['state'] = '1';
            $this->result['reason'] = '回复成功';
            $this->result['content'] = $arr['content'];
            $this->result['nickname'] = Customer::model()->getUserNickName(U_ID);
            $this->result['header'] ='/thumb/32_32/' .Customer::model()->getUserHeaderImage(U_ID);
            $this->result['url'] = Dynamic::goUrl(U_ID, 'center');
            // Dynamic::saveDynamicApi($ProductReview->product_review_id, Dynamic::PRODUCTREVIEW, U_ID, 4);
            exit(json_encode($this->result));


        } else {

            $this->result['state'] = '0';
            $this->result['reason'] = '回复失败';

            exit(json_encode($this->result));


        }


    }


    private function propertyReply($arr)
    {


        $PropertyReview = new PropertyReview;

        $PropertyReview->parent_review_id = $arr['parent_review_id'];

        $PropertyReview->property_id = $arr['object_id'];

        $PropertyReview->customer_id = U_ID;

        $PropertyReview->created = time();

        $PropertyReview->is_active = 0;

        $PropertyReview->description = $arr['content'];

        $PropertyReview->name = '';

        if ($PropertyReview->save(false)) {

            $this->result['state'] = '1';
            $this->result['reason'] = '回复成功';
            $this->result['content'] = $arr['content'];
            $this->result['nickname'] = Customer::model()->getUserNickName(U_ID);
            $this->result['header'] = '/thumb/32_32/' .Customer::model()->getUserHeaderImage(U_ID);
            $this->result['url'] = Dynamic::goUrl(U_ID, 'center');
            //Dynamic::saveDynamicApi($PropertyReview->property_review_id, Dynamic::PRODUCTREVIEW, U_ID, 4);
            exit(json_encode($this->result));


        } else {

            $this->result['state'] = '0';
            $this->result['reason'] = '回复失败';

            exit(json_encode($this->result));


        }


    }

    private function albumreviewReply($arr)
    {

        $albumreview = new AlbumReview;
        $albumReview->parent_id = $arr['parent_review_id'];
        $albumreview->parent_id = 0;
        $albumreview->content = G4S::convert_tags($arr['content']);
        $albumreview->album_image_id = $arr['object_id'];
        $albumreview->customer_id = U_ID;
        $albumreview->is_active = 0;
        $albumreview->created = time();


        if ($albumreview->save(false)) {

            $this->result['state'] = '1';
            $this->result['reason'] = '评论成功';
            $this->result['content'] = $arr['content'];
            $this->result['nickname'] = Customer::model()->getUserNickName(U_ID);
            $this->result['header'] = '/thumb/32_32/' . Customer::model()->
                getUserHeaderImage(U_ID);
            $this->result['url'] = Dynamic::goUrl(U_ID, 'center');
            //调用动态
            Dynamic::saveDynamicApi($arr['object_id'], Dynamic::ALBUMREVIEW,
                U_ID, 4);
            exit(json_encode($this->result));
        } else {

            $this->result['state'] = '0';
            $this->result['reason'] = '评论失败';

            exit(json_encode($this->result));
        }


    }

}
?>