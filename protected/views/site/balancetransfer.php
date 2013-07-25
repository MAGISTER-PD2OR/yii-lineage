<?php
$this->pageTitle = Yii::app()->name . ' - Перевод баланса';
$this->breadcrumbs = array("Перевод баланса");
?>

<h3>Перевод средств на другой аккаунт</h3>

<?php if(Yii::app()->user->hasFlash('success')||Yii::app()->user->hasFlash('error'))
    {
    $this->widget('bootstrap.widgets.TbAlert', array(
        'block'=>true, // display a larger alert block?
        'fade'=>true, // use transitions?
        'alerts'=>array( // configurations per alert type
        'success'=>array('block'=>true, 'fade'=>true), // success, info, warning, error or danger
        'error'=>array('block'=>true, 'fade'=>true),
        ),
    ));
} 
?>

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'id'=>'pay-balance-form',
	'enableClientValidation'=>true,
	'clientOptions'=>array(
	'validateOnSubmit'=>true,
	),
)); ?>

	<?php echo $form->errorSummary($model); ?>

	<?php echo $form->textFieldRow($model,'login',array('class'=>'span5','maxlength'=>45)); ?>

	<?php echo $form->textFieldRow($model,'balance',array('class'=>'span5','maxlength'=>9)); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>'Передать',
		)); ?>
	</div>

<?php $this->endWidget(); ?>