<?php
class FindpwdController extends BaseController
{
    public $layout = '//layouts/base';
    public $flag = array('selected' => null, 'select' => null);
    private $key = 'GO4SEAS';

    public function actionIndex()
    {
        $this->params['body'] = 'signup';

        if ($_REQUEST['action'] == 'find') {

            if ($_SESSION['safe'] >= 3) {

                Yii::app()->user->setFlash('errortips', '亲，您的提交太频繁了，休息一下吧');
                $this->redirect($this->createUrl('findpwd/index'));
            }

            if (empty($_REQUEST['email'])) {

                Yii::app()->user->setFlash('errortips', '邮箱不能为空');
                $this->redirect($this->createUrl('findpwd/index'));
            }

            if (!preg_match("/^[0-9a-zA-Z]+(?:[_-][a-z0-9-]+)*@[a-zA-Z0-9]+(?:[-.][a-zA-Z0-9]+)*.[a-zA-Z]+$/i",
                $_REQUEST['email'])) {

                Yii::app()->user->setFlash('errortips', '邮箱格式错误');
                $this->redirect($this->createUrl('findpwd/index'));
            }

            $data = Yii::app()->db->createCommand()->select('email')->from('customer')->
                where('email=:email', array(':email' => $_REQUEST['email']))->queryRow();

            if ($data['email']) {

            //    $url = $this->createUrl('findpwd/updateindex', array('email' => G4S::
//                        extendEncrypt($data['email'], $this->key)));

            $url = $this->createUrl('findpwd/updateindex', array('email' =>base64_encode($data['email'])));
                $data = array(
                    'email' => $data['email'],
                    'content' => '四海若邻找回密码,点击此链接(' . $url . ')设置你的新密码',
                    'title' => '密码找回',
                    'description' => '四海若邻找回密码服务');

                $rs = FUN::sendEmail($data);

                if ($rs) {

                    $_SESSION['email'] = $data['email'];
                    Yii::app()->user->setFlash('oktips', '邮件发送成功，请注意查收');
                    $this->redirect($this->createUrl('findpwd/index'));

                } else {

                    Yii::app()->user->setFlash('errortips', '邮件发送失败，请重新提交');
                    $this->redirect($this->createUrl('findpwd/index'));
                }


            } else {
                $_SESSION['safe']++;
                Yii::app()->user->setFlash('oktips', '邮件发送成功，请注意查收');
                $this->redirect($this->createUrl('findpwd/index'));

            }


        } else {

            $this->render('index');
        }
    }

    public function actionUpdateIndex()
    {

        if (empty($_GET['email'])) {

            Yii::app()->user->setFlash('errortips', '此链接已失效，重新获取密码修改链接');
            $this->redirect($this->createUrl('findpwd/index'));
        }

        if (empty($_SESSION['email'])) {

            Yii::app()->user->setFlash('errortips', '此链接已失效，重新获取密码修改链接');
            $this->redirect($this->createUrl('findpwd/index'));
        }

        if ($_SESSION['email'] != base64_decode($_GET['email'])) {

            Yii::app()->user->setFlash('errortips', '此链接已失效，重新获取密码修改链接');
            $this->redirect($this->createUrl('findpwd/index'));
        }

        $this->render('update');

    }
    public function actionUpdate()
    {

        if ($_REQUEST['action'] == 'update') {

            if (empty($_REQUEST['password'])) {

                Yii::app()->user->setFlash('errortips', '新密码不能为空');
                $this->redirect($this->createUrl('findpwd/update'));
            }

            if (empty($_REQUEST['repassword'])) {

                Yii::app()->user->setFlash('errortips', '确认新密码不能为空');
                $this->redirect($this->createUrl('findpwd/update'));
            }

            if ($_REQUEST['password'] != $_REQUEST['repassword']) {

                Yii::app()->user->setFlash('errortips', '两次密码输入不一致');
                $this->redirect($this->createUrl('findpwd/update'));
            }

            if (empty($_SESSION['email'])) {

                Yii::app()->user->setFlash('errortips', '此链接已失效，重新获取密码修改链接');
                $this->redirect($this->createUrl('findpwd/index'));
            }

  
            $user = Customer::model()->findByAttributes(array('email' =>$_SESSION['email']));

            $user->password = md5($_REQUEST['password']);
            $user->realpassword = $_REQUEST['password'];

            if ($user->save(false)) {

                $identity = new UserIdentity($_SESSION['email'], $_REQUEST['password']);
                $duration = 3600 * 24 * 15; // 30 days
                $identity->authenticate();
                Yii::app()->user->login($identity, $duration);
               //  Yii::app()->user->setFlash('oktips', '设置密码成功');
                $this->redirect($this->createUrl('/'));

            } else {

                Yii::app()->user->setFlash('errortips', '设置密码失败');
                $this->redirect($this->createUrl('findpwd/update'));
            }


        } else {

            $this->render('update');
        }

    }

}
?>