<?php
/**
 * 全局函数库，全站通用的函数都写进来，静态函数，Controller、model、view都可以调用，类似CHtml::link()
 * 调用方式Global::your_function();
 */
class G4S extends BaseActiveRecord
{
    
    /**  add by leo  **/
    
   public static $charset	= 'auto';
   

    
    /**
     * 计算两组经纬度坐标 之间的距离
     * @param float $lng1 经度1
     * @param float $lat1 纬度1
     * @param float $lng2 经度1
     * @param float $lat2 纬度1
     * @return float 距离(米)
     * @demo GetDistance(116.4767, 39.908156, 116.450479, 39.908452);
     */
     // Fedora
    public static function getDistance($lng1, $lat1, $lng2, $lat2, $decimal = 2)
    {
        $radLat1 = $lat1 * pi() / 180.0;
        $radLat2 = $lat2 * pi() / 180.0;
        $a = $radLat1 - $radLat2;
        $b = ($lng1 * pi() / 180.0) - ($lng2 * pi() / 180.0);
        $s = 2 * asin(sqrt(pow(sin($a / 2), 2) + cos($radLat1) * cos($radLat2) * pow(sin($b / 2), 2)));
        $s = $s * 6371.004; // 地球的球面平均半径
        return round($s * 1000, $decimal);
    }

     // Fedora
    public static function getAttactionsByXY($XY)
    {
        if($XY['y0']>=$XY['y1']) return null;
        if($XY['x0']<$XY['x1']) $condition = "longitude > ".$XY['x0']." and longitude < ".$XY['x1']." and latitude > ".$XY['y0']." and latitude < ".$XY['y1'];
        else $condition = "(longitude > ".$XY['x0']." and longitude < 180 or longitude < ".$XY['x1']." and longitude > -180 ) and latitude > ".$XY['y0']." and latitude < ".$XY['y1'];
        return Attraction::model()->findAll($condition);
    }

     // Fedora
    public static function getXYbyPoint($lng,$lat,$km=1)
    {
        $km *= 1000;
        $Rx=111319.55;
        $Ry=110946.30;
        //one表示当前纬度上1°的距离（米）
        $one = $Rx * cos(abs($lat));
        $lng_distance = $km/$one;
        $lat_distance = $km/$Ry;

        $XY = array();
        $XY['x0'] = ($lng-$lng_distance<-180)?($lng-$lng_distance+360):($lng-$lng_distance);
        $XY['x1'] = ($lng+$lng_distance> 180)?($lng+$lng_distance-360):($lng+$lng_distance);
        $XY['y0'] = ($lat-$lat_distance<-90)?(-90):($lat-$lat_distance);
        $XY['y1'] = ($lat+$lat_distance>90) ? (90):($lat+$lat_distance);
        return $XY;
    }

     // Fedora
    public static function countDays($from_date,$to_date){
        if(!$from_date || !$to_date) return 0;
        $a_dt=strtotime($from_date);
        $b_dt=strtotime($to_date);
        return round(abs($a_dt-$b_dt)/86400);
    }

     // Fedora
    public static function num2char($num,$uppercase=false,$mode=true){
    	$char = array('零','一','二','三','四','五','六','七','八','九');
    	if($uppercase)$char = array('零','壹','贰','叁','肆','伍','陆','柒','捌','玖');
    	$dw = array('','十','百','千','','万','亿','兆');
    	if($uppercase)$dw = array('','拾','佰','仟','','萬','億','兆');
    	$dec = '点';
        if($uppercase)$dec = '點';
    	$retval = '';
    	if($mode){
    		preg_match_all('/^0*(\d*)\.?(\d*)/',$num, $ar);
    	}else{
    		preg_match_all('/(\d*)\.?(\d*)/',$num, $ar);
    	}
    	if($ar[2][0] != ''){
    		$retval = $dec . ch_num($ar[2][0],false); //如果有小数，先递归处理小数
    	}
    	if($ar[1][0] != ''){
    		$str = strrev($ar[1][0]);
    		for($i=0;$i<strlen($str);$i++) {
    			$out[$i] = $char[$str[$i]];
    			if($mode){
    				$out[$i] .= $str[$i] != '0'? $dw[$i%4] : '';
    				if($str[$i]+$str[$i-1] == 0){
    					$out[$i] = '';
    				}
    				if($i%4 == 0){
    					$out[$i] .= $dw[4+floor($i/4)];
    				}
    			}
    		}
    		$retval = join('',array_reverse($out)) . $retval;
    	}
    	return $retval;
    }

     // Fedora
    //判断是否是ASCII字符（即英文字符）
    public static function is_English($str,$encode='utf-8')
    {
        $num = mb_strlen($str,$encode);
        for($i=0;$i<$num;$i++){
            if(ord(mb_substr($i,$i+1,$num,$encode)) > 127){
               return false;
           }
        }
        return true;
    }
    
     // Fedora
    public function seconds2day($time){
        if($time<0)return 0;
        if($time<60){
            return $time.Yii::t('order','秒');
        }elseif($time<3600){
            $minutes = floor($time/60);
            $seconds = $time%60;
            return $minutes.Yii::t('order','分').$seconds.Yii::t('order','秒');
        }elseif($time<86400){
            $hours = floor($time/3600);
            $minutes = floor(($time%3600)/60);
            $seconds = $time%60;
            return $minutes.Yii::t('order','小时').$minutes.Yii::t('order','分').$seconds.Yii::t('order','秒');
        }else{
            $days = floor($time/86400);
            $hours = floor(($time%86400)/3600);
            $minutes = floor(($time%3600)/60);
            $seconds = $time%60;
            return $days.Yii::t('order','天').$hours.Yii::t('order','小时').$minutes.Yii::t('order','分').$seconds.Yii::t('order','秒');
        }
        return $this->created;
    }

    /**
     * 生成缩略图
     * @param string     源图绝对完整地址{带文件名及后缀名}
     * @param string     目标图绝对完整地址{带文件名及后缀名}
     * @param int        缩略图宽{0:此时目标高度不能为0，目标宽度为源图宽*(目标高度/源图高)}
     * @param int        缩略图高{0:此时目标宽度不能为0，目标高度为源图高*(目标宽度/源图宽)}
     * @param int        是否裁切{宽,高必须非0}
     * @param int/float  缩放{0:不缩放, 0<this<1:缩放到相应比例(此时宽高限制和裁切均失效)}
     * @return boolean
     */
     // Fedora
    public static function img2thumb($src_img, $dst_img, $width = 75, $height = 75, $cut = 0, $proportion = 0)
    {
        if(!is_file($src_img))
        {
            return false;
        }
        $ot = pathinfo($dst_img, PATHINFO_EXTENSION);
        $otfunc = 'image' . ($ot == 'jpg' ? 'jpeg' : $ot);
        $srcinfo = getimagesize($src_img);
        $src_w = $srcinfo[0];
        $src_h = $srcinfo[1];
        $type  = strtolower(substr(image_type_to_extension($srcinfo[2]), 1));
        $createfun = 'imagecreatefrom' . ($type == 'jpg' ? 'jpeg' : $type);
        
        if(!$width){
            $width = $height*$src_w/$src_h;
        }
        if(!$height){
            $height = $width*$src_h/$src_w;
        }
        
        $dst_h = $height;
        $dst_w = $width;
        $x = $y = 0;
        /**
         * 缩略图不超过源图尺寸（前提是宽或高只有一个）
         */
        if(($width> $src_w && $height> $src_h) || ($height> $src_h && $width == 0) || ($width> $src_w && $height == 0))
        {
            $proportion = 1;
        }
        if($width> $src_w)
        {
            $dst_w = $width = $src_w;
        }
        if($height> $src_h)
        {
            $dst_h = $height = $src_h;
        }

        if(!$width && !$height && !$proportion)
        {
            return false;
        }
        if(!$proportion)
        {
            if($cut == 0)
            {
                if($dst_w && $dst_h)
                {
                    if($dst_w/$src_w> $dst_h/$src_h)
                    {
                        $dst_w = $src_w * ($dst_h / $src_h);
                        $x = 0 - ($dst_w - $width) / 2;
                    }
                    else
                    {
                        $dst_h = $src_h * ($dst_w / $src_w);
                        $y = 0 - ($dst_h - $height) / 2;
                    }
                }
                else if($dst_w xor $dst_h)
                {
                    if($dst_w && !$dst_h)  //有宽无高
                    {
                        $propor = $dst_w / $src_w;
                        $height = $dst_h  = $src_h * $propor;
                    }
                    else if(!$dst_w && $dst_h)  //有高无宽
                    {
                        $propor = $dst_h / $src_h;
                        $width  = $dst_w = $src_w * $propor;
                    }
                }
            }
            else
            {
                if(!$dst_h)  //裁剪时无高
                {
                    $height = $dst_h = $dst_w;
                }
                if(!$dst_w)  //裁剪时无宽
                {
                    $width = $dst_w = $dst_h;
                }
                $propor = min(max($dst_w / $src_w, $dst_h / $src_h), 1);
                $dst_w = (int)round($src_w * $propor);
                $dst_h = (int)round($src_h * $propor);
                $x = ($width - $dst_w) / 2;
                $y = ($height - $dst_h) / 2;
            }
        }
        else
        {
            $proportion = min($proportion, 1);
            $height = $dst_h = $src_h * $proportion;
            $width  = $dst_w = $src_w * $proportion;
        }

        $src = $createfun($src_img);
        $dst = imagecreatetruecolor($width ? $width : $dst_w, $height ? $height : $dst_h);
        $white = imagecolorallocate($dst, 255, 255, 255);
        imagefill($dst, 0, 0, $white);

        if(function_exists('imagecopyresampled'))
        {
            imagecopyresampled($dst, $src, $x, $y, 0, 0, $dst_w, $dst_h, $src_w, $src_h);
        }
        else
        {
            imagecopyresized($dst, $src, $x, $y, 0, 0, $dst_w, $dst_h, $src_w, $src_h);
        }
        imagejpeg($dst, $dst_img);
        imagedestroy($dst);
        imagedestroy($src);
        return true;
    }
   /** followning add by leo  **/
   
   //public static $charset	= 'auto';
   
   /**
	 * 以新浪微博的字数统计方式统计字数
	 * 中文算1个，英文算0.5个，全角字符算1个，半角字符算0.5个。
	 * @link http://jsliuliang.blog.163.com/blog/static/12333516320097143434850/
	 * @version $Id: strlen_weibo.func.php 17910 2011-08-19 12:16:25Z yaoying $
	 * @param string $string
	 * @return integer
	 */
	static public function strlen_weibo($string)
	{
	    if(is_string($string)) 
        {
            $string=trim(trim($string,' '));
            return (strlen($string) + mb_strlen($string,'UTF-8')) / 4;
        }
        else
        {
            return false;
        }

	}
	/**
	 * 截取指定长度的字符串，超出部分用 ..替换
	 * @param string $text
	 * @param int $length
	 * @param string $replace
	 * @param string $encoding
	 */
	static function substr_format($text, $length, $replace='..', $encoding='UTF-8') 
	{
		if ($text && mb_strlen($text, $encoding)>$length)
		{
			return mb_substr($text, 0, $length, $encoding).$replace;
		}
		return $text;
	}
	/**
	 * 
	 * 字符编码转换
	 * 
	 * */
	static function xwb_iconv($source, $in, $out)
	{
		$in		= strtoupper($in);
		$out	= strtoupper($out);
		if ($in == "UTF8"){$in = "UTF-8";}
		if ($out == "UTF8"){$out = "UTF-8";}
		if($in==$out){ return $source;}
	
		if(function_exists('mb_convert_encoding')) {
			return mb_convert_encoding($source, $out, $in );
		}elseif (function_exists('iconv'))  {
			return iconv($in,$out."//IGNORE", $source);
		}
		return $source;
	}
	
		
	/**
	*  Created:  2010-10-28
	*
	*  截取一定长度的字符串
	*
	*  @Xweibo (C)1996-2099 SINA Inc.
	*  @Author guoliang1 <guoliang1@staff.sina.com.cn>
	*
	***************************************************/
	
	static function cut_string($str, $len=90)
	{
		// 检查长度
		if (mb_strwidth($str, 'UTF-8')<=$len)
		{
			return $str;
		}
	
		
		// 截取
	    $i 		= 0;   
	    $tlen 	= 0;   
	    $tstr 	= '';   
	    
	    while ($tlen < $len) 
	    {   
	        $chr 	= mb_substr($str, $i, 1, 'UTF-8');   
	        $chrLen = ord($chr) > 127 ? 2 : 1;   
	        
	        if ($tlen + $chrLen > $len) break;   
	        
	        $tstr .= $chr;   
	        $tlen += $chrLen;   
	        $i ++;   
	    }
	    
	    if ($tstr != $str) 
	    {   
	        $tstr .= '...';   
	    }
	    
	    return $tstr; 
	}
	/**
	*  Created:  2010-10-28
	*
	*  防止XSS攻击,htmlspecialchars的别名
	*
	*  @Xweibo (C)1996-2099 SINA Inc.
	*  @Author guoliang1 <guoliang1@staff.sina.com.cn>
	*
	***************************************************/
	
	static function escape($str,  $quote_style = ENT_COMPAT )
    {
	    return htmlspecialchars($str, $quote_style);
	}
	/**
	 * 格式化时间
	 * 
	 * */
	static function wb_date_format($time,$format='m月d日 H:i')
	{
		$now = time();
	
		$t = $now - $time;
	
	    if($t >= 3600)
	    {
			if(date('Y')==date('Y',$time))
	    	$time =date($format,$time);
	    	else 
	    	$time =date('Y年m月d日 H:i',$time);
	    }
	    
	    elseif ($t < 3600 && $t >= 60)
	    {
			$time = floor($t / 60) . "分钟前";
		}
		else
	    {
			$time = "刚刚";
		}
	
		return $time;
	}
   
	static function isChinese($string)
	{
		if(preg_match("/^[\x{4e00}-\x{9fa5}]+$/u",$string))
		return true;
		return false;
	}
	static function isMobile($mobile)
	{
		if(preg_match("/^1[345689]\d{9}$/", $mobile))
		return true;
		return false;
	}
	static function dayToWeek($time)
	{
		$time = empty($time) ? TIME : $time;
		$date[0] = '周日';
		$date[1] = '周一';
		$date[2] = '周二';
		$date[3] = '周三';
		$date[4] = '周四';
		$date[5] = '周五';
		$date[6] = '周六';
		
		return $date[Date('w',$time)];
	
	}
    /**
  	 * 过滤页面html标签
  	 * $string $is_org  保留标签仅转义
  	 * $string $is_tag  替换标签
  	 * $string $is_xss  xss 攻击屏蔽
  	 * 
  	 * */
	public static function filter_html($content,$is_org=true,$is_clear=false,$is_tag=false,$is_xss=false)
	{
			//页面标签空格过滤
			$string = trim($content);
			if($is_org)
			{
	 			$string	=	self::convert_tags($string);
	 		}
	 		if($is_clear)
	 		{
	 		 	$string	=	strip_tags($string);
	 		}
	 		if($is_tag)
	 		{
	 			$string	=	self::strip_selected_tags($string,"<script><iframe><style><link><meta>");
	 		}
	 		if($is_xss)
	 		{
	 			$string	=	self::remove_xss($string);
	 		}
	 		
		return $string;
	
	}
	/**
	 * 过滤非法标签
	 * 
	 * */
  	public static function strip_selected_tags($str,$disallowable="<script><iframe><style><link>")
	{
		$disallowable	= trim(str_replace(array(">","<"),array("","|"),$disallowable),'|');
		$str			= str_replace(array('&lt;', '&gt;'),array('<', '>'),$str);
		$str			= preg_replace("~<({$disallowable})[^>]*>(.*?<\s*\/(\\1)[^>]*>)?~is",'$2',$str);
		
		return $str;
	}
	/**
	 * 不转换标签  替换或转义标签
	 * 
	 * */
	public static function convert_tags($str)
	{

		if($str)
	//	$str = str_replace(array('&','<', '>',"'",'"'),array('&amp;','&lt;', '&gt;','&#039;','&quot;'),$str);
    	$str = str_replace(array('<', '>',"'",'"'),array('&lt;', '&gt;','&#039;','&quot;'),$str);
	 	return $str;
	}
	public static function remove_xss($val)
  	{
	   $val 	= preg_replace('/([\x00-\x08,\x0b-\x0c,\x0e-\x19])/', '', $val);
	   $search 	= 'abcdefghijklmnopqrstuvwxyz';
	   $search .= 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
	   $search .= '1234567890!@#$%^&*()';
	   $search .= '~`";:?+/={}[]-_|\'\\';
	   
	   for ($i = 0; $i < strlen($search); $i++) 
	   {
	    $val = preg_replace('/(&#[xX]0{0,8}'.dechex(ord($search[$i])).';?)/i', $search[$i], $val);       $val = preg_replace('/(&#0{0,8}'.ord($search[$i]).';?)/', $search[$i], $val);  
	   }
	   	$ra		= self::getBanwords(5);
	   $found 	= true;
	   while ($found == true) 
	   {
	      $val_before = $val;
	      for ($i = 0; $i < sizeof($ra); $i++)
	       {
	       	 $pattern = '/';
	         for ($j = 0; $j < strlen($ra[$i]); $j++)
	         {
	            if ($j > 0) 
	            {
	               $pattern .= '(';
	               $pattern .= '(&#[xX]0{0,8}([9ab]);)';
	               $pattern .= '|';
	               $pattern .= '|(&#0{0,8}([9|10|13]);)';
	               $pattern .= ')*';
	            }
	            $pattern .= $ra[$i][$j];
	         }
	         $pattern .= '/i';
	         $replacement = substr($ra[$i], 0, 2).'<x>'.substr($ra[$i], 2);
	         $val = preg_replace($pattern, $replacement, $val);
	         if ($val_before == $val)
	         {
	            $found = false;
	         }
	      }
	   }
	   
	   return $val;
   }
    public static function jstrpos($haystack, $needle, $offset = null)
   {
   		$needle	 = trim($needle);
		$jstrpos = false;
		if(function_exists('mb_strpos'))
		{
			$jstrpos = mb_strpos($haystack, $needle, $offset, self::$charset);
		}
		elseif(function_exists('strpos'))
		{
			$jstrpos = strpos($haystack, $needle, $offset);
		}
		return $jstrpos;
   }
   /**
	 * 发送一个http请求
	 * 
	 * @param  $url    请求链接
	 * @param  $method 请求方式
	 * @param array $vars 请求参数
	 * @param  $time_out  请求过期时间
	 * @return Ambigous <string, mixed>
	 */
	static function get_curl($url, array $vars=array(), $method = 'post')
	{
		$method = strtolower($method);
		
		if($method == 'get' && !empty($vars))
		{
			if(strpos($url, '?') === false)
			{
				$url = $url . '?' . http_build_query($vars);
			}
			else
			{
				$url = $url . '&' . http_build_query($vars);
			}
		}
		
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	
		if ($method == 'post') 
		{
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $vars);
		}	
		$result = curl_exec($ch);
	
		if(!curl_errno($ch))
		{
			$result = trim($result);
		}
		else 
		{
			$result = 'error';
		}
		
		curl_close($ch);
		return $result;
        
	}
    /**
	 * 获取客户端ip
	 * 
	 * */
	public static function getIp()
	{
		if (isset($_SERVER['HTTP_CLIENT_IP']))
		{
			return $_SERVER['HTTP_CLIENT_IP'];
		}
		else if (isset($_SERVER['HTTP_X_FORWARDED_FOR']))
		{
			return $_SERVER['HTTP_X_FORWARDED_FOR'];
		}
		else if (isset($_SERVER['REMOTE_ADDR']))
		{
			return $_SERVER['REMOTE_ADDR'];
		}
		return '';
	}
    
    /**
     *获取禁用词词库
    **/
    public static function getBanwords($type = null)
    {
        $data = array();
        if($type === null)return $data;
        
        $_data = Yii::app()->cache->get('ban_words'.$type);
        if($_data)
        {
            $data = json_decode($_data,true);
        }
        
        if($data) return $data;
       
        $models = Banwords::model()->findAll(array('select'=>'word','condition'=>"type = $type and is_active = 1"));
        foreach($models as $v)
        {
            $data[] = $v->word;
        }
        Yii::app()->cache->set('ban_words'.$type,json_encode($data),0);
        return $data;
    }
    
    /**
     *获取关键词词库
    **/
    public static function getKeywords($type = null)
    {
        $data = array();
        if($type === null)return $data;
        
        $_data = Yii::app()->cache->get('key_words'.$type);
        if($_data)
        {
            $data = json_decode($_data,true);
        }
        
        if($data) return $data;
       
        $models = Keywords::model()->findAll(array('select'=>'word','condition'=>"type = $type and is_active = 1"));
        foreach($models as $v)
        {
            $data[] = $v->word;
        }
        Yii::app()->cache->set('key_words'.$type,json_encode($data),0);
        return $data;
    }
    /**
	 * 是否有禁用词
	 * */
 	public static function hasBanwords($string,$type = 0)
	{
		static $filter_array = array();
		
		$string	= trim($string);
		
		if($string)
	 	{
			
	 		$filter_array = self::getBanwords($type);

			if(!empty($filter_array))
			{
				
				foreach ($filter_array as $keyword)
				{				
					$strpos = self::jstrpos($string, $keyword);
					
					if($strpos!==false)
					{
						$keyword_len = strlen($keyword);
						
						//if($keyword_len>2 && $keyword_len<40)
						//{
							return "含有禁止发布的内容:<font color='red' >{$keyword}</font>，请修改后重新发布！";
						//}
					}
				}
			}
		}

		return false;
		
	}
    
    /**
	 * 文中若有非法词汇 全部替换为 *
	 * */
	public static function convertArticle($string,$type = 0)
	{
		$string	= trim($string);
		if(!$string) return $string;
	    $fileter_list = self::getBanwords($type);
		if(!empty($fileter_list))
		{
			$filter_keyword_list = $fileter_list;
		
				foreach ($filter_keyword_list as $keyword)
				{				
					$strpos = self::jstrpos($string, $keyword);
					
					if($strpos!= false)
					{
						$replace =  str_repeat("*",String::strlen_weibo($keyword));
						$string	= str_replace(trim($keyword),$replace,$string);
					}
				}
			
		}

		return $string;	
	}
    /**
	 * 字符串中关键词匹配 返回
	 * */
	public static function matchKeywords($string,$type = 0)
	{
		$string	= trim($string);
		if(!$string) return $string;
	    $fileter_list = self::getKeywords($type);
		if(!empty($fileter_list))
		{
			$filter_keyword_list = $fileter_list;
		
				foreach ($filter_keyword_list as $keyword)
				{				
					$strpos = self::jstrpos($string, $keyword);
					
					if($strpos!= false)
					{
						//$replace =  str_repeat("*",String::strlen_weibo($keyword));
                        $replace = "<font color='orange'>$keyword<font>";
						$string	= str_ireplace(trim($keyword),$replace,$string);
					}
				}
		}
		return $string;	
	}
    
    /**
     * email 发送器
    **/
    public static function sendEmail($email,$contents = "",$subject="四海旅游网络,资讯订阅中心",$from="四海若邻")
    {
        if(mb_strlen(trim($contents)) == 0)
        {
            $contents = '四海旅游网络,资讯订阅中心,欢迎您的加入,http://'.$_SERVER['HTTP_HOST'];
        }
        
        $body = $contents;
        $mailer = Yii::app()->mailer;
        $mailer->Host = 'smtp.exmail.qq.com';
        $mailer->IsSMTP();
        $mailer->isHTML(true);
        $mailer->SMTPAuth = true;
        $mailer->From = 'no-reply@go4seas.com';
        $mailer->AddReplyTo('no-reply@go4seas.com');
        $mailer->AddAddress($email);
        $mailer->FromName = $from;
        $mailer->Username = 'no-reply@go4seas.com'; //这里输入发件地址的用户名
        $mailer->Password = 'zyx123'; //这里输入发件地址的密码
        $mailer->SMTPDebug = false; //设置SMTPDebug为true，就可以打开Debug功能，根据提示去修改配置
        $mailer->CharSet = 'UTF-8';
        $mailer->Subject = $subject;
        $mailer->Body = $body;
        return $mailer->Send();
    }
   
   
    /**
     *  可逆加密解密  leo
     * @example        
     * 
     *  $a = 'yanzhiwei';
     *   // 加密
     *  $b = G4S::extendEncrypt($a,'www');
     *   // 解密
     *  echo G4S::extendDecrypt($b,'www');die;
     * 
     * 
     **/
     // 解密
    static function extendDecrypt($encryptedText,$key)
	{
		$cryptText 		= base64_decode($encryptedText);
		$ivSize 		= mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB);
		$iv 			= mcrypt_create_iv($ivSize, MCRYPT_RAND);
		$decryptText 	= mcrypt_decrypt(MCRYPT_RIJNDAEL_256, $key, $cryptText, MCRYPT_MODE_ECB, $iv);
		
		return trim($decryptText);
	}
	
	//可逆加密
	static function extendEncrypt($plainText,$key)
	{
		$ivSize			= mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB);
		$iv 			= mcrypt_create_iv($ivSize, MCRYPT_RAND);
		$encryptText	= mcrypt_encrypt(MCRYPT_RIJNDAEL_256, $key, $plainText, MCRYPT_MODE_ECB, $iv);
		
		return trim(base64_encode($encryptText));
	
   }
   
   public static function format($float,$ext=2)
   {
        return number_format(round($float,$ext),$ext,'.','');
   }
   
   /**
     *  rick  add  设置COOKIE   读取COOKIE
     */ 
    
   static  public function SetCookie($CKname,$CKcontent,$key)
    {  
        //加密先
       
        $email=G4S::extendEncrypt($CKcontent,$key);
        //首先新建cookie
        $cookie = new CHttpCookie($CKname,$email);
        //定义cookie的有效期
        $cookie->expire = time() + 60 * 60 * 24 * 15; //有限期15天
        //把cookie写入cookies使其生效
        Yii::app()->request->cookies[$CKname] = $cookie;


    }

  static  public function ReadyCookie($CKname,$key)
    {
    
        $cookie = Yii::app()->request->getCookies();

        $CKcontent=G4S::extendDecrypt($cookie[$CKname]->value,$key);
         return $CKcontent;


    }
    
    
}