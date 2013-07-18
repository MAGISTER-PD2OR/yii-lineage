<?php
if (Yii::app()->user->isGuest) {
    $this->redirect(array('/site/login'));
}

$this->pageTitle = Yii::app()->name . ' - Пополнить баланс';
$this->breadcrumbs = array(
    'Пополнить баланс',
);
?>


<?php
$form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id' => 'pays-form',
    'enableAjaxValidation' => false,
        ));
?>

    <?php $this->beginWidget('bootstrap.widgets.TbModal', array('id'=>'ofertaModal')); ?>
     
    <div class="modal-header">
    <a class="close" data-dismiss="modal">×</a>
    <h4>Оферта</h4>
    </div>

    <div class="modal-body">
    <?php $this->renderPartial('/site/pages/oferta'); 
    ?>
    </div>
     
    <div class="modal-footer">
    <?php $this->widget('bootstrap.widgets.TbButton', array(
    'label'=>'Закрыть',
    'url'=>'#',
    'htmlOptions'=>array('data-dismiss'=>'modal'),
    )); ?>
    </div>
    <?php $this->endWidget(); ?>

<div class="well">

            <h3 class="text-warning">Пополнить баланс</h3>
            <p> Оплачивая услуги на сайте, Вы принимаете 
                <?php echo CHtml::link('оферту', '#', array('data-toggle'=>'modal','data-target'=>'#ofertaModal', )); ?>
            </p>

            <?php 
            //echo $form->textFieldRow($model, 'fio', array('class' => 'span4', 'maxlength' => 128, 'value' => Yii::app()->user->name)); 
            echo $form->hiddenField($model, 'fio', array('value' => Yii::app()->user->name));
            ?>
            <?php echo $form->textFieldRow($model, 'summ', array('class' => 'span2', 'value'=>'10', 'append'=>'р.')); ?>
            <?php echo $form->checkBoxRow($model, 'acceptOferta'); ?>

        <?php
        $this->widget('bootstrap.widgets.TbButton', array(
            'buttonType' => 'submit',
            'type' => 'success',
            'label' => 'Пополнить',
            'size' => 'large',
            'icon' => 'icon-ok',
        ));
        ?>

</div>

<?php $this->endWidget(); ?>