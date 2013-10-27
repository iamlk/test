<?php
class SiteThirdLoginController extends BaseController
{

    public $layout = '//layouts/home';
    public $result = array('state' => null, 'reason' => null);
    // private $params = array(); //qq使用
    /**
     *   RICK   sina  login
     */
    private $sina_client_id = '1317156355';
    private $sina_client_secret = '49b19fc2e37be757805f476369b0effe';
    private $sina_url = 'http://qa.iamlk.cn/siteThirdLogin/sina';
    /**
     *   RICK   qq  login
     */
    private $qq_client_id = '100515591';
    private $qq_client_secret = 'ba24bff1cf6724a96403622a70ddd400';
    private $qq_url = 'http://qa.iamlk.cn/siteThirdLogin/qq';


    public function actionIndex()
    {


        $this->render('index');
    }

    //新浪登录回调地址
    public function actionSina()
    {
        if (empty($_REQUEST['code'])) {

            //请求新浪授权页面
            $this->redirect('https://api.weibo.com/oauth2/authorize?client_id=' . $this->
                sina_client_id . '&response_type=code&redirect_uri=' . $this->sina_url);
        } else {

            if (isset($_REQUEST['code'])) {

                $url = "https://api.weibo.com/oauth2/access_token";
                $data = "state=" . md5('go4seas') . "&client_id=" . $this->sina_client_id .
                    "&client_secret=" . $this->sina_client_secret . "&code=" . $_REQUEST['code'] .
                    "&grant_type=authorization_code&redirect_uri=" . rawurlencode($this->sina_url);

                $access = $this->do_call($url, $data);
                $arr = json_decode($access, true);
                $user = $this->checkUserRegist($arr['uid']); //检查用户是否存在于数据库
                if (!empty($user)) {
                    //用户存在直接登录
                    $this->thirdLogin($user['email'], $user['realpassword']);

                } else {
                    //用户不存在跳转到一个简单注册页面
                    $_SESSION['open_id'] = $arr['uid'];
                    $_SESSION['token'] = $arr['access_token'];
                    $_SESSION['expire'] = $arr['expires_in'];

                    $this->render('index');
                }
            }
        }
    }

    //QQ登录回调地址
    public function actionQq()
    {
        if (empty($_REQUEST["code"])) {

            $this->get_code($this->qq_client_id, $this->qq_url);

        } else {

            if (!empty($_GET['code'])) {

                $arr = $this->get_Access_Token($this->qq_client_id, $this->qq_url, $this->
                    qq_client_secret, $_GET['code']);
                $uid = $this->get_OpenID($arr); //QQ用户的OPEN_ID
                $user = $this->checkUserRegist($uid); //检查用户是否存在于数据库

                if (!empty($user)) {

                    //用户存在直接登录
                    $this->thirdLogin($user['email'], $user['realpassword']);

                } else {

                    //用户不存在跳转到一个简单注册页面
                    
                    $_SESSION['open_id'] = $uid;
                    $_SESSION['token'] = $arr['access_token'];
                    $_SESSION['expire'] = $arr['expires_in'];

                    $this->render('index');
                    
                    /*
                    $info=$this->getQqUserInfo($arr['access_token'], $uid);
                    
                    $user = new Customer;
                    $user->email = $uid;
                    $user->nick_name = $info['nickname']; //默认昵称
                    $user->avator = $info['figureurl_1']; //默认昵称
                    $model->default_language = Yii::app()->getLanguage(); //默认语言
                    $model->gender = $info['gender']; //刚注册默认保密 性别
                    $model->created = date('Y-m-d H:i:s', time()); //注册时间
                    $model->last_login = date('Y-m-d H:i:s', time()); //登录时间
                    $model->passwordpower = Customer::PassWordPower('101010'); //密码强度
                    $user->password = md5('101010');
                    $user->realpassword = '101010';
                    $user->open_id = $uid;
                    $user->token = $arr['access_token'];
                    $user->expire = $arr['expires_in'];
                    
                    if($user->save(false)){
                        
                         $this->thirdLogin($uid, '101010');
                    }else{
                        
                        $this->redirect('siteThirdLogin/qq');
                    }
                  */
                  
                }

            }

        }

    }
    //第三方登录入口
    private function thirdLogin($email, $realpassword)
    {
        //rick add  更新最新登录时间
        Customer::model()->updateLoginTime($email, $realpassword);
        $identity = new UserIdentity($email, $realpassword);
        $duration = 3600 * 24 * 15; // 30 days
        $identity->authenticate();
        Yii::app()->user->login($identity, $duration);
        $this->redirect($this->createUrl('/'));


    }


    //POST请求
    function do_call($url, $postdata)
    {
        //https
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);
        curl_setopt($ch, CURLOPT_URL, $url);
        $ret = curl_exec($ch);
        curl_close($ch);
        return $ret;
    }
    //验证用户是否已经注册过了
    public function checkUserRegist($uid)
    {
        //   $user = Customer::model()->findAllByAttributes(array('open_id' => $uid));
        $user = Yii::app()->db->createCommand()->select('*')->from('customer')->where('open_id=:id',
            array(':id' => $uid))->queryRow();
        return $user;
    }
    //用户注册
    public function actionRegist()
    {
   
        if (empty($_SESSION['open_id']) || empty($_SESSION['token'])) {

            Yii::app()->user->setFlash('errortips', '登录异常错误');

            $this->redirect($this->createUrl('siteThirdLogin/index'));
        }

  
        if (empty($_REQUEST['email'])) {

            Yii::app()->user->setFlash('errortips', '邮箱不能为空');
            $this->redirect($this->createUrl('siteThirdLogin/index'));
        }

        if (empty($_REQUEST['password'])) {

            Yii::app()->user->setFlash('errortips', '密码不能为空');
            $this->redirect($this->createUrl('siteThirdLogin/index'));
        }

        if (!preg_match("/^[0-9a-zA-Z]+(?:[_-][a-z0-9-]+)*@[a-zA-Z0-9]+(?:[-.][a-zA-Z0-9]+)*.[a-zA-Z]+$/i",
            $_REQUEST['email'])) {

            Yii::app()->user->setFlash('errortips', '邮箱格式错误');
            $this->redirect($this->createUrl('siteThirdLogin/index'));
        }
        $data=Customer::model()->findByAttributes(array('email'=>$_REQUEST['email']));
        
        if(count($data->attributes)){
            
             Yii::app()->user->setFlash('errortips', '此邮箱已经被注册');
            $this->redirect($this->createUrl('siteThirdLogin/index'));
        }


        $user = new Customer;
        $user->email = $_REQUEST['email'];
        $user->nick_name = $_REQUEST['email']; //默认昵称
        $model->default_language = Yii::app()->getLanguage(); //默认语言
        $model->gender = 2; //刚注册默认保密 性别
        $model->created = date('Y-m-d H:i:s', time()); //注册时间
        $model->last_login = date('Y-m-d H:i:s', time()); //登录时间
        $model->passwordpower = Customer::PassWordPower($_REQUEST['password']); //密码强度
        $user->password = md5($_REQUEST['password']);
        $user->realpassword = $_REQUEST['password'];
        $user->open_id = $_SESSION['open_id'];
        $user->token = $_SESSION['token'];
        $user->expire = $_SESSION['expire'];
        if ($user->save(false)) {

            $identity = new UserIdentity($_REQUEST['email'], $_REQUEST['password']);
            $duration = 3600 * 24 * 15; // 30 days
            $identity->authenticate();
            Yii::app()->user->login($identity, $duration);

            $this->redirect($this->createUrl('/'));


        } else {

            Yii::app()->user->setFlash('errortips', '登录失败');
            $this->redirect($this->createUrl('siteThirdLogin/index'));
        }
    }

    public function actiondelete()
    {

        $this->render('index');

    }

    //QQ登录调用

    public function get_code($app_id, $my_url)
    {
        //Step1：获取Authorization Code
        //state参数用于防止CSRF攻击，成功授权后回调时会原样带回
        $_SESSION['state'] = md5(uniqid(rand(), true));

        //拼接URL
        $dialog_url = "https://graph.qq.com/oauth2.0/authorize?response_type=code&client_id=" .
            $app_id . "&redirect_uri=" . urlencode($my_url) . "&state=" . $_SESSION['state'] .
            "&scope=get_user_info,add_t,upload_pic,do_like,add_weibo,add_share";

        echo ("<script> top.location.href='" . $dialog_url . "'</script>");
    }


    public function get_Access_Token($app_id, $my_url, $app_secret, $code)
    {
        //Step2：通过Authorization Code获取Access Token
        $url = "https://graph.qq.com/oauth2.0/token";
        $data = "client_id=" . $app_id . "&client_secret=" . $app_secret . "&code=" . $code .
            "&grant_type=authorization_code&redirect_uri=" . urlencode($my_url);

        $access = $this->do_call($url, $data);

        if (strpos($access, "callback") !== false) {

            $this->redirect($this->createUrl('site/signup'));

        } else {

            parse_str($access, $params);
            return $params;

        }
    }

    public function get_OpenID($params)
    {
        //Step3：使用Access Token来获取用户的OpenID
        $url = "https://graph.qq.com/oauth2.0/me";
        $data = "access_token=" . $params['access_token'];
        $access = $this->do_call($url, $data);
        // print_r($access); exit;
        if (strpos($access, "callback") !== false) {
            $lpos = strpos($access, "(");
            $rpos = strrpos($access, ")");
            $access = substr($access, $lpos + 1, $rpos - $lpos - 1);

        }
        $user = json_decode($access);
        if (isset($user->error)) {
            //     echo "<h3>error:</h3>" . $user->error;
            //            echo "<h3>msg  :</h3>" . $user->error_description;
            //            exit;
            $this->redirect($this->createUrl('site/signup'));
        }
        return $user->openid;
    }

    //QQ接口获取用户基本信息
    public function getQqUserInfo($access_token, $openid)
    {

        $url = "https://graph.qq.com/user/get_user_info";
        $data = "oauth_consumer_key=" . $this->qq_client_id . "&access_token=" . $access_token .
            "&openid=" . $openid . "&format=json";
        $access = $this->do_call($url, $data);
        $userinfo=json_decode($access);
        
        return (array)$userinfo;
       // print_r($userinfo);exit;
    }

}
