<?php
$button_label='Обменять';
$this->pageTitle = Yii::app()->name . ' - Обменник';
$this->breadcrumbs = array('Обменник');
?>

<h3>Обменник</h3>

<div class="alert in alert-block fade alert-danger">
     <b>Сервис не работает</b>
</div>

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

?>