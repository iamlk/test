<?php
class ToolsController extends BaseController {

    public function __construct($id,$module = null){
        parent::__construct($id,$module);
    }

    public function actiontxt2img($t){
        Yii::app()->Txt2Img->display($_SESSION['txt_'.urlencode($t)]);
        if(isset($t['text'])) unset($_SESSION['txt_'.urlencode($t['text'])]);
    }

	public function actionThumb($wh,$f){
		header('content-type:image/jpeg');
		$src_file_path = './'.Yii::app()->params['assets'].'/'.$f;
		if(!file_exists($src_file_path)) {
			header('HTTP/1.1 404 Not Found');
			header("status: 404 Not Found");
			die;
		}
        $thumb_file_path = "./thumb/$wh/".$f;
        $this->make_path($thumb_file_path);
		$w_h = preg_split('/[^0-9]+/',$wh);
        G4S::img2thumb($src_file_path,$thumb_file_path,$w_h[0],$w_h[1],1);
        readfile($thumb_file_path);
	}
    
	public function actionAutoThumb($wh,$f){
		header('content-type:image/jpeg');
		$src_file_path = './'.Yii::app()->params['assets'].'/'.$f;
		if(!file_exists($src_file_path)) {
			header('HTTP/1.1 404 Not Found');
			header("status: 404 Not Found");
			die;
		}     
        $thumb_file_path = "./thumb/$wh/".$f;
        $this->make_path($thumb_file_path);
		$w_h = preg_split('/[^0-9]+/',$wh);
        //初始化
        $srcinfo = getimagesize($src_file_path);
        $src_w = $srcinfo[0];
        $src_h = $srcinfo[1];
        $src_p = $src_w/$src_h;
        $wh_p  = $w_h[0]/$w_h[1];
        if($wh_p>$src_p)
        {
            $w_h[0] = 0;
        }
        else
        {
            $w_h[1] = 0;
        }
        G4S::img2thumb($src_file_path,$thumb_file_path,$w_h[0],$w_h[1],1);
        readfile($thumb_file_path);
	}
    private function make_path($f)
    {
        $f_array = explode('/',trim($f));
        $path = '.';
        foreach($f_array as $name){
            if(!$name) continue;
            if($name == '.') continue;
            if(strstr($name,'.')) break;
            $path .= '/'.$name;
            if(is_dir($path)) continue;
            mkdir ($path, 0777, true);
        }
        return $path;
    }

	/**
     * Country  Linkage
     * @return array|void
     */
    public function actionGetState()
    {
        if (Yii::app()->request->isAjaxRequest)
        {
            $action = Yii::app()->request->getParam('action');
            if ($action == 'get_states_json')
            {
                $country_id = intval($_GET['countryId']);
                $data = Zone::model()->getZones($country_id, Yii::app()->params['languageId']);
                $str = array();
                Yii::import('application.extensions.Chinese2Pinyin');
                $py = new Chinese2Pinyin();
                foreach ($data as $zone)
                {
                    $pinyin = $py->pingyinFirstChar($zone['name']);
                    $str[] = array(
                        'id' => $zone['zone_id'],
                        'name' => $zone['name'],
                        'pinyin' => $pinyin[0],
                        'telcode' => '',
                        );
                }
                echo CJSON::encode($str);
            }
            else
                if ($action == 'get_cities_json')
                {
                    $zone_id = intval($_GET['zone_id']);
                    $data = City::model()->findAll('zone_id = :zone_id', array(':zone_id' => $zone_id));
                    $str = array();
                    foreach ($data as $zoneCity)
                    {
                        $str[] = array(
                            'id' => $zoneCity['city_id'],
                            'name' => $zoneCity['name'],
                            'pinyin' => $zoneCity['name_py'],
                            'telcode' => $zoneCity['tel_code'],
                            );
                    }
                    echo CJSON::encode($str);
                }
        }
        Yii::app()->end();
    }
}
