<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<?php echo $form->textFieldRow($model,'id',array('class'=>'span5','maxlength'=>10)); ?>

	<?php echo $form->textFieldRow($model,'ip',array('class'=>'span5','maxlength'=>250)); ?>

	<?php echo $form->textFieldRow($model,'login',array('class'=>'span5','maxlength'=>50)); ?>

	<?php echo $form->textFieldRow($model,'char_name',array('class'=>'span5','maxlength'=>50)); ?>

	<?php echo $form->textFieldRow($model,'item_type',array('class'=>'span5','maxlength'=>50)); ?>

	<?php echo $form->textFieldRow($model,'item_name',array('class'=>'span5','maxlength'=>50)); ?>

	<?php echo $form->textFieldRow($model,'count',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'price_one',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'price_final',array('class'=>'span5')); ?>

	<?php echo $form->textFieldRow($model,'trans_date',array('class'=>'span5')); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>'Search',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
