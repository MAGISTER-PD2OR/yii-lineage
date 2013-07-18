<?php
$this->breadcrumbs=array(
	'История',
);
?>

<h3>Список транзакций</h3>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
