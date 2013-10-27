<?php

/**
 *
 * (see {@link http://www.kindsoft.net/doc3.php?cmd=config }).
 *
 * @author Fedora.Liu
 */
class KindEditor extends CInputWidget {


        public $config = array();

        public $width = '100%';

        public $height = '200';

        public $clear = null;

        public $html = array();

        public function init(){
            $_config = array('uploadJson'=>"'".Yii::app()->createUrl('KindEditor/upload_json')."'",
        'fileManagerJson'=>"'".Yii::app()->createUrl('KindEditor/file_manager_json')."'",
        'allowFileManager'=>'true','themeType'=>'"simple"','items'=>"['emoticons', 'image']",'newlineTag'=>'"br"');
            $this->config = $this->config + $_config;
            if(!$this->html['id']) $this->html['id'] = str_replace(array('[',']'),array('_','_'),$this->name);
            $this->html['style'] .= "width:{$this->width};height:{$this->height};";
        }

        public function run() {
                $this->registerClientScript();
                echo CHtml::textArea($this->name, $this->value, $this->html);
        }

        /**
         * Registers the needed CSS and JavaScript.
         */
        public function registerClientScript() {
            $js =<<<EOP
KindEditor.ready(function(K) {
			var keditor = K.create('textarea[id="textarea_id"]', { js_options \r\n afterBlur: function(){this.sync();}});
            K('#id_').click(function(e) { keditor.html(''); });
		});
EOP;
        $js_option = '';
        foreach($this->config as $key=>$value){
            $js_option .= "\r\n".$key.' : '.$value.',';
        }
        if($this->clear)$js = str_replace('id_',$this->clear,$js);
        $js = str_replace('keditor','keditor_'.$this->html['id'],$js);
        $js = str_replace('js_options',$js_option,$js);
        $js = str_replace('textarea_id',$this->html['id'],$js);
        $cs = Yii::app()->getClientScript();
        $cs->registerScriptFile(Yii::app()->request->baseUrl."/js/kindeditor/kindeditor-min.js", CClientScript::POS_BEGIN);
        $cs->registerScript($this->html['id'], $js, CClientScript::POS_BEGIN);
        }

}
