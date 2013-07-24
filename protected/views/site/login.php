<div class="row">
<div class="span4 offset4 well">

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'login-form',
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>

        <?php echo $model->getAttributeLabel('name'); ?>
        <?php echo $form->passwordField($model,'name', array('class'=>'span4')); ?>
        <?php echo $model->getAttributeLabel('password').' '.CHtml::link('(напомнить пароль)', array('/site/recovery')); ?>
	<?php echo $form->passwordField($model,'password', array('class'=>'span4')); ?>
    
        <?php 
        if(CCaptcha::checkRequirements()) {
        if($model->scenario == 'captchaRequired'){
        echo $form->captchaRow($model,'verifyCode', array('label' => false)); 
        }
        }
        ?>

	<?php $this->widget('bootstrap.widgets.TbButton', array(
            'buttonType'=>'submit',
            'type'=>'primary',
            'label'=>'Вход',
            'htmlOptions'=>array('class'=>'btn btn-info'),
        )); ?>

<?php $this->endWidget(); ?>

    </div>
</div>
