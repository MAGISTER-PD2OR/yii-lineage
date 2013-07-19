<?php
$button_label='Обменять';
$this->pageTitle = Yii::app()->name . ' - Обмен валют';
$this->breadcrumbs = array(
    'Обмен валют',
);
?>

<div class="alert in alert-block fade alert-info">
     <b>Кредитов: 
<?php
//echo AccountData::model()->getBonus(Yii::app()->user->name);
?> 
</b></div>

<?php if(Yii::app()->user->hasFlash('exchange')||Yii::app()->user->hasFlash('success'))
    {
    $this->widget('bootstrap.widgets.TbAlert', array(
        'block'=>true, // display a larger alert block?
        'fade'=>true, // use transitions?
        'alerts'=>array( // configurations per alert type
        'exchange'=>array('block'=>true, 'fade'=>true), // success, info, warning, error or danger
        'success'=>array('block'=>true, 'fade'=>true),
        ),
    ));
    } 
?>

<?php

echo 'Обмен игровой валюты по курсу 1 кредит = '.Yii::app()->params['exchangeCredits'].' руб.';

//$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
//    'id' => 'bonus-form',
//    'enableAjaxValidation' => false,
//        ));
//
//
//echo $form->hiddenField($model, 'name');
//echo $form->textFieldRow($model,'count', array('class'=>'span2'));
//
//
//$this->widget('bootstrap.widgets.TbButton', array(
//    'buttonType' => 'submit',
//    'type' => 'success',
//    'label' => $button_label,
//));
//
//$this->endWidget(); 

?>