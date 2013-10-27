<?php
class AuthidentityController extends BaseController
{
    public $layout = '//layouts/auth.identity';
    public $auth = null;
    public $xieyi = null;
    public $auth_type = null;
    public $result = array('state' => null, 'reason' => null);
    public $tips = null;
    public $flag = array('selected' => null, 'select' => null);
    private $path = './assets/';

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
        if (empty(Yii::app()->user->customer_id)) {

            $this->redirect($this->createUrl('site/login'));
        }
        $this->params['title']='职业认证';
        $this->render('index');
    }

    //申请房东认证入口 step1
    public function actionLandEntry()
    {
        if (empty(Yii::app()->user->customer_id)) {

            $this->redirect($this->createUrl('site/login'));
        }

        $this->flag['selected'] = 'land';
        $this->params['title']='房东-职业认证';
        //  $this->flag['select'] = 'BasicInfo';
        //验证用户是否已发布商品
        if ($this->CheckUserSellThing(Dynamic::PROPERTY)) {
            //可以申请房东认证
            $this->auth = "房东";
            $this->auth_type = 1;
            // $this->xieyi='xieyi';
            $this->render('step_1');

        } else {

            //不能申请房东认证
            $this->render('land_not');
        }


    }
    //申请认证信息填写页面 step2
    public function actionStepSecond()
    {

        $this->auth_type = $_REQUEST['auth_type'];
        if ($this->auth_type == 1) {
            $this->auth = '房东';
            $this->flag['selected'] = 'land';
        }
        if ($this->auth_type == 2) {
            $this->auth = '导游';
            $this->flag['selected'] = 'guide';
        }
        if ($this->auth_type == 3) {
            $this->auth = '个人商家';
            $this->flag['selected'] = 'business';
            $this->flag['select'] = 'people';

        }
        if ($this->auth_type == 4) {
            $this->auth = '企业商家';
            $this->flag['selected'] = 'business';
            $this->flag['select'] = 'company';
        }
        $this->params['title']=$this->auth.'-职业认证';
        $data = Customer::model()->findByPk(U_ID);

        // $auth=$data->authidentity->attributes;
        $auth = Yii::app()->db->createCommand()->select('*')->from('authidentity')->
            where('customer_id=:id and auth_type=:t_id', array(':id' => U_ID, ':t_id' => $this->
                auth_type))->queryRow();

        if ($this->auth_type == 4) {
            $this->render('step_2_business', array('userinfo' => $data->attributes, 'auth' =>
                    $auth));

        } else {
            $this->render('step_2', array('userinfo' => $data->attributes, 'auth' => $auth));
        }


    }
    //保存认证信息
    public function actionSaveLandInfo()
    {
        //print_r($_REQUEST);exit;
        //验证手机是否已经被绑定过

        $data = Customer::model()->findByPk(U_ID);
        $auth = Authidentity::model()->findByAttributes(array('customer_id' => U_ID,
                'auth_type' => $_REQUEST['auth_type']));

        if (empty($data->attributes['bind_phone'])) {

            if (empty($_REQUEST['phonenum'])) {

                $this->result['state'] = '0';
                $this->result['reason'] = '电话号码不能为空';

                exit(json_encode($this->result));
            }

            if (empty($_REQUEST['phonenumyzm'])) {

                $this->result['state'] = '0';
                $this->result['reason'] = '验证码不能为空';

                exit(json_encode($this->result));
            }

            if ($data->attributes['tempyzm'] != trim($_REQUEST['phonenumyzm'])) {

                $this->result['state'] = '0';
                $this->result['reason'] = '验证码错误';

                exit(json_encode($this->result));
            }

            if ((time() - $data->attributes['tempyzmtime']) > 30 * 60) {

                $this->result['state'] = '0';
                $this->result['reason'] = '验证码已失效';
                exit(json_encode($this->result));

            }

            $data->bind_phone = trim($_REQUEST['phonenum']);
            $data->save(false);


        }

        if (empty($_REQUEST['country'])) {

            $this->result['state'] = '0';
            $this->result['reason'] = '国家选择不能为空';

            exit(json_encode($this->result));
        }

        if (empty($_REQUEST['passport'][0])) {

            $this->result['state'] = '0';
            $this->result['reason'] = '证件类型不能为空';

            exit(json_encode($this->result));
        }
        /*
        if (empty($_REQUEST['pic'])) {

        $this->result['state'] = '0';
        $this->result['reason'] = '证件图片不能为空';

        exit(json_encode($this->result));
        }*/
        if ($_FILES['pic']['size'] > 2 * 1024 * 1024) {

            $this->result['state'] = '0';
            $this->result['reason'] = '上传图片尺寸不合适';

            exit(json_encode($this->result));
        }


        //保存用户图片

        if ($_REQUEST['auth_type'] == 1) {
            $type = 'land';
        }

        if ($_REQUEST['auth_type'] == 2) {
            $type = 'guide';
        }

        if ($_REQUEST['auth_type'] == 3) {
            $type = 'people_business';
        }

        if ($_REQUEST['auth_type'] == 4) {
            $type = 'company_business';
        }

        if (!empty($_REQUEST['pic'])) {

            $img_url = $this->actionSaveAuthImage($_REQUEST['pic'], $type);
            $old_pic = $auth->attributes['cert_image'];
        }

        if (!empty($_REQUEST['pic_guide'])) {

            $img_url_guide = $this->actionSaveAuthImage($_REQUEST['pic_guide'], $type);
            $guide_image = $auth->attributes['guide_image'];
        }

        if (!empty($_REQUEST['pic_listen'])) {

            $img_url_listen = $this->actionSaveAuthImage($_REQUEST['pic_listen'], $type);
            $company_listen_image = $auth->attributes['company_listen_image'];
        }

        if (!empty($_REQUEST['pic_tax'])) {

            $img_url_tax = $this->actionSaveAuthImage($_REQUEST['pic_tax'], $type);
            $company_tax_image = $auth->attributes['company_tax_image'];
        }

        $count = count($auth);

        if ($count > 0) {

            $auth->country = $_REQUEST['country'];
            $auth->cert_type = $_REQUEST['passport'][0];
            $auth->cert_image = $img_url;
            $auth->auth_type = $_REQUEST['auth_type'];
            $auth->auth_state = 0;
            if ($img_url_guide) {
                $auth->guide_image = $img_url_guide;
            }
            if ($img_url_listen) {

                $auth->company_listen_image = $img_url_listen;
            }
            if ($img_url_tax) {

                $auth->company_tax_image = $img_url_tax;
            }


            $rs = $auth->save(false);
            //删除旧图片


        } else {

            $auth = new Authidentity;
            $auth->customer_id = U_ID;
            $auth->country = $_REQUEST['country'];
            $auth->cert_type = $_REQUEST['passport'][0];
            $auth->cert_image = $img_url;
            $auth->auth_type = $_REQUEST['auth_type'];
            $auth->guide_image = $img_url_guide;
            $auth->company_listen_image = $img_url_listen;
            $auth->company_tax_image = $img_url_tax;
            $auth->auth_state = 0;
            $rs = $auth->save(false);

        }

        if ($rs) {

            //删除旧图片
            if ($old_pic) {
                @unlink($this->path . $old_pic);
            }
            if ($guide_image) {
                @unlink($this->path . $guide_image);
            }
            if ($company_listen_image) {
                @unlink($this->path . $company_listen_image);
            }
            if ($company_tax_image) {
                @unlink($this->path . $company_tax_image);
            }

            $this->result['state'] = '1';
            $this->result['reason'] = '提交成功';
            $this->result['url'] = $this->createUrl('authidentity/authcomplete', array('auth' =>
                    $_REQUEST['auth']));
            exit(json_encode($this->result));
        } else {

            $this->result['state'] = '0';
            $this->result['reason'] = '身份认证提交失败';

            exit(json_encode($this->result));
        }
    }
    //认证申请第三部
    public function actionAuthComplete()
    {
        $this->auth = $_REQUEST['auth'];
        $this->params['title']=$this->auth.'-职业认证';
        if ($this->auth == '房东') {
            $this->auth = '房东';
            $this->flag['selected'] = 'land';
        }
        if ($this->auth == '导游') {
            $this->auth = '导游';
            $this->flag['selected'] = 'guide';
        }
        if ($this->auth == '个人商家') {
            $this->auth = '个人商家';
            $this->flag['selected'] = 'business';
            $this->flag['select'] = 'people';

        }
        if ($this->auth == '企业商家') {
            $this->auth = '企业商家';
            $this->flag['selected'] = 'business';
            $this->flag['select'] = 'complany';
        }
        $this->render('step_3');
    }

    //验证用户是否已发布商品
    private function CheckUserSellThing($type)
    {
        if ($type == Dynamic::PROPERTY) {

            $goods = Property::model()->getPropertyId(U_ID);
        }
        if ($type == Dynamic::PRODUCT) {

            $goods = Product::model()->getProductId(U_ID);
        }

        return count($goods);


    }

    //申请个人商家认证入口
    public function actionPeopleBusinessEntry()
    {
        if (empty(Yii::app()->user->customer_id)) {

            $this->redirect($this->createUrl('site/login'));
        }
         $this->params['title']='个人商家-职业认证';
        if ($this->CheckUserSellThing(Dynamic::PRODUCT)) {

            $this->flag['selected'] = 'business';
            $this->flag['select'] = 'people';
            $this->auth = "个人商家";
            $this->auth_type = 3;
            // $this->xieyi='xieyi';
            $this->render('step_1');
        } else {

            $this->render('business_not');
        }


    }

    //申请导游认证入口
    public function actionGuideEntry()
    {
        if (empty(Yii::app()->user->customer_id)) {

            $this->redirect($this->createUrl('site/login'));
        }
         $this->params['title']='导游-职业认证';
        $this->flag['selected'] = 'guide';
        $this->auth = "导游";
        $this->auth_type = 2;
        // $this->xieyi='xieyi';
        $this->render('step_1');

    }

    //申请企业商家认证入口
    public function actionCompanyBusinessEntry()
    {
        if (empty(Yii::app()->user->customer_id)) {

            $this->redirect($this->createUrl('site/login'));
        }
         $this->params['title']='企业商家-职业认证';
        if ($this->CheckUserSellThing(Dynamic::PRODUCT)) {

            $this->flag['selected'] = 'business';
            $this->flag['select'] = 'company';
            $this->auth = "企业商家";
            $this->auth_type = 4;
            // $this->xieyi='xieyi';
            $this->render('step_1');
        } else {

            $this->render('business_not');
        }


    }


    //手机短信发送
    public function actionSendPhoneNums()
    {
        // echo $_REQUEST['phonenum'];exit;
        if (!empty($_REQUEST['phonenum'])) {

            $n = preg_match_all("/13[123569]{1}\d{8}|15[1235689]\d{8}|18[123456789]\d{8}/", $_REQUEST['phonenum'],
                $array);

            if ($n) {

                FUN::actionSendPhonenumsLimit(); //短信发送限制
                $yzm = rand(100000, 999999);
                //保存验证码到数据库
                $data = array('mobiles' => $_REQUEST['phonenum'], 'content' => '四海若邻绑定手机验证码:' .
                        $yzm . '(验证码30分钟内有效)');

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


    //存放上传证件图片
    public function actionSaveAuthImage($file, $type)
    {
        $image = getimagesize($file);

        $filetype = explode('/', $image['mime']);

        $imagepostfix = $filetype[1] == 'jpeg' ? 'jpg' : $filetype[1];

        if ($imagepostfix == 'png' || $imagepostfix == 'jpg' || $imagepostfix == 'gif') {
            //图片格式正确，允许临时保存

            if ($imageres = Yii::app()->assetManager->makeAssetFileUrl($file, 1, '/auth/' .
                $type . '/user_' . U_ID, $imagepostfix)) {

                return $imageres;

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


    }

    //上传文件临时存放
    public function actionSaveTempImage()
    {

        if (!empty($_FILES['pic'])) {

            $filetype = explode('/', $_FILES['pic']['type']);

            $imagepostfix = $filetype[1] == 'jpeg' ? 'jpg' : $filetype[1];

            if ($filetype[1] == 'png' || $filetype[1] == 'jpeg' || $filetype[1] == 'gif') {

                $imageinfo = getimagesize($_FILES['pic']['tmp_name']);
                $json_arr = array();
                $json_arr['code'] = 1;
                $json_arr['message'] = 'ok';
                $json_arr['width'] = $imageinfo[0];
                $json_arr['height'] = $imageinfo[1];
                //限制图片大小
                /*
                if ($json_arr['width'] < 160 || $json_arr['height'] < 160) {

                $this->result['state'] = '0';
                $this->result['reason'] = '上传图片尺寸太大';
                exit(json_encode($this->result));
                }
                */
                //图片格式正确，允许临时保存
                if ($imageres = Yii::app()->assetManager->makeAssetFileUrl($_FILES['pic']['tmp_name'],
                    time(), '/temp/user_' . U_ID, $imagepostfix)) {

                    $this->result['state'] = '1';
                    $this->result['reason'] = '临时保存图片成功';
                    $this->result['showimage'] = '/thumb/160_160/' . $imageres;
                    $this->result['realimage'] = './assets/' . $imageres;
                    exit(json_encode($this->result));

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
            $this->result['reason'] = '头像保存失败';
            exit(json_encode($this->result));

        }

    }


}
?>