<?php
$this->breadcrumbs=array(
	'Магазин'=>array('index'),
	$model->id,
);

?>

<h1>Просмотр товара #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'type',
                array(
                    'label'=>$model->getAttributeLabel('pic'),
                    'type'=>'image',
                    'value'=>$model->pic
                ),
		'item_name',
		'description',
		'price',
		'status',
	),
)); ?>
