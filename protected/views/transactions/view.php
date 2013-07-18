<?php
$this->breadcrumbs=array(
	'Transactions'=>array('index'),
	$model->id,
);

?>

<h3>Просмотр транзакции #<?php echo $model->id; ?></h3>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'ip',
		'login',
		'char_name',
		'item_type',
		'item_name',
		'count',
		'price_one',
		'price_final',
		'trans_date',
	),
)); ?>
