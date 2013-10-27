<?php

class QuestionController extends BaseController
{
    public $layout = '';
	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
    function filters()
    {
        return array(
            'ajaxOnly + questionOther',
        );
    }
    public function actionQuestionOther($id=0){
        $id = $id?$id:Yii::app()->user->customer_id;
        $provider = Question::model()->getProvider(array('parent_type'=>'Customer','parent_id'=>$id));
		Yii::app()->clientScript->reset();
        $this->render('/center/ask_list_item_other',array('provider'=>$provider,'user_id'=>$id));
    }

    public function actionQuestionSelf($id=0){
        $id = $id?$id:Yii::app()->user->customer_id;
        $provider = Question::model()->getProvider(array('parent_type'=>'Customer','parent_id'=>$id));
		Yii::app()->clientScript->reset();
        $this->render('/center/ask_list_item_self',array('provider'=>$provider,'user_id'=>$id));
    }

    public function actionPostReply()
    {
        if(!$_POST['answer']){
            echo json_encode(Yii::t('sns','内容不能为空'));
            return;
        }
        if(!intval($_POST['question_id'])){
            echo json_encode(Yii::t('sns','参数有误'));
            return;
        }
        $model = Question::model()->findByAttributes(array('question_id'=>intval($_POST['question_id'])));
        if(!$model || $model->parent_type=='Customer' && $model->parent_id != Yii::app()->user->customer_id){
            echo json_encode(Yii::t('sns','你无权回复该问题'));
            return;
        }
        $data = array();
        $data['answer'] = $_POST['answer'];
        $data['question_id'] = intval($_POST['question_id']);
        $data['created'] = $data['updated'] = date('Y-m-d H:i:s');
        $data['customer_id'] = Yii::app()->user->customer_id;
        $model = new QuestionAnswer;
        $model->attributes = $data;
        $model->save();
        $data = array();
        $data[] = 'ok';
        $data[] = '<div class="answer">
						<div class="arrow"></div>
						<div class="head-title">尊敬的客户，您好！感谢您对我们的支持。</div>
						<p>'.$_POST['answer'].'</p>
						<div class="signature"> '.date('Y-m-d H:i:s').'<span>'.Yii::app()->user->customer_name.'</span></div>
					</div>';
        echo json_encode($data);
    }

    public function actionPostCustomer()
    {
        if(!$_POST['question']){
            echo json_encode(Yii::t('sns','内容不能为空'));
            return;
        }
        if(!intval($_POST['customer_id']) || $_POST['customer_id']==Yii::app()->user->customer_id){
            echo json_encode(Yii::t('sns','参数有误'));
            return;
        }
        $data = array();
        $data['question'] = $_POST['question'];
        $data['parent_type'] = 'Customer';
        $data['parent_id'] = intval($_POST['customer_id']);
        $data['created'] = date('Y-m-d H:i:s');
        $data['customer_id'] = Yii::app()->user->customer_id;
        $model = new Question;
        $model->attributes = $data;
        $model->save();
        $data = array();
        $data[] = 'ok';
        $data[] = '<li>
    					<div class="ask">
    						<p>'.$model->content.'</p>
    						<div class="signature"><span>'.Yii::app()->user->customer_name.'</span>'.date('Y-m-d H:i:s').'</div>
    					</div>
                    </li>';
        echo json_encode($data);
    }

	public function actionIndex()
	{
        $this->breadcrumbs[]='你问我答';
        Yii::app()->clientScript->registerCssFile('css/destination.css');
        $provider = Question::model()->getProvider(array('is_active'=>'1'));
		$this->render('index',array('provider'=>$provider,'select'=>'select'));
	}

    public function actionQuestion(){
        $provider = Question::model()->getProvider(array('is_active'=>'1'));
		$this->layout = '';
		Yii::app()->clientScript->reset();
        $this->render('ask_list_item',array('provider'=>$provider));
    }

    public function actionDeal($qid,$aid){
        $data = Question::model()->findByPk($qid);
        if(Yii::app()->user->customer_id != $data->customer_id){
            throw new CException(Yii::t('sns','该问题不是你提问的！'));
        }elseif($data->status!=Question::ASKING){
            throw new CException(Yii::t('sns','该问题已经处理过了！'));
        }else{
            $answer = QuestionAnswer::model()->findByAttributes(array('question_id'=>$qid,'question_answer_id'=>$aid));
            if(!$answer){
                throw new CException(Yii::t('sns','该答案不是回答您的提问！'));
            }
            $data->best_answer_id = $aid;
            $data->status = Question::DEALED;
            $data->save();
            $this->redirect($this->createUrl('question/view',array('id'=>$qid)));
        }
    }

    public function actionView($id)
    {
        $this->breadcrumbs[]='你问我答';
        $question = Question::model()->findByPk($id);
        $data = array('question'=>$question);
        //判断问题是否超时
        if($question->timeout<date('Y-m-d H:i:s')){
            $question->status = 1;
            $question->save(false);
        }
        if($question->status != Question::ASKING){
            $template='view';
            if($question->best_answer_id){
                $data['best_answer'] = QuestionAnswer::model()->findByPk($question->best_answer_id);
            }
        }elseif($question->customer_id==Yii::app()->user->customer_id){
            $template='view-self';
            if($_POST['question']){
                $question->askAddition('question');
            }
        }else{
            $model = new QuestionAnswer;
            $template='view-others';
            if($_POST['answer']){
                echo $model->addAnswer($id);
            }
            if($model->findByAttributes(array('question_id'=>$id,'customer_id'=>Yii::app()->user->customer_id))){
                $data['answered']=true;
            }
        }
        Yii::app()->clientScript->registerCssFile('css/destination.css');
        $this->render($template,$data);
    }

    public function actionAsk()
    {
        $this->breadcrumbs[]='你问我答';
        if(Yii::app()->user->isGuest) $this->redirect($this->createUrl('site/login'));
        Yii::app()->clientScript->registerCssFile('css/destination.css');
        $model=new Question;
        $data = array('model'=>$model);
        if(isset($_POST['question']))
        {
            $question_id = $model->askQuestion('question');
            if($question_id){
                $this->redirect($this->createUrl('question/view',array('id'=>$model->attributes['question_id'])));
            }else{
                if($model->errors){
                    $error = '';
                    foreach($model->errors as $k){
                        foreach($k as $v)
                            $error .= $v.'\n';
                    }
                    $data['error']=$error;
                }
            }
        }
        $this->render('ask',$data);
    }
}