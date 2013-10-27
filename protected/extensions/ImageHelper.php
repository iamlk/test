<?php
/**
 * 图像助手类
 * @author zyme
 */
class ImageHelper
{

    /**
     * 验证图片文件符合要求
     * @return 返回true或错误消息
     */
    public static function validate($image)
    {
        // 是文件
        if ($image = realpath($image)) ;
        else  return Yii::t('imageHelper', '不是一个有效的文件.');
        // 是图片
        if ($_a = @getimagesize($image)) list($_width, $_height, $_type) = $_a;
        else  return Yii::t('imageHelper', '不是一个有效的图片文件.');
        if ($_type > 3) return Yii::t('imageHelper', '只支持GIF/JPEG/PNG格式的图片文件.');
        // 正确
        return true;
    }

    /**
     * 调整图片宽高
     * @param string 原图片文件
     * @param array 调整图片相关参数，参照 imagecopyresampled 的参数名.
     */
    public static function resize($src_image, $params = array())
    {
        // 原图宽高
        if ($src_image = realpath($src_image) and $_a = @getimagesize($src_image)) list($_width, $_height, $_type) = $_a;
        else  throw new CException(Yii::t('exception', '错误：不是一个有效的图片文件.'));
        if ($_type > 3) throw new CException(Yii::t('exception', '错误：只支持GIF/JPEG/PNG格式的图片文件.'));
        // 原图区域
        $src_w = $params['src_w'] > 0?max(1, min($params['src_w'], $_width)):$_width;
        $src_h = $params['src_h'] > 0?max(1, min($params['src_h'], $_height)):$_height;
        $src_x = max(0, min($params['src_x'], $_width - 1));
        $src_y = max(0, min($params['src_y'], $_height - 1));
        // 新图
        if ($dst_image = $params['dst_image'])
        {
            if (is_dir($dst_image)) throw new CException(Yii::t('exception', '错误：新图是一个存在的目录.'));
            if ($_p = realpath(dirname($dst_image))) $dst_image = $_p.DIRECTORY_SEPARATOR.basename($dst_image);
            else  throw new CException(Yii::t('exception', '错误：存放新图的目录不存在.'));
        }
        else  $dst_image = $src_image;
        // 新图区域
        $dst_w = ($params['dst_w'] > 0?max(1, $params['dst_w']):$_width);
        $dst_h = ($params['dst_h'] > 0?max(1, $params['dst_h']):$_height);
        $dst_x = max(0, min($params['dst_x'], $dst_w - 1));
        $dst_y = max(0, min($params['dst_y'], $dst_h - 1));
        // 复制图片
        $dst_im = imagecreatetruecolor($dst_w, $dst_h);
        if ($_type == 1) $src_im = imagecreatefromgif($src_image);
        if ($_type == 2) $src_im = imagecreatefromjpeg($src_image);
        if ($_type == 3) $src_im = imagecreatefrompng($src_image);
        $isok = imagecopyresized($dst_im, $src_im, $dst_x, $dst_y, $src_x, $src_y, $dst_w, $dst_h, $src_w, $src_h);
        if (!$isok) throw new CException(Yii::t('exception', '错误：调整图片宽高时复制图片出错.'));
        if ($_type == 1) $isok = imagegif($dst_im, $dst_image);
        if ($_type == 2) $isok = imagejpeg($dst_im, $dst_image, 100);
        if ($_type == 3) $isok = imagepng($dst_im, $dst_image);
        imagedestroy($dst_im);
    }

}
