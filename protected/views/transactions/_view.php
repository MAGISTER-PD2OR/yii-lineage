<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id),array('view','id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ip')); ?>:</b>
	<?php echo CHtml::encode($data->ip); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('login')); ?>:</b>
	<?php echo CHtml::encode($data->login); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('char_name')); ?>:</b>
	<?php echo CHtml::encode($data->char_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('item_type')); ?>:</b>
	<?php echo CHtml::encode($data->item_type); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('item_name')); ?>:</b>
	<?php echo CHtml::encode($data->item_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('count')); ?>:</b>
	<?php echo CHtml::encode($data->count); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('price_one')); ?>:</b>
	<?php echo CHtml::encode($data->price_one); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('price_final')); ?>:</b>
	<?php echo CHtml::encode($data->price_final); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('trans_date')); ?>:</b>
	<?php echo CHtml::encode($data->trans_date); ?>
	<br />

	*/ ?>

</div>