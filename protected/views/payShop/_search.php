<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<?php echo $form->textFieldRow($model,'id',array('class'=>'span5','maxlength'=>11)); ?>

	<?php //echo $form->textFieldRow($model,'type',array('class'=>'span5','maxlength'=>20)); ?>
        <?php echo $form->dropDownListRow($model,'type', array('item'=>'item', 'stackable'=>'stackable') , array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'pic',array('class'=>'span5','maxlength'=>250)); ?>

	<?php echo $form->textFieldRow($model,'item_name',array('class'=>'span5','maxlength'=>50)); ?>

	<?php echo $form->textFieldRow($model,'description',array('class'=>'span5','maxlength'=>250)); ?>

	<?php echo $form->textFieldRow($model,'price',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'status',array('class'=>'span5')); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>'Search',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
