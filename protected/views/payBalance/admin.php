<?php
$this->breadcrumbs=array('Баланс');

?>

<h3>Управление балансами</h3>

<?php $this->widget('application.widgets.BalanceModalWidget'); ?>

<?php $this->widget('bootstrap.widgets.TbGridView',array(
	'id'=>'pay-balance-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		//'id',
		'login',
		'balance',
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
		),
	),
)); ?>
