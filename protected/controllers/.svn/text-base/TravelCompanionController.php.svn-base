<?php
class TravelCompanionController extends BaseController
{
    public $layout = '//layouts/companion';
    protected $customer_id = 0;

    /**
     *
     * @return array action filters
     */
    public function filters()
    {
        return array('accessControl', // perform access control
                );
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     *
     * @return array access control rules
     */
    public function accessRules()
    {
        return array(
            array(
                'allow',
                'actions' => array('myTravelCompanion', 'create'),
                'users' => array('@'),
                ),
            array(
                'deny',
                'actions' => array('myTravelCompanion', 'create'),
                'users' => array('*'),
                ),
            );
    }

    public function actionSetExpired(){
        $id = intval($_POST['id']);
        $companion = TravelCompanion::model()->findByAttributes(array('customer_id'=>Yii::app()->user->customer_id,'travel_companion_id'=>$id));
        $companion->has_expired = (int)!$companion->has_expired;
        if($companion->save()) echo 'ok';
        else echo 'error';
    }

    public function actionMyCompanion(){
        $sms = SiteInnerSms::model()->findAllByAttributes(array('owner_id'=>Yii::app()->user->customer_id));
        $companion = TravelCompanion::model()->findAllByAttributes(array('customer_id'=>Yii::app()->user->customer_id));
        $application = TravelCompanionApplication::model()->findAllByAttributes(array('customer_id'=>Yii::app()->user->customer_id));
        $reply = TravelCompanionReply::model()->findAllByAttributes(array('customer_id'=>Yii::app()->user->customer_id));
        $this->render('my_companion',array('sms'=>$sms,'companion'=>$companion,'application'=>$application,'reply'=>$reply));
    }

	public function actionApplicationCreate() {
		if ($_POST && Yii::app()->request->isAjaxRequest && !Yii::app()->user->isGuest) {
			$tcp = new TravelCompanionApplication();
			$travel_companion_id = (int)$_POST['travel_companion_id'];
			$apply_already = $tcp->countByAttributes(array('customer_id'=>Yii::app()->user->customer_id,'travel_companion_id'=>$info->travel_companion_id)); //是否已经申请
            $tcp->attributes = $_POST;
			$travelCompanion = new TravelCompanion();
			$travelCompanion_r = $travelCompanion->findByPk($travel_companion_id);
			$is_self = ($travelCompanion_r->customer_id == Yii::app()->user->customer_id) ? true : false;
			if ($apply_already || $is_self || !$travel_companion_id) {
				// 如果当前用户已经申请过了或者当前用户是楼主自己
                echo CJSON::encode(array('status' => 1, 'errors' => '您不能再申请该结伴同游'));
				Yii::app()->end();
			}
			$tcp->verify_status = 0;
			$tcp->date_time = new CDbExpression('NOW()');
			$tcp->customer_id = Yii::app()->user->customer_id;
			$trans = Yii::app()->db->beginTransaction();
			try {
				if (!$tcp->validate()) {
					if (Yii::app()->request->isAjaxRequest) {
						echo CJSON::encode(array('status' => 1, 'errors' => $tcp->firstError));
						Yii::app()->end();
					}
				}else {
					$tcp->save(false);
					$trans->commit();
					if (false) {//给楼主发邮件
						$owner = Customer::model()->findByPk($travelCompanion_r->customer_id);
						if($owner->email) {
							$link = $this->createUrl('travelCompanion/view',array('id'=>$travel_companion_id));
							$email_text = "您发起的主题为".strip_tags($travelCompanion_r->title)."的结伴同游信息有人向你申请结伴啦，赶快登录$link查看吧。\n";
							$receiver = "{$owner->first_name}<{$travelCompanion_r->email}>";
							$subject = "四海网 结伴同游申请结伴！";
							$content = Yii::app()->mailer->loadMailContent('common',
								array(
									'receiver' => $travelCompanion_r->customer_name,
									'content' => $email_text,
								),
								'common_new');
							$this->send($receiver, $subject, $content);
						}
					}
					$msg = '您的申请已发送成功！<br />您可以登录&quot;' . CHtml::link('我的结伴同游', array('travelCompanion/myTravelCompanion')) . '&quot;查看结伴进度。';
					echo CJSON::encode(array('status' => 0));
				}
			} catch (CDbException $cdbe) {
			     print_r($cdbe);
				$trans->rollback();
			}
		}
	}

    public function actionreply_list($id)
    {
        $provider = TravelCompanionReply::model()->getProvider(array('travel_companion_id'=>$id,'parent_travel_companion_reply_id'=>1));
        $this->renderPartial('companion_reply_list_item',array('provider'=>$provider));
    }
    public function actionView($id)
    {
        $this->layout = '//layouts/companion.view';
        $model = TravelCompanion::model()->findByPk($id);
        $provider = TravelCompanionReply::model()->getProvider(array('travel_companion_id'=>$id,'parent_travel_companion_reply_id'=>1));
        $this->customer_id = $model->customer_id;
        $this->render('view',array('info'=>$model,'provider'=>$provider));
    }
    public function actionCompanion()
    {
        $provider = TravelCompanion::model()->getProvider();
        $this->renderPartial('companion_list_item',array('provider'=>$provider));
    }

    public function actionIndex()
    {
        $provider = TravelCompanion::model()->getProvider();
		$this->render('list',array('provider'=>$provider));
    }

    public function actionReply()
    {
        if(Yii::app()->user->isGuest){
            echo CJSON::encode(array('status'=>1,'message'=>'请先登录~'));
            return;
        }
        if($_POST)
        {
            $travelCompanionReply = new TravelCompanionReply;
            $travelCompanionReply->attributes = $_POST;
            $travelCompanionReply->created = $travelCompanionReply->updated = date('Y-m-d H:i:s');
            $travelCompanionReply->customer_id = Yii::app()->user->customer_id;
            if($travelCompanionReply->save()){
                echo CJSON::encode(array('status' => 0));
            }else{
                echo CJSON::encode(array('status'=>1,'message'=>$travelCompanionReply->firstError));
            }
        }
    }

    public function actionModifyContent()
    {
        if ($_POST)
        {
            $content = $_POST['content'];
            $id = (int)$_POST['id'];
            if ($id && $content)
            {
                $r = TravelCompanionReply::model()->findByPk($id);
                if ($r->customer_id == Yii::app()->user->customer_id)
                {
                    $r->updated = date('Y-m-d H:i:s');
                    $r->content = $content;
                    $r->save();
                    echo json_encode(array('status' => 0));
                    Yii::app()->end();
                }
            }
        }
        echo json_encode(array('status' => 1, 'msg' => '内容不能为空。'));
    }

    protected function performAjaxValidation($model, $id)
    {
        if (isset($_POST['ajax']) && $_POST['ajax'] == $id)
        {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    public function actionMyTravelCompanion()
    {
        $guest = (isset($_GET['customer_id']) && (int)$_GET['customer_id'])?CustomerTFF::model()->findByPk((int)$_GET['customer_id']):null; //别的访客访问时
        /* 我的信息 */
        $smsAr = new SiteInnerSms();
        $siss = SiteInnerSms::model()->findAllByAttributes(array('owner_id' => $this->authCustomer->customer_id, ), array('order' => '`read`,created desc', ));
        $sissCount = array('in' => 0, 'out' => 0);
        if ($siss)
        {
            foreach ($siss as $sis)
            {
                if ($this->authCustomer->customer_id == $sis->to_customer_id) $sissCount['in']++;
                /* 收到 */
                elseif ($this->authCustomer->customer_id == $sis->customer_id) $sissCount['out']++;
                /* 发出 */
            }
        }
        /*  我发布的结伴贴 */
        $tcs = Yii::app()->db->createCommand() //查找我发布的结伴贴
            ->from(TravelCompanion::tableName())->where('customer_id='.$this->authCustomer->customer_id)->order('created desc')->queryAll();
        $inIds = array();
        if ($tcs)
        {
            $i = count($tcs);
            while ($i--)
            {
                $inIds[] = $tcs[$i]['travel_companion_id'];
                $tcs[$i]['appnum'] = 0; //申请人数
                $tcs[$i]['connum'] = 0; //同意人数
            }
            $tcapps = Yii::app()->db->createCommand()->select('t.*,c.face')->from(TravelCompanionApplication::tableName().' t')->where('t.travel_companion_id in ('.implode(',', $inIds).')')->join(Customer::tableName().' c', 'c.customer_id=t.customer_id')->order('t.date_time desc')->queryAll(); // 找出我发布的结伴贴的所有申请
        }
        if ($tcapps)
        {
            foreach ($tcapps as $i)
            {
                $j = count($tcs);
                while ($j--)
                {
                    if ($tcs[$j]['travel_companion_id'] == $i['travel_companion_id'])
                    { // 根据id统计申请人数以及同意人数/
                        $tcs[$j]['app'][] = $i;
                        $tcs[$j]['appnum']++;
                        if ($i['verify_status'] == '1') $tcs[$j]['connum']++;
                        break;
                    }
                }
            }
        }

        $myapps = Yii::app()->db->createCommand() //查找我的申请与其所关联结伴贴信息
            ->select('c.first_name,c.customer_id,t.*,p.*')->from(TravelCompanionApplication::tableName().' t')->join(TravelCompanion::tableName().' p', 't.travel_companion_id=p.travel_companion_id')->join(Customer::tableName().' c', 'p.customer_id=c.customer_id')->where('t.customer_id='.$this->authCustomer->customer_id)->order('p.created desc')->queryAll();
        if ($myapps)
        {
            $inIds = array();
            foreach ($myapps as $i)
            {
                $inIds[] = $i['travel_companion_id']; //获取我所申请结伴贴子的id
            }
            if ($inIds)
            {
                $myapps_count = Yii::app()->db->createCommand() //查找我的申请所关联结伴贴的所有申请
                    ->select('travel_companion_id, count(*) as num')->from(TravelCompanionApplication::tableName())->where('travel_companion_id in('.implode(',', $inIds).')')->group('travel_companion_id')->order('date_time desc')->queryAll();
            }
            if ($myapps_count)
            {
                foreach ($myapps_count as $item)
                {
                    $i = count($myapps);
                    while ($i--)
                    {
                        if ($myapps[$i]['travel_companion_id'] === $item['travel_companion_id']) $myapps[$i]['appnum'] = $item['num'];
                    }
                }
            }
        }

        Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl.'/css/mycenter.css');
        Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/maxlength.js');
        //$replys_total = TravelCompanionReply::getTotal($this->authCustomer->customer_id);
        $replys = TravelCompanionReply::getReplysWithTopicName($this->authCustomer->customer_id);
        $this->render('myTravelCompanion', array(
            'customer' => $this->authCustomer,
            'guest' => $guest,
            'siss' => $siss,
            'sissCount' => $sissCount,
            'tcs' => $tcs,
            'myapps' => $myapps,
            //'page_total' => ceil($replys_total/10),
            'replys' => $replys,
            ));
    }

    public function actionCreate()
    {
        $this->layout = '';

        $travelCompanion = new TravelCompanion();
        $travelCompanion->customer_id = Yii::app()->user->customer_id;
        $travelCompanion->customer_name = Yii::app()->user->customer_name;
        $travelCompanion->email = Yii::app()->user->customer_email;

        if (isset($_POST['TravelCompanion']))
        {
            $travelCompanion->product_id = intval($_GET['product_id'])?intval($_GET['product_id']):1;
            $travelCompanion->order_id = 1;
            $travelCompanion->returning_date = '0000-00-00';
            $travelCompanion->created = $travelCompanion->updated = new CDbExpression('NOW()');

            if ($productName) $_POST['TravelCompanion']['content'] = $productName;
            $travelCompanion->attributes = $_POST['TravelCompanion'];
            // set additional attributes
            $travelCompanion->active = 1;
            if (!$travelCompanion->product_id) $travelCompanion->product_id = 1; // 未赋值则为1
            $trans = Yii::app()->db->beginTransaction();
            try
            {
                if ($travelCompanion->validate())
				{
                    $travelCompanion->save(false);
                    $script = '';
                    if ($_POST['set_top_box'] == '1' && $travelCompanion->stick_num_days && Configuration::getVal('USE_POINTS_EVDAY_FOR_TOP_TRAVEL_COMPANION'))
                    {
                        if (CustomerPoint::model()->sub_points_for_travel_companion_bbs_to_top($travelCompanion->customer_id, $travelCompanion->stick_num_days, $travelCompanion->travel_companion_id))
                        {
                            $travelCompanion->bbs_type = 2;
                            $travelCompanion->update(array('bbs_type'));
                        }
                        else
                        {
                            $tmp = $travelCompanion->stick_num_days;
                            $travelCompanion->stick_num_days = 0;
                            $travelCompanion->update(array('stick_num_days'));
                            $script = 'alert("你的积分不足以用于置顶'.$tmp.'天，本次置顶被取消！");';
                        }
                    }
                    $trans->commit();
                    $msg = '您已成功发布结伴同游帖！<br />您可以登录&quot;'.CHtml::link('我的结伴同游', array('travelCompanion/myTravelCompanion')).'&quot;查看结伴进度。';
					echo '<script type="text/javascript">';
					echo $script;
					echo 'parent.createSuccess();';
					echo '</script>';
					Yii::app()->end();
                }
            }
            catch (CDbException $cdbe)
            {
                $trans->rollback();
                echo print_r($cdbe->errorInfo);
                if (Yii::app()->request->isAjaxRequest)
                {
                    echo CJSON::encode(array(
                        'status' => 'error',
                        'message' => '对不起，我们发生了错误。请再试一次。',
                        ));
                    Yii::app()->end();
                }
                else
                {
                    Yii::app()->user->setFlash('error', '对不起，我们发生了错误。请再试一次。');
                }
            }
        }
        $this->render('pop_create', array(
            'travelCompanion' => $travelCompanion,
            'productName' => $productName,
            ));
    }

    public function actionAlbumError()
    {
        $this->render('albumError');
    }

    public function actionIndividualSpace()
    {
        if (isset($_GET['customer_id'])) $customerId = (int)$_GET['customer_id']; //被访问者的id
        elseif (isset($_GET['customers_id'])) $customerId = (int)$_GET['customers_id']; //兼容老站链接被访问者的id
        elseif (!Yii::app()->user->isGuest) $customerId = $this->authCustomer->customer_id; //否则为自己访问自己
        else
        {
            Yii::app()->user->setReturnUrl($this->createUrl('travelCompanion/individualSpace'));
            $this->redirect(Yii::app()->user->loginUrl); //访问自己未登录跳转
        }

        if ($this->authCustomer->customer_id == $customerId)	//是自己访问
        {
            $customerName = '我';
            $customer = $this->authCustomer;
            $isself = true;
        }
        else		//或别人游客访问
        {
            $customer = Customer::model()->findByPk($customerId);
			if(!$customer) {
				header("Content-type: text/html; charset=utf-8");
				die('该用户账号不存在，或已经被冻结！详情请拨4006001610');
			}
            if (!$customer->space_public)
            {
                $this->redirect('travelCompanion/albumError');
            }
            $customerName = $customer->first_name;
            $isself = false;
        }
        $extraWhere = $isself ? '' : ' and t.privacy_settings=3 and t.photo_sum>0  and p.`name`<>"" and p.status=1'; // 受访者的相册，如果是自己则没有限制条件，否则只能访问数量非空并且私有属性为3的相册
        // 查找受访者的相册
		$albums = Yii::app()->db->createCommand()
			->select('t.*,p.name as pname')
			->from(PhotoBook::tableName().' t')
			->where('t.customer_id='.$customer->customer_id.' and (t.type=1 or t.type=2)'.$extraWhere)
			->leftJoin(Photo::tableName().' p', 't.photo_book_id=p.photo_book_id')
			->order('t.type asc, t.photo_sum desc,t.photo_book_id desc')
			->group('t.photo_book_id')
			->queryAll();

        // 查找top4 相册
        $topPhotoBooks = PhotoBook::model()->with(array('customer' => array(
                'alias' => 'c',
                'joinType' => 'INNER JOIN',
                'condition' => 'c.active=1 and space_public=1',
                )))->findAll(array(
            'condition' => 't.cover<>"" and t.type=2 and t.privacy_settings=3 and t.`name` <> "" and t.photo_sum > 0',
            'order' => 't.photo_sum DESC, t.photo_book_id DESC',
            'limit' => 4,
            ));

        $table_otc = OrderTravelCompanion::model()->tableName(); // 结伴订单表名

        // 通过受访者下过的订单 找到以前所有结过伴的伙伴
        $subsql = "select order_id from $table_otc  where customer_id={$customer->customer_id}"; // 受访者的订单
        $customerTravelCompanions = Yii::app()->db->createCommand()->select('o.customer_id, count(o.customer_id) times, c.gender, c.first_name')->from($table_otc.' o')->join(Customer::tableName().' c', 'o.customer_id=c.customer_id')->where("o.order_id IN ($subsql) and o.customer_id>1 and c.active=1 and c.customer_id!={$customer->customer_id}")->group('o.customer_id')->order('times desc')->queryAll();

        // 受访者下过的订单去过的地方
        $opsql = "select o.customer_id ,op.product_departure_date, op.product_id
			from `order` as o, order_product as op
			where o.customer_id={$customer->customer_id} and o.status=100006 and op.order_id=o.order_id
			group by op.product_id";
        // 受访者付款过的结伴同游
        $tpsql = "select otc.customer_id ,op.product_departure_date, otc.product_id
			from `order` as o, `order_travel_companion` as otc, `order_product` as op
			where otc.customer_id ={$customer->customer_id} and o.status=100006 and otc.order_id=o.order_id and op.order_id=o.order_id and op.product_id=otc.product_id
			group by otc.product_id";
        // 由product_id取得产品名
        $usql = "select p.*, d.`name` from ($opsql union $tpsql) as p
		   	inner join product_description as d on d.product_id=p.product_id
			order by product_departure_date desc";
        $customerOrderProducts = Yii::app()->db->createCommand($usql)->queryAll();

        if (!$customerOrderProducts)
        {
            // get other customers order products
            $otherOrderProducts = Yii::app()->db->createCommand()->select('op.product_id, o.customer_id, op.product_departure_date,p.name')->from(Order::tableName().' o')->join(OrderProduct::tableName().' op', 'op.order_id=o.order_id')->join(ProductDescription::tableName().' p', 'op.product_id=p.product_id')->where('o.status=100006 and op.product_id!=1')->group('op.product_id')->limit(5)->queryAll();
        }

		//最新访客
		$guests = TravelCompanionGuestHistory::model()->findByAttributes(array('customer_id'=>$customerId),array('order'=>'created desc'));
        // include required css files
        Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl.'/css/mycenter.css');
        $this->render('individualSpace', array(
            //'customerPhotosCount' => $customerPhotosCount,
            'albums' => $albums,
            'topPhotoBooks' => $topPhotoBooks,
            'customerName' => $customerName,
            'customer' => $customer,
            'isself' => $isself,
            'customerTravelCompanions' => $customerTravelCompanions,
            'customerOrderProducts' => $customerOrderProducts,
            'otherOrderProducts' => $otherOrderProducts,
            ));
    }
    /**
     * agree the application
     */
    public function actionAgree()
    {
        $id = (int)$_POST['id']; //travel_companion_application_id
        $model = TravelCompanionApplication::model()->findByPk($id);
        if($model->travelCompanion->customer_id == Yii::app()->user->customer_id)
        {
            $model->verify_status = 1;
            $model->verify_status_sms = $_POST['content'];
            if($model->save()){
                echo CJSON::encode(array('status' => 0, 'verify' => 1));
                return;
            }
        }
        echo CJSON::encode(array('status' => 1, 'msg' => '操作失败，请重试。'));
    }
    /**
     * refuse the application
     */
    public function actionRefuse()
    {
        $id = (int)$_POST['id']; //travel_companion_application_id
        $model = TravelCompanionApplication::model()->findByPk($id);
        if($model->travelCompanion->customer_id == Yii::app()->user->customer_id)
        {
            $model->verify_status = 2;
            $model->verify_status_sms = $_POST['content'];
            if($model->save()){
                echo CJSON::encode(array('status' => 0, 'verify' => 2));
                return;
            }
        }
        echo CJSON::encode(array('status' => 1, 'msg' => '操作失败，请重试。'));
    }
    /**
     * cancel the application
     */
    public function actionCancel()
    {
        $id = (int)$_POST['id'];
        $model = TravelCompanionApplication::model()->findByAttributes(array('customer_id'=>Yii::app()->user->customer_id,'travel_companion_application_id'=>$id));
        //$model->verify_status
        if ($this->hasPermission($id))
        {
            $modify['verify_status'] = 0;
            if (trim($_POST['content'])) $modify['verify_status_sms'] = '0:'.Yii::app()->db->pdoInstance->quote($_POST['content']);
            $stat = Yii::app()->db->createCommand()->update(TravelCompanionApplication::tableName(), $modify, 'travel_companion_application_id='.(int)$_POST['id']);
            $result = array('status' => 0, 'verify' => 0);
        }
        else  $result = array('status' => 1, 'msg' => '操作失败，请重试。');
        echo json_encode($result);
    }
    /**
     * set the travel companion expire
     */
    public function actionSetExpire()
    {
        $status = 1;
        if (!Yii::app()->user->isGuest)
        {
            $id = (int)$_POST['id']; //travel_companion_id
            $tcr = Yii::app()->db->createCommand() //结果
                ->select('customer_id,has_expired')->from(TravelCompanion::tableName())->where('travel_companion_id='.$id)->queryRow();
            $owner_id = $tcr['customer_id'];
            $expire = (int)$tcr['has_expired']?0:1;
            if ($owner_id == $this->authCustomer->customer_id)
            {
                $stat = Yii::app()->db->createCommand()->update(TravelCompanion::tableName(), array('has_expired' => $expire), 'travel_companion_id='.$id);
                if ((int)$stat) $status = 0;
                else
                {
                    $msg = '操作失败。';
                }
            }
            $msg = '无权操作！';
        }
        $msg = '请登录后再操作。';
        echo json_encode(array('status' => $status, 'msg' => $msg));
    }
    /**
     * upload photo
     */
    public function actionAlbumUpload()
    {
        if (Yii::app()->user->isGuest) $this->redirect('/MyAccount/login');
        $albumAr = new PhotoBook();
        $this->breadcrumbs->add('我的个人中心', $this->createUrl('travelCompanion/individualSpace', array('customer_id' => $this->authCustomer->customer_id)));
        $this->breadcrumbs->add('上传照片');
        $albums = $albumAr->getAlbums($this->authCustomer->customer_id, true);
        Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl.'/css/mycenter.css');
        Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl.'/js/uploader/uploader.css');
        Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/uploader/swfobject.js', CClientScript::POS_HEAD);
        Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/js/uploader/uploader.js', CClientScript::POS_HEAD);
        $this->render('albumUpload', array(
            'customer' => $this->authCustomer,
            'albums' => $albums,
            ));
    }
    /**
     * create album
     */
    public function actionAlbumCreate()
    {
        $status = 1;
        $attr['name'] = trim($_POST['t']);
        $attr['description'] = $_POST['d'];
        if (Yii::app()->user->isGuest) $msg = '请登录。';
        if (!$attr['name']) $msg = '相册名不能为空。';
        if (!$attr['description']) $msg = '相册描述不能为空。';
        if (mb_strlen($attr['name']) > 18) $msg = '相册名过长。';
        if (mb_strlen($attr['description']) > 60) $msg = '相册描述超过限制。';
        if (!$msg)
        {
            $attr['type'] = 2;
            $attr['privacy_settings'] = 3;
            $album = new PhotoBook();
            $result = $album->createAlbum($this->authCustomer->customer_id, $attr);
            if ($result)
            {
                $status = 0;
                $msg = $this->createUrl('travelCompanion/albumUpload', array('book_id' => Yii::app()->db->getLastInsertId()));
                ;
            }
        }
        echo json_encode(array('status' => $status, 'msg' => $msg));
    }
    public function actionAlbumEdit()
    {
        $status = 1;
        $book_id = (int)$_GET['book_id'];
        if (!$book_id) $msg = '出现错误，请刷新页面重试。';
        $attr['name'] = trim($_POST['t']);
        $attr['description'] = $_POST['d'];
        if (Yii::app()->user->isGuest) $msg = '请登录。';
        if (!$attr['name']) $msg = '相册名不能为空。';
        if (!$attr['description']) $msg = '相册描述不能为空。';
        if (mb_strlen($attr['name']) > 18) $msg = '相册名过长。';
        if (mb_strlen($attr['description']) > 60) $msg = '相册描述超过限制。';
        if (!$msg)
        {
            $album = new PhotoBook();
            $result = $album->findByPk($book_id);
            if ($result->customer_id != $this->authCustomer->customer_id) $msg = '出现错误，请刷新页面重试。';
            else
            {
                $album->updateByPk($book_id, $attr);
                $status = 0;
            }
        }
        echo json_encode(array('status' => $status, 'msg' => $msg));
    }
    public function actionAlbumDelete()
    {
        $status = 1;
        $book_id = (int)$_POST['book_id'];
        if (!$book_id) $msg = '出现错误，请刷新页面重试';
        if (Yii::app()->user->isGuest) $msg = '请登录';
        if (!$msg)
        {
            $album = new PhotoBook();
            $result = $album->findByPk($book_id);
            if ($result->customer_id != $this->authCustomer->customer_id) $msg = '出现错误，请刷新页面重试';
            else
            {
                $album->deleteByPk($book_id);
                $photos = Photo::model()->findAllByAttributes(array('photo_book_id' => $book_id, 'customer_id' => $result->customer_id));
                if (count($photos) > 0)
                {
                    foreach ($photos as $p)
                    {
                        $prefix = substr($p->name, 0, -4);
                        $subdir = substr($prefix, 0, 4).'_'.substr($prefix, 4, 2);
                        $path = Yii::getPathOfAlias('webroot').'/images/photos/personal/'.$subdir.'/'.$prefix.'*';
                        @exec('rm -f '.$path);
                    }
                    Photo::model()->deleteAllByAttributes(array('photo_book_id' => $book_id, 'customer_id' => $result->customer_id));
                }
                $status = 0;
            }
        }
        echo json_encode(array('status' => $status, 'msg' => $msg));
    }
    /**
     * modify some base info
     */
    public function actionModifyInfo()
    {
        if (!Yii::app()->user->isGuest)
        {
            $post = array();
            if (isset($_POST['year']) && isset($_POST['month']) && isset($_POST['day']))
            {
                $post['dob'] = (int)$_POST['year'].'-'.(int)$_POST['month'].'-'.(int)$_POST['day'];
            }
            if (isset($_POST['dob_secret'])) $post['dob_secret'] = (int)$_POST['dob_secret'];
            if (isset($_POST['sex'])) $post['gender'] = $_POST['sex'];
            if (isset($_POST['email_secret'])) $post['email_secret'] = (int)$_POST['email_secret'];
            if (isset($_POST['phone_secret'])) $post['phone_secret'] = (int)$_POST['phone_secret'];
            $post['remark'] = $_POST['remark'];
            if (isset($_POST['space_public'])) $post['space_public'] = (int)$_POST['space_public'];
            $stat = Yii::app()->db->createCommand()->update(Customer::tableName(), $post, 'customer_id=:customer_id', array(':customer_id' => $this->authCustomer->customer_id));
            if ($stat) $status = 0;
            else
            {
                $status = 1;
                $msg = '操作失败。';
            }
        }
        else
        {
            $status = 1;
            $msg = '请登录后操作。';
        }
        echo json_encode(array('status' => $status, 'msg' => $msg));
    }


    /**
     * get my reply
     */
    public function actionGetReply()
    {
        if (!Yii::app()->user->isGuest)
        {
            $page = (int)(Yii::app()->request->getParam('page'))?:1;
            $step = (int)(Yii::app()->request->getParam('step'))?:10;
            $total = TravelCompanionReply::getTotal($this->authCustomer->customer_id);
            $replys = TravelCompanionReply::getReplysWithTopicName($this->authCustomer->customer_id, $page, $step);
            foreach ($replys as $i)
            {
                $this->renderPartial('_rep', array('data' => $i));
            }
        }
    }

    public function actionSearchReply()
    {
        if (!Yii::app()->user->isGuest)
        {
            $keyword = $_POST['keyword'];
            //$page = (int)(Yii::app()->request->getParam('page')) ?: 1 ;
            //$step = (int)(Yii::app()->request->getParam('step')) ?: 10;
            //$total = TravelCompanionReply::getTotal($this->authCustomer->customer_id);
            $replys = TravelCompanionReply::getReplysWithTopicName($this->authCustomer->customer_id, $keyword);
            $html = '';
            foreach ($replys as $i)
            {
                $html .= $this->renderPartial('_rep', array('data' => $i), true);
            }
            echo json_encode(array('status' => 0, 'html' => $html));
        }
    }

	public function actions(){
		return array(
                'captcha'=>array(
                'class'=>'CCaptchaAction',
                'backColor'=>0xFFFFFF,
                'foreColor'=>0x000000,
				'height' => 30,
				'width' => 80,
                'minLength'=>4,
                'maxLength'=>4,
				'padding'=>0,
                'transparent'=>true,
			),
		);
	}
    /**
     * audit the content which posted by client
     */
    private function audit($string)
    {
        Yii::import('application.extensions.StringFilter');
        return StringFilter::sensitiveAudit($string);
    }
}
