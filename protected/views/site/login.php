<?php
$this->pageTitle=Yii::app()->name.' - Вход в личный кабинет';
?>

<h3 class="text-center">Вход в личный кабинет</h3>
<div class="row">
<div class="span4 offset4 well">

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'login-form',
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>

        <?php echo $form->textFieldRow($model,'name', array('class'=>'span4')); ?>
	<?php echo $form->passwordFieldRow($model,'password', array('class'=>'span4')); ?>
        <?php echo '<p>'.CHtml::link('(напомнить пароль)', array('/site/recovery')).'</p>'; ?>
    
        <?php 
        if(CCaptcha::checkRequirements()) {
        if($model->scenario == 'captchaRequired'){
        echo $form->captchaRow($model,'verifyCode', array('label' => false)); 
        }
        }
        ?>
        <div align=center>
	<?php $this->widget('bootstrap.widgets.TbButton', array(
            'buttonType'=>'submit',
            'type'=>'primary',
            'label'=>'Вход',
            'htmlOptions'=>array('class'=>'btn btn-info'),
        )); ?>
        </div>

<?php $this->endWidget(); ?>

    </div>
</div>
