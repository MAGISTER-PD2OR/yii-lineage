<?php
$this->breadcrumbs=array(
	'Баланс',
);

?>

<h3>Балансы игроков</h3>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
