<?php
/**
 * @desc 资源管理
 * @author zyme
 */
class BaseAssetManager extends CAssetManager
{
    /**
     * @desc 根据提供的PK的id数值等信息，规整资源文件，并返回url路径
     * @param string/CUploadedFile $fileInfo 文件物理地址或上传的文件对象
     * @param integer/null $idNumber 唯一的编号值，通常是数据表的PK的id数值，或为'time()'值
     * @param string/null $collectUrl 收集到指定的路径下，通常为"数据表/字段名"，或为''值
     * @param string/null $extName 指定的文件扩展名，会转为小写，或为'自动取文件的扩展名'值
     * @return string/null/false
     */
    public function makeAssetFileUrl($fileInfo, $idNumber = null, $collectUrl = null, $extName = null)
    {
        if (is_string($fileInfo))
        {
            if (($filePath = realpath($fileInfo)) !== false and is_file($filePath))
            {
                // 新文件名规则
                $extName === null and $extName = $this->_getFileExtName($filePath);
                $extName = $this->_getFileExtName(".$extName");
                $fileName = $this->hash(filemtime($filePath).sprintf('%u', filesize($filePath))).$extName;
                $idNumber = (int)$idNumber or $idNumber = time();
                $dirTree = date('Ymd');//wordwrap(sprintf('%010s', $idNumber), 2, '/', true);
                $new_fileUrl = trim((preg_match('#^[\w\./-]*$#', $collectUrl)?$collectUrl:'')."/$dirTree/$fileName", '/');
                // 新文件
                $new_filePath = str_replace('/', DIRECTORY_SEPARATOR, $this->getBasePath()."/$new_fileUrl");
                if (!is_dir($dir = dirname($new_filePath)))
                {
                    if (!mkdir($dir, $this->newDirMode, true)) throw new CException('Error: '.__METHOD__);
                    chmod($dir, $this->newDirMode);
                }
                rename($filePath, $new_filePath);
                chmod($new_filePath, $this->newFileMode);
                // 返回新文件url地址
                return $new_fileUrl;
            }
            else  return null;
        }
        elseif (is_object($fileInfo))
        {
            if ($fileInfo instanceof CUploadedFile)
            {
                $extName === null and $extName = $this->_getFileExtName($fileInfo->name);
                $extName = $this->_getFileExtName(".$extName");
                // 暂存临时文件，用saveAs方法，到assets目录
                $newPath = Yii::app()->assetManager->basePath.DIRECTORY_SEPARATOR.sprintf('%x', crc32($fileInfo->tempName)).$extName;
                $fileInfo->saveAs($newPath);
                // 再用文件归类方法
                return $this->makeAssetFileUrl($newPath, $idNumber, $collectUrl, $extName);
            }
            else  return false;
        }
        else  return false;
    }

    /**
     * @desc 返回一个文件的标准的扩展名，带.符号，如".jpg"，或无标准的扩展名时为''字串
     */
    private function _getFileExtName($fileName)
    {
        return strtolower(preg_replace('/^(.*?)(\.[\w-]+)*$/', '$2', $fileName));
    }

}
