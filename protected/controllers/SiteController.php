<?php
class SiteController extends BaseController
{

    public $layout = '';
    public $result = array('state' => null, 'reason' => null);
    public $parent = null;
    public $sub = null;
    /**
     * Declares class-based actions.
     */
    public function actions()
    {
        return array(
            // captcha action renders the CAPTCHA image displayed on the contact page
            'captcha' => array(
                'class' => 'CCaptchaAction',
                'backColor' => 0xFFFFFF,
                ),
            // page action renders "static" pages stored under 'protected/views/site/pages'
            // They can be accessed via: index.php?r=site/page&view=FileName
            'page' => array('class' => 'CViewAction', ),
            );
    }
    public function actionIndex()
    {
        $this->render('index');
    }

    /**
     * This is the action to handle external exceptions.
     */
    public function actionError()
    {
        $this->layout = 'base';
        if ($error = Yii::app()->errorHandler->error) {
            if (Yii::app()->request->isAjaxRequest)
                echo $error['message'];
            else
                $this->render('error', $error);
        }
    }

    /**
     * Displays the contact page
     */
    public function actionContact()
    {
        $model = new ContactForm;
        if (isset($_POST['ContactForm'])) {
            $model->attributes = $_POST['ContactForm'];
            if ($model->validate()) {
                $name = '=?UTF-8?B?' . base64_encode($model->name) . '?=';
                $subject = '=?UTF-8?B?' . base64_encode($model->subject) . '?=';
                $headers = "From: $name <{$model->email}>\r\n" . "Reply-To: {$model->email}\r\n" .
                    "MIME-Version: 1.0\r\n" . "Content-type: text/plain; charset=UTF-8";

                mail(Yii::app()->params['adminEmail'], $subject, $model->body, $headers);
                Yii::app()->user->setFlash('contact',
                    'Thank you for contacting us. We will respond to you as soon as possible.');
                $this->refresh();
            }
        }
        $this->render('contact', array('model' => $model));
    }

    /**
     * 注册并自动登录  整理
     **/
    public function actionSignup()
    {
        $this->params['title'] = '注册';
        $this->params['body'] = 'signup';
        if (!$this->isGuest)
            $this->redirect('/');

        if ($_POST) {
            if (strlen($_POST['Customer']['password']) < 6) //邮箱在下面$model->CheckEmail()验证
                {
                $this->result['state'] = '0';
                $this->result['reason'] = '注册需要输入6位密码！';
            } elseif ($_POST['Customer']['password'] !== $_POST['password2']) {
                $this->result['state'] = '0';
                $this->result['reason'] = '输入的两次密码不一致！';
            } else {
                $model = new Customer;
                $model->checkEmail($_POST['Customer']['email']);
                $model->email = $_POST['Customer']['email']; //刚注册默认保密
                $model->nick_name = $_POST['Customer']['email'];
                $model->gender = 2; //刚注册默认保密
                $model->created = date('Y-m-d H:i:s', time()); //注册时间
                $model->password = md5($_POST['Customer']['password']);
                $model->default_language = Yii::app()->getLanguage();
                $model->passwordpower = Customer::PassWordPower($_POST['Customer']['password']); //密码强度
                $identity = new UserIdentity($_POST['Customer']['email'], $_POST['Customer']['password']);
                $duration = 3600 * 24 * 15; // 30 days
                if ($model->save(false)) {
                    $identity->authenticate();
                    Yii::app()->user->login($identity, $duration);
                    $this->result['state'] = '1';
                    $this->result['reason'] = 'yes';
                    $this->result['url'] = Yii::app()->user->returnUrl; //'/';//isset($_SERVER["HTTP_REFERER"])?$_SERVER["HTTP_REFERER"] : $_SERVER["HTTP_HOST"];
                } else {
                    $this->result['state'] = '0';
                    $this->result['reason'] = '注册失败';
                }
            }
            exit(json_encode($this->result));
        } else {
            $this->layout = '';
            $model = new Customer;
            $this->render('signup', array('model' => $model));
        }
    }

    public function actionPopLogin()
    {
        if ($_POST) {
            $model = new LoginForm;
            $model->attributes = $_POST;
            // validate user input and redirect to the previous page if valid
            if ($model->validate() && $model->login()) {
                Customer::model()->updateLoginTime($_REQUEST['username'], $_REQUEST['password']);
                echo '<script type="text/javascript">', 'parent.window.location.reload();',
                    '</script>';
                Yii::app()->end();
            }
            $error = '错误的邮箱或密码';
        }
        $this->renderPartial('pop_login', array('error' => $error));
    }

    /**
     * Displays the login page
     */
    public function actionLogin()
    {
        $this->params['title'] = '登录';
        $this->layout = '';
        $model = new LoginForm;

        // collect user input data
        if ($_POST) {
            $model->attributes = $login = $_POST['LoginForm'];

            if (!$login['username'] || !$login['password']) {
                $this->result['state'] = '0';
                $this->result['reason'] = '请填写帐号和密码';
            } elseif (!$model->validate() || !$model->login()) {
                $this->result['state'] = '0';
                $this->result['reason'] = '账户与密码不匹配';
            } else {
                if ($_REQUEST['rememberMe'] == 'on') {
                    G4S::SetCookie(LoginForm::REMMERNAME, $_REQUEST['LoginForm']['username'],
                        LoginForm::LOGINKEY);
                }
                $this->result['state'] = '1';
                $this->result['reason'] = '登录成功';
                $this->result['url'] = Yii::app()->user->returnUrl;
                //rick add  更新最新登录时间
                Customer::model()->updateLoginTime($_REQUEST['LoginForm']['username'], $_REQUEST['LoginForm']['password']);
            }
            exit(json_encode($this->result));

        } elseif ($_SERVER["HTTP_REFERER"]) {
            Yii::app()->user->setReturnUrl($_SERVER["HTTP_REFERER"]);
        }

        // display the login form
        $this->render('login', array('model' => $model));
    }
    /**
     * Logs out the current user and redirect to homepage.
     */
    public function actionLogout()
    {
        Yii::app()->user->logout();
    }

    public function actionUserCheckEmail()
    {
        Customer::model()->checkEmail($_REQUEST['email']);
    }

    public function actionRss()
    {

        //print_r($_POST);die;
        $respon = array('state' => '0', 'reason' => 'error');
        //print_r($respon);die;
        if (Yii::app()->request->isAjaxRequest) {
            $email = trim($_POST['follow-search-input']);
            $pattern = "/^[0-9a-zA-Z]+(?:[._-][a-z0-9-]+)*@[a-zA-Z0-9]+(?:[-.][a-zA-Z0-9]+)*.[a-zA-Z]+$/i";

            if (preg_match($pattern, $email)) {
                $data = array();
                $data['email'] = $email;
                $data['is_active'] = 1;
                $data['created'] = date("Y-m-d H:i:s");
                $data['name'] = Yii::app()->user->customer_name ? Yii::app()->user->
                    customer_name : 'Guest';
                $respon = Push::add($data); //print_r($respon);
            } else {
                $respon['reason'] = '非法邮件地址';
            }
        } else {
            $respon['reason'] = '非法请求';
        }

        die(json_encode($respon));

    }

    /**
     * 全站弹出窗口推荐目的地
     * Fedora
     */

    public function actionPopCity()
    {
        $data = Yii::app()->cache->get('homepage_' . $_POST['type']);
        if (!$data) {
            $data = Country::model()->getPopWindow();
            //Yii::app()->cache->set('homepage_'.$_POST['type'],$data,864000);
            Yii::app()->cache->set('homepage_' . $_POST['type'], $data, 60);
        }
        $this->renderPartial('pop_city', array('data' => $data, 'type' => $_POST['type']));
    }

    /**
     * 意见建议
     */
    public function actionSuggestion()
    {


        $respon = array(
            "state" => '0',
            'data' => "",
            "reason" => "非法请求");
        if (Yii::app()->request->isAjaxRequest) {
            $content = $_POST['feedback-txt'];
            $_is_ok = false;
            if ($content) {
                $_is_ok = SiteSuggestions::add($content);
            }
        }

        $respon['state'] = $_is_ok ? 1 : 0;
        $respon['reason'] = $_is_ok ? '您的建议我们已收到,非常感谢您的支持' : '非法请求';

        die(json_encode($respon));


    }

    //站内信消息实时更新  rick  add
    public function actionGetMessage()
    {

        //获取最新的回复
        $article_arr_r = ArticleReview::model()->getArticleReviewRecive(U_ID);
        //用户的相册图片回复
        $album_arr_r = AlbumReview::model()->getAllAlbumImageReviewFormUser(U_ID);
        $data_r = array_merge($article_arr_r, $album_arr_r);
        $result['HF'] = array('url' => $this->createUrl('center/msgmanager', array('class' =>
                    'HF')), 'count' => 0);
        foreach ($data_r as $item) {

            if ($item['is_read'] == 0) {

                $result['HF']['count']++;
            }

        }
        //获取站内信数量
         $result['SMS'] = array('url' => $this->createUrl('center/msgmanager', array('class' =>
                    'SMS')), 'count' => 0);
        $count = SiteInnerSmsUser::model()->getUserNotReadySms(U_ID);
       $result['SMS']['count']=empty($count)?0:$count;

        exit(json_encode($result));

    }

    //站内信  消息置为已读
    public function actionSetMessageState()
    {

        if (!empty($_REQUEST['type'])) {

            switch ($_REQUEST['type']) {


                case 'HF':

                    $article_arr_r = ArticleReview::model()->getArticleReviewRecive(U_ID);

                    if (!empty($article_arr_r)) {

                        foreach ($article_arr_r as $item) {

                            if ($item['is_read'] == 0) {
                                ArticleReview::model()->updateByPk($item['article_review_id'], array('is_read' =>
                                        1), 'is_read=:id', array(':id' => 0));
                            }

                        }
                    }

                    $album_arr_r = AlbumReview::model()->getAllAlbumImageReviewFormUser(U_ID);

                    if (!empty($album_arr_r)) {

                        foreach ($album_arr_r as $item) {

                            if ($item['is_read'] == 0) {

                                AlbumReview::model()->updateByPk($item['album_review_id'], array('is_read' =>
                                        1), 'is_read=:id', array(':id' => 0));

                            }

                        }

                    }

                    break;

                case 'SMS':
                
                $data=SiteInnerSmsUser::model()->getUserNotReadSms(U_ID);
                         
                if(!empty($data)){
                    
                    foreach($data as $value){
                        
                        SiteInnerSmsUser::model()->smsOperateIsRead($value['site_inner_sms_id'], U_ID, SiteInnerSmsUser::Y);
                    } 
                    
                } 
                
                     break;
                     
                default:
                    die('message type is null');

            }

        }

    }


    /**

     *     public function actionReadSms()
     *     {
     *         $tmp = array();
     *         foreach ($_POST['SiteInnerSms'] as $i) {
     *             $tmp[] = (int)$i;
     *         }
     *         if (count($tmp)) {
     *             $trans = Yii::app()->db->beginTransaction();
     *             try {
     *                 $count = SiteInnerSms::model()->updateByPk($tmp, array('read' => 1),
     *                     'owner_id=:owner_id', array(':owner_id' => Yii::app()->user->customer_id));
     *                 if ($count) {
     *                     $trans->commit();
     *                     $result = array('status' => 0);
     *                     echo json_encode($result);
     *                     return;
     *                 }
     *             }
     *             catch (CDbException $cdbe) {
     *                 $trans->rollback();
     *             }
     *         }
     *         $result = array('status' => 1, 'msg' => '标记失败，请重试。');
     *         echo json_encode($result);
     *     }
     */

    /**

     *     public function actionSendInnerSms()
     *     {
     *         $this->params['body']='signup';
     *         if (isset($_POST) && !Yii::app()->user->isGuest) {
     *             if (trim($_POST['content'])) {
     *                 if (false && !$this->audit($_POST['content'])) {
     *                     $status = 1;
     *                     $msg = '内容包含敏感词';
     *                 } elseif (Yii::app()->user->customer_id != (int)$_POST['uid']) {
     *                     $siteInnerSms = new SiteInnerSms();

     *                     $siteInnerSms->owner_id = (int)$_POST['uid'];
     *                     $siteInnerSms->customer_id = Yii::app()->user->customer_id;
     *                     $siteInnerSms->to_customer_id = (int)$_POST['uid'];
     *                     $siteInnerSms->content = $_POST['content'];
     *                     $siteInnerSms->key_type = $_POST['key_type'];
     *                     $siteInnerSms->key_id = (int)$_POST['key_id'];
     *                     $siteInnerSms->read = 0;
     *                     $siteInnerSms->created = new CDbExpression('NOW()');

     *                     $siteInnerSms_change = clone $siteInnerSms;
     *                     $siteInnerSms_change->owner_id = Yii::app()->user->customer_id;
     *                     $trans = Yii::app()->db->beginTransaction();
     *                     try {
     *                         if ($siteInnerSms->save() && $siteInnerSms_change->save()) {
     *                             $trans->commit();
     *                             $status = 0;
     *                         } else {
     *                             $trans->rollback();
     *                             $status = 1;
     *                             $msg = $siteInnerSms->firstError;
     *                         }
     *                     }
     *                     catch (CDbException $cdbe) {
     *                         $status = 1;
     *                         $msg = '发送失败，请重试。';
     *                         $trans->rollback();
     *                     }
     *                 } else {
     *                     $status = 1;
     *                     $msg = '不能给自己发送信息。';
     *                 }
     *             } else {
     *                 $status = 1;
     *                 $msg = '内容不能为空。';
     *             }
     *             echo json_encode(array('status' => $status, 'msg' => $msg));
     *         }
     *     }
     */


    /**
     * delete messages
     */
    /**
     *     public function actionDeleteSms()
     *     {
     *         $tmp = array();
     *         foreach ($_POST['SiteInnerSms'] as $i) {
     *             $tmp[] = (int)$i;
     *         }
     *         if (count($tmp)) {
     *             $trans = Yii::app()->db->beginTransaction();
     *             try {
     *                 $count = SiteInnerSms::model()->deleteByPk($tmp, 'owner_id=:owner_id', array(':owner_id' =>
     *                         Yii::app()->user->customer_id));
     *                 if ($count) {
     *                     $trans->commit();
     *                     $result = array('status' => 0);
     *                     echo json_encode($result);
     *                     return;
     *                 }
     *             }
     *             catch (CDbException $cdbe) {
     *                 $trans->rollback();
     *             }
     *         }
     *         $result = array('status' => 1, 'msg' => '删除失败，请重试。');
     *         echo json_encode($result);
     *     }
     */
}
