<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array( 
    'id'=>'accounts-form', 
    'enableAjaxValidation'=>false, 
)); ?>

    <h3>Регистрация</h3>

    <?php if(Yii::app()->user->hasFlash('success')||Yii::app()->user->hasFlash('pass_error'))
    {
    $this->widget('bootstrap.widgets.TbAlert', array(
        'block'=>true, // display a larger alert block?
        'fade'=>true, // use transitions?
        'alerts'=>array( // configurations per alert type
        'success'=>array('block'=>true, 'fade'=>true), // success, info, warning, error or danger
        'pass_error'=>array('block'=>true, 'fade'=>true),
        ),
    ));
    } 
    ?>
    
    <?php echo $form->errorSummary($model); ?>

    <?php echo $form->textFieldRow($model,'login',array('class'=>'span5','maxlength'=>32)); ?>

    <?php echo $form->passwordFieldRow($model,'password',array('class'=>'span5','maxlength'=>255)); ?>
    <?php echo $form->passwordFieldRow($model,'password_repeat',array('class'=>'span5','maxlength'=>255)); ?>

    <?php echo $form->textFieldRow($model,'email',array('class'=>'span5','maxlength'=>45)); ?>

    <?php if(CCaptcha::checkRequirements()): ?>
    <?php echo $form->captchaRow($model,'verifyCode',array(
    'hint'=>'Пожалуйста, введите буквы, показанные на картинке выше. Буквы вводятся без учета регистра.',
    )); ?>
    <?php endif; ?>

    <div class="form-actions"> 
        <?php $this->widget('bootstrap.widgets.TbButton', array( 
            'buttonType'=>'submit', 
            'type'=>'primary', 
            'label'=>'Зарегистрироваться', 
        )); ?>
    </div> 

<?php $this->endWidget(); ?>