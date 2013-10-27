<?php
class CenterController extends BaseController
{
    // rick add
    public $layout = '//layouts/center.mine';

    public $flag = array('selected' => null, 'select' => null);

    public $classly = null;

    public $tab = null;

    public $coutry_id = null;

    public $state_id = null;

    public $result = array(
        'state' => null,
        'reason' => null,
        'email' => null);

    public $page = 5;

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */

    /** 限制操作者 **/
    public function accessRules()
    {
        return array(
            //  array('allow', 'actions' => array('detail','showPrice')),
            array('allow', 'expression' => '!$user->isGuest'),
            array('deny'),
            );
    }

    public function actionIndex()
    {
        $this->params['title'] = '个人中心';

        if (empty(Yii::app()->user->customer_id)) {

            $this->redirect($this->createUrl('site/login'));
        }
        $provider = Order::model()->getFriendOrder();

        $dynamic = Dynamic::model()->getDynamicList();

        $shortrunhot = Yii::app()->db->createCommand()->select('*')->from('itinerary')->
            limit(5)->order('share_count desc')->queryAll();

        $shortrunnew = Yii::app()->db->createCommand()->select('*')->from('itinerary')->
            limit(5)->order('itinerary_id desc')->queryAll();

        $this->render('index', array(
            'dynamic' => $dynamic,
            'provider' => $provider,
            'new' => $shortrunnew,
            'hot' => $shortrunhot,
            'flag' => $this->flag));

    }

    public function actionIndexPage()
    {

        $dynamic = Dynamic::model()->getDynamicList();

        $this->renderPartial('_dynamic_index', array('dynamic' => $dynamic));


    }

    public function actionMine()
    {
        $this->render('mine');
    }

    public function actionAlbum()
    {
        $albums = AlbumGroup::model()->findAllByAttributes(array('customer_id' => Yii::
                app()->user->getCustomer_id()));
        $this->render('album', array('albums' => $albums));
    }

    public function actionAlbums()
    {
        $albums = AlbumGroup::model()->findAllByAttributes(array('customer_id' => Yii::
                app()->user->getCustomer_id()));
        $this->render('album_group', array('albums' => $albums));
    }

    public function actionUser($id = 0)
    {

        $this->layout = '//layouts/community.introduction';
        $id = $id ? $id : Yii::app()->user->getCustomer_id();
        $info = Customer::model()->getInfoByIdOrEmail($id);
        $view = ($id == Yii::app()->user->getCustomer_id()) ? 'info_self' : 'info_other';
        $provider = Question::model()->getProvider(array('parent_type' => 'Customer',
                'parent_id' => $id));
        $this->render($view, array(
            'provider' => $provider,
            'info' => $info,
            'user_id' => $id));
    }

    public function actionPostWeibo()
    {
        if (Yii::app()->user->getIsGuest()) {
            $this->redirect($this->createUrl('site/login'));
        }
        $this->layout = '';
        Yii::app()->clientScript->reset();
        $model = new CustomerTrend;
        $content = $_POST['content'];
        $model->recordWeibo($_POST['content']);
        $this->render('weibo_item', array('_data' => $model));
    }

    public function actionTrends()
    {
        if ($_GET['action_type'] == 'all')
            $provider = CustomerTrend::model()->getProvider();
        else {
            $data = array();
            $data['action_type'] = intval($_GET['action_type']);
            $data['ext_type'] = intval($_GET['ext_type']);
            $provider = CustomerTrend::model()->getProvider($data);
        }
        $provider->getData();
        if ($provider->pagination->pageCount < $_GET['qpage'])
            return;
        $this->layout = '';
        Yii::app()->clientScript->reset();
        $this->render('weibo_item', array('provider' => $provider));
    }
    //基本信息
    public function actionBasicInfo()
    {

        if (empty(Yii::app()->user->customer_id)) {

            $this->redirect($this->createUrl('site/login'));
        }

        $this->params['title'] = '基本信息-账号管理-个人中心';

        $this->flag['selected'] = 'zhgl';

        $this->flag['select'] = 'BasicInfo';

        if (!empty($_REQUEST) && $_REQUEST['action'] == 'updateuserinfo') {

            $Customer = Customer::model()->findByPk(U_ID);
            $Customer->nick_name = $_REQUEST['nickname'];
            $Customer->real_name = $_REQUEST['realname'];
            $Customer->sex = $_REQUEST['sex'];
            $Customer->born = $_REQUEST['born'];
            $Customer->display_born = $_REQUEST['display_born'];
            $Customer->display_realname = $_REQUEST['display_realname'];
            $Customer->domain = $_REQUEST['domain'];
            $Customer->country_id = intval($_REQUEST['Customer']['country_id']);
            $Customer->state_id =  intval($_REQUEST['Customer']['state_id']);
            $Customer->city_id = intval($_REQUEST['Customer']['city_id']);
            $Customer->introduction = $_REQUEST['introduction'];

            $Customer->save(false);
     
            Yii::app()->user->setCustomer_name($_REQUEST['nickname']);

            Yii::app()->user->setFlash('tips', '基本信息保存成功');
            $userdata = Customer::model()->findByPk(U_ID);
            $this->redirect($this->createUrl('center/basicinfo'),array('model' => $userdata->attributes, 'customer' =>
                    $userdata));
        } else {
 
            $userdata = Customer::model()->findByPk(U_ID);
            $this->render('basic_info', array('model' => $userdata->attributes, 'customer' =>
                    $userdata));
        }
    }

    public function actionDynamicZone()
    {
        // 搜索参数:type=country/state/city,word=文字,?id=上级id
        $type = Yii::app()->request->getParam('act');
        $id = (int)Yii::app()->request->getParam('id');
        // 分别处理
        $arr = array();
        if ($type == 'country') {
            $arr = Property::getCountries();
        }
        if ($type == 'state') {
            $arr = Property::getStates($id);
        }
        if ($type == 'city') {
            $arr = Property::getCities($id);
        }
        // JSON
        $str = "<option value=''>请选择...</option>";

        foreach ($arr as $key => $value) {

            $str .= "<option value='" . $key . "'>" . $value . "</option>";
        }
        exit($str);
        // echo CJSON::encode($arr);
        Yii::app()->end();
    }

    //安全中心
    public function actionSecurity()
    {
        if (empty(Yii::app()->user->customer_id)) {

            $this->redirect($this->createUrl('site/login'));
        }

        $this->params['title'] = '安全中心-账号管理-个人中心';
        $this->flag['selected'] = 'zhgl';

        $this->flag['select'] = 'Security';
        //账号安全度
        $userdata = Customer::model()->findByPk(U_ID);

        $userinfo = $userdata->attributes;
        $userinfo['account_power'] = 0;
        if (!empty($userinfo['bind_email'])) {

            $userinfo['account_power'] += 5;
        }

        if (!empty($userinfo['document_num'])) {

            $userinfo['account_power'] += 2;
        }

        if (!empty($userinfo['bind_phone'])) {

            $userinfo['account_power'] += 3;
        }

        $this->render('safe_center', array('userinfo' => $userinfo));
    }


    //粗略获取用户所在的国家地区
    public function actionGetUserAddress()
    {
        $ip = $this->actionGetIP();
        $url = 'http://int.dpool.sina.com.cn/iplookup/iplookup.php?format=xml&ip=' . $ip;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_USERAGENT,
            "Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/535.1 (KHTML, like Gecko) Chrome/14.0.835.202 Safari/535.1");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $content = curl_exec($ch);
        curl_close($ch);
        $arr = explode("\t", $content);

        $str = mb_convert_encoding('中国', "gb2312", "utf-8");
        //  echo $content;exit;
        if ($content != -2) {

            if (strpos($content, $str) == true) {

                return 'ch';

            } else {

                return 'notc';
            }

        } else {

            return 'notc';
        }


        // echo  mb_detect_encoding($content);


    }
    //获取客服端真实IP
    private function actionGetIP()
    {
        return G4S::getIp();
    }
    //绑定邮箱功能
    public function actionBindEmail()
    {

        if (empty($_REQUEST['email'])) {

            $this->result['state'] = '0';
            $this->result['reason'] = '邮箱不能为空';

            exit(json_encode($this->result));
        }

        if (empty($_REQUEST['emailyzm'])) {

            $this->result['state'] = '0';
            $this->result['reason'] = '邮箱验证码不能为空';

            exit(json_encode($this->result));
        }


        if (!preg_match("/^[0-9a-zA-Z]+(?:[_-][a-z0-9-]+)*@[a-zA-Z0-9]+(?:[-.][a-zA-Z0-9]+)*.[a-zA-Z]+$/i",
            $_REQUEST['email'])) {

            $this->result['state'] = '0';
            $this->result['reason'] = '邮箱格式错误';

            exit(json_encode($this->result));
        }

        $Customer = Customer::model()->findByPk(U_ID);

        if ($Customer->attributes['emailyzm'] == $_REQUEST['emailyzm']) {

            $Customer->bind_email = $_REQUEST['email'];
            $Customer->emailyzm = '';
            $Customer->display_bind_email = $_REQUEST['display_bind_email'];
            $rs = $Customer->save(false);

            if ($rs) {

                $this->result['state'] = '1';
                $this->result['reason'] = '绑定邮箱成功';
                $this->result['email'] = $this->Datahiding($_REQUEST['email'], 'email');
                exit(json_encode($this->result));

            } else {

                $this->result['state'] = '0';
                $this->result['reason'] = '绑定邮箱失败';

                exit(json_encode($this->result));
            }

        } else {

            $this->result['state'] = '0';
            $this->result['reason'] = '邮箱验证码错误';

            exit(json_encode($this->result));
        }


    }
    //检查解绑邮箱时获取的验证码
    public function actionCheckEmailYzm()
    {

        if (empty($_REQUEST['emailyzm'])) {

            $this->result['state'] = '0';
            $this->result['reason'] = '邮箱验证码不能为空';
            exit(json_encode($this->result));
        }

        $Customer = Customer::model()->findByPk(U_ID);

        if ($_REQUEST['emailyzm'] == $Customer->attributes['emailyzm']) {

            $Customer->emailyzm = '';
            $Customer->save(false);
            $this->result['state'] = '1';
            $this->result['reason'] = '验证码验证成功';
            exit(json_encode($this->result));
        } else {

            $this->result['state'] = '0';
            $this->result['reason'] = '验证码错误';
            exit(json_encode($this->result));
        }

    }

    //发送邮箱验证码1
    public function actionSendEmailYzm_1()
    {
        $Customer = Customer::model()->findByPk(U_ID);

        $email = $Customer->attributes['bind_email'];


        if (empty($email)) {

            $this->result['state'] = '0';
            $this->result['reason'] = '邮箱不能为空';

            exit(json_encode($this->result));
        }
        if (!preg_match("/^[0-9a-zA-Z]+(?:[_-][a-z0-9-]+)*@[a-zA-Z0-9]+(?:[-.][a-zA-Z0-9]+)*.[a-zA-Z]+$/i",
            $email) && !empty($email)) {

            $this->result['state'] = '0';
            $this->result['reason'] = '邮箱格式错误';

            exit(json_encode($this->result));
        }

        $yzm = rand(100000, 999999);

        $data = array(
            'email' => $email,
            'content' => '四海若邻绑定邮箱验证码：' . $yzm,
            'title' => '邮箱绑定',
            'description' => '四海若邻邮箱绑定');

        $rs = FUN::sendEmail($data);

        if ($rs) {

            $Customer = Customer::model()->findByPk(U_ID);

            $Customer->emailyzm = $yzm;

            $rs = $Customer->save(false);

            if ($rs) {

                $this->result['state'] = '1';
                $this->result['reason'] = '验证码已发送';

                exit(json_encode($this->result));

            } else {

                $this->result['state'] = '0';
                $this->result['reason'] = '验证码发送失败';

                exit(json_encode($this->result));
            }

        } else {

            $this->result['state'] = '0';
            $this->result['reason'] = '验证码发送失败';

            exit(json_encode($this->result));
        }


    }

    //发送邮箱验证码2
    public function actionSendEmailYzm_2()
    {
        $Customer = Customer::model()->findByPk(U_ID);

        $email = $_REQUEST['email'];


        if (empty($email)) {

            $this->result['state'] = '0';
            $this->result['reason'] = '邮箱不能为空';

            exit(json_encode($this->result));
        }
        if (!preg_match("/^[0-9a-zA-Z]+(?:[_-][a-z0-9-]+)*@[a-zA-Z0-9]+(?:[-.][a-zA-Z0-9]+)*.[a-zA-Z]+$/i",
            $email) && !empty($email)) {

            $this->result['state'] = '0';
            $this->result['reason'] = '邮箱格式错误';

            exit(json_encode($this->result));
        }

        $yzm = rand(100000, 999999);

        $data = array(
            'email' => $email,
            'content' => '四海若邻绑定邮箱验证码：' . $yzm,
            'title' => '邮箱绑定',
            'description' => '四海若邻邮箱绑定');

        $rs = FUN::sendEmail($data);

        if ($rs) {

            $Customer = Customer::model()->findByPk(U_ID);

            $Customer->emailyzm = $yzm;

            $rs = $Customer->save(false);

            if ($rs) {

                $this->result['state'] = '1';
                $this->result['reason'] = '验证码已发送';

                exit(json_encode($this->result));

            } else {

                $this->result['state'] = '0';
                $this->result['reason'] = '验证码发送失败';

                exit(json_encode($this->result));
            }

        } else {

            $this->result['state'] = '0';
            $this->result['reason'] = '验证码发送失败';

            exit(json_encode($this->result));
        }


    }


    //修改密码
    public function actionSetPwd()
    {

        if (strlen($_REQUEST['newp']) < 6 && strlen($_REQUEST['new_pwd_repeat']) < 6) {

            $this->result['state'] = '0';
            $this->result['reason'] = '密码长度太短';

            exit(json_encode($this->result));
        }

        if ($_REQUEST['newp'] != $_REQUEST['new_pwd_repeat']) {

            $this->result['state'] = '0';
            $this->result['reason'] = '两次密码输入不一致';

            exit(json_encode($this->result));
        }

        $customer = Yii::app()->db->createCommand()->select('*')->from('customer')->
            where('customer_id=:id', array(':id' => U_ID))->queryAll();

        if (md5($_REQUEST['old_pwd']) == $customer[0]['password']) {

            //修改密码操作

            $Customer = Customer::model()->findByPk(U_ID);
            $Customer->passwordpower = Customer::PassWordPower($_REQUEST['newp']);
            $Customer->password = md5($_REQUEST['newp']);
            $Customer->realpassword = $_REQUEST['newp'];
            $rs = $Customer->save(false);
            if ($rs) {

                $this->result['state'] = '1';
                $this->result['reason'] = '密码修改成功';

                exit(json_encode($this->result));
            } else {

                $this->result['state'] = '0';
                $this->result['reason'] = '密码修改失败';

                exit(json_encode($this->result));
            }

        } else {


            $this->result['state'] = '0';
            $this->result['reason'] = '旧密码输入错误';

            exit(json_encode($this->result));

        }


    }

    //修改证件
    public function actionSetIdentityCard()
    {


        if (empty($_REQUEST['realname'])) {

            $this->result['state'] = '0';
            $this->result['reason'] = '真实姓名不能为空';

            exit(json_encode($this->result));
        }

        if (empty($_REQUEST['cardnums'])) {

            $this->result['state'] = '0';
            $this->result['reason'] = '证件号码不能为空';

            exit(json_encode($this->result));
        }
        if (empty($_REQUEST['cardtype'])) {

            $this->result['state'] = '0';
            $this->result['reason'] = '证件类型不能为空';

            exit(json_encode($this->result));
        }
        /*
        if (empty($_REQUEST['webpwd'])) {

        $this->result['state'] = '0';
        $this->result['reason'] = '网站密码不能为空';

        exit(json_encode($this->result));
        }*/
        if ($_REQUEST['cardtype'] == '身份证') {

            if (!preg_match("/^[1-9]\d{5}[1-9]\d{3}((0\d)|(1[0-2]))(([0|1|2]\d)|3[0-1])\d{3}(\d|x|X)$/",
                $_REQUEST['cardnums'])) {

                $this->result['state'] = '0';
                $this->result['reason'] = '证件号码错误';

                exit(json_encode($this->result));
            }
        }

        $Customer = Customer::model()->findByPk(U_ID);
        $Customer->real_name = $_REQUEST['realname'];
        $Customer->document_num = $_REQUEST['cardnums'];
        $Customer->document_type = $_REQUEST['cardtype'];
        $Customer->weblogin_pwd = $_REQUEST['webpwd'];
        $rs = $Customer->save(false);
        if ($rs) {

            $this->result['state'] = '1';
            $this->result['reason'] = '证件信息保存成功';

            exit(json_encode($this->result));
        } else {

            $this->result['state'] = '0';
            $this->result['reason'] = '证件信息保存失败';

            exit(json_encode($this->result));
        }

    }
    //绑定手机操作
    public function actionBindPhone()
    {


        if (empty($_REQUEST['phonenum'])) {

            $this->result['state'] = '0';
            $this->result['reason'] = '手机号码不能为空';

            exit(json_encode($this->result));
        }

        if (empty($_REQUEST['phoneyzm'])) {

            $this->result['state'] = '0';
            $this->result['reason'] = '手机验证码不能为空';

            exit(json_encode($this->result));
        }

        if (!preg_match_all("/13[123569]{1}\d{8}|15[1235689]\d{8}|18[123456789]\d{8}/",
            $_REQUEST['phonenum'], $array)) {

            $this->result['state'] = '0';
            $this->result['reason'] = '手机号码错误';

            exit(json_encode($this->result));
        }

        $Customer = Customer::model()->findByPk(U_ID);

        if ((time() - $Customer->attributes['tempyzmtime']) > 30 * 60) {

            $this->result['state'] = '0';
            $this->result['reason'] = '验证码已失效';
            exit(json_encode($this->result));

        }

        if ($Customer->attributes['tempyzm'] == $_REQUEST['phoneyzm']) {

            $Customer->bind_phone = $_REQUEST['phonenum'];
            $Customer->display_bind_phone = $_REQUEST['display_bind_phone'];
            $Customer->tempyzm = '';
            $rs = $Customer->save(false);

            if ($rs) {

                $this->result['state'] = '1';
                $this->result['reason'] = '手机绑定成功';
                $this->result['phone'] = $this->Datahiding($_REQUEST['phonenum'], 'phone');
                exit(json_encode($this->result));

            } else {

                $this->result['state'] = '0';
                $this->result['reason'] = '手机绑定失败';

                exit(json_encode($this->result));
            }

        } else {

            $this->result['state'] = '0';
            $this->result['reason'] = '手机验证码错误';

            exit(json_encode($this->result));
        }


    }
    //检查更换手机号码时获取的验证码
    public function actionCheckPhoneYzm()
    {

        if (empty($_REQUEST['phoneyzm'])) {

            $this->result['state'] = '0';
            $this->result['reason'] = '手机验证码不能为空';
            exit(json_encode($this->result));
        }

        $Customer = Customer::model()->findByPk(U_ID);


        if ((time() - $Customer->attributes['tempyzmtime']) > 30 * 60) {

            $this->result['state'] = '0';
            $this->result['reason'] = '验证码已失效';
            exit(json_encode($this->result));

        }

        if ($_REQUEST['phoneyzm'] == $Customer->attributes['tempyzm']) {

            $Customer->tempyzm = '';

            $Customer->save(false);

            $this->result['state'] = '1';
            $this->result['reason'] = '验证码验证成功';
            exit(json_encode($this->result));
        } else {

            $this->result['state'] = '0';
            $this->result['reason'] = '验证码错误';
            exit(json_encode($this->result));
        }

    }


    //手机短信发送1
    public function actionSendPhoneNums_1()
    {
        $Customer = Customer::model()->findByPk(U_ID);

        $phonenum = $Customer->attributes['bind_phone'];

        if (empty($phonenum)) {

            $this->result['state'] = '0';
            $this->result['reason'] = '电话号码不能为空';

            exit(json_encode($this->result));
        }

        if (!empty($phonenum)) {


            $n = preg_match_all("/13[123569]{1}\d{8}|15[1235689]\d{8}|18[123456789]\d{8}/",
                $phonenum, $array);

            if ($n) {
                FUN::actionSendPhonenumsLimit(); //短信发送限制
                $yzm = rand(100000, 999999);
                //保存验证码到数据库
                $data = array('mobiles' => $phonenum, 'content' => '四海若邻绑定手机验证码:' . $yzm .
                        '(验证码30分钟内有效)');

                $rs = FUN::sendPhoneMessage($data);
                if ($rs) {
                    $Customer = Customer::model()->findByPk(U_ID);

                    $Customer->tempyzm = $yzm;

                    $Customer->tempyzmtime = time();

                    $rs = $Customer->save(false);

                    if ($rs) {

                        $this->result['state'] = '1';
                        $this->result['reason'] = '手机验证码发送成功';

                        exit(json_encode($this->result));
                    } else {

                        $this->result['state'] = '0';
                        $this->result['reason'] = '手机验证码发送无效';

                        exit(json_encode($this->result));
                    }
                } else {

                    $this->result['state'] = '0';
                    $this->result['reason'] = '获取手机验证码失败';

                    exit(json_encode($this->result));
                }
            } else {

                $this->result['state'] = '0';
                $this->result['reason'] = '手机号码错误';

                exit(json_encode($this->result));
            }

        } else {

            $this->result['state'] = '0';
            $this->result['reason'] = '手机号码不能为空';
            exit(json_encode($this->result));
        }
    }
    //发送手机短信消息2
    public function actionSendPhoneNums_2()
    {
        $Customer = Customer::model()->findByPk(U_ID);

        $phonenum = $_REQUEST['phonenum'];

        if (empty($phonenum)) {

            $this->result['state'] = '0';
            $this->result['reason'] = '电话号码不能为空';

            exit(json_encode($this->result));
        }

        if (!empty($phonenum)) {


            $n = preg_match_all("/13[123569]{1}\d{8}|15[1235689]\d{8}|18[123456789]\d{8}/",
                $phonenum, $array);

            if ($n) {
                FUN::actionSendPhonenumsLimit(); //短信发送限制
                $yzm = rand(100000, 999999);
                //保存验证码到数据库
                $data = array('mobiles' => $phonenum, 'content' => '四海若邻绑定手机验证码:' . $yzm .
                        '(验证码30分钟内有效)');

                $rs = FUN::sendPhoneMessage($data);
                if ($rs) {
                    $Customer = Customer::model()->findByPk(U_ID);

                    $Customer->tempyzm = $yzm;

                    $Customer->tempyzmtime = time();

                    $rs = $Customer->save(false);
                    if ($rs) {

                        $this->result['state'] = '1';
                        $this->result['reason'] = '手机验证码发送成功';

                        exit(json_encode($this->result));
                    } else {

                        $this->result['state'] = '0';
                        $this->result['reason'] = '手机验证码发送无效';

                        exit(json_encode($this->result));
                    }

                } else {

                    $this->result['state'] = '0';
                    $this->result['reason'] = '获取手机验证码失败';

                    exit(json_encode($this->result));
                }

            } else {

                $this->result['state'] = '0';
                $this->result['reason'] = '手机号码错误';

                exit(json_encode($this->result));
            }

        } else {

            $this->result['state'] = '0';
            $this->result['reason'] = '手机号码不能为空';

            exit(json_encode($this->result));
        }
    }

    //第三方绑定
    public function actionThirdParty()
    {

        $this->render('third_party');

    }

    //我的积分
    public function actionMyIntegral()
    {

        $this->render('my_integral');

    }
    //消息管理
    public function actionMsgManager()
    {
        if (empty(Yii::app()->user->customer_id)) {

            $this->redirect($this->createUrl('site/login'));
        }
        $this->params['title'] = '消息管理-账号管理-个人中心';

        $this->flag['selected'] = 'zhgl';

        $this->flag['select'] = 'MsgManager';
        
        $this->classly=isset($_REQUEST['class'])?$_REQUEST['class']:'HF';
        //系统消息数组
        /*
        $sysmsg = Yii::app()->db->createCommand()->select('*')->from('site_inner_sms')->
        where('customer_id=:id and to_customer_id=:tid and to_customer_status =:sid',
        array(
        ':id' => 1,
        ':tid' => U_ID,
        ':sid' => 0))->queryAll();

        $sysmsg = new CArrayDataProvider($sysmsg, array(
        'sort' => array(
        'attributes' => array('created'),
        'defaultOrder' => array('created' => true),
        ),
        'pagination' => array('pageSize' => $this->page),
        ));
        */
        //站内信消息数组
        $sms = SiteInnerSmsUser::model()->getUserAllSms(U_ID, $this->page);

        //获取用户的消息回复(发送的)
        $article_arr_s = ArticleReview::model()->getArticleReview(U_ID);
        //获取用户的消息回复(发送的)
        $delicacy_arr_s = DelicacyReview::model()->getDelicacyReview(U_ID);
        //餐厅回复(发送的)
        $restaurant_arr_s = RestaurantReview::model()->getRestaurantReview(U_ID);
        //景点回复(发送的)
        $attraction_arr_s = AttractionReview::model()->getAttractionReview(U_ID);
        //图片的回复
        $albumimage_arr_s = AlbumReview::model()->getAlbumImageReviewSend(U_ID);
        $data_s = array_merge($article_arr_s, $delicacy_arr_s, $restaurant_arr_s, $attraction_arr_s,
            $albumimage_arr_s);

        $dataProvider_s = new CArrayDataProvider($data_s, array(
            'sort' => array(

                'attributes' => array('created'),
                'defaultOrder' => array('created' => true),

                ),

            'pagination' => array('pageSize' => $this->page),
            ));

        //用户的攻略回复
        $article_arr_r = ArticleReview::model()->getArticleReviewRecive(U_ID);
        //用户的相册图片回复
        $album_arr_r = AlbumReview::model()->getAllAlbumImageReviewFormUser(U_ID);
        //获取用户的消息回复(接收到的)
        // $delicacy_arr_r = DelicacyReview::model()->getDelicacyReviewRecive(U_ID);

        //获取用户的消息回复(接收到的)
        // $restaurant_arr_r = RestaurantReview::model()->getRestaurantReviewRecive(U_ID);

        $data_r = array_merge($article_arr_r, $album_arr_r);

        $dataProvider_r = new CArrayDataProvider($data_r, array(
            'sort' => array(

                'attributes' => array('created'),
                'defaultOrder' => array('created' => true),

                ),

            'pagination' => array('pageSize' => $this->page),
            ));

        //    print_r($dataProvider_r);exit;

        $this->render('msg_manager', array(
            // 'sysmsg' => $sysmsg,
            'send' => $dataProvider_s,
            'recive' => $dataProvider_r,
            'sms' => $sms));
    }

    //系统消息分页
    public function actionSysmsgPage()
    {

        //站内信消息数组
        $sysmsg = Yii::app()->db->createCommand()->select('*')->from('site_inner_sms')->
            where('customer_id=:id and to_customer_id=:tid and to_customer_status =:sid',
            array(
            ':id' => 1,
            ':tid' => U_ID,
            ':sid' => 0))->queryAll();
        $sysmsg = new CArrayDataProvider($sysmsg, array(
            'sort' => array(
                'attributes' => array('created'),
                'defaultOrder' => array('created' => true),
                ),
            'pagination' => array('pageSize' => $this->page),
            ));
        $this->renderPartial('sys_msg', array('sysmsg' => $sysmsg));
    }

    //站内信分页
    public function actionStationPage()
    {

        //站内信消息数组
        $sms = SiteInnerSmsUser::model()->getUserAllSms(U_ID, $this->page);
        $this->renderPartial('station_msg', array('sms' => $sms));
    }


    //发出的消息分页

    public function actionSendReplyPage()
    {
        if (empty(Yii::app()->user->customer_id)) {

            $this->redirect($this->createUrl('site/login'));
        }
        //获取用户的消息回复(发送的)
        $article_arr_s = ArticleReview::model()->getArticleReview(U_ID);
        //获取用户的消息回复(发送的)
        $delicacy_arr_s = DelicacyReview::model()->getDelicacyReview(U_ID);
        //餐厅回复(发送的)
        $restaurant_arr_s = RestaurantReview::model()->getRestaurantReview(U_ID);
        //景点回复(发送的)
        $attraction_arr_s = AttractionReview::model()->getAttractionReview(U_ID);
        //图片的回复
        $albumimage_arr_s = AlbumReview::model()->getAlbumImageReviewSend(U_ID);
        $data_s = array_merge($article_arr_s, $delicacy_arr_s, $restaurant_arr_s, $attraction_arr_s,
            $albumimage_arr_s);

        $dataProvider_s = new CArrayDataProvider($data_s, array(
            'sort' => array(

                'attributes' => array('created'),
                'defaultOrder' => array('created' => true),

                ),

            'pagination' => array('pageSize' => $this->page),
            ));

        $this->renderPartial('send_reply', array('send' => $dataProvider_s));
    }


    public function actionReciveReplyPage()
    {
        //用户的攻略回复
        $article_arr_r = ArticleReview::model()->getArticleReviewRecive(U_ID);
        //用户的相册图片回复
        $album_arr_r = AlbumReview::model()->getAllAlbumImageReviewFormUser(U_ID);
        //获取用户的消息回复(接收到的)
        // $delicacy_arr_r = DelicacyReview::model()->getDelicacyReviewRecive(U_ID);

        //获取用户的消息回复(接收到的)
        // $restaurant_arr_r = RestaurantReview::model()->getRestaurantReviewRecive(U_ID);

        $data_r = array_merge($article_arr_r, $album_arr_r);

        $dataProvider_r = new CArrayDataProvider($data_r, array(
            'sort' => array(

                'attributes' => array('created'),
                'defaultOrder' => array('created' => true),

                ),

            'pagination' => array('pageSize' => $this->page),
            ));

        $this->renderPartial('recive_reply', array('recive' => $dataProvider_r));
    }
    //消息删除功能
    public function actionDeleteMessage()
    {

        FUN::msgDelete(intval($_REQUEST['id']), $_REQUEST['type']);

    }


    //区分评论
    public function actionGetReviewType($p)
    {

        if (!empty($p)) {

            $arr = explode('_', $p);

        }

        return $arr[0];

    }
    //买家首页
    public function actionBuyerIndex()
    {
        if (empty(Yii::app()->user->customer_id)) {

            $this->redirect($this->createUrl('site/login'));
        }
        $this->params['title'] = '我的订单-我是买家-个人中心';
        $this->flag['selected'] = 'buyer';

        $this->flag['select'] = 'order';

        $this->classly = !isset($_REQUEST['classly']) ? 'all' : $_REQUEST['classly'];

        $order = Order::model()->getAllBuyerOrder(U_ID, $this->page, null, $this->
            classly);


        $this->render('buyer_order', array('data' => $order));

    }
    //买家订单分页
    public function actionbuyerorderpage()
    {
        $this->classly = !isset($_REQUEST['classly']) ? 'all' : $_REQUEST['classly'];
        $order = Order::model()->getAllBuyerOrder(U_ID, $this->page, null, $this->
            classly);

        $this->renderPartial('_buyer_order_list', array('data' => $order));
    }

    //卖家首页
    public function actionSellerIndex()
    {
        if (empty(Yii::app()->user->customer_id)) {

            $this->redirect($this->createUrl('site/login'));
        }
        $this->params['title'] = '我是卖家-个人中心';
        $this->flag['selected'] = 'seller';
        $data = Customer::model()->findByPk(U_ID);
        $bankcard = Yii::app()->db->createCommand()->select('*')->from('bank_card')->
            where('customer_id=:id', array(':id' => U_ID))->queryRow();

        $this->render('seller_index', array('data' => $data->attributes, 'bankinfo' => $bankcard));

    }
    //添加银行卡号
    public function actionAddSellerCardNum()
    {
        $this->flag['selected'] = 'seller';

        if (empty(Yii::app()->user->customer_id)) {
            // Yii::app()->user->setFlash('errortips', '参数异常');
            $this->redirect($this->createUrl('site/login'));

        }


        if ($_REQUEST['action'] == 'addcard') {

            if (empty($_REQUEST['bank_name'])) {

                Yii::app()->user->setFlash('errortips', '银行名称不能为空');
                $this->redirect($this->createUrl('center/addsellercardnum'));

            }
            if (empty($_REQUEST['bank_address'])) {


                Yii::app()->user->setFlash('errortips', '开户行支行地址不能为空');

                $this->render('add_card', array('data' => $_REQUEST));
                exit;
            }

            if (empty($_REQUEST['banknumber'])) {

                Yii::app()->user->setFlash('errortips', '银行卡号不能为空');

                $this->render('add_card', array('data' => $_REQUEST));
                exit;
            }

            if (empty($_REQUEST['rebanknumber'])) {

                Yii::app()->user->setFlash('errortips', '银行卡确认不能为空');

                $this->render('add_card', array('data' => $_REQUEST));
                exit;
            }

            if (empty($_REQUEST['banker'])) {

                Yii::app()->user->setFlash('errortips', '银行卡开户姓名不能为空');

                $this->render('add_card', array('data' => $_REQUEST));
                exit;
            }

            if ($_REQUEST['rebanknumber'] != $_REQUEST['banknumber']) {

                Yii::app()->user->setFlash('errortips', '两次银行卡输入不一致');

                $this->render('add_card', array('data' => $_REQUEST));
                exit;
            }

            $data = Yii::app()->db->createCommand()->select('count(bankcard_id) as num')->
                from('bank_card')->where('customer_id=:id', array(':id' => U_ID))->queryRow();


            if ($data['num'] == 0) {

                $Bankcard = new BankCard;

            } else {

                $Bankcard = BankCard::model()->findByAttributes(array('customer_id' => U_ID));
            }

            $Bankcard->customer_id = U_ID;
            $Bankcard->bank_name = $_REQUEST['bank_name'];
            $Bankcard->bank_address = $_REQUEST['bank_address'];
            $Bankcard->banknumber = $_REQUEST['banknumber'];
            $Bankcard->banker = $_REQUEST['banker'];
            $Bankcard->created = time();

            if ($Bankcard->save(false)) {

                Yii::app()->user->setFlash('oktips', '银行卡保存成功');
                $this->redirect($this->createUrl('center/sellerindex'));

            } else {

                Yii::app()->user->setFlash('errortips', '银行卡保存失败');

                $this->render('add_card', array('data' => $_REQUEST));
                exit;
            }

        } else {

            if (empty(Yii::app()->user->customer_id)) {

                $this->redirect($this->createUrl('site/login'));
            }

            $data = BankCard::model()->findByAttributes(array('customer_id' => U_ID));

            $this->render('add_card', array('data' => $data->attributes));

        }


    }

    //卖家短期行程

    public function actionShortRun()
    {

        if (empty(Yii::app()->user->customer_id)) {

            $this->redirect($this->createUrl('site/login'));
        }
        $this->params['title'] = '我的短期行程-我是卖家-个人中心';
        $ordertype = 1; //住所

        $this->flag['selected'] = 'seller';

        $this->flag['select'] = 'sellershortrun';

        $_SESSION['state'] = !isset($_REQUEST['classly']) ? 'all' : $_REQUEST['classly'];

        $provider = Goods::model()->getAllShortRun(U_ID, $_SESSION['state'], $this->
            page);
        if ($_GET['action'] === 'search') {

            $order_data = Order::model()->searchOrders($_REQUEST, $ordertype, U_ID, $this->
                page);
            $this->tab = 'myorder';
        } else {

            //我卖出的住所
            $order_data = Order::model()->getAllSellerOrder(U_ID, $this->page, $ordertype);
            if ($_REQUEST['tab'] == 'myorder') {

                $this->tab = 'myorder';
            } else {

                $this->tab = 'mygoods';
            }

        }

        $this->render('short_run', array(
            'model' => $provider,
            'h_order' => $order_data,
            'data' => $_REQUEST));

    }
    //卖家短期行程分页
    public function actionCompanionShort()
    {
        $_SESSION['state'] = !isset($_REQUEST['classly']) ? 'all' : $_REQUEST['classly'];

        // $provider = Goods::model()->getProviderShort(Yii::app()->user->customer_id,$_SESSION['state']);
        $provider = Goods::model()->getAllShortRun(U_ID, $_SESSION['state'], $this->
            page);

        $this->renderPartial('short_run_list', array('model' => $provider));
    }

    //已卖出的短期行程分页
    public function actionCompanionShortRunOrder()
    {

        $ordertype = 1; //住所
        if ($_REQUEST['action'] === 'search') {

            $order_data = Order::model()->searchOrders($_REQUEST, $ordertype, U_ID, $this->
                page);
        } else {

            //我卖出的住所
            $order_data = Order::model()->getAllSellerOrder(U_ID, $this->page, $ordertype);
        }
        $this->renderPartial('sell_short_run_list', array('h_order' => $order_data,
                'data' => $_REQUEST));
    }
    //卖家住所
    public function actionHouse()
    {
        if (empty(Yii::app()->user->customer_id)) {

            $this->redirect($this->createUrl('site/login'));
        }


        $this->flag['selected'] = 'seller';

        $this->flag['select'] = 'sellerhouse';

        $this->params['title'] = '我的住所-我是卖家-个人中心';
        //我发布的住所
        $_SESSION['state'] = !isset($_REQUEST['classly']) ? 'all' : $_REQUEST['classly'];

        $provider = Goods::model()->getAllHouse(U_ID, $_SESSION['state'], $this->page);
        $ordertype = 2; //住所
        //我卖出的住所

        if ($_GET['action'] === 'search') {

            $order_data = Order::model()->searchOrders($_REQUEST, $ordertype, U_ID, $this->
                page);
            $this->tab = 'myorder';
        } else {

            //我卖出的住所
            $order_data = Order::model()->getAllSellerOrder(U_ID, $this->page, $ordertype);
            if ($_REQUEST['tab'] == 'myorder') {

                $this->tab = 'myorder';

            } else {

                $this->tab = 'mygoods';

            }

        }
        $this->render('house', array(
            'model' => $provider,
            'h_order' => $order_data,
            'data' => $_REQUEST));

    }
    //卖家住所分页
    public function actionCompanionHouse()
    {

        $_SESSION['state'] = !isset($_REQUEST['classly']) ? 'all' : $_REQUEST['classly'];
        $provider = Goods::model()->getAllHouse(U_ID, $_SESSION['state'], $this->page);
        $this->renderPartial('house_list', array('model' => $provider));
    }

    //已租出的住所分页
    public function actionCompanionHouseOrder()
    {
        $ordertype = 2; //住所
        if ($_GET['action'] === 'search') {

            $order_data = Order::model()->searchOrders($_REQUEST, $ordertype, U_ID, $this->
                page);
            $this->tab = 'myorder';
        } else {

            //我卖出的住所
            $order_data = Order::model()->getAllSellerOrder(U_ID, $this->page, $ordertype);
            $this->tab = 'mygoods';
        }
        $order_data = Order::model()->getAllSellerOrder(U_ID, $this->page, $ordertype);
        $this->renderPartial('house_order_list', array('h_order' => $order_data, 'data' =>
                $_REQUEST));
    }


    //设置商品上下架入口（不区分种类）
    public function actionGoodsState()
    {

        if (isset($_REQUEST['g_id'])) {

            $goodsdata = Goods::model()->findByPk(intval($_REQUEST['g_id']));

            if ($goodsdata->attributes['goods_id']) {


                if (intval($goodsdata->attributes['is_active']) === 0) {

                    $rs = $this->actionSetGoodsState($goodsdata->attributes['goods_id'], 1);

                    if ($rs) {

                        $this->result['state'] = '1';
                        $this->result['reason'] = '修改成功';

                        exit(json_encode($this->result));
                    } else {

                        $this->result['state'] = '0';
                        $this->result['reason'] = '修改失败';

                        exit(json_encode($this->result));
                    }
                }

                if (intval($goodsdata->attributes['is_active']) === 1) {

                    $rs = $this->actionSetGoodsState($goodsdata->attributes['goods_id'], 0);
                    if ($rs) {

                        $this->result['state'] = '1';
                        $this->result['reason'] = '修改成功';

                        exit(json_encode($this->result));
                    } else {

                        $this->result['state'] = '0';
                        $this->result['reason'] = '修改失败';

                        exit(json_encode($this->result));
                    }
                }

            }


        }

        if (intval($goodsdata->attributes['entity_type']) === 1) {

            echo '<script>window.location.href="http://' . $_SERVER['SERVER_NAME'] .
                '/center/shortrun"</script>';
        }


        if (intval($goodsdata->attributes['entity_type']) === 2) {

            //   $this-> actionHouse();
            echo '<script>window.location.href="http://' . $_SERVER['SERVER_NAME'] .
                '/center/house"</script>';
        }


    }
    //修改GOODS状态参数
    public function actionSetGoodsState($g_id, $state)
    {

        $Customer = Goods::model()->findByPk(intval($g_id));

        $Customer->is_active = $state;

        return $Customer->save(false);

    }

    //上传文件临时存放
    public function actionSaveTempImage()
    {

        if (empty(Yii::app()->user->customer_id)) {

            $this->result['state'] = '0';
            $this->result['reason'] = '未登录不能上传头像';
            exit(json_encode($this->result));
        }

        if (!empty($_FILES['pic'])) {

            $imageinfo = getimagesize($_FILES['pic']['tmp_name']);

            $filetype = explode('/', $imageinfo['mime']);

            $imagepostfix = $filetype[1] == 'jpeg' ? 'jpg' : $filetype[1];

            if ($filetype[1] == 'png' || $filetype[1] == 'jpeg' || $filetype[1] == 'gif') {

                $json_arr = array();
                $json_arr['code'] = 1;
                $json_arr['message'] = 'ok';
                $json_arr['width'] = $imageinfo[0];
                $json_arr['height'] = $imageinfo[1];
                //限制图片大小
                /*
                if ($json_arr['width'] < 160 || $json_arr['height'] < 160) {

                $this->result['state'] = '0';
                $this->result['reason'] = '图片尺寸不合适，请更换图片';
                exit(json_encode($this->result));
                }*/

                //图片格式正确，允许临时保存

                $images = './assets/temp/user_' . U_ID . time() . '.' . $imagepostfix;

                $rs = move_uploaded_file($_FILES['pic']['tmp_name'], $images);

                if ($rs) {

                    $json_arr['src'] = '.' . $images;
                    $_SESSION['tempImgUrl'] = $images;

                    exit(json_encode($json_arr));

                } else {

                    $this->result['state'] = '0';
                    $this->result['reason'] = '保存图片失败';
                    exit(json_encode($this->result));

                }

            } else {

                $this->result['state'] = '0';
                $this->result['reason'] = '图片类型错误';
                exit(json_encode($this->result));
            }


        } else {

            $this->result['state'] = '0';
            $this->result['reason'] = '临时图片保存失败';
            exit(json_encode($this->result));

        }

    }
    //头像上传页面显示
    public function actionUpdateHeader()
    {
        if (empty(Yii::app()->user->customer_id)) {

            $this->redirect($this->createUrl('site/login'));
        }
        $this->params['title'] = '修改头像-账号管理-个人中心';

        $user = Customer::model()->findByPk(U_ID);

        $this->flag['selected'] = 'zhgl';

        $this->flag['select'] = 'UpdateHeader';

        $this->render('update_headerimage', array('user' => $user));
    }

    //上传头像裁剪
    public function actionCrop()
    {

        if (empty($_REQUEST['w']) && empty($_REQUEST['h']) && empty($_REQUEST['x']) &&
            empty($_REQUEST['y'])) {

            $this->result['state'] = '1';
            $this->result['reason'] = '头像临时保存成功';
            $this->result['header'] = '/thumb/160_160/' . str_ireplace('./assets', '', $_SESSION['tempImgUrl']);
            $this->result['realheader'] = $_SESSION['tempImgUrl'];
            $_SESSION['tempImgUrl'] = null;
            exit(json_encode($this->result));

        }

        if ($_REQUEST) {

            $scale = $_REQUEST['bl'];
            //下面的属性乘以相应的比例
            $x = $_REQUEST['x'] * $scale;
            $y = $_REQUEST['y'] * $scale;
            $w = $_REQUEST['w'] * $scale;
            $h = $_REQUEST['h'] * $scale;
            $sl_width = 160;
            $sl_height = 160;
            $jpeg_quality = 75;
            $width = 500;
            $src = $_SESSION['tempImgUrl'];


            if (!file_exists($src)) {

                $this->result['state'] = '0';
                $this->result['reason'] = '找不到图片资源';
                exit(json_encode($this->result));
            }

            $w_h = getimagesize($src);

            $filetype = explode('/', $w_h['mime']);

            $imagepostfix = $filetype[1] == 'jpeg' ? 'jpg' : $filetype[1];


            switch ($imagepostfix) {

                case 'jpg':
                    $img_r = imagecreatefromjpeg($src);
                    break;

                case 'png':
                    $img_r = imagecreatefrompng($src);
                    break;

                case 'gif':
                    $img_r = imagecreatefromgif($src);
                    break;
            }


            // $dst_r = ImageCreateTrueColor($targ_w, $targ_h);

            /// $new_height = $w_h[1] * $width / $w_h[0];

            $dst_r = ImageCreateTrueColor($w, $h);

            // 调整大小
            imagecopy($dst_r, $img_r, 0, 0, $x, $y, $w, $h);

            // imagecopyresampled($new_img, $img_r, 0, 0, 0, 0, $width, $new_height, $w_h[0], $w_h[1]);

            //imagecopyresampled($dst_r, $new_img, 0, 0, $_REQUEST['x'], $_REQUEST['y'], $targ_w,$targ_h, $_REQUEST['w'], $_REQUEST['h']);
            $imagename = Yii::app()->user->customer_id . time() . '.' . $imagepostfix;
            $image = './assets/temp/tempheader_' . $imagename;

            switch ($imagepostfix) {

                case 'jpg':
                    $rs = imagejpeg($dst_r, $image, $jpeg_quality);
                    break;

                case 'png':
                    $rs = imagepng($dst_r, $image);
                    break;

                case 'gif':
                    $rs = imagegif($dst_r, $image);
                    break;

            }

            $this->actionDelTempImage($_SESSION['tempImgUrl']);
            if ($rs) {
                //裁剪后保存临时图片

                $this->result['state'] = '1';
                $this->result['reason'] = '头像临时保存成功';
                $this->result['header'] = '/thumb/160_160/temp/tempheader_' . $imagename;
                $this->result['realheader'] = $image;
                $_SESSION['tempImgUrl'] = null;
                exit(json_encode($this->result));

            } else {

                $this->result['state'] = '0';
                $this->result['reason'] = '图片裁剪失败';
                exit(json_encode($this->result));
            }

        }
    }

    //删除临时文件图像
    private function actionDelTempImage($tempimage)
    {

        @unlink($tempimage);

    }


    //保存新头像
    public function actionSaveNewHeaderImage()
    {

        if (empty($_REQUEST['realheader'])) {

            $this->result['state'] = '0';
            $this->result['reason'] = '头像上传数据不存在';
            exit(json_encode($this->result));

        }

        if (!file_exists($_REQUEST['realheader'])) {

            $this->result['state'] = '0';
            $this->result['reason'] = '图片资源不存在';
            exit(json_encode($this->result));

        }

        $w_h = getimagesize($_REQUEST['realheader']);

        $filetype = explode('/', $w_h['mime']);

        $imagepostfix = $filetype[1] == 'jpeg' ? 'jpg' : $filetype[1];

        $imageres = Yii::app()->assetManager->makeAssetFileUrl($_REQUEST['realheader'],
            1, '/userheader/user_' . U_ID, $imagepostfix);
        if ($imageres) {

            $Customer = Customer::model()->findByPk(U_ID);
            if ($Customer->attributes['avator'] != 'userheader/default_header.png') {

                @unlink('./assets/' . $Customer->attributes['avator']);
            }

            $Customer->avator = $imageres;

            $Rs = $Customer->save(false);

            if ($Rs) {

                @unlink($_REQUEST['realheader']);
                $this->result['state'] = '1';
                $this->result['reason'] = '头像保存成功';
                $this->result['url'] = $this->createUrl('center/updateheader');
                $this->result['header'] = $imageres;

                exit(json_encode($this->result));

            } else {
                @unlink($_REQUEST['realheader']);
                $this->result['state'] = '0';
                $this->result['reason'] = '头像保存失败';
                exit(json_encode($this->result));
            }

        } else {
            @unlink($_REQUEST['realheader']);
            $this->result['state'] = '0';
            $this->result['reason'] = '头像保存失败';
            exit(json_encode($this->result));

        }


    }
    //删除旧头像
    private function actionDelOldHeader()
    {

        $data = Customer::model()->findByPk(U_ID);

        if ($data->attributes['avator']) {

            @unlink('/assets/' . $data->attributes['avator']);
        }

    }

    //前台数据隐蔽显示处理
    public function Datahiding($str, $type)
    {
        //邮箱处理
        if ($type == 'email') {
            $arr = explode('@', $str);
            for ($i = 0; $i < strlen($arr[0]); $i++) {

                if ($i < 2) {

                    $tempstr .= $arr[0][$i];
                } else {

                    $tempstr .= '*';
                }
            }
            return $tempstr . '@' . $arr[1];
        }
        //手机处理
        if ($type == 'phone') {

            for ($i = 0; $i < strlen($str); $i++) {

                if ($i < 3) {

                    $tempstr .= $str[$i];

                } else
                    if ($i >= 3 && $i < 8) {

                        $tempstr .= '*';

                    } else {

                        $tempstr .= $str[$i];
                    }
            }

            return $tempstr;
        }

        //证件号码
        if ($type == 'document') {

            for ($i = 0; $i < strlen($str); $i++) {

                if ($i < 5) {

                    $tempstr .= $str[$i];

                } else
                    if ($i >= 5 && $i < 14) {

                        $tempstr .= '*';

                    } else {

                        $tempstr .= $str[$i];
                    }
            }

            return $tempstr;

        }


    }
    //删除站内信消息操作
    public function actionSmsOprate()
    {

        if (empty($_REQUEST['op'])) {

            $this->result['state'] = '0';
            $this->result['reason'] = '执行操作错误';
            exit(json_encode($this->result));
        }

        if (empty($_REQUEST['sid'])) {

            $this->result['state'] = '0';
            $this->result['reason'] = '参数异常错误';
            exit(json_encode($this->result));
        }


        switch ($_REQUEST['op']) {

            case SiteInnerSmsUser::D:
                SiteInnerSmsUser::model()->smsOperate(intval($_REQUEST['sid']), U_ID, $state =
                    SiteInnerSmsUser::D);

            case SiteInnerSmsUser::Y:
                SiteInnerSmsUser::model()->smsOperate(intval($_REQUEST['sid']), U_ID, $state =
                    SiteInnerSmsUser::Y);

        }

    }

    //rick ADD 行程单分享
    public function actionTravelShare()
    {

        $this->flag['selected'] = 'buyer';

        $this->flag['select'] = 'order';

        if (empty($_REQUEST['title'])) {

            Yii::app()->user->setFlash('errortips', '标题不能为空哦！');

            $this->redirect($this->createUrl('center/buyerindex'));
        }

        if (empty($_REQUEST['id'])) {

            Yii::app()->user->setFlash('errortips', '参数错误');

            $this->redirect($this->createUrl('center/buyerindex'));
        }

        if (Itinerary::model()->create(intval($_REQUEST['id']), $_REQUEST['title'])) {

            Yii::app()->user->setFlash('oktips', '分享成功');

            $this->redirect($this->createUrl('center/buyerindex'));

        } else {

            Yii::app()->user->setFlash('errortips', '分享失败');

            $this->redirect($this->createUrl('center/buyerindex'));
        }

    }


}
?>