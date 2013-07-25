<?php
$this->pageTitle = Yii::app()->name . ' - Перенос персонажа на другой аккаунт';
$this->breadcrumbs = array("Перенос персонажа на другой аккаунт");
?>

<h3>Перенос персонажа на другой аккаунт</h3>

<div class="alert in alert-block fade alert-info">
<b>Стоимость: 
<?php echo Yii::app()->params['change_account']; ?> 
</b></div>

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

        <?php echo $form->dropDownListRow($model,'char_name', $model->getCharList(Yii::app()->user->name)); ?>
	<?php echo $form->textFieldRow($model,'account_name'); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
            'buttonType'=>'submit',
            'type'=>'primary',
            'label'=>'Перенести',
        )); ?>
	</div>

<?php $this->endWidget(); ?>
        
</div>