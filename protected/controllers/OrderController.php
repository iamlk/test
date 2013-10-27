<?php

class OrderController extends BaseController
{
    public $layout = '';
    public $flag = array('selected' => null, 'select' => null);
    public $result = array('state' => null, 'reason' => null);
    public function actionIndex()
    {
        $this->render('index');
    }

    public function actionCreate()
    {
        if (!$_POST)
            return;
        $json = array();
        $basket = CustomerBasket::model()->getBasket();
        $detail = CustomerBasketDetail::model()->findAll('customer_basket_id = ' .
            intval($basket->customer_basket_id));
        if (!$basket || !$detail) {
            $json['status'] = 0;
            $json['msg'] = '您的行程单是空的！不能结算~';
        } else {
            $json['status'] = 1;
            foreach ($detail as $d) {
                if (!$d->is_deal) {
                    $json['status'] = 0;
                    $json['msg'] = '您还有商品没有设置！不能结算~';
                    break;
                }
            }
            $r = Order::model()->create($basket, $detail);
            if ($r)
                $json['url'] = $this->createUrl('order/confirm', array('oid' => $r));
            else {
                $json['status'] = 0;
                $json['msg'] = '未知错误';
            }
        }
        echo json_encode($json);
    }

    public function actionBack4Edit()
    {
        if (!$_POST)
            return;
        $order = Order::model()->findByPk(intval($_POST['oid']));
        if ($order->customer_id != Yii::app()->user->customer_id)
            return;
        $basket_id = CustomerBasket::model()->create($order);
        $detail = CustomerBasketDetail::model()->find('customer_basket_id=' . $basket_id);
        echo $detail->city_id;
    }

    public function actionCreateAddress()
    {
        if (!$_POST)
            return;
        $attribute = $_POST;
        if (Yii::app()->user->isGuest) {
            $order = Order::model()->find('visitor_key="' . session_id() . '"');
            if (!$order)
                return;
        } else {
            $model = CustomerAddressBook::model()->find('customer_id=' . Yii::app()->user->
                customer_id);
            if (!$model) {
                $model = new CustomerAddressBook;
                $model->isNewRecord = true;
            }
            $model->attributes = $attribute;
            $model->customer_id = Yii::app()->user->customer_id;
            $model->save();
            $order = Order::model()->findByPk(intval($_POST['o_id']));
            if (!$order || $order->customer_id <> Yii::app()->user->customer_id)
                return;
        }
        $order->attributes = $attribute;
        $order->save();
        echo $order->getFirstError() ? $order->getFirstError() : 'OK';
    }

    public function actionTest($oid)
    {
        //Itinerary::model()->create($oid,'这是一次踏上DOTA征途的旅程！');
    }

    public function actionConfirm($oid)
    {
        
        $this->breadcrumbs->add('首页', '/');
        $this->breadcrumbs->add('个人中心', array('center/index'));
        $this->breadcrumbs->add('我的订单');
        if (Yii::app()->user->isGuest) {
            $order = Order::model()->find('order_id = ' . intval($oid) .
                ' AND visitor_key="' . session_id() . '"');
        } else {
            $order = Order::model()->find('order_id = ' . intval($oid) . ' AND customer_id=' .
                Yii::app()->user->customer_id);
            $book = CustomerAddressBook::model()->find('customer_id=' . Yii::app()->user->
                customer_id);
            if ($order && $book && !$order->email) {
                $order->last_name = $book->last_name;
                $order->first_name = $book->first_name;
                $order->country_id = $book->country_id;
                $order->cellphone = $book->cellphone;
                $order->email = $book->email;
                $order->save();
            }
        }
        if (!$order)
            exit('This is not your business !!!');
        $this->params['title'] = '订单确认';
        $list = OrderDetail::model()->buildList($order);
        $this->render('confirm', array('order' => $order, 'list' => $list));
    }

    /**
     *  rick   add  2013-8-23  买家订单详情页面
     */
    public function actionBuyerOrderDetail()
    {
        //获取用户账户总支出
        $this->params['title'] = '我的订单-我是买家';
        if (empty(Yii::app()->user->customer_id)) {

            $this->redirect($this->createUrl('site/login'));
        }
        $this->flag['selected'] = 'buyer';

        $this->flag['select'] = 'order';

        $this->layout = '//layouts/center.mine';

        $data = Order::model()->findAllByPk($_REQUEST['id']);

        $this->render('buyer_order_detail', array('data' => $data));

    }

    /**
     *  rick   add  2013-8-23  卖家订单详情页面
     */
    public function actionSellerOrderDetail()
    {
           $this->params['title'] = '用户订单-我是卖家';
        if (empty(Yii::app()->user->customer_id)) {

            $this->redirect($this->createUrl('site/login'));
        }

        $this->flag['selected'] = 'seller';

        $this->flag['select'] = '';

        $this->layout = '//layouts/center.mine';

        $data = OrderDetail::model()->findAllByPk($_REQUEST['id']);

        $this->render('seller_order_detail', array('data' => $data));

    }

    /**
     *   RICK  买家删除订单
     */
    public function actionBuyerDeleteOrder()
    {
        if (empty(Yii::app()->user->customer_id)) {

            $this->redirect($this->createUrl('site/login'));
        }

        if (empty($_REQUEST['id'])) {


            $this->result['state'] = '0';
            $this->result['reason'] = '订单不存在';
            exit(json_encode($this->result));
        }

        $order = Order::model()->findByAttributes(array('order_id' => intval($_REQUEST['id'])));

        // var_dump($order);

        $order->ext_status = Order::ORDERHIDDEN;

        if ($order->save(false)) {

            $this->result['state'] = '1';
            $this->result['reason'] = '订单删除成功';
            exit(json_encode($this->result));
        } else {

            $this->result['state'] = '0';
            $this->result['reason'] = '订单删除失败';
            exit(json_encode($this->result));
        }

    }

    /**
     *   RICK  卖家删除订单
     */
    public function actionSellerDeleteOrder()
    {
        if (empty(Yii::app()->user->customer_id)) {

            $this->redirect($this->createUrl('site/login'));
        }

        if (empty($_REQUEST['id'])) {


            $this->result['state'] = '0';
            $this->result['reason'] = '订单不存在';
            exit(json_encode($this->result));
        }

        $OrderDetail = OrderDetail::model()->findByAttributes(array('order_detail_id' =>
                intval($_REQUEST['id'])));


        $OrderDetail->status_provider = Order::ORDERHIDDEN;

        if ($OrderDetail->save(false)) {

            $this->result['state'] = '1';
            $this->result['reason'] = '订单删除成功';
            exit(json_encode($this->result));
        } else {

            $this->result['state'] = '0';
            $this->result['reason'] = '订单删除失败';
            exit(json_encode($this->result));
        }

    }


}
