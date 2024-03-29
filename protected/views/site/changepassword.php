<?php
$this->pageTitle = Yii::app()->name . ' - Смена пароля';
$this->breadcrumbs = array("Смена пароля");
?>

<h3>Смена пароля</h3>

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

<div class="form">
    
<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'login-form',
        'type'=>'horizontal',
	'enableClientValidation'=>true,
	'clientOptions'=>array(
	'validateOnSubmit'=>true,
	),
)); ?>

	<?php echo $form->passwordFieldRow($model,'password'); ?>
        <?php echo $form->passwordFieldRow($model,'password_repeat'); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
            'buttonType'=>'submit',
            'type'=>'primary',
            'label'=>'Сохранить',
        )); ?>
	</div>

<?php $this->endWidget(); ?>
        
</div>