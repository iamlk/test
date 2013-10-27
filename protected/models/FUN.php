<?php
class FUN extends BaseActiveRecord
{
    //rick  add
    static public $result = array('state' => null, 'reason' => null);


    static public $dbname = array(
        'ArticleReview' => 'article_review',
        'AlbumReview' => 'album_review',
        'DelicacyReview' => 'delicacy_review',
        'RestaurantReview' => 'restaurant_review',
        'AttractionReview' => 'attraction_review');


    //删除消息操作参数 消息ID  消息类型type
    static public function msgDelete($id, $model)
    {

        if (empty($id)) {

            FUN::$result['state'] = '0';
            FUN::$result['reason'] = '消息ID错误';
            exit(json_encode(FUN::$result));
        }

        if (empty($model)) {

            FUN::$result['state'] = '0';
            FUN::$result['reason'] = '消息类型错误';
            exit(json_encode(FUN::$result));
        }

        switch ($model) {

            case Dynamic::ARTICLE:
                FUN::commonDelete($id, 'ArticleReview', 'article_review_id');
                break;

            case Dynamic::ALBUMIMAGE:
                FUN::commonDelete($id, 'AlbumReview', 'album_review_id');
                break;

            case Dynamic::DELICACY:
                FUN::commonDelete($id, 'DelicacyReview', 'delicacy_review_id');
                break;

            case Dynamic::RESTAURANT:
                FUN::commonDelete($id, 'RestaurantReview', 'restaurant_review_id');
                break;

            case Dynamic::ATTRACTION:
                FUN::commonDelete($id, 'AttractionReview', 'attraction_review_id');
                break;
            case 'station':
                FUN::stationDelete($id);
                break;
            case 'sysmsg':
                FUN::sysmsgDelete($id);
                break;

        }

    }
    //公用删除方法
    static private function commonDelete($id, $model, $field)
    {
        $arr = FUN::checkMessageIsset($id, $model, $field);

        if (!count($arr)) {

            FUN::$result['state'] = '0';
            FUN::$result['reason'] = '删除的对象不存在';
            exit(json_encode(FUN::$result));

        } else {

            if ($arr->parent_id == 0) {

                //删除父消息的同时删除他下面的所有子消息

                $data = FUN::getAllMessage($id, $model, $field);

                $count = count($data);
                $num = 0;

                for ($i = 0; $i < $count; $i++) {

                    if (FUN::deleteOperate($data[$i][$field], $model, $field)) {
                        $num++;
                    } else {

                        FUN::deleteOperate($data[$num][$field], $model, $field);
                    }
                }

                if ($count == $num)
                    FUN::$result['state'] = '1';
                FUN::$result['reason'] = '消息删除成功';
                exit(json_encode(FUN::$result));


            } else {

                //单独删除一条子消息
                if (FUN::deleteOperate($id, $model, $field)) {

                    FUN::$result['state'] = '1';
                    FUN::$result['reason'] = '消息删除成功';
                    exit(json_encode(FUN::$result));

                } else {

                    FUN::$result['state'] = '0';
                    FUN::$result['reason'] = '消息失败';
                    exit(json_encode(FUN::$result));

                }

            }

        }

    }
    //验证消息是否存在
    static private function checkMessageIsset($id, $model, $field)
    {

        $data = $model::model()->findByAttributes(array($field => $id));


        return $data;

    }
    //获取父消息和所有子消息
    static private function getAllMessage($id, $model, $field)
    {

        $data = Yii::app()->db->createCommand()->select('*')->from(FUN::$dbname[$model])->
            where($field . "=:f or parent_id=:id", array(':f' => $id, ':id' => $id))->
            queryAll();

        return $data;

    }

    //删除动作
    static private function deleteOperate($id, $model, $field)
    {
        $delete = $model::model()->findByAttributes(array($field => $id));
        return $delete->delete();
        // return $type::model()->deleteAll($field => ":id", array(':id' => $id));


    }

    //删除站内信操作
    public static function stationDelete($id)
    {

        SiteInnerSmsUser::model()->smsOperate($id, U_ID, SiteInnerSmsUser::D);

    }
    //删除系统消息
    public static function sysmsgDelete($id)
    {

        $rs = SiteInnerSms::model()->updateAll(array('to_customer_status' => 1),
            'site_inner_sms_id=:id', array(':id' => $id));

        if ($rs) {
            FUN::$result['state'] = '1';
            FUN::$result['reason'] = '消息删除成功';
            exit(json_encode(FUN::$result));
        } else {
            FUN::$result['state'] = '0';
            FUN::$result['reason'] = '消息失败';
            exit(json_encode(FUN::$result));

        }
    }

    //邮件发送封装
    static public function sendEmail($data)
    {
        /*
        $data = array(
        'email'=>$email,
        'content' => '四海若邻绑定邮箱验证码：',
        'title' => '邮箱绑定',
        'description' => '四海若邻邮箱绑定');*/

        $body = $data['content'];
        $mailer = Yii::app()->mailer;
        $mailer->Host = 'smtp.163.com'; //'smtp.exmail.qq.com'//smtp.163.com
        $mailer->IsSMTP();
        $mailer->SMTPAuth = true;
        $mailer->From = 'gp101010@163.com'; //no-reply@go4seas.com//gp101010@163.com
        $mailer->AddReplyTo('gp101010@163.com'); //no-reply@go4seas.com//gp101010@163.com
        $mailer->AddAddress($data['email']);
        $mailer->FromName = '四海若邻';
        $mailer->Username = 'gp101010'; //这里输入发件地址的用户名no-reply@go4seas.com//gp101010
        $mailer->Password = '101010'; //这里输入发件地址的密码zyx123 //101010
        $mailer->SMTPDebug = false; //设置SMTPDebug为true，就可以打开Debug功能，根据提示去修改配置
        $mailer->CharSet = 'UTF-8';
        $mailer->Subject = Yii::t($data['title'], $data['description']);
        $mailer->Body = $body;
        $rs = $mailer->Send();

        // var_dump($rs);exit;
        return $rs;

    }

    //短信验证码发送封装
    static public function sendPhoneMessage($data)
    {
        $data['userId'] = '01313ad7-54e8-4080-9a42-dc1c752180b2';
        $data['passwd'] = '1cbb9d100c';
        $content = 'message=' . json_encode($data);
        $ch = curl_init(); //初始化curl
        curl_setopt($ch, CURLOPT_URL, 'http://api.goinsms.com/sms/http/submit'); //抓取指定网页
        curl_setopt($ch, CURLOPT_HEADER, 0); //设置header
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); //要求结果为字符串且输出到屏幕上
        curl_setopt($ch, CURLOPT_POST, 1); //post提交方式
        curl_setopt($ch, CURLOPT_POSTFIELDS, $content);
        $data = curl_exec($ch); //运行curl
        curl_close($ch);
        $arr = json_decode($data);

    }

    //短信验证发送限制
    public static function actionSendPhonenumsLimit()
    {

        $customer = Customer::model()->findByPk(U_ID);

        if (!empty($customer->attributes['tempyzmtime']) && ($customer->attributes['tempyzmtime'] +
            60) > time()) {

            FUN::$result['state'] = '0';
            FUN::$result['reason'] = '请稍后再获取验证码';
            exit(json_encode(FUN::$result));

        }
    }

}
?>