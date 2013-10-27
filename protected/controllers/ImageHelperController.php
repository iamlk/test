<?php
/**
 * 图片上传接收器，对应ImageHelper工具类
 * @note 用于表单中图片上传按钮上传图片和保存
 * @note 示例:/index.php?r=imageHelper/upload&form=test&count=3
 * @author zyme
 */
class ImageHelperController extends BaseController
{

    /** YII_CSRF_TOKEN **/
    private function _makeCsrf()
    {
        echo CJSON::encode(array('name' => Yii::app()->request->csrfTokenName, 'value' => Yii::app()->request->getCsrfToken()));
        Yii::app()->end();
    }
    /** form **/
    private function _makeForm($formId, $fileCount)
    {
        $htmlOptions = array('enctype' => 'multipart/form-data');
        $properties = array('htmlOptions' => $htmlOptions);
        $formId and $properties['id'] = $formId;
        $form = $this->beginWidget('CActiveForm', $properties);
        for ($i = 0; $i < $fileCount; $i++) echo CHtml::fileField($fileCount == 1?'file':'file[]');
        echo CHtml::submitButton();
        $this->endWidget();
        Yii::app()->end();
    }
    /** message **/
    private function _makeMessage($code, $message = '', $name = '', $index = '', $key = '', $file = '')
    {
        $width_height = getimagesize('assets/'.$file);
        return array(
            'code' => $code?1:0,
            'message' => $message,
            'name' => $name,
            'index' => $index,
            'key' => $key,
            'file' => $file,
            'src' => $code?Yii::app()->assetManager->baseUrl.'/'.$file:'',
            'width'=> $width_height[0],
            'height'=>$width_height[1],
            'random' => sprintf('%x', crc32(__FILE__.__LINE__.md5(microtime()))),
            );
    }

    /**
     * 接收上传的图片
     * @return JSON
     */
    public function actionUpload()
    {
        if (!$_POST)
        {
            if (isset($_GET['form'])) return $this->_makeForm($_GET['form'], $_GET['count']);
            else  return $this->_makeCsrf();
        }
        else
        {
            // 消息
            $jsonArr = array();
            // 输入框名字
            $names = array_keys($_FILES) or array_push($jsonArr, $this->_makeMessage(0, '没有上传文件.'));
            // 上传
            foreach ($names as $index => $name)
            {
                $uploadedFiles = CUploadedFile::getInstancesByName($name);
                foreach ($uploadedFiles as $key => $uploadedFile)
                {
                    if ($uploadedFile)
                    {
                      
                        if ($uploadedFile->error === 0)
                        {
                            if (preg_match('%^image/(gif|p?jpe?g|(x-)?png)$%', $uploadedFile->type))
                            {
                              
                                if($uploadedFile->getSize()<=2*1024*1024)
                                {
                                     $_file = Yii::app()->assetManager->makeAssetFileUrl($uploadedFile, time(), 'product');
                                    if ($_file) array_push($jsonArr, $this->_makeMessage(1, '上传成功.', $name, $index, $key, $_file));
                                    else  array_push($jsonArr, $this->_makeMessage(0, '保存到服务器上失败.', $name, $index, $key, __LINE__));
                                }
                                else
                                {
                                    array_push($jsonArr, $this->_makeMessage(0, '上传文件太大', $name, $index, $key, __LINE__));
                                }
                                
                               
                            }
                            else  array_push($jsonArr, $this->_makeMessage(0, '只支持GIF/JPG/PNG格式的图片.', $name, $index, $key, __LINE__));
                        }
                        else  array_push($jsonArr, $this->_makeMessage(0, '上传失败.', $name, $index, $key, __LINE__));
                    }
                    else  array_push($jsonArr, $this->_makeMessage(0, '服务器没找到上传文件.', $name, $index, $key, __LINE__));
                }
            }

            //print_r($jsonArr);die;
            // 返回
            echo CJSON::encode($jsonArr);
            //echo json_encode($jsonArr);die;
            Yii::app()->end();
        }
    }

    public function actionTest()
    {
        $this->render('test');
    }

}
