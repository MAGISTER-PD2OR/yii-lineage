<?php
$this->breadcrumbs=array(
	'Магазин-список',
);
?>
<h3>Магазин - список товаров</h3>

<?php $this->widget('bootstrap.widgets.TbListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
