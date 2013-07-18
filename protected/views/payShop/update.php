<?php
$this->breadcrumbs=array(
	'Магазин'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Обновить',
);

?>

<h3>Обновить товар <?php echo $model->id; ?></h3>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>