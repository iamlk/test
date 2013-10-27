<?php
/**
 * 房子的外观图片至少三个
 * @author zyme
 */
class PropertyPictureFace extends CFormModel
{

    public $path1;
    public $path2;
    public $path3;

    public $file1;
    public $file2;
    public $file3;

    private $_is_error;

    /**
     * 规则
     */
    public function rules()
    {
        return array(array('path1, path2, path3, file1, file2, file3', 'checkAndSaveUploadFace'));
    }

    /**
     * 检查
     */
    public function checkAndSaveUploadFace()
    {
        if ($this->_is_error) return false;
        // files
        for ($k = 1; $k <= 3; $k++)
        {
            $uploadedFile = CUploadedFile::getInstanceByName("PropertyPictureFace[file$k]");
            if ($uploadedFile and $uploadedFile->error === 0 and preg_match('%^image/(gif|p?jpe?g|(x-)?png)$%', $uploadedFile->type))
            {
                // 文件名
                $newFileName = sprintf('%x', crc32($uploadedFile->tempName));
                // 扩展名
                if (preg_match('%^image/gif$%', $uploadedFile->type)) $newFileName .= '.gif';
                elseif (preg_match('%^image/p?jpe?g$%', $uploadedFile->type)) $newFileName .= '.jpg';
                else  $newFileName .= '.png';
                // 保存位置
                $path = Yii::app()->assetManager->basePath.DIRECTORY_SEPARATOR.$newFileName;
                // 保存(临时)并赋值
                if ($uploadedFile->saveAs($path))
                {
                    $this->{"file$k"} = $uploadedFile;
                    $this->{"path$k"} = $newFileName;
                }
            }
        }
        // paths
        if ($this->path1 == '' or $this->path2 == '' or $this->path3 == '')
        {
            $this->addErrors(array('picture' => Yii::t('propertyPicture', '请指定三个合法的图片(GIF/JPG/PNG)文件.')));
            $this->_is_error = true;
            return false;
        }
        // r
        return true;
    }

}
