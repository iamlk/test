<?php
/* @var $this CityController */
/* @var $model City */
/* @var $form CActiveForm */
?>
<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'city-form',
	'enableAjaxValidation'=>false,
)); ?>
<?php if($type == 'create'){ ?>
    <br />
    <div>
    <p>城市名</p>
    <?php echo CHtml::textField('destination[name]',$model->cityAddendum->name,array('must'=>'yes')) ?>
    </div>

    <div class="row">
    <p>城市头图 : </p>
    <?php echo CHtml::fileField('photo',''); ?>
    </div>

    <div class="row">
    <p>城市描述 : </p>
    <?php echo CHtml::textArea('destination[description]',$model->cityAddendum->description,array('must'=>'yes')) ?>
    </div>

    <div class="row">
    <p>城市详情 : </p>
    <?php $this->widget("application.extensions.ueditor.UEditor", array('name' => 'destination[content]','width'=>'800','height'=>'400','value'=>$this->page,
    'config'=>array('toolbars'=>"[['Undo', 'Redo', 'customstyle', 'insertimage']]"))); ?>
<?php }else{ ?>
<?php   if(!$this->current_line){ ?>
    <br />
    <div>
    <p>城市名</p>
    <?php echo CHtml::textField('destination[name]',$model->cityAddendum->name,array('must'=>'yes')) ?>
    </div>

    <div class="row">
    <p>城市头图 : </p>
    <?php echo CHtml::fileField('photo',''); ?>
    </div>

    <div class="row">
    <p>城市描述 : </p>
    <?php echo CHtml::textArea('destination[description]',$model->cityAddendum->description,array('must'=>'yes')) ?>
    </div>
<?php }else{ ?>
    <br />
    <div class="row">
    <p>城市详情 : </p>
    <?php $this->widget("application.extensions.ueditor.UEditor", array('name' => 'destination[content]','width'=>'800','height'=>'400','value'=>$this->page,
    'config'=>array('toolbars'=>"[['Undo', 'Redo', 'customstyle', 'insertimage']]"))); ?>
    </div>
<?php }} ?>
    <?php echo CHtml::hiddenField('cityID', $model->city_id); ?>
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
        <a href="#" class="submit">提交修改</a>
	</div>

<?php $this->endWidget(); ?>
</div><!-- form -->