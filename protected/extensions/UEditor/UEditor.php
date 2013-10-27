<?php

/**
 *
 * (see {@link http://www.kindsoft.net/doc3.php?cmd=config }).
 *
 * @author Fedora.Liu  
 */
class UEditor extends CInputWidget {

        public $config = array();
        
        /**
         * @note add by leo 由于后台规划编辑器配置统一 所以没必要个性配置 故声明了一个 $new_config 替代 前端$config参数无效
         * @date 9/22
        */
        public $new_config = array('toolbars'=>"[['Undo', 'Redo', 'fontsize', 'forecolor', 'insertimage', 'wordimage', 'removeformat','preview','bold','source','italic','backcolor','justifyleft','justifycenter','justifyright','justifyjustify','indent','formatmatch','autotypeset','fontfamily','paragraph','rowspacingtop','rowspacingbottom','lineheight','wordCount','link']]");

        public $width = 1000;

        public $height = 320;

        public $name = 'content';

        public $clear_id = null;

        public $htmlOptions=array('id'=>'content');

        public function init(){

        }

        public function run() {
                $this->registerClientScript();
                echo CHtml::textArea($this->name, $this->value, $this->htmlOptions);
        }

        /**
         * Registers the needed CSS and JavaScript.
         */
        public function registerClientScript() {
            $js =<<<EOP
            var editorOption = {js_options \r\n};
            var editor = new UE.ui.Editor(editorOption);
            editor.render("textarea_id");
            editor.ready(function(){
              editor.setContent("myContent");
            })
EOP;
        $js_option = '';
        foreach($this->new_config as $key=>$value){
            $js_option .= "\r\n".$key.' : '.$value.',';
        }
            $js_option .= 'initialFrameWidth:'.$this->width.',';
            $js_option .= 'initialFrameHeight:'.$this->height;
        //$js_option = substr($js_option,0,-1);
        $value = $this->value;
        $js = str_replace('js_options',$js_option,$js);
        $js = str_replace('textarea_id',$this->htmlOptions['id'],$js);
        $js = str_replace('myContent',$value,$js);
        if($this->clear_id)$js = str_replace('id_',$this->clear_id,$js);
        $cs = Yii::app()->getClientScript();
        $cs->registerScriptFile("/js/ueditor/editor_config.js", CClientScript::POS_BEGIN);
        $cs->registerScriptFile("/js/ueditor/editor_all.js", CClientScript::POS_BEGIN);
        $cs->registerScript('', $js, CClientScript::POS_BEGIN);
        }

}
