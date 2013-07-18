<?php
$this->breadcrumbs=array(
	'Баланс'=>array('index'),
	$model->id,
);

?>

<h3>Просмотр баланса <?php echo $model->login; ?></h3>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'login',
		'balance',
	),
)); ?>
